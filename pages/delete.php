<?php session_start(); ?>
<!-- index.php -->
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site de recettes - Supprime recette </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="d-flex flex-column min-vh-100">
    <div class="container">
        <?php include_once('../includes/header.php'); ?>
        <h1>Supprime une recette</h1>

        <form action="./post_delete.php" method="POST">
            <div class="mb-3 visually-hidden">
                <label for="id" class="from-label">id de la recette</label>
                <input type="id" class="form-control" id="id" name="id" value="<?php echo $_GET['id']; ?>">
            </div>
            <button type="submit" class="btn btn-danger">Supp définitive</button>
        </form>

    </div>
    <?php include_once('../includes/footer.php'); ?>
</body>

</html>