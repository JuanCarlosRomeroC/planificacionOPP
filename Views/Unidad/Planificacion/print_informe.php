<!DOCTYPE html>
<?php ob_start();$months=["Enero","Febrero","Marzo", "Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"];
$mes=$months[intval($resultado['month']) - 1];
$media= round(100 / count($resultado['actividades']), 2);
$porcentaje=0;
for ($i=0; $i < count($resultado['actividades']); $i++) {
     if ($resultado['actividades'][$i]['estado']==1) {
          $porcentaje=$porcentaje+$media;
     }else{
          $row= round($media/$resultado['actividades'][$i]['total'],2);
          $porcentaje=$porcentaje+($resultado['actividades'][$i]['porcentaje']*$row);
     }
}
?>
<html>
     <head>
          <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
          <title>Reporte de Avance de actividad del mes de <?php echo $mes ?></title>
          <script src="<?php echo URL;?>public/js/jQuery-2.1.4.min.js"></script>
          <style>
          html, body {
               height: 100%;
               font-family: Arial, Helvetica, sans-serif;
          }
          table td{
               border: 1px solid #8b8b8b;
          }
          table{
               border: 1px solid #8b8b8b;
          }
          p {
               font-family: Arial, Helvetica, sans-serif;
               text-align: justify;
               margin: 0;
               padding: 0;
               text-align: center;
          }
          h4 {
               font-family: Arial, Helvetica, sans-serif;
               font-weight: 600;
               font-size: .9em;
               margin: 2px 1px 2px 10px;
          }
          h6{
               font-weight: 200;
               font-size: .64em;
               margin: 0px;
               text-align: center;
          }
          td{
             line-height: 1em;
             padding: 0;
             margin: 0;
             text-align: center;
          }
          tr{
               padding: 0;
               margin: 0;
          }
          small{
               font-weight: 200;
               color: #757575;
               font-size: .98em;
          }
          h5{
               margin:3px;padding:0;
               font-weight:200;font-size: .64em;
          }
          h3{
               margin: 0;padding: 0;
          }

          span#procent {display: block;position: absolute;left: 50%;top: 104%;font-size: 50px;transform: translate(-50%, -50%);color: #545454;}
     	span#procent::after {content: '%';}
     	.canvas-wrap {position: relative;width: 300px;height: 300px;}

          </style>
     </head>
     <body >
          <img src="<?php echo URL;?>public/images/logos/logo.png" width="140px" style="position: absolute;top:-25px;z-index:10">
          <center><h3>INFORME MENSUAL<br> <small> Mes de <?php echo $mes." ".$resultado['year']; ?></small></h3></center>
          <h5 style="z-index:10;margin-top:7px">NOMBRE Y APELLIDO: <small><?php echo $resultado['usuario']['nombre']." ".$resultado['usuario']['apellido']; ?></small> </h5>
          <h5>CARGO: <small><?php echo strtolower($resultado['usuario']['cargo'])?></small> </h5>
          <h5>UNIDAD: <small><?php echo strtolower($resultado['usuario']['unidad']); //console.log($resultado);?></small> </h5>
          <h5>FECHA DE ELABORACIÓN: <small><?php  echo $resultado['todos'][0]['fecha_elaboracion']?></small> </h5>
          <h5>FECHA DE PRESETACIÓN: <small><?php echo $resultado['todos'][0]['fecha_presentacion']?></small> </h5>

          <div class="row" style="display:block;position:absolute;background:#c5e2cb; width:20%;height:22px;right:0;top:100px">
               <?php if ($porcentaje>10) {?>
                    <p style="border:1px solid #47c461;width:<?php echo round($porcentaje)?>%;display:block;height:20px;background:#47c461;color:#fff;padding:0;font-size:.8em"><?php echo round($porcentaje)?>%</p>
                    <p style="position: absolute;color:#5b5b5b;width:100%;font-size:.7em;top:22px;">Porcentaje de Avance POAI</p>
               <?php }else{?>
                    <p style="border:1px solid #47c461;width:<?php echo round($porcentaje)?>%;display:block;height:20px;background:#47c461;color:#fff;padding:0;font-size:.8em"></p>
                    <p style="position: absolute;color:#000;width:100%;font-size:.8em;top:3px"><?php echo round($porcentaje)?>%</p>
                    <p style="position: absolute;color:#5b5b5b;width:100%;font-size:.7em;top:22px;">Porcentaje de Avance POAI</p>
               <?php }?>

          </div>
          <table width="100%" style="margin:10px 0 20px 0;display: table;"  cellspacing="0" cellpadding="0">
               <thead style="background:#bdbdbd;text-align:center">
                    <tr>
                         <td width="30%" rowspan="2">PROGRAMACION OPERATIVA ANUAL (POAI GESTIÓN)</td>
                         <td width="20%" rowspan="2">ESTRATÉGIAS CUMPLIDAS</td>
                         <td width="25%" rowspan="2" >LOGROS</td>
                         <td width="15%" colspan="2">FECHA</td>
                         <td width="10%" rowspan="2">OBSERVACIÓN</td>
                    </tr>
                    <tr>
                         <td width="8%">INICIO</td>
                         <td width="8%">FIN</td>
                    </tr>
               </thead>
               <tbody>
                    <?php for($i=0;$i< count($resultado['todos']);$i++){?>
                         <tr>
                              <?php if (count($resultado['actividades']) >= count($resultado['todos'])){?>
                                   <?php if ($i==0): ?>
                                        <td rowspan="<?php echo count($resultado['todos'])?>">
                                        <?php $coun=1;for($j=0;$j<count($resultado['actividades']);$j++): ?>
                                             <h6 style="margin:0 5px 3px 5px;line-height: 1.1em;text-transform: lowercase;text-align:left"><strong><?php echo $coun?>. </strong><?php echo $resultado['actividades'][$j]["nombre"]; ?></h6>
                                        <?php $coun++;endfor; ?>
                                        </td>
                                   <?php endif; ?>
                              <?php }else{ ?>
                                   <?php if ($i==count($resultado['todos'])-1){?>
                                        <td style="border-top: 1px solid #fff;border-bottom: 1px solid #8b8b8b">
                                   <?php }else{ ?>
                                        <td style="border-top: 1px solid #fff;border-bottom: 1px solid #fff">
                                   <?php }?>
                                        <?php if($i<count($resultado['actividades'])){?>
                                        <h6 style="margin:0 5px 3px 5px;line-height: 1.1em;text-transform: lowercase;text-align:left"><strong><?php echo ($i)+1?>. </strong><?php echo $resultado['actividades'][$i]["nombre"]; ?></h6>
                                        <?php }?>
                                   </td>
                              <?php }?>
                              <td  style="text-align:left;padding-left:4px;text-transform: lowercase"><h5 style="line-height: 1.1em;"><?php echo $resultado['todos'][$i]['actividad']; ?></h5></td>
                              <td style="text-align:left;padding-left:4px">
                                   <?php $porciones = explode("|", $resultado['todos'][$i]['esperado']);
                                        $cont = 0;
                                        while ( $cont < count($porciones)-1) {
                                             echo '<h5> -    '.$porciones[$cont].'</h5>';
                                             $cont++;
                                        }
                              ?></td>
                              <td><h5><?php echo $resultado['todos'][$i]['fecha_de']; ?></h5></td>
                              <td><h5><?php echo $resultado['todos'][$i]['fecha_hasta']; ?></h5></td>
                              <td style="background:<?php echo $resultado['todos'][$i]['terminado']==0? '#ffe8e8': '#cbedb9'; ?>"><h5 style="line-height: 1.2em;"><?php echo $resultado['todos'][$i]['observacion']; ?></h5></td>
                         </tr>
                    <?php } ?>
               </tbody>
          </table>
          <?php  if (count($resultado['viajes'])>0) {?>
               <h3 style="margin: 0">- DETALLE DE ACTIVIDADES</h3>
               <table width="100%" style="margin-top:10px"  width="100%" cellspacing="0" cellpadding="0">
                    <thead style="background:#bdbdbd;text-align:center">
                         <tr>
                              <td width="18%" rowspan="2">ACTIVIDAD</td>
                              <td width="8%" rowspan="2">VIAJE</td>
                              <td width="10%" rowspan="2">CIUDAD</td>
                              <td width="20%" rowspan="2">LUGAR</td>
                              <td width="20%" rowspan="2">DESCRIPCIÓN</td>
                              <td style="padding:3px" width="10%" colspan="2">FECHA</td>
                              <td width="14%" rowspan="2">OBSERVACIÓN</td>
                         </tr>
                         <tr>
                              <td width="8%">INICIO</td>
                              <td width="8%">FIN</td>
                         </tr>
                    </thead>
                    <tbody>
                         <?php for($i=0;$i< count($resultado['viajes']);$i++){?>
                              <tr>
                                   <td style="text-align:left;padding-left:10px"><h5><?php echo $resultado['viajes'][$i]['actividad']; ?></h5></td>
                                   <td><h5 style="line-height:.85em"><?php echo "Inter ".$resultado['viajes'][$i]['tipo_lugar']?></h5></td>
                                   <td><h5><?php echo strtoupper($resultado['viajes'][$i]['ciudad'])?></h5></td>
                                   <td style="text-align:left;padding-left:4px">
                                        <h5>
                                        <?php  echo $resultado['viajes'][$i]['redsalud']."  ".strtolower($resultado['viajes'][$i]['municipio']);?>
                                        <small  style="text-transform:lowercase"><br><?php echo $resultado['viajes'][$i]['establecimiento'].$resultado['viajes'][$i]['lugar'];?></small>
                                        </h5>
                                   </td>
                                        </h5>
                                   </td>
                                   <td style="text-align:left;padding-left:9px;text-transform:lowercase"><h5><?php echo $resultado['viajes'][$i]['descripcion']?></h5></td>
                                   <td><h5 style="line-height: 1.2em"><?php echo $resultado['viajes'][$i]['fecha_de']; ?></h5></td>
                                   <td><h5 style="line-height: 1.2em"><?php echo $resultado['viajes'][$i]['fecha_hasta']; ?></h5></td>
                                   <td style="text-align:left;padding-left:9px;line-height: 1.2em;color:<?php $estatus=$resultado['viajes'][$i]['estado'];echo $estatus==0? '#da0d0d': '#262626'?>"><h5><?php echo $estatus==0 ?  "No Fue Validado" : $resultado['viajes'][$i]['observacion']; ?></h5></td>
                              </tr>
                         <?php } ?>
                    </tbody>
               </table>
          <?php } ?>
          <h5 style="position:absolute;bottom:-25px;right:0;text-align:center"><?php echo $resultado['usuario']['nombre']." ".$resultado['usuario']['apellido']; ?> <br><small><?php echo strtolower($resultado['usuario']['cargo'])?></small></h5>
     </body>
</html>
