<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../controllers/session.php';

header('Content-Type: application/json');

// Clé secrète (change-la et stocke-la hors du code en prod)
$secretKey = 'token_de_ouf_impossible_à_craquer';

// Vérifier méthode POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Méthode non autorisée']);
    exit;
}

$allowedRemote = ['origin', 'mobile', 'github'];
$remote = $_POST['remote'] ?? 'mobile';
if (!in_array($remote, $allowedRemote)) {
    http_response_code(400);
    echo json_encode(['error' => 'Remote non autorisé']);
    exit;
}

// Vérifier token
$token = $_POST['token'] ?? '';
if ($token !== $secretKey) {
    http_response_code(403);
    echo json_encode(['error' => 'Accès refusé']);
    exit;
}

$gitPath = 'C:\Program Files\Git\bin\git.exe';
// Dossier projet
$projectDir = 'C:/wamp64/www/projet_otsar';


// Commandes à exécuter
$commands = [
    "cd $projectDir",
    "\"$gitPath\" git add .",
    "\"$gitPath\" git commit -m \"auto deploy\"  || echo \"Rien à commit\"",
    "\"$gitPath\" git push $remote master"
];

$output = [];
$success = true;

echo '<pre>';
foreach ($commands as $cmd) {
    $output[] = "\n>>> $cmd";
    exec($cmd . ' 2>&1', $res, $returnVar);
    $output = array_merge($output, $res);
    if ($returnVar !== 0) {
        $success = false;
        $output[] = "Erreur détectée : $returnVar";
        break;
    }
}
echo '</pre>';

if (!$success) {
    header('Location: ' . BASE_URL . 'Admin/dashboard.php?erreur=Erreur lors du déploiement ! ' . $returnVar .'');
} else {
    header('Location: ' . BASE_URL . 'Admin/dashboard.php?success=Déploiement réussi !');
} 
exit;
