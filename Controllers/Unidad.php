<?php
class Unidad extends Controllers{
     private $unidad;
     function __construct(){
          parent::__construct();
          $this->unidad=parent::loadClassmodels("UnidadModel");
     }
     public function index(){
         $resultado=$this->unidad->listar();
         $this->view->render($this,"index","administrador","adm_",$resultado);
     }
     public function ver($id){
         $this->unidad->set('id',$id);
         $data=$this->unidad->ver();
         echo json_encode($data);
     }
     public function crear(){
          $this->unidad->set("nombre",$_POST['nombre']);
          $this->unidad->set("id_jefatura",$_POST['id_jefatura']);
          $resultado=$this->unidad->crear();
          echo $resultado;
     }
     public function editar($id){
         $this->unidad->set("id",$id);
         $this->unidad->set("nombre_original",$_POST['nombre_original']);
         $this->unidad->set("nombre",$_POST['nombre']);
         $this->unidad->set("id_jefatura",$_POST['id_jefatura']);
         $resultado=$this->unidad->editar();
         echo $resultado;
     }
     public function eliminar($id){
         $this->unidad->set('id',$id);
         $this->unidad->eliminar();
     }
}
 ?>
