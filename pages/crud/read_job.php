<?php
require '../../config.php';

$queryJob = "SELECT * FROM tb_job";
$queryJobTo = $conn->prepare($queryJob);
$queryJobTo->execute();
$jobs = $queryJobTo->fetchAll(PDO::FETCH_ASSOC);
?>