<?php
$Nid=$_GET[Nid];

$sql = "SELECT * FROM Noticias WHERE Nid='$Nid'";
    if(!$result = $mysqli->query($sql)){
        die("Query invalido: " . $sql);
    }          
    /* fetch array asociativo*/
    while ($fila = $result->fetch_assoc()) {
        $Nid = utf8_encode($fila["Nid"]);
        $Nfecha = utf8_encode($fila["Nfecha"]);
        $Ntitulo = utf8_encode($fila["Ntitulo"]);
        $Nsubtitulo = utf8_encode($fila["Nsubtitulo"]);
        $Nprecontenido = utf8_encode($fila["Nprecontenido"]);
        $Ncontenido = utf8_encode($fila["Ncontenido"]);
        $Nimg = utf8_encode($fila["Nimg"]);
        $Npinchazos = utf8_encode($fila["Npinchazos"]);
                
    }
    /* liberamos la memoria asociada al resultado */
    $result->close();
?>


<h2>Editar Noticia</h2><br />
<p class="semillas">Inicio > Noticias > Editar Noticia</p><br />

<form id="formulario_login" method="post" action="<?php echo $INC_url; ?>/administrador/fun_noticias_editor.php">    
            <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>* Título (H1):</label>
            </div>
                <input class="imput_editar" name="Ntitulo" type="text" id="Ntitulo" class=":required" value="<?php echo $Ntitulo; ?>" />
            <div class="limpiar"></div>
            <!-- -------------------------------------------------------------------------------------------- -->

            <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>* Subtítulo (H2):</label>
            </div>
                <input class="imput_editar" name="Nsubtitulo" type="text" id="Nsubtitulo" class=":required" value="<?php echo $Nsubtitulo; ?>" />
            <div class="limpiar"></div>
            <!-- -------------------------------------------------------------------------------------------- -->
            
            <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>* Link img:</label>
            </div>
                <input class="imput_editar" name="Nimg" type="text" id="Nimg" class=":required" value="<?php echo $Nimg; ?>" />
            <div class="limpiar"></div>
            <!-- -------------------------------------------------------------------------------------------- -->
            
            <div style="margin-top:2%;">
                <p>* Pre Contenido:</p><br />
                <textarea id="Nprecontenido" name="Nprecontenido"><?php echo $Nprecontenido; ?></textarea>
                <script>

			// Replace the <textarea id="editor"> with an CKEditor
			// instance, using default configurations.
			CKEDITOR.replace( 'Nprecontenido', {
				uiColor: '#cdcdcd'				
			});

		</script>

             </div>
             <div class="limpiar"></div>
            
            <br /><br />            
                        
            <div style="margin-top:2%;">
                <p>* Contenido:</p><br />
                <textarea id="Ncontenido" name="Ncontenido"><?php echo $Ncontenido; ?></textarea>
                <script>

			// Replace the <textarea id="editor"> with an CKEditor
			// instance, using default configurations.
			CKEDITOR.replace( 'Ncontenido', {
                                allowedContent: true,
				uiColor: '#cdcdcd'				
			});

		</script>

             </div>
             <div class="limpiar"></div>
             
             <input type="hidden" name="action" value="1" />
            <input type="hidden" name="Nid" value="<?php echo $Nid; ?>" />

            <div class="colocar_boton">         
            <input class="boton" type="submit" value="Editar" />
            </div>           
            <div class="limpiar"></div>            

        </form>
<br />