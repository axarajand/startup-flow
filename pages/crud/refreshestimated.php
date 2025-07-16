<?php
session_start();
header('Content-Type: text/plain');

$leader_id = $_GET["leader_id"] ?? null;
$project_id = $_GET["project_id"] ?? null;

if (!$leader_id || !$project_id) {
    http_response_code(400);
    echo "Missing leader_id or project_id.";
    exit;
}

$pythonScript = "../python/refreshestimated.py";
$pythonBinary = "python"; // Ganti dengan path absolut jika perlu
$command = escapeshellcmd("$pythonBinary $pythonScript $leader_id $project_id");

exec($command, $output, $result_code);

if ($result_code !== 0) {
    http_response_code(500);
    echo "Failed to run Python script:\n" . implode("\n", $output);
    exit;
}

echo "success";
exit;