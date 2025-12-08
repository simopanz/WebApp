<?php
function add() {
    global $amount, $products, $productId, $basket, $index;
    if ($amount > 0 && $amount <= $products[$productId]['amount']) {
        if ($index === -1) {
            $basket[] = [
                'id' => $productId,
                'amount' => $amount,
                'price' => $products[$productId]['price'] * $amount
            ];
        } else {
            $basket[$index]['amount'] += $amount;
            $basket[$index]['price'] = $products[$productId]['price'] * $basket[$index]['amount'];
        }
    }
    return $basket;
}
?>