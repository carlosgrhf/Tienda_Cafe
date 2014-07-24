<?php
// Inicializamos sesion 
session_start();
include('../lib/config.inc.php');
include('../lib/conectar.php');


$CPid = utf8_decode(trim($_GET["CPid"]));
 

//BORRAR

$query = "DELETE FROM Carrito_Pedidos WHERE CPid=$CPid";
            $mysqli->query($query);
            
            
            $_SESSION[errores]="ok";
            $_SESSION[comentario]="Has borrado un pedido."; 
            
            //REDIRIGIR
header('Location: '.$INC_url.'/administrador/panel_administrador.php?var=9');
         



 
?>
