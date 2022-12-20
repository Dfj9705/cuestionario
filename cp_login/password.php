<?php
session_start();
if($_SESSION['auth'] ){
    header('location: ../cp_menu/menu.php');
}

include_once '../includes/header.php'; 
include_once '../html_fns.php'; 

$ClsUser = new ClsUser($_GET);
$user = $ClsUser->getUserToken();

if($user) :

?>

    <div class="container-fluid mt-4 " style="min-height: 80vh;">
        
        <div class="row justify-content-center mb-3">
            <form class="col-lg-4 border rounded p-3 bg-light">
                <div class="row text-center mb-5" >
                    <div class="col-12">
                        <h1>CAMBIO DE CONSTRASEÑA</h1>
                    </div>
                </div>
                <input type="text" value="<?= $user[0]['USU_ID'] ?>" name="id" id="id">
                <input type="text" value="<?= $_GET['token'] ?>" name="token" id="token">
                <div class="row mb-3 text-center">
                    <div class="col-12">
                        <label for="correo">Correo Electrónico</label>
                        <input type="email" name="correo" id="correo" value="<?= $user[0]['USU_CORREO'] ?>" disabled class="form-control">
                        <div class="invalid-feedback text-start">
                            Ingrese un correo válido.
                        </div>
                    </div>
                </div>
                <div class="row mb-3 text-center">
                    <div class="col-12">
                        <label for="password">Contraseña</label>
                        <input type="password" name="password" id="password" class="form-control">
                        <div class="form-text text-start">
                            Su contraseña debe tener al menos 8 caracteres, una mayúscula, una minúscula, un número y un caracter especial (!#$%&)
                        </div>
                        <div class="invalid-feedback text-start">
                            Ingrese una contraseña válida.
                        </div>
                    </div>
                </div>
                <div class="row mb-3 text-center">
                    <div class="col-12">
                        <label for="password2">Confirmar contraseña</label>
                        <input type="password" name="password2" id="password2" class="form-control">
                        <div class="invalid-feedback text-start">
                            Las contraseñas deben coincidir.
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <button class="btn btn-primary w-100">
                            Reestablecer
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php else : ?>
    <h1 class="text-danger text-center">TOKEN NO VÁLIDO</h1>
<?php endif ?>
<?php  include_once '../includes/footer.php'  ?>
<script src="../assets/js/password.js"></script>
    
