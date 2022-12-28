<?php
require '../../html_fns.php';
require '../../includes/headersAPI.php';
validarIngresoApi();   
try {
    $ClsEvaluaciones = new ClsEvaluaciones([ 'usuario' => $_SESSION['id']]);   

    if(count($ClsEvaluaciones->getEvaluacion()) < 1 ){
        $ClsEvaluaciones->iniciarEvaluacion();
    }

    $dataEvaluacion=$ClsEvaluaciones->getEvaluacion();
    $_SESSION['modulo'] = $dataEvaluacion [0]['MODULO'];
    $_SESSION['evaluacion'] = $dataEvaluacion[0]['ID'];
    echo json_encode($dataEvaluacion[0]);
} catch (PDOException $e) {
    echo $e->getMessage();
    exit;
}