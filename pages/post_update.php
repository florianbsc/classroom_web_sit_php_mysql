<?php
session_start();

include_once('../includes/header.php');
include_once('../login.php');
include_once('../config/mysql.php');

$postData = $_POST;

if (!isset($loggedUser) || !isset($postData['edit_title']))
{
    // Redirection vers /login.php
    header("Location: /classroom_web_sit_php_mysql/login.php");
    exit(); 
}

//verrification de l'existance des elements qui vont etre modifié
if (!isset($postData['id_recipe']) || !isset($postData['edit_title']) || !isset($postData['edit_recipe']))
{
    echo ('Il manque des informations pour permettre l\'édition du formulaire.');
    return;

} else {
    $Li_id_recipe = ($postData['id_recipe']);
    $Ls_title = ($postData['edit_title']);
    $Ls_recipe = ($postData['edit_recipe']);
    
    $recupRecipe = $db->prepare("UPDATE recipes SET title = :title, recipe =:recipe WHERE id_recipe = :id_recipe");
    $recupRecipe->execute([
        'title' => $Ls_title,
        'recipe' => $Ls_recipe,
        'id_recipe' => $Li_id_recipe,
    ]);
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
                <p class="card-text"><b>Titre</b> : <?php echo ($Ls_title); ?></p>
                <p class="card-text"><b>Description</b> : <?php echo strip_tags($Ls_recipe); ?></p>
            </div>
        </div>
    </div>
    <?php include_once('../includes/footer.php'); ?>

</body>

</html>