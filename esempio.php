<?php $nome = "Simone";?>
<html>
    <head></head>
    <body>
        <h1>PRIMA WEBAPPP</h1>
        <p>Ciao <?php echo($nome);?></p>
        <?php echo("<p>Tipo: ".gettype($nome)."</p><p>".var_dump($nome)."</p>");?>
    </body>
</html>