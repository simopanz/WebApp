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
?>

<!-- SIGN IN -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Esercizio POST</title>
    <style>
        table, th, td {border:1px solid black; border-collapse:collapse;}
    </style>
</head>
<body>
    <?php if ($utente) { ?>
        <h3 style='color:green'>Utente Loggato</h3>
        <table style='width:50%'>
            <h4>CREDENZIALI</h4>
            <?php foreach ($utente as $k => $v)
                echo "<tr><th>$k</th><td>$v</td></tr>";
            ?>
        </table>
    <?php } else { ?>
        <h3 style='color:red'>Credenziali Errate</h3>
    <?php } ?>
</body>
</html>