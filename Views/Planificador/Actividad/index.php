<div class="fab" data-target="#newactividadModal" data-toggle="modal"> + </div>
<div class="row"><h2 class="text-center" style="margin:20px 0 1px 0;font-weight:300">LISTA DE ACTIVIDADES</h2></div>

<div class="row" style="margin:10px"> <!-- SECTION TABLE USERS -->
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="col-md-12">
	          <ul class="nav nav-tabs nav-justified" id="myTabs">
	               <li role="presentation" class="active"><a href="#todos" aria-controls="todos" role="tab" data-toggle="tab">ASIGNADOS<span class="badge" style="background:<?php echo COLOR;?>;margin-left:10px;color:#fff"><?php echo count($resultado["actividades"]);?></span></a></li>
				<li role="presentation"><a href="#sinjefatura" aria-controls="sinjefatura" role="tab" data-toggle="tab">SIN JEFATURA<span class="badge" style="background:<?php echo COLOR;?>;margin-left:10px"><?php echo mysql_num_rows($resultado["sinjefatura"]);?></span></a></li>
				 <li role="presentation"><a href="#sinunidad" aria-controls="sinunidad" role="tab" data-toggle="tab">SIN UNIDAD<span class="badge" style="background:<?php echo COLOR;?>;margin-left:10px"><?php echo mysql_num_rows($resultado["sinunidad"]);?></span></a></li>
				<li role="presentation"><a href="#baja" aria-controls="baja" role="tab" data-toggle="tab">BAJAS<span class="badge" style="background:<?php echo COLOR;?>;margin-left:10px"><?php echo mysql_num_rows($resultado["bajas"]);?></span></a></li>
	          </ul>
	     </div>
		<div class="col-md-12 tab-content" style="margin:0px">
	          <div id="todos" role="tabpanel" class="tab-pane active">
				<div class="table-responsive">
					<table id="tablejefaturas" class="table table-striped table-condensed table-hover">
						<thead>
							<th width="5%">n°</th>
							<th width="30%">nombre de la actividad</th>
							<th width="30%">jefatura</th>
							<th width="27%">unidad</th>
							<th width="8%">ops</th>
						</thead>
						<?php $aux=1; ?>
						<tbody>
							<?php for($i=0;$i<count($resultado["actividades"]);$i++): ?>
								<tr>
									<td><h5><?php echo $aux;?></h5></td>
									<td style="text-align:left;padding-left:9px;vertical-align:inherit"><h5 style="text-align:left"><?php echo ucwords(strtolower($resultado["actividades"][$i]['nombre'])); ?></h5></td>
									<td style="text-align:left;padding-left:9px;vertical-align:inherit"><h5 style="text-align:left"><?php echo $resultado["actividades"][$i]['jefatura']==null ? "Sin Jefatura Asingnada" : ucwords(strtolower($resultado["actividades"][$i]['jefatura'])); ?></h5></td>
									<td style="text-align:left;padding-left:9px;vertical-align:inherit"><h5 style="text-align:left"><?php echo $resultado["actividades"][$i]['unidad']==null ? "Sin Unidad Asingnada" : ucwords(strtolower($resultado["actividades"][$i]['unidad'])); ?></h5></td>
									<td style="vertical-align:inherit">
										<a data-target="#updateactividadModal" data-toggle="modal" onclick="updateAjax(<?php echo $resultado["actividades"][$i]['id'];?>)"><span title="editar actividad"  class="glyphicon glyphicon-pencil" aria-hidden="true" style="cursor:pointer;margin:0 2px 0 2px"></span></a>
										<a  onclick="verAjax(<?php echo $resultado["actividades"][$i]['id'];?>)"><span title="ver actividad" class="glyphicon glyphicon-eye-open" aria-hidden="true" style="cursor:pointer;color:#313131;margin:0 2px 0 2px"></span></a>
										<?php if ($resultado["actividades"][$i]['total']<1) {?>
											<a  onclick="bajaAjax(<?php echo $resultado["actividades"][$i]['id'];?>)"><span title="dar de baja actividad" class="glyphicon glyphicon-remove" aria-hidden="true" style="cursor:pointer;color:red;margin:0 2px 0 2px"></span></a>
										<?php } ?>

									</td>
									<?php $aux++; ?>
								</tr>
							<?php endfor; ?>
						</tbody>
					</table>
				</div>
				<div class="row" id="alert_empty"> <!-- SECTION EMPTY TABLE -->
					<?php if(count($resultado["actividades"])<1):?>
						<div class="col-md-12">
							<div class="alert alert-error alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<strong>MENSAJE DE ALERTA!</strong> No se encontraron USUARIOS registrados.
							</div>
						</div>
					<?php endif;?>
				</div>
			</div>
	          <div id="sinjefatura" role="tabpanel" class="tab-pane">
				<div class="table-responsive">
					<table class="table table-striped table-condensed table-hover">
						<thead>
							<th width="5%">n°</th>
							<th width="30%">nombre de la actividad</th>
							<th width="30%">jefatura</th>
							<th width="27%">unidad</th>
							<th width="8%">Ops</th>
						</thead>
						<?php $aux=1; ?>
						<tbody>
							<?php while($row=mysql_fetch_array($resultado["sinjefatura"])): ?>
								<tr>
									<td><h5><?php echo $aux;?></h5></td>
									<td style="text-align:left;padding-left:9px;vertical-align:inherit"><h5 style="text-align:left"><?php echo ucwords(strtolower($row['nombre'])); ?></h5></td>
									<td style="text-align:left;padding-left:9px;vertical-align:inherit"><h5 style="text-align:left"><?php echo $row['jefatura']==null ? "Sin Jefatura Asingnada" : ucwords(strtolower($row['jefatura'])); ?></h5></td>
									<td style="text-align:left;padding-left:9px;vertical-align:inherit"><h5 style="text-align:left"><?php echo $row['unidad']==null ? "Sin Unidad Asingnada" : ucwords(strtolower($row['unidad'])); ?></h5></td>
									<td>
										<a data-target="#updateactividadModal" data-toggle="modal" onclick="updateAjax(<?php echo $row['id'];?>)"><span title="editar actividad"  class="glyphicon glyphicon-pencil" aria-hidden="true" style="cursor:pointer;margin:0 2px 0 2px"></span></a>
										<a  onclick="bajaAjax(<?php echo $row['id'];?>)"><span title="dar de baja actividad" class="glyphicon glyphicon-remove" aria-hidden="true" style="cursor:pointer;color:red;margin:0 2px 0 2px"></span></a>
									</td>
									<?php $aux++; ?>
								</tr>
							<?php endwhile; ?>
						</tbody>
					</table>
				</div>
				<div class="row"> <!-- SECTION EMPTY TABLE -->
					<?php if(mysql_num_rows($resultado["sinjefatura"])<1):?>
						<div class="col-md-12">
							<div class="alert alert-error alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<strong>MENSAJE DE ALERTA!</strong> No se encontro personas de ADMINISTRACION registrados.
							</div>
						</div>
					<?php endif;?>
				</div>
			</div>
	          <div id="sinunidad" role="tabpanel" class="tab-pane">
				<div class="table-responsive">
					<table class="table table-striped table-condensed table-hover">
						<thead>
							<th width="5%">n°</th>
							<th width="30%">nombre de la actividad</th>
							<th width="30%">jefatura</th>
							<th width="27%">unidad</th>
							<th width="8%">Ops</th>
						</thead>
						<?php $aux=1; ?>
						<tbody>
							<?php while($row=mysql_fetch_array($resultado["sinunidad"])): ?>
								<tr>
									<td><h5><?php echo $aux;?></h5></td>
									<td style="text-align:left;padding-left:9px;vertical-align:inherit"><h5 style="text-align:left"><?php echo ucwords(strtolower($row['nombre'])); ?></h5></td>
									<td style="text-align:left;padding-left:9px;vertical-align:inherit"><h5 style="text-align:left"><?php echo $row['jefatura']==null ? "Sin Jefatura Asingnada" : ucwords(strtolower($row['jefatura'])); ?></h5></td>
									<td style="text-align:left;padding-left:9px;vertical-align:inherit"><h5 style="text-align:left"><?php echo $row['unidad']==null ? "Sin Unidad Asingnada" : ucwords(strtolower($row['unidad'])); ?></h5></td>
									<td>
										<a data-target="#updateactividadModal" data-toggle="modal" onclick="updateAjax(<?php echo $row['id'];?>)"><span title="editar actividad"  class="glyphicon glyphicon-pencil" aria-hidden="true" style="cursor:pointer;margin:0 2px 0 2px"></span></a>
										<a  onclick="bajaAjax(<?php echo $row['id'];?>)"><span title="dar de baja actividad" class="glyphicon glyphicon-remove" aria-hidden="true" style="cursor:pointer;color:red;margin:0 2px 0 2px"></span></a>
									</td>
									<?php $aux++; ?>
								</tr>
							<?php endwhile; ?>
						</tbody>
					</table>
				</div>
				<div class="row"> <!-- SECTION EMPTY TABLE -->
					<?php if(mysql_num_rows($resultado["sinunidad"])<1):?>
						<div class="col-md-12">
							<div class="alert alert-error alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<strong>MENSAJE DE ALERTA!</strong> No se encontraron Actividades dados de BAJA.
							</div>
						</div>
					<?php endif;?>
				</div>
			</div>
			<div id="baja" role="tabpanel" class="tab-pane">
				<div class="table-responsive">
					<table class="table table-striped table-condensed table-hover">
						<thead>
							<th width="5%">n°</th>
							<th width="30%">nombre de la actividad</th>
							<th width="30%">jefatura</th>
							<th width="27%">unidad</th>
							<th width="8%">Ops</th>
						</thead>
						<?php $aux=1; ?>
						<tbody>
							<?php while($row=mysql_fetch_array($resultado["bajas"])): ?>
								<tr>
									<td><h5><?php echo $aux;?></h5></td>
									<td style="text-align:left;padding-left:9px;vertical-align:inherit"><h5 style="text-align:left"><?php echo ucwords(strtolower($row['nombre'])); ?></h5></td>
									<td style="text-align:left;padding-left:9px;vertical-align:inherit"><h5 style="text-align:left"><?php echo $row['jefatura']==null ? "Sin Jefatura Asingnada" : ucwords(strtolower($row['jefatura'])); ?></h5></td>
									<td style="text-align:left;padding-left:9px;vertical-align:inherit"><h5 style="text-align:left"><?php echo $row['unidad']==null ? "Sin Unidad Asingnada" : ucwords(strtolower($row['unidad'])); ?></h5></td>
									<td>
										<a data-target="#updateactividadModal" data-toggle="modal" onclick="updateAjax(<?php echo $row['id'];?>)"><span title="editar actividad"  class="glyphicon glyphicon-pencil" aria-hidden="true" style="cursor:pointer;margin:0 2px 0 2px"></span></a>
										<a  onclick="altaAjax(<?php echo $row['id'];?>)"><button title="dar de alta la actividad" type="button" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></button></a>
									</td>
									<?php $aux++; ?>
								</tr>
							<?php endwhile; ?>
						</tbody>
					</table>
				</div>
				<div class="row"> <!-- SECTION EMPTY TABLE -->
					<?php if(mysql_num_rows($resultado["bajas"])<1):?>
						<div class="col-md-12">
							<div class="alert alert-error alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<strong>MENSAJE DE ALERTA!</strong> No se encontraron Actividades dados de BAJA.
							</div>
						</div>
					<?php endif;?>
				</div>
			</div>
	</div>
</div>

<?php 	include 'modalnewactividad.php';
		include 'modalupdateactividad.php';?>
<script>
	var id_jefatura_u,id_actividad_u,id_unidad_u;
    $(document).ready(function(){
		seleccionarLugar("selectjefatura","selectunidad");
	   	$('#selectjefatura').change(function(){seleccionarLugar("selectjefatura","selectunidad");});
		$('#selectjefatura_u').change(function(){seleccionarLugar("selectjefatura_u","selectunidad_u");function_validate("false");});
		$('#selectunidad_u').change(function(){function_validate("false");});

		$('#inputsearch').keyup(function(){
			var data=$(this).val().toLowerCase().trim();
			SEARCH_DATA(data,"tablejefaturas","No se encontraron coincidencias.");
		});
		$('#inputnombre,#inputnombre_u').keypress(function(e){
			fraces_text(e);}).keyup(function(){
				if($(this).val().trim().length>5){
					small_error($(this).attr('toggle'),true);
				}else{
					small_error($(this).attr('toggle'),false);
				}
					function_validate($(this).attr('validate'));
				});

		$('#btnregistrar').click(function(){
			$.ajax({
				url: '<?php echo URL;?>Actividad/crear',
				type: 'post',
				data:{nombre:$('#inputnombre').val(),
					id_jefatura:$('#selectjefatura option:selected').val(),
					id_unidad:$('#selectunidad option:selected').val()
				},
				success:function(obj){if (obj=="false") {$('#error_registro').show();}else{
					swal("Mensaje de Alerta!", obj , "success");
					setInterval(function(){ location.reload(); }, 1000);
				}}});});
		function function_validate(validate){
			if(validate!="false"&&validate=="true"){
				if($('.fila1').hasClass('has-success')){
						$("#btnregistrar").attr('disabled', false);}else{$("#btnregistrar").attr('disabled', true);}
			}else{
				if($('.fila1_u').hasClass('has-success')){
					if(($('#inputnombre_u').attr('placeholder')!=$('#inputnombre_u').val().trim().toLowerCase()) ||
						($('#selectjefatura_u option:selected').attr('value')!=id_jefatura_u) ||
						($('#selectunidad_u option:selected').attr('value')!=id_unidad_u)
					){
						$("#buttonupdate").attr('disabled', false);
					}else{$("#buttonupdate").attr('disabled', true);}
				}else{$("#buttonupdate").attr('disabled', true);}
			}
		}
		//UPDATE jefatura
		$('#buttonupdate').click(function(){
			var name="";
			if($('#inputnombre_u').attr('placeholder')!=$('#inputnombre_u').val().trim().toLowerCase()){
				name=$('#inputnombre_u').val().trim();
			}
			$.ajax({
				url: '<?php echo URL;?>Actividad/editar/'+id_actividad_u,
				type: 'post',
				data:{nombre:name,
					id_jefatura:$('#selectjefatura_u option:selected').val(),
					id_unidad:$('#selectunidad_u option:selected').val()
				},
				success:function(obj){if (obj=="false") {$('#error_update').show();}else{
					swal("Mensaje de Alerta!", obj , "success");
					setInterval(function(){ location.reload(); }, 1500);
					}
				}
			});
		});
		$('#selectjefatura_u').change(function(){function_validate("false");});
	});
	function updateAjax(val){
		$("#buttonupdate").attr('disabled', true);small_error(".fila1_u",true);
		$('.inputrow1_u').show();
		$.ajax({
			url: '<?php echo URL;?>Actividad/ver/'+val,
			type: 'get',
			success:function(obj){
				var data = JSON.parse(obj);
				console.log(data);
				$('.unombre h5').text(data.nombre);$('.unombre p').text(data.estado==1 ? ("Activo"):("Inactivo"));$('.uunidad').text(data.unidad==null ? ("No Asignado"):(data.unidad));$('.ujefatura').text(data.jefatura==null ? ("No Asignado"):(data.jefatura));
				$('#inputnombre_u').val(data.nombre.toLowerCase());
				$('#inputnombre_u').attr('placeholder',data.nombre.toLowerCase());
				$('#selectjefatura_u option[value='+data.id_jefatura+']').attr('selected','selected');
				id_jefatura_u=data.id_jefatura;id_actividad_u=data.id;id_unidad_u=data.id_unidad;
				if (data.planificacion_anual>0) {
					$('.inputrow1_u').hide();
				}
				$("#selectunidad_u option").hide();$("#selectunidad_u option[jefatura="+id_jefatura_u+"]").show();
				$('#selectunidad_u option[value='+id_unidad_u+']').attr('selected','selected');
				$("#selectunidad_u,#selectjefatura_u").selectpicker('refresh');
			}
		});
	}
	function bajaAjax(val){
		swal({
			title: "¿Estás seguro?",
			text: "Esta Seguro que quiere dar de baja a la Actividad?",
			type: "warning",
			showCancelButton: true,confirmButtonColor: "#d93333",
			confirmButtonText: "Dar de Baja!",
			closeOnConfirm: false
		},function(){
			$.ajax({
				url: '<?php echo URL;?>Actividad/eliminar/'+val,
				type: 'get',
				success:function(obj){
					if (obj=="false") {
					}else{
						swal("Mensaje de Alerta!", obj , "success");
						setInterval(function(){  location.reload(); }, 1500);
					}
				}
			});
		});
	}
	function altaAjax(val){
		swal({
			title: "¿Estás seguro?",
			text: "Esta Seguro que quiere dar de alta la Actividad?",
			type: "warning",
			showCancelButton: true,confirmButtonColor: "#24be66",
			confirmButtonText: "Dar de Alta!",
			closeOnConfirm: false
		},function(){
			$.ajax({
				url: '<?php echo URL;?>Actividad/alta/'+val,
				type: 'get',
				success:function(obj){
					if (obj=="false") {
					}else{
						swal("Mensaje de Alerta!", obj , "success");
						setInterval(function(){ location.reload();}, 1000);
					}
				}
			});
		});
	}
	function seleccionarLugar(jefatura,unidad){var seleccionado=$('#'+jefatura+' option:selected').val();$("#"+unidad+" option").hide();$("#"+unidad+" option[jefatura="+seleccionado+"]").show();$("#"+unidad).prop("selectedIndex", 0);$("#"+unidad).selectpicker('refresh');}
</script>
