<?php
ini_set('session.cookie_lifetime', '3600');
session_start();
$productId = $_POST['product'] ?? 0;
$amount = $_POST['amount'] ?? 1;
$op = $_POST['op'] ?? '';
if (!isset($_SESSION['user']['basket'])) $basket = [];
else $basket = $_SESSION['user']['basket'];
/*
if ($productId >= 1 && $productId <= 40)
switch ($op) {
    case 'add':
        if ($amount > 0 && $amount)
        break;
    case 'delete':
        break;
    default:
        $msg = '';
        break;
}*/
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Esercizio SESSION</title>
</head>
<body>
    <a href="index.php">Home</a>
    <a href="products.php">Prodotti</a>
    <h2>Carrello</h2>

    <h3>Aggiungi prodotto</h3>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        <div>
            <label for="product_add">ID prodotto</label>
            <input type="number" name="product" id="product_add" required>
        </div>
        <div>
            <label for="amount">Quantità</label>
            <input type="number" name="amount" id="amount">
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