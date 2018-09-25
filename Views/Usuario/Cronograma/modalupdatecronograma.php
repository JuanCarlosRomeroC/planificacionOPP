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
						<label style="color:#3fd2e0;font-weight:400;font-family:arial;font-size:.8em;margin-bottom:2px">SELECCIONE ACTIVIDAD</label>
						<?php mysql_data_seek($resultado['actividad'], 0);?>
						<select id="selectactividad_u" class="form-control selectpicker show-tick" data-live-search="true">
							<?php while($row=mysql_fetch_array($resultado['actividad'])): ?>
								<option value="<?php echo $row['id'];?>"><?php echo ucwords(strtolower($row['nombre']));?></option>
							<?php endwhile;?>
						</select>
					</div>
				</div>
				<div class="panel-group" id="accordion3_u" role="tablist" aria-multiselectable="true">
					<div class="panel panel-default">
						<div class="panel-heading" style="background:#383838;height:50px;padding:0 0 10px 15px" id="heading1_u" href="#collapse5_u" data-parent="#accordion3_u">
							<div class="col-md-10 col-sm-10 col-xs-8" style="padding:0">
								<h4 class="panel-title" style="color:#fff;font-size:1.8em;font-weight:200"><img style="margin-right: 10px;padding:0" src="<?php echo URL;?>public/images/icons/64/car.png" width="50px">REALIZARÁ VIAJE?</h4>
							</div>
							<style> .toggle.ios, .toggle-on.ios, .toggle-off.ios { border-radius: 20px; } , .toggle.ios .toggle-handle { border-radius: 20px; }</style>
							<div class="col-md-2 col-sm-2 col-xs-4" style="margin-top:8px">
								<input type="checkbox" data-toggle="toggle" data-onstyle="danger" style="float:right" data-on="Si"  data-off="No" data-style="ios" id="checkviaje_u" validate=false>
							</div>
						</div>
						<div id="collapse5_u" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading1_u" style="display:none">
							<div class="panel-body">
								<div class="col-md-12" style="padding:0 20px 0 20px;">
									<center style="margin-bottom:15px">
										<label class="radio-inline" style="margin-right:20px">
										  	<input type="radio" name="inline"  class="checklugar_u" value="departamental" validate=false> INTER - DEPARTAMENTAL
										</label>
										<label class="radio-inline">
										  	<input type="radio" name="inline" class="checklugar_u" value="provincial" validate=false> INTER - MUNICIPAL
										</label>
									</center>
									<div class="form-group classdepartamental_u">
										<label>Ciudad</label>
										<select id="selectdepartamento_u" class="form-control">
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
									<div class="form-group classprovincial_u" style="display:none">
										<label>Red De Salud</label>
										<select id="selectredsalud_u" class="form-control selectpicker show-tick" data-live-search="true" validate=false>
											<?php while($row=mysql_fetch_array($resultado['redsalud'])): ?>
												<option value="<?php echo $row['id'];?>"><?php echo ucwords(strtolower($row['nombre']));?></option>
											<?php endwhile;?>
										</select>
									</div>
									<div class="form-group classprovincial_u" style="display:none">
										<label>Municipio</label>
										<select id="selectmunicipio_u" class="form-control selectpicker show-tick" data-live-search="true" data-show-subtext="true" validate=false>
											<option disabled selected value> -- seleccione un municipio -- </option>
											<?php while($row=mysql_fetch_array($resultado['municipios'])): ?>
												<option value="<?php echo $row['id_redsalud'];?>" municipio="<?php echo $row['id'];?>" data-subtext="<?php echo ucwords(strtolower($row['redsalud']));?>"><?php echo ucwords(strtolower($row['nombre']));?></option>
											<?php endwhile;?>
										</select>
									</div>
									<div class="form-group classprovincial_u" style="display:none">
										<label>Establecimiento</label>
										<select id="selectestablecimiento_u" class="form-control selectpicker show-tick" data-live-search="true" data-show-subtext="true" validate=false>
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
					<div class="form-group" style="margin-top:8px" id="rowauditorio_u">
						<label class="col-sm-7 col-xs-7 col-md-7 control-label">Hara Uso de Auditorio?</label>
						<div class="col-sm-5 col-xs-5 col-md-5">
						<input type="checkbox" data-toggle="toggle" data-onstyle="success" style="float:right" data-on="Si"  data-off="No" data-style="ios" id="checkauditorio_u" validate=false>
						</div>
					</div>
					<div class="row" style="margin:15px" id="rowlugar_u">
						<div class="form-group  has-feedback has-success fila1_u">
							<label style="color:#3fd2e0;font-weight:400;font-family:arial;font-size:.8em;margin-bottom:2px">LUGAR DE EJECUCIÓN DE LA ACTIVIDAD</label>
							<input type="text" id="inputlugar_u" class="form-control" placeholder="Ejemplo: Hotel Claudia" validate=false toggle=".fila1_u">
							<span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden=true style="right:2px"></span>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer" style="border-left:10px solid  #84da92;margin: 0;padding:10px 0 10px 0">
					<div class="col-md-6">

					</div>
					<div class="col-md-6">
						<button class="btn btn-danger" id="btncancelar" type="button" data-dismiss="modal" aria-label="Close">CANCELAR</button>
						<button class="btn btn-success" id="buttonupdate" type="button">ACTUALIZAR</button>
					</div>
	      	</div>
		</div>
	</div>
</div>
