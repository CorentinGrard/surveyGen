$("#register").validate({
    rules: {
        password: { 
            required: true,
             minlength: 6,
             maxlength: 32,

        } , 

        confPassword: { 
            equalTo: "#password_id",
            minlength: 6,
            maxlength: 32
        }


    },
messages:{
  password: { 
          required:"the password is required"

        }
}

});

$("#email_id").keypress(function(){
    $.ajax({
        url: "index.php?controller=user&action=existUser&email="+this.value,
        success: function(result){
            if(result==true){
                $("#email_id").css("border-color", "red")
                $("#confEmail").html("Email already exist")
            }else{
                $("#email_id").css("border-color", "green")
                $("#confEmail").html("")
            }
    }});
})