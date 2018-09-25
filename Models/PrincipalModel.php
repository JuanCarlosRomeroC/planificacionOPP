<?php
     class PrincipalModel extends Conexion{
          public $user_id;
          public $user_lugar;
          public $session;
          function __construct(){
               parent::__construct();
               $this->session=Session::getSession('User');
               if (isset($this->session)){
                    $this->user_id=$this->session['id'];
                    $this->user_lugar=$this->session['id_lugar'];
               }
          }
          public function set($atributo,$contenido){
               $this->$atributo=$contenido;
          }
          public function get($atributo){
               return $this->$atributo;
          }
          public function listar(){
               $year=date('Y');$month=date('m');
               $profile=parent::consultaRetorno("SELECT u.*,c.nombre as cargo FROM usuario as u JOIN cargo as c ON c.id=u.id_cargo WHERE u.id='{$this->user_id}' LIMIT 1");
               $poai=parent::consultaRetorno("SELECT COUNT(*) as total FROM planificacion_anual WHERE  id_usuario='{$this->user_id}' AND year='{$year}'");
               $planificacion=parent::consultaRetorno("SELECT COUNT(*) as total FROM planificacion WHERE id_usuario='{$this->user_id}' AND MONTH(fecha_de)='{$month}' ");
               $otraplanificacion=parent::consultaRetorno("SELECT COUNT(*) as total FROM otra_planificacion WHERE id_usuario='{$this->user_id}' AND MONTH(fecha_de)='{$month}' ");
               $notificacion=parent::consultaRetorno("SELECT COUNT(*) as total FROM otra_planificacion WHERE  id_usuario='{$this->user_id}' AND modificado=1 AND visto=0");
               $cargos="SELECT * FROM cargo WHERE estado=b'1' ";
               $result=["profile"=> mysql_fetch_assoc($profile),
                         "poai"=> mysql_fetch_assoc($poai),
                         "planificacion"=> mysql_fetch_assoc($planificacion),
                         "otraplanificacion"=> mysql_fetch_assoc($otraplanificacion),
                         "notificacion"=> mysql_fetch_assoc($notificacion),
                         "cargos"=>parent::consultaRetorno($cargos)
               ];
               return $result;
          }
          public function editar_profile(){
               $_SESSION["User"]['nombre']=$this->nombre;$_SESSION["User"]['apellido']=$this->apellido;
               $sql=("UPDATE usuario SET nombre='{$this->nombre}',apellido='{$this->apellido}',id_cargo='{$this->id_cargo}',telefono='{$this->telefono}' WHERE id='{$this->user_id}' ");
               parent::consultaSimple($sql);
               if($this->password != ""){
                    $sql=("UPDATE usuario SET password='{$password_insert}' WHERE id='{$this->user_id}'");
                    parent::consultaSimple($sql);
               }
               if($this->ci!=""){
                    $ver_ci=$this->ver_ci();
                    if($ver_ci != 0){
                         return "false";
                    }else{
                         $sql=("UPDATE usuario SET ci='{$this->ci}' WHERE id='{$this->user_id}'");
                         parent::consultaSimple($sql);
                    }
               }
               return "Perfil modificado Satisfactoriamente";
          }
          public function ver_ci(){
               $sql="SELECT * FROM usuario WHERE ci='{$this->ci}'";
               $resultado=parent::consultaRetorno($sql);
               return mysql_num_rows($resultado);
          }

     }
 ?>
