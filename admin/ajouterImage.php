<?php
try {
    $bdd = new PDO('mysql:host=localhost;dbname=espace_admin;charset=utf8;', 'root', '');
} catch (Exception $e) {
    die('Erreur connexion : ' . $e->getMessage());
}
session_start();
if (!$_SESSION['password']) {
    header('location:connexion.php');
    exit();
}

// VERIFIER SI ID ARTICLE DANS VARIABLE GET
if (isset($_GET['id']) && !empty($_GET['id'])) {
    // if (isset($_POST['image']) && !empty($_POST['image'])) {

    $getId = $_GET['id'];

    // AJOUTER IMAGE
    if (isset($_POST['valider'])) {


        $req = $bdd->prepare("  INSERT INTO images(nom,taille,type,bin,id_article)
                                VALUES (?,?,?,?,?)");

        $req->execute(array($_FILES['image']['name'], $_FILES['image']['size'], $_FILES['image']['type'], file_get_contents($_FILES['image']['tmp_name']), $getId));

        echo "<div class='alert alert-light text-center' role='success'>
                        Votre image a été enregistrée.
                </div>";
    }
    // } else echo "<div class='alert alert-danger text-center' role='success'>
    //                     Vous n'avez pas choisi d'image.
    //             </div>";
} else echo "<div class='alert alert-danger text-center' role='success'>
                    L'identifiant n'a pas été récuperer.
            </div>";

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
    <title>Ajouter une image</title>
</head>

<body class="fondGradient">
    <!-- AVEC BOOTSTRAP -->
    <div class="container d-flex justify-content-center mt-3">
        <a class="btn btn-light textWhite" href="./afficherArticle.php" role="button">retour aux articles</a>

    </div>

    <div class="container">

        <div class="container mt-5">
            <form action="" method="post" enctype="multipart/form-data">

                <div class="mb-3">
                    <label for="formFile" class="form-label textWhite">Choisir une photo au format 1280x853</label>
                    <input class="form-control" type="file" id="formFile" name="image" required>
                </div>
                <button type="submit" class="btn btn-primary" name="valider">Ajouter</button>
            </form>
        </div>
    </div>


    <!-- SANS BOOTSTRAP -->
    <!-- <a href="./afficherArticle.php">retour aux articles</a>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="image"><br>
        <input type="submit" value="Valider" name="valider">
    </form> -->


</body>

</html>