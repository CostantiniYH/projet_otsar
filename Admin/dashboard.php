<?php
require_once __DIR__ . '/../backend/db_connect.php';
require_once __DIR__ . '/../controllers/session.php';
require_once __DIR__ . '/../components/header.php';
require_once __DIR__ . '/../class/navbar.php';

require_login();

if (!isAdmin()) {
    $_SESSION['error'] = "Accès refusé. Vous n'avez pas les droits nécessaires.";
    header('Location: ' . BASE_URL . 'index.php');
    exit();
}

$pdo = connect();
$user = getUser($pdo);

$navbar = new Navbar();
$navbar->AddItem(' אוצר','index.php', 'left', '', 'bi bi-book-half rounded-5 text-white" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip-left" title="אוצר הספרים');
$navbar->AddItem('','index.php','center', '', 'bi bi-house-fill" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip" title="Accueil');
$navbar->AddItem('', 'Admin/dashboard.php', 'center', true, 'bi bi-kanban" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip" title="Tableau de bord');
$navbar->AddItem('', 'Form/Create-Update/categorie.php', 'center', '', 'bi bi-grid-3x3-gap-fill" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip" title="Gestion des catégories');
$navbar->AddItem('', 'Form/Create-Update/image.php', 'center', '', 'bi bi-image" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip" title="Ajouter une image');
$navbar->AddItem('', 'Form/Create-Update/livre.php', 'center', '', 'bi bi-book-fill" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip" title="Ajouter un livre');

$navbar->AddItem('תנ"ך','Torah/0_tanak.php','dropdown');
$navbar->AddItem('גמרא','Talmud/1_talmud.php','dropdown');
$navbar->AddItem('הלכה', 'Halakh/2_halaka.php', 'dropdown');
$navbar->AddItem('', 'javascript:location.replace(BASE_URL + "logout.php")', 'right', '', 'bi bi-door-open-fill rounded-5" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip-red" title="Déconnexion');
$navbar->render() ;
?>

<div class="container mt-5 mb-5">
    <?php
        require_once __DIR__ . '/../components/alerts.php';

        ?>    

<div class="row d-flex justify-content-center" data-aos="fade-up" data-aos-duration="1500">
        <?php if (isAdmin()) { ?>
                    <h1 class="fs-3 shadow p-4 rounded border-start border-black border-2 border-end">
                        Bienvenue sur votre tableau de bords <?= $_SESSION['user']['prenom'] ?> l'admin !</h1>
                        <!--<a href="admin-pannel.php">Panel admin</a>-->
                        <?php } else { ?>
                    <p class="col-md-12 shadow p-3 rounded border-start border-black border-2 border-end">
                        Bienvenue, <?= $_SESSION['user']['prenom'] . ' ' . $_SESSION['user']['nom'] ?> !</p>
                
        <?php }; ?>
        
        <?php 
            if (isset($_GET['deploy']) && isset($_SESSION['deploy_result'])) {
                $result = $_SESSION['deploy_result'];
                echo '<div style="border:1px solid #ccc;padding:10px;margin:10px 0;background:#f9f9f9">';
                $alertClass = $result['success'] ? 'alert-success' : 'alert-danger';
                $title = $result['success'] ? '✅ Déploiement réussi' : '❌ Erreur lors du déploiement';

                echo '<div class="alert ' . $alertClass . ' mt-3">';
                echo '<h4>' . $title . '</h4>';
                echo '<pre style="max-height:300px;overflow:auto;">';
                foreach ($result['log'] as $line) {
                    echo htmlspecialchars($line) . "\n";
                }
                echo '</pre>';
                echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                echo '</div>';
                unset($_SESSION['deploy_result']); // nettoyage après affichage
            }

            if ($_SERVER['SERVER_NAME'] === 'localhost' || $_SERVER['REMOTE_ADDR'] === '127.0.0.1') { 
                $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
                ?>
                <div class="col-md-12 shadow mt-4 mb-4 text-center p-3 rounded border border-info">
                    <h3>Cliquer ici pour lancer le déploiement :</h3>
                    <form method="post" action="<?= BASE_URL ?>controllers/deploy.php">
                        <div class="d-flex col-md-3 mx-auto mt-3">
                            <select name="remote" class="form-select mx-auto mb-3" aria-label="Default select example">
                                <option value="origin">origin</option>
                                <option value="mobile">mobile</option>
                                <option value="github">github</option>
                            </select>
                        </div>
                        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                        <button type="submit" class="btn btn-success bi bi-cloud-upload"> Déployer maintenant</button>
                    </form>
                </div>
        <?php } ?>
    
        <div class="col-md-12 shadow p-3 rounded border-start border-black border-2 border-end overflow-auto"
        data-aos="fade-up" data-aos-duration="1500">
            <table class="table shadow ">
                <h2>Table utilisateurs</h2>                
                <tr>
                    <th  class="table-header">ID User</th>
                    <th  class="table-header">nom</th>
                    <th  class="table-header">Prénom</th>
                    <th  class="table-header">Adresse Email</th>
                    <th  class="table-header">Role</th>
                    <th  class="table-header">Création</th>
                    <th  class="table-header">Action</th>
                </tr>
                <?php foreach ($user as $key =>$u) : ?>
                    <tr>                    
                        <td><?= $u['id'] ?></td>
                        <td><?= $u['nom'] ?></td>
                        <td><?= $u['prenom'] ?></td>
                        <td><?= $u['mail'] ?></td>
                        <td><?= $u['role'] ?></td>
                        <td><?= $u['created_at'] ?></td>
                        <td>
                            <div class="d-flex gap-2">
                                <input type="hidden" name="id" value="<?= $u['id'] ?>">
                                <button type="button" href="<?= BASE_URL ?>Compte/dashboard.php" class="
                                btn btn-primary btn-sm bi bi-eye"></button>
                            </div>
                            <div class="d-flex gap-2">
                                <input type="hidden" name="id" value="<?= $u['id'] ?>">
                                <button type="button" href="<?= BASE_URL ?>Form/Compte/user.php" class="btn btn-warning btn-sm bi bi-pencil"></button>
                            </div>
                            <form action="<?= BASE_URL ?>controllers/Delete/user.php">
                                <input type="hidden" name="id" value="<?= $u['id'] ?>">
                                <button type="submit" class="btn btn-danger btn-sm bi bi-trash"
                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');"></button>
                            </form>

                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <div class="col-md-12 shadow mt-4 p-3 rounded border-start border-black border-2 border-end overflow-auto"
        data-aos="fade-up" data-aos-duration="1000">
            <table class="table shadow">
                
                    <h2>Table Livres</h2>
                
                <tr>
                    <th>קטגוריה כללית</th>
                    <th>קטגוריה פרטית</th>
                    <th>קטגוריה קטנה</th>
                    <th>ספר</th>
                </tr>
                <tr>
                    <?php 
                    $pdo = connect();
                    $massekets = getLivre($pdo);
                    
                    foreach ($massekets as $masseket) : ?>
                        <tr>
                            <td><?= $masseket['nom_categorie'] ?></td>
                            <td><?= $masseket['nom_s_categorie'] ?></td>
                            <td><?= $masseket['nom_s_s_categorie'] ?></td>
                            <td><?= $masseket['titre'] ?></td>
                        </tr>
                    <?php endforeach; ?>
            </table>
        </div>
        <div class="col-md-12 shadow mt-4 p-3 rounded border-start border-black border-2 border-end overflow-auto"
        data-aos="fade-up" data-aos-duration="1000">
            <table class="table shadow">
                
                    <h2>Table Images</h2>
                
                <tr>
                    <th>Image</th>
                    <th>Titre</th>                    
                    <th>Catégorie</th>
                    <th>Ajoutée le</th>
                    <th>Action</th>
                </tr>
                <!--  foreach ($images as $image) : -->
                <?php 
                    $pdo = connect();
                    $images = getAllInnerJoin($pdo, 't_images', 't_categories', 'nom AS nom_categorie', 't_images.id_categorie = t_categories.id');
                    
                    foreach ($images as $image) : ?>
                        <tr>
                            <td><img src="<?= /*BASE_URL . 'uploads/' .*/ $image['chemin'] ?>" alt="<?= $image['nom'] ?>" width="100"></td>
                            <td><?= $image['nom'] ?></td>                            
                            <td><?= $image['nom_categorie'] ?></td>
                            <td><?= $image['date_upload'] ?></td>
                            <td>
                                <div class="d-flex gap-2">
                                    <input type="hidden" name="id" value="<?= $image['id'] ?>">
                                    <button type="button" href="Crud/update_image.php" class="btn btn-warning btn-sm bi bi-pencil"></button>
                                <form action="<?= BASE_URL ?>controllers/delete_image.php" method="post" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette image ?');">
                                    <input type="hidden" name="id" value="<?= $image['id'] ?>">
                                    <button type="submit" class="btn btn-danger btn-sm bi bi-trash"></button>
                                </form>
                        </tr>
                    <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>
<script>
fetch('BASE_URL + controllers/deploy.php', { method: 'POST', body: new URLSearchParams({ token: 'MON_TOKEN' }) })
    .then(res => res.json())
    .then(data => {
        if (data.status === 'ok') {
            // Redirection après succès
            window.location.href = 'BASE_URL + Admin/dashboard.php';
        } else {
            alert('Erreur pendant le déploiement');
        }
    });
</script>


<?php
require_once __DIR__ . '/../components/footer.php';
?>