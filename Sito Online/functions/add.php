<?php
function add() {
    global $amount, $products, $productId, $basket, $indexBasket, $indexProducts, $available;
    if ($amount > 0 && $amount <= $available) {
        $unitPrice = $products[$indexProducts]['price'];
        if ($indexBasket === -1) {
            $basket[] = [
                'id' => $productId,
                'name' => $products[$indexProducts]['name'],
                'amount' => $amount,
                'price' => $unitPrice * $amount
            ];
        } else {
            $basket[$indexBasket]['amount'] += $amount;
            $basket[$indexBasket]['price'] = $unitPrice * $basket[$indexBasket]['amount'];
        }
    }
    return $basket;
}
?>