<?php
class Agenda extends Controllers{
     private $agenda;
     function __construct(){
          parent::__construct();
          $this->agenda=parent::loadClassmodels("CronogramaModel");
     }
     public function index(){
          $this->agenda->set('type',isset($_GET['type']) ? $_GET['type'] :0);
         $resultado=$this->agenda->listar_agenda();
         $this->view->render($this,"index",$resultado);
     }
     public function ver_agenda($id){
         $this->agenda->set('id',$id);
         $data=$this->agenda->ver();
         echo json_encode($data);
     }
     public function printpdf(){
          $this->agenda->set('de',$_GET['de']);
         $this->agenda->set('hasta',$_GET['hasta']);
         $data=$this->agenda->imprimir();
         $this->pdf->loadPDF($this,'print','landscape',$data);
     }
}
 ?>
