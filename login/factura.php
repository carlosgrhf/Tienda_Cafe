<?php
// Inicializamos sesion 
session_start();
include('../lib/config.inc.php');
include('../lib/conectar.php');
include('fun_fechas.php');

// Comprobamos si existe la variable
if ( empty ( $_SESSION["Uidacceso"] ) ) 	// Si no existe
    header('Location: '.$INC_url.'');



//recogemos el id de la factura
$Fid=$_GET[Fid];

$sql = "SELECT * FROM Facturas WHERE Fid='$Fid'";
if(!$result = $mysqli->query($sql)){
    die("Query invalido: " . $sql);
}          
/* fetch array asociativo*/
while ($fila = $result->fetch_assoc()) {
    $Fid = utf8_encode($fila["Fid"]);
    $F_CPid = utf8_encode($fila["F_CPid"]);
    $F_Uid = utf8_encode($fila["F_Uid"]);
    $Fnumero = utf8_encode($fila["Fnumero"]);
    $Ffecha = cambiaf_a_normal(utf8_encode($fila["Ffecha"]));
    $F_Uempresa = utf8_encode($fila["F_Uempresa"]);
    $F_Unombre = utf8_encode($fila["F_Unombre"]);
    $F_Uapellidos = utf8_encode($fila["F_Uapellidos"]);
    $F_Udnicif = utf8_encode($fila["F_Udnicif"]);
    $F_Udireccion = utf8_encode($fila["F_Udireccion"]);
    $F_Ucp = utf8_encode($fila["F_Ucp"]);
    $F_Ulocalidad = utf8_encode($fila["F_Ulocalidad"]);
    $F_Uprovincia = utf8_encode($fila["F_Uprovincia"]);
    $F_Upais = utf8_encode($fila["F_Upais"]);
    $F_Unombreenvio = utf8_encode($fila["F_Unombreenvio"]);
    $F_Uapellidosenvio = utf8_encode($fila["F_Uapellidosenvio"]);
    $F_Udireccionenvio = utf8_encode($fila["F_Udireccionenvio"]);
    $F_Ucpenvio = utf8_encode($fila["F_Ucpenvio"]);
    $F_Ulocalidadenvio = utf8_encode($fila["F_Ulocalidadenvio"]);
    $F_Uprovinciaenvio = utf8_encode($fila["F_Uprovinciaenvio"]);
    $F_Upaisenvio = utf8_encode($fila["F_Upaisenvio"]);
    $Fportes = utf8_encode($fila["Fportes"]);
    $Fivatotal = utf8_encode($fila["Fivatotal"]);
    $Ftotalsiniva= utf8_encode($fila["Ftotalsiniva"]);
    $Fformapago = utf8_encode($fila["Fformapago"]);
    $Fpreciototal = utf8_encode($fila["Fpreciototal"]);    
    $Fvale = utf8_encode($fila["Fvale"]);
}
/* liberamos la memoria asociada al resultado */
$result->close();	

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="Keywords" content="cafe, capsula, capsulas, tienda" />
	<meta name="Description" content="Factura de la tienda Cafe en Capsula" />
        <meta name="author" content="Hay Canal Web S.L." />
	<meta name="Language" content="es" />
	<meta name="Robots" content="index, follow" />
	<title>Factura <?php echo $Fnumero; ?></title>
        <!-- Llamadas a Estilos y Reset -->
	<link rel="stylesheet" type="text/css" href="<?php echo $INC_url; ?>/estilos/reset.css" /> 
        <link rel="stylesheet" type="text/css" href="<?php echo $INC_url; ?>/estilos/estilos_factura.css" />
        
        <!-- Google Font -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700,300italic' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Fredericka+the+Great' rel='stylesheet' type='text/css'>
</head>
<body>
    
<div id="contenedor">
    <div id="marco_logo">            
                <p>Café en Cápsula</p>
        </div>
    <h1>FACTURA <?php echo $Fnumero; ?></h1>
    <ul class="lista1">
        <li><strong>Datos del cliente</strong></li>
        <li><strong>Empresa:</strong> <?php echo $F_Uempresa; ?></li>
        <li><strong>Nombre:</strong> <?php echo $F_Unombreenvio; ?></li>
        <li><strong>Apellidos:</strong> <?php echo $F_Uapellidosenvio; ?></li>
        <li><strong>DNI/CIF:</strong> <?php echo $F_Udnicif; ?></li>
        <li><strong>Direccion:</strong> <?php echo $F_Udireccion; ?></li>
        <li><strong>Código postal:</strong> <?php echo $F_Ucp; ?></li>
        <li><strong>Localidad:</strong> <?php echo $F_Ulocalidad; ?></li>
        <li><strong>Provincia:</strong> <?php echo $F_Uprovincia; ?></li>
        <li><strong>País:</strong> <?php echo $F_Upais; ?></li>
    </ul>

    <ul class="lista2">
        <li><strong>Datos de envio</strong></li>
        <li><strong>Nombre:</strong> <?php echo $F_Unombreenvio; ?></li>
        <li><strong>Apellidos:</strong> <?php echo $F_Uapellidosenvio; ?></li>
        <li><strong>Dirección:</strong> <?php echo $F_Udireccionenvio; ?></li>
        <li><strong>Código postal:</strong> <?php echo $F_Ucpenvio; ?></li>
        <li><strong>Localidad:</strong> <?php echo $F_Ulocalidadenvio; ?></li>
        <li><strong>Provincia:</strong> <?php echo $F_Uprovinciaenvio; ?></li>
        <li><strong>País:</strong> <?php echo $F_Upaisenvio; ?></li>
    </ul>
    <div class="limpiar"></div>
    <p>FECHA: <strong><?php echo $Ffecha; ?></strong> FORMA DE PAGO: <strong><?php echo $Fformapago; ?></strong></p><br />


    <table class="tabla">
    <thead>
    <tr>
    <th>Ref.</th>
    <th>Nombre</th>
    <th>PVP</th>
    <th>Cantidad</th>
    <th>Total</th>
    </tr>
    </thead>
    <tbody>
                
                <?php
                $sql = "SELECT * FROM Facturas_Detalle WHERE FD_Fid='$Fid' ORDER BY FDid asc";
                if(!$result = $mysqli->query($sql)){
                    die("Query invalido: " . $sql);
                }          
                /* fetch array asociativo*/
                while ($fila = $result->fetch_assoc()) {
                    $FDid = utf8_encode($fila["FDid"]);
                    $FD_Fid = utf8_encode($fila["FD_Fid"]);
                    $FD_Pid = utf8_encode($fila["FD_Pid"]);
                    $FDcantidad = utf8_encode($fila["FDcantidad"]);
                    $FDpreciototal = utf8_encode($fila["FDpreciototal"]);
                    $FDpreciounitario = utf8_encode($fila["FDpreciounitario"]);
                    $FDprecioivaind = utf8_encode($fila["FDprecioivaind"]);
                    
                    $sql2 = "SELECT * FROM Productos WHERE Pid='$FD_Pid'";
                    if(!$result2 = $mysqli->query($sql2)){
                        die("Query invalido: " . $sql2);
                    }          
                    /* fetch array asociativo*/
                    while ($fila2 = $result2->fetch_assoc()) {
                        $Pid = utf8_encode($fila2["Pid"]);
                        $Preferencia = utf8_encode($fila2["Preferencia"]);
                        $Pnombre = utf8_encode($fila2["Pnombre"]);
                        $Pdescripcion = utf8_encode($fila2["Pdescripcion"]);
                        $Pfamilia = utf8_encode($fila2["Pfamilia"]);
                        $Psubfamilia = utf8_encode($fila2["Psubfamilia"]);
                        $Pfabricante = utf8_encode($fila2["Pfabricante"]);
                        $Pprecio = utf8_encode($fila2["Pprecio"]);
                        $Piva = utf8_encode($fila2["Piva"]);
                        $Pdestacado = utf8_encode($fila2["Pdestacado"]);
                        $Poferta = utf8_encode($fila2["Poferta"]);
                        $Pimagenuno = utf8_encode($fila2["Pimagenuno"]);
                        $Pimagendos = utf8_encode($fila2["Pimagendos"]);
                        $Pimagentres = utf8_encode($fila2["Pimagentres"]);
                        $Pvecescomprado = utf8_encode($fila2["Pvecescomprado"]);
                        $Pdesactivar = utf8_encode($fila2["Pdesactivar"]);
                        $Pobservaciones = utf8_encode($fila2["Pobservaciones"]);
                        
                        echo '
                            <tr>
                                <td>'.$Preferencia.'</td>
                                <td>'.$Pnombre.'</td>
                                <td>'.number_format($FDpreciounitario, 2, ",", "").' €</td>
                                <td>'.$FDcantidad.'</td>
                                <td>'.number_format($FDpreciototal, 2, ",", "").' €</td>
                            </tr>
                        ';
                        
                    }      
                    /* liberamos la memoria asociada al resultado */
                    $result2->close();
                    
                    
                }
                /* liberamos la memoria asociada al resultado */
                $result->close();
                
                if($Fvale!=""){
                    
                    //consultamos en la base de datos 
                    $sql = "SELECT * FROM Vales WHERE Vid='$Fvale'";
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
                            <td>1</td>                
                            <td>- '.$Vvalor.' %</td>
                    </tr>';
                    
                }
                ?>
                    
                
    </tbody>
    </table>
    <br />
    <p>PORTES, IVA Y TOTAL:</p><br />

    <table class="tabla">
    <thead>
    <tr>
    <th>Portes</th>
    <th>Iva total</th>
    <th>Total simple</th>
    <th>Total con iva y portes</th>
    </tr>
    </thead>
    <tbody>
                <tr>
                    <td><?php echo number_format($Fportes, 2, ",", ""); ?> €</td>
                    <td><?php echo number_format($Fivatotal, 2, ",", ""); ?> €</td>
                    <td><?php echo number_format($Ftotalsiniva, 2, ",", ""); ?> €</td>
                    <td><?php echo number_format($Fpreciototal, 2, ",", ""); ?> €</td>
                </tr>
    </tbody>
    </table>
    <br />
    <p style="font-size:12px;">CafeenCapsula.com - Hay Canal Web S.L. - C/ Jativa 8, 7ºA, 28007, Madrid - Spain - CIF. B86049319 - 917789087</p>
    
    <div class="limpiar"></div>
</div>
	
            
</body>
</html>
