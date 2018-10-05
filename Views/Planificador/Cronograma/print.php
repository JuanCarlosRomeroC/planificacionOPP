<!DOCTYPE html>
<?php ob_start();$months=["Enero","Febrero","Marzo", "Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"];
//$mes=$months[intval($resultado['month']) - 1];
?>
<html>
     <head>
          <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
          <title>Planificacion de Otras Actividades</title>
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
          <center><h3>REPORTE DE PLANIFICADOR GENERAL DE SEDES POTOSÍ</h3></center>
          <h5 style="z-index:10;margin-top:7px;text-align:center">FECHA  DE: <small><?php echo $resultado['de']."     "?></small> FECHA HASTA:  <small><?php echo $resultado['hasta']?></small></h5>
          <table width="100%" style="margin-top:30px"  width="100%" cellspacing="0" cellpadding="0">
               <thead style="background:#bdbdbd;text-align:center">
                    <tr>
                         <td width="25%" rowspan="2">USUARIO</td>
                         <td width="15%" rowspan="2">ACTIVIDAD</td>
                         <td width="10%" rowspan="2">CIUDAD</td>
                         <td width="35%" rowspan="2">LUGAR</td>
                         <td width="15%" colspan="2">FECHA</td>
                    </tr>
                    <tr>
                         <td width="8%">INICIO</td>
                         <td width="8%">FIN</td>
                    </tr>
               </thead>
               <tbody>
                    <?php while($row=mysql_fetch_assoc($resultado['todos'])): ?>
                         <tr>
                              <td style="text-align:left;padding-left:10px"><h5><?php echo $row['nombre'];?></h5></td>
                              <td style="text-align:left;padding-left:10px"><h5><?php echo $row['actividad'];?></h5></td>
                              <td><h5><?php echo $row['ciudad']=="" ?  "potosí" : $row['ciudad']?></h5></td>
                              <td style="text-align:left;padding-left:10px">
                                   <h5 style="text-transform:lowercase">
                                   <?php echo $row['lugar']; ?>
                                   <?php if ($row['municipio']!=null) {
                                             echo $row['municipio'];
                                        }else{
                                             if ($row['redsalud']!=null) {
                                                  echo $row['redsalud'];
                                             }
                                   }?>
                              </td>
                              <td style="line-height: 1.2em;"><h5><?php echo  $row['fecha_de']; ?></h5></td>
                              <td style="line-height: 1.2em;"><h5><?php echo  $row['fecha_hasta']; ?></h5></td>
                         </tr>
				<?php endwhile; ?>
               </tbody>
          </table>
     </body>
</html>
