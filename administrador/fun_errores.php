<?php   
include('../lib/config.inc.php');
$comentario=$_SESSION[comentario];

if($_SESSION[errores]=="ok"){
    echo '
    <div id="flotante" class="errores_ok">
        <p>Acción realizada con éxito.</p><br />
        <p>Mensaje: '.$comentario.'</p>
        <a href="javascript:cerrar();">
            <img style="float:right; margin-right: 10px;" src="'.$INC_url.'/administrador/iconos/blacks/32x32/round_delete.png">
        </a>
    </div>
    ';
}
if($_SESSION[errores]=="error"){
    echo '
    <div id="flotante" class="errores_error">
        <p>Error. La acción no se realizó correctamente. Por favor, vuelve a intentarlo.</p><br />
        <p>Mensaje: '.$comentario.'</p>
        <a href="javascript:cerrar();">
            <img style="float:right; margin-right: 10px;" src="'.$INC_url.'/administrador/iconos/blacks/32x32/round_delete.png">
        </a>
    </div>
    ';
}

$_SESSION[comentario]="";
$_SESSION[errores]="";
?>
