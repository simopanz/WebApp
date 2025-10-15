<?php
$listaUtenti = array("simone"=>"123", "simon"=>"456", "simo"=>"789");
$login = $_GET["login"];
$psw = $_GET["psw"];

if ($login === '' || $psw === '') {
    echo "Inserisci login e password.";
    exit;
}

if (array_key_exists($login, $listaUtenti) && $listaUtenti[$login] === $psw) {
    echo "Utente Loggato";
} else {
    echo "Credenziali Errate";
}
?>