<?php
     require "config.php";
     $url= isset($_GET['url']) ?$_GET['url']:"Index/index";
     $url = explode("/", $url);

     $controller="Index";
     $method="index";
     if (isset($url[0])) {
          $controller=$url[0];
     }
     if (isset($url[1])) {
          if ($url[1]!='') {
               $method=$url[1];
          }
     }
     if (isset($url[2])) {
          if ($url[2]!='') {
               $params=$url[2];
          }
     }
     spl_autoload_register( function($class){
          if (file_exists(LBS.$class.".php")) {
               require LBS.$class.".php";
          }
     });
     $controllersPath='Controllers/'.$controller.'.php';
     if (file_exists($controllersPath)) {
          require $controllersPath;
          $controller=new $controller();
          if (isset($method)) {
               if (method_exists($controller, $method)) {
                    if (isset($params)) {
                         $controller->{$method}($params);
                    }else{
                         $controller->{$method}();
                    }
               }else{
                    $controller->index();
               }
          }else{
               $controller->index();
          }
     }else {
          require 'Controllers/Index.php';
          $controller=new Index();
          $controller->index();
     }
 ?>
