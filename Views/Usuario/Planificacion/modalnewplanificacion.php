<div class="modal fade" id="newplanificacionModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header" style="background:#3fd2e0">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" style="color:#fff">REGISTRO DE NUEVA PLANIFICACION</h4>
			</div>
			<div class="modal-body" style="margin:0;padding:0">
				<form  class="form-horizontal" autocomplete="off">
					<div class="row"  style="margin-left:40px;margin-right:40px;margin-top:25px;margin-bottom:25px">
						<div class="form-group  has-feedback has-error fila1">
							<label class="col-sm-2 control-label">Objetivo</label>
							<div class="col-sm-10">
								<input type="text" id="inputobjetivo" class="form-control" placeholder="Ejemplo: Ejecutar actividades delegadas por el superior" validate=true toggle=".fila1">
								<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden=true></span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Actividades</label>
							<div class="col-sm-10">
								<select id="selectactividad" class="form-control selectpicker show-tick" data-live-search="true">
									<?php while($row=mysql_fetch_array($resultado['actividades'])): ?>
										<option value="<?php echo $row['id'];?>"><?php echo ucwords(strtolower($row['nombre']));?></option>
									<?php endwhile;?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Fecha de</label>
							<div class="col-sm-10" >
					            	<div class='input-group date' id='datetimepicker'>
					                	<input readonly type='text' class="form-control" value="<?php echo date('Y-m-d'); ?>"/>
					                	<span class="input-group-addon">
					                    	<span class="glyphicon glyphicon-calendar"></span>
					                	</span>
					            	</div>
							</div>
				        	</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Hasta</label>
							<div class="col-sm-10">
					            	<div class='input-group date' id='datetimepicker2'>
					                	<input readonly type='text' class="form-control" value="<?php echo date('Y-m-d'); ?>"/>
					                	<span class="input-group-addon">
					                    	<span class="glyphicon glyphicon-calendar"></span>
					                	</span>
					            	</div>
							</div>
				        	</div><hr>
						<h3 style="color:#3dbed5"><strong>RESULTADOS ESPERADOS</strong></h3>
						<div class="form-group">
							<div class="col-sm-2 col-xs-12">
								<button type="button" id="buttonagregar" class="btn btn-warning">AGREGAR <span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>
							</div>
							<div class="col-sm-10 col-xs-12">
								<input type="text" min="1" id="inputresultado" class="form-control" placeholder="Ejemplo: Reducir tiempos de costos">
							</div>
						</div>
						<ul class="list-group"  id="resultado_caja" >



  						</ul>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-info" disabled>Nuevo Objetivo <span class="badge">0</span></button>
				        	<button type="button" class="btn btn-danger" disabled>Eliminar Objetivo</button>
						<button class="btn btn-success" type="button" id="btnregistrar" disabled>REGISTRAR</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
