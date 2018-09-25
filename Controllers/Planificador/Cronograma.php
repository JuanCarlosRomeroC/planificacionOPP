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
     public function ver_cronograma($id){
         $this->cronograma->set('id',$id);
         $data=$this->cronograma->ver();
         echo json_encode($data);
     }
     public function editar($id){
          $this->cronograma->set("id",$id);
         if ($_POST['estado']=="true") {
              $this->cronograma->set("fecha_de",date('Y-m-d', strtotime($_POST['fecha_de']. ' + 1 day')));
         }else{
              $this->cronograma->set("fecha_de",$_POST['fecha_de']);
         }
         $this->cronograma->set("fecha_hasta",$_POST['fecha_hasta']);
         $this->cronograma->set("descripcion",$_POST['descripcion']);
         $resultado=$this->cronograma->editar();
     }
}
 ?>
