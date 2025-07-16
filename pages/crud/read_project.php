<?php
require '../../config.php';

$queryProject = "SELECT * FROM tb_project WHERE project_leader_id = :project_leader_id";
$queryProject = $conn->prepare($queryProject);
$queryProject->bindParam(':project_leader_id', $_SESSION['user_id'], PDO::PARAM_INT); 
$queryProject->execute();
$projects = $queryProject->fetchAll(PDO::FETCH_ASSOC);

if (isset($_GET['project_id']) && is_numeric($_GET['project_id'])) {
    $project_id = $_GET['project_id'];

    // Query untuk mendapatkan project_users_id berdasarkan project_id
    $queryProjectUsers = "
        SELECT project_users_id
        FROM tb_project
        WHERE project_id = :project_id
    ";
    $stmtProjectUsers = $conn->prepare($queryProjectUsers);
    $stmtProjectUsers->bindParam(':project_id', $project_id, PDO::PARAM_INT);
    $stmtProjectUsers->execute();
    $result = $stmtProjectUsers->fetch(PDO::FETCH_ASSOC);

        // Decode project_users_id dari format JSON
        $userIds = json_decode($result['project_users_id'], true);

        // Jika $userIds adalah array, lakukan query untuk mendapatkan data pengguna
        if (is_array($userIds) && count($userIds) > 0) {
            $queryUsers = "
                SELECT user_id, user_name
                FROM tb_user
                WHERE user_id IN (" . implode(',', array_map('intval', $userIds)) . ")
            ";
            $stmtUsers = $conn->prepare($queryUsers);
            $stmtUsers->execute();
            $users = $stmtUsers->fetchAll(PDO::FETCH_ASSOC);

            // Kembalikan hasil dalam format JSON
            echo json_encode($users);
            exit;
        }
    }
?>
