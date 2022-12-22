<?php
require '../../html_fns.php';
require '../../includes/headersAPI.php';
    
try {
    $ClsEvaluaciones = new ClsEvaluaciones([ 'usuario' => $_SESSION['id']]);   

    if(count($ClsEvaluaciones->getEvaluacion()) < 1 ){
        $ClsEvaluaciones->iniciarEvaluacion();
    }
    $_SESSION['modulo'] = $ClsEvaluaciones->getEvaluacion()[0]['MODULO'];
    $_SESSION['evaluacion'] = $ClsEvaluaciones->getEvaluacion()[0]['ID'];
    echo json_encode($ClsEvaluaciones->getEvaluacion()[0]);
} catch (PDOException $e) {
    echo $e->getMessage();
    exit;
}