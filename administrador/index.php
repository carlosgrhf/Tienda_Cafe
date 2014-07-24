<?php
// Inicializamos sesion 
session_start();
include('../lib/config.inc.php');
include('../lib/conectar.php');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="Keywords" content="<?php echo $INC_palabras; ?>" />
	<meta name="Description" content="Login del administrador - <?php echo $INC_descripcion; ?>" />
        <meta name="author" content="Hay Canal Web S.L." />
	<meta name="Language" content="es" />
	<meta name="Robots" content="index, follow" />
	<title>Admin</title>
        <!-- Llamadas a Estilos y Reset -->
	<link rel="stylesheet" type="text/css" href="<?php echo $INC_url; ?>/estilos/reset.css" /></link> 
        <link rel="stylesheet" type="text/css" href="<?php echo $INC_url; ?>/estilos/estilos_administrador.css" /></link>
        
        <link href='http://fonts.googleapis.com/css?family=Fredericka+the+Great' rel='stylesheet' type='text/css'>
       
        
        <!-- Ventana de Error -->
        <script type="text/javascript">
                function cerrar() {
                    div = document.getElementById('flotante');
                    div.style.display='none';
                }
        </script> 
</head>
<body>
<?php include('fun_errores.php'); ?> 

    
<div id="login">
    <div id="marco_logo">            
        <a class="logo" href="<?php echo $INC_url; ?>" title="Inicio">
            <p>Café en Cápsula</p>
        </a>
    </div>
    <h1>Panel de Administración</h1><br />
        
    <form id="formulario_login" method="post" action="<?php echo $INC_url; ?>/administrador/fun_login.php">
            <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>* Nombre:</label>
            </div>
                <input class="imput_editar" name="nombre" type="text" id="nombre"  />
            <div class="limpiar"></div>
            <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>* Usuario:</label>
            </div>
                <input class="imput_editar" name="usuario" type="text" id="usuario" />
            <div class="limpiar"></div>
            <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>* Password:</label>
            </div>
                <input class="imput_editar" name="password" type="password" id="password" />
            <div class="limpiar"></div>
            <!-- -------------------------------------------------------------------------------------------- -->
            
         
            

            <input type="hidden" name="action" value="1" />

            <div class="colocar_boton">         
            <input class="boton" type="submit" value="Entrar" />
            </div>
            <div class="limpiar"></div>

        </form>
    
        
    
</div>
    

	
            
</body>
</html>
