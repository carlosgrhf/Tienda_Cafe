<?php
// Inicializamos sesion 
session_start();
include('../lib/config.inc.php');
include('../lib/conectar.php');


$PAid = utf8_decode(trim($_GET["PAid"]));
 

//BORRAR

$query = "DELETE FROM Paginas WHERE PAid=$PAid";
            $mysqli->query($query);
            
            
            $_SESSION[errores]="ok";
            $_SESSION[comentario]="Has borrado la página."; 
            
            //REDIRIGIR
header('Location: '.$INC_url.'/administrador/panel_administrador.php?var=3');
         



 
?>
