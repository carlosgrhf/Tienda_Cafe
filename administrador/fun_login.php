<?php
// Inicializamos sesion 
session_start();
include('../lib/config.inc.php');
include('../lib/conectar.php');



if(isset($_POST["nombre"]) &&
   isset($_POST["usuario"]) &&
   isset($_POST["password"]) &&     
   trim($_POST["nombre"]!="") && 
   trim($_POST["usuario"]!="") && 
   trim($_POST["password"]!="")){
    
        
        
        $nombre = $mysqli->real_escape_string(trim($_POST["nombre"]));    
        $usuario = $mysqli->real_escape_string(trim($_POST["usuario"]));
        $password = $mysqli->real_escape_string(trim($_POST["password"]));
                
        $sql = "SELECT * FROM Administrador WHERE
                                    Anombre='$nombre' AND
                                    Ausuario='$usuario' AND
                                    Apassword='$password'";
        if(!$result = $mysqli->query($sql)){
            die("Query invalido: " . $sql);
        }          
        /* fetch array asociativo*/
        while ($fila = $result->fetch_assoc()) {
            $Aid = utf8_encode($fila["Aid"]);
            $Anombre = utf8_encode($fila["Anombre"]);
            $Ausuario = utf8_encode($fila["Ausuario"]);
        }
        /* liberamos la memoria asociada al resultado */
        $result->close();        
        
        //Creamos las variables de sesion        
        $_SESSION[Aid]=$Aid;
        $_SESSION[Anombre]=$Anombre;
        $_SESSION[Ausuario]=$Ausuario; 
        $_SESSION[webactiva]="FACTUM-ARTE";
}

if ($_SESSION[Aid]==""){
    
    $_SESSION[errores]="error";
    $_SESSION[comentario]="No tienes acceso."; 
    
    header('Location: '.$INC_url.'/administrador');
    
} else { 
    
    
    ////////////////////////////////////////LOG///////////////////////////////////////////////
    $fecha=date('l jS \of F Y h:i:s A');
    $iddelusuario=$_SESSION[Aid];
    $nombredelusuario=$_SESSION[Anombre];
    $descripcion='El usuario '.$nombredelusuario.' ha accedido al gestor.';
    //INSERTAR      
    $query = "INSERT INTO Log (LOGdescripcion,LOGfecha,LOGidusuario,LOGnombreusuario)
                       VALUES ('$descripcion','$fecha','$iddelusuario','$nombredelusuario')";
            $mysqli->query($query);
    ////////////////////////////////////////LOG///////////////////////////////////////////////
    
    $_SESSION[errores]="ok";
    $_SESSION[comentario]="Has accedido al panel de administración."; 
    
    header('Location: '.$INC_url.'/administrador/panel_administrador.php');
    
} 



?>
