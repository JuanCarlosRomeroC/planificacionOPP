<?php
	$months=["Enero","Febrero","Marzo", "Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"];
?>
<div class="fab" id="btnprint"><span class="glyphicon glyphicon-save" aria-hidden="true" style="font-size:.7em;margin-left: 3px;"></span></div>
<div class="col-md-12">
	<h2 class="text-center" style="margin:5px 0 10px 0;font-weight:700">AGENDA ELECTRÓNICA DEL DIRECTOR DE SEDES</h2>
</div>
<div class="row" style="margin:0px"> <!-- SECTION CALENDARIO -->
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div id='calendar'></div>
	</div>
</div>
<div class="row" id="alert_empty"> <!-- SECTION EMPTY TABLE -->
	<?php if(count($resultado['planificacion'])<1){ //tabla vacia?>
		<div class="col-md-12"><div class="alert alert-error alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>MENSAJE DE ALERTA!</strong> No se encontraron Planificaciones pendientes.</div></div>
	<?php }else{include 'modalveragenda.php';}?>
</div>
<style>
	table thead tr {background: none;}table>thead>tr>th {color: #827a90;font-weight: 600;}
</style>
<script>
	var typemodal="",Get_ID,date_start,date_end;
     $(document).ready(function(){
		function getRandomColor() {var letters = '0123456789ABCDEF'.split(''),color = '#';for (var i = 0; i < 6; i++ ) {color += letters[Math.floor(Math.random() * 16)];}return color;} //random color
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
			timeFormat: 'H(:mm)',
    			eventRender: function(event, element) {
    	            element.find('.fc-title').append("<br/>" + event.description);
		  	},
			eventClick: function(event) {
				$('#veragendaModal').modal('show');
				verAjax(event.id);
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
	function verAjax(val){
     	$.ajax({
			url: '<?php echo URL;?>Agenda/ver_agenda/'+val,
			type: 'get',
			success:function(obj){
				var data = JSON.parse(obj);
				console.log(data);
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
</script>
