<?php
// Inicializamos sesion 
session_start();
include('../lib/config.inc.php');
include('../lib/conectar.php');


        
//Recogemos email enviado
$email = utf8_decode(trim($_POST['email']));

//comprobamos que el email está en la base de datos
$sql = "SELECT * FROM Usuarios WHERE Uemail = '".$email."' ";
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

if ($Uid!=""){
    //creamos un token para dar seguridad al proceso
    $secret_word = 'haycanalweb';
    $token = sha1(md5($secret_word));
    
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        ////////ENVIAMOS EL E-MAIL
        
        
        
        require_once('../fun_mailer.php');
        $email_destino = $email;
        $nombre_email = $Unombre;
        $asunto = 'Cambiar password';
        $mensaje = '
            <p>Has solicitado el cambio de tu password. Por favor pincha en este enlace para cambiarlo.</p>
            <p><a href="'.$INC_url.'/login/cambiar_pass.php?email='.$email.'&token='.$token.'">Pincha aqui para cambiar tu password.</a></p>
        ';
        $comprobacion_email = mailer($email_destino, $nombre_email, $asunto, $mensaje);
              
        if($comprobacion_email==1){
            $_SESSION[errores]="ok";
            $_SESSION[comentario]="Recibirás un correo eléctronico para cambiar tu contraseña.";
        } else {
            $_SESSION[errores]="error";
            $_SESSION[comentario]="Ha habído un error al procesar el formulario. Por favor vuelve a intentarlo.";
        }
    
} else {
    $_SESSION[errores]="error";
    $_SESSION[comentario]="El email introducido no está registrado.";
}

 

echo '
    <script language="javascript" type="text/javascript">
        location.replace("'.$INC_url.'/login/recordar");
    </script>
';

?>

