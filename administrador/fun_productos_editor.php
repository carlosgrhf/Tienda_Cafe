<?php
// Inicializamos sesion 
session_start();
include('../lib/config.inc.php');
include('../lib/conectar.php');
include('../fun_fechas.php');

$action = utf8_decode(trim($_POST["action"]));
$Pid = utf8_decode(trim($_POST["Pid"]));
$Preferencia = utf8_decode(trim($_POST["Preferencia"]));
$Pnombre = utf8_decode(trim($_POST["Pnombre"]));
$Pdescripcion = utf8_decode(trim($_POST["Pdescripcion"]));
$Pfamilia = utf8_decode(trim($_POST["Pfamilia"]));
$Psubfamilia = utf8_decode(trim($_POST["Psubfamilia"]));
$Pfabricante = utf8_decode(trim($_POST["Pfabricante"]));
$Pprecio = utf8_decode(trim($_POST["Pprecio"]));
$Piva = utf8_decode(trim($_POST["Piva"]));
$Pdestacado = utf8_decode(trim($_POST["Pdestacado"]));
$Poferta = utf8_decode(trim($_POST["Poferta"]));
$Pvecescomprado = utf8_decode(trim($_POST["Pvecescomprado"]));
$Pdesactivar = utf8_decode(trim($_POST["Pdesactivar"]));
$Pobservaciones = utf8_decode(trim($_POST["Pobservaciones"]));

$Pfecha_tope_arreglada = cambiaf_a_mysql($Pfecha_tope);


if ($action=="1"){
//ACTUALIZAR      
$query = "UPDATE Productos SET 
            Preferencia='".$Preferencia."',
            Pnombre='".$Pnombre."',
            Pdescripcion='".$Pdescripcion."',
            Pfamilia='".$Pfamilia."',
            Psubfamilia='".$Psubfamilia."',
            Pfabricante='".$Pfabricante."',
            Pprecio='".$Pprecio."',
            Piva='".$Piva."',
            Pdestacado='".$Pdestacado."',
            Poferta='".$Poferta."',
            Pvecescomprado='".$Pvecescomprado."',
            Pdesactivar='".$Pdesactivar."',
            Pobservaciones='".$Pobservaciones."'
            WHERE Pid=".$Pid."";
            $mysqli->query($query);
            
            ////////////////////////////////////////LOG///////////////////////////////////////////////
            $fecha=date('l jS \of F Y h:i:s A');
            $iddelusuario=$_SESSION[Aid];
            $nombredelusuario=$_SESSION[Anombre];
            $descripcion='El usuario '.$nombredelusuario.' ha actualizado el producto '.$Pid.'.';
            //INSERTAR      
            $query = "INSERT INTO Log (LOGdescripcion,LOGfecha,LOGidusuario,LOGnombreusuario)
                               VALUES ('$descripcion','$fecha','$iddelusuario','$nombredelusuario')";
                    $mysqli->query($query);
            ////////////////////////////////////////LOG///////////////////////////////////////////////
            
            
            $_SESSION[errores]="ok";
            $_SESSION[comentario]="Has editado el producto."; 
            
            //REDIRIGIR
header('Location: '.$INC_url.'/administrador/panel_administrador.php?var=101&Pid='.$Pid.'');
         

}

if ($action=="2"){
     
    
//INSERTAR      
$query = "INSERT INTO Productos (Preferencia, Pnombre, Pdescripcion, Pfamilia, Psubfamilia, Pfabricante, Pprecio, Piva, Pobservaciones, Pdestacado, Poferta, Pdesactivar) 
            VALUES ('$Preferencia', '$Pnombre', '$Pdescripcion', '$Pfamilia', '$Psubfamilia', '$Pfabricante', '$Pprecio', '$Piva', '$Pobservaciones', '$Pdestacado', '$Poferta', '$Pdesactivar')";
            $mysqli->query($query);
            
            ////////////////////////////////////////LOG///////////////////////////////////////////////
            $fecha=date('l jS \of F Y h:i:s A');
            $iddelusuario=$_SESSION[Aid];
            $nombredelusuario=$_SESSION[Anombre];
            $descripcion='El usuario '.$nombredelusuario.' ha insertado un nuevo producto.';
            //INSERTAR      
            $query = "INSERT INTO Log (LOGdescripcion,LOGfecha,LOGidusuario,LOGnombreusuario)
                               VALUES ('$descripcion','$fecha','$iddelusuario','$nombredelusuario')";
                    $mysqli->query($query);
            ////////////////////////////////////////LOG///////////////////////////////////////////////
            
            
            $_SESSION[errores]="ok";
            $_SESSION[comentario]="Has creado un producto."; 
            
            //REDIRIGIR
header('Location: '.$INC_url.'/administrador/panel_administrador.php?var=10');
         

}

if ($action=="3"){
     
    
    

                //REDIRIGIR
    header('Location: '.$INC_url.'/administrador/panel_administrador.php?var=10&fab='.$Pfabricante.'&fam='.$Pfamilia.'&sub='.$Psubfamilia.'&filtros=1');
         

}

if ($action=="4"){
     
    //FILTRO, SIMPLEMENTE REDIRIGIMOS POR GET LAS VARIABLES ESCOGIDAS      
    $where="".$Preferencia."";

    $titulo="".$Preferencia."";

                //REDIRIGIR
    header('Location: '.$INC_url.'/administrador/panel_administrador.php?var=10&where='.$where.'&titulo='.$titulo.'&buscador=1');
         

}

 
?>
