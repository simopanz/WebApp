<?php
    $nomeFile= "utenti.json";
    if (!file_exists($nomeFile)) {
        die("xdffdsfsdf");
    } else {
        $json = file_get_contents($nomeFile);
        $array = json_decode($json, true);
        
        $nuovoUtente = [
            "login" => "SIMO",
            "psw" => "PANZ"
        ];

        $array[] = $nuovoUtente;

        foreach($array as $utente){
            echo ("<p>");
            foreach($utente as $k=>$v){
                echo ("$k: $v <br>");
            }
            echo ("</p>");    
        }

        $json = json_encode($array, JSON_PRETTY_PRINT);
        echo($json);
        file_put_contents($nomeFile, $json);
    }
?>