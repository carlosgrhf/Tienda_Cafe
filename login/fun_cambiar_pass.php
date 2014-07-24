<?php
// Inicializamos sesion 
session_start();
include('../lib/config.inc.php');
include('../lib/conectar.php');


        
//Recogemos email enviado
$email = utf8_decode(trim($_POST['email']));
$tokenviene = utf8_decode(trim($_POST['token']));
$password = utf8_decode(trim($_POST['password']));
$repetirpassword = utf8_decode(trim($_POST['repetirpassword']));

//comprobamos que el email está en la base de datos
$sql = "SELECT * FROM Usuarios WHERE Uemail = '$email' ";
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
    
    if($tokenviene==$token){
        
        if($repetirpassword==$password){
        
            //ciframos la contraseña
            $password_cifrado = sha1(md5($password));

            //ACTUALIZAR      
            $query = "UPDATE Usuarios SET 
                    Upassword='".$password_cifrado."'
                    WHERE Uid=".$Uid."";
                    $mysqli->query($query);

            $_SESSION[errores]="ok";
            $_SESSION[comentario]="Has cambiado tu contraseña. Ya puedes acceder a tu panel de control.";
        } else {
            $_SESSION[errores]="error";
            $_SESSION[comentario]="No son iguales las contraseñas introducidas. Has debido equivocarte.";
        }
        
    } else {
        $_SESSION[errores]="error";
        $_SESSION[comentario]="Ha habido un error en el proceso de seguridad. Vuelve a intentarlo.";
    }
    
    
    
} else {
    $_SESSION[errores]="error";
    $_SESSION[comentario]="Tu email no está registrado. Por favor registrate de nuevo o consulta al administrador de la web.";
}

 

echo '
    <script language="javascript" type="text/javascript">
        location.replace("'.$INC_url.'/login/cambiar_pass.php?email='.$email.'&token='.$tokenviene.'");
    </script>
';

?>

