<?php
$orden = $_GET[orden];

if($orden=="") $ordenacion="Aid asc";
if($orden==1) $ordenacion="Aid asc";
if($orden==2) $ordenacion="Aid desc";
if($orden==3) $ordenacion="Anombre asc";
if($orden==4) $ordenacion="Anombre desc";
?>

<h2>Usuarios</h2><br />
<p class="semillas">Inicio > Usuarios</p><br />
<p>
    <a href="<?php echo $INC_url; ?>/administrador/panel_administrador.php?var=22">Nuevo Usuario</a> |
    <strong>Filtrar:</strong> 
    Id <a href="<?php echo $INC_url; ?>/administrador/panel_administrador.php?var=2&orden=1"><</a> - <a href="<?php echo $INC_url; ?>/administrador/panel_administrador.php?var=2&orden=2">></a> |
    Nombre <a href="<?php echo $INC_url; ?>/administrador/panel_administrador.php?var=2&orden=3">A</a> - <a href="<?php echo $INC_url; ?>/administrador/panel_administrador.php?var=2&orden=4">Z</a> |

</p><br />

<?php

    $sql = "SELECT * FROM Administrador";
        if(!$result = $mysqli->query($sql)){
            die("Query invalido: " . $sql);
        }          
        $total_registros = $result->num_rows;
        /* liberamos la memoria asociada al resultado */
        $result->close();
    
                
                 
    
    echo '
        <table class="tabla">
        <caption>Número total de usuarios: '.$total_registros.'</caption>
        <thead>
        <tr>
        <th>Id</th>
        <th>Nombre</th>
        <th>Usuario</th>
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
    
    $sql = "SELECT * FROM Administrador ORDER BY ".$ordenacion." LIMIT ".$inicio.",".$cantidadRegistrosPorPagina." ";
    if(!$result = $mysqli->query($sql)){
        die("Query invalido: " . $sql);
    }          
    /* fetch array asociativo*/
    while ($fila = $result->fetch_assoc()) {
        $Aid_us = utf8_encode($fila["Aid"]);
        $Anombre_us = utf8_encode($fila["Anombre"]);
        $Ausuario_us = utf8_encode($fila["Ausuario"]);        
        
        echo '
            <tr>
                <td>'.$Aid_us.'</td>
                <td>'.$Anombre_us.'</td>
                <td>'.$Ausuario_us.'</td>
                <td>
                    <a href="'.$INC_url.'/administrador/panel_administrador.php?var=21&Aid_us='.$Aid_us.'">Editar</a> |
                    <a href="'.$INC_url.'/administrador/usuarios_borrar.php?Aid_us='.$Aid_us.'">Borrar</a>
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
        $enlaces = $paginador->getHtmlPaginacion('var=2&orden='.$orden.'&pagina', 'li');
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

        
    
