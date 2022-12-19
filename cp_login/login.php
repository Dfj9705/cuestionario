<?php
session_start();
if($_SESSION['auth']){
    header('location: ../cp_menu/menu.php');
}
include_once '../includes/header.php'; ?>

    <div class="container-fluid mt-4 " style="min-height: 80vh;">
        
        <div class="row justify-content-center mb-3">
            <form class="col-lg-4 border rounded p-3 bg-light">
                <div class="row text-center mb-5" >
                    <div class="col-12">
                        <h1>INICIO DE SESIÓN</h1>
                    </div>
                </div>
                <div class="row mb-3 text-center">
                    <div class="col-12">
                        <label for="correo">Correo Electrónico</label>
                        <input type="email" name="correo" id="correo" class="form-control">
                        <div class="invalid-feedback text-start">
                            Ingrese un correo válido.
                        </div>
                    </div>
                </div>
                <div class="row mb-3 text-center">
                    <div class="col-12">
                        <label for="password">Contraseña</label>
                        <input type="password" name="password" id="password" class="form-control">
                        <div class="invalid-feedback text-start">
                            Ingrese una contraseña válida.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <button class="btn btn-primary w-100">
                            Iniciar sesión
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php include_once '../includes/footer.php' ?>
<script src="../assets/js/login.js"></script>
    
