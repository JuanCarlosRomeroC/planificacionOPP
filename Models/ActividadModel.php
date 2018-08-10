

<?php
     class ActividadModel extends Conexion{
          function __construct(){
               parent::__construct();
          }
          public function set($atributo,$contenido){
               $this->$atributo=$contenido;
          }
          public function get($atributo){
               return $this->$atributo;
          }
          public function listar(){
               $actividad="SELECT * FROM actividad ";
               return parent::consultaRetorno($actividad);
          }
          public function ver(){
               $actividad="SELECT * FROM actividad WHERE id = '{$this->id}' LIMIT 1" ;
               $result=mysql_fetch_assoc(parent::consultaRetorno($actividad));
               return $result;

          }
          public function crear(){
               $ver_actividad=$this->ver_actividad();
               if($ver_actividad != 0){
                    return "false";
               }else{
                    $sql=("INSERT INTO `actividad`(`id`, `nombre`, `fecha`, `id`) VALUES (null,'{$this->nombre}',CURRENT_TIME,4)");
                    parent::consultaSimple($sql);
                    return "La actividad se Registro Satiiamente";
               }
          }
          public function editar(){
               if($this->nombre_original==$this->nombre){
                    $sql=("UPDATE jefatura SET
                         nombre='{$this->nombre_original}' WHERE id='{$this->id}' ");
               }else{
                    $ver_jefatura=$this->ver_jefatura();
                    if($ver_jefatura != 0){
                         return "false";
                    }else{
                         $sql=("UPDATE jefatura SET
                              nombre='{$this->nombre}' WHERE id='{$this->id}' ");
                    }
               }
               parent::consultaSimple($sql);
               return "La Jefatura se Modifico Satisfactoriamente";
          }
          public function eliminar(){
               $sql="UPDATE jefatura SET estado=b'0'
                    WHERE id='{$this->id}'";
               parent::consultaSimple($sql);
               return "Jefatura dada de Baja Satisfactoriamente";
          }
          public function ver_actividad(){
               $sql2="SELECT * FROM actividad WHERE actividad='{$this->nombre}'";
               $resultado=parent::consultaRetorno($sql2);
               return mysql_num_rows($resultado);
          }
     }
 ?>
