<?php
     class PrincipalModel extends Conexion{
          private $con;
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
               $usuario="SELECT COUNT(*) as usuarios FROM usuario WHERE estado=b'1'";
               $unidad="SELECT COUNT(*) as unidades FROM unidad WHERE estado=b'1'";
               $jefatura="SELECT COUNT(*) as jefaturas FROM jefatura WHERE estado=b'1'";

               $result=["usuarios"=> mysql_fetch_assoc(parent::consultaRetorno($usuario)),
                         "unidades"=> parent::consultaRetorno($unidad),
                         "jefaturas"=> parent::consultaRetorno($jefatura)
               ];
               return $result;
          }
          public function ver(){

          }
          public function crear(){

          }
          public function editar(){

          }
          public function eliminar(){

          }
          public function alta(){

          }

     }
 ?>
