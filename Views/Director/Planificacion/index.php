<?php
	$users=['Administrador','Director','Planificador','Jefe de Jefatura','Jefe de Unidad','Normal'];
	$months=["Enero","Febrero","Marzo", "Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"];
	$mes=$months[intval($resultado['month']) - 1];
	$get_presentado="";
?>
<div class="col-md-12">
	<div class="col-md-9">
		<h2 class="text-center" style="margin:5px 0 1px 0;font-weight:300">LISTA DE MIS PLANIFICACIONES <small>(<?php echo $mes."-".$resultado['year'];?>)</small> </h2>
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
					<th width="62%">nombre actividad</th>
					<th width="10%">mes</th>
				    <th width="12%">estado</th>
					<th width="10%">Opciones</th>
				</thead>
				<?php $aux=1; $meses= array('ENERO','FEBRERO','MARZO','ABRIL','MAYO','JUNIO','JULIO','AGOSTO','SEPTIEMBRE','OCTUBRE','NOVIEMBRE','DICIEMBRE');?>
				<tbody>
					<?php while($row=mysql_fetch_array($resultado['planificacion'])):?>
						<tr>
							<td style="vertical-align:middle"><h5><?php echo $aux;?></h5></td>
							<td><h5><?php echo $row['actividad'];?></h5></td>
							<td><h5><?php echo $meses[intval(date('m', strtotime($row['fecha_elaboracion'])))-1]?></h5></td>
							<td style="vertical-align:middle"><h5> <?php echo $row['estado']==0 ? 'Sin Completar <span class="glyphicon glyphicon-remove" aria-hidden="true" style="color:#ee0000"></span>' : 'Completado <span class="glyphicon glyphicon-ok" aria-hidden="true" style="color:#00cd40"></span>'?></h5></td>
							<td style="vertical-align:middle">
								<a data-target="#verplanificacionModal" data-toggle="modal" onclick="verAjax(<?php echo $row['id'];?>)"><span class="glyphicon glyphicon-eye-open" title="ver planificación" aria-hidden="true" style="padding:0 5px 0 5px;color:#313131;cursor:pointer"></span></a>
						    <?php
                                 	if($row['fecha_presentacion']=="" || $row['fecha_presentacion']==null){
								echo '<a data-target="#updateplanificacionModal" data-toggle="modal" onclick="updateAjax('.$row['id'].')"><button title="editar planificacion" type="button" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button></a>';
                                 	 	echo '<a onclick="bajaAjax('.$row['id'].')"><buttontitle="eliminar planificacion" type="button" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button></a>';

							}else{
								$get_presentado=$row['fecha_presentacion'];
								if(date('Y', strtotime($row['fecha_hasta']))<=date('Y') && date('m', strtotime($row['fecha_hasta']))<=date('m') && date('d', strtotime($row['fecha_hasta']))<=date('d') && $row['estado']==0) {
									echo '<a data-target="#informeplanificacionModal" data-toggle="modal" onclick="GET_ID('.$row['id'].')"><span class="glyphicon glyphicon-check" title="completar informe" aria-hidden="true" style="padding:0 5px 0 5px;color:#0ab500;cursor:pointer"></span></a>';
								}else{

								}
							}?>
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
	<?php if(mysql_num_rows($resultado["planificacion"])<1){ //tabla vacia?>
		<div class="col-md-12"><div class="alert alert-error alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>MENSAJE DE ALERTA!</strong> No se encontraron Planificaciones en este mes.</div></div>

		<div class="fab" data-target="#newplanificacionModal" data-toggle="modal"> + </div>
		<?php  include 'modalnewplanificacion.php';?>

	<?php }else{ include 'modallistplanificacion.php';if ($get_presentado =="") { //cuando no se presento planificacion?>
		<div class="fab" data-target="#newplanificacionModal" data-toggle="modal"> + </div>
		<?php include 'modalupdateplanificacion.php';include 'modalnewplanificacion.php';?>
			<center><button class="btn btn-success" id="buttonvalidar" onclick="validarAjax(<?php echo $resultado['year']?>,<?php echo $resultado['month']?>)">VALIDAR ACTIVIDADES</button></center>
		<?php }else{  include 'modalinformeplanificacion.php';//planificacion presentada?>
			<a href="/<?php echo FOLDER;?>/Planificacion/print_mi_informe/<?php echo $resultado['year'].$resultado['month']?>" target="_blank"><div class="fab" style="background:#f21d1d"><span class="glyphicon glyphicon-print" style="font-size:.7em" aria-hidden="true"></span></div></a>
			<center>
	  			<a href="/<?php echo FOLDER;?>/Planificacion/print_mi_planificacion/<?php echo $resultado['year'].$resultado['month']?>" target="_blank"><button type="button" class="btn btn-info">VER PLANIFICACION</button></a>
  	        	</center>
		<?php }} ?>
</div>
<script>
   	var id_actividad_u,id_planificacion_u,auxi=0,auxi2=0,rowobj=0,rowesp=0,validarbag=false,Get_ID;
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
			if (parseInt(fechade[0])==year) {
				if ((parseInt(fechade[1])==month)&&(parseInt(fechade[2])>=day)) {
					validate_sinsmall(".fila1"+data,true);$('#error_fechade'+data).hide();
				}else{
					if ((parseInt(fechahasta[0])==year)&&(parseInt(fechade[1])==parseInt(fechahasta[1]))&&(parseInt(fechahasta[2])>=parseInt(fechade[2]))){
						validate_sinsmall(".fila2"+data,true);
						$('#error_fechahasta'+data).hide();
					}else{
						validate_sinsmall(".fila2"+data,false);
						$('#error_fechahasta'+data).show();
					}
					if (parseInt(fechade[1])==month+1) {
						validate_sinsmall(".fila1"+data,true);$('#error_fechade'+data).hide();
					}else{
						validate_sinsmall(".fila1"+data,false);
						validate_sinsmall(".fila2"+data,false);
						$('#error_fechade'+data+',#error_fechahasta'+data).show();
					}
				}
			}else {
				$('#error_fechade'+data+',#error_fechahasta'+data).show();
				validate_sinsmall(".fila1"+data,false);
				validate_sinsmall(".fila2"+data,false);
			}
			function_validate(estado);
		}

	//_______________REGISTRAR ACTIVIDAD
		$('#btnregistrar').click(function(){array=[];$('.rows_resultados').each(function(){array.push($(this).text().trim());});var total = "";for (var i = 0; i < array.length; i++) {total=total+array[i]+"|";};arrayobj=[];$('.rows_objetivos').each(function(){arrayobj.push($(this).text().trim());});var totalobj = "";for (var i = 0; i < arrayobj.length; i++) {totalobj=totalobj+arrayobj[i]+"|";};$.ajax({url: '<?php echo URL;?>Planificacion/crear',type: 'post',data:{id_actividad:$('#selectactividad option:selected').val(),fecha_de:$('#datetimepicker1 input').val(),fecha_hasta:$('#datetimepicker2 input').val(),objetivo:totalobj,esperado:total},success:function(obj){swal("Mensaje de Alerta!", obj , "success");setInterval(function(){ location.reload();}, 1000);}});});
		//agregar objetivos
		$('#buttonadd_objetivo,#buttonadd_objetivo_u').click(function(){var type=$(this).attr("info"),estado=$(this).attr("validate");if (type=="_u") {validarbag=true;}if ($('#input_objetivo'+type).val().trim()!="") {$('#objetivo_caja'+type).append('<li class="list-group-item rows_objetivos'+type+' row_objetivo'+type+auxi2+'" style="padding: 5px 15px 5px 15px;"><span class="badge glyphicon glyphicon-remove badge_objetivo'+type+'"  row="'+auxi2+'" aria-hidden="true" style="background:#ca3030;cursor:pointer"> </span>'+$('#input_objetivo'+type).val()+'</li>');auxi2=auxi2+1;$('#input_objetivo'+type).val("");function_validate(estado);}$('.badge_objetivo'+type).click(function(){$('.row_objetivo'+type+$(this).attr('row')).remove();function_validate(estado);});});
		//agregar resultados esperados
		$('#buttonadd_resultado,#buttonadd_resultado_u').click(function(){var type=$(this).attr("info"),estado=$(this).attr("validate");console.log($('#input_resultado'+type).val()); if (type=="_u") {validarbag=true;}if ($('#input_resultado'+type).val().trim()!="") {$('#resultado_caja'+type).append('<li class="list-group-item rows_resultados'+type+' row_resultado'+type+auxi2+'" style="padding: 5px 15px 5px 15px;"><span class="badge glyphicon glyphicon-remove badge_resultado'+type+'"  row="'+auxi2+'" aria-hidden="true" style="background:#ca3030;cursor:pointer"> </span>'+$('#input_resultado'+type).val()+'</li>');auxi2=auxi2+1;$('#input_resultado'+type).val("");function_validate(estado);}$('.badge_resultado'+type).click(function(){$('.row_resultado'+type+$(this).attr('row')).remove();function_validate(estado);});});

	//__________________COMPLETAR INFORME DE PLANIFICACION
		$('#textareaobjetivo').keyup(function(){if($(this).val().trim().length>4){validate_sinsmall($(this).attr('toggle'),true);$("#btninforme").attr('disabled', false);}else{validate_sinsmall($(this).attr('toggle'),false);$("#btninforme").attr('disabled', true);}});
		$('#btninforme').click(function(){$.ajax({url: '<?php echo URL;?>Planificacion/completarinforme/'+Get_ID,type: 'post',data:{observacion:$('#textareaobjetivo').val(),},success:function(obj){swal("Mensaje de Alerta!", obj , "success");setInterval(function(){ location.reload();}, 1000);}});});

	//_____________UPDATE PLANIFICACION
		$('#buttonupdate').click(function(){array=[];$('.rows_resultados_u').each(function(){array.push($(this).text().trim());});var total = "";for (var i = 0; i < array.length; i++) {total=total+array[i]+"|";};arrayobj=[];$('.rows_objetivos_u').each(function(){arrayobj.push($(this).text().trim());});var totalobj = "";for (var i = 0; i < arrayobj.length; i++) {totalobj=totalobj+arrayobj[i]+"|";};$.ajax({url: '<?php echo URL;?>Planificacion/editar/'+id_planificacion_u,type: 'post',data:{id_actividad:$('#selectactividad_u option:selected').val(),fecha_de:$('#datetimepicker1_u input').val(),fecha_hasta:$('#datetimepicker2_u input').val(),objetivo:totalobj,esperado:total},success:function(obj){swal("Mensaje de Alerta!", obj , "success");setInterval(function(){ location.reload();}, 1000);}});});
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

	//ELIMINAR PLANIFICACION
	function bajaAjax(val){swal({title: "¿Estás seguro?",text: "Esta Seguro que quiere Eliminar la Planificacion?",type: "warning",showCancelButton: true,confirmButtonColor: "#d93333",confirmButtonText: "Dar de Baja!",closeOnConfirm: false},function(){$.ajax({url: '<?php echo URL;?>Planificacion/eliminar/'+val,type: 'get',success:function(obj){if (obj=="false") {}else{swal("Mensaje de Alerta!", obj , "success");setInterval(function(){ location.reload();}, 1000);}}});});}

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
		$.ajax({
			url: '<?php echo URL;?>Planificacion/ver/'+val,
			type: 'get',
			success:function(obj){
				var data = JSON.parse(obj);
				var arrayaobjetivo = data.objetivo==null ? ([0]):(data.objetivo.split("|"));
				var arrayesperado = data.esperado==null ? ([0]):(data.esperado.split("|"));

			     $('#tablealcanzados,#tableobjetivos,#tableesperados').empty();
				for (var i = 0; i < arrayaobjetivo.length-1; i++) {
					$('#tableobjetivos').append('<tr><td>'+(i+1)+'</td><td>'+arrayaobjetivo[i]+'</td></tr>');
				}
				for (var i = 0; i < arrayesperado.length-1; i++) {
					$('#tablealcanzados').append('<tr><td>'+(i+1)+'</td><td>'+arrayesperado[i]+'</td> </tr>');
				}
				for (var i = 0; i < arrayesperado.length-1; i++) {
					$('#tableesperados').append('<tr><td>'+(i+1)+'</td><td>'+arrayesperado[i]+'</td> </tr>');
				}
				$('#idcontesperados').text(arrayesperado.length-1);
				$('#idcontobtenidos').text(arrayesperado.length-1);
				$('#idcontobjetivos').text(arrayaobjetivo.length-1);
			    var aux = ["No Consolidado" , "Consolidado"];
			     $('.vactividad').text(data.actividad);
				$('.vfecha_de').text(data.fecha_de);
				$('.vfecha_hasta').text(data.fecha_hasta);
				$('.vvista_planificador').text(aux[data.vista_planificador]);
				$('.vvista_unidad').text(aux[data.vista_unidad]);
				$('.vvista_jefatura').text(aux[data.vista_jefatura]);
                    $('.vfecha_elaboracion').text(data.fecha_elaboracion);
				$('.vestado').text(data.estado==0 ? ("Sin Concluir"):("Concluido"));
				if (data.fecha_presentacion==null || data.fecha_presentacion=="") {
					$('.vfecha_presentacion').text("No Presentado");
					$('.vobservacion').hide();$('#buttonvalidar').show();
				}else{
					$('.vobservacion').show();$('#buttonvalidar').hide();
					$('.vfecha_presentacion').text(data.fecha_presentacion);
					if (data.observacion==null || data.observacion=="") {
						$('.vobservacion span').text("Sin Observaciones");
					}else{
						$('.vobservacion span').text(data.observacion.toLowerCase());
					}
				}
				if (data.estado==0) {
					$('#esperado_modal,.esperadomodal').show();
					$('#obtenido_modal,.obtenidomodal').hide();
				}else{
					$('#esperado_modal,.esperadomodal').hide();
					$('#obtenido_modal,.obtenidomodal').show();
				}
				$('#myTab a:first').tab('show');
			}
		});
	}
	function validarAjax(year,month){
		console.log(year,month);
		swal({
			title: "¿Estás seguro de validar la actividad?",
			text: "Una vez validado las actividades ya no podra modificarlos.. ya que estas actividades seran parte de su planificación mensual y que usted los realizará",
			type: "warning",
			showCancelButton: true,confirmButtonColor: "#24be66",
			confirmButtonText: "Validar Actividad!",
			closeOnConfirm: false
		},function(){
			$.ajax({
				url: '<?php echo URL;?>Planificacion/validar?year='+year+'&month='+month,
				type: 'get',
				success:function(obj){
					if (obj=="false") {
					}else{
						swal("Mensaje de Alerta!", obj , "success");
						setInterval(function(){ location.reload(); }, 1000);
					}
				}
			});
		});
	}
	function GET_ID(val){Get_ID=val;}
</script>
