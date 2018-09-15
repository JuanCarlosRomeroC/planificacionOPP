<?php
	$months=["Enero","Febrero","Marzo", "Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"];
?>
<div class="col-md-12">
	<h2 class="text-center" style="margin:5px 0 10px 0;font-weight:300">LISTA DE PLANIFICACIONES SIN CONSOLIDAR</h2>
</div>
<div class="row" style="margin:0px"> <!-- SECTION TABLE USERS -->
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="col-md-12 tab-content" style="margin:0px">
			<div class="table-responsive">
			<table id="tableplanificacion" class="table table-striped table-condensed table-hover">
				<thead>
					<th width="21%">jefatura</th>
					<th width="21%">unidad</th>
					<th width="15%">nombres</th>
					<th width="25%">actividad</th>
				    <th width="8%">mes</th>
					<th width="10%">Opciones</th>
				</thead>
				<?php $meses= array('ENERO','FEBRERO','MARZO','ABRIL','MAYO','JUNIO','JULIO','AGOSTO','SEPTIEMBRE','OCTUBRE','NOVIEMBRE','DICIEMBRE');?>
				<tbody>
					<?php while($row=mysql_fetch_array($resultado)):?>
						<tr>
							<td style="text-align:left;padding-left:9px;vertical-align:middle"><h5><?php echo ucwords(strtolower($row['jefatura']))?></h5></td>
							<td style="text-align:left;padding-left:9px;vertical-align:middle"><h5><?php echo ucwords(strtolower($row['unidad']))?></h5></td>
							<td style="text-align:left;padding-left:9px;vertical-align:middle"><h5><?php echo ucwords(strtolower($row['nombre']))?></h5></td>
							<td style="vertical-align:middle"><h5><?php echo $row['actividad'];?></h5></td>
							<td style="vertical-align:middle"><h5><?php echo $months[intval(date('m', strtotime($row['fecha_de']))) - 1] ?></h5></td>
                                   <?php $code=base64_encode($row['id']);?>
                                   <td style="vertical-align:middle"><a data-target="#verplanificacionModal" data-toggle="modal" onclick="verAjax(<?php echo $row['id'];?>)"><span class="glyphicon glyphicon-eye-open" title="ver planificación" aria-hidden="true" style="padding:0 5px 0 5px;color:#313131;cursor:pointer"></span></a>
                                   <a  onclick="validarAjax('<?php echo $code?>')" style="cursor:pointer"><span class="glyphicon glyphicon-ok" aria-hidden="true" style="color:#07cb3e" title="Consolidar Planificación"></span></a></td>
							<?php?>
						</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
			</div>
		</div>
	</div>
</div>
<div class="row" id="alert_empty"> <!-- SECTION EMPTY TABLE -->
	<?php if(mysql_num_rows($resultado)<1){ //tabla vacia?>
		<div class="col-md-12"><div class="alert alert-error alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>MENSAJE DE ALERTA!</strong> No se encontraron Planificaciones pendientes.</div></div>
	<?php }else{include 'modalverplanificacion.php';}?>
</div>
<script>
   	var id_actividad_u,id_planificacion_u,auxi=0,auxi2=0,rowobj=0,rowesp=0,validarbag=false,Get_ID;
     $(document).ready(function(){
	     $('#datetimepickermes').datetimepicker({locale: 'es',format: 'YYYY-MM',ignoreReadonly: true,viewMode: 'months'}).on('dp.change', function(e){
		     var placeholder=$('#datetimepickermes input').attr('placeholder'),input=$('#datetimepickermes input').val(),entero=parseInt(e.date._d.getMonth())+1,au= entero < 10 ? ("0" + entero) : (entero);
		     if (placeholder.toString()!=input.toString()) {
                    window.location.href = "/<?php echo FOLDER;?>/Planificacion/ver/<?php echo base64_encode($resultado['titulo']['id'])?>?year="+e.date._d.getFullYear()+"&month="+au;
		     }
	     });
	     $('#inputsearch').keyup(function(){$('#myTabs a[href="#todos"]').tab('show');
		    var data=$(this).val().toLowerCase().trim();SEARCH_DATA(data,"tableplanificacion","No se encontraron Coincidencias.");});
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
