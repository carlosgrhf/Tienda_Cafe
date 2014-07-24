<?php
// Inicializamos sesion 
session_start();
include('lib/config.inc.php');
include('lib/conectar.php');
include('fun_acentos.php');
include('fun_acentosyespacios.php');
include('fun_fechas.php');

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo $INC_url; ?>/favicon.ico" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="Keywords" content="<?php echo $INC_palabras; ?>" />
	<meta name="Description" content="Blog. <?php echo $INC_descripcion; ?>" />
        <meta name="author" content="Hay Canal Web S.L." />
	<meta name="Language" content="es" />
	<meta name="Robots" content="index, follow" />
	<title>Blog</title>
        <!-- Llamadas a Estilos y Reset -->
	<link rel="stylesheet" type="text/css" href="<?php echo $INC_url; ?>/estilos/reset.css" /> 
        <link rel="stylesheet" type="text/css" href="<?php echo $INC_url; ?>/estilos/estilos.css" />
        <!-- Google Font -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700,300italic' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Fredericka+the+Great' rel='stylesheet' type='text/css'>
            
        
</head>
<body>
<?php include_once("analyticstracking.php") ?>
<?php include ("marco.php"); ?>
<div id="contenedor">         
    <h1>Blog</h1>
    <br />
    <?php
    
        
    $sql = "SELECT * FROM Noticias ORDER BY Nid desc";
        if(!$result = $mysqli->query($sql)){
            die("Query invalido: " . $sql);
        }          
        $total_registros = $result->num_rows;
        /* liberamos la memoria asociada al resultado */
        $result->close();
    
    // Parametros a ser usados por el Paginador.
    $cantidadRegistrosPorPagina	= 10;
    $cantidadEnlaces            = 10; // Cantidad de enlaces que tendra el paginador.
    $totalRegistros             = $total_registros;
    $pagina                     = isset($_GET['pagina'])? $_GET['pagina'] : 0;
    
    // Comenzamos incluyendo el Paginador.
    require_once 'fun_paginador.php';
    
    // Instanciamos la clase Paginador
    $paginador = new Paginador();

    // Configuramos cuanto registros por pagina que debe ser igual a el limit de la consulta mysql
    $paginador->setCantidadRegistros($cantidadRegistrosPorPagina);
    // Cantidad de enlaces del paginador sin contar los no numericos.
    $paginador->setCantidadEnlaces($cantidadEnlaces);
    
    // Agregamos estilos al Paginador
    $paginador->setClass('primero',         'previous');
    $paginador->setClass('bloqueAnterior',  'previous');
    $paginador->setClass('anterior',        'previous');
    $paginador->setClass('siguiente',       'next');
    $paginador->setClass('bloqueSiguiente', 'next');
    $paginador->setClass('ultimo',          'next');
    $paginador->setClass('numero',          '<>');
    $paginador->setClass('actual',          'active');
    
    // Y mandamos a paginar desde la pagina actual y le pasamos tambien el total
    // de registros de la consulta mysql.
    $datos = $paginador->paginar($pagina, $totalRegistros);
    
    if($pagina>0){
        $inicio = $pagina * $cantidadRegistrosPorPagina;
    } else {
        $inicio = 0;
    }
    
    $sql = "SELECT * FROM Noticias ORDER BY Nid desc LIMIT ".$inicio.",".$cantidadRegistrosPorPagina." ";
    if(!$result = $mysqli->query($sql)){
        die("Query invalido: " . $sql);
    }          
    /* fetch array asociativo*/
    while ($fila = $result->fetch_assoc()) {
        $Nid = utf8_encode($fila["Nid"]);
        $Ntitulo = utf8_encode($fila["Ntitulo"]);
        $Nsubtitulo = utf8_encode($fila["Nsubtitulo"]);
        $Nfecha = cambiaf_a_normal(utf8_encode($fila["Nfecha"]));
        $Nprecontenido = utf8_encode($fila["Nprecontenido"]);
        $Ncontenido = utf8_encode($fila["Ncontenido"]);
        $Nimg = utf8_encode($fila["Nimg"]);
        $Nvisitas = utf8_encode($fila["Nvisitas"]);
        
        $Ntitulo_arreglado=QuitaAcentosyEspacios($Ntitulo);
        
        
        echo '
            <div class="noticias">
                <h2 style=font-size:30px;><a href="'.$INC_url.'/post/'.$Nid.'/'.$Ntitulo_arreglado.'" title="'.$Ntitulo.'">'.$Ntitulo.'</a></h2>
                <br />
                <h3>'.$Nsubtitulo.'</h3>
                <br />
                '.$Nfecha.'
                <br /><br />
                <a href="'.$INC_url.'/post/'.$Nid.'/'.$Ntitulo_arreglado.'" title="'.$Ntitulo.'">
                    <img src="'.$INC_url.'/lib/kcfinder/upload/images/blog_img/'.$Nimg.'" alt="'.$Ntitulo.'" />
                </a>
            </div>
            <br />
            <div class="contenido">
                '.$Nprecontenido.'
                <a style="font-weight:bold; text-align:right;" href="'.$INC_url.'/post/'.$Nid.'/'.$Ntitulo_arreglado.'" title="'.$Ntitulo.'">Leer post completo</a>
            </div>
            <hr>
        ';
        
    }
    /* liberamos la memoria asociada al resultado */
    $result->close();
    
    // Preguntamos si retorno algo, si retorno paginamos. Nos retorna un arreglo
    // que se puede usar para paginar del modo clasico. Si queremos paginar con
    // el enlace ya confeccionado realizamos lo siguiente.
    if ($datos) {
        $enlaces = $paginador->getHtmlPaginacion('pagina', 'li');
    ?>
    <ul id="pagination-digg">
    <?php
        foreach ($enlaces as $enlace) {
            echo $enlace . "\n";
        }
    ?>
    </ul>
    <br /><br />
    <?php
    }
    ?>
</div> 
<?php include ("pie.php"); ?>	
            
</body>
</html>
