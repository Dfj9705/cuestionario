<?php

require '../../html_fns.php';
require '../../includes/headersAPI.php';
validarIngresoApi(2);    
try {
    $ClsRespuestas = new ClsRespuestas();

    $info = $ClsRespuestas->getRespuestas();
  
    $data = [];
    foreach ($info as $key => $resuesta) {
        $data[]=[
            'id' => $resuesta['ID'],
            'pregunta' => utf8_encode($resuesta['PREGUNTA']),
            'respuesta' => utf8_encode($resuesta['RESPUESTA']),
            'correcta' => utf8_encode($resuesta['CORRECTA']),
            'id_pregunta' => $resuesta['RESPUESTA_PREGUNTA'],
            'contador' => $key + 1
           
        ];
    }


    echo json_encode($data);
} catch (PDOException $e) {
    echo $e->getMessage();
    exit;
}