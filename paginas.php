<?php
// Inicializamos sesion 
session_start();
include('lib/config.inc.php');
include('lib/conectar.php');
include('fun_acentos.php');
include('fun_acentosyespacios.php');

$PAid=$_GET["PAid"];

//consultamos en la base de datos 
    $sql = "SELECT * FROM Paginas WHERE PAid='$PAid'";
    if(!$result = $mysqli->query($sql)){
        die("Query invalido: " . $sql);
    }
    /* fetch array asociativo*/
    while ($fila = $result->fetch_assoc()) {                
        $PAid = utf8_encode($fila["PAid"]);
        $PAtitulo = utf8_encode($fila["PAtitulo"]);
        $PAintro = utf8_encode($fila["PAintro"]);
        $PAcontenido = utf8_encode($fila["PAcontenido"]);
        $PApinchazos = utf8_encode($fila["PApinchazos"]);
            
    }
    /* liberamos la memoria asociada al resultado */
    $result->close();
    
 //SUMAMOS UN PINCHAZO   
 $PApinchazos++;
$query = "UPDATE Paginas SET PApinchazos='$PApinchazos' WHERE PAid=".$PAid."";
            $mysqli->query($query);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo $INC_url; ?>/favicon.ico" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="Keywords" content="<?php echo $INC_palabras; ?>" />
	<meta name="Description" content="<?php echo $PAtitulo; ?>. <?php echo $INC_descripcion; ?>" />
        <meta name="author" content="Hay Canal Web S.L." />
	<meta name="Language" content="es" />
	<meta name="Robots" content="index, follow" />
	<title><?php echo $PAtitulo; ?></title>
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
    <h1><?php echo $PAtitulo; ?></h1>
    <br /><br />
    <div class="intro">
        <?php echo $PAintro; ?>  
    </div>
    <br /><br />
    <div class="contenido">
        <?php echo $PAcontenido; ?>
    </div>
</div> 
<?php include ("pie.php"); ?>	
            
</body>
</html>
