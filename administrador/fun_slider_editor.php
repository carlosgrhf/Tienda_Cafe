<?php
// Inicializamos sesion 
session_start();
include('../lib/config.inc.php');
include('../lib/conectar.php');

$action = utf8_decode(trim($_POST["action"]));
$Sid = utf8_decode(trim($_POST["Sid"]));
$Stitulo = utf8_decode(trim($_POST["Stitulo"]));
$Simg = utf8_decode(trim($_POST["Simg"]));
$Slink = utf8_decode(trim($_POST["Slink"]));
$Scontenido = utf8_decode(trim($_POST["Scontenido"]));
 

if ($action=="1"){
//ACTUALIZAR      
$query = "UPDATE Slider SET 
            Stitulo='".$Stitulo."',
            Simg='".$Simg."',
            Slink='".$Slink."',
            Scontenido='".$Scontenido."'
            WHERE Sid=".$Sid."";
            $mysqli->query($query);
            
            
            $_SESSION[errores]="ok";
            $_SESSION[comentario]="Has editado el slider."; 
            
            //REDIRIGIR
header('Location: '.$INC_url.'/administrador/panel_administrador.php?var=71&Sidslider='.$Sid.'');
         

}



 
?>
