<div class="fab" data-target="#newpoaiModal" data-toggle="modal"> + </div>
<div class="row">
	<div class="col-md-12">
		<div class="col-md-10">
			<h2 class="text-center" style="margin:0px 0 1px 0;font-weight:300">LISTA DE MI POAI <small>(gestión - <?php echo $resultado['year'] ?>)</small> </h2>
		</div>
		<div class="col-md-2" style="padding:0">
		   <div class='input-group date' id='datetimepickeryear'>
			   <input  readonly type='text' value="<?php echo $resultado['year']?>" class="form-control" placeholder=" <?php echo $resultado['year']?>"/>
			 <span class="input-group-addon">
			    <span class="glyphicon glyphicon-calendar"></span>
			 </span>
		   </div>
		</div>
	</div>
</div>
<div class="row"><!-- SECTION ACTIVITIES -->
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top:10px">
		<div class="table-responsive">
			<table id="tableactividades" class="table table-striped table-condensed table-hover">
				<thead>
					<th width="5%" style="font-size:1.1em">n°</th>
					<th width="48%" style="font-size:1.1em">nombre de la actividad</th>
					<th width="9%" style="font-size:1.1em">total</th>
					<th width="9%" style="font-size:1.1em">ejecutado</th>
					<th width="9%" style="font-size:1.1em">culminado</th>
					<th width="12%" style="font-size:1.1em">estado</th>
					<th width="8%" style="font-size:1.1em">opcion</th>
				</thead>
				<tbody>
					<?php for($i=0; $i<count($resultado["actividades"]);$i++): ?>
						<tr>
							<td><h5><?php $auxi=$i;$auxi++;echo $auxi?></h5></td>
							<td style="text-align:left;padding-left:9px;vertical-align:inherit"><h5 style="text-align:left"><?php echo ucwords(strtolower($resultado['actividades'][$i]['actividad'])); ?></h5></td>
							<td><?php echo $resultado['actividades'][$i]['total']?></td>
							<td><?php echo $resultado['actividades'][$i]['ejecutado']?></td>
							<td><?php echo $resultado['actividades'][$i]['porcentaje']?></td>
							<?php if ($resultado['actividades'][$i]['porcentaje']!=0) {
								$media=100/($resultado['actividades'][$i]['total']);
								$porcentaje=round($resultado['actividades'][$i]['porcentaje']*$media);
								echo '<td><div class="progress"><div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="'.$porcentaje.'" aria-valuemin="0" aria-valuemax="100" style="min-width: 2em;width: '.$porcentaje.'%;">'.$porcentaje.'% </div></div></td>';
							} else{
								echo '<td><div class="progress"><div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="min-width: 2em;width: 0%;">0% </div></div></td>';
							}?>
							<td>
								<?php if ($resultado['actividades'][$i]['ejecutado']>0) {?>
										Sin Accion
									<?php }else{ ?>
										<a data-target="#updatepoaiModal" data-toggle="modal" onclick="updateAjax(<?php echo $resultado["actividades"][$i]["id"].",".$resultado["actividades"][$i]["total"]?>,'<?php echo $resultado["actividades"][$i]["actividad"]?>')"><button title="editar actividad" type="button" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button></a>
										<a  onclick="bajaAjax(<?php echo $resultado['actividades'][$i]['id']?>)"><button title="eliminar actividad del POAI" type="button" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button></a>
								<?php } ?>
							</td>
						</tr>
					<?php endfor; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<div class="row">
	<center><span id="procent" style="font-size: 30px;position: absolute;margin-top: 65px;left:48%;color: #545454;"></span></center>
</div>
<div class="row" style="margin-bottom:0px">
	<center>
		<div class="canvas-wrap" style="top: -60px;position: relative;width: 300px;height: 200px;">
		  	<canvas id="canvas" width="300" height="300"></canvas>
		</div>
	</center>
</div>
<div class="row" id="alert_empty"> <!-- SECTION EMPTY TABLE -->
	<?php if(count($resultado["actividades"])<1):?>
		<div class="col-md-12">
			<div class="alert alert-error alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<strong>MENSAJE DE ALERTA!</strong> No se encontraron Actividades registrados este año.
			</div>
		</div>
	<?php endif;?>
</div>
<?php  include 'modalnewpoai.php';include 'modalupdatepoai.php';?>
<script>
	var id_jefatura_u,id_actividad_u,Get_ID,total_GET;$(document).ready(function(){$('#datetimepickeryear').datetimepicker({locale: 'es',format: 'YYYY',ignoreReadonly: true,viewMode: 'years'}).on('dp.change', function(e){var placeholder=$('#datetimepickeryear input').attr('placeholder'),input=$('#datetimepickeryear input').val();if (placeholder.toString()!=input.toString()) {window.location.href = "/<?php echo FOLDER;?>/Actividad?year="+e.date._d.getFullYear();}});$('#inputsearch').keyup(function(){var data=$(this).val().toLowerCase().trim();SEARCH_DATA(data,"tableactividades","No se encontraron coincidencias.");});$('#inputtotal').keypress(function(e){yes_number(e);}).keyup(function(){if(parseInt($(this).val())>0 && parseInt($(this).val())<366){small_error($(this).attr('toggle'),true);}else{small_error($(this).attr('toggle'),false);}function_validate($(this).attr('validate'));});$('#inputtotal_u').keypress(function(e){yes_number(e);}).keyup(function(){function_validate('false');});function function_validate(validate){if(validate!="false"&&validate=="true"){if(($('.fila1').hasClass('has-success'))&&($('#selectactividad option').length>0)){$("#buttonregistro").attr('disabled', false);}else{$("#buttonregistro").attr('disabled', true);}}else{if(parseInt($('#inputtotal_u').val())>0 && total_GET != $('#inputtotal_u').val() && parseInt($('#inputtotal_u').val())<366) {$("#buttonupdate").attr('disabled', false);}else{$("#buttonupdate").attr('disabled', true);}}}$('#buttonregistro').click(function(){$.ajax({url: '<?php echo URL;?>Actividad/crear_poai',type: 'post',data:{total:$('#inputtotal').val(),id_actividad:$('#selectactividad option:selected').val()},success:function(obj){swal("Mensaje de Alerta!", obj , "success");setInterval(function(){ location.reload();}, 1500);}});});$('#buttonupdate').click(function(){$.ajax({url: '<?php echo URL;?>Actividad/editar_poai/'+Get_ID,type: 'post',data:{total:$('#inputtotal_u').val()},success:function(obj){swal("Mensaje de Alerta!", obj , "success");setInterval(function(){ location.reload()}, 1000);}});});function roundToTwo(num) {return +(Math.round(num + "e+2")  + "e-2");}var DomainName = <?php echo json_encode($resultado['actividades']) ?>,media=roundToTwo(100 / DomainName.length),progress=0;for (var i = 0; i < DomainName.length; i++) {if (DomainName[i].estado==1) {progress=progress+media;}else{porcentaje=roundToTwo(media/DomainName[i].total);progress=progress+roundToTwo(porcentaje*DomainName[i].porcentaje);}}var can = document.getElementById('canvas'),spanProcent = document.getElementById('procent'),c = can.getContext('2d');var posX = can.width / 2,posY = can.height / 2,fps = 1000 / 200,procent = 0,oneProcent = 360 / 100,result = oneProcent * progress;c.lineCap = 'round';arcMove();function arcMove(){var deegres = 0;var acrInterval = setInterval (function() {deegres += 1;c.clearRect( 0, 0, can.width, can.height );procent = deegres / oneProcent;spanProcent.innerHTML = procent.toFixed()+"%"; c.beginPath();c.arc( posX, posY, 70, (Math.PI/180) * 270, (Math.PI/180) * (270 + 360) );c.strokeStyle = '#b9cbbc';c.lineWidth = '10';c.stroke();c.beginPath();c.strokeStyle = '#27c277';c.lineWidth = '10';c.arc( posX, posY, 70, (Math.PI/180) * 270, (Math.PI/180) * (270 + deegres) );c.stroke();if( deegres >= result ) clearInterval(acrInterval);}, fps);}});function bajaAjax(val){swal({title: "¿ELIMINAR ACTIVIDAD?",text: "Esta seguro de eliminar la actividad de su POAI anual?",type: "warning",showCancelButton: true,confirmButtonColor: "#be2424",confirmButtonText: "Eliminar Actividad!",closeOnConfirm: false},function(){$.ajax({url: '<?php echo URL;?>Actividad/eliminar_poai/'+val,type: 'get',success:function(obj){if (obj=="false") {}else{swal("Mensaje de Alerta!", obj , "success");setInterval(function(){ location.reload() }, 1000);}}});});};function updateAjax(id,total,nombre){Get_ID=id;total_GET=total;$('#inputtotal_u').val(total);$('.u_nombre').text(nombre.toLowerCase());}
</script>
