<?php
// Inicializamos sesion 
session_start();
include('../lib/config.inc.php');
include('../lib/conectar.php');

$action = utf8_decode(trim($_POST["action"]));
$id = utf8_decode(trim($_POST["id"]));
$nombre = utf8_decode(trim($_POST["nombre"]));
$usuario = utf8_decode(trim($_POST["usuario"]));
$password = utf8_decode(trim($_POST["password"]));
 

if ($action=="1"){
//ACTUALIZAR      
$query = "UPDATE Administrador SET 
            Anombre='".$nombre."',
            Ausuario='".$usuario."'
            WHERE Aid=".$id."";
            $mysqli->query($query);
            
            
            $_SESSION[errores]="ok";
            $_SESSION[comentario]="Has editado el usuario."; 
            
            //REDIRIGIR
header('Location: '.$INC_url.'/administrador/panel_administrador.php?var=21&Aid_us='.$id.'');
         

} 

if ($action=="2"){
//ACTUALIZAR      
$query = "UPDATE Administrador SET 
            Apassword='".$password."'
            WHERE Aid=".$id."";
            $mysqli->query($query);
            
            
            $_SESSION[errores]="ok";
            $_SESSION[comentario]="Has editado el password del usuario.";
            
            //REDIRIGIR
header('Location: '.$INC_url.'/administrador/panel_administrador.php?var=21&Aid_us='.$id.'');
         

}

if ($action=="3"){
//ACTUALIZAR      
$query = "INSERT INTO Administrador (Anombre, Ausuario, Apassword) 
            VALUES ('$nombre', '$usuario', '$password')";
            $mysqli->query($query);
            
            
            $_SESSION[errores]="ok";
            $_SESSION[comentario]="Has creado un usuario."; 
            
            //REDIRIGIR
header('Location: '.$INC_url.'/administrador/panel_administrador.php?var=2');
         

}



 
?>
