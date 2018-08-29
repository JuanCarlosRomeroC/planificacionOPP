<?php
class Planificacion extends Controllers{
     private $planificacion;
     function __construct(){
          parent::__construct();
          $this->planificacion=parent::loadClassmodels("PlanificacionModel");
     }
     public function index(){
          $year=isset($_GET['year']) ? $_GET['year'] :date('Y');
          $month=isset($_GET['month']) ? $_GET['month'] :date('m');
          $this->planificacion->set('year',$year);
          $this->planificacion->set('month',$month);
         $resultado=$this->planificacion->listar();
         $this->view->render($this,"index",$resultado);
     }
     public function ver($id){
         $this->planificacion->set('id',$id);
         $data=$this->planificacion->ver();
         echo json_encode($data);
     }
     public function crear(){
          $this->planificacion->set("id_actividad",$_POST['id_actividad']);
          $this->planificacion->set("fecha_de",$_POST['fecha_de']);
          $this->planificacion->set("fecha_hasta",$_POST['fecha_hasta']);
          $this->planificacion->set("objetivo",$_POST['objetivo']);
          $this->planificacion->set("esperado",$_POST['esperado']);
          $resultado=$this->planificacion->crear();
          echo $resultado;
     }
     public function editar($id){
          $this->planificacion->set("id",$id);
          $this->planificacion->set("id_actividad",$_POST['id_actividad']);
         $this->planificacion->set("fecha_de",$_POST['fecha_de']);
         $this->planificacion->set("fecha_hasta",$_POST['fecha_hasta']);
         $this->planificacion->set("objetivo",$_POST['objetivo']);
         $this->planificacion->set("esperado",$_POST['esperado']);
         $resultado=$this->planificacion->editar();
         echo $resultado;
     }
     public function destroySession(){
          Session::destroy();
          header('Location: '.URL);
          exit();
     }
}
 ?>
