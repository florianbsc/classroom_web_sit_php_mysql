<?php
// functions.php
//verivication de la validité de la recette


//recuperation le tableau de recette dans la base de donnée

function addRecipes(array $loggedUser, $recipeTitle, $description, PDO $db): void
{
    $sqlQuery = 'INSERT INTO recipes(title, recipe, author, is_enabled, id_user) VALUES (:title, :recipe, :author, :is_enabled, :id_user)';

    // Préparation
    $addRecipe = $db->prepare($sqlQuery);

    // Exécution ! La recette est maintenant en base de données
    $addRecipe->execute([
        'title' => $recipeTitle,
        'recipe' => $description,
        'author' => $loggedUser['email'],
        'is_enabled' => 1, // 1 = true, 0 = false
        'id_user' => getEmailIdUser($loggedUser['email'], $db),
    ]);
}

function getAllRecipes(PDO $db): array
{
  
    $sqlQuery = 'SELECT * FROM `recipes`';
    $getRecipes = $db->prepare($sqlQuery);
    $getRecipes->execute();

    // Récupère toutes les recettes de la base de données
    $recipes = $getRecipes->fetchAll(PDO::FETCH_ASSOC);

    return $recipes;
    
}



function getRecipes(PDO $db, array $loggedUser, array $recipes): array
{

    $sqlQuery = 'SELECT * FROM `recipes` WHERE id_user = :id_user ;';

    $getRecipes = $db->prepare($sqlQuery);

    $getRecipes->execute([
        'id_user' => $loggedUser['email'],
    ]);

    // Récupère toutes les recettes liées à l'utilisateur
    $recipes = $getRecipes->fetchAll(PDO::FETCH_ASSOC);

    return $recipes;
}

function getEmailIdUser($email, $db): int
{
    // Requête SQL pour sélectionner les recettes de l'utilisateur connecté
    $sqlQuery = "SELECT DISTINCT id_user FROM `recipes` WHERE id_user IN (SELECT id_user FROM users WHERE email = :email)";
    $recipesStatement = $db->prepare($sqlQuery);

    // Exécution de la requête avec le paramètre email de la session
    $recipesStatement->execute(['email' =>  $email]);

    // Récupération des résultats sous forme d'un tableau associatif
    $results = $recipesStatement->fetchAll(PDO::FETCH_ASSOC);

    return $results[0]['id_user'];
}

// function isValidRecipe(array $recipe): bool
// {
//     if (array_key_exists('is_enabled', $recipe)) {
//         $isEnabled = $recipe['is_enabled'];
//     } else {
//         $isEnabled = false;
//     }

//     return $isEnabled;
// }

// //affichage de la recette valide
// function display_recipe(array $recipe): string
// {
//     $recipe_content = '';

//     if ($recipe['is_enabled']) {
//         $recipe_content = '<article>';
//         $recipe_content .= '<h3>' . $recipe['title'] . '</h3>';
//         $recipe_content .= '<div>' . $recipe['recipe'] . '</div>';
//         $recipe_content .= '<i>' . $recipe['author'] . '</i>';
//         $recipe_content .= '</article>';
//     }

//     return $recipe_content;
// }
