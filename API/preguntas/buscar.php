<?php
require '../../html_fns.php';
require '../../includes/headersAPI.php';
    
try {
    $ClsPreguntas = new ClsPreguntas();

    $info = $ClsPreguntas->getPreguntas();
    // var_dump($info);
    // exit;
    // $data = [];
    foreach ($info as $key => $pregunta) {
        $data[]=[
            'id' => $pregunta['ID'],
            'descripcion' => utf8_encode($pregunta['DESCRIPCION']),
            'subtema' => $pregunta['SUBTEMA'],
            'contador' => $key + 1
           
        ];
    }


    echo json_encode($data);
} catch (PDOException $e) {
    echo $e->getMessage();
    exit;
}