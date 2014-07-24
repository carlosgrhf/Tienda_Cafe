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

$sql = "SELECT * FROM Paginas ORDER BY PApinchazos desc LIMIT 10";
        if(!$result = $mysqli->query($sql)){
            die("Query invalido: " . $sql);
        }          
        /* fetch array asociativo*/
        while ($fila = $result->fetch_assoc()) {
            $PAid = utf8_encode($fila["PAid"]);
            $PAtitulo = utf8_encode($fila["PAtitulo"]);
            $PApinchazos = utf8_encode($fila["PApinchazos"]);
            
            
            $PAtitulo = str_replace('"', '', $PAtitulo);
            $PAtitulo = str_replace("'", "", $PAtitulo);
          
            echo '{"c":[{"v":"'.$PAtitulo.'","f":null},{"v":'.$PApinchazos.',"f":null}]},';
            
        }
        /* liberamos la memoria asociada al resultado */
        $result->close();

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
