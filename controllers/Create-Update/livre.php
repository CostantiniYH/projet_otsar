<?php
require_once __DIR__ . '/../../controllers/session.php';
require_once __DIR__ . '/../../class/image.php';
require_once __DIR__ . '/../../class/upload.php';

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header('location: ' . BASE_URL . 'Form/Create-Update/image.php?erreur=Accès interdit !');
    exit();
}

$nom = htmlspecialchars($_POST['titre'] ?? '');
$auteur = htmlspecialchars($_POST['auteur'] ?? '');
$c = htmlspecialchars($_POST['categorie'] ?? '');
$s_c = htmlspecialchars($_POST['s_categorie'] ?? '');
$s_s_c = htmlspecialchars($_POST['s_scategorie'] ?? '');
$s_s_s_c = htmlspecialchars($_POST['s_s_s_categorie'] ?? '');
$description = htmlspecialchars($_POST['description']);

$pdo = connect();
$N_C = findBy($pdo, 't_categories', 'id', $c);
$nom_categorie = $N_C['nom'];

$upload = new Upload($_FILES['image']);

if ($upload->validate()) {
    $uploadDir = 'uploads/';
    $uploadPath = __DIR__ . '/../../uploads/';

    if (!is_dir($uploadPath)) {
        mkdir($uploadPath, 0777, true); // Crée le dossier avec les bonnes permissions
    }

     if (!is_dir($uploadPath) && !mkdir($uploadPath, 0775, true)) {
        header('Location: ' . BASE_URL . 'Form/Crud/categorie.php?erreur=Impossible de créer le dossier 
        uploads principal !');
        exit();
    }

    if (!is_writable($uploadPath)) {
        die("Erreur : le dossier uploads n'est pas inscriptible par PHP !");
    }

    $categorieClean = preg_replace('/[^a-zA-Z0-9_-]/', '_', $nom_categorie);
    $categoriePath = $uploadPath . $categorieClean . '/';
    
    if (!is_dir($categoriePath)) {
        mkdir($categoriePath, 0775, true); // Crée le dossier de la catégorie avec les bonnes permissions
    }
    
    if (!is_dir($categoriePath) && !mkdir($categoriePath, 0775, true)) {
        header('Location: ' . BASE_URL . 'Form/Crud/categorie.php?erreur=Impossible de créer le dossier ' . $categorieClean . '!');
        exit();
    }

    if (!file_exists($_FILES['image']['tmp_name'])) {
        die("Erreur : le fichier temporaire n'existe pas.");
    }

    $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
    $fileName = uniqid('img_') . '.' . $ext;

    $destination = $uploadPath . $categorieClean . '/' . $fileName;

    if ($upload->moveTo($destination)) {
        echo "Fichier uploadé avec succès ! <br>";
        echo "Chemin du fichier : " . $upload->getFilePath();
    } else {
        echo "Erreur lors du déplacement du fichier : " . implode(', ', $upload->getError());
    }
} else {
    echo "Erreur de validation : " . implode(', ', $upload->getError());
} 

$livreExistant = findBy($pdo, 't_livres',  'titre', $nom);

if ($livreExistant) {
    header('location: ' . BASE_URL . 'Form/Create-Update/livre.php?message=Le livre a déjà été ajouté !');
    exit();
}

if ($c == 0 && $s_c == 0 && $s_s_c == 0 && $s_s_s_c == 0) {
    header('location: ' . BASE_URL . 'Form/Create-Update/livre.php?message=Veuillez sélectionner au moins une catégorie.');
    exit();
}

$imageUrl = $uploadDir . $categorieClean . '/' . $fileName;

$data = [
    'titre' => $nom,
    'auteur' => $auteur,
    'description' => $description,
    'id_categorie' => $c,
    'id_s_categorie' => $s_c,
    'id_s_s_categorie' => $s_s_c,
    'id_s_s_s_categorie' => $s_s_s_c,
    'image' => $imageUrl
];

if (insert($pdo, 't_livres', $data)) { 
    header('location: ' . BASE_URL . 'Form/Create-Update/livre.php?success=Livre ajouté avec succès !');
} else {
    header('location: ' . BASE_URL . 'Form/Create-Update/livre.php?erreur=Erreur lors de l\'ajout du livre : ' . implode(', ', $upload->getError()) . '');
    exit();
}
?>