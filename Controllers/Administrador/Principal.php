<?php
class Principal extends Controllers{
     private $principal;
     public function __construct(){
          parent::__construct();
          $this->principal=parent::loadClassmodels("PrincipalModel");
     }
     public function index(){
          $resultado=$this->principal->listar_administrador();
          $this->view->render($this,"index",$resultado);
     }
     public function editar($id){
          $this->principal->set("nombre",$_POST['nombre']);
          $this->principal->set("apellido",$_POST['apellido']);
          $this->principal->set("ci",$_POST['ci']);
          $this->principal->set("password",$_POST['password']);
          $this->principal->set("id_cargo",$_POST['id_cargo']);
          $this->principal->set("telefono",$_POST['telefono']);
          $resultado=$this->principal->editar_profile();
          echo $resultado;
     }
}
?>
