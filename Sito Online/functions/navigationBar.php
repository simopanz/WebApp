<?php
function navigationBar($file) {
    switch ($file) {
        case 'index.php' || 'products.php':
            $navigationBar = "<a href='index.php'>Home</a> | <a href='products.php'>Prodotti</a>";
            if (isset($_SESSION['user'])) $navigationBar .= " | <a href='basket.php'>Carrello</a> | <a href='orders.php'>Ordini</a>";
            break;
        case 'basket.php' || 'orders.php':
            $navigationBar = "<a href='index.php'>Home</a> | <a href='products.php'>Prodotti</a> | <a href='basket.php'>Carrello</a> | <a href='orders.php'>Ordini</a>";
            break;
        default:
            $navigationBar = "";
            break;
    }
    return $navigationBar;
}
?>