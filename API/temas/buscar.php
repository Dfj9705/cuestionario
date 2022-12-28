<?php
require '../../html_fns.php';
require '../../includes/headersAPI.php';
validarIngresoApi(2);  
try {
    $ClsTemas = new ClsTemas();

    $temas = $ClsTemas->getTemas();
    $data = [];
    foreach ($temas as $key => $tema) {
        $data[]=[
            'id' => $tema['ID'],
            'nombre' => $tema['NOMBRE'],
            'contador' => $key + 1
           
        ];
    }


    echo json_encode($data);
} catch (PDOException $e) {
    echo $e->getMessage();
    exit;
}