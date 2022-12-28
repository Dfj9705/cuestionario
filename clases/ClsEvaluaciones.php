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
        $sql = "SELECT respuesta_descripcion as respuesta, respuesta_id as id, respuesta_correcta as correcta  from ciber_respuestas where respuesta_pregunta = $idPregunta and respuesta_situacion = 1";
        $resultado = $this->exec_query($sql);
        return $resultado;
    }

    public function getResultados(){
        $sql = "SELECT tema_nombre, tema_id,
        (
            select count(*) from ciber_preguntas
            inner join ciber_subtemas on pregunta_subtema = subtema_id
            where subtema_tema = tema_id
            and pregunta_situacion = 1
        ) as preguntas,
        (
            select count(*) from ciber_detalle_evaluaciones
            inner join ciber_evaluaciones on detalle_evaluacion = evaluacion_id
            inner join ciber_respuestas on detalle_respuesta = respuesta_id
            inner join ciber_preguntas on respuesta_pregunta = pregunta_id
            inner join ciber_subtemas on pregunta_subtema = subtema_id
            where subtema_tema = tema_id
            and respuesta_correcta = 1
            and detalle_situacion = 1
            and evaluacion_usuario = $this->usuario
        ) as correctas,
        (
            select count(*) from ciber_detalle_evaluaciones
            inner join ciber_evaluaciones on detalle_evaluacion = evaluacion_id
            inner join ciber_respuestas on detalle_respuesta = respuesta_id
            inner join ciber_preguntas on respuesta_pregunta = pregunta_id
            inner join ciber_subtemas on pregunta_subtema = subtema_id
            where subtema_tema = tema_id
            and respuesta_correcta = 0
            and detalle_situacion = 1
            and evaluacion_usuario = $this->usuario
        ) as incorrectas
        
        
        
        from ciber_temas where tema_situacion = 1
        ";
        $resultado = $this->exec_query($sql);
        return $resultado;
    }

    public function getDetalle(){
        $sql = "SELECT pregunta_id, pregunta_descripcion,
        (
            select respuesta_id from ciber_respuestas where respuesta_pregunta = pregunta_id and respuesta_correcta = 1 
        ) as correcta,
        (
            select detalle_respuesta from ciber_detalle_evaluaciones 
            inner join ciber_evaluaciones on detalle_evaluacion = evaluacion_id
            inner join ciber_respuestas on detalle_respuesta = respuesta_id
            where evaluacion_usuario = $this->usuario 
            and detalle_situacion = 1
            and respuesta_pregunta = pregunta_id
        
        ) as seleccionada
        
        from ciber_preguntas inner join ciber_subtemas on pregunta_subtema = subtema_id where subtema_tema = $this->tema";
        $resultado = $this->exec_query($sql);

        return $resultado;
    }

    public function deleteDetalleRepetir(){
        $sql = "UPDATE ciber_detalle_evaluaciones set detalle_situacion = 0 where detalle_id in (
            select detalle_id from ciber_detalle_evaluaciones 
            inner join ciber_evaluaciones on detalle_evaluacion = evaluacion_id 
            inner join ciber_respuestas on detalle_respuesta = respuesta_id
            inner join ciber_preguntas on respuesta_pregunta = pregunta_id
            inner join ciber_subtemas on pregunta_subtema = subtema_id
            where evaluacion_usuario = $this->usuario and subtema_tema = $this->tema
        ) ";
        $resultado = $this->exec_sql($sql);

        return $resultado;
    }

    function getCantidadRespuestasCorrectas(){
        $sql = "SELECT count(*) as correctas from ciber_evaluaciones inner join ciber_detalle_evaluaciones on detalle_evaluacion = evaluacion_id inner join ciber_respuestas on detalle_respuesta = respuesta_id where evaluacion_usuario = $this->usuario and detalle_situacion = 1 and respuesta_correcta = 1";
        $resultado = $this->exec_query($sql);

        return $resultado[0]['CORRECTAS'];
    }

    function getCantidadRespuestasIncorrectas(){
        $sql = "SELECT count(*) as incorrectas from ciber_evaluaciones inner join ciber_detalle_evaluaciones on detalle_evaluacion = evaluacion_id inner join ciber_respuestas on detalle_respuesta = respuesta_id where evaluacion_usuario = $this->usuario and detalle_situacion = 1 and respuesta_correcta = 0";
        $resultado = $this->exec_query($sql);

        return $resultado[0]['INCORRECTAS'];
    }
    
}