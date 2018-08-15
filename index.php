<?php
     require "config.php";
     require LBS."/autoload.php";
     require LBS."/Router.php";
     $router=new Router();
     $controller=$router->getController();
     $method=$router->getMethod();
     $params=$router->getParam();
     $tipo=$router->getSession();
     // echo '<pre>';
     // print_r($router->getUri());
     // echo '</pre>';
     // echo '<pre>';
     // echo "controlador: {$controller} <br>";
     // echo '</pre>';

     $controllersPath='Controllers/'.$tipo.$controller.'.php';
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
          // header("Location: ".URL.'Principal');
          // exit();
          require 'Controllers/Index.php';
          $controller=new Index();
          $controller->index();
     }
 ?>
