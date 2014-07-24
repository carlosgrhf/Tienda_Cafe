<?php
// Inicializamos sesion 
session_start();
include('../lib/config.inc.php');
include('../lib/conectar.php');

if(isset($_GET["email"]) && isset($_GET["token"]) && trim($_GET["email"]!="") && trim($_GET["token"]!="")) {
    
        
    $email = $mysqli->real_escape_string(trim($_GET["email"]));
    $token = $mysqli->real_escape_string(trim($_GET["token"]));
    
    $sql = "SELECT * FROM Usuarios WHERE Uemail='$email' ";
    if(!$result = $mysqli->query($sql)){
        die("Query invalido: " . $sql);
    }          
    /* fetch array asociativo*/
    while ($fila = $result->fetch_assoc()) {
        $Uid = utf8_encode($fila["Uid"]);
        $Uemail = utf8_encode($fila["Uemail"]);
        $Udnicif = utf8_encode($fila["Udnicif"]);
        $Uvalidado = utf8_encode($fila["Uvalidado"]);
    }
    /* liberamos la memoria asociada al resultado */
    $result->close(); 
    
	
        
        //creamos un token para dar seguridad al proceso
        $token_llega = $token;
        $secret_word = 'tiendaonline';
        $token_comprueba = sha1(md5($Udnicif.$secret_word));
        
        
} else {
    $_SESSION[errores]="error";
    $_SESSION[comentario]="Ha habído un error al validar tu email.";
}

if ($token_comprueba==$token_llega AND $Uvalidado=='no' ){
    
        //ACTUALIZAR      
        $query = "UPDATE Usuarios SET Uvalidado='si' WHERE Uid='$Uid'";
            $mysqli->query($query);
        
        $_SESSION[errores]="ok";
        $_SESSION[comentario]="Email validado, ya puedes acceder.";
        echo '
	
		<script language="javascript" type="text/javascript">
		   location.replace("'.$INC_url.'");
		</script>
		
        ';
} else {
    $_SESSION[errores]="error";
    $_SESSION[comentario]="Ha habído un error al validar tu email.";
    echo '
	
		<script language="javascript" type="text/javascript">
		   location.replace("'.$INC_url.'");
		</script>
		
        ';
}


?>
