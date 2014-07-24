<?php
// Inicializamos sesion 
session_start();
include('../lib/config.inc.php');
include('../lib/conectar.php');

$action = utf8_decode(trim($_POST["action"]));
$Uid = utf8_decode(trim($_POST["Uid"]));
$Utipo = utf8_decode(trim($_POST["Utipo"]));
$Uempresa = utf8_decode(trim($_POST["Uempresa"]));
$Unombre = utf8_decode(trim($_POST["Unombre"]));
$Uapellidos = utf8_decode(trim($_POST["Uapellidos"]));
$Udnicif = utf8_decode(trim($_POST["Udnicif"]));
$Udireccion = utf8_decode(trim($_POST["Udireccion"]));
$Ucp = utf8_decode(trim($_POST["Ucp"]));
$Ulocalidad = utf8_decode(trim($_POST["Ulocalidad"]));
$Uprovincia = utf8_decode(trim($_POST["Uprovincia"]));
$Upais = utf8_decode(trim($_POST["Upais"]));
$Uemail = utf8_decode(trim($_POST["Uemail"]));
$Ucondiciones = utf8_decode(trim($_POST["Ucondiciones"]));
$Unews = utf8_decode(trim($_POST["Unews"]));
$Utipo = utf8_decode(trim($_POST["Utipo"]));
$Uvalidado = utf8_decode(trim($_POST["Uvalidado"]));

 

if ($action=="1"){
//ACTUALIZAR      
$query = "UPDATE Usuarios SET 
            Uempresa='".$Uempresa."',
            Unombre='".$Unombre."',
            Uapellidos='".$Uapellidos."',
            Udnicif='".$Udnicif."',
            Udireccion='".$Udireccion."',
            Ucp='".$Ucp."',
            Ulocalidad='".$Ulocalidad."',
            Uprovincia='".$Uprovincia."',
            Upais='".$Upais."',
            Uemail='".$Uemail."',
            Ucondiciones='".$Ucondiciones."',
            Unews='".$Unews."',
            Utipo='".$Utipo."',
            Uvalidado='".$Uvalidado."'
            WHERE Uid=".$Uid."";
            $mysqli->query($query);
            
            ////////////////////////////////////////LOG///////////////////////////////////////////////
            $fecha=date('l jS \of F Y h:i:s A');
            $iddelusuario=$_SESSION[Aid];
            $nombredelusuario=$_SESSION[Anombre];
            $descripcion='El usuario '.$nombredelusuario.' ha actualizado el cliente '.$Uid.'.';
            //INSERTAR      
            $query = "INSERT INTO Log (LOGdescripcion,LOGfecha,LOGidusuario,LOGnombreusuario)
                               VALUES ('$descripcion','$fecha','$iddelusuario','$nombredelusuario')";
                    $mysqli->query($query);
            ////////////////////////////////////////LOG///////////////////////////////////////////////
            
            
            $_SESSION[errores]="ok";
            $_SESSION[comentario]="Has editado el cliente."; 
            
            //REDIRIGIR
header('Location: '.$INC_url.'/administrador/panel_administrador.php?var=81&Uid='.$Uid.'');
         

}



 
?>
