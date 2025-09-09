<?php
require_once __DIR__ . '/../../backend/db_connect.php';
require_once __DIR__ . '/../../controllers/session.php';
require_once __DIR__ . '/../../components/header.php';
require_once __DIR__ . '/../../class/navbar.php';

require_login();

$pdo = connect();

$categories = getAll($pdo, 't_categories');
//$images = getAll($pdo, 't_images');
$images = getAllInnerJoin($pdo, 't_images', 't_categories', 'nom AS nom_categorie', 't_images.id_categorie = t_categories.id');

$navbar = new Navbar();
$navbar->AddItem(' אוצר','index.php', 'left', '', 'bi bi-book-half rounded-5 text-white" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip-left" title="אוצר הספרים');
$navbar->AddItem('','index.php','center', '', 'bi bi-house-fill" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip" title="Accueil');
$navbar->AddItem('', 'Admin/dashboard.php', 'center', '', 'bi bi-kanban" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip" title="Tableau de bord');
$navbar->AddItem('', 'Form/Create-Update/categorie.php', 'center', '', 'bi bi-grid-3x3-gap-fill" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip" title="Gestion des catégories');
$navbar->AddItem('', 'Form/Create-Update/image.php', 'center', true, 'bi bi-image" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip" title="Ajouter une image');
$navbar->AddItem('', 'Form/Create-Update/livre.php', 'center', '', 'bi bi-book-fill" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip" title="Ajouter un livre');

$navbar->AddItem('תנ"ך','0_tanak.php','dropdown');
$navbar->AddItem('גמרא','1_talmud.php','dropdown');
$navbar->AddItem('הלכה', '2_halaka.php', 'dropdown');
$navbar->AddItem('', 'javascript:location.replace(BASE_URL + "logout.php")', 'right', '', 'bi bi-door-open-fill rounded-5" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip-red" title="Déconnexion');
$navbar->render() ;
?>

<div class="container p-3">
    <?php
        require_once __DIR__ . '/../../components/alerts.php';
    ?>

    <div class="row mt-4 mb-4 gap-4">
        <h3 class="text-center mb-4 p-3 rounded-4 shadow border border-bottom-0 border-3 border-warning">Ajouter une image et banque d'image</h3>
        <form action="<?= BASE_URL ?>controllers/Create-Update/image.php" method="post" class="col-md-5 shadow p-4 rounded-4" enctype="multipart/form-data">
            <h4 class="text-center">Image</h4>
            <div class="form-group">
                <label for="image" class="mb-2">Image</label>
                <input type="file" class="form-control" id="image" name="image" required>
            </div><br>
            <div class="form-group">
                <label for="titre" class="mb-2">Titre</label>
                <input type="text" class="form-control" id="titre" name="titre"
                placeholder="Entrer le nom de l'image" required>
            </div><br>        
            <div class="form-group">
                <label for="categorie" class="mb-2">Catégorie</label>
                <select class="form-select" id="categorie" name="categorie" required>
                    <option value="0">Choisir une catégorie</option>
                        <?php  foreach ($categories as $categorie): ?>
                            <option value="<?= $categorie['id'] ?>" required><?= $categorie['nom'] ?></option>
                        <?php endforeach; ?>
                </select>
            </div><br>
            <div class="form-group">
                <button type="submit" class="btn btn-primary" id="">Ajouter</button>
            </div>
        </form>
        <div class="col shadow rounded bg-custom">
            <h4 class="text-center mt-4 p-3 rounded-4 shadow border border-bottom-0 border-2 border-warning">Banque d'image</h4>
            <div class="row row-cols-1 row-cols-md-3">
                <?php foreach ($images as $image => $value) { ?>
                        <div class="col-md-3 mb-2">
                            <?php require __DIR__ . '/../../components/image.php';?>
                        </div>            
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<?php
require_once __DIR__ . '/../../components/footer.php';
?>