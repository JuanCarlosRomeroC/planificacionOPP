<?php
class Views{
     public $users= array('Administrador','Director','Planificador','Jefatura','Unidad','Usuario');
     public $headers= array('adm_','dir_','pla_','jef_','uni_','usu_');
     function render($controller,$view,$resultado){ //Controlador,Vista,tipo_usuario,header_footer(adm_), data
          $tipo_user="";$head="";
          $session=Session::getSession('User');
          if ($session!=null) {
               $tipo_user=$this->users[$session['tipo']];
               $head=$this->headers[$session['tipo']];
          }
          $controllers =get_class($controller);
          $foo= $controllers==='Index' ? '' : "all_";
          require VIEWS.DFT.$head.'head.php';
          require VIEWS.$tipo_user.'/'.$controllers.'/'.$view.'.php';
          require VIEWS.DFT.$foo.'footer.php';
     }
}
 ?>
