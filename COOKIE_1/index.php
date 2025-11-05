<?php
require_once 'delete_cookie.php';
require_once 'set_cookie.php';

$name = "utente";
$value = "simopanz";
?>

<!doctype html>
<html>
<head>
    <title>Esercizio COOKIE</title>
</head>
<body>
    <?php
    if (isset($_COOKIE[$name])) {
        echo "<h1>Benvenuto nell'esercizio sui cookie</h1>";
        
    } else {
        
        if (isset($_POST["val"])) {
            set($name, $_POST["val"]);
        }
    }
    ?>
    <a href="delete_">Cancella il cookie corrente</a>
    <form action="index.php" method="post">
        <label for="val">Inserisci il nome:</label>
        <input type="text" name="val" id="val" required>
        <br>
        <input type="submit" name="btn" value="Ottieni il cookie">
    </form>
</body>
</html>