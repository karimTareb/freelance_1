<?php
if (isset($_POST['valider'])) {
    try {
        $bdd = new PDO('mysql:host=localhost;dbname=espace_admin;charset=utf8;', 'root', '');
    } catch (Exception $e) {
        die('Erreur connexion : ' . $e->getMessage());
    }

    $req = $bdd->prepare("  INSERT INTO
                            images(nom,taille,type,bin,id_article)
                            VALUES (?,?,?,?)");

    $req->execute(array($_FILES['image']['name'], $_FILES['image']['size'], $_FILES['image']['type'], file_get_contents($_FILES['image']['tmp_name'])));
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="image"><br>
        <input type="submit" value="Valider" name="valider">
    </form>

    <div>
    </div>
</body>

</html>