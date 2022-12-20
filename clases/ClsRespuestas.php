<?php
require_once 'ClsConex.php';

class ClsRespuestas extends ClsConex{

    public $id;
    public $subtema;
    public $pregunta;

    public function __construct($args = [])
    {   
        $this->id = $args['id'] ?: null;
        $this->subtema = $args['subtema'] ?: '';
        $this->pregunta = $args['pregunta'] ?: '';
    }


}