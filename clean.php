<?php

include "data.php";

$pdo->beginTransaction();
$pdo->exec("UPDATE posts SET name = 'demo' WHERE id = 3");
$pdo->exec("UPDATE posts SET content = 'demo' WHERE id = 3");
$post = $pdo->query("SELECT * FROM posts WHERE id = 3")->fetch();
var_dump($post);
$pdo->rollBack();