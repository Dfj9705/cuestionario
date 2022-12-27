<?php 
session_start();
if(!$_SESSION['auth']){
    header('location: ../cp_menu/menu.php');
}
include_once '../includes/header.php'; ?>
<div class="container py-3 border mt-3 rounded bg-light">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <h1>Resultados de la evaluación</h1>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-lg-12 table-responsive">
            <table class="table" id="tableResultados">
                <thead>
                    <tr>
                        <th>MÓDULO</th>
                        <th>PREGUNTAS</th>
                        <th>CORRECTAS</th>
                        <th>INCORRECTAS</th>
                        <th>ESTADO</th>
                        <th>DETALLE</th>
                        <th>REPETIR</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    
                </tbody>
            </table>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-3">
            <a href="#" class="btn btn-info w-100" id="btnImprimir"><i class="bi bi-award me-2"></i>Imprimir certificado</a>
        </div>
    </div>
</div>
<div class="modal fade" id="modalDetalle" tabindex="-1" role="dialog" aria-labelledby="infomodalDetalle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <h5 class="modal-title " id="infomodalDetalle">DETALLE DE EVALUACION</h5>
            </div>
            <div class="modal-body container-fluid " >
                <div class="row">
                    <div class="col table-responsive">
                        <p id="loaderResultados" class="text-primary">Obteniendo resultados, espere un momento<span class="spinner-border spinner-border-sm ms-2"></span></p>
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>PREGUNTA</th>
                                    <th>RESULTADO</th>
                                </tr>
                            </thead>
                            <tbody id="tbodyDetalle">

                            </tbody>
                        </table>
                    </div>
                </div>
                    
            </div>
            <div class="modal-footer ">
                <button type="button"  class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<?php include_once '../includes/footer.php' ?>
<script src="../assets/js/resultados.js"></script>
    