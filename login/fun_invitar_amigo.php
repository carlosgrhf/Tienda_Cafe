<?php
// Inicializamos sesion 
session_start();
include('../lib/config.inc.php');
include('../lib/conectar.php');


  
$emailamigo = utf8_decode(strip_tags(trim($_POST[emailamigo])));

$emailamigo = $mysqli->real_escape_string($emailamigo);

$emailmio = $_SESSION[Uemail];


if($emailamigo!=$emailmio){ 
    
        $sql = "SELECT * FROM Usuarios WHERE Uid='$_SESSION[Uidacceso]' ";
        if(!$result = $mysqli->query($sql)){
            die("Query invalido: " . $sql);
        }          
        /* fetch array asociativo*/
        while ($fila = $result->fetch_assoc()) {
            $Unombre = utf8_encode($fila["Unombre"]); 
            $Uapellidos = utf8_encode($fila["Uapellidos"]);
        }
        /* liberamos la memoria asociada al resultado */
        $result->close();
        
        
        $query = "INSERT INTO Invitaciones 
        (emailregistrado, emailinvitado) 
        VALUES 
        ('$emailmio','$emailamigo')";
        $mysqli->query($query);
        
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        ////////ENVIAMOS EL E-MAIL      
        
        
        require_once('../fun_mailer.php');
        $email_destino = $emailamigo;
        $nombre_email = "Invitacion";
        $asunto = 'Tu amigo '.$Unombre.' te recomienda esta web'; 
        $mensaje = '
            <p>'.$Unombre.' '.$Uapellidos.' te invita a conocer la tienda virtual donde comprar el mejor cafe en capsula, tanto para
                casa como para la oficina.</p>
            <p><a href="'.$INC_url.'">Pincha para ver la web.</a></p>
        ';
        $comprobacion_email = mailer($email_destino, $nombre_email, $asunto, $mensaje);
              
        if($comprobacion_email==1){
            $_SESSION[errores]="ok";
            $_SESSION[comentario]="Gracias por realizar una invitación. Si tu amigo se registra participarás en el sorteo de distintas promociones.";
        } else {
            $_SESSION[errores]="error";
            $_SESSION[comentario]="Ha habído un error al procesar el formulario.";
        }
        
    
    
    
} else {
    $_SESSION[errores]="error";
    $_SESSION[comentario]="No puedes invitarte a tí mismo.";
}        
        

echo '
    <script language="javascript" type="text/javascript">
        location.replace("'.$INC_url.'/login/panel_control");
    </script>
';

?>

