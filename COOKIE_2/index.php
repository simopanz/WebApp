<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Esercizio COOKIE_2</title>
    <style>

    </style>
</head>
<body>
    <?php
    if (isset($_COOKIE['nome'], $_COOKIE['cognome'], $_COOKIE['pers'])) {
        $nome = $_COOKIE['nome'];
        $cognome = $_COOKIE['cognome'];
        $pers = $_COOKIE['pers'];
        echo "<h1>Benvenuto $nome $cognome</h1>";
    } else { ?>
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
                <p>Personalizzazione</p>
                <div>
                    <label for="pers_font">Font:</label>
                    <input type="text" name="pers_font" id="pers_font" required>
                </div>
                <div>
                    <label for="pers_colour">Colore font:</label>
                    <input type="text" name="pers_colour" id="pers_colour" required>
                </div>
                <div>
                    <label for="pers_background">Colore sfondo:</label>
                    <input type="text" name="pers_background" id="pers_background" required>
                </div>
            </div>
            <div>
                <input type="submit" value="Send">
            </div>
        </form>
    <?php
        if (isset($_POST['nome'], $_POST['cognome'], $_POST['pers_font'], $_POST['pers_colour'], $_POST['pers_background'])) {
            $pers = [
                'pers_font' => $_POST['pers_font'],
                'pers_colour' => $_POST['pers_colour'],
                'pers_background' => $_POST['pers_background']
            ];
            setcookie('nome', $_POST['nome'], time()+3600, '/');
            setcookie('cognome', $_POST['cognome'], time()+3600, '/');
            setcookie('pers', $_POST['pers'], time()+3600, '/');
        }
    } ?>
</body>
</html>