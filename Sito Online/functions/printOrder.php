<?php
// TODO: cases
function printOrder($o) {
    $order = "";
    foreach ($o as $k => $v) {
        switch ($k) {
            case 'id':
                $order .= "ID: ".$v."<br>";
                break;
            case 'name':
                $order .= "Nome: ".$v."<br>";
                break;
            case 'category':
                $order .= "Categoria: ".$v."<br>";
                break;
            case 'description':
                $order .= "Descrizione: ".$v."<br>";
                break;
            case 'amount':
                $order .= "Quantità: ".$v."<br>";
                break;
            case 'price':
                $order .= "Prezzo: ".$v."€<br>";
            default:
                break;
        }
    }
    return $order;
}
?>