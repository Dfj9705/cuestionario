<?php
require '../../html_fns.php';
require '../../includes/headersAPI.php';

try {
    $ClsUser = new ClsUser($_POST);
    $registro = $ClsUser->buscarUsuario();
    if($registro){
        
        $valida = password_verify($_POST['password'], $registro[0]['USU_PASSWORD']);

        if($valida){
            // echo json_encode($valida);
            session_start();
            $_SESSION['catalogo'] = $registro[0]['USU_CATALOGO'];
            $_SESSION['rol'] = $registro[0]['USU_ROL'];
            $_SESSION['correo'] = $registro[0]['USU_CORREO'];
            $_SESSION['id'] = $registro[0]['USU_ID'];
            $_SESSION['nombre'] = trim($registro[0]['GRA_DESC_CT']) .  " " . trim($registro[0]['PER_NOM1']) . " " . trim($registro[0]['PER_APE1']) ;
            $_SESSION['auth'] = true;
            $ClsEvaluaciones = new ClsEvaluaciones([ 'usuario' => $_SESSION['id']]); 
            $dataEvaluacion=$ClsEvaluaciones->getEvaluacion();
            if(count($dataEvaluacion) > 0){
                $_SESSION['evaluacion'] = $dataEvaluacion[0]['ID'];  
                $_SESSION['modulo'] = $dataEvaluacion [0]['MODULO'];

            }
            echo json_encode([
                "exito" => "BIENVENIDO " . $_SESSION['nombre']
            ]);
            exit;

        }else{
            echo json_encode([
                "mensaje" => "LA CONTRASEÑA INGRESADA NO ES CORRECTA"
            ]);
            exit;
        }


    }else{
        echo json_encode([
            "mensaje" => "EL USUARIO INGRESADO NO EXISTE"
        ]);
        exit;

    }

} catch (PDOException $e) {
    echo json_encode([
        "error" => $e
    ]);
    exit;
}