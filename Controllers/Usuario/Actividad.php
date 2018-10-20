<?php
class Actividad extends Controllers{
     private $actividad;
     function __construct(){
          parent::__construct();
          $this->actividad=parent::loadClassmodels("ActividadModel");
     }
     public function index(){
          $this->actividad->set('year',isset($_GET['year']) ? $_GET['year'] :date('Y'));
          $resultado=$this->actividad->listar_poai();
          $this->view->render($this,"mi_poai",$resultado);
     }
     public function crear_poai(){
          $this->actividad->set("id_actividad",$_POST['id_actividad']);
          $this->actividad->set("total",$_POST['total']);
          $this->actividad->crear_poai();
     }
     public function editar_poai($id){
          $this->actividad->set("id",$id);
          $this->actividad->set("total",$_POST['total']);
          $this->actividad->editar_poai();
     }
     public function eliminar_poai($id){
         $this->actividad->set('id',$id);
         $this->actividad->eliminar_poai();
     }
}
 ?>
