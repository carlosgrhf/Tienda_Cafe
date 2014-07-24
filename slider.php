<div id="slider">

	<div id="mover">


<?php
$sql = "SELECT * FROM Slider ORDER BY Sid asc LIMIT 3";
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
    
    echo '
      <div id="slide-1" class="slide">
		
            <h2>'.$Stitulo.'</h2>

            '.$Scontenido.'

            <a href="http://'.$Slink.'" title="'.$Stitulo.'"><img src="'.$INC_url.'/lib/kcfinder/upload/images/slider/'.$Simg.'" alt="'.$Stitulo.'" style="width: 400px; height: 200px;" /></a>
                
            
			
	</div>  
    ';
    
    
}
/* liberamos la memoria asociada al resultado */
$result->close();
?>



		

		
	
	</div>

</div>

