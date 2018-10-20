<div class="fab" data-target="#newcargoModal" data-toggle="modal"> + </div>
<div class="row"><h2 class="text-center" style="margin:20px 0 1px 0;font-weight:300">LISTA DE CARGOS</h2></div>

<div class="row" style="margin:10px"> <!-- SECTION TABLE USERS -->
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="col-md-12">
	          <ul class="nav nav-tabs nav-justified" id="myTabs">
	               <li role="presentation" class="active"><a href="#todos" aria-controls="todos" role="tab" data-toggle="tab">ACTIVOS<span class="badge" style="background:<?php echo COLOR;?>;margin-left:10px;color:#fff"><?php echo count($resultado["cargos"]);?></span></a></li>
				<li role="presentation"><a href="#baja" aria-controls="baja" role="tab" data-toggle="tab">BAJAS<span class="badge" style="background:<?php echo COLOR;?>;margin-left:10px"><?php echo mysql_num_rows($resultado["bajas"]);?></span></a></li>
	          </ul>
	     </div>
		<div class="col-md-12 tab-content" style="margin:0px">
	          <div id="todos" role="tabpanel" class="tab-pane active">
				<div class="table-responsive">
					<table class="table table-striped table-condensed table-hover" id="tableall_data">
						<thead>
							<th width="20%">n°</th>
							<th width="60%">nombre de la actividad</th>
							<th width="20%">opciones</th>
						</thead>
						<?php $aux=1; ?>
						<tbody>
							<?php while($row=mysql_fetch_array($resultado["cargos"])): ?>
								<tr>
									<td><h5><?php echo $aux;?></h5></td>
									<td style="text-align:left;padding-left:9px;vertical-align:inherit"><h5 style="text-align:left"><?php echo ucwords(strtolower($row['nombre'])); ?></h5></td>
									<td>
										<a data-target="#updatecargoModal" data-toggle="modal" onclick="updateAjax(<?php echo $row['id'];?>,'<?php echo strtolower($row['nombre'])?>')"><span title="editar actividad"  class="glyphicon glyphicon-pencil" aria-hidden="true" style="cursor:pointer;margin:0 2px 0 2px"></span></a>
										<a  onclick="bajaAjax(<?php echo $row['id'];?>)"><span title="dar de baja actividad" class="glyphicon glyphicon-remove" aria-hidden="true" style="cursor:pointer;color:red;margin:0 2px 0 2px"></span></a>
									</td>
									<?php $aux++; ?>
								</tr>
							<?php endwhile; ?>
						</tbody>
					</table>
				</div>
				<div class="row"> <!-- SECTION EMPTY TABLE -->
					<?php if(mysql_num_rows($resultado["cargos"])<1):?>
						<div class="col-md-12">
							<div class="alert alert-error alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<strong>MENSAJE DE ALERTA!</strong> No se encontraron Cargos dados de  Alta.
							</div>
						</div>
					<?php endif;?>
				</div>
			</div>
			<div id="baja" role="tabpanel" class="tab-pane">
				<div class="table-responsive">
					<table class="table table-striped table-condensed table-hover">
						<thead>
							<th width="20%">n°</th>
							<th width="60%">nombre de la actividad</th>
							<th width="20%">opciones</th>
						</thead>
						<?php $aux=1; ?>
						<tbody>
							<?php while($row=mysql_fetch_array($resultado["bajas"])): ?>
								<tr>
									<td><h5><?php echo $aux;?></h5></td>
									<td style="text-align:left;padding-left:9px;vertical-align:inherit"><h5 style="text-align:left"><?php echo ucwords(strtolower($row['nombre'])); ?></h5></td>
									<td>
										<a data-target="#updatecargoModal" data-toggle="modal" onclick="updateAjax(<?php echo $row['id'];?>,'<?php echo strtolower($row['nombre'])?>')"><span title="editar actividad"  class="glyphicon glyphicon-pencil" aria-hidden="true" style="cursor:pointer;margin:0 2px 0 2px"></span></a>
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
							<strong>MENSAJE DE ALERTA!</strong> No se encontraron Cargos dados de BAJA.
							</div>
						</div>
					<?php endif;?>
				</div>
			</div>
	</div>
</div>

<?php 	include 'modalnewcargo.php';
		include 'modalupdatecargo.php';?>
<script>
	var Get_ID,Get_NOMBRE;
    $(document).ready(function(){
		$('#inputsearch').keyup(function(){var data=$(this).val().toLowerCase().trim();SEARCH_DATA(data,"tableall_data","No se encontraron coincidencias.");});
		$('#inputnombre,#inputnombre_u').keypress(function(e){not_number(e);}).keyup(function(){if($(this).val().trim().length>4){small_error($(this).attr('toggle'),true);}else{small_error($(this).attr('toggle'),false);}function_validate($(this).attr('validate'));});
		$('#btnregistrar').click(function(){
			$.ajax({
				url: '<?php echo URL;?>Configuracion/crear_cargo',
				type: 'post',
				data:{nombre:$('#inputnombre').val()
				},
				success:function(obj){if (obj=="false") {$('#error_registro').show();}else{
					swal("Mensaje de Alerta!", obj , "success");
					setInterval(function(){location.reload();
					}, 1000);
				}}});});
		function function_validate(validate){
			if(validate!="false"&&validate=="true"){
				if($('.fila1').hasClass('has-success')){
						$("#btnregistrar").attr('disabled', false);}else{$("#btnregistrar").attr('disabled', true);}
			}else{

				if($('.fila1_u').hasClass('has-success') && $('#inputnombre_u').val().trim()!=Get_NOMBRE){
					$("#buttonupdate").attr('disabled', false);
				}else{$("#buttonupdate").attr('disabled', true);}
			}
		}
		$('#buttonupdate').click(function(){
			$.ajax({
				url: '<?php echo URL;?>Configuracion/editar_cargo/'+Get_ID,
				type: 'post',
				data:{nombre:$('#inputnombre_u').val().trim()},
				success:function(obj){if (obj=="false") {$('#error_update').show();}else{
					swal("Mensaje de Alerta!", obj , "success");
					setInterval(function(){
						location.reload();
					}, 1000);
					}
				}
			});
		});
	});
	function updateAjax(val,nombre){
		Get_ID=val;
		Get_NOMBRE=nombre;
		$('#inputnombre_u').val(nombre);$("#buttonupdate").attr('disabled', true);small_error('.fila1_u',true);
	}
	function bajaAjax(val){
		swal({
			title: "¿Estás seguro?",
			text: "Esta Seguro que quiere dar de baja a el Cargo?",
			type: "warning",
			showCancelButton: true,confirmButtonColor: "#d93333",
			confirmButtonText: "Dar de Baja!",
			closeOnConfirm: false
		},function(){
			$.ajax({
				url: '<?php echo URL;?>Configuracion/baja_cargo/'+val,
				type: 'get',
				success:function(obj){
					if (obj=="false") {
					}else{
						swal("Mensaje de Alerta!", obj , "success");
						setInterval(function(){  location.reload(); }, 1000);
					}
				}
			});
		});
	}
	function altaAjax(val){
		swal({
			title: "¿Estás seguro?",
			text: "Esta Seguro que quiere dar de alta el Cargo?",
			type: "warning",
			showCancelButton: true,confirmButtonColor: "#24be66",
			confirmButtonText: "Dar de Alta!",
			closeOnConfirm: false
		},function(){
			$.ajax({
				url: '<?php echo URL;?>Configuracion/alta_cargo/'+val,
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
</script>
