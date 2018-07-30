<?php
     class Controllers{
          public $data;
          public function __construct(){
               Session::start();
               $this->view=new Views();
               //$this->loadClassmodels();
          }
          function loadClassmodels(){
               $model = ucwords(strtolower(get_class($this))).'Model';
               $path='Models/'.$model.'.php';
               if(file_exists($path)){
                    require $path;
                    $this->model = new $model();
                    $this->data=$this->model;
               }else{
                    echo 'no hay modelo';
               }
          }
     }
 ?>
