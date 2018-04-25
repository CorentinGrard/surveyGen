var survey;
var typeOfQuestion;

$(document).ready(function() {
	$.ajax({
		url: "?controller=survey&action=getTypeOfQuestion",
		success: function(result){
			typeOfQuestion=JSON.parse(result);
			survey=new Survey();
		}
	})
})

$('#addQuestion').click(function(){
	survey.addQuestion();
})


/*
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
/*

function addEventDelete(path){
    $(path+ ".delete").click(function(){
            $($(this).parent())[0].remove();
    })
}*/
/*
function addEventToggle(){
    $(".toggle").dblclick(function(){
        console.log($(this).closest(".input")[0].childElementCount>2)
        if($(this).closest(".input")[0].childElementCount>2){
            $($(this).parent()[0]).replaceWith(createAnswer('radio',"value="+this.innerHTML, true,true))
            addEventDelete()
        }else{
            $($(this).parent()[0]).replaceWith(createAnswer('radio',"value="+this.innerHTML, true,false))
        }
        addEventOk();
    })
}*/
/*
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
}*/


