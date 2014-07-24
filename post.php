<?php
// Inicializamos sesion 
session_start();
include('lib/config.inc.php');
include('lib/conectar.php');
include('fun_acentos.php');
include('fun_acentosyespacios.php');
include('fun_fechas.php');

$Nid=$_GET["Nid"];

//consultamos en la base de datos 
    $sql = "SELECT * FROM Noticias WHERE Nid='$Nid'";
    if(!$result = $mysqli->query($sql)){
        die("Query invalido: " . $sql);
    }
    /* fetch array asociativo*/
    while ($fila = $result->fetch_assoc()) {                
        $Nid = utf8_encode($fila["Nid"]);
        $Ntitulo = utf8_encode($fila["Ntitulo"]);
        $Nsubtitulo = utf8_encode($fila["Nsubtitulo"]);
        $Nfecha = utf8_encode($fila["Nfecha"]);
        $Nprecontenido = utf8_encode($fila["Nprecontenido"]);
        $Ncontenido = utf8_encode($fila["Ncontenido"]);
        $Nimg = utf8_encode($fila["Nimg"]);
        $Nvisitas = utf8_encode($fila["Nvisitas"]);
            
    }
    /* liberamos la memoria asociada al resultado */
    $result->close();
    
 //SUMAMOS UN PINCHAZO   
 $Nvisitas++;
$query = "UPDATE Noticias SET Nvisitas='$Nvisitas' WHERE Nid=".$Nid."";
            $mysqli->query($query);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo $INC_url; ?>/favicon.ico" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="Keywords" content="<?php echo $INC_palabras; ?>" />
	<meta name="Description" content="<?php echo $Ntitulo; ?>. <?php echo $INC_descripcion; ?>" />
        <meta name="author" content="Hay Canal Web S.L." />
	<meta name="Language" content="es" />
	<meta name="Robots" content="index, follow" />
	<title><?php echo $Ntitulo; ?></title>
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
    <h3><a href="<?php echo $INC_url; ?>/blog/portada" title="Blog">Volver al Blog</a></h3>
    <br />
    <div class="noticias">
        <h1><?php echo $Ntitulo; ?></h1>
        <br />
        <h2><?php echo $Nsubtitulo; ?></h2>
        <br />
        <?php echo cambiaf_a_normal($Nfecha); ?> 
        <br /><br />
        <img src="<?php echo $INC_url; ?>/lib/kcfinder/upload/images/blog_img/<?php echo $Nimg; ?>" alt="<?php echo $Ntitulo; ?>" />  
    </div>
        
    <br />
    <div class="contenido">
        <?php echo $Nprecontenido; ?>
        <br />
        <?php echo $Ncontenido; ?>
    </div>
    <br />
    <h3><a href="<?php echo $INC_url; ?>/blog/portada" title="Blog">Volver al Blog</a></h3>
</div> 
<?php include ("pie.php"); ?>	
            
</body>
</html>
