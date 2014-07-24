<?php
// Inicializamos sesion 
session_start();
include('../lib/config.inc.php');
include('../lib/conectar.php');


/////////////////////////////////////////////////////////////////////////////////////SUBIMOS EL FICHERO 					
$status = "";
if ($_POST["action"] == "upload") {
    // obtenemos los datos del archivo
    $tamano = $_FILES["archivo"]['size'];
    $tipo = $_FILES["archivo"]['type'];
    $archivo = $_FILES["archivo"]['name'];
    $prefijo = substr(md5(uniqid(rand())),0,6);
   
    if ($archivo != "") {
        // guardamos el archivo a la carpeta files
        $destino =  "files/".$prefijo."_".$archivo."";
        if (copy($_FILES['archivo']['tmp_name'],$destino)) {
            $status = "Archivo subido: <b>".$archivo."</b>";
        } else {
            $status = "Error al subir el archivo";
        }
    } else {
        $status = "Error al subir archivo";
    }
    echo $status;
}
chmod("files/".$prefijo."_".$archivo."", 0755);

//////////////////////////////////////////////////////////////////////////////////////LEEMOS EL CONTENIDO Y LO GUARDAMOS EN LA BBDD

$fp = fopen ( "files/".$prefijo."_".$archivo."" , "r" ); 
while (( $data = fgetcsv ( $fp , 0 , ";" )) !== FALSE ) { // Mientras hay líneas que leer...
	$i=0;
	while( isset($data[$i]) ) {
		
                $dato=$data[$i];
		$dato=utf8_decode($dato);
            
		if($i==0){
                    $referencia = $dato;                    
                }
                
                if($i==1){
                    $nombre = $dato;
                }
                
                if($i==2){
                    $descripcion = $dato;
                }
                
                if($i==3){
                    $familia = $dato;
                }
                
                if($i==4){
                    $subfamilia = $dato;
                }
                
                if($i==5){
                    $fabricante = $dato;
                }
                
                if($i==6){
                    $precio = $dato;
                }   
                
                if($i==7){
                    $iva = $dato;
                }
                
                if($i==8){
                    $destacado = $dato;
                }
                
                if($i==9){
                    $oferta = $dato;
                }
                
                if($i==10){
                    $vecescomprado = $dato;
                }
                
                if($i==11){
                    $desactivar = $dato;
                }
                
                if($i==12){
                    $observaciones = $dato;
                }
                
                
		
		
		$i++;
	}
        $query = "INSERT INTO Productos (Preferencia, Pnombre, Pdescripcion, Pfamilia, Psubfamilia, Pfabricante, Pprecio, Piva,
                                         Pdestacado, Poferta, Pvecescomprado, Pdesactivar, Pobservaciones) 
                  VALUES ('$referencia', '$nombre', '$descripcion', '$familia', '$subfamilia', '$fabricante', '$precio', '$iva',
                          '$destacado', '$oferta', '$vecescomprado', '$desactivar', '$observaciones')";
        $mysqli->query($query);
 

	
} 
fclose ( $fp );


?>