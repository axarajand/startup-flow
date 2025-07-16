<?php
session_start(); // Memulai session
include('../../config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $task_name = $_POST['task_name'];
    $description = $_POST['description'];
    $project_to = $_POST['project_to'];
    $send_to = $_POST['send_to'];
    $deadline_start = $_POST['deadline_start'];
    $deadline_end = $_POST['deadline_end'];
    $created_at = date('Y-m-d H:i:s');
    $modified_dt = $created_at;

    // Format untuk upload file attachment
    if (isset($_FILES['attachment']) && $_FILES['attachment']['error'] == 0) {
        $attachment_name = $_FILES['attachment']['name'];
        $attachment_temp = $_FILES['attachment']['tmp_name'];
        $timestamp = time(); 
        $attachment_extension = pathinfo($attachment_name, PATHINFO_EXTENSION);
        $attachment_new_name = $timestamp . '.' . $attachment_extension;
        $upload_dir = '../../assets/attachment/';
        $attachment_path = $upload_dir . basename($attachment_new_name);
        move_uploaded_file($attachment_temp, $attachment_path);
    } else {
        $attachment_new_name = null; 
    }

    // Query untuk menambahkan data ke tabel `tb_task`
    $sql = "INSERT INTO tb_task 
            (task_record, task_name, task_description, task_project_id, task_user_id, task_attachment, task_deadline_start, task_deadline_end, task_created_at, task_modified_dt) 
            VALUES 
            ('set', :task_name, :description, :project_to, :send_to, :attachment, :deadline_start, :deadline_end, :created_at, :modified_dt)";

    $stmt = $conn->prepare($sql);

    // Bind parameter
    $stmt->bindParam(':task_name', $task_name);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':project_to', $project_to);
    $stmt->bindParam(':send_to', $send_to);
    $stmt->bindParam(':attachment', $attachment_new_name);
    $stmt->bindParam(':deadline_start', $deadline_start);
    $stmt->bindParam(':deadline_end', $deadline_end);
    $stmt->bindParam(':created_at', $created_at);
    $stmt->bindParam(':modified_dt', $modified_dt);

    // Eksekusi query dan set session message
    if ($stmt->execute()) {
        $_SESSION['message'] = "success";
    } else {
        $_SESSION['message'] = "error";
    }

    // Redirect kembali ke halaman sebelumnya
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}
?>