<?php
require '../../html_fns.php';
require '../../includes/headersAPI.php';
    
try {
    $id = $_GET['id'];
    $ClsEvaluaciones = new ClsEvaluaciones([ 'usuario' => $_SESSION['id'] , 'tema' => $id]);   

    $detalles = $ClsEvaluaciones->getDetalle();
    $data = [];
    foreach ($detalles as $key => $detalle) {
        $data[] = [
            "pregunta" => utf8_encode($detalle['PREGUNTA_DESCRIPCION']),
            "id" => $detalle['PREGUNTA_ID'],
            "correcta" => $detalle['CORRECTA'],
            "seleccionada" => $detalle['SELECCIONADA'],

        ];
    }

    echo json_encode( $data );
} catch (PDOException $e) {
    echo $e->getMessage();
    exit;
}