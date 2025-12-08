<?php
ini_set('session.cookie_lifetime', '3600');
session_start();

require_once 'functions/categories.php';
require_once 'functions/printProduct.php';
require_once 'functions/findProductIndex.php';
require_once 'functions/add.php';
require_once 'functions/remove.php';
require_once 'functions/delete.php';
require_once 'functions/available.php';

$category = $_GET['filter'] ?? '-';
$productId = $_POST['product'] ?? 0;
$amount = $_POST['amount'] ?? 0;
$action = $_POST['action'] ?? '';

$path = 'data/products.json';
if (!file_exists($path)) die("Error: $path non esiste.");
$json = file_get_contents($path);
$products = json_decode($json, true);
if (!is_array($products)) die("Error: $path non valido.");
$categories = categories($products);

if (!isset($_SESSION['user']['basket'])) $basket = [];
else $basket = $_SESSION['user']['basket'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $indexBasket = findProductIndex($basket, $productId);
    $indexProducts = findProductIndex($products, $productId);
    switch ($action) {
        case 'add':
            $basket = add();
            break;
        case 'remove':
            $basket = remove();
            break;
        case 'delete':
            $basket = delete();
            break;
        default:
            break;
    }
    $_SESSION['user']['basket'] = $basket;
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crazy Shop</title>
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
</head>
<body>
    <a href="index.php">Home</a>
    <?php if (isset($_SESSION['user'])) { ?> <a href="basket.php">Carrello</a> <?php } ?>
    <h2>Prodotti</h2>

    <form action="" method="get">
        <label for="filter">Categoria</label>
        <select name="filter" id="filter">
            <option value="-">-</option>
            <?php foreach ($categories as $c) echo "<option value=".$c.">".$c."</option>"; ?>
        </select>
        <button type="submit">Filtra</button>
    </form>

    <?php foreach ($products as $p) {
        if ($category === '-' || $category === $p['category']) { ?>
            <div style="margin-top:15px; margin-bottom:15px;">
                <?php printProduct($p);
                $indexProducts = findProductIndex($products, $p['id']);
                $indexBasket = findProductIndex($basket, $p['id']);
                if (isset($_SESSION['user'])) { ?>
                    <form action="" method="post" style="display:inline;">
                        <input type="hidden" name="product" value="<?php echo $p['id']; ?>">
                        <input type="number" name="amount" placeholder="0" min="0" max="<?php echo available(); ?>">
                        <button type="submit" name="action" value="add">Aggiungi</button>
                    </form>
                    <form action="" method="post" style="display:inline;">
                        <input type="hidden" name="product" value="<?php echo $p['id']; ?>">
                        <button type="submit" name="action" value="remove">-1</button>
                    </form>
                    <form action="" method="post" style="display:inline;">
                        <input type="hidden" name="product" value="<?php echo $p['id']; ?>">
                        <button type="submit" name="action" value="delete">Elimina</button>
                    </form>
                    <div>
                        <?php if ($indexBasket !== -1) echo "Nel carrello: <b>".$basket[$indexBasket]['amount']."</b>"; ?>
                    </div>
                <?php } ?>
            </div>
        <?php }
    } ?>
</body>
</html>