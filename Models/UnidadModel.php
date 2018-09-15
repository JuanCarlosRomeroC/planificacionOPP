<?php
     class UnidadModel extends Conexion{
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
               $unidad="SELECT u.id,u.nombre,j.nombre as jefatura FROM unidad as u
                    JOIN jefatura as j ON j.id = u.id_jefatura
                    WHERE u.estado=b'1'";
               $jefatura="SELECT * FROM jefatura WHERE estado=b'1'";
               $result=["unidades"=> parent::consultaRetorno($unidad),
                         "jefaturas"=> parent::consultaRetorno($jefatura)
               ];
               return $result;
          }
          public function ver(){
               $unidad="SELECT * FROM unidad WHERE id = '{$this->id}' LIMIT 1";
               $usuarios="SELECT * FROM usuario WHERE id_lugar = '{$this->id}'";
               $all = array();$query=parent::consultaRetorno($usuarios);
               while($row = mysql_fetch_assoc($query)){
                  $all[] = $row;
               }
               $count=0;
               while($count<count($all)){
                    $all[$count]['id_hash']=base64_encode($all[$count]['id']);
                  $count++;
               }
               $result=["usuarios"=> $all,
                         "unidad"=> mysql_fetch_assoc(parent::consultaRetorno($unidad))
               ];
               return $result;
          }
          public function crear(){
               $ver_unidad=$this->ver_unidad();
               if($ver_unidad != 0){
                    return "false";
               }else{
                    $sql=("INSERT INTO unidad(nombre,id_jefatura) VALUES(
                         '{$this->nombre}','{$this->id_jefatura}')");
                    parent::consultaSimple($sql);
                    return "La Unidad se Registro Satisfactoriamente";
               }
          }
          public function editar(){
               if($this->nombre_original==$this->nombre){
                    $sql=("UPDATE unidad SET
                         nombre='{$this->nombre_original}',
                         id_jefatura='{$this->id_jefatura}' WHERE id='{$this->id}' ");
               }else{
                    $ver_unidad=$this->ver_unidad();
                    if($ver_unidad != 0){
                         return "false";
                    }else{
                         $sql=("UPDATE unidad SET
                              nombre='{$this->nombre}',
                              id_jefatura='{$this->id_jefatura}' WHERE id='{$this->id}' ");
                    }
               }
               parent::consultaSimple($sql);
               return "La Unidad se Modifico Satisfactoriamente";
          }
          public function eliminar(){
               $sql="UPDATE unidad SET estado=b'0'
                    WHERE id='{$this->id}'";
               parent::consultaSimple($sql);
               return "Unidad dado de Baja Satisfactoriamente";
          }
          public function ver_unidad(){
               $sql2="SELECT * FROM unidad WHERE nombre='{$this->nombre}'";
               $resultado=parent::consultaRetorno($sql2);
               return mysql_num_rows($resultado);
          }

          public function listar_jefatura(){
               $unidad="SELECT u.id,u.nombre,j.nombre as jefatura FROM unidad as u
                    JOIN jefatura as j ON j.id = u.id_jefatura
                    WHERE u.estado=b'1' AND u.id_jefatura='{$this->user_lugar}'";
               $result=["unidades"=> parent::consultaRetorno($unidad)];
               return $result;
          }
     }
 ?>
