<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sündmuste kalender</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .event {
            background: #e2f0d9;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 5px;
            border-left: 5px solid #4CAF50;
        }
        .event h2 {
            margin: 0;
            font-size: 1.2em;
            color: #4CAF50;
        }
        .event p {
            margin: 5px 0;
            color: #666;
        }
        .back-link {
            text-align: center;
            margin-top: 15px;
        }
        .back-link a {
            color: #4CAF50;
            text-decoration: none;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Sündmuste kalender</h1>
    <?php
    require 'connection.php'; // Ühenduse fail
    global $yhendus;
    // Võtame kõik sündmused
    $sql = "SELECT * FROM events ORDER BY event_date";
    $result = $yhendus->query($sql);

    if ($result->num_rows > 0) {
        while ($event = $result->fetch_assoc()) {
            echo "<div class='event'>";
            echo "<h2>" . htmlspecialchars($event['title']) . "</h2>";
            echo "<p><strong>Kuupäev:</strong> " . htmlspecialchars($event['event_date']) . "</p>";
            echo "<p><strong>Kirjeldus:</strong> " . htmlspecialchars($event['description']) . "</p>";
            echo "<p><strong>Email:</strong> " . htmlspecialchars($event['email']) . "</p>";
            echo "</div>";
        }
    } else {
        echo "<p>Planeeritud sündmusi ei ole.</p>";
    }

    $yhendus->close();
    ?>
    <div class="back-link">
        <a href="index.html">Lisa uus sündmus</a>
    </div>
</div>
</body>
</html>
