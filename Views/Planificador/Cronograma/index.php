<?php
	$months=["Enero","Febrero","Marzo", "Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"];
?>
<div class="fab" id="btnprint"><span class="glyphicon glyphicon-save" aria-hidden="true" style="font-size:.7em;margin-left: 3px;"></span></div>
<div class="col-md-12">
		<div class="col-md-10">
			<h2 class="text-center" style="margin:5px 0 10px 0;font-weight:600">PLANIFICADOR GENERAL DE SEDES POTOSÍ</h2>
		</div>
		<div class="col-md-2" style="padding:0">
			<select id="selectactividad" class="form-control selectpicker show-tick" type="<?php echo $resultado['type']?>">
				<option value="0">Viajes</option>
				<option value="all">Todos</option>
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
	<?php }else{include 'modalverplanificacion.php';include 'modalupdatecronograma.php';}?>
</div>
<style>
	table thead tr {background: none;}table>thead>tr>th {color: #827a90;font-weight: 600;}
</style>
<script>
   	var id_actividad_u,id_planificacion_u,auxi=0,auxi2=0,rowobj=0,rowesp=0,validarbag=false,Get_ID;
	var users_array=['Administrador','Director','Planificador','Jefe de Jefatura','Jefe de Unidad','Normal'];
	var citys={['potosi']:"Potosí",['lapaz']:"La Paz",['cochabamba']:"Cochabamba",['santacruz']:"Santa Cruz",['tarija']:"Tarija",['chuquisaca']:"Chuquisaca",['oruro']:"Oruro",['beni']:"Beni",['pando']:"Pando"};

     $(document).ready(function(){
		$('#textareadescripcion').keyup(function(){if($(this).val().trim().length>8){small_error('.fila1',true);$("#btncambiarfecha").attr('disabled', false);}else{small_error('.fila1',false);$("#btncambiarfecha").attr('disabled', true);}});

		$('#selectactividad').change(function(){window.location.href = "/<?php echo FOLDER;?>/Cronograma?type="+ $('#selectactividad').val();});
		$('#selectactividad option[value='+$("#selectactividad").attr("type")+']').attr('selected','selected');
	     $('#inputsearch').keyup(function(){$('#myTabs a[href="#todos"]').tab('show');
		    var data=$(this).val().toLowerCase().trim();SEARCH_DATA(data,"tableplanificacion","No se encontraron Coincidencias.");});
		function getRandomColor() {var letters = '0123456789ABCDEF'.split(''),color = '#';for (var i = 0; i < 6; i++ ) {color += letters[Math.floor(Math.random() * 16)];}return color;} //random color
    		var datos = [],data = <?php echo json_encode($resultado['planificacion'])?>;
    		for (var i = 0; i < data.length; i++) {
			var viaje= data[i].tipo_actividad=="viaje" ? (" (con viaje)") : (" (sin viaje)");
			var title=data[i].actividad.toUpperCase()+viaje;
    			myObj = { "id":data[i].id,"_id":i, "title":title, "start":data[i].fecha_de,"end":data[i].fecha_hasta,"description": 'Usuario:'+data[i].nombre.toLowerCase(),"color":getRandomColor()};
    			datos.push(myObj);}
    		$('#calendar').fullCalendar({
    			locale: 'es',
    			header: {
    				left: 'prev,next today',
    				center: 'title',
    				right: 'month, agendaWeek, agendaDay'
    			},
    			defaultDate: '<?php echo date('Y-m-d')?>',
    			navLinks: true,
    			eventLimit: true,
    			events: datos,
			resizable: true,
			editable:true,
			timeFormat: 'H(:mm)',
    			eventRender: function(event, element) {
    	            element.find('.fc-title').append("<br/>" + event.description);
		  	},
			eventClick: function(calEvent) {
				verAjax(calEvent.id);
			    $('#verplanificacionModal').modal('show');
		     },
		    eventDrop: function(event, delta, revertFunc) {
			    var old=new Date(event.source.rawEventDefs[event._id].end);
			    var CurrentDate = new Date(),GivenDate = new Date(event.end.format());
			    if (GivenDate>CurrentDate &&  old >= CurrentDate) {
				     $('#updatecronogramaModal').modal({
					    backdrop: 'static',
					    keyboard: true,
					    show: true
	 		    		});
				}else{
					revertFunc();
				}
				$('#btncambiarfecha').click(function(){
					updateAjax(event.id,event.start.format(),event.end.format());
				});
				$('#btncancelar').click(function(){
				   revertFunc();
				   small_error('.fila1',false);$("#btncambiarfecha").attr('disabled', true);
				})
		   	},
			eventResize: function(event, delta, revertFunc) {
				var old=new Date(event.source.rawEventDefs[event._id].end);
 			     var CurrentDate = new Date(),GivenDate = new Date(event.end.format());
 			     if (GivenDate>CurrentDate &&  old >= CurrentDate) {
					$('#updatecronogramaModal').modal({
						backdrop: 'static',
	                         keyboard: true,
	                         show: true
				     });
		    		}else{
			    		revertFunc();
		    		}
				$('#btncambiarfecha').click(function(){
					updateAjax(event.id,event.start.format(),event.end.format());
				});
				$('#btncancelar').click(function(){
				    revertFunc();
				    small_error('.fila1',false);$("#btncambiarfecha").attr('disabled', true);
				})
			},
			viewRender: function( view, element ){
				date_start=view.intervalStart.format();
				var d=parseInt(view.intervalEnd._d.getDate()),m=parseInt(view.intervalEnd._d.getMonth())+1;
				var aux=d<10?("0"+d):(d);
				var aux2=m<10?("0"+m):(m);
				date_end=view.intervalEnd._d.getFullYear()+"-"+aux2+"-"+aux;
				$('#btnprint').click(function(){
					window.open("/<?php echo FOLDER;?>/Cronograma/printpdf/"+$('#selectactividad').val()+"?de="+date_start+"&hasta="+date_end, '_blank');
				});
			}
		});

	});
	function updateAjax(id,fecha_de,fecha_hasta){
		$.ajax({
			url: '<?php echo URL;?>Cronograma/editar/'+id,
			type: 'post',
		  data:{descripcion:$("#textareadescripcion").val(),fecha_de:fecha_de,fecha_hasta:fecha_hasta},
			success:function(obj){
				$('#updatecronogramaModal').modal('toggle');
				small_error('.fila1',false);$("#btncambiarfecha").attr('disabled', true);
				swal("Mensaje de Alerta!", obj , "success");
				setInterval(function(){ location.reload();}, 1000);
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
				$('.uciudad').text("CIUDAD: "+citys[data.ciudad]);
				var aux={['departamental']:"Inter-Departamental",['provincial']:"Inter - Municipal"};
				$('.uestablecimiento').text(data.establecimiento==null ? ("Sin Establecimiento"):(data.establecimiento.toLowerCase()));
				$('.utipo').text(aux[data.tipo_lugar]);
				var lugar="";
				if (data.lugar!=null && data.lugar!="") {
					lugar=data.lugar.toLowerCase();
				}else{
					if (data.redsalud!=null) {
						lugar=data.redsalud.toLowerCase();
						if (data.municipio!=null) {
							lugar=data.municipio.toLowerCase();
						}
					}
				}
				$('.ulugar').text(lugar);
				$('.ufechahasta').text(data.fecha_hasta);
				$('.ufechade').text(data.fecha_de);
			}
		});
	}
</script>
