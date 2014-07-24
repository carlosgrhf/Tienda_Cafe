<?php
// Inicializamos sesion 
session_start();
include('../lib/config.inc.php');
include('../lib/conectar.php');



$action = $mysqli->real_escape_string(trim($_GET["action"])); 

    //SI LA ACTION VALE 1 ENVIAMOS AL USUARIO A LA OTRA WEB
if($action==1){
    
    $palabra_secreta = "HAYCANALWEB.COM";
    $encriptada_viaja = md5(sha1($palabra_secreta));
    
    $Aid = $_SESSION[Aid];
    $Anombre = $_SESSION[Anombre];
    $Ausuario = $_SESSION[Ausuario];
    $action = 2;

    header('Location: '.$INC_url2.'/administrador/fun_login_intermedio.php?a='.$encriptada_viaja.'&b='.$Aid.'&c='.$Anombre.'&d='.$Ausuario.'&action='.$action.'');

    //SI LA ACTION VALE 2 ESTAMOS RECIBIENDO AL USUARIO DESDE LA OTRA WEB
} elseif($action==2){
    $palabra_secreta = "HAYCANALWEB.COM";
    $encriptada = md5(sha1($palabra_secreta));
    $encriptada_llega = $mysqli->real_escape_string(trim($_GET["a"]));
    
    if($encriptada==$encriptada_llega){
        $_SESSION[Aid] = $mysqli->real_escape_string(trim($_GET["b"]));
        $_SESSION[Anombre] = $mysqli->real_escape_string(trim($_GET["c"]));
        $_SESSION[Ausuario] = $mysqli->real_escape_string(trim($_GET["d"]));
        $_SESSION[webactiva] = "FACTUM-ARTE";
        
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
        
        
        header('Location: '.$INC_url.'/administrador/panel_administrador.php');
    }
    
    
} else {
    header('Location: '.$INC_url.'');
}

?>
