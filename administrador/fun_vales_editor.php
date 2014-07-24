<?php
// Inicializamos sesion 
session_start();
include('../lib/config.inc.php');
include('../lib/conectar.php');

$action = utf8_decode(trim($_POST["action"]));
$Vid = utf8_decode(trim($_POST["Vid"]));
$Vvale = utf8_decode(trim($_POST["Vvale"]));
$Vvalor = utf8_decode(trim($_POST["Vvalor"]));
$Vestado = utf8_decode(trim($_POST["Vestado"]));
 

if ($action=="1"){
//ACTUALIZAR      
$query = "UPDATE Vales SET 
            Vvale='".$Vvale."',
            Vestado='".$Vestado."',
            Vvalor='".$Vvalor."'            
            WHERE Vid=".$Vid."";
            $mysqli->query($query);
            
            ////////////////////////////////////////LOG///////////////////////////////////////////////
            $fecha=date('l jS \of F Y h:i:s A');
            $iddelusuario=$_SESSION[Aid];
            $nombredelusuario=$_SESSION[Anombre];
            $descripcion='El usuario '.$nombredelusuario.' ha actualizado el vale '.$Vid.'.';
            //INSERTAR      
            $query = "INSERT INTO Log (LOGdescripcion,LOGfecha,LOGidusuario,LOGnombreusuario)
                               VALUES ('$descripcion','$fecha','$iddelusuario','$nombredelusuario')";
                    $mysqli->query($query);
            ////////////////////////////////////////LOG///////////////////////////////////////////////
            
            
            $_SESSION[errores]="ok";
            $_SESSION[comentario]="Has editado el vale."; 
            
            //REDIRIGIR
header('Location: '.$INC_url.'/administrador/panel_administrador.php?var=141&Vid='.$Vid.'');
         

}

if ($action=="2"){

$Vfecha = date("Y-m-d");
$Vvale = strtoupper($Vvale);
    
//INSERTAR      
$query = "INSERT INTO Vales (Vvale, Vfechacreacion, Vestado, Vvalor) 
            VALUES ('$Vvale', '$Vfecha', '$Vestado', '$Vvalor')";
            $mysqli->query($query);
            
            ////////////////////////////////////////LOG///////////////////////////////////////////////
            $fecha=date('l jS \of F Y h:i:s A');
            $iddelusuario=$_SESSION[Aid];
            $nombredelusuario=$_SESSION[Anombre];
            $descripcion='El usuario '.$nombredelusuario.' ha insertado un nuevo vale.';
            //INSERTAR      
            $query = "INSERT INTO Log (LOGdescripcion,LOGfecha,LOGidusuario,LOGnombreusuario)
                               VALUES ('$descripcion','$fecha','$iddelusuario','$nombredelusuario')";
                    $mysqli->query($query);
            ////////////////////////////////////////LOG///////////////////////////////////////////////
            
            
            $_SESSION[errores]="ok";
            $_SESSION[comentario]="Has creado un vale."; 
            
            //REDIRIGIR
header('Location: '.$INC_url.'/administrador/panel_administrador.php?var=14');
         

}

 
?>
