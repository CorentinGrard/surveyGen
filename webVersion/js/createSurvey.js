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
			console.log("Sending data...")
			sendData();
		}
	})
	
	function sendData(){
		let data=JSON.stringify(survey);
		console.log(data)
		$.post("?controller=survey&action=created",
		{ json_string:data },
		function(data){
			$('#addQuestion').html(data)
		});
	}
})