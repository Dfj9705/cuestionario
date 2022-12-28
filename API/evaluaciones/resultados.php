<?php
require '../../html_fns.php';
require '../../includes/headersAPI.php';
validarIngresoApi();   
try {
    $ClsEvaluaciones = new ClsEvaluaciones([ 'usuario' => $_SESSION['id'] ]);   

    $resultados = $ClsEvaluaciones->getResultados();
    $data = [];
    foreach ($resultados as $key => $resultado) {
        $data[] = [
            "tema" => $resultado['TEMA_NOMBRE'],
            "id" => $resultado['TEMA_ID'],
            "preguntas" => $resultado['PREGUNTAS'],
            "correctas" => $resultado['CORRECTAS'],
            "incorrectas" => $resultado['INCORRECTAS'],

        ];
    }

    echo json_encode( $data );
} catch (PDOException $e) {
    echo $e->getMessage();
    exit;
}