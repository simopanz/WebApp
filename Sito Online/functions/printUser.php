<?php
function printUser($u) {
    foreach ($u as $k => $v) {
        switch ($k) {
            case 'id':
                echo "ID: $v<br>";
                break;
            case 'name':
                echo "Nome: $v<br>";
                break;
            case 'surname':
                echo "Cognome: $v<br>";
                break;
            case 'username':
                echo "Username: $v<br>";
                break;
            default:
                break;
        }
    }
}
?>