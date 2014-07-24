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
	<meta name="Description" content="Resumen del pedido - <?php echo $INC_descripcion; ?>" />
        <meta name="author" content="Hay Canal Web S.L." />
	<meta name="Language" content="es" />
	<meta name="Robots" content="index, follow" />
	<title>Resumen del pedido - <?php echo $INC_titulo; ?></title>
        <!-- Llamadas a Estilos y Reset -->
	<link rel="stylesheet" type="text/css" href="<?php echo $INC_url; ?>/estilos/reset.css" /> 
        <link rel="stylesheet" type="text/css" href="<?php echo $INC_url; ?>/estilos/estilos.css" />
        <!-- Google Font -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700,300italic' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Fredericka+the+Great' rel='stylesheet' type='text/css'>
         
        <!-- External Links -->    
        <script type="text/javascript" src="<?php echo $INC_url; ?>/lib/external_links.js"></script>
        
        <script type="text/javascript">
                function cerrar() {
                    div = document.getElementById('flotante');
                    div.style.display='none';
                }
        </script>
            
</head>
<body>
<?php include_once("../analyticstracking.php") ?>   
<?php include ("../marco.php"); ?>
<div id="contenedor">
    <div id="central_producto">
        <h1>Carrito de la Compra, pedido completado</h1><br />
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
                    <span style="font-size:8pt; color:#fff;">'.$Pfamilia.' | '.$Psubfamilia.' | '.$Pfabricante.'</span>
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
    
    echo '<div style="float:left; width: 290px; margin-top:20px;">
      <br /><p><strong>Datos de facturación</strong></p><br />
      <ul class=lista_carrito_paso_dos>
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
    echo '<div style="float:left; width: 315px; height: 250px; background: #FBF7F1; padding-left:20px; padding-top: 18px; margin-top:20px; margin-left:20px;">
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
    
    echo '<div style="float:left; width: 315px; height: 250px; background: #382E2A; padding-left:20px; padding-top: 18px; margin-top:20px; margin-left:20px; color: #fff;">
      <br /><p><strong>Forma de pago y datos para realizar el pago</strong></p><br />
      <ul class=lista_carrito_paso_dos>
        <li><strong>Forma elegida:</strong> Transferencia</li>
        <li><strong>Estado:</strong> Pendiente</li>
        <li><strong>Banco:</strong> BBVA</li>
        <li><strong>Titular:</strong> Hay Canal Web SL (CafeenCapsula.com)</li> 
        <li><strong>Cuenta bancaria:</strong> 0182-2425-47-0201534374</li>   
        <li><strong>Cantidad a ingresar:</strong> '.number_format($CPpreciototal, 2, ",", "").' €</li>   
        <li><strong>Indicar número de pedido:</strong> '.$_SESSION[numero_pedido].'</li>
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