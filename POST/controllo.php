<?php
$login = $_POST['login'];
$psw = $_POST['psw'];
$path = 'utenti.json';

if (!file_exists($path)) die("Error: $path non esiste.");

$json = file_get_contents($path);
$utenti = json_decode($json, true); // se $json non valido = null

if (!is_array($utenti)) die("Error: $path non valido.");

$utente = null;
foreach ($utenti as $u) {
    if ($u['login'] === $login && $u['psw'] === $psw) {
        $utente = $u;
        break;
    }
}

if ($utente) {
    $messaggio = "<h3 style='color:green'>Utente Loggato</h3>";
    //TO DO: finire stampa a video delle CREDENZIALI
    $messaggio .= "<p>Nome: {$utente['nome']} </p>";
} else {
    $messaggio = "<h3 style='color:red'>Credenziali Errate</h3>";
}
?>

<!-- CONTROLLO SIGN IN -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Esercizio POST</title>
</head>
<body>
    <?php echo "$messaggio"; ?>
</body>
</html>