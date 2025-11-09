<?php
require_once 'auth.php';
require_once 'products.php';
require_once 'cart.php';
require_once 'order.php';

$action = $_GET['action'] ?? 'home';
$msg = $_GET['msg'] ?? null;

function render_header() {
    $user = current_user();
    echo "<div style='padding:10px;background:#eee'>";
    echo "<a href='index.php'>Home</a> | ";
    echo "<a href='index.php?action=products'>Prodotti</a> | ";
    echo "<a href='index.php?action=cart'>Carrello</a> | ";
    if ($user) {
        echo "Ciao " . htmlspecialchars($user['username']) . " (" . htmlspecialchars($user['role']) . ") | ";
        echo "<a href='index.php?action=logout'>Logout</a>";
    } else {
        echo "<a href='index.php?action=login'>Login</a> | <a href='index.php?action=register'>Registrati</a>";
    }
    echo "</div>";
}

ob_start();

switch ($action) {
    case 'home':
        render_header();
        echo "<h1>Benvenuto nello store</h1>";
        break;

    case 'register':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once __DIR__ . '/auth.php';
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            $role = ($_POST['role'] ?? 'user') === 'gestore' ? 'gestore' : 'user';
            $res = register_user($username, $password, $role);
            echo $res['message'];
            echo "<br><a href='index.php?action=login'>Vai al login</a>";
            break;
        }
        render_header();
        echo "<h2>Registrazione</h2>";
        echo "<form method='post' action='index.php?action=register'>";
        echo "Username: <input name='username' required><br>";
        echo "Password: <input type='password' name='password' required><br>";
        echo "Ruolo: <select name='role'><option value='user'>Utente</option><option value='gestore'>Gestore</option></select><br>";
        echo "<button>Registrati</button>";
        echo "</form>";
        break;

    case 'login':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            $res = login_user($username, $password);
            if ($res['success']) header('Location: index.php');
            else echo $res['message'];
            break;
        }
        render_header();
        echo "<h2>Login</h2>";
        echo "<form method='post' action='index.php?action=login'>";
        echo "Username: <input name='username' required><br>";
        echo "Password: <input type='password' name='password' required><br>";
        echo "<button>Login</button>";
        echo "</form>";
        break;

    case 'logout':
        logout_user();
        header('Location: index.php');
        break;

    case 'products':
        render_header();
        echo "<h2>Prodotti</h2>";
        $list = get_all_products();
        echo "<ul>";
        foreach ($list as $p) {
            echo "<li>" . htmlspecialchars($p['name']) . " - €" . number_format($p['price'],2) . " - Disponibili: " . intval($p['stock']) . " ";
            echo "<a href='index.php?action=add_to_cart&id=".intval($p['id'])."'>Aggiungi al carrello</a> ";
            echo "</li>";
        }
        echo "</ul>";
        // link gestione gestore
        $user = current_user();
        if ($user && $user['role'] === 'gestore') {
            echo "<a href='index.php?action=admin_products'>Gestione prodotti</a>";
        }
        break;

    case 'add_to_cart':
        $id = intval($_GET['id'] ?? 0);
        $res = add_to_cart($id, 1);
        header('Location: index.php?action=cart');
        break;

    case 'cart':
        render_header();
        echo "<h2>Carrello</h2>";
        $info = cart_items_detailed();
        if (empty($info['items'])) echo "Carrello vuoto.";
        else {
            echo "<ul>";
            foreach ($info['items'] as $it) {
                echo "<li>" . htmlspecialchars($it['product']['name']) . " x " . intval($it['quantity']) . " = €".number_format($it['line_total'],2)." <a href='index.php?action=remove_from_cart&id=".intval($it['product']['id'])."'>Rimuovi</a></li>";
            }
            echo "</ul>";
            echo "Totale: €" . number_format($info['total'],2);
            echo "<form method='post' action='index.php?action=checkout'><button>Vai al pagamento</button></form>";
        }
        break;

    case 'remove_from_cart':
        $id = intval($_GET['id'] ?? 0);
        remove_from_cart($id);
        header('Location: index.php?action=cart');
        break;

    case 'checkout':
        // checkout via POST per sicurezza; qui semplificato
        $res = place_order();
        render_header();
        echo $res['message'] ?? 'Errore';
        if (!empty($res['order'])) {
            echo "<pre>".htmlspecialchars(json_encode($res['order'], JSON_PRETTY_PRINT))."</pre>";
        }
        break;

    case 'admin_products':
        // semplice gestione prodotti per gestore
        require_role('gestore');
        render_header();
        echo "<h2>Gestione prodotti</h2>";
        $list = get_all_products();
        echo "<a href='index.php?action=admin_add_product'>Aggiungi prodotto</a>";
        echo "<ul>";
        foreach ($list as $p) {
            echo "<li>".htmlspecialchars($p['name'])." - €".number_format($p['price'],2)." [<a href='index.php?action=admin_edit_product&id=".intval($p['id'])."'>modifica</a>] [<a href='index.php?action=admin_delete_product&id=".intval($p['id'])."' onclick=\"return confirm('Eliminare?')\">elimina</a>]</li>";
        }
        echo "</ul>";
        break;

    case 'admin_add_product':
        require_role('gestore');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = ['name'=>$_POST['name'],'description'=>$_POST['description'],'price'=>$_POST['price'],'stock'=>$_POST['stock']];
            add_product($data);
            header('Location: index.php?action=admin_products');
            break;
        }
        render_header();
        echo "<h2>Aggiungi prodotto</h2>";
        echo "<form method='post' action='index.php?action=admin_add_product'>";
        echo "Nome: <input name='name' required><br>";
        echo "Descrizione: <input name='description'><br>";
        echo "Prezzo: <input name='price' required type='number' step='0.01'><br>";
        echo "Stock: <input name='stock' required type='number'><br>";
        echo "<button>Aggiungi</button>";
        echo "</form>";
        break;

    case 'admin_edit_product':
        require_role('gestore');
        $id = intval($_GET['id'] ?? 0);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = ['name'=>$_POST['name'],'description'=>$_POST['description'],'price'=>$_POST['price'],'stock'=>$_POST['stock']];
            update_product($id, $data);
            header('Location: index.php?action=admin_products');
            break;
        }
        $p = get_product($id);
        render_header();
        echo "<h2>Modifica prodotto</h2>";
        echo "<form method='post' action='index.php?action=admin_edit_product&id=".intval($id)."'>";
        echo "Nome: <input name='name' value='".htmlspecialchars($p['name'])."' required><br>";
        echo "Descrizione: <input name='description' value='".htmlspecialchars($p['description'])."'><br>";
        echo "Prezzo: <input name='price' value='".htmlspecialchars($p['price'])."' required type='number' step='0.01'><br>";
        echo "Stock: <input name='stock' value='".htmlspecialchars($p['stock'])."' required type='number'><br>";
        echo "<button>Salva</button>";
        echo "</form>";
        break;

    case 'admin_delete_product':
        require_role('gestore');
        $id = intval($_GET['id'] ?? 0);
        delete_product($id);
        header('Location: index.php?action=admin_products');
        break;

    default:
        render_header();
        echo "Azione non riconosciuta.";
}

$out = ob_get_clean();
?>

<!doctype html>
<html>
<head>
    <meta charset='utf-8'>
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>E-commerce</title>
</head>
<body>
    <?= $out ?>
</body>
</html>