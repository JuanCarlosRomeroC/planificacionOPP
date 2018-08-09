<?php
     class UsuarioModel extends Conexion{
          private $con;
          function __construct(){
               parent::__construct();
          }
          public function set($atributo,$contenido){
               $this->$atributo=$contenido;
          }
          public function get($atributo){
               return $this->$atributo;
          }
          public function login(){
              //$sql="SELECT *FROM usuario WHERE estado = 1" ;
               $auth="SELECT id,ci,nombre,apellido,id_cargo,password FROM usuario
                    WHERE ci = '{$this->ci}' and estado=b'1'";
               $result= parent::consultaRetorno($auth);
               if(mysql_num_rows($result)==1){
                    $rows= mysql_fetch_assoc($result);
                    if (password_verify($this->password, $rows['password'])){
                         return $rows;
                    }else{
                         return "false";
                    }
               }else{
                    return "false";
               }
          }
          public function listar(){
               $user="SELECT p.id,p.ci,p.nombre,p.apellido,p.tipo,c.nombre as cargo FROM usuario as p
                    JOIN cargo as c ON c.id = p.id_cargo WHERE p.estado = b'1'";
               $administracion="SELECT p.id,p.ci,p.nombre,p.apellido,p.tipo,c.nombre as cargo FROM usuario as p
                    JOIN cargo as c ON c.id = p.id_cargo WHERE p.estado = b'1' AND p.tipo=0 OR p.tipo=1 OR p.tipo=2 ";
               $user_jefatura="SELECT p.id,p.ci,p.nombre,p.apellido,p.tipo,j.nombre as jefatura,c.nombre as cargo FROM usuario as p
                    JOIN cargo as c ON c.id = p.id_cargo JOIN jefatura as j ON j.id = p.id_lugar WHERE p.estado = b'1' AND p.tipo=3 AND id_lugar<>0";
               $userunidad="SELECT p.id,p.ci,p.nombre,p.apellido,p.tipo,u.nombre as unidad,c.nombre as cargo FROM usuario as p
                    JOIN cargo as c ON c.id = p.id_cargo JOIN unidad as u ON u.id = p.id_lugar WHERE p.estado = b'1' AND p.tipo<>3";
               $asignar="SELECT p.id,p.ci,p.nombre,p.apellido,p.tipo,c.nombre as cargo FROM usuario as p
                    JOIN cargo as c ON c.id = p.id_cargo WHERE p.estado = b'1' AND p.tipo=5 AND p.id_lugar=0";
               $bajas="SELECT p.*,c.nombre as cargo FROM usuario as p
                    JOIN cargo as c ON c.id = p.id_cargo WHERE p.estado = b'0'";
               $unidad="SELECT * FROM unidad WHERE estado=b'1'";
               $jefatura="SELECT * FROM jefatura WHERE estado=b'1'";
               $cargo="SELECT * FROM cargo WHERE estado=b'1'";
               $result=["usuarios"=> parent::consultaRetorno($user),
                         "administracion"=> parent::consultaRetorno($administracion),
                         "userjefatura"=> parent::consultaRetorno($user_jefatura),
                         "userunidad"=> parent::consultaRetorno($userunidad),
                         "sinasignar"=> parent::consultaRetorno($asignar),
                         "bajas"=> parent::consultaRetorno($bajas),
                         "unidades"=> parent::consultaRetorno($unidad),
                         "jefaturas"=> parent::consultaRetorno($jefatura),
                         "cargos"=> parent::consultaRetorno($cargo)
               ];
               return $result;
          }
          public function ver(){
               $sql="SELECT tipo FROM usuario WHERE id = '{$this->id}' LIMIT 1";
               $tipouser=mysql_fetch_assoc(parent::consultaRetorno($sql));
               if($tipouser['tipo']==3){
                    $sql="SELECT u.*,j.nombre as jefatura,c.nombre as cargo,null as unidad FROM usuario as u
                         JOIN cargo as c ON c.id = u.id_cargo
                         JOIN jefatura as j ON u.id_lugar = j.id
                         WHERE u.id = '{$this->id}' LIMIT 1";
               }else{
                    $sql="SELECT u.*,n.nombre as unidad,j.nombre as jefatura,c.nombre as cargo FROM usuario as u
                         JOIN cargo as c ON c.id = u.id_cargo
                         LEFT JOIN unidad as n ON u.id_lugar = n.id
                         LEFT JOIN jefatura as j ON n.id_jefatura =j.id
                         WHERE u.id = '{$this->id}' LIMIT 1";
               }
               return mysql_fetch_assoc(parent::consultaRetorno($sql));
          }
          public function crear(){
               $ver_ci=$this->ver_ci();
               if($ver_ci != 0){
                    return "false";
               }else{
                    $sql=("INSERT INTO usuario(ci, nombre, apellido, id_cargo,telefono,id_lugar,password,tipo) VALUES(
                         '{$this->ci}','{$this->nombre}','{$this->apellido}','{$this->id_cargo}','{$this->telefono}','{$this->id_lugar}','{$this->password}','{$this->tipo}')");
                    parent::consultaSimple($sql);
                    return "El Usuario se Registro Satisfactoriamente";
               }
          }
          public function editar(){
               if($this->password == ""){$password_insert=$this->password_original;}else{$password_insert=password_hash($this->password, PASSWORD_BCRYPT);}
               if($this->ci_original==$this->ci){
                    $sql=("UPDATE usuario SET ci='{$this->ci_original}',nombre='{$this->nombre}',
                         apellido='{$this->apellido}',id_lugar='{$this->id_lugar}',
                         id_cargo='{$this->id_cargo}',telefono='{$this->telefono}',
                         password='{$password_insert}',tipo='{$this->tipo}' WHERE id='{$this->id}'");
               }else{
                    $ver_ci=$this->ver_ci();
                    if($ver_ci != 0){
                         return "false";
                    }else{
                         $sql=("UPDATE usuario SET ci='{$this->estado_ci}',nombre='{$this->nombre}', apellido='{$this->apellido}',id_lugar='{$this->id_lugar}',id_cargo='{$this->id_cargo}',telefono='{$this->telefono}',password='{$password_insert}',tipo='{$this->tipo}' WHERE id='{$this->id}'");
                    }
               }
               parent::consultaSimple($sql);
               return "El Usuario se Modifico Satisfactoriamente";
          }
          public function eliminar(){
               $sql="UPDATE usuario SET estado=b'0'
                    WHERE id='{$this->id}'";
               parent::consultaSimple($sql);
               return "Usuario dado de Baja Satisfactoriamente";
          }
          public function alta(){
               $sql="UPDATE usuario SET estado=b'1'
                    WHERE id='{$this->id}'";
               parent::consultaSimple($sql);
               return "Usuario dado de ALTA Satisfactoriamente";
          }
          public function ver_ci(){
               $sql="SELECT * FROM usuario WHERE ci='{$this->ci}'";
               $resultado=parent::consultaRetorno($sql);
               return mysql_num_rows($resultado);
          }
     }
 ?>
