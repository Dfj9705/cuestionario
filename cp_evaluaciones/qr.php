<?php
    include_once '../assets/phpqrcode/qrlib.php';

    $id = $_GET['id'];

    $enlace = "http://localhost/cuestionario/cp_evaluaciones/validacion.php?id=$id";

    QRcode::png($enlace);