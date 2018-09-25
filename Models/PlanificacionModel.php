<?php
     class PlanificacionModel extends Conexion{
          public $user_id;
          public $user_lugar;
          public $session;
          function __construct(){
               parent::__construct();
               $this->session=Session::getSession('User');
               if (isset($this->session)){
                    $this->user_id=$this->session['id'];
                    $this->user_lugar=$this->session['id_lugar'];
               }
          }
          public function set($atributo,$contenido){
               $this->$atributo=$contenido;
          }
          public function get($atributo){
               return $this->$atributo;
          }
          public function listar(){
               $actividad="SELECT pa.year,a.nombre,a.id FROM planificacion_anual as pa
               JOIN actividad as a ON a.id=pa.id_actividad WHERE pa.id_usuario='{$this->user_id}' AND pa.year='{$this->year}'";
               $planificacion="SELECT p.*,a.nombre as actividad FROM planificacion as p
               JOIN actividad as a ON a.id=p.id_actividad where p.id_usuario='{$this->user_id}' AND YEAR(p.fecha_de) = '{$this->year}' AND MONTH(p.fecha_de) = '{$this->month}'";
               $result=[
                         "actividades"=> parent::consultaRetorno($actividad),
                         "planificacion"=>parent::consultaRetorno($planificacion),
                         "month"=>$this->month,"year"=>$this->year
               ];
               return $result;
          }
          public function ver(){
               $planificacion="SELECT p.*,a.nombre as actividad,u.nombre,u.apellido,u.ci FROM planificacion as p JOIN usuario as u ON u.id=p.id_usuario JOIN actividad as a ON a.id=p.id_actividad WHERE p.id='{$this->id}' LIMIT 1";

               return mysql_fetch_assoc(parent::consultaRetorno($planificacion));
          }
          public function crear(){
               $sql=("INSERT INTO planificacion(id_usuario,id_actividad,fecha_de, fecha_hasta,objetivo,esperado,fecha_elaboracion) VALUES(
                    '{$this->user_id}','{$this->id_actividad}','{$this->fecha_de}','{$this->fecha_hasta}','{$this->objetivo}','{$this->esperado}',NOW())");
               parent::consultaSimple($sql);
               return "La Planificacion se Registro Satisfactoriamente";
          }
          public function editar(){
               $sql=("UPDATE planificacion SET id_actividad='{$this->id_actividad}',fecha_de='{$this->fecha_de}',
                    fecha_hasta='{$this->fecha_hasta}',objetivo='{$this->objetivo}',esperado='{$this->esperado}' WHERE id='{$this->id}'");
               parent::consultaSimple($sql);
               return "La Planificacion se Modifico Satisfactoriamente";
          }
          public function completarinforme(){
               $sql=("UPDATE planificacion SET observacion='{$this->observacion}',vista_unidad='{$this->vista_unidad}',vista_jefatura='{$this->vista_jefatura}',vista_planificador='{$this->vista_planificador}',estado=1 WHERE id='{$this->id}'");
               parent::consultaSimple($sql);
               return "La Planificacion se Culminó Satisfactoriamente";
          }
          public function validar(){
               $fecha=date('Y-m-d');
               $sql="UPDATE planificacion SET fecha_presentacion='{$fecha}'
                    WHERE id_usuario='{$this->user_id}' AND YEAR(fecha_de)='{$this->year}' AND MONTH(fecha_de)='{$this->month}' ";
               parent::consultaSimple($sql);
               return "La Planificacion de actividades del mes se VALIDO Satisfactoriamente";
          }
          public function imprimir(){
               $planificacion=parent::consultaRetorno("SELECT p.*,a.nombre as actividad FROM planificacion as p JOIN actividad as a ON a.id=p.id_actividad WHERE p.id_usuario='{$this->user_id}'  AND YEAR(p.fecha_de) = '{$this->year}' AND MONTH(p.fecha_de) = '{$this->month}'");
               $all = array();
               while($row = mysql_fetch_assoc($planificacion)){
                  $all[] = $row;
               }
               $viajes=parent::consultaRetorno("SELECT p.*,a.nombre as actividad,e.nombre as establecimiento,m.nombre as municipio FROM otra_planificacion as p JOIN otra_actividad as a ON a.id=p.id_otra_actividad LEFT JOIN establecimiento as e ON e.id=p.id_establecimiento LEFT JOIN municipio as m ON m.id=e.id_municipio where p.id_usuario='{$this->user_id}'  AND YEAR(p.fecha_de) = '{$this->year}' AND MONTH(p.fecha_de) = '{$this->month}'");
               $all2 = array();
               while($row = mysql_fetch_assoc($viajes)){
                  $all2[] = $row;
               }
               $user=mysql_fetch_assoc(parent::consultaRetorno("SELECT u.*,n.nombre as unidad,j.nombre as jefatura,c.nombre as cargo FROM usuario as u JOIN cargo as c ON c.id = u.id_cargo LEFT JOIN unidad as n ON u.id_lugar = n.id LEFT JOIN jefatura as j ON n.id_jefatura =j.id WHERE u.id = '{$this->user_id}' LIMIT 1"));
               $actividad=parent::consultaRetorno("SELECT id_actividad,estado FROM planificacion_anual WHERE id_usuario='{$this->user_id}' AND year='{$this->year}' ");
               $all3 = array();while ($rows =  mysql_fetch_assoc($actividad)) {$all3[] = $rows;}
               $count=0;while ($count < count($all3)) {
                    $rowactividad=$all3[$count]["id_actividad"];
                    $row=mysql_fetch_assoc(parent::consultaRetorno("SELECT COUNT(*) as total FROM planificacion WHERE id_usuario='{$this->user_id}' AND id_actividad='{$rowactividad}'  AND YEAR(fecha_de)='{$this->year}' AND estado=1"));
                    $all3[$count]['total']=$row['total'];$count=$count+1;
               }
               if ($user['tipo']==5 || $user['tipo']==4 || $user['tipo']==2) {
                    $actividad_unidad=parent::consultaRetorno("SELECT id,nombre FROM actividad WHERE id_unidad='{$this->user_lugar}' AND estado=1");
               }else{
                    $actividad_unidad=parent::consultaRetorno("SELECT p.id,a.nombre FROM planificacion_anual as p JOIN actividad as a ON a.id=p.id_actividad WHERE p.id_usuario='{$this->user_id}' AND p.year='{$this->year}'  ");
               }
               $result=["todos"=> $all,"viajes"=> $all2,"month"=>$this->month,"year"=>$this->year,"actividades"=>$actividad_unidad,"usuario"=>$user,"actividad_porcentaje"=>$all3];
               return $result;
          }
          public function eliminar(){
               $sql="UPDATE planificacion SET estado=b'0'
                    WHERE id='{$this->id}'";
               parent::consultaSimple($sql);
               return "Planificacion dado de Baja Satisfactoriamente";
          }
          public function alta(){
               $sql="UPDATE planificacion SET estado=b'1'
                    WHERE id='{$this->id}'";
               parent::consultaSimple($sql);
               return "Planificacion dado de ALTA Satisfactoriamente";
          }
          public function ver_ci(){
               $sql="SELECT * FROM planificacion WHERE ci='{$this->ci}'";
               $resultado=parent::consultaRetorno($sql);
               return mysql_num_rows($resultado);
          }
          public function listar_unusuario(){
               $usuario=mysql_fetch_assoc(parent::consultaRetorno("SELECT nombre,apellido,id,ci FROM usuario WHERE id='{$this->id}' LIMIT 1"));
               $planificacion="SELECT p.*,a.nombre as actividad FROM planificacion as p JOIN actividad as a ON a.id=p.id_actividad where p.id_usuario='{$this->id}' AND YEAR(p.fecha_de) = '{$this->year}' AND MONTH(p.fecha_de) = '{$this->month}'";

               $actividad=parent::consultaRetorno("SELECT p.*,a.nombre as actividad FROM planificacion_anual as p JOIN actividad as a ON a.id = p.id_actividad WHERE p.id_usuario='{$this->id}' AND p.year='{$this->year}' ");
               $all = array();while ($rows =  mysql_fetch_assoc($actividad)) {$all[] = $rows;}
               $count=0;while ($count < count($all)) {$rowactividad=$all[$count]["id_actividad"];$row=mysql_fetch_assoc(parent::consultaRetorno("SELECT COUNT(*) as total FROM planificacion WHERE id_usuario='{$this->id}' AND id_actividad='{$rowactividad}'  AND YEAR(fecha_de)='{$this->year}' AND estado=1"));$all[$count]['total']=$row['total'];$count=$count+1;}

               $result=["planificacion"=>parent::consultaRetorno($planificacion),
                         "titulo"=>$usuario,"actividades"=>$all,
                         "month"=>$this->month,"year"=>$this->year
               ];
               return $result;
          }
          public function imprimir_unusuario(){
               $planificacion=parent::consultaRetorno("SELECT p.*,a.nombre as actividad FROM planificacion as p JOIN actividad as a ON a.id=p.id_actividad WHERE p.id_usuario='{$this->id}'  AND YEAR(p.fecha_de) = '{$this->year}' AND MONTH(p.fecha_de) = '{$this->month}'");
               $all = array();
               while($row = mysql_fetch_assoc($planificacion)){
                  $all[] = $row;
               }
               $viajes=parent::consultaRetorno("SELECT p.*,a.nombre as actividad,e.nombre as establecimiento,m.nombre as municipio FROM otra_planificacion as p JOIN otra_actividad as a ON a.id=p.id_otra_actividad LEFT JOIN establecimiento as e ON e.id=p.id_establecimiento LEFT JOIN municipio as m ON m.id=e.id_municipio where p.id_usuario='{$this->id}'  AND YEAR(p.fecha_de) = '{$this->year}' AND MONTH(p.fecha_de) = '{$this->month}'");
               $all2 = array();
               while($row = mysql_fetch_assoc($viajes)){
                  $all2[] = $row;
               }
               $user=mysql_fetch_assoc(parent::consultaRetorno("SELECT u.*,n.nombre as unidad,j.nombre as jefatura,c.nombre as cargo FROM usuario as u JOIN cargo as c ON c.id = u.id_cargo LEFT JOIN unidad as n ON u.id_lugar = n.id LEFT JOIN jefatura as j ON n.id_jefatura =j.id WHERE u.id = '{$this->id}' LIMIT 1"));

               $actividad=parent::consultaRetorno("SELECT id_actividad,estado FROM planificacion_anual WHERE id_usuario='{$this->id}' AND year='{$this->year}' ");
               $all3 = array();while ($rows =  mysql_fetch_assoc($actividad)) {$all3[] = $rows;}
               $count=0;while ($count < count($all3)) {
                    $rowactividad=$all3[$count]["id_actividad"];
                    $row=mysql_fetch_assoc(parent::consultaRetorno("SELECT COUNT(*) as total FROM planificacion WHERE id_usuario='{$this->id}' AND id_actividad='{$rowactividad}'  AND YEAR(fecha_de)='{$this->year}' AND estado=1"));
                    $all3[$count]['total']=$row['total'];$count=$count+1;
               }
               if ($user['tipo']==5 || $user['tipo']==4 || $user['tipo']==2) {
                    $su_unidad=$user['id_lugar'];
                    $actividad_unidad=parent::consultaRetorno("SELECT id,nombre FROM actividad WHERE id_unidad='{$su_unidad}' AND estado=1");
               }else{
                    $actividad_unidad=parent::consultaRetorno("SELECT p.id,a.nombre FROM planificacion_anual as p JOIN actividad as a ON a.id=p.id_actividad WHERE p.id_usuario='{$this->id}' AND p.year='{$this->year}'  ");
               }
               $result=["todos"=> $all,"viajes"=> $all2,"month"=>$this->month,"year"=>$this->year,"actividades"=>$actividad_unidad,"usuario"=>$user,"actividad_porcentaje"=>$all3];
               return $result;
          }

          public function ver_otra_planificacion(){
               $sql="SELECT o.*,CONCAT(u.nombre,' ',u.apellido) as nombre,u.ci,a.nombre as actividad,e.nombre as establecimiento FROM otra_planificacion as o
                    JOIN usuario as u ON u.id = o.modificado_persona
                    JOIN otra_actividad as a ON a.id = o.id_otra_actividad
                    LEFT JOIN establecimiento as e ON e.id = o.id_establecimiento
                    WHERE o.id = '{$this->id}' LIMIT 1";
               return mysql_fetch_assoc(parent::consultaRetorno($sql));
          }
          //para usuario
          public function validar_notificacion_otro(){
               $sql="UPDATE otra_planificacion SET visto=1
                    WHERE id='{$this->id}'";
               parent::consultaSimple($sql);
               echo "El usuario vio la notiicacion!".$this->id;
          }
          public function notificacion_usuario(){
               $planificacion=mysql_fetch_assoc(parent::consultaRetorno("SELECT COUNT(*) as total FROM otra_planificacion
                    WHERE id_usuario='{$this->user_id}' AND modificado=1 AND visto=0"));
               echo $planificacion['total'];
          }
          public function notificacion_lista_otraplanificacion(){
               $sinleer=parent::consultaRetorno("SELECT p.*,a.nombre as actividad FROM otra_planificacion as p
                    JOIN otra_actividad as a ON a.id=p.id_otra_actividad
                    where p.id_usuario='{$this->user_id}' AND p.modificado=1 AND p.visto=0 ");
               $leidos=parent::consultaRetorno("SELECT p.*,a.nombre as actividad FROM otra_planificacion as p
                    JOIN otra_actividad as a ON a.id=p.id_otra_actividad
                    where p.id_usuario='{$this->user_id}' AND p.modificado=1 AND p.visto=1 ");
               $result=["sinleer"=> $sinleer,"leidos"=>$leidos];
               return $result;
          }

          //para unidad
          public function validar_unidad(){
               $sql="UPDATE planificacion SET vista_unidad=1
                    WHERE id='{$this->id}'";
               parent::consultaSimple($sql);
               echo "La Actividad se Consolido Satisfactoriamente!";
          }
          public function notificacion(){
               $planificacion=mysql_fetch_assoc(parent::consultaRetorno("SELECT COUNT(*) as total FROM planificacion as p
                    JOIN usuario as u ON u.id=p.id_usuario
                    WHERE u.id_lugar='{$this->user_lugar}' AND p.estado=1 AND p.vista_unidad=0 AND u.tipo=5"));
               $otro=mysql_fetch_assoc(parent::consultaRetorno("SELECT COUNT(*) as total FROM otra_planificacion
                    WHERE id_usuario='{$this->user_id}' AND modificado=1 AND visto=0"));
               $result=["actividad"=> $planificacion,"otro"=>$otro];
               return $result;
          }
          public function notificacion_unidad(){
               $planificacion=parent::consultaRetorno("SELECT p.*,a.nombre as actividad,u.nombre,u.apellido FROM planificacion as p
                    JOIN usuario as u ON u.id=p.id_usuario JOIN actividad as a ON a.id=p.id_actividad
                    WHERE u.id_lugar='{$this->user_lugar}' AND p.estado=1 AND p.vista_unidad=0 AND u.tipo=5");
               return $planificacion;
          }

          //para jefatura
          public function validar_jefatura(){
               $sql="UPDATE planificacion SET vista_jefatura=1
                    WHERE id='{$this->id}'";
               parent::consultaSimple($sql);
               echo "La Actividad se Consolido Satisfactoriamente!";
          }
          public function notificacion_jefatura(){
               $planificacion=mysql_fetch_assoc(parent::consultaRetorno("SELECT COUNT(*) as total FROM planificacion as p
                    JOIN usuario as u ON u.id=p.id_usuario
                    JOIN unidad as n ON n.id=u.id_lugar
                    WHERE n.id_jefatura='{$this->user_lugar}' AND p.estado=1 AND p.vista_jefatura=0 AND (u.tipo=5 OR u.tipo=4)"));
               $otro=mysql_fetch_assoc(parent::consultaRetorno("SELECT COUNT(*) as total FROM otra_planificacion
                    WHERE id_usuario='{$this->user_id}' AND modificado=1 AND visto=0"));
               $result=["actividad"=> $planificacion,"otro"=>$otro];
               return $result;
          }
          public function notificacion_listajefatura(){
               $planificacion=parent::consultaRetorno("SELECT p.*,a.nombre as actividad,u.nombre,u.apellido,n.nombre as unidad,u.tipo FROM planificacion as p
                     JOIN actividad as a ON a.id=p.id_actividad JOIN usuario as u ON u.id=p.id_usuario JOIN unidad as n ON n.id=u.id_lugar
                    WHERE n.id_jefatura='{$this->user_lugar}' AND p.estado=1 AND p.vista_jefatura=0 AND (u.tipo=5 OR u.tipo=4)");
               return $planificacion;
          }

          //paraplanificador
          public function validar_planificador(){
               $sql="UPDATE planificacion SET vista_planificador=1
                    WHERE id='{$this->id}'";
               parent::consultaSimple($sql);
               echo "La Actividad se Consolido Satisfactoriamente!";
          }
          public function notificacion_planificador(){
               $planificacion=mysql_fetch_assoc(parent::consultaRetorno("SELECT COUNT(*) as total FROM planificacion
                    WHERE estado=1 AND vista_planificador=0"));
               $otro=mysql_fetch_assoc(parent::consultaRetorno("SELECT COUNT(*) as total FROM otra_planificacion
                    WHERE id_usuario='{$this->user_id}' AND modificado=1 AND visto=0"));
               $result=["actividad"=> $planificacion,"otro"=>$otro];
               return $result;
          }
          public function notificacion_listaplanificador(){
               $planificacion=parent::consultaRetorno("SELECT p.*,a.nombre as actividad,CONCAT(u.nombre,u.apellido) as nombre,n.nombre as unidad,u.tipo,j.nombre as jefatura FROM planificacion as p
                    JOIN actividad as a ON a.id=p.id_actividad JOIN usuario as u ON u.id=p.id_usuario JOIN unidad as n ON n.id=u.id_lugar JOIN jefatura as j ON j.id=n.id_jefatura
                    WHERE p.estado=1 AND p.vista_planificador=0");
               return $planificacion;
          }

          public function imprimir_director(){
               $planificacion=parent::consultaRetorno("SELECT p.*,a.nombre as actividad FROM planificacion as p JOIN actividad as a ON a.id=p.id_actividad WHERE p.id_usuario='{$this->user_id}'  AND YEAR(p.fecha_de) = '{$this->year}' AND MONTH(p.fecha_de) = '{$this->month}'");
               $all = array();
               while($row = mysql_fetch_assoc($planificacion)){
                  $all[] = $row;
               }
               $viajes=parent::consultaRetorno("SELECT p.*,a.nombre as actividad,e.nombre as establecimiento,m.nombre as municipio FROM otra_planificacion as p JOIN otra_actividad as a ON a.id=p.id_otra_actividad LEFT JOIN establecimiento as e ON e.id=p.id_establecimiento LEFT JOIN municipio as m ON m.id=e.id_municipio where p.id_usuario='{$this->user_id}'  AND YEAR(p.fecha_de) = '{$this->year}' AND MONTH(p.fecha_de) = '{$this->month}'");
               $all2 = array();
               while($row = mysql_fetch_assoc($viajes)){
                  $all2[] = $row;
               }
               $user="SELECT u.*,n.nombre as unidad,j.nombre as jefatura,c.nombre as cargo FROM usuario as u JOIN cargo as c ON c.id = u.id_cargo LEFT JOIN unidad as n ON u.id_lugar = n.id LEFT JOIN jefatura as j ON n.id_jefatura =j.id WHERE u.id = '{$this->user_id}' LIMIT 1";

               $actividad=parent::consultaRetorno("SELECT p.id_actividad,p.estado,a.nombre FROM planificacion_anual as p JOIN actividad as a ON a.id=p.id_actividad WHERE p.id_usuario='{$this->user_id}' AND p.year='{$this->year}' ");
               $all3 = array();while ($rows =  mysql_fetch_assoc($actividad)) {$all3[] = $rows;}
               $count=0;while ($count < count($all3)) {
                    $rowactividad=$all3[$count]["id_actividad"];
                    $row=mysql_fetch_assoc(parent::consultaRetorno("SELECT COUNT(*) as total FROM planificacion WHERE id_usuario='{$this->user_id}' AND id_actividad='{$rowactividad}'  AND YEAR(fecha_de)='{$this->year}' AND estado=1"));
                    $all3[$count]['total']=$row['total'];$count=$count+1;
               }

               $result=["todos"=> $all,"viajes"=> $all2,"month"=>$this->month,"year"=>$this->year,"usuario"=>mysql_fetch_assoc(parent::consultaRetorno($user)),"actividad_porcentaje"=>$all3];
               return $result;
          }
     }
 ?>
