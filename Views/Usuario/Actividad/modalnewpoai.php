<div class="modal fade" id="newpoaiModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
               <div class="modal-body" style="padding:20px">
                   	<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="right: 9px;top:5px;position:absolute"><span aria-hidden="true">&times;</span></button>
                  	<center><h3 style="margin-top:5px;color: #1cd2dc;font-weight: 700;">NUEVA ACTIVIDAD <small> (Gestión <?php echo intval(date('Y'))+1?>)</small> </h3></center>
				<div class="form-group inputrow1_u" style="margin-bottom:20px">
					<label style="color:#3fd2e0;font-weight:400;font-family:arial;font-size:.8em;margin-bottom:2px">SELECCIONE ACTIVIDAD</label>
					<select id="selectactividad" class="form-control selectpicker show-tick" data-live-search="true">
                          	<?php while($row=mysql_fetch_assoc($resultado['sinasignar'])): ?>
                              	<option value="<?php echo $row['id'];?>"><?php echo ucwords(strtolower($row['nombre']));?></option>
                          	<?php endwhile; ?>
                      	</select>
				</div>
				<div class="form-group  has-feedback has-error fila1">
					<label style="color:#3fd2e0;font-weight:400;font-family:arial;font-size:.8em;margin-bottom:2px">CUANTAS VECES REALIZARÁ ESTA ACTIVIDAD EN TODO EL AÑO?</label>
					<input type="text" id="inputtotal" required class="form-control" placeholder="Ejemplo: 12" validate=true toggle=".fila1">
					<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden=true></span>
				</div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-success"  id="buttonregistro" type="button" disabled>Agregar Actividad a POAI</button>
			</div>
		</div>
	</div>
</div>
