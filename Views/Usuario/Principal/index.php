<div class="col-xs-12 col-sm-12 col-md-5 col-lg-5" style="padding:0;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
    <div class="row" style="background:#17c1e7;padding:0;margin:0">
        <div class="col-md-12">
            <img src="<?php echo URL; ?>public/images/icons/user_circle.png" alt="profile" class="center-block" width="110px" style="padding:10px;margin-top:0">
        </div>
        <h4 class="text-center" style="color:#fff;font-weight:600;margin-bottom:2px;text-transform:uppercase"> <?php echo $resultado['profile']['nombre']." ".$resultado['profile']['apellido']  ?></h4>
        <div class="col-md-12">
            <p class="col-md-5 col-lg-5 col-sm-5 col-xs-5" style="text-align:right;color:#2289b6;padding-left:0"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> <?php echo $resultado['profile']['ci'] ?></p>
            <p class="col-md-7 col-lg-7 col-sm-7 col-xs-7" style="text-align:left;color:#2289b6;padding-right:0;text-transform:lowercase"><span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span>  <?php echo $resultado['profile']['cargo'] ?></p>
        </div>
     </div>
     <div class="col-md-12" style="background:#f1f1f1">
        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6"><img src="<?php echo URL; ?>public/images/icons/status.jpg" alt="profile" class="img-circle center-block hexagon" width="90px" style="margin-top:10px"></div>
        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6"><a data-target="#updateusuarioModal" data-toggle="modal" onclick="updateAjax(<?php echo $resultado['profile']['id'];?>)"><img src="<?php echo URL; ?>public/images/icons/profile2.jpg" alt="profile" class="img-circle center-block" width="90px" style="margin-top:10px"></a></div>
        <div class="col-md-12">
            <p class="col-md-6 col-lg-6 col-sm-6 col-xs-6 text-center" style="color:#313131;padding-left:0">Activo  <span class="glyphicon glyphicon-ok-sign" style="color: #3dd55e" aria-hidden="true"></span></p>
            <p class="col-md-6 col-lg-6 col-sm-6 col-xs-6 text-center" style="color:#313131;padding-right:0">Mi Perfil</p>
        </div>
        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6"><a style="cursor:pointer" href="/<?php echo FOLDER?>/Planificacion"><img src="<?php echo URL; ?>public/images/icons/profile.jpg" alt="profile" class="img-circle center-block" width="90px" style="margin-top:10px"></a></div>
        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6"><a style="cursor:pointer" href="/<?php echo FOLDER?>/Otro"><img src="<?php echo URL; ?>public/images/icons/car.jpg" alt="profile" class="img-circle center-block hexagon" width="90px" style="margin-top:10px"></a></div>

        <div class="col-md-12">
            <p class="col-md-6 col-lg-6 col-sm-6 col-xs-6 text-center" style="color:#313131;padding-left:0">Planificaciones:<small style="font-size:1.5em;color:#31cfeb;font-weight:700">  <?php echo $resultado['planificacion']['total']?></small></p>
            <p class="col-md-6 col-lg-6 col-sm-6 col-xs-6 text-center" style="color:#313131;padding-right:0">Viajes:<small style="font-size:1.5em;color:#31cfeb;font-weight:700"> <?php echo $resultado['otraplanificacion']['total']?></small></p>
        </div>
        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6"><a style="cursor:pointer" href="/<?php echo FOLDER?>/Actividad"><img src="<?php echo URL; ?>public/images/icons/profile.jpg" alt="profile" class="img-circle center-block hexagon" width="90px" style="margin-top:10px"></a></div>
        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6"><a style="cursor:pointer" href="/<?php echo FOLDER?>/Notificacion"><img src="<?php echo URL; ?>public/images/icons/message.jpg" alt="profile" class="img-circle center-block" width="90px" style="margin-top:10px"></a></div>
        <div class="col-md-12">
            <p class="col-md-6 col-lg-6 col-sm-6 col-xs-6 text-center" style="color:#313131;padding-left:0">POAI:<small style="font-size:1.5em;color:#31cfeb;font-weight:700;">  <?php echo $resultado['poai']['total']?></small></p>
            <p class="col-md-6 col-lg-6 col-sm-6 col-xs-6 text-center" style="color:#313131;padding-right:0">Notificaciones:<small style="font-size:1.5em;color:#31cfeb;font-weight:700">  <?php echo $resultado['notificacion']['total']?></small></p>
        </div>
    </div>
</div>
<div class="col-xs-12 col-sm-12 col-md-7 col-lg-7" style="margin:0;padding:0">

</div>

</script>
<?php include 'modalupdateusuario.php';?>
<script>
     var id_cargo_u,id_user_u;
     var users_array=['Administrador','Director','Planificador','Jefe de Jefatura','Jefe de Unidad','Normal'];
     $(document).ready(function(){
          $('#inputnombre_u').keypress(function(e){not_number(e);}).keyup(function(){if($(this).val().trim().length>2){small_error('.fila1_u',true);}else{small_error('.fila1_u',false);}function_validate();});
		$('#inputapellido_u').keypress(function(e){not_number(e);}).keyup(function(){if($(this).val().trim().length>6){small_error('.fila2_u',true);}else{small_error('.fila2_u',false);}function_validate();});
		$('#inputci_u').keypress(function(e){yes_number(e);}).keyup(function(){if($(this).val().trim().length>6){small_error('.fila3_u',true);}else{small_error('.fila3_u',false);}function_validate();});
		$('#inputpassword_u').keyup(function(){if($(this).val().trim().length>4){small_error('fila4_u',true);}else{small_error('fila4_u',false);}function_validate();});
		$('#inputtelefono_u').keypress(function(e){yes_number(e);}).keyup(function(){function_validate();});
          $('#selectcargo_u').change(function(){function_validate();});
          function function_validate(){
			if($('.fila1_u').hasClass('has-success') && $('.fila2_u').hasClass('has-success') && $('.fila3_u').hasClass('has-success')){
				if (($('#inputpassword_u').val().trim()=="") || ($('.fila4_u').hasClass('has-success'))) {
					if(($('#inputnombre_u').attr('placeholder')!=$('#inputnombre_u').val().trim().toLowerCase()) ||
						($('#inputapellido_u').attr('placeholder')!=$('#inputapellido_u').val().toLowerCase()) ||
						($('#inputci_u').attr('placeholder')!=$('#inputci_u').val()) ||
		                  	($('#inputtelefono_u').attr('placeholder')!=$('#inputtelefono_u').val()) ||
		                  	($('#selectcargo_u option:selected').attr('value')!=id_cargo_u) ||
                              ($('.fila4_u').hasClass('has-success'))
					){
						$("#buttonupdate").attr('disabled', false);
					}else{$("#buttonupdate").attr('disabled', true);}
				}else{$("#buttonupdate").attr('disabled', true);}
			}else{$("#buttonupdate").attr('disabled', true);}
		}
          //UPDATE usuario
		$('#buttonupdate').click(function(){
               var carnet="";
               if ($('#inputci_u').val()!=$('#inputci_u').attr('placeholder')) {
                    carnet=$('#inputci_u').val();
               }
			$.ajax({
				url: '<?php echo URL;?>Principal/editar',
				type: 'post',
				data:{
					nombre:$('#inputnombre_u').val(),apellido:$('#inputapellido_u').val(),
					ci:carnet,id_cargo:$('#selectcargo_u option:selected').val(),
					telefono:$('#inputtelefono_u').val(),password:$('#inputpassword_u').val()
				},
				success:function(obj){
					if (obj=="false") {
						$('#error_update').show();
					}else{
						swal("Mensaje de Alerta!", obj , "success");
						//setInterval(function(){ location.reaload();}, 1000);
					}
				}
			});
		});
     });
     function updateAjax(val){
          $.ajax({
               url: '<?php echo URL;?>Usuario/ver/'+val,
               type: 'get',
               success:function(obj){
                    var data = JSON.parse(obj);
                    console.log(data);
                    $('.unombre h5').html(data.nombre+"<br>"+data.apellido);$('.unombre p').text(data.ci);$('.unombre em').text(users_array[data.tipo]);$('.utelefono').text("(+591) "+data.telefono);$('.ucargo').text(data.cargo);$('.uunidad').text(data.unidad==null ? ("No Asignado"):(data.unidad));$('.ujefatura').text(data.jefatura==null ? ("No Asignado"):(data.jefatura));
                    $('#inputnombre_u').val(data.nombre.toLowerCase());$('#inputnombre_u').attr('placeholder',data.nombre.toLowerCase());
                    $('#inputapellido_u').val(data.apellido.toLowerCase());$('#inputapellido_u').attr('placeholder',data.apellido.toLowerCase());
                    $('#inputci_u').val(data.ci);$('#inputci_u').attr('placeholder',data.ci);
                    $('#inputpassword_u').val("");$('#inputpassword_u').removeClass('has-success').addClass('has-error');
                    $('#inputtelefono_u').val(data.telefono);$('#inputtelefono_u').attr('placeholder',data.telefono);
                    $('#selectcargo_u option[value='+data.id_cargo+']').attr('selected','selected');
                    $("#selectcargo_u").selectpicker('refresh');
                    id_cargo_u=data.id_cargo;
               }
          });
     }
</script>
