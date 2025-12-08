<?php
function findProductIndex($list, $productId) {
    foreach ($list as $index => $product) {
        if ($product['id'] == $productId) return $index;
    }
    return -1;
}
?>