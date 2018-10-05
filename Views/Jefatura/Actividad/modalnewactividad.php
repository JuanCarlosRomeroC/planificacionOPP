<div class="modal fade" id="newactividadModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
               <div class="modal-body" style="padding:20px">
                   	<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="right: 9px;top:5px;position:absolute"><span aria-hidden="true">&times;</span></button>
                  	<center><h3 style="margin-top:5px;color: #1cd2dc;font-weight: 700;">NUEVA ACTIVIDAD</h3></center>
			   	<form autocomplete="off">
					<div class="form-group  has-feedback has-error fila1" style="margin-bottom:20px">
						<label style="color:#3fd2e0;font-weight:400;font-family:arial;font-size:.8em;margin-bottom:2px">SELECCIONE ACTIVIDAD</label>
						<textarea rows="4" id="inputnombre" cols="80" placeholder="Ejemplo: Brindar soporte técnico a los distintos sistemas desarrollados por el SEDES potosí" maxlength="250" style="resize: none;" class="form-control"  validate=true toggle=".fila1"></textarea>
						<span class="glyphicon glyphicon-remove form-control-feedback" style="margin:25px 8px 0 0" aria-hidden=true></span>
						<em style="color:#cf6666;display:none" id="error_registro">El nombre de Actividad ya esta en uso!</em>
					</div>
					<div class="form-group">
						<label style="color:#3fd2e0;font-weight:400;font-family:arial;font-size:.8em;margin-bottom:2px">SELECCIONE UNIDAD</label>
						<select id="selectunidad" class="form-control selectpicker show-tick" data-live-search="true">
							<option value="0" jefatura="0">Sin Asignar</option>
							<?php while($row=mysql_fetch_array($resultado['unidades'])): ?>
								<option value="<?php echo $row['id'];?>" jefatura="<?php echo $row['id_jefatura'];?>"><?php echo ucwords(strtolower($row['nombre']));?></option>
							<?php endwhile; ?>
						</select>
					</div>
				</form>
               </div>
			<div class="modal-footer" style="padding:0">
				<button class="btn btn-success" style="margin:5px" id="buttonagregaractividad" type="button" disabled>Agregar</button>
			</div>
		</div>
	</div>
</div>
