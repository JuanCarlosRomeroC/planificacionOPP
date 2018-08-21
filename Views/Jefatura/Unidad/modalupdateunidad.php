<div class="modal fade" id="updateunidadModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
               <div class="modal-body" style="padding-top:0;padding-bottom:0;">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top:8px;"><span aria-hidden="true">&times;</span></button>
                    <div class="row">
	                   	<div class="col-md-3" height="100%" style="margin:0px;background:#0c2544;padding-top:40px;padding-left: 0;padding-right: 2px;height: 590px;">
	                       	<img src="<?php echo URL;?>public/images/icons/64/home1.png" alt="profile" class="center-block" width="110px" style="padding:10px;margin-top:0px">
	                       	<center>
	                           	<h5 class="unombre" style="color: #f2fafd;margin-top:0;margin-bottom:1px;text-transform:uppercase;"></h5>
							<button type="button" id="buttoneditar_update" class="btn btn-link" style="margin-bottom:14px;">Editar</button>
						</center>
	                       	<center>
	                           	<img src="<?php echo URL;?>public/images/icons/32/manager.png"  style="padding:15px 0 5px 0;margin-top:0px">
	                           	<br><p style="margin:1px 0 1px 0;color:#afa95d;font-weight: 400;">JEFE DE UNIDAD</p>
							<p class="ujefe" style="line-height: .95em !important;text-transform: lowercase;color:#cde9e5">Juan Colmillo</p>
	                       	</center>
						<center>
	                           	<img src="<?php echo URL;?>public/images/icons/32/group.png"  style="padding:15px 0 5px 0;margin-top:0px">
	                           	<br><p style="margin:1px 0 1px 0;color:#afa95d;font-weight: 400;">TOTAL USUARIOS</p>
							<p class="uusuarios" style="line-height: .95em !important;text-transform: lowercase;color:#cde9e5">2</p>

	                       	</center>
						<center>
	                           	<img src="<?php echo URL;?>public/images/icons/32/status.png"  style="padding:15px 0 5px 0;margin-top:0px">
	                           	<br><p style="margin:1px 0 1px 0;color:#afa95d;font-weight: 400;">ESTADO</p>
							<p class="uestado" style="line-height: .95em !important;text-transform: lowercase;color:#cde9e5">Activo</p>
	                       	</center>
	                   	</div>
                        	<div class="col-md-9">
						<div class="row" id="editbox_update"  style="display:none">
							<div class="col-md-8 col-md-offset-2">
								<center><h3 style="margin-top:0;color: #1cd2dc;font-weight: 700;">MODIFICAR UNIDAD</h3></center>
								<label>NOMBRE</label>
								<div class="form-group has-success has-feedback fila1_u">
								  	<input type="text" class="form-control input-sm" id="inputnombre_u"  validate="false" toggle=".fila1_u" aria-describedby="helpBlock2">
								  	<span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
									<em id="error_update" style="color:#f25858;display:none;">El nombre de unidad ya esta en uso!</em>
								</div>
							</div>
							<?php mysql_data_seek($resultado['jefaturas'], 0);?>
							<div class="col-md-8 col-md-offset-2" style="">
								<label>JEFATURA</label>
								<div class="form-group">
									<select name="id_jefatura" id="selectjefatura_u" class="form-control selectpicker show-tick" data-live-search="true">
	                                    		<?php while($row=mysql_fetch_array($resultado['jefaturas'])): ?>
	                                        		<option value="<?php echo $row['id'];?>"><?php echo ucwords(strtolower($row['nombre']));?></option>
	                                    		<?php endwhile; ?>
	                                		</select>
								</div>
							</div>
							<div class="col-md-8 col-md-offset-2" style="margin:3px;padding:0">
								<center>
									<button type="button" class="btn btn-success btn-sm" id="buttonupdate" disabled style="margin-right:3px">Guardar
									<button type="button" class="btn btn-danger btn-sm" id="buttoncancel_update">Cancelar
								</center>
							</div>
						</div>
						<div class="row" id="listuserbox_update" style="margin:0 10px 10px 10px">
							<div class="col-md-12">
								<center><h3 style="margin-top:0;color: #1cd2dc;font-weight: 700;">LISTA DE USUARIOS</h3></center>
							</div>
							<table class="table  table-bordered" id="tableunidad">
							</table>
							<div class="row" id="alert_empty_usuario"> <!-- SECTION EMPTY TABLE -->
							<div class="col-md-12">
								<div class="alert alert-error" role="alert">
									<strong>MENSAJE DE ALERTA!</strong> No se encontraron USUARIOS activos o registrados.
								</div>
							</div>
						</div>
						</div>
					</div>
				</div>
               </div>
		</div>
	</div>
</div>
