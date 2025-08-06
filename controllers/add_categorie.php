<?php
require_once __DIR__ . '/../backend/db_connect.php';

    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        header('location: ' . BASE_URL . 'add_categorie.php?erreur=Accès interdit !');
        exit();
    }

$nom = $_POST['nom'];

$pdo = connect();


$categoryExists = findBy2($pdo, 't_categories', 'id', $nom);
    if ($categoryExists) {
        header('location: ' . BASE_URL . 'add_categorie.php?message=La catégorie sélectionnée existe déjà.');
        exit();
    }

$data = [
    'nom' => $nom
];

var_dump($data) ; 

if (insert($pdo,'t_categories',$data)) { 
    header('location: ' . BASE_URL . 'add_categorie.php?success=Catégorie ajoutée avec succès !');
    exit();
    } else {
        header('location: ' . BASE_URL . 'add_categorie.php?erreur=Erreur lors de l\'ajout de la catégorie !');    
        exit();;
    }
?>