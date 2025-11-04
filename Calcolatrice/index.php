<?php
    require_once 'functions/somma.php';
    require_once 'functions/sottrazione.php';
    require_once 'functions/moltiplicazione.php';
    require_once 'functions/divisione.php';

    $a = $_POST["a"] ?? 0;
    $b = $_POST["b"] ?? 0;
    $op = $_POST["op"] ?? '';

    switch ($op) {
        case 'Somma':
            $result = somma($a, $b);
            break;
        case 'Sottrazione':
            $result = sottrazione($a, $b);
            break;
        case 'Moltiplicazione':
            $result = moltiplicazione($a, $b);
            break;
        case 'Divisione':
            $division = divisione($a, $b);
            if ($division === null) {
                $result = 'Error';
            } else {
                $result = $division;
            }
            break;
        default:
            $result = '';
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
            .calcolatrice { max-width:480px; margin:40px auto; background:white; padding:20px; border-radius:8px; box-shadow:0 6px 20px rgba(0,0,0,0.06); }
            input { width:100%; padding:8px 10px; margin:6px 0 12px; border:1px solid #ddd; border-radius:6px; }
            .result { margin-top:16px; padding:12px; background:#eef7ff; border-left:4px solid #3b82f6; border-radius:6px; }
            label { font-weight:600; display:block; margin-bottom:6px; }
            .row { display:flex; gap:8px; }
            .row > * { flex:1; }
        </style>
    </head>

    <body>
        <div class="calcolatrice">
            <h1>Calcolatrice</h1>
            <form action="index.php" method="post">
                <label for="a">Numero A</label>
                <input type="number" id="a" name="a" required>

                <label for="b">Numero B</label>
                <input type="number" id="b" name="b" required>

                <h3>Operazione</h3>
                <input type="submit" name="op" value="Somma">
                <input type="submit" name="op" value="Sottrazione">
                <input type="submit" name="op" value="Moltiplicazione">
                <input type="submit" name="op" value="Divisione">
            </form>

            <div class="result">
                <strong>Risultato:</strong>
                <?php echo $result; ?>
            </div>
        </div>
    </body>
</html>