<?php
ini_set('session.cookie_lifetime', '3600');
session_start();

if (!(isset($_SESSION['user']))) {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $path = 'users.json';
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
    <h1>Crazy shop</h1>
    <?php if (isset($_SESSION['user'])) { 
        echo "<h2>Account: ".$_SESSION['user']['name']." ".$_SESSION['user']['surname']."</h2>";
    } else { ?>
        <h2>Login</h2>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
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