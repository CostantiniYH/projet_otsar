<?php
require_once __DIR__ . '/../backend/db_connect.php';
require_once __DIR__ . '/../controllers/session.php';
require_once __DIR__ . '/../components/header.php';
require_once __DIR__ . '/../class/navbar.php';
require_once __DIR__ . '/../class/carousel.php';

//require_login();

$navbar = new Navbar();
$navbar->AddItem(' אוצר','index.php', 'left', '', 'bi bi-book-half rounded-5 text-white" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip-left" title="אוצר הספרים');
$navbar->AddItem('','index.php','center', '', 'bi bi-house-fill" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip" title="Accueil');
$navbar->AddItem('גמרא','1_talmud.php','center', true);
if (isLoggedIn()) {
    $navbar->AddItem('','livres.php','center', '', 'bi bi-book" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip" title="Liste des livres');
    $navbar->AddItem('תנ"ך','Torah/0_tanak.php','dropdown');    $navbar->AddItem('הלכה', 'Halakha/2_halaka.php', 'dropdown');
    $navbar->AddItem('מוסר', 'Agada-moussar/3_mousar.php', 'dropdown');    
    $navbar->AddItem('', 'Admin/dashboard.php', 'center', '', 'bi bi-kanban" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip" title="Tableau de bord');
    $navbar->AddItem('', 'Admin/add_image.php', 'center', '', 'bi bi-image" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip" title="Ajouter une image');
    $navbar->AddItem('', 'Admin/add_categorie.php', 'center', true, 'bi bi-image" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip" title="Ajouter une image');
    $navbar->AddItem('', 'Admin/add_livre.php', 'center', '', 'bi bi-book-fill" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip" title="Ajouter un livre');
    $navbar->AddItem('', 'javascript:location.replace("logout.php")', 'right', '', 'bi bi-door-open-fill rounded-5" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip-red" title="Déconnexion');
    } else {
    $navbar->AddItem('תנ"ך','0_tanak.php','center');
    $navbar->AddItem('הלכה', '2_halaka.php', 'center');
    $navbar->AddItem('מוסר', '3_mousar.php', 'center');
    $navbar->AddItem('','Compte/login.php','right', '', 'bi bi-person-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip-right" title="Connexion');
    $navbar->AddItem('Inscription','register.php', 'right');
    }
$navbar->render() ;
?>
<div class="container">

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

    <h1 class="mt-5 mb-5 shadow rounded-4 border border-bottom-0 border-3 border-success"
     data-aos="fade-up" data-aos-duration="1500">גמרא</h1>
    <div class="row mb-5">
        <div class="col me-5 img-map img-gmara" data-aos=" fade-up" data-aos-duration="1500" data-aos-delay="2500">
            <img src="<?= BASE_URL ?>uploads/chass-vilna.jpg" class="card-img rounded-4 shadow" alt="תלמוד בבלי" usemap="#map_3">
            <map name="map_3">
                <area shape="rect" coords="0, 0, 1500,400" alt="mikraot-guedolot" href="1-1_babli.php">
            </map>
        </div>
        <div class="col ms-5 img-map img-gmara" data-aos=" fade-up" data-aos-duration="1500" data-aos-delay="2500">
            <img src="<?= BASE_URL ?>uploads/yerouchalmi.jpg" class="card-img rounded-4 shadow" alt="תלמוד ירושלמי" usemap="#map_4">
            <map name="map_4">
                <area shape="rect" coords="0, 0, 1500,400" alt="chass-talmud" href="1-2_yerouchalmi.php">
            </map>
        </div>
    </div>
</div>

<?php
require_once __DIR__ . '/../components/footer.php';
?>