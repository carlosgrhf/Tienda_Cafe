<?php
// Inicializamos sesion 
session_start();
include('../lib/config.inc.php');
include('../lib/conectar.php');
include('../fun_fechas.php');
include('../fun_acentos.php');
include('../fun_acentosyespacios.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo $INC_url; ?>/favicon.ico" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="Keywords" content="<?php echo $INC_palabras; ?>" />
	<meta name="Description" content="Contactar - <?php echo $INC_descripcion; ?>" />
        <meta name="author" content="Hay Canal Web S.L." />
	<meta name="Language" content="es" />
	<meta name="Robots" content="index, follow" />
	<title>Contactar</title>
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
                    'tlf': { required: true, number: true },
                    'email': { required: true, email: true },
                    'mensaje': 'required'
                },
                messages: {                    
                    'nombre': 'Debe introducir su nombre.',                    
                    'tlf': { required: 'Debe ingresar un número de teléfono.', number: 'Debe ingresar el número de teléfono con un formato correcto, solo con números. Por ejemplo: 914338585.' },
                    'email': { required: 'Debe ingresar un correo electrónico.', email: 'Debe ingresar el correo electrónico con el formato correcto. Ejemplo: name@gmail.com.' },
                    'mensaje': 'Debe escribir un mensaje.'
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
    <h1>Contactar</h1>
    <br />
    <p style="font-size: 18px; line-height: 22px;">Si necesitas ayuda o tienes cualquier duda, por favor, no dejes de contactar con
        nosotros. Te responderemos lo más rápido posible. Gracias.</p>
    
    <form id="formulario_registro" name="formformulario_registro" method="post" action="<?php echo $INC_url; ?>/login/fun_contactar.php">
        
        
        <div class="label_registro">
            <label>* Nombre:</label>
        </div>
        <div class="imput_registro"> 
            <input name="nombre" type="text" id="nombre" />
        </div>
        <div class="limpiar"></div>
        
        <div class="label_registro">
            <label>* Teléfono:</label>
        </div>
        <div class="imput_registro"> 
            <input name="tlf" type="text" id="tlf" />
        </div>
        <div class="limpiar"></div>
        
        
        <div class="label_registro">
            <label>* Email:</label>
        </div>
        <div class="imput_registro"> 
            <input name="email" type="text" id="email" />
        </div>
        <div class="limpiar"></div>

        <div class="label_registro">        
            <label>* Mensaje:</label>
        </div>
        <div class="imput_registro"> 
        <textarea style="width:500px; height: 150px;" name="mensaje" id="mensaje"></textarea>
        </div>
        <div class="limpiar"></div>

        
        <input type="hidden" name="action" value="1" />
        
        
        <div class="label_registro">
            <label>&nbsp;</label>
        </div>
        <div class="imput_registro"> 
            <input type="submit" class="marco_submit" value="Contactar" />
        </div>
        <div class="limpiar"></div>
        
        

    </form>
    
    </div> 
    <div class="limpiar"></div>    
</div> 
<?php include ("../pie.php"); ?>	
            
</body>
</html>