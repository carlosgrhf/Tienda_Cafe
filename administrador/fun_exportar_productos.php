<?php
// Inicializamos sesion 
session_start();
include('../lib/config.inc.php');
include('../lib/conectar.php');
include('fun_fechas.php');

header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");  
header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");  
header ("Cache-Control: no-cache, must-revalidate");  
header ("Pragma: no-cache");  
header ("Content-type: application/x-msexcel");  
header ("Content-Disposition: attachment; filename=\"exportacion.xls\"" );


echo "id\treferencia\tnombre\tdescripcion\tfamilia\tsubfamilia\tfabricante\tprecio\tiva\tdestacado\toferta\tvecescomprado\tdesactivar\tobservaciones\tidioma\n";

$inicio=$_POST["inicio"];
$cantidadregistros=$_POST["cantidadregistros"];


$sql = "SELECT * FROM Productos LIMIT ".$inicio.",".$cantidadregistros." ";
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
    $Pvecescomprado = utf8_encode($fila["Pvecescomprado"]);
    $Pdesactivar = utf8_encode($fila["Pdesactivar"]);
    $Pobservaciones = utf8_encode($fila["Pobservaciones"]);
    

    echo "$Pid\t$Preferencia\t$Pnombre\t$Pdescripcion\t$Pfamilia\t$Psubfamilia\t$Pfabricante\t$Pprecio\t$Piva\t$Pdestacado\t$Poferta\t$Pvecescomprado\t$Pdesactivar\t$Pobservaciones\n";
    

}
/* liberamos la memoria asociada al resultado */
$result->close();
    
    
    

?>
