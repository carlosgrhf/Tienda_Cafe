<?php
// Inicializamos sesion 
session_start();
include('../lib/config.inc.php');
include('../lib/conectar.php');
include('../fun_fechas.php');
include('../fun_acentos.php');
include('../fun_acentosyespacios.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo $INC_url; ?>/favicon.ico" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="Keywords" content="<?php echo $INC_palabras; ?>" />
	<meta name="Description" content="Registro de usuarios - <?php echo $INC_descripcion; ?>" />
        <meta name="author" content="Hay Canal Web S.L." />
	<meta name="Language" content="es" />
	<meta name="Robots" content="index, follow" />
	<title><?php echo $INC_titulo; ?> - Registro de usuarios</title>
        <!-- Llamadas a Estilos y Reset -->
	<link rel="stylesheet" type="text/css" href="<?php echo $INC_url; ?>/estilos/reset.css" /> 
        <link rel="stylesheet" type="text/css" href="<?php echo $INC_url; ?>/estilos/estilos.css" />
        <!-- Google Font -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700,300italic' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Fredericka+the+Great' rel='stylesheet' type='text/css'>
            
        <!-- Llamadas script -->   
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

        <!-- Llamadas script - validar formularios -->
        <script src="<?php echo $INC_url; ?>/lib/validator/dist/jquery.validate.js"></script>
        <script type="text/javascript">
        $(function(){
            $('#formulario_registro').validate({
                rules: {
                    'tipo': 'required',
                    'nombre': 'required',
                    'apellidos': 'required',
                    'dnicif': 'required',
                    'direccion': 'required',
                    'localidad': 'required',
                    'provincia': 'required',
                    'cp': 'required',
                    'pais': 'required',
                    'tlf': { required: true, number: true },
                    'email': { required: true, email: true },
                    'password': { required: true, minlength: 6 },
                    'password2': { required: true, minlength: 6, equalTo: "#password" }, 
                    'newsletter': 'required',
                    'condiciones': 'required'
                },
                messages: {
                    'tipo': 'Debe elegir si desea facturar como empresa o como particular.',
                    'nombre': 'Debe introducir su nombre.',
                    'apellidos': 'Debe ingresar sus apellidos.',
                    'dnicif': 'Debe ingresar su DNI, NIF o CIF según corresponda.',
                    'direccion': 'Debe ingresar la dirección de facturación.',
                    'localidad': 'Debe ingresar la localidad de facturación.',
                    'provincia': 'Debe ingresar la provincia de facturación.',
                    'cp': 'Debe ingresar el código postal de facturación.',
                    'pais': 'Debe ingresar el país de facturación.',
                    'tlf': { required: 'Debe ingresar un número de teléfono.', number: 'Debe ingresar el número de teléfono con un formato correcto, solo con números. Por ejemplo: 914338585.' },
                    'email': { required: 'Debe ingresar un correo electrónico.', email: 'Debe ingresar el correo electrónico con el formato correcto. Ejemplo: name@gmail.com.' },
                    'password': { required: 'Debe ingresar una contraseña.', minlength: 'Debe contener 6 caracteres como mínimo.' },
                    'password2': { required: 'Debe ingresar una contraseña.', minlength: 'Debe contener 6 caracteres como mínimo.', equalTo: 'Debe ser igual al anterior campo.' },
                    'newsletter': 'Debe indicar si quieres recibir nuestra newsletter con ofertas y promociones.',
                    'condiciones': 'Debe aceptar las condiciones.'
                }                
            });
        });
        </script>        
       
        <script type="text/javascript">
                function cerrar() {
                    div = document.getElementById('flotante');
                    div.style.display='none';
                }
        </script>
</head>
<body>
<?php include_once("../analyticstracking.php") ?>   
<?php include ("../marco.php"); ?>
<div id="contenedor">
    <div id="central_producto">
    <h1>Registro de usuarios nuevos</h1>
    <br />
    <p style="font-size: 18px; line-height: 22px;">Por favor, tomese un par de minutos y registrese en nuestra tienda online para que podamos atenderle como se merece. Los datos que le pedimos son necesarios para generar sus facturas,
    para realizar seguimiento de los envíos, para realizar devoluciones y para que nuestro equipo pueda comunicarse con usted en cualquier momento para informarle de todo lo que ocurre
    con sus pedidos. Estos datos personales no son cedidos a nadie, solo se utilizan para gestión de pedidos y pueden ser borrados en cualquier momento. Muchas gracias por su atención.</p>
    
    <form id="formulario_registro" name="formformulario_registro" method="post" action="<?php echo $INC_url; ?>/login/fun_registrar_usuario.php">
        
        
        <div class="label_registro">
            <label>* Tipo usuario:</label>
        </div>
        <div class="imput_registro">        
        <select name="tipo" id="tipo">
            <option value=""></option>
            <option value="PARTICULAR">Particular</option>
            <option value="EMPRESA">Empresa</option>
        </select>
        </div>
        <div class="limpiar"></div>
        
        
        <div class="label_registro">
            <label>Nombre Empresa (opcional):</label>
        </div>
        <div class="imput_registro"> 
            <input name="empresa" type="text" id="empresa" />
        </div>
        <div class="limpiar"></div>
        
        
        <div class="label_registro">
            <label>* Nombre:</label>
        </div>
        <div class="imput_registro"> 
            <input name="nombre" type="text" id="nombre" />
        </div>
        <div class="limpiar"></div>


        <div class="label_registro">
            <label>* Apellidos:</label>
        </div>
        <div class="imput_registro"> 
            <input name="apellidos" type="text" id="apellidos" />
        </div>
        <div class="limpiar"></div>
        
        <input name="nacimiento" class="nacimiento" />


        <div class="label_registro">
            <label>* Dni/Cif:</label>
        </div>
        <div class="imput_registro"> 
            <input name="dnicif" type="text" id="dnicif" />
        </div>
        <div class="limpiar"></div>


        <div class="label_registro">
            <label>* Dirección:</label>
        </div>
        <div class="imput_registro"> 
            <input name="direccion" type="text" id="direccion" />
        </div>
        <div class="limpiar"></div>


        <div class="label_registro">
            <label>* Código Postal:</label>
        </div>
        <div class="imput_registro"> 
            <input name="cp" type="text" id="cp" />
        </div>
        <div class="limpiar"></div>


        <div class="label_registro">
            <label>* Localidad:</label>
        </div>
        <div class="imput_registro"> 
            <input name="localidad" type="text" id="localidad" />
        </div>
        <div class="limpiar"></div>
        
        <div class="label_registro">
            <label>* Provincia:</label>
        </div>
        <div class="imput_registro"> 
            <input name="provincia" type="text" id="provincia" />
        </div>
        <div class="limpiar"></div>
        
        <div class="label_registro">
            <label>* País:</label>
        </div>
        <div class="imput_registro"> 
            <select name="pais" id="pais">
                <option value=""></option>
                <option value="ESPAÑA">España</option>
                <option value="PORTUGAL">Portugal</option>
            </select>
        </div>
        <div class="limpiar"></div>
        
        <div class="label_registro">
            <label>* Teléfono:</label>
        </div>
        <div class="imput_registro"> 
            <input name="tlf" type="text" id="tlf" />
        </div>
        <div class="limpiar"></div>
        
        
        <div class="label_registro">
            <label>* Email:</label>
        </div>
        <div class="imput_registro"> 
            <input name="email" type="text" id="email" />
        </div>
        <div class="limpiar"></div>
        
        <div class="label_registro">
            <label>* Contraseña:</label>
        </div>
        <div class="imput_registro"> 
            <input name="password" type="password" id="password" />
        </div>
        <div class="limpiar"></div>
        
        <div class="label_registro">
            <label>* Repetir Contraseña:</label>
        </div>
        <div class="imput_registro"> 
            <input name="password2" type="password" id="password2" />
        </div>
        <div class="limpiar"></div>
        
        <div class="label_registro">
            <label>* Recibir Newsletter:</label>
        </div>
        <div class="imput_registro">        
        <select name="newsletter" id="newsletter">
            <option value=""></option>
            <option value="si">SI</option>
            <option value="no">NO</option>
        </select>
        </div>
        <div class="limpiar"></div>
        
                
        <div class="label_registro">
            <label>* Acepto:</label>
        </div>
        <div class="imput_registro"> 
            <input name="condiciones" type="checkbox" id="condiciones" />
        </div>
        <div class="limpiar"></div>

        <div class="label_registro">        
            <label>Condiciones:</label>
        </div>
        <div class="imput_registro"> 
        <textarea style="width:500px; height: 150px;" readonly>
Al marcar la casilla "ACEPTO LAS CONDICIONES" implica su consentimiento expreso para que se le envíe información acerca de nuestros productos y servicios y para que sus datos personales sean incluidos  en un fichero propiedad de Cafe en Capsula - Hay Canal Web S.L. con la finalidad de mantener comunicaciones comerciales con usted.
Para ejercer sus derechos de acceso, rectificación cancelación y oposición con respecto a los datos personales incluidos en los ficheros, deberá hacerlo por escrito a la siguiente dirección: cafeencapsula@cafeencapsula.com.
Menores de edad: Se requiere que el menor cuente con el previo consentimiento de sus padres o tutores antes de introducir sus datos personales en esta Web. Cafe en Capsula - Hay Canal Web S.L. se exime de cualquier responsabilidad si no se cumple este requisito.
        </textarea>
        </div>
        <div class="limpiar"></div>

        
        <input type="hidden" name="action" value="1" />
        
        
        <div class="label_registro">
            <label>&nbsp;</label>
        </div>
        <div class="imput_registro"> 
            <input type="submit" class="marco_submit" value="Registrarse" />
        </div>
        <div class="limpiar"></div>
        
        

    </form>
    
    </div> 
    <div class="limpiar"></div>    
</div> 
<?php include ("../pie.php"); ?>	
            
</body>
</html>