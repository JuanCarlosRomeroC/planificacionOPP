<?php
class Views{
     function render($controller,$view,$tipo_user,$foo,$resultado){
          $controllers =get_class($controller);
          require VIEWS.DFT.$foo.'head.php';
          require VIEWS.$tipo_user.'/'.$controllers.'/'.$view.'.php';
          require VIEWS.DFT.$foo.'footer.php';
     }
}
 ?>
