<?php
$destinataire = "mth71749@gmail.com";

function sanitize($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

if ($_POST['captcha'] != '7') {
    die("Captcha incorrect. Retournez en arrière et réessayez.");
}

$prenom = sanitize($_POST['prenom']);
$email = sanitize($_POST['email']);
$objet = sanitize($_POST['objet']);
$message = sanitize($_POST['message']);

$headers = "From: $prenom <$email>\r\n";
$headers .= "Reply-To: $email\r\n";
$headers .= "Content-Type: text/plain; charset=utf-8\r\n";

$contenu = "Vous avez reçu un nouveau message depuis votre formulaire de contact :\n\n";
$contenu .= "Prénom : $prenom\n";
$contenu .= "Email : $email\n";
$contenu .= "Objet : $objet\n\n";
$contenu .= "Message :\n$message\n";

if (mail($destinataire, $objet, $contenu, $headers)) {
    echo "<h2>✅ Merci $prenom, votre message a bien été envoyé !</h2>";
    echo "<a href='index.html'>Retour au site</a>";
} else {
    echo "<h2>❌ Une erreur est survenue. Merci de réessayer.</h2>";
}
?>
