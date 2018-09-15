<?php
	$months=["Enero","Febrero","Marzo", "Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"];
?>
<div class="col-md-12">

		<div class="col-md-10">
			<h2 class="text-center" style="margin:5px 0 10px 0;font-weight:600">CRONOGRAMA DE OTRAS ACTIVIDADES</h2>
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
	<?php }else{include 'modalverplanificacion.php';}?>
</div>
<style>
	table thead tr {background: none;}table>thead>tr>th {color: #827a90;font-weight: 600;}
</style>
<script>
   	var id_actividad_u,id_planificacion_u,auxi=0,auxi2=0,rowobj=0,rowesp=0,validarbag=false,Get_ID;
     $(document).ready(function(){
	     $('#selectactividad').change(function(){window.location.href = "/<?php echo FOLDER;?>/Cronograma?type="+ $('#selectactividad').val();});
		$('#selectactividad option[value='+$("#selectactividad").attr("type")+']').attr('selected','selected');
	     $('#inputsearch').keyup(function(){$('#myTabs a[href="#todos"]').tab('show');
		    var data=$(this).val().toLowerCase().trim();SEARCH_DATA(data,"tableplanificacion","No se encontraron Coincidencias.");});
		function getRandomColor() {var letters = '0123456789ABCDEF'.split(''),color = '#';for (var i = 0; i < 6; i++ ) {color += letters[Math.floor(Math.random() * 16)];}return color;} //random color
    		var datos = [],data = <?php echo json_encode($resultado['planificacion'])?>;
    		for (var i = 0; i < data.length; i++) {
    			myObj = { "id":data[i].id, "title":data[i].actividad.toUpperCase(), "start":data[i].fecha_de,"end":data.fecha_hasta,"description": 'lugar:'+data[i].nombre.toLowerCase(),"color":getRandomColor()};
    			datos.push(myObj);console.log("desdedata",datos);}

    		$('#calendar').fullCalendar({
    			locale: 'es',
    			header: {
    				left: 'prev,next today',
    				center: 'title',
    				right: 'month,basicWeek,basicDay',
				today:    'Hoy',
				month:    'Mes'
    			},
    			defaultDate: '2018-09-12',
    			navLinks: true, // can click day/week names to navigate views
    			editable: false,
    			eventLimit: true, // allow "more" link when too many events
    			events: datos,
    			eventRender: function(event, element) {
    	            element.find('.fc-title').append("<br/>" + event.description);
		  	},
			eventClick: function(calEvent) {
			    $('#verplanificacionModal').modal('show')
			}
    		});
	});

	function verAjax(val){
     	$.ajax({
			url: '<?php echo URL;?>Planificacion/ver_planificacion/'+val,
			type: 'get',
			success:function(obj){
				var data = JSON.parse(obj);
                    console.log(data);
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
			    var aux = ["Sin Consolidar" , "Consolidado"];
			     $('.vactividad').text(data.actividad);
				$('.vfecha_de').text(data.fecha_de);
				$('.vfecha_hasta').text(data.fecha_hasta);
				$('.vnombre').text(data.nombre.toLowerCase()+" "+data.apellido.toLowerCase());
                    $('.vci').text(data.ci);
				$('.vvista_planificador').text(aux[data.vista_planificador]);
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
