<?php
require '../../html_fns.php';
require '../../includes/headersAPI.php';
    
try {
    $_POST['nombre'] = trim(mb_strtoupper($_POST['nombre'], 'UTF-8'));
    $_POST['pregunta'] = trim(mb_strtoupper($_POST['pregunta'], 'UTF-8'));
  
    $ClsPreguntas = new ClsPreguntas($_POST);
    $resultado = $ClsPreguntas->modificarPregunta();
    echo json_encode([
        "resultado" => $resultado,
    ]);
} catch (PDOException $e) {
    echo json_encode([
        "error" => $e->getMessage()
    ]);
    exit;
}