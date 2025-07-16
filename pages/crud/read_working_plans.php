<?php
require '../../config.php';

$queryHWorkingPlans = "SELECT * FROM tb_task WHERE task_user_id = :task_user_id AND task_record IN ('set','process','paused') ORDER BY task_deadline_end ASC";
$stmtHWorkingPlans = $conn->prepare($queryHWorkingPlans);
$stmtHWorkingPlans->bindParam(':task_user_id', $_SESSION['user_id'], PDO::PARAM_INT); 
$stmtHWorkingPlans->execute();
$HWorkingPlans = $stmtHWorkingPlans->fetchAll(PDO::FETCH_ASSOC);

$queryHWorkingPlansRequest = "SELECT * FROM tb_task LEFT JOIN tb_user ON :task_user_id = user_leader_id LEFT JOIN tb_job ON user_job_id = job_id WHERE task_user_id = user_id AND task_record = 'request' ORDER BY task_deadline_end ASC";
$stmtHWorkingPlansRequest = $conn->prepare($queryHWorkingPlansRequest);
$stmtHWorkingPlansRequest->bindParam(':task_user_id', $_SESSION['user_id'], PDO::PARAM_INT);
$stmtHWorkingPlansRequest->execute();
$HTaskRequest = $stmtHWorkingPlansRequest->fetchAll(PDO::FETCH_ASSOC);

$queryHWorkingPlansDone = "SELECT * FROM tb_task LEFT JOIN tb_user ON :task_user_id = user_leader_id LEFT JOIN tb_job ON user_job_id = job_id WHERE task_user_id = user_id AND task_record = 'done' ORDER BY task_deadline_end ASC";
$stmtHWorkingPlansDone = $conn->prepare($queryHWorkingPlansDone);
$stmtHWorkingPlansDone->bindParam(':task_user_id', $_SESSION['user_id'], PDO::PARAM_INT);
$stmtHWorkingPlansDone->execute();
$HTaskDone = $stmtHWorkingPlansDone->fetchAll(PDO::FETCH_ASSOC);

$queryHWorkingPlansRevision = "SELECT * FROM tb_task LEFT JOIN tb_user ON :task_user_id = user_leader_id LEFT JOIN tb_job ON user_job_id = job_id WHERE task_user_id = user_id AND task_record = 'revision' ORDER BY task_deadline_end ASC";
$stmtHWorkingPlansRevision = $conn->prepare($queryHWorkingPlansRevision);
$stmtHWorkingPlansRevision->bindParam(':task_user_id', $_SESSION['user_id'], PDO::PARAM_INT);
$stmtHWorkingPlansRevision->execute();
$HTaskRevision = $stmtHWorkingPlansRevision->fetchAll(PDO::FETCH_ASSOC);

$queryHWorkingPlansProcess = "SELECT * FROM tb_task LEFT JOIN tb_user ON :task_user_id = user_leader_id LEFT JOIN tb_job ON user_job_id = job_id LEFT JOIN tb_report ON task_user_id = report_user_id AND task_id = report_task_id WHERE task_user_id = user_id AND task_record IN ('process', 'request', 'done') ORDER BY task_deadline_end ASC";
$stmtHWorkingPlansProcess = $conn->prepare($queryHWorkingPlansProcess);
$stmtHWorkingPlansProcess->bindParam(':task_user_id', $_SESSION['user_id'], PDO::PARAM_INT);
$stmtHWorkingPlansProcess->execute();
$HTaskProcess = $stmtHWorkingPlansProcess->fetchAll(PDO::FETCH_ASSOC);

$queryHWorkingPlansUserDone = "SELECT * FROM tb_task WHERE task_user_id = :user_id AND task_record = 'done' ORDER BY task_deadline_end ASC";
$stmtHWorkingPlansUserDone = $conn->prepare($queryHWorkingPlansUserDone);
$stmtHWorkingPlansUserDone->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
$stmtHWorkingPlansUserDone->execute();
$HTaskUserDone = $stmtHWorkingPlansUserDone->fetchAll(PDO::FETCH_ASSOC);

$queryHWorkingPlansUserRevision = "SELECT * FROM tb_task WHERE task_user_id = :user_id AND task_record = 'revision' ORDER BY task_deadline_end ASC";
$stmtHWorkingPlansUserRevision = $conn->prepare($queryHWorkingPlansUserRevision);
$stmtHWorkingPlansUserRevision->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
$stmtHWorkingPlansUserRevision->execute();
$HTaskUserRevision = $stmtHWorkingPlansUserRevision->fetchAll(PDO::FETCH_ASSOC);
?>
