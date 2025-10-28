<?php
    require_once 'functions/somma.php';
    require_once 'functions/sottrazione.php';
    require_once 'functions/moltiplicazione.php';
    require_once 'functions/divisione.php';

    $a = $_POST["a"];
    $b = $_POST["b"];
    $op = $_POST["op"];

    switch ($op) {
        case 'somma':
            $result = somma($a, $b);
            break;
        case 'sottrazione':
            $result = sottrazione($a, $b);
            break;
        case 'moltiplicazione':
            $result = moltiplicazione($a, $b);
            break;
        case 'divisione':
            $division = divisione($a, $b);
            if ($division === null) {
                $result = 'Errore: divisione per zero';
            } else {
                $result = $division;
            }
            break;
        default:
            $result = 'Operazione non valida';
    }
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>Calcolatrice PHP</title>
        <style>
            body { font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial; background:#f7f7f9; color:#111; }
            .container { max-width:480px; margin:40px auto; background:white; padding:20px; border-radius:8px; box-shadow:0 6px 20px rgba(0,0,0,0.06); }
            input[type="number"] { width:100%; padding:8px 10px; margin:6px 0 12px; border:1px solid #ddd; border-radius:6px; }
            input[type="submit"] { width:100%; padding:8px 10px; margin:6px 0 12px; border:1px solid #ddd; border-radius:6px; }
            select { width:100%; padding:8px 12px; border-radius:6px; border:1px solid #ccc; }
            .result { margin-top:16px; padding:12px; background:#eef7ff; border-left:4px solid #3b82f6; border-radius:6px; }
            label { font-weight:600; display:block; margin-bottom:6px; }
            .row { display:flex; gap:8px; }
            .row > * { flex:1; }
        </style>
    </head>

    <body>
        <div class="container">
            <h1>Calcolatrice</h1>
            <form action="index.php" method="post">
                <label for="a">Numero A</label>
                <input type="number" id="a" name="a" required>

                <label for="b">Numero B</label>
                <input type="number" id="b" name="b" required>

                <label for="op">Operazione</label>
                <select id="op" name="op">
                    <option value="somma">Somma</option>
                    <option value="sottrazione">Sottrazione</option>
                    <option value="moltiplicazione">Moltiplicazione</option>
                    <option value="divisione">Divisione</option>
                </select>

                </br>
                <input type="submit" name="btn" value="Calcola">
            </form>
            <div class="result">
                <strong>Risultato:</strong>
                <div>
                    <?php echo($result); ?>
                </div>
            </div>
        </div>
    </body>
</html>