<?php
// Inicializamos sesion 
session_start();
include('../lib/config.inc.php');
include('../lib/conectar.php');


$Uid = utf8_decode(trim($_GET["Uid"]));
 

//BORRAR

$query = "DELETE FROM Usuarios WHERE Uid=$Uid";
            $mysqli->query($query);
            
            
            $_SESSION[errores]="ok";
            $_SESSION[comentario]="Has borrado un cliente."; 
            
            //REDIRIGIR
header('Location: '.$INC_url.'/administrador/panel_administrador.php?var=8');
         



 
?>
