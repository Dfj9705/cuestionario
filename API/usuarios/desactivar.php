<?php
require '../../html_fns.php';
require '../../includes/headersAPI.php';
validarIngresoApi(2);
try {
    $ClsUser = new ClsUser($_POST);

    $resultado = $ClsUser->desactivarUsuario();
    echo json_encode([
        "resultado" => $resultado,
    ]);
    
} catch (PDOException $e) {
    echo $e->getMessage();
    exit;
}