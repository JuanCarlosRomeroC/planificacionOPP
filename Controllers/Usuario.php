<?php
class Usuario extends Controllers{
     private $usuario;
     function __construct(){
          parent::__construct();
          $this->usuario=parent::loadClassmodels("UsuarioModel");
     }
     public function index(){
         $resultado=$this->usuario->listar();
         $this->view->render($this,"index","administrador","adm_",$resultado);
     }
     public function ver($id){
         $this->usuario->set('id',$id);
         $data=$this->usuario->ver();
         echo json_encode($data);
     }
     public function crear(){
          $this->usuario->set("nombre",$_POST['nombre']);
          $this->usuario->set("apellido",$_POST['apellido']);
          $this->usuario->set("ci",$_POST['ci']);
          $this->usuario->set("password", password_hash($_POST['password'], PASSWORD_BCRYPT));
          $this->usuario->set("id_cargo",$_POST['id_cargo']);
          $this->usuario->set("id_unidad",$_POST['id_unidad']);
          $this->usuario->set("telefono",$_POST['telefono']);
          $resultado=$this->usuario->crear();
          echo $resultado;
     }
     public function editar($id){
         $this->usuario->set("id",$id);
         $this->usuario->set("estado_ci",$_POST['estado_ci']);
         $this->usuario->set("estado_password",$_POST['estado_password']);
         $this->usuario->set("nombre",$_POST['nombre']);
         $this->usuario->set("apellido",$_POST['apellido']);
         $this->usuario->set("ci",$_POST['ci']);
         $this->usuario->set("password",$_POST['password']);
         $this->usuario->set("id_cargo",$_POST['id_cargo']);
         $this->usuario->set("id_unidad",$_POST['id_unidad']);
         $this->usuario->set("telefono",$_POST['telefono']);
         $resultado=$this->usuario->editar();
         echo $resultado;
     }
     public function eliminar($id){
         $this->usuario->set('id',$id);
         $this->usuario->eliminar();
     }

     public function userLogin(){
          if (isset($_POST['ci']) && isset($_POST['password'])) {
               $this->usuario->set("ci",$_POST['ci']);
               $this->usuario->set("password",$_POST['password']);
               $data=$this->usuario->login();
               if ($data!="false") {
                    $this->createSession($data['nombre']);
                    $rows= json_encode($data);
                    echo $rows;
               }else{echo false;}
         }
     }
     function createSession($user){
          Session::setSession('User',$user);
     }
     function destroySession(){
          Session::destroy();
          header('Location:'.URL);
     }
}
 ?>
