<?php
//////////////////////////////////////////////////// 
//Convierte fecha de mysql a normal 
//////////////////////////////////////////////////// 
function cambiaf_a_normal($fecha){ 
   	$dia = substr($fecha, -2);
        $mes   = substr($fecha, -5, 2);
        $ano = substr($fecha,-10, 4);
        // fechal final realizada el cambio de formato a las fechas europeas
        $lafecha = $dia.'/'.$mes.'/'.$ano;
        return $lafecha; 
} 

//////////////////////////////////////////////////// 
//Convierte fecha de normal a mysql 
//////////////////////////////////////////////////// 

function cambiaf_a_mysql($fecha){ 
   	$dia = substr($fecha, 0, -8);
        $mes = substr($fecha, 3, -5);
        $ano = substr($fecha, -4);
        // fechal final realizada el cambio de formato a las fechas europeas
        $lafecha = $ano.'/'.$mes.'/'.$dia;
        return $lafecha;
} 
?>
