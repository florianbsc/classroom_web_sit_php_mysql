<?php session_start(); ?>
<!-- index.php -->
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site de recettes - Page d'accueil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="d-flex flex-column min-vh-100">
    <div class="container">

        <!-- inclusion des variables et fonctions -->
        <?php
        include_once('config/mysql.php');
        include_once('includes/header.php');
        include_once('var/functions.php');
        ?>

        <h1>Site de recettes</h1>

        <?php include_once('login.php'); 
        echo '<br>';  
        
    
        $allRecipes = getAllRecipes($db);
        echo '<a class="btn btn-success" aria-current="page" href="./pages/addrecipe.php">Add</a> <br> <br>';

        // Affichage des recettes
        foreach ($allRecipes as $recipe) {
            echo 'Titre: ' . $recipe['title'] . '<br>';
            echo 'Recette: ' . $recipe['recipe'] . '<br>';
            // ... autres détails de la recette ...
            echo '<br>';
        
        echo '<a class="btn btn-danger" href="./pages/delete.php">Supp</a> 
        <a class="btn btn-primary" href="./pages/update.php">Edit</a>';

        echo '<br><br>';
        }
        ?>

    </div>

</body>
<!-- inclusion du bas de page du site -->
<?php include_once('includes/footer.php'); ?>

</html>