<?php
require_once 'ClsConex.php';

class ClsDetalle extends ClsConex{

    public $id;
    public $evaluacion;
    public $respuesta;

    public function __construct($args = [])
    {   
        $this->id = $args['id'] ?: null;
        $this->evaluacion = $args['evaluacion'] ?: '';
        $this->respuesta = $args['respuesta'] ?: '';
    }

    public function guardarRespuesta(){
        $sql = "INSERT INTO ciber_detalle_evaluaciones (detalle_evaluacion, detalle_respuesta) values ('$this->evaluacion', '$this->respuesta' )";
        $resultado = $this->exec_sql($sql);
        return $resultado;
    }

}