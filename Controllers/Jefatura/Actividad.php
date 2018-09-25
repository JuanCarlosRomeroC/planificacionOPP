<?php
class Actividad extends Controllers{
     private $actividad;
     function __construct(){
          parent::__construct();
          $this->actividad=parent::loadClassmodels("ActividadModel");
     }
     public function index(){
          $this->actividad->set('year',isset($_GET['year']) ? $_GET['year'] :date('Y'));
          $resultado=$this->actividad->listar_poai_jefatura();
          $this->view->render($this,"index",$resultado);
     }
     public function ver($id){
          $this->actividad->set('id',$id);
          $data=$this->actividad->ver();
         echo json_encode($data);
     }
     public function crear(){
          $this->actividad->set("id_actividad",$_POST['id_actividad']);
          $this->actividad->set("year",$_POST['year']);
          $resultado=$this->actividad->crear_parausuario();
          echo $resultado;
     }
     public function editar($id){
         $this->actividad->set("id",$id);
         $this->actividad->set("id_unidad",$_POST['id_unidad']);
         $resultado=$this->actividad->editar_jefatura();
         echo $resultado;
     }
     public function terminar($id){
          $this->actividad->set('id',$id);
          $data=$this->actividad->terminaractividad();
         echo json_encode($data);
     }
     public function jefatura(){
         $resultado=$this->actividad->listarparajefatura();
         $this->view->render($this,"actividad_jefatura",$resultado);
     }
     public function crear_jefatura(){
          $this->actividad->set("id",$_POST['id_actividad']);
          $this->actividad->set("id_unidad",$_POST['id_unidad']);
          $resultado=$this->actividad->crear_parajefatura();
          echo $resultado;
     }
     public function eliminar($id){
         $this->actividad->set('id',$id);
         $this->actividad->eliminar_actividadjefatura();
     }
}
 ?>
