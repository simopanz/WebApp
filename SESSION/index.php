<?php
if (!(isset($_SESSION['utente']))) {
    ini_set('session.cookie_lifetime', '3600');
    $username = $_POST['username'] ?? null;
    $password = $_POST['password'] ?? null;
    $path = 'utenti.json';
    if (!file_exists($path)) die("Error: $path non esiste.");
    $json = file_get_contents($path);
    $utenti = json_decode($json, true);
    if (!is_array($utenti)) die("Error: $path non valido.");
    foreach ($utenti as $u) {
        if ($u['username'] === $username && $u['password'] === $password) {
            session_start();
            $_SESSION['utente'] = $u;
            break;
        }
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
    <a href="oggetti.php">Oggetti</a>
    <?php if (isset($_SESSION['utente'])) { ?> <a href="carrello.php">Carrello</a> <?php } ?>
    <h1>Crazy shop</h1>
    <?php if (isset($_SESSION['utente'])) { 
        echo "<h2>Account: ".$_SESSION['utente']['nome']." ".$_SESSION['utente']['cognome']."</h2>";
    } else { ?>
        <h2>Login</h2>
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