<?php
ini_set('session.cookie_lifetime', '3600');
session_start();
require 'functions/printProducts.php';
$category = $_GET['filter'] ?? '-';
$path = 'products.json';

if (!file_exists($path)) die("Error: $path non esiste.");
$json = file_get_contents($path);
$products = json_decode($json, true);
if (!is_array($products)) die("Error: $path non valido.");
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crazy Shop</title>
</head>
<body>
    <a href="index.php">Home</a>
    <?php if (isset($_SESSION['user'])) { ?> <a href="basket.php">Carrello</a> <?php } ?>
    <h2>Prodotti</h2>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get">
        <label for="filter">Categoria</label>
        <select name="filter" id="filter">
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
    <?php foreach ($products as $p) {
        echo "<p>";
        if ($category === '-') foreach ($p as $k => $v) echo "$k: $v<br>";
        elseif ($category === $p['category']) foreach ($p as $k => $v) echo "$k: $v<br>";
        echo "</p>";
    } ?>
</body>
</html>