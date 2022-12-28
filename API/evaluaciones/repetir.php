<?php
require '../../html_fns.php';
require '../../includes/headersAPI.php';

validarIngresoApi();

try {
    $modulo = $_GET['modulo'];
    $tema = $_GET['tema'];
    $ClsEvaluaciones = new ClsEvaluaciones([ 'usuario' => $_SESSION['id'] , 'tema' => $tema]);   
    $ClsEvaluaciones->deleteDetalleRepetir();
    // if(count($ClsEvaluaciones->getEvaluacion()) < 1 ){
    //     $ClsEvaluaciones->iniciarEvaluacion();
    // }
    $_SESSION['modulo'] = $modulo;
    $_SESSION['evaluacion'] = $ClsEvaluaciones->getEvaluacion()[0]['ID'];
    echo json_encode($modulo);
} catch (PDOException $e) {
    echo $e->getMessage();
    exit;
}