<?php
// il codice php
    $nome = "Simone";
    $l = "<h1 style='color: red;'>Hello $nome</h1>";
    echo($l);

    $lista = array(1,2,3,4,5,6,7,8,9,0);
    echo("<h3 style='color: blue;'>Contenuto lista</h3>");
    foreach($lista as $k=>$v) {
        echo("<p>$k: $v</p>");
    }
?>