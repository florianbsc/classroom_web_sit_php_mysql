<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site de recettes - Page de connexion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="d-flex flex-column min-vh-100">
    <div class="container">

        <?php include_once('header.php'); ?>
        <h1>Connectez-vous</h1>
        <form action="login.php" method="POST">
            <div class="mb-3">
                <input type="text" required>
                <label>Email Address</label>
            </div>
            <div class="field">
                <input type="password" required>
                <label>Password</label>
            </div>
            <div class="content">

                <div class="pass-link">
                    <a href="#">Forgot password?</a>
                </div>
            </div>
            <div>
                <input type="submit" class="btn btn-primary" value="login"></button>

            </div>

        </form>
    </div>


</body>
<footer>

</footer>

</html>