<?php
class Usuario extends Controllers{
     private $usuario;
     function __construct(){
          parent::__construct();
          $this->usuario=parent::loadClassmodels("UsuarioModel");
     }
     public function index(){
         $resultado=$this->usuario->listar_jefatura();
         $this->view->render($this,"index",$resultado);
     }
     public function ver($id){
         $this->usuario->set('id',$id);
         $data=$this->usuario->ver();
         echo json_encode($data);
     }
     public function editar($id){
         $this->usuario->set("id",$id);
         $this->usuario->set("ci_original",$_POST['ci_original']);
         $this->usuario->set("password_original",$_POST['password_original']);
         $this->usuario->set("nombre",$_POST['nombre']);
         $this->usuario->set("apellido",$_POST['apellido']);
         $this->usuario->set("ci",$_POST['ci']);
         $this->usuario->set("password",$_POST['password']);
         $this->usuario->set("id_cargo",$_POST['id_cargo']);
         $this->usuario->set("id_lugar",$_POST['id_lugar']);
         $this->usuario->set("telefono",$_POST['telefono']);
         $this->usuario->set("tipo",$_POST['tipo']);
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
