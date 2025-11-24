<?php
$categoria = $_GET['filtro'] ?? '-';
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
    <form action="oggetti.php" method="get">
        <label for="filtro">Categoria</label>
        <select name="filtro" id="filtro">
            <option value="-">-</option>
            <option value="Elettronica">Elettronica</option>
            <option value="Accessori PC">Accessori PC</option>
            <option value="Accessori Smartphone">Accessori Smartphone</option>
            <option value="Networking">Networking</option>
            <option value="Ufficio">Ufficio</option>
            <option value="Casa">Casa</option>
            <option value="Abbigliamento">Abbigliamento</option>
            <option value="Bambini">Bambini</option>
            <option value="Sport">Sport</option>
        </select>
        <button type="submit">Filtra</button>
    </form>
    <?php foreach ($oggetti as $o) {
        echo "<p>";
        if ($categoria === $o['categoria']) foreach ($o as $k => $v) echo "$k: $v<br>";
        elseif ($categoria === '-') foreach ($o as $k => $v) echo "$k: $v<br>";
        echo "</p>";
    } ?>
</body>
</html>