<div class="modal fade" id="newotraplanificacionModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header" style="background:#3fd2e0">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" style="color:#fff">REGISTRO DE NUEVA PLANIFICACION</h4>
			</div>
			<div class="modal-body" style="margin:20px;padding:0">

				<div class="panel-group" id="accordion3" role="tablist" aria-multiselectable="true">
					<div class="panel panel-default">
						<div class="panel-heading" style="background:#383838;height:50px;padding:0 0 10px 15px" id="heading1" href="#collapse5" data-parent="#accordion3">
							<div class="col-md-10 col-sm-10 col-xs-8" style="padding:0">
								<h4 class="panel-title" style="color:#fff;font-size:1.8em;font-weight:200"><img style="margin-right: 10px;padding:0" src="<?php echo URL;?>public/images/icons/64/car.png" width="50px">VIAJE?</h4>
							</div>
							<style> .toggle.ios, .toggle-on.ios, .toggle-off.ios { border-radius: 20px; } , .toggle.ios .toggle-handle { border-radius: 20px; }</style>
							<div class="col-md-2 col-sm-2 col-xs-4" style="margin-top:8px">
								<input type="checkbox" data-toggle="toggle" data-onstyle="danger" style="float:right" data-on="Si"  data-off="No" data-style="ios" id="checkviaje" validate=true>
							</div>
						</div>
						<div id="collapse5" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading1" style="display:none">
							<div class="panel-body">
								<div class="col-md-12" style="padding:0 20px 0 20px;">
									<center style="margin-bottom:15px">
										<label class="radio-inline" style="margin-right:20px">
										  	<input type="radio" checked name="inline"  class="checklugar" value="departamental" validate=true> DEPARTAMENTAL
										</label>
										<label class="radio-inline">
										  	<input type="radio" name="inline" class="checklugar" value="provincial" validate=true> PROVINCIAL
										</label>
									</center>
									<div class="form-group classdepartamental">
										<label>Ciudad</label>
										<select id="selectdepartamento" class="form-control">
											<option value="potosi">Potosí</option>
											<option value="lapaz">La Paz</option>
											<option value="cochabamba">Cochabamba</option>
											<option value="santacruz">Santa Cruz</option>
											<option value="tarija">Tarija</option>
											<option value="chuquisaca">Chuquisaca</option>
											<option value="oruro">Oruro</option>
											<option value="beni">Beni</option>
											<option value="pando">Pando</option>
										</select>
									</div>
									<div class="form-group classprovincial" style="display:none">
										<label>Red De Salud</label>
										<select id="selectredsalud" class="form-control selectpicker show-tick" data-live-search="true" validate=true>
											<?php while($row=mysql_fetch_array($resultado['redsalud'])): ?>
												<option value="<?php echo $row['id'];?>"><?php echo ucwords(strtolower($row['nombre']));?></option>
											<?php endwhile;?>
										</select>
									</div>
									<div class="form-group classprovincial" style="display:none">
										<label>Municipio</label>
										<select id="selectmunicipio" class="form-control selectpicker show-tick" data-live-search="true" data-show-subtext="true" validate=true>
											<option disabled selected value> -- seleccione un municipio -- </option>
											<?php while($row=mysql_fetch_array($resultado['municipios'])): ?>
												<option value="<?php echo $row['id_redsalud'];?>" municipio="<?php echo $row['id'];?>" data-subtext="<?php echo ucwords(strtolower($row['redsalud']));?>"><?php echo ucwords(strtolower($row['nombre']));?></option>
											<?php endwhile;?>
										</select>
									</div>
									<div class="form-group classprovincial" style="display:none">
										<label>Establecimiento</label>
										<select id="selectestablecimiento" class="form-control selectpicker show-tick" data-live-search="true" data-show-subtext="true" validate=true>
											<option disabled selected value> -- seleccione un establecimiento -- </option>
											<?php while($row=mysql_fetch_array($resultado['establecimientos'])): ?>
												<option value="<?php echo $row['id_municipio'];?>" toggle="<?php echo $row['id'];?>" data-subtext="<?php echo ucwords(strtolower($row['municipio']));?>"><?php echo ucwords(strtolower($row['nombre']));?></option>
											<?php endwhile;?>
										</select>
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>
				<form  class="form-horizontal" autocomplete="off">
					<div class="form-group">
						<label class="col-sm-2 control-label">Actividad</label>
						<div class="col-sm-10">
							<select id="selectactividad" class="form-control selectpicker show-tick" data-live-search="true">
								<?php while($row=mysql_fetch_array($resultado['otraactividad'])): ?>
									<option value="<?php echo $row['id'];?>"><?php echo ucwords(strtolower($row['nombre']));?></option>
								<?php endwhile;?>
							</select>
						</div>
					</div>

					<div class="form-group  has-feedback has-error fila1">
						<label class="col-sm-2 control-label">Lugar</label>
						<div class="col-sm-10">
							<input type="text" id="inputlugar" class="form-control" placeholder="Lugar donde se ejecutara la planificación" validate=true toggle=".fila1">
							<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden=true></span>
						</div>
					</div>
					<div class="form-group has-feedback has-success fila2">
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
					<div class="form-group has-feedback has-success fila3">
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

				</form>
			</div>
			<div class="modal-footer" style="border-left:10px solid  #84da92;margin-top: 15px;padding:10px 0 10px 0">
					<div class="col-md-9">
						<h3 style="font-weight:200;color:#ff0000;margin:0;text-align:left">NOTA<span style="font-size:0.5em;font-style: italic;color:#777575;margin-left:15px">el boton de registro de habilitara una vez llene toda la información</span></h3>
					</div>
					<div class="col-md-3">
						<button class="btn btn-success" id="btnregistrar" data-loading-text="Registrando Planificacion..." autocomplete="off" type="submit" onclick="window.onbeforeunload = null;" disabled>REGISTRAR</button>
					</div>
	      	</div>
		</div>
	</div>
</div>
