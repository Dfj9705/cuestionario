<?php
require '../../html_fns.php';
require '../../includes/headersAPI.php';

validarIngresoApi();

try {
    $ClsEvaluaciones = new ClsEvaluaciones([ 'tema' => $_SESSION['modulo'] ]);   

    $preguntas = $ClsEvaluaciones->getPreguntasEvaluacion();
    shuffle($preguntas);
    $data = [];
    foreach ($preguntas as $key => $pregunta) {
        $dataRespuestas = $ClsEvaluaciones->getRespuestasPregunta($pregunta['ID']);
        $respuestas = [];
        
        foreach ($dataRespuestas as $key => $respuesta) {
            $respuestas[] = [
                'id' => $respuesta['ID'],
                'respuesta' => utf8_encode($respuesta['RESPUESTA']),
                'correcta' => $respuesta['CORRECTA'],
            ];
        }
        shuffle($respuestas);
        $data[] = [
            "pregunta" => utf8_encode($pregunta['PREGUNTA']),
            "id" => $pregunta['ID'],
            "respuestas" => $respuestas
        ];
    }

    echo json_encode( $data );
} catch (PDOException $e) {
    echo $e->getMessage();
    exit;
}