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
	<title>Newsletter</title>
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
                    'email': { required: true, email: true }
                },
                messages: {
                    'email': { required: 'Debe ingresar un correo electrónico.', email: 'Debe ingresar el correo electrónico con el formato correcto. Ejemplo: name@gmail.com.' }
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
    <h1>Newsletter</h1>
    <br />
    <p style="font-size: 18px; line-height: 22px;">Apuntate a nuestra Newsletter y recibirás promociones y descuentos exclusivos para
    nuestros suscriptores. Muchas gracias!!</p>
    
    <form id="formulario_registro" name="formformulario_registro" method="post" action="<?php echo $INC_url; ?>/login/fun_newsletter.php">
        
        
        <div class="label_registro">
            <label>* Email:</label>
        </div>
        <div class="imput_registro"> 
            <input name="email" type="text" id="email" />
        </div>
        <div class="limpiar"></div>

       
        <input type="hidden" name="action" value="1" />
        
        
        <div class="label_registro">
            <label>&nbsp;</label>
        </div>
        <div class="imput_registro"> 
            <input type="submit" class="marco_submit" value="Me apunto!" />
        </div>
        <div class="limpiar"></div>
        
        

    </form>
    
    
    <br />
    <p style="font-size: 18px; line-height: 22px;">Y si quieres darte de baja puedes hacerlo en cualquier momento.</p>
    
    <form id="formulario_registro" name="formformulario_registro" method="post" action="<?php echo $INC_url; ?>/login/fun_newsletter.php">
        
        
        <div class="label_registro">
            <label>* Email:</label>
        </div>
        <div class="imput_registro"> 
            <input name="email" type="text" id="email" />
        </div>
        <div class="limpiar"></div>

       
        <input type="hidden" name="action" value="2" />
        
        
        <div class="label_registro">
            <label>&nbsp;</label>
        </div>
        <div class="imput_registro"> 
            <input type="submit" class="marco_submit" value="Darme de Baja" />
        </div>
        <div class="limpiar"></div>
        
        

    </form>
    
    
    </div> 
    <div class="limpiar"></div>    
</div> 
<?php include ("../pie.php"); ?>	
            
</body>
</html>