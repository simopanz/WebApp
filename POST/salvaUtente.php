<?php
$path = 'utenti.json';

if (!file_exists($path)) die("Error: $path non esiste.");

$json = file_get_contents($path);
$utenti = json_decode($json, true);

if (!is_array($utenti)) die("Error: $path non valido.");

//TO DO: verificare che non esista già un utente con la stessa login e/o psw

$utenti[] = [
    'nome' => $_POST['nome'],
    'cognome' => $_POST['cognome'],
    'email' => $_POST['email'],
    'login' => $_POST['login'],
    'psw' => $_POST['psw']
];

$json = json_encode($utenti, JSON_PRETTY_PRINT);
file_put_contents($path, $json);
?>

<!-- CONTROLLO SIGN UP -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Esercizio POST</title>
</head>
<body>
    
    
</body>
</html>