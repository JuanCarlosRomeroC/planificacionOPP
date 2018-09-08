<?php
class Actividad extends Controllers{
     private $actividad;

     function __construct(){
          parent::__construct();
          $this->actividad=parent::loadClassmodels("ActividadModel");
     }
     public function index(){
         $resultado=$this->actividad->listarparaunidad();
         $this->view->render($this,"index",$resultado);
     }
     public function terminar($id){
          $this->actividad->set('id',$id);
         $data=$this->actividad->terminaractividad();
         echo json_encode($data);
     }
}
 ?>
