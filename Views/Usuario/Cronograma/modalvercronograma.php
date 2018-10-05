<div class="modal fade" id="vercronogramaModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
               <div class="modal-body" style="padding-top:0;padding-bottom:0;z-index:20">
				<div class="row">
	                   	<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="right: 5px;z-index:100;position:absolute"><span aria-hidden="true">&times;</span></button>
	                   	<div class="col-md-12" height="100%" style="margin:0px;background:#3a3a3a;padding-top:15px;padding-left: 0;padding-right: 2px;z-index:-50;">
                              <img src="<?php echo URL;?>public/images/icons/64/user2.png" alt="profile" class="center-block"  style="width: 100px;padding:5px;margin-top:0px">
	                       	<center class="unombre">
	                           	<h5  style="color: #abaaaa;margin-top:0;margin-bottom:0px;text-transform:uppercase;z-index:900">nombre del usuario</h5>
							<p style="margin:0px;color:#ced161;font-weight: 700;">CI: 23423434</p>
							<h6 style="margin:0 0 5px 0;color:#dcdcdc;font-weight: 400;">Usuario</h6>
						</center>
                         </div>
                         <div class="col-md-6">
                              <center>
	                           	<img src="<?php echo URL;?>public/images/icons/32/new-file.png"  style="padding:15px 0 5px 0;margin-top:0px;color:#313131">
	                           	<br><p class="uactividad" style="line-height: .95em !important;text-transform: lowercase;color:#797979">terwterwter</p>
	                       	</center>
                         </div>
                         <div class="col-md-6">
                              <center>
	                           	<img src="<?php echo URL;?>public/images/icons/32/placeholder.png"  style="padding:15px 0 5px 0;margin-top:0px">
		                         <br><p class="uciudad" style="line-height: .95em !important;color:#797979">reterterte</p>
	                       	</center>
                         </div>
                         <div class="col-md-6">
                              <center>
	                           	<img src="<?php echo URL;?>public/images/icons/32/car.png"  style="padding:15px 0 5px 0;margin:0">
	                           	<br><p class="uviaje" style="line-height: .95em !important;color:#797979">rtertrte</p>
	                       	</center>
                         </div>
                         <div class="col-md-6">
                              <center>
	                           	<img src="<?php echo URL;?>public/images/icons/32/hospital.png"  style="padding:15px 0 5px 0;margin-top:0px">
	                           	<br><p class="uestablecimiento" style="line-height: .95em !important;color:#797979">reterter</p>
	                       	</center>
                         </div>
					<div class="col-md-6">
                              <center>
	                           	<img src="<?php echo URL;?>public/images/icons/32/place.png"  style="padding:15px 0 5px 0;margin:0">
	                           	<br><p class="ulugar" style="line-height: .95em !important;color:#797979">tertrte</p>
	                       	</center>
                         </div>
                         <div class="col-md-6">
                              <center>
	                           	<img src="<?php echo URL;?>public/images/icons/32/guidepost.png"  style="padding:15px 0 5px 0;margin-top:0px">
	                           	<br><p class="utipo" style="line-height: .95em !important;color:#797979">rtreter</p>
	                       	</center>
                         </div>
					<div class="col-md-6">
                              <center>
	                           	<img src="<?php echo URL;?>public/images/icons/32/calendar1.png"  style="padding:15px 0 5px 0;margin:0">
	                           	<br><p class="ufechade" style="line-height: .95em !important;color:#797979">tertrte</p>
	                       	</center>
                         </div>
                         <div class="col-md-6">
                              <center>
	                           	<img src="<?php echo URL;?>public/images/icons/32/calendar.png"  style="padding:15px 0 5px 0;margin-top:0px">
	                           	<br><p class="ufechahasta" style="line-height: .95em !important;color:#797979">rtreter</p>
	                       	</center>
                         </div>
                    </div>
               </div>
               <div class="modal-footer" style="border-left:10px solid  #84da92;margin-top: 15px;padding:5px 0 5px 0">
				<div class="col-md-9">
					<div class="form-group has-error has-feedback fila_validar rowinputvalidate" style="margin:0">
						<input type="text" id="inputobservacion" class="form-control input-sm" placeholder="Ejemplo: se cumplio con la actividad satisfactoriamente">
						<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
					</div>
					<h4 id="vobservacion" style="font-weight:200;color:#ff0000;margin:0;text-align:left">OBSERVACIÓN<span style="font-size:0.8em;font-style: italic;color:#606060;margin-left:10px">la actividad se finalizo con exito</span></h4>
				</div>
				<div class="col-md-3">
					<button class="btn btn-sm" id="btnnovalidado" style="margin:0px;border:1px solid #d52e2e;color:#d52e2e;background:#fff" type="button" onclick="validateAjax()" disabled>SIN VALIDAR <span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
					<button class="btn btn-sm" id="btnvalidado" style="margin:0px;border:1px solid #02bd47;color:#02bd47;background:#fff" type="button">VALIDADO <span class="glyphicon glyphicon-ok" aria-hidden="true"></span></button>
				</div>
               </div>
		</div>
	</div>
</div>
