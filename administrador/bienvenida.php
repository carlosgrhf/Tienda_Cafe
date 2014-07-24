
<div class="caja_bienvenida">
    <div class="caja_marco_bienvenida">
        Últimas entradas del Blog
    </div>
    <br />
    <div class="caja_bienvenida_dentro">
    <?php
    $sql = "SELECT * FROM Noticias ORDER BY Nid desc LIMIT 7";
    if(!$result = $mysqli->query($sql)){
        die("Query invalido: " . $sql);
    }          
    /* fetch array asociativo*/
    while ($fila = $result->fetch_assoc()) {
        $Nid = utf8_encode($fila["Nid"]);
        $Nfecha = utf8_encode($fila["Nfecha"]);
        $Ntitulo = utf8_encode($fila["Ntitulo"]);
        $Nsubtitulo = utf8_encode($fila["Nsubtitulo"]);
        $Ncontenido = utf8_encode($fila["Ncontenido"]);
        $Nimg = utf8_encode($fila["Nimg"]);
        $Npinchazos = utf8_encode($fila["Npinchazos"]); 
        
        echo '<p>'.cambiaf_a_normal($Nfecha).' - <a href="'.$INC_url.'/administrador/panel_administrador.php?var=91&Nid='.$Nid.'">'.$Ntitulo.'</a></p><br />';
        
    }
    /* liberamos la memoria asociada al resultado */
    $result->close();	
    ?>
    </div>
</div>

<div class="caja_bienvenida">
    <div class="caja_marco_bienvenida">
        Log
    </div>
    <br />
    <div class="caja_bienvenida_dentro">
    <?php
    $sql = "SELECT * FROM Log ORDER BY LOGid desc LIMIT 7";
    if(!$result = $mysqli->query($sql)){
        die("Query invalido: " . $sql);
    }          
    /* fetch array asociativo*/
    while ($fila = $result->fetch_assoc()) {
        $LOGid = utf8_encode($fila["LOGid"]);
        $LOGdescripcion = utf8_encode($fila["LOGdescripcion"]);
        $LOGfecha = utf8_encode($fila["LOGfecha"]);
        $LOGidusuario = utf8_encode($fila["LOGidusuario"]); 
        $LOGnombreusuario = utf8_encode($fila["LOGnombreusuario"]);
        
        echo '<p>'.$LOGnombreusuario.' - '.$LOGdescripcion.'</p><br />';
        
    }
    /* liberamos la memoria asociada al resultado */
    $result->close();	
    ?>
    </div>
</div>

<div class="limpiar"></div>

        
    
