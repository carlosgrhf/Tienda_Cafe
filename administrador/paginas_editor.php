<?php
$PAid=$_GET[PAid];

$sql = "SELECT * FROM Paginas WHERE PAid='$PAid'";
    if(!$result = $mysqli->query($sql)){
        die("Query invalido: " . $sql);
    }          
    /* fetch array asociativo*/
    while ($fila = $result->fetch_assoc()) {
        $PAid = utf8_encode($fila["PAid"]);        
        $PAtitulo = utf8_encode($fila["PAtitulo"]);  
        $PAintro = utf8_encode($fila["PAintro"]);   
        $PAcontenido = utf8_encode($fila["PAcontenido"]);        
        $PApinchazos = utf8_encode($fila["PApinchazos"]);  
        $PAidioma = utf8_encode($fila["PAidioma"]);  
        
                
    }
    /* liberamos la memoria asociada al resultado */
    $result->close();
?>


<h2>Editar Página</h2><br />
<p class="semillas">Inicio > Páginas > Editar Página</p><br />

<form id="formulario_login" method="post" action="<?php echo $INC_url; ?>/administrador/fun_paginas_editor.php">    
            <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>* Título (H1):</label>
            </div>
                <input class="imput_editar" name="PAtitulo" type="text" id="Ptitulo" class=":required" value="<?php echo $PAtitulo; ?>" />
            <div class="limpiar"></div>
            <!-- -------------------------------------------------------------------------------------------- -->
            
            <br />
            Ayuda: Si quieres resaltar unas palabras dentro de la introducción encierralas dentro las etiquetas "span" con la clase "destacado". 
            Ej: <strong>< span class="destacado" >Palabra Destacada</ span ></strong> (no dejes espacio en los corchetes!)
            <br /><br />
            
            <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>* Introducción:</label>
            </div>
                <textarea class="imput_editar" id="PAintro" name="PAintro" style="width:400px; height:100px;"><?php echo $PAintro; ?></textarea>
            <div class="limpiar"></div>
            <!-- -------------------------------------------------------------------------------------------- -->

                        
            <div style="margin-top:2%;">
                <p>* Contenido:</p><br />
                <textarea id="Pcontenido" name="PAcontenido"><?php echo $PAcontenido; ?></textarea>
                <script>

			// Replace the <textarea id="editor"> with an CKEditor
			// instance, using default configurations.
			CKEDITOR.replace( 'Pcontenido', {
                                allowedContent: true,
				uiColor: '#cdcdcd'				
			});

		</script>

             </div>
             <div class="limpiar"></div>
             
             <input type="hidden" name="action" value="1" />
            <input type="hidden" name="PAid" value="<?php echo $PAid; ?>" />

            <div class="colocar_boton">         
            <input class="boton" type="submit" value="Editar" />
            </div>           
            <div class="limpiar"></div>            

        </form>
<br />

