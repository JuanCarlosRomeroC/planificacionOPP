<?php
class Planificacion extends Controllers{
     private $planificacion;
     function __construct(){
          parent::__construct();
          $this->planificacion=parent::loadClassmodels("PlanificacionModel");
     }
     public function index(){
         //$resultado=$this->usuario->listar();
         $this->view->render($this,"index","");
     }
     public function ver($id){
         $this->planificacion->set('id',$id);
         $data=$this->planificacion->ver();
         echo json_encode($data);
     }
     public function editar($id){
         $this->planificacion->set("id",$id);
         $this->planificacion->set("ci_original",$_POST['ci_original']);
         $this->planificacion->set("password_original",$_POST['password_original']);
         $this->planificacion->set("nombre",$_POST['nombre']);
         $this->planificacion->set("apellido",$_POST['apellido']);
         $this->planificacion->set("ci",$_POST['ci']);
         $this->planificacion->set("password",$_POST['password']);
         $this->planificacion->set("id_cargo",$_POST['id_cargo']);
         $this->planificacion->set("id_lugar",$_POST['id_lugar']);
         $this->planificacion->set("telefono",$_POST['telefono']);
         $this->planificacion->set("tipo",$_POST['tipo']);
         $resultado=$this->planificacion->editar();
         echo $resultado;
     }
     public function destroySession(){
          Session::destroy();
          header('Location: '.URL);
          exit();
     }
}
 ?>
