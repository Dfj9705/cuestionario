<?php

session_start();
$_SESSION = [];
session_destroy();

header('location: ../cp_menu/menu.php');
