<?php
// Inicializamos sesion 
session_start();
include('../lib/config.inc.php');
include('../lib/conectar.php');

$vale = strtoupper(utf8_decode(trim($_POST["vale"])));

//COMPROBAMOS SI HAY UN VALE COMO EL INDICADO POR EL USUARIO
$sql = "SELECT * FROM Vales WHERE Vvale='$vale' AND Vestado='activo'";
if(!$result = $mysqli->query($sql)){
    die("Query invalido: " . $sql);
}
/* fetch array asociativo*/
while ($fila = $result->fetch_assoc()) {                
    $Vid = utf8_encode($fila["Vid"]);
    $Vestado = utf8_encode($fila["Vestado"]);
    $Vvalor = utf8_encode($fila["Vvalor"]);
}
/* liberamos la memoria asociada al resultado */
$result->close();

if($Vid!=""){
            
        //La sesión
        $session = session_id();
        
        //ACTUALIZAR      
        $query = "UPDATE Carrito_Temporal SET 
            CT_Vid='".$Vid."'
            WHERE CTsesion='$session'";
            $mysqli->query($query);
            
        $_SESSION[errores]="ok";
        $_SESSION[comentario]="El código introducido es correcto y ha sido aplicado.";
        
        
    
    
    
} else {
    $_SESSION[errores]="error";
    $_SESSION[comentario]="El código introducido no es válido.";
}
 

      
//REDIRIGIR
 echo '
 <script language="javascript" type="text/javascript">
		   location.replace("'.$INC_url.'/carrito/carrito_paso_uno");
</script>
 ';
 
?>
