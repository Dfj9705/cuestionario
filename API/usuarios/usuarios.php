<?php
require '../../html_fns.php';
require '../../includes/headersAPI.php';
validarIngresoApi(2);  
try {
    $ClsUser = new ClsUser();

    $usuarios = $ClsUser->getAllUsers();
    $data = [];
    foreach ($usuarios as $key => $usuario) {
        $data[]=[
            'id' => $usuario['USU_ID'],
            'nombre' => trim($usuario['GRA_DESC_CT']) .  " " . trim($usuario['PER_NOM1']) . " " . trim($usuario['PER_APE1']),
            'catalogo' => $usuario['PER_CATALOGO'],
            'correo' => $usuario['USU_CORREO'],
            'contador' => $key + 1,
        ];
    }


    echo json_encode($data);
} catch (PDOException $e) {
    echo $e->getMessage();
    exit;
}