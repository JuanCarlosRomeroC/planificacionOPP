<div class="col-md-12">
		<h2 class="text-center" style="margin:0px 0 1px 0;font-weight:300">LISTA DE ACTIVIDADES DE LA UNIDAD</h2>
</div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top:10px"> <!-- SECTION ACTIVITIES -->
	<div class="table-responsive">
		<table id="tableactividades" class="table table-striped table-condensed table-hover">
			<thead>
				<th width="5%">n°</th>
				<th width="70%">nombre de la actividad</th>
				<th width="15%">estado</th>
				<th width="10%">opciones</th>
			</thead>
			<tbody>
				<?php $aux=1;for($i=0;$i<count($resultado["actividades"]);$i++): ?>
					<tr>
						<td><h5><?php echo $aux?></h5></td>
						<td style="text-align:left;padding-left:9px;vertical-align:inherit"><h5 style="text-align:left"><?php echo ucwords(strtolower($resultado["actividades"][$i]['nombre'])); ?></h5></td>
						<td><h5> Activo</h5> </td>
						<td>
							<?php if ($resultado["actividades"][$i]['total']==0) {?>
								<a  onclick="bajaAjax(<?php $aux++;echo $resultado["actividades"][$i]['id']; ?>)"><button title="Eliminar Actividad de Unidad" type="button" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button></a>
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
<script>
	var id_jefatura_u,id_actividad_u;
    $(document).ready(function(){
	    if ($('#selectactividad option').length>0) {
		    $("#buttonagregaractividad").attr('disabled', false);
	    }else{
		    $("#buttonagregaractividad").attr('disabled', true);
	    }
	     $('#datetimepickeryear').datetimepicker({locale: 'es',format: 'YYYY',ignoreReadonly: true,viewMode: 'years'}).on('dp.change', function(e){
		     var placeholder=$('#datetimepickeryear input').attr('placeholder'),input=$('#datetimepickeryear input').val();
		     if (placeholder.toString()!=input.toString()) {
			    window.location.href = "/<?php echo FOLDER;?>/Actividad?year="+e.date._d.getFullYear();
		     }
	    	});
		$('#inputsearch').keyup(function(){
			var data=$(this).val().toLowerCase().trim();
			SEARCH_DATA(data,"tableactividades","No se encontraron coincidencias.");
		});

		//_____________REGISTRAR NUEVA ACTIVIDAD
		$('#buttonagregaractividad').click(function(){
			$.ajax({
				url: '<?php echo URL;?>Actividad/crear',
				type: 'post',
				data:{
					id_actividad:$('#selectactividad option:selected').val()
				},
				success:function(obj){
					swal("Mensaje de Alerta!", obj , "success");
					setInterval(function(){ window.location.href = "/<?php echo FOLDER; ?>/Actividad"; }, 1000);
				}
			});
		});
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
					setInterval(function(){ window.location.href = "/<?php echo FOLDER;?>/Actividad"; }, 1000);
				}
			});
		});
	}
</script>
