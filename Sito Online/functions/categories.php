<?php
function categories($products) {
    $categories = [];
    foreach ($products as $p) {
        if (!in_array($p['category'], $categories)) {
            $categories[] = $p['category'];
        }
    }
    return $categories;
}
?>