<?php
     class ActividadModel extends Conexion{
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
               $year=date("Y");
               $actividad=parent::consultaRetorno("SELECT a.*,j.nombre as jefatura,u.nombre as unidad FROM actividad as a LEFT JOIN jefatura as j ON j.id = a.id_jefatura LEFT JOIN unidad as u ON u.id = a.id_unidad
               WHERE a.id_jefatura<>0 AND  a.id_unidad<>0 AND a.estado='1'");
               $all = array();
               while($row = mysql_fetch_assoc($actividad)) {
                  $all[] = $row;
               }
               $count=0;
               while ($count<count($all)) {
                    $id_a=$all[$count]['id'];
                    $result=mysql_fetch_assoc(parent::consultaRetorno("SELECT COUNT(*) as total FROM planificacion_anual WHERE id_actividad = '{$id_a}' AND year='{$year}' "));
                    $all[$count]["total"]=$result['total'];
                    $count++;
               }
               $sinjefatura="SELECT a.*,j.nombre as jefatura,u.nombre as unidad FROM actividad as a LEFT JOIN jefatura as j ON j.id = a.id_jefatura LEFT JOIN unidad as u ON u.id = a.id_unidad
               WHERE a.id_jefatura=0 AND a.estado='1'";
               $sinunidad="SELECT a.*,j.nombre as jefatura,u.nombre as unidad FROM actividad as a LEFT JOIN jefatura as j ON j.id = a.id_jefatura LEFT JOIN unidad as u ON u.id = a.id_unidad
               WHERE a.id_unidad=0 AND a.estado='1'";
               $baja="SELECT a.*,j.nombre as jefatura,u.nombre as unidad FROM actividad as a LEFT JOIN jefatura as j ON j.id = a.id_jefatura LEFT JOIN unidad as u ON u.id = a.id_unidad
               WHERE a.estado='0'";

               $jefatura="SELECT * FROM jefatura WHERE estado='1'";
               $unidad="SELECT * FROM unidad WHERE estado='1'";
               $result=["actividades"=>$all,
                         "sinjefatura"=>parent::consultaRetorno($sinjefatura),
                         "sinunidad"=>parent::consultaRetorno($sinunidad),
                         "bajas"=>parent::consultaRetorno($baja),
                         "jefaturas"=>parent::consultaRetorno($jefatura),
                         "unidades"=>parent::consultaRetorno($unidad)
               ];
               return $result;
          }
          public function ver(){
               $year=date("Y");
               $actividad="SELECT a.*,j.nombre as jefatura,u.nombre as unidad FROM actividad as a
               LEFT JOIN jefatura as j ON j.id = a.id_jefatura LEFT JOIN unidad as u ON a.id_unidad = u.id WHERE a.id = '{$this->id}' LIMIT 1" ;
               $estado="SELECT * FROM planificacion_anual WHERE id_actividad = '{$this->id}' AND year='{$year}'";
               $result=mysql_fetch_assoc(parent::consultaRetorno($actividad));
               $result["planificacion_anual"]=mysql_num_rows(parent::consultaRetorno($estado));
               return $result;
          }
          public function crear(){
               $ver_nombre=$this->ver_nombre();
               if($ver_nombre != 0){
                    return "false";
               }else{
                    $sql=("INSERT INTO actividad (nombre,id_jefatura,id_unidad,fecha_created) VALUES ('{$this->nombre}','{$this->id_jefatura}','{$this->id_unidad}',NOW())");
                    parent::consultaSimple($sql);
                    return "La Actividad se Registro Satisfactoriamente";
               }
          }
          public function editar(){
               if($this->nombre==""){
                    $sql=("UPDATE actividad SET id_jefatura='{$this->id_jefatura}',id_unidad='{$this->id_unidad}',fecha_updated=NOW() WHERE id='{$this->id}'");
               }else{
                    $ver_nombre=$this->ver_nombre();
                    if($ver_nombre != 0){
                         return "false";
                    }else{
                         $sql=("UPDATE actividad SET nombre='{$this->nombre}',id_jefatura='{$this->id_jefatura}',id_unidad='{$this->id_unidad}',fecha_updated=NOW() WHERE id='{$this->id}'");
                    }
               }
               parent::consultaSimple($sql);
               return "La Actividad se Modifico Satisfactoriamente";
          }
          public function terminaractividad(){
               $sql="UPDATE planificacion_anual SET estado='1'
                    WHERE id='{$this->id}'";
               parent::consultaSimple($sql);
               return "La Actividad Se Termino Satisfactoriamente";
          }
          public function eliminar(){
               $sql="UPDATE actividad SET estado=0
                    WHERE id='{$this->id}'";
               parent::consultaSimple($sql);
               echo "La Actividad se dio de baja Satisfactoriamente";
          }
          public function alta(){
               $sql="UPDATE actividad SET estado=1
                    WHERE id='{$this->id}'";
               parent::consultaSimple($sql);
               echo "La Actividad se dio de Alta Satisfactoriamente";
          }
          public function ver_nombre(){
               $sql2="SELECT * FROM actividad WHERE nombre='{$this->nombre}'";
               $resultado=parent::consultaRetorno($sql2);
               return mysql_num_rows($resultado);
          }

          public function listarparausuario(){
               $actividad=parent::consultaRetorno("SELECT p.*,a.nombre as actividad FROM planificacion_anual as p
               JOIN actividad as a ON a.id = p.id_actividad WHERE p.id_usuario='{$this->user_id}' AND p.year='{$this->year}' ");
               $all = array();
               while ($rows =  mysql_fetch_assoc($actividad)) {
                    $all[] = $rows;
               }
               $count=0;
               while ($count < count($all)) {
                    $rowactividad=$all[$count]["id_actividad"];
                    $row=mysql_fetch_assoc(parent::consultaRetorno("SELECT COUNT(*) as total FROM planificacion
                    WHERE id_usuario='{$this->user_id}' AND id_actividad='{$rowactividad}'  AND YEAR(fecha_de)='{$this->year}' AND estado=1"));
                    $all[$count]['total']=$row['total'];
                    $count=$count+1;
               }
               $lugar=$this->user_lugar;$asignar=parent::consultaRetorno("SELECT * FROM actividad WHERE id_unidad='{$lugar}'  AND estado=1");
               $result=["actividades"=>$all,"year"=>$this->year,"sinasignar"=>$asignar];
               return $result;
          }
          public function listar_poai_jefatura(){
               $actividad=parent::consultaRetorno("SELECT p.*,a.nombre as actividad FROM planificacion_anual as p
               JOIN actividad as a ON a.id = p.id_actividad WHERE p.id_usuario='{$this->user_id}' AND p.year='{$this->year}' ");
               $all = array();
               while ($rows =  mysql_fetch_assoc($actividad)) {
                    $all[] = $rows;
               }
               $count=0;
               while ($count < count($all)) {
                    $rowactividad=$all[$count]["id_actividad"];
                    $row=mysql_fetch_assoc(parent::consultaRetorno("SELECT COUNT(*) as total FROM planificacion
                    WHERE id_usuario='{$this->user_id}' AND id_actividad='{$rowactividad}'  AND YEAR(fecha_de)='{$this->year}' AND estado=1"));
                    $all[$count]['total']=$row['total'];
                    $count=$count+1;
               }
               $asignar=parent::consultaRetorno("SELECT * FROM actividad WHERE id_jefatura='{$this->user_lugar}'  AND estado=1");
               $result=["actividades"=>$all,"year"=>$this->year,"sinasignar"=>$asignar];
               return $result;
          }
          public function listarparaunidad(){
               $actividad=parent::consultaRetorno("SELECT * FROM actividad WHERE id_unidad='{$this->user_lugar}' AND estado=1");
               $all = array();
               while ($rows =  mysql_fetch_assoc($actividad)) {
                    $all[] = $rows;
               }
               $count=0;$year=date('Y');
               while ($count < count($all)) {
                    $rowactividad=$all[$count]["id"];
                    $row=mysql_fetch_assoc(parent::consultaRetorno("SELECT COUNT(*) as total FROM planificacion_anual WHERE id_actividad='{$rowactividad}'  AND year='{$year}' "));
                    $all[$count]['total']=$row['total'];
                    $count=$count+1;
               }
               $usuario=mysql_fetch_assoc(parent::consultaRetorno("SELECT u.id_jefatura FROM usuario as p JOIN unidad as u ON u.id=p.id_lugar WHERE p.id='{$this->user_id}' LIMIT 1"));
               $jefatura=$usuario['id_jefatura'];
               $asignar=parent::consultaRetorno("SELECT * FROM actividad WHERE id_jefatura='{$jefatura}' AND id_unidad=0");
               $result=["actividades"=>$all,"sinasignar"=>$asignar];
               return $result;
          }
          public function listarparajefatura(){
               $actividad=parent::consultaRetorno("SELECT a.*,u.nombre as unidad,j.nombre as jefatura FROM actividad as a
                    LEFT JOIN unidad as u ON u.id=a.id_unidad
                    JOIN jefatura as j ON j.id=a.id_jefatura
                    WHERE a.id_jefatura='{$this->user_lugar}' AND a.estado=1");
               $all = array();
               while ($rows =  mysql_fetch_assoc($actividad)) {$all[] = $rows;}
               $count=0;$year=date('Y');
               while ($count < count($all)) {
                    $rowactividad=$all[$count]["id"];
                    $row=mysql_fetch_assoc(parent::consultaRetorno("SELECT COUNT(*) as total FROM planificacion_anual WHERE id_actividad='{$rowactividad}'  AND year='{$year}' "));
                    $all[$count]['total']=$row['total'];
                    $count=$count+1;
               }
               $asignar=parent::consultaRetorno("SELECT * FROM actividad WHERE id_jefatura=0 AND id_unidad=0");
               $unidad="SELECT * FROM unidad WHERE estado='1' AND id_jefatura='{$this->user_lugar}'";
               $result=["actividades"=>$all,"sinasignar"=>$asignar,"unidades"=>parent::consultaRetorno($unidad)];
               return $result;
          }
          public function listar_poai_director(){
               $actividad=parent::consultaRetorno("SELECT p.*,a.nombre as actividad FROM planificacion_anual as p
               JOIN actividad as a ON a.id = p.id_actividad WHERE p.id_usuario='{$this->user_id}' AND p.year='{$this->year}' ");
               $all = array();
               while ($rows =  mysql_fetch_assoc($actividad)) {
                    $all[] = $rows;
               }
               $count=0;
               while ($count < count($all)) {
                    $rowactividad=$all[$count]["id_actividad"];
                    $before=parent::consultaRetorno("SELECT COUNT(*) as total FROM planificacion
                    WHERE id_usuario='{$this->user_id}' AND id_actividad='{$rowactividad}' AND YEAR(fecha_de)='{$this->year}' AND estado=1");
                    $row=mysql_fetch_assoc($before);
                    $all[$count]['total']=$row['total'];
                    $count=$count+1;
               }
               $asignar=parent::consultaRetorno("SELECT * FROM actividad WHERE estado=1");
               $result=["actividades"=>$all,"year"=>$this->year,"sinasignar"=>$asignar];
               return $result;
          }

          public function crear_parausuario(){
               $sql=("INSERT INTO planificacion_anual (id_usuario,id_actividad,year) VALUES ('{$this->user_id}','{$this->id_actividad}','{$this->year}' )");
               parent::consultaSimple($sql);
               return "La Actividad se Registro Satisfactoriamente";
          }
          public function crear_paraunidad(){
               $sql="UPDATE actividad SET id_unidad='{$this->user_lugar}'
                    WHERE id='{$this->id}'";
               parent::consultaSimple($sql);
               echo "La Actividad se Agregó Satisfactoriamente a la unidad";
          }
          public function crear_parajefatura(){
               $sql="UPDATE actividad SET id_jefatura='{$this->user_lugar}',id_unidad='{$this->id_unidad}'
                    WHERE id='{$this->id}'";
               parent::consultaSimple($sql);
               echo "La Actividad se Agregó Satisfactoriamente a la unidad";
          }

          public function eliminar_actividadunidad(){
               $sql="UPDATE actividad SET id_unidad=0
                    WHERE id='{$this->id}'";
               parent::consultaSimple($sql);
               echo "La Actividad se elimino Satisfactoriamente de la unidad";
          }
          public function eliminar_actividadjefatura(){
               $sql="UPDATE actividad SET id_jefatura=0,id_unidad=0
                    WHERE id='{$this->id}'";
               parent::consultaSimple($sql);
               echo "La Actividad se elimino Satisfactoriamente de la unidad";
          }
          public function editar_jefatura(){
               $sql=("UPDATE actividad SET id_unidad='{$this->id_unidad}',fecha_updated=NOW() WHERE id='{$this->id}'");
               parent::consultaSimple($sql);
               return "La Actividad se Modifico Satisfactoriamente";
          }
          public function crear_paraplanificador(){
               $sql=("INSERT INTO planificacion_anual (id_usuario,id_actividad,year) VALUES ('{$this->user_id}','{$this->id_actividad}','{$this->year}' )");
               parent::consultaSimple($sql);
               return "La Actividad se Registro Satisfactoriamente";
          }
     }
 ?>
