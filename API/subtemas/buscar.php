<?php
require '../../html_fns.php';
require '../../includes/headersAPI.php';
validarIngresoApi(2);  
try {
    $ClsSubtemas = new ClsSubtemas();

    $temas = $ClsSubtemas->getSubTemas();
    $data = [];
    foreach ($temas as $key => $tema) {
        $data[]=[
            'id' => $tema['ID'],
            'tema' => $tema['TEMA'],
            'nombre' => $tema['NOMBRE'],
            'contador' => $key + 1
           
        ];
    }


    echo json_encode($data);
} catch (PDOException $e) {
    echo $e->getMessage();
    exit;
}