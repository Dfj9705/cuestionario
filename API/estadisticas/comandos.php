<?php
require '../../html_fns.php';
require '../../includes/headersAPI.php';

validarIngresoApi(2);
    
try {
    $_GET['inicio'] = str_replace('T', ' ', $_GET['inicio']);
    $_GET['fin'] = str_replace('T', ' ', $_GET['fin']);
    $ClsEstaditicas = new ClsEstadisticas($_GET);
    
    $comandos = $ClsEstaditicas->getComandos();

    $data = [];

    foreach ($comandos as $key => $comando) {
        $data[] = [
            "comando" => $comando['COMANDO'],
            "activos" => $comando['ACTIVOS'],
            "evaluados" => $comando['EVALUADOS'],
            "certificados" => $comando['CERTIFICADOS'],
            "iniciados" => $comando['INICIADOS'],
        ];
    }
    echo json_encode( $data );
} catch (PDOException $e) {
    echo json_encode([
        "error" => $e
    ]);
    exit;
}