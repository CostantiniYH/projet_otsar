<?php
require_once __DIR__ . '/backend/db_connect.php';
require_once __DIR__ . '/controllers/session.php';
require_once __DIR__ . '/components/header.php';
require_once __DIR__ . '/class/navbar.php';
require_once __DIR__ . '/class/carousel.php';

$navbar = new Navbar();
$navbar->AddItem(' אוצר','index.php', 'left', '', 'bi bi-book-half rounded-5 text-white" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip-left" title="אוצר הספרים');
$navbar->AddItem('','index.php','center', true, 'bi bi-house-fill" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip" title="Accueil');

if (isLoggedIn()) {
    $navbar->AddItem('Livres','livres.php','dropdown', '', 'bi bi-book" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip" title="Liste des livres');
    $navbar->AddItem('תנ"ך','Torah/0_tanak.php','dropdown');
    $navbar->AddItem('גמרא','Talmud/1_talmud.php','dropdown');
    $navbar->AddItem('הלכה', 'Halakha/2_halaka.php', 'dropdown');
    $navbar->AddItem('מוסר', 'Agada-moussar/3_mousar.php', 'dropdown');    
    $navbar->AddItem('', 'Admin/dashboard.php', 'center', '', 'bi bi-kanban" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip" title="Tableau de bord');
    $navbar->AddItem('', 'Admin/add_image.php', 'center', '', 'bi bi-image" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip" title="Ajouter une image');
    $navbar->AddItem('', 'Admin/add_categorie.php', 'center', '', 'bi bi-grid-3x3-gap-fill" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip" title="Gestion des catégories');
    $navbar->AddItem('', 'Admin/add_livre.php', 'center', '', 'bi bi-book-fill" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip" title="Ajouter un livre');
    $navbar->AddItem('', 'javascript:location.replace("logout.php")', 'right', '', 'bi bi-door-open-fill rounded-5" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip-red" title="Déconnexion');
} else {
    $navbar->AddItem('תורה', '0-1_torah.php', 'dropdown');
    $navbar->AddItem('נך', '0-2_nak.php', 'dropdown');
    $navbar->AddItem('תלמוד בבלי', '1-1_babli.php', 'dropdown');
    $navbar->AddItem('תלמוד ירושלמי', '1-2_yerouchalmi.php', 'dropdown');
    $navbar->AddItem('','livres.php','center', '', 'bi bi-book" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip" title="Liste des livres');
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


    <h1 class="mb-5 shadow rounded-bottom rounded-4 border border-bottom-0 border-3 border-warning"
     data-aos="fade-down" data-aos-duration="1500" data-aos-delay="1000">Bienvenue dans le אוצר הספרים</h1>
    <div class="carousel col-md-12 mb-5 rounded-4 shadow"
     data-aos="fade-up" data-aos-duration="1500" data-aos-delay="1500">
        <?php
            $carousel = new Carousel();
            $a = [
                ['link' =>  '' . BASE_URL . 'uploads/parchemin_3.jpg', 'text' => 'תורה'],
                ['link' =>  '' . BASE_URL . 'uploads/guemara.jpg', 'text' => 'גמרא'],
                ['link' =>  '' . BASE_URL . 'uploads/michnei-torah.jpg', 'text' => 'הלכה'],
                ['link' =>  '' . BASE_URL . 'uploads/portrait-betyossef.jpg', 'text' => 'מרן רבי יוסף קארו'],
                ['link' => '' . BASE_URL . 'uploads/ain-yaacov.jpg', 'text' => 'מוסר'],
                ['link' => '' . BASE_URL . 'uploads/smousar.jpg', 'text' => 'מוסר'],
                ['link' => '' . BASE_URL . 'uploads/chass-vilna', 'text' => 'גמרא'],
                ['link' => '' . BASE_URL . 'uploads/yerouchalmi.jpg', 'text' => 'גמרא'],
                ['link' => '' . BASE_URL . 'uploads/choulhan-arouk.jpg', 'text' => 'הלכה']
            ];      
            
            $carousel->Read($a, 1);
        ?>
    </div> 
    <div class="container">
        <div class="row">
            <div class="col-md-4  mb-5 img-map img-index"  data-aos="flip-right" data-aos-duration="1500" data-aos-delay="500">
                <img src="./uploads/tanak.jpg" class="card-img rounded-4 shadow" alt="מקראות גדולות" usemap="#tanakmap">
                <map name="tanakmap">
                <area shape="rect" coords="0, 0, 350,250" alt="mikraot-guedolot" href="Torah/0_tanak.php">
                </map>
            </div>
            <div class="col-md-4 mb-5 img-map img-index " data-aos="flip-right" data-aos-duration="1500" data-aos-delay="500">
                <img src="./uploads/chass-vilna.jpg" class="card-img rounded-4 shadow" alt="שס" usemap="#talmudmap">
                <map name="talmudmap">
                <area shape="rect" coords="0,0, 350,250" alt="chass-talmud" href="Talmud/1_talmud.php">
                </map>
            </div>
            <div class="col-md-4 mb-5 img-map img-index" data-aos="flip-right" data-aos-duration="1500" data-aos-delay="500">
                <img src="./uploads/choulhan-arouk.jpg" class="card-img rounded-4 shadow" alt="הלכה" usemap="#halakamap">
                <map name="halakamap">
                <area shape="rect" coords="0,0, 350,250" alt="halaka" href="Halakha/2_halaka.php">
                </map>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mb-5 img-map"  data-aos="flip-down" data-aos-duration="1500" data-aos-delay="1000">
                <img src="./uploads/ain-yaacov.jpg" class="card-img rounded-4 shadow" alt="מוסר" usemap="#mousarmap">
                <map name="mousarmap">
                <area shape="rect" coords="0,0, 1200,250" alt="mousar" href="Agada-Moussar/3_mousar.php">
                </map>
            </div>
        </div>
    </div>   
</div>
<?php
require_once __DIR__ . '/components/footer.php';
?>