<?php
class Planificacion extends Controllers{
     private $planificacion;
     function __construct(){
          parent::__construct();
          $this->planificacion=parent::loadClassmodels("PlanificacionModel");
     }
//__________ACCIONES PARA MI
     public function ver($id){//ver una planificacion
         $this->planificacion->set('id',$id);
         $data=$this->planificacion->ver();
         echo json_encode($data);
     }
//__________ACCIONES PARA USUARIO___________
     public function listar_unusuario($id){//lista de planificacion de 1 usuario
         $this->planificacion->set('id',base64_decode($id));
         $this->planificacion->set('year',isset($_GET['year']) ? $_GET['year'] :date('Y'));
         $this->planificacion->set('month',isset($_GET['month']) ? $_GET['month'] :date('m'));
         $data=$this->planificacion->listar_unusuario();
         $this->view->render($this,"ver",$data);
     }
     public function validar_p($id){//valida planificacion de usuario
         $this->planificacion->set('id',base64_decode($id));
         $data=$this->planificacion->validar_planificador();
     }
     public function print_un_informe($id){//imprime informe de 1 usuario
          $this->planificacion->set('id',base64_decode($id));
          $this->planificacion->set('year',substr($_GET['date'], 0, -2));
          $this->planificacion->set('month',substr($_GET['date'], -2));
          $data=$this->planificacion->imprimir();
          $this->pdf->loadPDF($this,'print_informe','landscape',$data);
     }
}
 ?>
