<?php
$orden = $_GET[orden];

if($orden=="") $ordenacion="Fid asc";
if($orden==1) $ordenacion="Fid asc";
if($orden==2) $ordenacion="Fid desc";
?>

<h2>Facturas</h2><br />
<p class="semillas">Inicio > Facturas</p><br />
<p>
    
    <strong>Filtrar:</strong> 
    Id <a href="<?php echo $INC_url; ?>/administrador/panel_administrador.php?var=13&orden=1"><</a> - <a href="<?php echo $INC_url; ?>/administrador/panel_administrador.php?var=13&orden=2">></a> |    
</p><br />
<?php

    $sql = "SELECT * FROM Facturas";
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
        <th>Id</th>
        <th>Nº Factura</th>
        <th>Nº Pedido</th>
        <th>Fecha</th>
        <th>Forma de Pago</th>
        <th>Acciones</th>
        </tr>
        </thead>
        <tbody>

    ';
    
    
    

                
    // Parametros a ser usados por el Paginador.
    $cantidadRegistrosPorPagina	= 30;
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
    
    $sql = "SELECT * FROM Facturas ORDER BY ".$ordenacion." LIMIT ".$inicio.",".$cantidadRegistrosPorPagina." ";
    if(!$result = $mysqli->query($sql)){
        die("Query invalido: " . $sql);
    }          
    /* fetch array asociativo*/
    while ($fila = $result->fetch_assoc()) {
        $Fid = utf8_encode($fila["Fid"]);        
        $F_CPid = utf8_encode($fila["F_CPid"]);  
        $Fnumero = utf8_encode($fila["Fnumero"]);   
        $Ffecha = utf8_encode($fila["Ffecha"]);        
        $Fformapago = utf8_encode($fila["Fformapago"]);
        
        echo '
            <tr>
                <td>'.$Fid.'</td>
                <td>'.$F_CPid.'</td> 
                <td>'.$Fnumero.'</td>
                <td>'.cambiaf_a_normal($Ffecha).'</td>     
                <td>'.$Fformapago.'</td>       
                <td><a href="'.$INC_url.'/administrador/facturas_ver.php?Fid='.$Fid.'">Ver para imprimir</a>
                </td>
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
        $enlaces = $paginador->getHtmlPaginacion('var=13&orden='.$orden.'&pagina', 'li');
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

        
    
