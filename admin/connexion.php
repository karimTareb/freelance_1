<?php
session_start();
if (isset($_POST['submit'])) {
    if (!empty($_POST['pseudo']) && !empty($_POST['password'])) {
        $pseudo_default      = "admin";
        $password_default    = "admin123";

        $pseudo_saisi        = htmlspecialchars($_POST['pseudo']);
        $password_saisi      = htmlspecialchars($_POST['password']);

        if ($pseudo_saisi == $pseudo_default && $password_saisi == $password_default) {
            $_SESSION['password'] = $password_saisi;
            header('location:public/index.php');
            exit();
        } else {
            echo 'Mot de passe et/ou pseudo est incorect';
        }
    } else {
        echo 'Veuillez compléter tous les champs.';
    }
}


?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./design/styleGlassmorphique.css">
    <title>Espace de connexion administrateur</title>
</head>

<body>
    <div class="containere">
        <form method="POST">
            <p>Bienvenue</p>
            <input type="text" name="pseudo" placeholder="Pseudo" /><br />
            <input type="password" name="password" placeholder="Mot de passe" /><br />
            <input type="submit" name="submit" value="Connexion" /><br />
            <a href="#">Mot de passe oublié</a>
        </form>

        <div class="drop drop-1"></div>
        <div class="drop drop-2"></div>
        <div class="drop drop-3"></div>
        <div class="drop drop-4"></div>
        <div class="drop drop-5"></div>
    </div>


    <!-- <form action="connexion.php" method="post">
        <input type="text" name="pseudo">
        <br>
        <input type="password" name="mdp">
        <br><br>
        <input type="submit" name="valider">
    </form> -->
</body>

</html>