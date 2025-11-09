<?php
// user.php
require_once __DIR__ . '/products.php';
require_once __DIR__ . '/cart.php';
require_once __DIR__ . '/order.php';
require_once __DIR__ . '/auth.php';

function user_view_products() {
    return get_all_products();
}

function user_add_to_cart($product_id, $qty) {
    return add_to_cart($product_id, $qty);
}

function user_checkout() {
    return place_order();
}
?>