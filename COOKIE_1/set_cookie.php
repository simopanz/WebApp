<?php
function set($name, $value) {
    setcookie($name, $value, time()+3600, "/");
}
?>