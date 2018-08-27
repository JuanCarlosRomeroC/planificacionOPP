<?php
     class OtroModel extends Conexion{
          public $user_id;
          public $session;
          function __construct(){
               parent::__construct();
               $this->session=Session::getSession('User');
               if (isset($this->session)){
                    $this->user_id=$this->session['id'];
               }
          }
          public function set($atributo,$contenido){
               $this->$atributo=$contenido;
          }
          public function get($atributo){
               return $this->$atributo;
          }
          public function listar(){
               $year=date('Y');
               $todos="SELECT p.*,a.nombre as actividad FROM otra_planificacion as p
               JOIN otra_actividad as a ON a.id=p.id_otra_actividad where p.id_usuario='{$this->user_id}' ";
               $viajes="SELECT p.*,a.nombre as actividad,e.nombre as establecimiento,m.nombre as municipio FROM otra_planificacion as p
                    JOIN otra_actividad as a ON a.id=p.id_otra_actividad
                    LEFT JOIN establecimiento as e ON e.id=p.id_establecimiento
                    LEFT JOIN municipio as m ON m.id=e.id_municipio where p.id_usuario='{$this->user_id}' AND p.tipo_actividad='viaje' ";
               $locales="SELECT p.*,a.nombre as actividad FROM otra_planificacion as p
               JOIN otra_actividad as a ON a.id=p.id_otra_actividad where p.id_usuario='{$this->user_id}' AND p.tipo_actividad='local' ";
               $redsalud="SELECT * FROM redsalud";
               $municipio="SELECT m.*,r.nombre as redsalud FROM municipio as m JOIN redsalud as r ON r.id=m.id_redsalud";
               $establecimiento="SELECT e.*,m.nombre as municipio FROM establecimiento as e JOIN municipio as m ON m.id=e.id_municipio";
               $otraactividad="SELECT * FROM otra_actividad";
               $result=["todos"=> parent::consultaRetorno($todos),
                         "viajes"=> parent::consultaRetorno($viajes),
                         "locales"=>parent::consultaRetorno($locales),
                         "redsalud"=>parent::consultaRetorno($redsalud),
                         "municipios"=>parent::consultaRetorno($municipio),
                         "establecimientos"=>parent::consultaRetorno($establecimiento),
                         "otraactividad"=>parent::consultaRetorno($otraactividad),
               ];
               return $result;
          }
          public function ver(){
               $planificacion="SELECT p.*,a.nombre as actividad FROM planificacion as p JOIN actividad as a ON a.id=p.id_actividad WHERE p.id='{$this->id}' LIMIT 1";
               return mysql_fetch_assoc(parent::consultaRetorno($planificacion));
          }
          public function imprimir(){
               $planificacion="SELECT p.*,a.nombre as actividad,e.nombre as establecimiento,m.nombre as municipio FROM otra_planificacion as p
                    JOIN otra_actividad as a ON a.id=p.id_otra_actividad
                    LEFT JOIN establecimiento as e ON e.id=p.id_establecimiento
                    LEFT JOIN municipio as m ON m.id=e.id_municipio where p.id_usuario='{$this->user_id}' ";
               $all = array();$query=parent::consultaRetorno($planificacion);
               while($row = mysql_fetch_assoc($query)){
                  $all[] = $row;
               }
               $result=["todos"=> $all];
               return $result;
          }
          public function crear(){
               $sql=("INSERT INTO otra_planificacion(id_usuario,id_establecimiento,tipo_actividad,tipo_lugar,ciudad,id_otra_actividad,lugar,fecha_de, fecha_hasta) VALUES(
                    '{$this->user_id}','{$this->id_establecimiento}','{$this->tipo_actividad}','{$this->tipo_lugar}','{$this->ciudad}','{$this->id_otra_actividad}','{$this->lugar}','{$this->fecha_de}','{$this->fecha_hasta}')");
               parent::consultaSimple($sql);
               return "La Planificacion se Registro Satisfactoriamente";
          }
          public function editar(){
               $sql=("UPDATE otra_planificacion SET id_actividad='{$this->id_actividad}',fecha_de='{$this->fecha_de}',
                    fecha_hasta='{$this->fecha_hasta}',objetivo='{$this->objetivo}',esperado='{$this->esperado}' WHERE id='{$this->id}'");
               parent::consultaSimple($sql);
               return "La Planificacion se Modifico Satisfactoriamente";
          }
          public function eliminar(){
               $sql="UPDATE otra_planificacion SET estado='0'
                    WHERE id='{$this->id}'";
               parent::consultaSimple($sql);
               return "Planificacion dado de Baja Satisfactoriamente";
          }
          public function alta(){
               $sql="UPDATE otra_planificacion SET estado='1'
                    WHERE id='{$this->id}'";
               parent::consultaSimple($sql);
               return "Planificacion dado de ALTA Satisfactoriamente";
          }
     }
 ?>
