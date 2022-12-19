<?php
require '../../html_fns.php';
require '../../includes/headersAPI.php';

try {
    $_POST['tema'] = trim(mb_strtoupper($_POST['tema'], 'UTF-8'));
    $_POST['nombre'] = trim(mb_strtoupper($_POST['nombre'], 'UTF-8'));
  

    $ClsSubtemas = new ClsSubtemas($_POST);

    $resultado = $ClsSubtemas->guardarSubtema();
    echo json_encode([
        "resultado" => $resultado,
    ]);

    
} catch (PDOException $e) {
    echo json_encode([
        "error" => $e->getMessage()
    ]);
    exit;
}