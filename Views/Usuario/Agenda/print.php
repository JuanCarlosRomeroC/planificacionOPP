<!DOCTYPE html>
<?php ob_start();$months=["Enero","Febrero","Marzo", "Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"];
//$mes=$months[intval($resultado['month']) - 1];
?>
<html>
     <head>
          <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
          <title>Agenda de Director</title>
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
          <center><h3>CRONOGRAMA DE AGENDA DE DIRECTOR DE SEDES </h3></center>
          <h5 style="z-index:10;margin-top:7px;text-align:center">FECHA  DE: <small><?php echo $resultado['de']."     "?></small> FECHA HASTA:  <small><?php echo $resultado['hasta']?></small></h5>
          <table width="100%" style="margin-top:20px"  width="100%" cellspacing="0" cellpadding="0">
               <thead style="background:#bdbdbd;text-align:center">
                    <tr>
                         <td width="10%" colspan="2">INICIO</td>
                         <td width="10%" colspan="2">FINAL</td>
                         <td width="50%" rowspan="2">PERSONA RESPONSABLE</td>
                         <td width="30%" rowspan="2">ACTIVIDAD</td>
                    </tr>
                    <tr>
                         <td width="8%">FECHA</td>
                         <td width="8%">HORA</td>
                         <td width="8%">FECHA</td>
                         <td width="8%">HORA</td>
                    </tr>
               </thead>
               <tbody>
                    <?php for($i=0;$i< count($resultado['todos']);$i++){?>
                         <tr>
                              <?php $fecha_de=explode(' ', $resultado['todos'][$i]['fecha_de']);$fecha_hasta=explode(' ', $resultado['todos'][$i]['fecha_hasta']); ?>
                              <td><h5><?php echo $fecha_de[0]; ?></h5></td>
                              <td><h5><?php echo $fecha_de[1] ?></h5></td>
                              <td><h5><?php echo $fecha_hasta[0]; ?></h5></td>
                              <td><h5><?php echo $fecha_hasta[1] ?></h5></td>
                              <td><h5><?php echo $resultado['todos'][$i]['nombre']; ?></h5></td>
                              <td><h5><?php echo $resultado['todos'][$i]['actividad']; ?></h5></td>
                         </tr>
                    <?php } ?>
               </tbody>

          </table>

     </body>
</html>
