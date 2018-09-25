<?php
class Actividad extends Controllers{
     private $actividad;
     function __construct(){
          parent::__construct();
          $this->actividad=parent::loadClassmodels("ActividadModel");
     }
     public function index(){
          $this->actividad->set('year',isset($_GET['year']) ? $_GET['year'] :date('Y'));
          $resultado=$this->actividad->listar_poai_director();
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
     public function terminar($id){
          $this->actividad->set('id',$id);
          $data=$this->actividad->terminaractividad();
         echo json_encode($data);
     }
     public function eliminar($id){
         $this->actividad->set('id',$id);
         $this->actividad->eliminar_actividadjefatura();
     }
}
 ?>
