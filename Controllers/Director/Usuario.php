<?php
class Usuario extends Controllers{
     private $usuario;
     function __construct(){
          parent::__construct();
          $this->usuario=parent::loadClassmodels("UsuarioModel");
     }
     public function ver($id){
         $this->usuario->set('id',$id);
         $data=$this->usuario->ver();
         echo json_encode($data);
     }
     public function editar(){
         $this->usuario->set("nombre",$_POST['nombre']);
         $this->usuario->set("apellido",$_POST['apellido']);
         $this->usuario->set("ci",$_POST['ci']);
         $this->usuario->set("password",$_POST['password']);
         $this->usuario->set("id_cargo",$_POST['id_cargo']);
         $this->usuario->set("telefono",$_POST['telefono']);
         $resultado=$this->usuario->editar();
         echo $resultado;
     }
     public function destroySession(){
          Session::destroy();
          header('Location: '.URL);
          exit();
     }
}
 ?>
