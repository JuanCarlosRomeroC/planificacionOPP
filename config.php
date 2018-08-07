<?php
     $url_p = explode("/", $_SERVER['REQUEST_URI']); // /nombreproyecto
     $URL_Raiz="http://".$_SERVER['SERVER_NAME']."/".$url_p[1]."/"; //http://localhost/nombreproyecto/
     const LBS = "Library/";
     const VIEWS = 'Views/';
     const MODELS = 'Models/';
     const DFT = 'default/';
     define('RQ','Resources');
     define('FOLDER',$url_p[1]); //  nombreproyecto
     define('URL',$URL_Raiz); // URL = variable global para direccionar archivos
 ?>
