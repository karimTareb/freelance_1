<?php
session_start();
if (!$_SESSION['password']) {
    header('location:connexion.php');
    exit();
}
try {
    $bdd = new PDO('mysql:host=localhost;dbname=espace_admin;charset=utf8;', 'root', '');
} catch (Exception $e) {
    echo "Erreur connexion bdd : " . $e->getMessage();
}

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $getId = $_GET['id'];
    $req = $bdd->prepare('  SELECT *
                            FROM membre
                            WHERE id = ?');

    $req->execute(array($getId));

    if ($req->rowCount() > 0) {
        $reqBannirMembre = $bdd->prepare('DELETE FROM membre
                                          WHERE id = ?');

        $reqBannirMembre->execute(array($getId));

        header('location:./membres.php');
        exit();
    } else echo "Cet identifiant ne correspond à aucun membre.";
} else echo "L'identifiant n'a pas été récuperer.";
