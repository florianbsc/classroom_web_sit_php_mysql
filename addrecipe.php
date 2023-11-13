<?php session_start(); ?>
<!-- index.php -->
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site de recettes - Ajout de recette </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="d-flex flex-column min-vh-100">
    <div class="container">
        <?php include_once('includes/header.php'); ?>
        <h1>Ajouter une recette</h1>

        <form action="pages/post_create.php" method="POST">
            <div class="mb-3">
                <label for="addRecipe">Titre de la recette</label>
                <input type="text" class="form-control" id="addRecipe" name="addRecipe">
                <div id="addRecipe" class="form-text">Choisisez un titre percutant</div>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Desciption de la rectte</label>
                <textarea class="form-control" placeholder="Seuelement du contenu vous appartenent ou libre de droits" id="description" name="description"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>

    </div>
    <?php include_once('includes/footer.php'); ?>
</body>

</html>