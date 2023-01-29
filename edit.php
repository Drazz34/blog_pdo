<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Article</title>
</head>
<body>
    
</body>
</html>

<?php

include "data.php";

$error = null;
$success = null;


try {
    if (isset($_POST['name'], $_POST['content']))
    {
        $query = $pdo->prepare("UPDATE posts SET name = :name, content = :content WHERE id = :id");
        $query->execute([
            "name" => $_POST["name"],
            "content" => $_POST["content"],
            "id" => $_GET["id"]
        ]);

        $success = "votre article a bien été modifié";
    }
    $query = $pdo->prepare("SELECT * FROM posts WHERE id = :id");
    $query->execute([
        'id' => $_GET['id']
    ]);

    $post = $query->fetch();
} catch (PDOException $e) {
    $error = $e->getMessage();
}

// include ici le header 
?>

<div class="container">

<p>

    <a href="index.php">Revenir au listing</a>

</p>

    <?php if ($success): ?>

        <div class="alert alert-success">

            <?= $success ?>

        </div>

    <?php endif ?>

    <?php if ($error) : ?>
        <div class="alert"><?= $error ?></div>
    <?php else : ?>
    
        <form action="" method="POST">
    
            <div class="form-group">
    
                <input type="text" name="name" class="form-control" value="<?= htmlentities($post->name) ?>">
    
            </div>
    
            <div class="form-group">
    
                <textarea name="content" class="form-control"><?= htmlentities($post->content) ?></textarea>
    
            </div>
    
            <button class="btn btn-primary">Sauvegarder</button>
    
        </form>
    
    <?php endif ?>

</div>