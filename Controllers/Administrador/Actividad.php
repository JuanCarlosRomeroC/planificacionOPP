<?php
class Actividad extends Controllers{
     private $actividad;

     function __construct(){
          parent::__construct();
          $this->actividad=parent::loadClassmodels("ActividadModel");
     }

     public function index(){
         $resultado=$this->actividad->listar();
         $this->view->render($this,"index",$resultado);
     }
     public function ver($id){
         $this->actividad->set('id',$id);
         $data=$this->actividad->ver();
         echo json_encode($data);
     }
     public function crear(){
          $this->actividad->set("nombre",$_POST['nombre']);
          $resultado=$this->actividad->crear();
          echo $resultado;
     }
     public function editar($id){
         $this->actividad->set("id",$id);
         $this->actividad->set("nombre_original",$_POST['nombre_original']);
         $this->actividad->set("nombre",$_POST['nombre']);
         $resultado=$this->actividad->editar();
         echo $resultado;
     }
     public function eliminar($id){
         $this->actividad->set('id',$id);
         $this->actividad->eliminar();
     }
}
 ?>
