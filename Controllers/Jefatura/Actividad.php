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
          $year=intval(date('Y'))+1;
          $this->actividad->set("id_actividad",$_POST['id_actividad']);
          $this->actividad->set("year",$year);
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

     public function ver($id){
          $this->actividad->set('id',$id);
          $data=$this->actividad->ver();
         echo json_encode($data);
     }
     public function editar($id){
         $this->actividad->set("id",$id);
         $this->actividad->set("nombre",$_POST['nombre']);
         $this->actividad->set("id_unidad",$_POST['id_unidad']);
         $resultado=$this->actividad->editar();
         echo $resultado;
     }
     public function jefatura(){
         $resultado=$this->actividad->listarparajefatura();
         $this->view->render($this,"actividad_jefatura",$resultado);
     }
     public function crear(){
          $this->actividad->set("nombre",$_POST['nombre']);
          $this->actividad->set("id_unidad",$_POST['id_unidad']);
          $resultado=$this->actividad->crear();
          echo $resultado;
     }
     public function eliminar($id){
         $this->actividad->set('id',$id);
         $this->actividad->eliminar();
     }
     public function alta($id){
         $this->actividad->set('id',$id);
         $this->actividad->alta();
     }
}
 ?>
