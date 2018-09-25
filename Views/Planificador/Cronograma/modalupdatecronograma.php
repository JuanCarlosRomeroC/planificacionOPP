<div class="modal fade" id="updatecronogramaModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header" style="background:#3fd2e0">
				<h4 class="modal-title" style="color:#fff">MODIFICAR CRONOGRAMA</h4>
			</div>
			<div class="modal-body" style="margin:0;padding:0">
				<form  class="form-horizontal" autocomplete="off" style="margin:25px 40px 25px 40px">
                         <div class="form-group has-feedback has-error fila1">
						<label>Detalle el porque el Cambio de la fecha</label>
						<textarea id="textareadescripcion" toggle=".fila1_i" validate="true" rows="2" placeholder="EJEMPLO: No se dispone del vehiculo en tal fecha" maxlength="150" style="resize: none;padding:10px"  class="form-control"></textarea>
					</div>
				</form>
			</div>
			<div class="modal-footer" style="border-left:10px solid  #84da92;margin-top: 15px;padding:3px 5px 3px 5px">
                    <button type="button" class="btn btn-danger" id="btncancelar">Cancelar</button>
				<button class="btn btn-success" id="btncambiarfecha" type="button" disabled>CAMBIAR FECHA</button>
	      	</div>
		</div>
	</div>
</div>
