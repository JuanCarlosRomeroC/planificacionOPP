<?php
class Cronograma extends Controllers{
     private $cronograma;
     function __construct(){
          parent::__construct();
          $this->cronograma=parent::loadClassmodels("CronogramaModel");
     }
     public function index(){
          $this->cronograma->set('type',isset($_GET['type']) ? $_GET['type'] :1);
         $resultado=$this->cronograma->listar();
         $this->view->render($this,"index",$resultado);
     }
     public function ver($id){
         $this->cronograma->set('id',base64_decode($id));
         $this->cronograma->set('year',isset($_GET['year']) ? $_GET['year'] :date('Y'));
         $this->cronograma->set('month',isset($_GET['month']) ? $_GET['month'] :date('m'));
         $data=$this->cronograma->listar_unusuario();
         $this->view->render($this,"ver",$data);
     }
     public function ver_cronograma($id){
         $this->cronograma->set('id',$id);
         $data=$this->cronograma->ver();
         echo json_encode($data);
     }

     public function printpdf($id){
          $this->cronograma->set('id',base64_decode($id));
          $this->cronograma->set('year',substr($_GET['date'], 0, -2));
          $this->cronograma->set('month',substr($_GET['date'], -2));
          $data=$this->cronograma->imprimir_unusuario();
          $this->pdf->loadPDF($this,'print','landscape',$data);
     }
     public function validar_p($id){
         $this->cronograma->set('id',base64_decode($id));
         $data=$this->cronograma->validar_planificador();
     }
     public function crear(){
          $this->cronograma->set("id_actividad",$_POST['id_actividad']);
          $this->cronograma->set("fecha_de",$_POST['fecha_de']);
          $this->cronograma->set("fecha_hasta",$_POST['fecha_hasta']);
          $this->cronograma->set("objetivo",$_POST['objetivo']);
          $this->cronograma->set("esperado",$_POST['esperado']);
          $resultado=$this->cronograma->crear();
          echo $resultado;
     }
     public function editar($id){
          $this->cronograma->set("id",$id);
          $this->cronograma->set("id_actividad",$_POST['id_actividad']);
         $this->cronograma->set("fecha_de",$_POST['fecha_de']);
         $this->cronograma->set("fecha_hasta",$_POST['fecha_hasta']);
         $this->cronograma->set("objetivo",$_POST['objetivo']);
         $this->cronograma->set("esperado",$_POST['esperado']);
         $resultado=$this->cronograma->editar();
         echo $resultado;
     }
     public function completarinforme($id){
          $this->cronograma->set("id",$id);
          $this->cronograma->set("observacion",$_POST['observacion']);
          $resultado=$this->cronograma->completarinforme();
          echo $resultado;
     }
}
 ?>
