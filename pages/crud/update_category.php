<?php
require '../../config.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cat_id = $_POST['cat_id'] ?? null;
    $cat_name = $_POST['cat_name'] ?? null;

    if ($cat_id && $cat_name) {
        try {
            // Query untuk update kategori
            $query = "UPDATE tb_category SET cat_name = :cat_name WHERE cat_id = :cat_id";
            $stmt = $conn->prepare($query);

            // Bind parameter
            $stmt->bindParam(':cat_name', $cat_name);
            $stmt->bindParam(':cat_id', $cat_id);

            // Eksekusi query
            if ($stmt->execute()) {
                $_SESSION['message'] = "success";
                header('Location: ../leader/category.php');
                exit;
            } else {
                $_SESSION['message'] = "error";
                header('Location: ../leader/category.php');
                exit;
            }
        } catch (Exception $e) {
            $_SESSION['message'] = "error";
            header('Location: ../leader/category.php');
            exit;
        }
    } else {
        $_SESSION['message'] = "error";
        header('Location: ../leader/category.php');
        exit;
    }
} else {
    header('Location: ../leader/category.php');
    exit;
}