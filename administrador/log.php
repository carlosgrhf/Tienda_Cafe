<h2>Slider</h2><br />
<p class="semillas">Inicio > Slider</p><br />
<?php



    $sql = "SELECT * FROM Log";
        if(!$result = $mysqli->query($sql)){
            die("Query invalido: " . $sql);
        }          
        $total_registros = $result->num_rows;
        /* liberamos la memoria asociada al resultado */
        $result->close();
        
        ////////////HACEMOS LIMPIA DE LOG SI HAY MÁS DE MIL REGISTROS
        if($total_registros>1000){
            
            //contador del array a cero
            $contador=0;
            
            ////SACAMOS LOS ID DE LOS PRIMEROS 100 REGISTROS Y LOS METEMOS EN UN ARRAY
            $sql = "SELECT * FROM Log ORDER BY LOGid asc LIMIT 101";
            if(!$result = $mysqli->query($sql)){
                die("Query invalido: " . $sql);
            }          
            /* fetch array asociativo*/
            while ($fila = $result->fetch_assoc()) {
                $LOGid = utf8_encode($fila["LOGid"]);
                
                //guardamos en un array todos los id que hay que borrar
                $arrayid[$contador] = $LOGid;
                $contador++;
                
            }
            /* liberamos la memoria asociada al resultado */
            $result->close();
            
            for ($i = 0; $i < 100; $i++) {
                $query = "DELETE FROM Log WHERE LOGid='$arrayid[$i]'";
                $mysqli->query($query);
            }
        }
        ////////////FIN DE HACEMOS LIMPIA DE LOG SI HAY MÁS DE MIL REGISTROS
    
     $sql = "SELECT * FROM Log";
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
        <th>Descripción</th>
        <th>Fecha</th>
        <th>Id usuario</th>
        <th>Nombre</th>
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
    
    $sql = "SELECT * FROM Log ORDER BY LOGid desc LIMIT ".$inicio.",".$cantidadRegistrosPorPagina." ";
    if(!$result = $mysqli->query($sql)){
        die("Query invalido: " . $sql);
    }          
    /* fetch array asociativo*/
    while ($fila = $result->fetch_assoc()) {
        $LOGid = utf8_encode($fila["LOGid"]);
        $LOGdescripcion = utf8_encode($fila["LOGdescripcion"]);
        $LOGfecha = utf8_encode($fila["LOGfecha"]);
        $LOGidusuario = utf8_encode($fila["LOGidusuario"]); 
        $LOGnombreusuario = utf8_encode($fila["LOGnombreusuario"]); 
        
        echo '
            <tr>
                <td>'.$LOGid.'</td>
                <td>'.$LOGdescripcion.'</td>
                <td>'.$LOGfecha.'</td>
                <td>'.$LOGidusuario.'</td>
                <td>'.$LOGnombreusuario.'</td>
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
        $enlaces = $paginador->getHtmlPaginacion('var=2000&pagina', 'li');
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

        
    
