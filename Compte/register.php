<?php
require_once __DIR__ . '/../backend/db_connect.php';
require_once __DIR__ . '/../controllers/session.php';
require_once __DIR__ . '/../components/header.php';
require_once __DIR__ . '/../class/navbar.php';

$navbar = new Navbar();
$navbar->AddItem(' אוצר','index.php', 'left', '', 'bi bi-book-half rounded-5 text-white" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip-left" title="אוצר הספרים');
$navbar->AddItem('','index.php','center', '', 'bi bi-house-fill" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip" title="Accueil');
$navbar->AddItem('','Compte/login.php','right', '', 'bi bi-person-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip-right" title="Connexion');
$navbar->render() ;
?>

<!--<link rel="stylesheet" href="<?= BASE_URL ?>styles/style_register.css">-->

<div class="container">
    <?php
        require_once __DIR__ . '/../components/alerts.php';
    ?>    
    
    <a href="<?= BASE_URL ?>index.php" class="btn btn-primary bi bi-arrow-left mt-5"> Home</a>   
    
    <div class="row p-5">
        <form action="<?= BASE_URL ?>controllers/register.php" method="post" class="bg-white col-md-6 mx-auto shadow p-3 rounded-4 border-bottum-0 border-3 border-blueDark">
            <h1 class="mb-5">Inscription</h1>
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
            <div class="mx-auto text-center mb-3">
                <button type="submit" class="p-1 border-0 rounded bg-primary text-white fs-5 w-100">Valider</button>
            </div>
        </form>
    </div>
</div>

<?php
require_once __DIR__ . '/../components/footer.php';
?>