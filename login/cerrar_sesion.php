<?php 
// Inicializamos sesion 
session_start();
include('../lib/config.inc.php');

// Borramos toda la sesion
session_destroy();
session_unset();   
header('Location: '.$INC_url.'');
?>