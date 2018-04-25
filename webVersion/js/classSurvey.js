var nbQuestion=1;

class Answer {
	constructor(type, idQuestion, remove = true, param="", placeholder = 'Answer') {
		this.active = true;
		this.type=type;
		this.idQuestion=idQuestion;
		this.ok = true;
		this.remove = remove;
		this.placeholder=placeholder;
		this.param=param;
		console.log('io');
		let ui=$("#Q"+this.idQuestion+" #inputQ"+this.idQuestion);
		ui.append('ui')
		this.value="";
	}

	text () {
		let text="";
		if (this.active) {
			text = '<div><input type="' + this.type + '"> <input type="text" class="answerChoose" placeholder="' + this.placeholder + '" ' + this.param + '>';
			text += '<button type="button" class="ok"><i class="fa fa-check validate"></i></button>';
			if (this.remove) {
				text += '<button type="button" class="delete"><i class="fa fa-times error"></i></button>';
			}
			text += '</div>';
		}
		else {
			text = '<div class="toggle">' + this.value + '</div>';
		}
		return text;		
	};

	affichage(){
		this.path.replaceWith(this.text());
	}

	toogleAtive() {
		this.active = !this.active;
		this.affichage();
	};
	toogleRemove () {
		this.remove = !this.remove;
		this.affichage();
	};
	getValue () {
		this.value = this.path[0].childNodes[2].value;
	};
	eventDelete () {
		$(this.path + " .delete").click(function () {
			this.path.remove();
		});
	};
	eventOk () {
		$(this.path + " .ok").click(function () {
			this.toogleActive();
		});
	};
}
class Question {
	constructor() {
		this.numero=nbQuestion;
		nbQuestion++;
		this.answers=[];
		this.type=0;
		this.affichage();
	}

	addAnswer(){
		if(this.type==6 || this.type==7){
			this.answers.push(new Answer('radio',this.numero))
		}else if(this.type==8 || this.type==9){
			this.answers.push(new Answer('checkbox',this.numero))
		}
	}

	affichage(){
		let text = '<div id="Q'+this.numero+'">'
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
		$("#Q"+this.numero+" .typeOfQuestion").change(function(x){
			(survey.questions[(x.target.name)-1]).changeTypeOfQuestion(x);
		})
	}

	changeTypeOfQuestion(x){
		let text;
		this.type=parseInt(x.target.value);
		switch(this.type) {
			case 1:
				text='<textarea readonly placeholder="Response"></textarea>';
				break;
			case 2:
				text='<input type="number" value=0>'
				break;
			case 3:
				text='<input type="number" step="0.01" value=0>';
				break;
			case 4:
				text='<input type="date">';
				break;
			case 5:
				text='<input type="range" min="0" max="10">';
				break;
			case 6:
				this.addAnswer();
				this.addAnswer();
				text='<button class="addAnswer" type="button">Add an other answer</button><br>';
				this.addEventAddAnwser()
				break;
			case 7:
	
				break;
			case 8:
	
				break;
			case 9:

				break;
			default:
				text='';
		}
		$("#inputQ"+this.numero).html(text);
	}

	addEventAddAnwser(){
		$("Q"+this.numero+" .addAnswer").click(function(x){
			console.log(x)
			(survey.questions[(x.target.name)-1]).addAnswer()
		})
	}
}

class Survey {
	constructor() {
		this.questions = [];
		this.questions.push(new Question())
	}

	addQuestion(){
		this.questions.push(new Question())
	}
}