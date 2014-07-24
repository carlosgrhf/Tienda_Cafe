<?php
// Inicializamos sesion 
session_start();
include('../lib/config.inc.php');
include('../lib/conectar.php');
include('../fun_fechas.php');
include('../fun_acentos.php');
include('../fun_acentosyespacios.php');

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
	<meta name="Description" content="Forma de pago - <?php echo $INC_descripcion; ?>" />
        <meta name="author" content="Hay Canal Web S.L." />
	<meta name="Language" content="es" />
	<meta name="Robots" content="index, follow" />
	<title>Forma de pago - <?php echo $INC_titulo; ?></title>
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
        <h1>Carrito de la Compra, confirma la forma de pago</h1><br />
        <p><strong>Número de pedido asignado:</strong> <?php echo $_SESSION[numero_pedido]; ?></p><br />
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
    <div class="limpiar"</div>
    <br /><h2>Confirmar forma de pago</h2><br />
    
    <!-- PAGO POR TRANSFERENCIA -->
    <div class="cuadrito_forma_pago">
        <div style="height: 45px;">
        <a href="http://www.bbva.es/TLBS/tlbs/esp/segmento/particulares/index.jsp" title="Más info BBVA" rel="external">
            <img src="<?php echo $INC_url; ?>/img/bbva.jpg" width="100">
        </a>
        </div>
        <h3>Transferencia</h3>
        <div style="text-align: right;">
        <form method="post" action="<?php echo $INC_url; ?>/carrito/pago_transferencia.php">
                
            
            <input type="submit" class="submit_class_carrito" style="width: 70px;" value="Confirmar" />
            

        </form><br />
        </div>        
        <p>Puedes pagar por transferencia bancaria. Trabajamos con BBVA y puedes acercarte a cualquiera de sus sucursales
        e ingresar el dinero personalmente. También puedes hacer una transferencia por Internet, consulta a tu banco habitual. Cuando confirmes
        esta opción te indicaremos nuestros datos bancarios.</p>       
    </div>
    
    <!-- PAGO POR TARJETA -->
    <div class="cuadrito_forma_pago">
        <div style="height: 45px;">
        <a href="http://www.visaeurope.es/es/su_tarjeta_visa/compre_en_internet_-_verified.aspx" title="Más info Verified by Visa" rel="external">
            <img src="<?php echo $INC_url; ?>/img/visa.jpg">
        </a>
        <a href="http://www.mastercard.com/us/personal/es/servicios/codigodeseguridad/" title="Más info Mastercard SecureCode" rel="external">
            <img src="<?php echo $INC_url; ?>/img/mastercard.jpg">
        </a>
        </div>
        <h3>Tarjeta</h3>
        <div style="text-align: right;">
        <form method="post" action="https://w3.grupobbva.com/TLPV/tlpv/TLPV_pub_RecepOpModeloServidor">
         <?php 
        //SACAMOS LA PALABRA CLAVE DE LA BASE DE DATOS PARA PODER COMUNICARNOS CON EL TPV VIRTUAL
        //sacamos los datos del pedido
        $sql = "SELECT * FROM palabratpv";
        if(!$result = $mysqli->query($sql)){
            die("Query invalido: " . $sql);
        }          
        /* fetch array asociativo*/
        while ($fila = $result->fetch_assoc()) {
            $pal_sec_ofuscada = utf8_encode($fila["palabratpv"]);
        }
        /* liberamos la memoria asociada al resultado */
        $result->close();
        
        
        //INICIAMOS LA PALABRA XOR QUE TAMBIEN NOS HARÁ FALTA
        $clave_xor = "loYtsnjeB86049319***";

        //DECODIFICAMOS LA PALABRA CLAVE
        $cad1_0 = "0";
        $cad2_0 = "00";
        $cad3_0 = "000";
        $cad4_0 = "0000";
        $cad5_0 = "00000";
        $cad6_0 = "000000";
        $cad7_0 = "0000000";
        $cad8_0 = "00000000";
        $pal_sec = "";

        $valor = rand (0, 99);
        $id_trans = date("mdHis").$valor;
        $localizador="1234567890";
        $numtarjeta=$_POST["bbva_number"];
        $fechacad="20" . $_POST["bbva_expires"];
        $importe = $_POST["card_total"];
        $trozos = explode (";", $pal_sec_ofuscada);
        $tope = count($trozos);

        for ($i=0; $i<$tope ; $i++)
        {
                $res = "";
                $pal_sec_ofus_bytes[$i] = decbin(hexdec($trozos[$i]));	
                if (strlen($pal_sec_ofus_bytes[$i]) == 7){ $pal_sec_ofus_bytes[$i] = $cad1_0.$pal_sec_ofus_bytes[$i]; }	
                if (strlen($pal_sec_ofus_bytes[$i]) == 6){ $pal_sec_ofus_bytes[$i] = $cad2_0.$pal_sec_ofus_bytes[$i]; }
                if (strlen($pal_sec_ofus_bytes[$i]) == 5){ $pal_sec_ofus_bytes[$i] = $cad3_0.$pal_sec_ofus_bytes[$i]; }
                if (strlen($pal_sec_ofus_bytes[$i]) == 4){ $pal_sec_ofus_bytes[$i] = $cad4_0.$pal_sec_ofus_bytes[$i]; }
                if (strlen($pal_sec_ofus_bytes[$i]) == 3){ $pal_sec_ofus_bytes[$i] = $cad5_0.$pal_sec_ofus_bytes[$i]; }
                if (strlen($pal_sec_ofus_bytes[$i]) == 2){ $pal_sec_ofus_bytes[$i] = $cad6_0.$pal_sec_ofus_bytes[$i]; }
                if (strlen($pal_sec_ofus_bytes[$i]) == 1){ $pal_sec_ofus_bytes[$i] = $cad7_0.$pal_sec_ofus_bytes[$i]; }
                $pal_sec_xor_bytes[$i] = decbin(ord($clave_xor[$i]));
                if (strlen($pal_sec_xor_bytes[$i]) == 7){ $pal_sec_xor_bytes[$i] = $cad1_0.$pal_sec_xor_bytes[$i]; }
                if (strlen($pal_sec_xor_bytes[$i]) == 6){ $pal_sec_xor_bytes[$i] = $cad2_0.$pal_sec_xor_bytes[$i]; }
                if (strlen($pal_sec_xor_bytes[$i]) == 5){ $pal_sec_xor_bytes[$i] = $cad3_0.$pal_sec_xor_bytes[$i]; }
                if (strlen($pal_sec_xor_bytes[$i]) == 4){ $pal_sec_xor_bytes[$i] = $cad4_0.$pal_sec_xor_bytes[$i]; }
                if (strlen($pal_sec_xor_bytes[$i]) == 3){ $pal_sec_xor_bytes[$i] = $cad5_0.$pal_sec_xor_bytes[$i]; }
                if (strlen($pal_sec_xor_bytes[$i]) == 2){ $pal_sec_xor_bytes[$i] = $cad6_0.$pal_sec_xor_bytes[$i]; }
                if (strlen($pal_sec_xor_bytes[$i]) == 1){ $pal_sec_xor_bytes[$i] = $cad7_0.$pal_sec_xor_bytes[$i]; }
                for ($j=0; $j<8; $j++)
                {
                        (string)$res .= (int)$pal_sec_ofus_bytes[$i][$j] ^ (int)$pal_sec_xor_bytes[$i][$j];
                }
                $xor[$i] = $res;
                $pal_sec .= chr(bindec($xor[$i]));
        }
        //YA TENEMOS LA VARIABLE $pal_sec QUE ES LA QUE BUSCABAMOS
        //////////////////////////////////////////////////////////////////////////////////////////////

        $idterminal="999999";
        $idcomercio="B8604931900001";
        $idtransaccion=$_SESSION[numero_pedido];
        $importe_noformateado=number_format($CPpreciototal, 2, '.', '');;
        $importe_formateado=$importe_noformateado*100;
        $moneda="978"; 

        $datosfirma = $idterminal.$idcomercio.$idtransaccion.$importe_formateado.$moneda.$pal_sec;
        $digest1 = sha1($datosfirma);
        $firma = strtoupper($digest1);

        $peticion='
        <tpv>
        <oppago>
                        <idterminal>999999</idterminal>
                        <idcomercio>'.$idcomercio.'</idcomercio>
                        <idtransaccion>'.$idtransaccion.'</idtransaccion>
                        <moneda>'.$moneda.'</moneda>
                        <importe>'.$importe_noformateado.'</importe>
                        <urlcomercio>'.$INC_url.'/carrito/tpv_respuesta.php</urlcomercio>
                        <idioma>es</idioma>
                        <pais>ES</pais>
                        <urlredir>'.$INC_url.'/carrito/carrito_tpv</urlredir>
                        <firma>'.$firma.'</firma>
        </oppago>
        </tpv>';
        ?>       
            <input type="hidden" name="peticion" value="<?php echo $peticion; ?>">
            <input type="submit" class="submit_class_carrito" style="width: 70px;" value="Confirmar" />
            

        </form>
        </div> 
        <p>Puedes pagar con tu tarjeta Visa o Mastercard siempre y cuando estén asociadas a los protocolos de seguridad Verified by Visa
        o Mastercard SecureCode. Pinchando en los logos recibirás más información. Si no sabes si tu tarjeta Visa o Mastercard están
        asociadas a estos protocolos de seguridad consulta a tu banco habitual.</p>
        
        
    </div>
    
    
    <!-- PAGO POR PAYPAL -->
    <div class="cuadrito_forma_pago">
        <div style="height: 45px;">
        <a href="https://www.paypal.com/es/cgi-bin/webscr?cmd=_home-general&nav=0" title="Más info Paypal" rel="external">
            <img src="<?php echo $INC_url; ?>/img/paypal.jpg" width="100">
        </a>
        </div>
        <h3>Paypal</h3>
        <div style="text-align: right;">
            <?php 
                //HAY QUE CREAR LAS VARIABLES DE SESSION PARA IR A PAYPAL Y VOLVER SIN PERDER LAS VARIABLES
                //VARIABLE DEL VALOR TOTAL DEL CARRITO
                $_SESSION["Payment_Amount"]=number_format($CPpreciototal, 2, '.', '');
                //$_SESSION["np"]=$np;
            ?>	
        <form method="post" action="<?php echo $INC_url; ?>/carrito/paypal_pagar.php">
                
            
            <input type="hidden" name="pago" value="paypal"/>
            <input type="submit" class="submit_class_carrito" style="width: 70px;" value="Confirmar" />
            

        </form>
        </div> 
        <p>Paypal es un medio de pago especializado en compras por Internet. Si tienes una cuenta Paypal podrás pagar con tu 
        usuario y contraseña de Paypal sin introducir más datos. Si no tienes cuenta Paypal y tampoco tienes tus tarjetas
        Visa y Mastercard securizadas puedes pagar con tu tarjeta habitual eligiendo esta opción y eligiendo después la opción
        tarjetas Visa y Mastercard.</p>
    </div>    
    
    
    <?php
    } else {//condicion si el carrito tiene 0 productos no muestra la tabla
        echo '<p>El carrito de la compra está vació.</p>';
    }
    ?>
    
    </div>       
</div> 
    <div class="limpiar"></div>    
</div> 
<?php include ("../pie.php"); ?>	
            
</body>
</html>