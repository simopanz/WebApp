<?php
function printProduct($p) {
    foreach ($p as $k => $v) {
        switch ($k) {
            case 'id':
                echo "ID: $v<br>";
                break;
            case 'name':
                echo "Nome: $v<br>";
                break;
            case 'category':
                echo "Categoria: $v<br>";
                break;
            case 'description':
                echo "Descrizione: $v<br>";
                break;
            case 'amount':
                echo "Quantità: $v<br>";
                break;
            default:
                break;
        }
    }
}
?>
