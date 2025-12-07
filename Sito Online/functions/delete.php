<?php
function delete() {
    global $basket, $index;
    if ($index !== -1) array_splice($basket, $index, 1);
    return $basket;
}
?>