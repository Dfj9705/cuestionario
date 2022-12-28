<?php 
session_start();
include_once '../includes/header.php'; 
validarIngreso();

?>
<div class="container py-3 border mt-3 rounded bg-light">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <h1>Inicio de la evaluación</h1>
        </div>
    </div>
    <div class="row justify-content-center mb-3">
        <div class="col-lg-8">
            <img src="../assets/img/test.jpg" alt="header" width="100%">
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <p>Esta punto de iniciar la evaluación de ciberseguridad, presione el botón "Iniciar" para mostrar los módulos disponibles para evaluación</p>
        </div>
    </div>
    <div class="row justify-content-center mb-3">
        <div class="col-lg-8">
            <?php if($_SESSION['modulo'] > 4 ) : ?>
                <p class="text-success h1 text-center">Ha finalizado las evaluaciones </p>
                <button class="btn btn-primary w-100" id="btnInicio">Ver resultados</button>
            <?php elseif($_SESSION['modulo'] > 1): ?>
                <button class="btn btn-warning w-100" id="btnInicio">Continuar con el módulo <?= $_SESSION['modulo']?></button>
            <?php else : ?>
                <button class="btn btn-primary w-100" id="btnInicio">Iniciar Evaluación</button>
            <?php endif ?>
        </div>
    </div>
</div>


<?php include_once '../includes/footer.php' ?>
<script src="../assets/js/inicio.js"></script>
    