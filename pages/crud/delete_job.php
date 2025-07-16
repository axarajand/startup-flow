<?php
// Mulai session
session_start();

// Cek apakah job_id dikirimkan melalui URL
if (isset($_GET['job_id'])) {
    // Ambil job_id dari URL
    $jobId = $_GET['job_id'];

    // Include file config untuk koneksi database
    require '../../config.php';

    try {
        // Siapkan query untuk menghapus data berdasarkan job_id
        $sql = "DELETE FROM tb_job WHERE job_id = :job_id";
        $stmt = $conn->prepare($sql);

        // Bind parameter
        $stmt->bindParam(':job_id', $jobId, PDO::PARAM_INT);

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
    // Jika job_id tidak ada dalam URL, redirect ke halaman sebelumnya
        $_SESSION['message'] = "error";
}

// Redirect ke halaman sebelumnya (misalnya halaman daftar pekerjaan)
header('Location: ../leader/job.php');
exit();
?>
