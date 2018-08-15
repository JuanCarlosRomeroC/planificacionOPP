<?php
class Index extends Controllers{
     private $usuario;
     public function __construct(){
          parent::__construct();
          $this->usuario=parent::loadClassmodels("UsuarioModel");
     }
     public function index(){
          $this->view->render($this,"index","");
     }
     public function userLogin(){
          if (isset($_POST['ci']) && isset($_POST['password'])) {
               $this->usuario->set("ci",$_POST['ci']);
               $this->usuario->set("password",$_POST['password']);
               $data=$this->usuario->login();
               if ($data!="false") {
                    $this->createSession($data);
                    $rows= json_encode($data);
                    echo $rows;
               }else{echo false;}
         }
     }
     function createSession($user){
          Session::setSession('User',$user);
     }
}
 ?>
