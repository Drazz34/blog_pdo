<?php

include "data.php";

$error = null;

try {
    $query = $pdo->query("SELECT * FROM posts");

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
            <li><a href="edit.php?id=<?= $post->id ?>"><?= htmlentities($post->name) ?></a></li>
        <?php endforeach ?>
    </ul>

<?php endif ?>

