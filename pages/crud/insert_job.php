<?php
// Mulai session
session_start();

// Cek apakah form dikirimkan
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $jobName = $_POST['job_name'];

    // Include file config untuk koneksi database
    require '../../config.php';

    try {
        // Siapkan query untuk memasukkan data ke tabel tb_job
        $sql = "INSERT INTO tb_job (job_name, job_created_at) VALUES (:job_name, current_timestamp())";
        $stmt = $conn->prepare($sql);

        // Bind parameter
        $stmt->bindParam(':job_name', $jobName, PDO::PARAM_STR);

        // Eksekusi query
        if ($stmt->execute()) {
            // Set pesan sukses dan arahkan kembali ke halaman sebelumnya
            $_SESSION['message'] = "success";
        } else {
            // Set pesan gagal jika query tidak dieksekusi
            $_SESSION['message'] = "error";
        }
    } catch (PDOException $e) {
        // Tangani error jika terjadi kesalahan pada query
        $_SESSION['message'] = "error";
    }
} else {
    // Jika form tidak disubmit, beri pesan error
    $_SESSION['message'] = "error";
}

// Redirect ke halaman sebelumnya (misalnya halaman daftar pekerjaan)
header('Location: ../leader/job.php');
exit();
?>
