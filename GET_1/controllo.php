<?php
    $nome = $_GET["nome"];
    $cognome = $_GET["cognome"];
?>
<html>
    <head>
        <title>Benvenuto</title>
    </head>
    <body>
        <h1>BENVENUTO</h1>
        <?php echo("<p>Nome: $nome Cognome: $cognome</p>");?>
    </body>
</html>