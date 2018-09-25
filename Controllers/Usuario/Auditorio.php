<?php
class Auditorio extends Controllers{
     private $cronograma;
     function __construct(){
          parent::__construct();
          $this->cronograma=parent::loadClassmodels("CronogramaModel");
     }
     public function index(){
         $resultado=$this->cronograma->listar_auditorio();
         $this->view->render($this,"index",$resultado);
     }
     public function crear(){
          $this->cronograma->set("id_usuario",$_POST['id_usuario']);
          $this->cronograma->set("id_establecimiento",0);
          $this->cronograma->set("tipo_actividad","local");
          $this->cronograma->set("tipo_lugar","departamental");
          $this->cronograma->set("ciudad","potosi");
          $this->cronograma->set("id_otra_actividad",$_POST['id_otra_actividad']);
          $this->cronograma->set("lugar","auditorio");
          $this->cronograma->set("fecha_de",$_POST['fecha_de']);
          $this->cronograma->set("fecha_hasta",$_POST['fecha_hasta']);
          $resultado=$this->cronograma->crear();
          echo $resultado;
     }
     public function editar($id){
          $this->cronograma->set("id",$id);
          $this->cronograma->set("id_usuario",$_POST['id_usuario']);
          $this->cronograma->set("id_establecimiento",0);
          $this->cronograma->set("tipo_actividad","local");
          $this->cronograma->set("tipo_lugar","departamental");
          $this->cronograma->set("ciudad","potosi");
          $this->cronograma->set("id_otra_actividad",$_POST['id_otra_actividad']);
          $this->cronograma->set("lugar","auditorio");
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
         $data=$this->cronograma->imprimir_auditorio();
         $this->pdf->loadPDF($this,'print','landscape',$data);
     }
}
 ?>
