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
})

$('#addQuestion').click(function(){
	survey.addQuestion();
})

function sendData(){
	let data=JSON.stringify(survey);
	console.log(data)
	$.ajax({
		url: "?controller=survey&action=created",
		success: function(){
			console.log("ok")
		}
	})
}