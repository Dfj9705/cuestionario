<?php
require_once 'ClsConex.php';

class ClsUser extends ClsConex{
    public $id;
    public $correo;
    public $password;
    public $catalogo;
    public $rol;


    public function __construct($args = [])
    {   
        $this->id = $args['id'] ?: null;
        $this->correo = $args['correo'] ?: '';
        $this->password = $args['password'] ?: '';
        $this->catalogo = $args['catalogo'] ?: '';
        $this->rol = $args['rol'] ?: '';
    }

    public function registrar(){
        $sql = "INSERT INTO ciber_usuarios (usu_correo, usu_password, usu_catalogo ) values ('$this->correo', '$this->password', '$this->catalogo')";
        $resultado = $this->exec_sql($sql);
        return $resultado;
    }

    public function buscarRegistro(){
        $sql = "SELECT * from ciber_usuarios where usu_catalogo = $this->catalogo or usu_correo = '$this->correo' ";
        $resultado = $this->exec_query($sql);
        return $resultado;
    }

    public function buscarUsuario(){
        $sql = "SELECT * from ciber_usuarios inner join mper on per_catalogo = usu_catalogo inner join grados on per_grado = gra_codigo where usu_correo = '$this->correo' ";
        $resultado = $this->exec_query($sql);
        return $resultado;
    }

    

}
