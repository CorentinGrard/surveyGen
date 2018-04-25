var nbQuestion=1;

$(document).ready(function() {
	addQuestion();
})

$('#addQuestion').click(function(){
	addQuestion();
})

function addQuestion(){
	let typeOfQuestion;
	$.when($.ajax({
		url: "?controller=survey&action=getTypeOfQuestion",
		success: function(result){
			typeOfQuestion=JSON.parse(result);
	}})).then(function(){
		let text = '<div id="Q'+nbQuestion+'">'
		text += '<div class="title">'
		text += '    <input type="text" placeholder="Question">'
		text += '</div>'
		text += '<select class="typeOfQuestion" name="'+nbQuestion+'">'
		text += '    <option value=0>Choose a type of question</option>'
		$.each(typeOfQuestion, function(i,item){
			text+= '<option value='+(i+1)+'>'+item.description+'</option>'
		})
		text += '</select>'
		text += '<div id="inputQ'+nbQuestion+'"></div>'
		text += '</div>'
		$('#questions').append(text);
		nbQuestion++;
		$(".typeOfQuestion").change(function(){
			var text="";
			let value=parseInt(this.value);
			switch(value) {
				case 1:
					text='<textarea readonly placeholder="Response"></textarea>';
					$("#inputQ"+this.name).html(text);
					break;
				case 2:
					text='<input type="number" value=0>'
					$("#inputQ"+this.name).html(text);
					break;
				case 3:
					text='<input type="number" step="0.01" value=0>';
					$("#inputQ"+this.name).html(text);
					break;
				case 4:
					text='<input type="date">';
					$("#inputQ"+this.name).html(text);
					break;
				case 5:
					text='<input type="range" min="0" max="10">';
					$("#inputQ"+this.name).html(text);
					break;
				case 6:
					text='<div class="input">'+createAnswer("radio","checked",true,false);
					text+=createAnswer("radio","",true,false)+'</div>';
					text+='<button class="addAnswer" type="button">Add an other answer</button><br>';
					$("#inputQ"+this.name).html(text);
					addEventAddAnwser();
					addEventOk();
					break;
				case 7:
					text='<div class="input">'+createAnswer("radio","checked",true,false);
					text+=createAnswer("radio","",true,false)+'</div>';
					text+='<button class="addAnswer" type="button">Add an other answer</button><br>';
					text+=createAnswer("radio", "readonly",false,false,"User answer");
					$("#inputQ"+this.name).html(text);
					addEventAddAnwser();
					addEventOk();
					break;
				case 8:
					text='<div class="input">'+createAnswer("checkbox","checked",true,false);
					text+=createAnswer("checkbox","",true,false)+'</div>';
					text+='<button class="addAnswer" type="button">Add an other answer</button><br>';
					$("#inputQ"+this.name).html(text);
					addEventAddAnwser();
					addEventOk();
					break;
				case 9:
					text='<div class="input">'+createAnswer("checkbox","checked",true,false);
					text+=createAnswer("checkbox","",true,false)+'</div>';
					text+='<button class="addAnswer" type="button">Add an other answer</button><br>';
					text+=createAnswer("checkbox", "readonly",false,false,"User answer");
					$("#inputQ"+this.name).html(text);
					addEventAddAnwser();
					addEventOk();
					break;
				default:
					text='';
			}
			
		})
	})
}

function addEventAddAnwser(){
	$(".addAnswer").click(function(){
		$(event.path[1].firstChild).append(createAnswer("radio","",true,true))
		addEventOk()
		addEventDelete()
	})
}

function addEventOk(){
	$(".ok").click(function(){
		let input=$(this).prev();
		if(input[0] && input[0].value!=""){
			input.replaceWith('<div class="toggle">'+input[0].value+'</div>');
			if($(this).next()[0]){
				$(this).next()[0].remove()
			}
			$(this).remove()
			addEventToggle();
		}
	})
}

function addEventDelete(){
	$(".delete").click(function(){
		console.log($($(this).parent()));
		$($(this).parent())[0].remove();
	})
}
function addEventToggle(){
	$(".toggle").dblclick(function(){
		if($(this).closest(".input")[0].childElementCount>2){
			$($(this).parent()[0]).replaceWith(createAnswer('radio',"value="+this.innerHTML, true,true))
			addEventDelete()
		}else{
			$($(this).parent()[0]).replaceWith(createAnswer('radio',"value="+this.innerHTML, true,false))
		}
		addEventOk();
	})
}
function createAnswer(type,param="",ok=true,remove=true,placeholder="Anwser"){
	text='<div><input type="'+type+'"> <input type="text" class="answerChoose" placeholder="'+placeholder+'" '+param+'>';
	if(ok){
		text+='<button type="button" class="ok"><i class="fa fa-check validate"></i></button>'
	}
	if(remove){
		text+='<button type="button" class="delete"><i class="fa fa-times error"></i></button>'
	}
	text+='</div>'
	return text;
}