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
    
        <?php
        include_once('./login.php');
            echo '<br>';


            if (!isset($loggedUser)) 
            {
                $allRecipes = getAllRecipes($db);
                
                // Affichage des recettes
                foreach ($allRecipes as $recipe) 
                {
                    echo 'Titre: ' . $recipe['title'] . '<br>';
                    echo 'Recette: ' . $recipe['recipe'] . '<br><br>';
                }
            }
             else { 

            echo '<a class="btn btn-success" aria-current="page" href="./pages/addrecipe.php">Add</a> <br> <br>';
            
            $recipesById_user = getRecipeById_user ($db, getEmailIdUser($db, $loggedUser['email']));


                // echo '<pre>';
                // print_r($recipesById_user);
                // // ou
                // // var_dump($recipesById_user);
                // echo '</pre>';

            // $La_recipe "L" pour variable local "a" de type array (tableau) de nom recipe
            foreach ($recipesById_user as $La_recipe) {
                echo 'Titre: ' . $La_recipe['title'] . '<br>';
                echo 'Recette: ' . $La_recipe['recipe'] . '<br><br>';
            
              
                    // Formulaire pour le bouton "Supp"
                    echo '<form action="./pages/delete.php" method="post">';
                    echo '<input type="hidden" name="id_recipe" value="' . $La_recipe['id_recipe'] . '">';
                    echo '<button type="submit" class="btn btn-danger">Supp</button>';
                    echo '</form>';
            
                    // Formulaire pour le bouton "Edit"
                    echo '<form action="./pages/update.php" method="post">';
                    echo '<input type="hidden" name="id_recipe" value="' . $La_recipe['id_recipe'] . '">';
                    echo '<button type="submit" class="btn btn-primary">Edit</button>';
                    echo '</form>';
                
            
                echo '<br><br>';
            }
            
                      
        }
        ?>

    </div>

</body>
<!-- inclusion du bas de page du site -->
<?php include_once('includes/footer.php'); ?>

</html>