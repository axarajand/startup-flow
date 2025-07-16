<?php
// Mulai session
session_start();

// Cek apakah ID dikirimkan melalui URL
if (isset($_GET['id'])) {
    // Ambil ID dari URL
    $userId = $_GET['id'];

    // Include file config untuk koneksi database
    require '../../config.php';

    try {
        // Siapkan query untuk mengambil nama file avatar berdasarkan user_id
        $sql = "SELECT user_avatar FROM tb_user WHERE user_id = :user_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();

        // Ambil data user
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Ambil nama file avatar
            $avatarFile = $user['user_avatar'];

            // Cek apakah avatar ada dan file dapat dihapus
            if ($avatarFile && file_exists("../../dist/img/avatar/$avatarFile")) {
                unlink("../../dist/img/avatar/$avatarFile"); // Menghapus file avatar
            }

            // Siapkan query untuk menghapus data pengguna dari database
            $deleteSql = "DELETE FROM tb_user WHERE user_id = :user_id";
            $deleteStmt = $conn->prepare($deleteSql);
            $deleteStmt->bindParam(':user_id', $userId, PDO::PARAM_INT);

            // Eksekusi query penghapusan data
            if ($deleteStmt->execute()) {
                // Set pesan sukses dan arahkan kembali ke halaman sebelumnya
                $_SESSION['message'] = "success";
            } else {
                // Set pesan gagal jika query tidak dieksekusi
                $_SESSION['message'] = "error";
            }
        } else {
            // Jika user tidak ditemukan
    $_SESSION['message'] = "error";
        }
    } catch (PDOException $e) {
        // Tangani error jika terjadi kesalahan pada query
    $_SESSION['message'] = "error";
    }
} else {
    // Jika ID tidak ada dalam URL
    $_SESSION['message'] = "error";
}

// Redirect ke halaman sebelumnya (misalnya halaman daftar tim)
header('Location: ../leader/team.php');
exit();
?>
