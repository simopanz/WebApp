<?php
function priceBasket($basket) {
    $total = 0;
    foreach ($basket as $p) {
        $total += $p['price'];
    }
    return $total;
}
?>