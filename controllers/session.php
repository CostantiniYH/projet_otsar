<?php
require_once __DIR__ . '/../backend/db_connect.php';
if (basename(__FILE__) === basename($_SERVER['SCRIPT_FILENAME'])) {
    exit('Accès direct interdit.');
}

session_start();

function isLoggedIn() {
    return isset($_SESSION['user']);
}


function isAdmin() {
    return isLoggedIn() && ($_SESSION['user']['role'] ?? '') === 'admin';
}

function loginUser($user) {
    session_regenerate_id(true);
    $_SESSION['user'] = [
        'id' => $user['id'],
        'nom' => $user['nom'],
        'prenom' => $user['prenom'],
        'mail' => $user['mail'],
        'role' => $user['role'],
        'created_at' => $user['created_at'],
    ];
}
function getUserSession() {
    return isLoggedIn() ? $_SESSION['user'] : null;
}

function require_login() {
    if (!isLoggedIn()) {
        header('Location: ' . BASE_URL . 'Compte/login.php?message=Vous devez vous connecter !');
        exit();
    }
}


function logoutUser() {
    session_destroy();
    setcookie(session_name(), '', time() - 3600, '/');
    header('Location: ' . BASE_URL . 'Compte/login.php?success=Déconnexion réussi !');
    exit();
}
?>
