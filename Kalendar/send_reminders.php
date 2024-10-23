<?php
require 'connection.php'; // Ühenduse fail
global $yhendus;

if ($yhendus->connect_error) {
    die("Andmebaasi ühenduse viga: " . $yhendus->connect_error);
}

// Valime sündmused, mille meeldetuletusi pole veel saadetud ja mille kuupäev on homme
$sql = "SELECT * FROM events WHERE event_date = CURDATE() + INTERVAL 1 DAY AND reminder_sent = 0";
$result = $yhendus->query($sql);

while ($event = $result->fetch_assoc()) {
    $to = $event['email'];
    $subject = "Meeldetuletus sündmuse kohta: " . $event['title'];
    $message = "Tere!\n\nMeeldetuletus sündmuse \"" . $event['title'] . "\" kohta.\nSündmuse kuupäev: " . $event['event_date'] . "\n\nKirjeldus: " . $event['description'];
    $headers = "From: reminder@example.com";

    // Kirja saatmine
    if (mail($to, $subject, $message, $headers)) {
        // Uuendame meeldetuletuse staatust, et seda uuesti ei saadetaks
        $update_sql = "UPDATE events SET reminder_sent = 1 WHERE id = ?";
        $update_stmt = $yhendus->prepare($update_sql);
        $update_stmt->bind_param('i', $event['id']);
        $update_stmt->execute();
    }
}

$yhendus->close();
?>
