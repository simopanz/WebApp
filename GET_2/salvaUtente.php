<?php
$nomeFile= "utenti.json";
    if (!file_exists($nomeFile)) {
        die("xdffdsfsdf");
} else {
    $json = file_get_contents($nomeFile);
    $array = json_decode($json, true);
    
    $nuovoUtente = [
        "login" => "SIMO",
        "psw" => "PANZ"
    ];

    $array[] = $nuovoUtente;

    $json = json_encode($array, JSON_PRETTY_PRINT);
    echo($json);
    file_put_contents($nomeFile, $json);
}
?>