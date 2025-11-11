<?php
if (isset($_POST['nome'], $_POST['cognome'], $_POST['pers_font'], $_POST['pers_color'], $_POST['pers_background'])) {
    $nomeP = $_POST['nome'];
    $cognomeP = $_POST['cognome'];
    $persP = $_POST['pers_font'] .'|'. $_POST['pers_color'] .'|'. $_POST['pers_background'];
    setcookie('nome', $nomeP, time()+3600, '/');
    setcookie('cognome', $cognomeP, time()+3600, '/');
    setcookie('pers', $persP, time()+3600, '/');
}
if (isset($_COOKIE['pers'])) {
    $lista = explode('|', $_COOKIE['pers']);
    $font = $lista[0];
    $colore = $lista[1];
    $bg = $lista[2];
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Esercizio COOKIE_2</title>
    <style>
        body {font-family='<?php echo $font?>'; color: <?php echo $colore ?>; background-color: <?php echo $bg ?>;}
    </style>
</head>
<body>
    <?php
    if (isset($_COOKIE['nome'], $_COOKIE['cognome'], $_COOKIE['pers'])) {
        $nomeC = $_COOKIE['nome'];
        $cognomeC = $_COOKIE['cognome'];
        echo "<h1>Benvenuto $nomeC $cognomeC</h1>"; ?>
        <h3>Aggiorna i dati</h3>
        <form action="index.php" method="post">
            <div>
                <label for="nome">Nome:</label>
                <input type="text" name="nome" id="nome">
            </div>
            <div>
                <label for="cognome">Cogome:</label>
                <input type="text" name="cognome" id="cognome">
            </div>
            <div>
                <label for="pers_font">Font:</label>
                <select name="pers_font" id="pers_font">
                    <option value="Arial">Arial</option>
                    <option value="Verdana">Verdana</option>
                    <option value="Times New Roman">Times New Roman</option>
                    <option value="Courier New">Courier New</option>
                    <option value="Georgia">Georgia</option>
                </select>
            </div>
            <div>
                <label for="pers_color">Colore font:</label>
                <input type="color" name="pers_color" id="pers_color">
            </div>
            <div>
                <label for="pers_background">Colore sfondo:</label>
                <input type="color" name="pers_background" id="pers_background">
            </div>
            <div>
                <input type="submit" name="sub" value="Send">
            </div>
        </form>
    <?php } else { ?>
        <h3>Inserisci i dati</h3>
        <form action="index.php" method="post">
            <div>
                <label for="nome">Nome:</label>
                <input type="text" name="nome" id="nome" required>
            </div>
            <div>
                <label for="cognome">Cogome:</label>
                <input type="text" name="cognome" id="cognome" required>
            </div>
            <div>
                <label for="pers_font">Font:</label>
                <select name="pers_font" id="pers_font" required>
                    <option value="Arial">Arial</option>
                    <option value="Verdana">Verdana</option>
                    <option value="Times New Roman">Times New Roman</option>
                    <option value="Courier New">Courier New</option>
                    <option value="Georgia">Georgia</option>
                </select>
            </div>
            <div>
                <label for="pers_color">Colore font:</label>
                <input type="color" name="pers_color" id="pers_color" required>
            </div>
            <div>
                <label for="pers_background">Colore sfondo:</label>
                <input type="color" name="pers_background" id="pers_background" required>
            </div>
            <div>
                <input type="submit" name="sub" value="Send">
            </div>
        </form>
    <?php } ?>
</body>
</html>