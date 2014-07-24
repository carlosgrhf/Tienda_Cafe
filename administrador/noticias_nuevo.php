<h2>Nueva Noticia</h2><br />
<p class="semillas">Inicio > Noticia > Nueva Noticia</p><br />

<form id="formulario_login" method="post" action="<?php echo $INC_url; ?>/administrador/fun_noticias_editor.php">
             <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>* Título (H1):</label>
            </div>
                <input class="imput_editar" name="Ntitulo" type="text" id="Ntitulo" class=":required" />
            <div class="limpiar"></div>
            <!-- -------------------------------------------------------------------------------------------- -->

            <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>* Subtítulo (H2):</label>
            </div>
                <input class="imput_editar" name="Nsubtitulo" type="text" id="Nsubtitulo" class=":required" />
            <div class="limpiar"></div>
            <!-- -------------------------------------------------------------------------------------------- -->
            
            <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>* Link img:</label>
            </div>
                <input class="imput_editar" name="Nimg" type="text" id="Nimg" class=":required" />
            <div class="limpiar"></div>
            <!-- -------------------------------------------------------------------------------------------- -->
            
            
            <div style="margin-top:2%;">
                <p>* Pre Contenido:</p><br />
                <textarea id="Nprecontenido" name="Nprecontenido"></textarea>
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
                <textarea id="Ncontenido" name="Ncontenido"></textarea>
                <script>

			// Replace the <textarea id="editor"> with an CKEditor
			// instance, using default configurations.
			CKEDITOR.replace( 'Ncontenido', {
				uiColor: '#cdcdcd'				
			});

		</script>

             </div>
             <div class="limpiar"></div>
            

            <input type="hidden" name="action" value="2" />

            <div class="colocar_boton">         
            <input class="boton" type="submit" value="Crear" />
            </div>
            <div class="limpiar"></div>

        </form><br />

        
    
