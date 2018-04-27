var nbQuestion=1;
var idAnswer=1

class Answer {
	constructor(type, idQuestion, remove = true , param="", placeholder = 'Answer', ok=true, prepend=true) {
		this.active = true;
		this.type=type;
		this.idQuestion=idQuestion;
		this.id=idAnswer;
		idAnswer++;
		this.ok = ok;
		this.delete = remove;
		this.placeholder=placeholder;
		this.param=param;
		this.description="";
		if(prepend){
			$("#Q"+this.idQuestion+" #inputQ"+this.idQuestion).prepend(this.text());
		}else{
			$("#Q"+this.idQuestion+" #inputQ"+this.idQuestion).append(this.text());
		}
		this.eventOk();
		this.eventDelete();
	}

	text () {
		let text="";
		if (this.active) {
			text = '<div id="I'+this.id+'"><input type="' + this.type + '"> <input type="text" class="answerChoose" value="'+this.description+'" placeholder="' + this.placeholder + '" ' + this.param + '>';
			if(this.ok) text += '<button type="button" class="ok"><i class="fa fa-check validate"></i></button>';
			if (this.delete) {
				text += '<button type="button" class="delete"><i class="fa fa-times error"></i></button>';
			}
			text += '</div>';
		}
		else {
			text = '<div id="I'+this.id+'"><input type="' + this.type + '"><div class="toggle">' + this.description + '</div></div>';
		}
		return text;		
	};

	display(){
		$('#I'+this.id).replaceWith(this.text());
	}

	toogleActive() {
		if(this.active)	this.getValue()
		this.active = !this.active;
		this.display();
		if(this.active){
			this.eventOk()
			if(this.delete) this.eventDelete()
		}else{
			this.eventdbClick()
		}
	};
	toogleDelete () {
		this.delete = !this.delete;
		this.display();
	};
	getValue () {
		this.description = $('#I'+this.id+" .answerChoose").val();
	};
	eventDelete () {
		let that=this;
		$("#I"+this.id + " .delete").click(function () {
			$("#I"+that.id).remove();
			let index=survey.questions[that.idQuestion-1].answers.indexOf(that)
			if (index > -1) {
				survey.questions[that.idQuestion-1].answers.splice(index, 1);
			}
		});
	};
	eventOk () {
		let that=this;
		$("#I"+this.id + " .ok").click(function (x) {
			that.getValue()
			if(that.description!="")	that.toogleActive()
		})	
	};

	eventdbClick(){
		let that=this;
		$('#I'+this.id+" .toggle").dblclick(function(x){
			that.toogleActive()
		})
	};
}
class Question {
	constructor() {
		this.numero=nbQuestion;
		this.active=true;
		this.title="";
		nbQuestion++;
		this.answers=[];
		this.type=0;
		$("#questions").append(this.text())
		this.eventActive()
	}

	addAnswer(remove=true){
		if(this.type==6 || this.type==7){
			this.answers.push(new Answer('radio',this.numero,remove))
		}else if(this.type==8 || this.type==9){
			this.answers.push(new Answer('checkbox',this.numero,remove))
		}
	}

	text(){
		let text="";
		let that=this;
		if(this.active){
			text += '<div id="Q'+this.numero+'" class="question">'
			text += '<div class="title">'
			text += '<input type="text" placeholder="Question" value="'+this.title+'">'
			text += '</div>'
			text += '<select class="typeOfQuestion" name="'+this.numero+'">'
			text += '<option value=0>Choose a type of question</option>'
			$.each(typeOfQuestion, function(i,item){
				let selected="";
				if((i+1)==that.type) selected="selected"
				text+= '<option value='+(i+1)+' '+selected+'>'+item.description+'</option>'
			})
			text += '</select>'
			text += '<div id="inputQ'+this.numero+'">'
			for(let i = 0 ; i<this.answers.length;i++){
				text += this.answers[i].text()
			}
			switch(this.type) {
				case 1:
					text += '<textarea readonly placeholder="Response"></textarea>'
					break;
				case 2:
					text += '<input type="number" value=0>'
					break;
				case 3:
					text += '<input type="number" step="0.01" value=0>'
					break;
				case 4:
					text += '<input type="date">'
					break;
				case 5:
					text += '<input type="range" min="0" max="10">'
					break;
				case 7:
					text+='<button class="addAnswer" type="button">Add an other answer</button><br>'
					text+='<input type="radio"><input type="text" readonly placeholder="User answer">';					
					break;
				case 9:
					text+='<button class="addAnswer" type="button">Add an other answer</button><br>'
					text+='<input type="checkbox"><input type="text" readonly placeholder="User answer">';
					break;
			}
			text += '</div>'
			text += '<button type="button" class="validate"><i class="fa fa-check validate"></i></button>'
			text += '</div>'
		}else{
			text += '<div id="Q'+this.numero+'" class="question">'
			text += '<div class="title">'
			text += this.title
			text += '</div>'
			text += '<div id="inputQ'+this.numero+'"></div>'
			for(let i=0;i<this.answers.length;i++){
				text += this.answers[i].text()
			}
			switch(this.type) {
				case 1:
					text += '<textarea readonly placeholder="Response"></textarea>'
					break;
				case 2:
					text += '<input type="number" value=0>'
					break;
				case 3:
					text += '<input type="number" step="0.01" value=0>'
					break;
				case 4:
					text += '<input type="date">'
					break;
				case 5:
					text += '<input type="range" min="0" max="10">'
					break;
				case 7:
					text+='<input type="radio"><input type="text" readonly placeholder="User answer">';
					break;
				case 9:
					text+='<input type="checkbox"><input type="text" readonly placeholder="User answer">';
					break;
			}
			text += '</div>'
		}
		return text;
	}

	changeTypeOfQuestion(x){
		let text;
		this.answers=[];
		this.type=parseInt(x.target.value);
		for(let i=0;i<this.answers.length;i++){
			this.answers[i]=null;
		}
		this.answers=[];
		switch(this.type) {
			case 1:
				$("#inputQ"+this.numero).html('<textarea readonly placeholder="Response"></textarea>');
				break;
			case 2:
				$("#inputQ"+this.numero).html('<input type="number" value=0>')
				break;
			case 3:
				$("#inputQ"+this.numero).html('<input type="number" step="0.01" value=0>');
				break;
			case 4:
				$("#inputQ"+this.numero).html('<input type="date">');
				break;
			case 5:
				$("#inputQ"+this.numero).html('<input type="range" min="0" max="10">');
				break;
			case 6:
				$("#inputQ"+this.numero).empty();
				this.addAnswer(false);
				this.addAnswer(false);
				$("#inputQ"+this.numero).append('<button class="addAnswer" type="button">Add an other answer</button><br>');
				this.addEventAddAnwser();
				break;
			case 7:
				$("#inputQ"+this.numero).empty();
				this.addAnswer(false);
				this.addAnswer(false);
				text='<button class="addAnswer" type="button">Add an other answer</button><br>'
				text+='<input type="radio"><input type="text" readonly placeholder="User answer">';
				$("#inputQ"+this.numero).append(text);
				this.addEventAddAnwser();
				
				break;
			case 8:
				$("#inputQ"+this.numero).empty();
				this.addAnswer(false);
				this.addAnswer(false);
				$("#inputQ"+this.numero).append('<button class="addAnswer" type="button">Add an other answer</button><br>');
				this.addEventAddAnwser();
				break;
			case 9:
				$("#inputQ"+this.numero).empty();
				this.addAnswer(false);
				this.addAnswer(false);
				text='<button class="addAnswer" type="button">Add an other answer</button><br>'
				text+='<input type="checkbox"><input type="text" readonly placeholder="User answer">';
				$("#inputQ"+this.numero).append(text);
				this.addEventAddAnwser();
				break;
			default:
				$("#inputQ"+this.numero).empty();
		}
	}

	addEventAddAnwser(){
		let that=this;
		$("#Q"+this.numero+" .addAnswer").click(function(x){
			that.addAnswer()
		})
	}
	eventActive(){
		let that=this;
		$("#Q"+this.numero+" .title input").change(function(){
			that.title=this.value;
		})
		$("#Q"+this.numero+" .typeOfQuestion").change(function(x){
			that.changeTypeOfQuestion(x);
		})
		$("#Q"+this.numero+" .validate").click(function(x){
			let bool=false;
			for(let i=0;i<that.answers.length;i++){
				bool=that.answers[i].active || bool;		
			}
			if(!bool && that.title!="" && that.type!=0){
				that.active=!that.active;
				$('#Q'+that.numero).replaceWith(that.text());
				that.addEventToggle()
			}
		})

		for(let i=0;i<this.answers.length;i++){
			this.answers[i].eventdbClick();
		}
	}

	addEventToggle(){
		let that=this;
		$("#Q"+this.numero).dblclick(function(){ 
			that.active=!that.active;
			$('#Q'+that.numero).replaceWith(that.text());
			that.eventActive();
		 })
	}
}

class Survey {
	constructor() {
		this.projectId;
		this.name;
		this.description;
		this.objective;
		this.startDate;
		this.finalDate;
		let that=this;
		$("#project_id").change(function(){
			that.projectId=this.value;
		})
		$("#name_id").change(function(){
			that.name=this.value;
		})
		$("#description_id").change(function(){
			that.description=this.value;
		})
		$("#objective_id").change(function(){
			that.objective=this.value;
		})
		$("#sDate_id").change(function(){
			that.startDate=this.value;
		})
		$("#eDate_id").change(function(){
			that.finalDate=this.value;
		})
		this.questions = [];
		this.questions.push(new Question())
	}

	addQuestion(){
		this.questions.push(new Question())
	}
}