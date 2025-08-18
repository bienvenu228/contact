<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // chemin vers Composer autoload

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Nettoyage et validation des champs
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
        // Paramètres SMTP Gmail
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'strangebienvenu@gmail.com'; // ton Gmail
        $mail->Password   = 'mcypykcicseagjqz'; // mot de passe d'application Gmail
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        // Expéditeur et destinataire
        $mail->setFrom('ton.email@gmail.com', 'Formulaire Contact');
        $mail->addAddress('strangebienvenu@gmail.com', 'Moi');
        $mail->addReplyTo($email, $nom);

        // Contenu
        $mail->isHTML(false); // texte simple
        $mail->Subject = 'Nouveau message depuis le formulaire de contact';
        $mail->Body    = "Nom: $nom\nEmail:";
    } catch (\Throwable $th){
        echo "ça marche pas";
    }
}