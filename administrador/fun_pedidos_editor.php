<?php
// Inicializamos sesion 
session_start();
include('../lib/config.inc.php');
include('../lib/conectar.php');

$action = utf8_decode(trim($_POST["action"]));
$CPid = utf8_decode(trim($_POST["CPid"]));
$CPnombreenvio = utf8_decode(trim($_POST["CPnombreenvio"]));
$CPapellidosenvio = utf8_decode(trim($_POST["CPapellidosenvio"]));
$CPdireccionenvio = utf8_decode(trim($_POST["CPdireccionenvio"]));
$CPcpenvio = utf8_decode(trim($_POST["CPcpenvio"]));
$CPlocalidadenvio = utf8_decode(trim($_POST["CPlocalidadenvio"]));
$CPprovinciaenvio = utf8_decode(trim($_POST["CPprovinciaenvio"]));
$CPpaisenvio = utf8_decode(trim($_POST["CPpaisenvio"]));
$CPportes = utf8_decode(trim($_POST["CPportes"]));
$CPivatotal = utf8_decode(trim($_POST["CPivatotal"]));
$CPtotalsiniva = utf8_decode(trim($_POST["CPtotalsiniva"]));
$CPpreciototal = utf8_decode(trim($_POST["CPpreciototal"]));
$CPtrk = utf8_decode(trim($_POST["CPtrk"]));
$CPformapago = utf8_decode(trim($_POST["CPformapago"]));
$CPpagado = utf8_decode(trim($_POST["CPpagado"]));
$CPestado = utf8_decode(trim($_POST["CPestado"]));
$CPobservaciones = utf8_decode(trim($_POST["CPobservaciones"]));
$CPvale = utf8_decode(trim($_POST["CPvale"]));
 

if ($action=="1"){
    
    //pasamos a mayusculas las palabras que hay que pasar   
    $CPlocalidadenvio=strtoupper($CPlocalidadenvio);
    $CPprovinciaenvio=strtoupper($CPprovinciaenvio);
    $CPpaisenvio=strtoupper($CPpaisenvio);
    
//ACTUALIZAR      
$query = "UPDATE Carrito_Pedidos SET 
            CPnombreenvio='".$CPnombreenvio."',
            CPapellidosenvio='".$CPapellidosenvio."',
            CPdireccionenvio='".$CPdireccionenvio."',
            CPcpenvio='".$CPcpenvio."',
            CPlocalidadenvio='".$CPlocalidadenvio."',
            CPprovinciaenvio='".$CPprovinciaenvio."',
            CPpaisenvio='".$CPpaisenvio."',
            CPportes='".$CPportes."',
            CPivatotal='".$CPivatotal."',
            CPtotalsiniva='".$CPtotalsiniva."',
            CPpreciototal='".$CPpreciototal."',
            CPtrk='".$CPtrk."',
            CPformapago='".$CPformapago."',
            CPpagado='".$CPpagado."',
            CPobservaciones='".$CPobservaciones."',    
            CPvale='".$CPvale."'
            WHERE CPid=".$CPid."";
            $mysqli->query($query);
            
            ////////////////////////////////////////LOG///////////////////////////////////////////////
            $fecha=date('l jS \of F Y h:i:s A');
            $iddelusuario=$_SESSION[Aid];
            $nombredelusuario=$_SESSION[Anombre];
            $descripcion='El usuario '.$nombredelusuario.' ha actualizado el pedido '.$CPid.'.';
            //INSERTAR      
            $query = "INSERT INTO Log (LOGdescripcion,LOGfecha,LOGidusuario,LOGnombreusuario)
                               VALUES ('$descripcion','$fecha','$iddelusuario','$nombredelusuario')";
                    $mysqli->query($query);
            ////////////////////////////////////////LOG///////////////////////////////////////////////
            
            
            $_SESSION[errores]="ok";
            $_SESSION[comentario]="Has editado el pedido."; 
            
            //REDIRIGIR
header('Location: '.$INC_url.'/administrador/panel_administrador.php?var=91&CPid='.$CPid.'');
         

}

if ($action=="2"){   
    
//ACTUALIZAR      
$query = "UPDATE Carrito_Pedidos SET 
            CPestado='".$CPestado."'
            WHERE CPid=".$CPid."";
            $mysqli->query($query);
            
            //SI ES FACTURADO
                if($CPestado=="facturado"){

                    
                    //SACAMOS LOS DATOS DEL PEDIDO
                    $sql = "SELECT * FROM Carrito_Pedidos WHERE CPid='$CPid'";
                    if(!$result = $mysqli->query($sql)){
                        die("Query invalido: " . $sql);
                    }          
                    /* fetch array asociativo*/
                    while ($fila = $result->fetch_assoc()) {
                        $CPid = utf8_encode($fila["CPid"]);
                        $CP_Uid = utf8_encode($fila["CP_Uid"]);
                        $CPnombreenvio = $fila["CPnombreenvio"];
                        $CPapellidosenvio = $fila["CPapellidosenvio"];
                        $CPdireccionenvio = $fila["CPdireccionenvio"];
                        $CPcpenvio = $fila["CPcpenvio"];
                        $CPlocalidadenvio = $fila["CPlocalidadenvio"];
                        $CPprovinciaenvio = $fila["CPprovinciaenvio"];
                        $CPpaisenvio = $fila["CPpaisenvio"];
                        $CPportes = utf8_encode($fila["CPportes"]);
                        $CPivatotal = utf8_encode($fila["CPivatotal"]);
                        $CPtotalsiniva = utf8_encode($fila["CPtotalsiniva"]);
                        $CPpreciototal = utf8_encode($fila["CPpreciototal"]);
                        $CPfecha = utf8_encode($fila["CPfecha"]);
                        $CPtrk = utf8_encode($fila["CPtrk"]);
                        $CPformapago = utf8_encode($fila["CPformapago"]);
                        $CPpagado = utf8_encode($fila["CPpagado"]);
                        $CPestado = utf8_encode($fila["CPestado"]);
                        $CPobservaciones = utf8_encode($fila["CPobservaciones"]);
                        $CPvale = utf8_encode($fila["CPvale"]);
                    }
                    /* liberamos la memoria asociada al resultado */
                    $result->close();

                    //SACAMOS LOS DATOS DEL USUARIO
                    $sql = "SELECT * FROM Usuarios WHERE Uid='$CP_Uid'";
                    if(!$result = $mysqli->query($sql)){
                        die("Query invalido: " . $sql);
                    }          
                    /* fetch array asociativo*/
                    while ($fila = $result->fetch_assoc()) {
                        $Uid = $fila["Uid"];
                        $Uempresa = $fila["Uempresa"];
                        $Unombre = $fila["Unombre"];
                        $Uapellidos = $fila["Uapellidos"];
                        $Udnicif = $fila["Udnicif"];
                        $Udireccion = $fila["Udireccion"];
                        $Ucp = $fila["Ucp"];
                        $Ulocalidad = $fila["Ulocalidad"];
                        $Uprovincia = $fila["Uprovincia"];
                        $Upais = $fila["Upais"];
                        $Utlf = $fila["Utlf"];
                        $Uemail = $fila["Uemail"];
                        $Ucondiciones = $fila["Ucondiciones"];
                        $Unews = $fila["Unews"];
                        $Utipo = $fila["Utipo"];
                        $Uvalidado = $fila["Uvalidado"];
                        $Unumerocompras = $fila["Unumerocompras"];
                        $Ufechaultimacompra = $fila["Ufechaultimacompra"];
                        $Ugastototal = $fila["Ugastototal"];
                    }
                    /* liberamos la memoria asociada al resultado */
                    $result->close();

                    /////////////////////////////////////////////////////////////////////////////
                    //GUARDAMOS LOS DATOS EN LA FACTURA
                    //PERO PRIMERO CREAMOS EL NUMERO DE LA FACTURA
                    $sql = "SELECT Fnumero FROM Facturas ORDER BY Fid desc";
                    if(!$result = $mysqli->query($sql)){
                        die("Query invalido: " . $sql);
                    }          
                    $total_registros = $result->num_rows;
                    /* liberamos la memoria asociada al resultado */
                    $result->close();


                    if($total_registros==0){
                        $ano = date('Y');
                        $Fnumero = 'WEB-'.$ano.'-1';
                    } else {
                        $sql = "SELECT Fnumero FROM Facturas ORDER BY Fid asc";
                        if(!$result = $mysqli->query($sql)){
                            die("Query invalido: " . $sql);
                        }          
                        /* fetch array asociativo*/
                        while ($fila = $result->fetch_assoc()) {
                            $Fnumero = utf8_encode($fila["Fnumero"]);
                        }
                        /* liberamos la memoria asociada al resultado */
                        $result->close();

                        $numero=explode("-",$Fnumero);
                        $ano = date('Y');

                        if($numero[1] == $ano){                
                            $Fnumero = 'WEB-'.$ano.'-'.($numero[2]+1); 
                        } else {
                            $Fnumero = 'WEB-'.$ano.'-1';
                        }
                    }

                    $fecha_hoy=date("Y-m-d");



                    //AHORA GUARDAMOS LOS DATOS DE LA FACTURA
                    $query = "INSERT INTO Facturas (F_CPid, F_Uid, Fnumero, Ffecha, F_Uempresa, F_Unombre, F_Uapellidos, F_Udnicif, F_Udireccion, F_Ucp, F_Ulocalidad, F_Uprovincia, 
                                                    F_Upais, F_Unombreenvio, F_Uapellidosenvio, F_Udireccionenvio, F_Ucpenvio, F_Ulocalidadenvio, F_Uprovinciaenvio, F_Upaisenvio, 
                                                    Fportes, Fivatotal, Ftotalsiniva, Fformapago, Fpreciototal) 
                                        VALUES ('$CPid', '$CP_Uid', '$Fnumero', '$fecha_hoy', '$Uempresa', '$Unombre', '$Uapellidos', '$Udnicif', '$Udireccion', '$Ucp', '$Ulocalidad', '$Uprovincia',
                                            '$Upais', '$CPnombreenvio', '$CPapellidosenvio', '$CPdireccionenvio', '$CPcpenvio', '$CPlocalidadenvio', '$CPprovinciaenvio', '$CPpaisenvio', '$CPportes',
                                            '$CPivatotal', '$CPtotalsiniva', '$CPformapago', '$CPpreciototal')";
                            $mysqli->query($query);

                    //SACAMOS EL ID DE LA FACTURA GENERADA PARA ASOCIARLA FACTURA_DETALLE
                    $sql = "SELECT Fid FROM Facturas WHERE Fnumero = '$Fnumero'";
                    if(!$result = $mysqli->query($sql)){
                        die("Query invalido: " . $sql);
                    }          
                    /* fetch array asociativo*/
                    while ($fila = $result->fetch_assoc()) {
                        $Fid = utf8_encode($fila["Fid"]);
                    }
                    /* liberamos la memoria asociada al resultado */
                    $result->close();



                    //SACAMOS LOS DATOS DE CARRITO_PEDIDOS_DETALLE
                    $sql = "SELECT * FROM Carrito_Pedidos_Detalle WHERE CPD_CPid = '$CPid'";
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

                        if($CPD_Vid!="") {
                            $idvale=$CPD_Vid;
                        }


                        //AHORA GUARDAMOS LOS DATOS DE LA FACTURA
                        $query = "INSERT INTO Facturas_Detalle (FD_Fid, FD_Pid, FDcantidad, FDpreciototal, FDpreciounitario, FDprecioivaind) 
                                  VALUES ('$Fid', '$CPD_Pid', '$CPDcantidad', '$CPDpreciototal', '$CPDpreciounitario', '$CPDprecioiva')";
                            $mysqli->query($query);       

                    }
                    /* liberamos la memoria asociada al resultado */
                    $result->close();

                    if($CPvale=="si"){ 
                        //ACTUALIZAR      
                        $query = "UPDATE Facturas SET 
                                Fvale='$idvale' 
                                WHERE Fnumero='$Fnumero'";
                                $mysqli->query($query);
                    }
                }    
            //SI ES VACIO    
            if($CPestado=="vacio"){
    
                $Email = utf8_decode(trim($_POST["Email"]));
                $Nombre = utf8_decode(trim($_POST["Nombre"]));
                $Numero = utf8_decode(trim($_POST["Numero"]));
                $Valor = utf8_decode(trim($_POST["Valor"]));

                //ACTUALIZAR      
                $query = "UPDATE Carrito_Pedidos SET 
                            CPformapago='transferencia' 
                            WHERE CPid=".$CPid."";
                            $mysqli->query($query);  

                //ACTUALIZAR      
                $query = "UPDATE Carrito_Pedidos SET 
                            CPestado='pendiente' 
                            WHERE CPid=".$CPid."";
                            $mysqli->query($query);
                ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                    ////////ENVIAMOS EL E-MAIL       


                    require_once('../fun_mailer.php');
                    $email_destino = $Email;
                    $nombre_email = $Nombre;
                    $asunto = 'Pedido recibido';
                    $mensaje = '
                        <p>Has realizado un pedido. Te agradecemos tu confianza.</p>
                        <p>Puedes hacer seguimiento de tu pedido desde tu panel de control. Si tienes cualquier duda contacta con nosotros.</p>
                        <p>Datos para realizar el pago</p>
                        <p>Banco BBVA - 0182-2425-47-0201534374</p>
                        <p>Titular - Hay Canal Web SL (CafeenCapsula.com)</p>
                        <p>Numero de pedido '.$Numero.'</p>
                        <p>Cantidad a ingresar '.number_format($Valor, 2, ",", "").' euros</p>
                    ';
                    $comprobacion_email = mailer($email_destino, $nombre_email, $asunto, $mensaje);
                    
                    
            }
            
            ////////////////////////////////////////LOG///////////////////////////////////////////////
            $fecha=date('l jS \of F Y h:i:s A');
            $iddelusuario=$_SESSION[Aid];
            $nombredelusuario=$_SESSION[Anombre];
            $descripcion='El usuario '.$nombredelusuario.' ha actualizado el estado del pedido '.$CPid.'.';
            //INSERTAR      
            $query = "INSERT INTO Log (LOGdescripcion,LOGfecha,LOGidusuario,LOGnombreusuario)
                               VALUES ('$descripcion','$fecha','$iddelusuario','$nombredelusuario')";
                    $mysqli->query($query);
            ////////////////////////////////////////LOG///////////////////////////////////////////////
            
            
            $_SESSION[errores]="ok";
            $_SESSION[comentario]="Has editado el estado del pedido."; 
            
            //REDIRIGIR
header('Location: '.$INC_url.'/administrador/panel_administrador.php?var=91&CPid='.$CPid.'');
         

}



 
?>
