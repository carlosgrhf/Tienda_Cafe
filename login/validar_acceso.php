<?php
// Inicializamos sesion 
session_start();
include('../lib/config.inc.php');
include('../lib/conectar.php');

if(isset($_POST["email"]) && isset($_POST["password"]) && trim($_POST["email"]!="") && trim($_POST["password"]!="")){
        
        $email = $mysqli->real_escape_string(trim($_POST["email"]));
        //ciframos la contraseña
        $password = $mysqli->real_escape_string(trim($_POST["password"]));
        $password_cifrado = sha1(md5($password));
        
        $sql = "SELECT * FROM Usuarios WHERE Uemail='$email' AND Upassword='$password_cifrado' AND Uvalidado='si'";
        if(!$result = $mysqli->query($sql)){
            die("Query invalido: " . $sql);
        }          
        /* fetch array asociativo*/
        while ($fila = $result->fetch_assoc()) {
            $Uid = utf8_encode($fila["Uid"]);
            $Unombre = utf8_encode($fila["Unombre"]);
            $Uemail = utf8_encode($fila["Uemail"]);
        }
        /* liberamos la memoria asociada al resultado */
        $result->close();        
        
        //Creamos las variables de sesion        
        $_SESSION[Uidacceso]=$Uid;
        $_SESSION[Unombre]=$Unombre;
        $_SESSION[Uemail]=$Uemail; 
}

if ($_SESSION[Uidacceso]==""){
    $_SESSION[errores]="error";
    $_SESSION[comentario]="No tienes acceso."; 
}

header('Location: '.$INC_url.'/login/panel_control');

?>
