<?php
$username = $_POST['username'] ?? null;
$password = $_POST['password'] ?? null;

$path = 'utenti.json';
if (!file_exists($path)) die("Error: $path non esiste.");
$json = file_get_contents($path);
$utenti = json_decode($json, true);
if (!is_array($utenti)) die("Error: $path non valido.");
foreach ($utenti as $u) {
    if ($u['username'] === $username && $u['password'] === $password) {
        $stringU = $u['nome'].'|'.$u['cognome'].'|'.$u['username'].'|'.$u['password'];
        setcookie('credenziali', $stringU, time()+1800, '/');
        break;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Esercizio SESSION</title>
</head>
<body>
    <?php if (isset($_COOKIE['credenziali'])) { 
        $utente = explode('|', $_COOKIE['credenziali']); ?>
        <div>
            <a href="oggetti.php">Oggetti</a>
            <a href="carrello.php">Carrello</a>
        </div>
        <?php echo "<h1>Benvenuto $utente[0] $utente[1]!</h1>";
    } else { ?>
        <h1>Login</h1>
        <form action="index.php" method="post">
            <div>
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Sign in</button>
        </form>
    <?php } ?>
</body>
</html>