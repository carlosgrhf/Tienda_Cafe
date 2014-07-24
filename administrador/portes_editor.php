<?php

$sql = "SELECT * FROM Gastos_Envio WHERE GEid='1'";
    if(!$result = $mysqli->query($sql)){
        die("Query invalido: " . $sql);
    }          
    /* fetch array asociativo*/
    while ($fila = $result->fetch_assoc()) {
        $GEid = utf8_encode($fila["GEid"]);        
        $GEportes = utf8_encode($fila["GEportes"]);  
        $GElimite = utf8_encode($fila["GElimite"]); 
    }
    /* liberamos la memoria asociada al resultado */
    $result->close();
?>


<h2>Editar Portes</h2><br />
<p class="semillas">Inicio > Portes > Editar Portes</p><br />

<form id="formulario_login" method="post" action="<?php echo $INC_url; ?>/administrador/fun_portes_editor.php">    
            <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>* Portes €:</label>
            </div>
                <input class="imput_editar" name="GEportes" type="text" value="<?php echo $GEportes; ?>" />
            <div class="limpiar"></div>
            <!-- -------------------------------------------------------------------------------------------- -->
            
            <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>* Límite €:</label>
            </div>
                <input class="imput_editar" name="GElimite" type="text" value="<?php echo $GElimite; ?>" />
            <div class="limpiar"></div>
            <!-- -------------------------------------------------------------------------------------------- -->
            
            
             
            <input type="hidden" name="action" value="1" />
            <input type="hidden" name="GEid" value="<?php echo $GEid; ?>" />

            <div class="colocar_boton">         
            <input class="boton" type="submit" value="Editar" />
            </div>           
            <div class="limpiar"></div>            

        </form>
<br />

