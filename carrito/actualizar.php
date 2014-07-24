<?php 
// Inicializamos sesion 
session_start();
include('../lib/config.inc.php');
include('../lib/conectar.php');
include('../fun_fechas.php');

//esto hay que borrarlo
$_SESSION[id]=1;

$Pid=$_GET["Pid"]; //el id del producto viene por GET

//OBTENEMOS LOS DATOS DEL PRODUCTO
//consultamos en la base de datos 
$sql = "SELECT * FROM Productos WHERE Pid='$Pid' AND Pdesactivar='no'";
if(!$result = $mysqli->query($sql)){
    die("Query invalido: " . $sql);
}
/* fetch array asociativo*/
while ($fila = $result->fetch_assoc()) {                
    $Pid = utf8_encode($fila["Pid"]);
    $Preferencia = utf8_encode($fila["Preferencia"]);
    $Pnombre = utf8_encode($fila["Pnombre"]);
    $Pdescripcion = utf8_encode($fila["Pdescripcion"]);
    $Pfamilia = utf8_encode($fila["Pfamilia"]);
    $Psubfamilia = utf8_encode($fila["Psubfamilia"]);
    $Pfabricante = utf8_encode($fila["Pfabricante"]);
    $Pprecio = utf8_encode($fila["Pprecio"]);
    $Piva = utf8_encode($fila["Piva"]);
    $Pdestacado = utf8_encode($fila["Pdestacado"]);
    $Poferta = utf8_encode($fila["Poferta"]);
    $Pimagenuno = utf8_encode($fila["Pimagenuno"]);
    $Pimagendos = utf8_encode($fila["Pimagendos"]);
    $Pimagentres = utf8_encode($fila["Pimagentres"]);
    $Pvecescomprado = utf8_encode($fila["Pvecescomprado"]);
    $Pdesactivar = utf8_encode($fila["Pdesactivar"]); 
    $Pobservaciones = utf8_encode($fila["Pobservaciones"]);  

    $precioconiva=$Pprecio+$Piva;        

}
/* liberamos la memoria asociada al resultado */
$result->close();

//OBTENEMOS LOS DATOS DEL USUARIO
//consultamos en la base de datos 
$sql = "SELECT * FROM Usuarios WHERE Uid='$_SESSION[id]'";
if(!$result = $mysqli->query($sql)){
    die("Query invalido: " . $sql);
}
/* fetch array asociativo*/
while ($fila = $result->fetch_assoc()) {                
    $Uid = utf8_encode($fila["Uid"]);        

}
/* liberamos la memoria asociada al resultado */
$result->close();


//GUARDAMOS EL ID DE LA SESION
$session = session_id();

// GUARDAMOS LA FECHA
$fecha = date("Y-m-d");

// INSERTAMOS 1 UNIDAD POR DEFECTO
$unidades = 1;


//SACAMOS LOS PRODUCTOS DEL CARRITO TEMPORAL PARA COMPROBAR QUE NO ESTÁ AÑADIDO YA EL PRODUCTO
//consultamos en la base de datos 
$sql = "SELECT * FROM Carrito_Temporal WHERE CT_Pid='$Pid' AND CTsesion='$session'";
if(!$result = $mysqli->query($sql)){
    die("Query invalido: " . $sql);
}
/* fetch array asociativo*/
while ($fila = $result->fetch_assoc()) {                
    $CTid = utf8_encode($fila["CTid"]);
}
/* liberamos la memoria asociada al resultado */
$result->close();

if($CTid != ""){
    $comprobacion = 0;//el producto ya está en la cesta
}else{
    $comprobacion = 1;//no tenemos a ese producto en la cesta
}



//INSERTAMOS EL PRODUCTO EN EL CARRITO TEMPORAL
if($Pid!="" AND $comprobacion == 1){
    $query = "INSERT INTO Carrito_Temporal (CT_Uid,CT_Pid,CTsesion,CTcantidad,CTpreciototal,CTfecha,CTpreciounitario) 
                  VALUES ('$Uid', '$Pid', '$session', '$unidades', '$precioconiva', '$fecha', '$precioconiva')";
    $mysqli->query($query);
    
}

$_SESSION[errores]="ok";
$_SESSION[comentario]='Has añadido un producto al <a href="'.$INC_url.'/carrito/carrito_paso_uno" title="Ver el carrito"><strong>carrito</strong></a>.';

//DE DONDE VIENE EL USUARIO??
    $dedonde=$_SERVER['HTTP_REFERER'];

//REDIRIGIR
header('Location: '.$dedonde.'');
?>