<?php 
session_start();
include_once '../includes/header.php'; 
validarIngreso(2);

?>

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
    <div class="modal fade" id="modalCorreo" tabindex="-1" role="dialog" aria-labelledby="infomodalCorreo" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header ">
                    <h3 class="modal-title " id="infomodalCorreo">Cambio de correo</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body container-fluid " >
                    <div class="row">
                        <form class="col" id="formCorreo">
                            <input type="text" id="id" name="id">
                            <div class="row">
                                <div class="col">
                                    <label for="correo">Correo nuevo</label>
                                    <input type="email" name="correo" id="correo" class="form-control">
                                </div>
                            </div>
                        </form>
                    </div>
                   
                </div>
                <div class="modal-footer">
                    <button type="button"  class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" form="formCorreo" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </div>
    </div>
<?php include_once '../includes/footer.php' ?>
<script src="../assets/js/usuarios.js"></script>
    