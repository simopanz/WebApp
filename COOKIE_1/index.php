

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Esercizio COOKIE_1</title>
</head>
<body>
    <?php
    if (isset($_COOKIE['utente'])) {
        $utente = $_COOKIE['utente'];
        echo "<h1>Benvenuto $utente!</h1>"
    ?>
    <a href="delete_cookie.php">Elimina cookie</a>
    <?php
    } else {
    ?>
    <form action="index.php" method="post">
        <div>
            <label for="nome">Inserisci nome:</label>
            <input type="text" name="nome" id="nome" required>
        </div>
        <div>
            <input type="submit" name="btn" value="Salva cookie">
        </div>
    </form>
    <?php } ?>
</body>
</html>