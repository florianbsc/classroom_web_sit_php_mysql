<?php

// Validation du formulaire
if (isset($_POST['email']) &&  isset($_POST['password'])) {
    foreach ($users as $user) {
        // verification dans variable.php l'exsistance de l'adresse mail et du mdp
        if (
            // si l'email et le mdp rentré par l'utilisateur correspond à l'email et au mdp de la BD
            $user['email'] === $_POST['email'] &&
            $user['password'] === $_POST['password']
        ) {
            /* alors 'email' prend la valeur de la chaine de caractere $user['email'] 
            et 'name' prend la valeur de ['full_name']*/
            $loggedUser = [
                'email' => $user['email'],
                'name' => $user['full_name'],
            ];


            //Cookie qui expire dans un an

            setcookie(
                'LOGGED_USER',
                $loggedUser['email'],
                //$loggedUser['name'],
                [
                    'expires' => time() + 10,
                    'secure' => true,
                    'httponly' => true,
                ]
            );

            $_SESSION['LOGGED_USER'] = $loggedUser['email'];
            // $_SESSION['LOGGED_USER'] = $loggedUser['name'];
        } else {
            //sinon affichage d'un msg d'erreur
            $errorMessage = sprintf(
                'Les informations envoyées ne permettent pas de vous identifier : (%s/%s)',
                $_POST['email'],
                $_POST['password']
            );
        }
    }
}

// Si le cookie est présent
if (isset($_COOKIE['LOGGED_USER'])) {
    $loggedUser = [
        'email' => $_COOKIE['LOGGED_USER'],
        // 'name' => $_COOKIE['LOGGED_USER'],
    ];
}

if (isset($_SESSION['LOGGED_USER'])) {
    $loggedUser = [
        'email' => $_SESSION['LOGGED_USER'],
        // 'name' => $_SESSION['LOGGED_USER'],
    ];
}


?>

<!--
   Si utilisateur/trice est non identifié(e), on affiche le formulaire
-->
<?php if (!isset($loggedUser)) : ?>
    <form action="index.php" method="post">
        <!-- si message d'erreur on l'affiche -->
        <?php if (isset($errorMessage)) : ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $errorMessage; ?>
            </div>
        <?php endif; ?>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" aria-describedby="email-help" placeholder="you@exemple.com">
            <div id="email-help" class="form-text">L'email utilisé lors de la création de compte.</div>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <button type="submit" class="btn btn-primary">Envoyer</button>
    </form>
    <!-- 
    Si utilisateur/trice bien connectée on affiche un message de succès
-->
<?php else : ?>
    <div class="alert alert-success" role="alert">
        Bonjour <?php echo ($loggedUser['email']); ?> et bienvenue sur le site !
    </div>
<?php endif; ?>