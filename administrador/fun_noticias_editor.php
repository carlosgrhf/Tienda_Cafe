<?php
// Inicializamos sesion 
session_start();
include('../lib/config.inc.php');
include('../lib/conectar.php');

$action = utf8_decode(trim($_POST["action"]));
$Nid = utf8_decode(trim($_POST["Nid"]));
$Ntitulo = utf8_decode(trim($_POST["Ntitulo"]));
$Nsubtitulo = utf8_decode(trim($_POST["Nsubtitulo"]));
$Nprecontenido = utf8_decode(trim($_POST["Nprecontenido"]));
$Ncontenido = utf8_decode(trim($_POST["Ncontenido"]));
$Nimg = utf8_decode(trim($_POST["Nimg"]));
 

if ($action=="1"){
//ACTUALIZAR      
$query = "UPDATE Noticias SET 
            Ntitulo='".$Ntitulo."',
            Nsubtitulo='".$Nsubtitulo."',
            Nprecontenido='".$Nprecontenido."',
            Ncontenido='".$Ncontenido."',
            Nimg='".$Nimg."'
            WHERE Nid=".$Nid."";
            $mysqli->query($query);
            
            ////////////////////////////////////////LOG///////////////////////////////////////////////
            $fecha=date('l jS \of F Y h:i:s A');
            $iddelusuario=$_SESSION[Aid];
            $nombredelusuario=$_SESSION[Anombre];
            $descripcion='El usuario '.$nombredelusuario.' ha actualizado la noticia '.$Nid.'.';
            //INSERTAR      
            $query = "INSERT INTO Log (LOGdescripcion,LOGfecha,LOGidusuario,LOGnombreusuario)
                               VALUES ('$descripcion','$fecha','$iddelusuario','$nombredelusuario')";
                    $mysqli->query($query);
            ////////////////////////////////////////LOG///////////////////////////////////////////////
            
            
            $_SESSION[errores]="ok";
            $_SESSION[comentario]="Has editado la noticia."; 
            
            //REDIRIGIR
header('Location: '.$INC_url.'/administrador/panel_administrador.php?var=41&Nid='.$Nid.'');
         

}

if ($action=="2"){

$Nfecha = date("Y-m-d");      
    
//INSERTAR      
$query = "INSERT INTO Noticias (Nfecha, Ntitulo, Nsubtitulo, Nprecontenido, Ncontenido, Nimg) 
            VALUES ('$Nfecha', '$Ntitulo', '$Nsubtitulo', '$Nprecontenido', '$Ncontenido', '$Nimg')";
            $mysqli->query($query);
            
            ////////////////////////////////////////LOG///////////////////////////////////////////////
            $fecha=date('l jS \of F Y h:i:s A');
            $iddelusuario=$_SESSION[Aid];
            $nombredelusuario=$_SESSION[Anombre];
            $descripcion='El usuario '.$nombredelusuario.' ha insertado una nueva noticia.';
            //INSERTAR      
            $query = "INSERT INTO Log (LOGdescripcion,LOGfecha,LOGidusuario,LOGnombreusuario)
                               VALUES ('$descripcion','$fecha','$iddelusuario','$nombredelusuario')";
                    $mysqli->query($query);
            ////////////////////////////////////////LOG///////////////////////////////////////////////
            
            
            $_SESSION[errores]="ok";
            $_SESSION[comentario]="Has creado una noticia."; 
            
            //REDIRIGIR
header('Location: '.$INC_url.'/administrador/panel_administrador.php?var=4');
         

}

 
?>
