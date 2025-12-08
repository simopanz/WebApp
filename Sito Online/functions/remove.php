<?php
function remove() {
    global $products, $indexProducts, $basket, $indexBasket;
    if ($indexBasket !== -1) {
        $basket[$indexBasket]['amount']--;
        $basket[$indexBasket]['price'] -= $products[$indexProducts]['price'];
        if ($basket[$indexBasket]['amount'] <= 0) array_splice($basket, $indexBasket, 1);
    }
    return $basket;
}
?>