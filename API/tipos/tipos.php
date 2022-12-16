<?php
require '../../html_fns.php';
require '../../includes/headersAPI.php';
    
try {
    $ClsTipos = new ClsTipos();

    $tipos = $ClsTipos->getTipos();
    $data = [];
    foreach ($tipos as $key => $tipo) {
        $data[]=[
            'id' => $tipo['ID'],
            'nombre' => $tipo['NOMBRE'],
            'direccion' => utf8_encode($tipo['DIRECCION']),
            'codigo_direccion' => $tipo['CODIGO_DIRECCION'],
            'contador' => $key + 1
        ];
    }


    echo json_encode($data);
} catch (PDOException $e) {
    echo $e->getMessage();
    exit;
}