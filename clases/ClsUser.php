<?php
require_once 'ClsConex.php';

class ClsUser extends ClsConex{
    public $id;
    public $correo;
    public $password;
    public $catalogo;
    public $rol;
    public $token;
    public $diploma;


    public function __construct($args = [])
    {   
        $this->id = $args['id'] ?: null;
        $this->correo = $args['correo'] ?: '';
        $this->password = $args['password'] ?: '';
        $this->catalogo = $args['catalogo'] ?: '';
        $this->rol = $args['rol'] ?: '';
        $this->token = $args['token'] ?: '';
        $this->diploma = $args['diploma'] ?: '';
    }

    public function registrar(){
        $sql = "INSERT INTO ciber_usuarios (usu_correo, usu_password, usu_catalogo ) values ('$this->correo', '$this->password', '$this->catalogo')";
        $resultado = $this->exec_sql($sql);
        return $resultado;
    }

    public function buscarRegistro(){
        $sql = "SELECT * from ciber_usuarios where usu_catalogo = $this->catalogo or usu_correo = '$this->correo' and usu_situacion = 1 ";
        $resultado = $this->exec_query($sql);
        return $resultado;
    }

    public function buscarUsuario(){
        $sql = "SELECT * from ciber_usuarios inner join mper on per_catalogo = usu_catalogo inner join grados on per_grado = gra_codigo inner join armas on per_arma = arm_codigo where usu_correo = '$this->correo' and usu_situacion = 1 ";
        $resultado = $this->exec_query($sql);
        return $resultado;
    }

    public function getAllUsers(){
        $sql = "SELECT * from ciber_usuarios inner join mper on per_catalogo = usu_catalogo inner join grados on per_grado = gra_codigo where usu_situacion = 1 ";
        $resultado = $this->exec_query($sql);
        return $resultado;
    }
    
    public function updateToken(){
        $sql = "UPDATE ciber_usuarios set usu_token = '$this->token' where usu_id = $this->id ";
        $resultado = $this->exec_sql($sql);
        return $resultado;
    }

    public function updateDiploma(){
        $sql = "UPDATE ciber_usuarios set usu_diploma = '$this->diploma', usu_fecha_diploma = current where usu_id = $this->id ";
        $resultado = $this->exec_sql($sql);
        return $resultado;
    }

    public function getUserToken(){
        $sql = "SELECT * from ciber_usuarios where usu_token = '$this->token' ";
        $resultado = $this->exec_query($sql);
        return $resultado;
    }

    public function getUserDiploma(){
        $sql = "SELECT * from ciber_usuarios inner join mper on usu_catalogo = per_catalogo inner join grados on per_grado = gra_codigo where usu_diploma = '$this->diploma' ";
        $resultado = $this->exec_query($sql);
        return $resultado;
    }

    public function updatePassword(){
        $sql = "UPDATE ciber_usuarios set usu_password = '$this->password' where usu_id = $this->id ";
        $resultado = $this->exec_sql($sql);
        return $resultado;
    }

    public function deleteToken(){
        $sql = "UPDATE ciber_usuarios set usu_token = null where usu_id = $this->id ";
        $resultado = $this->exec_sql($sql);
        return $resultado;
    }

    public function deleteDiploma(){
        $sql = "UPDATE ciber_usuarios set usu_diploma = null where usu_id = $this->id ";
        $resultado = $this->exec_sql($sql);
        return $resultado;
    }

    
    public function actualizarCorreo(){
        $sql = "UPDATE ciber_usuarios set usu_correo = '$this->correo' where usu_id = $this->id ";
        $resultado = $this->exec_sql($sql);
        return $resultado;
    }

    public function desactivarUsuario(){
        $sql = "UPDATE ciber_usuarios set usu_situacion = 0 where usu_id = $this->id ";
        $resultado = $this->exec_sql($sql);
        return $resultado;
    }
}
