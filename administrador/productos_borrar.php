<?php
// Inicializamos sesion 
session_start();
include('../lib/config.inc.php');
include('../lib/conectar.php');


$Nid = utf8_decode(trim($_GET["Nid"]));
 

//BORRAR

$query = "DELETE FROM Noticias WHERE Nid=$Nid";
            $mysqli->query($query);
            
            ////////////////////////////////////////LOG///////////////////////////////////////////////
            $fecha=date('l jS \of F Y h:i:s A');
            $iddelusuario=$_SESSION[Aid];
            $nombredelusuario=$_SESSION[Anombre];
            $descripcion='El usuario '.$nombredelusuario.' ha borrado la noticia '.$Nid.'.';
            //INSERTAR      
            $query = "INSERT INTO Log (LOGdescripcion,LOGfecha,LOGidusuario,LOGnombreusuario)
                               VALUES ('$descripcion','$fecha','$iddelusuario','$nombredelusuario')";
                    $mysqli->query($query);
            ////////////////////////////////////////LOG///////////////////////////////////////////////
            
            
            $_SESSION[errores]="ok";
            $_SESSION[comentario]="Has borrado la noticia."; 
            
            //REDIRIGIR
header('Location: '.$INC_url.'/administrador/panel_administrador.php?var=4');
         



 
?>
