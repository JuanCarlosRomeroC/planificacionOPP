<div class="modal fade" id="newactividadModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
               <div class="modal-body" style="padding:20px">
                   	<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="right: 9px;top:5px;position:absolute"><span aria-hidden="true">&times;</span></button>
                  	<center><h3 style="margin-top:5px;color: #1cd2dc;font-weight: 700;">NUEVA ACTIVIDAD</h3></center>
			   	<form autocomplete="off">
					<div class="form-group">
						<label style="color:#3fd2e0;font-weight:400;font-family:arial;font-size:.8em;margin-bottom:2px">GESTIÓN</label>
			            	<div class='input-group date' id='dategestion'>
			                	<input readonly type='text' class="form-control" value="<?php echo date('Y'); ?>"/>
			                	<span class="input-group-addon">
			                    	<span class="glyphicon glyphicon-calendar"></span>
			                	</span>
			            	</div>
			        	</div>
					<div class="form-group inputrow1_u" style="margin-bottom:20px">
						<label style="color:#3fd2e0;font-weight:400;font-family:arial;font-size:.8em;margin-bottom:2px">SELECCIONE ACTIVIDAD</label>
						<select id="selectactividad" class="form-control selectpicker show-tick" data-live-search="true">
                               	<?php while($row=mysql_fetch_array($resultado['sinasignar'])): ?>
                                   	<option value="<?php echo $row['id'];?>"><?php echo ucwords(strtolower($row['nombre']));?></option>
                               	<?php endwhile; ?>
                           	</select>
					</div>
                       	<center>
                           	<button class="btn btn-success btn-lg" style="margin:30px 0 0 0" id="buttonagregaractividad" type="button">Guardar</button>
                       	</center>
				</form>
               </div>
		</div>
	</div>
</div>
