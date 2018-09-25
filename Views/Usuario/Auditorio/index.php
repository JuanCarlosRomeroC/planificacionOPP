<?php
	$months=["Enero","Febrero","Marzo", "Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"];
?>
<div class="fab" id="btnprint"><span class="glyphicon glyphicon-save" aria-hidden="true" style="font-size:.7em;margin-left: 3px;"></span></div>
<div class="col-md-12">
	<h2 class="text-center" style="margin:5px 0 10px 0;font-weight:700">PLANIFICADOR GENERAL DE USO DEL AUDITORIO SEDES</h2>
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
     $(document).ready(function(){
		function getRandomColor() {var letters = '0123456789ABCDEF'.split(''),color = '#';for (var i = 0; i < 6; i++ ) {color += letters[Math.floor(Math.random() * 16)];}return color;} //random color
		$('#btnregistrar').click(function(){
			$.ajax({
				url: '<?php echo URL;?>Auditorio/crear',
				type: 'post',
				data:{
					id_usuario:$('#selectusuario option:selected').val(),
					id_otra_actividad:$('#selectactividad option:selected').val(),
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
			$.ajax({
				url: '<?php echo URL;?>Auditorio/editar/'+Get_ID,
				type: 'post',
				data:{
					id_usuario:$('#selectusuario_u option:selected').val(),
					id_otra_actividad:$('#selectactividad_u option:selected').val(),
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
			var title=data[i].actividad.toUpperCase();
    			myObj = { "id":data[i].id, "title":title, "start":data[i].fecha_de,"end":data[i].fecha_hasta,"description": 'USUARIO: '+data[i].nombre.toLowerCase(),"color":getRandomColor()};
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
				typemodal=""
				$('#fecha_de').val(startDate.format());
				$('#fecha_hasta').val(endDate.format());
				$('#newcronogramaModal').modal({
 				    backdrop: 'static',
 				    keyboard: true,
 				    show: true
 			     });
	          },
			eventClick: function(event) {
				if (event.end._d.getFullYear()>=<?php echo intval(date('Y'))?> && event.end._d.getMonth()+1>= <?php echo intval(date('m'))?>&& event.end._d.getDate()>=<?php echo intval(date('d'))?>) {
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
					window.open("/<?php echo FOLDER;?>/Auditorio/printpdf?de="+date_start+"&hasta="+date_end, '_blank');
				});
			}
    		});
	});
	function updateAjax(val,fecha_de,fecha_hasta){
		typemodal="_u"
		$.ajax({
			url: '<?php echo URL;?>Auditorio/ver_cronograma/'+val,
			type: 'get',
			success:function(obj){
				var data = JSON.parse(obj);
				Get_ID=data.id;
				$('#fecha_de_u').val(fecha_de==false? (data.fecha_de):(fecha_de));
				$('#fecha_hasta_u').val(fecha_hasta==false? (data.fecha_hasta):(fecha_hasta));
				$('#selectactividad_u option[value='+data.id_otra_actividad+']').attr('selected','selected');
				$('#selectusuario_u option[value='+data.id_usuario+']').attr('selected','selected');
				$("#selectactividad_u,#selectusuario_u").selectpicker('refresh');
			}
		});
	}
	function verAjax(val){
     	$.ajax({
			url: '<?php echo URL;?>Cronograma/ver_cronograma/'+val,
			type: 'get',
			success:function(obj){
				var data = JSON.parse(obj);
				$('.unombre h5').text(data.nombre);
				$('.unombre p').text(data.ci);
				$('.uactividad').text(data.actividad);
				$('.uviaje').text(data.tipo_actividad=="local" ? ("Sin Viaje"):("Con Viaje"));
				$('.uciudad').text(data.ciudad=="" ? ("potosí"):(data.ciudad));
				$('.ulugar').text(data.lugar);
				var aux=['departamental','provincial'];
				var u=['Inter-departamental','Inter - Municipal'];
				$('.uestablecimiento').text(data.establecimiento==null ? ("Sin Establecimiento"):(data.establecimiento));
				$('.utipo').text(data.tipo_lugar=="" ? ("Inter - Departamental"):(data.tipo_lugar));
				$('.ufechahasta').text(data.fecha_hasta);
				$('.ufechade').text(data.fecha_de);

			}
		});
	}
	function function_validate(validate){
		if(validate!="false"&&validate=="true"){
			if($('#checkviaje').is(':checked')){
				if($('.fila1').hasClass('has-success')) {
					if ($('.checklugar:checked').val()=="provincial") {
						if ($('#selectmunicipio option:selected').val()!="") {
							if ($('#selectestablecimiento option:selected').val()!="") {
								$("#btnregistrar").attr('disabled', false);
							}else{$("#btnregistrar").attr('disabled', true);}
						}else{$("#btnregistrar").attr('disabled', true);}
					}else{$("#btnregistrar").attr('disabled', false);}
				}else{$("#btnregistrar").attr('disabled', true);}
			}else{
				if($('#checkauditorio').is(':checked')){
					$("#btnregistrar").attr('disabled', false);
				}else{
					if($('.fila1').hasClass('has-success')) {
						$("#btnregistrar").attr('disabled', false);
					}else{
						$("#btnregistrar").attr('disabled', true);
					}
				}
			}
		}else{
			if($('#checkviaje_u').is(':checked')){
				if($('.fila1_u').hasClass('has-success')) {
					if ($('.checklugar_u:checked').val()=="provincial") {
						if ($('#selectmunicipio_u option:selected').val()!="") {
							if ($('#selectestablecimiento_u option:selected').val()!="") {
								$("#buttonupdate").attr('disabled', false);
							}else{$("#buttonupdate").attr('disabled', true);}
						}else{$("#buttonupdate").attr('disabled', true);}
					}else{$("#buttonupdate").attr('disabled', false);}
				}else{$("#buttonupdate").attr('disabled', true);}
			}else{
				if($('#checkauditorio_u').is(':checked')){
					$("#buttonupdate").attr('disabled', false);
				}else{
					if($('.fila1_u').hasClass('has-success')) {
						$("#buttonupdate").attr('disabled', false);
					}else{
						$("#buttonupdate").attr('disabled', true);
					}
				}
			}
		}
	}
</script>
