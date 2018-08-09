function SEARCH_DATA(DATA,TABLE,MESSAGE){
     var tabla_tr = document.getElementById(TABLE).getElementsByTagName("tbody")[0].rows;
     for(var i=0; i<tabla_tr.length; i++){
          var tr = tabla_tr[i];
          var textotr = (tr.innerText).toLowerCase();
          tr.className = (textotr.indexOf(DATA)>=0)?"mostrar":"ocultar";
     }
     $('#alert_empty').empty();
     if(!$('#'+TABLE+'>tbody>tr').hasClass('mostrar')){
          $('#alert_empty').append('<div class="col-md-12"><div class="alert alert-error alert-dismissible" role="alert"><strong>MENSAJE DE ALERTA!</strong>'+MESSAGE+'</div></div>')
     }
}
function yes_number(e){var keyCode = (e.keyCode ? e.keyCode : e.which);if((keyCode > 47 && keyCode < 58) || keyCode == 8){return true;}else{e.preventDefault();}}
function not_number(e){var keyCode = (e.keyCode ? e.keyCode : e.which);if((keyCode > 96 && keyCode < 123) || keyCode == 241 || keyCode == 32 || keyCode == 8){return true;}else{e.preventDefault();}}
function small_error(e,t){if(t){$(e).removeClass('has-error').addClass('has-success');$(e+" span").removeClass('glyphicon-remove').addClass('glyphicon-ok');}else{$(e).removeClass('has-success').addClass('has-error');$(e+" span").removeClass('glyphicon-ok').addClass('glyphicon-remove');}}
// funcion para ocultar y mostrar unidades y jefaturas cuando cambia tipo
function accion_tipo(tipo,row1,row2){if(($(tipo+' option:selected').val()==4)||($(tipo+' option:selected').val()==5)){$(row1).show();$(row2).hide();}else{if($(tipo+' option:selected').val()==3){$(row2).show();$(row1).hide();}else {$(row1+","+row2).hide();}}}
$(function() {
    //FUNCTION SHOW AND HIDE PASSWORD
     $("#togglepassword,#togglepassword_u").click(function() {
          $(this).toggleClass("fa-eye fa-eye-slash");
               var input = $($(this).attr("toggle"));
              if (input.attr("type") == "password") {
                    input.attr("type", "text");
               }else {
                    input.attr("type", "password");
          }
     });
     $('#buttoncancel_update').click(function(){
          $('#buttoneditar_update').attr('disabled', false);
          $( "#editbox_update" ).toggle( "slide" );
          $( "#listuserbox_update" ).toggle( "slide" );
     });
     $('#buttoneditar_update').click(function(){
          $('#buttoneditar_update').attr('disabled', true);
          $( "#editbox_update" ).toggle( "slide" );
          $( "#listuserbox_update" ).toggle( "slide" );
     });
})
