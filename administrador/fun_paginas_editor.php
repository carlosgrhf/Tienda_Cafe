<?php
// Inicializamos sesion 
session_start();
include('../lib/config.inc.php');
include('../lib/conectar.php');

$action = utf8_decode(trim($_POST["action"]));
$PAid = utf8_decode(trim($_POST["PAid"]));
$PAtitulo = utf8_decode(trim($_POST["PAtitulo"]));
$PAintro = utf8_decode(trim($_POST["PAintro"]));
$PAcontenido = utf8_decode(trim($_POST["PAcontenido"]));
 

if ($action=="1"){
//ACTUALIZAR      
$query = "UPDATE Paginas SET 
            PAtitulo='".$PAtitulo."',
            PAintro='".$PAintro."',
            PAcontenido='".$PAcontenido."'
            WHERE PAid=".$PAid."";
            $mysqli->query($query);
            
            ////////////////////////////////////////LOG///////////////////////////////////////////////
            $fecha=date('l jS \of F Y h:i:s A');
            $iddelusuario=$_SESSION[Aid];
            $nombredelusuario=$_SESSION[Anombre];
            $descripcion='El usuario '.$nombredelusuario.' ha actualizado la pagina '.$PAid.'.';
            //INSERTAR      
            $query = "INSERT INTO Log (LOGdescripcion,LOGfecha,LOGidusuario,LOGnombreusuario)
                               VALUES ('$descripcion','$fecha','$iddelusuario','$nombredelusuario')";
                    $mysqli->query($query);
            ////////////////////////////////////////LOG///////////////////////////////////////////////
            
            
            $_SESSION[errores]="ok";
            $_SESSION[comentario]="Has editado la página."; 
            
            //REDIRIGIR
header('Location: '.$INC_url.'/administrador/panel_administrador.php?var=31&PAid='.$PAid.'');
         

}



 
?>
