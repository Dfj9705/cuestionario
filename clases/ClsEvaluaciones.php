<?php
require_once 'ClsConex.php';

class ClsEvaluaciones extends ClsConex{

    public $id;
    public $usuario;
    public $modulo;
    public $tema;

    public function __construct($args = [])
    {   
        $this->id = $args['id'] ?: null;
        $this->usuario = $args['usuario'] ?: '';
        $this->modulo = $args['modulo'] ?: '';
        $this->tema = $args['tema'] ?: '';
    }
    
    public function iniciarEvaluacion(){
        $sql = "INSERT INTO ciber_evaluaciones (evaluacion_usuario, evaluacion_modulo) values ('$this->usuario', '1' )";
        $resultado = $this->exec_sql($sql);
        return $resultado;
    }

    public function getEvaluacion(){
        $sql = "SELECT EVALUACION_ID AS ID, EVALUACION_MODULO as MODULO from ciber_evaluaciones where evaluacion_usuario = $this->usuario ";
        $resultado = $this->exec_query($sql);
        return $resultado;
    }

    public function getPreguntasEvaluacion(){
        $sql = "SELECT pregunta_descripcion as pregunta, pregunta_id as id from ciber_preguntas inner join ciber_subtemas on pregunta_subtema = subtema_id inner join ciber_temas on subtema_tema = tema_id where tema_id = $this->tema";
        $resultado = $this->exec_query($sql);
        return $resultado;
    }

    public function updateModulo(){
        $sql = "UPDATE ciber_evaluaciones set evaluacion_modulo = $this->modulo where evaluacion_id = $this->id ";
        $resultado = $this->exec_sql($sql);
        return $resultado;
    }

    public function getRespuestasPregunta($idPregunta){
        $sql = "SELECT respuesta_descripcion as respuesta, respuesta_id as id, respuesta_correcta as correcta  from ciber_respuestas where respuesta_pregunta = $idPregunta";
        $resultado = $this->exec_query($sql);
        return $resultado;
    }

    
}