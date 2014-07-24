<?php
$orden = $_GET[orden];

if($orden=="") $ordenacion="NEWid asc";
if($orden==1) $ordenacion="NEWid asc";
if($orden==2) $ordenacion="NEWid desc";
if($orden==3) $ordenacion="NEWestado asc";
if($orden==4) $ordenacion="NEWestado desc";
?>

<h2>Contactos Newsletter</h2><br />
<p class="semillas">Inicio > Contactos Newsletter</p><br />
<p>
    <a href="<?php echo $INC_url; ?>/administrador/panel_administrador.php?var=202">Nuevo Contacto</a> |
    <strong>Filtrar:</strong> 
    Id <a href="<?php echo $INC_url; ?>/administrador/panel_administrador.php?var=20&orden=1"><</a> - <a href="<?php echo $INC_url; ?>/administrador/panel_administrador.php?var=20&orden=2">></a> |
    Estado <a href="<?php echo $INC_url; ?>/administrador/panel_administrador.php?var=20&orden=3">Activo</a> - <a href="<?php echo $INC_url; ?>/administrador/panel_administrador.php?var=20&orden=4">Bloqueado</a> |

</p><br />

<?php

    $sql = "SELECT * FROM Newsletter";
        if(!$result = $mysqli->query($sql)){
            die("Query invalido: " . $sql);
        }          
        $total_registros = $result->num_rows;
        /* liberamos la memoria asociada al resultado */
        $result->close();
    
                
                 
    
    echo '
        <table class="tabla">
        <caption>Número total de contactos: '.$total_registros.'</caption>
        <thead>
        <tr>
        <th>Id</th>
        <th>Email</th>
        <th>Estado</th>
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
    
    $sql = "SELECT * FROM Newsletter ORDER BY ".$ordenacion." LIMIT ".$inicio.",".$cantidadRegistrosPorPagina." ";
    if(!$result = $mysqli->query($sql)){
        die("Query invalido: " . $sql);
    }          
    /* fetch array asociativo*/
    while ($fila = $result->fetch_assoc()) {
        $NEWid = utf8_encode($fila["NEWid"]);
        $NEWemail = utf8_encode($fila["NEWemail"]);
        $NEWestado = utf8_encode($fila["NEWestado"]);        
        
        echo '
            <tr>
                <td>'.$NEWid.'</td>
                <td>'.$NEWemail.'</td>
                <td>'.$NEWestado.'</td>
                <td>
                    <a href="'.$INC_url.'/administrador/panel_administrador.php?var=201&NEWid='.$NEWid.'">Editar</a> |
                    <a href="'.$INC_url.'/administrador/newsletter_borrar.php?NEWid='.$NEWid.'">Borrar</a>
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
        $enlaces = $paginador->getHtmlPaginacion('var=20&orden='.$orden.'&pagina', 'li');
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

        
    
