<div class="row"><h2 class="text-center" style="margin:20px 0 1px 0;font-weight:200">LISTA DE JEFATURAS</h2></div>
<div class="row" style="margin:10px"> <!-- SECTION TABLE USERS -->
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table id="tablejefaturas" class="table table-striped table-condensed table-hover">
				<thead>
					<th width="10%">nro</th>
					<th width="80%">Nombre</th>
					<th width="10%">Opciones</th>
				</thead>
				<?php $aux=1; ?>
				<tbody>
					<?php while($row=mysql_fetch_array($resultado)): ?>
						<tr>
							<td><h5><?php echo $aux;?></h5></td>
							<td style="text-align:left;padding-left:9px"><h5 class="rowtable_nombre<?php echo $row['id'];?>"><?php echo ucwords(strtolower($row['nombre'])); ?></h5></td>
							<td>
								<a data-target="#updatejefaturaModal" data-toggle="modal" onclick="verAjax(<?php echo $row['id'];?>)"><button title="ver jefatura" type="button" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></button></a>
							</td>
							<?php $aux++; ?>
						</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<div class="row" id="alert_empty"> <!-- SECTION EMPTY TABLE -->
	<?php if(mysql_num_rows($resultado)<1):?>
		<div class="col-md-12">
			<div class="alert alert-error alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<strong>MENSAJE DE ALERTA!</strong> No se encontraron JEFATURAS registradas.
			</div>
		</div>
	<?php endif;?>
</div>
<?php include 'modalupdatejefatura.php';?>
<script>
    $(document).ready(function(){
		$('#inputsearch').keyup(function(){var data=$(this).val().toLowerCase().trim();SEARCH_DATA(data,"tablejefaturas","No se encontraron JEFATURAS registradas.");});
	});
	function verAjax(val){
		$.ajax({
			url: '<?php echo URL;?>Jefatura/ver/'+val,
			type: 'get',
			success:function(obj){
				var data = JSON.parse(obj);$("#buttonupdate").attr('disabled', true);
				$('.unombre').text(data.jefatura.nombre);
				$('.uunidad').text(data.unidades.length);
				$('.uestado').text(data.jefatura.estado=="1" ? ("Activo") : ("Inactivo"));
				$("#tablejefatura").empty();$("#alert_empty_unidad").hide();
				$('.ujefe').text(data.encargado.nombre==null?('Sin Encargado'):(data.encargado.nombre));
				if (data.unidades.length>0) {
					for (var i = 0; i < data.unidades.length; i++) {
						$('#tablejefatura').append('<tr><td style="text-align:left;padding-left:10px">'+parseInt(i+1)+'. '+data.unidades[i].nombre+'</td></tr>');
					}
				}else {
					$("#alert_empty_unidad").show();
				}
			}
		});
	}
</script>
