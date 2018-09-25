<div class="modal fade" id="updatecronogramaModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header" style="background:#3fd2e0">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" style="color:#fff">REGISTRO DE NUEVA PLANIFICACION</h4>
			</div>
			<div class="modal-body" style="padding:20px">
				<div class="row">
					<div class="form-group col-md-6 col-sm-6 col-xs-6">
						<div class='input-group'>
							<span class="input-group-addon" style="background:#c7ffa4">
								INICIO
							</span>
							<input readonly type='text' class="form-control" id="fecha_de_u" validate="true"/>
						</div>
					</div>
					<div class="form-group col-md-6 col-sm-6 col-xs-6">
						<div class='input-group'>
							<span class="input-group-addon" style="background:#ffb9a4">
								FINAL
							</span>
							<input readonly type='text' class="form-control" id="fecha_hasta_u" validate="true"/>
						</div>
					</div>
				</div>
				<div class="row" style="margin:0">
					<div class="form-group">
						<label style="color:#3fd2e0;font-weight:400;font-family:arial;font-size:.8em;margin-bottom:2px">SELECCIONE USUARIO</label>
						<?php mysql_data_seek($resultado['usuario'], 0);?>
						<select id="selectusuario_u" class="form-control selectpicker show-tick" data-live-search="true">
							<?php while($row=mysql_fetch_array($resultado['usuario'])): ?>
								<option value="<?php echo $row['id'];?>"><?php echo ucwords(strtolower($row['nombre']));?></option>
							<?php endwhile;?>
						</select>
					</div>
				</div>
				<div class="row" style="margin:0">
					<div class="form-group">
						<label style="color:#3fd2e0;font-weight:400;font-family:arial;font-size:.8em;margin-bottom:2px">SELECCIONE ACTIVIDAD</label>
						<?php mysql_data_seek($resultado['actividad'], 0);?>
						<select id="selectactividad_u" class="form-control selectpicker show-tick" data-live-search="true">
							<?php while($row=mysql_fetch_array($resultado['actividad'])): ?>
								<option value="<?php echo $row['id'];?>"><?php echo ucwords(strtolower($row['nombre']));?></option>
							<?php endwhile;?>
						</select>
					</div>
				</div>
			</div>
			<div class="modal-footer" style="border-left:10px solid  #84da92;margin: 0;padding:5px">
				<button class="btn btn-danger" id="btncancelar" type="button" data-dismiss="modal" aria-label="Close">CANCELAR</button>
				<button class="btn btn-success" id="buttonupdate" type="button">ACTUALIZAR</button>
	      	</div>
		</div>
	</div>
</div>
