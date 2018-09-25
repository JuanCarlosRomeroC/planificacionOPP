<?php
class Actividad extends Controllers{
     private $actividad;
     function __construct(){
          parent::__construct();
          $this->actividad=parent::loadClassmodels("ActividadModel");
     }
     public function all(){
         $resultado=$this->actividad->listar();
         $this->view->render($this,"all",$resultado);
     }
     public function index(){
          $this->actividad->set('year',isset($_GET['year']) ? $_GET['year'] :date('Y'));
         $resultado=$this->actividad->listarparausuario();
         $this->view->render($this,"poai",$resultado);
     }
     public function crear_poai(){
          $this->actividad->set("id_actividad",$_POST['id_actividad']);
          $this->actividad->set("year",$_POST['year']);
          $resultado=$this->actividad->crear_paraplanificador();
          echo $resultado;
     }
     public function unidad(){
          $resultado=$this->actividad->listarparaunidad();
          $this->view->render($this,"actividad_unidad",$resultado);
     }
     public function ver($id){
         $this->actividad->set('id',$id);
         $data=$this->actividad->ver();
         echo json_encode($data);
     }
     public function crear(){
          $this->actividad->set("nombre",$_POST['nombre']);
          $this->actividad->set("id_jefatura",$_POST['id_jefatura']);
          $this->actividad->set("id_unidad",$_POST['id_unidad']);
          $resultado=$this->actividad->crear();
          echo $resultado;
     }
     public function editar($id){
         $this->actividad->set("id",$id);
         $this->actividad->set("nombre",$_POST['nombre']);
         $this->actividad->set("id_jefatura",$_POST['id_jefatura']);
         $this->actividad->set("id_unidad",$_POST['id_unidad']);
         $resultado=$this->actividad->editar();
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
