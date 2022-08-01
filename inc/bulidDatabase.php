<?php


require_once "config.php";

$file = "number.sqlite";

$database = new db($file);
$db = $database -> sqlite_create();



try {
    $create_table = $db->exec("
    CREATE TABLE numbers (
        id INTEGER PRIMARY KEY,
        number INTEGER NOT NULL
    );");
} catch (Exception $e) {
    echo $e->getMessage();
}


$database -> seedRandInt($db ,  "numbers" , "number");


$db ->close();
