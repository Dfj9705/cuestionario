<?php
require '../../html_fns.php';
require '../../includes/headersAPI.php';
validarIngresoApi(2);
try {
    $ClsUser = new ClsUser($_POST);
    $token = uniqid();
    $ClsUser->token = $token;
    $ClsUser->updateToken();

    echo json_encode([ "token" => $ClsUser->token ]);

} catch (PDOException $e) {
    echo json_encode([
        "error" => $e
    ]);
    exit;
}