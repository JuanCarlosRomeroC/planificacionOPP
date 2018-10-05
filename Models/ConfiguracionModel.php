<?php
     class ConfiguracionModel extends Conexion{
          function __construct(){
               parent::__construct();
          }
          public function set($atributo,$contenido){
               $this->$atributo=$contenido;
          }
          public function get($atributo){
               return $this->$atributo;
          }
          public function listar_cargo(){
               $cargo="SELECT * FROM cargo WHERE estado = 1 ";
               $baja="SELECT * FROM cargo WHERE estado = 0";
               $result=["cargos"=>parent::consultaRetorno($cargo),
                         "bajas"=>parent::consultaRetorno($baja),
               ];
               return $result;
          }
          public function listar_otro(){
               $otro="SELECT * FROM otra_actividad WHERE estado = 1 ";
               $baja="SELECT * FROM otra_actividad WHERE estado = 0";
               $result=["otros"=>parent::consultaRetorno($otro),
                         "bajas"=>parent::consultaRetorno($baja),
               ];
               return $result;
          }
          public function listar_auditorio(){
               $auditorio_users="SELECT id,CONCAT(nombre,' ',apellido) as nombre , ci FROM usuario WHERE estado = 1 AND auditorio=1";
               $usuarios="SELECT id,CONCAT(nombre,' ',apellido) as nombre FROM usuario WHERE estado=1 AND tipo=5 AND auditorio=0" ;
               $result=["auditorio_users"=>parent::consultaRetorno($auditorio_users),
                         "usuarios"=>parent::consultaRetorno($usuarios),
               ];
               return $result;
          }
          public function listar_director(){
               $director_users="SELECT id,CONCAT(nombre,' ',apellido) as nombre , ci FROM usuario WHERE estado = 1 AND director=1";
               $usuarios="SELECT id,CONCAT(nombre,' ',apellido) as nombre FROM usuario WHERE estado=1 AND tipo=5 AND director=0" ;
               $result=["director_users"=>parent::consultaRetorno($director_users),
                         "usuarios"=>parent::consultaRetorno($usuarios),
               ];
               return $result;
          }
          public function crear_cargo(){
               $ver_cargo=$this->ver_cargo();
               if($ver_cargo != 0){
                    echo "false";
               }else{
                    $sql=("INSERT INTO cargo(nombre) VALUES('{$this->nombre}')");
                    parent::consultaSimple($sql);
                    echo "El Cargo se Registro Satisfactoriamente";
               }
          }
          public function crear_otro(){
               $ver_otro=$this->ver_otro();
               if($ver_otro != 0){
                    echo "false";
               }else{
                    $sql=("INSERT INTO otra_actividad(nombre) VALUES('{$this->nombre}')");
                    parent::consultaSimple($sql);
                    echo "La Actividad se Registro Satisfactoriamente";
               }
          }
          public function editar_cargo(){
               $ver_cargo=$this->ver_cargo();
               if($ver_cargo != 0){
                    echo "false";
               }else{
                    $sql=("UPDATE cargo SET nombre='{$this->nombre}' WHERE id='{$this->id}' ");
                    parent::consultaSimple($sql);
                    echo "El Cargo se Modifico Satisfactoriamente";
               }
          }
          public function editar_otro(){
               $ver_otro=$this->ver_otro();
               if($ver_otro != 0){
                    echo "false";
               }else{
                    $sql=("UPDATE otra_actividad SET nombre='{$this->nombre}' WHERE id='{$this->id}' ");
                    parent::consultaSimple($sql);
                    echo "La Actividad se Modifico Satisfactoriamente";
               }
          }
          public function baja_otro(){
               $sql="UPDATE otra_actividad SET estado=0 WHERE id='{$this->id}'";
               parent::consultaSimple($sql);
               echo "La Actividad se dio de Baja Satisfactoriamente";
          }
          public function baja_cargo(){
               $sql="UPDATE cargo SET estado=0 WHERE id='{$this->id}'";
               parent::consultaSimple($sql);
               echo "El Cargo se dio de Baja Satisfactoriamente";
          }
          public function baja_usuario_auditorio(){
               $sql="UPDATE usuario SET auditorio=0 WHERE id='{$this->id}'";
               parent::consultaSimple($sql);
               echo "Se Dio de Baja Al Usuario Encargado del Auditorio Satisfactoriamente";
          }
          public function baja_usuario_director(){
               $sql="UPDATE usuario SET director=0 WHERE id='{$this->id}'";
               parent::consultaSimple($sql);
               echo "Se quito los permisos para ver la agenda del director Satisfactoriamente";
          }
          public function alta_otro(){
               $sql="UPDATE otra_actividad SET estado=1 WHERE id='{$this->id}'";
               parent::consultaSimple($sql);
               echo "La Actividad se dio de Alta Satisfactoriamente";
          }
          public function alta_cargo(){
               $sql="UPDATE cargo SET estado=1 WHERE id='{$this->id}'";
               parent::consultaSimple($sql);
               echo "El Cargo se dio de Alta Satisfactoriamente";
          }
          public function alta_usuario_auditorio(){
               $sql="UPDATE usuario SET auditorio=1 WHERE id='{$this->id}'";
               parent::consultaSimple($sql);
               echo "Se Dio de Alta Al Usuario Encargado del Auditorio Satisfactoriamente";
          }
          public function alta_usuario_director(){
               $sql="UPDATE usuario SET director=1 WHERE id='{$this->id}'";
               parent::consultaSimple($sql);
               echo "Se Dio los permisos para ver la agenda del director Satisfactoriamente";
          }
          public function ver_cargo(){
               $sql2="SELECT * FROM cargo WHERE nombre='{$this->nombre}'";
               $resultado=parent::consultaRetorno($sql2);
               return mysql_num_rows($resultado);
          }
          public function ver_otro(){
               $sql2="SELECT * FROM otra_actividad WHERE nombre='{$this->nombre}'";
               $resultado=parent::consultaRetorno($sql2);
               return mysql_num_rows($resultado);
          }
     }
 ?>
