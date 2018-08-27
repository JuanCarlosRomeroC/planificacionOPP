<div class="modal fade bs-example-modal-lg" id="verplanificacionModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"> 
      <!-- SECCION MODAL CREAR SOLICITUD DE VENTA



       -->

    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background:#3fd2e0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title" style="color:#fff"> LISTAR LAS ESTADOS DE LAS PLANIFICACION </h3>
            </div>
                <div class="modal-body" style="padding:0;">
                         <ul role="tablist" style="padding-bottom:0px;background:#dafeec" class="nav nav-tabs nav-justified">

                         <li role="presentation" class="active">
                         <a href="#about_modal" aria-controls="about_modal" role="tab" data-toggle="tab" style="height: 43px;">GENERAL</a></li>
                         <li role="presentation"><a href="#diagnostico_modal" aria-controls="diagnostico_modal" role="tab" data-toggle="tab">ESPERADOS<h5 id="idcontesperados" class="badge" style="background:red;margin-left:10px">0</h5></a></li>

                         <li role="presentation"><a href="#medicamento_modal" aria-controls="medicamento_modal" role="tab" data-toggle="tab">OBTENIDOS<h5 id="idcontobtenidos" class="badge" style="background:red;margin-left:10px">0</h5></a></li>

                         <li  role="presentation"><a href="#other_modal" aria-controls="other_modal" role="tab" data-toggle="tab" style="height:43px;">OBJETIVOS<h5 id="idcontobjetivos" class="badge" style="background:red;margin-left:10px">0</h5></a></li>
                        </ul>
                        <div class="row">
                        <div class="tab-content" style="margin-left:60px;margin-right:60px;margin-top:35px;margin-bottom:35px">
 <!--UNO DE GENERAL-->   <div id="about_modal" role="tabpanel" class="tab-pane active">
                            <div class="col-md-10">
                                        <div class="form-group">
                                        <div class='input-group'>
                                           <LABEL >RESULTADOS GENERALES</LABEL>
                                        </div>
                                        </div>

                                          <div class="col-lg-18 col-md-12 col-sm-12 col-xs-12" >

                                       </div>
                                       <table  id="table_diagnostico_update" class="table table-striped table-condensed table-hover">
                                            <thead >
                                            <th width="10%">N°</th>
                                            <th width="50%">GENERAL</th>
                                            <th width="40%">RESUTADOS</th>
                                             </thead>
                                             <tbody>

                                            <tr class="selected" id="filadiagnostico_u" value="">
                                            <td style="background-color:#19ADE0">1</td><td style="background-color:#19ADE0">FECHA DE INICIO PARA LA PRESENTACION</td><td> <li type="text" id = "fechapre"></li></td>
                                            </tr>
                                            <tr class="selected" id="filadiagnostico_u" value="">
                                            <td style="background-color:#19ADE0">2</td><td style="background-color:#19ADE0">FECHA DE FINAL DE PRESENTACION</td><td> <li type="text" id = "fechafin"></li></td>
                                            </tr>
                                            <tr class="selected" id="filadiagnostico_u" value="">
                                            <td style="background-color:#19ADE0">3</td><td style="background-color:#19ADE0" >VISTO BUENO POR EL PLANIFICADOR</td><td><li type="text" id = "vistaplani"></li></td>
                                            </tr>
                                            <tr class="selected" id="filadiagnostico_u" value="">
                                            <td style="background-color:#19ADE0">4</td><td style="background-color:#19ADE0">VISTO BUENO POR LA UNIDAD</td><td><li type="text" id = "vistaunidad"></li></td>
                                            </tr>
                                            <tr class="selected" id="filadiagnostico_u" value="">
                                            <td style="background-color:#19ADE0">5</td><td style="background-color:#19ADE0">VISTO BUENO POR LA JEFATURA</td><td> <li type="text" id = "vistajefatura"></li></td>
                                            </tr>
                                             <tr class="selected" id="filadiagnostico_u" value="">
                                            <td style="background-color:#19ADE0">6</td><td style="background-color:#19ADE0">OBSERVACIONES</td><td><li type="text" id = "observacion"></li></td>
                                            </tr>
                                             <tr class="selected" id="filadiagnostico_u" value="">
                                            <td style="background-color:#19ADE0">7</td><td style="background-color:#19ADE0">FECHA DE ELAVORACION</td><td><li type="text" id = "fechaela">hjhfjdf</li></td>
                                            </tr>
                                             <tr class="selected" id="filadiagnostico_u" value="">
                                            <td style="background-color:#19ADE0">8</td><td style="background-color:#19ADE0">FECHA DE PRESENTACION</td><td><li type="text" id = "fechapresen"></li></td>

                                            </tr>
                                            </tbody>
                                        </table>

                            </div>
                             </div>
   <!--DOS DE ESPERADOS--> <div id="diagnostico_modal" role="tabpanel" class="tab-pane">
                                <div class="col-md-10">
                                        <div class="form-group">
                                        <div class='input-group'>
                                           <LABEL>RESULTADOS ESPERADOS
                                        </LABEL>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-1 col-md-1 col-sm-2 col-xs-2">
                                        <div class="form-group" style="margin-top:0">
                                        </div>
                                    </div>
                               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">


                                        <table class="table table-striped table-condensed table-hover">
                                            <thead style="background-color:#A9D0F5">
                                              <th width="10%">N°</th>
                                                <th width="40%">ESPERADOS</th>
                                             </thead>
                                             <tbody id="tableesperados"></tbody>
                                        </table>

                                </div>
                            </div>

<!--TRES DE MEDICAENTOS-->   <div id="medicamento_modal" role="tabpanel" class="tab-pane">
                                <div class="col-md-10">
                                        <div class="form-group">
                                        <div class='input-group'>
                                           <LABEL>RESULTADOS ALACANZADOS</LABEL>
                                        </LABEL>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-1 col-md-1 col-sm-2 col-xs-2">
                                        <div class="form-group" style="margin-top:0">

                                        </div>
                                    </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">




                                  <table class="table table-striped table-condensed table-hover">
                                            <thead style="background-color:#A9D0F5">
                                              <th width="10%">N°</th>
                                                <th width="40%">ESPERADOS</th>
                                             </thead>
                                             <tbody id="tabledeli"></tbody>
                                        </table>


                                </div>

                            </div>
  <!--CUATRO DE GENERAL-->  <div id="other_modal" role="tabpanel" class="tab-pane">
                               <div class="col-md-10">
                                        <div class="form-group">
                                        <div class='input-group'>
                                           <LABEL>RESULTADOS OBJETIVOS
                                        </LABEL>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-1 col-md-1 col-sm-2 col-xs-2">
                                        <div class="form-group" style="margin-top:0">
                                        </div>
                                    </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                           <table class="table table-striped table-condensed table-hover">
                                            <thead style="background-color:#A9D0F5">
                                              <th width="10%">N°</th>
                                                <th width="40%">ESPERADOS</th>
                                             </thead>
                                             <tbody id="tableobjetivos"></tbody>
                                        </table>



                                        </table>
                                </div>

                                </div>


                            </div>
                             </div>
                    </div>

<!--ALERTA DE MODIFCAION --><div class="modal-footer" style="border-left:10px solid  #84da92;margin-top: 15px;">
                        <div class="col-md-9">
                            <h2 style="font-weight:200;color:#ff0000;margin:0">NOTA<span style="font-size:0.5em;font-style: italic;color:#777575;margin-left:15px">el boton (Modificar NO SE ALLA ACTIVADO ) se habilitara una vez haya modificado alguna InformaciÃ³n</span></h2>
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-success" data-loading-text="Modificando AtenciÃ³n..." autocomplete="off" id="btnpdateatencion" type="submit" disabled>Modificar AtenciÃ³n</button>
                        </div>
                </div>
            {!!Form::close()!!}
             </div>
        </div>
    </div>
</div>
