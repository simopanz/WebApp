<?php
    function somma($parametri) {
        $somma = 0;
        foreach ($parametri as $v) {
            $somma += $v;
        }
        return $somma;
    }

    function moltiplicazione($parametri) {
        $molt = 1;
        foreach ($parametri as $v) {
            $molt *= $v;
        }
        return $molt;
    }
?>