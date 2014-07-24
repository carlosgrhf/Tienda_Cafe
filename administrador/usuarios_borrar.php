<?php
// Inicializamos sesion 
session_start();
include('../lib/config.inc.php');
include('../lib/conectar.php');


$Aid_us = utf8_decode(trim($_GET["Aid_us"]));
 

//BORRAR

$query = "DELETE FROM Administrador WHERE Aid=$Aid_us";
            $mysqli->query($query);
            
            
            $_SESSION[errores]="ok";
            $_SESSION[comentario]="Has borrado el usuario."; 
            
            //REDIRIGIR
header('Location: '.$INC_url.'/administrador/panel_administrador.php?var=2');
         



 
?>
