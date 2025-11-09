<?php
function read_json($path) {
    if (!file_exists($path)) {
        file_put_contents($path, json_encode([]));
    }
    $json = file_get_contents($path);
    $data = json_decode($json, true);
    if ($data === null) return [];
    return $data;
}

function write_json($path, $data) {
    $dir = dirname($path);
    if (!is_dir($dir)) mkdir($dir, 0755, true);

    $tmp = $path . '.tmp';
    $encoded = json_encode($data, JSON_PRETTY_PRINT);
    file_put_contents($tmp, $encoded);
    rename($tmp, $path);
}
?>