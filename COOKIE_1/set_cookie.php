<?php
$nome = $_POST['nome'];
setcookie('utente', $nome, time()+3600, "/");

// invia un’intestazione HTTP di tipo Location che dice al browser di aprire un’altra pagina
header("Location: index.php");
// ferma l'esecuzione
exit;
?>