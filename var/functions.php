<?php
// functions.php

function isValidRecipe(array $recipe) : bool
{
    if (array_key_exists('is_enabled', $recipe)) {
        $isEnabled = $recipe['is_enabled'];
    } else {
        $isEnabled = false;
    }

    return $isEnabled;
}

function display_recipe(array $recipe) : string
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

function displayAuthor(string $authorEmail, array $users) : string
{
    for ($i = 0; $i < count($users); $i++) {
        $author = $users[$i];
        if ($authorEmail === $author['email']) {
            return $author['full_name'] . '(' . $author['age'] . ' ans)';
        }
    }
}

function getRecipes(array $recipes, int $limit) : array
{
    $validRecipes = [];
    $counter = 0;

    foreach($recipes as $recipe) {
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
//         foreach($recipes as $recipe) {
//         if (isValidRecipe($recipe)) {
//             $validRecipes[] = $recipe;
//         }
        
//     }
//     if(sizeOf($validRecipes)==0)
//     {echo('pas de recette valide');}
//     return $validRecipes;