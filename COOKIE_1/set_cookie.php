<?php
function set() {
    global $keyCookie, $nome;
    setcookie($keyCookie, $nome, time()+3600, "/");
}
?>