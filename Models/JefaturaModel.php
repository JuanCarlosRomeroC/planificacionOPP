<?php
     class JefaturaModel extends Conexion{
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
               $jefatura="SELECT * FROM jefatura WHERE estado = b'1'";
               return parent::consultaRetorno($jefatura);
          }
          public function ver(){
               $jefatura="SELECT * FROM jefatura WHERE id = '{$this->id}' LIMIT 1";
               $encargado=parent::consultaRetorno("SELECT CONCAT(nombre,' ',apellido) as nombre FROM usuario WHERE id_lugar = '{$this->id}' AND tipo=3 LIMIT 1");
               $unidades="SELECT * FROM unidad WHERE id_jefatura = '{$this->id}'";
               $query=parent::consultaRetorno($unidades);$all = array();
               while($row = mysql_fetch_assoc($query)){
                  $all[] = $row;
               }
               $result=["unidades"=> $all,
                         "jefatura"=> mysql_fetch_assoc(parent::consultaRetorno($jefatura)),
                         "encargado"=>mysql_fetch_assoc($encargado)
               ];
               return $result;

          }
          public function crear(){
               $ver_jefatura=$this->ver_jefatura();
               if($ver_jefatura != 0){
                    return "false";
               }else{
                    $sql=("INSERT INTO jefatura(nombre) VALUES('{$this->nombre}')");
                    parent::consultaSimple($sql);
                    return "La Jefatura se Registro Satisfactoriamente";
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
          public function ver_jefatura(){
               $sql2="SELECT * FROM jefatura WHERE nombre='{$this->nombre}'";
               $resultado=parent::consultaRetorno($sql2);
               return mysql_num_rows($resultado);
          }
     }
 ?>
