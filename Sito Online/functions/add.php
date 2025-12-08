<?php
// REDO if()
function add() {
    global $amount, $products, $productId, $basket, $indexBasket, $indexProducts;
    if ($amount > 0 && $amount <= $products[$indexProducts]['amount']) {
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