<div class="fab" data-target="#newactividadModal" data-toggle="modal"> + </div>
<div class="col-md-12">
	<h2 class="text-center" style="margin:0px 0 1px 0;font-weight:300">LISTA DE ACTIVIDADES DEL DIRECTOR</h2>
</div>
<div class="row" style="margin:10px"> <!-- SECTION TABLE USERS -->
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="col-md-12">
	          <ul class="nav nav-tabs nav-justified" id="myTabs">
	               <li role="presentation" class="active"><a href="#todos" aria-controls="todos" role="tab" data-toggle="tab">TODOS<span class="badge" style="background:red;margin-left:10px;color:#fff"><?php echo mysql_num_rows($resultado["actividades"]);?></span></a></li>
	               <li role="presentation"><a href="#baja" aria-controls="baja" role="tab" data-toggle="tab">BAJAS<span class="badge" style="background:red;margin-left:10px"><?php echo mysql_num_rows($resultado["bajas"]);?></span></a></li>
	          </ul>
	     </div>
		<div class="col-md-12 tab-content" style="margin:0px">
	          <div id="todos" role="tabpanel" class="tab-pane active">
				<div class="table-responsive">
					<table id="tableactividades" class="table table-striped table-condensed table-hover">
						<thead>
							<th width="5%">n°</th>
							<th width="70%">nombre de la actividad</th>
							<th width="15%">estado</th>
							<th width="10%">opciones</th>
						</thead>
						<tbody>
							<?php $count=1;while($row=mysql_fetch_array($resultado["actividades"])): ?>
								<tr>
									<td><h5><?php echo $count?></h5></td>
									<td><h5><?php echo ucwords(strtolower($row['nombre'])); ?></h5></td>
									<td><h5>Activo</h5></td>
									<td>
										<a data-target="#updateactividadModal" data-toggle="modal" onclick="updateAjax(<?php echo $row['id'];?>)"><span title="editar actividad"  class="glyphicon glyphicon-pencil" aria-hidden="true" style="cursor:pointer;margin:0 2px 0 2px"></span></a>
										<a  onclick="bajaAjax(<?php echo $row['id'];?>)"><button title="Eliminar Actividad de Unidad" type="button" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button></a>
									</td>
								</tr>
							<?php $count++;endwhile; ?>
						</tbody>
					</table>
				</div>
				<div class="row" id="alert_empty"> <!-- SECTION EMPTY TABLE -->
					<?php if(mysql_num_rows($resultado["actividades"])<1):?>
						<div class="col-md-12">
							<div class="alert alert-error alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<strong>MENSAJE DE ALERTA!</strong> No se encontraron ACTIVIDADES registradas.
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
							<th width="70%">nombre de la actividad</th>
							<th width="15%">estado</th>
							<th width="10%">opciones</th>
						</thead>
						<tbody>
							<?php $count=1;while($row=mysql_fetch_array($resultado["bajas"])): ?>
								<tr>
									<td><h5><?php echo $count?></h5></td>
									<td><h5><?php echo ucwords(strtolower($row['nombre'])); ?></h5></td>
									<td><h5>De Baja</h5></td>
									<td>
										<a  onclick="altaAjax(<?php echo $row['id'];?>)"><button title="dar de alta la actividad" type="button" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></button></a>
									</td>
								</tr>
							<?php $count++;endwhile; ?>
						</tbody>
					</table>
				</div>
				<div class="row"> <!-- SECTION EMPTY TABLE -->
					<?php if(mysql_num_rows($resultado["bajas"])<1):?>
						<div class="col-md-12">
							<div class="alert alert-error alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<strong>MENSAJE DE ALERTA!</strong> No se encontraron actividades dados de BAJA.
							</div>
						</div>
					<?php endif;?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include 'modalnewactividad.php';include 'modalupdateactividad.php';?>
<script>
	var id_jefatura_u,id_actividad_u;
    $(document).ready(function(){
		$('#inputsearch').keyup(function(){
			var data=$(this).val().toLowerCase().trim();
			SEARCH_DATA(data,"tableactividades","No se encontraron coincidencias.");
		});
		$('#inputnombre,#inputnombre_u').keypress(function(e){
			not_number(e);
		}).keyup(function(){
			if($(this).val().trim().length>5){
				small_error($(this).attr('toggle'),true);
			}else{small_error($(this).attr('toggle'),false);}function_validate($(this).attr('validate'));});

		function function_validate(validate){
			if(validate!="false"&&validate=="true"){
				if($('.fila1').hasClass('has-success')){
					$("#buttonagregaractividad").attr('disabled', false);}else{$("#buttonagregaractividad").attr('disabled', true);}
			}else{
				if($('.fila1_u').hasClass('has-success')&& $('#inputnombre_u').attr('placeholder')!=$('#inputnombre_u').val().trim().toLowerCase()) {
					$("#buttonupdate").attr('disabled', false);
				}else{$("#buttonupdate").attr('disabled', true);}
			}
		}

		//_____________REGISTRAR NUEVA ACTIVIDAD
		$('#buttonagregaractividad').click(function(){
			$.ajax({
				url: '<?php echo URL;?>Actividad/crear',
				type: 'post',
				data:{
					nombre:$('#inputnombre').val(),
				},
				success:function(obj){
					swal("Mensaje de Alerta!", obj , "success");
					setInterval(function(){location.reload();}, 1000);
				}
			});
		});
		$('#buttonupdate').click(function(){
			$.ajax({
				url: '<?php echo URL;?>Actividad/editar/'+id_actividad_u,
				type: 'post',
				data:{nombre:$('#inputnombre_u').val()},
				success:function(obj){if (obj=="false") {$('#error_update').show();}else{
					swal("Mensaje de Alerta!", obj , "success");
					setInterval(function(){ location.reload(); }, 1000);
					}
				}
			});
		});
	});

	function bajaAjax(val){
		swal({
			title: "¿Estás seguro?",
			text: "Esta Seguro que quiere dar de baja la Actividad",
			type: "warning",
			showCancelButton: true,confirmButtonColor: "#d93333",
			confirmButtonText: "Eliminar!",
			closeOnConfirm: false
		},function(){
			$.ajax({
				url: '<?php echo URL;?>Actividad/eliminar/'+val,
				type: 'get',
				success:function(obj){
					swal("Mensaje de Alerta!", obj , "success");
					setInterval(function(){ location.reload();}, 1000);
				}
			});
		});
	}
	function updateAjax(val){
		$("#buttonupdate").attr('disabled', true);
		$.ajax({
			url: '<?php echo URL;?>Actividad/ver/'+val,
			type: 'get',
			success:function(obj){
				var data = JSON.parse(obj);
				$('#inputnombre_u').val(data.nombre.toLowerCase());$('#inputnombre_u').attr('placeholder',data.nombre.toLowerCase());
				id_actividad_u=data.id;
			}
		});
	}
	function altaAjax(val){
		swal({
			title: "¿Estás seguro?",
			text: "Esta Seguro que quiere dar de alta la actividad?",
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
						setInterval(function(){ location.reload() }, 1000);
					}
				}
			});
		});
	}
</script>
