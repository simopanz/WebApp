<?php
$utenti = array("simone"=>"123", "simon"=>"456", "simo"=>"789");
?>

<html>
    <head></head>
    <body>
        <h1>Controllo credenziali</h1>
        <?php
            $k = $_GET["login"];
            $v = $utenti[$k];
            if ($v === $_GET["psw"]) {
                echo("<p style='color:green'>Utente Loggato</p>");
            } else {
                echo("<p style='color:red'>Credenziali Errate</p>");
            }
        ?>
    </body>
</html>