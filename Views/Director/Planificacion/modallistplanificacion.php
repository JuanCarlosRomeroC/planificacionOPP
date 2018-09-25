<div class="modal fade bs-example-modal-lg" id="verplanificacionModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
     <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
               <div class="modal-body" style="padding:0;z-index:20">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="right: 5px;z-index:100;position:absolute"><span aria-hidden="true">&times;</span></button>
                    <div class="row" style="margin:0px;background:#cd9850;padding:0 10px 0 0;">
                         <div class="col-md-4 col-lg-3 col-sm-6 col-xs-12" style="margin:0px;padding:0 0 15px 0;">
                              <center>
	                           	<img src="<?php echo URL;?>public/images/icons/32/profiles.png"  style="padding:15px 0 5px 0;margin-top:0px;">
                                   <br><p style="line-height: .95em !important;color:#ffc97f;margin:1px">DE</p>
                                   <p class="vfecha_de" style="line-height: .95em !important;text-transform: lowercase;color:#fffcf1;margin:1px"></p>

                              </center>
                         </div>
                         <div class="col-md-4 col-lg-3 col-sm-6 col-xs-12" style="margin:0px;padding:0 0 15px 0;">
                              <center>
	                           	<img src="<?php echo URL;?>public/images/icons/32/end.png"  style="padding:15px 0 5px 0;margin-top:0px">
                                   <br><p style="line-height: .95em !important;color:#ffc97f;margin:1px">HASTA</p>
                                   <p class="vfecha_hasta" style="line-height: .95em !important;text-transform: lowercase;color:#fffcf1;margin:1px"></p>
	                       	</center>
                         </div>
                         <div class="col-md-4 col-lg-3 col-sm-6 col-xs-12" style="margin:0px;padding:0 0 15px 0;">
                              <center>
	                           	<img src="<?php echo URL;?>public/images/icons/32/elaborado.png"  style="padding:15px 0 5px 0;margin:0">
                                   <br><p style="line-height: .95em !important;color:#ffc97f;margin:1px">ELABORADO</p>
	                           	<p class="vfecha_elaboracion" style="line-height: .95em !important;text-transform: lowercase;color:#fffcf1;margin:1px"></p>
	                       	</center>
                         </div>
                         <div class="col-md-4 col-lg-3 col-sm-6 col-xs-12" style="margin:0px;padding:0 0 15px 0;">
                              <center>
	                           	<img src="<?php echo URL;?>public/images/icons/32/printer.png"  style="padding:15px 0 5px 0;margin-top:0px">
                                   <br><p style="line-height: .95em !important;color:#ffc97f;margin:1px">PRESENTADO</p>
	                           	<p class="vfecha_presentacion" style="line-height: .95em !important;text-transform: lowercase;color:#fffcf1;margin:1px"></p>
	                       	</center>
                         </div>
                    </div>
                    <div class="row" style="margin:0px;background:#544025;padding:0px;">
                         <div class="col-md-1 col-lg-1 col-sm-2 col-xs-2" style="margin:0px;padding:0 5px 0 5px;">
	                           	<img src="<?php echo URL;?>public/images/icons/64/writing.png" width="40px" style="padding:15px 0 15px 0;margin-top:0px">
                         </div>
                         <div class="col-md-11 col-lg-11 col-sm-10 col-xs-10" style="margin:0px;padding:0 10px 0 5px;">
                                   <p style="line-height: 1em !important;color:#ffc97f;margin:10px 0 0 0;font-weight:700">ACTIVIDAD</p>
	                           	<p class="vactividad" style="line-height: .95em !important;color:#fffcf1;margin:1px"></p>
                         </div>
                    </div>
                    <ul role="tablist" style="padding:0px;" class="nav nav-tabs nav-justified" id="myTab">
                         <li  role="presentation" class="active"><a style="padding:0 15px 0 15px" href="#objetivo_modal" aria-controls="objetivo_modal" role="tab" data-toggle="tab">OBJETIVOS<h5 id="idcontobjetivos" class="badge" style="background:red;margin-left:10px">0</h5></a></li>
                         <li role="presentation" class="esperadomodal"><a style="padding:0 15px 0 15px" href="#esperado_modal" aria-controls="esperado_modal" role="tab" data-toggle="tab">ESPERADOS<h5 id="idcontesperados" class="badge" style="background:red;margin-left:10px">0</h5></a></li>
                         <li role="presentation" class="obtenidomodal"><a style="padding:0 15px 0 15px" href="#obtenido_modal" aria-controls="obtenido_modal" role="tab" data-toggle="tab">OBTENIDOS<h5 id="idcontobtenidos" class="badge" style="background:red;margin-left:10px">0</h5></a></li>
                    </ul>
                    <div class="row">
                         <div class="tab-content" style="margin:20px 30px 10px 30px">
                              <div id="objetivo_modal" role="tabpanel" class="tab-pane active">
                                   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <table class="table table-striped table-condensed table-hover" style="margin-bottom:0">
                                             <thead style="background-color:#A9D0F5">
                                                  <th width="20%">N°</th>
                                                  <th width="80%">OBJETIVOS TRAZADOS</th>
                                             </thead>
                                             <tbody id="tableobjetivos"></tbody>
                                        </table>
                                   </div>
                              </div>
                              <div id="esperado_modal" role="tabpanel" class="tab-pane">
                                   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <table class="table table-striped table-condensed table-hover">
                                             <thead style="background-color:#A9D0F5">
                                                  <th width="20%">N°</th>
                                                  <th width="80%">RESULTADOS ESPERADOS</th>
                                             </thead>
                                             <tbody id="tableesperados"></tbody>
                                        </table>
                                   </div>
                              </div>
                              <div id="obtenido_modal" role="tabpanel" class="tab-pane">
                                   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <table class="table table-striped table-condensed table-hover">
                                             <thead style="background-color:#A9D0F5">
                                                  <th width="20%">N°</th>
                                                  <th width="80%">RESULTADOS OBJETIVOS</th>
                                             </thead>
                                             <tbody id="tablealcanzados"></tbody>
                                        </table>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
               <div class="modal-footer" style="border-left:10px solid  #84da92;margin-top: 0px;padding:10px 0 10px 0">
					<div class="col-md-12">
						<h3  class="vobservacion" style="font-weight:200;color:#ff0000;margin:0;text-align:left">OBSERVACIONES<span style="font-size:0.6em;font-style: italic;color:#777575;margin-left:15px"></span></h3>
					</div>
	      	</div>
          </div>
     </div>
</div>
