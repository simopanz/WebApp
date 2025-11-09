<?php
$nome = $_POST['nome'];
$cognome = $_POST['cognome'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];
$path = 'utenti.json';
$duplicato = false;

if (!file_exists($path)) die("Error: $path non esiste.");

$json = file_get_contents($path);
$utenti = json_decode($json, true);

if (!is_array($utenti)) die("Error: $path non valido.");

foreach ($utenti as $u) {
    if ($u['email'] === $email || $u['username'] === $username) {
        $duplicato = true;
        $msg = "<h3 style='color:red'>Impossibile registrarsi</h3>";
        break;
    }
}

if (!$duplicato) {
    $utenti[] = [
            'nome' => $nome,
            'cognome' => $cognome,
            'email' => $email,
            'username' => $username,
            'password' => $password
    ];
    $json = json_encode($utenti, JSON_PRETTY_PRINT);
    file_put_contents($path, $json);
    $msg = "<h3 style='color:green'>Utente registrato con successo</h3>";
}
?>

<!-- SIGN UP -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Esercizio POST</title>
</head>
<body>
    <?php echo $msg ?>
</body>
</html>