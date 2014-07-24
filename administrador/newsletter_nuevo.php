<h2>Contactos Newsletter</h2><br />
<p class="semillas">Inicio > Contactos Newsletter > Nuevo Contacto Newsletter</p><br />

<form id="formulario_login" method="post" action="<?php echo $INC_url; ?>/administrador/fun_newsletter_editor.php">
            <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>* Email:</label>
            </div>
                <input class="imput_editar" name="NEWemail" type="text" id="NEWemail" />
            <div class="limpiar"></div>
            <!-- -------------------------------------------------------------------------------------------- -->
            
            <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>* Estado:</label>
            </div>
                <select name="NEWestado" id="NEWestado" class="imput_editar">
                    <option value="activo">Activo</option>
                    <option value="bloqueado">Bloqueado</option>
                </select>
            <div class="limpiar"></div>
            <!-- -------------------------------------------------------------------------------------------- -->
            
            

            <input type="hidden" name="action" value="2" />

            <div class="colocar_boton">         
            <input class="boton" type="submit" value="Crear" />
            </div>
            
            <div class="limpiar"></div>

        </form><br />

        
    
