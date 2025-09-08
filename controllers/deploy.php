<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../controllers/session.php';

header('Content-Type: application/json');

// Clé secrète (en prod → stocker ailleurs)
$secretKey = 'token_de_ouf_impossible_à_craquer';

// Vérifier méthode POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Méthode non autorisée']);
    exit;
}

// Vérifier remote
$allowedRemote = ['origin', 'mobile', 'github'];
$remote = $_POST['remote'] ?? 'origin';
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

// Chemin complet vers Git
$gitPath = '"C:\Program Files\Git\bin\git.exe"';
// Dossier projet
$projectDir = 'C:\wamp64\www\projet_otsar';

$output = [];
$success = true;

// ✅ Vérifier s'il y a des changements
$checkChangesCmd = "cd /d \"$projectDir\" && $gitPath status --porcelain";
exec($checkChangesCmd . ' 2>&1', $changes);

if (empty($changes)) {
    $output[] = "Aucun changement à commit.";
} else {
    // ✅ Ajout des fichiers
    exec("cd /d \"$projectDir\" && $gitPath add . 2>&1", $res, $ret);
    $output = array_merge($output, $res);

    // ✅ Commit
    exec("cd /d \"$projectDir\" && $gitPath commit -m \"auto deploy\" 2>&1", $res, $ret);
    $output = array_merge($output, $res);

    if ($ret !== 0) {
        $success = false;
        $output[] = "Erreur lors du commit (code $ret)";
    }
}

// ✅ Push (même si aucun commit, push pour sync)
exec("cd /d \"$projectDir\" && $gitPath push $remote master 2>&1", $res, $ret);
$output = array_merge($output, $res);

if ($ret !== 0) {
    $success = false;
    $output[] = "Erreur lors du push (code $ret)";
}

// ✅ Stocker le résultat dans la session
$_SESSION['deploy_result'] = [
    'success' => $success,
    'log' => $output
];

// ✅ Redirection propre avec un indicateur simple
if ($success) {
    header('Location: ' . BASE_URL . 'Admin/dashboard.php?deploy=success');
} else {
    header('Location: ' . BASE_URL . 'Admin/dashboard.php?deploy=error');
}
exit;
