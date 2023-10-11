<?php

// submit_contact.php
if (!isset($_POST['email']) || !isset($_POST['message']) || !isset($_POST['prenom']) || !isset($_POST['nom']))
{
	echo('Il faut un email et un message pour soumettre le formulaire.');
    return;
}	

$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$email = $_POST['email'];
$message = $_POST['message'];

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Site de Recettes - Demande de contact reçue</title>
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
            rel="stylesheet"
        >
    </head>
    <body>
        <div class="container">
    
        <?php include_once('header.php'); ?>
            <h1>Message bien reçu !</h1>
            
            <div class="card">
                
                <div class="card-body">
                    <h5 class="card-title">Rappel de vos informations</h5>
                    <p class="card-text"><b>Nom</b> : <?php echo ($nom); ?></p>
                    <p class="card-text"><b>Prénom</b> : <?php echo ($prenom); ?></p>
                    <p class="card-text"><b>Email</b> : <?php echo($email); ?></p>
                    <p class="card-text"><b>Message</b> : <?php echo strip_tags($message); ?></p>
                </div>
            </div>
        </div>
        <?php include_once('footer.php'); ?>

    </body>
</html>