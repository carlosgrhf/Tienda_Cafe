<?php
$Vid=$_GET[Vid];

$sql = "SELECT * FROM Vales WHERE Vid='$Vid'";
    if(!$result = $mysqli->query($sql)){
        die("Query invalido: " . $sql);
    }          
    /* fetch array asociativo*/
    while ($fila = $result->fetch_assoc()) {
        $Vid = utf8_encode($fila["Vid"]);
        $Vvale = utf8_encode($fila["Vvale"]);
        $Vfechacreacion = utf8_encode($fila["Vfechacreacion"]);
        $Vestado = utf8_encode($fila["Vestado"]);
        $Vvalor = utf8_encode($fila["Vvalor"]);  
                
    }
    /* liberamos la memoria asociada al resultado */
    $result->close();
?>


<h2>Editar Vale</h2><br />
<p class="semillas">Inicio > Vales > Editar Vale</p><br />

<form id="formulario_login" method="post" action="<?php echo $INC_url; ?>/administrador/fun_vales_editor.php">    
            <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>* Vale:</label>
            </div>
                <input class="imput_editar" name="Vvale" type="text" value="<?php echo $Vvale; ?>" />
            <div class="limpiar"></div>
            <!-- -------------------------------------------------------------------------------------------- -->

            <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>* Descuento %:</label>
            </div>
                <input class="imput_editar" name="Vvalor" type="text" value="<?php echo $Vvalor; ?>" />
            <div class="limpiar"></div>
            <!-- -------------------------------------------------------------------------------------------- -->  
            
            <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>* Estado:</label>
            </div>
                <select name="Vestado" id="Vestado" class="imput_editar">
                    <option value="<?php echo $Vestado; ?>"><?php echo ''.strtoupper($Vestado).' (Activo)'; ?></option>
                    <option value="activo">activo</option>
                    <option value="cerrado">cerrado</option>
                </select>
            <div class="limpiar"></div>
            <!-- -------------------------------------------------------------------------------------------- -->
            
            
             
             <input type="hidden" name="action" value="1" />
            <input type="hidden" name="Vid" value="<?php echo $Vid; ?>" />

            <div class="colocar_boton">         
            <input class="boton" type="submit" value="Editar" />
            </div>           
            <div class="limpiar"></div>            

        </form>
<br />