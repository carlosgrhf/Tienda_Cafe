<?php
// Inicializamos sesion 
session_start();
include('../lib/config.inc.php');
include('../lib/conectar.php');

$sql = "SELECT * FROM Usuarios WHERE Uid='$_SESSION[Uidacceso]' ";
    if(!$result = $mysqli->query($sql)){
        die("Query invalido: " . $sql);
    }          
    /* fetch array asociativo*/
    while ($fila = $result->fetch_assoc()) {
        $Uid = utf8_encode($fila["Uid"]);
        $Uempresa = utf8_encode($fila["Uempresa"]);
        $Unombre = utf8_encode($fila["Unombre"]);
        $Uapellidos = utf8_encode($fila["Uapellidos"]);
        $Udnicif = utf8_encode($fila["Udnicif"]);
        $Udireccion = utf8_encode($fila["Udireccion"]);
        $Ucp = utf8_encode($fila["Ucp"]);
        $Ulocalidad = utf8_encode($fila["Ulocalidad"]);
        $Uprovincia = utf8_encode($fila["Uprovincia"]);
        $Upais = utf8_encode($fila["Upais"]);
        $Utlf = utf8_encode($fila["Utlf"]);
        $Uemail = utf8_encode($fila["Uemail"]);
        $Ucondiciones = utf8_encode($fila["Ucondiciones"]);
        $Unews = utf8_encode($fila["Unews"]);
        $Utipo = utf8_encode($fila["Utipo"]);
        $Upassword = utf8_encode($fila["Upassword"]);
        $Uvalidado = utf8_encode($fila["Uvalidado"]);
        $Unumerocompras = utf8_encode($fila["Unumerocompras"]);
        $Ufechaultimacompra = utf8_encode($fila["Ufechaultimacompra"]);
        
        
        
        
    }
    /* liberamos la memoria asociada al resultado */
    $result->close();	

?>
    <h2>Actualizar mis datos</h2>
    <form id="formulario_registro" name="formformulario_registro" method="post" action="<?php echo $INC_url; ?>/login/fun_actualizar_usuario.php">
         
        <div class="label_registro">
        <label>* Tipo usuario:</label>
        </div>
         <div class="imput_registro">    
        <select name="tipo" id="tipo">
            <?php
            if($Utipo=="PARTICULAR"){
                echo '
                    <option value="PARTICULAR">Particular</option>
                    <option value="EMPRESA">Empresa</option>
                ';
            }
            if($Utipo=="EMPRESA"){
                echo '
                    <option value="EMPRESA">Empresa</option>
                    <option value="PARTICULAR">Particular</option>                   
                ';
            }
            ?>
        </select>
        </div>
        <div class="limpiar"></div>
        
        
        <div class="label_registro">
            <label>Nombre Empresa (opcional):</label>
        </div>
         <div class="imput_registro">    
            <input name="empresa" type="text" id="empresa" value="<?php echo $Uempresa; ?>" />
        </div>
        <div class="limpiar"></div>
        
        <div class="label_registro">
        <label>* Nombre:</label>
        </div>
         <div class="imput_registro">    
        <input name="nombre" type="text" id="nombre" value="<?php echo $Unombre; ?>" />
        </div>
        <div class="limpiar"></div>


        <div class="label_registro">
        <label>* Apellidos:</label>
        </div>
         <div class="imput_registro">    
        <input name="apellidos" type="text" id="apellidos" value="<?php echo $Uapellidos; ?>" />
        </div>
        <div class="limpiar"></div>


        <div class="label_registro">
        <label>* Dni/Cif:</label>
        </div>
         <div class="imput_registro">    
        <input name="dnicif" type="text" id="dnicif" value="<?php echo $Udnicif; ?>" />
        </div>
        <div class="limpiar"></div>


        <div class="label_registro">
        <label>* Dirección:</label>
        </div>
        <div class="imput_registro">    
        <input name="direccion" type="text" id="direccion" value="<?php echo $Udireccion; ?>" />
        </div>
        <div class="limpiar"></div>


        <div class="label_registro">
        <label>* Código Postal:</label>
        </div>
         <div class="imput_registro">    
        <input name="cp" type="text" id="cp" value="<?php echo $Ucp; ?>" />
        </div>
        <div class="limpiar"></div>


        <div class="label_registro">
        <label>* Localidad:</label>
        </div>
         <div class="imput_registro">    
        <input name="localidad" type="text" id="localidad" value="<?php echo $Ulocalidad; ?>" />
        </div>
        <div class="limpiar"></div>
        
        <div class="label_registro">
        <label>* Provincia:</label>
        </div>
         <div class="imput_registro">    
        <input name="provincia" type="text" id="provincia" value="<?php echo $Uprovincia; ?>" />
        </div>
        <div class="limpiar"></div>
        
        <div class="label_registro">
        <label>* País:</label>
        </div>
         <div class="imput_registro">    
        <select name="pais" id="pais">
            <?php
            if($Upais=="ESPAÑA"){
                echo '
                    <option value="ESPAÑA">España</option>
                    <option value="PORTUGAL">Portugal</option>
                ';
            }
            if($Upais=="PORTUGAL"){
                echo '
                    <option value="PORTUGAL">Portugal</option>
                    <option value="ESPAÑA">España</option>                    
                ';
            }
            ?>
        </select>
        </div>
        <div class="limpiar"></div>
        
        <div class="label_registro">
        <label>* Teléfono:</label>
        </div>
         <div class="imput_registro">    
        <input name="tlf" type="text" id="tlf" value="<?php echo $Utlf; ?>" />
        </div>
        <div class="limpiar"></div>
        
        <input type="hidden" name="action" value="1" />
        
        <div class="label_registro">
            <label>&nbsp;</label>
        </div>
        <div class="imput_registro"> 
            <input type="submit" class="marco_submit" value="Actualizar" />
        </div>
        <div class="limpiar"></div>

    </form>
    <br />
    <h2>Cambiar mi contraseña</h2>
    <form id="formulario_registro" name="formulario_password" method="post" action="<?php echo $INC_url; ?>/login/fun_actualizar_usuario.php">
                 
        <div class="label_registro">
        <label>* Contraseña actual:</label>
        </div>
         <div class="imput_registro">    
        <input name="pass" type="password" />
        </div>
        <div class="limpiar"></div>
        
        
        <div class="label_registro">
        <label>* Contraseña nueva:</label>
        </div>
         <div class="imput_registro">    
        <input name="password" type="password" id="password" />
        </div>
        <div class="limpiar"></div>      
        
        <div class="label_registro">
        <label>* Repetir contraseña nueva:</label>
        </div>
         <div class="imput_registro">    
        <input name="password2" type="password" id="password2" />
        </div>
        <div class="limpiar"></div>      
        

        
        <input type="hidden" name="action" value="2" />
        
        <div class="label_registro">
            <label>&nbsp;</label>
        </div>
        <div class="imput_registro"> 
            <input type="submit" class="marco_submit" value="Cambiar" />
        </div>
        <div class="limpiar"></div>

    </form>
