<?php
require '../../html_fns.php';
require '../../includes/headersAPI.php';
validarIngresoApi(2);   
try {
    $ClsRespuestas = new ClsRespuestas($_POST);
    $resultado = $ClsRespuestas->eliminar();
    echo json_encode([
        "resultado" => $resultado,
    ]);
} catch (PDOException $e) {
    echo json_encode([
        "error" => $e->getMessage() 
    ]);
    exit;
}