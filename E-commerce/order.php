<?php
// order.php
require_once __DIR__ . '/utils/json_utils.php';
require_once __DIR__ . '/cart.php';
require_once __DIR__ . '/auth.php';

define('ORDERS_FILE', __DIR__ . '/data/orders.json');

function get_all_orders() {
    return read_json(ORDERS_FILE);
}

function save_all_orders($orders) {
    write_json(ORDERS_FILE, $orders);
}

function place_order() {
    $user = current_user();
    if (!$user) return ['success'=>false, 'message'=>'Devi essere autenticato per acquistare.'];

    $cartInfo = cart_items_detailed();
    if (empty($cartInfo['items'])) return ['success'=>false, 'message'=>'Carrello vuoto.'];

    $orders = get_all_orders();
    $id = 1;
    if (!empty($orders)) $id = max(array_column($orders, 'id')) + 1;
    $order = [
        'id' => $id,
        'user_id' => $user['id'],
        'items' => array_map(function($it){
            return [
                'product_id' => $it['product']['id'],
                'name' => $it['product']['name'],
                'quantity' => $it['quantity'],
                'price' => $it['product']['price']
            ];
        }, $cartInfo['items']),
        'total' => $cartInfo['total'],
        'date' => date('c')
    ];
    $orders[] = $order;
    save_all_orders($orders);

    // decrement stock
    $products = read_json(__DIR__ . '/data/products.json');
    foreach ($order['items'] as $it) {
        foreach ($products as &$p) {
            if ($p['id'] == $it['product_id']) {
                $p['stock'] = max(0, $p['stock'] - $it['quantity']);
            }
        }
    }
    write_json(__DIR__ . '/data/products.json', $products);

    clear_cart();
    return ['success'=>true, 'message'=>'Ordine effettuato.', 'order' => $order];
}
?>