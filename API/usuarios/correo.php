<?php

require '../../html_fns.php';
require '../../includes/headersAPI.php';

try {
    $validaciones = [
        "id" => FILTER_VALIDATE_INT,
        "correo" => FILTER_VALIDATE_EMAIL,
    
    ];

    
    $inputsValidados = filter_var_array($_POST, $validaciones);

    if(array_search(false, $inputsValidados)){
        echo json_encode([
            "mensaje" => "REVISE LA INFORMACIÓN INGRESADA"
        ]);
        exit;

    }
    $ClsUser = new ClsUser($inputsValidados);

    if(count($ClsUser->buscarUsuario()) > 0){
        echo json_encode([
            "mensaje" => "ESTE CORREO YA FUE REGISTRADO"
        ]);
        exit;
    }

    $resultado = $ClsUser->actualizarCorreo();
    echo json_encode([
        "resultado" => $resultado,
    ]);

    
} catch (PDOException $e) {
    echo json_encode([
        "error" => $e->getMessage()
    ]);
    exit;
}