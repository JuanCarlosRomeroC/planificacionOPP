<?php
class Notificacion extends Controllers{
     private $notificacion;
     function __construct(){
          parent::__construct();
          $this->notificacion=parent::loadClassmodels("PlanificacionModel");
     }
     public function index(){
         $resultado=$this->notificacion->notificacion_lista_otraplanificacion();
         $this->view->render($this,"otra_planificacion",$resultado);
     }
     public function ver_otra_planificacion($id){
         $this->notificacion->set('id',$id);
         $data=$this->notificacion->ver_otra_planificacion();
         echo json_encode($data);
     }
     public function validar_notificacion_otro($id){
         $this->notificacion->set('id',$id);
         $data=$this->notificacion->validar_notificacion_otro();
     }
     public function notificacion(){
         $data=$this->notificacion->notificacion_usuario();
     }
}
