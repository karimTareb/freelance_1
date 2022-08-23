<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// AVEC PHPMAILER
require_once('./includes/Exception.php');
require_once('./includes/PHPMailer.php');
require_once('./includes/SMTP.php');

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);
if (!empty($_POST['email']) && !empty($_POST['name'])) {
  try {
    ob_start();
    //DECLARATION DES VARIABLES
    $email = htmlspecialchars($_POST['email']);
    $nom   = htmlspecialchars($_POST['name']);
    $telephone = htmlspecialchars($_POST['phone']);
    $message = "" . htmlspecialchars($_POST['messageContact']); //
    $message = wordwrap($message, 70, '\r\n'); // Pour couper le message en ligne de 70 caractères pour éviter les problème sur certain navigateur

    $ficheContact = "
        <h2>Fiche client</h2>
    <table>
      <tr>
        <th>Nom : </th>
        <td>" . $nom . "</td>
      </tr>
      <tr>
        <th>Email : </th>
        <td>" . $email . "</td>
      </tr>
      <tr>
        <th>Téléphone : </th>
        <td>" . $telephone . "</td>
      </tr>
      <tr>
        <th>Message : </th>
        <td>" . $message . "</td>
      </tr>
    </table>
        ";


    //Server settings
    $mail->SMTPDebug  = SMTP::DEBUG_SERVER;            //Enable verbose debug output
    $mail->isSMTP();                                   //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';              //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                          //Enable SMTP authentication
    $mail->Username   = 'monmailtest712@gmail.com';          //SMTP username
    $mail->Password   = 'kanjdnuktsmflunz'; //SMTP password
    //$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;   //Enable implicit TLS encryption
    $mail->secure     =  "tls";
    $mail->SMTPDebug = 2;

    $mail->Port       = 587;                           //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    $mail->SMTPOptions = array(
      'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
      )
    );

    //Recipients
    $mail->setFrom('ktareb80@gmail.com', 'Expediteur');
    $mail->addAddress('karim.tareb@orange.fr', 'Destinataire');     //Add a recipient
    //$mail->addAddress('ellen@example.com');               //Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Test envoi mail PHPMailer';
    //$mail->Body    = $_POST['prenom'] . ' vous à contacté. Voici son adresse mail : <br>'
    //     . $_POST['email'];
    $mail->Body = $ficheContact;

    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
      try {
        $mail->send();
        header('location:./messageEnvoye.html');
        exit();
      } catch (Exception $e) {
        echo $e->getMessage();
        echo 'Mail pas envoyé';
      }
    } else header('location:contact.php');
    exit();
    ob_end_flush();
  } catch (Exception) {
    echo "Le message n'a pas pu être envoyé. Erreur : {$mail->ErrorInfo}";
  }
};

?>



<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="./design/style.css" />
  <link rel="stylesheet" href="./design/bootstrap.min.css" />
  <link rel="stylesheet" href="./design/bootstrap.min.css.map" />

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css" />
  <title>Contact</title>

</head>

<body class="fondBois">

  <!-- HEADER -->
  <header class="container-fluid">
    <div class="header-text">
      <h2 style="font-size:50px">Je suis Karim TAREB</h2>
      <h3>Développeur Web Freelance</h3>
      <a class="btn btn-primary mt-5" href="../contact.php" role="button">Contactez moi</a>

  </header>

  <div>
    <!-- MENU -->
    <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="./img/IMG_6102.jpg">
          <img src="./img/IMG_6102.jpg" width="30" height="30" alt="Karim Tareb" style="border-radius:50% ;">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="./public/index.html">Accueil</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./services.html">Services</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="./contact.php">Contact</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./test.html" tabindex="-1" aria-disabled="true">Test</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <section class="container-fluid title">
      <p class="text-center">Contact</p>

    </section>

    <!-- FORMULAIRE -->
    <div class="container vh-100 mt-5">
      <form method="post" action="contact.php">
        <div class="input-group mb-5">
          <span class="input-group-text"><i class="bi bi-person-circle"></i></span>
          <input type="text" class="form-control" placeholder="Votre Nom" name="name" required>
        </div>

        <div class="input-group mt-5">
          <span class="input-group-text"><i class="bi bi-at"></i></span>
          <input type="text" class="form-control" placeholder="Votre Email" name="email" required>
        </div>
        <div class="input-group mt-5 mb-5">
          <span class="input-group-text"><i class="bi bi-telephone"></i></span>
          <input type="text" class="form-control" placeholder="Votre numéro de téléphone" name="phone">
        </div>
        <label for="comment">Message:</label>
        <textarea class="form-control" rows="5" id="comment" placeholder="Message sur 5 lignes max." name="messageContact"></textarea>

        <div class="mt-5 position-relative">
          <button class="btn btn-primary position-absolute top-0 start-50 translate-middle-x form-control form-control-lg" type="submit">Envoyer</button>
        </div>

      </form>
    </div>

    <!-- FOOTER -->
    <footer class="d-flex justify-content-around bg-light">
      <div class="p-2 kt"><i class="bi bi-facebook me-1"></i>
        <i class="bi bi-instagram me-1"></i>
        <i class="bi bi-twitter me-1"></i>
        <i class="bi bi-tiktok me-1"></i>
        <i class="bi bi-snapchat me-1"></i>
      </div>
      <div class="p-2"></div>
      <div class="p-2 kt">2022 &copy; Karim Tareb</div>
    </footer>
  </div>
</body>

</html>