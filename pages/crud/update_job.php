<?php
require '../../config.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $job_id = $_POST['job_id'] ?? null;
    $job_name = $_POST['job_name'] ?? null;

    try {
        // Query untuk update job
        $query = "UPDATE tb_job SET job_name = :job_name WHERE job_id = :job_id";

        $stmt = $conn->prepare($query);
        $stmt->bindParam(':job_name', $job_name);
        $stmt->bindParam(':job_id', $job_id);

        // Eksekusi query
        if ($stmt->execute()) {
            $_SESSION['message'] = "success";
        } else {
            $_SESSION['message'] = "error";
        }
    } catch (Exception $e) {
        $_SESSION['message'] = "error";
    }

    // Redirect kembali ke halaman CRUD Job
    header('Location: ../leader/job.php');
    exit;
} else {
    header('Location: ../leader/job.php');
    exit;
}
