<?php
session_start();

// CONNEXION A LA BDD
$bdd = new PDO('mysql:host=localhost;dbname=espace_admin', 'root', '');


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
    <title>Afficher les membres</title>
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

    <!-- TITRE -->
    <section class="container-fluid bg-light p-4 text-center">
        <h1>Liste des membres</h1>

    </section>

    <!-- AFFICHER TOUS LES MEMBRES AVEC BOOTSTRAP -->
    <?php
    $req = $bdd->query('SELECT *
                        FROM membre'); ?>
    <section class="container">
        <div class="container vh-100 mt-4">
            <table class="table table-primary table-striped border border-dark">

                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Email</th>
                        <th scope="col">Bannir</th>

                    </tr>
                    <?php while ($user = $req->fetch()) {
                    ?>
                </thead>
                <tbody>

                    <tr>
                        <td><?= $user['id']; ?></td>
                        <td><?= $user['pseudo']; ?></td>
                        <td><?= $user['email']; ?></td>
                        <td><a onclick="confirm('Etes-vous sûr de vouloir supprimer définitivement ce membre ?');" href="./bannir.php?id= <?= $user['id'] ?>" class="btn btn-danger" type="text">Bannir</a>
                        </td>
                    </tr>
                <?php
                    }
                ?>
                </tbody>
            </table>
        </div>
    </section>
</body>

</html>