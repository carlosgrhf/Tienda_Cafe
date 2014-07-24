<?php
// Inicializamos sesion 
session_start();
include('../lib/config.inc.php');
include('../lib/conectar.php');

/*CONTROL FORMULARIO **********************************************************/
if(trim($_POST['action'])==1){
    $control = 0;
    
    //recogemos pero no validamos la empresa
    $empresa = utf8_decode(trim($_POST['empresa']));
    
    //CONTROL TIPO
    if(trim($_POST['tipo']) != "" ){
        $tipo = utf8_decode(trim($_POST['tipo']));
        $control++; //VALE 1
    }
    
    //CONTROL NOMBRE
    if(trim($_POST['nombre']) != "" ){
        $nombre = utf8_decode(trim($_POST['nombre']));
        $control++; //VALE 2
    }
    
    //CONTROL APELLIDOS
    if(trim($_POST['apellidos']) != "" ){
        $apellidos = utf8_decode(trim($_POST['apellidos']));
        $control++; //VALE 3
    }
    
    //CONTROL DNI
    if(trim($_POST['dnicif']) != "" ){
        $dnicif = utf8_decode(trim($_POST['dnicif']));
        $control++; //VALE 4
    }
    
    //CONTROL DIRECCION
    if(trim($_POST['direccion']) != "" ){
        $direccion = utf8_decode(trim($_POST['direccion']));
        $control++; //VALE 5
    }
    
    //CONTROL CP
    if(trim($_POST['cp']) != "" ){
        $cp = utf8_decode(trim($_POST['cp']));
        $control++; //VALE 6
    }
    
    //CONTROL LOCALIDAD
    if(trim($_POST['localidad']) != "" ){
        $localidad = utf8_decode(trim($_POST['localidad']));
        $control++; //VALE 7
    }
    
    //CONTROL PROVINCIA
    if(trim($_POST['provincia']) != "" ){
        $provincia = utf8_decode(trim($_POST['provincia']));
        $control++; //VALE 8
    }
    
    //CONTROL PAIS
    if(trim($_POST['pais']) != "" ){
        $pais = utf8_decode(trim($_POST['pais']));
        $control++; //VALE 9
    }
    
    //CONTROL TELEFONO
    if(trim($_POST['tlf']) != "" ){
        $tlf = utf8_decode(trim($_POST['tlf']));
        $control++; //VALE 10
    }
    
        
    
    
    
    
    
    //SI TODOS LOS CAMPOS SON CORRECTOS, HACEMOS EL INSERT EN LA BD
    if($control == 10){
        
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
      
    
       
    
    //ACTUALIZAR      
    $query = "UPDATE Usuarios SET 
                Uempresa='".$empresa."',
                Unombre='".$nombre."', 
                Uapellidos='".$apellidos."',
                Udnicif='".$dnicif."',
                Udireccion='".$direccion."',
                Ucp='".$cp."',
                Ulocalidad='".$localidad."',
                Uprovincia='".$provincia."',
                Upais='".$pais."',
                Utlf='".$tlf."',
                Utipo='".$tipo."'
                WHERE Uid=".$_SESSION[Uidacceso]."";
                $mysqli->query($query);
    
    
    
              
        
            $_SESSION[errores]="ok";
            $_SESSION[comentario]="Gracias por actualizar tus datos.";
        
        
    } else {
        $_SESSION[errores]="error";
        $_SESSION[comentario]="Ha habído un error al procesar el formulario.";
    }
    
} elseif(trim($_POST['action'])==2){ 
    //CONTROL PASSWORD ACTUAL
    if(trim($_POST['pass']) != "" ){
        $passwordactual = utf8_decode(trim($_POST['pass']));
        $control++; //VALE 1
    }
    
    //CONTROL PASSWORD NUEVO
    if(trim($_POST['password2']) != "" ){
        $password = utf8_decode(trim($_POST['password2']));
        $control++; //VALE 2
    }
    
    
    if($control == 2){
        
        $sql = "SELECT * FROM Usuarios WHERE Uid='$_SESSION[Uidacceso]' ";
        if(!$result = $mysqli->query($sql)){
            die("Query invalido: " . $sql);
        }          
        /* fetch array asociativo*/
        while ($fila = $result->fetch_assoc()) {
            $Upassword = utf8_encode($fila["Upassword"]);
        }
        /* liberamos la memoria asociada al resultado */
        $result->close();	
        
        //ciframos la contraseña
        $passwordactual = sha1(md5($passwordactual)); 
        
        if($passwordactual==$Upassword){
            //ciframos la contraseña
            $password_cifrado = sha1(md5($password)); 
            //ACTUALIZAR      
            $query = "UPDATE Usuarios SET
                        Upassword='".$password_cifrado."'
                        WHERE Uid=".$_SESSION[Uidacceso]."";
                        $mysqli->query($query);
                        
            $_SESSION[errores]="ok";
            $_SESSION[comentario]="Tu contraseña ha sido cambiada.";
            
        } else {
            $_SESSION[errores]="error";
            $_SESSION[comentario]="Tu contraseña actual no es correcta.";
        }
        
        
    } else {
        $_SESSION[errores]="error";
        $_SESSION[comentario]="Ha habído un error al procesar el formulario.";
    }
    
    
    
} else {
    $_SESSION[errores]="error";
    $_SESSION[comentario]="Ha habído un error al procesar el formulario.";    
}

echo '
    <script language="javascript" type="text/javascript">
        location.replace("'.$INC_url.'/login/1/panel_control");
    </script>
';

?>

