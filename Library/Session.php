<?php
class Session{
     static function start(){
          @session_start();
     }
     static function getSession($name){
          if (isset($_SESSION[$name])) {
               return $_SESSION[$name];
          }else{
               return null;
          }
     }
     static function setSession($name,$data){
          $_SESSION[$name]=$data;
     }
     static function destroy(){
          @session_destroy();
     }
}


 ?>
