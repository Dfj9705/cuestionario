<?php
require '../../html_fns.php';
require '../../includes/headersAPI.php';

try {
    
    $regex = "$\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])(?=\S*[\W])\S*$";
    $validaciones = [
        "id" => FILTER_VALIDATE_INT,
        "token" => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        "password" => [
            'filter' => FILTER_VALIDATE_REGEXP,
            'options' => ["regexp"=>$regex]
        ],
        "password2" => [
            'filter' => FILTER_VALIDATE_REGEXP,
            'options' => ["regexp"=>$regex]
        ]
    ];

    $inputsValidados = filter_var_array($_POST, $validaciones);

    foreach ($inputsValidados as $key => $input) {
        if(!$input){
            $errores[] = $key;
        }
    }

    if($_POST['password'] != $_POST['password2'] ){
        $errores[] = 'password';
        $errores[] = 'password2';
    }

    $ClsUser = new ClsUser($inputsValidados);
    $user = $ClsUser->getUserToken();
    
    if($user){

        if(!$errores){
    
            $ClsUser->password = password_hash($inputsValidados['password'], PASSWORD_BCRYPT);
            // $ClsUser = new ClsUser($inputsValidados);
    
            $ClsUser->updatePassword();
            $ClsUser->deleteToken();

            echo json_encode([
                "exito" => "CONTRASEÑA ACTUALIZADA"
            ]);
            
        }else{
            echo json_encode([
                "errores" => $errores
            ]);
            exit;
        }
    }else{
        echo json_encode([
            "token" => "TOKEN INCORRECTO"
        ]);
        exit;
    }
    

} catch (PDOException $e) {
    echo json_encode([
        "error" => $e
    ]);
    exit;
}