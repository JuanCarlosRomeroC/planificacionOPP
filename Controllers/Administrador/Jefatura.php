<?php
class Jefatura extends Controllers{
     private $jefatura;
     function __construct(){
          parent::__construct();
          $this->jefatura=parent::loadClassmodels("JefaturaModel");
     }
     public function index(){
         $resultado=$this->jefatura->listar();
         $this->view->render($this,"index",$resultado);
     }
     public function ver($id){
         $this->jefatura->set('id',$id);
         $data=$this->jefatura->ver();
         echo json_encode($data);
     }
     public function crear(){
          $this->jefatura->set("nombre",$_POST['nombre']);
          $resultado=$this->jefatura->crear();
          echo $resultado;
     }
     public function editar($id){
         $this->jefatura->set("id",$id);
         $this->jefatura->set("nombre_original",$_POST['nombre_original']);
         $this->jefatura->set("nombre",$_POST['nombre']);
         $resultado=$this->jefatura->editar();
         echo $resultado;
     }
     public function eliminar($id){
         $this->jefatura->set('id',$id);
         $this->jefatura->eliminar();
     }
}
 ?>
