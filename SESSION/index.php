<?php
if (isset($_POST['un'], $_POST['psw'])) {
    $un = $_POST['un'];
    $psw = $_POST['psw'];
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
    <div>
        <a href="oggetti.php">Oggetti</a>
        <a href="carrello.php">Carrello</a>
    </div>
    <div>
        <h1>Login</h1>
        <form action="index.php" method="post">
            <div>
                <label for="un">Username</label>
                <input type="text" id="un" name="un" required>
            </div>
            <div>
                <label for="psw">Password</label>
                <input type="text" id="psw" name="psw" required>
            </div>
            <button type="submit">Sign in</button>
        </form>
    </div>
</body>
</html>