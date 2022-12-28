<?php
require '../../html_fns.php';
require '../../includes/headersAPI.php';
validarIngresoApi(2);   
try {
    $_POST['nombre'] = trim(mb_strtoupper($_POST['nombre'], 'UTF-8'));
    $ClsTipos = new ClsTipos($_POST);
    $resultado = $ClsTipos->guardarTipo();
    echo json_encode([
        "resultado" => $resultado,
    ]);
} catch (PDOException $e) {
    echo json_encode([
        "error" => $e->getMessage()
    ]);
    exit;
}