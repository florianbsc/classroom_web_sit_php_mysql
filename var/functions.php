<?php
// functions.php
//verivication de la exsitance de l'utilisateur
include_once('../config/mysql.php');



function checkUser(PDO $db, $userEmail, $userPassword): bool
{
    $sql = "SELECT count(*) FROM users WHERE email = :email AND password = :password";
    $stmt = $db->prepare($sql);

    // Exécution de la requête
    $stmt->execute([
        'email' => $userEmail,
        'password' => $userPassword,
    ]);

    // Récupération des résultats
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Vérification si l'utilisateur a été trouvé et si le mot de passe est correct
    return $user['count(*)'];
}

//recuperation le tableau de recette dans la base de donnée

function addRecipes(array $loggedUser, $recipeTitle, $description, PDO $db): void
{
    $sqlQuery = 'INSERT INTO recipes(title, recipe, author, is_enabled, id_user) VALUES (:title, :recipe, :author, :is_enabled, :id_user)';

    // Préparation
    $addRecipe = $db->prepare($sqlQuery);

    // Exécution ! La recette est maintenant en base de données
    
    try { 
        $addRecipe->execute([
            'title' => $recipeTitle,
            'recipe' => $description,
            'author' => $loggedUser['email'],
            'is_enabled' => 1, // 1 = true, 0 = false
            'id_user' => getEmailIdUser($loggedUser['email'], $db),
        ]);
    } catch (Exception $e) {
        // En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur execution requette dans la base de données : ' . $e->getMessage());
    }     
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
    $getRecipes->execute([ 'id_user' => $loggedUser['email']]);

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


function deleteRecipe ($db, $id_recipe)
{
    $sql = 'DELETE FROM `recipes` WHERE id_recipe = :id_recipe';
    $deleteRecipe = $db->prepare($sql);
    $deleteRecipe->execute([ 
        'id_recipe' => $id_recipe
]);
    echo('la recette a bien été effacé');
    return ;
}

// function editRecipe ( $db, $email, $recipe):int
// {
//     $sql = 'UPDATE recipes SET title = :title, recipe = :recipe WHERE id_recipe = :id_recipe ';
//     $sql = $db->prepare($sql);
//     $sql->execute([ 
//         'title' = $newTitle['title'],
//         'recipe'= $newDescription['description'],
// ]);

//     $recipes = $sql->fetchAll(PDO::FETCH_ASSOC);

//     return $recipes;
// }