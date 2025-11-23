<?php
$path = 'oggetti.json';
if (!file_exists($path)) die("Error: $path non esiste.");
$json = file_get_contents($path);
$oggetti = json_decode($json, true);
if (!is_array($oggetti)) die("Error: $path non valido.");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Esercizio SESSION</title>
</head>
<body>
    <a href="index.php">Home</a>
    <a href="carrello.php">Carrello</a>
    <h2>Oggetti</h2>
    <?php foreach ($oggetti as $o) {
        echo "<p>";
        foreach ($o as $k => $v) echo "$k: $v<br>";
        echo "</p>";
    } ?>
</body>
</html>