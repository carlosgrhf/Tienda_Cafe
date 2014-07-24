<?php
// Inicializamos sesion 
session_start();
include('../lib/config.inc.php');
include('../lib/conectar.php');
include('../fun_fechas.php');
include('../fun_acentos.php');
include('../fun_acentosyespacios.php');

//recogemos el email
$email=$_GET[email];

//recogemos el token
$token=$_GET[token];


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo $INC_url; ?>/favicon.ico" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="Keywords" content="<?php echo $INC_palabras; ?>" />
	<meta name="Description" content="Recordar contraseña - <?php echo $INC_descripcion; ?>" />
        <meta name="author" content="Hay Canal Web S.L." />
	<meta name="Language" content="es" />
	<meta name="Robots" content="index, follow" />
	<title><?php echo $INC_titulo; ?> - Recordar contraseña</title>
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
                    'password': { required: true, minlength: 6 },
                    'repetirpassword': { required: true, minlength: 6, equalTo: "#password" }
                },
                messages: {
                    'password': { required: 'Debe ingresar una contraseña.', minlength: 'Debe contener 6 caracteres como mínimo.' },
                    'repetirpassword': { required: 'Debe ingresar una contraseña.', minlength: 'Debe contener 6 caracteres como mínimo.', equalTo: 'Debe ser igual al anterior campo.' }
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
<?php include ("../marco.php"); ?>
<div id="contenedor">
    <?php include ("../lateral.php"); ?> 
    <div id="central_producto">
    <h1>Cambiar contraseña</h1>
    <form id="formulario_registro" name="formformulario_registro" method="post" action="<?php echo $INC_url; ?>/login/fun_cambiar_pass.php">
        
        <p>Ya puedes cambiar tu contraseña.</p><br />
        
        <div style="float:left; width:125px; text-align: right; padding-right: 1%; margin-bottom: 2%;">
        <label>* Nueva contraseña:</label>
        </div>
        <div style="float:left; width:500px; margin-bottom: 2%;">
        <input name="password" type="password" id="password" />
        </div>
        <div class="limpiar"></div>       
        
        <div style="float:left; width:125px; text-align: right; padding-right: 1%; margin-bottom: 2%;">
        <label>* Repetir contraseña:</label>
        </div>
        <div style="float:left; width:500px; margin-bottom: 2%;">
        <input name="repetirpassword" type="password" id="repetirpassword" />
        </div>
        <div class="limpiar"></div>
        
        <input type="hidden" name="email" value="<?php echo $email; ?>"/>
        <input type="hidden" name="token" value="<?php echo $token; ?>"/>
        <div style="float:left; width:280px; text-align: right; padding-right: 1%; margin-bottom: 2%;"> 
        <input type="submit" class="marco_submit" value="Enviar" />
        </div>
        <div class="limpiar"></div>
    </form>
    
    </div> 
    <div class="limpiar"></div>
    <?php include ("../pie.php"); ?>
</div> 
	
            
</body>
</html>