<?php
// Inicializamos sesion 
session_start();
include('../lib/config.inc.php');
include('../lib/conectar.php');
include('../fun_fechas.php');
include('../fun_acentos.php');
include('../fun_acentosyespacios.php');


$sql = "SELECT * FROM Usuarios WHERE Uid = '".$_SESSION[Uidacceso]."' ";
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

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo $INC_url; ?>/favicon.ico" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="Keywords" content="<?php echo $INC_palabras; ?>" />
	<meta name="Description" content="Registro de usuarios - <?php echo $INC_descripcion; ?>" />
        <meta name="author" content="Hay Canal Web S.L." />
	<meta name="Language" content="es" />
	<meta name="Robots" content="index, follow" />
	<title><?php echo $INC_titulo; ?> - Panel de usuarios</title>
        <!-- Llamadas a Estilos y Reset -->
	<link rel="stylesheet" type="text/css" href="<?php echo $INC_url; ?>/estilos/reset.css" /> 
        <link rel="stylesheet" type="text/css" href="<?php echo $INC_url; ?>/estilos/estilos.css" />
        
        <!-- Llamadas a Estilos del Paginador -->
        <link href="<?php echo $INC_url; ?>/lib/paginador/cafeencapsula/paginador.css" type="text/css" rel="stylesheet"></link>
        
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
                    'tipo': 'required',
                    'nombre': 'required',
                    'apellidos': 'required',
                    'dnicif': 'required',
                    'direccion': 'required',
                    'localidad': 'required',
                    'provincia': 'required',
                    'cp': 'required',
                    'pais': 'required',
                    'tlf': { required: true, number: true },
                    'email': { required: true, email: true }, 
                    'newsletter': 'required',
                    'condiciones': 'required'
                },
                messages: {
                    'tipo': 'Debe elegir si desea facturar como empresa o como particular.',
                    'nombre': 'Debe introducir su nombre.',
                    'apellidos': 'Debe ingresar sus apellidos.',
                    'dnicif': 'Debe ingresar su DNI, NIF o CIF según corresponda.',
                    'direccion': 'Debe ingresar la dirección de facturación.',
                    'localidad': 'Debe ingresar la localidad de facturación.',
                    'provincia': 'Debe ingresar la provincia de facturación.',
                    'cp': 'Debe ingresar el código postal de facturación.',
                    'pais': 'Debe ingresar el país de facturación.',
                    'tlf': { required: 'Debe ingresar un número de teléfono.', number: 'Debe ingresar el número de teléfono con un formato correcto, solo con números. Por ejemplo: 914338585.' },
                    'email': { required: 'Debe ingresar un correo electrónico.', email: 'Debe ingresar el correo electrónico con el formato correcto. Ejemplo: name@gmail.com.' },
                    'newsletter': 'Debe indicar si quieres recibir nuestra newsletter con ofertas y promociones.',
                    'condiciones': 'Debe aceptar las condiciones.'
                }                
            });
            
            $('#formulario_password').validate({
                rules: {
                    'password': { required: true, minlength: 6 },
                    'password2': { required: true, minlength: 6, equalTo: "#password" }
                },
                messages: {
                    'password': { required: 'Debe ingresar una contraseña.', minlength: 'Debe contener 6 caracteres como mínimo.' },
                    'password2': { required: 'Debe ingresar una contraseña.', minlength: 'Debe contener 6 caracteres como mínimo.', equalTo: 'Debe ser igual al anterior campo.' }
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
    <h1>Panel de control</h1><br />
    <?php 
    if($_SESSION[Uidacceso]==""){
        echo '<p>No tienes acceso</p>';
    } else {
    ?>
    <p>
        <a href="<?php echo $INC_url; ?>/carrito/carrito_paso_uno" title="Tu compra"><img src="<?php echo $INC_url; ?>/img/iconos/blacks/16x16/shop_cart.png" alt="Carrito de la compra" /> <strong>Ir al carrito de la compra actual</strong></a>
    </p><br />
    <p class="menu_panel_control_usuario">
        <a href="<?php echo $INC_url; ?>/login/panel_control" title="Actualizar mis datos">Panel de control</a> |
        <a href="<?php echo $INC_url; ?>/login/panel_control.php?sec=1" title="Actualizar mis datos">Actualizar mis datos</a> | 
        <a href="<?php echo $INC_url; ?>/login/panel_control.php?sec=2" title="Ver mis pedidos">Ver mis pedidos</a> |
        <a href="<?php echo $INC_url; ?>/login/panel_control.php?sec=3" title="Ver mis facturas">Ver mis facturas</a>
    </p><br />
    <?php
        //Vemos que sección sacamos
        $sec=$_GET[sec];
        
        if($sec==1) include ("panel_datos.php");
        if($sec==2) include ("panel_pedidos.php");
        if($sec==3) include ("panel_facturas.php");
        if($sec==4) include ("panel_pedidos_ver.php");
        
        if($sec==""){
            
            
            echo '
            
                <div id="panel_control_usuario">
                    <p>Hola '.$Unombre.', bienvenido a tu panel de control.</p>
                    <p>Actualmente has realizado un total de '.$Unumerocompras.' pedidos.</p>
                 ';
            $mesactual=date('n');
            $fechaultimacompra=cambiaf_a_normal($Ufechaultimacompra);
            $mesultimacompra=explode("/",$fechaultimacompra);
            
            if($mesactual==$mesultimacompra[1] AND $fechaultimacompra!=""){
                echo 'Tu última compra fue el '.$fechaultimacompra.'.';
            } else {
                echo '¡ESTE MES NO HAS HECHO NINGÚN PEDIDO!';
            }
            
           echo '</div>';
            
            
        }
    
        }// si no se ha iniciado sesion no mostramos la informacion
    ?>
        
            
    </div> 
    <div class="limpiar"></div>    
</div>            
<?php include ("../pie.php"); ?>
</body>
</html>