<?php
require '../../html_fns.php';
require '../../includes/headersAPI.php';

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