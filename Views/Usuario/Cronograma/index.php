<?php
	$months=["Enero","Febrero","Marzo", "Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"];
?>
<div class="fab" id="btnprint"><span class="glyphicon glyphicon-save" aria-hidden="true" style="font-size:.7em;margin-left: 3px;"></span></div>
<div class="col-md-12">
		<div class="col-md-10">
			<h2 class="text-center" style="margin:5px 0 10px 0;font-weight:600">CRONOGRAMA DE OTRAS ACTIVIDADES</h2>
		</div>
		<div class="col-md-2" style="padding:0">
			<select id="selectactividad_v" class="form-control selectpicker show-tick" type="<?php echo $resultado['type']?>">
				<option value="0">Viajes</option>
				<?php while($row=mysql_fetch_array($resultado['actividad'])): ?>
					<option value="<?php echo $row['id'];?>"><?php echo ucwords(strtolower($row['nombre']));?></option>
				<?php endwhile; ?>
			</select>
		</div>
	</div>
	<h2 class="text-center" style="margin:5px 0 10px 0;font-weight:300"></h2>
</div>
<div class="row" style="margin:0px"> <!-- SECTION CALENDARIO -->
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div id='calendar'></div>
	</div>
</div>
<div class="row" id="alert_empty"> <!-- SECTION EMPTY TABLE -->
	<?php if(count($resultado['planificacion'])<1){ //tabla vacia?>
		<div class="col-md-12"><div class="alert alert-error alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>MENSAJE DE ALERTA!</strong> No se encontraron Planificaciones pendientes.</div></div>
	<?php }else{include 'modalvercronograma.php';include 'modalupdatecronograma.php';}?>
</div>
<?php  include 'modalnewcronograma.php'?>
<style>
	table thead tr {background: none;}table>thead>tr>th {color: #827a90;font-weight: 600;}
</style>
<script>
	var typemodal="",Get_ID,date_start,date_end;
	var citys={['potosi']:"Potosí",['lapaz']:"La Paz",['cochabamba']:"Cochabamba",['santacruz']:"Santa Cruz",['tarija']:"Tarija",['chuquisaca']:"Chuquisaca",['oruro']:"Oruro",['beni']:"Beni",['pando']:"Pando"};
     $(document).ready(function(){
		$('#selectactividad_v').change(function(){window.location.href = "/<?php echo FOLDER;?>/Cronograma?type="+ $('#selectactividad_v').val();});
		$('#selectactividad_v option[value='+$("#selectactividad_v").attr("type")+']').attr('selected','selected');
		function getRandomColor() {var letters = '0123456789ABCDEF'.split(''),color = '#';for (var i = 0; i < 6; i++ ) {color += letters[Math.floor(Math.random() * 16)];}return color;} //random color

		$('#inputobservacion').keyup(function(){if($(this).val().trim().length>5){small_error('.fila_validar',true);$("#btnnovalidado").attr('disabled', false);}else{small_error('.fila_validar',false);$("#btnnovalidado").attr('disabled', true);}});

		$("#selectmunicipio option,#selectestablecimiento option").hide();
	     var seleccionado=$('#selectredsalud option:selected').val();
	     $("#selectmunicipio option[value="+seleccionado+"]").show();

	     $('#selectredsalud,#selectredsalud_u').change(function(){var seleccionado=$('#selectredsalud'+typemodal+' option:selected').val();$("#selectmunicipio"+typemodal+" option,#selectestablecimiento"+typemodal+" option").hide();$("#selectmunicipio"+typemodal+" option[value="+seleccionado+"]").show();$("#selectmunicipio"+typemodal+",#selectestablecimiento"+typemodal).prop("selectedIndex", 0);$("#selectmunicipio"+typemodal+",#selectestablecimiento"+typemodal).selectpicker('refresh');function_validate($(this).attr('validate'));
	     });
	     $('#selectmunicipio,#selectmunicipio_u').change(function(){var selecc=$('#selectmunicipio'+typemodal+' option:selected').attr('municipio');$("#selectestablecimiento"+typemodal+" option").hide();$("#selectestablecimiento"+typemodal+" option[value="+selecc+"]").show();$("#selectestablecimiento"+typemodal).prop("selectedIndex", 0);$("#selectestablecimiento"+typemodal).selectpicker('refresh');function_validate($(this).attr('validate'));});
	     $('#selectestablecimiento,#selectestablecimiento_u').change(function(){function_validate($(this).attr('validate'));});
		$('#checkauditorio,#checkauditorio_u').change(function () {if($(this).is(':checked')){$('#rowlugar'+typemodal).hide();}else{$('#rowlugar'+typemodal).show();}function_validate($(this).attr('validate'));});
		$('#checkviaje,#checkviaje_u').change(function () {if($(this).is(':checked')){$('#collapse5'+typemodal).show();$('#rowauditorio'+typemodal).hide();if($('.checklugar'+typemodal+':checked').val()=="departamental") {$('#rowlugar'+typemodal).show();}else{$('#rowlugar'+typemodal).hide();}}else{$('#collapse5'+typemodal).hide();$('#rowauditorio'+typemodal).show();if($('#checkauditorio'+typemodal).is(':checked')){$('#rowlugar'+typemodal).hide();}else{$('#rowlugar'+typemodal).show();}}function_validate($(this).attr('validate'));});
		$('.checklugar,.checklugar_u').change(function () {if($('.checklugar'+typemodal+':checked').val()=="departamental") {$('.classdepartamental'+typemodal).show();$('.classprovincial'+typemodal).hide();$('#rowlugar'+typemodal).show();}else{$('.classdepartamental'+typemodal).hide();$('.classprovincial'+typemodal).show();$('#rowlugar'+typemodal).hide();}function_validate($(this).attr('validate'));});
		$('#inputlugar,#inputlugar_u').keypress(function(e){not_number(e);}).keyup(function(){if($(this).val().trim().length>5){small_error($(this).attr('toggle'),true);}else{small_error($(this).attr('toggle'),false);}function_validate($(this).attr('validate'));});
		$('#inputdescripcion,#inputdescripcion_u').keypress(function(e){not_number(e);}).keyup(function(){if($(this).val().trim().length>5){small_error($(this).attr('toggle'),true);}else{small_error($(this).attr('toggle'),false);}function_validate($(this).attr('validate'));});

		$('#btnregistrar').click(function(){
			var id_redsalud=0,id_municipio=0,id_establecimiento=0,tipo_actividad="local",tipo_lugar="departamental",ciudad="potosi",lugar=$('#inputlugar').val();
			if($('#checkviaje').is(':checked')){
				tipo_actividad="viaje";
				if ($('.checklugar:checked').val()=="provincial") {
					tipo_lugar="provincial";
					id_redsalud=$('#selectredsalud option:selected').val();
					id_municipio=$('#selectmunicipio option:selected').attr('municipio');
					id_establecimiento=$('#selectestablecimiento option:selected').attr('toggle');lugar='';
				}else{ciudad=$('#selectdepartamento option:selected').val()}
			}else{
				if($('#checkauditorio').is(':checked')){
					lugar='auditorio';
				}
			}
			$.ajax({
				url: '<?php echo URL;?>Cronograma/crear',
				type: 'post',
				data:{
					id_redsalud:id_redsalud,
					id_municipio:id_municipio,
					id_establecimiento:id_establecimiento,
					tipo_actividad:tipo_actividad,
					tipo_lugar:tipo_lugar,
					ciudad:ciudad,
					id_otra_actividad:$('#selectactividad option:selected').val(),
					lugar:lugar,
					descripcion:$('#inputdescripcion').val(),
					fecha_de:$('#fecha_de').val(),
					fecha_hasta:$('#fecha_hasta').val()
				},
				success:function(obj){
					swal("Mensaje de Alerta!", obj , "success");
					setInterval(function(){ location.reload()}, 1000);
				}
			});
		});
		$('#buttonupdate').click(function(){
			var id_redsalud=0,id_municipio=0,id_establecimiento=0,tipo_actividad="local",tipo_lugar="departamental",ciudad="potosi",lugar=$('#inputlugar_u').val();
			if($('#checkviaje_u').is(':checked')){
				tipo_actividad="viaje";
				if ($('.checklugar_u:checked').val()=="provincial") {
					tipo_lugar="provincial";
					id_redsalud=$('#selectredsalud_u option:selected').val();
					id_municipio=$('#selectmunicipio_u option:selected').attr('municipio');
					id_establecimiento=$('#selectestablecimiento_u option:selected').attr('toggle');lugar='';
				}else{ciudad=$('#selectdepartamento_u option:selected').val()}
			}else{
				if($('#checkauditorio_u').is(':checked')){
					lugar='auditorio';
				}
			}
			$.ajax({
				url: '<?php echo URL;?>Cronograma/editar/'+Get_ID,
				type: 'post',
				data:{
					id_redsalud:id_redsalud,
					id_municipio:id_municipio,
					id_establecimiento:id_establecimiento,
					tipo_actividad:tipo_actividad,
					tipo_lugar:tipo_lugar,
					ciudad:ciudad,
					id_otra_actividad:$('#selectactividad_u option:selected').val(),
					lugar:lugar,
					descripcion:$('#inputdescripcion_u').val(),
					fecha_de:$('#fecha_de_u').val(),
					fecha_hasta:$('#fecha_hasta_u').val()
				},
				success:function(obj){
					swal("Mensaje de Alerta!", obj , "success");
					setInterval(function(){ location.reload()}, 1000);
				}
			});
		});
		var datos = [],data = <?php echo json_encode($resultado['planificacion'])?>;
    		for (var i = 0; i < data.length; i++) {
			var lugar="";if (data[i].lugar!=null && data[i].lugar!="") {lugar=data[i].lugar.toLowerCase();}else{if (data[i].redsalud!=null) {lugar=data[i].redsalud.toLowerCase();if (data[i].municipio!=null) {lugar=data[i].municipio.toLowerCase();if (data[i].establecimiento!=null) {lugar=data[i].establecimiento.toLowerCase();}}}}
			var viaje= data[i].tipo_actividad=="viaje" ? (" (con viaje)") : (" (sin viaje)");
			var title=data[i].actividad.toUpperCase()+viaje;
    			myObj = { "id":data[i].id, "title":title, "start":data[i].fecha_de,"end":data[i].fecha_hasta,"description": 'LUGAR: '+lugar,"color":getRandomColor()};
    			datos.push(myObj);}
    		$('#calendar').fullCalendar({
    			locale: 'es',
			defaultView: 'month',
    			header: {
    				left: 'prev, next, today',
    				center: 'title',
    				right: 'month, agendaWeek, agendaDay'
    			},
    			defaultDate: '<?php echo date('Y-m-d')?>',
    			navLinks: true,
    			eventLimit: true,
    			events: datos,
			resizable: true,
			editable:true,
			selectable:true,
			timeFormat: 'H(:mm)',
    			eventRender: function(event, element) {
    	            element.find('.fc-title').append("<br/>" + event.description);
		  	},
			select: function(startDate, endDate, jsEvent) {
				if (endDate._d.getFullYear()>=<?php echo intval(date('Y'))?> && (endDate._d.getMonth()+1>= <?php echo intval(date('m'))?>&& endDate._d.getDate()>=<?php echo intval(date('d'))?>) ||  (endDate._d.getMonth()== <?php echo intval(date('m'))?>)) {
					typemodal=""
					$('#fecha_de').val(startDate.format());
					$('#fecha_hasta').val(endDate.format());
					$('#newcronogramaModal').modal({
	 				    backdrop: 'static',
	 				    keyboard: true,
	 				    show: true
	 			     });
				};
	          },
			eventClick: function(event) {
				var CurrentDate = new Date(),GivenDate = new Date(event.end.format());
				if (GivenDate>CurrentDate) {
					updateAjax(event.id,false,false);
				     $('#updatecronogramaModal').modal('show');
				}else{
					verAjax(event.id);
				     $('#vercronogramaModal').modal('show');
				}
		     },
		     eventDrop: function(event, delta, revertFunc) {
				if (event.end._d.getFullYear()>=<?php echo intval(date('Y'))?> && event.end._d.getMonth()+1>= <?php echo intval(date('m'))?>&& event.end._d.getDate()>=<?php echo intval(date('d'))?>) {
					updateAjax(event.id,event.start.format(),event.end.format());
				     $('#updatecronogramaModal').modal({
					     backdrop: 'static',
					     keyboard: true,
					     show: true
				     });
				     $('#btncancelar').click(function(){
					     revertFunc();
				     })
				}else{
					revertFunc();
				}
		   	},
			eventResize: function(event, delta, revertFunc) {
				if (event.end._d.getFullYear()>=<?php echo intval(date('Y'))?> && event.end._d.getMonth()+1>= <?php echo intval(date('m'))?>&& event.end._d.getDate()>=<?php echo intval(date('d'))?>) {
					updateAjax(event.id,event.start.format(),event.end.format());
				     $('#updatecronogramaModal').modal({
					     backdrop: 'static',
					     keyboard: true,
					     show: true
				     });
				     $('#btncancelar').click(function(){
					     revertFunc();
				     })
				}else{
					revertFunc();
				}
			},
			viewRender: function( view, element ){
				date_start=view.intervalStart.format();
				var d=parseInt(view.intervalEnd._d.getDate()),m=parseInt(view.intervalEnd._d.getMonth())+1;
				var aux=d<10?("0"+d):(d);
				var aux2=m<10?("0"+m):(m);
				date_end=view.intervalEnd._d.getFullYear()+"-"+aux2+"-"+aux;
				$('#btnprint').click(function(){
					window.open("/<?php echo FOLDER;?>/Cronograma/printpdf?de="+date_start+"&hasta="+date_end, '_blank');
				});
			}
    		});
	});
	function updateAjax(val,fecha_de,fecha_hasta){
		typemodal="_u"
		$.ajax({
			url: '<?php echo URL;?>Cronograma/ver_cronograma/'+val,
			type: 'get',
			success:function(obj){
				var data = JSON.parse(obj);
				Get_ID=data.id;
				$('#fecha_de_u').val(fecha_de==false? (data.fecha_de):(fecha_de));
				$('#fecha_hasta_u').val(fecha_hasta==false? (data.fecha_hasta):(fecha_hasta));
				$('#selectactividad_u option[value='+data.id_otra_actividad+']').attr('selected','selected');
				$("#selectactividad_u").selectpicker('refresh');
				$('.checklugar_u[value='+data.tipo_lugar+']').attr('checked',true);
				$('#inputlugar_u').val(data.lugar);small_error('.fila2_u',true);$('#inputdescripcion_u').val(data.descripcion);small_error('.fila1_u',true);
				if (data.tipo_actividad=="viaje") {
					$('#collapse5_u').show();$('#rowauditorio_u').hide();
					if (data.tipo_lugar=="departamental") {
						$('#rowlugar_u').show();
						$('#selectdepartamento_u option[value='+data.ciudad+']').attr('selected','selected');
						$('.classdepartamental_u').show();
						$('.classprovincial_u').hide();
						$("#selectmunicipio_u option,#selectestablecimiento_u option").hide();
					     $("#selectmunicipio_u,#selectestablecimiento_u,#selectredsalud_u").prop("selectedIndex", 0);
						$("#selectmunicipio_u,#selectredsalud_u,#selectestablecimiento_u").selectpicker('refresh');
					}else{
						$('#inputlugar_u').val("");small_error('.fila2_u',false);
						$('#rowlugar_u').hide();
						$('.classdepartamental_u').hide();
						$('.classprovincial_u').show();
					     $("#selectmunicipio_u option,#selectestablecimiento_u option").hide();
					     $("#selectmunicipio_u option[value="+data.id_redsalud+"]").show();
						$("#selectestablecimiento_u option[value="+data.id_municipio+"]").show();
						$('#selectredsalud_u option[value='+data.id_redsalud+']').attr('selected','selected');
						$('#selectmunicipio_u option[municipio='+data.id_municipio+']').attr('selected','selected');
						$('#selectestablecimiento_u option[toggle='+data.id_establecimiento+']').attr('selected','selected');
						$("#selectmunicipio_u,#selectredsalud_u,#selectestablecimiento_u").selectpicker('refresh');
					}
					$('#checkviaje_u').prop('checked', true).change();
				}else{
					$('#collapse5_u').hide();$('#rowauditorio_u').show();
					if (data.lugar=="auditorio") {
						$('#checkauditorio_u').prop('checked', true).change();
						$('#rowlugar_u').hide();
						$('#inputlugar_u').val("");
						small_error('.fila2_u',false);

					}else{
						$('#checkauditorio_u').prop('checked', false).change();
						$('#rowlugar_u').show();
					}
					$('#checkviaje_u').prop('checked', false).change();
				}
			}
		});
	}
	function verAjax(val){
     	$.ajax({
			url: '<?php echo URL;?>Cronograma/ver_cronograma/'+val,
			type: 'get',
			success:function(obj){
				var data = JSON.parse(obj);
				Get_ID=data.id;
				$('.unombre h5').text(data.nombre);
				$('.unombre p').text(data.ci);
				$('.uactividad').text(data.actividad);
				$('.uviaje').text(data.tipo_actividad=="local" ? ("Sin Viaje"):("Con Viaje"));
				$('.uciudad').text("CIUDAD: "+citys[data.ciudad]);
				var aux={['departamental']:"Inter-Departamental",['provincial']:"Inter - Municipal"};
				$('.uestablecimiento').text(data.establecimiento==null ? ("Sin Establecimiento"):(data.establecimiento));
				$('.utipo').text(aux[data.tipo_lugar]);
				var lugar="";
				if (data.lugar!=null && data.lugar!="") {
					lugar=data.lugar.toLowerCase();
				}else{
					if (data.redsalud!=null) {
						lugar=data.redsalud.toLowerCase();
						if (data.municipio!=null) {
							lugar=data.municipio.toLowerCase();
							if (data.establecimiento!=null) {
								lugar=data.establecimiento.toLowerCase();
							}
						}
					}
				}
				$('.ulugar').text(lugar);
				$('.ufechahasta').text(data.fecha_hasta);
				$('.ufechade').text(data.fecha_de);
				if (data.estado==0) {
					$('#btnnovalidado,.rowinputvalidate').show();
					$('#btnvalidado,#vobservacion').hide();
				}else{
					$('#btnnovalidado,.rowinputvalidate').hide();
					$('#vobservacion span').text(data.observacion);
					$('#btnvalidado,#vobservacion').show();
				}
			}
		});
	}
	function function_validate(validate){
		if(validate!="false"&&validate=="true"){
			if($('.fila1').hasClass('has-success')) {
				if($('#checkviaje').is(':checked')){
					if ($('.checklugar:checked').val()=="provincial") {
						$("#btnregistrar").attr('disabled', false);
					}else{
						if($('.fila2').hasClass('has-success')) {
							$("#btnregistrar").attr('disabled', false);
						}else{$("#btnregistrar").attr('disabled', true);}
					}
				}else{
					if($('#checkauditorio').is(':checked')){
						$("#btnregistrar").attr('disabled', false);
					}else{
						if($('.fila2').hasClass('has-success')) {
							$("#btnregistrar").attr('disabled', false);
						}else{
							$("#btnregistrar").attr('disabled', true);
						}
					}
				}
			}else{$("#btnregistrar").attr('disabled', true);}
		}else{
			if($('.fila1_u').hasClass('has-success')) {
				if($('#checkviaje_u').is(':checked')){
					if ($('.checklugar_u:checked').val()=="provincial") {
						$("#buttonupdate").attr('disabled', false);
					}else{
						if($('.fila2_u').hasClass('has-success')) {
							$("#buttonupdate").attr('disabled', false);
						}else{$("#buttonupdate").attr('disabled', true);}
					}
				}else{
					if($('#checkauditorio_u').is(':checked')){
						$("#buttonupdate").attr('disabled', false);
					}else{
						if($('.fila2_u').hasClass('has-success')) {
							$("#buttonupdate").attr('disabled', false);
						}else{
							$("#buttonupdate").attr('disabled', true);
						}
					}
				}
			}else{$("#buttonupdate").attr('disabled', true);}
		}
	}
	function validateAjax(){
		var observacion=$('#inputobservacion').val();
		$("#btnnovalidado").attr('disabled', true);
		$.ajax({
			url: '<?php echo URL;?>Cronograma/validate/'+Get_ID,
			type: 'post',
			data:{
				observacion:observacion,
			},
			success:function(obj){
				small_error('.fila_validar',false);
				$('#btnnovalidado,.rowinputvalidate').hide();
				$('#vobservacion span').text(observacion);
				$('#btnvalidado,#vobservacion').show();
				$('#inputobservacion').val("");
			}
		})
	}
</script>
