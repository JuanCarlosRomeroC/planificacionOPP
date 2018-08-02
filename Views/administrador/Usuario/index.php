<?php
	$users=['Administrador','Director','Planificador','Jefe de Jefatura','Jefe de Unidad','Otros'];
?>
<div class="fab" data-target="#newusuarioModal" data-toggle="modal"> + </div>
<div class="row">
	<h2 class="text-center" style="margin:20px 0 1px 0;font-weight:300">LISTA DE USUARIOS</h2>
</div>
<div class="row" style="margin:10px"> <!-- SECTION TABLE USERS -->
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table id="tableusers" class="table table-striped table-condensed table-hover">
				<thead>
					<th width="9%">ci</th>
					<th width="25%">apellidos y nombres</th>
					<th width="25%">cargo</th>
					<th width="35%">unidad</th>
					<th width="6%">Opciones</th>
				</thead>
				<tbody>
					<?php while($row=mysql_fetch_array($resultado["usuarios"])): ?>
						<tr>
							<td><h5><?php echo $row['ci'];?></h5></td>
							<td style="text-align:left;padding-left:9px"><h5><?php echo ucwords(strtolower($row['apellido']))." ".ucwords(strtolower($row['nombre'])); ?></h5></td>
							<td><h5><?php echo ucwords(strtolower($row['cargo'])); ?></h5></td>
							<td><h5><?php echo ucwords(strtolower($row['unidad'])); ?></h5></td>
							<td>
								<a data-target="#updateusuarioModal" data-toggle="modal" onclick="updateAjax(<?php echo $row['id'];?>)"><button title="editar usuario" type="button" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button></a>
								<a  onclick="bajaAjax(<?php echo $row['id'];?>)"><button title="dar de baja usuario" type="button" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button></a>
							</td>
						</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<div class="row" id="alert_empty"> <!-- SECTION EMPTY TABLE -->
	<?php if(mysql_num_rows($resultado["usuarios"])<1):?>
		<div class="col-md-12">
			<div class="alert alert-error alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<strong>MENSAJE DE ALERTA!</strong> No se encontraron USUARIOS registrados.
			</div>
		</div>
	<?php endif;?>
</div>
<?php 	include 'modalnewusuario.php';
		include 'modalupdateusuario.php';?>
<script>
   	var id_unidad_u,id_cargo_u,id_user_u,psw_u;
    $(document).ready(function(){

		$('#inputsearch').keyup(function(){var data=$(this).val().toLowerCase().trim();SEARCH_DATA(data,"tableusers","No se encontraron USUARIOS registrados.");});

		$('#inputnombre,#inputnombre_u').keypress(function(e){not_number(e);}).keyup(function(){if($(this).val().trim().length>2){small_error($(this).attr('toggle'),true);}else{small_error($(this).attr('toggle'),false);}function_validate($(this).attr('validate'));});
		$('#inputapellido,#inputapellido_u').keypress(function(e){not_number(e);}).keyup(function(){if($(this).val().trim().length>6){small_error($(this).attr('toggle'),true);}else{small_error($(this).attr('toggle'),false);}function_validate($(this).attr('validate'));});
		$('#inputci,#inputci_u').keypress(function(e){yes_number(e);}).keyup(function(){if($(this).val().trim().length>6){small_error($(this).attr('toggle'),true);}else{small_error($(this).attr('toggle'),false);}function_validate($(this).attr('validate'));});
		$('#inputpassword,#inputpassword_u').keyup(function(){if($(this).val().trim().length>4){small_error($(this).attr('toggle'),true);}else{small_error($(this).attr('toggle'),false);}function_validate($(this).attr('validate'));});
		$('#inputtelefono,#inputtelefono_u').keypress(function(e){yes_number(e);}).keyup(function(){function_validate($(this).attr('validate'));});

		$('#btnregistrar').click(function(){
			$.ajax({
				url: 'http://localhost/planificationSoft/Usuario/crear',
				type: 'post',
				data:{nombre:$('#inputnombre').val(),apellido:$('#inputapellido').val(),ci:$('#inputci').val(),password:$('#inputpassword').val(),id_cargo:$('#selectcargo option:selected').val(),id_unidad:$('#selectunidad option:selected').val(),telefono:$('#inputtelefono').val(),},
					success:function(obj){if (obj=="false") {$('#error_registro').show();}else{
						swal("Mensaje de Alerta!", obj , "success");
					setInterval(function(){ window.location.href = "/planificationSoft/Usuario"; }, 2000);
				}}});});

		function function_validate(validate){
			if(validate!="false"&&validate=="true"){
				if(($('.fila1').hasClass('has-success'))&&($('.fila2').hasClass('has-success'))&&($('.fila3').hasClass('has-success'))&&($('.fila4').hasClass('has-success'))&&($('#selectcargo option').length>0)&&($('#selectunidad option').length>0)){
						$("#btnregistrar").attr('disabled', false);}else{$("#btnregistrar").attr('disabled', true);}
			}else{
				if($('.fila1_u').hasClass('has-success') && $('.fila2_u').hasClass('has-success') && $('.fila3_u').hasClass('has-success')){
					if (($('#inputpassword_u').val().trim()=="") || ($('.fila4_u').hasClass('has-success'))) {
						if(($('#inputnombre_u').attr('placeholder')!=$('#inputnombre_u').val().trim().toLowerCase()) ||
							($('#inputapellido_u').attr('placeholder')!=$('#inputapellido_u').val().toLowerCase()) ||
							($('#inputci_u').attr('placeholder')!=$('#inputci_u').val()) ||
		                  		($('#inputtelefono_u').attr('placeholder')!=$('#inputtelefono_u').val()) ||
		                  		($('#selectcargo_u option:selected').attr('value')!=id_cargo_u) ||
							($('#selectunidad_u option:selected').attr('value')!=id_unidad_u) ||
							($('#inputpassword_u').val()!="")
						){
							$("#buttonupdate").attr('disabled', false);
						}else{
							$("#buttonupdate").attr('disabled', true);
						}
					}else{
						$("#buttonupdate").attr('disabled', true);
					}
				}else{$("#buttonupdate").attr('disabled', true);}
			}
		}
		//UPDATE usuario
		$('#buttonupdate').click(function(){
			if($('#inputci_u').attr('placeholder')!=$('#inputci_u').val()){var ci_update=$('#inputci_u').val();}else{var ci_update="";}
			$.ajax({
				url: 'http://localhost/planificationSoft/Usuario/editar/'+id_user_u,
				type: 'post',
				data:{
					nombre:$('#inputnombre_u').val(),apellido:$('#inputapellido_u').val(),
					estado_ci:$('#inputci_u').val(),ci:$('#inputci_u').attr('placeholder'),
					id_cargo:$('#selectcargo_u option:selected').val(),id_unidad:$('#selectunidad_u option:selected').val(),
					telefono:$('#inputtelefono_u').val(),
					estado_password:$('#inputpassword').val(),password:psw_u
				},
				success:function(obj){
					if (obj=="false") {
						$('#error_update').show();
					}else{
						swal("Mensaje de Alerta!", obj , "success");
						setInterval(function(){ window.location.href = "/planificationSoft/Usuario"; }, 1500);
					}
				}
			});
		});
         $('#selectcargo_u, #selectunidad_u').change(function(){function_validate("false");});
	});
	function updateAjax(val){
		$.ajax({
			url: 'http://localhost/planificationSoft/Usuario/ver/'+val,
			type: 'get',
			success:function(obj){
				var data = JSON.parse(obj);
				$('.unombre h5').html(data.nombre+"<br>"+data.apellido);$('.unombre p').text(data.ci);$('.utelefono').text("(+591) "+data.telefono);$('.ucargo').text(data.cargo);$('.uunidad').text(data.unidad);$('.ujefatura').text(data.jefatura);
				$('#inputnombre_u').val(data.nombre.toLowerCase());$('#inputnombre_u').attr('placeholder',data.nombre.toLowerCase());
				$('#inputapellido_u').val(data.apellido.toLowerCase());$('#inputapellido_u').attr('placeholder',data.apellido.toLowerCase());
				$('#inputci_u').val(data.ci);$('#inputci_u').attr('placeholder',data.ci);
				$('#inputpassword_u').val("");$('#inputpassword_u').removeClass('has-success').addClass('has-error');
				$('#inputtelefono_u').val(data.telefono);$('#inputtelefono_u').attr('placeholder',data.telefono);
				$('#selectunidad_u option[value='+data.id_unidad+']').attr('selected','selected');
				$('#selectcargo_u option[value='+data.id_cargo+']').attr('selected','selected');
				$("#selectunidad_u,#selectcargo_u").selectpicker('refresh');

				id_unidad_u=data.id_unidad;id_cargo_u=data.id_cargo;id_user_u=data.id;psw_u=data.password;
			}
		});
	}
	function bajaAjax(val){
		swal({
			title: "¿Estás seguro?",
			text: "Esta Seguro que quiere dar de baja al Usuario?",
			type: "warning",
			showCancelButton: true,confirmButtonColor: "#d93333",
			confirmButtonText: "Dar de Baja!",
			closeOnConfirm: false
		},function(){
			$.ajax({
				url: 'http://localhost/planificationSoft/Usuario/eliminar/'+val,
				type: 'get',
				success:function(obj){
					if (obj=="false") {
					}else{
						swal("Mensaje de Alerta!", obj , "success");
						setInterval(function(){ window.location.href = "/planificationSoft/Usuario"; }, 1000);
					}
				}
			});
		});
	}
</script>
