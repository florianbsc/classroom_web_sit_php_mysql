<?php
session_start();

include_once('../includes/header.php');

if (!isset($loggedUser) || !isset($recipeTitle)) {
    // Redirection vers /login.php
    header("Location: /classroom_web_sit_php_mysql/login.php");
    exit(); // Assurez-vous d'utiliser exit() après la redirection pour éviter l'exécution ultérieure du script
}

$postData = $_POST;

//verrification de l'existance des elements qui vont etre modifié
if (!isset($postData['id_recipe']) || !isset($postData['title']) || !isset('recipe'))
{
    echo ('Ilmanque des informations pour permettre l\'édition du formulaire.');
    return;
}

$id_recipe = ($postData['id_recipe']);
$title = ($postData['title']);
$recipe = ($postData['recipe']);

$recupRecipe = $mysqlClien->prepare("UPDATE recipes SET title = :titel, recipe =:recipe WHERE id_recipe = :id_recipe");
$recupRecipe->execute([
    'title' => $title,
    'recipe' => $recipe,
    'id_recipe' => $id_recipe,
]);





?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Site de Recettes - Création de recette</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="d-flex flex-column min-vh-100">
    <div class="container">

        <?php include_once('../includes/header.php'); ?>
        <h1>Message bien reçu !</h1>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Rappel de vos informations</h5>
                <p class="card-text"><b>Titre</b> : <?php echo ($editRecipe); ?></p>
                <p class="card-text"><b>Description</b> : <?php echo strip_tags($description); ?></p>
            </div>
        </div>
    </div>
    <?php include_once('../includes/footer.php'); ?>

</body>

</html>