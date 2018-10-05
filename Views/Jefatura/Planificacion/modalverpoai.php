<div class="modal fade bs-example-modal-lg" id="verpoaiModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
     <div class="modal-dialog" role="document">
          <div class="modal-content">
               <div class="modal-body" style="padding:0;z-index:20">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="right: 5px;z-index:100;position:absolute"><span aria-hidden="true">&times;</span></button>

				<div class="row" style="margin:0px;height:180px;background:#cd9850;padding:0 10px 0 0;">
					<center>
						<div class="canvas-wrap" style="top: -60px;">
						  	<canvas id="canvas" width="300" height="300"></canvas>
						  	<span id="procent"></span>
						</div>
					</center>
				</div>
				<div class="row" style="margin:0px;background:#cd9850;padding:0 10px 0 0;">
                         <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12" style="margin:0px;padding:0 0 15px 0;">
                              <center>
	                           	<img src="<?php echo URL;?>public/images/icons/32/manager.png"  style="padding:15px 0 5px 0;margin:0">
                                   <br><p style="line-height: .95em !important;color:#ffc97f;margin:1px">NOMBRES</p>
	                           	<p style="line-height: .95em !important;color:#fffcf1;margin:1px"><?php echo $resultado['titulo']['nombre']." ".$resultado['titulo']['apellido']?></p>
	                       	</center>
                         </div>
                         <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12" style="margin:0px;padding:0 0 15px 0;">
                              <center>
	                           	<img src="<?php echo URL;?>public/images/icons/32/profiles.png"  style="padding:15px 0 5px 0;margin-top:0px;">
                                   <br><p style="line-height: .95em !important;color:#ffc97f;margin:1px">ACTIVIDADES</p>
                                   <p class="vfecha_de" style="line-height: .95em !important;text-transform: lowercase;color:#fffcf1;margin:1px"><?php echo count($resultado["actividades"]) ?></p>
                              </center>
                         </div>
					<div class="col-md-4 col-lg-4 col-sm-4 col-xs-12" style="margin:0px;padding:0 0 15px 0;">
                              <center>
	                           	<img src="<?php echo URL;?>public/images/icons/32/elaborado.png"  style="padding:15px 0 5px 0;margin:0">
                                   <br><p style="line-height: .95em !important;color:#ffc97f;margin:1px">GESTIÓN</p>
	                           	<p class="vfecha_elaboracion" style="line-height: .95em !important;text-transform: lowercase;color:#fffcf1;margin:1px"><?php echo $resultado['year']?></p>
	                       	</center>
                         </div>
                    </div>
				<div class="row"  style="margin:15px 0 0 0">
					<div class="col-md-12">
						<div class="table-responsive">
							<table id="tableactividades" class="table table-striped table-condensed table-hover">
								<thead>
									<th width="78%">nombre de la actividad</th>
									<th width="17%">estado</th>
								</thead>
								<tbody>
									<?php for($i=0; $i<count($resultado["actividades"]);$i++): ?>
										<tr>
											<td style="text-align:left;padding-left:9px;vertical-align:inherit"><h5 style="text-align:left"><?php echo ucwords(strtolower($resultado['actividades'][$i]['actividad'])); ?></h5></td>
                                                       <?php if ($resultado['actividades'][$i]['porcentaje']!=0) {
                    								$media=100/($resultado['actividades'][$i]['total']);
                    								$porcentaje=round($resultado['actividades'][$i]['porcentaje']*$media);
                                                            echo '<td><div class="progress"><div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="'.$porcentaje.'" aria-valuemin="0" aria-valuemax="100" style="background:#cd9850;min-width: 2em;width: '.$porcentaje.'%;">'.$porcentaje.'% </div></div></td>';
                                                       } else{
                                                            echo '<td><div class="progress"><div  class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="background:#cd9850;min-width: 2em;width: 0%;">0% </div></div></td>';
                                                       }?>
										</tr>
									<?php endfor; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
               </div>
          </div>
     </div>
</div>
