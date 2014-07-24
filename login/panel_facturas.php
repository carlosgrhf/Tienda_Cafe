<?php
// Inicializamos sesion 
session_start();
include('../lib/config.inc.php');
include('../lib/conectar.php');
?>
    <h2>Ver mis facturas</h2>
<?php

    $sql = "SELECT * FROM Facturas WHERE F_Uid = '$_SESSION[Uidacceso]' ORDER BY Fid desc";
        if(!$result = $mysqli->query($sql)){
            die("Query invalido: " . $sql);
        }          
        $total_registros = $result->num_rows;
        /* liberamos la memoria asociada al resultado */
        $result->close();
    
                
                 
    
    echo '
        <table class="tabla">
        <caption>Número total de facturas: '.$total_registros.'</caption>
        <thead>
        <tr>
        <th>Factura</th>
        <th>Fecha</th>
        <th>Forma de pago</th>
        <th>Precio Total</th>
        <th>Acciones</th>
        </tr>
        </thead>
        <tbody>

    ';
    
    
    

                
    // Parametros a ser usados por el Paginador.
    $cantidadRegistrosPorPagina	= 10;
    $cantidadEnlaces            = 10; // Cantidad de enlaces que tendra el paginador.
    $totalRegistros             = $total_registros;
    $pagina                     = isset($_GET['pagina'])? $_GET['pagina'] : 0;
    
    // Comenzamos incluyendo el Paginador.
    require_once 'fun_paginador.php';
    
    // Instanciamos la clase Paginador
    $paginador = new Paginador();

    // Configuramos cuanto registros por pagina que debe ser igual a el limit de la consulta mysql
    $paginador->setCantidadRegistros($cantidadRegistrosPorPagina);
    // Cantidad de enlaces del paginador sin contar los no numericos.
    $paginador->setCantidadEnlaces($cantidadEnlaces);
    
    // Agregamos estilos al Paginador
    $paginador->setClass('primero',         'previous');
    $paginador->setClass('bloqueAnterior',  'previous');
    $paginador->setClass('anterior',        'previous');
    $paginador->setClass('siguiente',       'next');
    $paginador->setClass('bloqueSiguiente', 'next');
    $paginador->setClass('ultimo',          'next');
    $paginador->setClass('numero',          '<>');
    $paginador->setClass('actual',          'active');
    
    // Y mandamos a paginar desde la pagina actual y le pasamos tambien el total
    // de registros de la consulta mysql.
    $datos = $paginador->paginar($pagina, $totalRegistros);
    
    if($pagina>0){
        $inicio = $pagina * $cantidadRegistrosPorPagina;
    } else {
        $inicio = 0;
    }
    
    $sql = "SELECT * FROM Facturas WHERE F_Uid = '$_SESSION[Uidacceso]' ORDER BY Fid desc LIMIT ".$inicio.",".$cantidadRegistrosPorPagina." ";
    if(!$result = $mysqli->query($sql)){
        die("Query invalido: " . $sql);
    }          
    /* fetch array asociativo*/
    while ($fila = $result->fetch_assoc()) {
        $Fid = utf8_encode($fila["Fid"]);
        $F_CPid = utf8_encode($fila["F_CPid"]);
        $F_Uid = utf8_encode($fila["F_Uid"]);
        $Fnumero = utf8_encode($fila["Fnumero"]);
        $Ffecha = cambiaf_a_normal(utf8_encode($fila["Ffecha"]));
        $F_Unombre = utf8_encode($fila["F_Unombre"]);
        $F_Uapellidos = utf8_encode($fila["F_Uapellidos"]);
        $F_Udnicif = utf8_encode($fila["F_Udnicif"]);
        $F_Udireccion = utf8_encode($fila["F_Udireccion"]);
        $F_Ucp = utf8_encode($fila["F_Ucp"]);
        $F_Ulocalidad = utf8_encode($fila["F_Ulocalidad"]);
        $F_Uprovincia = utf8_encode($fila["F_Uprovincia"]);
        $F_Upais = utf8_encode($fila["F_Upais"]);
        $F_Unombreenvio = utf8_encode($fila["F_Unombreenvio"]);
        $F_Uapellidosenvio = utf8_encode($fila["F_Uapellidosenvio"]);
        $F_Udireccionenvio = utf8_encode($fila["F_Udireccionenvio"]);
        $F_Ucpenvio = utf8_encode($fila["F_Ucpenvio"]);
        $F_Ulocalidadenvio = utf8_encode($fila["F_Ulocalidadenvio"]);
        $F_Uprovinciaenvio = utf8_encode($fila["F_Uprovinciaenvio"]);
        $F_Upaisenvio = utf8_encode($fila["F_Upaisenvio"]);
        $Fportes = utf8_encode($fila["Fportes"]);
        $Fivatotal = utf8_encode($fila["Fivatotal"]);
        $Ftotalsiniva= utf8_encode($fila["Ftotalsiniva"]);
        $Fformapago = utf8_encode($fila["Fformapago"]);
        $Fpreciototal = utf8_encode($fila["Fpreciototal"]);
        
        
        echo '
            <tr>
                <td>'.$Fnumero.'</td>
                <td>'.$Ffecha.'</td>
                <td>'.$Fformapago.'</td>
                <td>'.number_format($Fpreciototal, 2, ",", "").' €</td>
                <td><a href="'.$INC_url.'/factura/'.$Fid.'">Ver</a></td>
            </tr>
        ';
        
    }
    /* liberamos la memoria asociada al resultado */
    $result->close();	
                        
    echo '
        </tbody>
        </table>
        <br />
    ';
    
    // Preguntamos si retorno algo, si retorno paginamos. Nos retorna un arreglo
    // que se puede usar para paginar del modo clasico. Si queremos paginar con
    // el enlace ya confeccionado realizamos lo siguiente.
    if ($datos) {
        $enlaces = $paginador->getHtmlPaginacion('sec=3&pagina', 'li');
    ?>
    <ul id="pagination-digg">
    <?php
        foreach ($enlaces as $enlace) {
            echo $enlace . "\n";
        }
    ?>
    </ul>
    <br /><br />
    <?php
    }
?>
