<?php
	$months=["Enero","Febrero","Marzo", "Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"];
?>
<div class="col-md-12">
		<div class="col-md-10">
			<h2 class="text-center" style="margin:5px 0 10px 0;font-weight:600">PLANIFICADOR GENERAL DE SEDES POTOSÍ</h2>
		</div>
		<div class="col-md-2" style="padding:0">
			<select id="selectactividad" class="form-control selectpicker show-tick" type="<?php echo $resultado['type']?>">
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
    			myObj = { "id":data[i].id, "title":title, "start":data[i].fecha_de,"end":data[i].fecha_hasta,"description": 'Usuario:'+data[i].nombre.toLowerCase(),"color":getRandomColor()};
    			datos.push(myObj);}
		console.log(datos);
    		$('#calendar').fullCalendar({
    			locale: 'es',
    			header: {
    				left: 'prev,next today',
    				center: 'title',
    				right: 'month,basicWeek,basicDay'
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
			    $('#updatecronogramaModal').modal({
				    backdrop: 'static',
				    keyboard: true,
				    show: true
			   });
			   $('#btncambiarfecha').click(function(){
				    var m=parseInt(event.end._d.getMonth())+1,mes_fin= m < 10 ? ("0" + m) : (m);
				    var d=parseInt(event.end._d.getDate()),dia_fin= d < 10 ? ("0" + d) : (d);
				    var fecha_hasta=event.end._d.getFullYear()+"-"+mes_fin+"-"+dia_fin;

				    var m=parseInt(event.start._d.getMonth())+1,mes_inicio= m < 10 ? ("0" + m) : (m);
				    var d=parseInt(event.start._d.getDate()),dia_inicio= d < 10 ? ("0" + d) : (d);
				    var fecha_de=event.start._d.getFullYear()+"-"+mes_inicio+"-"+dia_inicio;
				    updateAjax(event.id,fecha_de,fecha_hasta,true);
			   });
			   $('#btncancelar').click(function(){
				   revertFunc();
				   $('#updatecronogramaModal').modal('toggle');
				   small_error('.fila1',false);$("#btncambiarfecha").attr('disabled', true);
			   })
		   	},
			eventResize: function(event, delta, revertFunc) {
				$('#updatecronogramaModal').modal({
					backdrop: 'static',
                         keyboard: true,
                         show: true
			    });
			    $('#btncambiarfecha').click(function(){
				     var m=parseInt(event.end._d.getMonth())+1,mes_fin= m < 10 ? ("0" + m) : (m);
				     var d=parseInt(event.end._d.getDate()),dia_fin= d < 10 ? ("0" + d) : (d);
				     var fecha_hasta=event.end._d.getFullYear()+"-"+mes_fin+"-"+dia_fin;
					updateAjax(event.id,event.start._i,fecha_hasta,false);
			    });
			    $('#btncancelar').click(function(){
				    revertFunc();
				    $('#updatecronogramaModal').modal('toggle');
				    small_error('.fila1',false);$("#btncambiarfecha").attr('disabled', true);
			    })
			}
    		});

	});
	function updateAjax(id,fecha_de,fecha_hasta,status){
		console.log(id,fecha_de,fecha_hasta);
		$.ajax({
			url: '<?php echo URL;?>Cronograma/editar/'+id,
			type: 'post',
		  data:{descripcion:$("#textareadescripcion").val(),fecha_de:fecha_de,fecha_hasta:fecha_hasta,estado:status},
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
                    console.log(data);

				$('.unombre h5').text(data.nombre);
				$('.unombre p').text(data.ci);
				// $('#unombre').text(data.fecha_hasta);
				// $('#unombre').text(data.fecha_hasta);
				$('.uactividad').text(data.actividad);
				$('.uviaje').text(data.tipo_actividad=="local" ? ("Sin Viaje"):("Con Viaje"));
				$('.uciudad').text(data.ciudad=="" ? ("potosí"):(data.ciudad));
				$('.ulugar').text(data.lugar);
				// $('#uviaje').text(data.fecha_hasta);
				var aux=['departamental','provincial'];
				var u=['Inter-departamental','Inter - Municipal'];
				$('.uestablecimiento').text(data.establecimiento==null ? ("Sin Establecimiento"):(data.establecimiento));
				$('.utipo').text(data.tipo_lugar=="" ? ("Inter - Departamental"):(data.tipo_lugar));
				$('.ufechahasta').text(data.fecha_hasta);
				$('.ufechade').text(data.fecha_de);

			}
		});
	}
	function validarAjax(id){
		swal({
			title: "¿Esta seguro de Consolidar la actividad?",
			text: "Una vez consolidado la actividad usted da el visto bueno de que el personal concluyo con éxito su trabajo!. Asegurese de revisar toda la información",
			type: "warning",
			showCancelButton: true,confirmButtonColor: "#24be66",
			confirmButtonText: "Consolidar Actividad!",
			closeOnConfirm: false
		},function(){
			$.ajax({
				url: '<?php echo URL;?>Planificacion/validar_p/'+id,
				type: 'get',
				success:function(obj){
					console.log(obj);
					if (obj=="false") {
					}else{
						swal("Mensaje de Alerta!", obj , "success");
						setInterval(function(){ location.reload();}, 1000);
					}
				}
			});
		});
	}
</script>
