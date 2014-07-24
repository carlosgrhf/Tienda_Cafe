<?php
// Inicializamos sesion 
session_start();
include('../lib/config.inc.php');
include('../lib/conectar.php');
include('../fun_fechas.php');
include('../fun_acentos.php');
include('../fun_acentosyespacios.php');


/*==================================================================
 PayPal Express Checkout Call
 ===================================================================
*/
// Check to see if the Request object contains a variable named 'token'	
$token = "";
if (isset($_REQUEST['token']))
{
	$token = $_REQUEST['token'];
	
}

// If the Request object contains the variable 'token' then it means that the user is coming from PayPal site.	
if ( $token != "" )
{

	require_once ("paypalfunctions.php");

	/*
	'------------------------------------
	' Calls the GetExpressCheckoutDetails API call
	'
	' The GetShippingDetails function is defined in PayPalFunctions.jsp
	' included at the top of this file.
	'-------------------------------------------------
	*/
	

	$resArray = GetShippingDetails( $token );
	$ack = strtoupper($resArray["ACK"]);
	if( $ack == "SUCCESS" || $ack == "SUCESSWITHWARNING") 
	{
		/*
		' The information that is returned by the GetExpressCheckoutDetails call should be integrated by the partner into his Order Review 
		' page		
		*/
		$email 				= $resArray["EMAIL"]; // ' Email address of payer.
		$payerId 			= $resArray["PAYERID"]; // ' Unique PayPal customer account identification number.
		$payerStatus		= $resArray["PAYERSTATUS"]; // ' Status of payer. Character length and limitations: 10 single-byte alphabetic characters.
		$salutation			= $resArray["SALUTATION"]; // ' Payer's salutation.
		$firstName			= $resArray["FIRSTNAME"]; // ' Payer's first name.
		$middleName			= $resArray["MIDDLENAME"]; // ' Payer's middle name.
		$lastName			= $resArray["LASTNAME"]; // ' Payer's last name.
		$suffix				= $resArray["SUFFIX"]; // ' Payer's suffix.
		$cntryCode			= $resArray["COUNTRYCODE"]; // ' Payer's country of residence in the form of ISO standard 3166 two-character country codes.
		$business			= $resArray["BUSINESS"]; // ' Payer's business name.
		$shipToName			= $resArray["PAYMENTREQUEST_0_SHIPTONAME"]; // ' Person's name associated with this address.
		$shipToStreet		= $resArray["PAYMENTREQUEST_0_SHIPTOSTREET"]; // ' First street address.
		$shipToStreet2		= $resArray["PAYMENTREQUEST_0_SHIPTOSTREET2"]; // ' Second street address.
		$shipToCity			= $resArray["PAYMENTREQUEST_0_SHIPTOCITY"]; // ' Name of city.
		$shipToState		= $resArray["PAYMENTREQUEST_0_SHIPTOSTATE"]; // ' State or province
		$shipToCntryCode	= $resArray["PAYMENTREQUEST_0_SHIPTOCOUNTRYCODE"]; // ' Country code. 
		$shipToZip			= $resArray["PAYMENTREQUEST_0_SHIPTOZIP"]; // ' U.S. Zip code or other country-specific postal code.
		$addressStatus 		= $resArray["ADDRESSSTATUS"]; // ' Status of street address on file with PayPal   
		$invoiceNumber		= $resArray["INVNUM"]; // ' Your own invoice or tracking number, as set by you in the element of the same name in SetExpressCheckout request .
		$phonNumber			= $resArray["PHONENUM"]; // ' Payer's contact telephone number. Note:  PayPal returns a contact telephone number only if your Merchant account profile settings require that the buyer enter one. 
	} 
	else  
	{
		//Display a user friendly Error on the page using any of the following error information returned by PayPal
		$ErrorCode = urldecode($resArray["L_ERRORCODE0"]);
		$ErrorShortMsg = urldecode($resArray["L_SHORTMESSAGE0"]);
		$ErrorLongMsg = urldecode($resArray["L_LONGMESSAGE0"]);
		$ErrorSeverityCode = urldecode($resArray["L_SEVERITYCODE0"]);
		
		echo "GetExpressCheckoutDetails API call failed. ";
		echo "Detailed Error Message: " . $ErrorLongMsg;
		echo "Short Error Message: " . $ErrorShortMsg;
		echo "Error Code: " . $ErrorCode;
		echo "Error Severity Code: " . $ErrorSeverityCode;
	}
}

//iniciamos las variables totales
$total_cantidad_carrito=0;
$total_carrito=0;

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
        $Uempresa = utf8_encode($fila["Uempresa"]);
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
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo $INC_url; ?>/favicon.ico" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="Keywords" content="Dirección de envío - <?php echo $INC_palabras; ?>" />
	<meta name="Description" content="Confirmar pago con Paypal - <?php echo $INC_descripcion; ?>" />
        <meta name="author" content="Hay Canal Web S.L." />
	<meta name="Language" content="es" />
	<meta name="Robots" content="index, follow" />
	<title>Confirmar pago con Paypal - <?php echo $INC_titulo; ?></title>
        <!-- Llamadas a Estilos y Reset -->
	<link rel="stylesheet" type="text/css" href="<?php echo $INC_url; ?>/estilos/reset.css" /> 
        <link rel="stylesheet" type="text/css" href="<?php echo $INC_url; ?>/estilos/estilos.css" />
        <!-- Google Font -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700,300italic' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Fredericka+the+Great' rel='stylesheet' type='text/css'>
         
        <!-- External Links -->    
        <script type="text/javascript" src="<?php echo $INC_url; ?>/lib/external_links.js"></script>
            
</head>
<body>
<?php include_once("../analyticstracking.php") ?>   
<?php include ("../marco.php"); ?>
<div id="contenedor">
    <div id="central_producto">
        <h1>Carrito de la Compra, confirma el pago con Paypal</h1><br />
        <p>Número de pedido asignado: <?php echo $_SESSION[numero_pedido]; ?></p><br />
    <?php
    //GUARDAMOS EL ID DE LA SESION
    $session = session_id();
    
    $sql = "SELECT * FROM Carrito_Pedidos_Detalle WHERE CPD_CPid = '$_SESSION[numero_pedido]'";
        if(!$result = $mysqli->query($sql)){
            die("Query invalido: " . $sql);
        }          
        $total_registros = $result->num_rows;
        /* liberamos la memoria asociada al resultado */
        $result->close();
    
    if($total_registros>0){         
    
    echo '
        <table class="tabla">
        <caption>Número total de productos en tu carrito: '.$total_registros.'</caption>
        <thead>
        <tr>
        <th style="width:35%;">Producto</th>
        <th style="width:15%;">PVP</th>
        <th style="width:25%;">Unidades</th>
        <th style="width:15%;">Total</th>
        <th style="width:10%;">Borrar</th>
        </tr>
        </thead>
        <tbody>
        
        
            
        

    ';
    //consultamos en la base de datos 
    $sql = "SELECT * FROM Carrito_Pedidos_Detalle WHERE CPD_CPid = '$_SESSION[numero_pedido]'";
    if(!$result = $mysqli->query($sql)){
        die("Query invalido: " . $sql);
    }
    /* fetch array asociativo*/
    while ($fila = $result->fetch_assoc()) {                
        $CPDid = utf8_encode($fila["CPDid"]);
        $CPD_CPid = utf8_encode($fila["CPD_CPid"]);
        $CPD_Pid = utf8_encode($fila["CPD_Pid"]);
        $CPDcantidad = utf8_encode($fila["CPDcantidad"]);
        $CPDpreciototal = utf8_encode($fila["CPDpreciototal"]);        
        $CPDpreciounitario = utf8_encode($fila["CPDpreciounitario"]);
        $CPDprecioiva = utf8_encode($fila["CPDprecioiva"]);
        $CPD_Vid = utf8_encode($fila["CPD_Vid"]);
        
        if($CPD_Vid!="" AND $CPD_Vid!=0) {
            $idvale=$CPD_Vid;
        }
        
        //sumamos los totales
        $total_cantidad_carrito=$total_cantidad_carrito+$CPDcantidad;
        
        //Hay que sacar el nombre del producto que no está en el carrito temporal
        //consultamos en la base de datos 
        $sql2 = "SELECT * FROM Productos WHERE Pid='$CPD_Pid'";
        if(!$result2 = $mysqli->query($sql2)){
            die("Query invalido: " . $sql2);
        }
        /* fetch array asociativo*/
        while ($fila2 = $result2->fetch_assoc()) {                
            $Pnombre = utf8_encode($fila2["Pnombre"]);
            $Pfamilia = utf8_encode($fila2["Pfamilia"]);
            $Psubfamilia = utf8_encode($fila2["Psubfamilia"]);
            $Pfabricante = utf8_encode($fila2["Pfabricante"]);
        }
        /* liberamos la memoria asociada al resultado */
        $result2->close();
        
        echo '
            <tr>
                <td>
                    '.$Pnombre.'<br />
                    <span style="font-size:10pt;">'.$Pfamilia.' | '.$Psubfamilia.' | '.$Pfabricante.'</span>
                </td>
                <td>'.number_format($CPDpreciounitario, 2, ",", "").' €</td>
                <td>'.$CPDcantidad.'</td>
                <td>'.number_format($CPDpreciototal, 2, ",", "").' €</td>
                <td></td>
            </tr>
        ';
    }
    /* liberamos la memoria asociada al resultado */
    $result->close();
    
    if($CPvale=="si"){ 
        //consultamos en la base de datos 
        $sql = "SELECT * FROM Vales WHERE Vid='$idvale'";
        if(!$result = $mysqli->query($sql)){
            die("Query invalido: " . $sql);
        }
        /* fetch array asociativo*/
        while ($fila = $result->fetch_assoc()) { 
            $Vvale = utf8_encode($fila["Vvale"]);
            $Vvalor = utf8_encode($fila["Vvalor"]);
        }
        /* liberamos la memoria asociada al resultado */
        $result->close();
        
        echo '
        <tr>
                <td>Código promocional</td>
                <td>'.$Vvale.'</td>
                <td></td>
                <td>- '.$Vvalor.' %</td>
                <td>
                </td>
        </tr>';
    }
    
    echo '
        <tr>
                <td>Gastos de envío</td>
                <td></td>
                <td></td>
                <td>'.number_format($CPportes, 2, ",", "").' €</td>
                <td></td>
        </tr>
        <tr class="total">
                <td></td>
                <td>Total</td>
                <td>'.$total_cantidad_carrito.'</td>
                <td>'.number_format($CPpreciototal, 2, ",", "").' €</td>
                <td>Iva incluido</td>
        </tr>
        </tbody>
        </table>
    ';
    
    echo '<p style="font-size:22px; background: #FBF7F1; margin-top: 10px; padding: 10px;">
            <a href="'.$INC_url.'/carrito/carrito_paso_cinco_paypal" >
                    <strong>Confirma el pago con Paypal</strong>
            </a>
          </p>';
    
    echo '
            <div style="float:left; width: 290px; margin-top:20px;">
      <br /><p><strong>Datos de facturación</strong></p><br />
      <ul class=lista_carrito_paso_dos>
        <li><strong>Empresa:</strong> '.$Uempresa.'</li>
        <li><strong>Nombre:</strong> '.$Unombre.' '.$Uapellidos.'</li>
        <li><strong>Dni/Cif:</strong> '.$Udnicif.'</li>
        <li><strong>Email:</strong> '.$Uemail.'</li>
        <li><strong>Teléfono:</strong> '.$Utlf.'</li>
        <li><strong>Dirección:</strong> '.$Udireccion.'</li>
        <li><strong>Código Postal:</strong> '.$Ucp.'</li>   
        <li><strong>Localidad:</strong> '.$Ulocalidad.'</li>   
        <li><strong>Provincia:</strong> '.$Uprovincia.'</li>
        <li><strong>País:</strong> '.$Upais.'</li> 
      </ul><br /></div>
    ';
    echo '
        <div style="float:right; width: 690px; height: 250px; background: #FBF7F1; padding-left:20px; padding-top: 18px; margin-top:20px;">
      <br /><p><strong>Datos de envío</strong></p><br />
      <ul class=lista_carrito_paso_dos>
        <li><strong>Nombre:</strong> '.$CPnombreenvio.' '.$CPapellidosenvio.'</li>
        <li><strong>Dirección:</strong> '.$CPdireccionenvio.'</li>
        <li><strong>Código Postal:</strong> '.$CPcpenvio.'</li>   
        <li><strong>Localidad:</strong> '.$CPlocalidadenvio.'</li>   
        <li><strong>Provincia:</strong> '.$CPprovinciaenvio.'</li>
        <li><strong>País:</strong> '.$CPpaisenvio.'</li> 
      </ul><br /></div>
    ';
    ?>
    
         
    
    
    <?php
    } else {//condicion si el carrito tiene 0 productos no muestra la tabla
        echo '<p>El carrito de la compra está vació.</p>';
    }
    ?>
    
    </div> 
    <div class="limpiar"></div>    
</div> 
<?php include ("../pie.php"); ?>	
            
</body>
</html>