<div class="modal fade" id="newusuarioModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header" style="background:#3fd2e0">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" style="color:#fff">REGISTRO DE NUEVO ENCARGADO DE AUDITORIO</h4>
			</div>
			<div class="modal-body" style="margin:0;padding:0">
				<form  class="form-horizontal" autocomplete="off">
					<div class="row"  style="margin-left:40px;margin-right:40px;margin-top:25px;margin-bottom:25px">
						<div class="form-group">
							<label class="col-sm-2 control-label">Seleccione Usuario</label>
							<div class="col-sm-10">
								<select name="id_jefatura" id="selectusuario" class="form-control selectpicker show-tick" data-live-search="true">
                                    		<?php while($row=mysql_fetch_array($resultado['usuarios'])): ?>
                                        		<option value="<?php echo $row['id'];?>"><?php echo ucwords(strtolower($row['nombre']));?></option>
                                    		<?php endwhile; ?>
                                		</select>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button class="btn btn-success" type="button" id="btnregistrar">REGISTRAR</button>
			</div>
		</div>
	</div>
</div>
