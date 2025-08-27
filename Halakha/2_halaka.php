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
if (isLoggedIn()) {
    $navbar->AddItem('תנ"ך','Torah/0_tanak.php','dropdown');    
    $navbar->AddItem('גמרא','Talmud/1_talmud.php','dropdown');
    $navbar->AddItem('הלכה', 'Halakha/2_halaka.php', 'dropdown', true);
    $navbar->AddItem('מוסר', 'Agada-moussar/3_mousar.php', 'dropdown');    
    $navbar->AddItem('', 'Admin/dashboard.php', 'center', '', 'bi bi-kanban" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip" title="Tableau de bord');
    $navbar->AddItem('', 'Admin/add_image.php', 'center', '', 'bi bi-image" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip" title="Ajouter une image');
    $navbar->AddItem('', 'Admin/add_categorie.php', 'center', '', 'bi bi-image" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip" title="Ajouter une image');
    $navbar->AddItem('', 'Admin/add_livre.php', 'center', '', 'bi bi-book-fill" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip" title="Ajouter un livre');
    $navbar->AddItem('', 'javascript:location.replace("logout.php")', 'right', '', 'bi bi-door-open-fill rounded-5" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip-red" title="Déconnexion');
} else {
    $navbar->AddItem('תורה', 'Torah/0-1_torah.php', 'dropdown');
    $navbar->AddItem('נך', 'Torah/0-2_nak.php', 'dropdown');
    $navbar->AddItem('תלמוד בבלי', 'Talmud/1-1_babli.php', 'dropdown');
    $navbar->AddItem('תלמוד ירושלמי', 'Talmud/1-2_yerouchalmi.php', 'dropdown');
    $navbar->AddItem('','livres.php','center', '', 'bi bi-book" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip" title="Liste des livres');
    $navbar->AddItem('תנ"ך','Torah/0_tanak.php','center');
    $navbar->AddItem('גמרא','Talmud/1_talmud.php','center');
    $navbar->AddItem('הלכה', 'Halakha/2_halaka.php', 'center', true);
    $navbar->AddItem('מוסר', 'Agada-Moussar/3_mousar.php', 'center');
    $navbar->AddItem('','Compte/login.php','right', '', 'bi bi-person-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip-right" title="Connexion');
    $navbar->AddItem('Inscription','register.php', 'right');
    }
$navbar->render() ;
?>
<div class="container">
<div class="container p-4 mt-3 mb-3">    
    <h1 class="shadow rounded-4 border border-bottom-0 border-3 border-primary"
     data-aos="fade-up" data-aos-duration="1500">הלכה</h1>    
    <div class="row">     
        <div class="col-md-2 img-map img-gmara mx-auto mt-5" data-aos=" fade-up" data-aos-duration="1500" data-aos-delay="2500">
            <img src="<?= BASE_URL ?>uploads\choulhan-arouk.jpg" class="card-img rounded-4 shadow" alt="הלכה" usemap="#map_5">
            <map name="map_5">
                <area shape="rect" coords="0, 0, 450,400" alt="chass-talmud" href="0-2_nak.php">
            </map>
        </div>
        <div class="col-md-2 img-map img-gmara mx-auto mt-5" data-aos=" fade-up" data-aos-duration="1500" data-aos-delay="2500">
            <img src="<?= BASE_URL ?>uploads\tour.jpg" class="card-img rounded-4 shadow" alt="הלכה" usemap="#map_5">
            <map name="map_5">
                <area shape="rect" coords="0, 0, 450,400" alt="chass-talmud" href="0-2_nak.php">
            </map>
        </div>
        <div class="col-md-2 img-map img-gmara mx-auto mt-5" data-aos=" fade-up" data-aos-duration="1500" data-aos-delay="2500">
            <img src="<?= BASE_URL ?>uploads\michnei-torah.jpg" class="card-img rounded-4 shadow" alt="תורה" usemap="#map_6">
            <map name="map_6">
                <area shape="rect" coords="0, 0, 450,400" alt="mikraot-guedolot" href="0-1_torah.php">
            </map>
        </div>
    </div>
</div>
</div>
<?php
require_once __DIR__ . '/../components/footer.php';
?>