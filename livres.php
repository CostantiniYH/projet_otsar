<?php
require_once __DIR__ . '/backend/db_connect.php';
require_once __DIR__ . '/controllers/session.php';
require_once __DIR__ . '/components/header.php';
require_once __DIR__ . '/class/navbar.php';
require_once __DIR__ . '/class/carousel.php';

$pdo = connect();
$livres = getAll ($pdo, 't_livres');
$id = $_GET['id'] ?? null;

$navbar = new Navbar();
$navbar->AddItem(' אוצר','index.php', 'left', '', 'bi bi-book-half rounded-5 text-white" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip-left" title="אוצר הספרים');
$navbar->AddItem('','index.php','center', '', 'bi bi-house-fill" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip" title="Accueil');

if (isLoggedIn()) {
    $navbar->AddItem('Livres','livres.php','dropdown', true, 'bi bi-book" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip" title="Livres');
    $navbar->AddItem('תנ"ך','0_tanak.php','dropdown');
    $navbar->AddItem('גמרא','1_talmud.php','dropdown');
    $navbar->AddItem('הלכה', '2_halaka.php', 'dropdown');
    $navbar->AddItem('מוסר', '3_mousar.php', 'dropdown');    
    $navbar->AddItem('', 'Admin/dashboard.php', 'center', '', 'bi bi-kanban" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip" title="Tableau de bord');
    $navbar->AddItem('', 'Admin/add_image.php', 'center', '', 'bi bi-image" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip" title="Ajouter une image');
    $navbar->AddItem('', 'Admin/add_categorie.php', 'center', '', 'bi bi-grid-3x3-gap-fill" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip" title="Gestion des catégories');
    $navbar->AddItem('', 'Admin/add_livre.php', 'center', '', 'bi bi-book-fill" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip" title="Ajouter un livre');
    $navbar->AddItem('Déconnexion', 'javascript:location.replace("logout.php")', 'right');
} else {
    $navbar->AddItem('תורה', '0-1_torah.php', 'dropdown');
    $navbar->AddItem('נך', '0-2_nak.php', 'dropdown');
    $navbar->AddItem('תלמוד בבלי', '1-1_babli.php', 'dropdown');
    $navbar->AddItem('תלמוד ירושלמי', '1-2_yerouchalmi.php', 'dropdown');
    $navbar->AddItem('','livres.php','center', true, 'bi bi-book" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip" title="Livres');
    $navbar->AddItem('תנ"ך','0_tanak.php','center');
    $navbar->AddItem('גמרא','1_talmud.php','center');
    $navbar->AddItem('הלכה', '2_halaka.php', 'center');
    $navbar->AddItem('מוסר', '3_mousar.php', 'center');
    $navbar->AddItem('','Compte/login.php','right', '', 'bi bi-person-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip-right" title="Connexion');
    $navbar->AddItem('Inscription','Compte/register.php', 'right');
    }

$navbar->render() ;
?>

<div class="container mb-5 mt-5">
<?php if (isset($_GET['erreur'])): ?>
        <div class="alert alert-danger alert-dismissible fade show" data-bs-dismiss="3000" role="alert">
            <?= htmlspecialchars($_GET['erreur']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <?php if (isset($_GET['message'])): ?>
        <div class="alert alert-warning alert-dismissible fade show" data-bs-dismiss="3000" role="alert">
            <?= htmlspecialchars($_GET['message']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success alert-dismissible fade show" data-bs-dismiss="3000" role="alert">
            <?= htmlspecialchars($_GET['success']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
<?php  $titre = findBy2 ($pdo, 't_livres', 'id_categorie', $id); ?>
    <h1 class="mb-5 shadow rounded-4 border-start border-end border-2 border-success"> 
        <?php
            if (!empty($_GET['id'])) {
                    echo 'Produits ' . htmlspecialchars($titre['nom']);
                   // echo ' (ID: ' . htmlspecialchars($titre['id']) . ')';
            } else {
                echo 'Tous les livres';
            }
            ?></h1>
     
    <div class="row gy-5 text-center">
        <?php 
            if (!empty($_GET['id'])) {
                $id = $_GET['id'];
                $livreById = findBy2 ($pdo, 't_livres', 'id_categorie', $id); 

                foreach ($livreById as $row => $value) {
                ?>
                    <div class="col-md-4" data-aos="fade-up" data-aos-duration="2000">
                        <?php require __DIR__ . '/components/card_livre.php'; ?> </br>
                    </div>
                <?php 
                }
            } else {

                foreach ($livres as $row => $value) {
                ?>
                    <div class="col-md-4" data-aos="fade-up" data-aos-duration="2000" data-bs-toggle="tooltip" data-bs-placement="top" title="<?= $value['nom'] ?>">
                        <?php require __DIR__ . '/components/card_livre.php'; ?> </br>
                    </div>
                <?php 
                }
            }
        ?>
    </div>   
</div>
<?php
require_once __DIR__ . '/components/footer.php';
?>