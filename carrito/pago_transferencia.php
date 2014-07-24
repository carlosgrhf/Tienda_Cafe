<?php
// Inicializamos sesion 
session_start();
include('../lib/config.inc.php');
include('../lib/conectar.php');

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
}
/* liberamos la memoria asociada al resultado */
$result->close();




//actualizamos el pedido con la nueva forma de pago
$query = "UPDATE Carrito_Pedidos SET CPformapago='transferencia' WHERE CPid='$_SESSION[numero_pedido]'";
$mysqli->query($query);

//Enviamos el e-mail tanto al usuario como al administrador
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        ////////ENVIAMOS EL E-MAIL       
        
        
        require_once('../fun_mailer.php');
        $email_destino = $_SESSION[Uemail];
        $nombre_email = $_SESSION[Unombre];
        $asunto = 'Pedido recibido';
        $mensaje = '
            <p>Has realizado un pedido. Te agradecemos tu confianza.</p>
            <p>Puedes hacer seguimiento de tu pedido desde tu panel de control. Si tienes cualquier duda contacta con nosotros.</p>
            <p>Datos para realizar el pago</p>
            <p>Banco BBVA - 0182-2425-47-0201534374</p>
            <p>Titular - Hay Canal Web SL (CafeenCapsula.com)</p>            
            <p>Numero de pedido '.$_SESSION[numero_pedido].'</p>
            <p>Cantidad a ingresar '.number_format($CPpreciototal, 2, ",", "").' euros</p>
        ';
        $comprobacion_email = mailer($email_destino, $nombre_email, $asunto, $mensaje);
              
        if($comprobacion_email==1){
            $_SESSION[errores]="ok";
            $_SESSION[comentario]="Gracias por completar tu pedido. En esta pantalla te mostramos los datos bancarios para que puedas realizar el pago.";
        } 
        
        

header('Location: '.$INC_url.'/carrito/carrito_terminado');
    
?>
