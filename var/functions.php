<?php
// functions.php

function isValidRecipe(array $recipe): bool
{
    if (array_key_exists('is_enabled', $recipe)) {
        $isEnabled = $recipe['is_enabled'];
    } else {
        $isEnabled = false;
    }

    return $isEnabled;
}

function display_recipe(array $recipe): string
{
    $recipe_content = '';

    if ($recipe['is_enabled']) {
        $recipe_content = '<article>';
        $recipe_content .= '<h3>' . $recipe['title'] . '</h3>';
        $recipe_content .= '<div>' . $recipe['recipe'] . '</div>';
        $recipe_content .= '<i>' . $recipe['author'] . '</i>';
        $recipe_content .= '</article>';
    }

    return $recipe_content;
}

function displayAuthor(string $authorEmail, array $users): string
{
    for ($i = 0; $i < count($users); $i++) {
        $author = $users[$i];
        if ($authorEmail === $author['email']) {
            return $author['full_name'] . '(' . $author['age'] . ' ans)';
        }
    }
}

function getRecipes(array $recipes, int $limit): array
{
    $validRecipes = [];
    $counter = 0;

    foreach ($recipes as $recipe) {
        if ($counter == $limit) {
            return $validRecipes;
        }

        if ($recipe['is_enabled']) {
            $validRecipes[] = $recipe;
            $counter++;
        }
    }

    return $validRecipes;
}

function getEmailIdUser($email, $db): int
{
    // Requête SQL pour sélectionner les recettes de l'utilisateur connecté
    $sqlQuery = "SELECT DISTINCT id_user FROM `recipes` WHERE id_user IN (SELECT id_user FROM users WHERE email = :email)";
    
    // Préparation de la requête SQL
    $recipesStatement = $db->prepare($sqlQuery);

    // Exécution de la requête avec le paramètre email de la session
    $recipesStatement->execute(['email' =>  $email]);

    // Récupération des résultats sous forme d'un tableau associatif
    $results = $recipesStatement->fetchAll(PDO::FETCH_ASSOC);

    return $results[0]['id_user'];
}