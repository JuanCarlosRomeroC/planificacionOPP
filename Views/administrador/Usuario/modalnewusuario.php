<div class="modal fade" id="newusuarioModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header" style="background:#3fd2e0">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" style="color:#fff">REGISTRO DE NUEVO USUARIO</h4>
			</div>
			<div class="modal-body" style="margin:0;padding:0">
				<form method="POST" action="" class="form-horizontal">
					<div class="row"  style="margin-left:40px;margin-right:40px;margin-top:25px;margin-bottom:25px">
						<div class="form-group  has-feedback has-error fila1">
							<label class="col-sm-2 control-label">Nombres</label>
							<div class="col-sm-10">
								<input type="text" name="nombre" id="inputnombre" required class="form-control" placeholder="Ejemplo: Stefanie" validate="true" toggle=".fila1">
								<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
							</div>
						</div>
						<div class="form-group  has-feedback has-error fila2">
							<label class="col-sm-2 control-label">Apellidos</label>
							<div class="col-sm-10">
								<input type="text" name="apellido" id="inputapellido" required class="form-control" placeholder="Ejemplo: Alvarez Castillo" validate="true" toggle=".fila2">
								<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
							</div>
						</div>
						<div class="form-group  has-feedback has-error fila3">
							<label class="col-sm-2 control-label">Número CI</label>
							<div class="col-sm-10">
								<input type="number" min="1" name="ci" id="inputci" required class="form-control" placeholder="Ejemplo: 5570221" validate="true" toggle=".fila3">
								<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Cargo</label>
							<div class="col-sm-10">
								<select name="id_cargo" id="selectcargo" class="form-control selectpicker show-tick" data-live-search="true">
									<?php while($row=mysql_fetch_array($resultado['cargos'])): ?>
										<option value="<?php echo $row['id'];?>"><?php echo ucwords(strtolower($row['nombre']));?></option>
									<?php endwhile; ?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Unidad</label>
							<div class="col-sm-10">
								<select name="unidad" id="selectunidad" class="form-control selectpicker show-tick" data-live-search="true">
                                    <?php while($row=mysql_fetch_array($resultado['unidades'])): ?>
                                        <option value="<?php echo $row['id'];?>"><?php echo ucwords(strtolower($row['nombre']));?></option>
                                    <?php endwhile; ?>
                                </select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Telefono</label>
							<div class="col-sm-10">
								<input type="number" min="1" name="telefono" id="inputtelefono" class="form-control" placeholder="Ejemplo: 71610000">
							</div>
						</div>
						<center>
							<button class="btn btn-warning btn-lg" style="margin-bottom:15px" id="btnregistrar" type="submit" disabled>Guardar</button>
						</center>

					</div>
				</form>
			</div>
		</div>
	</div>
</div>
