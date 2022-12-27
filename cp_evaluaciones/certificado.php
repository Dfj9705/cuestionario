<?php
    require_once '../html_fns.php';
    include_once '../clases/pdf_mc_table.php';
    setlocale(LC_ALL, 'es_ES');
    session_start();
    if(!$_SESSION['auth']){
        header('location: ../cp_menu/menu.php');
    }
    $ClsUser = new ClsUser($_SESSION);
    $ClsEvaluaciones = new ClsEvaluaciones([ 'usuario' => $_SESSION['id']]);
    $respuestasCorrectas = $ClsEvaluaciones->getCantidadRespuestasCorrectas();
    $respuestasIncorrectas = $ClsEvaluaciones->getCantidadRespuestasIncorrectas();
    $total = $respuestasCorrectas + $respuestasIncorrectas;
    

    $porcentaje = $respuestasCorrectas * 100 / 20;

    if($porcentaje < 60 || $total < 20 ){
        header('location: ../cp_menu/menu.php');
    }

    $datos = $ClsUser->buscarUsuario();
    $dataEvaluacion=$ClsEvaluaciones->getEvaluacion();
    $token = uniqid();
    $ClsUser->diploma = $token;
    $ClsUser->updateDiploma();


    $nombre = utf8_decode( trim($datos[0]['PER_NOM1']) . ' ' . trim($datos[0]['PER_NOM2']) . ' ' . trim($datos[0]['PER_APE1']) . ' ' . trim($datos[0]['PER_APE2']) ); 
    $grado = formatearGrado(trim($datos[0]['GRA_DESC_LG']) , trim($datos[0]['GRA_CODIGO']) , trim($datos[0]['ARM_DESC_LG']) , trim($datos[0]['ARM_CODIGO']) );
    $catalogo = $datos[0]['PER_CATALOGO'];
    $evaluacion = $dataEvaluacion[0]['ID'];


    $pdf = new PDF_MC_Table('L','mm','Letter');
    $pdf->AddPage();
    $pdf->Image('../assets/img/border2.png', .5,.5,277.5,215,'PNG');
    $pdf->SetFont('Times','B',12);
    $pdf->SetTextColor(212,175,55);
    $pdf->Cell(130,5,utf8_decode('REPÚBLICA DE GUATEMALA'),0,0,'C');
    $pdf->Image('../assets/img/Divisa.png', 132.5,7,15,15,'PNG');
    $pdf->Image('../assets/img/lineas4.png', 75,10,130,30,'PNG');
    $pdf->Cell(130,5,utf8_decode('EJÉRCITO DE GUATEMALA'),0,1,'C');
    $pdf->SetFont('Times','',16);
    $pdf->Ln(25);
    $pdf->SetTextColor(0,0,0);
    $pdf->Cell(0,5,utf8_decode('LA COMANDANCIA DEL COMANDO DE INFORMÁTICA Y TECNOLOGÍA'),0,1,'C');
    $pdf->SetFont('Times','',12);
    $pdf->Ln(10);
    $pdf->Cell(0,5,utf8_decode('Otorga el presente'),0,1,'C');
    $pdf->SetFont('Times','B',40);
    $pdf->Ln(10);
    $pdf->SetTextColor(212,175,55);
    $pdf->Cell(0,5,utf8_decode('DIPLOMA'),0,1,'C');
    $pdf->SetFont('Times','',12);
    $pdf->Ln(10);
    $pdf->SetTextColor(0,0,0);
    $pdf->Cell(0,5,utf8_decode('Al:'),0,1,'C');
    $pdf->Ln(5);
    $pdf->SetFont('Times','B',16);
    $pdf->Cell(0,5,utf8_decode($grado),0,1,'C');
    $pdf->Ln(5);
    $pdf->Cell(0,5,utf8_decode($nombre),0,1,'C');
    $pdf->Ln(10);
    $pdf->Cell(55);
    $pdf->SetWidths([150]);
    $pdf->SetFont('Times','',14);
    $pdf->SetLineHeight(5);
    $pdf->Row([utf8_decode('Por haber aprobado satisfactoriamente el CURSO BÁSICO DE SEGURIDAD DE LA INFORMACIÓN, del Comando de Informática y Tecnología')], false, false);
    $pdf->Ln(10);
    $pdf->Cell(0,5,strftime('Guatemala, %d de %B de %Y'),0,1,'C');
    $pdf->Ln(12);
    
    $pdf->Image('http://localhost/cuestionario/cp_evaluaciones/qr.php?id=' . base64_encode( $token ), 122.5,165,35,35,'png');
    $pdf->SetFont('Times','',8);
    $pdf->Cell(0,5, utf8_decode('Este código solo puede ser validado una (01) vez'),0,0,'C');
    $pdf->Output();