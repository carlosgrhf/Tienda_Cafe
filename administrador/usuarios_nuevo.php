<h2>Usuarios</h2><br />
<p class="semillas">Inicio > Usuarios > Nuevo Usuario</p><br />

<form id="formulario_login" method="post" action="<?php echo $INC_url; ?>/administrador/fun_usuarios_editor.php">
            <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>* Nombre:</label>
            </div>
                <input class="imput_editar" name="nombre" type="text" id="nombre" class=":required" />
            <div class="limpiar"></div>
            <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>* Usuario:</label>
            </div>
                <input class="imput_editar" name="usuario" type="text" id="usuario" class=":required" />
            <div class="limpiar"></div>
            <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>* Password:</label>
            </div>
                <input class="imput_editar" name="password" type="text" id="password" class=":required" />
            <div class="limpiar"></div>
            <!-- -------------------------------------------------------------------------------------------- -->
            

            <input type="hidden" name="action" value="3" />

            <div class="colocar_boton">         
            <input class="boton" type="submit" value="Crear" />
            </div>
            
            <div class="limpiar"></div>

        </form><br />

        
    
