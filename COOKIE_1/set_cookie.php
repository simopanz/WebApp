<?php
$nome = $_POST['nome'];
setcookie('utente', $nome, time()+3600, "/");
?>