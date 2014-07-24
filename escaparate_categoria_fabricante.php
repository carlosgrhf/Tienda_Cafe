<?php
// Inicializamos sesion 
session_start();
include('lib/config.inc.php');
include('lib/conectar.php');
include('fun_acentos.php');
include('fun_acentosyespacios.php');

$Fab=$_GET[Fab];
$Cat=$_GET[Cat];

//consultamos en la base de datos 
$sql = "SELECT DISTINCT Pfabricante FROM Productos ORDER BY Pfabricante asc";
if(!$result = $mysqli->query($sql)){
    die("Query invalido: " . $sql);
}
/* fetch array asociativo*/
while ($fila = $result->fetch_assoc()) {                
    $Pfabricante = utf8_encode($fila["Pfabricante"]); 

    $Pfabricante_arreglado = QuitaAcentosyEspacios($Pfabricante); //arreglamos la url

    if($Fab==$Pfabricante_arreglado){
        $fab=$Pfabricante;
    }

}

/* liberamos la memoria asociada al resultado */
$result->close();

//consultamos en la base de datos 
$sql = "SELECT DISTINCT Pfamilia FROM Productos ORDER BY Pfamilia asc";
if(!$result = $mysqli->query($sql)){
    die("Query invalido: " . $sql);
}
/* fetch array asociativo*/
while ($fila = $result->fetch_assoc()) {                
    $Pfamilia = utf8_encode($fila["Pfamilia"]); 

    $Pfamilia_arreglado = QuitaAcentosyEspacios($Pfamilia); //arreglamos la url

    if($Cat==$Pfamilia_arreglado){
        $cat=$Pfamilia;
    }

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
	<meta name="Description" content="<?php echo $cat; ?> - <?php echo $fab; ?> - <?php echo $INC_descripcion; ?>" />
        <meta name="author" content="Hay Canal Web S.L." />
	<meta name="Language" content="es" />
	<meta name="Robots" content="index, follow" />
	<title><?php echo $INC_titulo; ?> - <?php echo $cat; ?> - <?php echo $fab; ?></title>
        <!-- Llamadas a Estilos y Reset -->
	<link rel="stylesheet" type="text/css" href="<?php echo $INC_url; ?>/estilos/reset.css" /> 
        <link rel="stylesheet" type="text/css" href="<?php echo $INC_url; ?>/estilos/estilos.css" />
        <!-- Google Font -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700,300italic' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Fredericka+the+Great' rel='stylesheet' type='text/css'>
            
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
        
        
    <div class="filtros">
        <p><strong>Filtros</strong></p>
        <?php
        $cat_sin = QuitaAcentos($cat);
        $cat_sinysin = QuitaAcentosyEspacios($cat);
        
        $fab_sin = QuitaAcentos($fab);
        $fab_sinysin = QuitaAcentosyEspacios($fab);
        echo '<p>Fabricante: ';
        //consultamos en la base de datos 
        $sql = "SELECT DISTINCT Pfabricante FROM Productos WHERE Pfamilia='$cat_sin' AND Pdesactivar='no' ORDER BY Pfabricante asc";
        if(!$result = $mysqli->query($sql)){
            die("Query invalido: " . $sql);
        }
        /* fetch array asociativo*/
        while ($fila = $result->fetch_assoc()) {                
            $Pfabricante = utf8_encode($fila["Pfabricante"]); 

            //Pintamos las cajas
            $Pfabricante_arreglado = QuitaAcentosyEspacios($Pfabricante); //arreglamos la url

            echo '<a href="'.$INC_url.'/escaparate_categoria_fabricante/'.$cat_sinysin.'/'.$Pfabricante_arreglado.'" title="'.$Pfabricante.'">'.$Pfabricante.'</a> | ';

        }
        /* liberamos la memoria asociada al resultado */
        $result->close();

        echo '</p><p>Subfamilia: ';

        //consultamos en la base de datos 
        $sql = "SELECT DISTINCT Psubfamilia FROM Productos WHERE Pfamilia='$cat_sin' AND Pdesactivar='no' ORDER BY Psubfamilia asc";
        if(!$result = $mysqli->query($sql)){
            die("Query invalido: " . $sql);
        }
        /* fetch array asociativo*/
        while ($fila = $result->fetch_assoc()) {                
            $Psubfamilia = utf8_encode($fila["Psubfamilia"]); 

            //Pintamos las cajas
            $Psubfamilia_arreglado = QuitaAcentosyEspacios($Psubfamilia); //arreglamos la url

            echo '<a href="'.$INC_url.'/escaparate_categoria_sistema/'.$cat_sinysin.'/'.$Psubfamilia_arreglado.'" title="'.$Psubfamilia.'">'.$Psubfamilia.'</a> | ';

        }
        echo '</p>';
        /* liberamos la memoria asociada al resultado */
        $result->close();
        ?>
    </div>
        
        
    <h1><?php echo $cat; ?></h1>
    
    <?php       
    
    
    //semillas
    echo '<br /><p style="font-size:12pt;">'.$cat.' > '.$fab.'</p>';
    
    echo '<div class="limpiar"></div>';
    
    //escaparate de productos
    echo '<div class="escaparate">';
    
    
    $cat = QuitaAcentos($cat);
    //consultamos en la base de datos 
    $sql = "SELECT * FROM Productos WHERE Pfabricante='$fab_sin' AND Pfamilia='$cat_sin' AND Pdesactivar='no'";
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
    
    //escaparate de productos
    echo '</div>';
    ?>
    
    
    
    </div> 
    <div class="limpiar"></div>    
</div> 
<?php include ("pie.php"); ?>	
            
</body>
</html>
