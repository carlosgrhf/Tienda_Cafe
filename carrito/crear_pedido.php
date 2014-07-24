<?php
// Inicializamos sesion 
session_start();
include('../lib/config.inc.php');
include('../lib/conectar.php');
include('../fun_fechas.php');
include('../fun_acentos.php');

//fecha de hoy
$fecha=date("Y-m-d");

//RECOGEMOS LA DIRECCION DE ENVIO
$nombre = $mysqli->real_escape_string(trim($_POST["nombre"]));
$nombreenvio = utf8_decode($nombre);
$nombreenvio=strtolower($nombreenvio);
$nombreenvio=ucwords($nombreenvio);

$apellidos = $mysqli->real_escape_string(trim($_POST["apellidos"]));
$apellidosenvio = utf8_decode($apellidos);
$apellidosenvio=strtolower($apellidosenvio);
$apellidosenvio=ucwords($apellidosenvio);

$direccion = $mysqli->real_escape_string(trim($_POST["direccion"]));
$direccionenvio = utf8_decode($direccion);
$direccionenvio=strtolower($direccionenvio);
$direccionenvio=ucwords($direccionenvio);

$cp = $mysqli->real_escape_string(trim($_POST["cp"]));
$cpenvio = utf8_decode($cp);

$localidad = $mysqli->real_escape_string(trim($_POST["localidad"]));
$localidadenvio = utf8_decode($localidad);
$localidadenvio=strtoupper($localidadenvio);

$provincia = $mysqli->real_escape_string(trim($_POST["provincia"]));
$provinciaenvio = utf8_decode($provincia);
$provinciaenvio=strtoupper($provinciaenvio);

$pais = $mysqli->real_escape_string(trim($_POST["pais"]));
$paisenvio = utf8_decode($pais);

//FUNCION PARA SACAR UN ID DE TRANSACCION UNICA A TRAVES DE FECHAS, QUE SERA EL ID DEL PEDIDO
$ahora_es = date(U);
$numero_pedido = $ahora_es*100;

//metemos el numero de pedido en una variable de sesion para utilizarlo en los siguientes pasos
$_SESSION[numero_pedido] = $numero_pedido;

//iniciamos las variables totales
$total_cantidad_carrito=0;
$total_carrito=0;
$total_iva=0;
$total_sin_iva=0;

//SACAMOS EL COSTE DEL PORTE Y EL LIMITE PARA QUE SEA GRATUITO
$sql = "SELECT * FROM Gastos_Envio WHERE GEid=1";
if(!$result = $mysqli->query($sql)){
    die("Query invalido: " . $sql);
}
/* fetch array asociativo*/
while ($fila = $result->fetch_assoc()) {                
    $GEportes = utf8_encode($fila["GEportes"]);
    $GElimite = utf8_encode($fila["GElimite"]);
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
        $Ugastototal = utf8_encode($fila["Ugastototal"]);
        
    }
    /* liberamos la memoria asociada al resultado */
    $result->close();

//GUARDAMOS EL ID DE LA SESION
$session = session_id();

    
//consultamos en la base de datos los productos del carrito temporal 
$sql = "SELECT * FROM Carrito_Temporal WHERE CTsesion='$session'";
if(!$result = $mysqli->query($sql)){
    die("Query invalido: " . $sql);
}
/* fetch array asociativo*/
while ($fila = $result->fetch_assoc()) {                
    $CTid = utf8_encode($fila["CTid"]);
    $CT_Uid = utf8_encode($fila["CT_Uid"]);
    $CT_Pid = utf8_encode($fila["CT_Pid"]);
    $CTsesion = utf8_encode($fila["CTsesion"]);
    $CTcantidad = utf8_encode($fila["CTcantidad"]);
    $CTpreciototal = utf8_encode($fila["CTpreciototal"]);
    $CTfecha = utf8_encode($fila["CTfecha"]);
    $CTpreciounitario = utf8_encode($fila["CTpreciounitario"]);    
    $CT_Vid = utf8_encode($fila["CT_Vid"]);
        
        if($CT_Vid!="") {
            $vale="si";
            $idvale=$CT_Vid;
        }
    
    //SACAMOS EL IVA DEL PRODUCTO DESDE LA TABLA PRODUCTOS POR QUE NO ESTA EN EL CARRITO
    $sql2 = "SELECT * FROM Productos WHERE Pid='$CT_Pid'";
    if(!$result2 = $mysqli->query($sql2)){
        die("Query invalido: " . $sql2);
    }
    /* fetch array asociativo*/
    while ($fila2 = $result2->fetch_assoc()) {                
        $Piva = utf8_encode($fila2["Piva"]);
        $Pprecio = utf8_encode($fila2["Pprecio"]);
    }
    /* liberamos la memoria asociada al resultado */
    $result2->close();

    //sumamos los totales
    $total_cantidad_carrito=$total_cantidad_carrito+$CTcantidad;
    $total_carrito=$total_carrito+$CTpreciototal;
    $total_iva=$total_iva+($Piva*$CTcantidad);
    $total_sin_iva=$total_sin_iva+($Pprecio*$CTcantidad);
    
    //VAMOS GUARDANDO LOS PRODUCTOS DEL CARRITO TEMPORAL EN EL DETALLE DE PEDIDOS
    $query = "INSERT INTO Carrito_Pedidos_Detalle 
    (CPD_CPid, CPD_Pid, CPDcantidad, CPDpreciototal, CPDpreciounitario, CPDprecioiva, CPD_Vid) 
    VALUES 
    ('$numero_pedido','$CT_Pid','$CTcantidad','$CTpreciototal','$CTpreciounitario','$Piva', '$CT_Vid')";
    $mysqli->query($query);
    
    //VAMOS AÑADIENDO A CADA PRODUCTO QUE HA SIDO COMPRADO
    //consultamos en la base de datos los productos del carrito temporal 
    $sql3 = "SELECT * FROM Productos WHERE Pid='$CT_Pid'";
    if(!$result3 = $mysqli->query($sql3)){
        die("Query invalido: " . $sql3);
    }
    /* fetch array asociativo*/
    while ($fila3 = $result3->fetch_assoc()) {                
        $Pvecescomprado = utf8_encode($fila3["Pvecescomprado"]);
        
        $Pvecescomprado++;
        
        $query = "UPDATE Productos SET Pvecescomprado='$Pvecescomprado' WHERE Pid='$CT_Pid'";
        $mysqli->query($query);
    }
    /* liberamos la memoria asociada al resultado */
    $result3->close();
    
}
/* liberamos la memoria asociada al resultado */
$result->close();

    //SI SE HA INTRODUCIDO UN VALE SACAMOS LA INFORMACION DEL VALE, HACEMOS LA CUENTA Y LO MOSTRAMOS, TAMBIEN SE PUEDE BORRAR
    if($vale=="si"){     
        
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
        
        $total_iva=$total_iva-($total_iva*$Vvalor/100);
        $total_sin_iva=$total_sin_iva-($total_sin_iva*$Vvalor/100);
        $total_carrito=$total_carrito-($total_carrito*$Vvalor/100);
        
        //Al usuario le añadimos en la tabla Vales_Usuarios para que no pueda volver a utilizarlo
        $query = "INSERT INTO Vales_Usuarios
                (VUUid, VUVid) 
                VALUES 
                ('$_SESSION[Uidacceso]','$idvale')";
                $mysqli->query($query);
        
    }
    
    //CALCULAMOS LOS GASTOS DE ENVIO
    if($GElimite<$total_carrito){
        $GEportes=0.00;
    } else {
        $total_carrito=$total_carrito+$GEportes;
    }
    
//CREAMOS EL PEDIDO
$query = "INSERT INTO Carrito_Pedidos 
(CPid, CP_Uid, CPnombreenvio, CPapellidosenvio, CPdireccionenvio, CPcpenvio, CPlocalidadenvio, CPprovinciaenvio, CPpaisenvio, CPportes, CPivatotal, CPtotalsiniva, CPpreciototal, CPfecha, CPformapago, CPpagado, CPestado, CPvale) 
VALUES 
('$numero_pedido', '$_SESSION[Uidacceso]','$nombreenvio','$apellidosenvio','$direccionenvio','$cpenvio','$localidadenvio','$provinciaenvio','$paisenvio','$GEportes', '$total_iva', '$total_sin_iva', '$total_carrito', '$fecha', 'vacio', 'no', 'pendiente', '$vale')";
$mysqli->query($query);

//AL USUARIO LE SUMAMOS UN PEDIDO Y LE SUMAMOS LA CANTIDAD TOTAL A SU FICHA
    
        
        $Unumerocompras++;
        $Ugastototal=$Ugastototal+$total_carrito;
        
        $query = "UPDATE Usuarios SET Unumerocompras='$Unumerocompras', Ufechaultimacompra=NOW(), Ugastototal='$Ugastototal' WHERE Uid='$_SESSION[Uidacceso]'";
        $mysqli->query($query);
    
    
    
//ELIMINAMOS LOS PRODUCTOS DEL CARRITO TEMPORAL
$query ="DELETE FROM Carrito_Temporal WHERE CTsesion='$session'";
$mysqli->query($query);

header('Location: '.$INC_url.'/carrito/carrito_paso_tres');
    
?>
