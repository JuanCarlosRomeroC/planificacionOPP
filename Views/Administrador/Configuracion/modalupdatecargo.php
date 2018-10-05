<div class="modal fade" id="updatecargoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header" style="background:#3fd2e0">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" style="color:#fff">MODIFICAR EL CARGO</h4>
			</div>
			<div class="modal-body" style="margin:20px;padding:30px:">
				<div class="form-group  has-feedback has-success fila1_u">
					<label>Nombre del Cargo</label>
					<input type="text" id="inputnombre_u" class="form-control" validate=false toggle=".fila1_u">
					<span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden=true></span>
					<em style="color:#cf6666;display:none" id="error_update">El Nombre del Cargo ya esta en uso!</em>
				</div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-success" type="button" id="buttonupdate" disabled>ACTUALIZAR</button>
			</div>
		</div>
	</div>
</div>
