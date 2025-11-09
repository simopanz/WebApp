<?php
// auth.php
session_start();
require_once __DIR__ . '/utils/json_utils.php';

define('USERS_FILE', __DIR__ . '/data/users.json');

function find_user_by_username($username) {
    $users = read_json(USERS_FILE);
    foreach ($users as $u) {
        if ($u['username'] === $username) return $u;
    }
    return null;
}

function find_user_by_id($id) {
    $users = read_json(USERS_FILE);
    foreach ($users as $u) {
        if ($u['id'] == $id) return $u;
    }
    return null;
}

function register_user($username, $password, $role = 'user') {
    $users = read_json(USERS_FILE);
    // controllo username unico
    foreach ($users as $u) {
        if ($u['username'] === $username) return ['success' => false, 'message' => 'Username già utilizzato.'];
    }
    $id = 1;
    if (!empty($users)) $id = max(array_column($users, 'id')) + 1;
    $users[] = [
        'id' => $id,
        'username' => $username,
        'password' => password_hash($password, PASSWORD_DEFAULT),
        'role' => $role
    ];
    write_json(USERS_FILE, $users);
    return ['success' => true, 'message' => 'Registrazione avvenuta.'];
}

function login_user($username, $password) {
    $user = find_user_by_username($username);
    if (!$user) return ['success' => false, 'message' => 'Credenziali non valide.'];
    if (!password_verify($password, $user['password'])) return ['success' => false, 'message' => 'Credenziali non valide.'];
    // salvo user id e role in sessione
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['role'] = $user['role'];
    return ['success' => true, 'message' => 'Login effettuato.'];
}

function logout_user() {
    session_unset();
    session_destroy();
}

function current_user() {
    if (!isset($_SESSION['user_id'])) return null;
    return find_user_by_id($_SESSION['user_id']);
}

function require_login() {
    if (!isset($_SESSION['user_id'])) {
        header('Location: index.php?action=login&msg=login_required');
        exit;
    }
}

function require_role($role) {
    require_login();
    if (!isset($_SESSION['role']) || $_SESSION['role'] !== $role) {
        header('Location: index.php?msg=forbidden');
        exit;
    }
}
?>