<?php
if (
    (!isset($_GET['email']) || !filter_var($_GET['email'], FILTER_VALIDATE_EMAIL))
    || (!isset($_GET['message']) || empty($_GET['message']))
    )
{
	echo('Il faut un email et un message valides pour soumettre le formulaire.');
    // Arrête l'exécution de PHP
    return;
}
?>

<h1>Message bien reçu !</h1>

<?php include_once('header.php'); ?>
<div class="card">


    <div class="card-body">
        <h5 class="card-title">Rappel de vos informations</h5>
        <p class="card-text"><b>Nom</b> : <?php echo $_GET['nom']; ?></p>
        <p class="card-text"><b>Prénom</b> : <?php echo $_GET['prenom']; ?></p>
        <p class="card-text"><b>Email</b> : <?php echo $_GET['email']; ?></p>
        <p class="card-text"><b>Message</b> : <?php echo $_GET['message']; ?></p>
    </div>
</div>