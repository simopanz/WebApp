<?php
ini_set('session.cookie_lifetime', '3600');
session_start();
require_once 'functions/minIdProducts.php';
require_once 'functions/maxIdProducts.php';
$minId = minIdProducts();
$maxId = maxIdProducts();
$productId = $_POST['product'] ?? 0;
$amount = $_POST['amount'] ?? 0;
$op = $_POST['op'] ?? '';
$path = 'data/products.json';

if (!file_exists($path)) die("Error: $path non esiste.");
$json = file_get_contents($path);
$products = json_decode($json, true);
if (!is_array($products)) die("Error: $path non valido.");

if (!isset($_SESSION['user']['basket'])) $basket = [];
else $basket = $_SESSION['user']['basket'];

if (!($productId >= 1 && $productId <= 40)) $msg = "<p style='color:red'>ID del prodotto non disponibile.</p>";
else {
    $product = $products[$productId];
    switch ($op) {
        case 'add':
            if ($amount > 0 && $amount <= $product['amount']) {
                $productAdd = [
                    'id' => $product['id'],
                    'name' => $product['name'],
                    'amount' => $amount
                ];
            }
            $_SESSION['user']['basket'] = $basket;
            break;
        case 'delete':
            break;
        default:
            $msg = null;
    }
}
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
    <a href="products.php">Prodotti</a>
    <h2>Carrello</h2>

    <?php if (isset($msg)) echo $msg ?>

    <h3>Aggiungi prodotto</h3>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        <div>
            <label for="product_add">ID prodotto</label>
            <input type="number" name="product" id="product_add" required>
        </div>
        <div>
            <label for="amount">Quantità</label>
            <input type="number" name="amount" id="amount" placeholder="0">
        </div>
        <button type="submit" name="op" value="add">Aggiungi</button>
    </form>
    
    <h3>Elimina prodotto</h3>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        <div>
            <label for="product_delete">ID prodotto</label>
            <input type="number" name="product" id="product_delete" required>
        </div>
        <button type="submit" name="op" value="delete">Elimina</button>
    </form>
</body>
</html>