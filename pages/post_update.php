<?php
session_start();

include_once('../includes/header.php');
include_once('../login.php');
include_once('../config/mysql.php');
include_once('../var/functions.php');

if (!isset($loggedUser))
{
    // Redirection vers /login.php
    header("Location: ../login.php");
    exit(); 
}

$postData = $_POST;

//verrification de l'existance des elements qui vont etre modifié
if (!isset($postData['id_recipe']) || !isset($postData['edit_title']) || !isset($postData['edit_recipe']))
{
    echo ('Il manque des informations pour permettre l\'édition du formulaire.');
    return;

} else {
    $Gi_id_recipe = $postData['id_recipe'];
    $Gs_title = $postData['edit_title'];
    $Gs_recipe = $postData['edit_recipe'];
    
    editRecipe($db, $Gi_id_recipe, $Gs_title, $Gs_recipe);
}
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
        <h1>Le message à bien été modifié !</h1>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Rappel de vos informations</h5>
                <p class="card-text"><b>Titre</b> : <?php echo ($Gs_title); ?></p>
                <p class="card-text"><b>Description</b> : <?php echo strip_tags($Gs_recipe); ?></p>
            </div>
        </div>
    </div>
    <?php include_once('../includes/footer.php'); ?>

</body>

</html>