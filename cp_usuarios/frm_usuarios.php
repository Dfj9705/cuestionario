<?php 
session_start();
if(!$_SESSION['auth']){
    header('location: ../cp_menu/menu.php');
}
include_once '../includes/header.php'; ?>

    <div class="container-fluid mt-4 " style="min-height: 80vh;">
        <div class="row justify-content-center">
            <div class="col text-center">
                <h1>
                    Usuarios registrados
                </h1>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8 table-responsive text-center">
                <table id='tablaTemas' class='table table-hover table-condensed table-bordered w-100'>
                    <thead class='table-dark'>
                    <tr>
                    <th>No</th>
                    <th>NOMBRE</th>
                    <th>CATÁLOGO</th>
                    <th>CORREO</th>
                    <th>ACCIONES</th>
                    </tr>
                    </thead>
                    <tbody id="tabla_body">
                        
                    </tbody>
                </table>
            </div>
        </div>
    
    </div>
<?php include_once '../includes/footer.php' ?>
<script src="../assets/js/usuarios.js"></script>
    