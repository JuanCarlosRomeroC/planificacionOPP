<div class="modal fade" id="updatejefaturaModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
               <div class="modal-body" style="padding-top:0;padding-bottom:0;z-index:20">
                    <div class="row">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top:8px;"><span aria-hidden="true">&times;</span></button>
	                   	<div class="col-md-3" height="100%" style="margin:0px;background:#0c2544;padding-top:40px;padding-left: 0;padding-right: 2px;height: 535px;">
	                       	<img src="<?php echo URL;?>public/images/icons/64/house.png" alt="profile" class="center-block" width="110px" style="padding:10px;margin-top:0px">
	                       	<center>
	                           	<h5 class="unombre" style="color: #f2fafd;margin-top:0;margin-bottom:1px;text-transform:uppercase;"></h5>
							<button type="button" id="buttoneditar_update" class="btn btn-link" style="margin-bottom:9px;">Editar</button>
						</center>
	                       	<center>
	                           	<img src="<?php echo URL;?>public/images/icons/32/manager.png"  style="padding:15px 0 5px 0;margin-top:0px">
	                           	<br><p style="margin:1px 0 1px 0;color:#afa95d;font-weight: 400;">JEFE DE JEFATURA</p>
							<p class="ujefe" style="line-height: .95em !important;text-transform: lowercase;color:#cde9e5">Juan Colmillo</p>
	                       	</center>
						<center>
	                           	<img src="<?php echo URL;?>public/images/icons/32/home.png"  style="padding:15px 0 5px 0;margin-top:0px">
	                           	<br><p style="margin:1px 0 1px 0;color:#afa95d;font-weight: 400;">TOTAL UNIDADES</p>
							<p class="uunidad" style="line-height: .95em !important;text-transform: lowercase;color:#cde9e5">2</p>

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
									<center><h3 style="margin-top:0;color: #1cd2dc;font-weight: 700;">MODIFICAR JEFATURA</h3></center>
								<label>NOMBRE</label>
								<div class="form-group has-success has-feedback fila1_u">
								  	<input type="text" class="form-control input-sm" id="inputnombre_u"  validate="false" toggle=".fila1_u">
								  	<span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
									<em id="error_update" style="color:#f25858;display:none;">El nombre de la jefatura ya esta en uso!</em>
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
							<center><h3 style="margin-top:0;color: #1cd2dc;font-weight: 700;">LISTA DE UNIDADES</h3></center>
							<table class="table  table-bordered" id="tablejefatura">
							</table>
							<div class="row" id="alert_empty_unidad"> <!-- SECTION EMPTY TABLE -->
								<div class="col-md-12">
									<div class="alert alert-error" role="alert">
										<strong>MENSAJE DE ALERTA!</strong> No se encontraron UNIDADES activas o registradas.
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
