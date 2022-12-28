<?php
require_once 'ClsConex.php';

class ClsRespuestas extends ClsConex{

    public $id;
    public $pregunta;
    public $respuesta;
    public $correcta;

    public function __construct($args = [])
    {   
        $this->id = $args['id'] ?: null;
        $this->pregunta = $args['pregunta'] ?: '';
        $this->respuesta = $args['respuesta'] ?: '';
        $this->correcta = $args['correcta'] ?: '';
    }

    
    public function guardarRespuetas(){
        $sql = "INSERT INTO ciber_respuestas (respuesta_pregunta, respuesta_descripcion, respuesta_correcta) values ($this->pregunta,'$this->respuesta',$this->correcta)";
        $resultado = $this->exec_sql($sql);
        return $resultado;
    }

    public function getRespuestas(){
        $sql ="SELECT pregunta_descripcion as pregunta, respuesta_Descripcion as respuesta, respuesta_correcta  as correcta, respuesta_id as id, respuesta_pregunta from ciber_respuestas inner join   ciber_preguntas on respuesta_pregunta =pregunta_id 
                where respuesta_situacion = 1";
          $resultado = $this->exec_query($sql);
          return $resultado;
    }

    public function eliminar() {
        $sql = "UPDATE ciber_respuestas set 
                respuesta_situacion = 0    
                where respuesta_id = $this->id;
                ";

        $resultado = $this->exec_sql($sql);
        return $resultado;
    }


    public function modificarRespuestas(){
        $sql = "UPDATE ciber_respuestas set 
        respuesta_pregunta = $this->pregunta,
        respuesta_descripcion = '$this->respuesta',
        respuesta_correcta = $this->correcta
        where respuesta_id = $this->id;
        ";

        $resultado = $this->exec_sql($sql);
        return $sql;
    }




}