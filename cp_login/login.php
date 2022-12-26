<?php
session_start();
if($_SESSION['auth']){
    header('location: ../cp_menu/menu.php');
}
include_once '../includes/header.php'; ?>

    <div class="container-fluid mt-4 " style="min-height: 80vh;">
        
        <div class="row justify-content-center mb-3">
            <form class="col-lg-4 border rounded p-3 bg-light">
                <div class="row justify-content-center" >
                    <div class="col-4">
                        <img width="100%" src="../assets/img/escudo.png" alt="escudo-ciber">
                    </div>
                </div>
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
                <div class="row mb-3">
                    <div class="col">
                        <button class="btn btn-primary w-100">
                            Iniciar sesión
                        </button>
                    </div>
                </div>
                <div class="row ">
                    <div class="col text-center">
                        <button type="button" class="btn btn-link" data-bs-target="#modalInfo" data-bs-toggle="modal">¿Olvidó su contraseña?</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="modal fade" id="modalInfo" tabindex="-1" role="dialog" aria-labelledby="infomodalInfo" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header ">
                    <h3 class="modal-title " id="infomodalInfo">PASOS PARA REESTABLECER CONTRASEÑA</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body container-fluid " >
                    <ol class="list-group list-group-numbered">
                        <li class="list-group-item">Escribir un mensaje al número 4497-4318, indicando que desea reestablecer su contraseña, con la siguiente información:
                            <ul>
                                <li>Correo electrónico <strong>registrado</strong></li>
                                <li>No. de Catálogo</li>
                                <li>Nombre Completo</li>
                            </ul>
                        </li>
                        <li class="list-group-item">Recibirá un correo electrónico con un enlace para reestablecer su contraseña</li>
                        <li class="list-group-item">Completar el formulario para cambio de contraseña</li>
                    </ol>
                   
                </div>
                <div class="modal-footer">
                    <button type="button"  class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
<?php include_once '../includes/footer.php' ?>
<script src="../assets/js/login.js"></script>
    
