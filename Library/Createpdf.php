<?php
class Createpdf{
     public $users= array('Administrador','Director','Planificador','Jefatura','Unidad','Usuario');
     function loadPDF($controller,$resultado){
          $tipo_user="";
          $session=Session::getSession('User');
          if ($session!=null) {
               $tipo_user=$this->users[$session['tipo']];
          }
          $controllers =get_class($controller);
          require VIEWS.$tipo_user.'/'.$controllers.'/print.php';
          require_once '/../dompdf/dompdf_config.inc.php';
          $dompdf = new DOMPDF();

          $dompdf->load_html(ob_get_clean());
          $dompdf->set_paper('letter', 'landscape');
          $dompdf->render();
          $dompdf->stream($controllers.'.pdf',array('Attachment'=>0));
     }
}
?>
