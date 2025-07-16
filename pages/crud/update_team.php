<?php
require '../../config.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $user_id = $_POST['user_id'] ?? null;
    $user_name = $_POST['user_name'] ?? null;
    $user_email = $_POST['user_email'] ?? null;
    $user_job = $_POST['user_job'] ?? null;
    $user_sph = $_POST['user_sph'] ?? null;

    // Proses upload avatar
    $avatar_dir = '../../assets/images/avatar/';
    $avatar_file = null;

    if (isset($_FILES['user_avatar']) && $_FILES['user_avatar']['error'] === UPLOAD_ERR_OK) {
        $tmp_name = $_FILES['user_avatar']['tmp_name'];
        $file_name = basename($_FILES['user_avatar']['name']);
        $avatar_path = $avatar_dir . $file_name;

        if (move_uploaded_file($tmp_name, $avatar_path)) {
            $avatar_file = $file_name; // Simpan hanya nama file ke database
        }
    }

    try {
        // Persiapkan query untuk update data
        $query = "UPDATE tb_user 
                  SET user_name = :user_name, 
                      user_email = :user_email, 
                      user_job_id = :user_job,
                      user_sph = :user_sph";

        // Tambahkan kolom avatar jika ada file baru
        if ($avatar_file) {
            $query .= ", user_avatar = :user_avatar";
        }

        $query .= " WHERE user_id = :user_id";

        $stmt = $conn->prepare($query);

        // Bind parameter
        $stmt->bindParam(':user_name', $user_name);
        $stmt->bindParam(':user_email', $user_email);
        $stmt->bindParam(':user_job', $user_job);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':user_sph', $user_sph);

        // Bind avatar jika ada file baru
        if ($avatar_file) {
            $stmt->bindParam(':user_avatar', $avatar_file);
        }

        // Eksekusi query
        if ($stmt->execute()) {
            $_SESSION['message'] = "success";
        } else {
            $_SESSION['message'] = "error";
        }
    } catch (Exception $e) {
        $_SESSION['message'] = "error";
    }

    // Redirect kembali ke halaman team
    header('Location: ../leader/team.php');
    exit;
} else {
    header('Location: ../leader/team.php');
    exit;
}
