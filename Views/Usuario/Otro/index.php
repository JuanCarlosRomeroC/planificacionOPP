<div class="fab" data-target="#newotraplanificacionModal" data-toggle="modal"> + </div>

<div class="col-md-12">
	<div class="col-md-10">
		<h2 class="text-center" style="margin:5px 0 1px 0;font-weight:300">LISTA DE OTRAS PLANIFICACIONES</h2>
	</div>
	<div class="col-md-2">
	   <div class='input-group date' id='datetimepickermes'>
		   <input  readonly type='text' value="<?php echo $resultado['year']."-".$resultado['month'] ?>" class="form-control" placeholder=" <?php echo $resultado['year']."-".$resultado['month'] ?>"/>
		 <span class="input-group-addon">
		    <span class="glyphicon glyphicon-calendar"></span>
		 </span>
	   </div>
	</div>
</div>

<div class="row" style="margin:10px"> <!-- SECTION TABLE PLANIFICACION -->
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="col-md-12">
	          <ul class="nav nav-tabs nav-justified" id="myTabs">
	               <li role="presentation" class="active"><a href="#todos" aria-controls="todos" role="tab" data-toggle="tab">TODOS<span class="badge" style="background:<?php echo COLOR;?>;margin-left:10px;color:#fff"><?php echo mysql_num_rows($resultado["todos"]);?></span></a></li>
				<li role="presentation"><a href="#viajes" aria-controls="viajes" role="tab" data-toggle="tab">VIAJES<span class="badge" style="background:<?php echo COLOR;?>;margin-left:10px"><?php echo mysql_num_rows($resultado["viajes"]);?></span></a></li>
				<li role="presentation"><a href="#locales" aria-controls="locales" role="tab" data-toggle="tab">LOCALES<span class="badge" style="background:<?php echo COLOR;?>;margin-left:10px"><?php echo mysql_num_rows($resultado["locales"]);?></span></a></li>
	          </ul>
	     </div>
		<div class="col-md-12 tab-content" style="margin:0px">
	          <div id="todos" role="tabpanel" class="tab-pane active">
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
							<?php while($row=mysql_fetch_array($resultado["todos"])): ?>
								<tr>
									<td><h5><?php echo $aux;?></h5></td>
									<td style="text-align:left;padding-left:9px"><h5><?php echo $row['actividad']; ?></h5></td>
									<td style="text-align:left;padding-left:9px"><h5><?php echo $row['lugar']; ?></h5></td>
									<td><h5><?php echo $row['fecha_de']; ?></h5></td>
									<td><h5><?php echo $row['fecha_hasta']; ?></h5></td>
									<td>
										<a data-target="#updateotraplanificacionModal" data-toggle="modal" onclick="updateAjax(<?php echo $row['id'];?>)"><button title="editar usuario" type="button" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button></a>
										<a  onclick="bajaAjax(<?php echo $row['id'];?>)"><button title="dar de baja usuario" type="button" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button></a>
									</td>
								</tr>
								<?php $aux++; ?>
							<?php endwhile; ?>
						</tbody>
					</table>
				</div>
				<div class="row" id="alert_empty"> <!-- SECTION EMPTY TABLE -->
					<?php if(mysql_num_rows($resultado["todos"])<1):?>
						<div class="col-md-12">
							<div class="alert alert-error alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<strong>MENSAJE DE ALERTA!</strong> No se encontraron USUARIOS registrados.
							</div>
						</div>
					<?php endif;?>
				</div>
			</div>
	          <div id="viajes" role="tabpanel" class="tab-pane">
				<div class="table-responsive">
					<table class="table table-striped table-condensed table-hover">
						<thead>
							<tr style="background-color: #313131">
								<th rowspan="2" width="7%" style="padding-bottom:10px;">Nro</th>
								<th rowspan="2" width="15%" style="padding-bottom:10px;">Actividad</th>
								<th rowspan="2" width="10%" style="padding-bottom:10px;">viaje</th>
								<th rowspan="2" width="45%" style="padding-bottom:10px;">lugar</th>
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
							<?php while($row=mysql_fetch_array($resultado["viajes"])): ?>
								<tr>
									<td><h5><?php echo $aux;?></h5></td>
									<td><h5><?php echo $row['actividad']; ?></h5></td>
									<td><h5><?php echo $row['tipo_lugar']; ?></h5></td>
									<td style="text-align:left;padding-left:9px"><h5><?php echo $row['establecimiento']=="" ?  $row['ciudad'] : $row['establecimiento']; ?> <small><?php echo $row['municipio'];?></small></h5></td>
									<td><h5><?php echo $row['fecha_de']; ?></h5></td>
									<td><h5><?php echo $row['fecha_hasta']; ?></h5></td>
									<td>
										<a data-target="#updateotraplanificacionModal" data-toggle="modal" onclick="updateAjax(<?php echo $row['id'];?>)"><button title="editar usuario" type="button" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button></a>
										<a  onclick="bajaAjax(<?php echo $row['id'];?>)"><button title="dar de baja usuario" type="button" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button></a>
									</td>
								</tr>
								<?php $aux++; ?>
							<?php endwhile; ?>
						</tbody>
					</table>
				</div>
				<div class="row"> <!-- SECTION EMPTY TABLE -->
					<?php if(mysql_num_rows($resultado["viajes"])<1):?>
						<div class="col-md-12">
							<div class="alert alert-error alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<strong>MENSAJE DE ALERTA!</strong> No se encontro personas de ADMINISTRACION registrados.
							</div>
						</div>
					<?php endif;?>
				</div>
			</div>
	          <div id="locales" role="tabpanel" class="tab-pane">
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
							<?php while($row=mysql_fetch_array($resultado["locales"])): ?>
								<tr>
									<td><h5><?php echo $aux;?></h5></td>
									<td style="text-align:left;padding-left:9px"><h5><?php echo $row['actividad']; ?></h5></td>
									<td style="text-align:left;padding-left:9px"><h5><?php echo $row['lugar']; ?></h5></td>
									<td><h5><?php echo $row['fecha_de']; ?></h5></td>
									<td><h5><?php echo $row['fecha_hasta']; ?></h5></td>
									<td>
										<a data-target="#updateotraplanificacionModal" data-toggle="modal" onclick="updateAjax(<?php echo $row['id'];?>)"><button title="editar usuario" type="button" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button></a>
										<a  onclick="bajaAjax(<?php echo $row['id'];?>)"><button title="dar de baja usuario" type="button" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button></a>
									</td>
								</tr>
								<?php $aux++; ?>
							<?php endwhile; ?>
						</tbody>
					</table>
				</div>
				<div class="row"> <!-- SECTION EMPTY TABLE -->
					<?php if(mysql_num_rows($resultado["locales"])<1):?>
						<div class="col-md-12">
							<div class="alert alert-error alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<strong>MENSAJE DE ALERTA!</strong> No se encontraron encargados de JEFATURA registrados.
							</div>
						</div>
					<?php endif;?>
				</div>
			</div>
		</div>
	</div>
	<center>
		<a href="/<?php echo FOLDER;?>/Otro/printpdf/<?php echo $resultado['year'].$resultado['month']?>" target="_blank"><button type="button" class="btn btn-success">IMPRIMIR REPORTE</button></a>
	</center>
</div>
<?php 	include 'modalnewotraplanificacion.php';
		include 'modalupdateotraplanificacion.php';?>
<script>
   	var id_planificacion_u;
    $(document).ready(function(){
	    $("#selectmunicipio option,#selectestablecimiento option").hide();
	    var seleccionado=$('#selectredsalud option:selected').val();
	    $("#selectmunicipio option[value="+seleccionado+"]").show();

	    $('#selectredsalud').change(function(){
		    var seleccionado=$('#selectredsalud option:selected').val();
		    $("#selectmunicipio option,#selectestablecimiento option").hide();
		    $("#selectmunicipio option[value="+seleccionado+"]").show();
		    $("#selectmunicipio,#selectestablecimiento").prop("selectedIndex", 0);
			$("#selectmunicipio,#selectestablecimiento").selectpicker('refresh');
			function_validate($(this).attr('validate'));
	    });
	    $('#selectmunicipio').change(function(){
		    var selecc=$('#selectmunicipio option:selected').attr('municipio');
		    $("#selectestablecimiento option").hide();
		    $("#selectestablecimiento option[value="+selecc+"]").show();
		    $("#selectestablecimiento").prop("selectedIndex", 0);
			$("#selectestablecimiento").selectpicker('refresh');
			function_validate($(this).attr('validate'));
	    });
	    $('#selectestablecimiento').change(function(){
			function_validate($(this).attr('validate'));
	    });

	    $('#inputsearch').keyup(function(){$('#myTabs a[href="#todos"]').tab('show');
		    var data=$(this).val().toLowerCase().trim();SEARCH_DATA(data,"tableplanificacion","No se encontraron PLANIFICACIONES registrados.");});

	    	$('#datetimepicker1,#datetimepicker2').datetimepicker({locale: 'es',format: 'YYYY-MM-DD',ignoreReadonly: true,viewMode: 'days'}).on('dp.change', function(e){ validate_fecha("","true");});
	    	$('#datetimepicker1_u,#datetimepicker2_u').datetimepicker({locale: 'es',format: 'YYYY-MM-DD',ignoreReadonly: true,viewMode: 'days'}).on('dp.change', function(e){ validate_fecha("_u","false");});
		$('#inputlugar,#inputlugar_u').keypress(function(e){not_number(e);}).keyup(function(){if($(this).val().trim().length>5){small_error($(this).attr('toggle'),true);}else{small_error($(this).attr('toggle'),false);}function_validate($(this).attr('validate'));});
		$('#datetimepickermes').datetimepicker({locale: 'es',format: 'YYYY-MM',ignoreReadonly: true,viewMode: 'months'}).on('dp.change', function(e){
			var placeholder=$('#datetimepickermes input').attr('placeholder'),input=$('#datetimepickermes input').val(),entero=parseInt(e.date._d.getMonth())+1,au= entero < 10 ? ("0" + entero) : (entero);
			if (placeholder.toString()!=input.toString()) {
				window.location.href = "/<?php echo FOLDER;?>/Otro?year="+e.date._d.getFullYear()+"&month="+au;
			}
		});


		$('#checkviaje').change(function () {if($(this).is(':checked')){$('#collapse5').show();}else{$('#collapse5').hide();}function_validate($(this).attr('validate'));});
		$('.checklugar').change(function () {
			if ($('.checklugar:checked').val()=="departamental") {
				$('.classdepartamental').show();
				$('.classprovincial').hide();
			}else{
				$('.classdepartamental').hide();
				$('.classprovincial').show();
			}
			function_validate($(this).attr('validate'));
		});

		function validate_fecha(data,estado){
			var year=parseInt(<?php echo date('Y');?>);
			var month=parseInt(<?php echo date('m');?>);
			var day=parseInt(<?php echo date('d');?>);
			var fechade = 	$('#datetimepicker1'+data+' input').val().split("-");
			var fechahasta = 	$('#datetimepicker2'+data+' input').val().split("-");
			if ((parseInt(fechade[0])==year)&&(parseInt(fechade[1])==month || parseInt(fechade[1])==month+1)&&(parseInt(fechade[2])>=day)) {
				validate_sinsmall(".fila2"+data,true);$('#error_fechade'+data).hide();
				if ((parseInt(fechahasta[0])==year)&&(parseInt(fechade[1])==parseInt(fechahasta[1]))&&(parseInt(fechahasta[2])>=parseInt(fechade[2]))){
					validate_sinsmall(".fila3"+data,true);
					$('#error_fechahasta'+data).hide();
				}else{
					validate_sinsmall(".fila3"+data,false);
					$('#error_fechahasta'+data).show();
				}
			}else {
				$('#error_fechade'+data+',#error_fechahasta'+data).show();
				validate_sinsmall(".fila2"+data,false);
				validate_sinsmall(".fila3"+data,false);
			}
			function_validate(estado);
		}

		$('#btnregistrar').click(function(){
			var id_establecimiento=0,tipo_actividad="local",tipo_lugar="",ciudad="";
			if($('#checkviaje').is(':checked')){
				tipo_actividad="viaje";ciudad=$('#selectdepartamento option:selected').val();
				if ($('.checklugar:checked').val()=="provincial") {
					tipo_lugar="provincial";
					id_establecimiento=$('#selectestablecimiento option:selected').attr('toggle');
				}else{tipo_lugar="departamental";}
			}
			$.ajax({
				url: '<?php echo URL;?>Otro/crear',
				type: 'post',
				data:{
					id_establecimiento:id_establecimiento,
					tipo_actividad:tipo_actividad,
					tipo_lugar:tipo_lugar,
					ciudad:ciudad,
					id_otra_actividad:$('#selectactividad option:selected').val(),
					lugar:$('#inputlugar').val(),
					fecha_de:$('#datetimepicker1 input').val(),
					fecha_hasta:$('#datetimepicker2 input').val()
				},
				success:function(obj){
					swal("Mensaje de Alerta!", obj , "success");
					setInterval(function(){ window.location.href = "/<?php echo FOLDER; ?>/Otro"; }, 1500);
				}
			});
		});

		//UPDATE planificacion
		$('#buttonupdate').click(function(){
			array=[];$('.rows_resultados_u').each(function(){array.push($(this).text().trim());});
			var total = "";for (var i = 0; i < array.length; i++) {total=total+array[i]+"|";}
			arrayobj=[];$('.rows_objetivos_u').each(function(){arrayobj.push($(this).text().trim());});
			var totalobj = "";for (var i = 0; i < arrayobj.length; i++) {totalobj=totalobj+arrayobj[i]+"|";}
			$.ajax({
				url: '<?php echo URL;?>Planificacion/editar/'+id_planificacion_u,
				type: 'post',
				data:{
					id_actividad:$('#selectactividad_u option:selected').val(),
					fecha_de:$('#datetimepicker1_u input').val(),
					fecha_hasta:$('#datetimepicker2_u input').val(),
					objetivo:totalobj,
					esperado:total
				},
				success:function(obj){
					swal("Mensaje de Alerta!", obj , "success");
					setInterval(function(){ window.location.href = "/<?php echo FOLDER;?>/Planificacion"; }, 1500);
				}
			});
		});
         	$('#selectactividad_u').change(function(){function_validate("false");});
	});
	function updateAjax(val){
		$.ajax({
			url: '<?php echo URL;?>Planificacion/ver/'+val,
			type: 'get',
			success:function(obj){
				var data = JSON.parse(obj);
				$('.unombre').text(data.actividad);$('.ufechade').text("de: "+data.fecha_de);$('.ufechahasta').text("hasta: "+data.fecha_hasta);$('.uelaborado').text("elaborado: "+data.fecha_elaboracion);
				$('#datetimepicker1_u input').val(data.fecha_de);$('#datetimepicker1_u input').attr('placeholder',data.fecha_de);
				$('#datetimepicker2_u input').val(data.fecha_hasta);$('#datetimepicker2_u input').attr('placeholder',data.fecha_hasta);
				$('#selectactividad_u option[value='+data.id_actividad+']').attr('selected','selected');
				$("#selectactividad_u").selectpicker('refresh');
				id_planificacion_u=data.id;id_actividad_u=data.id_actividad;
				var objetivos=data.objetivo.split('|');
				var esperados=data.esperado.split('|');
				$('#objetivo_caja_u,#resultado_caja_u').empty();
				for (var i = 0; i < objetivos.length-1; i++) {
					$('#objetivo_caja_u').append('<li class="list-group-item rows_objetivos_u row_objetivou'+rowobj+'" style="padding: 5px 15px 5px 15px;"><span class="badge glyphicon glyphicon-remove badge_objetivou"  row="'+rowobj+'" aria-hidden="true" style="background:#ca3030;cursor:pointer"> </span>'+objetivos[i]+'</li>');
					rowobj++;
				}
				for (var i = 0; i < esperados.length-1; i++) {
					$('#resultado_caja_u').append('<li class="list-group-item rows_resultados_u row_resultadou'+rowesp+'" style="padding: 5px 15px 5px 15px;"><span class="badge glyphicon glyphicon-remove badge_resultadou"  row="'+rowesp+'" aria-hidden="true" style="background:#ca3030;cursor:pointer"> </span>'+esperados[i]+'</li>');
					rowesp++;
				}
				$('.badge_resultadou').click(function(){
					$('.row_resultadou'+$(this).attr('row')).remove();
					validarbag=true;
					function_validate("false");
				});
				$('.badge_objetivou').click(function(){
					$('.row_objetivou'+$(this).attr('row')).remove();
					validarbag=true;
					function_validate("false");
				});
			}
		});
	}
	function bajaAjax(val){
		swal({
			title: "¿Estás seguro?",
			text: "Esta Seguro que quiere Eliminar la Planificacion?",
			type: "warning",
			showCancelButton: true,confirmButtonColor: "#d93333",
			confirmButtonText: "Dar de Baja!",
			closeOnConfirm: false
		},function(){
			$.ajax({
				url: '<?php echo URL;?>Planificacion/eliminar/'+val,
				type: 'get',
				success:function(obj){
					if (obj=="false") {
					}else{
						swal("Mensaje de Alerta!", obj , "success");
						setInterval(function(){ window.location.href = "/<?php echo FOLDER;?>/Planificacion"; }, 1000);
					}
				}
			});
		});
	}
	function function_validate(validate){
		if(validate!="false"&&validate=="true"){
			if(($('.fila1').hasClass('has-success'))&&($('.fila2').hasClass('has-success'))&&($('.fila3').hasClass('has-success'))) {
				if($('#checkviaje').is(':checked')){
					if ($('.checklugar:checked').val()=="provincial") {
						if ($('#selectmunicipio option:selected').val()!="") {
							if ($('#selectestablecimiento option:selected').val()!="") {
								$("#btnregistrar").attr('disabled', false);
							}else{$("#btnregistrar").attr('disabled', true);}
						}else{$("#btnregistrar").attr('disabled', true);}
					}else{$("#btnregistrar").attr('disabled', false);}
				}else{$("#btnregistrar").attr('disabled', false);}
			}else{$("#btnregistrar").attr('disabled', true);}
		}else{
			if($('.fila1_u').hasClass('has-success') && $('.fila2_u').hasClass('has-success')&&($('#selectactividad_u option').length>0)&&$('#resultado_caja_u li').length>0&&$('#objetivo_caja_u li').length>0){
				if(($('#datetimepicker1_u input').attr('placeholder')!=$('#datetimepicker1_u input').val()) ||
					($('#datetimepicker2_u input').attr('placeholder')!=$('#datetimepicker2_u input').val()) ||
					($('#selectactividad_u option:selected').attr('value')!=id_actividad_u) || validarbag
				){
					$("#buttonupdate").attr('disabled', false);
				}else{$("#buttonupdate").attr('disabled', true);}
			}else{$("#buttonupdate").attr('disabled', true);}
		}
	}
</script>
