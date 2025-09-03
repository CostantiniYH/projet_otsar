<?php
require_once __DIR__ . '/../../backend/db_connect.php';
require_once __DIR__ . '/../../controllers/session.php';
require_once __DIR__ . '/../../class/image.php';
require_once __DIR__ . '/../../class/upload.php';

    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        header('location: ' . BASE_URL . 'Form/Create-Update/image.php?erreur=Accès interdit !');
        exit();
    }

$nom = $_POST['titre'] ?? '';
$auteur = $_POST['auteur'] ?? '';

$upload = new Upload($_FILES['image']);
if ($upload->validate()) {
    $uploadDir = '/uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true); // Crée le dossier avec les bonnes permissions
    }
    //if (!file_exists($_FILES['image']['tmp_name'])) {
      //  die("Erreur : le fichier temporaire n'existe pas.");
    //}
    $destination = $uploadDir . basename($_FILES['image']["name"]);
    if ($upload->moveTo($destination)) {
        echo "Fichier uploadé avec succès ! <br>";
        echo "Chemin du fichier : " . $upload->getFilePath();
    } else {
        echo "Erreur lors du déplacement du fichier : " . implode(', ', $upload->getError());
    }
} else {
    echo "Erreur de validation : " . implode(', ', $upload->getError());
} 

$c = $_POST['categorie'] ?? null;
$s_c = $_POST['s_categorie'] ?? null;
$s_s_c = $_POST['s_s_categorie'] ?? null;
$s_s_s_c = $_POST['s_s_s_categorie'] ?? null;

$description = $_POST['description'] ?? null;

$pdo = connect();

$livreExistant = findBy($pdo, 't_livres',  'titre', $nom);
if ($livreExistant) {
    header('location: ' . BASE_URL . 'Form/Create-Update/livre.php?message=Le livre a déjà été ajouté !');
    exit();
}

if ($c == 0 && $s_c == 0 && $s_s_c == 0 && $s_s_s_c == 0) {
    header('location: ' . BASE_URL . 'Form/Create-Update/livre.php?message=Veuillez sélectionner au moins une catégorie.');
    exit();
}

$data = [
    'titre' => $nom,
    'auteur' => $auteur,
    'description' => $description,
    'id_categorie' => $c,
    'id_s_categorie' => $s_c,
    'id_s_s_categorie' => $s_s_c,
    'id_s_s_s_categorie' => $s_s_s_c,
    'image' => $destination
];

//var_dump($data);
//exit();

if (insert($pdo, 't_livres', $data)) { 
    header('location: ' . BASE_URL . 'Form/Create-Update/livre.php?success=Livre ajouté avec succès !');
} else {
    header('location: ' . BASE_URL . 'Form/Create-Update/livre.php?erreur=Erreur lors de l\'ajout du livre : ' . implode(', ', $upload->getError()) . '');
    exit();
}
