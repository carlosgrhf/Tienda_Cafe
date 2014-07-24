<?php
// Inicializamos sesion 
session_start();
include('../lib/config.inc.php');
include('../lib/conectar.php');


/*CONTROL FORMULARIO **********************************************************/
if(trim($_POST['action'])==1){
    $nombre = utf8_decode(trim($_POST['nombre']));    
    $tlf = utf8_decode(trim($_POST['tlf']));
    $email = utf8_decode(trim($_POST['email']));    
    $mensaje_form = utf8_decode(trim($_POST['mensaje']));
    
    
    
    
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        ////////ENVIAMOS EL E-MAIL
        require_once('../fun_mailer.php');
        $email_destino = $email;
        $nombre_email = $nombre;
        $asunto = 'Contactar';
        $mensaje = '
            <p>Nombre: '.$nombre.'</p>
            <p>Email: '.$email.'</p>
            <p>Tlf: '.$tlf.'</p>
            <p>Mensaje: '.$mensaje_form.'</p>
        ';
        $comprobacion_email = mailer($email_destino, $nombre_email, $asunto, $mensaje);
        
        
              
        if($comprobacion_email==1){
            $_SESSION[errores]="ok";
            $_SESSION[comentario]="Gracias por contactar con nosotros.";
        } else {
            $_SESSION[errores]="error";
            $_SESSION[comentario]="Ha habído un error al procesar el formulario.";
        }
        
    
    
} else {
    $_SESSION[errores]="error";
    $_SESSION[comentario]="Ha habído un error al procesar el formulario.";
}


//REDIRIGIR
header('Location: '.$INC_url.'/login/contactar');
?>

