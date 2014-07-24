<?php
$Aid_us=$_GET[Aid_us];

$sql = "SELECT * FROM Administrador WHERE Aid='$Aid_us'";
    if(!$result = $mysqli->query($sql)){
        die("Query invalido: " . $sql);
    }          
    /* fetch array asociativo*/
    while ($fila = $result->fetch_assoc()) {
        $Aid_us = utf8_encode($fila["Aid"]);
        $Anombre_us = utf8_encode($fila["Anombre"]);
        $Ausuario_us = utf8_encode($fila["Ausuario"]);        
        
                
    }
    /* liberamos la memoria asociada al resultado */
    $result->close();
?>


<h2>Editar Usuario</h2><br />
<p class="semillas">Inicio > Usuarios > Editar Usuarios</p><br />

<form id="formulario_login" method="post" action="<?php echo $INC_url; ?>/administrador/fun_usuarios_editor.php">
            <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>* Nombre:</label>
            </div>
                <input class="imput_editar" name="nombre" type="text" id="nombre" class=":required" value="<?php echo $Anombre_us; ?>" />
            <div class="limpiar"></div>
            <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>* Usuario:</label>
            </div>
                <input class="imput_editar" name="usuario" type="text" id="usuario" class=":required" value="<?php echo $Ausuario_us; ?>" />
            <div class="limpiar"></div>
            <!-- -------------------------------------------------------------------------------------------- -->
            
                        

            <input type="hidden" name="action" value="1" />
            <input type="hidden" name="id" value="<?php echo $Aid_us; ?>" />

            <div class="colocar_boton">         
            <input class="boton" type="submit" value="Editar" />
            </div>
            
            <div class="limpiar"></div>

        </form><br />

<form id="formulario_login" method="post" action="<?php echo $INC_url; ?>/administrador/fun_usuarios_editor.php">

            <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>* Nuevo Password:</label>
            </div>
                <input class="imput_editar" name="password" type="password" id="password" class=":required" />
            <div class="limpiar"></div>
            <!-- -------------------------------------------------------------------------------------------- -->        
            

            <input type="hidden" name="action" value="2" />
            <input type="hidden" name="id" value="<?php echo $Aid_us; ?>" />

            <div class="colocar_boton">         
            <input class="boton" type="submit" value="Editar" />
            </div>
            
            <div class="limpiar"></div>

        </form>

        
    <br />
