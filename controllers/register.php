<?php
require_once __DIR__ . '/../backend/db_connect.php';
require_once __DIR__ . '/../controllers/session.php';
require_once __DIR__ . '/../class/user.php';

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header('location: ' . BASE_URL . 'Compte/register.php?message=Accès interdit !');
    exit();
}

if (empty($_POST['nom']) || empty($_POST['prenom']) || empty($_POST['email']) || empty($_POST['password'])
    || empty($_POST['password2'])) {    
    header('location: ' . BASE_URL . 'Compte/register.php?message=Tous les champs sont requis !');
    exit();
}

if ($_POST['password'] !== $_POST['password2']) {
    header('location: ' . BASE_URL . 'Compte/register.php?message=Les mots de passe ne correspondent pas !');
    exit();
}

$user = new User($_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['password']);

$nom = $user->getNom();
$prenom = $user->getPrenom();
$email = $user->getEmail();
$password = $user->getPassword();
$error = $user->getError();

if (!empty($error)) {
    header('Location: ' . BASE_URL . 'Compte/register.php?erreur=' . urlencode($error[0]));
    exit();
}

$pdo = connect();

$existingUser = findBy($pdo, 't_users',  'mail', $email);

if ($existingUser) {
    header('location: ' . BASE_URL . 'Compte/register.php?message=Email déjà utilisé !');
    exit();
}

if (insertUser($pdo,$nom,$prenom,$email,$password) == true) { 
    header('location: ' . BASE_URL . 'Admin/dashboard.php?success=Inscription réussie !');
    } else {
        header('location: ' . BASE_URL . 'Compte/register.php?erreur=' . $error[0] . 'Erreur lors de l\'inscription !');    
    exit();
}
?>