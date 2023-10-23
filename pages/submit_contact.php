<?php

$postData = $_POST;

// fonction "isset" verifie l'exsitance d'un element
if (!isset($postData['email']) || !isset($postData['message']))
{
     include_once('../includes/header.php');
	echo('Il faut un email et un message pour soumettre le formulaire.');
    return;
}	

$email = $postData['email'];
$message = $postData['message'];
// $_GET et $_POST sont des superglobale et $_FILES est une supervariable

//Traitement de l'envoi en PHP
if (isset($_FILES['screenshot']) && $_FILES['screenshot']['error'] == 0) {
    if ($_FILES['screenshot']['size'] < 1000000) 
    {
        //Vérification de l'extension du fichier
        $fileInfo = pathinfo($_FILES['screenshot']['name']);
        $extension = $fileInfo['extension'];
        $allowedExtensions = ['jpg', 'jpeg', 'gif', 'png'];

        if (in_array($extension, $allowedExtensions)) 
        {
            // On peut valider le fichier et le stocker définitivement
            move_uploaded_file($_FILES['screenshot']['tmp_name'], 'uploads/' . basename($_FILES['screenshot']['name']));
            echo "L'envoi a bien été effectué !";
        }
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Site de Recettes - Demande de contact reçue</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">

        <?php include_once('../includes/header.php'); ?>
        <h1>Message bien reçu !</h1>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Rappel de vos informations</h5>
                <p class="card-text"><b>Email</b> : <?php echo ($email); ?></p>
                <p class="card-text"><b>Message</b> : <?php echo strip_tags($message); ?></p>
            </div>
        </div>
    </div>

</body>   
    <?php include_once('../includes/footer.php'); ?>
</html>