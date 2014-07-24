<?php
// Inicializamos sesion 
session_start();
include('../lib/config.inc.php');
include('../lib/conectar.php');

$action = utf8_decode(trim($_POST["action"]));
$Cid = utf8_decode(trim($_POST["Cid"]));
$Ctitulo = utf8_decode(trim($_POST["Ctitulo"]));
$Csubtitulo = utf8_decode(trim($_POST["Csubtitulo"]));
$Cprecontenido = utf8_decode(trim($_POST["Cprecontenido"]));
$Ccontenido = utf8_decode(trim($_POST["Ccontenido"]));
$Cimg = utf8_decode(trim($_POST["Cimg"]));
$Cidioma = utf8_decode(trim($_POST["Cidioma"]));
 

if ($action=="1"){
//ACTUALIZAR      
$query = "UPDATE Creando SET 
            Ctitulo='".$Ctitulo."',
            Csubtitulo='".$Csubtitulo."',
            Cprecontenido='".$Cprecontenido."',
            Ccontenido='".$Ccontenido."',
            Cimg='".$Cimg."',
            Cidioma='".$Cidioma."'
            WHERE Cid=".$Cid."";
            $mysqli->query($query);
            
            ////////////////////////////////////////LOG///////////////////////////////////////////////
            $fecha=date('l jS \of F Y h:i:s A');
            $iddelusuario=$_SESSION[Aid];
            $nombredelusuario=$_SESSION[Anombre];
            $descripcion='El usuario '.$nombredelusuario.' ha actualizado el creando '.$Cid.'.';
            //INSERTAR      
            $query = "INSERT INTO Log (LOGdescripcion,LOGfecha,LOGidusuario,LOGnombreusuario)
                               VALUES ('$descripcion','$fecha','$iddelusuario','$nombredelusuario')";
                    $mysqli->query($query);
            ////////////////////////////////////////LOG///////////////////////////////////////////////
            
            
            $_SESSION[errores]="ok";
            $_SESSION[comentario]="Has editado el creando."; 
            
            //REDIRIGIR
header('Location: '.$INC_url.'/administrador/panel_administrador.php?var=51&Cid='.$Cid.'');
         

}

if ($action=="2"){

$Cfecha = date("Y-m-d");      
    
//INSERTAR      
$query = "INSERT INTO Creando (Cfecha, Ctitulo, Csubtitulo, Cprecontenido, Ccontenido, Cimg, Cidioma) 
            VALUES ('$Cfecha', '$Ctitulo', '$Csubtitulo', '$Cprecontenido', '$Ccontenido', '$Cimg', '$Cidioma')";
            $mysqli->query($query);
            
            ////////////////////////////////////////LOG///////////////////////////////////////////////
            $fecha=date('l jS \of F Y h:i:s A');
            $iddelusuario=$_SESSION[Aid];
            $nombredelusuario=$_SESSION[Anombre];
            $descripcion='El usuario '.$nombredelusuario.' ha insertado un nuevo creando.';
            //INSERTAR      
            $query = "INSERT INTO Log (LOGdescripcion,LOGfecha,LOGidusuario,LOGnombreusuario)
                               VALUES ('$descripcion','$fecha','$iddelusuario','$nombredelusuario')";
                    $mysqli->query($query);
            ////////////////////////////////////////LOG///////////////////////////////////////////////
            
            
            $_SESSION[errores]="ok";
            $_SESSION[comentario]="Has creado un creando."; 
            
            //REDIRIGIR
header('Location: '.$INC_url.'/administrador/panel_administrador.php?var=5');
         

}

 
?>
