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
     public function validar($id){
         $this->planificacion->set('id',$id);
         $this->planificacion->set("month",$_GET['month']);
         $this->planificacion->set("year",$_GET['year']);
         $data=$this->planificacion->validar();
         echo json_encode($data);
     }
     public function completarinforme($id){
          $this->planificacion->set("id",$id);
          $this->planificacion->set("terminado",$_POST['terminado']);
          $this->planificacion->set("observacion",$_POST['observacion']);
          $this->planificacion->set("vista_unidad",0);
          $this->planificacion->set("vista_jefatura",0);
          $this->planificacion->set("vista_planificador",0);
          $resultado=$this->planificacion->completarinforme();
          echo $resultado;
     }
     public function print_planificacion($id){
          $this->planificacion->set('year',substr($id, 0, -2));
          $this->planificacion->set('month',substr($id, -2));
          $data=$this->planificacion->imprimir();
          $this->pdf->loadPDF($this,'print_planificacion','landscape',$data);
     }
     public function print_informe($id){
          $this->planificacion->set('year',substr($id, 0, -2));
          $this->planificacion->set('month',substr($id, -2));
          $data=$this->planificacion->imprimir();
          $this->pdf->loadPDF($this,'print_informe','landscape',$data);
     }
     public function eliminar($id){
        $this->planificacion->set("id",$id);
         $data=$this->planificacion->eliminar();
     }
}
?>
