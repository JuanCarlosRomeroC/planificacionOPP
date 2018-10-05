<?php
class Configuracion extends Controllers{
     private $configuracion;
     function __construct(){
          parent::__construct();
          $this->configuracion=parent::loadClassmodels("ConfiguracionModel");
     }
     public function otro(){
         $resultado=$this->configuracion->listar_otro();
         $this->view->render($this,"otro",$resultado);
     }
     public function auditorio(){
         $resultado=$this->configuracion->listar_auditorio();
         $this->view->render($this,"auditorio",$resultado);
     }
     public function director(){
         $resultado=$this->configuracion->listar_director();
         $this->view->render($this,"director",$resultado);
     }
     public function cargo(){
         $resultado=$this->configuracion->listar_cargo();
         $this->view->render($this,"cargo",$resultado);
     }
     public function crear_cargo(){
          $this->configuracion->set("nombre",$_POST['nombre']);
          $resultado=$this->configuracion->crear_cargo();
     }
     public function crear_otro(){
          $this->configuracion->set("nombre",$_POST['nombre']);
          $resultado=$this->configuracion->crear_otro();
     }
     public function editar_cargo($id){
          $this->configuracion->set("id",$id);
          $this->configuracion->set("nombre",$_POST['nombre']);
          $resultado=$this->configuracion->editar_cargo();
     }
     public function editar_otro($id){
          $this->configuracion->set("id",$id);
          $this->configuracion->set("nombre",$_POST['nombre']);
          $resultado=$this->configuracion->editar_otro();
     }
     public function baja_otro($id){
          $this->configuracion->set('id',$id);
          $resultado=$this->configuracion->baja_otro();
     }
     public function baja_cargo($id){
          $this->configuracion->set('id',$id);
          $resultado=$this->configuracion->baja_cargo();
     }
     public function baja_usuario_auditorio($id){
          $this->configuracion->set('id',$id);
          $resultado=$this->configuracion->baja_usuario_auditorio();
     }
     public function alta_usuario_auditorio($id){
          $this->configuracion->set('id',$id);
          $resultado=$this->configuracion->alta_usuario_auditorio();
     }
     public function baja_usuario_director($id){
          $this->configuracion->set('id',$id);
          $resultado=$this->configuracion->baja_usuario_director();
     }
     public function alta_usuario_director($id){
          $this->configuracion->set('id',$id);
          $resultado=$this->configuracion->alta_usuario_director();
     }
     public function alta_otro($id){
         $this->configuracion->set('id',$id);
         $this->configuracion->alta_otro();
     }
     public function alta_cargo($id){
         $this->configuracion->set('id',$id);
         $this->configuracion->alta_cargo();
     }
}
 ?>
