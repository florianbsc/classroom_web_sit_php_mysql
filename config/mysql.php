<?php
try {
    // On se connecte à MySQL
    $db = new PDO(
        'mysql:host=localhost;dbname=site_cuisine;charset=utf8',
        'root',
        'root',
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],
    );
} catch (Exception $e) {
    // En cas d'erreur, on affiche un message et on arrête tout
    die('Erreur : ' . $e->getMessage());
}

$sqlQuery = 'INSERT INTO recipes(title, recipe, author, is_enabled) VALUES (:title, :recipe, :author, :is_enabled)';

// Préparation
$addRecipe = $db->prepare($sqlQuery);

// Exécution ! La recette est maintenant en base de données
$addRecipe->execute([
    'title' => 'Cassoulet',
    'recipe' => 'Etape 1 : Des flageolets ! Etape 2 : Euh ...',
    'author' => $loggedUser['email'],
    'is_enabled' => 1, // 1 = true, 0 = false
]);

// On affiche chaque recette une à une

?>