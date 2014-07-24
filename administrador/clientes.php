<?php
$orden = $_GET[orden];

if($orden=="") $ordenacion="Uid desc";
if($orden==1) $ordenacion="Uid asc";
if($orden==2) $ordenacion="Uid desc";
?>

<h2>Clientes</h2><br />
<p class="semillas">Inicio > Clientes</p><br />
<p>
    
    <strong>Filtrar:</strong> 
    Id <a href="<?php echo $INC_url; ?>/administrador/panel_administrador.php?var=8&orden=1"><</a> - <a href="<?php echo $INC_url; ?>/administrador/panel_administrador.php?var=8&orden=2">></a>
</p><br />
<?php

    $sql = "SELECT * FROM Usuarios";
        if(!$result = $mysqli->query($sql)){
            die("Query invalido: " . $sql);
        }          
        $total_registros = $result->num_rows;
        /* liberamos la memoria asociada al resultado */
        $result->close();
    
                
                 
    
    echo '
        <table class="tabla">
        <caption>Número total de clientes: '.$total_registros.'</caption>
        <thead>
        <tr>
        <th>Id</th>
        <th>Tipo</th>
        <th>Nombre</th>
        <th>DNI / CIF</th>
        <th>Direccion</th>
        <th>Contacto</th>
        <th>Newsletter, Condiciones y Validado</th>
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
    
    $sql = "SELECT * FROM Usuarios ORDER BY ".$ordenacion." LIMIT ".$inicio.",".$cantidadRegistrosPorPagina." ";
    if(!$result = $mysqli->query($sql)){
        die("Query invalido: " . $sql);
    }          
    /* fetch array asociativo*/
    while ($fila = $result->fetch_assoc()) {
        $Uid = utf8_encode($fila["Uid"]);        
        $Uempresa = utf8_encode($fila["Uempresa"]);  
        $Unombre = utf8_encode($fila["Unombre"]);   
        $Uapellidos = utf8_encode($fila["Uapellidos"]);        
        $Udnicif = utf8_encode($fila["Udnicif"]);  
        $Udireccion = utf8_encode($fila["Udireccion"]);
        $Ucp = utf8_encode($fila["Ucp"]);
        $Ulocalidad = utf8_encode($fila["Ulocalidad"]);
        $Uprovincia = utf8_encode($fila["Uprovincia"]);
        $Upais = utf8_encode($fila["Upais"]);
        $Utlf = utf8_encode($fila["Utlf"]);
        $Uemail = utf8_encode($fila["Uemail"]);
        $Ucondiciones = utf8_encode($fila["Ucondiciones"]);
        $Unews = utf8_encode($fila["Unews"]);
        $Utipo = utf8_encode($fila["Utipo"]);
        $Upassword = utf8_encode($fila["Upassword"]);
        $Uvalidado = utf8_encode($fila["Uvalidado"]);
        $Unumerocompras = utf8_encode($fila["Unumerocompras"]);
        $Ufechaultimacompra = utf8_encode($fila["Ufechaultimacompra"]);
        $Ugastototal = utf8_encode($fila["Ugastototal"]);
        
        
        echo '
            <tr>
                <td>'.$Uid.'</td>                
                <td>'.$Utipo.'</td>
                <td>'.$Unombre.' '.$Uapellidos.'</td>    
                <td>'.$Udnicif.'</td>
                <td>'.$Udireccion.' '.$Ucp.' '.$Ulocalidad.' '.$Uprovincia.' '.$Upais.'</td>
                <td>'.$Uemail.' '.$Utlf.'</td>  
                <td>'.$Unews.' '.$Ucondiciones.' '.$Uvalidado.'</td>
                <td><a href="'.$INC_url.'/administrador/panel_administrador.php?var=81&Uid='.$Uid.'">Editar</a>
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
        $enlaces = $paginador->getHtmlPaginacion('var=8&orden='.$orden.'&pagina', 'li');
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

        
    
