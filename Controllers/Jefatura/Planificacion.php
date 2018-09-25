<?php
class Planificacion extends Controllers{
     private $planificacion;
     function __construct(){
          parent::__construct();
          $this->planificacion=parent::loadClassmodels("PlanificacionModel");
     }
//__________ACCIONES PARA MI
     public function index(){ //lista mis planificaciones
          $year=isset($_GET['year']) ? $_GET['year'] :date('Y');
          $month=isset($_GET['month']) ? $_GET['month'] :date('m');
          $this->planificacion->set('year',$year);
          $this->planificacion->set('month',$month);
          $resultado=$this->planificacion->listar();
          $this->view->render($this,"index",$resultado);
     }
     public function ver($id){ //ver una planificacion
          $this->planificacion->set('id',$id);
          $data=$this->planificacion->ver();
         echo json_encode($data);
     }
     public function crear(){ // crea mi planificacion
          $this->planificacion->set("id_actividad",$_POST['id_actividad']);
          $this->planificacion->set("fecha_de",$_POST['fecha_de']);
          $this->planificacion->set("fecha_hasta",$_POST['fecha_hasta']);
          $this->planificacion->set("objetivo",$_POST['objetivo']);
          $this->planificacion->set("esperado",$_POST['esperado']);
          $resultado=$this->planificacion->crear();
          echo $resultado;
     }
     public function editar($id){ //edita mi planificacion
          $this->planificacion->set("id",$id);
          $this->planificacion->set("id_actividad",$_POST['id_actividad']);
          $this->planificacion->set("fecha_de",$_POST['fecha_de']);
          $this->planificacion->set("fecha_hasta",$_POST['fecha_hasta']);
          $this->planificacion->set("objetivo",$_POST['objetivo']);
          $this->planificacion->set("esperado",$_POST['esperado']);
          $resultado=$this->planificacion->editar();
          echo $resultado;
     }
     public function validar($id){ //valida mi planificacion mensual
          $this->planificacion->set('id',$id);
          $this->planificacion->set("month",$_GET['month']);
          $this->planificacion->set("year",$_GET['year']);
          $data=$this->planificacion->validar();
          echo json_encode($data);
     }
     public function completarinforme($id){//completa mi informe
          $this->planificacion->set("id",$id);
          $this->planificacion->set("observacion",$_POST['observacion']);
          $this->planificacion->set("vista_unidad",1);
          $this->planificacion->set("vista_jefatura",1);
          $this->planificacion->set("vista_planificador",0);
          $resultado=$this->planificacion->completarinforme();
          echo $resultado;
     }
     public function print_mi_planificacion($id){//imprime mi planificacion
          $this->planificacion->set('year',substr($id, 0, -2));
          $this->planificacion->set('month',substr($id, -2));
          $data=$this->planificacion->imprimir();
          $this->pdf->loadPDF($this,'print_planificacion','landscape',$data);
     }
     public function print_mi_informe($id){ //imprime mi informe
          $this->planificacion->set('year',substr($id, 0, -2));
          $this->planificacion->set('month',substr($id, -2));
          $data=$this->planificacion->imprimir();
          $this->pdf->loadPDF($this,'print_informe','landscape',$data);
     }

//__________ACCIONES PARA USUARIO___________
     public function listar_unusuario($id){ //lista de planificacion de 1 usuario
          $this->planificacion->set('id',base64_decode($id));
          $this->planificacion->set('year',isset($_GET['year']) ? $_GET['year'] :date('Y'));
          $this->planificacion->set('month',isset($_GET['month']) ? $_GET['month'] :date('m'));
          $data=$this->planificacion->listar_unusuario();
          $this->view->render($this,"ver",$data);
     }
     public function validar_j($id){  //valida planificacion de usuario
          $this->planificacion->set('id',base64_decode($id));
          $data=$this->planificacion->validar_jefatura();
     }
     public function print_un_informe($id){ //imprime informe de 1 usuario
          $this->planificacion->set('id',base64_decode($id));
          $this->planificacion->set('year',substr($_GET['date'], 0, -2));
          $this->planificacion->set('month',substr($_GET['date'], -2));
          $data=$this->planificacion->imprimir_unusuario();
          $this->pdf->loadPDF($this,'print_informe','landscape',$data);
     }
}
 ?>
