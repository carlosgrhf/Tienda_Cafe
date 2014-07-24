<?php
// Inicializamos sesion 
session_start();
include('../lib/config.inc.php');
include('../lib/conectar.php');
include('../fun_fechas.php');
include('../fun_acentos.php');
include('../fun_acentosyespacios.php');

//iniciamos las variables totales
$total_cantidad_carrito=0;
$total_carrito=0;

//SACAMOS EL COSTE DEL PORTE Y EL LIMITE PARA QUE SEA GRATUITO
$sql = "SELECT * FROM Gastos_Envio WHERE GEid=1";
if(!$result = $mysqli->query($sql)){
    die("Query invalido: " . $sql);
}
/* fetch array asociativo*/
while ($fila = $result->fetch_assoc()) {                
    $GEportes = utf8_encode($fila["GEportes"]);
    $GElimite = utf8_encode($fila["GElimite"]);
}
$portes_texto=$GEportes;
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
	<meta name="Description" content="Carrito de la compra - <?php echo $INC_descripcion; ?>" />
        <meta name="author" content="Hay Canal Web S.L." />
	<meta name="Language" content="es" />
	<meta name="Robots" content="index, follow" />
	<title>Carrito de la compra - <?php echo $INC_titulo; ?></title>
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
<?php include_once("../analyticstracking.php") ?>   
<?php include ("../marco.php"); ?>
<div id="contenedor">
    <div id="central_producto">        
        <h1>Carrito de la Compra</h1><br />
    <?php
    //GUARDAMOS EL ID DE LA SESION
    $session = session_id();
    
    $sql = "SELECT * FROM Carrito_Temporal WHERE CTsesion = '$session'";
        if(!$result = $mysqli->query($sql)){
            die("Query invalido: " . $sql);
        }          
        $total_registros = $result->num_rows;
        /* liberamos la memoria asociada al resultado */
        $result->close();
    
    if($total_registros>0){         
    
    echo '
        <table class="tabla">
        <caption>Número total de productos en tu carrito: '.$total_registros.'</caption>
        <thead>
        <tr>
        <th style="width:35%;">Producto</th>
        <th style="width:15%;">PVP</th>
        <th style="width:25%;">Unidades</th>
        <th style="width:15%;">Total</th>
        <th style="width:10%;">Borrar</th>
        </tr>
        </thead>
        <tbody>
        
        
            
        

    ';
    //consultamos en la base de datos 
    $sql = "SELECT * FROM Carrito_Temporal WHERE CTsesion='$session'";
    if(!$result = $mysqli->query($sql)){
        die("Query invalido: " . $sql);
    }
    /* fetch array asociativo*/
    while ($fila = $result->fetch_assoc()) {                
        $CTid = utf8_encode($fila["CTid"]);
        $CT_Uid = utf8_encode($fila["CT_Uid"]);
        $CT_Pid = utf8_encode($fila["CT_Pid"]);
        $CTsesion = utf8_encode($fila["CTsesion"]);
        $CTcantidad = utf8_encode($fila["CTcantidad"]);
        $CTpreciototal = utf8_encode($fila["CTpreciototal"]);
        $CTfecha = utf8_encode($fila["CTfecha"]);
        $CTpreciounitario = utf8_encode($fila["CTpreciounitario"]);
        $CT_Vid = utf8_encode($fila["CT_Vid"]);
        
        if($CT_Vid!="" AND $CT_Vid!=0) {
            $vale="si";
            $idvale=$CT_Vid;
        }
        
        //sumamos los totales
        $total_cantidad_carrito=$total_cantidad_carrito+$CTcantidad;
        $total_carrito=$total_carrito+$CTpreciototal;
        
        //Hay que sacar el nombre del producto que no está en el carrito temporal
        //consultamos en la base de datos 
        $sql2 = "SELECT * FROM Productos WHERE Pid='$CT_Pid'";
        if(!$result2 = $mysqli->query($sql2)){
            die("Query invalido: " . $sql2);
        }
        /* fetch array asociativo*/
        while ($fila2 = $result2->fetch_assoc()) {                
            $Pnombre = utf8_encode($fila2["Pnombre"]);
            $Pfamilia = utf8_encode($fila2["Pfamilia"]);
            $Psubfamilia = utf8_encode($fila2["Psubfamilia"]);
            $Pfabricante = utf8_encode($fila2["Pfabricante"]);
        }
        /* liberamos la memoria asociada al resultado */
        $result2->close();
        
        echo '
            <tr>
                <td>
                    '.$Pnombre.'<br />
                    <span style="font-size:10pt;">'.$Pfamilia.' | '.$Psubfamilia.' | '.$Pfabricante.'</span>
                </td>
                <td>'.number_format($CTpreciounitario, 2, ",", "").' €</td>
                <td><span style="float:left;margin-left: 48px; margin-right:30px; margin-top: 6px; font-size:20px">'.$CTcantidad.'</span>
                    <form id="formulario_carrito_unidades" name="formulario_carrito_unidades" method="post" action="'.$INC_url.'/carrito/actualizar_unidades.php">
                        
                        <div style="float:left;">                        
                        <select name="unidades" id="unidades" class="select_class_carrito">
                            <option value="1"></option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                            <option value="13">13</option>
                            <option value="14">14</option>
                            <option value="15">15</option>
                            <option value="16">16</option>
                            <option value="17">17</option>
                            <option value="18">18</option>
                            <option value="19">19</option>
                            <option value="20">20</option>
                            <option value="21">21</option>
                            <option value="22">22</option>
                            <option value="23">23</option>
                            <option value="24">24</option>
                            <option value="25">25</option>
                            <option value="26">26</option>
                            <option value="27">27</option>
                            <option value="28">28</option>
                            <option value="29">29</option>
                            <option value="30">30</option>
                        </select>
                        </div>

                        <input type="hidden" name="Pid" value="'.$CT_Pid.'" />                        
                        <div style="float:left; width:50px; margin-left: 2%;"> 
                        <input type="submit" class="submit_class_carrito" style="width: 70px;" value="Cambiar" />
                        </div>	
                        
                    </form>
                </td>
                <td>'.number_format($CTpreciototal, 2, ",", "").' €</td>
                <td>                    
                    <a href="'.$INC_url.'/actualizar/'.$CT_Pid.'" title="Borrar producto">
                    <img src="'.$INC_url.'/img/iconos/blacks/16x16/delete.png" alt="Borrar producto" />
                    </a>
                </td>
            </tr>
        ';
    }
    /* liberamos la memoria asociada al resultado */
    $result->close();
    
    //SI SE HA INTRODUCIDO UN VALE SACAMOS LA INFORMACION DEL VALE, HACEMOS LA CUENTA Y LO MOSTRAMOS, TAMBIEN SE PUEDE BORRAR
    if($vale=="si"){     
        
        //consultamos en la base de datos 
        $sql = "SELECT * FROM Vales WHERE Vid='$idvale'";
        if(!$result = $mysqli->query($sql)){
            die("Query invalido: " . $sql);
        }
        /* fetch array asociativo*/
        while ($fila = $result->fetch_assoc()) { 
            $Vvale = utf8_encode($fila["Vvale"]);
            $Vvalor = utf8_encode($fila["Vvalor"]);
        }
        /* liberamos la memoria asociada al resultado */
        $result->close();
        
        $total_carrito=$total_carrito-($total_carrito*$Vvalor/100);
        
        echo '
        <tr>
                <td>Código promocional</td>
                <td>'.$Vvale.'</td>
                <td></td>
                <td>- '.$Vvalor.' %</td>
                <td>
                    <a href="'.$INC_url.'/carrito/quitar_vale_descuento" title="Borrar código promocional">
                        <img src="'.$INC_url.'/img/iconos/blacks/16x16/delete.png" alt="Borrar código promocional" />
                    </a>
                </td>
        </tr>';
    }
    
    
    
    //CALCULAMOS LOS GASTOS DE ENVIO
    if($GElimite<$total_carrito){
        $GEportes=0.00;
    } else {
        $total_carrito=$total_carrito+$GEportes;
    }
    
    echo '
        <tr>
                <td>Gastos de envío</td>
                <td></td>
                <td></td>
                <td>'.number_format($GEportes, 2, ",", "").' €</td>
                <td></td>
        </tr>
        <tr class="total">
                <td></td>
                <td>Total</td>
                <td>'.$total_cantidad_carrito.'</td>
                <td>'.number_format($total_carrito, 2, ",", "").' €</td>
                <td>Iva incluido</td>
        </tr>
        </tbody>
        </table>
        <br />
    ';
    
    if($vale!="si"){     
    echo '
        <form method="post" action="'.$INC_url.'/carrito/fun_vale_descuento.php">
            
            <div class="label_vale">
                <label>* Código Promocional:</label>
            </div>
                <input class="imput_vale" name="vale" type="text" />

            <input type="submit" class="boton_vale" value="Vale" />           
            

        </form>    
        

<div class="limpiar"></div>
    ';
    }
    
    if($_SESSION[Uidacceso]==""){
        echo '<p style="text-align: right; font-size:14pt;"><strong>Para completar tu pedido tienes que identificarte o 
            <a href="'.$INC_url.'/login/registro" title="Regístrate para hacer tu pedido">registrarte</a>
            si aún no lo has hecho.</strong></p>';
    } else {
        echo '<p style="text-align: right; font-size:14pt;">
            <a href="'.$INC_url.'/carrito/carrito_paso_dos" title="Continuar"><strong>Pedido terminado, pasar a confirmar mis datos de envio.</strong></a></p>';
    }
    
    ?>
      
    <br />
    <div style="font-size:16px; line-height: 22px;">  
        <p>*Gastos de envío dentro de la peninsula ibérica = <?php echo $portes_texto; ?> €</p>    
        <p>*Gastos de envío gratis a partir de pedidos superiores a <?php echo $GElimite; ?> €</p>
        <p>*Gastos de envío fuera de la peninsula ibérica = Solo pedidos teléfonicos. Contactar</p>
        <p>*Todos los precios tienen el Iva incluido.</p>
    </div>
    <?php
    } else {//condicion si el carrito tiene 0 productos no muestra la tabla
        echo '<br /><img src="'.$INC_url.'/img/iconos/blacks/48x48/shop_cart.png" alt="Carrito de la compra" style="float:left;"/>
              <br /><p style="font-size:24px; margin-left:90px;">El carrito de la compra está vacio.</p>';
    }
    ?>
    
    </div> 
    <div class="limpiar"></div>    
</div> 
<?php include ("../pie.php"); ?>	
            
</body>
</html>