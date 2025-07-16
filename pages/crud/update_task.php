<?php
require '../../config.php';
// start_continue_task.php

if (isset($_GET['task_id']) && isset($_GET['task_record'])) {
    $taskId = $_GET['task_id'];
    $taskRecord = $_GET['task_record'];
    $userId = $_GET['user_id'];
    $leaderId = $_GET['leader_id'];
    $projectId = $_GET['project_id'];

    // Logic to update task status
    if ($taskRecord === 'process') {
        $newTaskRecord = 'process';  // Continue task
    } elseif ($taskRecord === 'paused') {
        $newTaskRecord = 'paused';  // Paused task
    } elseif ($taskRecord === 'done') {
        $newTaskRecord = 'request';  // Request task
    }else {
        $newTaskRecord = 'set';  // Start task
    }

    // Update the task record in the database
    $query = "UPDATE tb_task SET task_record = :task_record WHERE task_id = :task_id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':task_id', $taskId);
    $stmt->bindParam(':task_record', $newTaskRecord);

    if ($stmt->execute()) {
        // Redirect to the task page showing the updated task list
            // Logic to update task status
        if ($taskRecord === 'process') {
            header("Location: ../integration/start_monitoring.php?task_id=" . $taskId . "&user_id=" . $userId . "&leader_id=" . $leaderId . "&project_id=" . $projectId);
        } elseif ($taskRecord === 'paused') {
            header("Location: ../integration/stop_monitoring.php?task_id=" . $taskId . "&user_id=" . $userId . "&leader_id=" . $leaderId . "&project_id=" . $projectId);
        } elseif ($taskRecord === 'done') {
            header("Location: ../integration/stop_monitoring.php?task_id=" . $taskId . "&user_id=" . $userId . "&leader_id=" . $leaderId . "&project_id=" . $projectId);
        }else {
            $newTaskRecord = 'set';  // Start task
        }
        exit;
    }
}
?>
