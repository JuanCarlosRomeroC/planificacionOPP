<?php
     class PlanificacionModel extends Conexion{
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
               $actividad="SELECT pa.year,a.nombre,a.id FROM planificacion_anual as pa
               JOIN actividad as a ON a.id=pa.id_actividad WHERE pa.id_usuario='{$this->user_id}' AND pa.year='{$year}'";
               $planificacion="SELECT p.*,a.nombre as actividad FROM planificacion as p
               JOIN actividad as a ON a.id=p.id_actividad where p.id_usuario='{$this->user_id}'";
               $result=[
                         "actividades"=> parent::consultaRetorno($actividad),
                         "planificacion"=>parent::consultaRetorno($planificacion)
               ];
               return $result;
          }
          public function ver(){
               $planificacion="SELECT p.*,a.nombre as actividad FROM planificacion as p JOIN actividad as a ON a.id=p.id_actividad WHERE p.id='{$this->id}' LIMIT 1";

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
     }
 ?>
