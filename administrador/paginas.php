<?php
$orden = $_GET[orden];

if($orden=="") $ordenacion="PAid asc";
if($orden==1) $ordenacion="PAid asc";
if($orden==2) $ordenacion="PAid desc";
if($orden==3) $ordenacion="PAtitulo asc";
if($orden==4) $ordenacion="PAtitulo desc";
?>

<h2>Páginas</h2><br />
<p class="semillas">Inicio > Páginas</p><br />
<p>
    
    <strong>Filtrar:</strong> 
    Id <a href="<?php echo $INC_url; ?>/administrador/panel_administrador.php?var=3&orden=1"><</a> - <a href="<?php echo $INC_url; ?>/administrador/panel_administrador.php?var=3&orden=2">></a> |
    Nombre <a href="<?php echo $INC_url; ?>/administrador/panel_administrador.php?var=3&orden=3">A</a> - <a href="<?php echo $INC_url; ?>/administrador/panel_administrador.php?var=3&orden=4">Z</a>
</p><br />
<?php

    $sql = "SELECT * FROM Paginas";
        if(!$result = $mysqli->query($sql)){
            die("Query invalido: " . $sql);
        }          
        $total_registros = $result->num_rows;
        /* liberamos la memoria asociada al resultado */
        $result->close();
    
                
                 
    
    echo '
        <table class="tabla">
        <caption>Número total de páginas: '.$total_registros.'</caption>
        <thead>
        <tr>
        <th>Id</th>
        <th>Titulo</th>
        <th>Visitas</th>
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
    
    $sql = "SELECT * FROM Paginas ORDER BY ".$ordenacion." LIMIT ".$inicio.",".$cantidadRegistrosPorPagina." ";
    if(!$result = $mysqli->query($sql)){
        die("Query invalido: " . $sql);
    }          
    /* fetch array asociativo*/
    while ($fila = $result->fetch_assoc()) {
        $PAid = utf8_encode($fila["PAid"]);        
        $PAtitulo = utf8_encode($fila["PAtitulo"]);  
        $PAintro = utf8_encode($fila["PAintro"]);   
        $PAcontenido = utf8_encode($fila["PAcontenido"]);        
        $PApinchazos = utf8_encode($fila["PApinchazos"]); 
        
        echo '
            <tr>
                <td>'.$PAid.'</td>                
                <td>'.$PAtitulo.'</td>
                <td>'.$PApinchazos.'</td>     
                <td><a href="'.$INC_url.'/administrador/panel_administrador.php?var=31&PAid='.$PAid.'">Editar</a>
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
        $enlaces = $paginador->getHtmlPaginacion('var=3&orden='.$orden.'&pagina', 'li');
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

        
    
