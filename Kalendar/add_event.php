<?php
require 'connection.php'; // Подключаем файл с параметрами подключения
global $yhendus;
// Получение данных из формы
$title = $_POST['title'];
$description = $_POST['description'];
$event_date = $_POST['event_date'];
$email = $_POST['email'];

// SQL-запрос для добавления события
$sql = "INSERT INTO events (title, description, event_date, email) VALUES (?, ?, ?, ?)";
$stmt = $yhendus->prepare($sql);
$stmt->bind_param('ssss', $title, $description, $event_date, $email);

if ($stmt->execute()) {
    header("Location: calendar.php");
} else {
    echo "Viga: " . $stmt->error;
}

$stmt->close();
$yhendus->close();
?>
