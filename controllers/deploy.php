<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../controllers/session.php';

if (!isLoggedIn() || !isAdmin()) {
    http_response_code(403);
    echo json_encode(['error' => 'Accès refusé, vous devez être administrateur.']);
    exit;
}

//header('Content-Type: application/json');


if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Méthode non autorisée']);
    exit;
}

$allowedRemote = ['origin', 'mobile', 'github'];
$remote = $_POST['remote'] ?? 'origin';

if (!in_array($remote, $allowedRemote)) {
    http_response_code(400);
    echo json_encode(['error' => 'Remote non autorisé']);
    exit;
}

$secretKey = $_SESSION['csrf_token'] ?? '';
$token = $_POST['csrf_token'] ?? '';

if (empty($secretKey) || empty($token)) {
    http_response_code(403);
    echo json_encode(['error' => 'Accès refusé le token est manquant']);
    exit;
}

if ($token !== $secretKey) {
    http_response_code(403);
    echo json_encode(['error' => 'Accès refusé le token ne correspond pas']);
    exit;
}

unset($_SESSION['csrf_token']);

$gitPath = escapeshellarg('C:\Program Files\Git\bin\git.exe');
$projectDir = escapeshellarg('C:\wamp64\www\projet_otsar');

$output = [];
$success = true;

// ✅ Vérifier s'il y a des changements
$checkChangesCmd = "cd /d $projectDir && $gitPath status --porcelain";
exec($checkChangesCmd . ' 2>&1', $changes);

exec("cd /d $projectDir && $gitPath rev-parse --abbrev-ref HEAD", $branch);
$currentBranch = trim($branch[0] ?? 'master');

if (empty($changes)) {
    $output[] = "Aucun changement à commit.";
} else {
    // ✅ Ajout des fichiers
    exec("cd /d $projectDir && $gitPath add . 2>&1", $res, $ret);
    $output = array_merge($output, $res);

    // ✅ Commit
    $res = [];
    exec("cd /d $projectDir && $gitPath commit -m \"auto deploy\" 2>&1", $res, $ret);
    $output = array_merge($output, $res);

    if ($ret !== 0) {
        $success = false;
        $output[] = "Erreur lors du commit (code $ret)";
    }
}

// ✅ Push (même si aucun commit, push pour sync)
$res = [];
exec("cd /d $projectDir && $gitPath push $remote $currentBranch 2>&1", $res, $ret);
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
