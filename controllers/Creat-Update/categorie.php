<?php
require_once __DIR__ . '/../../backend/db_connect.php';
require_once __DIR__ . '/../../controllers/session.php';

    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        header('location: ' . BASE_URL . 'Form/Create-Update/categorie.php?erreur=Accès interdit !');
        exit();
    }

$nom_c = $_POST['nom_categorie'] ?? '';
$nom_s_c = $_POST['nom_s_categorie'] ?? '';
$nom_s_s_c = $_POST['nom_s_s_categorie'] ?? '';
$nom_s_s_s_c = $_POST['nom_s_s_s_categorie'] ?? null;


$pdo = connect();


$categoryExists = [
    findBy2($pdo, 't_categories', 'nom', $nom_c),
    findBy2($pdo, 't_s_categories', 'nom', $nom_s_c),
    findBy2($pdo, 't_s_s_categories', 'nom', $nom_s_s_c),
    findBy2($pdo, 't_s_s_s_categories', 'nom', $nom_s_s_s_c)
];

    if (array_filter($categoryExists)) {
        header('location: ' . BASE_URL . 'Form/Create-Update/categorie.php?message=La catégorie existe déjà.');
        exit();
    }

$data_c = [
    'nom' => $nom_c
];
$data_s_c = [
    'nom' => $nom_s_c
];
$data_s_s_c = [
    'nom' => $nom_s_s_c
];
$data_s_s_s_c = [
    'nom' => $nom_s_s_s_c
];

//var_dump($data_c, $data_s_c, $data_s_s_c, $data_s_s_s_c);

$succes = false;

if (!empty($nom_c)) {
    $succes = insert($pdo, 't_categories', $data_c);
}
if (!empty($nom_s_c)) {
    $succes = insert($pdo, 't_s_categories', $data_s_c);
}
if (!empty($nom_s_s_c)) {
    $succes = insert($pdo, 't_s_s_categories', $data_s_s_c);
}
if (!empty($nom_s_s_s_c)) {
    $succes = insert($pdo, 't_s_s_s_categories', $data_s_s_s_c);
}


if ($succes) {
    header('location: ' . BASE_URL . 'Form/Create-Update/categorie.php?success=Catégorie ajoutée avec succès !');
    exit();
    } else {
        header('location: ' . BASE_URL . 'Form/Create-Update/categorie.php?erreur=Erreur lors de l\'ajout de la catégorie !');    
        exit();;
    }
?>