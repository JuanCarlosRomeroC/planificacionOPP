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
         $this->planificacion->set('id',base64_decode($id));
         $this->planificacion->set('year',isset($_GET['year']) ? $_GET['year'] :date('Y'));
         $this->planificacion->set('month',isset($_GET['month']) ? $_GET['month'] :date('m'));
         $data=$this->planificacion->listar_unusuario();
         $this->view->render($this,"ver",$data);
     }
     public function ver_planificacion($id){
         $this->planificacion->set('id',$id);
         $data=$this->planificacion->ver();
         echo json_encode($data);
     }

     public function printpdf($id){
          $this->planificacion->set('id',base64_decode($id));
          $this->planificacion->set('year',substr($_GET['date'], 0, -2));
          $this->planificacion->set('month',substr($_GET['date'], -2));
          $data=$this->planificacion->imprimir_unusuario();
          $this->pdf->loadPDF($this,'print','landscape',$data);
     }
     public function validar_p($id){
         $this->planificacion->set('id',base64_decode($id));
         $data=$this->planificacion->validar_planificador();
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
     public function completarinforme($id){
          $this->planificacion->set("id",$id);
          $this->planificacion->set("observacion",$_POST['observacion']);
          $resultado=$this->planificacion->completarinforme();
          echo $resultado;
     }
}
 ?>
