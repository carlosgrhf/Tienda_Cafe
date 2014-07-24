<?php
$where = $_GET[where];
$buscador = $_GET[buscador];
$filtros = $_GET[filtros];
$fab = $_GET[fab];
$fam = $_GET[fam];
$sub = $_GET[sub];
$titulo = $_GET[titulo];
$pagina = $_GET[pagina];

if($where!="" AND $buscador==1){ $where="Preferencia='".$where."'"; }

if(($where=="" OR $pagina>=0) AND $buscador!=1) { $where="Pid>'0'"; $titulo="Todos"; }

if($filtros==1) { 
    $where="Pfabricante='$fab' AND Pfamilia='$fam' AND Psubfamilia='$sub'"; 
    $titulo=''.$fab.' - '.$fam.' - '.$sub.'';
}


?>

<div style="float:right; margin-top: 25px;">
    <p><strong>Buscar:</strong></p><br />
    <form id="formulario_login" method="post" action="<?php echo $INC_url; ?>/administrador/fun_productos_editor.php">
        
            <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>* Referencia:</label>
            </div>
                <input class="imput_editar" name="Preferencia" type="text" />
            <div class="limpiar"></div>
            <!-- -------------------------------------------------------------------------------------------- -->
        
            <input type="hidden" name="action" value="4" />

            <div class="colocar_boton">         
            <input class="boton" type="submit" value="Buscar Ref" />
            </div>           
            <div class="limpiar"></div>            

    </form>
</div>

<h2>Productos: <span style="color:green;"><?php echo $titulo; ?></span></h2><br />
<p class="semillas">Inicio > Productos</p><br />
<p>
    <a href="<?php echo $INC_url; ?>/administrador/panel_administrador.php?var=102">Nuevo Producto</a> |
    <a href="<?php echo $INC_url; ?>/administrador/panel_administrador.php?var=103">Importar/Exportar</a>
</p><br />
<p><strong>Filtrar:</strong></p><br />

<form id="formulario_login" method="post" action="<?php echo $INC_url; ?>/administrador/fun_productos_editor.php">
    <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>Fabricante:</label>
            </div>
                <select name="Pfabricante" class="imput_editar">
                    <?php
                    $sql = "SELECT DISTINCT Pfabricante FROM Productos";
                    if(!$result = $mysqli->query($sql)){
                        die("Query invalido: " . $sql);
                    }          
                    /* fetch array asociativo*/
                    while ($fila = $result->fetch_assoc()) {
                        $Pfabricante = utf8_encode($fila["Pfabricante"]);
                        
                        echo '<option value="'.$Pfabricante.'">'.$Pfabricante.'</option>';

                    }
                    /* liberamos la memoria asociada al resultado */
                    $result->close();
                    ?>  
                </select>
            <div class="limpiar"></div>
    <!-- -------------------------------------------------------------------------------------------- -->
    <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>Familia:</label>
            </div>
                <select name="Pfamilia" class="imput_editar">
                    <?php
                    $sql = "SELECT DISTINCT Pfamilia FROM Productos";
                    if(!$result = $mysqli->query($sql)){
                        die("Query invalido: " . $sql);
                    }          
                    /* fetch array asociativo*/
                    while ($fila = $result->fetch_assoc()) {
                        $Pfamilia = utf8_encode($fila["Pfamilia"]);
                        
                        echo '<option value="'.$Pfamilia.'">'.$Pfamilia.'</option>';

                    }
                    /* liberamos la memoria asociada al resultado */
                    $result->close();
                    ?>  
                </select>
            <div class="limpiar"></div>
    <!-- -------------------------------------------------------------------------------------------- -->
    <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>Subfamilia:</label>
            </div>
                <select name="Psubfamilia" class="imput_editar">
                    <?php
                    $sql = "SELECT DISTINCT Psubfamilia FROM Productos";
                    if(!$result = $mysqli->query($sql)){
                        die("Query invalido: " . $sql);
                    }          
                    /* fetch array asociativo*/
                    while ($fila = $result->fetch_assoc()) {
                        $Psubfamilia = utf8_encode($fila["Psubfamilia"]);
                        
                        echo '<option value="'.$Psubfamilia.'">'.$Psubfamilia.'</option>';

                    }
                    /* liberamos la memoria asociada al resultado */
                    $result->close();
                    ?>  
                </select>
            <div class="limpiar"></div>
    <!-- -------------------------------------------------------------------------------------------- -->
    
            
            <input type="hidden" name="action" value="3" />

            <div class="colocar_boton">         
            <input class="boton" type="submit" value="Filtrar" />
            </div>           
            <div class="limpiar"></div>            

</form>
<br /><br />    
<?php

    $sql = "SELECT * FROM Productos WHERE ".$where." ORDER BY Pid desc";
        if(!$result = $mysqli->query($sql)){
            die("Query invalido: " . $sql);
        }          
        $total_registros = $result->num_rows;
        /* liberamos la memoria asociada al resultado */
        $result->close();
    
                
                 
    
    echo '
        <table class="tabla">
        <caption>Número total de productos: '.$total_registros.'</caption>
        <thead>
        <tr>
        <th>Id</th>        
        <th>Referencia</th>
        <th>Nombre</th>
        <th>Fabricante</th>
        <th>Familia</th>
        <th>Subfamilia</th>
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
                                            
    $sql = "SELECT * FROM Productos WHERE ".$where." ORDER BY Pid desc LIMIT ".$inicio.",".$cantidadRegistrosPorPagina." ";
    if(!$result = $mysqli->query($sql)){
        die("Query invalido: " . $sql);
    }          
    /* fetch array asociativo*/
    while ($fila = $result->fetch_assoc()) {
        $Pid = utf8_encode($fila["Pid"]);
        $Preferencia = utf8_encode($fila["Preferencia"]);
        $Pnombre = utf8_encode($fila["Pnombre"]);
        $Pdescripcion = utf8_encode($fila["Pdescripcion"]);
        $Pfamilia = utf8_encode($fila["Pfamilia"]);
        $Psubfamilia = utf8_encode($fila["Psubfamilia"]);
        $Pfabricante = utf8_encode($fila["Pfabricante"]); 
        $Pprecio = utf8_encode($fila["Pprecio"]);
        $Piva = utf8_encode($fila["Piva"]);
        $Pdestacado = utf8_encode($fila["Pdestacado"]);
        $Poferta = utf8_encode($fila["Poferta"]);
        $Pvecescomprado = utf8_encode($fila["Pvecescomprado"]);
        $Pdesactivar = utf8_encode($fila["Pdesactivar"]);
        $Pobservaciones = utf8_encode($fila["Pobservaciones"]);
        $Pfecha_tope = utf8_encode($fila["Pfecha_tope"]);
        $Pcontador_pedidos = utf8_encode($fila["Pcontador_pedidos"]);
        $Pcontador_tope = utf8_encode($fila["Pcontador_tope"]);
        
        echo '
            <tr>
                <td>'.$Pid.'</td>
                <td>'.$Preferencia.'</td>
                <td>'.$Pnombre.'</td>
                <td>'.$Pfabricante.'</td>
                <td>'.$Pfamilia.'</td>
                <td>'.$Psubfamilia.'</td>
                <td><a href="'.$INC_url.'/administrador/panel_administrador.php?var=101&Pid='.$Pid.'">Editar</a>
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
        $enlaces = $paginador->getHtmlPaginacion('var=10&where='.$where.'&titulo='.$titulo.'&pagina', 'li');
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

        
    
