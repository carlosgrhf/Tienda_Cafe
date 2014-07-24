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
	<meta name="Description" content="Dirección de envío - <?php echo $INC_descripcion; ?>" />
        <meta name="author" content="Hay Canal Web S.L." />
	<meta name="Language" content="es" />
	<meta name="Robots" content="index, follow" />
	<title>Dirección de envío - <?php echo $INC_titulo; ?></title>
        <!-- Llamadas a Estilos y Reset -->
	<link rel="stylesheet" type="text/css" href="<?php echo $INC_url; ?>/estilos/reset.css" /> 
        <link rel="stylesheet" type="text/css" href="<?php echo $INC_url; ?>/estilos/estilos.css" />
        <!-- Google Font -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700,300italic' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Fredericka+the+Great' rel='stylesheet' type='text/css'>
            
        <!-- Llamadas script -->   
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

        <!-- Llamadas script - validar formularios -->
        <script src="<?php echo $INC_url; ?>/lib/validator/dist/jquery.validate.js"></script>
        <script type="text/javascript">
        $(function(){
            $('#formulario_registro').validate({
                rules: {                    
                    'nombre': 'required',
                    'apellidos': 'required',
                    'direccion': 'required',
                    'localidad': 'required',
                    'provincia': 'required',
                    'cp': 'required',
                    'pais': 'required'                    
                },
                messages: {
                    'nombre': 'Debe introducir el nombre de envío.',
                    'apellidos': 'Debe ingresar sus apellidos.',
                    'direccion': 'Debe ingresar la dirección de envío.',
                    'localidad': 'Debe ingresar la localidad de envío.',
                    'provincia': 'Debe ingresar la provincia de envío.',
                    'cp': 'Debe ingresar el código postal de envío.',
                    'pais': 'Debe ingresar el país de envío.'
                }                
            });
        });
        </script>        
       
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
        <h1>Carrito de la Compra, confirma la dirección de envío</h1><br />
    <?php
    //GUARDAMOS EL ID DE LA SESION
    $session = session_id();
    
    $sql = "SELECT * FROM Carrito_Temporal WHERE CTsesion = '$session'";
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
        
        if($CT_Vid!="" AND $CT_Vid!=0) {
            $vale="si";
            $idvale=$CT_Vid;
        }
        
        //sumamos los totales
        $total_cantidad_carrito=$total_cantidad_carrito+$CTcantidad;
        $total_carrito=$total_carrito+$CTpreciototal;
        
        //Hay que sacar el nombre del producto que no está en el carrito temporal
        //consultamos en la base de datos 
        $sql2 = "SELECT * FROM Productos WHERE Pid='$CT_Pid'";
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
                <td>'.number_format($CTpreciounitario, 2, ",", "").' €</td>
                <td>'.$CTcantidad.'</td>
                <td>'.number_format($CTpreciototal, 2, ",", "").' €</td>
                <td></td>
            </tr>
        ';
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
        
        $total_carrito=$total_carrito-($total_carrito*$Vvalor/100);
        
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
    
    //CALCULAMOS LOS GASTOS DE ENVIO
    if($GElimite<$total_carrito){
        $GEportes=0.00;
    } else {
        $total_carrito=$total_carrito+$GEportes;
    }
    
    echo '
        <tr>
                <td>Gastos de envío</td>
                <td></td>
                <td></td>
                <td>'.number_format($GEportes, 2, ",", "").' €</td>
                <td></td>
        </tr>
        <tr class="total">
                <td></td>
                <td>Total</td>
                <td>'.$total_cantidad_carrito.'</td>
                <td>'.number_format($total_carrito, 2, ",", "").' €</td>
                <td>Iva incluido</td>
        </tr>
        </tbody>
        </table>
    ';
    
    echo '
        <div style="float:left; width: 290px; margin-top:20px;">
      <br /><p>Estos son tus datos actuales de facturación. 
        <a href="'.$INC_url.'/login/1/panel_control" title="Actualizar mis datos">Puedes actualizarlos si hay algún error.</a>
      </p><br />
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
      </ul><br />
    ';
    ?>
        </div>
        <div style="float:right; width: 690px; background: #FBF7F1; padding-left:20px; padding-top: 18px; margin-top:20px;">
    <h2>Confirmar dirección de envio</h2>
    <form id="formulario_registro" method="post" action="<?php echo $INC_url; ?>/carrito/crear_pedido.php">
         
        <p>Si la dirección de envío es la misma que la de facturación deja el formulario como está, si no cambia los datos y confirma 
            la nueva dirección. La nueva dirección solo quedará guardada para este pedido y no cambiará tus datos de facturación.</p>        
        <br />
        
        <div class="label_registro">
            <label>* Nombre:</label>
        </div>
        <div class="imput_registro"> 
            <input name="nombre" type="text" id="nombre" value="<?php echo $Unombre; ?>" />
        </div>
        <div class="limpiar"></div>


         <div class="label_registro">
            <label>* Apellidos:</label>
        </div>
        <div class="imput_registro"> 
            <input name="apellidos" type="text" id="apellidos" value="<?php echo $Uapellidos; ?>" />
        </div>
        <div class="limpiar"></div>


        <div class="label_registro">
            <label>* Dirección:</label>
        </div>
        <div class="imput_registro"> 
            <input name="direccion" type="text" id="direccion" value="<?php echo $Udireccion; ?>" />
        </div>
        <div class="limpiar"></div>


        <div class="label_registro">
            <label>* Código Postal:</label>
        </div>
        <div class="imput_registro"> 
            <input name="cp" type="text" id="cp" value="<?php echo $Ucp; ?>" />
        </div>
        <div class="limpiar"></div>


        <div class="label_registro">
            <label>* Localidad:</label>
        </div>
        <div class="imput_registro"> 
            <input name="localidad" type="text" id="localidad" value="<?php echo $Ulocalidad; ?>" />
        </div>
        <div class="limpiar"></div>
        
        <div class="label_registro">
            <label>* Provincia:</label>
        </div>
        <div class="imput_registro"> 
            <input name="provincia" type="text" id="provincia" value="<?php echo $Uprovincia; ?>" />
        </div>
        <div class="limpiar"></div>
        
        <div class="label_registro">
            <label>* País:</label>
        </div>
        <div class="imput_registro"> 
            <select name="pais" id="pais">
                <?php
                if($Upais=="ESPAÑA"){
                    echo '
                        <option value="ESPAÑA">España</option>
                        <option value="PORTUGAL">Portugal</option>
                    ';
                }
                if($Upais=="PORTUGAL"){
                    echo '
                        <option value="PORTUGAL">Portugal</option>
                        <option value="ESPAÑA">España</option>                    
                    ';
                }
                ?>
            </select>
        </div>
        <div class="limpiar"></div>
        
        
        
        
        <div class="label_registro">
            <label>&nbsp;</label>
        </div>
        <div class="imput_registro"> 
            <input type="submit" class="marco_submit" value="Confirmar y seguir" />
        </div>
        <div class="limpiar"></div>

    </form>
         
        </div>
    
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