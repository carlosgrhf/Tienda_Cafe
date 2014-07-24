<?php

function mailer($email_destino,$nombre_email,$asunto,$mensaje) {

// Varios destinatarios
$para = $email_destino;

// subject
$asunto = $asunto;

// Para enviar un correo HTML mail, la cabecera Content-type debe fijarse
$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Cabeceras adicionales
$cabeceras .= 'To: '.$nombre_email.' <'.$email_destino.'>' . "\r\n" .
'From: CafeenCapsula.com <cafeencapsula@cafeencapsula.com>' . "\r\n" .
'Bcc: CafeenCapsula.com <cafeencapsula@cafeencapsula.com>' . "\r\n";


$cuerpo = '
<body>

<table width="778" cellspacing="1" cellpadding="3" border="0" bgcolor="#e5efee" align="center">
<tr>
    <td width=772 align=left bgcolor="#e5efee">
        <a href="http://www.cafeencapsula.com"><img src="http://www.cafeencapsula.com/lib/kcfinder/upload/images/email/cabecera.png" alt="CafeenCapsula.com.com"/></a>
    </td>
    
</tr>

</table>
<br>
<table width="778" cellspacing="0" cellpadding="0" border="0" align="center">
<tr>
    
    <td bgcolor= "#ffffff" width=608 valign="top">
	<!--CUERPO PRINCIPAL-->
	<font face="Garamond">
	<h1>'.$asunto.'</h1>
        '.$mensaje.'


	</font>
	
	
</tr>
</table>
<br>
<table width="778" cellspacing="1" cellpadding="3" border="0" bgcolor="#263248" align="center">
<tr>
    
    <td width=772 align=left bgcolor="#FBF7F1">
        <font size="-2" color="#382E2A">
            
            AVISO DE CONFIDENCIALIDAD:
            Este correo electr&oacute;nico y en su caso cualquier fichero adjunto al mismo contienen informaci&oacute;n de 
            car&aacute;cter confidencial exclusivamente dirigida a sus destinatarios. Si Usted no es uno de dichos destinatarios, 
            notif&iacute;quenos este hecho y elimine el mensaje de su sistema. Queda prohibida la copia, difusi&oacute;n o 
            revelaci&oacute;n de su contenido a terceros sin el previo consentimiento por escrito de CafeenCapsula.com En caso 
            contrario, vulnerar&aacute; la legislaci&oacute;n vigente.
        
        </font>
    </td>
    
</tr>

</table>

</body>    
';

    // Mail it
    $comprobacion=mail($para, $asunto, $cuerpo, $cabeceras);

    if($comprobacion==TRUE){
        $comprobacion = 1;
    } else {
        $comprobacion = 0;
    }

 
    return $comprobacion;
  
}
?>
