<html>
    <head></head>
    <body>
        <h1>Controllo credenziali</h1>
        <?php
            $path = "utenti.json";
            if (!file_exists($path))
                die("Errore, il file non esiste");
            else {
                $json = file_get_contents($path);
                $dati = json_decode($json, true);
            }
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