<?php
$server = "127.0.0.1";
$dbname = "blogSite";
$user = "rakib";
$pass = "rakibul";
$pdo = new PDO("mysql:host=$server;dbname=$dbname", $user, $pass);

try {
    $pdo = new PDO("mysql:host=$server;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
} catch (Throwable $t){
    echo 'Cannot Connect to Database';
    die;
}

// var_dump($pdo->query("select version()"));