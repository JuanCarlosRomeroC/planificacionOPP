<div class="modal fade" id="updateusuarioModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
               <div class="modal-body" style="padding-top:0;padding-bottom:0;z-index:20">
				<div class="row">
	                   	<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="right: 5px;z-index:100;position:absolute"><span aria-hidden="true">&times;</span></button>
	                   	<div class="col-md-4" height="100%" style="margin:0px;background:#0c2544;padding-top:20px;padding-left: 0;padding-right: 2px;z-index:-50;height: 560px;">
	                       	<img src="<?php echo URL;?>public/images/icons/64/man.png" alt="profile" class="center-block" width="110px" style="padding:10px;margin-top:0px">
	                       	<center class="unombre">
	                           	<h5  style="color: #f2fafd;margin-top:0;margin-bottom:0px;text-transform:uppercase;z-index:900">Limbert <br> Arando Benavides</h5>
						  	<p style="margin-bottom:0;color:#f7e70e;font-weight: 700;"></p>
							<em style="margin-bottom:15px;color:#36bb5d;font-weight: 700;"> Administrador</em>
						</center>
	                       	<center>
	                           	<img src="<?php echo URL;?>public/images/icons/32/briefcase.png"  style="padding:15px 0 5px 0;margin-top:0px">
	                           	<br><p class="ucargo" style="line-height: .95em !important;text-transform: lowercase;color:#cde9e5"></p>
	                       	</center>
						<center>
	                           	<img src="<?php echo URL;?>public/images/icons/32/hotel.png"  style="padding:15px 0 5px 0;margin-top:0px">
		                         <br><p class="ujefatura" style="line-height: .95em !important;text-transform: lowercase;color:#cde9e5"></p>
	                       	</center>
						<center>
	                           	<img src="<?php echo URL;?>public/images/icons/32/home.png"  style="padding:15px 0 5px 0;margin-top:0px">
	                           	<br><p class="uunidad" style="line-height: .95em !important;text-transform: lowercase;color:#cde9e5"></p>
	                       	</center>
						<center>
	                           	<img src="<?php echo URL;?>public/images/icons/32/call.png"  style="padding:15px 0 5px 0;margin-top:0px">
	                           	<br><p class="utelefono" style="line-height: .95em !important;text-transform: lowercase;color:#cde9e5"></p>
	                       	</center>
	                   	</div>
	                   	<div class="col-md-8">
	                       	<center><h3 style="margin-top:25px;color: #1cd2dc;font-weight: 700;">MODIFICAR MI PERFIL</h3></center>
					   	<form autocomplete="off">
	                            	<div class="form-group has-feedback has-success fila1_u" style="margin-bottom:15px">
	                                <label style="color:#3fd2e0;font-weight:400;font-family:arial;font-size:.8em;margin-bottom:2px">NOMBRES</label>
	                                <input type="text" id="inputnombre_u" class="form-control">
	                                <span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
	                            	</div>
	                            	<div class="form-group has-feedback has-success fila2_u" style="margin-bottom:15px">
	                                <label style="color:#3fd2e0;font-weight:400;font-family:arial;font-size:.8em;margin-bottom:2px">APELIDOS</label>
	                                <input type="text" id="inputapellido_u" class="form-control">
	                                <span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
	                            	</div>
	                            	<div class="form-group has-feedback has-success fila3_u" style="margin-bottom:15px">
	                                <label style="color:#3fd2e0;font-weight:400;font-family:arial;font-size:.8em;margin-bottom:2px">NÚMERO DE CARNET</label>
	                                <input type="number" autocomplete="false" id="inputci_u" min="1" class="form-control">
	                                <span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
							  	<em style="color:#cf6666;display:none" id="error_update">El carnet de identidad ya esta en uso!</em>
							</div>
						   	<div class="form-group has-feedback has-error fila4_u" style="margin-bottom:15px">
	                            		<label style="color:#3fd2e0;font-weight:400;font-family:arial;font-size:.8em;margin-bottom:2px">NUEVA CONTRASEÑA <small> (OPCIONAL)</small></label>
	                                	<input type="password" autocomplete="false" autocorrect="off" class="form-control" id="inputpassword_u" placeholder="Minimo 5 caracteres">
	                                	<span toggle="#inputpassword_u" id="togglepassword_u" class="fa fa-fw fa-eye field-icon"></span>
						   	</div>
							<div class="form-group" style="margin-bottom:15px">
	                                	<label style="color:#3fd2e0;font-weight:400;font-family:arial;font-size:.8em;margin-bottom:2px">CARGO</label>
	                                	<select id="selectcargo_u" class="form-control selectpicker show-tick input-sm" data-live-search="true">
	                                    	<?php while($row=mysql_fetch_array($resultado['cargos'])): ?>
	                                        	<option value="<?php echo $row['id'];?>"><?php echo ucwords(strtolower($row['nombre']));?></option>
	                                    	<?php endwhile; ?>
	                                	</select>
	                            	</div>
							<div class="form-group" style="margin-bottom:15px">
	                                	<label style="color:#3fd2e0;font-weight:400;font-family:arial;font-size:.8em;margin-bottom:2px">NÚMERO DE TELEFONO</label>
	                                	<input type="number" min="1" id="inputtelefono_u" validate="false" class="form-control">
	                            	</div>
	                            	<center>
	                                	<button class="btn btn-success btn-lg col-md-12 col-sm-12 col-xs-12" style="margin:10px 0 18px 0px" id="buttonupdate" type="button" disabled>ACTUALIZAR MI PERFIL</button>
	                            	</center>
						</form>
	                   	</div>
				</div>
               </div>
		</div>
	</div>
</div>
