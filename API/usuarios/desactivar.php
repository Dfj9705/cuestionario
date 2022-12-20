<?php
require '../../html_fns.php';
require '../../includes/headersAPI.php';

try {

    
} catch (PDOException $e) {
    echo $e->getMessage();
    exit;
}