<?php
// Inicializamos sesion 
session_start();
include('lib/config.inc.php');
include('lib/conectar.php');
include('fun_acentos.php');
include('fun_acentosyespacios.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo $INC_url; ?>/favicon.ico" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="Keywords" content="<?php echo $INC_palabras; ?>" />
	<meta name="Description" content="<?php echo $INC_descripcion; ?>" />
        <meta name="author" content="Hay Canal Web S.L." />
	<meta name="Language" content="es" />
	<meta name="Robots" content="index, follow" />
	<title><?php echo $INC_titulo; ?></title>
        <!-- Llamadas a Estilos y Reset -->
	<link rel="stylesheet" type="text/css" href="<?php echo $INC_url; ?>/estilos/reset.css" /> 
        <link rel="stylesheet" type="text/css" href="<?php echo $INC_url; ?>/estilos/estilos.css" />
        <!-- Google Font -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700,300italic' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Fredericka+the+Great' rel='stylesheet' type='text/css'>
        <!-- Slider y Jquery -->    
        <script type="text/javascript" src="<?php echo $INC_url; ?>/lib/StartStopSlider/js/jquery-1.2.6.pack.js"></script>
        <script type="text/javascript" src="<?php echo $INC_url; ?>/lib/StartStopSlider/js/startstop-slider.js"></script>
        
        
            
        <script type="text/javascript">
                function cerrar() {
                    div = document.getElementById('flotante');
                    div.style.display='none';
                }
        </script>   
            
        
        
        
        
        
</head>
<body>
<?php include_once("analyticstracking.php") ?>
<?php include ("marco.php"); ?>
<div id="contenedor">       
    <div id="central">
 
    <?php include ("slider.php"); ?>
        
    
    <div class="escaparate">    
    <?php
       
    //consultamos en la base de datos 
    $sql = "SELECT * FROM Productos WHERE Pdestacado='si' AND Pdesactivar='no'";
    if(!$result = $mysqli->query($sql)){
        die("Query invalido: " . $sql);
    }
    /* fetch array asociativo*/
    while ($fila = $result->fetch_assoc()) {                
        $Pid = utf8_encode($fila["Pid"]);
        $Preferencia = utf8_encode($fila["Preferencia"]);
        $Pnombre = utf8_encode($fila["Pnombre"]);
        $Pdescripcion = utf8_encode($fila["Pdescripcion"]);
        $Pfamilia = utf8_encode($fila["Pfamilia"]);
        $Psubfamilia = utf8_encode($fila["Psubfamilia"]);
        $Pfabricante = utf8_encode($fila["Pfabricante"]);
        $Pprecio = utf8_encode($fila["Pprecio"]);
        $Piva = utf8_encode($fila["Piva"]);
        $Pdestacado = utf8_encode($fila["Pdestacado"]);
        $Poferta = utf8_encode($fila["Poferta"]);
        $Pimagenuno = utf8_encode($fila["Pimagenuno"]);
        $Pimagendos = utf8_encode($fila["Pimagendos"]);
        $Pimagentres = utf8_encode($fila["Pimagentres"]);
        $Pvecescomprado = utf8_encode($fila["Pvecescomprado"]);
        $Pdesactivar = utf8_encode($fila["Pdesactivar"]); 
        $Pobservaciones = utf8_encode($fila["Pobservaciones"]);  
        
        $precioconiva=$Pprecio+$Piva;
        
        $Pnombre_arreglado = QuitaAcentosyEspacios($Pnombre); //arreglamos la url
        
        //creamos el nombre de la primera imagene
        $Pnombre_imagen1=''.$Preferencia.'_1.jpg';
        $valiza1=0;        
        // abrir un directorio y listarlo recursivo 
        $ruta='lib/kcfinder/upload/images/productos';
        if (is_dir($ruta)) { 
           if ($dh = opendir($ruta)) { 
              while (($file = readdir($dh)) !== false) { 
                 if ($file!="." && $file!=".."){ 
                     if($file==$Pnombre_imagen1){
                         $valiza1=1;
                     }
                     if($file==$Pnombre_imagen2){
                         $valiza2=1;
                     } 
                     if($file==$Pnombre_imagen3){
                         $valiza3=1;
                     } 

                 } 
              } 
           closedir($dh); 
           } 
        }else {
           echo "<br>No es ruta valida";
        } 
        /////////////////////PINTAMOS LA CAJA
        echo '<div class="caja">';
        
        echo '<a href="'.$INC_url.'/tienda/'.$Pid.'/'.$Pnombre_arreglado.'" title="'.$Pnombre.'">';
            if($valiza1==1){
                echo '<img src="'.$INC_url.'/lib/kcfinder/upload/images/productos/'.$Preferencia.'_1.jpg" alt="'.$Preferencia.'_1.jpg" style="width: 234px; height: 300px; margin-right: 10px;"></a>';
            } else {
                echo '<img src="'.$INC_url.'/lib/kcfinder/upload/images/productos/sin_foto.jpg" alt="Sin Foto" style="width: 234px; height: 300px; margin-right: 20px;"></a>';
            }
                   
        echo '<div class="caja_nombre">
                <a class="nombre_pro" href="'.$INC_url.'/tienda/'.$Pid.'/'.$Pnombre_arreglado.'" title="'.$Pnombre.'">
                    '.$Pnombre.'
                </a>
                </div>';
        
        echo '<div class="caja_observaciones">'.$Pobservaciones.'</div>';
        
        
        
        echo '<div class="caja_carrito">
                <a class="dinero" href="'.$INC_url.'/comprar/'.$Pid.'/'.$Pnombre_arreglado.'" title="Comprar">'.number_format($precioconiva,2,",",".").' €
                    <img src="'.$INC_url.'/img/iconos/blacks/16x16/shop_cart.png" alt="Comprar" />      
                </a></div>';
        
        
        if($Poferta=="si"){
            echo '<div class="caja_oferta">OFERTA</div>';
            
        }
        
        echo '</div>';
        
    }
    
    /* liberamos la memoria asociada al resultado */
    $result->close();
    ?>
    </div>   
    
    </div>
    
    <div class="limpiar"></div>
</div> 
<?php include ("pie.php"); ?>	
            
</body>
</html>
