<?php
	$users=['Administrador','Director','Planificador','Jefe de Jefatura','Jefe de Unidad','Normal'];
	$months=["Enero","Febrero","Marzo", "Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"];
	$mes=$months[intval($resultado['month']) - 1];
	$get_presentado="";
?>
<div class="col-md-12">
	<div class="col-md-9">
		<h2 class="text-center" style="margin:5px 0 10px 0;font-weight:600">LISTA DE PLANIFICACIONES <small>(<?php echo $mes."-".$resultado['year'];?>)</small> </h2>
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
				    <th width="12%">estado</th>
                        <th width="10%">consolidado</th>
					<th width="10%">Opciones</th>
				</thead>
				<?php $aux=1; $meses= array('ENERO','FEBRERO','MARZO','ABRIL','MAYO','JUNIO','JULIO','AGOSTO','SEPTIEMBRE','OCTUBRE','NOVIEMBRE','DICIEMBRE');?>
				<tbody>
					<?php while($row=mysql_fetch_array($resultado['planificacion'])):?>
						<tr>
							<td style="vertical-align:middle"><h5><?php echo $aux;?></h5></td>
							<td><h5><?php echo $row['actividad'];?></h5></td>
							<td style="vertical-align:middle"><h5> <?php echo $row['estado']==0 ? 'Sin Completar' : 'Completado'?></h5></td>
						    <?php
                                 	if($row['estado']==1){
                                        if($row['vista_unidad']==1){?>
                                             <td><h5>Consolidado <span class="glyphicon glyphicon-ok" aria-hidden="true" style="color:#00cd40"></span></h5></td>
                                             <td style="vertical-align:middle"><a data-target="#verplanificacionModal" data-toggle="modal" onclick="verAjax(<?php echo $row['id'];?>)"><span class="glyphicon glyphicon-eye-open" title="ver planificación" aria-hidden="true" style="padding:0 5px 0 5px;color:#313131;cursor:pointer"></span></a></td>
                                        <?php }else{ $code=base64_encode($row['id']);?>
                                             <td><h5>Sin Consolidar <span class="glyphicon glyphicon-remove" aria-hidden="true" style="color:#ee0000"></span></h5></td>
                                             <td style="vertical-align:middle"><a data-target="#verplanificacionModal" data-toggle="modal" onclick="verAjax(<?php echo $row['id'];?>)"><span class="glyphicon glyphicon-eye-open" title="ver planificación" aria-hidden="true" style="padding:0 5px 0 5px;color:#313131;cursor:pointer"></span></a>
                                             <a  onclick="validarAjax('<?php echo $code?>')" style="cursor:pointer"><span class="glyphicon glyphicon-ok" aria-hidden="true" style="color:#07cb3e" title="Consolidar Planificación"></span></a></td>
                                        <?php } ?>
							<?php }else{?>
                                        <td><h5>Sin Consolidar <span class="glyphicon glyphicon-remove" aria-hidden="true" style="color:#ee0000"></span></h5></td>
                                        <td style="vertical-align:middle"><a data-target="#verplanificacionModal" data-toggle="modal" onclick="verAjax(<?php echo $row['id'];?>)"><span class="glyphicon glyphicon-eye-open" title="ver planificación" aria-hidden="true" style="padding:0 5px 0 5px;color:#313131;cursor:pointer"></span></a></td>
							<?php };$aux++;?>
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
	<?php }else{ include 'modalverplanificacion.php';?>
		<a href="/<?php echo FOLDER;?>/Planificacion/print_un_informe/<?php echo base64_encode($resultado['titulo']['id'])."?date=".$resultado['year'].$resultado['month']?>" target="_blank"><div class="fab" style="background:#f21d1d"><span class="glyphicon glyphicon-print" style="font-size:.7em" aria-hidden="true"></span></div></a>
     <?php }?>
</div>
<?php include 'modalverpoai.php'; ?>
<center><a data-target="#verpoaiModal" data-toggle="modal"><button type="button" class="btn btn-info" name="button">VER POAI</button> </a></center>
<style>span#procent {position: absolute;left: 50%;top: 50%;font-size: 50px;transform: translate(-50%, -50%);color: #fff;font-weight: 200}span#procent::after {content: '%';}.canvas-wrap {position: relative;width: 300px;height: 300px;}</style>
<script>
   	var id_actividad_u,id_planificacion_u,auxi=0,auxi2=0,rowobj=0,rowesp=0,validarbag=false,Get_ID;
     $(document).ready(function(){
	    $('#datetimepickermes').datetimepicker({locale: 'es',format: 'YYYY-MM',ignoreReadonly: true,viewMode: 'months'}).on('dp.change', function(e){
		    var placeholder=$('#datetimepickermes input').attr('placeholder'),input=$('#datetimepickermes input').val(),entero=parseInt(e.date._d.getMonth())+1,au= entero < 10 ? ("0" + entero) : (entero);
		    if (placeholder.toString()!=input.toString()) {
                   window.location.href = "/<?php echo FOLDER;?>/Planificacion/listar_unusuario/<?php echo base64_encode($resultado['titulo']['id'])?>?year="+e.date._d.getFullYear()+"&month="+au;
		    }
	    });
	    //____________DIBUJAR AVANCE DE ACTIVIDAD
	    var DomainName = <?php echo json_encode($resultado['actividades']) ?>,media= 100 / DomainName.length,progress=0;
	    for (var i = 0; i < DomainName.length; i++) {if (DomainName[i].estado==1) {progress=progress+media;}else{progress=progress+parseInt(DomainName[i].total);}}

	    var can = document.getElementById('canvas'),spanProcent = document.getElementById('procent'),c = can.getContext('2d');var posX = can.width / 2,posY = can.height / 2,fps = 1000 / 200,procent = 0,oneProcent = 360 / 100,result = oneProcent * progress;c.lineCap = 'round';arcMove();
	    function arcMove(){var deegres = 0;var acrInterval = setInterval (function() {deegres += 1;c.clearRect( 0, 0, can.width, can.height );procent = deegres / oneProcent;spanProcent.innerHTML = procent.toFixed(); c.beginPath();c.arc( posX, posY, 70, (Math.PI/180) * 270, (Math.PI/180) * (270 + 360) );c.strokeStyle = '#d4a769';c.lineWidth = '10';c.stroke();c.beginPath();c.strokeStyle = '#ffdfb4';c.lineWidth = '10';c.arc( posX, posY, 70, (Math.PI/180) * 270, (Math.PI/180) * (270 + deegres) );c.stroke();if( deegres >= result ) clearInterval(acrInterval);}, fps);}

	    $('#inputsearch').keyup(function(){$('#myTabs a[href="#todos"]').tab('show');
		    var data=$(this).val().toLowerCase().trim();SEARCH_DATA(data,"tableplanificacion","No se encontraron Coincidencias.");});

	});

	function verAjax(val){
     	$.ajax({
			url: '<?php echo URL;?>Planificacion/ver/'+val,
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
				$('.vvista_unidad').text(aux[data.vista_unidad]);
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
				url: '<?php echo URL;?>Planificacion/validar_u/'+id,
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
