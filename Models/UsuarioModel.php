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
               $auth="SELECT id,ci,nombre,apellido,id_cargo FROM usuario
                    WHERE ci = '{$this->ci}' and password='{$this->password}' and estado=b'1'";
               $result= parent::consultaRetorno($auth);
               return mysql_fetch_array($result);

          }
          public function listar(){
               $user="SELECT p.id,p.ci,p.nombre,p.apellido,u.nombre as unidad,j.nombre as jefatura,c.nombre as cargo FROM usuario as p
                    JOIN cargo as c ON c.id = p.id_cargo
                    JOIN unidad as u ON u.id = p.id_unidad
                    JOIN jefatura as j ON j.id = u.id_jefatura
                    WHERE p.estado = b'1'";
               $unidad="SELECT u.id,u.nombre,j.nombre as jefatura FROM unidad as u
                    JOIN jefatura as j ON j.id = u.id_jefatura
                    WHERE u.estado=b'1'";
               $cargo="SELECT * FROM cargo WHERE estado=b'1'";
               $result=["usuarios"=> parent::consultaRetorno($user),
                         "unidades"=> parent::consultaRetorno($unidad),
                         "cargos"=> parent::consultaRetorno($cargo)
               ];
               return $result;
          }
          public function ver(){
               $sql="SELECT * FROM usuario WHERE id = '{$this->id}' LIMIT 1";
               $resultado = parent::consultaRetorno($sql);
               $row=mysql_fetch_array($resultado);
               $this->id=$row['id'];
               $this->ci=$row['ci'];
               $this->nombre=$row['nombre'];
               $this->apellido=$row['apellido'];
               $this->unidad=$row['id_unidad'];
               $this->cargo=$row['id_cargo'];
               $this->telefono=$row['telefono'];
               return $row;
          }
          public function crear(){
               $ver_ci=ver_ci();
               if($ver_ci != 0){
                    return "false";
               }else{
                    $sql=("INSERT INTO usuario(ci, nombre, apellido, id_cargo,telefono,id_unidad,password) VALUES(
                         '{$this->ci}','{$this->nombre}','{$this->apellido}','{$this->id_cargo}','{$this->telefono}','{$this->id_unidad}','{$this->password}')");
                    parent::consultaSimple($sql);
                    return "El Usuario se Registro Satisfactoriamente";
               }
          }
          public function editar(){
               if($this->ci==""){
                    if($this->password==""){
                         $sql=("UPDATE usuario SET
                              ci='{$this->status}',
                              nombre='{$this->nombre}',
                              apellido='{$this->apellido}',
                              id_unidad='{$this->id_unidad}',
                              id_cargo='{$this->id_cargo}',
                              telefono='{$this->telefono}',
                              password='{$this->status_p}' WHERE id='{$this->id}'");
                    }else{
                         $pass=password_hash($this->password, PASSWORD_BCRYPT);
                         $sql=("UPDATE usuario SET ci='{$this->status}',nombre='{$this->nombre}', apellido='{$this->apellido}',id_unidad='{$this->id_unidad}',id_cargo='{$this->id_cargo}',telefono='{$this->telefono}',password='{$pass}' WHERE id='{$this->id}'");
                    }
               }else{
                    $ver_ci=$this->ver_ci();
                    if($ver_ci != 0){
                         return "false";
                    }else{
                         echo "verdadero ci";
                         if($this->password==""){
                              $sql=("UPDATE usuario SET ci='{$this->ci}',nombre='{$this->nombre}', apellido='{$this->apellido}',id_unidad='{$this->id_unidad}',id_cargo='{$this->id_cargo}',telefono='{$this->telefono}',password='{$this->status_p}' WHERE id='{$this->id}'");
                         }else{
                              $pass=password_hash($this->password, PASSWORD_BCRYPT);
                              $sql=("UPDATE usuario SET ci='{$this->ci}',nombre='{$this->nombre}', apellido='{$this->apellido}',id_unidad='{$this->id_unidad}',id_cargo='{$this->id_cargo}',telefono='{$this->telefono}',password='{$pass}' WHERE id='{$this->id}'");
                         }
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
          public function ver_ci(){
               $sql2="SELECT * FROM usuario WHERE ci='{$this->ci}'";
               $resultado=parent::consultaRetorno($sql2);
               return mysql_num_rows($resultado);
          }
     }
 ?>
