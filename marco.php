<?php

    $session = session_id();
    
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
    /* liberamos la memoria asociada al resultado */
    $result->close();

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

        //sumamos los totales
        $total_cantidad_carrito=$total_cantidad_carrito+$CTcantidad;
        $total_carrito=$total_carrito+$CTpreciototal;


    }
    /* liberamos la memoria asociada al resultado */
    $result->close();

    //CALCULAMOS LOS GASTOS DE ENVIO
    if($GElimite<$total_carrito){
        $GEportes=0.00;
    } else {
        if($total_carrito!=0){
            $total_carrito=$total_carrito+$GEportes;
        }
    }
    
    
    

?>
<?php include('fun_errores.php'); ?>
<div class="submarco">
    <div style="width: 1000px; margin: 0 auto;">
    
    <div id="marco_login">
        <?php
        if ($_SESSION[Uidacceso]==""){             
        ?>
        <form name="formformulario_login" method="post" action="<?php echo $INC_url; ?>/login/validar_acceso.php">

            <div class="label_login">
                <label>* Email:</label>
            </div>
                <input class="imput_login" name="email" type="text" />


            <div class="label_login">
                <label>* Contraseña:</label>
            </div>
            
                <input class="imput_login" name="password" type="password" />
            

            <input type="hidden" name="id" value="<?php echo $Pid; ?>" />
            <input type="hidden" name="action" value="1" />
            
            
            <input type="submit" class="boton_entrar" value="Entrar" />
            

            <div style="float:left; width:146px; margin-left: 8px; margin-top: 2px; font-size:14px;"> 
                <a class="password" href="<?php echo $INC_url; ?>/login/recordar" title="Recordar contraseña">¿Contraseña olvidada?</a>
            </div>

        </form>            
    <?php
        } else {
    ?>
        <div style="float:left; width:520px; text-align: left; margin-left: 40px; margin-bottom: 10px;">
            <img src="<?php echo $INC_url; ?>/img/iconos/white/16x16/user.png" alt="Usuario" />
            <span>Bienvenido <?php echo $_SESSION[Unombre]; ?>, ahora puedes realizar tu pedido. | 
                <a class="password" href="<?php echo $INC_url; ?>/login/panel_control" title="Ir a mi panel de control">Ir a mi panel de control -</a></span>
            <a href="<?php echo $INC_url; ?>/login/panel_control" title="Ir a mi panel de control">
                <img src="<?php echo $INC_url; ?>/img/iconos/white/16x16/notepad_2.png" alt="Ir a mi panel de control" />
            </a>
            <a href="<?php echo $INC_url; ?>/login/cerrar_sesion" title="Cerrar sesión">
                <img src="<?php echo $INC_url; ?>/img/iconos/white/16x16/on-off.png" alt="Cerrar sesion" />
            </a>
        </div>
    <?php
        }             
    ?>        
    </div>
       
    <div style="float:right; margin-top:10px; margin-right:10px;">
        <a href="<?php echo $INC_url; ?>/login/contactar" title="Contactar">
                <img src="<?php echo $INC_url; ?>/img/iconos/white/16x16/mail.png" alt="Contactar" style="vertical-align: middle;" />
        </a>
    </div>
    <div style="float:right; margin-right:10px; margin-top:10px;">
        <a href="https://www.facebook.com/cafeencapsula?fref=ts" title="Facebook">
            <img src="<?php echo $INC_url; ?>/img/iconos/white/16x16/facebook.png" alt="Tlf" style="vertical-align: middle;" />
        </a>
    </div>
    <div style="float:right; margin-right:10px; margin-top:10px;">
        <a href="https://twitter.com/CafeenCapsula" title="Twitter">
            <img src="<?php echo $INC_url; ?>/img/iconos/white/16x16/twitter.png" alt="Mail" style="vertical-align: middle;" />
        </a>
    </div>    
    <div style="float:right; margin-right:10px; margin-top:10px;">
        <a href="http://www.cafeencapsula.com/blog/0" title="Blog">
            <img src="<?php echo $INC_url; ?>/img/iconos/white/16x16/notepad_2.png" alt="Mail" style="vertical-align: middle;" />
        </a>
    </div>    
    </div>
</div>

<div id="marco">    
    <div id="marco_contenedor">
        
        
        
        <div id="marco_logo">            
            <a class="logo" href="<?php echo $INC_url; ?>" title="Inicio">
                <p>Café en Cápsula</p>
            </a>
        </div>
        
        <div class="marco_carrito">
                   <a href="<?php echo $INC_url; ?>/carrito/carrito_paso_uno" title="Carrito de la Compra"><img src="<?php echo $INC_url; ?>/img/iconos/blacks/16x16/shop_cart.png" alt="Carrito de la compra" /> Tu compra
                   </a> | Unidades = <?php echo $total_cantidad_carrito; ?> | Total = <?php echo number_format($total_carrito, 2, ",", ""); ?> €
        </div>
        <?php
        //LIMPIAMOS LAS VARIABLES PARA QUE NO HAGAN CONFLICTO CON EL CARRITO
        $total_cantidad_carrito=0;
        $total_carrito=0;
        
        ?>
        <?php
            if ($_SESSION[Uidacceso]==""){             
        ?>
        <div class="marco_registrate">                    
                   <a href="<?php echo $INC_url; ?>/login/registro" title="Regístrate">Regístrate para hacer tu pedido</a>
        </div>
        <?php
            }
        ?>
        
        
        
        
            
            
        
        
        <div class="limpiar"></div>
        
        
        
        
        
    </div>
</div>

<div id="nuevo_menu">    
    <div id="nuevo_menu_contenedor">

        
            <?php
            //CONSTRUIMOS EL MENU A PARTIR DE LAS SECCIONES Y SUBSECCIONES QUE NOS ENCONTRAMOS EN LA LISTA DE PRECIOS       

            //CONSTRUIMOS LA ULTIMA PESTAÑA CON LOS FABRICANTES                

            echo '
                    <div class="menu1">
                        Fabricantes
                        <div class="submenu1">
                ';

            $sql = "SELECT DISTINCT Pfabricante FROM Productos WHERE Pdesactivar='no' ORDER BY Pfabricante asc";
            if(!$result = $mysqli->query($sql)){
                die("Query invalido: " . $sql);
            }
            /* fetch array asociativo*/
            while ($fila = $result->fetch_assoc()) {                
                $Pfabricante = utf8_encode($fila["Pfabricante"]);

                 $Pfabricante_arreglado = QuitaAcentosyEspacios($Pfabricante); //arreglamos la url           

                echo '<p><a class="enlaces_menu2" href="'.$INC_url.'/escaparate_fabricante/'.$Pfabricante_arreglado.'" title="'.$Pfabricante.'">'.$Pfabricante.'</a></p><br />';

            }

            echo '
                    </div>
                </div>
                ';
            /* liberamos la memoria asociada al resultado */
            $result->close();


            //CONSTRUIMOS EL RESTO DE BOTONES CON LAS FAMILIAS Y SUBFAMILIAS


            $sql = "SELECT DISTINCT Pfamilia FROM Productos WHERE Pdesactivar='no' ORDER BY Pfamilia desc";
            if(!$result = $mysqli->query($sql)){
                die("Query invalido: " . $sql);
            }
            /* fetch array asociativo*/
            while ($fila = $result->fetch_assoc()) {                
                $Pfamilia = utf8_encode($fila["Pfamilia"]);

                $Pfamilia_arreglado = QuitaAcentosyEspacios($Pfamilia); //arreglamos la url

                echo '
                    <div class="menu1">
                        <a class="enlaces_menu1" href="'.$INC_url.'/escaparate_categoria/'.$Pfamilia_arreglado.'" title="'.$Pfamilia.'">'.$Pfamilia.'</a>
                        <div class="submenu1">
                ';


                $sql2 = "SELECT DISTINCT Psubfamilia FROM Productos WHERE Pfamilia='$Pfamilia' AND Pdesactivar='no' ORDER BY Psubfamilia asc";
                if(!$result2 = $mysqli->query($sql2)){
                    die("Query invalido: " . $sql2);
                }
                /* fetch array asociativo*/
                while ($fila2 = $result2->fetch_assoc()) {                
                    $Psubfamilia = utf8_encode($fila2["Psubfamilia"]);

                    $Psubfamilia_arreglado = QuitaAcentosyEspacios($Psubfamilia); //arreglamos la url

                    echo '<p><a class="enlaces_menu2" href="'.$INC_url.'/escaparate_sistema/'.$Psubfamilia_arreglado.'" title="'.$Psubfamilia.'">'.$Psubfamilia.'</a></p><br />';
                }
                /* liberamos la memoria asociada al resultado */
                $result2->close();

                echo '
                    </div>
                </div>
                ';

            }
            /* liberamos la memoria asociada al resultado */
            $result->close();



            ?>
        
    </div>
</div>

