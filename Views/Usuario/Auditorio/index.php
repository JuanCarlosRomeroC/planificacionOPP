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
	var users_array=['Administrador','Director','Planificador','Jefe de Jefatura','Jefe de Unidad','Normal'];
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
					fecha_hasta:$('#fecha_hasta').val(),
					descripcion:$('#inputdescripcion').val()
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
					fecha_hasta:$('#fecha_hasta_u').val(),
					descripcion:$('#inputdescripcion_u').val()
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
    			myObj = { "id":data[i].id,"_id":i,"title":title, "start":data[i].fecha_de,"end":data[i].fecha_hasta,"description": 'USUARIO: '+data[i].nombre.toLowerCase(),"color":getRandomColor()};
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
				}
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
				var old=new Date(event.source.rawEventDefs[event._id].end);
				var CurrentDate = new Date(),GivenDate = new Date(event.end.format());
				if (GivenDate>CurrentDate &&  old >= CurrentDate) {
					updateAjax(event.id,event.start.format(),event.end.format());
				     $('#updatecronogramaModal').modal({
					     backdrop: 'static',
					     keyboard: true,
					     show: true
				     });
				}else{
					revertFunc();
				}
				$('#btncancelar').click(function(){
					revertFunc();
				})
		   	},
			eventResize: function(event, delta, revertFunc) {
				var old=new Date(event.source.rawEventDefs[event._id].end);
				var CurrentDate = new Date(),GivenDate = new Date(event.end.format());
				if (GivenDate>CurrentDate &&  old >= CurrentDate) {
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
				$('#inputdescripcion_u').val(data.descripcion);
			}
		});
	}
	function verAjax(val){
     	$.ajax({
			url: '<?php echo URL;?>Cronograma/ver_cronograma/'+val,
			type: 'get',
			success:function(obj){
				var data = JSON.parse(obj);
				console.log(data);
				$('.unombre h5').text(data.nombre);
				$('.unombre h6').text(users_array[data.tipo]);
				$('.unombre p').text(data.ci);
				$('.uactividad').text("ACTIVIDAD: "+data.actividad.toLowerCase());
				$('.ufechahasta').text(data.fecha_hasta);
				$('.ufechade').text(data.fecha_de);
				$('.vdescripcion span').text(data.descripcion!=null?(data.descripcion):("La descripción no fue detallada"));
			}
		});
	}
	function bajaAjax(){
		swal({
			title: "¿Estás seguro?",
			text: "Esta Seguro que quiere eliminar esta actividad del Auditorio?",
			type: "warning",
			showCancelButton: true,confirmButtonColor: "#d93333",
			confirmButtonText: "Eliminar Actividad!",
			closeOnConfirm: false
		},function(){
			$.ajax({
				url: '<?php echo URL;?>Auditorio/eliminar_actividad/'+Get_ID,
				type: 'get',
				success:function(obj){
					if (obj=="false") {
					}else{
						swal("Mensaje de Alerta!", obj , "success");
						setInterval(function(){ location.reload() }, 1000);
					}
				}
			});
		});
	}
</script>
