<?php
require '../../config.php';

$queryReport = "SELECT * FROM tb_report LEFT JOIN tb_user ON report_user_id = user_id LEFT JOIN tb_task ON report_task_id = task_id LEFT JOIN tb_project ON task_project_id = project_id LEFT JOIN tb_job ON user_job_id = job_id WHERE user_leader_id = :user_leader_id";
$stmtReport = $conn->prepare($queryReport);
$stmtReport->bindParam(':user_leader_id', $_SESSION['user_id'], PDO::PARAM_INT);
$stmtReport->execute();
$reports = $stmtReport->fetchAll(PDO::FETCH_ASSOC);

$queryReportEnd = "SELECT * FROM tb_project WHERE project_leader_id = :user_leader_id";
$stmtReportEnd = $conn->prepare($queryReportEnd);
$stmtReportEnd->bindParam(':user_leader_id', $_SESSION['user_id'], PDO::PARAM_INT);
$stmtReportEnd->execute();
$reportsEnd = $stmtReportEnd->fetchAll(PDO::FETCH_ASSOC);
?>