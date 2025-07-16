<?php
require '../../config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $project_name = $_POST['project_name'] ?? null;
    $description = $_POST['description'] ?? null;
    $project_category = $_POST['project_category'] ?? null;
    $project_budget = $_POST['project_anggaran'] ?? null;
    $project_leader_id = $_SESSION['user_id'] ?? null; // Ambil ID leader dari session
    $inputUsers = $_POST['inputUsers'] ?? []; // Ambil input dari checkbox, default array kosong

    // Ubah nilai inputUsers menjadi format array JSON numerik
    $project_users_id = json_encode(array_map('intval', $inputUsers), JSON_NUMERIC_CHECK); // Pastikan angka

    try {
        // Persiapkan query untuk insert data
        $query = "INSERT INTO tb_project 
            (project_name, project_description, project_budget, project_category_id, project_leader_id, project_users_id, project_created_at) 
            VALUES 
            (:project_name, :description, :budget, :category_id, :leader_id, :users_id, NOW())";

        $stmt = $conn->prepare($query);

        // Bind parameter
        $stmt->bindParam(':project_name', $project_name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':budget', $project_budget);
        $stmt->bindParam(':category_id', $project_category);
        $stmt->bindParam(':leader_id', $project_leader_id);
        $stmt->bindParam(':users_id', $project_users_id);

        // Eksekusi query
        if ($stmt->execute()) {
            $_SESSION['message'] = "success";
            header('Location: ../leader/set-project.php');
            exit;
        } else {
            $_SESSION['message'] = "error";
            header('Location: ../leader/set-project.php');
            exit;
        }
    } catch (Exception $e) {
        $_SESSION['message'] = "error";
        header('Location: ../leader/set-project.php');
        exit;
    }
} else {
    // Jika file ini diakses tanpa POST, redirect ke halaman form
    header('Location: ../leader/set-project.php');
    exit;
}
