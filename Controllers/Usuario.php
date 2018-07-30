<?php
include_once("/../Models/UsuarioModel.php");
class Usuario extends Controllers{
     private $usuario;
     function __construct(){
          $this->usuario=new UsuarioModel();
          parent::__construct();
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
     public function crear ($ci,$nombre,$apellido,$jefatura,$unidad,$tipo,$cargo,$estado,$direccion,$telefono,$clave){
         $this->usuario->set("ci",$ci);
         $this->usuario->set("nombre",$nombre);
         $this->usuario->set("apellido",$apellido);
         $this->usuario->set("jefatura",$jefatura);
         $this->usuario->set("unidad",$unidad);
         $this->usuario->set("tipo",$tipo);
         $this->usuario->set("cargo",$cargo);
         $this->usuario->set("estado",$estado);
         $this->usuario->set("direccion",$direccion);
         $this->usuario->set("telefono",$telefono);
         $this->usuario->set("clave",$clave);

         $resultado=$this->usuario->crear();
         return $resultado;
     }
     public function editar($id){
         $this->usuario->set("id",$id);
         $this->usuario->ver();
         $this->usuario->editar();
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
               if (isset($data)) {
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
