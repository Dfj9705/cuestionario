<?php include_once '../includes/header.php'; ?>

<?php

    validarIngreso(2);

    include_once '../html_fns.php';
    $codigo = $_GET['id'];
    $token = base64_decode($codigo);
    try {
        
        $ClsUser = new ClsUser(['diploma' => $token ]);
        $usuario = $ClsUser->getUserDiploma();
        if(count($usuario) > 0){
            $ClsUser->id = $usuario[0]['USU_ID'];
            // print_r($usuario);
            $catalogo = $usuario[0]['PER_CATALOGO'];
            $nombre = trim($usuario[0]['GRA_DESC_CT']) .  " " . trim($usuario[0]['PER_NOM1']) . " " . trim($usuario[0]['PER_APE1']) ;
            $ClsUser->deleteDiploma();
        }
    } catch (PDOException $e) {
        echo $e;
    }
?>

<div class="container py-3 border mt-3 rounded bg-light">
    <div class="row">
        <div class="col text-center">
            <h1>Validación de Diplomas</h1>
        </div>
    </div>
    <div class="row justify-content-center">
    
        <?php if(count($usuario) > 0 ) : ?>
        <div class="col-lg-6 alert alert-success">
            <p><i class="bi bi-check-circle me-2"></i> Certificado válido</p>
            <p>Diploma perteneciente a: <?=$nombre?></p>
            <p>Catálogo: <?=$catalogo?></p>
        </div>  
        
        <?php else :?>
        <div class="col-lg-6 alert alert-danger">
           <i class="bi bi-exclamation-circle me-2"></i> Usuario no encontrado
        </div>  
        <?php endif ?>
        
    </div>
</div>

<?php include_once '../includes/footer.php' ?>
    