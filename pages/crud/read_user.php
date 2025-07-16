<?php
require '../../config.php';

$querySendTo = "SELECT * FROM tb_user LEFT JOIN tb_job ON user_job_id = job_id WHERE user_leader_id = :user_leader_id";
$stmtSendTo = $conn->prepare($querySendTo);
$stmtSendTo->bindParam(':user_leader_id', $_SESSION['user_id'], PDO::PARAM_INT);
$stmtSendTo->execute();
$users = $stmtSendTo->fetchAll(PDO::FETCH_ASSOC);
?>