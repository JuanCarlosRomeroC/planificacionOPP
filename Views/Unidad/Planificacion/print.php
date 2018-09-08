<!DOCTYPE html>
<?php ob_start();$months=["Enero","Febrero","Marzo", "Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"];
$mes=$months[intval($resultado['month']) - 1];
?>
<html>
     <head>
          <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
          <title>Planificacion Mes de <?php echo $mes ?></title>
          <style>
               html, body {
                    height: 100%;
                    font-family: Arial, Helvetica, sans-serif;
               }
               table td{
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
                    font-size: .7em;
                    margin: 0px;
                    text-align: center;
               }
               td{
                  line-height: 1.3em;
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
                    font-weight:200;font-size: .7em;
               }
               h3{
                    margin: 0;padding: 0;
               }
          </style>
     </head>
     <body >
          <img src="<?php echo URL;?>public/images/logos/logo.png" width="140px" style="position: absolute;top:-25px;z-index:10">
          <center><h3>PLAN DE TRABAJO<br> <small> Mes de <?php echo $mes." ".$resultado['year']; ?></small></h3></center>
          <h5 style="z-index:10;margin-top:7px">NOMBRE Y APELLIDO: <small><?php echo $resultado['usuario']['nombre']." ".$resultado['usuario']['apellido']; ?></small> </h5>

          <h5>CARGO: <small><?php echo strtolower($resultado['usuario']['cargo'])?></small> </h5>
          <h5>UNIDAD: <small><?php echo strtolower($resultado['usuario']['unidad']);?></small> </h5>
          <h5>FECHA DE ELABORACIÓN: <small><?php  echo $resultado['todos'][0]['fecha_elaboracion']?></small> </h5>
          <h5>FECHA DE PRESENTACIÓN: <small><?php echo $resultado['todos'][0]['fecha_presentacion']?></small> </h5>
          <table width="100%" style="margin:10px 0 20px 0"  width="100%" cellspacing="0" cellpadding="0">
               <thead style="background:#bdbdbd;text-align:center">
                    <tr>
                         <td width="20%" rowspan="2">ACTIVIDADES DE UNIDAD</td>
                         <td width="20%" rowspan="2">ACTIVIDAD</td>
                         <td width="30%"  rowspan="2" >OBJETIVOS</td>
                         <td width="20%"  rowspan="2" >RESULTADOS ESPERADOS</td>
                         <td width="10%" colspan="2">FECHA</td>
                    </tr>
                    <tr>
                         <td width="7%">DE</td>
                         <td width="7%">HASTA</td>
                    </tr>
               </thead>
               <tbody>
                    <?php for($i=0;$i< count($resultado['todos']);$i++){?>
                         <tr>
                              <?php if ($i==0): ?>
                                   <?php echo '<td rowspan="'.count($resultado['todos']).'"></td>' ?>
                              <?php endif; ?>
                              <td  style="text-align:left;padding-left:4px"><h5><?php echo $resultado['todos'][$i]['actividad']; ?></h5></td>
                              <td style="text-align:left">
                                   <?php $espera = explode("|", $resultado['todos'][$i]['objetivo'])==null ? [1]:explode("|", $resultado['todos'][$i]['objetivo']);
                                        $cont = 0;
                                        while ( $cont < count($espera)-1) {
                                             echo '<h5 style="margin:0 0 0 5px;">- '.$espera[$cont].'</h5>';
                                             $cont++;
                                        }
                              ?></td>
                              <td style="text-align:left">
                                   <?php $espera = explode("|", $resultado['todos'][$i]['esperado'])==null ? [1]:explode("|", $resultado['todos'][$i]['esperado']);
                                        $cont = 0;
                                        while ( $cont < count($espera)-1) {
                                             echo '<h5 style="margin:0 0 0 5px;"> -    '.$espera[$cont].'</h5>';
                                             $cont++;
                                        }
                              ?></td>
                              <td><h5><?php echo $resultado['todos'][$i]['fecha_de']; ?></h5></td>
                              <td><h5><?php echo $resultado['todos'][$i]['fecha_hasta']; ?></h5></td>
                         </tr>
                    <?php } ?>
               </tbody>
          </table>
          <?php  if (count($resultado['viajes'])>0) {?>
               <h3 style="margin: 0">- Viajes</h3>
               <table width="100%" style="margin-top:10px"  width="100%" cellspacing="0" cellpadding="0">
                    <thead style="background:#bdbdbd;text-align:center">
                         <tr>
                              <td width="11%" rowspan="2">ACTIVIDAD</td>
                              <td width="9%" rowspan="2">VIAJE</td>
                              <td width="10%" rowspan="2">CIUDAD</td>
                              <td width="35%" rowspan="2">ESTABLECIMIENTO</td>
                              <td width="25%" rowspan="2">LUGAR</td>
                              <td width="10%" colspan="2">FECHA</td>
                         </tr>
                         <tr>
                              <td width="10%">DE</td>
                              <td width="10%">HASTA</td>
                         </tr>
                    </thead>
                    <tbody>
                         <?php for($i=0;$i< count($resultado['viajes']);$i++){?>
                              <tr>
                                   <td><h5><?php echo $resultado['viajes'][$i]['actividad']; ?></h5></td>
                                   <td><h5><?php echo $resultado['viajes'][$i]['tipo_lugar']=="" ? "no se viajo" :$resultado['viajes'][$i]['tipo_lugar']; ?></h5></td>
                                   <td><h5><?php echo $resultado['viajes'][$i]['ciudad']=="" ?  "potosí" : $resultado['viajes'][$i]['ciudad']?></h5></td>
                                   <td style="text-align:left;padding-left:9px"><h5><?php echo $resultado['viajes'][$i]['establecimiento']=="" ?  "sin establecimiento" : $resultado['viajes'][$i]['establecimiento']; ?> <small><?php echo $resultado['viajes'][$i]['municipio'];?></small></h5></td>
                                   <td><h5><?php echo $resultado['viajes'][$i]['lugar']; ?></h5></td>
                                   <td><h5><?php echo $resultado['viajes'][$i]['fecha_de']; ?></h5></td>
                                   <td><h5><?php echo $resultado['viajes'][$i]['fecha_hasta']; ?></h5></td>
                              </tr>
                         <?php } ?>
                    </tbody>
               </table>
          <?php } ?>
     </body>
</html>
