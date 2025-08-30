
<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nom = strip_tags(trim($_POST['nom']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $message = strip_tags(trim($_POST['message']));

    if (empty($nom) || empty($email) || empty($message)) {
        echo "<h2>Veuillez remplir tous les champs.</h2>";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<h2>Adresse email invalide.</h2>";
        exit;
    }

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'linuxholding@gmail.com';
        $mail->Password   = 'frgfnegcowltbigr';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        $mail->setFrom('linuxholding@gmail.com', 'Formulaire Contact');
        $mail->addAddress('linuxholding@gmail.com', 'Linux Holding LTD');
        $mail->addReplyTo($email, $nom);

        $mail->isHTML(true);
        $mail->Subject = 'Nouveau message depuis votre site web';
        $mail->Body    = "
            <h3>Vous avez reçu un nouveau message :</h3>
            <p><strong>Nom :</strong> $nom</p>
            <p><strong>Email :</strong> $email</p>
            <p><strong>Message :</strong><br>$message</p>
        ";

        if ($mail->send()) {
            echo '
    <script type="text/javascript">
        alert("Message envoyé avec succès 🎉");
        window.location.href = "index.html"; 
    </script>
    ';
            exit();
        } else {
            echo "<h2>Échec de l'envoi: " . $mail->ErrorInfo . "</h2>";
        }
    } catch (Exception $e) {
        echo "<h2>Erreur lors de l'envoi: {$mail->ErrorInfo}</h2>";
    }
}
