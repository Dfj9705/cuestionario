<?php
require '../../html_fns.php';
require '../../includes/headersAPI.php';

validarIngresoApi(2);
    
try {
    $_GET['inicio'] = str_replace('T', ' ', $_GET['inicio']);
    $_GET['fin'] = str_replace('T', ' ', $_GET['fin']);
    $ClsEstaditicas = new ClsEstadisticas($_GET);
    $usuariosActivos = $ClsEstaditicas->getUsuariosRegistrados();
    $evaluacionesIniciadas = $ClsEstaditicas->getEvaluacionesIniciadas();
    $evaluacionesFinalizadas = $ClsEstaditicas->getEvaluacionesFinalizadas();
    $certificaciones = $ClsEstaditicas->getCertificaciones();

    $data = [
        'usuarios' => $usuariosActivos,
        'iniciadas' => $evaluacionesIniciadas,
        'finalizadas' => $evaluacionesFinalizadas,
        'certificaciones' => $certificaciones
    ];
    echo json_encode( $data );
} catch (PDOException $e) {
    echo json_encode([
        "error" => $e
    ]);
    exit;
}