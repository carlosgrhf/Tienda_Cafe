<?php
$NEWid=$_GET[NEWid];

$sql = "SELECT * FROM Newsletter WHERE NEWid='$NEWid'";
    if(!$result = $mysqli->query($sql)){
        die("Query invalido: " . $sql);
    }          
    /* fetch array asociativo*/
    while ($fila = $result->fetch_assoc()) {
        $NEWid = utf8_encode($fila["NEWid"]);
        $NEWemail = utf8_encode($fila["NEWemail"]);
        $NEWestado = utf8_encode($fila["NEWestado"]);    
        
                
    }
    /* liberamos la memoria asociada al resultado */
    $result->close();
?>


<h2>Editar Contactos Newsletter</h2><br />
<p class="semillas">Inicio > Contactos Newsletter > Editar Contactos Newsletter</p><br />

<form id="formulario_login" method="post" action="<?php echo $INC_url; ?>/administrador/fun_newsletter_editor.php">
            <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>* Email:</label>
            </div>
                <input class="imput_editar" name="NEWemail" type="text" id="NEWemail" value="<?php echo $NEWemail; ?>" />
            <div class="limpiar"></div>
            <!-- -------------------------------------------------------------------------------------------- -->
            
            <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>* Estado (Activo: <?php echo strtoupper($NEWestado); ?>) :</label>
            </div>
                <select name="NEWestado" id="NEWestado" class="imput_editar">
                    <option value="<?php echo $NEWestado; ?>"><?php echo ''.strtoupper($NEWestado).' (Activo)'; ?></option>
                    <option value="activo">Activo</option>
                    <option value="bloqueado">Bloqueado</option>
                </select>
            <div class="limpiar"></div>
            <!-- -------------------------------------------------------------------------------------------- -->
            
                        

            <input type="hidden" name="action" value="1" />
            <input type="hidden" name="NEWid" value="<?php echo $NEWid; ?>" />

            <div class="colocar_boton">         
            <input class="boton" type="submit" value="Editar" />
            </div>
            
            <div class="limpiar"></div>

        </form><br />
