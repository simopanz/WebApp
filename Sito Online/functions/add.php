<?php
function add() {
    global $amount, $products, $productId, $basket, $index;
    if ($amount > 0 && $amount <= $products[$productId]['amount']) {
        if ($index === -1) $basket[] = ['id' => $productId, 'amount' => $amount];
        else $basket[$index]['amount'] += $amount;
    }
    return $basket;
}
?>