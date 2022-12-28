<?php
require_once 'ClsConex.php';

class ClsPreguntas extends ClsConex{

    public $id;
    public $subtema;
    public $pregunta;

    public function __construct($args = [])
    {   
        $this->id = $args['id'] ?: null;
        $this->subtema = $args['subtema'] ?: '';
        $this->pregunta = $args['pregunta'] ?: '';
    }

    public function guardarPregunta(){
        $sql = "INSERT INTO ciber_preguntas (pregunta_subtema, pregunta_descripcion) values ('$this->subtema', '$this->pregunta' )";
        $resultado = $this->exec_sql($sql);
        return $resultado;
    }




    public function modificarPregunta(){
        $sql = "UPDATE ciber_preguntas set 
        pregunta_subtema = $this->subtema,
        pregunta_descripcion = '$this->pregunta'
        where pregunta_id = $this->id;
        ";

        $resultado = $this->exec_sql($sql);
        return $resultado;
    }

    public function eliminar() {
        $sql = "UPDATE ciber_preguntas set 
                pregunta_situacion = 0    
                where pregunta_id = $this->id;
                ";

        $resultado = $this->exec_sql($sql);
        return $resultado;
    }

    public function getPreguntas(){
        $sql =" SELECT pregunta_descripcion as descripcion, subtema_nombre as subtema, pregunta_id as id from ciber_preguntas inner join   ciber_subtemas on pregunta_subtema =subtema_id 
                where pregunta_situacion = 1";
        $resultado = $this->exec_query($sql);
        return $resultado;

    }
    


    
    
}