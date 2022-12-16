<?php 
include_once '../includes/header.php'; ?>

    <div class="container-fluid mt-4 " style="min-height: 80vh;">
        
        <div class="row justify-content-center mb-3">
            <form class="col-lg-4 border rounded p-3 bg-light">
                <div class="row mb-3 text-center mb-5" >
                    <div class="col-12">
                        <h1>REGISTRO DE USUARIOS</h1>
                    </div>
                </div>
                <div class="row mb-3 text-center">
                    <div class="col-12">
                        <label for="correo">Correo Electrónico</label>
                        <input type="email" name="correo" id="correo" class="form-control">
                    </div>
                </div>
                <div class="row mb-3 text-center">
                    <div class="col-12">
                        <label for="catalogo">Catálogo</label>
                        <input type="text" name="catalogo" id="catalogo" class="form-control">
                    </div>
                </div>
                <div class="row mb-3 text-center">
                    <div class="col-12">
                        <label for="password">Contraseña</label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>
                </div>
                <div class="row mb-3 text-center">
                    <div class="col-12">
                        <label for="password2">Confirmar contraseña</label>
                        <input type="password" name="password2" id="password2" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <button class="btn btn-primary w-100">
                            Registrar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php include_once '../includes/footer.php' ?>
<script src="../assets/js/registro.js"></script>
    
