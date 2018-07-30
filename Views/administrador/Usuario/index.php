<?php
	if(isset($_GET['user'])){
		$res=$controlador->ver($_GET['user']);
		echo json_encode($res);
		return true;
	}
	$users=['Administrador','Director','Planificador','Jefe de Jefatura','Jefe de Unidad','Otros'];
?>
<div class="fab" data-target="#newusuarioModal" data-toggle="modal"> + </div>
<div class="row">
	<h2 class="text-center" style="margin:20px 0 1px 0;font-weight:300">LISTA DE USUARIOS</h2>
</div>
<div class="row" style="margin:10px"> <!-- SECTION TABLE USERS -->
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-condensed table-hover">
				<thead>
					<th width="4%">N°</th>
					<th width="15%">Nombres</th>
					<th width="15%">apellidos</th>
					<th width="25%">cargo</th>
					<th width="35%">unidad</th>
					<th width="6%">Opciones</th>
				</thead>
				<?php $aux=1; ?>
				<?php while($row=mysql_fetch_array($resultado["usuarios"])): ?>
					<tr>
						<td style="vertical-align: inherit"><h5 style="margin-top:3px;margin-bottom:0"><?php echo $aux; ?></h5></td>
						<td style="vertical-align: inherit"><h5 style="margin-top:3px;margin-bottom:0;text-align:left"><?php echo ucwords(strtolower($row['nombre'])); ?></h5></td>
						<td style="vertical-align: inherit"><h5 style="margin-top:3px;margin-bottom:0;text-align:left"><?php echo ucwords(strtolower($row['apellido'])); ?></h5></td>

						<td style="vertical-align: inherit"><h5 style="margin-top:3px;margin-bottom:0"><?php echo ucwords(strtolower($row['cargo'])); ?></h5></td>
						<td style="vertical-align: inherit"><h5 style="margin-top:3px;margin-bottom:0"><?php echo ucwords(strtolower($row['unidad'])); ?></h5></td>
						<td style="padding:0;margin:0;vertical-align: inherit">
							<a data-target="#updateusuarioModal" data-toggle="modal" onclick="updateAjax(<?php echo $row['id'];?>)"><button style="margin:2px;padding:2px" title="editar usuario" type="button" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button></a>
							<a data-target="#modal-delete-{{$per->idusuario}}" data-toggle="modal"><button title="dar de baja usuario" style="margin:2px;padding:2px" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button></a>
							<a href="/reporte/usuario/{{$per->idusuario}}"><button title="Ver usuario" style="margin:2px;padding:2px" class="btn btn-info btn-xs"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span></button></a>
						</td>
					</tr>
					<?php $aux++; ?>
				<?php endwhile; ?>
			</table>
		</div>
	</div>
</div>
<div class="row"> <!-- SECTION EMPTY TABLE -->
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
   	var seccionid=0,aseguradoid;
    $(document).ready(function(){
		if($('#alertaSweet').attr('value') != undefined){
			swal("Mensaje de Alerta!", $('#alertaSweet').attr('value') +"..", "success");$('#alertaSweet').attr('value','');
		}
		$('#datetimepickerabout').datetimepicker({locale: 'es',format: 'YYYY-MM-DD',ignoreReadonly: true,viewMode: 'years'});

		$('#resettbtn').click(function(){
			$('#newusuarioModal input').val('');
 			$('.fila1,.fila2').removeClass('has-success').addClass('has-error');
          	$('.fila1 span,.fila2 span').removeClass('glyphicon-ok').addClass('glyphicon-remove');$("#btnregistrar").attr('disabled', true);
		});

		function yes_number(e){var keyCode = (e.keyCode ? e.keyCode : e.which);if(keyCode > 47 && keyCode < 58){return true;}else{e.preventDefault();}}
		function not_number(e){var keyCode = (e.keyCode ? e.keyCode : e.which);if(keyCode > 96 && keyCode < 123 || keyCode == 241 || keyCode == 32){return true;}else{e.preventDefault();}}

		function small_error(e,t){if(t){$(e).removeClass('has-error').addClass('has-success');$(e+" span").removeClass('glyphicon-remove').addClass('glyphicon-ok');}else{$(e).removeClass('has-success').addClass('has-error');$(e+" span").removeClass('glyphicon-ok').addClass('glyphicon-remove');}}

		$('#inputnombre,#inputnombre_u').keypress(function(e){not_number(e);}).keyup(function(){if($(this).val().trim().length>2){small_error($(this).attr('toggle'),true);}else{small_error($(this).attr('toggle'),false);}function_validate($(this).attr('validate'));});
		$('#inputapellido,#inputapellido_u').keypress(function(e){not_number(e);}).keyup(function(){if($(this).val().trim().length>6){small_error($(this).attr('toggle'),true);}else{small_error($(this).attr('toggle'),false);}function_validate($(this).attr('validate'));});
		$('#inputci,#inputci_u').keypress(function(e){yes_number(e);}).keyup(function(){if($(this).val().trim().length>6){small_error($(this).attr('toggle'),true);}else{small_error($(this).attr('toggle'),false);}function_validate($(this).attr('validate'));});
		$('#inputtelefono,#inputtelefono_u').keypress(function(e){yes_number(e);});

        function function_validate(validate){
			console.log(validate);
			if(validate){
				//console.log($('#selectcargo option').length);
				if(
					($('.fila1').hasClass('has-success'))&&
					($('.fila2').hasClass('has-success'))&&
					($('.fila3').hasClass('has-success'))&&
					($('#selectcargo option').length>0)&&
					($('#selectunidad option').length>0)
				){$("#btnregistrar").attr('disabled', false);}else{$("#btnregistrar").attr('disabled', true);}
			}else{
				if(
					($('.fila1_u').hasClass('has-success'))&&
					($('.fila2_u').hasClass('has-success'))&&
					($('.fila3_u').hasClass('has-success'))&&
					($('#selectcargo_u option').length>0)&&
					($('#selectunidad_u option').length>0)
				){
					if(($('#inputnombre_u').attr('placeholder')!=$('#inputnombre_u').val().trim().toUpperCase()) ||
						($('#inputapellido_').attr('placeholder')!=$('#inputedad1').val().trim()) ||
						($('#inputci_u').attr('placeholder')!=$('#inputedad1').val()) ||
	                  	($('#inputtelefono').attr('placeholder')!=$('#inputedad1').val()) ||
	                  	($('#selectcargo_u option:selected').attr('value')!=seccionid) ||
						($('#selectunidad_u option:selected').attr('value')!=aseguradoid)
					){
						$("#buttonupdate").attr('disabled', false);
					}else{
						$("#buttonupdate").attr('disabled', true);
					}
					$("#buttonupdate").attr('disabled', false);}else{$("#buttonupdate").attr('disabled', true);
				}}
			}

		//UPDATE usuario
		$('#submitbtn1').click(function(){
		    if($('#inputnombre1').attr('placeholder')!=$('#inputnombre1').val().toUpperCase()){
			    $("#inputnombre1").val(function(i,val){
				    return val.toUpperCase();
			    });
		    }else{$('#inputnombre1').val('');}});
         $('#selectcargo_u, #selectunidad_u').change(function(){function_validate(false);});

	});
	function updateAjax(val){
		$.ajax({
			url: 'http://localhost/planificationsoft/Usuario/ver/'+val,
			type: 'get',
			success:function(obj){
				console.log(obj);
				var data = JSON.parse(obj);
				$('#inputnombre_u').val(data.nombre);$('#inputnombre_u').attr('placeholder',data.nombre);
				$('#inputapellido_u').val(data.apellido);$('#inputapellido_u').attr('placeholder',data.apellido);
				$('#inputci_u').val(data.ci);$('#inputci_u').attr('placeholder',data.ci);
				$('#inputtelefono_u').val(data.telefono);$('#inputtelefono_u').attr('placeholder',data.telefono);
				$('#selectunidad_u option[value='+data.id_unidad+']').attr('selected','selected');
				$('#selectcargo_u option[value='+data.id_cargo+']').attr('selected','selected');
				// seccionid=data.seccion;
				$("#selectunidad_u,selectcargo_u").selectpicker('refresh');
				// $('#selectusuario2 option[value="'+data.tipo+'"]').attr('selected','selected');
				// aseguradoid=data.tipo;
				console.log(obj);
			}
		});

		// $.ajax({url: "/hospital/usuario/"+val+"/edit",
		// 	type: "get",success: function(data){
		// 		$('#updateusuarioModal form').attr('action','/hospital/usuario/'+data.idusuario+'');
		// 		$('#inputnombre1').val(data.nombre);$('#inputnombre1').attr('placeholder',data.nombre);
		// 		$('#inputedad1').val(data.fecha.substring(0,10));$('#inputedad1').attr('placeholder',data.fecha.substring(0,10));
		// 		$('#selectseccion1 option[value='+data.seccion+']').attr('selected','selected');
		// 		seccionid=data.seccion;
		// 		$("#selectseccion1").selectpicker('refresh');
		// 		$('#selectusuario2 option[value="'+data.tipo+'"]').attr('selected','selected');
		// 		aseguradoid=data.tipo;
		// 	}
		// });
	}
</script>
