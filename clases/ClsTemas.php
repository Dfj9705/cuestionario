<?php
require_once 'ClsConex.php';

class ClsTemas extends ClsConex{

    public $id;
    public $nombre;

    public function __construct($args = [])
    {   
        $this->id = $args['id'] ?: null;
        $this->nombre = $args['nombre'] ?: '';
    }

    public function guardarTema(){
        $sql = "INSERT INTO ciber_temas (tema_nombre) values ('$this->nombre')";
        $resultado = $this->exec_sql($sql);
        return $resultado;
    }

    public function getTemas(){
        $sql = "SELECT tema_nombre as nombre, tema_id as id from ciber_temas where tema_situacion = 1";
        $resultado = $this->exec_query($sql);
        return $resultado;
    }

    public function modificarTema(){
        $sql = "UPDATE ciber_temas set 
                tema_nombre = '$this->nombre'
                where tema_id = $this->id;
                ";

        $resultado = $this->exec_sql($sql);
        return $resultado;
    }

    public function eliminar() {
        $sql = "UPDATE ciber_temas set 
                tema_situacion = 0    
                where tema_id = $this->id;
                ";

        $resultado = $this->exec_sql($sql);
        return $resultado;
    }
    
}