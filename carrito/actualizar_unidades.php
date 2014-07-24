<?php 
// Inicializamos sesion 
session_start();
include('../lib/config.inc.php');
include('../lib/conectar.php');
include('../fun_fechas.php');

//La sesión
$session = session_id();
$Pid=$_POST["Pid"]; //el id del producto viene por POST
$nueva_cantidad=$_POST["unidades"]; //las unidades que vienen por POST

//HAY QUE SACAR EL PRECIO TOTAL DEL CARRITO TEMPORAL PARA ACTUALIZARLO
//consultamos en la base de datos 
$sql = "SELECT * FROM Carrito_Temporal WHERE CT_Pid='$Pid' AND CTsesion='$session'";
if(!$result = $mysqli->query($sql)){
    die("Query invalido: " . $sql);
}
/* fetch array asociativo*/
while ($fila = $result->fetch_assoc()) {                
    $CTpreciounitario = utf8_encode($fila["CTpreciounitario"]);          

}
/* liberamos la memoria asociada al resultado */
$result->close();

//actualizamos el precio total
$CTpreciototal=$CTpreciounitario*$nueva_cantidad; 

//ACTUALIZAMOS LAS UNIDADES EN EL CARRITO
$query = "UPDATE Carrito_Temporal SET CTcantidad='$nueva_cantidad', CTpreciototal='$CTpreciototal' WHERE CT_Pid='$Pid' AND CTsesion='$session'";
$mysqli->query($query);    


header('Location: '.$INC_url.'/carrito/carrito_paso_uno');
?>