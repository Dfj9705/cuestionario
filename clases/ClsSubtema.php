<?php
require_once 'ClsConex.php';

class ClsSubtemas extends ClsConex{

    public $id;
    public $tema;
    public $nombre;

    public function __construct($args = [])
    {   
        $this->id = $args['id'] ?: null;
        $this->tema = $args['tema'] ?: '';
        $this->nombre = $args['nombre'] ?: '';
    }

    public function guardarSubtema(){
        $sql = "INSERT INTO ciber_subtemas (subtema_tema, subtema_nombre) values ('$this->tema', '$this->nombre' )";
        $resultado = $this->exec_sql($sql);
        return $resultado;
    }

    public function getSubTemas(){
        $sql = "SELECT subtema_nombre as nombre, tema_nombre as tema, subtema_id as id, tema_id as id_tema from ciber_subtemas inner join   ciber_temas on subtema_tema =tema_id where subtema_situacion = 1
        ";
        $resultado = $this->exec_query($sql);
        return $resultado;
    }

    public function modificarSubtema(){
        $sql = "UPDATE ciber_subtemas set 
        subtema_tema = $this->tema,
        subtema_nombre = '$this->nombre'
        where subtema_id = $this->id;
        ";

        $resultado = $this->exec_sql($sql);
        return $resultado;
    }

    public function eliminar() {
        $sql = "UPDATE ciber_subtemas set 
                subtema_situacion = 0    
                where subtema_id = $this->id;
                ";

        $resultado = $this->exec_sql($sql);
        return $resultado;
    }
    


    
    
}