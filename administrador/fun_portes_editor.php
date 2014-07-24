<?php
// Inicializamos sesion 
session_start();
include('../lib/config.inc.php');
include('../lib/conectar.php');

$action = utf8_decode(trim($_POST["action"]));
$GEid = utf8_decode(trim($_POST["GEid"]));
$GEportes = utf8_decode(trim($_POST["GEportes"]));
$GElimite = utf8_decode(trim($_POST["GElimite"]));
 

if ($action=="1"){
//ACTUALIZAR      
$query = "UPDATE Gastos_Envio SET 
            GEportes='".$GEportes."',
            GElimite='".$GElimite."'
            WHERE GEid=".$GEid."";
            $mysqli->query($query);
            
            ////////////////////////////////////////LOG///////////////////////////////////////////////
            $fecha=date('l jS \of F Y h:i:s A');
            $iddelusuario=$_SESSION[Aid];
            $nombredelusuario=$_SESSION[Anombre];
            $descripcion='El usuario '.$nombredelusuario.' ha actualizado los portes.';
            //INSERTAR      
            $query = "INSERT INTO Log (LOGdescripcion,LOGfecha,LOGidusuario,LOGnombreusuario)
                               VALUES ('$descripcion','$fecha','$iddelusuario','$nombredelusuario')";
                    $mysqli->query($query);
            ////////////////////////////////////////LOG///////////////////////////////////////////////
            
            
            $_SESSION[errores]="ok";
            $_SESSION[comentario]="Has editado los portes."; 
            
            //REDIRIGIR
header('Location: '.$INC_url.'/administrador/panel_administrador.php?var=12');
         

}



 
?>
