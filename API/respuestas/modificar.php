<?php



require '../../html_fns.php';
require '../../includes/headersAPI.php';

try {
    $_POST['pregunta'] = trim(mb_strtoupper($_POST['pregunta'], 'UTF-8'));
    $_POST['respuesta'] = trim(mb_strtoupper($_POST['respuesta'], 'UTF-8'));
    $_POST['correcta'] = trim(mb_strtoupper($_POST['correcta'], 'UTF-8'));

  

    $ClsRespuestas= new ClsRespuestas($_POST);
    $ClsRespuestas->correcta = $_POST['correcta'];

    $resultado = $ClsRespuestas->modificarRespuestas();


   
    echo json_encode([
        "resultado" => $resultado,
    ]);

    
} catch (PDOException $e) {
    echo json_encode([
        "error" => $e->getMessage()
    ]);
    exit;
}