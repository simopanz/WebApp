<?php
// products.php
require_once __DIR__ . '/utils/json_utils.php';

define('PRODUCTS_FILE', __DIR__ . '/data/products.json');

function get_all_products() {
    return read_json(PRODUCTS_FILE);
}

function get_product($id) {
    $list = get_all_products();
    foreach ($list as $p) if ($p['id'] == $id) return $p;
    return null;
}

function save_all_products($list) {
    write_json(PRODUCTS_FILE, $list);
}

function add_product($data) {
    $products = get_all_products();
    $id = 1;
    if (!empty($products)) $id = max(array_column($products, 'id')) + 1;
    $product = [
        'id' => $id,
        'name' => $data['name'],
        'description' => $data['description'],
        'price' => (float)$data['price'],
        'stock' => (int)$data['stock']
    ];
    $products[] = $product;
    save_all_products($products);
    return $product;
}

function update_product($id, $data) {
    $products = get_all_products();
    foreach ($products as &$p) {
        if ($p['id'] == $id) {
            $p['name'] = $data['name'];
            $p['description'] = $data['description'];
            $p['price'] = (float)$data['price'];
            $p['stock'] = (int)$data['stock'];
            save_all_products($products);
            return true;
        }
    }
    return false;
}

function delete_product($id) {
    $products = get_all_products();
    $new = array_filter($products, function($p) use ($id) { return $p['id'] != $id; });
    save_all_products(array_values($new));
}
?>