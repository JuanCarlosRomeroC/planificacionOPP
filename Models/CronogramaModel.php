<?php
     class CronogramaModel extends Conexion{
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
               if ($this->type==0) {
                    $todos=parent::consultaRetorno("SELECT p.id,p.tipo_actividad,a.nombre as actividad,p.lugar,p.fecha_de,p.fecha_hasta FROM otra_planificacion as p
                    JOIN otra_actividad as a ON a.id=p.id_otra_actividad where p.id_usuario='{$this->user_id}'  AND p.tipo_actividad='viaje'");
               }else{
                    $todos=parent::consultaRetorno("SELECT p.id,p.tipo_actividad,a.nombre as actividad,p.lugar,p.fecha_de,p.fecha_hasta FROM otra_planificacion as p
                    JOIN otra_actividad as a ON a.id=p.id_otra_actividad where p.id_usuario='{$this->user_id}' AND p.id_otra_actividad='{$this->type}'");
               }
               $all = array();while($row = mysql_fetch_assoc($todos)) {$all[] = $row;}
               $redsalud="SELECT * FROM redsalud";
               $municipio="SELECT m.*,r.nombre as redsalud FROM municipio as m JOIN redsalud as r ON r.id=m.id_redsalud";
               $establecimiento="SELECT e.*,m.nombre as municipio FROM establecimiento as e JOIN municipio as m ON m.id=e.id_municipio";
               $otraactividad="SELECT * FROM otra_actividad";
               $result=["planificacion"=> $all,
                         "redsalud"=>parent::consultaRetorno($redsalud),
                         "municipios"=>parent::consultaRetorno($municipio),
                         "establecimientos"=>parent::consultaRetorno($establecimiento),
                         "actividad"=>parent::consultaRetorno($otraactividad),
                         "type"=>$this->type
               ];
               return $result;
          }
          public function crear(){
               $id_user=$this->user_id;
               if (isset($this->id_usuario)) {
                    $id_user=$this->id_usuario;
               }
               $sql=("INSERT INTO otra_planificacion(id_usuario,id_establecimiento,tipo_actividad,tipo_lugar,ciudad,id_otra_actividad,lugar,fecha_de, fecha_hasta) VALUES(
                    '{$id_user}','{$this->id_establecimiento}','{$this->tipo_actividad}','{$this->tipo_lugar}','{$this->ciudad}','{$this->id_otra_actividad}','{$this->lugar}','{$this->fecha_de}','{$this->fecha_hasta}')");
               parent::consultaSimple($sql);
               return "La Planificacion se Registro Satisfactoriamente";
          }
          public function ver(){
               $sql="SELECT o.*,CONCAT(u.nombre,' ',u.apellido) as nombre,u.ci,a.nombre as actividad,e.nombre as establecimiento,m.id as id_municipio,m.id_redsalud FROM otra_planificacion as o
                    JOIN usuario as u ON u.id = o.id_usuario
                    JOIN otra_actividad as a ON a.id = o.id_otra_actividad
                    LEFT JOIN establecimiento as e ON e.id = o.id_establecimiento
                    LEFT JOIN municipio as m ON m.id = e.id_municipio
                    WHERE o.id = '{$this->id}' LIMIT 1";
               return mysql_fetch_assoc(parent::consultaRetorno($sql));
          }
          public function editar(){
               $id_user=$this->user_id;
               if (isset($this->id_usuario)) {
                    $id_user=$this->id_usuario;
               }
               $sql=("UPDATE otra_planificacion SET id_usuario='{$id_user}',id_establecimiento='{$this->id_establecimiento}',tipo_actividad='{$this->tipo_actividad}',tipo_lugar='{$this->tipo_lugar}',
                    ciudad='{$this->ciudad}',id_otra_actividad='{$this->id_otra_actividad}',lugar='{$this->lugar}',fecha_de='{$this->fecha_de}',fecha_hasta='{$this->fecha_hasta}' WHERE id='{$this->id}'");
               parent::consultaSimple($sql);
               echo "La Cronograma se Modifico Satisfactoriamente";
          }
          public function imprimir(){
               $planificacion="SELECT p.*,a.nombre as actividad,e.nombre as establecimiento,m.nombre as municipio FROM otra_planificacion as p
                    JOIN otra_actividad as a ON a.id=p.id_otra_actividad
                    LEFT JOIN establecimiento as e ON e.id=p.id_establecimiento
                    LEFT JOIN municipio as m ON m.id=e.id_municipio where p.id_usuario='{$this->user_id}'  AND (p.fecha_de BETWEEN '{$this->de}' AND '{$this->hasta}')";
               $all = array();$query=parent::consultaRetorno($planificacion);
               while($row = mysql_fetch_assoc($query)){
                  $all[] = $row;
               }
               $user="SELECT u.*,n.nombre as unidad,j.nombre as jefatura,c.nombre as cargo FROM usuario as u
                    JOIN cargo as c ON c.id = u.id_cargo
                    LEFT JOIN unidad as n ON u.id_lugar = n.id
                    LEFT JOIN jefatura as j ON n.id_jefatura =j.id
                    WHERE u.id = '{$this->user_id}' LIMIT 1";
               $result=["todos"=> $all,"de"=>$this->de,"hasta"=>$this->hasta,"usuario"=>mysql_fetch_assoc(parent::consultaRetorno($user))];
               return $result;
          }
          public function listar_auditorio(){
               $todos=parent::consultaRetorno("SELECT p.id,a.nombre as actividad,CONCAT(u.nombre,' ',u.apellido) as nombre,p.fecha_de,p.fecha_hasta FROM otra_planificacion as p
                    JOIN otra_actividad as a ON a.id=p.id_otra_actividad
                    JOIN usuario as u ON u.id=p.id_usuario where p.lugar='auditorio' ");

               $all = array();while($row = mysql_fetch_assoc($todos)) {$all[] = $row;}
               $usuario="SELECT id,CONCAT(nombre,' ',apellido) as nombre,ci FROM usuario WHERE estado=1";
               $otraactividad="SELECT * FROM otra_actividad";
               $result=["planificacion"=> $all,
                         "actividad"=>parent::consultaRetorno($otraactividad),
                         "usuario"=>parent::consultaRetorno($usuario)
               ];
               return $result;
          }
          public function imprimir_auditorio(){
               $planificacion=parent::consultaRetorno("SELECT p.fecha_de,p.fecha_hasta,a.nombre as actividad,CONCAT(u.nombre,' ',u.apellido) as nombre FROM otra_planificacion as p
                    JOIN usuario as u ON u.id=p.id_usuario JOIN otra_actividad as a ON a.id=p.id_otra_actividad WHERE p.lugar='auditorio'  AND (p.fecha_de BETWEEN '{$this->de}' AND '{$this->hasta}')" );
               $all = array();
               while($row = mysql_fetch_assoc($planificacion)){
                  $all[] = $row;
               }
               $result=["todos"=> $all,"de"=>$this->de,"hasta"=>$this->hasta];
               return $result;
          }
          public function validate_cronograma(){
               $sql=("UPDATE otra_planificacion SET estado=1,observacion='{$this->observacion}' WHERE id='{$this->id}'");
               parent::consultaSimple($sql);
               echo "true";
          }
     }
 ?>
