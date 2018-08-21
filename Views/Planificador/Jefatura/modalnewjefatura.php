<div class="modal fade" id="newjefaturaModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header" style="background:#3fd2e0">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" style="color:#fff">REGISTRO DE NUEVA JEFATURA</h4>
			</div>
			<div class="modal-body" style="margin:0;padding:0">
				<form  class="form-horizontal" autocomplete="off">
					<div class="form-group  has-feedback has-error fila1" style="margin-left:40px;margin-right:40px;margin-top:25px;margin-bottom:25px">
						<label class="col-sm-2 control-label">Nombres</label>
						<div class="col-sm-10">
							<input type="text" name="nombre" id="inputnombre" required class="form-control" placeholder="Ejemplo: jefatura de seguros de salud" validate=true toggle=".fila1">
							<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden=true></span>
							<em style="color:#cf6666;display:none" id="error_registro">El nombre de Jefatura ya esta en uso!</em>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
					<button class="btn btn-success" type="button" id="btnregistrar" disabled>REGISTRAR</button>
			</div>
		</div>
	</div>
</div>
