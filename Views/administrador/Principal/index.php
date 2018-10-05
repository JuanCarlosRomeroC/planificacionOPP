<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding:0;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
    <div class="row" style="background:#17c1e7;padding:0;margin:0">
         <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
              <img src="<?php echo URL; ?>public/images/icons/status.jpg" alt="profile" class="img-circle center-block hexagon" width="90px" style="margin-top:10px">
              <p class="text-center" style="color:#ffffff;padding-left:0">Activo  <span class="glyphicon glyphicon-ok-sign" style="color: #ffffff" aria-hidden="true"></span></p>
         </div>
        <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
            <img src="<?php echo URL; ?>public/images/icons/user_circle.png" alt="profile" class="center-block" width="100px" style="padding:10px;margin-top:0">
            <h4 class="text-center" style="color:#fff;font-weight:600;padding:0;margin:0px"> <?php echo $resultado['profile']['nombre']." ".$resultado['profile']['apellido'] ?></h4>
        </div>
        <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
             <a data-target="#updateusuarioModal" data-toggle="modal" onclick="updateAjax(<?php echo $resultado['profile']['id'];?>)">
                  <img src="<?php echo URL; ?>public/images/icons/profile2.jpg" alt="profile" class="img-circle center-block" width="90px" style="margin-top:10px;cursor:pointer">
             </a>
             <p class="text-center" style="color:#ffffff;padding-right:0">Mi Perfil</p>
        </div>
    </div>
    <div class="col-md-12" style="background:#f1f1f1">
          <div class="col-md-4 col-lg-3 col-sm-6 col-xs-12">
               <a style="cursor:pointer" href="/<?php echo FOLDER?>/Usuario">
                    <img src="<?php echo URL; ?>public/images/icons/users.jpg" alt="profile" class="img-circle center-block" width="90px" style="margin-top:10px">
                    <p class="text-center" style="color:#313131;padding-right:0">Usuarios: <small style="font-size:1.5em;color:#31cfeb;font-weight:700"> <?php echo $resultado["usuarios"]['total'];?></small></p>
               </a>
          </div>
          <div class="col-md-4 col-lg-3 col-sm-6 col-xs-12">
               <a style="cursor:pointer" href="/<?php echo FOLDER?>/Jefatura">
                    <img src="<?php echo URL; ?>public/images/icons/especialidad.jpg" alt="profile" class="img-circle center-block hexagon" width="90px" style="margin-top:10px">
               </a>
               <p class="text-center" style="color:#313131;padding-left:0">Jefaturas: <small style="font-size:1.5em;color:#31cfeb;font-weight:700"> <?php echo $resultado["jefaturas"]['total'];?></small></p>
          </div>
          <div class="col-md-4 col-lg-3 col-sm-6 col-xs-12">
               <a style="cursor:pointer" href="/<?php echo FOLDER?>/Unidad">
                    <img src="<?php echo URL; ?>public/images/icons/unidad.jpg" alt="profile" class="img-circle center-block" width="90px" style="margin-top:10px">
               </a>
               <p class="text-center" style="color:#313131;padding-right:0">Unidades :<small style="font-size:1.5em;color:#31cfeb;font-weight:700"> <?php echo $resultado["unidades"]['total'];?></small></p>
          </div>
          <div class="col-md-4 col-lg-3 col-sm-6 col-xs-12">
               <a style="cursor:pointer" href="/<?php echo FOLDER?>/Actividad">
                    <img src="<?php echo URL; ?>public/images/icons/transfer.jpg" alt="profile" class="img-circle center-block hexagon" width="90px" style="margin-top:10px">
               </a>
               <p class="text-center" style="color:#313131;padding-left:0">Actividades</p>
          </div>
     </div>
     <div class="col-md-12">
          <h2 class="text-center" style="font-weight:700;margin-top:40px;margin-bottom:40px">SISTEMA DE ADMINISTRACIÓN Y PLANIFICACIÓN DE ACTIVIDADES<small style="color:#808080"><br>Servicio Departamental de Salud Potosi</small></h2>
     </div>
</div>
<table id="todos" style="display:none">
     <tbody>
          <?php while($row=mysql_fetch_array($resultado["tabla_user"])): ?>
               <tr><td><?php echo $row['id'];?></td><td><?php echo $row['ci'];?></td><td><?php echo ucwords(strtolower($row['nombre'])); ?></td><td><?php echo ucwords(strtolower($row['cargo'])); ?></td></tr>
          <?php endwhile; ?>
     </tbody>
</table>
<?php include 'modalverusuario.php';include 'modalupdateusuario.php';?>
<script>
     var id_persona_u,id_user_u;
     var users_array=['Administrador','Director','Planificador','Jefe de Jefatura','Jefe de Unidad','Normal'];

     $(document).ready(function(){
          $('#inputnombre_u').keypress(function(e){not_number(e);}).keyup(function(){if($(this).val().trim().length>2){small_error('.fila1_u',true);}else{small_error('.fila1_u',false);}function_validate();});
		$('#inputapellido_u').keypress(function(e){not_number(e);}).keyup(function(){if($(this).val().trim().length>6){small_error('.fila2_u',true);}else{small_error('.fila2_u',false);}function_validate();});
          $('#inputci_u').keypress(function(e){carnet_press(e);}).keyup(function(){var valor=$(this).val().split('-') == null ? ([]) : ($(this).val().split('-'));if(valor.length<3 && parseInt(valor[0])>999999 && valor[1]!=""){if($(this).val().trim().length>6 && $(this).val().trim().length<12){small_error('.fila3_u',true);}else{small_error('.fila3_u',false);}}else{small_error('.fila3_u',false);}function_validate();});
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
						setInterval(function(){ location.reload();}, 1000);
					}
				}
			});
		});
          function getRandomColor() {var letters = '0123456789ABCDEF'.split(''),color = '#';for (var i = 0; i < 6; i++ ) {color += letters[Math.floor(Math.random() * 16)];}return color;} //random color
          $('#inputsearch').focusout(function() {
               var outn=setInterval(function(){ $('#searchprincipal').hide();clearInterval(outn);}, 150);
          })
          $('#inputsearch').focusin(function() {
               $('#searchprincipal').show();
          })
          $('#inputsearch').keyup(function(){
              $('#searchprincipal').empty();
              var data=$(this).val().toLowerCase().trim();
              SEARCH_PERSON(data,"todos","No se encontraron coincidencias");
          });
          function SEARCH_PERSON(DATA,TABLE,MESSAGE){
              var tabla_tr = document.getElementById(TABLE).getElementsByTagName("tbody")[0].rows;
              var filas=[];
              for(var i=0; i<tabla_tr.length; i++){
                    var tr = tabla_tr[i];
                    var textotr = (tr.innerText).toLowerCase();
                    if(textotr.indexOf(DATA)>0){
                         filas.push(tabla_tr[i]);
                    }
              }
              for (var i = 0; i < filas.length; i++) {
                    var id=filas[i].getElementsByTagName('td')[0].innerHTML,
                    cod=filas[i].getElementsByTagName('td')[1].innerHTML,
                    nombres=filas[i].getElementsByTagName('td')[2].innerHTML,
                    cargo=filas[i].getElementsByTagName('td')[3].innerHTML;
                    $('#searchprincipal').append('<a href="#" class="list-group-item" style"padding:5px;" data-target="#verusuarioModal" data-toggle="modal" onclick="verAjax('+id+')"><p style="font-size:1.3em;font-weight:600" class="list-group-item-text">'+nombres+'</p><p class="list-group-item-text"><strong>CI: </strong>'+cod+'<strong> Tipo: </strong>'+cargo+'</p></a>');

               }
          }
     });
     function updateAjax(val){
          $.ajax({
               url: '<?php echo URL;?>Usuario/ver/'+val,
               type: 'get',
               success:function(obj){
                    var data = JSON.parse(obj);
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
     function verAjax(val){
		$.ajax({
			url: '<?php echo URL;?>Usuario/ver/'+val,
			type: 'get',
			success:function(obj){
				var data = JSON.parse(obj);
				$('.unombre h5').html(data.nombre+"<br>"+data.apellido);$('.unombre p').text(data.ci);$('.unombre em').text(users_array[data.tipo]);$('.utelefono').text("(+591) "+data.telefono);$('.ucargo').text(data.cargo);$('.uunidad').text(data.unidad==null ? ("No Asignado"):(data.unidad));$('.uestado').text(data.estado==1 ? ("Activo"):("Inactivo"));
			}
		});
	}
</script>
