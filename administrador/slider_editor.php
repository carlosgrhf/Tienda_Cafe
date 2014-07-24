<?php
$Sid=$_GET[Sidslider];

$sql = "SELECT * FROM Slider WHERE Sid='$Sid'";
    if(!$result = $mysqli->query($sql)){
        die("Query invalido: " . $sql);
    }          
    /* fetch array asociativo*/
    while ($fila = $result->fetch_assoc()) {
        $Sid = utf8_encode($fila["Sid"]);
        $Stitulo = utf8_encode($fila["Stitulo"]);
        $Simg = utf8_encode($fila["Simg"]);
        $Slink = utf8_encode($fila["Slink"]);
        $Scontenido = utf8_encode($fila["Scontenido"]);
        $Sidioma = utf8_encode($fila["Sidioma"]);        
                
    }
    /* liberamos la memoria asociada al resultado */
    $result->close();
?>


<h2>Editar Slider</h2><br />
<p class="semillas">Inicio > Slider > Editar Slider</p><br />

<form id="formulario_login" method="post" action="<?php echo $INC_url; ?>/administrador/fun_slider_editor.php">    
    
            <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>* Título:</label>
            </div>
                <input class="imput_editar" name="Stitulo" type="text" value="<?php echo $Stitulo; ?>" />
            <div class="limpiar"></div>
            <!-- -------------------------------------------------------------------------------------------- -->    
    
            <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>* Imágen:</label>
            </div>
                <input class="imput_editar" name="Simg" type="text" value="<?php echo $Simg; ?>" />
            <div class="limpiar"></div>
            <!-- -------------------------------------------------------------------------------------------- -->
            
            <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>* Link (sin http://):</label>
            </div>
                <input class="imput_editar" name="Slink" type="text" value="<?php echo $Slink; ?>" />
            <div class="limpiar"></div>
            <!-- -------------------------------------------------------------------------------------------- -->
                       
            
            
                        
            <div style="margin-top:2%;">
                <p>* Contenido:</p><br />
                <textarea id="Scontenido" name="Scontenido"><?php echo $Scontenido; ?></textarea>
                <script>

			// Replace the <textarea id="editor"> with an CKEditor
			// instance, using default configurations.
			CKEDITOR.replace( 'Scontenido', {
                                allowedContent: true,
				uiColor: '#cdcdcd'				
			});

		</script>

             </div>
             <div class="limpiar"></div>
             
             <input type="hidden" name="action" value="1" />
            <input type="hidden" name="Sid" value="<?php echo $Sid; ?>" />

            <div class="colocar_boton">         
            <input class="boton" type="submit" value="Editar" />
            </div>             
            <div class="limpiar"></div>            

        </form><br />