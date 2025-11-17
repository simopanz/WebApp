<?php
function del() {
    setcookie('utente', '', time()-3600, '/');
}
?>