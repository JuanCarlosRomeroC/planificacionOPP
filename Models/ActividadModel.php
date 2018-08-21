<?php
     class ActividadModel extends Conexion{
          function __construct(){
               parent::__construct();
          }
          public function set($atributo,$contenido){
               $this->$atributo=$contenido;
          }
          public function get($atributo){
               return $this->$atributo;
          }
          public function listar(){
               $actividad="SELECT a.*,j.nombre as jefatura,u.nombre as unidad FROM actividad as a LEFT JOIN jefatura as j ON j.id = a.id_jefatura LEFT JOIN unidad as u ON u.id = a.id_unidad";
               $sinasignar="SELECT * FROM actividad WHERE id_jefatura=0 AND estado='1'";
               $baja="SELECT * FROM actividad WHERE estado='0' ";
               $jefatura="SELECT * FROM jefatura WHERE estado='1'";
               $unidad="SELECT * FROM unidad WHERE estado='1'";
               $result=["actividades"=>parent::consultaRetorno($actividad),
                         "sinasignar"=>parent::consultaRetorno($sinasignar),
                         "bajas"=>parent::consultaRetorno($baja),
                         "jefaturas"=>parent::consultaRetorno($jefatura)
               ];
               return $result;
          }
          public function ver(){
               $year=date("Y");
               $actividad="SELECT a.*,j.nombre as jefatura,u.nombre as unidad FROM actividad as a
               LEFT JOIN jefatura as j ON j.id = a.id_jefatura LEFT JOIN unidad as u ON a.id_unidad = u.id WHERE a.id = '{$this->id}' LIMIT 1" ;
               $estado="SELECT * FROM planificacion_anual WHERE id_actividad = '{$this->id}' AND year='{$year}'";
               $result=mysql_fetch_assoc(parent::consultaRetorno($actividad));
               $result["planificacion_anual"]=mysql_num_rows(parent::consultaRetorno($estado));
               return $result;
          }
          public function crear(){
               $ver_nombre=$this->ver_nombre();
               if($ver_nombre != 0){
                    return "false";
               }else{
                    $sql=("INSERT INTO actividad (nombre,id_jefatura,fecha_created) VALUES ('{$this->nombre}','{$this->id_jefatura}',NOW())");
                    parent::consultaSimple($sql);
                    return "La Actividad se Registro Satisfactoriamente";
               }
          }
          public function editar(){
               if($this->nombre==""){
                    $sql=("UPDATE actividad SET id_jefatura='{$this->id_jefatura}',fecha_updated=NOW() WHERE id='{$this->id}'");
               }else{
                    $ver_nombre=$this->ver_nombre();
                    if($ver_nombre != 0){
                         return "false";
                    }else{
                         $sql=("UPDATE actividad SET nombre='{$this->nombre}',id_jefatura='{$this->id_jefatura}',fecha_updated=NOW() WHERE id='{$this->id}'");
                    }
               }
               parent::consultaSimple($sql);
               return "La Actividad se Modifico Satisfactoriamente";
          }
          public function eliminar(){
               $sql="UPDATE actividad SET estado='0'
                    WHERE id='{$this->id}'";
               parent::consultaSimple($sql);
               return "Actividad dada de Baja Satisfactoriamente";
          }
          public function ver_nombre(){
               $sql2="SELECT * FROM actividad WHERE nombre='{$this->nombre}'";
               $resultado=parent::consultaRetorno($sql2);
               return mysql_num_rows($resultado);
          }
     }
 ?>
