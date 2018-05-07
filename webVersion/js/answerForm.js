var answers;

$(document).ready(function(){

    function init(){
        answers=new Array(questionsType.length);
        for(let i=0;i<answers.length;i++){
            if(questionsType[i]==7 || questionsType[i]==9)
                answers[i]={id:i, type:questionsType[i],answer:null,extraAnswer:null};
            else
                answers[i]={id:i,type:questionsType[i],answer:null};
        }
    }

    init();

    function updateAnswer(i) {
        var total = 0;
        $('.Q'+i+'_class:checked').each(function(i, n) {
            total += parseInt($(n).val());
        })
        return total
      }

    for(let i=0;i<questionsType.length;i++){
        if([1,2,3,4,5].indexOf(questionsType[i]) > -1){
            $("#Q"+i+"_id").change(function (x) {
                answers[i].answer=this.value;
            })
        }else if([8,9].indexOf(questionsType[i]) > -1){
            $('.Q'+i+'_class').change(function(){
                answers[i].answer=updateAnswer(i);
            })
        }else if([6,7].indexOf(questionsType[i]) > -1){
            $('.Q'+i+'_class').change(function(){
                let res=$('.Q'+i+'_class:checked').val();
                answers[i].answer=res;
            })
        }

        if(questionsType[i]==7 || questionsType[i]==9){
            $('#Q'+i+'_text').change(function(){
                answers[i].extraAnswer=this.value;
            })
        }
    }

    $('#sendData').click(function(){
		let data=JSON.stringify(answers);
        console.log(data);
		$.ajax({
			type: "POST",
			url: "?controller=answer&action=created",
			data : { json_string:data , idSurvey: id},
			dataType : 'html',
			beforeSend : function(){
				console.log("Sending data..."),
				$('#sendData span').text('Loading ...');
				$('#sendData i').css("display","block");
			},
			success : function(data){
                console.log("Responce Receive");
                console.log(data)
				if(data!="OK"){
					$('#error').html('<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">&times;</button> <strong>Oh snap!</strong> '+data+'</div>')
					$('#sendData span').text('Submit answer');
					$('#sendData i').css("display","none");
				}else{
					window.location.replace("./view/answer/okAnswer.html");
				};

			}
		})
	})
})