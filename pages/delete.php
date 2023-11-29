<?php session_start(); 

include_once('../var/functions.php');
include_once('../config/mysql.php');

// à remplacer par une fonction
$postData = $_POST;


if (!isset($postData['id_recipe']) && is_numeric($postData['id_recipe']))
{
    echo('il faut un identifiant de reccette pour la modifier. ');
    return;
}

$recupRecipe = getRecipeById($db, $postData['id_recipe']);

if (!$recupRecipe) {
    // Gérer le cas où la recette n'est pas trouvée
    echo 'Recette non trouvée';
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site de recettes - Supprime recette </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="d-flex flex-column min-vh-100">
    <div class="container">
        <?php include_once('../includes/header.php'); ?>
        <h1>Supprime une recette</h1>

        <form action="./post_delete.php" method="POST">
            <div class="card-body">
                <div class="mb-3 visually-hidden">
                    <label for="id_recipe" class="from-label">id de la recette</label>
                    <input type="id" class="form-control" id="id_recipe" name="id_recipe" value="<?php echo $_POST['id_recipe']; ?>">
                </div>
                <div class="mb-3">
                    <p class="card-text"><b>Titre</b> : <?php echo $recupRecipe['title']; ?></p>
                </div>
                <div class="mb-3">
                    <p class="card-text"><b>Recette</b> : <?php echo $recupRecipe['recipe']; ?></p>
                </div>
            </div>
            
            <button type="submit" class="btn btn-danger">Supp définitive</button>
        </form>

    </div>
    <?php include_once('../includes/footer.php'); ?>
</body>

</html>