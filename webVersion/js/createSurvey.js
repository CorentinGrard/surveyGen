var survey;
var typeOfQuestion="1";

$(document).ready(function() {
	$.ajax({
		url: "?controller=survey&action=getTypeOfQuestion",
		success: function(result){
			typeOfQuestion=JSON.parse(result);
			survey=new Survey();
		}
	})

	$('#addQuestion').click(function(){
		survey.addQuestion();
	})
	
	$('#sendData').click(function(){
		let bool=false;
		for(let i=0;i<survey.questions.length;i++){
			bool= bool || survey.questions[i].active
		}
		if(!bool) {
			sendData();
		}
	})

	function sendData(){
		let data=JSON.stringify(survey);

		$.ajax({
			type: "POST",
			url: "?controller=survey&action=created",
			data : { json_string:data },
			dataType : 'html',
			beforeSend : function(){
				console.log("Sending data..."),
				$('#sendData span').text('Loading ...');
				$('#sendData i').css("display","block");
			},
			success : function(data){
				console.log("Responce Receive");
				let id=parseInt(data, 10);
				if(isNaN(id)){
					$('#error').html('<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">&times;</button> <strong>Oh snap!</strong> '+data+'</div>')
					$('#sendData span').text('Create survey');
					$('#sendData i').css("display","none");
				}
				else{
					window.location.replace("index.php?controller=survey&action=read&id="+id);
				};

			}
		})
	}
})