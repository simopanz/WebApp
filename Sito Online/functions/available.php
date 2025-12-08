<?php
function available() {
    global $indexProducts, $indexBasket, $products, $basket;
    $maxAvailable = $products[$indexProducts]['amount'];
    $current = 0;
    if ($indexBasket !== -1) $current = $basket[$indexBasket]['amount'];
    return $maxAvailable - $current;
}
?>