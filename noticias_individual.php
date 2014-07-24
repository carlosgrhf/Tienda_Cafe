<?php
// Inicializamos sesion 
session_start();
include('lib/config.inc.php');
include('conectar.php');
include('fun_acentos.php');
include('fun_acentosyespacios.php');
include('fun_fechas.php');



$sql = "SELECT * FROM Noticias WHERE Nid='$_GET[Nid]'";
if(!$result = $mysqli->query($sql)){
    die("Query invalido: " . $sql);
}          
/* fetch array asociativo*/
while ($fila = $result->fetch_assoc()) {
    $Nid = utf8_encode($fila["Nid"]);
    $Ntitulo = utf8_encode($fila["Ntitulo"]);
    $Nfecha = cambiaf_a_normal(utf8_encode($fila["Nfecha"]));
    $Ndescripcion = utf8_encode($fila["Ndescripcion"]);
    $Ncontenido = utf8_encode($fila["Ncontenido"]);
    $Nimagenuno = utf8_encode($fila["Nimagenuno"]);
    $Nimagendos = utf8_encode($fila["Nimagendos"]);
    $Nimagentres = utf8_encode($fila["Nimagentres"]);
    $Nvisitas = utf8_encode($fila["Nvisitas"]);

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
        <meta name="Description" content="<?php echo strip_tags($Ndescripcion); ?>" />
        <meta name="author" content="Hay Canal Web S.L." />
	<meta name="Language" content="es" />
	<meta name="Robots" content="index, follow" />
	<title><?php echo $Ntitulo; ?> - <?php echo $INC_titulo; ?></title>
        <!-- Llamadas a Estilos y Reset -->
	<link rel="stylesheet" type="text/css" href="<?php echo $INC_url; ?>/estilos/reset.css" /> 
        <link rel="stylesheet" type="text/css" href="<?php echo $INC_url; ?>/estilos/estilos.css" />
        <!-- Llamadas a Estilos del Paginador -->
        <link href="<?php echo $INC_url; ?>/lib/paginador/cafeencapsula/paginador.css" type="text/css" rel="stylesheet"></link>
        <!-- Google Font -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700,300italic' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Fredericka+the+Great' rel='stylesheet' type='text/css'>


<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>

</head>
<body>
<?php include_once("analyticstracking.php") ?>
<?php include ("marco.php"); ?>
<div id="contenedor"> 
    <?php include ("lateral.php"); ?>    
    <div id="central_producto">
        <h1>Noticias</h1>        
            
    <?php
    
    
       $sql = "SELECT * FROM Noticias WHERE Nid='$_GET[Nid]'";
        if(!$result = $mysqli->query($sql)){
            die("Query invalido: " . $sql);
        }          
        /* fetch array asociativo*/
        while ($fila = $result->fetch_assoc()) {
            $Nid = utf8_encode($fila["Nid"]);
            $Ntitulo = utf8_encode($fila["Ntitulo"]);
            $Nfecha = cambiaf_a_normal(utf8_encode($fila["Nfecha"]));
            $Ndescripcion = utf8_encode($fila["Ndescripcion"]);
            $Ncontenido = utf8_encode($fila["Ncontenido"]);
            $Nimagenuno = utf8_encode($fila["Nimagenuno"]);
            $Nimagendos = utf8_encode($fila["Nimagendos"]);
            $Nimagentres = utf8_encode($fila["Nimagentres"]);
            $Nvisitas = utf8_encode($fila["Nvisitas"]);

        }
        /* liberamos la memoria asociada al resultado */
        $result->close();         
        
        echo '
            <p style="font-size:12pt;">
            <a href="'.$INC_url.'" title="Café en Capsulas">Inicio</a> > 
            <a href="'.$INC_url.'/noticias/listado/0" title="Noticias">Noticias</a> >
            '.$Ntitulo.'</p>    
        ';
        
        
        echo '
            <div class="noticias">
                <h2>'.$Ntitulo.'</h2>
                <div>';
        
         if($Nimagenuno!=""){
             echo '<img style="margin-right:1%;" src="'.$INC_url.'/img/news/'.$Nimagenuno.'" alt="'.$Ntitulo.'" />';
         } 
         if($Nimagendos!=""){
             echo '<img style="margin-right:1%;" src="'.$INC_url.'/img/news/'.$Nimagendos.'" alt="'.$Ntitulo.'" />';
         }
         if($Nimagentres!=""){
             echo '<img style="margin-right:1%;" src="'.$INC_url.'/img/news/'.$Nimagentres.'" alt="'.$Ntitulo.'" />';
         }
                        
         echo '           
                </div>
                <p>'.$Nfecha.'</p>
                '.$Ndescripcion.'
                '.$Ncontenido.'
                <div class="limpiar"></div>
            </div>
        ';
        
         
         $Nvisitas++;
    //ACTUALIZAMOS LAS VISITAS
$query = "UPDATE Noticias SET Nvisitas='$Nvisitas' WHERE Nid='$Nid'";
$mysqli->query($query); 
    
    ?>
        
        <span class='st_facebook_vcount' displayText='Facebook'></span>
        <span class='st_twitter_vcount' displayText='Tweet'></span>
        <span class='st_meneame_vcount' displayText='Meneame'></span>
        <span class='st_google_vcount' displayText='Google'></span>
        <span class='st_linkedin_vcount' displayText='LinkedIn'></span>
        <span class='st_email_vcount' displayText='Email'></span>
        <span class='st_fblike_vcount' displayText='Facebook Like'></span>
        <span class='st_plusone_vcount' displayText='Google +1'></span>
    </div> 
    <div class="limpiar"></div>
    <?php include ("pie.php"); ?>
</div> 
	
            
</body>
</html>
