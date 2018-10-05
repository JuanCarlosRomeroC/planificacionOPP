<?php
class Cronograma extends Controllers{
     private $cronograma;
     function __construct(){
          parent::__construct();
          $this->cronograma=parent::loadClassmodels("CronogramaModel");
     }
     public function index(){
          $this->cronograma->set('type',isset($_GET['type']) ? $_GET['type'] :0);
          $resultado=$this->cronograma->listar_planificador();
          $this->view->render($this,"index",$resultado);
     }
     public function ver_cronograma($id){
         $this->cronograma->set('id',$id);
         $data=$this->cronograma->ver();
         echo json_encode($data);
     }
     public function editar($id){
          $this->cronograma->set("id",$id);
          $this->cronograma->set("fecha_de",$_POST['fecha_de']);
          $this->cronograma->set("fecha_hasta",$_POST['fecha_hasta']);
          $this->cronograma->set("modificado_descripcion",$_POST['descripcion']);
          $resultado=$this->cronograma->editar_planificador();
     }
     public function printpdf($type){
          $this->cronograma->set("type",$type);
          $this->cronograma->set('de',$_GET['de']);
         $this->cronograma->set('hasta',$_GET['hasta']);
         $data=$this->cronograma->imprimir_planificador();
         //$this->view->render($this,"print",$data);
         $this->pdf->loadPDF($this,'print','landscape',$data);
     }
}
 ?>
