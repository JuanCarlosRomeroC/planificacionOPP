<?php
	$users=['Administrador','Director','Planificador','Jefe de Jefatura','Jefe de Unidad','Normal'];
	$months=["Enero","Febrero","Marzo", "Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"];
	$mes=$months[intval($resultado['month']) - 1];
?>
<div class="fab" data-target="#newplanificacionModal" data-toggle="modal"> + </div>
<div class="col-md-12">
	<div class="col-md-9">
		<h2 class="text-center" style="margin:5px 0 1px 0;font-weight:300">LISTA DE PLANIFICACIONES <small>(<?php echo $mes;?>)</small> </h2>
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
<div class="row" style="margin:0px"> <!-- SECTION TABLE USERS -->
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="col-md-12 tab-content" style="margin:0px">
			<div class="table-responsive">
			<table id="tableplanificacion" class="table table-striped table-condensed table-hover">
				<thead>
					<th width="6%">nro</th>
					<th width="54%">nombre actividad</th>
					<th width="10%">mes</th>
					<th width="10%">elaborado</th>
				    <th width="10%">estado</th>
					<th width="10%">Opciones</th>
				</thead>
				<?php $aux=1; ?>
				<tbody>
					<?php while($row=mysql_fetch_array($resultado['planificacion'])):?>
						<tr>
							<td><h5><?php echo $aux;?></h5></td>
							<td><h5><?php echo $row['actividad'];?></h5></td>
							<td><h5><?php
                              $meses= array('inu','ENERO','FEBRERO','MARZO','ABRIL','MAYO','JUNIO','JULIO','AGOSTO','SEPTIEMBRE','OCTUBRE','NOVIEMBRE','DICIEMBRE');
                              $fecha = $row['fecha_elaboracion'];
                              $mes = substr($fecha, 5, 2);
                              echo $meses[(int)$mes];
							?></h5></td>
							<td style="text-align:left;padding-left:9px"><h5 style="text-align:left" class="rowtable_nombre<?php echo $row['id'];?>"><?php echo ucwords(strtolower($row['fecha_elaboracion'])); ?></h5></td>
							<td style="text-align:left;padding-left:9px"><h5 style="text-align:left"> <?php echo $row['estado']==0 ? "No Completado" : "Completado"?></h5></td>
							<td>
								<a data-target="#updateplanificacionModal" data-toggle="modal" onclick="updateAjax(<?php echo $row['id'];?>)"><button title="editar planificacion" type="button" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button></a>
								<a data-target="#verplanificacionModal" data-toggle="modal" onclick="verAjax(<?php echo $row['id'];?>)"><button title="ver planificación" type="button" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></button></a>
								<a  onclick="bajaAjax(<?php echo $row['id'];?>)">
						    <?php $estado = $row['estado'];
                                 	if($estado==0){
                                 	 	echo '<buttontitle="eliminar planificacion" type="button" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>';
                                 	}?>
							</a>
							</td>
							<?php $aux++;?>
						</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
			</div>
		</div>
	</div>
</div>
<div class="row" id="alert_empty"> <!-- SECTION EMPTY TABLE -->
	<?php if(mysql_num_rows($resultado["planificacion"])<1):?>
		<div class="col-md-12">
			<div class="alert alert-error alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<strong>MENSAJE DE ALERTA!</strong> No se encontraron Planificaciones en este mes.
			</div>
		</div>
	<?php endif;?>
</div>
<?php 	include 'modalnewplanificacion.php';
		include 'modalupdateplanificacion.php';
		include 'modallistplanificacion.php';?>
<script>
   	var id_actividad_u,id_planificacion_u,auxi=0,auxi2=0,rowobj=0,rowesp=0,validarbag=false;
    $(document).ready(function(){
	    $('#datetimepickermes').datetimepicker({locale: 'es',format: 'YYYY-MM',ignoreReadonly: true,viewMode: 'months'}).on('dp.change', function(e){
		    var placeholder=$('#datetimepickermes input').attr('placeholder'),input=$('#datetimepickermes input').val(),entero=parseInt(e.date._d.getMonth())+1,au= entero < 10 ? ("0" + entero) : (entero);
		    if (placeholder.toString()!=input.toString()) {
			    window.location.href = "/<?php echo FOLDER;?>/Planificacion?year="+e.date._d.getFullYear()+"&month="+au;
		    }
	    });

	    $('#inputsearch').keyup(function(){$('#myTabs a[href="#todos"]').tab('show');
		    var data=$(this).val().toLowerCase().trim();SEARCH_DATA(data,"tableplanificacion","No se encontraron PLANIFICACIONES registrados.");});

	    	$('#datetimepicker1,#datetimepicker2').datetimepicker({locale: 'es',format: 'YYYY-MM-DD',ignoreReadonly: true,viewMode: 'days'}).on('dp.change', function(e){ validate_fecha("","true");});
	    	$('#datetimepicker1_u,#datetimepicker2_u').datetimepicker({locale: 'es',format: 'YYYY-MM-DD',ignoreReadonly: true,viewMode: 'days'}).on('dp.change', function(e){ validate_fecha("_u","false");});
		$('#inputobjetivo,#inputobjetivo_u').keypress(function(e){not_number(e);}).keyup(function(){if($(this).val().trim().length>8){small_error($(this).attr('toggle'),true);}else{small_error($(this).attr('toggle'),false);}function_validate($(this).attr('validate'));});

		function validate_fecha(data,estado){
			var year=parseInt(<?php echo date('Y');?>);
			var month=parseInt(<?php echo date('m');?>);
			var day=parseInt(<?php echo date('d');?>);
			var fechade = 	$('#datetimepicker1'+data+' input').val().split("-");
			var fechahasta = 	$('#datetimepicker2'+data+' input').val().split("-");
			if ((parseInt(fechade[0])==year)&&(parseInt(fechade[1])==month || parseInt(fechade[1])==month+1)&&(parseInt(fechade[2])>=day)) {
				validate_sinsmall(".fila1"+data,true);$('#error_fechade'+data).hide();
				if ((parseInt(fechahasta[0])==year)&&(parseInt(fechade[1])==parseInt(fechahasta[1]))&&(parseInt(fechahasta[2])>=parseInt(fechade[2]))){
					validate_sinsmall(".fila2"+data,true);
					$('#error_fechahasta'+data).hide();
				}else{
					validate_sinsmall(".fila2"+data,false);
					$('#error_fechahasta'+data).show();
				}
			}else {
				$('#error_fechade'+data+',#error_fechahasta'+data).show();
				validate_sinsmall(".fila1"+data,false);
				validate_sinsmall(".fila2"+data,false);
			}
			function_validate(estado);
		}
		$('#buttonadd_objetivo,#buttonadd_objetivo_u').click(function(){
			var type=$(this).attr("info"),estado=$(this).attr("validate");
			if (type=="_u") {
				validarbag=true;
			}
			if ($('#input_objetivo'+type).val().trim()!="") {
				$('#objetivo_caja'+type).append('<li class="list-group-item rows_objetivos'+type+' row_objetivo'+type+auxi2+'" style="padding: 5px 15px 5px 15px;"><span class="badge glyphicon glyphicon-remove badge_objetivo'+type+'"  row="'+auxi2+'" aria-hidden="true" style="background:#ca3030;cursor:pointer"> </span>'+$('#input_objetivo'+type).val()+'</li>');
				auxi2=auxi2+1;$('#input_objetivo'+type).val("");
				function_validate(estado);
			}
			$('.badge_objetivo'+type).click(function(){
				$('.row_objetivo'+type+$(this).attr('row')).remove();
				function_validate(estado);
			});
		});
		$('#buttonadd_resultado,#buttonadd_resultado_u').click(function(){
			var type=$(this).attr("info"),estado=$(this).attr("validate");
			if (type=="_u") {
				validarbag=true;
			}
			if ($('#input_resultado'+type).val().trim()!="") {
				$('#resultado_caja'+type).append('<li class="list-group-item rows_resultados'+type+' row_resultado'+type+auxi2+'" style="padding: 5px 15px 5px 15px;"><span class="badge glyphicon glyphicon-remove badge_resultado'+type+'"  row="'+auxi2+'" aria-hidden="true" style="background:#ca3030;cursor:pointer"> </span>'+$('#input_resultado'+type).val()+'</li>');
				auxi2=auxi2+1;$('#input_resultado'+type).val("");
				function_validate(estado);
			}
			$('.badge_resultado'+type).click(function(){
				$('.row_resultado'+type+$(this).attr('row')).remove();
				function_validate(estado);
			});
		});
		$('#btnregistrar').click(function(){
			array=[];$('.rows_resultados').each(function(){array.push($(this).text().trim());});
			var total = "";for (var i = 0; i < array.length; i++) {total=total+array[i]+"|";}

			arrayobj=[];$('.rows_objetivos').each(function(){arrayobj.push($(this).text().trim());});
			var totalobj = "";for (var i = 0; i < arrayobj.length; i++) {totalobj=totalobj+arrayobj[i]+"|";}
			$.ajax({
				url: '<?php echo URL;?>Planificacion/crear',
				type: 'post',
				data:{
					id_actividad:$('#selectactividad option:selected').val(),
					fecha_de:$('#datetimepicker1 input').val(),
					fecha_hasta:$('#datetimepicker2 input').val(),
					objetivo:totalobj,
					esperado:total
				},
				success:function(obj){
					swal("Mensaje de Alerta!", obj , "success");
					setInterval(function(){ window.location.href = "/<?php echo FOLDER; ?>/Planificacion"; }, 1500);
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
			if(($('.fila1').hasClass('has-success'))&&($('.fila2').hasClass('has-success'))&&($('#selectactividad option').length>0)&&$('#resultado_caja li').length>0&&$('#objetivo_caja li').length>0){
					$("#btnregistrar").attr('disabled', false);}else{$("#btnregistrar").attr('disabled', true);}
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
	function verAjax(val){
		console.log(val);
		//$("#buttonupdate").attr('disabled', true);small_error(".fila1_u",true);
		$.ajax({
			url: '<?php echo URL;?>Planificacion/ver/'+val,
			type: 'get',
			success:function(obj){
				var data = JSON.parse(obj);
				console.log(data);
				var alcanzado = data.alcanzado;
				var arrayalcan = alcanzado==null ? ([]):(alcanzado.split("|"));

				var objetivos = data.objetivo;
				var arrayaobje = objetivos.split("|");

				var esperados = data.esperado;
				var arrayesperado = esperados.split("|");

			     $('#tabledeli,#tableobjetivos,#tableesperados').empty();
				for (var i = 0; i < arrayalcan.length; i++) {
						$('#tabledeli').append('<tr><td>'+(i+1)+'</td><td>'+arrayalcan[i]+'</td> </tr>');

				}


				for (var i = 0; i < arrayaobje.length; i++) {
						$('#tableobjetivos').append('<tr><td>'+(i+1)+'</td><td>'+arrayaobje[i]+'</td> </tr>');

					}

				for (var i = 0; i < arrayesperado.length; i++) {
						$('#tableesperados').append('<tr><td>'+(i+1)+'</td><td>'+arrayesperado[i]+'</td> </tr>');

					}


					$('#idcontesperados').text(arrayesperado.length);

				 	$('#idcontobtenidos').text(arrayalcan.lengtn);
				 	$('#idcontobjetivos').text(arrayaobje.length);


			    var aux = ["no visto" , "visto"];

				 $('#fechapre').text(data.fecha_de.toLowerCase());
				 $('#fechafin').text(data.fecha_hasta.toLowerCase());
				 $('#vistaplani').text(aux[data.vista_planificador].toLowerCase());
				 $('#vistaunidad').text(aux[data.vista_unidad].toLowerCase());
				 $('#vistajefatura').text(aux[data.vista_jefatura].toLowerCase());
				 $('#observacion').text(data.observacion.toLowerCase());
                 $('#fechaela').text(data.fecha_elaboracion.toLowerCase());
				 $('#fechapresen').text(data.fecha_presentacion.toLowerCase());

			}
		});
	}
</script>
