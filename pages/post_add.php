<?php
session_start();
include_once('../includes/header.php');
include_once('../config/mysql.php');
include_once('../var/functions.php');
include_once('../login.php');

if (!isset($loggedUser) || !isset($recipeTitle)) {
    // Redirection vers /login.php
    header("Location: /classroom_web_sit_php_mysql//login.php");
    exit(); // Assurez-vous d'utiliser exit() après la redirection pour éviter l'exécution ultérieure du script
}

echo '<h1>Veuillez vous connecter et vérifier votre recette.</h1>';





$postData = $_POST;

// fonction "isset" verifie l'exsitance d'un element
if (!isset($postData['title']) || !isset($postData['description'])) {
    echo ('Il faut un titre et un message pour soumettre le formulaire.');
    return;
}

$addTitle = $postData['title'];

$description = $postData['description'];

addRecipes($loggedUser, $addTitle, $description, $db);




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
                <p class="card-text"><b>Titre</b> : <?php echo ($addTitle); ?></p>
                <p class="card-text"><b>Description</b> : <?php echo strip_tags($description); ?></p>
            </div>
        </div>
    </div>
    <?php include_once('../includes/footer.php'); ?>

</body>

</html>