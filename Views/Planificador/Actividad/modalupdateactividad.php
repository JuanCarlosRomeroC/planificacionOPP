<div class="modal fade" id="updateactividadModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
               <div class="modal-body" style="padding-top:0;padding-bottom:0;z-index:20">
				<div class="row">
	                   	<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="right: 5px;z-index:100;position:absolute"><span aria-hidden="true">&times;</span></button>
	                   	<div class="col-md-4" height="100%" style="margin:0px;background:#0c2544;padding-top:20px;padding-left: 0;padding-right: 2px;z-index:-50;height: 480px;">
	                       	<img src="<?php echo URL;?>public/images/icons/128/test.png" alt="profile" class="center-block" width="110px" style="padding:10px;margin-top:0px">
	                       	<center class="unombre">
	                           	<h5  style="color: #f2fafd;margin-top:0;margin-bottom:0px;text-transform:uppercase;z-index:900"></h5>
						  	<p style="margin-bottom:0;color:#f7e70e;font-weight: 700;"></p>
						</center>
						<center>
	                           	<img src="<?php echo URL;?>public/images/icons/32/hotel.png"  style="padding:15px 0 5px 0;margin-top:0px">
		                         <br><p class="ujefatura" style="line-height: .95em !important;text-transform: lowercase;color:#cde9e5"></p>
	                       	</center>
						<center>
	                           	<img src="<?php echo URL;?>public/images/icons/32/home.png"  style="padding:15px 0 5px 0;margin-top:0px">
	                           	<br><p class="uunidad" style="line-height: .95em !important;text-transform: lowercase;color:#cde9e5"></p>
	                       	</center>
	                   	</div>
	                    <?php mysql_data_seek($resultado['jefaturas'],0);?>
	                   	<div class="col-md-8">
	                       	<center><h3 style="margin-top:5px;color: #1cd2dc;font-weight: 700;">MODIFICAR ACTIVIDAD</h3></center>
					   	<form autocomplete="off">
	                            	<div class="form-group has-feedback has-success fila1_u" style="margin-bottom:20px">
	                                	<label style="color:#3fd2e0;font-weight:400;font-family:arial;font-size:.8em;margin-bottom:2px">NOMBRE DE LA ACTIVIDAD</label>
								<textarea rows="4" id="inputnombre_u" maxlength="250" style="resize: none;" class="form-control"  validate="false" toggle=".fila1_u"></textarea>
	                                	<span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
								<em style="color:#cf6666;display:none" id="error_update">El nombre de Actividad ya esta en uso!</em>
							</div>
							<div class="form-group inputrow1_u" style="margin-bottom:20px">
								<label style="color:#3fd2e0;font-weight:400;font-family:arial;font-size:.8em;margin-bottom:2px">JEFATURA</label>
								<select id="selectjefatura_u" class="form-control selectpicker show-tick" data-live-search="true">
									<option value="0">Sin Asignar</option>
	                                    	<?php while($row=mysql_fetch_array($resultado['jefaturas'])): ?>
	                                        	<option value="<?php echo $row['id'];?>"><?php echo ucwords(strtolower($row['nombre']));?></option>
	                                    	<?php endwhile; ?>
	                                	</select>
							</div>
	                            	<center>
	                                	<button class="btn btn-success btn-lg" style="margin:30px 0 0 0" id="buttonupdate" type="button" disabled>Guardar</button>
	                            	</center>
						</form>
	                   	</div>
				</div>
               </div>
		</div>
	</div>
</div>
