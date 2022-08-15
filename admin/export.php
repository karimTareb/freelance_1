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

$reqImg = $bdd->prepare('  SELECT *
                            FROM images where id_article=?');

$reqImg->setFetchMode(PDO::FETCH_ASSOC);
$reqImg->execute(array($_GET['id']));
$tab = $reqImg->fetchAll();
echo $tab[0]['bin'];
