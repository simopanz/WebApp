<?php
$utenti = array("simone"=>"123", "simon"=>"456", "simo"=>"789");
$login = $_GET["login"];
$psw = $_GET["psw"];

if ($login === '' || $psw === '') {
    echo "Inserisci login e password.";
    exit;
}

if (array_key_exists($login, $utenti) && $$utenti[$login] === $psw) {
    echo "Utente Loggato";
} else {
    echo "Credenziali Errate";
}
?>