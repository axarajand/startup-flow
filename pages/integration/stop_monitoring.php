    <?php
    include('../../config.php');
    session_start();

    if (isset($_GET['task_id']) && isset($_GET['user_id'])) {
        $task_id = $_GET['task_id'];
        $user_id = $_GET['user_id'];
        $leader_id = $_GET['leader_id'];
        $project_id = $_GET['project_id'];

        // Jalankan skrip Python untuk menghentikan monitoring
        $command = "start /B python C:/xampp/htdocs/startup-flow/pages/python/monitoring.py stop {$task_id} {$user_id} {$leader_id} {$project_id}";
        pclose(popen($command, "r")); // Jalankan perintah di background

        // Update waktu selesai monitoring di database
        $stmt = $conn->prepare("UPDATE tb_report
                             SET report_end_time = NOW()
                             WHERE report_task_id = ? AND report_user_id = ? AND report_end_time IS NULL");
        $stmt->execute([$task_id, $user_id]);

        // Berikan notifikasi
        $_SESSION['message'] = "success";
        $_SESSION['text_success'] = "Monitoring stopped for task $task_id by user $user_id.";
        header('Location: ../employee/list-task.php');
        exit;
    }
    ?>