<?php
function findProductIndex($basket, $productId) {
    foreach ($basket as $index => $product) {
        if ($product['id'] == $productId)
            return $index;
    }
    return -1;
}
?>