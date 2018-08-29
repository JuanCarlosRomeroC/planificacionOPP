<?php
class Otro extends Controllers{
     private $otro;
     function __construct(){
          parent::__construct();
          $this->otro=parent::loadClassmodels("OtroModel");
     }
     public function index(){
          $year=isset($_GET['year']) ? $_GET['year'] :date('Y');
          $month=isset($_GET['month']) ? $_GET['month'] :date('m');
          $this->otro->set('year',$year);
          $this->otro->set('month',$month);
         $resultado=$this->otro->listar();
         $this->view->render($this,"index",$resultado);
     }
     public function ver($id){
         $this->otro->set('id',$id);
         $data=$this->otro->ver();
         echo json_encode($data);
     }
     public function printpdf($id){
          $this->otro->set('year',substr($id, 0, -2));
          $this->otro->set('month',substr($id, -2));
          $data=$this->otro->imprimir();
          $this->pdf->loadPDF($this, $data);
     }
     public function crear(){
          $this->otro->set("id_establecimiento",$_POST['id_establecimiento']);
          $this->otro->set("tipo_actividad",$_POST['tipo_actividad']);
          $this->otro->set("tipo_lugar",$_POST['tipo_lugar']);
          $this->otro->set("ciudad",$_POST['ciudad']);
          $this->otro->set("id_otra_actividad",$_POST['id_otra_actividad']);
          $this->otro->set("lugar",$_POST['lugar']);
          $this->otro->set("fecha_de",$_POST['fecha_de']);
          $this->otro->set("fecha_hasta",$_POST['fecha_hasta']);
          $resultado=$this->otro->crear();
          echo $resultado;
     }
     public function editar($id){
          $this->otro->set("id",$id);
          $this->otro->set("id_establecimiento",$_POST['id_establecimiento']);
          $this->otro->set("tipo_actividad",$_POST['tipo_actividad']);
          $this->otro->set("tipo_lugar",$_POST['tipo_lugar']);
          $this->otro->set("ciudad",$_POST['ciudad']);
          $this->otro->set("id_otra_actividad",$_POST['id_otra_actividad']);
          $this->otro->set("lugar",$_POST['lugar']);
          $this->otro->set("fecha_de",$_POST['fecha_de']);
          $this->otro->set("fecha_hasta",$_POST['fecha_hasta']);
         $resultado=$this->otro->editar();
         echo $resultado;
     }
     public function destroySession(){
          Session::destroy();
          header('Location: '.URL);
          exit();
     }
}
 ?>
