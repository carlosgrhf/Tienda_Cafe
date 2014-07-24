<?php
// Inicializamos sesion 
session_start();
include('../lib/config.inc.php');
include('../lib/conectar.php');
include('fun_fechas.php');

// Comprobamos si existe la variable
if ( empty ( $_SESSION["Ausuario"] ) ) 	// Si no existe
    header('Location: '.$INC_url.'');

$var=$_GET['var'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="Keywords" content="<?php echo $INC_palabras; ?>" />
	<meta name="Description" content="Panel del administrador - <?php echo $INC_descripcion; ?>" />
        <meta name="author" content="Hay Canal Web S.L." />
	<meta name="Language" content="es" />
	<meta name="Robots" content="index, follow" />
	<title>Panel del administrador</title>
        
        <!-- Llamadas a Estilos y Reset -->
	<link rel="stylesheet" type="text/css" href="<?php echo $INC_url; ?>/estilos/reset.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo $INC_url; ?>/estilos/estilos_administrador.css" />
        
        <!-- Llamadas a Estilos del Paginador -->
        <link href="<?php echo $INC_url; ?>/lib/paginador/uds_admin/paginador.css" type="text/css" rel="stylesheet">
           
        <!-- Font -->    
        <link href='http://fonts.googleapis.com/css?family=Fredericka+the+Great' rel='stylesheet' type='text/css'>    
            
        <!-- Llamadas a ckeditor -->
        <script type="text/javascript" src="<?php echo $INC_url; ?>/lib/ckeditor/ckeditor.js"></script>
        
        
        <!-- Llamadas Google Graficos -->
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
        <script type="text/javascript" src="https://www.google.com/jsapi"></script>
        
        
        
        
        <script type="text/javascript">
                function cerrar() {
                    div = document.getElementById('flotante');
                    div.style.display='none';
                }
        </script>   
        
        
        
</head>
<body>
<?php include('fun_errores.php'); ?>     
<?php include('marco.php'); ?>   

    
        <div id="cuerpo">
            <div class="contenedor_cuerpo"> 
            <?php
            if($var==1 OR $var=="" OR $var==11 ) include ('bienvenida.php'); //Bienvenida
            
            if($var==2) include ('usuarios.php'); //Usuarios
            if($var==21) include ('usuarios_editor.php'); //Usuarios
            if($var==22) include ('usuarios_nuevo.php'); //Usuarios
            
            if($var==3) include ('paginas.php'); //Paginas
            if($var==31) include ('paginas_editor.php'); //Paginas
            
            if($var==4) include ('noticias.php'); //Noticias
            if($var==41) include ('noticias_editor.php'); //Noticias
            if($var==42) include ('noticias_nuevo.php'); //Noticias
            
            if($var==5) include ('imagenes.php'); //Imagenes
            
            if($var==6) include ('ficheros.php'); //Ficheros
            
            if($var==7) include ('slider.php'); //Slider
            if($var==71) include ('slider_editor.php'); //Slider
            
            if($var==8) include ('clientes.php'); //Clientes
            if($var==81) include ('clientes_editor.php'); //Clientes
            
            if($var==9) include ('pedidos.php'); //Pedidos
            if($var==91) include ('pedidos_editor.php'); //Pedidos
            
            if($var==10) include ('productos.php'); //Productos
            if($var==101) include ('productos_editor.php'); //Productos
            if($var==102) include ('productos_nuevo.php'); //Productos
            if($var==103) include ('productos_export.php'); //Productos
            
            if($var==12) include ('portes_editor.php'); //Portes
            
            if($var==13) include ('facturas.php'); //Facturas
            
            if($var==14) include ('vales.php'); //Noticias
            if($var==141) include ('vales_editor.php'); //Noticias
            if($var==142) include ('vales_nuevo.php'); //Noticias
            
            if($var==20) include ('newsletter.php'); //Newsletter
            if($var==201) include ('newsletter_editor.php'); //Newsletter
            if($var==202) include ('newsletter_nuevo.php'); //Newsletter
            
            if($var==30) include ('portada.php'); //Portada
            if($var==306) include ('portada_en.php'); //Portada
            if($var==301) include ('portada_editor.php'); //Portada
            if($var==307) include ('portada_editor_en.php'); //Portada
            if($var==302) include ('portada_nuevo.php'); //Portada
            if($var==303) include ('portada_en.php'); //Portada
            if($var==304) include ('portada_editor.php'); //Portada
            if($var==305) include ('portada_nuevo.php'); //Portada
            
            if($var==1000) include ('estadisticas.php'); //Estadisticas
            
            if($var==2000) include ('log.php'); //Log
            
            
            
            
            
            ?>
                
                
            </div>
            
        </div>
        

	
            
</body>
</html>
