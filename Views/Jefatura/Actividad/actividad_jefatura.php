<div class="fab" data-target="#newactividadModal" data-toggle="modal"> + </div>
<div class="col-md-12">
		<h2 class="text-center" style="margin:0px 0 1px 0;font-weight:300">LISTA DE ACTIVIDADES DE LA JEFATURA</h2>
</div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top:10px"> <!-- SECTION ACTIVITIES -->
	<div class="table-responsive">
		<table id="tableactividades" class="table table-striped table-condensed table-hover">
			<thead>
				<th width="4%">n°</th>
				<th width="20%">jefatura</th>
				<th width="23%">unidad</th>
				<th width="45%">nombre de la actividad</th>
				<th width="8%">opcion</th>
			</thead>
			<tbody>
				<?php $aux=1;for($i=0;$i<count($resultado["actividades"]);$i++): ?>
					<tr>
						<td style="vertical-align:inherit"><h5><?php echo $aux?></h5></td>
						<td style="text-align:left;padding-left:9px;vertical-align:inherit"><h5 style="text-align:left"><?php echo ucwords(strtolower($resultado["actividades"][$i]['jefatura'])); ?></h5></td>
						<td style="text-align:left;padding-left:9px;vertical-align:inherit"><h5 style="text-align:left"><?php echo $resultado["actividades"][$i]['unidad'] == null ? "Sin Unidad":ucwords(strtolower($resultado["actividades"][$i]['unidad'])); ?></h5></td>
						<td style="text-align:left;padding-left:9px;vertical-align:inherit"><h5 style="text-align:left"><?php echo ucwords(strtolower($resultado["actividades"][$i]['nombre'])); ?></h5></td>
						<td style="vertical-align:inherit">
							<?php $aux++;if ($resultado["actividades"][$i]['total']==0) {?>
								<a data-target="#updateactividadModal" data-toggle="modal" onclick="updateAjax(<?php echo $resultado["actividades"][$i]['id'];?>)"><span title="editar actividad"  class="glyphicon glyphicon-pencil" aria-hidden="true" style="cursor:pointer;margin:0 2px 0 2px"></span></a>
								<a  onclick="bajaAjax(<?php echo $resultado["actividades"][$i]['id']; ?>)"><button title="Eliminar Actividad de Unidad" type="button" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button></a>
							<?php }else{ echo "Sin Acción";}?>
						</td>
					</tr>
				<?php endfor; ?>
			</tbody>
		</table>
	</div>
</div>
<div class="row" id="alert_empty"> <!-- SECTION EMPTY TABLE -->
	<?php if(count($resultado["actividades"])<1):?>
		<div class="col-md-12">
			<div class="alert alert-error alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<strong>MENSAJE DE ALERTA!</strong> No se encontraron USUARIOS registrados.
			</div>
		</div>
	<?php endif;?>
</div>
<?php 	include 'modalnewactividad.php';include 'modalupdateactividad.php';?>
<script>
	var id_jefatura_u,id_actividad_u;
    $(document).ready(function(){
	    if ($('#selectactividad option').length>0) {
		    $("#buttonagregaractividad").attr('disabled', false);
	    }else{
		    $("#buttonagregaractividad").attr('disabled', true);
	    }
		$('#inputsearch').keyup(function(){
			var data=$(this).val().toLowerCase().trim();
			SEARCH_DATA(data,"tableactividades","No se encontraron coincidencias.");
		});

		//_____________REGISTRAR NUEVA ACTIVIDAD
		$('#buttonagregaractividad').click(function(){
			$.ajax({
				url: '<?php echo URL;?>Actividad/crear_jefatura',
				type: 'post',
				data:{
					id_actividad:$('#selectactividad option:selected').val(),
					id_unidad:$('#selectunidad option:selected').val()
				},
				success:function(obj){
					swal("Mensaje de Alerta!", obj , "success");
					setInterval(function(){ location.reload();}, 1000);
				}
			});
		});
		$('#buttonupdate').click(function(){
			$.ajax({
				url: '<?php echo URL;?>Actividad/editar/'+id_actividad_u,
				type: 'post',
				data:{id_unidad:$('#selectunidad_u option:selected').val()},
				success:function(obj){if (obj=="false") {$('#error_update').show();}else{
					swal("Mensaje de Alerta!", obj , "success");
					setInterval(function(){ location.reload(); }, 1000);
					}
				}
			});
		});
		$('#selectunidad_u').change(function(){function_validate();});
		function function_validate(){
			if($('#selectunidad_u option:selected').attr('value')!=id_unidad_u){
				$("#buttonupdate").attr('disabled', false);
			}else{$("#buttonupdate").attr('disabled', true);}
		}
	});
	function bajaAjax(val){
		swal({
			title: "¿Estás seguro?",
			text: "Esta Seguro que quiere Eliminar la Actividad de la Unidad?",
			type: "warning",
			showCancelButton: true,confirmButtonColor: "#d93333",
			confirmButtonText: "Eliminar!",
			closeOnConfirm: false
		},function(){
			$.ajax({
				url: '<?php echo URL;?>Actividad/eliminar/'+val,
				type: 'get',
				success:function(obj){
					swal("Mensaje de Alerta!", obj , "success");
					setInterval(function(){ location.reload();}, 1000);
				}
			});
		});
	}
	function updateAjax(val){
		$("#buttonupdate").attr('disabled', true);
		$.ajax({
			url: '<?php echo URL;?>Actividad/ver/'+val,
			type: 'get',
			success:function(obj){
				var data = JSON.parse(obj);
				$('.nombre_actividadu em').text(data.nombre);
				$('#selectunidad_u option[value='+data.id_unidad+']').attr('selected','selected');
				id_actividad_u=data.id;id_unidad_u=data.id_unidad;
				$("#selectunidad_u").selectpicker('refresh');
			}
		});
	}
</script>
