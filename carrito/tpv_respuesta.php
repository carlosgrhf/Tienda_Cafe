<?php 
// Inicializamos sesion 
session_start();
include('../lib/config.inc.php');
include('../lib/conectar.php');
include('../fun_fechas.php');
include('../fun_acentos.php');
include('../fun_acentosyespacios.php');


//sacamos los datos del pedido
$sql = "SELECT * FROM Carrito_Pedidos WHERE CPid='$_SESSION[numero_pedido]' ";
if(!$result = $mysqli->query($sql)){
    die("Query invalido: " . $sql);
}          
/* fetch array asociativo*/
while ($fila = $result->fetch_assoc()) {
    $CPid = utf8_encode($fila["CPid"]);
    $CP_Uid = utf8_encode($fila["CP_Uid"]);
    $CPnombreenvio = utf8_encode($fila["CPnombreenvio"]);
    $CPapellidosenvio = utf8_encode($fila["CPapellidosenvio"]);
    $CPdireccionenvio = utf8_encode($fila["CPdireccionenvio"]);
    $CPcpenvio = utf8_encode($fila["CPcpenvio"]);
    $CPlocalidadenvio = utf8_encode($fila["CPlocalidadenvio"]);
    $CPprovinciaenvio = utf8_encode($fila["CPprovinciaenvio"]);
    $CPpaisenvio = utf8_encode($fila["CPpaisenvio"]);
    $CPportes = utf8_encode($fila["CPportes"]);
    $CPivatotal = utf8_encode($fila["CPivatotal"]);
    $CPtotalsiniva = utf8_encode($fila["CPtotalsiniva"]);
    $CPpreciototal = utf8_encode($fila["CPpreciototal"]);
    $CPfecha = utf8_encode($fila["CPfecha"]);
    $CPformadepago = utf8_encode($fila["CPformadepago"]);
    $CPpagado = utf8_encode($fila["CPpagado"]);
    $CPestado = utf8_encode($fila["CPestado"]);    
    $CPvale = utf8_encode($fila["CPvale"]);
}
/* liberamos la memoria asociada al resultado */
$result->close();

//sacamos los datos del usuario
$sql = "SELECT * FROM Usuarios WHERE Uid='$_SESSION[Uidacceso]' ";
    if(!$result = $mysqli->query($sql)){
        die("Query invalido: " . $sql);
    }          
    /* fetch array asociativo*/
    while ($fila = $result->fetch_assoc()) {
        $Uid = utf8_encode($fila["Uid"]);
        $Unombre = utf8_encode($fila["Unombre"]);
        $Uapellidos = utf8_encode($fila["Uapellidos"]);
        $Udnicif = utf8_encode($fila["Udnicif"]);
        $Udireccion = utf8_encode($fila["Udireccion"]);
        $Ucp = utf8_encode($fila["Ucp"]);
        $Ulocalidad = utf8_encode($fila["Ulocalidad"]);
        $Uprovincia = utf8_encode($fila["Uprovincia"]);
        $Upais = utf8_encode($fila["Upais"]);
        $Utlf = utf8_encode($fila["Utlf"]);
        $Uemail = utf8_encode($fila["Uemail"]);
        $Ucondiciones = utf8_encode($fila["Ucondiciones"]);
        $Unews = utf8_encode($fila["Unews"]);
        $Utipo = utf8_encode($fila["Utipo"]);
        $Upassword = utf8_encode($fila["Upassword"]);
        $Uvalidado = utf8_encode($fila["Uvalidado"]);
        $Unumerocompras = utf8_encode($fila["Unumerocompras"]);
        $Ufechaultimacompra = utf8_encode($fila["Ufechaultimacompra"]);

    }
    /* liberamos la memoria asociada al resultado */
    $result->close();


//LEEMOS EL CONTENIDO XML QUE NOS MANDA EL BANCO
		$xml = simplexml_load_string($peticion);
                for($i=0; $i<count($xml->respago); $i++){
    		
        	$order_id = $xml->respago[$i]->idtransaccion;
        	$importe = $xml->respago[$i]->importe;
        	$moneda = $xml->respago[$i]->moneda;
        	$estado = $xml->respago[$i]->estado;
        	$pagada_descripcion = $xml->respago[$i]->coderror;
        	$codautorizacion = $xml->respago[$i]->codautorizacion;
        	$descripcion_error = $xml->respago[$i]->deserror;
        	$firma_suya = $xml->respago[$i]->firma;
        	
        	if ($estado=='2'){
        		$pagado="si";
        	} else {
        		$pagado="no";
        	}
        	
        	if ($descripcion_error=="") $descripcion_error="Sin observaciones";
                
                $observaciones=''.$pagada_descripcion.' | '.$descripcion_error.'';
        	//ACTUALIZAR      
                $query = "UPDATE Carrito_Pedidos SET 
                            CPformapago='tarjeta',
                            CPpagado='".$pagado."', 
                            CPobservaciones='".$observaciones."'
                            WHERE CPid=".$order_id."";
                            $mysqli->query($query);            
        	
		}
                
                    
         
        
        
         
        
        
?>
