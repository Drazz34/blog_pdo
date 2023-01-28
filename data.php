<?php

$dsn = "mysql:host=localhost; dbname=blog_pdo";
$username = "root";
$password = "Mysql5*";

$pdo = new PDO($dsn, $username, $password, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
]);
