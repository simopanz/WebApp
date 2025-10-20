<html>
    <head></head>
    <body>
        <h1>Controllo credenziali</h1>
        <?php
            /**
             * Leggere un file json:
             * - $path: utenti.json
             * - file_exists($path) --> TRUE se esiste il file, FALSE altrimenti
             * Stampare il contenuto a video
             */
            $path = "utenti.json";
            if (!file_exists($path))
                die("Errore, il file non esiste");
            else {
                // leggere il contenuto
                $json = file_get_contents($path);
                //var_dump($json);
                $dati = json_decode($json, true); // true --> array
                //var_dump($dati);
                $utenti = array();
                foreach ($dati as $valore) {
                    foreach ($valore as $k=>$v) {
                        $utenti[$k] = $v;
                        echo("$k: $v</br>");
                    }
                }
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