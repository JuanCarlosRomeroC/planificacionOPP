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
             //$sql="SELECT *FROM usuario WHERE estado = 1" ;
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
               $sql2="SELECT * FROM usuario WHERE ci='{$this->ci}'";
               $resultado=$this->con->consultaRetorno($sql2);
               $num=mysql_num_rows($resultado);
               if($num != 0){
                    return false;
               }else{
                    $sql=("INSERT INTO usuario(ci, nombre, apellido, jefatura,unidad,cargo,estado,direccion,telefono,clave) VALUES(
                         '{$this->ci}','{$this->nombre}','{$this->apellido}','{$this->jefatura}','{$this->unidad}',
                         '{$this->cargo}','{$this->estado}','{$this->direccion}','{$this->telefono}','{$this->clave}'
                    )");
                    $this->con->consultaSimple($sql);
                    return true;
               }
          }
          public function editar(){
               $sql=("UPDATE usuario SET nombre='{$this->nombre}', apellido='{$this->apellido}', jefatura='{$this->jefatura}',
                    unidad='{$this->unidad}',cargo='{$this->cargo}',estado='{$this->estado}',
                    direccion='{$this->direccion}',telefono='{$this->telefono}',clave='{$this->clave}'");
          }
          public function eliminar(){
               $sql="DELETE FROM usuario WHERE id='{$this->id}'";
               $this->con->consultaSimple($sql);
          }
     }
 ?>
