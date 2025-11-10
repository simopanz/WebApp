<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Esercizio COOKIE_2</title>
    <style>
        <?php if (isset($_COOKIE['pers'])) $lista = explode('|', $_COOKIE['pers']); ?>
        body {font-family="<?php $lista[0] ?>"; color:"<?php $lista[1] ?>"; background-color:"<?php $lista[2] ?>";}
    </style>
</head>
<body>
    <?php
    if (isset($_COOKIE['nome'], $_COOKIE['cognome'], $_COOKIE['pers'])) {
        $nome = $_COOKIE['nome'];
        $cognome = $_COOKIE['cognome'];
        $pers = $_COOKIE['pers'];
        echo "<h1>Benvenuto $nome $cognome</h1>"; ?>
        <!--
        <h3>Aggiorna i dati</h3>
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
                <input type="text" name="pers_font" id="pers_font" required>
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
        -->
    <?php } else { ?>
        <form action="index.php?sub" method="post">
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
                <input type="text" name="pers_font" id="pers_font" required>
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
    <?php
        if (isset($_POST['nome'], $_POST['cognome'], $_POST['pers_font'], $_POST['pers_color'], $_POST['pers_background'])) {
            $pers = $_POST['pers_font'] .'|'. $_POST['pers_color'] .'|'. $_POST['pers_background'];
            setcookie('nome', $_POST['nome'], time()+3600, '/');
            setcookie('cognome', $_POST['cognome'], time()+3600, '/');
            setcookie('pers', $pers, time()+120, '/');
        }
    } ?>
</body>
</html>