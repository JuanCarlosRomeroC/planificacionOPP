<?php
	$users=['Administrador','Director','Planificador','Jefe de Jefatura','Jefe de Unidad','Normal'];
?>
<div class="row">
	<h2 class="text-center" style="margin:20px 0 1px 0;font-weight:300">LISTA DE USUARIOS</h2>
</div>
<div class="row" style="margin:10px"> <!-- SECTION TABLE USERS -->
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="col-md-12">
	          <ul class="nav nav-tabs nav-justified" id="myTabs">
	               <li role="presentation" class="active"><a href="#todos" aria-controls="todos" role="tab" data-toggle="tab">ACTIVOS<span class="badge" style="background:red;margin-left:10px;color:#fff"><?php echo mysql_num_rows($resultado["usuarios"]);?></span></a></li>
				<li role="presentation"><a href="#jefatura" aria-controls="jefatura" role="tab" data-toggle="tab">JEFATURA<span class="badge" style="background:red;margin-left:10px"><?php echo mysql_num_rows($resultado["userjefatura"]);?></span></a></li>
				<li role="presentation"><a href="#unidad" aria-controls="unidad" role="tab" data-toggle="tab">UNIDAD<span class="badge" style="background:red;margin-left:10px"><?php echo mysql_num_rows($resultado["userunidad"]);?></span></a></li>
				<li role="presentation"><a href="#baja" aria-controls="baja" role="tab" data-toggle="tab">BAJAS<span class="badge" style="background:red;margin-left:10px"><?php echo mysql_num_rows($resultado["bajas"]);?></span></a></li>
	          </ul>
	     </div>
		<div class="col-md-12 tab-content" style="margin:0px">
	          <div id="todos" role="tabpanel" class="tab-pane active">
				<div class="table-responsive">
					<table id="tableusers" class="table table-striped table-condensed table-hover">
						<thead>
							<th width="23%">apellidos y nombres</th>
							<th width="20%">cargo</th>
							<th width="25%">jefatura</th>
							<th width="25%">unidad</th>
							<th width="7%">opciones</th>
						</thead>
						<tbody>
							<?php while($row=mysql_fetch_array($resultado["usuarios"])): ?>
								<tr>

									<td style="text-align:left;padding-left:9px"><h5><?php echo ucwords(strtolower($row['nombre'])); ?> <small> <?php echo $row['ci'];?></small> </h5></td>
									<td><h5><?php echo ucwords(strtolower($row['cargo'])); ?></h5></td>
									<td style="text-align:left;padding-left:9px"><h5><?php echo $row['jefatura']==null?"Sin Jefatura":ucwords(strtolower($row['jefatura'])); ?></h5></td>
									<td style="text-align:left;padding-left:9px"><h5><?php echo $row['unidad']==null?"Sin Unidad":ucwords(strtolower($row['unidad'])); ?></h5></td>
									<td>
										<a data-target="#verusuarioModal" data-toggle="modal" onclick="verAjax(<?php echo $row['id'];?>)"><button title="ver personal" type="button" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></button></a>
										<a  onclick="bajaAjax(<?php echo $row['id'];?>)"><button title="ver planificación de actividades" type="button" class="btn btn-info btn-xs"><span class="glyphicon glyphicon glyphicon-check" aria-hidden="true"></span></button></a>
									</td>
								</tr>
							<?php endwhile; ?>
						</tbody>
					</table>
				</div>
				<div class="row" id="alert_empty"> <!-- SECTION EMPTY TABLE -->
					<?php if(mysql_num_rows($resultado["usuarios"])<1):?>
						<div class="col-md-12">
							<div class="alert alert-error alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<strong>MENSAJE DE ALERTA!</strong> No se encontraron USUARIOS registrados.
							</div>
						</div>
					<?php endif;?>
				</div>
			</div>
	          <div id="jefatura" role="tabpanel" class="tab-pane">
				<div class="table-responsive">
					<table id="tableusers" class="table table-striped table-condensed table-hover">
						<thead>
							<th width="27%">apellidos y nombres</th>
							<th width="22%">cargo</th>
							<th width="33%">jefatura</th>
							<th width="12%">tipo</th>
							<th width="7%">opciones</th>
						</thead>
						<tbody>
							<?php while($row=mysql_fetch_assoc($resultado["userjefatura"])): ?>
								<tr>

									<td style="text-align:left;padding-left:9px"><h5><?php echo ucwords(strtolower($row['nombre'])); ?> <small> <?php echo $row['ci'];?></small> </h5></td>
									<td><h5><?php echo ucwords(strtolower($row['cargo'])); ?></h5></td>
									<td style="text-align:left;padding-left:9px"><h5><?php echo $row['jefatura']==null?"Sin Jefatura":ucwords(strtolower($row['jefatura'])); ?></h5></td>
									<td><h5>Jefe De Jefatura</h5></td>
									<td>
										<a data-target="#verusuarioModal" data-toggle="modal" onclick="verAjax(<?php echo $row['id'];?>)"><button title="ver personal" type="button" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></button></a>
										<a  onclick="bajaAjax(<?php echo $row['id'];?>)"><button title="ver planificación de actividades" type="button" class="btn btn-info btn-xs"><span class="glyphicon glyphicon glyphicon-check" aria-hidden="true"></span></button></a>
									</td>
								</tr>
							<?php endwhile; ?>
						</tbody>
					</table>
				</div>
				<div class="row"> <!-- SECTION EMPTY TABLE -->
					<?php if(mysql_num_rows($resultado["userjefatura"])<1):?>
						<div class="col-md-12">
							<div class="alert alert-error alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<strong>MENSAJE DE ALERTA!</strong> No se encontraron encargados de JEFATURA registrados.
							</div>
						</div>
					<?php endif;?>
				</div>
			</div>
			<div id="unidad" role="tabpanel" class="tab-pane">
				<div class="table-responsive">
					<table id="tableusers" class="table table-striped table-condensed table-hover">
						<thead>
							<th width="23%">apellidos y nombres</th>
							<th width="16%">cargo</th>
							<th width="20%">jefatura</th>
							<th width="25%">unidad</th>
							<th width="11%">tipo</th>
							<th width="5%">opcion</th>
						</thead>
						<tbody>
							<?php while($row=mysql_fetch_assoc($resultado["userunidad"])): ?>
								<tr>
									<td style="text-align:left;padding-left:9px"><h5><?php echo ucwords(strtolower($row['nombre'])); ?> <small> <?php echo $row['ci'];?></small> </h5></td>
									<td><h5><?php echo ucwords(strtolower($row['cargo'])); ?></h5></td>
									<td style="text-align:left;padding-left:9px"><h5><?php echo $row['jefatura']==null?"Sin Jefatura":ucwords(strtolower($row['jefatura'])); ?></h5></td>
									<td style="text-align:left;padding-left:9px"><h5><?php echo $row['unidad']==null?"Sin Unidad":ucwords(strtolower($row['unidad'])); ?></h5></td>
									<td>Jefe De Unidad</td>
									<td>
										<a data-target="#verusuarioModal" data-toggle="modal" onclick="verAjax(<?php echo $row['id'];?>)"><button title="ver personal" type="button" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></button></a>
										<a  onclick="bajaAjax(<?php echo $row['id'];?>)"><button title="ver planificación de actividades" type="button" class="btn btn-info btn-xs"><span class="glyphicon glyphicon glyphicon-check" aria-hidden="true"></span></button></a>
									</td>
								</tr>
							<?php endwhile; ?>
						</tbody>
					</table>
				</div>
				<div class="row" id="alert_empty"> <!-- SECTION EMPTY TABLE -->
					<?php if(mysql_num_rows($resultado["userunidad"])<1):?>
						<div class="col-md-12">
							<div class="alert alert-error alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<strong>MENSAJE DE ALERTA!</strong> No se encontraron USUARIOS registrados.
							</div>
						</div>
					<?php endif;?>
				</div>
			</div>
	          <div id="baja" role="tabpanel" class="tab-pane">
				<div class="table-responsive">
					<table id="tableusers" class="table table-striped table-condensed table-hover">
						<thead>
							<th width="23%">apellidos y nombres</th>
							<th width="20%">cargo</th>
							<th width="25%">jefatura</th>
							<th width="25%">unidad</th>
							<th width="7%">opciones</th>
						</thead>
						<tbody>
							<?php while($row=mysql_fetch_assoc($resultado["bajas"])): ?>
								<tr>

									<td style="text-align:left;padding-left:9px"><h5><?php echo ucwords(strtolower($row['nombre'])); ?> <small> <?php echo $row['ci'];?></small> </h5></td>
									<td><h5><?php echo ucwords(strtolower($row['cargo'])); ?></h5></td>
									<td style="text-align:left;padding-left:9px"><h5><?php echo $row['jefatura']==null?"Sin Jefatura":ucwords(strtolower($row['jefatura'])); ?></h5></td>
									<td style="text-align:left;padding-left:9px"><h5><?php echo $row['unidad']==null?"Sin Unidad":ucwords(strtolower($row['unidad'])); ?></h5></td>
									<td>
										<a data-target="#verusuarioModal" data-toggle="modal" onclick="verAjax(<?php echo $row['id'];?>)"><button title="ver personal" type="button" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></button></a>
										<a  onclick="bajaAjax(<?php echo $row['id'];?>)"><button title="ver planificación de actividades" type="button" class="btn btn-info btn-xs"><span class="glyphicon glyphicon glyphicon-check" aria-hidden="true"></span></button></a>
									</td>
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
							<strong>MENSAJE DE ALERTA!</strong> No se encontraron usuarios dados de BAJA.
							</div>
						</div>
					<?php endif;?>
				</div>
			</div>
		</div>
	</div>
</div>

<?php include 'modalverusuario.php';?>
<script>
   	var id_lugar_u,id_cargo_u,id_user_u,psw_u,id_tipo_u;
	var users_array=['Administrador','Director','Planificador','Jefe de Jefatura','Jefe de Unidad','Normal'];
    $(document).ready(function(){
		$('#inputsearch').keyup(function(){$('#myTabs a[href="#todos"]').tab('show');
			var data=$(this).val().toLowerCase().trim();SEARCH_DATA(data,"tableusers","No se encontraron USUARIOS registrados.");});
	});
	function verAjax(val){
		$.ajax({
			url: '<?php echo URL;?>Usuario/ver/'+val,
			type: 'get',
			success:function(obj){
				var data = JSON.parse(obj);
				console.log(data);
				$('.unombre h5').text(data.nombre+" "+data.apellido);$('.unombre p').text(data.ci);$('.unombre em').text(users_array[data.tipo]);$('.utelefono').text("(+591) "+data.telefono);$('.ucargo').text(data.cargo);$('.uunidad').text(data.unidad==null ? ("Sin Unidad"):(data.unidad));$('.uestado').text(data.estado==1 ? ("Activo"):("Inactivo"));
				$('.unombre h6').text(data.jefatura==null ? ("sin jefatura asignada"):(data.jefatura));
			}
		});
	}
</script>
