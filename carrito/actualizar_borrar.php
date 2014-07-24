<?php 
// Inicializamos sesion 
session_start();
include('../lib/config.inc.php');
include('../lib/conectar.php');
include('../fun_fechas.php');

//La sesión
$session = session_id();
$Pid=$_GET["Pid"]; //el id del producto viene por POST


//ACTUALIZAMOS LAS UNIDADES EN EL CARRITO
$query = "DELETE FROM Carrito_Temporal WHERE CT_Pid='$Pid' AND CTsesion='$session'";
$mysqli->query($query);    


header('Location: '.$INC_url.'/carrito/carrito_paso_uno');
?>