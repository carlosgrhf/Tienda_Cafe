<?php
$email_destino="carlos.gutierrez@haycanal.com";
$nombre_email="Carlos";
$asunto="Asunto del email";
$mensaje="Este es el mensaje del email";

mailer($email_destino, $nombre_email, $asunto, $mensaje);

function mailer($email_destino,$nombre_email,$asunto,$mensaje) {

// Varios destinatarios
$para = $email_destino;

// subject
$asunto = $asunto;

// Para enviar un correo HTML mail, la cabecera Content-type debe fijarse
$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Cabeceras adicionales
$cabeceras .= 'To: Carlos <carlos.gutierrez@haycanal.com>' . "\r\n" .
'From: RelojesyBisuteria.com <noreply@relojesybisuteria.com>' . "\r\n" .
'Reply-To: noreply@relojesybisuteria.com' . "\r\n".
'Bcc: haycanalweb@haycanalweb.com' . "\r\n";

$cuerpo = '
<body>

<table width="778" cellspacing="1" cellpadding="3" border="0" bgcolor="#263248" align="center">
<tr>
    <td width=772 align=left bgcolor="#7E8AA2">
        <font size="+2" color="#ffffff"><strong>www.tiendaonline.com</strong></font>
    </td>
    
</tr>

</table>
<br>
<table width="778" cellspacing="0" cellpadding="0" border="0" align="center">
<tr>
    <td width=150 valign="top">
	<!--NAVEGADOR LATERAL IZQUIERDO-->
			<table width="150" cellspacing="1" cellpadding="3" border="0" bgcolor="#263248"> 
			<tr> 
			   <td bgcolor="#7E8AA2"><font size="3" color="#FFFFFF"><b>+ Info</b></font></td> 
			</tr> 
			<tr> 
			   <td bgcolor="#DFEBFF"> 
			
			    <table width="95%" cellspacing="1" cellpadding="1" border="0" align="center"> 
			<tr> 
			   <td valign=top><font face="Garamond" size=2>+</font></td> 
			   <td><font face="Garamond" size=2> 
			
			www.tiendaonline.com 
			
			      </font></td> 
			   </tr> 
			   <tr> 
			      <td valign=top><font face="Garamond" size=2>+</font></td> 
			   <td><font face="Garamond" size=2> 
			
			tiendaonline@tiendaonline.com 
			
			      </font></td> 
			   </tr> 
			   <tr> 
			      <td valign=top><font face="Garamond" size=2>+</font></td> 
			      <td><font face="Garamond" size=2> 
			
			917789087
			
			      </font></td> 
			   </tr> 
			   
			   </table> 
			
			   </td> 
			</tr> 
			</table> 
	
	</td>
	<td width=10></td>
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
    
    <td width=772 align=left bgcolor="#7E8AA2">
        <font size="-2" color="#DFEBFF">
            
            AVISO DE CONFIDENCIALIDAD:
            Este correo electr&oacute;nico y en su caso cualquier fichero adjunto al mismo contienen informaci&oacute;n de 
            car&aacute;cter confidencial exclusivamente dirigida a sus destinatarios. Si Usted no es uno de dichos destinatarios, 
            notif&iacute;quenos este hecho y elimine el mensaje de su sistema. Queda prohibida la copia, difusi&oacute;n o 
            revelaci&oacute;n de su contenido a terceros sin el previo consentimiento por escrito de La Empresa SL. En caso 
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
        echo "Exito";
    } else {
        echo "Fracaso";
    }


}
        
?>
