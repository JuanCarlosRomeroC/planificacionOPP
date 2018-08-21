<div class="fab" data-target="#newactividadModal" data-toggle="modal"> + </div>
<div class="row"><h2 class="text-center" style="margin:20px 0 1px 0;font-weight:300">LISTA DE ACTIVIDADES</h2></div>

<div class="row" style="margin:10px"> <!-- SECTION TABLE USERS -->
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="col-md-12">
	          <ul class="nav nav-tabs nav-justified" id="myTabs">
	               <li role="presentation" class="active"><a href="#todos" aria-controls="todos" role="tab" data-toggle="tab">ASIGNADOS<span class="badge" style="background:<?php echo COLOR;?>;margin-left:10px;color:#fff"><?php echo mysql_num_rows($resultado["actividades"]);?></span></a></li>
				<li role="presentation"><a href="#sinasignar" aria-controls="sinasignar" role="tab" data-toggle="tab">SIN ASIGNAR<span class="badge" style="background:<?php echo COLOR;?>;margin-left:10px"><?php echo mysql_num_rows($resultado["sinasignar"]);?></span></a></li>
	               <li role="presentation"><a href="#baja" aria-controls="baja" role="tab" data-toggle="tab">BAJAS<span class="badge" style="background:<?php echo COLOR;?>;margin-left:10px"><?php echo mysql_num_rows($resultado["bajas"]);?></span></a></li>
	          </ul>
	     </div>
		<div class="col-md-12 tab-content" style="margin:0px">
	          <div id="todos" role="tabpanel" class="tab-pane active">
				<div class="table-responsive">
					<table id="tablejefaturas" class="table table-striped table-condensed table-hover">
						<thead>
							<th width="5%">nro</th>
							<th width="30%">nombre de la actividad</th>
							<th width="30%">jefatura</th>
							<th width="30%">unidad</th>
							<th width="5%">Ops</th>
						</thead>
						<?php $aux=1; ?>
						<tbody>
							<?php while($row=mysql_fetch_array($resultado["actividades"])): ?>
								<tr>
									<td><h5><?php echo $aux;?></h5></td>
									<td style="text-align:left;padding-left:9px;vertical-align:inherit"><h5 style="text-align:left"><?php echo ucwords(strtolower($row['nombre'])); ?></h5></td>
									<td style="text-align:left;padding-left:9px;vertical-align:inherit"><h5 style="text-align:left"><?php echo $row['jefatura']==null ? "Sin Jefatura Asingnada" : ucwords(strtolower($row['jefatura'])); ?></h5></td>
									<td style="text-align:left;padding-left:9px;vertical-align:inherit"><h5 style="text-align:left"><?php echo $row['unidad']==null ? "Sin Unidad Asingnada" : ucwords(strtolower($row['unidad'])); ?></h5></td>
									<td>
										<a data-target="#updateactividadModal" data-toggle="modal" onclick="updateAjax(<?php echo $row['id'];?>)"><button title="ver nombreES" type="button" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button></a>
									</td>
									<?php $aux++; ?>
								</tr>
							<?php endwhile; ?>
						</tbody>
					</table>
				</div>
				<div class="row" id="alert_empty"> <!-- SECTION EMPTY TABLE -->
					<?php if(mysql_num_rows($resultado["actividades"])<1):?>
						<div class="col-md-12">
							<div class="alert alert-error alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<strong>MENSAJE DE ALERTA!</strong> No se encontraron USUARIOS registrados.
							</div>
						</div>
					<?php endif;?>
				</div>
			</div>
	          <div id="sinasignar" role="tabpanel" class="tab-pane">
				<div class="table-responsive">
					<table id="tablejefaturas" class="table table-striped table-condensed table-hover">
						<thead>
							<th width="5%">nro</th>
							<th width="45%">nombre de la actividad</th>
							<th width="40%">Jefatura</th>
							<th width="10%">Opciones</th>
						</thead>
						<?php $aux=1; ?>
						<tbody>
							<?php while($row=mysql_fetch_array($resultado["sinasignar"])): ?>
								<tr>
									<td><h5><?php echo $aux;?></h5></td>
									<td style="text-align:left;padding-left:9px"><h5 style="text-align:left"><?php echo ucwords(strtolower($row['nombre'])); ?></h5></td>
									<td style="text-align:left;padding-left:9px"><h5 style="text-align:left">No se Asigno Jefatura</h5></td>
									<td>
										<a data-target="#updateactividadModal" data-toggle="modal" onclick="updateAjax(<?php echo $row['id'];?>)"><button title="ver actividad" type="button" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button></a>
										<a  onclick="bajaAjax(<?php echo $row['id'];?>)"><button title="dar de baja actividad" type="button" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button></a>
									</td>
									<?php $aux++; ?>
								</tr>
							<?php endwhile; ?>
						</tbody>
					</table>
				</div>
				<div class="row"> <!-- SECTION EMPTY TABLE -->
					<?php if(mysql_num_rows($resultado["sinasignar"])<1):?>
						<div class="col-md-12">
							<div class="alert alert-error alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<strong>MENSAJE DE ALERTA!</strong> No se encontro personas de ADMINISTRACION registrados.
							</div>
						</div>
					<?php endif;?>
				</div>
			</div>
	          <div id="baja" role="tabpanel" class="tab-pane">
				<div class="table-responsive">
					<table class="table table-striped table-condensed table-hover">
						<thead>
							<th width="5%">nro</th>
							<th width="45%">nombre de la actividad</th>
							<th width="40%">estado</th>
							<th width="10%">Opciones</th>
						</thead>
						<tbody>
							<?php while($row=mysql_fetch_array($resultado["bajas"])): ?>
								<tr>
									<td><h5><?php echo $aux;?></h5></td>
									<td style="text-align:left;padding-left:9px"><h5 style="text-align:left"><?php echo ucwords(strtolower($row['nombre'])); ?></h5></td>
									<td style="text-align:left;padding-left:9px">Actividad dada de BAJA</h5></td>
									<td>
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
	var id_jefatura_u,id_actividad_u;
    $(document).ready(function(){
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
					id_jefatura:$('#selectjefatura option:selected').val()
				},
				success:function(obj){if (obj=="false") {$('#error_registro').show();}else{
					swal("Mensaje de Alerta!", obj , "success");
					setInterval(function(){ location.reload(); }, 1500);
				}}});});
		function function_validate(validate){
			if(validate!="false"&&validate=="true"){
				if($('.fila1').hasClass('has-success')){
						$("#btnregistrar").attr('disabled', false);}else{$("#btnregistrar").attr('disabled', true);}
			}else{
				if($('.fila1_u').hasClass('has-success')){
					if(($('#inputnombre_u').attr('placeholder')!=$('#inputnombre_u').val().trim().toLowerCase()) ||
						($('#selectjefatura_u option:selected').attr('value')!=id_jefatura_u)
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
					id_jefatura:$('#selectjefatura_u option:selected').val()
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
				$("#selectjefatura_u").selectpicker('refresh');
				id_jefatura_u=data.id_jefatura;id_actividad_u=data.id;
				if (data.planificacion_anual==0) {
					$('.inputrow1_u').show();
				}else{
					$('.inputrow1_u').show();
				}
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
						setInterval(function(){ window.location.href = "/<?php echo FOLDER; ?>/Actividad"; }, 1500);
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
						setInterval(function(){ window.location.href = "/<?php echo FOLDER;?>/Actividad"; }, 1000);
					}
				}
			});
		});
	}
</script>
