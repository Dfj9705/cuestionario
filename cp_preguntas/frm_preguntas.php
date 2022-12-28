<?php 
include_once '../includes/header.php'; 
validarIngreso(2);
?>

    <div class="container-fluid mt-4 " style="min-height: 80vh;">
        
        <div class="row justify-content-center mb-3">
            <form class="col-lg-6 border rounded p-3 bg-light">
                <div class="row text-center mb-5" >
                    <div class="col-12">
                        <h1>INGRESO DE PREGUNTAS</h1>
                    </div>
                </div>
                <input type="hidden" name="id" id="id">
                <div class="row justify-content-center mb-3">
                    <div class="col-lg-6">
                        <label for="nombre">Nombre del subtema</label>
                        <select    class="form-control" name="subtema" id="subtema">
                        </select>
                    </div>
                    <div class="col-lg-6">
                        <label for="nombre">Preguntas</label>
                        <input type="text" name="pregunta" id="pregunta" class="form-control">
                    </div>
                </div>
                <div class="row justify-content-center mb-3">
                    <div class="col-lg-3 mb-lg-0 mb-2">
                        <button type="submit" class="btn w-100 btn-success" id="btnGuardar"><i class="bi bi-save me-2"></i>Guardar</button>
                    </div>
                    <div class="col-lg-3 mb-lg-0 mb-2">
                        <button type="button" class="btn w-100 btn-warning" id="btnModificar"><i class="bi bi-pencil-square me-2"></i>Modificar</button>
                    </div>
                    <div class="col-lg-3 mb-lg-0 mb-2">
                        <button type="reset" class="btn w-100 btn-danger" id="btnLimpiar"><i class="bi bi-arrow-clockwise me-2"></i>Limpiar</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8 table-responsive text-center">
                <table id='tablaTemas' class='table table-hover table-condensed table-bordered w-100'>
                    <thead class='table-dark'>
                    <tr>
                    <th >No</th>
                    <th >NOMBRE DEL SUBTEMA</th>
                    <th >PREGUNTAS</th>
                    <th>MODIFICAR</th>
                    <th>ELIMINAR</th>
                    </tr>
                    </thead>
                    <tbody id="tabla_body">
                        
                    </tbody>
                </table>
            </div>
        </div>
    
    </div>
<?php include_once '../includes/footer.php' ?>
<script src="../assets/js/preguntas.js"></script>
    
