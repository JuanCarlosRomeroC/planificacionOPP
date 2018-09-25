<?php
class Principal extends Controllers{
     private $principal;
     public function __construct(){
          parent::__construct();
          $this->principal=parent::loadClassmodels("PrincipalModel");
     }
     public function index(){
          $resultado=$this->principal->listar();
          $this->view->render($this,"index",$resultado);
     }
}
?>
