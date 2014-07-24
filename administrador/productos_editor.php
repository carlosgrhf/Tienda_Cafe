<?php
$Pid=$_GET[Pid];

$sql = "SELECT * FROM Productos WHERE Pid='$Pid'";
    if(!$result = $mysqli->query($sql)){
        die("Query invalido: " . $sql);
    }          
    /* fetch array asociativo*/
    while ($fila = $result->fetch_assoc()) {
        $Pid = utf8_encode($fila["Pid"]);
        $Preferencia = utf8_encode($fila["Preferencia"]);
        $Pnombre = utf8_encode($fila["Pnombre"]);
        $Pdescripcion = utf8_encode($fila["Pdescripcion"]);
        $Pfamilia = utf8_encode($fila["Pfamilia"]);
        $Psubfamilia = utf8_encode($fila["Psubfamilia"]);
        $Pfabricante = utf8_encode($fila["Pfabricante"]); 
        $Pprecio = utf8_encode($fila["Pprecio"]);
        $Piva = utf8_encode($fila["Piva"]);
        $Pdestacado = utf8_encode($fila["Pdestacado"]);
        $Poferta = utf8_encode($fila["Poferta"]);
        $Pvecescomprado = utf8_encode($fila["Pvecescomprado"]);
        $Pdesactivar = utf8_encode($fila["Pdesactivar"]);
        $Pobservaciones = utf8_encode($fila["Pobservaciones"]);
                
    }
    /* liberamos la memoria asociada al resultado */
    $result->close();
    
    //creamos los nombres de las 3 imagenes
    $Pnombre_imagen1=''.$Preferencia.'_1.jpg';
    $Pnombre_imagen2=''.$Preferencia.'_2.jpg';
    $Pnombre_imagen3=''.$Preferencia.'_3.jpg';
    
    $valiza1=0;
    $valiza2=0;
    $valiza3=0;
    
    // abrir un directorio y listarlo recursivo 
       $ruta='../lib/kcfinder/upload/images/productos';
       if (is_dir($ruta)) { 
          if ($dh = opendir($ruta)) { 
             while (($file = readdir($dh)) !== false) { 
                if ($file!="." && $file!=".."){ 
                    if($file==$Pnombre_imagen1){
                        $valiza1=1;
                    }
                    if($file==$Pnombre_imagen2){
                        $valiza2=1;
                    } 
                    if($file==$Pnombre_imagen3){
                        $valiza3=1;
                    } 
                    
                } 
             } 
          closedir($dh); 
          } 
       }else 
          echo "<br>No es ruta valida";
    
?>


<h2>Editar Producto</h2><br />
<p class="semillas">Inicio > Productos > Editar Productos</p><br />

<?php
    if($valiza1==1){
        echo '<img src="'.$INC_url.'/lib/kcfinder/upload/images/productos/'.$Preferencia.'_1.jpg" alt="'.$Preferencia.'_1.jpg" style="float: left; width: 250px; margin-right: 20px;">';
    } else {
        echo '<img src="'.$INC_url.'/lib/kcfinder/upload/images/productos/sin_foto.jpg" alt="Sin Foto" style="float: left; width: 250px; margin-right: 20px;">';
    }
    if($valiza2==1){
        echo '<img src="'.$INC_url.'/lib/kcfinder/upload/images/productos/'.$Preferencia.'_2.jpg" alt="'.$Preferencia.'_2.jpg" style="float: left; width: 250px; margin-right: 20px;">';
    } else {
        echo '<img src="'.$INC_url.'/lib/kcfinder/upload/images/productos/sin_foto.jpg" alt="Sin Foto" style="float: left; width: 250px; margin-right: 20px;">';
    }
    if($valiza3==1){
        echo '<img src="'.$INC_url.'/lib/kcfinder/upload/images/productos/'.$Preferencia.'_3.jpg" alt="'.$Preferencia.'_3.jpg" style="float: left; width: 250px; margin-right: 20px;">';
    } else {
        echo '<img src="'.$INC_url.'/lib/kcfinder/upload/images/productos/sin_foto.jpg" alt="Sin Foto" style="float: left; width: 250px; margin-right: 20px;">';
    }
?>

<div class="limpiar"></div> 
<br /><br />

<form id="formulario_login" method="post" action="<?php echo $INC_url; ?>/administrador/fun_productos_editor.php">  
    
            <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>* ID:</label>
            </div>
                <p class="imput_editar"><?php echo $Pid; ?></p>
            <div class="limpiar"></div>
            <!-- -------------------------------------------------------------------------------------------- -->
            
            <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>* Veces Comprado:</label>
            </div>
                <p class="imput_editar"><?php echo $Pvecescomprado; ?></p>
            <div class="limpiar"></div>
            <!-- -------------------------------------------------------------------------------------------- -->
    
            <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>* Referencia:</label>
            </div>
                <input class="imput_editar" name="Preferencia" type="text" value="<?php echo $Preferencia; ?>" />
            <div class="limpiar"></div>
            <!-- -------------------------------------------------------------------------------------------- -->

            <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>* Nombre:</label>
            </div>
                <input class="imput_editar" name="Pnombre" type="text" value="<?php echo $Pnombre; ?>" />
            <div class="limpiar"></div>
            <!-- -------------------------------------------------------------------------------------------- -->  
            
            <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>* Familia:</label>
            </div>
                <input class="imput_editar" name="Pfamilia" type="text" value="<?php echo $Pfamilia; ?>" />
            <div class="limpiar"></div>
            <!-- -------------------------------------------------------------------------------------------- -->
            
            <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>* Subfamilia:</label>
            </div>
                <input class="imput_editar" name="Psubfamilia" type="text" value="<?php echo $Psubfamilia; ?>" />
            <div class="limpiar"></div>
            <!-- -------------------------------------------------------------------------------------------- -->  
            
            <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>* Fabricante:</label>
            </div>
                <input class="imput_editar" name="Pfabricante" type="text" value="<?php echo $Pfabricante; ?>" />
            <div class="limpiar"></div>
            <!-- -------------------------------------------------------------------------------------------- -->  
            
            <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>* Precio €:</label>
            </div>
                <input class="imput_editar" name="Pprecio" type="text" value="<?php echo $Pprecio; ?>" />
            <div class="limpiar"></div>
            <!-- -------------------------------------------------------------------------------------------- -->  
            
            <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>* Piva €:</label>
            </div>
                <input class="imput_editar" name="Piva" type="text" value="<?php echo $Piva; ?>" />
            <div class="limpiar"></div>
            <!-- -------------------------------------------------------------------------------------------- -->  
            
            <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>* Destacado (Activo: <?php echo strtoupper($Pdestacado); ?>) :</label>
            </div>
                <select name="Pdestacado" id="Pdestacado" class="imput_editar">
                    <option value="<?php echo $Pdestacado; ?>"><?php echo ''.strtoupper($Pdestacado).' (Activo)'; ?></option>
                    <option value="si">SI</option>
                    <option value="no">NO</option>
                </select>
            <div class="limpiar"></div>
            <!-- -------------------------------------------------------------------------------------------- -->
            
            <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>* Oferta (Activo: <?php echo strtoupper($Poferta); ?>) :</label>
            </div>
                <select name="Poferta" id="Poferta" class="imput_editar">
                    <option value="<?php echo $Poferta; ?>"><?php echo ''.strtoupper($Poferta).' (Activo)'; ?></option>
                    <option value="si">SI</option>
                    <option value="no">NO</option>
                </select>
            <div class="limpiar"></div>
            <!-- -------------------------------------------------------------------------------------------- -->
            
            
            <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>* Desactivar (Activo: <?php echo strtoupper($Pdesactivar); ?>) :</label>
            </div>
                <select name="Pdesactivar" id="Pdesactivar" class="imput_editar">
                    <option value="<?php echo $Pdesactivar; ?>"><?php echo ''.strtoupper($Pdesactivar).' (Activo)'; ?></option>
                    <option value="si">SI</option>
                    <option value="no">NO</option>
                </select>
            <div class="limpiar"></div>
            <!-- -------------------------------------------------------------------------------------------- -->
            
            <div style="margin-top:2%;">
                <p>* Descripcion:</p><br />
                <textarea id="Pdescripcion" name="Pdescripcion"><?php echo $Pdescripcion; ?></textarea>
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
                <textarea class="imput_editar" id="Pobservaciones" name="Pobservaciones" style="width:400px; height:100px;"><?php echo $Pobservaciones; ?></textarea>
            <div class="limpiar"></div>
            <!-- -------------------------------------------------------------------------------------------- -->
             
            <input type="hidden" name="action" value="1" />
            <input type="hidden" name="Pid" value="<?php echo $Pid; ?>" />

            <div class="colocar_boton">         
            <input class="boton" type="submit" value="Editar" />
            </div>           
            <div class="limpiar"></div>            

        </form>
<br />