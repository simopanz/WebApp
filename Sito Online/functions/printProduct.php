<?php
function printProduct($p) {
    $product = "";
    foreach ($p as $k => $v) {
        switch ($k) {
            case 'id':
                $product .= "ID: ".$v."<br>";
                break;
            case 'name':
                $product .= "Nome: ".$v."<br>";
                break;
            case 'category':
                $product .= "Categoria: ".$v."<br>";
                break;
            case 'description':
                $product .= "Descrizione: ".$v."<br>";
                break;
            case 'amount':
                $product .= "Quantità: ".$v."<br>";
                break;
            case 'price':
                $product .= "Prezzo: ".$v."€<br>";
            default:
                break;
        }
    }
    return $product;
}
?>