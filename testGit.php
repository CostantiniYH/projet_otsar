<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$output = [];
$returnVar = 0;
exec('git --version 2>&1', $output, $returnVar);

echo "<pre>";
print_r($output);
echo "Return code: $returnVar";
echo "</pre>";
