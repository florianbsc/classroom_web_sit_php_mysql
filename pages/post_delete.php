<?php
session_start();

include_once('../includes/header.php');
include('../config/mysql.php');
include_once('../var/functions.php');
include_once('../login.php');

$postData = $_POST;
if (!isset($loggedUser))
{
    // Redirection vers /login.php
    header("Location: ../login.php");
    exit(); 
}

// fonction "isset" verifie l'exsitance d'un element
if (!isset($postData['id_recipe'])) {
    echo ('Il faut un identifdiant valide pour supprimer une recette.');
    return;
}
$id_recipe = $postData['id_recipe'];

$suppRecipe = deleteRecipeById($db, $postData['id_recipe']);

header('Location: ../index.php');
?>
