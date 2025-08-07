<?php
require_once __DIR__ . '/backend/db_connect.php';
require_once __DIR__ . '/controllers/session.php';
require_once __DIR__ . '/components/header.php';
require_once __DIR__ . '/class/navbar.php';

$navbar = new Navbar();
$navbar->AddItem(' אוצר','index.php', 'left', '', 'bi bi-book-half rounded-5 text-white" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip-left" title="אוצר הספרים');
$navbar->AddItem('','index.php','center', '', 'bi bi-house-fill" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip" title="Accueil');
$navbar->AddItem('','login.php','right', '', 'bi bi-person-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip-right" title="Connexion');
$navbar->render() ;
?>
<link rel="stylesheet" href="<?= BASE_URL ?>styles/style_register.css">
<div class="container bg-white bg-transparent p-5 shadow">
    
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
    
    
    <h1 class="text-center rounded-3 bg-white shadow">Inscription</h1>
    <a href="index.php" class="btn btn-primary bi bi-arrow-left">Home</a>
    <div class="row p-5">
        <form action="<?= BASE_URL ?>controllers/register.php" method="post" class="col-md-6 offset-3 border-3 border-start border-end border-primary shadow p-3 rounded-4 bg-white">
            <div class="form-group mb-3">
                <label for="name">Nom</label>
                <input type="text" class="form-control" id="name" name="nom" placeholder="Entrez votre nom" required>
            </div>
            <div class="form-group mb-3">
                <label for="prenom">Prénom</label>
                <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Entrez votre prenom" required>
            </div>
            <div class="form-group mb-3">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group mb-3">
                <label for="password">Mot de passe</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group mb-3">
                <label for="password2">Confirmer le mot de passe</label>
                <input type="password" class="form-control" id="password2" name="password2" required>
            </div>
            <div class="form-group mb-3">
                <button type="submit" class="col-md-6 offset-3 border-0 rounded bg-primary text-white fs-5">Valider</button>
            </div>
        </form>
    </div>
</div>

<?php
require_once __DIR__ . '/components/footer.php';
?>