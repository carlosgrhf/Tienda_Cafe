<?php 
// Inicializamos sesion 
session_start();
include('../lib/config.inc.php');
include('../lib/conectar.php');

echo '
    {
        "cols": [
                {"id":"","label":"Topping","pattern":"","type":"string"},
                {"id":"","label":"Slices","pattern":"","type":"number"}
            ],
        "rows": [
';

$sql = "SELECT * FROM Paginas";
        if(!$result = $mysqli->query($sql)){
            die("Query invalido: " . $sql);
        }          
        $total_registros = $result->num_rows;
        /* liberamos la memoria asociada al resultado */
        $result->close();
        
        echo '{"c":[{"v":"Paginas","f":null},{"v":'.$total_registros.',"f":null}]},';
        
$sql = "SELECT * FROM Noticias";
        if(!$result = $mysqli->query($sql)){
            die("Query invalido: " . $sql);
        }          
        $total_registros = $result->num_rows;
        /* liberamos la memoria asociada al resultado */
        $result->close();
        
        echo '{"c":[{"v":"Noticias","f":null},{"v":'.$total_registros.',"f":null}]},';
        
$sql = "SELECT * FROM Productos";
        if(!$result = $mysqli->query($sql)){
            die("Query invalido: " . $sql);
        }          
        $total_registros = $result->num_rows;
        /* liberamos la memoria asociada al resultado */
        $result->close();
        
        echo '{"c":[{"v":"Productos","f":null},{"v":'.$total_registros.',"f":null}]},';

echo '
    ]
}
';

/*
$string = file_get_contents("sampleData.json");
echo $string;
*/
// Instead you can query your database and parse into JSON etc etc


?>
