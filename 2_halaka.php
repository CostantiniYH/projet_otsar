<?php
require_once __DIR__ . '/backend/db_connect.php';
require_once __DIR__ . '/controllers/session.php';
require_once __DIR__ . '/components/header.php';
require_once __DIR__ . '/class/navbar.php';
require_once __DIR__ . '/class/carousel.php';

require_login();


$navbar = new Navbar();
$navbar->AddItem(' אוצר','index.php', 'left', '', 'bi bi-book-half rounded-5 text-white" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip-left" title="אוצר הספרים');
$navbar->AddItem('','index.php','center', '', 'bi bi-house-fill" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip" title="Accueil');
$navbar->AddItem('תנ"ך','0_tanak.php','center');
$navbar->AddItem('גמרא','1_talmud.php','center');
$navbar->AddItem('הלכה', '2_halaka.php', 'center', true);
$navbar->AddItem('מוסר', '3_mousar.php', 'center');
if (isLoggedIn()) {
    $navbar->AddItem('', 'dashboard.php', 'center', '', 'bi bi-kanban" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip" title="Tableau de bord');
    $navbar->AddItem('', 'add_image.php', 'center', '', 'bi bi-image" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip" title="Ajouter une image');
    $navbar->AddItem('', 'add_categorie.php', 'center', true, 'bi bi-image" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip" title="Ajouter une image');
    $navbar->AddItem('Déconnexion', 'javascript:location.replace("logout.php")', 'right');
    } else {
    $navbar->AddItem('','login.php','right', '', 'bi bi-person-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip-right" title="Connexion');
    $navbar->AddItem('Inscription','register.php', 'right');
    }
$navbar->render() ;
?>
<div class="container">
<div class="container p-4 mt-3 mb-3">    
    <h1 class="shadow rounded-4 border border-bottom-0 border-3 border-primary"
     data-aos="fade-up" data-aos-duration="1500">הלכה</h1>    
    <div class="row">     
        <div class="col me-2 img-map img-gmara p-5" data-aos=" fade-up" data-aos-duration="1500" data-aos-delay="2500">
            <img src="./img\choulhan-arouk.png" class="card-img rounded-4 shadow" alt="הלכה" usemap="#map_5">
            <map name="map_5">
                <area shape="rect" coords="0, 0, 450,400" alt="chass-talmud" href="0-2_nak.php">
            </map>
        </div>
        <div class="col me-2 img-map img-gmara p-5" data-aos=" fade-up" data-aos-duration="1500" data-aos-delay="2500">
            <img src="./img\tour.png" class="card-img rounded-4 shadow" alt="הלכה" usemap="#map_5">
            <map name="map_5">
                <area shape="rect" coords="0, 0, 450,400" alt="chass-talmud" href="0-2_nak.php">
            </map>
        </div>
        <div class="col ms-2 img-map img-gmara p-5" data-aos=" fade-up" data-aos-duration="1500" data-aos-delay="2500">
            <img src="./img\michnei-torah.png" class="card-img rounded-4 shadow" alt="תורה" usemap="#map_6">
            <map name="map_6">
                <area shape="rect" coords="0, 0, 450,400" alt="mikraot-guedolot" href="0-1_torah.php">
            </map>
        </div>
    </div>
</div>
</div>
<?php
require_once __DIR__ . '/components/footer.php';
?>