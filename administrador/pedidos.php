<?php
$where = $_GET[where];

if($where=="") { $sentencia="CPid>'0'"; $titulo="Todos"; }
if($where==1) { $sentencia="CPestado='pendiente'"; $titulo="Pendientes"; }
if($where==2) { $sentencia="CPestado='enviado'"; $titulo="Enviados"; }
if($where==3) { $sentencia="CPestado='completado'"; $titulo="Completados"; }
if($where==4) { $sentencia="CPestado='facturado'"; $titulo="Facturados"; }
if($where==5) { $sentencia="CPestado='devuelto'"; $titulo="Devueltos"; }
if($where==6) { $sentencia="CPestado='amigo'"; $titulo="Amigos"; }
?>

<h2>Pedidos: <span style="color:green;"><?php echo $titulo; ?></span></h2><br />
<p class="semillas">Inicio > Pedidos</p><br />
<p>    
    <strong>Seleccionar:</strong> 
    <a href="<?php echo $INC_url; ?>/administrador/panel_administrador.php?var=9&where=1">Pendientes</a> |
    <a href="<?php echo $INC_url; ?>/administrador/panel_administrador.php?var=9&where=2">Enviados</a> |
    <a href="<?php echo $INC_url; ?>/administrador/panel_administrador.php?var=9&where=3">Completados</a> |
    <a href="<?php echo $INC_url; ?>/administrador/panel_administrador.php?var=9&where=4">Facturados</a> |
    <a href="<?php echo $INC_url; ?>/administrador/panel_administrador.php?var=9&where=5">Devueltos</a> |
    <a href="<?php echo $INC_url; ?>/administrador/panel_administrador.php?var=9&where=6">Amigos</a>
</p><br />
<?php

    $sql = "SELECT * FROM Carrito_Pedidos WHERE ".$sentencia."";
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
        <th>Id</th>
        <th>Fecha</th>
        <th>Nombre</th>
        <th>Dirección</th>
        <th>Forma Pago</th>
        <th>Pagado</th>
        <th>Estado</th>
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
    
    $sql = "SELECT * FROM Carrito_Pedidos WHERE ".$sentencia." ORDER BY CPid desc LIMIT ".$inicio.",".$cantidadRegistrosPorPagina." ";
    if(!$result = $mysqli->query($sql)){
        die("Query invalido: " . $sql);
    }          
    /* fetch array asociativo*/
    while ($fila = $result->fetch_assoc()) {
        $CPid = utf8_encode($fila["CPid"]);        
        $CP_Uid = utf8_encode($fila["CP_Uid"]);  
        $CPnombreenvio = utf8_encode($fila["CPnombreenvio"]);   
        $CPapellidosenvio = utf8_encode($fila["CPapellidosenvio"]);        
        $CPdireccionenvio = utf8_encode($fila["CPdireccionenvio"]);  
        $CPcpenvio = utf8_encode($fila["CPcpenvio"]);
        $CPlocalidadenvio = utf8_encode($fila["CPlocalidadenvio"]);
        $CPprovinciaenvio = utf8_encode($fila["CPprovinciaenvio"]);
        $CPpaisenvio = utf8_encode($fila["CPpaisenvio"]);
        $CPportes = utf8_encode($fila["CPportes"]);
        $CPivatotal = utf8_encode($fila["CPivatotal"]);
        $CPtotalsiniva = utf8_encode($fila["CPtotalsiniva"]);
        $CPpreciototal = utf8_encode($fila["CPpreciototal"]);
        $CPfecha = utf8_encode($fila["CPfecha"]);
        $CPtrk = utf8_encode($fila["CPtrk"]);
        $CPformapago = utf8_encode($fila["CPformapago"]);
        $CPpagado = utf8_encode($fila["CPpagado"]);
        $CPestado = utf8_encode($fila["CPestado"]);
        $CPobservaciones = utf8_encode($fila["CPobservaciones"]);
        $CPvale = utf8_encode($fila["CPvale"]);
        
        $sql2 = "SELECT * FROM Usuarios WHERE Uid='$CP_Uid'";
            if(!$result2 = $mysqli->query($sql2)){
                die("Query invalido: " . $sql2);
            }          
            /* fetch array asociativo*/
            while ($fila2 = $result2->fetch_assoc()) {
                $Uid = utf8_encode($fila2["Uid"]); 
                $Unombre = utf8_encode($fila2["Unombre"]);   
                $Uapellidos = utf8_encode($fila2["Uapellidos"]); 
                $Utlf = utf8_encode($fila2["Utlf"]);
                $Uemail = utf8_encode($fila2["Uemail"]);
            }
            /* liberamos la memoria asociada al resultado */
            $result2->close();
        
        echo '
            <tr>
                <td>'.$CPid.'</td>                
                <td>'.cambiaf_a_normal($CPfecha).'</td> 
                <td>'.$Uid.' '.$Unombre.' '.$Uapellidos.' '.$Utlf.' '.$Uemail.'</td>   
                <td>'.$CPdireccionenvio.' '.$CPcpenvio.' '.$CPlocalidadenvio.' '.$CPprovinciaenvio.' '.$CPpaisenvio.'</td>    
                <td>'.$CPformapago.'</td>
                <td>'.$CPpagado.'</td>
                <td>'.$CPestado.'</td>
                <td><a href="'.$INC_url.'/administrador/panel_administrador.php?var=91&CPid='.$CPid.'">Editar</a> |
                    <a href="'.$INC_url.'/administrador/pedidos_borrar.php?CPid='.$CPid.'">Borrar</a>
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
        $enlaces = $paginador->getHtmlPaginacion('var=9&where='.$where.'&pagina', 'li');
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

        
    
