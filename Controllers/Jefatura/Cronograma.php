<?php
class Cronograma extends Controllers{
     private $cronograma;
     function __construct(){
          parent::__construct();
          $this->cronograma=parent::loadClassmodels("CronogramaModel");
     }
     public function index(){
          $this->cronograma->set('type',isset($_GET['type']) ? $_GET['type'] :0);
         $resultado=$this->cronograma->listar();
         $this->view->render($this,"index",$resultado);
     }
     public function crear(){
          $this->cronograma->set("id_establecimiento",$_POST['id_establecimiento']);
          $this->cronograma->set("tipo_actividad",$_POST['tipo_actividad']);
          $this->cronograma->set("tipo_lugar",$_POST['tipo_lugar']);
          $this->cronograma->set("ciudad",$_POST['ciudad']);
          $this->cronograma->set("id_otra_actividad",$_POST['id_otra_actividad']);
          $this->cronograma->set("lugar",$_POST['lugar']);
          $this->cronograma->set("fecha_de",$_POST['fecha_de']);
          $this->cronograma->set("fecha_hasta",$_POST['fecha_hasta']);
          $resultado=$this->cronograma->crear();
          echo $resultado;
     }
     public function editar($id){
          $this->cronograma->set("id",$id);
          $this->cronograma->set("id_establecimiento",$_POST['id_establecimiento']);
          $this->cronograma->set("tipo_actividad",$_POST['tipo_actividad']);
          $this->cronograma->set("tipo_lugar",$_POST['tipo_lugar']);
          $this->cronograma->set("ciudad",$_POST['ciudad']);
          $this->cronograma->set("id_otra_actividad",$_POST['id_otra_actividad']);
          $this->cronograma->set("lugar",$_POST['lugar']);
          $this->cronograma->set("fecha_de",$_POST['fecha_de']);
          $this->cronograma->set("fecha_hasta",$_POST['fecha_hasta']);
         $resultado=$this->cronograma->editar();
         echo $resultado;
     }
     public function ver_cronograma($id){
         $this->cronograma->set('id',$id);
         $data=$this->cronograma->ver();
         echo json_encode($data);
     }
     public function printpdf(){
          $this->cronograma->set('de',$_GET['de']);
         $this->cronograma->set('hasta',$_GET['hasta']);
         $data=$this->cronograma->imprimir();
         $this->pdf->loadPDF($this,'print','landscape',$data);
     }
}
 ?>
