<?php
function delete($name, $value) {
    setcookie($name, $value, time()-3600, "/");
}
?>