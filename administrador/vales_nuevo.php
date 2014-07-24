<h2>Nuevo Vale</h2><br />
<p class="semillas">Inicio > Vales > Nuevo Vale</p><br />

<form id="formulario_login" method="post" action="<?php echo $INC_url; ?>/administrador/fun_vales_editor.php">
             <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>* Vale:</label>
            </div>
                <input class="imput_editar" name="Vvale" type="text" />
            <div class="limpiar"></div>
            <!-- -------------------------------------------------------------------------------------------- -->

            <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>* Descuento %:</label>
            </div>
                <input class="imput_editar" name="Vvalor" type="text" />
            <div class="limpiar"></div>
            <!-- -------------------------------------------------------------------------------------------- -->
            
            <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>* Estado:</label>
            </div>
                <select name="Vestado" id="Vestado" class="imput_editar">
                    <option value="activo">activo</option>
                    <option value="cerrado">cerrado</option>
                </select>
            <div class="limpiar"></div>
            <!-- -------------------------------------------------------------------------------------------- -->
            
            
            

            <input type="hidden" name="action" value="2" />

            <div class="colocar_boton">         
            <input class="boton" type="submit" value="Crear" />
            </div>
            <div class="limpiar"></div>

        </form><br />

        
    
