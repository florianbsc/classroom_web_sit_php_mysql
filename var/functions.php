<?php
// functions.php
//verivication de la exsitance de l'utilisateur

function checkUser(PDO $db, string $userEmail, string $userPassword): bool
{
    $sql = "SELECT count(*) FROM users WHERE email = :email AND password = :password";
    $stmt = $db->prepare($sql);

    try {
        // Exécution de la requête
        $stmt->execute([
            'email' => $userEmail,
            'password' => $userPassword,
        ]);

        // Récupération des résultats
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Vérification si l'utilisateur a été trouvé et si le mot de passe est correct
        return $user['count(*)'];
    } catch (Exception $e) {
        // En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur execution requette dans la base de données : ' . $e->getMessage());
    }
}

function addRecipes(PDO $db, array $loggedUser, string $recipeTitle, string $description): void
{
    $sqlQuery = 'INSERT INTO recipes(title, recipe, author, is_enabled, id_user) VALUES (:title, :recipe, :author, :is_enabled, :id_user)';

    // Préparation
    $addRecipe = $db->prepare($sqlQuery);

    try {
        $addRecipe->execute([
            'title' => $recipeTitle,
            'recipe' => $description,
            'author' => $loggedUser['email'],
            'is_enabled' => 1, // 1 = true, 0 = false
            'id_user' => getEmailIdUser( $db, $loggedUser['email']),
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
    try {
        $getRecipes->execute();

        // Récupère toutes les recettes de la base de données
        $recipes = $getRecipes->fetchAll(PDO::FETCH_ASSOC);

        return $recipes;
    } catch (Exception $e) {
        // En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur execution requette dans la base de données : ' . $e->getMessage());
    }
}

function getRecipes(PDO $db, array $loggedUser, array $recipes): array
{
    $sqlQuery = 'SELECT * FROM `recipes` WHERE id_user = :id_user ;';
    $getRecipes = $db->prepare($sqlQuery);

    try {
        $getRecipes->execute(['id_user' => $loggedUser['email']]);

        // Récupère toutes les recettes liées à l'utilisateur
        $recipes = $getRecipes->fetchAll(PDO::FETCH_ASSOC);

        return $recipes;
    } catch (Exception $e) {
        // En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur execution requette dans la base de données : ' . $e->getMessage());
    }
}

function getEmailIdUser( PDO $db, string $email): int
{
    // Requête SQL pour sélectionner les recettes de l'utilisateur connecté
    $sqlQuery = "SELECT DISTINCT id_user FROM `recipes` WHERE id_user IN (SELECT id_user FROM users WHERE email = :email)";
    $recipesStatement = $db->prepare($sqlQuery);

    // Exécution de la requête avec le paramètre email de la session
    try {
        $recipesStatement->execute(['email' =>  $email]);

        // Récupération des résultats sous forme d'un tableau associatif
        $results = $recipesStatement->fetchAll(PDO::FETCH_ASSOC);

        return $results[0]['id_user'];
    } catch (Exception $e) {
        // En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur execution requette dans la base de données : ' . $e->getMessage());
    }
}

function deleteRecipeById(PDO $db, int $id_recipe)
{
    $sql = 'DELETE FROM `recipes` WHERE id_recipe = :id_recipe';
    $deleteRecipe = $db->prepare($sql);
    try {
        $deleteRecipe->execute([
            'id_recipe' => $id_recipe
        ]);
        echo ('la recette a bien été effacé');
        return;
    } catch (Exception $e) {
        // En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur execution requette dans la base de données : ' . $e->getMessage());
    }
}

function getRecipeById(PDO $db, $id_recipe)
{
    $sql = 'SELECT title, recipe FROM recipes WHERE id_recipe = :id_recipe';

    // Préparation de la requête
    $getRecipeById = $db->prepare($sql);

    try {
        // Exécution de la requête
        $getRecipeById->execute([
            'id_recipe' => $id_recipe,
        ]);

        // Récupération des résultats
        $result = $getRecipeById->fetch(PDO::FETCH_ASSOC);

        // Retourne les résultats ou un tableau vide si la recette n'est pas trouvée
        return $result ? $result : [];
    } catch (Exception $e) {
        // En cas d'erreur, retourner un tableau vide plutôt que de jeter une exception
        return [];
    }
}


function editRecipe(PDO $db, int $Li_id_recipe, string $Ls_title, string $Ls_recipe): void
{
    $sqlQuery = 'UPDATE recipes SET title = :title, recipe = :recipe WHERE id_recipe = :id_recipe';

    // Préparation de la requête
    $editRecipe = $db->prepare($sqlQuery);

    try {
        // Exécution de la requête
        $editRecipe->execute([
            'id_recipe' => $Li_id_recipe,
            'title' => $Ls_title,
            'recipe' =>  $Ls_recipe,
        ]);
    } catch (Exception $e) {
        // En cas d'erreur, lever une exception avec un message d'erreur
        throw new RuntimeException('Erreur lors de la modification de la recette : ' . $e->getMessage());
    }
}

function getRecipeById_user (PDO $db,  int $Li_id_user )
{
    $sqlQuery = 'SELECT `title`,`recipe`,`id_user`,`id_recipe` FROM `recipes` WHERE `id_user` = :id_user';
    $getRecipeById_user = $db->prepare($sqlQuery);

    try {
        // Exécution de la requête
        $getRecipeById_user->execute(['id_user' => $Li_id_user]);

        // Récupère toutes les recettes de la base de données
       return $getRecipeById_user->fetchAll(PDO::FETCH_ASSOC);
        
    } catch (Exception $e) {
        // En cas d'erreur, lever une exception avec un message d'erreur
        throw new RuntimeException('Erreur lors de la recuperation des données des recettes ou des utilisateurs : ' . $e->getMessage());
    }
}

