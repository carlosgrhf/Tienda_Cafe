<h2>Nueva Producto</h2><br />
<p class="semillas">Inicio > Productos > Nuevo Producto</p><br />

<form id="formulario_login" method="post" action="<?php echo $INC_url; ?>/administrador/fun_productos_editor.php">
             <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>* Referencia:</label>
            </div>
                <input class="imput_editar" name="Preferencia" type="text" />
            <div class="limpiar"></div>
            <!-- -------------------------------------------------------------------------------------------- -->

            <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>* Nombre:</label>
            </div>
                <input class="imput_editar" name="Pnombre" type="text" />
            <div class="limpiar"></div>
            <!-- -------------------------------------------------------------------------------------------- -->  
            
            <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>* Familia:</label>
            </div>
                <input class="imput_editar" name="Pfamilia" type="text" />
            <div class="limpiar"></div>
            <!-- -------------------------------------------------------------------------------------------- -->
            
            <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>* Subfamilia:</label>
            </div>
                <input class="imput_editar" name="Psubfamilia" type="text" />
            <div class="limpiar"></div>
            <!-- -------------------------------------------------------------------------------------------- -->  
            
            <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>* Fabricante:</label>
            </div>
                <input class="imput_editar" name="Pfabricante" type="text" />
            <div class="limpiar"></div>
            <!-- -------------------------------------------------------------------------------------------- -->  
            
            <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>* Precio €:</label>
            </div>
                <input class="imput_editar" name="Pprecio" type="text" />
            <div class="limpiar"></div>
            <!-- -------------------------------------------------------------------------------------------- -->  
            
            <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>* Piva €:</label>
            </div>
                <input class="imput_editar" name="Piva" type="text" />
            <div class="limpiar"></div>
            <!-- -------------------------------------------------------------------------------------------- -->  
            
            <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>* Destacado:</label>
            </div>
                <select name="Pdestacado" id="Pdestacado" class="imput_editar">
                    <option value="si">SI</option>
                    <option value="no">NO</option>
                </select>
            <div class="limpiar"></div>
            <!-- -------------------------------------------------------------------------------------------- -->
            
            <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>* Oferta:</label>
            </div>
                <select name="Poferta" id="Poferta" class="imput_editar">
                    <option value="si">SI</option>
                    <option value="no">NO</option>
                </select>
            <div class="limpiar"></div>
            <!-- -------------------------------------------------------------------------------------------- -->
            
           
            
            <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>* Desactivar:</label>
            </div>
                <select name="Pdesactivar" id="Pdesactivar" class="imput_editar">
                    <option value="si">SI</option>
                    <option value="no">NO</option>
                </select>
            <div class="limpiar"></div>
            <!-- -------------------------------------------------------------------------------------------- -->
            
            <div style="margin-top:2%;">
                <p>* Descripcion:</p><br />
                <textarea id="Pdescripcion" name="Pdescripcion"></textarea>
                <script>

			// Replace the <textarea id="editor"> with an CKEditor
			// instance, using default configurations.
			CKEDITOR.replace( 'Pdescripcion', {
				uiColor: '#cdcdcd'				
			});

		</script>

             </div>
             <div class="limpiar"></div>
            
            <br /><br />           
                        
            <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>* Observaciones:</label>
            </div>
                <textarea class="imput_editar" id="Pobservaciones" name="Pobservaciones" style="width:400px; height:100px;"></textarea>
            <div class="limpiar"></div>
            <!-- -------------------------------------------------------------------------------------------- -->
            

            <input type="hidden" name="action" value="2" />

            <div class="colocar_boton">         
            <input class="boton" type="submit" value="Crear" />
            </div>
            <div class="limpiar"></div>

        </form><br />

        
    
