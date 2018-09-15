<?php
class Notificacion extends Controllers{
     private $notificacion;
     function __construct(){
          parent::__construct();
          $this->notificacion=parent::loadClassmodels("PlanificacionModel");
     }
     public function index(){
         $resultado=$this->notificacion->notificacion_listaplanificador();
         $this->view->render($this,"index",$resultado);
     }
     public function ver_planificacion($id){
         $this->notificacion->set('id',$id);
         $data=$this->notificacion->ver();
         echo json_encode($data);
     }
     public function validar_p($id){
         $this->notificacion->set('id',base64_decode($id));
         $data=$this->notificacion->validar_planificador();
     }
     public function notificacion(){
         $data=$this->notificacion->notificacion_planificador();
     }
}
