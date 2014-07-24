<?php

$db_host=$INC_db_host;
$db_database=$INC_db_database;
$db_username=$INC_db_username;
$db_password=$INC_db_password;

$mysqli = new mysqli($db_host, $db_username, $db_password, $db_database);
if ($mysqli->connect_errno) {
    echo "Fallo al contenctar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
?>
