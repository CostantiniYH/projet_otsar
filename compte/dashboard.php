<?php
require_once __DIR__ . '/../controllers/session.php';
header('refresh:5;url=' .BASE_URL . 'index.php');
echo "Page en cours d'écriture. Redirection vers la page d'accueil dans 5 secondes.";