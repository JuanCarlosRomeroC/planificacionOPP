<?php
class Notificacion extends Controllers{
     private $notificacion;
     function __construct(){
          parent::__construct();
          $this->notificacion=parent::loadClassmodels("PlanificacionModel");
     }
     public function index(){
         $resultado=$this->notificacion->notificacion_unidad();
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
         $data=$this->notificacion->notificacion();
         echo json_encode($data);
     }
     public function otra_planificacion(){
         $resultado=$this->notificacion->notificacion_lista_otraplanificacion();
         $this->view->render($this,"otra_planificacion",$resultado);
     }
     public function validar_notificacion_otro($id){
         $this->notificacion->set('id',$id);
         $data=$this->notificacion->validar_notificacion_otro();
     }
}
 ?>
