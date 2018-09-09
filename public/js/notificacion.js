$(document).ready(function(){
     console.log('oye');
     $.ajax({
          url: 'http://localhost/PlanificationSoft/Notificacion/notificacion',type: "get",success: function(res){
               console.log(res);
               if(res>0){
                    $('#cantobject').text(res);
                    $('#cantobject').show();
               }else{
                    $('#cantobject').css('display','none');}}});})
