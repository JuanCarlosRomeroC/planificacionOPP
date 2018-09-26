</body>
     <footer>
          <div class="footer-bottom">
               <div class="container">
                    <div class="row">
                         <div class="col-sm-6 footer-copyright"  style="margin-top:15px">
                               ©  Potosí<a> SEDES</a>
                         </div>
                         <div class="col-sm-6 footer-social"  style="margin-top:15px">
                              <a href="#"><i class="fa fa-facebook"></i></a>
                              <a href="#"><i class="fa fa-twitter"></i></a>
                              <a href="#"><i class="fa fa-google-plus"></i></a>
                              <a href="#"><i class="fa fa-instagram"></i></a>
                              <a href="#"><i class="fa fa-pinterest"></i></a>
                         </div>
                     </div>
               </div>
          </div>
     </footer>
</body>
</html>
<script type="text/javascript">
     var aux=false,aux_pass=false;
     $(function(){
          var urlString = 'url(<?php echo URL;?>public/images/background.jpg)';
          document.getElementById("bannerleft").style.backgroundImage =  urlString;

          function yes_number(e){var keyCode = (e.keyCode ? e.keyCode : e.which);if((keyCode > 47 && keyCode < 58)||keyCode==8){return true;}else{e.preventDefault();}}
          $('#inputci').keypress(function(e){yes_number(e);}).keyup(function(){if($(this).val().trim().length>6){aux=true;}else{aux=false;}validate();});
          $('#inputpassword').keyup(function(){if($(this).val().length>4){aux_pass=true;}else{aux_pass=false;}validate();});
          function validate(){if((aux) && (aux_pass)){$("#btnlogin").attr('disabled', false);}else{$("#btnlogin").attr('disabled', true);}}
          $("#btnlogin").click(function(){
               ci=$('#inputci').val();pass=$('#inputpassword').val();
               $.ajax({
     			url: 'Index/userLogin',
     			type: 'post',
     			data: {'ci':ci,'password':pass},
     			success:function(obj){
                         var data = JSON.parse(obj);
                         if (data == false) {
                              $('#alert_error').show();
                         }else{
                             window.location.href = "/<?php echo FOLDER;?>/Principal";
                         }
     			}
     		});
          });
     })
</script>
