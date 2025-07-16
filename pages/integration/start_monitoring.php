<?php
include('../../config.php');
session_start();

if (isset($_GET['task_id']) && isset($_GET['user_id'])) {
    $task_id = $_GET['task_id'];
    $user_id = $_GET['user_id'];
    $leader_id = $_GET['leader_id'];
    $project_id = $_GET['project_id'];

    // Buat nama file CSV dan video
    $folder_path = "{$leader_id}_{$project_id}";
    $csv_name = "{$folder_path}/activity_{$task_id}_{$user_id}.csv";
    $video_name = "{$folder_path}/screen_{$task_id}_{$user_id}.mp4";

    // Jalankan skrip Python untuk memulai monitoring
    $command = "start /B python C:/xampp/htdocs/startup-flow/pages/python/monitoring.py start {$task_id} {$user_id} {$leader_id} {$project_id}";
    pclose(popen($command, "r")); // Jalankan perintah di background

    // Simpan metadata ke database
     $stmt = $conn->prepare("INSERT INTO tb_report (report_task_id, report_user_id, report_csv, report_video, report_start_time)
                        VALUES (?, ?, ?, ?, NOW())");
    $stmt->execute([$task_id, $user_id, $csv_name, $video_name]);

    // Berikan notifikasi
    $_SESSION['message'] = "success";
    $_SESSION['text_success'] = "Monitoring started for task $task_id by user $user_id.";
    header('Location: ../employee/list-task.php');
    exit;
}
?>