<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Esercizio GET</title>
</head>
<body>
    <h1>BENVENUTO</h1>
    <?php
    $nome = $_GET["nome"];
    $cognome = $_GET["cognome"];
    echo "<p>Nome: $nome<br>Cognome: $cognome</p>";
    ?>
</body>
</html>