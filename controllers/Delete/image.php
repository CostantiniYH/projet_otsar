<?php
require_once __DIR__ . '/../../controllers/session.php';

require_login();
if (!isAdmin()) {
    $_SESSION['error'] = "Accès refusé. Vous n'avez pas les droits nécessaires.";
    header('Location: ' . BASE_URL . 'index.php');
    exit();
}
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);
    $pdo = connect();

    $image = findBy($pdo, 't_images', 'id', $id);
    if ($image) {
        $deleted = delete($pdo, 't_images', 'id', $id);
        if ($deleted) {
            header('Location: ' . BASE_URL . 'Admin/dashboard.php?success=Image supprimée avec succès');
            exit();
        } else {
            header('Location: ' . BASE_URL . 'Admin/dashboard.php?error=Erreur lors de la suppression de la catégorie');
            exit();
        }
    } else {
        header('Location: ' . BASE_URL . 'Admin/dashboard.php?error=Image non trouvée');
        exit();
    }
} else {
    header('Location: ' . BASE_URL . 'Admin/dashboard.php?error=ID de l\'image invalide');
    exit();
}