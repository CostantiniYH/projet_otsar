<?php
require_once __DIR__ . '/../backend/db_connect.php';
require_once __DIR__ . '/../class/image.php';
require_once __DIR__ . '/../class/upload.php';

    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        header('location: ' . BASE_URL . 'add_image.php?erreur=Accès interdit !');
        exit();
    }

$upload = new Upload($_FILES['image']);
if ($upload->validate()) {
    $uploadDir = '' . BASE_URL . 'uploads/';
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

$titre = $_POST['titre'];
$categories = $_POST['categorie'];
var_dump(
    $destination,
    $categories,
    $titre
);

$pdo = connect();

$existingImage = findBy2($pdo, 't_images',  'chemin', $destination);
    if ($existingImage) {
        header('location: ' . BASE_URL . 'add_image.php?message=L\'image a déjà été ajoutée !');
        exit();
    }

$categoryExists = findBy2($pdo, 't_categories', 'id', $categories);
    if (!$categoryExists) {
        header('location: ' . BASE_URL . 'add_image.php?message=La catégorie sélectionnée n\'existe pas.');
        exit();
    }

$data = [
    'chemin' => $destination,
    'nom' => $titre,
    'id_categorie' => $categories
];

var_dump($data) ; 

if (insert($pdo,'t_images',$data)) { 
    header('location: ' . BASE_URL . 'add_image.php?success=Image ajoutée avec succès !');
    exit();
    } else {
        header('location: ' . BASE_URL . 'add_image.php?erreur=Erreur lors de l\'ajout de l\'image !');    
        exit();;
    }
?>