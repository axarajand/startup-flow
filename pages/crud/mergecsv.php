<?php
session_start();

header('Content-Type: text/plain');

$project_id = $_GET['project_id'] ?? null;
$leader_id = $_GET['leader_id'] ?? null;
$user_id = $_SESSION["user_id"] ?? null;

if (!$project_id || !$leader_id || !$user_id) {
    http_response_code(400);
    echo "Missing parameters.";
    exit;
}

$pythonScript = "../python/mergecsv.py";
$pythonBinary = "python"; // atau path absolut
$command = escapeshellcmd("$pythonBinary $pythonScript $leader_id $project_id");

exec($command, $output, $result_code);

if ($result_code !== 0) {
    http_response_code(500);
    echo "Failed to run Python script:\n" . implode("\n", $output);
    exit;
}

echo "success";
exit;