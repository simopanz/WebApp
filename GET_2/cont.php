<?php
// controllo.php
// Versione senza funzioni: legge utenti.json, costruisce un array login->record (psw o array dettagli),
// verifica login/psw passati via GET e stampa i dati con Bootstrap.

// Prendi i parametri GET
$login = isset($_GET['login']) ? trim($_GET['login']) : '';
$psw   = isset($_GET['psw'])   ? $_GET['psw'] : '';

// Percorso del file JSON (stesso folder)
$path = "utenti.json";

// Controllo file
if (!file_exists($path)) {
    // render HTML minimo con errore se non esiste il file
    ?>
    <!doctype html>
    <html lang="it">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Errore - utenti.json</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body class="bg-light">
      <div class="container py-5">
        <div class="alert alert-danger">Errore: il file <strong>utenti.json</strong> non esiste.</div>
        <a href="index.html" class="btn btn-primary">Torna al login</a>
      </div>
    </body>
    </html>
    <?php
    exit;
}

// Leggi il file
$json = file_get_contents($path);
if ($json === false) {
    ?>
    <!doctype html>
    <html lang="it">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Errore lettura</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body class="bg-light">
      <div class="container py-5">
        <div class="alert alert-danger">Errore: impossibile leggere <strong>utenti.json</strong>.</div>
        <a href="index.html" class="btn btn-primary">Torna al login</a>
      </div>
    </body>
    </html>
    <?php
    exit;
}

// Decodifica JSON in array associativo
$dati = json_decode($json, true);
if ($dati === null && json_last_error() !== JSON_ERROR_NONE) {
    $msg = json_last_error_msg();
    ?>
    <!doctype html>
    <html lang="it">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Errore JSON</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body class="bg-light">
      <div class="container py-5">
        <div class="alert alert-danger">Errore: JSON non valido in <strong>utenti.json</strong> (<?php echo htmlspecialchars($msg, ENT_QUOTES, 'UTF-8'); ?>).</div>
        <a href="index.html" class="btn btn-primary">Torna al login</a>
      </div>
    </body>
    </html>
    <?php
    exit;
}

// Costruisci array $utenti dove chiave = login e valore = psw o array dettagli
$utenti = array();

// Se il JSON è già una mappa login => record
if (is_array($dati)) {
    foreach ($dati as $valore) {
        // Se l'elemento è array e ha coppie k=>v del tipo { "mario": "pwd" } o { "mario": {...} }
        if (is_array($valore)) {
            foreach ($valore as $k => $v) {
                $utenti[$k] = $v;
            }
        } else {
            // se il JSON è una stringa o altro (poco probabile) non facciamo nulla
        }
    }

    // Caso alternativo: il JSON potrebbe essere una mappa top-level login => record (non in array)
    // Esempio: { "mario": {"psw":"123", "nome":"Mario",...}, "luigi":"pwd2" }
    // Riconosciamo questo formato controllando se le chiavi non sono numeriche e i valori non sono array di array
    $allKeysAreStrings = true;
    foreach ($dati as $ktest => $vtest) {
        if (is_int($ktest)) { $allKeysAreStrings = false; break; }
    }
    if ($allKeysAreStrings) {
        // Sostituiamo eventuale costruzione precedente con questa mappa diretta
        $utenti = $dati;
    }
}

// Verifica parametri forniti
$authOk = false;
$foundRecord = null;
$error = '';

if ($login === '' || $psw === '') {
    $error = "Devi inserire login e password.";
} else {
    if (!isset($utenti[$login])) {
        $error = "Credenziali Errate.";
    } else {
        $record = $utenti[$login];
        // Se record è stringa considerala come password
        if (is_string($record)) {
            if ($record === $psw) {
                $authOk = true;
                $foundRecord = array(
                    'login' => $login,
                    'psw'   => $psw,
                    'nome'  => '',
                    'cognome' => '',
                    'email' => ''
                );
            } else {
                $error = "Credenziali Errate.";
            }
        } elseif (is_array($record)) {
            // Proviamo a trovare il campo password nel record con nomi comuni
            $storedPsw = null;
            if (isset($record['psw'])) $storedPsw = $record['psw'];
            elseif (isset($record['password'])) $storedPsw = $record['password'];
            elseif (isset($record['pwd'])) $storedPsw = $record['pwd'];

            if ($storedPsw !== null && $storedPsw === $psw) {
                $authOk = true;
                $foundRecord = array(
                    'login' => $login,
                    'psw'   => $psw,
                    'nome'  => isset($record['nome']) ? $record['nome'] : (isset($record['name']) ? $record['name'] : ''),
                    'cognome' => isset($record['cognome']) ? $record['cognome'] : (isset($record['surname']) ? $record['surname'] : ''),
                    'email' => isset($record['email']) ? $record['email'] : ''
                );
            } else {
                $error = "Credenziali Errate.";
            }
        } else {
            $error = "Formato record utente non riconosciuto.";
        }
    }
}

// OUTPUT HTML con Bootstrap
?>
<!doctype html>
<html lang="it">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Controllo Credenziali</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-lg-8 col-md-10">
        <div class="card shadow-sm">
          <div class="card-body">
            <h2 class="h5 mb-3">Risultato Login</h2>

            <?php if ($error !== ''): ?>
              <div class="alert alert-danger" role="alert">
                <?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?>
              </div>
              <a href="index.html" class="btn btn-outline-primary">Torna al login</a>

            <?php elseif ($authOk && $foundRecord !== null): ?>
              <div class="alert alert-success">Utente Loggato</div>

              <div class="table-responsive">
                <table class="table table-bordered">
                  <tbody>
                    <tr>
                      <th style="width:25%;">login</th>
                      <td><?php echo htmlspecialchars($foundRecord['login'], ENT_QUOTES, 'UTF-8'); ?></td>
                    </tr>
                    <tr>
                      <th>password</th>
                      <td><?php echo htmlspecialchars($foundRecord['psw'], ENT_QUOTES, 'UTF-8'); ?></td>
                    </tr>
                    <tr>
                      <th>nome</th>
                      <td><?php echo htmlspecialchars($foundRecord['nome'], ENT_QUOTES, 'UTF-8'); ?></td>
                    </tr>
                    <tr>
                      <th>cognome</th>
                      <td><?php echo htmlspecialchars($foundRecord['cognome'], ENT_QUOTES, 'UTF-8'); ?></td>
                    </tr>
                    <tr>
                      <th>email</th>
                      <td><?php echo htmlspecialchars($foundRecord['email'], ENT_QUOTES, 'UTF-8'); ?></td>
                    </tr>
                  </tbody>
                </table>
              </div>

              <a href="index.html" class="btn btn-outline-secondary">Effettua un altro login</a>

            <?php else: ?>
              <div class="alert alert-warning">Stato non determinato.</div>
            <?php endif; ?>

          </div>
        </div>
        <p class="text-muted small mt-3">Nota: l'esercitazione usa GET per trasmettere le credenziali; in un contesto reale usare POST + HTTPS e password hashed.</p>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>