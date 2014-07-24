<?php
$CPid=$_GET[CPid];

///////////////////////////////////////////////////////////////////////////////////
//SACAMOS LOS DATOS DEL PEDIDO
$sql = "SELECT * FROM Carrito_Pedidos WHERE CPid='$CPid'";
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
        $CPtrk = utf8_encode($fila["CPtrk"]);
        $CPformapago = utf8_encode($fila["CPformapago"]);
        $CPpagado = utf8_encode($fila["CPpagado"]);
        $CPestado = utf8_encode($fila["CPestado"]);
        $CPobservaciones = utf8_encode($fila["CPobservaciones"]);
        $CPvale = utf8_encode($fila["CPvale"]);
        
                
    }
    /* liberamos la memoria asociada al resultado */
    $result->close();
    
    
////////////////////////////////////////////////////////////////////////////////////
//SACAMOS LOS DATOS DEL USUARIO
$sql = "SELECT * FROM Usuarios WHERE Uid = '$CP_Uid' ";
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
    $Ugastototal = utf8_encode($fila["Ugastototal"]);
}
/* liberamos la memoria asociada al resultado */
$result->close();
?>
<h2>Pedido <?php echo $CPid; ?></h2><br />
<p class="semillas">Inicio > Pedidos > Editar Pedido</p><br />

<ul style="float:left; font-size: 12px; line-height: 16px;">
    <li><strong>Datos del usuario</strong></li>
    <li><strong>Tipo:</strong> <?php echo $Utipo; ?></li>
    <li><strong>Empresa:</strong> <?php echo $Uempresa; ?></li>
    <li><strong>Nombre:</strong> <?php echo ''.$Unombre.' '.$Uapellidos.''; ?></li>
    <li><strong>DNI/CIF:</strong> <?php echo $Udnicif; ?></li>
    <li><strong>Direccion:</strong> <?php echo $Udireccion; ?></li>
    <li><strong>Código postal:</strong> <?php echo $Ucp; ?></li>
    <li><strong>Localidad:</strong> <?php echo $Ulocalidad; ?></li>
    <li><strong>Provincia:</strong> <?php echo $Uprovincia; ?></li>
    <li><strong>País:</strong> <?php echo $Upais; ?></li>
    <li><strong>E-mail:</strong> <?php echo $Uemail; ?></li>
    <li><strong>Teléfono:</strong> <?php echo $Utlf; ?></li>
</ul>

<ul style="float:right; margin-right: 250px; font-size: 12px; line-height: 16px;">
    <li><strong>Datos de envio</strong></li>
    <li><strong>Nombre:</strong> <?php echo $CPnombreenvio; ?></li>
    <li><strong>Apellidos:</strong> <?php echo $CPapellidosenvio; ?></li>
    <li><strong>Dirección:</strong> <?php echo $CPdireccionenvio; ?></li>
    <li><strong>Código postal:</strong> <?php echo $CPcpenvio; ?></li>
    <li><strong>Localidad:</strong> <?php echo $CPlocalidadenvio; ?></li>
    <li><strong>Provincia:</strong> <?php echo $CPprovinciaenvio; ?></li>
    <li><strong>País:</strong> <?php echo $CPpaisenvio; ?></li>
</ul>

<div class="limpiar"></div>
<br /><br />
<p><strong>NÚMERO DE PEDIDO:</strong> <?php echo $CPid; ?></p>

<br /><br />
<p><strong>OBSERVACIONES:</strong> <?php echo $CPobservaciones; ?></p>

<br /><br />
<p><strong>PORTES Y TRACKING:</strong> <?php echo $CPtrk; ?></p>

<br /><br />
<table class="tabla">
<thead>
<tr>
<th>Fecha</th>
<th>Estado</th>
<th>Forma de pago</th>
<th>Pagado</th>
</tr>
</thead>
<tbody>
            <tr>
                <td><?php echo cambiaf_a_normal($CPfecha); ?></td>
                <td><?php echo $CPestado; ?></td>
                <td><?php echo $CPformapago; ?></td>
                <td><?php echo $CPpagado; ?></td>               
            </tr>
</tbody>
</table>

<br /><br />
<table class="tabla">
<thead>
<tr>
<th>Referencia</th>
<th>Nombre</th>
<th>PVP+Iva</th>
<th>Iva Ind.</th>
<th>Unidades</th>
<th>Total</th>
</tr>
</thead>
<tbody>

               

<?php
///////////////////////////////////////////////////////////////////////////////////
//SACAMOS LOS DATOS DEL DETALLE DEL PEDIDO Y EN CASCADA LOS DATOS DE LOS PRODUCTOS
$sql = "SELECT * FROM Carrito_Pedidos_Detalle WHERE CPD_CPid = '$CPid' ";
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
        
    $sql2 = "SELECT * FROM Productos WHERE Pid = '".$CPD_Pid."' ";
    if(!$result2 = $mysqli->query($sql2)){
        die("Query invalido: " . $sql2);
    } 
    
    /* fetch array asociativo*/
    while ($fila2 = $result2->fetch_assoc()) {
        $Preferencia = utf8_encode($fila2["Preferencia"]);
        $Pnombre = utf8_encode($fila2["Pnombre"]);
        $Pfabricante = utf8_encode($fila2["Pfabricante"]);
        
        echo '<tr>';
        echo '<td>'.$Preferencia.'</td>';
        echo '<td>'.$Pnombre.' <span style="font-size:8pt;">('.$Pfabricante.')</span></td>';
        echo '<td>'.number_format($CPDpreciounitario, 2, ",", "").' €</td>';
        echo '<td>'.number_format($CPDprecioiva, 2, ",", "").' €</td>';
        echo '<td>'.$CPDcantidad.'</td>';
        echo '<td>'.number_format($CPDpreciototal, 2, ",", "").' €</td>';
        echo '</tr>';
    }
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
                <td></td>
                <td>1</td>                
                <td>- '.$Vvalor.' %</td>                
        </tr>';
}

?>
 

</tbody>
</table>

<br /><br />
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
                <td><?php echo number_format($CPportes, 2, ",", ""); ?> €</td>
                <td><?php echo number_format($CPivatotal, 2, ",", ""); ?> €</td>
                <td><?php echo number_format($CPtotalsiniva, 2, ",", ""); ?> €</td>
                <td><?php echo number_format($CPpreciototal, 2, ",", ""); ?> €</td>
            </tr>
</tbody>
</table>


<br /><br />
<h2>Editar estado del pedido</h2><br />

<?php if($CPestado!="facturado"){ ?>

        <form id="formulario_login" method="post" action="<?php echo $INC_url; ?>/administrador/fun_pedidos_editor.php">    
            
            
            <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>* Estado:</label>
            </div>
                <select name="CPestado" class="imput_editar">
                    <option value="<?php echo $CPestado; ?>"><?php echo ''.$CPestado.' (Activo)'; ?></option>
                    <option value="pendiente">pendiente</option>
                    <option value="enviado">enviado</option>
                    <option value="completado">completado</option>
                    <option value="facturado">facturado</option>
                    <option value="devuelto">devuelto</option>
                    <option value="amigo">amigo</option>
                    <option value="vacio">vacio</option>
                </select>
            <div class="limpiar"></div>
            <!-- -------------------------------------------------------------------------------------------- -->
            
             
            <input type="hidden" name="action" value="2" />
            <input type="hidden" name="CPid" value="<?php echo $CPid; ?>" />
            <input type="hidden" name="Email" value="<?php echo $Uemail; ?>" />
            <input type="hidden" name="Nombre" value="<?php echo $Unombre; ?>" />
            <input type="hidden" name="Numero" value="<?php echo $CPid; ?>" />
            <input type="hidden" name="Valor" value="<?php echo $CPpreciototal; ?>" />

            <div class="colocar_boton">         
            <input class="boton" type="submit" value="Editar" />
            </div>           
            <div class="limpiar"></div>            

        </form>
<?php } else { ?>
        <p>El pedido está facturado, ya no se puede cambiar el estado y se recomienda no hacer ningún cambio en el pedido.</p>

<?php } ?>

<br />

<br /><br />
<h2>Editar pedido</h2><br />

<form id="formulario_login" method="post" action="<?php echo $INC_url; ?>/administrador/fun_pedidos_editor.php"> 
    
            <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>* ID:</label>
            </div>
                <p class="imput_editar"><?php echo $CPid; ?></p>
            <div class="limpiar"></div>
            <!-- -------------------------------------------------------------------------------------------- -->
            
            <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>* ID Cliente:</label>
            </div>
                <p class="imput_editar"><?php echo $CP_Uid; ?></p>
            <div class="limpiar"></div>
            <!-- -------------------------------------------------------------------------------------------- -->
            
            <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>* Fecha:</label>
            </div>
            <p class="imput_editar"><?php echo cambiaf_a_normal($CPfecha); ?></p>
            <div class="limpiar"></div>
            <!-- -------------------------------------------------------------------------------------------- -->            
            
                            
            <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>* Nombre envío:</label>
            </div>
                <input class="imput_editar" name="CPnombreenvio" type="text" value="<?php echo $CPnombreenvio; ?>" />
            <div class="limpiar"></div>
            <!-- -------------------------------------------------------------------------------------------- -->
            
            <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>* Apellidos envío:</label>
            </div>
                <input class="imput_editar" name="CPapellidosenvio" type="text" value="<?php echo $CPapellidosenvio; ?>" />
            <div class="limpiar"></div>
            <!-- -------------------------------------------------------------------------------------------- -->
            
            <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>* Dirección envío:</label>
            </div>
                <input class="imput_editar" name="CPdireccionenvio" type="text" value="<?php echo $CPdireccionenvio; ?>" />
            <div class="limpiar"></div>
            <!-- -------------------------------------------------------------------------------------------- -->
            
            <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>* Código Postal envío:</label>
            </div>
                <input class="imput_editar" name="CPcpenvio" type="text" value="<?php echo $CPcpenvio; ?>" />
            <div class="limpiar"></div>
            <!-- -------------------------------------------------------------------------------------------- -->
            
            <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>* Localidad envío:</label>
            </div>
                <input class="imput_editar" name="CPlocalidadenvio" type="text" value="<?php echo $CPlocalidadenvio; ?>" />
            <div class="limpiar"></div>
            <!-- -------------------------------------------------------------------------------------------- -->
            
            <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>* Provincia envío:</label>
            </div>
                <input class="imput_editar" name="CPprovinciaenvio" type="text" value="<?php echo $CPprovinciaenvio; ?>" />
            <div class="limpiar"></div>
            <!-- -------------------------------------------------------------------------------------------- -->
            
            <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>* Pais envío:</label>
            </div>
                <input class="imput_editar" name="CPpaisenvio" type="text" value="<?php echo $CPpaisenvio; ?>" />
            <div class="limpiar"></div>
            <!-- -------------------------------------------------------------------------------------------- -->
            
            <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>* Portes €:</label>
            </div>
                <input class="imput_editar" name="CPportes" type="text" value="<?php echo $CPportes; ?>" />
            <div class="limpiar"></div>
            <!-- -------------------------------------------------------------------------------------------- -->
            
            <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>* Iva total €:</label>
            </div>
                <input class="imput_editar" name="CPivatotal" type="text" value="<?php echo $CPivatotal; ?>" />
            <div class="limpiar"></div>
            <!-- -------------------------------------------------------------------------------------------- -->
            
            <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>* Total sin Iva €:</label>
            </div>
                <input class="imput_editar" name="CPtotalsiniva" type="text" value="<?php echo $CPtotalsiniva; ?>" />
            <div class="limpiar"></div>
            <!-- -------------------------------------------------------------------------------------------- -->
            
            <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>* Precio Total €:</label>
            </div>
                <input class="imput_editar" name="CPpreciototal" type="text" value="<?php echo $CPpreciototal; ?>" />
            <div class="limpiar"></div>
            <!-- -------------------------------------------------------------------------------------------- -->
            
            <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>* Tracking:</label>
            </div>
                <input class="imput_editar" name="CPtrk" type="text" value="<?php echo $CPtrk; ?>" />
            <div class="limpiar"></div>
            <!-- -------------------------------------------------------------------------------------------- -->
            
            <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>* Forma Pago:</label>
            </div>
                <select name="CPformapago" class="imput_editar">
                    <option value="<?php echo $CPformapago; ?>"><?php echo ''.$CPformapago.' (Activo)'; ?></option>
                    <option value="transferencia">transferencia</option>
                    <option value="tarjeta">tarjeta</option>
                    <option value="paypal">paypal</option>
                    <option value="vacio">vacio</option>
                </select>
            <div class="limpiar"></div>
            <!-- -------------------------------------------------------------------------------------------- -->
            
            <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>* Pagado:</label>
            </div>
                <select name="CPpagado" class="imput_editar">
                    <option value="<?php echo $CPpagado; ?>"><?php echo ''.strtoupper($CPpagado).' (Activo)'; ?></option>
                    <option value="si">SI</option>
                    <option value="no">NO</option>
                </select>
            <div class="limpiar"></div>
            <!-- -------------------------------------------------------------------------------------------- -->          
            
            
            <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>* Vale:</label>
            </div>
                <select name="CPvale" class="imput_editar">
                    <option value="<?php echo $CPvale; ?>"><?php echo ''.strtoupper($CPvale).' (Activo)'; ?></option>
                    <option value="si">SI</option>
                    <option value="no">NO</option>
                </select>
            <div class="limpiar"></div>
            <!-- -------------------------------------------------------------------------------------------- -->
            
            <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>* Observaciones:</label>
            </div>
                <textarea class="imput_editar" name="CPobservaciones" style="width:400px; height:100px;"><?php echo $CPobservaciones; ?></textarea>
            <div class="limpiar"></div>
            <!-- -------------------------------------------------------------------------------------------- -->
                                   
            
                        
            
             
             <input type="hidden" name="action" value="1" />
            <input type="hidden" name="CPid" value="<?php echo $CPid; ?>" />

            <div class="colocar_boton">         
            <input class="boton" type="submit" value="Editar" />
            </div>           
            <div class="limpiar"></div>            

        </form>
<br />

