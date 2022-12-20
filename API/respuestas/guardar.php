<?php
require '../../html_fns.php';
require '../../includes/headersAPI.php';

try {
    $_POST['pregunta'] = trim(mb_strtoupper($_POST['pregunta'], 'UTF-8'));
    $_POST['respueta'] = trim(mb_strtoupper($_POST['respueta'], 'UTF-8'));
    $_POST['buena'] = trim(mb_strtoupper($_POST['buena'], 'UTF-8'));
    $_POST['mala'] = trim(mb_strtoupper($_POST['mala'], 'UTF-8'));
  

    $ClsRespuestas= new ClsRespuestas($_POST);

    // $resultado = $ClsRespuestas->guardarRespuetas();
    echo json_encode([
        "resultado" => $resultado,
    ]);

    
} catch (PDOException $e) {
    echo json_encode([
        "error" => $e->getMessage()
    ]);
    exit;
}