<?php
function printUser() {
    $user = "";
    foreach ($_SESSION['user'] as $k => $v) {
        switch ($k) {
            case 'id':
                $user.= "ID: $v<br>";
                break;
            case 'name':
                $user.= "Nome: $v<br>";
                break;
            case 'surname':
                $user.= "Cognome: $v<br>";
                break;
            case 'username':
                $user.= "Username: $v<br>";
                break;
            default:
                break;
        }
    }
    return $user;
}
?>