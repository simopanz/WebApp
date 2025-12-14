<?php
ini_set('session.cookie_lifetime', '3600');
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}

require_once 'functions\printOrder.php';
require_once 'functions\navigationBar.php';
require_once 'functions\jsonUtils.php';

$path = __DIR__.'\data\orders.json';
$orders = read($path);

echo $_SESSION['user']['username'];
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
    <h2>Ordini</h2>

    <?php if (empty($orders)) echo "<p>Nessun ordine effettuato.</p>";
    else {

    } ?>
</body>
</html>