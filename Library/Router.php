<?php
class Router{
     public $uri;
     public $controller;
     public $method;
     public $param;
     private $session;
     public $users= array('Administrador','Director','Planificador','Jefatura','Unidad','Usuario');
     public $tipo;
     public function __construct(){
          Session::start();
          $this->setSession();
          $this->setUri();
          $this->setController();
          $this->setMethod();
          $this->setParam();
     }
     public function setSession(){
          $this->session=Session::getSession('User');
          if (isset($this->session)) {
               if ('/'.FOLDER.'/'==URI) {
                    header("Location: ".URL.'Principal');
                    $this->tipo=$this->users[$this->session['tipo']].'/';
               }else{
                    $this->tipo=$this->users[$this->session['tipo']].'/';
               }
          }else{
               $this->tipo="";
               if ('/'.FOLDER.'/'!=URI) {
                    if(URI!='/'.FOLDER.'/Index/userLogin'){
                         header("Location: ".URL);
                         exit();
                    }
               }
          }
     }
     public function setUri(){
          $this->uri = explode('/', URI);
     }
     public function setController(){
          $this->controller = $this->uri[2] === '' ? 'Index' : $this->uri[2];
     }
     public function setMethod(){
          $this->method = ! empty($this->uri[3]) ? $this->uri[3] : 'index';
     }
     public function setParam(){
          $this->param = ! empty($this->uri[4]) ? $this->uri[4] : '';
     }
     public function getSession(){
          return $this->tipo;
     }
     public function getUri(){
          return $this->uri;
     }
     public function getController(){
          $aux=explode('?', $this->controller)==null ? [] : explode('?', $this->controller);
          $this->controller= $aux==[] ?  $this->controller : $aux[0] ;
          return $this->controller;
     }
     public function getMethod(){
          $aux=explode('?', $this->method)==null ? [] : explode('?', $this->method);
          $this->method= $aux==[] ?  $this->method : $aux[0] ;
          return $this->method;
     }
     public function getParam(){
          $aux=explode('?', $this->param)==null ? [] : explode('?', $this->param);
          $this->param= $aux==[] ?  $this->param : $aux[0] ;
          return $this->param;
     }
}
