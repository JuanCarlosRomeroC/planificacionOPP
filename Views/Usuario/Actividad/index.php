<div class="fab" data-target="#newactividadModal" data-toggle="modal"> + </div>
<div class="row">
	<div class="col-md-12">
		<div class="col-md-10">
			<h2 class="text-center" style="margin:0px 0 1px 0;font-weight:300">LISTA DE MIS ACTIVIDADES <small>(Año - <?php echo $resultado['year'] ?>)</small> </h2>
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
<div class="row">
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
					<?php for($i=0; $i<count($resultado["actividades"]);$i++): ?>
						<tr>
							<td><h5><?php $auxi=$i;$auxi++;echo $auxi?></h5></td>
							<td style="text-align:left;padding-left:9px;vertical-align:inherit"><h5 style="text-align:left"><?php echo ucwords(strtolower($resultado['actividades'][$i]['actividad'])); ?></h5></td>
							<?php if ($resultado['actividades'][$i]['estado']==0) {
								echo '<td><div class="progress"><div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="'.$resultado['actividades'][$i]['total'].'" aria-valuemin="0" aria-valuemax="100" style="min-width: 2em;width: '.$resultado['actividades'][$i]['total'].'%;">'.$resultado['actividades'][$i]['total'].'% </div></div></td>';
							} else{
								echo '<td><div class="progress"><div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="min-width: 2em;width: 100%;">100% </div></div></td>';
							}?>
							<td>
								<?php if ($resultado['actividades'][$i]['total']==0){
									echo "Sin Opción";
								}else{
									if ($resultado['actividades'][$i]['estado']==1) {
										echo "Culminado";
									}else{
										echo '<a  onclick="altaAjax('.$resultado['actividades'][$i]['id'].')"><button title="Finalizar actividad anual" type="button" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></button></a>';
									}

								} ?>
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
			<strong>MENSAJE DE ALERTA!</strong> No se encontraron USUARIOS registrados.
			</div>
		</div>
	<?php endif;?>
</div>
<?php  include 'modalnewactividad.php';?>
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
					year:$('#dategestion input').val(),
					id_actividad:$('#selectactividad option:selected').val()
				},
				success:function(obj){
					swal("Mensaje de Alerta!", obj , "success");
					setInterval(function(){ window.location.href = "/<?php echo FOLDER; ?>/Actividad"; }, 1500);
				}
			});
		});

		//____________DIBUJAR AVANCE DE ACTIVIDAD
		var DomainName = <?php echo json_encode($resultado['actividades']) ?>,media= 100 / DomainName.length,progress=0;
		for (var i = 0; i < DomainName.length; i++) {if (DomainName[i].estado==1) {progress=progress+media;}else{progress=progress+parseInt(DomainName[i].total);}}

		var can = document.getElementById('canvas'),spanProcent = document.getElementById('procent'),c = can.getContext('2d');var posX = can.width / 2,posY = can.height / 2,fps = 1000 / 200,procent = 0,oneProcent = 360 / 100,result = oneProcent * progress;c.lineCap = 'round';arcMove();
	  	function arcMove(){var deegres = 0;var acrInterval = setInterval (function() {deegres += 1;c.clearRect( 0, 0, can.width, can.height );procent = deegres / oneProcent;spanProcent.innerHTML = procent.toFixed()+"%"; c.beginPath();c.arc( posX, posY, 70, (Math.PI/180) * 270, (Math.PI/180) * (270 + 360) );c.strokeStyle = '#b9cbbc';c.lineWidth = '10';c.stroke();c.beginPath();c.strokeStyle = '#27c277';c.lineWidth = '10';c.arc( posX, posY, 70, (Math.PI/180) * 270, (Math.PI/180) * (270 + deegres) );c.stroke();if( deegres >= result ) clearInterval(acrInterval);}, fps);}
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
