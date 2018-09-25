<div class="col-md-12">
	<h2 class="text-center" style="margin:5px 0 10px 0;font-weight:300">LISTA DE OTRAS PLANIFICACIONES MODIFICADAS</h2>
</div>
<div class="row" style="margin:10px"> <!-- SECTION TABLE PLANIFICACION -->
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="col-md-12">
	          <ul class="nav nav-tabs nav-justified" id="myTabs">
	               <li role="presentation" class="active"><a href="#sinleer" aria-controls="sinleer" role="tab" data-toggle="tab">SIN LEER<span class="badge" style="background:<?php echo COLOR;?>;margin-left:10px;color:#fff"><?php echo mysql_num_rows($resultado["sinleer"]);?></span></a></li>
				<li role="presentation"><a href="#leidos" aria-controls="leidos" role="tab" data-toggle="tab">LEIDOS<span class="badge" style="background:<?php echo COLOR;?>;margin-left:10px"><?php echo mysql_num_rows($resultado["leidos"]);?></span></a></li>
	          </ul>
	     </div>
		<div class="col-md-12 tab-content" style="margin:0px">
	          <div id="sinleer" role="tabpanel" class="tab-pane active">
				<div class="table-responsive">
					<table id="tableplanificacion" class="table table-striped table-condensed table-hover">
						<thead>
							<tr style="background-color: #313131">
								<th rowspan="2" width="7%" style="padding-bottom:10px;">Nro</th>
								<th rowspan="2" width="30%" style="padding-bottom:10px;">Actividad</th>
								<th rowspan="2" width="40%" style="padding-bottom:10px;">lugar</th>
								<th width="15%" colspan="2" style="padding:0;margin:0">fecha</th>
								<th rowspan="2" width="8%" style="padding-bottom:10px;">Opciones</th>
							</tr>
							<tr style="background-color: #555555">
								<th width="10%" style="padding:0;margin:0;font-size:.9em">de</th>
								<th width="10%" style="padding:0;margin:0;font-size:.9em">hasta</th>
							</tr>
						</thead>
						<tbody>
							<?php $aux=1; ?>
							<?php while($row=mysql_fetch_array($resultado["sinleer"])): ?>
								<tr>
									<td><h5><?php echo $aux;?></h5></td>
									<td style="text-align:left;padding-left:9px"><h5><?php echo $row['actividad']; ?></h5></td>
									<td style="text-align:left;padding-left:9px"><h5><?php echo $row['lugar']; ?></h5></td>
									<td><h5><?php echo $row['fecha_de']; ?></h5></td>
									<td><h5><?php echo $row['fecha_hasta']; ?></h5></td>
									<td>
										<a data-target="#verotraplanificacionModal" data-toggle="modal" onclick="verAjax(<?php echo $row['id'];?>)"><span class="glyphicon glyphicon-eye-open" title="ver planificación" aria-hidden="true" style="padding:0 5px 0 5px;color:#313131;cursor:pointer"></span></a>
									</td>
								</tr>
								<?php $aux++; ?>
							<?php endwhile; ?>
						</tbody>
					</table>
				</div>
				<div class="row" id="alert_empty"> <!-- SECTION EMPTY TABLE -->
					<?php if(mysql_num_rows($resultado["sinleer"])<1):?>
						<div class="col-md-12">
							<div class="alert alert-error alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<strong>MENSAJE DE ALERTA!</strong> No se encontraron USUARIOS registrados.
							</div>
						</div>
					<?php endif;?>
				</div>
			</div>
	          <div id="leidos" role="tabpanel" class="tab-pane">
				<div class="table-responsive">
					<table class="table table-striped table-condensed table-hover">
						<thead>
							<tr style="background-color: #313131">
								<th rowspan="2" width="7%" style="padding-bottom:10px;">Nro</th>
								<th rowspan="2" width="30%" style="padding-bottom:10px;">Actividad</th>
								<th rowspan="2" width="40%" style="padding-bottom:10px;">lugar</th>
								<th width="15%" colspan="2" style="padding:0;margin:0">fecha</th>
								<th rowspan="2" width="8%" style="padding-bottom:10px;">Opciones</th>
							</tr>
							<tr style="background-color: #555555">
								<th width="10%" style="padding:0;margin:0;font-size:.9em">de</th>
								<th width="10%" style="padding:0;margin:0;font-size:.9em">hasta</th>
							</tr>
						</thead>
						<tbody>
							<?php $aux=1; ?>
							<?php while($row=mysql_fetch_array($resultado["leidos"])): ?>
								<tr>
									<td><h5><?php echo $aux;?></h5></td>
									<td style="text-align:left;padding-left:9px"><h5><?php echo $row['actividad']; ?></h5></td>
									<td style="text-align:left;padding-left:9px"><h5><?php echo $row['lugar']; ?></h5></td>
									<td><h5><?php echo $row['fecha_de']; ?></h5></td>
									<td><h5><?php echo $row['fecha_hasta']; ?></h5></td>
									<td>
										<a data-target="#verotraplanificacionModal" data-toggle="modal" onclick="verAjax(<?php echo $row['id'];?>)"><span class="glyphicon glyphicon-eye-open" title="ver planificación" aria-hidden="true" style="padding:0 5px 0 5px;color:#313131;cursor:pointer"></span></a>
									</td>
								</tr>
								<?php $aux++; ?>
							<?php endwhile; ?>
						</tbody>
					</table>
				</div>
				<div class="row"> <!-- SECTION EMPTY TABLE -->
					<?php if(mysql_num_rows($resultado["leidos"])<1):?>
						<div class="col-md-12">
							<div class="alert alert-error alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<strong>MENSAJE DE ALERTA!</strong> No se encontro personas de ADMINISTRACION registrados.
							</div>
						</div>
					<?php endif;?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include 'modalverotraplanificacion.php';?>
<script>
   	var Get_ID;
     $(document).ready(function(){
	    $('#inputsearch').keyup(function(){$('#myTabs a[href="#sinleer"]').tab('show');
		    var data=$(this).val().toLowerCase().trim();SEARCH_DATA(data,"tableplanificacion","No se encontraron Coincidencias.");});
	});
	function verAjax(val){
     	$.ajax({
			url: '<?php echo URL;?>Notificacion/ver_otra_planificacion/'+val,
			type: 'get',
			success:function(obj){
				var data = JSON.parse(obj);
				if (data.visto==1) {
					console.log("lo vio");
					$('#marcarleido').hide();
				}else{
					$('#marcarleido').show();
				}
				$('.unombre h5').text("modificado por: "+data.nombre);
				$('.unombre h6').text("motivo de modificacion: "+data.modificado_descripcion);
				$('.uactividad').text(data.actividad);
				$('.uviaje').text(data.tipo_actividad=="local" ? ("Sin Viaje"):("Con Viaje"));
				$('.uciudad').text(data.ciudad=="" ? ("potosí"):(data.ciudad));
				$('.ulugar').text(data.lugar);
				if (data.tipo_lugar=="" && data.tipo_lugar=="departamental") {
					$('.utipo').text("Inter - Departamental");
				}else{
					$('.utipo').text("Inter - Municipal");
				}
				$('.uestablecimiento').text(data.establecimiento==null ? ("Sin Establecimiento"):(data.establecimiento));
				$('.ufechahasta').text(data.fecha_hasta);
				$('.ufechade').text(data.fecha_de);
				Get_ID=data.id;
			}
		});
	}
	function validarAjax(){
		$.ajax({
			url: '<?php echo URL;?>Notificacion/validar_notificacion_otro/'+Get_ID,
			type: 'get',
			success:function(obj){
				location.reload();
			}
		});
	}
</script>
