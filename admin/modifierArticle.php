<?php
// CONNEXION A LA BDD
$bdd = new PDO('mysql:host=localhost;dbname=espace_admin', 'root', '');

session_start();
if (!$_SESSION['password']) {
    header('location:connexion.php');
    exit();
}

if (isset($_GET['id']) && !empty($_GET['id'])) {

    $getId = $_GET['id'];
    $reqModifierArticle = $bdd->prepare('   SELECT *
                                            FROM article
                                            WHERE id = ?');

    $reqModifierArticle->execute(array($getId));

    if ($reqModifierArticle->rowCount() > 0) {
        // Afficher le texte de la bdd
        $articleInfos = $reqModifierArticle->fetch();
        $titre = $articleInfos['titre'];
        $contenu = str_replace('<br />', '', $articleInfos['contenu']);

        if (isset($_POST['submit'])) {
            // Récupérer les élements du formulaire et les mettre dans des variables
            $titre_saisi = htmlspecialchars($_POST['titre']);
            $contenu_saisi = nl2br(htmlspecialchars($_POST['contenu']));

            $reqModifierArticle = $bdd->prepare('   UPDATE article
                                                    SET titre= ?, contenu=?
                                                    WHERE id = ?');

            $reqModifierArticle->execute(array($titre_saisi, $contenu_saisi, $getId));

            header('location:./afficherArticle.php');
            exit();
        }
    } else echo "<div class='alert alert-danger text-center' role='success'>
                        Cet identifiant ne correspond à aucun membre.
                </div>";
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
    <title>Modifier un article</title>
</head>

<body class="fondGradient">
    <!-- TITRE -->
    <section class="container-fluid p-3 textWhite text-center">
        <h1>Modifier les articles</h1>
        <a class="textWhite" href="./afficherArticle.php">Retour aux articles</a>
    </section>

    <!-- FORMULAIRE -->
    <section class="container vh-100 mt-5">
        <div class="container">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label textWhite">Titre</label>
                    <input type="text" class="form-control" name="titre" value="<?= $titre; ?>">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label textWhite">Description</label>
                    <textarea name="contenu" class="form-control" rows="3"><?= $contenu; ?></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Valider</button>
            </form>
        </div>
    </section>


</body>

</html>