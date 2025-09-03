<?php
require_once __DIR__ . '/../../backend/db_connect.php';
require_once __DIR__ . '/../../controllers/session.php';
require_once __DIR__ . '/../../components/header.php';
require_once __DIR__ . '/../../class/navbar.php';
require_once __DIR__ . '/../../backend/db_connect.php';

require_login();

$pdo = connect();

$navbar = new Navbar();
$navbar->AddItem(' אוצר','index.php', 'left', '', 'bi bi-book-half rounded-5 text-white" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip-left" title="אוצר הספרים');
$navbar->AddItem('','index.php','center', '', 'bi bi-house-fill" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip" title="Accueil');
$navbar->AddItem('', 'Admin/dashboard.php', 'center', '', 'bi bi-kanban" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip" title="Tableau de bord');
$navbar->AddItem('', 'Admin/add_categorie.php', 'center', '', 'bi bi-grid-3x3-gap-fill" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip" title="Gestion des catégories');
$navbar->AddItem('', 'Admin/add_image.php', 'center', '', 'bi bi-image" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip" title="Ajouter une image');
$navbar->AddItem('', 'Admin/add_livre.php', 'center', true, 'bi bi-book-fill" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip" title="Ajouter un livre');

$navbar->AddItem('תנ"ך','0_tanak.php','dropdown');
$navbar->AddItem('גמרא','1_talmud.php','dropdown');
$navbar->AddItem('הלכה', '2_halaka.php', 'dropdown');
$navbar->AddItem('', 'javascript:location.replace(BASE_URL + "logout.php")', 'right', '', 'bi bi-door-open-fill rounded-5" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip-red" title="Déconnexion');
$navbar->render() ;
?>
<style>
    a {
        text-decoration: none;
        color: black;        
    }
</style>
<div class="container p-3">
    <?php
        require_once __DIR__ . '/../../components/alerts.php';
    ?>
        
        <div class="row mt-4 mb-4 gap-4">
            <h3 class="text-center mb-4 p-3 rounded-4 shadow border border-bottom-0 border-3 border-warning"
            >Ajouter un livre</h3>
            <form action="<?= BASE_URL ?>controllers/Create-Update/livre.php" method="post" class="col-md-5 shadow p-4 
            rounded-4" enctype="multipart/form-data">
            <h4 class="text-center">Ajouter ici</h4>
            <div class="form-group">
                <label for="titre" class="mb-2">Titre</label>
                <input type="text" class="form-control" id="titre" name="titre"
                placeholder="Entrer le nom de la ctégorie" required>
            </div><br> 
            <div class="form-group">
                <label for="auteur" class="mb-2">Auteur</label>
                <input type="text" class="form-control" id="auteur" name="auteur"
                placeholder="Entrer le nom de l'auteur" required>
            </div>
            <div class="form-group">
                <label for="image" class="mb-2">Image</label>
                <input type="file" class="form-control" id="image" name="image" required>
            </div><br>

            <?php $categories = getAll($pdo, 't_categories');?>
            <div class="form-group">
                <label for="categorie" class="mb-2">Catégorie</label>
                <select class="form-select" id="categorie" name="categorie" required>
                    <option value="0">Choisir une catégorie</option>
                    <?php  foreach ($categories as $categorie): ?>
                        <option value="<?= $categorie['id'] ?>"><?= $categorie['nom'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div><br>

            <?php $s_categories = getAll($pdo, 't_s_categories');?>
            <div class="form-group">
                <label for="s_categorie" class="mb-2">Sous-catégorie</label>
                <select class="form-select" id="s_categorie" name="s_categorie">
                    <option value="0">Choisir une sous-catégorie</option>
                    <?php  foreach ($s_categories as $s_categorie): ?>
                        <option value="<?= $s_categorie['id'] ?>"><?= $s_categorie['nom'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div><br>

            <?php $s_s_categories = getAll($pdo, 't_s_s_categories');?>
            <div class="form-group">
                <label for="s_s_categorie" class="mb-2">Sous-sous-catégorie</label>
                <select class="form-select" id="s_s_categorie" name="s_s_categorie">
                    <option value="0">Choisir une sous-sous-catégorie</option>
                    <?php  foreach ($s_s_categories as $s_s_categorie): ?>
                        <option value="<?= $s_s_categorie['id'] ?>"><?= $s_s_categorie['nom'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div><br>
                
            <?php $s_s_s_categories = getAll($pdo, 't_s_s_s_categories');?>
            <div class="form-group">
                <div class="form-group">
                <label for="s_s_s_categorie" class="mb-2">Sous-sous-sous-catégorie</label>
                <select class="form-select" id="s_s_s_categorie" name="s_s_s_categorie">
                    <option value="0">Choisir une sous-sous-sous-catégorie</option>
                    <?php  foreach ($s_s_s_categories as $s_s_s_categorie): ?>
                        <option value="<?= $s_s_s_categorie['id'] ?>"><?= $s_s_s_categorie['nom'] ?></option>
                        <?php endforeach; ?>
                </select>
            </div><br>
            <label for="description" class="mb-2">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
            </div><br>
            <div class="form-group">
                <button type="submit" class="btn btn-primary" id="">Ajouter</button>
            </div>
        </form>

        <?php $livres = getAll($pdo, 't_livres');?>
        <div class="col shadow rounded bg-custom">
            <h4 class="text-center mt-4 p-3 rounded-4 shadow border border-bottom-0 border-2 border-warning">Livres existants</h4>
            <div class="row row-cols-1 row-cols-md-3">
                <?php foreach ($livres as $livre) { ?> 
                    <div class="col-md-2 m-2 pt-3 rounded-4 shadow bg-light text-center">
                            <p class=""><a href="<?= BASE_URL ?>livres.php?id=<?= $livre['id']; ?>"
                            style="display: contents;"><?= $livre['titre']; ?></p>
                        </div>            
                        <?php } ?>
            </div>
        </div>
    </div>
</div>
<?php
require_once __DIR__ . '/../../components/footer.php';
?>