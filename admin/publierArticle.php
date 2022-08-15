<?php
session_start();
// CONNEXION A LA BDD
try {
    $bdd = new PDO('mysql:host=localhost;dbname=espace_admin', 'root', '');
} catch (Exception $e) {
    die('Erreur connexion : ' . $e->getMessage());
}


if (!$_SESSION['password']) {
    header('location:connexion.php');
    exit();
}

if (isset($_POST['envoi'])) {
    if (!empty($_POST['titre']) && !empty($_POST['contenu'])) {
        $titre             = htmlspecialchars($_POST['titre']);
        $contenu           = htmlspecialchars(wordwrap($_POST['contenu'], 50, "\n", true)); //nl2br permet que le texte ne soit pas ajouter à la suite en cas de retour à la ligne

        // DEFINIR UN MAX POUR LE CONTENU
        if (strlen($contenu) < 201) {

            $reqInsererArticle = $bdd->prepare('INSERT INTO article(titre, contenu)
                                            Values(?,?)');
            $reqInsererArticle->execute(array($titre, $contenu));

            echo "<div class='alert alert-success text-center' role='success'>
                        Votre article à bien été ajouté.
                </div>";
        } else echo "<div class='alert alert-danger text-center' role='success'>
                        Votre description ne doit pas dépasser 180 caractères.
                    </div>";
    } else echo "<div class='alert alert-danger text-center' role='success'>
                        Veuillez compléter tous les champs
                </div>";
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
    <title>Publier un article</title>
</head>

<body>
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
    <div class="container-fluid vh-100 fondGradient">
        <!-- TITRE -->
        <section class="container-fluid p-4 text-center">
            <h1 class="textWhite">Publier un article</h1>
        </section>

        <!-- AVEC BOOTSTRAP -->
        <div class="container-fluid">
            <div class="container">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label textWhite">Titre</label>
                        <input type="text" class="form-control" id="titreArticle" placeholder="titre" name="titre">
                    </div>
                    <div class="mb-3">
                        <label for="descriptionArticle" class="form-label textWhite">Description</label>
                        <textarea class="form-control" id="descriptionArticle" rows="2" placeholder="2 lignes max" name="contenu"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary" name="envoi">Publier</button>


                </form>
            </div>
        </div>

    </div>

    <!-- SANS BOOTSTRAP -->
    <!-- <form action="publierArticle.php" method="post">
        <input type="text" name="titre">
        <br>
        <textarea name="contenu" rows="3"></textarea>
        <br>
        <input type="submit" value="envoi" name="envoi">
    </form> -->
</body>

</html>