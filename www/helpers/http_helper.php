<?php

/**
 * Fonction de rendu des templates correspond à chaque vue
 * @param string $path | nom de la portition du chemin allant du dossier view au fichier à utiliser
 * @param array $params | données à passer à la vue pour affichage. ex : title, categories,...
 */
function renderView(string $path, array $params = []): void
{
    // Crée des variable à partir d'un tableau associatif. Clé ==> Nom de la variable, Valeur ==> Valeur de la variable.
    extract($params);
    // Inclusion des fichiers partiels
    require_once __DIR__ . '/../views/' . $path  . '.php';
    require_once __DIR__ . '/../views/templates/template.php';
}

/**
 * Redirection HTTP vers une autre route
 * @param string $path | nom de la route
 */
function redirectToRoute($path)
{
    header('Location: ' . $path);
    exit();
}

function addFlash(string $type, string $message)
{
    $_SESSION['flashes']['type'] = $type;
    $_SESSION['flashes']['message'] = $message;
}

function getFlash()
{
    $flash = [];
    if (isset($_SESSION['flashes'])) {
        $flash['type'] =  $_SESSION['flashes']['type'];
        $flash['message'] =  $_SESSION['flashes']['message'];
    }
    unset($_SESSION['flashes']);
    return $flash;
}

// function sendMail(string $mail, string $clientName)
// {
//     $to      = $mail;
//     $subject = 'Confirmation de votre réservation de véhicule';
//     $message = 'Cher(e)';
//     $headers = array(
//         'From' => 'webmaster@example.com',
//         'Reply-To' => 'webmaster@example.com',
//         'X-Mailer' => 'PHP/' . phpversion()
//     );

//     mail($to, $subject, $message, $headers);
// }

function sendMail(string $mail, string $clientName, string $startdate, string $enddate, string $vehicleName): bool
{
    $to = $mail;
    $subject = 'Confirmation de votre réservation de véhicule';
    $message = "
<html>
<head>
  <title>Confirmation de votre réservation de véhicule</title>
</head>
<body>
  <p>Cher(e) $clientName,</p>
  <p>Nous avons le plaisir de vous confirmer que votre réservation de véhicule a été effectuée avec succès. Vous trouverez ci-dessous les détails de votre réservation :</p>
  <p><strong>Détails de la réservation :</strong></p>
  <ul>
    <li><strong>Nom :</strong> $clientName</li>
    <li><strong>Date de prise en charge :</strong> $startdate</li>
    <li><strong>Date de retour :</strong> $enddate</li>
    <li><strong>Véhicule réservé :</strong> $vehicleName</li>
  </ul>
  <p>Si vous avez des questions ou besoin de modifier votre réservation, n'hésitez pas à nous contacter à contact@rentmyride.com ou par téléphone au 0104054545.</p>
  <p>Merci de votre confiance et à bientôt.</p>
  <p>Cordialement,</p>
  <p>L'équipe de Rent My Ride</p>
</body>
</html>
";
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8\r\n";
    $headers .= "From: ras.risha@gmail.com\r\n";
    $headers .= "Reply-To: ras.risha@gmail.com\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();

    return mail($to, $subject, $message, $headers);
}
