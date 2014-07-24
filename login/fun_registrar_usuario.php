<?php
// Inicializamos sesion 
session_start();
include('../lib/config.inc.php');
include('../lib/conectar.php');


/*CONTROL FORMULARIO **********************************************************/
if(trim($_POST['action'])==1 AND trim($_POST['nacimiento'])==""){
    
    
    $tipo = utf8_decode(trim($_POST['tipo']));
    $empresa = utf8_decode(trim($_POST['empresa']));
    $nombre = utf8_decode(trim($_POST['nombre']));
    $apellidos = utf8_decode(trim($_POST['apellidos']));
    $dnicif = utf8_decode(trim($_POST['dnicif']));
    $direccion = utf8_decode(trim($_POST['direccion']));
    $cp = utf8_decode(trim($_POST['cp']));
    $localidad = utf8_decode(trim($_POST['localidad']));
    $provincia = utf8_decode(trim($_POST['provincia']));
    $pais = utf8_decode(trim($_POST['pais']));
    $tlf = utf8_decode(trim($_POST['tlf']));
    $email = utf8_decode(trim($_POST['email']));
    $password = utf8_decode(trim($_POST['password']));
    $newsletter = utf8_decode(trim($_POST['newsletter']));
    
    
    //VAMOS A COMPROBAR QUE EL EMAIL INTRODUCIDO NO ESTÁ YA EN LA BASE DE DATOS
    $sql = "SELECT * FROM Usuarios WHERE Uemail='$email'";
    if(!$result = $mysqli->query($sql)){
        die("Query invalido: " . $sql);
    }          
    /* fetch array asociativo*/
    while ($fila = $result->fetch_assoc()) {
        $Uid = utf8_encode($fila["Uid"]);        
        $Uempresa = utf8_encode($fila["Uempresa"]);  
        $Unombre = utf8_encode($fila["Unombre"]);   
        $Uapellidos = utf8_encode($fila["Uapellidos"]);        
        $Udnicif = utf8_encode($fila["Udnicif"]);  
        $Udireccion = utf8_encode($fila["Udireccion"]);
        $Ucp = utf8_encode($fila["Ucp"]);
        $Ulocalidad = utf8_encode($fila["Ulocalidad"]);
        $Uprovincia = utf8_encode($fila["Uprovincia"]);
        $Upais = utf8_encode($fila["Upais"]);
        $Utlf = utf8_encode($fila["Utlf"]);
        $Uemail = utf8_encode($fila["Uemail"]);
        $Ucondiciones = utf8_encode($fila["Ucondiciones"]);
        $Unews = utf8_encode($fila["Unews"]);
        $Utipo = utf8_encode($fila["Utipo"]);
        $Upassword = utf8_encode($fila["Upassword"]);
        $Uvalidado = utf8_encode($fila["Uvalidado"]);
        $Unumerocompras = utf8_encode($fila["Unumerocompras"]);
        $Ufechaultimacompra = utf8_encode($fila["Ufechaultimacompra"]);
        $Ugastototal = utf8_encode($fila["Ugastototal"]);
    }
    /* liberamos la memoria asociada al resultado */
    $result->close();
    
    if($Uemail==$email){
        $_SESSION[errores]="error";
        $_SESSION[comentario]='El email que has introducido ya está registrado en esta tienda. Si has olvidado tu contraseña pincha
            en <a href="'.$INC_url.'/login/recordar">recordar contraseña</a> ';
        
        //REDIRIGIR
        header('Location: '.$INC_url.'/login/registro');
        die();
    }
    
        
    //convertimos a mayusculas las variables necesarias
    $empresa=strtolower($empresa);
    $empresa=ucwords($empresa);  
    
    $nombre=strtolower($nombre);
    $nombre=ucwords($nombre);
    
    $apellidos=strtolower($apellidos);
    $apellidos=ucwords($apellidos);
    
    $direccion=strtolower($direccion);
    $direccion=ucwords($direccion);
    
    $dnicif=strtoupper($dnicif);    
    $localidad=strtoupper($localidad);
    $provincia=strtoupper($provincia);
        
    //ciframos la contraseña
    $password_cifrado = sha1(md5($password));    
    
    $query = "INSERT INTO Usuarios 
    (Uempresa, Unombre, Uapellidos, Udnicif, Udireccion, Ucp, Ulocalidad, Uprovincia, Upais, Utlf, Uemail, Ucondiciones, Unews, Utipo, Upassword) 
    VALUES 
    ('$empresa','$nombre','$apellidos','$dnicif','$direccion','$cp','$localidad','$provincia','$pais','$tlf','$email','si','$newsletter','$tipo','$password_cifrado')";
    $mysqli->query($query);
    
    
    
    //creamos un token para dar seguridad al proceso
    $secret_word = 'tiendaonline';
    $token = sha1(md5($dnicif.$secret_word));
    
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        ////////ENVIAMOS EL E-MAIL
        
        
        
        require_once('../fun_mailer.php');
        $email_destino = $email;
        $nombre_email = $nombre;
        $asunto = 'Validar Registro';
        $mensaje = '
            <p>Te has registrado en nuestra tienda online, por favor, valida tu email pinchando en el siguiente enlace.</p>
            <p><a href="'.$INC_url.'/login/validar_registro.php?email='.$email.'&token='.$token.'">Pincha aqui para validar tu email.</a></p>
        ';
        $comprobacion_email = mailer($email_destino, $nombre_email, $asunto, $mensaje);
              
        if($comprobacion_email==1){
            $_SESSION[errores]="ok";
            $_SESSION[comentario]="Gracias por registrarte. Recibirás un correo eléctronico para validar tu email.";
        } else {
            $_SESSION[errores]="error";
            $_SESSION[comentario]="Ha habído un error al procesar el formulario.";
        }
        
    
    
} else {
    $_SESSION[errores]="error";
    $_SESSION[comentario]="Ha habído un error al procesar el formulario.";
}


//REDIRIGIR
header('Location: '.$INC_url.'/login/registro');
?>

