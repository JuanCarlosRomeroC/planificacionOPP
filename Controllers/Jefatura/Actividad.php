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
     public function crear(){
          $this->actividad->set("id",$_POST['id_actividad']);
          $resultado=$this->actividad->crear_paraunidad();
          echo $resultado;
     }
     public function eliminar($id){
         $this->actividad->set('id',$id);
         $this->actividad->eliminar_actividadunidad();
     }
}
 ?>
