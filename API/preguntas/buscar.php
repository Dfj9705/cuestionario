<?php
require '../../html_fns.php';
require '../../includes/headersAPI.php';
    
try {
    $ClsPreguntas = new ClsPreguntas();

    $temas = $ClsPreguntas->getPreguntas();
    $data = [];
    foreach ($temas as $key => $tema) {
        $data[]=[
            'id' => $tema['ID'],
            'subtema' => $tema['SUBTEMA'],
            'descripcion' => $tema['DESCRIPCION'],
            'contador' => $key + 1
           
        ];
    }


    echo json_encode($data);
} catch (PDOException $e) {
    echo $e->getMessage();
    exit;
}