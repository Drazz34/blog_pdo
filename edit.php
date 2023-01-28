<?php

include "data.php";

$error = null;
$id = $pdo->quote($_GET['id']);
var_dump($id);

try {
    $query = $pdo->query("SELECT * FROM posts WHERE id = " . $_GET['id']);

    $posts = $query->fetchAll();
} catch (PDOException $e) {
    $error = $e->getMessage();
}

// include ici le header 
?>

<?php if ($error) : ?>
    <div class="alert"><?= $error ?></div>
<?php else : ?>

    <!-- récupère le nom de la table posts -->

    <ul>
        <?php foreach ($posts as $post) : ?>
            <li><?= $post->name ?></li>
        <?php endforeach ?>
    </ul>

<?php endif ?>