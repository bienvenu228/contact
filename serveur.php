BIENVENU
bienvenu_strange228
En ligne

paul — 14/08/2025 13:19
[13/08/2025 16:47] ~Le Mec Simple~: sdkmanager --sdk_root=C:\Android\SDK "platform-tools" "platforms;android-34" "build-tools;34.0.0"
[13/08/2025 16:48] ~Le Mec Simple~: sdkmanager --sdk_root=C:\Android\SDK --licenses
[13/08/2025 16:51] ~Le Mec Simple~: flutter doctor --android-licenses
[13/08/2025 16:57] ~Le Mec Simple~: adb kill-server
adb start-server
adb devices
BIENVENU — 11:39
idofdhfs
Type de fichier joint : archive
portfolio2.rar
155.14 KB
Type de fichier joint : archive
portfolio2.rar
355.80 KB
paul — 12:07
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // chemin vers Composer autoload
Afficher plus
serveur.php
2 Ko
git remote add origin https://github.com/bienvenu228/contact.git
paul
paul_dev102
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
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; 
        $mail->Port       = 587;

        // Expéditeur et destinataire
        $mail->setFrom('strangebienvenu@gmail.com', 'Formulaire Contact'); 
        $mail->addAddress('strangebienvenu@gmail.com', 'Moi'); 
        $mail->addReplyTo($email, $nom);

        // Contenu
        $mail->isHTML(false); // texte simple
        $mail->Subject = 'Nouveau message depuis le formulaire de contact';
        $mail->Body    = "Nom: $nom\nEmail: $email\n\nMessage:\n$message";

        if ($mail->send()) {
            echo "<h2>Message envoyé avec succès 🎉</h2>";
        } else {
            echo "<h2>Échec de l'envoi: " . $mail->ErrorInfo . "</h2>";
        }

    } catch (Exception $e) {
        echo "<h2>Erreur lors de l'envoi: {$mail->ErrorInfo}</h2>";
    }
}
