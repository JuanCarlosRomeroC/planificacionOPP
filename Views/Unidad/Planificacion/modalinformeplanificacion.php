<div class="modal fade" id="informeplanificacionModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header" style="background:#3fd2e0">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" style="color:#fff">COMPLETAR INFORME DE PLANIFICACIÓN</h4>
			</div>
			<div class="modal-body" style="margin:0;padding:0">
				<form  class="form-horizontal" autocomplete="off" style="margin:25px 40px 25px 40px">
					<div class="form-group">
						<center>
							<label>Se Realizó la actividad? </label>
							<input type="checkbox" data-toggle="toggle" data-onstyle="danger" style="float:right" data-on="Si"  data-off="No" data-style="ios" id="checkterminado" validate=true checked>
						</center>
					</div>
                         <div class="form-group has-feedback has-error fila1_i">
						<label>Observaciones</label>
						<textarea id="textareaobjetivo" toggle=".fila1_i" validate="true" rows="2" placeholder="EJEMPLO: La planificación se terminó satisfactoriamente" maxlength="150" style="resize: none;padding:10px"  class="form-control"></textarea>
					</div>
				</form>
			</div>
			<div class="modal-footer" style="border-left:10px solid  #84da92;margin-top: 15px;padding:3px 5px 3px 5px">
				<button class="btn btn-success" id="btninforme" type="button" disabled>COMPLETAR INFORME</button>
	      	</div>
		</div>
	</div>
</div>
