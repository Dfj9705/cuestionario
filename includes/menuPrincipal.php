<div class="offcanvas offcanvas-start " tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header bg-dark text-white">
        <h5 class="offcanvas-title" id="offcanvasExampleLabel">MENU</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="list-group">
            <div class="accordion" id="accordionFlushExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="itemtitle1">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#item1" aria-expanded="false" aria-controls="item1">
                            <i class="bi bi-gear me-2"></i>Administración
                        </button>
                    </h2>
                    <div id="item1" class="accordion-collapse collapse" aria-labelledby="itemtitle1" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <div class="list-group">
                                <a href="../cp_temas/frm_temas.php" class="list-group-item"><i class="bi bi-list-ol me-2"></i>Temas</a>
            
                                <a href="../cp_subtemas/frm_subtemas.php" class="list-group-item"><i class="bi bi-list-nested me-2"></i>Subtemas</a>
                            </div>
                        </div>
                    </div>
                </div>
               
            </div>
        </div>

    </div>
</div>
<nav class="navbar navbar-dark bg-dark">
    <div class="d-flex w-100 justify-content-between px-3">
        <div>
        <?php if(isset($_SESSION['auth'])): ?>
       
        <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
            <i class="bi bi-list"></i>
        </button>
        <?php endif ?>
        </div>
        <div class="d-flex">
            <?php if(!isset($_SESSION['auth'])): ?>
            <a href="../cp_login/registro.php" class="btn btn-secondary" type="button" >
                Registrarse
            </a>
            <a href="../cp_login/login.php" class="btn btn-primary" type="button" >
                Ingresar
            </a>
            <?php else : ?>
            <button class="btn btn-dark">
                <?= $_SESSION['nombre'] ?>
            </button>
            <a href="../cp_login/logout.php" class="btn btn-danger" type="button" >
                Salir
            </a>
            <?php endif ?>
        </div>
           
        
    </div>
</nav>
