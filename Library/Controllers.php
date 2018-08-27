<?php
     class Controllers{
          public $data;
          public function __construct(){
               $this->view=new Views();
               $this->pdf=new Createpdf();
          }
          public function loadClassmodels($model){
               $path='Models/'.$model.'.php';
               if(file_exists($path)){
                    require $path;
                    return new $model();
               }else{
                    echo 'no hay modelo';
               }
          }
     }
 ?>
