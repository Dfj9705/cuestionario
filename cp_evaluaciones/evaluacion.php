<?php 

session_start();
include_once '../includes/header.php'; 
validarIngreso();
$modulo = $_SESSION['modulo'];

if($modulo > 4){
    header('location: resultados.php');
}

?>


<?php if(file_exists("modulo${modulo}.php")) :?>
<div class="container">
    <div class="row">
        <div class="col p-3">
            <?php include_once "modulo${modulo}.php" ?>
        </div>
    </div>
</div>

<?php endif ?>
<div class="modal fade bg-dark" id="modalEvaluacion" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="infomodalEvaluacion" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <h5 class="modal-title " id="infomodalEvaluacion">EVALUACIÓN MÓDULO <?= $modulo?></h5>
            </div>
            <div class="modal-body container-fluid " >
                <div id="carouselEvaluacion" class="carousel slide" data-bs-ride="carousel">
                    <form class="carousel-inner" id="formCarousel">
                        <p id="loaderPreguntas" class="text-primary">Obteniendo preguntas, espere un momento<span class="spinner-border spinner-border-sm ms-2"></span></p>
                    </form>
                </div>
                    
            </div>
            <div class="modal-footer ">
                <button type="button" id="buttonAnterior"class="btn btn-secondary">Anterior</button>
                <button type="button" id="buttonSiguiente"class="btn btn-success">Siguiente</button>
                <button type="submit" form="formCarousel" id="buttonFinalizar"class="btn btn-primary">Finalizar</button>
            </div>
        </div>
    </div>
</div>

<?php include_once '../includes/footer.php' ?>
<script src="../assets/js/evaluaciones.js"></script>