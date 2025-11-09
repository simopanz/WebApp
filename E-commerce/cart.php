<?php
// cart.php
require_once __DIR__ . '/products.php';

function get_cart() {
    if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];
    return $_SESSION['cart'];
}

function save_cart($cart) {
    $_SESSION['cart'] = $cart;
}

function add_to_cart($product_id, $qty = 1) {
    $product = get_product($product_id);
    if (!$product) return ['success'=>false, 'message'=>'Prodotto non trovato.'];
    $cart = get_cart();
    if (isset($cart[$product_id])) $cart[$product_id] += $qty; else $cart[$product_id] = $qty;
    save_cart($cart);
    return ['success'=>true, 'message'=>'Aggiunto al carrello.'];
}

function remove_from_cart($product_id) {
    $cart = get_cart();
    if (isset($cart[$product_id])) unset($cart[$product_id]);
    save_cart($cart);
}

function clear_cart() {
    $_SESSION['cart'] = [];
}

function cart_items_detailed() {
    $cart = get_cart();
    $items = [];
    $total = 0.0;
    foreach ($cart as $pid => $qty) {
        $p = get_product($pid);
        if (!$p) continue;
        $lineTotal = $p['price'] * $qty;
        $items[] = ['product' => $p, 'quantity' => $qty, 'line_total' => $lineTotal];
        $total += $lineTotal;
    }
    return ['items' => $items, 'total' => $total];
}
?>