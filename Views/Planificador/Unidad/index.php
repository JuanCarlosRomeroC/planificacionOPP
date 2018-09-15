<div class="row">
	<h2 class="text-center" style="margin:20px 0 1px 0;font-weight:300">LISTA DE UNIDADES</h2>
</div>
<div class="row" style="margin:10px"> <!-- SECTION TABLE USERS -->
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table id="tableunidades" class="table table-striped table-condensed table-hover">
				<thead>
					<th width="9%">nro</th>
					<th width="40%">jefatura</th>
					<th width="40%">unidad</th>
					<th width="11%">Opciones</th>
				</thead>
				<?php $aux=1; ?>
				<tbody>
					<?php while($row=mysql_fetch_array($resultado["unidades"])): ?>
						<tr>
							<td><h5><?php echo $aux;?></h5></td>
							<td style="text-align:left;padding-left:9px"><h5 class="rowtable_jefatura<?php echo $row['id'];?>"><?php echo ucwords(strtolower($row['jefatura'])); ?></h5></td>
							<td><h5 class="rowtable_nombre<?php echo $row['id'];?>"><?php echo ucwords(strtolower($row['nombre'])); ?></h5></td>
							<td>
								<a data-target="#updateunidadModal" data-toggle="modal" onclick="verAjax(<?php echo $row['id'];?>)"><button title="editar unidad" type="button" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></button></a>
							</td>
						</tr>
						<?php $aux++; ?>
					<?php endwhile; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<div class="row" id="alert_empty"> <!-- SECTION EMPTY TABLE -->
	<?php if(mysql_num_rows($resultado["unidades"])<1):?>
		<div class="col-md-12">
			<div class="alert alert-error alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<strong>MENSAJE DE ALERTA!</strong> No se encontraron UNIDADES registradas.
			</div>
		</div>
	<?php endif;?>
</div>
<?php include 'modalupdateunidad.php';?>
<script>
    $(document).ready(function(){
		$('#inputsearch').keyup(function(){var data=$(this).val().toLowerCase().trim();SEARCH_DATA(data,"tableunidades","No se encontraron UNIDADES registradas.");});
	});
	function verAjax(val){
		$.ajax({
			url: '<?php echo URL;?>Unidad/ver/'+val,
			type: 'get',
			success:function(obj){
				var data = JSON.parse(obj);
				$('.unombre').text(data.unidad.nombre);
				$('.uusuarios').text(data.usuarios.length);
				$('.uestado').text(data.unidad.estado=="1" ? ("Activo") : ("Inactivo"));
				$("#tableunidad").empty();$("#alert_empty_usuario").hide();
				if (data.usuarios.length>0) {
					for (var i = 0; i < data.usuarios.length; i++) {
						$('#tableunidad').append('<tr><td style="text-align:left;padding-left:10px">'+parseInt(i+1)+'. '+data.usuarios[i].nombre+' '+data.usuarios[i].apellido+'</td></tr>');
					}
				}else {
					$("#alert_empty_usuario").show();
				}
			}
		});
	}
</script>
