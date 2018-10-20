<div class="modal fade" id="updateplanificacionModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
               <div class="modal-body" style="padding-top:0;padding-bottom:0;z-index:20;background:#0c2544;">
				<div class="row">
	                   	<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="right: 5px;z-index:100;position:absolute"><span aria-hidden="true">&times;</span></button>
	                   	<div class="col-md-3" height="100%" style="margin:0px;background:#0c2544;padding-top:10px;padding-left: 0;padding-right: 2px;z-index:-50;height:100%;">
	                       	<img src="<?php echo URL;?>public/images/icons/128/calendar.png" alt="profile" class="center-block" width="110px" style="padding:10px;margin-top:0px">
	                       	<center>
	                           	<h5  class="unombre" style="color: #f2fafd;margin-top:0;margin-bottom:0px;text-transform:uppercase;z-index:900">Limbert <br> Arando Benavides</h5>
						  	<p style="margin-bottom:0;color:#f7e70e;font-weight: 700;">Sin Validar</p>
						</center>
	                       	<center>
	                           	<img src="<?php echo URL;?>public/images/icons/32/start.png"  style="padding:15px 0 5px 0;margin-top:0px">
	                           	<br><p class="ufechade" style="line-height: .95em !important;text-transform: lowercase;color:#cde9e5"></p>
	                       	</center>
						<center>
	                           	<img src="<?php echo URL;?>public/images/icons/32/end.png"  style="padding:15px 0 5px 0;margin-top:0px">
		                         <br><p class="ufechahasta" style="line-height: .95em !important;text-transform: lowercase;color:#cde9e5"></p>
	                       	</center>
						<center>
	                           	<img src="<?php echo URL;?>public/images/icons/32/elaborado.png"  style="padding:15px 0 5px 0;margin-top:0px">
	                           	<br><p class="uelaborado" style="line-height: .95em !important;text-transform: lowercase;color:#cde9e5"></p>
	                       	</center>
	                   	</div>
	                   	<div class="col-md-9" style="background:#fff;height:100%">
	                       	<center><h4 style="margin-top:15px;color: #1cd2dc;font-weight: 700;">MODIFICAR PLANIFICACION</h4></center>
					   	<form autocomplete="off">
	                            	<div class="form-group" style="margin-bottom:10px">
	                                	<label style="color:#3fd2e0;font-weight:400;font-family:arial;font-size:.8em;margin-bottom:2px">NOMBRE DE LA ACTIVIDAD</label>
							  	<select id="selectactividad_u" class="form-control selectpicker show-tick" data-live-search="true">
									<?php for ($i=0; $i < count($resultado['actividades']) ; $i++) {
										if ($resultado['actividades'][$i]['estado']) {
											echo '<option value="'.$resultado['actividades'][$i]['id'].'">'.$resultado['actividades'][$i]['nombre'].'</option>';
										}
									} ?>
  								</select>
	                            	</div>
	                            	<div class="form-group has-feedback has-success fila1_u" style="margin-bottom:10px">
	                                	<label style="color:#3fd2e0;font-weight:400;font-family:arial;font-size:.8em;margin-bottom:2px">FECHA DE</label>
								<div class='input-group date' id='datetimepicker1_u'>
					                	<input readonly type='text' class="form-control" value="" validate="true"/>
					                	<span class="input-group-addon">
					                    	<span class="glyphicon glyphicon-calendar"></span>
					                	</span>
					            	</div>
								<em style="color:#cf6666;display:none" id="error_fechade_u">Se debe programar para este mes o mes siguiente (dia>=hoy)..</em>
	                            	</div>
	                            	<div class="form-group has-feedback has-success fila2_u" style="margin-bottom:10px">
	                                	<label style="color:#3fd2e0;font-weight:400;font-family:arial;font-size:.8em;margin-bottom:2px">FECHA HASTA</label>
								<div class='input-group date' id='datetimepicker2_u'>
					                	<input readonly type='text' class="form-control" validate="true"/>
					                	<span class="input-group-addon">
					                    	<span class="glyphicon glyphicon-calendar"></span>
					                	</span>
					            	</div>
								<em style="color:#cf6666;display:none" id="error_fechahasta_u">debe de estar en el mismo mes -> FECHA DE (dia igual o posterior)</em>
	                            	</div>
							<center><h4 style="color:#3dbed5"><strong>OBJETIVOS</strong></h4></center>
							<div class="form-group">
								<div class="col-sm-2 col-xs-2">
									<button type="button" id="buttonadd_objetivo_u" class="btn btn-info btn-sm" info="_u" validate="false">AGREGAR <span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>
								</div>
								<div class="col-sm-10 col-xs-10">
									<input type="text" id="input_objetivo_u" class="form-control input-sm" placeholder="Ejemplo: Actualizacion de antivirus">
								</div>
							</div><br>
							<div class="col-md-12" style="margin-top:10px">
								<ul class="list-group"  id="objetivo_caja_u">
								</ul>
							</div>
							<center><h4 style="color:#3dbed5"><strong>RESULTADOS ESPERADOS</strong></h4></center>
							<div class="form-group">
								<div class="col-sm-2 col-xs-2">
									<button type="button" id="buttonadd_resultado_u" class="btn btn-warning btn-sm" info="_u" validate="false">AGREGAR <span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>
								</div>
								<div class="col-sm-10 col-xs-10">
									<input type="text"  id="input_resultado_u" class="form-control input-sm" placeholder="Ejemplo: Equipos computacionales funcionando correctamente">
								</div>
							</div><br>
							<div class="col-md-12" style="margin-top:10px">
								<ul class="list-group"  id="resultado_caja_u">
								</ul>
							</div>
						</form>
	                   	</div>
				</div>
               </div>
			<div class="modal-footer" style="border-left:10px solid  #84da92;margin-top: 0px;padding:10px 0 10px 0">
					<div class="col-md-9">
						<h3 style="font-weight:200;color:#ff0000;margin:0;text-align:left">NOTA<span style="font-size:0.5em;font-style: italic;color:#777575;margin-left:15px">el boton de actualizar de habilitara una vez modifique algún dato</span></h3>
					</div>
					<div class="col-md-3">
						<button class="btn btn-success" id="buttonupdate" data-loading-text="Registrando Planificacion..." autocomplete="off" type="button" onclick="window.onbeforeunload = null;" disabled>ACTUALIZAR</button>
					</div>
	      	</div>
		</div>
	</div>
</div>
