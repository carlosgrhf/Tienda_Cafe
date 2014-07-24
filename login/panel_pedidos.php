<?php
// Inicializamos sesion 
session_start();
include('../lib/config.inc.php');
include('../lib/conectar.php');
?>
    <h2>Ver mis pedidos</h2>
<?php

    $sql = "SELECT * FROM Carrito_Pedidos WHERE CP_Uid = '$_SESSION[Uidacceso]' ORDER BY CPid desc";
        if(!$result = $mysqli->query($sql)){
            die("Query invalido: " . $sql);
        }          
        $total_registros = $result->num_rows;
        /* liberamos la memoria asociada al resultado */
        $result->close();
    
                
                 
    
    echo '
        <table class="tabla">
        <caption>Número total de pedidos: '.$total_registros.'</caption>
        <thead>
        <tr>
        <th>Número de pedido</th>
        <th>Fecha</th>
        <th>Estado</th>
        <th>Forma de pago</th>
        <th>Pagado</th>
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
    
    $sql = "SELECT * FROM Carrito_Pedidos WHERE CP_Uid = '$_SESSION[Uidacceso]' ORDER BY CPid desc LIMIT ".$inicio.",".$cantidadRegistrosPorPagina." ";
    if(!$result = $mysqli->query($sql)){
        die("Query invalido: " . $sql);
    }          
    /* fetch array asociativo*/
    while ($fila = $result->fetch_assoc()) {
        $CPid = utf8_encode($fila["CPid"]);
        $CP_CTid = utf8_encode($fila["CP_CTid"]);
        $CP_Uid = utf8_encode($fila["CP_Uid"]);
        $CPdireccionenvio = utf8_encode($fila["CPdireccionenvio"]);
        $CPcpenvio = utf8_encode($fila["CPcpenvio"]);
        $CPlocalidadenvio = utf8_encode($fila["CPlocalidadenvio"]);
        $CPprovinciaenvio = utf8_encode($fila["CPprovinciaenvio"]);
        $CPpaisenvio = utf8_encode($fila["CPpaisenvio"]);
        $CPportes = utf8_encode($fila["CPportes"]);
        $CPpreciototal = utf8_encode($fila["CPpreciototal"]);
        $CPfecha = utf8_encode($fila["CPfecha"]);
        $CPformapago = utf8_encode($fila["CPformapago"]);
        $CPpagado = utf8_encode($fila["CPpagado"]);
        $CPestado = utf8_encode($fila["CPestado"]);
        
        if($CPformapago=="vacio") continue;
        
        echo '
            <tr>
                <td>'.$CPid.'</td>
                <td>'.cambiaf_a_normal($CPfecha).'</td>
                <td>'.$CPestado.'</td>
                <td>'.$CPformapago.'</td>
                <td>'.$CPpagado.'</td>
                <td><a href="'.$INC_url.'/login/4/'.$CPid.'">Ver</a></td>
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
        $enlaces = $paginador->getHtmlPaginacion('sec=2&pagina', 'li');
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
