$(function() {
    //FUNCTION SHOW AND HIDE PASSWORD
    $("#togglepassword,#togglepassword_u").click(function() {
      console.log('hora');
      
        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
          input.attr("type", "text");
        } else {
          input.attr("type", "password");
        }
      });
})