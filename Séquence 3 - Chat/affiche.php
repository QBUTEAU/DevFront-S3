<?php

setlocale(LC_TIME, 'fr_FR.UTF-8', 'fr_FR', 'fr');

$db = new PDO('mysql:host=mariadb;dbname=bdd', 'id', 'mdp');
$db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$res = $db -> query('SELECT * FROM Chat ORDER BY chat_id DESC');

$previousDate = null;

while ($data = $res -> fetch()) {

    $currentDate = date('Y-m-d', strtotime($data['chat_date']));
    $adjustedDate = strtotime($data['chat_date'] . '+1 hour');
    // Utilisation de strftime pour formater la date selon la locale
    $formattedDate = strftime('%d/%m/%Y %H:%M', $adjustedDate);

    // Vérifie si la date du message précédent est différente de la date actuelle
    if ($currentDate != $previousDate) {
        // Ajoute une div avec la date
        echo '<div class="message-separator">';
        echo '<p class="message__date">' . strftime('%d/%m/%Y', $adjustedDate) . '</p>';
        echo '</div>';
    }

    $messageClass = (strcasecmp($data['chat_pseudo'], 'Quentin') === 0) ? 'message right-align' : 'message left-align';


    echo '<div class="' . $messageClass . '">';
        echo '<p class="message__nom">' . $data['chat_pseudo'] . '</p>';
        echo '<p class="message__contenu">' . $data['chat_message'] . '</p>';
        echo '<p class="message__date">' . $formattedDate . '</p>';
    echo '</div>';

    $previousDate = $currentDate;

}

// $previousPseudo = '';
// $position = '';

// foreach($messages as $message){
//     $pseudo = $message['pseudo'];
//     if ($previousPseudo != $pseudo){
//         if ($position == 'left'){
//             $position = 'right';
//         } else {
//             $position = 'left';
//         }
//     }
// }

// $previousPseudo = $pseudo;

// $allMessages[] = [
//     'pseudo' => $message['pseudo'],
//     'message' => $message['message'],
//     'date' => $message['date'],
//     'position' => $position,
//     'initial' => $message['pseudo'][0]
// ];

?>