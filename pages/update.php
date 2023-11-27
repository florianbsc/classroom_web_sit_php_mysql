<?php session_start(); 
include_once('../var/functions.php');
include_once('../config/mysql.php');

$getData = $_GET;


if (!isset($getData['id_recipe']) && is_numeric($getData['id_recipe']))
{
    echo('il faut un identifiant de reccette pour la modifier. ');
    return;
}

$recupRecipe = getRecipeById($db, $getData['id_recipe']);

if (!$recupRecipe) {
    // Gérer le cas où la recette n'est pas trouvée
    echo 'Recette non trouvée';
} else {
    // Afficher le formulaire de modification avec les données existantes
    ?>
    <form method="post" action="./post_update.php">
        <input type="hidden" name="id_recipe" value="<?php echo $getData['id_recipe']; ?>">
        Titre: <input type="text" name="edit_title" id="edit_title"  value="<?php echo $recupRecipe['title']; ?>"><br>
        Recette: <textarea name="edit_recipe"><?php echo $recupRecipe['recipe']; ?></textarea><br>
        <input type="submit" value="Modifier">
    </form>
    <?php
}

?>



<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site de recettes - Edit de recette </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="d-flex flex-column min-vh-100">
    <div class="container">
        <?php include_once('../includes/header.php'); ?>
        <h1>MAJ une recette</h1>
        
        <!-- <h1>MAJ une recette <?php echo($recipe['title']); ?></h1> -->
        
        <form action="./post_update.php" method="POST">
            <div class="mb-3 visually-hidden">
                <label for="id_recipe" class="form-label">id de la recette</label>
                <input type="hidden" class="from-control" id="id_recipe" name="id_recipe" value="<?php ;?>">
            </div>
            <div class="mb-3">
                <label for="title">Titre de la recette</label>
                <input type="text" class="form-control" id="title" name="title">
                <div id="title" class="form-text">Choisisez un titre percutant</div>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Desciption de la rectte</label>
                <textarea class="form-control" placeholder="Seuelement du contenu vous appartenent ou libre de droits" id="description" name="description"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>

    </div>
    <?php include_once('../includes/footer.php');?>
</body>
</html>