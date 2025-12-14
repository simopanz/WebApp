<?php
function read($path) {
    if (!file_exists($path)) die("Error: $path non esiste.");
    $data = json_decode(file_get_contents($path), true);
    if (!is_array($data)) die("Error: $path non valido.");
    return $data;
}

function write($path, $data) {
    if (!file_exists($path)) die("Error: $path non esiste.");
    file_put_contents($path, json_encode($data, JSON_PRETTY_PRINT));
}
?>