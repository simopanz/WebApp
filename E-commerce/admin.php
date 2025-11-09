<?php
// admin.php
require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/products.php';

function admin_list_products() {
    require_role('gestore');
    return get_all_products();
}

function admin_add_product($data) {
    require_role('gestore');
    return add_product($data);
}

function admin_update_product($id, $data) {
    require_role('gestore');
    return update_product($id, $data);
}

function admin_delete_product($id) {
    require_role('gestore');
    return delete_product($id);
}
?>