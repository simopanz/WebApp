<?php
ini_set('session.cookie_lifetime', '3600');
session_start();

require_once 'functions/printUser.php';

$msg = null;

// login
if (!(isset($_SESSION['user'])) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $path = 'data/users.json';
    if (!file_exists($path)) die("Error: $path non esiste.");
    $json = file_get_contents($path);
    $users = json_decode($json, true);
    if (!is_array($users)) die("Error: $path non valido.");
    foreach ($users as $u) {
        if ($u['username'] === $username && $u['password'] === $password) {
            $_SESSION['user'] = $u;
            header('Location: '.$_SERVER['PHP_SELF']);
            exit;
        }
    }
    $msg = "<p style='color:red'>Credenziali errate.</p>";
}

// logout
if (isset($_POST['out'])) {
    session_destroy();
    header('Location: '.$_SERVER['PHP_SELF']);
    exit;
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crazy Shop</title>
</head>
<body>
    <a href="products.php">Prodotti</a>
    <?php if (isset($_SESSION['user'])) { ?> <a href="basket.php">Carrello</a> <?php } ?>
    <h1>Crazy Shop</h1>

    <?php if (isset($_SESSION['user'])) { 
        echo "<h2>Account</h2>"; 
        echo "<p>".printUser($_SESSION['user'])."</p>"; ?>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
            <button type="submit" name="out">Sign out</button>
        </form>
    <?php } else {
        if (isset($msg)) echo $msg; ?>
        <h2>Login</h2>
        <form action="" method="post">
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