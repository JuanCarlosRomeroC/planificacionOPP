<div class="modal fade" id="newactividadModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header" style="background:#3fd2e0">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" style="color:#fff">REGISTRO DE NUEVA ACTIVIDAD</h4>
			</div>
			<div class="modal-body" style="margin:0;padding:0">
				<form  class="form-horizontal" autocomplete="off" style="margin: 25px 30px 25px 30px">
					<div class="form-group  has-feedback has-error fila1" >
						<label class="col-sm-2 control-label">Actividad</label>
						<div class="col-sm-10">
							<textarea rows="4" id="inputnombre" cols="80" placeholder="Ejemplo: Brindar soporte técnico a los distintos sistemas desarrollados por el SEDES potosí" maxlength="250" style="resize: none;" class="form-control"  validate=true toggle=".fila1"></textarea>
							<span class="glyphicon glyphicon-remove form-control-feedback" style="margin:25px 8px 0 0" aria-hidden=true></span>
							<em style="color:#cf6666;display:none" id="error_registro">El nombre de Actividad ya esta en uso!</em>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Jefatura</label>
						<div class="col-sm-10">
							<select id="selectjefatura" class="form-control selectpicker show-tick" data-live-search="true">
								<option value="0">Sin Asignar</option>
								<?php while($row=mysql_fetch_array($resultado['jefaturas'])): ?>
									<option value="<?php echo $row['id'];?>"><?php echo ucwords(strtolower($row['nombre']));?></option>
								<?php endwhile; ?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Unidad</label>
						<div class="col-sm-10">
							<select id="selectunidad" class="form-control selectpicker show-tick" data-live-search="true">
								<option value="0" jefatura="0">Sin Asignar</option>
								<?php while($row=mysql_fetch_array($resultado['unidades'])): ?>
									<option value="<?php echo $row['id'];?>" jefatura="<?php echo $row['id_jefatura'];?>"><?php echo ucwords(strtolower($row['nombre']));?></option>
								<?php endwhile; ?>
							</select>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
					<button class="btn btn-success" type="button" id="btnregistrar" disabled>REGISTRAR</button>
			</div>
		</div>
	</div>
</div>
