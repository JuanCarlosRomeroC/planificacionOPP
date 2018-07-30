<?php
class Principal extends Controllers{
     public function __construct(){
          parent::__construct();
     }
     public function index(){
          $this->view->render($this,"index","administrador","adm_","");
     }
}
 ?>
