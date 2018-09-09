<div class="modal fade" id="newusuarioModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header" style="background:#3fd2e0">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" style="color:#fff">REGISTRO DE NUEVO USUARIO</h4>
			</div>
			<div class="modal-body" style="margin:0;padding:0">
				<form  class="form-horizontal" autocomplete="off">
					<div class="row"  style="margin-left:40px;margin-right:40px;margin-top:25px;margin-bottom:25px">
						<div class="form-group  has-feedback has-error fila1">
							<label class="col-sm-2 control-label">Nombres</label>
							<div class="col-sm-10">
								<input type="text" id="inputnombre" required class="form-control" placeholder="Ejemplo: Stefanie" validate=true toggle=".fila1">
								<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden=true></span>
							</div>
						</div>
						<div class="form-group  has-feedback has-error fila2">
							<label class="col-sm-2 control-label">Apellidos</label>
							<div class="col-sm-10">
								<input type="text" id="inputapellido" required class="form-control" placeholder="Ejemplo: Alvarez Castillo" validate=true toggle=".fila2">
								<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
							</div>
						</div>
						<div class="form-group  has-feedback has-error fila3">
							<label class="col-sm-2 control-label">Número CI</label>
							<div class="col-sm-10">
								<input type="number" min="1" id="inputci" autocomplete="false" class="form-control" placeholder="Ejemplo: 5570221" validate=true toggle=".fila3">
								<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
								<em style="color:#cf6666;display:none" id="error_registro">El carnet de identidad ya esta en uso!</em>
							</div>
						</div>
						<div class="form-group has-feedback has-error fila4">
							<label class="col-sm-2 control-label">Contraseña</label>
							<div class="col-sm-10">
								<input type="password" id="inputpassword" autocomplete="false" class="form-control" placeholder="Minimo 5 caracteres" validate="true"  toggle=".fila4">
								<span toggle="#inputpassword" id="togglepassword" class="fa fa-fw fa-eye field-icon"></span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Cargo</label>
							<div class="col-sm-10">
								<select id="selectcargo" class="form-control selectpicker show-tick" data-live-search="true">
									<?php while($row=mysql_fetch_array($resultado['cargos'])): ?>
										<option value="<?php echo $row['id'];?>"><?php echo ucwords(strtolower($row['nombre']));?></option>
									<?php endwhile; ?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Telefono</label>
							<div class="col-sm-10">
								<input type="number" min="1" id="inputtelefono" class="form-control" placeholder="Ejemplo: 71610000">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Tipo</label>
							<div class="col-sm-10">
								<select id="selecttipo" class="form-control">
									<option value=0>Administrador</option>
									<option value=1>Director</option>
									<option value=2>Planificador</option>
									<option value=3>Jefe de Jefatura</option>
									<option value=4>Jefe de Unidad</option>
									<option value=5>Usuario</option>
								</select>
							</div>
						</div>
						<div class="form-group inputrow1" style="display:none">
							<label class="col-sm-2 control-label">Unidad</label>
							<div class="col-sm-10">
								<select id="selectunidad" class="form-control selectpicker show-tick" data-live-search="true">
									<option value=0>Sin Asignar</option>
	                                    	<?php while($row=mysql_fetch_array($resultado['unidades'])): ?>
	                                        	<option value="<?php echo $row['id'];?>"><?php echo ucwords(strtolower($row['nombre']));?></option>
	                                    	<?php endwhile; ?>
                                		</select>
							</div>
						</div>
						<div class="form-group inputrow2" style="display:none">
							<label class="col-sm-2 control-label">Jefatura</label>
							<div class="col-sm-10">
								<select id="selectjefatura" class="form-control selectpicker show-tick" data-live-search="true">
	                                    	<?php while($row=mysql_fetch_array($resultado['jefaturas'])): ?>
	                                        	<option value="<?php echo $row['id'];?>"><?php echo ucwords(strtolower($row['nombre']));?></option>
	                                    	<?php endwhile; ?>
	                                	</select>
							</div>
						</div>
						<center>
							<button class="btn btn-warning btn-lg" type="button" style="margin-bottom:15px" id="btnregistrar" disabled>REGISTRAR</button>
						</center>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
