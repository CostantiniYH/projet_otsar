<?php
require_once __DIR__ . '/../backend/db_connect.php';
require_once __DIR__ . '/../controllers/session.php';
require_once __DIR__ . '/../components/header.php';
require_once __DIR__ . '/../class/navbar.php';

require_login();

if (isLoggedIn()) {
    getUserSession();
    if (isAdmin()) {
        echo "Ecoute c'est pas mal, heureusement que t'es admin, sinon t'aurais été tej vite fait !";
    } else {
        echo "Vous êtes connecté en tant qu'utilisateur simple !";
    } 
}



$pdo = connect();
$user = getUser($pdo);

$navbar = new Navbar();
$navbar->AddItem(' אוצר','index.php', 'left', '', 'bi bi-book-half rounded-5 text-white" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip-left" title="אוצר הספרים');
$navbar->AddItem('','index.php','center', '', 'bi bi-house-fill" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip" title="Accueil');
$navbar->AddItem('', 'dashboard.php', 'center', '', 'bi bi-kanban" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip" title="Tableau de bord');
$navbar->AddItem('', 'add_categorie.php', 'center', '', 'bi bi-grid-3x3-gap-fill" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip" title="Gestion des catégories');
$navbar->AddItem('', 'add_image.php', 'center', true, 'bi bi-image" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip" title="Ajouter une image');
$navbar->AddItem('תנ"ך','0_tanak.php','dropdown');
$navbar->AddItem('גמרא','1_talmud.php','dropdown');
$navbar->AddItem('הלכה', '2_halaka.php', 'dropdown');
$navbar->AddItem('', 'javascript:location.replace(BASE_URL + "logout.php")', 'right', '', 'bi bi-door-open-fill rounded-5" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip-red" title="Déconnexion');
$navbar->render() ;
?>

<div class="container p-3">

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

    <div class="row d-flex justify-content-center">
        <?php if (isAdmin()) { ?>
                    <h1 class="fs-3 shadow p-4 rounded border-start border-black border-2 border-end">
                        Bienvenue sur votre tableau de bords <?= $_SESSION['user']['prenom'] ?> l'admin !</h1>
                    <!--<a href="admin-pannel.php">Panel admin</a>-->
            <?php } else { ?>
                    <p class="col-md-12 shadow p-3 rounded border-start border-black border-2 border-end">
                        Bienvenue, <?= $_SESSION['user']['nom'] ?> !</p>
                
        <?php }; ?>
    
        <div class="col-md-12 shadow p-3 rounded border-start border-black border-2 border-end overflow-auto">
            <table class="table shadow ">
                <tr>
                    <th>Table utilisateurs</th>
                </tr>
                <tr>
                    <th  class="table-header">ID User</th>
                    <th  class="table-header">nom</th>
                    <th  class="table-header">Prénom</th>
                    <th  class="table-header">Adresse Email</th>
                    <th  class="table-header">Role</th>
                    <th  class="table-header">Créations</th>
                </tr>
                <?php foreach ($user as $key =>$u) : ?>
                    <tr>                    
                        <td><?= $u['id'] ?></td>
                        <td><?= $u['nom'] ?></td>
                        <td><?= $u['prenom'] ?></td>
                        <td><?= $u['mail'] ?></td>
                        <?= $u['role'] ?></td>
                        <td><?= $u['created_at'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <div class="col-md-12 shadow mt-4 p-3 rounded border-start border-black border-2 border-end overflow-auto">
            <table class="table shadow">
                <tr>
                    <th >Table מסכתות</th>
                </tr>
                <tr>
                    <th  class=""></th>
                    <th  class=""></th>
                    <th  class=""></th>
                    <th  class=""></th>
                    <th  class="">מסכת</th>
                    <th  class="">סדר</th>
                </tr>
               <!-- <?php foreach ($masseket as $key => $m) : ?>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                <?php endforeach; ?>-->
            </table>
        </div>
    </div>
</div>

<?php
require_once __DIR__ . '/../components/footer.php';
?>