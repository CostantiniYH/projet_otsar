<?php
require_once __DIR__ . '/../backend/db_connect.php';
require_once __DIR__ . '/../controllers/session.php';
require_once __DIR__ . '/../components/header.php';
require_once __DIR__ . '/../class/navbar.php';
require_once __DIR__ . '/../class/carousel.php';

if (!isLoggedIn()) {
    header('Location: ' . BASE_URL . 'Compte/login.php');
    exit();
} else {
    getUserSession();
    $success = 'Félicitation ' . htmlspecialchars($_SESSION['user']['prenom']) . ', vous avez accès au תלמוד בבלי!';
}

$navbar = new Navbar();
$navbar->AddItem(' אוצר','index.php', 'left', '', 'bi bi-book-half rounded-5 text-white" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip-left" title="אוצר הספרים');
$navbar->AddItem('','index.php','center', '', 'bi bi-house-fill" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip" title="Accueil');
$navbar->AddItem('תלמוד בבלי','1-1_babli.php','center', true);
if (isLoggedIn()) {
    $navbar->AddItem('','livres.php','dropdown', '', 'bi bi-book" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip" title="Liste des livres');
    $navbar->AddItem('תנ"ך','Torah/0_tanak.php','dropdown');    $navbar->AddItem('גמרא','Talmud/1_talmud.php','dropdown');
    $navbar->AddItem('הלכה', 'Halakha/2_halaka.php', 'dropdown');
    $navbar->AddItem('מוסר', '3_mousar.php', 'dropdown', '');
    $navbar->AddItem('', 'Admin/dashboard.php', 'center', '', 'bi bi-kanban" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip" title="Tableau de bord');
    $navbar->AddItem('', 'Admin/add_image.php', 'center', '', 'bi bi-image" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip" title="Ajouter une image');
    $navbar->AddItem('', 'Admin/add_categorie.php', 'center', '', 'bi bi-image" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip" title="Ajouter une image');
    $navbar->AddItem('', 'Admin/add_livre.php', 'center', '', 'bi bi-book-fill" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip" title="Ajouter un livre');
    $navbar->AddItem('', 'javascript:location.replace("logout.php")', 'right', '', 'bi bi-door-open-fill rounded-5" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip-red" title="Déconnexion');
} else {
    $navbar->AddItem('תנ"ך','0_tanak.php','center');
    $navbar->AddItem('גמרא','1_talmud.php','center');
    $navbar->AddItem('הלכה', '2_halaka.php', 'center');
    $navbar->AddItem('מוסר', '3_mousar.php', 'center', '');
    $navbar->AddItem('','Compte/login.php','right', '', 'bi bi-person-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip-right" title="Connexion');
    $navbar->AddItem('Inscription','register.php', 'right');
    }
$navbar->render() ;
?>

<div class="container pt-3">

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

    <div class="alert alert-success alert-dismissible fade show" data-bs-dismiss="3000" 
    role="alert"><?= $success ;?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <h1 class="mt-5 mb-5 shadow rounded-4 border border-bottom-0 border-3 "
     data-aos="fade-up" data-aos-duration="1500">תלמוד בבלי</h1>
     <?php
        if (!empty($_GET['id'])) {
            $pdo = connect();
            $traites = findBy($pdo, 't_livres', 'id_sous_categorie', 5);
            foreach ($traites as $traite) {
                if ($traite['id'] == $_GET['id']) {
                    echo '<h2 class="text-center mb-4">' . htmlspecialchars($traite['titre']) . '</h2>';
                    echo '<p class="text-center">' . htmlspecialchars($traite['description']) . '</p>';
                }
            }
        } else {
    ?>
        <form action="<?= BASE_URL ?>Talmud/1-1_babli.php" method="get" class="mb-5">
            <div class="form-group mb-3">
                <label for="search" class="form-label">Rechercher un traité du Talmud</label>
                <input type="text" class="form-control" id="search" name="search" placeholder="Ex: Berakhot, Shabbat, etc.">
                <button type="submit" class="btn btn-primary mt-3">Rechercher</button>
            </div>
            <div class="form-group mb-3">
                <!-- Sélectionner une מסכת -->
                <label for="tractate" class="form-label">Sélectionner une מסכת</label>
                <select class="form-select" id="tractate" name="tractate">
                    <option value="">-- Sélectionner une מסכת --</option>
                    <?php
                        $pdo = connect();
                        $traites = findBy($pdo, 't_livres', 'id_categorie', 5);
                        foreach ($traites as $traite) {
                            echo '<option value="' . htmlspecialchars($traite['id']) . '">' . htmlspecialchars($traite['titre']) . '</option>';
                            }
                    ?>              
                </select>
                <button type="submit" class="btn btn-primary mt-3">Voir les livres</button>
            </div>
        </form>
    <?php
    }
    if (isset($_GET['search']) && !empty($_GET['search'])) {
        $pdo = connect();
        $search = htmlspecialchars($_GET['search']);
        $traites = findBy($pdo, 't_livres', 'titre', $search);
        if (empty($traites)) {
            echo '<div class="alert alert-danger" role="alert">Aucun traité trouvé pour la recherche : ' . $search . '</div>';
        } else {
            echo '<h2 class="text-center mb-4">Résultats de la recherche pour : ' . $search . '</h2>';
            foreach ($traites as $traite) {
                echo '<div class="card mb-3">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">' . htmlspecialchars($traite['titre']) . '</h5>';
                echo '<p class="card-text">' . htmlspecialchars($traite['description']) . '</p>';
                echo '<a href="?id=' . htmlspecialchars($traite['id']) . '" class="btn btn-primary">Voir le traité</a>';
                echo '</div>';
                echo '</div>';
            }
        }
    } elseif (isset($_GET['tractate']) && !empty($_GET['tractate'])) {
        $pdo = connect();   
        $tractateId = htmlspecialchars($_GET['tractate']);
        $traites = findBy($pdo, 't_livres', 'id', $tractateId);
        if (empty($traites)) {
            echo '<div class="alert alert-danger" role="alert">Aucun livre trouvé pour la מסכת sélectionnée.</div>';
        } else {
            echo '<h2 class="text-center mb-4">Livres de la מסכת sélectionnée</h2>';
            foreach ($traites as $traite) {
                echo '<div class="card mb-3">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">' . htmlspecialchars($traite['titre']) . '</h5>';
                echo '<p class="card-text">' . htmlspecialchars($traite['description']) . '</p>';
                echo '<a href=livre_one.php?id=' . htmlspecialchars($traite['id']) . '" class="btn btn-primary">Voir le traité</a>';
                echo '</div>';
                echo '</div>';
            }
        }
        }
        ?>

</div>
<?php
require_once __DIR__ . '/../components/footer.php';
?>