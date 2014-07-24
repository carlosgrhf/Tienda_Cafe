<?php
// Inicializamos sesion 
session_start();
include('../lib/config.inc.php');
include('../lib/conectar.php');


//La sesión
$session = session_id();

//ACTUALIZAR      
$query = "UPDATE Carrito_Temporal SET 
    CT_Vid=NULL
    WHERE CTsesion='$session'";
    $mysqli->query($query);

$_SESSION[errores]="ok";
$_SESSION[comentario]="El código promocional ha sido borrado.";


 

      
//REDIRIGIR
 echo '
 <script language="javascript" type="text/javascript">
		   location.replace("'.$INC_url.'/carrito/carrito_paso_uno");
</script>
 ';
 
?>
