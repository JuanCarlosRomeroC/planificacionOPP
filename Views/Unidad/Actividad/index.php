<div class="fab" data-target="#newactividadModal" data-toggle="modal"> + </div>
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
				<?php $aux=1;while($row=mysql_fetch_assoc($resultado["actividades"])): ?>
					<tr>
						<td><h5><?php echo $aux?></h5></td>
						<td style="text-align:left;padding-left:9px;vertical-align:inherit"><h5 style="text-align:left"><?php echo ucwords(strtolower($row['nombre'])); ?></h5></td>
						<td><h5> Activo</h5> </td>
						<td>
							<a  onclick="altaAjax(<?php $aux++;echo $row['id']; ?>)"><button title="Finalizar actividad anual" type="button" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></button></a>
						</td>
					</tr>
				<?php endwhile; ?>
			</tbody>
		</table>
	</div>
</div>
<div class="row" id="alert_empty"> <!-- SECTION EMPTY TABLE -->
	<?php if(mysql_num_rows($resultado["actividades"])<1):?>
		<div class="col-md-12">
			<div class="alert alert-error alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<strong>MENSAJE DE ALERTA!</strong> No se encontraron USUARIOS registrados.
			</div>
		</div>
	<?php endif;?>
</div>
<?php 	include 'modalnewactividad.php';?>
<script>
	var id_jefatura_u,id_actividad_u;
    $(document).ready(function(){
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

	});

	function altaAjax(val){
		swal({
			title: "¿Finalizar Actividad?",
			text: "Al finalizar la Actividad, usted afirma ya haber concluido la actividad en todo el año - tenga en cuenta de que ya no podra realizar mas esta actividad en esta gestión",
			type: "warning",
			showCancelButton: true,confirmButtonColor: "#24be66",
			confirmButtonText: "Terminar Actividad!",
			closeOnConfirm: false
		},function(){
			$.ajax({
				url: '<?php echo URL;?>Actividad/terminar/'+val,
				type: 'get',
				success:function(obj){
					if (obj=="false") {
					}else{
						swal("Mensaje de Alerta!", obj , "success");
						setInterval(function(){ window.location.href = "/<?php echo FOLDER;?>/Actividad"; }, 1000);
					}
				}
			});
		});
	}
</script>
