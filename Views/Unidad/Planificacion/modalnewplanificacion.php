<div class="modal fade" id="newplanificacionModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header" style="background:#3fd2e0">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" style="color:#fff">REGISTRO DE NUEVA PLANIFICACION</h4>
			</div>
			<div class="modal-body" style="margin:0;padding:0">
				<form  class="form-horizontal" autocomplete="off" style="margin:25px 40px 25px 40px">
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
					<div class="form-group has-feedback has-success fila1">
						<label class="col-sm-2 control-label">Fecha de</label>
						<div class="col-sm-10" >
				            	<div class='input-group date' id='datetimepicker1'>
				                	<input readonly type='text' class="form-control" value="<?php echo date('Y-m-d'); ?>"  validate="true"/>
				                	<span class="input-group-addon">
				                    	<span class="glyphicon glyphicon-calendar"></span>
				                	</span>
				            	</div>
							<em style="color:#cf6666;display:none" id="error_fechade">Se debe programar para este mes o mes siguiente (dia>=hoy)..</em>
						</div>
			        	</div>
					<div class="form-group has-feedback has-success fila2">
						<label class="col-sm-2 control-label">Hasta</label>
						<div class="col-sm-10">
				            	<div class='input-group date' id='datetimepicker2'>
				                	<input readonly type='text' class="form-control" value="<?php echo date('Y-m-d'); ?>" validate="true"/>
				                	<span class="input-group-addon">
				                    	<span class="glyphicon glyphicon-calendar"></span>
				                	</span>
				            	</div>
							<em style="color:#cf6666;display:none" id="error_fechahasta">debe de estar en el mismo mes -> FECHA DE (dia igual o posterior)</em>
						</div>
			        	</div><hr>
					<h3 style="color:#3dbed5"><strong>OBJETIVOS</strong></h3>
					<div class="form-group">
						<div class="col-sm-2 col-xs-12">
							<button type="button" id="buttonadd_objetivo" class="btn btn-info" info="" validate="true">AGREGAR <span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>
						</div>
						<div class="col-sm-10 col-xs-12">
							<input type="text" min="1" id="input_objetivo" class="form-control" placeholder="Ejemplo: Actualizacion de antivirus">
						</div>
					</div>
					<ul class="list-group"  id="objetivo_caja" >
					</ul>
					<hr>
					<h3 style="color:#ffc53d"><strong>RESULTADOS ESPERADOS</strong></h3>
					<div class="form-group">
						<div class="col-sm-2 col-xs-12">
							<button type="button" id="buttonadd_resultado" class="btn btn-warning" info="" validate="true">AGREGAR <span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>
						</div>
						<div class="col-sm-10 col-xs-12">
							<input type="text" id="input_obtenido" class="form-control" placeholder="Ejemplo: Información Centralizada">
						</div>
					</div>
					<ul class="list-group"  id="obtenido_caja" >
					</ul>
				</form>
			</div>
			<div class="modal-footer" style="border-left:10px solid  #84da92;margin-top: 15px;padding:10px 0 10px 0">
					<div class="col-md-9">
						<h3 style="font-weight:200;color:#ff0000;margin:0;text-align:left">NOTA<span style="font-size:0.5em;font-style: italic;color:#777575;margin-left:15px">el boton de registro de habilitara una vez llene toda la información</span></h3>
					</div>
					<div class="col-md-3">
						<button class="btn btn-success" id="btnregistrar" data-loading-text="Registrando Planificacion..." autocomplete="off" type="button" onclick="window.onbeforeunload = null;" disabled>REGISTRAR</button>
					</div>
	      	</div>
		</div>
	</div>
</div>
