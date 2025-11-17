<?php
function delete() {
    global $keyCookie;
    setcookie($keyCookie, '', time()-3600, '/');
}
?>