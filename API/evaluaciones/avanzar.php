<?php
require '../../html_fns.php';
require '../../includes/headersAPI.php';
    
try {
    if(count($_POST) > 0){
        // echo json_encode($_POST);

        $evaluacion = $_SESSION['evaluacion'];
        $resultados = [];
        foreach ($_POST as $key => $input) {
            $respuesta = $input;
            $ClsDetalle = new ClsDetalle([
                "evaluacion" => $evaluacion,
                "respuesta" => $respuesta,           
            ]);

            $resultados[] = $ClsDetalle->guardarRespuesta();
            // echo $input;
        }
        if(!array_search(false,$resultados)){
            $ClsEvaluaciones = new ClsEvaluaciones([
                "id" => $evaluacion,
                'usuario' => $_SESSION['id'],
            ]);
            $moduloGuardado =  $ClsEvaluaciones->getEvaluacion()[0]['MODULO'];
            
            if($moduloGuardado == 5){
                $_SESSION['modulo'] = $moduloGuardado;
            }else{
                $_SESSION['modulo']++;
            }
            $ClsEvaluaciones->modulo = $_SESSION['modulo'];
            $ClsEvaluaciones->updateModulo();
            echo json_encode([
                "resultado" => "EVALUACIÓN GUARDADA"
            ]);
            
        }else{
            echo json_encode([
                "mensaje" => "ERROR AL GUARDAR RESPUESTAS"
            ]);
        }

    }else{
        echo json_encode([
            "mensaje" => "DEBE SELECCIONAR TODAS LAS RESPUESTAS"
        ]);
        exit;
    }
} catch (PDOException $e) {
    echo json_encode([
        "error" => $e
    ]);
    exit;
}