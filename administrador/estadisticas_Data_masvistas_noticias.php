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

$sql = "SELECT * FROM Noticias ORDER BY Nvisitas desc LIMIT 10";
        if(!$result = $mysqli->query($sql)){
            die("Query invalido: " . $sql);
        }          
        /* fetch array asociativo*/
        while ($fila = $result->fetch_assoc()) {
            $Nid = utf8_encode($fila["Nid"]);
            $Ntitulo = utf8_encode($fila["Ntitulo"]);
            $Nvisitas = utf8_encode($fila["Nvisitas"]);
            
            
            $Ntitulo = str_replace('"', '', $Ntitulo);
            $Ntitulo = str_replace("'", "", $Ntitulo);
          
            echo '{"c":[{"v":"'.$Ntitulo.'","f":null},{"v":'.$Nvisitas.',"f":null}]},';
            
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
