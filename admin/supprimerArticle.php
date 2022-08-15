<?php
// CONNEXION A LA BDD
$bdd = new PDO('mysql:host=localhost;dbname=espace_admin', 'root', '');

session_start();
if (!$_SESSION['mdp']) {
    header('location:connexion.php');
    exit();
}


if (isset($_GET['id']) && !empty($_GET['id'])) {

    $getId = $_GET['id'];
    $req = $bdd->prepare('  SELECT *
                            FROM article
                            WHERE id = ?');

    $req->execute(array($getId));

    if ($req->rowCount() > 0) {
        $reqSupprimerArticle = $bdd->prepare('DELETE FROM article
                                              WHERE id = ?');

        $reqSupprimerArticle->execute(array($getId));

        header('location:./afficherArticle.php');
        exit();
    } else echo "Cet identifiant ne correspond à aucun membre.";
} else echo "L'identifiant n'a pas été récuperer.";
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supprimer un article</title>
</head>

<body>

</body>

</html>