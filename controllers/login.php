<?php
require_once __DIR__ . '/../backend/db_connect.php';
require_once __DIR__ . '/../controllers/session.php';
require_once __DIR__ . '/../class/user.php';


if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die("Accès interdit !");
}

$email = $_POST['email'];
$password = $_POST['password'];

$pdo = connect();

$value = findBy($pdo, 't_users',  'mail', $email);



$user = $value[0]; // car findBy() retourne un tableau d'utilisateurs


if (User::verifyPassword($password, $user['passwd'])) {
    loginUser($user);    
    header('Location: ' . BASE_URL . 'Admin/dashboard.php?success=Connexion réussie !');
    exit();
} else {
    
    header('Location: ' . BASE_URL . 'Compte/login.php?erreur=Mot de passe incorrect !');
    exit();
}
?>
