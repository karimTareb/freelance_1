<?php
session_start();
if (!$_SESSION['password']) {
    header('location:connexion.php');
    exit();
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../design/style.css">
    <link rel="stylesheet" href="../design/bootstrap.min.css">
    <link rel="stylesheet" href="../design/bootstrap.min.css.map">
    <title>Connexion</title>
</head>

<body class="fondGradient">

    <div class="container-fluid"></div>
    <div class="container-fluid vh-100 d-flex p-2 bd-highlight align-items-center">
        <div class="d-grid gap-2 col-6 mx-auto">
            <a class="btn btn-primary" href="../membres.php" role="button">Afficher liste des membres</a>
            <a class="btn btn-primary" href="../publierArticle.php" role="button">Publier un article</a>
            <a class="btn btn-primary" href="../afficherArticle.php" role="button">Afficher les articles</a>
        </div>
    </div>






    <!-- <a href="../membres.php">Afficher liste des membres</a>
    <a href="../publierArticle.php">Publier un article</a>
    <a href="../afficherArticle.php">Afficher les articles</a> -->
</body>

</html>