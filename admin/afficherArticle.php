<?php
// CONNEXION A LA BDD
$bdd = new PDO('mysql:host=localhost;dbname=espace_admin;charset=utf8', 'root', '');

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
    <link rel="stylesheet" href="./design/style.css">
    <link rel="stylesheet" href="./design/bootstrap.min.css">
    <link rel="stylesheet" href="./design/bootstrap.min.css.map">
    <title>Afficher les articles</title>
</head>

<body class="bg-light">
    <!-- MENU -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Menu</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link active" aria-current="page" href="./connexion.php">Connexion</a>
                    <a class="nav-link" href="./afficherArticle.php">Afficher Articles</a>
                    <a class="nav-link" href="./membres.php">Membres</a>
                    <a class="nav-link" href="./publierArticle.php">Publier articles</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- TITRE -->
    <section class="container-fluid p-4 text-center">
        <h1>Listes des articles</h1>
    </section>

    <!-- Afficher tous les articles -->
    <section class="container">
        <?php
        $reqAfficherArticle = $bdd->query('SELECT *
                                       FROM article');
        while ($article = $reqAfficherArticle->fetch()) {

        ?>
            <section id="articleImg" class="row mt-2">
                <div id="article" class="col">
                    <p class="p-2"><span style="font-weight:bold">Titre : </span> <?= $article['titre'] ?>
                        <br><br>
                        <span style="font-weight:bold">Description : </span> <?= $article['contenu'] ?>
                        <br><br><a style="text-decoration:none" href="./modifierArticle.php?id=<?= $article['id'] ?>"> <button type="button" class="btn btn-secondary">Modifier l'article</button>
                        </a>
                        <br><a style="text-decoration:none" href="./supprimerArticle.php?id=<?= $article['id'] ?>"> <button type="button" class="btn btn-danger mt-1">Supprimer l'article</button>
                        </a>
                    </p>
                </div>



                <div id="img" class="col mt-3">
                    <p><span style="font-weight:bold">Image : </span><br>
                        <img src="export.php?id=<?= $article['id'] ?>" alt="adword" width="150px">
                        <br><br><a style="text-decoration:none" href="./ajouterImage.php?id=<?= $article['id'] ?>"> <button type="button" class="btn btn-secondary">Modifier l'image</button>
                        </a>
                        <br><a style="text-decoration:none" href="./supprimerImage.php?id=<?= $article['id'] ?>"> <button type="button" class="btn btn-danger mt-1">Supprimer l'image</button>
                        </a>
                    </p>
                </div>
            </section>

        <?php
        }
        ?>
    </section>

    <!-- BS avec JS -->
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>

</html>