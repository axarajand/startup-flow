<?php
require '../../config.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $user_name = $_POST['user_name'] ?? null;
    $user_email = $_POST['user_email'] ?? null;
    $user_password = $_POST['user_password'] ?? null;
    $user_job = $_POST['user_job'] ?? null;
    $user_role = $_POST['user_role'] ?? null;
    $user_leader_id = $_POST['user_leader_id'] ?? null;
    $user_sph = $_POST['user_sph'] ?? null;

    // Proses upload avatar
    $avatar_dir = '../../assets/images/avatar/';
    $avatar_file = null;

    if (isset($_FILES['user_avatar']) && $_FILES['user_avatar']['error'] === UPLOAD_ERR_OK) {
        $tmp_name = $_FILES['user_avatar']['tmp_name'];
        $file_name = basename($_FILES['user_avatar']['name']);
        $avatar_file = $avatar_dir . $file_name;

        if (move_uploaded_file($tmp_name, $avatar_file)) {
            $avatar_file = $file_name; // Simpan relative path ke database
        } else {
            $avatar_file = null;
        }
    }

    try {
        // Persiapkan query untuk insert data
        $query = "INSERT INTO tb_user 
            (user_name, user_avatar, user_email, user_password, user_job_id, user_sph, user_role, user_leader_id, user_created_at) 
            VALUES 
            (:user_name, :user_avatar, :user_email, MD5(:user_password), :user_job, :user_sph, :user_role, :user_leader_id, NOW())";

        $stmt = $conn->prepare($query);
        $stmt->bindParam(':user_name', $user_name);
        $stmt->bindParam(':user_avatar', $avatar_file);
        $stmt->bindParam(':user_email', $user_email);
        $stmt->bindParam(':user_password', $user_password);
        $stmt->bindParam(':user_job', $user_job);
        $stmt->bindParam(':user_role', $user_role);
        $stmt->bindParam(':user_leader_id', $user_leader_id);
        $stmt->bindParam(':user_sph', $user_sph);

        // Eksekusi query
        if ($stmt->execute()) {
            // Jika berhasil, kembali ke halaman semula dengan pesan sukses
            $_SESSION['message'] = "success";
            header('Location: ../leader/team.php');
            exit;
        } else {
            // Jika gagal, kembali ke halaman semula dengan pesan error
            $_SESSION['message'] = "error";
            header('Location: ../leader/team.php');
            exit;
        }
    } catch (Exception $e) {
        // Jika terjadi kesalahan, kembali ke halaman semula dengan pesan error
        $_SESSION['message'] = "error";
        header('Location: ../leader/team.php');
        exit;
    }
} else {
    // Jika file ini diakses tanpa POST, redirect ke halaman form
    header('Location: ../leader/team.php');
    exit;
}
