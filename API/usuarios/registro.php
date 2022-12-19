<?php
require '../../html_fns.php';
require '../../includes/headersAPI.php';






try {
    
    $regex = "$\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])(?=\S*[\W])\S*$";
    $validaciones = [
        "catalogo" => FILTER_VALIDATE_INT,
        "correo" => FILTER_VALIDATE_EMAIL,
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

    if($inputsValidados['catalogo']){
        $ClsMenu = new ClsMenu();
        $user = $ClsMenu->getUser($inputsValidados['catalogo']);
    
        if(!$user){
            $errores[] = 'catalogo';
        }
        
    }
    

    if(!$errores){

        $inputsValidados['password'] = password_hash($inputsValidados['password'], PASSWORD_BCRYPT);
        $ClsUser = new ClsUser($inputsValidados);

        if(!$ClsUser->buscarRegistro()){
            $ClsUser->registrar();
            echo json_encode(["user" => $user[0] ]);
        }else{
            echo json_encode([
                "mensaje" => "ESTE USUARIO/CORREO YA FUE REGISTRADO CON ANTERIORIDAD",
            ]);
        }
        
    }else{
        echo json_encode([
            "errores" => $errores
        ]);
        exit;
    }
} catch (PDOException $e) {
    echo json_encode([
        "error" => $e
    ]);
    exit;
}