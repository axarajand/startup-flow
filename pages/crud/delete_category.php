<?php
// Mulai session
session_start();

// Cek apakah cat_id dikirimkan melalui URL
if (isset($_GET['cat_id'])) {
    // Ambil cat_id dari URL
    $catId = $_GET['cat_id'];

    // Include file config untuk koneksi database
    require '../../config.php';

    try {
        // Siapkan query untuk menghapus data berdasarkan cat_id
        $sql = "DELETE FROM tb_category WHERE cat_id = :cat_id";
        $stmt = $conn->prepare($sql);

        // Bind parameter
        $stmt->bindParam(':cat_id', $catId, PDO::PARAM_INT);

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
    // Jika cat_id tidak ada dalam URL, redirect ke halaman sebelumnya
        $_SESSION['message'] = "error";
}

// Redirect ke halaman sebelumnya (misalnya halaman daftar pekerjaan)
header('Location: ../leader/category.php');
exit();
?>
