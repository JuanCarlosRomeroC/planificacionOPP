<div class="modal fade" id="newcargoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header" style="background:#3fd2e0">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" style="color:#fff">REGISTRO DE NUEVO CARGO</h4>
			</div>
			<div class="modal-body" style="margin:20px;padding:30px:">
				<div class="form-group  has-feedback has-error fila1">
					<label>Nombre del Cargo</label>
					<input type="text" id="inputnombre" class="form-control" placeholder="Ejemplo: Desarrollador de Software." validate=true toggle=".fila1">
					<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden=true></span>
					<em style="color:#cf6666;display:none" id="error_registro">El Nombre del Cargo ya esta en uso!</em>
				</div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-success" type="button" id="btnregistrar" disabled>REGISTRAR</button>
			</div>
		</div>
	</div>
</div>
