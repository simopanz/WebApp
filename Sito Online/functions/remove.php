<?php
function remove() {
    global $basket, $index;
    if ($index !== -1) {
        $basket[$index]['amount']--;
        if ($basket[$index]['amount'] <= 0) array_splice($basket, $index, 1);
    }
    return $basket;
}
?>