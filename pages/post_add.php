<?php
session_start();

$postData = $_POST;
include_once('../includes/header.php');

// fonction "isset" verifie l'exsitance d'un element
if (!isset($postData['addRecipe']) || !isset($postData['description'])) {
    echo ('Il faut un titre et un message pour soumettre le formulaire.');
    return;
}

$addRecipe = $postData['addRecipe'];
$description = $postData['description'];

include_once('../config/mysql.php');
include_once('../var/functions.php');
include_once('../login.php');

$recipes = addRecipes($loggedUser, $addRecipe, $description, $db);

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
                <p class="card-text"><b>Titre</b> : <?php echo ($addRecipe); ?></p>
                <p class="card-text"><b>Description</b> : <?php echo strip_tags($description); ?></p>
            </div>
        </div>
    </div>
    <?php include_once('../includes/footer.php'); ?>

</body>

</html>