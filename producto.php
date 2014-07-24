<?php
// Inicializamos sesion 
session_start();
include('lib/config.inc.php');
include('lib/conectar.php');
include('fun_acentos.php');
include('fun_acentosyespacios.php');

$Pid=$_GET["Pid"];

//consultamos en la base de datos 
    $sql = "SELECT * FROM Productos WHERE Pid='$Pid' AND Pdesactivar='no'";
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
                
    }
    
    //creamos los nombres de las 3 imagenes
    $Pnombre_imagen1=''.$Preferencia.'_1.jpg';
    $Pnombre_imagen2=''.$Preferencia.'_2.jpg';
    $Pnombre_imagen3=''.$Preferencia.'_3.jpg';
    
    $valiza1=0;
    $valiza2=0;
    $valiza3=0;
    
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
       }else 
          echo "<br>No es ruta valida";
    
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
	<meta name="Description" content="<?php echo $Pnombre; ?>. <?php echo $Pfabricante; ?>. <?php echo number_format($precioconiva,2,",","."); ?> €. Sistema <?php echo $Psubfamilia; ?>." />
        <meta name="author" content="Hay Canal Web S.L." />
	<meta name="Language" content="es" />
	<meta name="Robots" content="index, follow" />
	<title><?php echo $Pnombre; ?>. <?php echo $Pfabricante; ?>.</title>
        <!-- Llamadas a Estilos y Reset -->
	<link rel="stylesheet" type="text/css" href="<?php echo $INC_url; ?>/estilos/reset.css" /> 
        <link rel="stylesheet" type="text/css" href="<?php echo $INC_url; ?>/estilos/estilos.css" />
        <!-- Google Font -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700,300italic' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Fredericka+the+Great' rel='stylesheet' type='text/css'>
            
        <!-- Fancybox -->
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo $INC_url; ?>/lib/fancybox/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
        <script type="text/javascript" src="<?php echo $INC_url; ?>/lib/fancybox/fancybox/jquery.easing-1.4.pack.js"></script>
        <script type="text/javascript" src="<?php echo $INC_url; ?>/lib/fancybox/fancybox/jquery.mousewheel-3.0.4.pack.js"> </script>
        <link rel="stylesheet" href="<?php echo $INC_url; ?>/lib/fancybox/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
        <script type="text/javascript">
                $(document).ready(function() {
                    /* This is basic - uses default settings */
                    $("a#single_image").fancybox();
                    /* Using custom settings */
                    $("a#inline").fancybox({
                            'hideOnContentClick': true
                    });
                    /* Apply fancybox to multiple items */
                    $("a.group").fancybox({
                            'transitionIn'	:	'elastic',
                            'transitionOut'	:	'elastic',
                            'speedIn'		:	600, 
                            'speedOut'		:	200, 
                            'overlayShow'	:	false
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
<?php include_once("analyticstracking.php") ?>
<?php include ("marco.php"); ?>
<div id="contenedor">         
    <?php
    //consultamos en la base de datos 
    $sql = "SELECT * FROM Productos WHERE Pid='$Pid' AND Pdesactivar='no'";
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
                
    }
    
    /* liberamos la memoria asociada al resultado */
    $result->close();
    ?>
    <div id="central_producto">        
        <div class="mitad_producto">
        <?php
            if($valiza1==1){
                echo '<a class="group" rel="group1" href="'.$INC_url.'/lib/kcfinder/upload/images/productos/'.$Preferencia.'_1.jpg" alt="'.$Preferencia.'_1.jpg">
                            <img src="'.$INC_url.'/lib/kcfinder/upload/images/productos/'.$Preferencia.'_1.jpg" alt="'.$Preferencia.'_1.jpg" style="float: left; width: 300px; height: 400px; margin-right: 20px;">
                       </a><div class="limpiar"></div>';
            } else {
                echo '<img src="'.$INC_url.'/lib/kcfinder/upload/images/productos/sin_foto.jpg" alt="Sin Foto" style="float: left; width: 250px; margin-right: 20px;">';
            }
            if($valiza2==1){
                echo '<a class="group" rel="group1" href="'.$INC_url.'/lib/kcfinder/upload/images/productos/'.$Preferencia.'_2.jpg" alt="'.$Preferencia.'_2.jpg">
                            <img src="'.$INC_url.'/lib/kcfinder/upload/images/productos/'.$Preferencia.'_2.jpg" alt="'.$Preferencia.'_2.jpg" style="float: left; width: 50px; height: 67px; margin-right: 6px; margin-top: 2px;">
                       </a>';
            } 
            if($valiza3==1){
                echo '<a class="group" rel="group1" href="'.$INC_url.'/lib/kcfinder/upload/images/productos/'.$Preferencia.'_3.jpg" alt="'.$Preferencia.'_3.jpg">
                            <img src="'.$INC_url.'/lib/kcfinder/upload/images/productos/'.$Preferencia.'_3.jpg" alt="'.$Preferencia.'_3.jpg" style="float: left; width: 50px; height: 67px; margin-top: 2px;">
                       </a>';
            } 
        ?>
        </div>
        <div class="mitad_producto2">
            <h1><?php echo $Pnombre; ?></h1><br />
            <div class="caja_tags2">
                <p>Referencia: <?php echo $Preferencia; ?></p>                
            </div>
            <div class="caja_contenido2">
                <?php echo $Pdescripcion; ?>                 
            </div>
            

            
            <div class="caja_observaciones2">
                <p><strong>Observaciones: </strong><?php echo $Pobservaciones; ?></p>           
            </div>
            
            <div class="caja_carrito2">
                <?php
                echo '
                <a href="'.$INC_url.'/comprar/'.$Pid.'/'.$Pnombre_arreglado.'" title="Comprar">'.number_format($precioconiva,2,",",".").' €
                    <img src="'.$INC_url.'/img/iconos/blacks/32x32/shop_cart.png" alt="Comprar" />   
                    <span style="font-size:12pt;">Añadir al carrito</span>
                </a>
                ';
                ?> 
            </div>
            
            
            <p style="float:right; font-size: 12pt; margin-right: 3%;">Iva incluido</p>         
        </div>
        <div class="limpiar"></div>
    </div>
       
</div> 
<?php include ("pie.php"); ?>	
            
</body>
</html>
