<?php
// Inicializamos sesion 
session_start();
include('../lib/config.inc.php');
include('../lib/conectar.php');


/*CONTROL FORMULARIO **********************************************************/
if(trim($_POST['action'])==1){
    
    $email = utf8_decode(trim($_POST['email']));
    
    
    //INSERTAR      
    $query = "INSERT INTO Newsletter (NEWemail, NEWestado) VALUES ('$email', 'activo')";
            $mysqli->query($query);    
        
              
    $_SESSION[errores]="ok";
    $_SESSION[comentario]="Gracias por darte de alta en nuestra Newsletter.";    
        
    //REDIRIGIR
    header('Location: '.$INC_url.'/login/newsletter');
    
} 

/*CONTROL FORMULARIO **********************************************************/
if(trim($_POST['action'])==2){
    
    $email = utf8_decode(trim($_POST['email']));
    
    //ACTUALIZAR      
    $query = "UPDATE Newsletter SET NEWestado='bloqueado' WHERE NEWemail='$email' ";
            $mysqli->query($query);    
        
              
    $_SESSION[errores]="ok";
    $_SESSION[comentario]="El email ".$email." ha sido dado de baja correctamente.";    
        
    //REDIRIGIR
    header('Location: '.$INC_url.'/login/newsletter');
    
} 



?>

