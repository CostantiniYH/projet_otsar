<?php
require_once __DIR__ . '/backend/db_connect.php';
require_once __DIR__ . '/controllers/session_manage.php';
require_once __DIR__ . '/components/header.php';
require_once __DIR__ . '/class/navbar.php';
require_once __DIR__ . '/class/carousel.php';

$navbar = new Navbar();
$navbar->AddItem(' אוצר','index.php', 'left', '', 'bi bi-book-half rounded-5 text-white" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip-left" title="אוצר הספרים');
$navbar->AddItem('','index.php','center', '', 'bi bi-house-fill" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip" title="Accueil');
$navbar->AddItem('תנ"ך','0_tanak.php','center', true);
if (isLoggedIn()) {
    $navbar->AddItem('','livres.php','dropdown', '', 'bi bi-book" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip" title="Livres');
    $navbar->AddItem('גמרא','1_talmud.php','dropdown');
    $navbar->AddItem('הלכה', '2_halaka.php', 'dropdown');
    $navbar->AddItem('מוסר', '3_mousar.php', 'dropdown');
    $navbar->AddItem('', 'Admin/dashboard.php', 'center', '', 'bi bi-kanban" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip" title="Tableau de bord');
    $navbar->AddItem('', 'Admin/add_image.php', 'center', '', 'bi bi-image" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip" title="Ajouter une image');
    $navbar->AddItem('', 'Admin/add_categorie.php', 'center', '', 'bi bi-grid-3x3-gap-fill" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip" title="Gestion des catégories');
    $navbar->AddItem('', 'Admin/add_livre.php', 'center', '', 'bi bi-book-fill" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip" title="Ajouter un livre');
    $navbar->AddItem('Déconnexion', 'javascript:location.replace("logout.php")', 'right');
} else {
    $navbar->AddItem('גמרא','1_talmud.php','center');
    $navbar->AddItem('הלכה', '2_halaka.php', 'center');
    $navbar->AddItem('מוסר', '3_mousar.php', 'center');
    $navbar->AddItem('','Compte/login.php','right', '', 'bi bi-person-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip-right" title="Connexion');
    $navbar->AddItem('Inscription','register.php', 'right');
    }
$navbar->render() ;
?>

<?php
require_once __DIR__ . '/components/footer.php';
?>