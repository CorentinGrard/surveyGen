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
		nbQuestion++;
		this.answers=[];
		this.type=0;
		this.display();
	}

	addAnswer(remove=true){
		if(this.type==6 || this.type==7){
			this.answers.push(new Answer('radio',this.numero,remove))
		}else if(this.type==8 || this.type==9){
			this.answers.push(new Answer('checkbox',this.numero,remove))
		}
	}

	display(){
		let text = '<div id="Q'+this.numero+'" class="question">'
		text += '<div class="title">'
		text += '<input type="text" placeholder="Question">'
		text += '</div>'
		text += '<select class="typeOfQuestion" name="'+this.numero+'">'
		text += '<option value=0>Choose a type of question</option>'
		$.each(typeOfQuestion, function(i,item){
			text+= '<option value='+(i+1)+'>'+item.description+'</option>'
		})
		text += '</select>'
		text += '<div id="inputQ'+this.numero+'"></div>'
		text += '</div>'
		$('#questions').append(text);
		let that=this;
		$("#Q"+this.numero+" .typeOfQuestion").change(function(x){
			that.changeTypeOfQuestion(x);
		})
	}

	changeTypeOfQuestion(x){
		this.answers=[];
		let text;
		this.type=parseInt(x.target.value);
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
				$("#inputQ"+this.numero).append('<button class="addAnswer" type="button">Add an other answer</button><br>');
				this.addEventAddAnwser();
				new Answer('radio',this.numero,false,"readonly","User answer",false,false);
				
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
				$("#inputQ"+this.numero).append('<button class="addAnswer" type="button">Add an other answer</button><br>');
				this.addEventAddAnwser();
				new Answer('checkbox',this.numero,false,"readonly","User answer",false,false);
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