var answers=new Array(questionsType.length);

$(document).ready(function(){

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
                answers[i]=this.value;
            })
        }else if([8,9].indexOf(questionsType[i]) > -1){
            $('.Q'+i+'_class').change(function(){
                console.log(updateAnswer(i));
            })
        }else if([6,7].indexOf(questionsType[i]) > -1){
            $('.Q'+i+'_class').change(function(){
                let res=$('.Q'+i+'_class:checked').val();
                console.log(res);
            })
        }
    }
})