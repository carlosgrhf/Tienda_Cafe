<?php
$sql = "SELECT * FROM Productos ORDER BY Pid desc";
if(!$result = $mysqli->query($sql)){
    die("Query invalido: " . $sql);
}          
$total_registros = $result->num_rows;
/* liberamos la memoria asociada al resultado */
$result->close();   
   
    
?>


<h2>Importar / Exportar Productos</h2><br />
<p class="semillas">Inicio > Productos > Editar Productos</p><br />
<div class="limpiar"></div>


<h3>Exportar productos a excel</h3><br />
<p>En estos momentos hay <?php echo $total_registros; ?> productos en la base de datos y el primer registro es el número 0. El delimitador para LibreOffice es tabulador y ".</p>
<br />
<form method="post" action="<?php echo $INC_url; ?>/administrador/fun_exportar_productos.php">  
    
                
            <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>* Inicio:</label>
            </div>
                <input class="imput_editar" name="inicio" type="text" />
            <div class="limpiar"></div>
            <!-- -------------------------------------------------------------------------------------------- -->

            <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>* Nº Registros:</label>
            </div>
                <input class="imput_editar" name="cantidadregistros" type="text" />
            <div class="limpiar"></div>
            <!-- -------------------------------------------------------------------------------------------- -->              
                         
            

            <div class="colocar_boton">         
            <input class="boton" type="submit" value="Exportar" />
            </div>           
            <div class="limpiar"></div>            

</form>
<br /><br />

<h3>Exportar productos a csv</h3><br />
<p>En estos momentos hay <?php echo $total_registros; ?> productos en la base de datos y el primer registro es el número 0. El delimitador para LibreOffice es # y ".</p></p>
<br />
<form method="post" action="<?php echo $INC_url; ?>/administrador/fun_exportar_productos_csv.php">  
    
                
            <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>* Inicio:</label>
            </div>
                <input class="imput_editar" name="inicio" type="text" />
            <div class="limpiar"></div>
            <!-- -------------------------------------------------------------------------------------------- -->

            <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>* Nº Registros:</label>
            </div>
                <input class="imput_editar" name="cantidadregistros" type="text" />
            <div class="limpiar"></div>
            <!-- -------------------------------------------------------------------------------------------- -->               
                         
            

            <div class="colocar_boton">         
            <input class="boton" type="submit" value="Exportar" />
            </div>           
            <div class="limpiar"></div>            

</form>
<br /><br />

<h3>Importar productos desde csv</h3><br />
<p>Se permiten archivos .csv con delimitadores de punto y coma ; y texto entre comillas ".
    <a href="<?php echo $INC_url; ?>/administrador/files/importacion.csv">Ejemplo importacion.csv</a> y
    <a href="<?php echo $INC_url; ?>/administrador/files/importacion.xls">Ejemplo importacion.xls</a>
</p>
<br />
<form enctype="multipart/form-data" method="post" action="fun_importar_productos.php"> 
    
                
            <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>* Archivo .csv:</label>
            </div>
                <input type="file" name="archivo" />
            <div class="limpiar"></div>
            <!-- -------------------------------------------------------------------------------------------- -->                 
            
            <input type="hidden" name="action" value="upload" />
            
            <div class="colocar_boton">         
            <input class="boton" type="submit" value="Importar" />
            </div>           
            <div class="limpiar"></div>            

</form>
<br /><br />