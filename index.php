<?php

include "data.php";

include "class/Post.php";

$error = null;

try {

    if (isset($_POST['name'], $_POST['content'])) {
        $query = $pdo->prepare("INSERT INTO posts (name, content, created_at) VALUES (:name, :content, :created)");
        $query->execute([
            "name" => $_POST["name"],
            "content" => $_POST["content"],
            "created" => time()
        ]);

        header('Location: edit.php?id=' . $pdo->lastInsertId());
        exit();
    }

    $query = $pdo->query("SELECT * FROM posts");

    /** @var Post[] */
    $posts = $query->fetchAll(PDO::FETCH_CLASS, "Post");

} catch (PDOException $e) {
    $error = $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Blog</title>
</head>
<body>
    
</body>
</html>

<?php
// include ici le header 
?>

<div class="container">

    <?php if ($error) : ?>
        <div class="alert"><?= $error ?></div>
    <?php else : ?>
    
        <!-- récupère le nom de la table posts -->
    
        <ul>
            <?php foreach ($posts as $post) : ?>
                <h2><a href="edit.php?id=<?= $post->id ?>"><?= htmlentities($post->name) ?></a></h2>
                <p class="small text-muted">Ecrit le 
                    <?= $post->created_at->format('d/m/Y à H:i') ?>
                </p>
                <p>
                    <?= nl2br(htmlentities($post->getExcerpt())) ?>
                </p>
            <?php endforeach ?>
        </ul>
    
        <form action="" method="POST">
    
                <div class="form-group">
    
                    <input type="text" name="name" class="form-control" value="">
    
                </div>
    
                <div class="form-group">
    
                    <textarea name="content" class="form-control"></textarea>
    
                </div>
    
                <button class="btn btn-primary">Sauvegarder</button>
    
            </form>
    
    <?php endif ?>
     
</div>

