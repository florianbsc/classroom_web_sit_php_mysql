<html>
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site de recettes - Page de connexion</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
        rel="stylesheet"
    >

    </head>
    <body class="d-flex flex-column min-vh-100">
    <div class="container">

    <?php include_once('header.php'); ?>
        <h1>Connectez-vous</h1>
            <form action="" method="POST">
                <div class="mb-3">
                    <label for="mail">mail</label>
                    <input type="mail" class="form-control fomr-control -sm" name="mail" id="mail" placeholder="mail" size="30" maxlength="20" required>
                    <label for="password" >Password</label>
                    <input type="password" class="form-control fomr-control -sm" name="password" id="password" placeholder="password" size="30" maxlength="20" required>
                
                </div>
            </form>
        </div>

        
    </body>
    <footer>

    </footer>
</html>
