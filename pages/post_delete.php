<?php
session_start();

include_once('../includes/header.php');
include('../config/mysql.php');

$postData = $_POST;

// fonction "isset" verifie l'exsitance d'un element
if (!isset($_POST['id'])) {
    echo ('Il faut un identifdiant valide pour supprimer une recette.');
    return;
}
$id = $_POST['id'];

$suppRecipe = $db->prepare("DELETE FROM recipe where recipe_id = :id");
$suppRecipe->execute([
    'id' => $id,
]);

header('Location: classroom_web_sit_php_mysql/index.php');
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
                <p class="card-text"><b>Titre</b> : <?php echo ($supRecipe); ?></p>
                <p class="card-text"><b>Description</b> : <?php echo strip_tags($description); ?></p>
            </div>
        </div>
    </div>
    <?php include_once('../includes/footer.php'); ?>

</body>

</html>