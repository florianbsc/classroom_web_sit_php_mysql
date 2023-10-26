<?php
try {
    // On se connecte à MySQL
    $mysqlClient = new PDO(
        'mysql:host=localhost;dbname=site_cuisine;charset=utf8',
        'root',
        'root',
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],
    );
} catch (Exception $e) {
    // En cas d'erreur, on affiche un message et on arrête tout
    die('Erreur : ' . $e->getMessage());
}

// Si tout va bien, on peut continuer

// On récupère tout le contenu de la table recipes
//$sqlQuery = "SELECT * FROM `recipes` WHERE id_user = :id_user";
/*
$sqlQuery = "SELECT * FROM `recipes` WHERE id_user in (select id_user from users where email=:email)";
$recipesStatement = $mysqlClient->prepare($sqlQuery);
$recipesStatement->execute([
    'email' =>  $_SESSION['LOGGED_USER'],
]);
$recipes = $recipesStatement->fetchAll();
*/

$sqlQuery = 'INSERT INTO recipes(title, recipe, author, is_enabled) VALUES (:title, :recipe, :author, :is_enabled)';

// Préparation
$insertRecipe = $mysqlClient->prepare($sqlQuery);

// Exécution ! La recette est maintenant en base de données
$insertRecipe->execute([
    'title' => 'Cassoulet',
    'recipe' => 'Etape 1 : Des flageolets ! Etape 2 : Euh ...',
    'author' => 'contributeur@exemple.com',
    'is_enabled' => 1, // 1 = true, 0 = false
]);

// On affiche chaque recette une à une
foreach ($recipes as $recipe) {
?>
    <!-- <p><?php echo $recipe['title']; ?></p> -->

    <?php echo display_recipe($recipe); ?>

<?php
}
?>