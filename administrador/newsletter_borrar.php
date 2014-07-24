<?php
// Inicializamos sesion 
session_start();
include('../lib/config.inc.php');
include('../lib/conectar.php');


$NEWid = utf8_decode(trim($_GET["NEWid"]));
 

//BORRAR

$query = "DELETE FROM Newsletter WHERE NEWid=$NEWid";
            $mysqli->query($query);
            
            
            $_SESSION[errores]="ok";
            $_SESSION[comentario]="Has borrado el usuario."; 
            
            //REDIRIGIR
header('Location: '.$INC_url.'/administrador/panel_administrador.php?var=20');
         



 
?>
