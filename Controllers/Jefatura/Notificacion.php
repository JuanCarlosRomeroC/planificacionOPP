<?php
class Notificacion extends Controllers{
     private $notificacion;
     function __construct(){
          parent::__construct();
          $this->notificacion=parent::loadClassmodels("PlanificacionModel");
     }
     public function index(){
         $resultado=$this->notificacion->notificacion_listajefatura();
         $this->view->render($this,"index",$resultado);
     }
     public function ver_planificacion($id){
         $this->notificacion->set('id',$id);
         $data=$this->notificacion->ver();
         echo json_encode($data);
     }
     public function validar_u($id){
         $this->notificacion->set('id',base64_decode($id));
         $data=$this->notificacion->validar_unidad();
     }
     public function notificacion(){
         $data=$this->notificacion->notificacion_jefatura();
     }
}
 ?>
