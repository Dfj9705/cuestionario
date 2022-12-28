<?php 
session_start();
include_once '../includes/header.php'; 
validarIngreso(2);
?>

    <div class="container-fluid mt-4 bg-light p-5 rounded " > 
        <div class="row justify-content-center mb-3 text-center">
            <div class="col">
                <h1>Estadisticas Generales</h1>
            </div>
        </div>
        <form class="row mb-3" id="formFiltro">
            <div class="col-lg-2">
                <input type="datetime-local" name="inicio" id="inicio" class="form-control form-control-sm">
            </div>
            <div class="col-lg-2">
                <input type="datetime-local" name="fin" id="fin" class="form-control form-control-sm">
            </div>
            <div class="col-lg-1">
                <button class="btn btn-primary btn-sm w-100" type="submit"><i class="bi bi-filter"></i></button>
            </div>
        </form>
        <div class="row mb-3">
            <div class="card mb-3 col-lg-3 " style="max-width: 540px;">
                <div class="row g-0">
                    <div class="col-4 text-info">
                        <svg xmlns="http://www.w3.org/2000/svg" width="100%" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                            <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z"/>
                        </svg>
                        <!-- <img src="../assets/img/escudo.png" class="img-fluid rounded-start" alt="..."> -->
                    </div>
                    <div class="col-8">
                        <div class="card-body">
                            <h6 class="card-title">Usuarios activos</h6>
                            <p class="card-text display-6" id="datoUsuarios">0</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-3 col-lg-3 " style="max-width: 540px;">
                <div class="row g-0">
                    <div class="col-4 text-info">
                        <svg xmlns="http://www.w3.org/2000/svg" width="100%" fill="currentColor" class="bi bi-card-list" viewBox="0 0 16 16">
                            <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                            <path d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8zm0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-1-5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zM4 8a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm0 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z"/>
                        </svg>
                    </div>
                    <div class="col-8">
                        <div class="card-body">
                            <h6 class="card-title">Ev. iniciadas</h6>
                            <p class="card-text display-6" id="datoIniciadas">0</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-3 col-lg-3 " style="max-width: 540px;">
                <div class="row g-0">
                    <div class="col-4 text-info">
                        <svg xmlns="http://www.w3.org/2000/svg" width="100%" fill="currentColor" class="bi bi-card-checklist" viewBox="0 0 16 16">
                            <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                            <path d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0zM7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z"/>
                        </svg>
                    </div>
                    <div class="col-8">
                        <div class="card-body">
                            <h6 class="card-title">Ev. finalizadas</h6>
                            <p class="card-text display-6" id="datoFinalizadas">0</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-3 col-lg-3 " style="max-width: 540px;">
                <div class="row g-0">
                    <div class="col-4 text-info">
                        <svg xmlns="http://www.w3.org/2000/svg" width="100%" fill="currentColor" class="bi bi-award" viewBox="0 0 16 16">
                            <path d="M9.669.864 8 0 6.331.864l-1.858.282-.842 1.68-1.337 1.32L2.6 6l-.306 1.854 1.337 1.32.842 1.68 1.858.282L8 12l1.669-.864 1.858-.282.842-1.68 1.337-1.32L13.4 6l.306-1.854-1.337-1.32-.842-1.68L9.669.864zm1.196 1.193.684 1.365 1.086 1.072L12.387 6l.248 1.506-1.086 1.072-.684 1.365-1.51.229L8 10.874l-1.355-.702-1.51-.229-.684-1.365-1.086-1.072L3.614 6l-.25-1.506 1.087-1.072.684-1.365 1.51-.229L8 1.126l1.356.702 1.509.229z"/>
                            <path d="M4 11.794V16l4-1 4 1v-4.206l-2.018.306L8 13.126 6.018 12.1 4 11.794z"/>
                        </svg>
                    </div>
                    <div class="col-8">
                        <div class="card-body">
                            <h6 class="card-title">Certificaciones</h6>
                            <p class="card-text display-6" id="datoCertificaciones">0</p>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="row mb-3">
            <div class="col-lg-12 border" >
                
                <canvas id="graficoDependencias">

                </canvas>
            
            </div>
        </div>
    </div>
<?php include_once '../includes/footer.php' ?>

<script src="../assets/js/Chart.min.js"></script>
<script src="../assets/js/estadisticas.js"></script>
    
