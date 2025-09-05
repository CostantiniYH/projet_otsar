<?php
require_once __DIR__ . '/backend/db_connect.php';
require_once __DIR__ . '/controllers/session.php';
require_once __DIR__ . '/components/header.php';
require_once __DIR__ . '/class/navbar.php';
require_once __DIR__ . '/class/carousel.php';

$pdo = connect();
$id = $_GET['id'] ?? null;

$navbar = new Navbar();
$navbar->AddItem(' אוצר','index.php', 'left', '', 'bi bi-book-half rounded-5 text-white" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip-left" title="אוצר הספרים');
$navbar->AddItem('','index.php','center', '', 'bi bi-house-fill" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip" title="Accueil');

if (isLoggedIn()) {
    $navbar->AddItem('תנ"ך','Torah/0_tanak.php','dropdown');    $navbar->AddItem('גמרא','Talmud/1_talmud.php','dropdown');
    $navbar->AddItem('הלכה', 'Halakha/2_halaka.php', 'dropdown');
    $navbar->AddItem('מוסר', 'Agada-moussar/3_mousar.php', 'dropdown');    
    $navbar->AddItem('', 'Admin/dashboard.php', 'center', '', 'bi bi-kanban" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip" title="Tableau de bord');
    $navbar->AddItem('', 'Form/Create-Update/image.php', 'center', '', 'bi bi-image" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip" title="Ajouter une image');
    $navbar->AddItem('', 'Form/Create-Update/categorie.php', 'center', '', 'bi bi-grid-3x3-gap-fill" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip" title="Gestion des catégories');
    $navbar->AddItem('', 'Form/Create-Update/livre.php', 'center', '', 'bi bi-book-fill" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip" title="Ajouter un livre');
    $navbar->AddItem('', 'javascript:location.replace("logout.php")', 'right', '', 'bi bi-door-open-fill rounded-5" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip-red" title="Déconnexion');
} else {
    $navbar->AddItem('תורה', 'Torah/0-1_torah.php', 'dropdown');
    $navbar->AddItem('נך', 'Torah/0-2_nak.php', 'dropdown');
    $navbar->AddItem('תלמוד בבלי', 'Talmud/1-1_babli.php', 'dropdown');
    $navbar->AddItem('תלמוד ירושלמי', 'Talmud/1-2_yerouchalmi.php', 'dropdown');
    $navbar->AddItem('','livres.php','center', true, 'bi bi-book" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip" title="Liste des livres');
    $navbar->AddItem('תנ"ך','Torah/0_tanak.php','center');
    $navbar->AddItem('גמרא','Talmud/1_talmud.php','center');
    $navbar->AddItem('הלכה', 'Halakha/2_halaka.php', 'center');
    $navbar->AddItem('מוסר', 'Agada-Moussar/3_mousar.php', 'center');
    $navbar->AddItem('','Form/Compte/login.php','right', '', 'bi bi-person-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip-right" title="Connexion');
    $navbar->AddItem('Inscription','Form/Compte/register.php', 'right');
}

$navbar->render() ;
?>

<div class="container mb-5 mt-5">
    <?php
        require_once __DIR__ . '/components/alerts.php';
    ?>
    
    <h1 class="mb-5 shadow rounded-4 border-start border-end border-2"> 
        <?php
            if (!empty($_GET['id'])) {
                $categorieLivre = findBy($pdo, 't_categories', 'id', $id);
                echo 'Livres ' . $categorieLivre[0]['nom'] . '';
            } else {
                echo 'Tous les livres';
            }
        ?>
    </h1>

    <div class="col-md-12">
        <p class="text-center">Sélectionnez une catégorie pour voir les livres associés.</p>
        <form action="<?= BASE_URL ?>livres.php" method="get" class="d-flex justify-content-center mb-4">
            <select name="id" id="id" class="form-select w-50">
                <option value="">Choisir une catégorie</option>
                <?php
                $categories = getAll($pdo, 't_categories');
                foreach ($categories as $categorie): ?>
                    <option value="<?= $categorie['id'] ?>"><?= $categorie['nom'] ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit" class="btn btn-primary ms-2">Voir les livres</button>
        </form>
    </div>

        
    <div class="row gy-5 text-center">
        <?php 
        if (!empty($_GET['id'])) {
            $livreById = getLivreByCategorieId($pdo, $id); 
            
            foreach ($livreById as $row => $value) {
                ?>
                <div class="col-md-4" data-aos="fade-up" data-aos-duration="2000">
                    <?php require __DIR__ . '/components/card_livre.php'; ?> </br>
                </div>
                <?php 
            }
        } else {
            $livres = getLivre ($pdo);                
            foreach ($livres as $row => $value) {
                ?>
                <div class="col-md-4" data-aos="fade-up" data-aos-duration="2000" data-bs-toggle="tooltip" 
                data-bs-placement="top" title="<?= $value['titre'] ?>">
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