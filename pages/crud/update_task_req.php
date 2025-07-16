<?php
require '../../config.php';

session_start();

if (isset($_GET['task_id']) && isset($_GET['task_record'])) {
    // Ambil data dari form
    $taskId = $_GET['task_id'];
    $taskRecord = $_GET['task_record'];

    try {
        $query = "UPDATE tb_task SET task_record = :task_record WHERE task_id = :task_id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':task_id', $taskId);
        $stmt->bindParam(':task_record', $taskRecord);

        // Eksekusi query
        if ($stmt->execute()) {
            $_SESSION['message'] = "success";
        } else {
            $_SESSION['message'] = "error";
        }
    } catch (Exception $e) {
        $_SESSION['message'] = "error";
    }

    if ($_SESSION['user_role'] == 'Leader') {
        header('Location: ../leader/request-approval.php');
    } else {
        header('Location: ../employee/revision.php');
    }
    exit;
} else {
    $_SESSION['message'] = "error";
    if ($_SESSION['user_role'] == 'Leader') {
        header('Location: ../leader/request-approval.php');
    } else {
        header('Location: ../employee/revision.php');
    }
    exit;
}
