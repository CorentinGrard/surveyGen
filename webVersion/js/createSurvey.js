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
					text='  <input type="radio" name="gender" value="male" checked> Male<br>';
					text+='	<input type="radio" name="gender" value="female"> Female<br>';
					break;
				case 7:
					text='<div class="input">'+createAnswer("radio","checked",true,false);
					text+=createAnswer("radio","",true,false)+'</div>';
					text+='<button class="addAnswer" type="button">Add an other answer</button><br>';
					text+=createAnswer("radio", "readonly",false,false,"User answer");
					break;
				case 8:
					text='  <input type="checkbox" name="vehicle1" value="Bike"> I have a bike<br>';
					text+=' <input type="checkbox" name="vehicle2" value="Car"> I have a car ';
					break;
				case 9:
					text='  <input type="checkbox" name="vehicle1" value="Bike"> I have a bike<br>';
					text+=' <input type="checkbox" name="vehicle2" value="Car"> I have a car ';
					break;
				default:
					text='';
			}
			$("#inputQ"+this.name).html(text);
			addEventAddAnwser();
		})
	})
}

function addEventAddAnwser(){
	$(".addAnswer").click(function(){
		$(event.path[1].firstChild).append((createAnswer('radio')))
	})
	$(".ok").click(function(){
		let input=$(this).prev();
		input.replaceWith('<div class="toggle">'+input[0].value+'</div>');
		$(this).next()[0].remove()
		$(this).remove()
		addEventToggle();
	})
	$(".delete").click(function(){
		$($(this).parent())[0].remove();
	})
}

function addEventToggle(){
	$(".toggle").dblclick(function(){
		$($(this).parent()[0]).replaceWith(createAnswer('radio',"value="+this.innerHTML))
		addEventAddAnwser();
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