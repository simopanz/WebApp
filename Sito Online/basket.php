<?php
ini_set('session.cookie_lifetime', '3600');
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}

require_once 'functions/priceBasket.php';
require_once 'functions/printProduct.php';
require_once 'functions/findProductIndex.php';
require_once 'functions/add.php';
require_once 'functions/remove.php';
require_once 'functions/delete.php';
require_once 'functions/available.php';
require_once 'functions/navigationBar.php';

if (!isset($_SESSION['user']['basket'])) $basket = [];
else $basket = $_SESSION['user']['basket'];

$path = __DIR__.'/data/products.json';
if (!file_exists($path)) die("Error: $path non esiste.");
$json = file_get_contents($path);
$products = json_decode($json, true);
if (!is_array($products)) die("Error: $path non valido.");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = $_POST['product'] ?? null;
    $indexBasket = findProductIndex($basket, $productId);
    $indexProducts = findProductIndex($products, $productId);
    $action = $_POST['action'] ?? '';
    switch ($action) {
        case 'add':
            $available = available();
            $amount = $_POST['amount'] ?? (($available) ? 1 : 0);
            $basket = add();
            break;
        case 'remove':
            $basket = remove();
            break;
        case 'delete':
            $basket = delete();
            break;
        case 'order':
            $msg = "<p>Il tuo ordine è andato a buon fine.</p>";
            $basket = [];
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
    <?php echo navigationBar($_SERVER['PHP_SELF']); ?>
    <h2>Carrello</h2>

    <?php if (empty($basket)) {
        if (isset($msg)) echo $msg;
        echo "<p>Il carrello è vuoto.</p>";
    } else {
        echo "<p style='display:inline;'>Prezzo del carrello: <b>".priceBasket($basket)."€</b>"; ?>
        <form action="" method="post" style="display:inline;">
            <button type="submit" name="action" value="order">Ordina</button>
        </form>
        <?php foreach ($basket as $p) { ?>
            <div style="margin-top:15px; margin-bottom:15px;">
                <?php printProduct($p); 
                $indexProducts = findProductIndex($products, $p['id']);
                $indexBasket = findProductIndex($basket, $p['id']);
                $available = available();
                $value = ($available) ? '1' : '0'; ?>
                <form action="" method="post" style="display:inline;">
                    <input type="hidden" name="product" value="<?php echo $p['id']; ?>">
                    <input type="number" name="amount" <?php echo "value=$value"; ?> min="0" max="<?php echo $available; ?>">
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
            </div>
        <?php }
    } ?>
</body>
</html>