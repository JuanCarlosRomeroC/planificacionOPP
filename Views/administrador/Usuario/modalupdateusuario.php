<div class="modal fade" id="updateusuarioModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
            <form action="POST">
                <div class="modal-body" style="padding-top:0;padding-bottom:0;z-index:20">
                    <div class="row"  style="display:none">
                        <center style="margin:150px"><img src="<?php echo $_URL;?>public/images/icons/loading.gif" alt="loading"></center>
                    </div>
                    <div class="row">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top:8px;margin-right:8px;z-index:100"><span aria-hidden="true">&times;</span></button>
                        <div class="col-md-4" height="100%" style="margin:0px;background:#3fd2e0;padding-top:40px;z-index:-50">
                            <img src="<?php echo $_URL;?>public/images/icons/user_circle.png" alt="profile" class="center-block" width="110px" style="padding:10px;margin-top:0px">
                            <center>
                                <h5 style="color: #f2fafd;margin-top:0;margin-bottom:20px;text-transform:uppercase;z-index:900">Limbert <br> Arando Benavides</h5>
                            </center>

                            <center>
                                <img src="<?php echo $_URL;?>public/images/icons/32/big-id-card.png"  style="padding:10px;margin-top:0px">
                                <br><small>5465644</small>
                            </center>
                            <center>
                                <img src="<?php echo $_URL;?>public/images/icons/32/briefcase.png"  style="padding:10px;margin-top:0px">
                                <br><small>Ingenierio de Sistemas</small>
                            </center>
                            <center>
                                <h4>JEFATURA<br> <small>5466756457</small></h4>
                            </center>
                            <center>
                                <h4>UNIDAD<br> <small>calle america #3243</small></h4>
                            </center>
                            <center>
                                <h4>TELEFONO<br> <small>5466756457</small></h4>
                            </center>
                        </div>
                        <?php mysql_data_seek($resultado['unidades'], 0);mysql_data_seek($resultado['cargos'],0);?>
                        <div class="col-md-8">
                            <center><h3 style="margin-top:0;color: #1cd2dc;font-weight: 700;">MODIFICAR USUARIO</h3></center>
                            <div class="form-group has-feedback has-succes fila1_u" style="margin-bottom:10px">
                                <label style="color:#3fd2e0;font-weight:400;font-family:arial;font-size:.8em;margin-bottom:2px">NOMBRES</label>
                                <input type="text" name="nombre" id="inputnombre_u" class="form-control" validate="false" toggle=".fila1_u">
                                <span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
                            </div>
                            <div class="form-group has-feedback has-succes fila2_u" style="margin-bottom:10px">
                                <label style="color:#3fd2e0;font-weight:400;font-family:arial;font-size:.8em;margin-bottom:2px">APELIDOS</label>
                                <input type="text" name="apellido" id="inputapellido_u" class="form-control" validate="false" toggle=".fila2_u">
                                <span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
                            </div>
                            <div class="form-group has-feedback has-succes fila3_u" style="margin-bottom:10px">
                                <label style="color:#3fd2e0;font-weight:400;font-family:arial;font-size:.8em;margin-bottom:2px">NÚMERO DE CARNET</label>
                                <input type="number" name="ci" id="inputci_u" min="1" required class="form-control" validate="false" toggle=".fila3_u">
                                <span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
                            </div>
                            <div class="form-group" style="margin-bottom:10px">
                                <label style="color:#3fd2e0;font-weight:400;font-family:arial;font-size:.8em;margin-bottom:2px">CARGO</label>
                                <select name="jefatura" id="selectcargo_u" class="form-control selectpicker show-tick" data-live-search="true">
                                    <?php while($row=mysql_fetch_array($resultado['cargos'])): ?>
                                        <option value="<?php echo $row['id'];?>"><?php echo ucwords(strtolower($row['nombre']));?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                            <div class="form-group" style="margin-bottom:10px">
                                <label style="color:#3fd2e0;font-weight:400;font-family:arial;font-size:.8em;margin-bottom:2px">UNIDAD</label>
                                <select name="unidad" id="selectunidad_u" class="form-control selectpicker show-tick" data-live-search="true">
                                    <?php while($row=mysql_fetch_array($resultado['unidades'])): ?>
                                        <option value="<?php echo $row['id'];?>"><?php echo ucwords(strtolower($row['nombre']));?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                            <div class="form-group" style="margin-bottom:10px">
                                <label style="color:#3fd2e0;font-weight:400;font-family:arial;font-size:.8em;margin-bottom:2px">NÚMERO DE TELEFONO</label>
                                <input type="number" name="telefono" min="1" id="inputtelefono_u" required class="form-control">
                            </div>
                            <center>
                                <button class="btn btn-warning" style="margin:10px 0 20px 0px" id="buttonupdate" type="submit" disabled>Guardar</button>
                            </center>

                        </div>
					</div>
                </div>
            </form>
		</div>
	</div>
</div>
