<?php
// Koneksi ke database
include '../../config.php';

// Ambil data jumlah task yang sudah selesai dan jumlah total task per user
$query = "
    SELECT task_user_id, COUNT(*) as total_tasks, 
           SUM(task_record = 'done') as completed_tasks 
    FROM tb_task 
    GROUP BY task_user_id
";
$stmt = $conn->prepare($query);
$stmt->execute();
$taskData = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Data untuk semua task
$queryAllTeams = "
    SELECT COUNT(*) as total_tasks, 
           SUM(task_record = 'done') as completed_tasks 
    FROM tb_task
";
$stmtAllTeams = $conn->prepare($queryAllTeams);
$stmtAllTeams->execute();
$allTeams = $stmtAllTeams->fetch(PDO::FETCH_ASSOC);

// Fungsi untuk menghitung persentase progress
function calculateProgress($completed, $total) {
    return $total > 0 ? ($completed / $total) * 100 : 0;
}

if (isset($_GET['user_id'])) {
    $userId = $_GET['user_id'];

    // Ambil nama user berdasarkan user_id
    $queryUser = "SELECT user_name FROM tb_user WHERE user_id = :user_id";
    $stmtUser = $conn->prepare($queryUser);
    $stmtUser->bindParam(':user_id', $userId);
    $stmtUser->execute();
    $userData = $stmtUser->fetch(PDO::FETCH_ASSOC);

    // Ambil daftar tugas (task) berdasarkan user_id
    $queryTasks = "
        SELECT task_name, task_description, task_attachment, task_record 
        FROM tb_task 
        WHERE task_user_id = :user_id
    ";
    $stmtTasks = $conn->prepare($queryTasks);
    $stmtTasks->bindParam(':user_id', $userId);
    $stmtTasks->execute();
    $tasks = $stmtTasks->fetchAll(PDO::FETCH_ASSOC);

    // Siapkan data untuk respons
    $response = [
        'user_name' => $userData['user_name'],
        'tasks' => $tasks
    ];

    // Kirimkan data sebagai JSON
    echo json_encode($response);
}

// Query untuk mengambil total dan completed tasks berdasarkan task_record untuk user tertentu
$queryAllTasks = "
    SELECT COUNT(*) as total_tasks, 
           SUM(task_record = 'done') as completed_tasks 
    FROM tb_task
    WHERE task_user_id = :user_id
";
$stmtAllTasks = $conn->prepare($queryAllTasks);
$stmtAllTasks->bindParam(':user_id', $_SESSION["user_id"]);
$stmtAllTasks->execute();
$allTasks = $stmtAllTasks->fetch(PDO::FETCH_ASSOC);

// Query untuk mendapatkan total dan completed tasks dengan status 'request' untuk user tertentu
$queryRequestTasks = "
    SELECT COUNT(*) as total_tasks, 
           SUM(task_record IN ('request','paused')) as completed_tasks 
    FROM tb_task
    WHERE task_user_id = :user_id
";
$stmtRequestTasks = $conn->prepare($queryRequestTasks);
$stmtRequestTasks->bindParam(':user_id', $_SESSION["user_id"]);
$stmtRequestTasks->execute();
$requestTasks = $stmtRequestTasks->fetch(PDO::FETCH_ASSOC);

// Query untuk mendapatkan total dan completed tasks dengan status 'done' untuk user tertentu
$queryApproveTasks = "
    SELECT COUNT(*) as total_tasks, 
           SUM(task_record = 'done') as completed_tasks 
    FROM tb_task
    WHERE task_user_id = :user_id
";
$stmtApproveTasks = $conn->prepare($queryApproveTasks);
$stmtApproveTasks->bindParam(':user_id', $_SESSION["user_id"]);
$stmtApproveTasks->execute();
$approveTasks = $stmtApproveTasks->fetch(PDO::FETCH_ASSOC);

// Query untuk mendapatkan total dan completed tasks dengan status 'process' untuk user tertentu
$queryOnProgressTasks = "
    SELECT COUNT(*) as total_tasks, 
           SUM(task_record = 'process') as completed_tasks 
    FROM tb_task
    WHERE task_user_id = :user_id
";
$stmtOnProgressTasks = $conn->prepare($queryOnProgressTasks);
$stmtOnProgressTasks->bindParam(':user_id', $_SESSION["user_id"]);
$stmtOnProgressTasks->execute();
$onProgressTasks = $stmtOnProgressTasks->fetch(PDO::FETCH_ASSOC);

// Query untuk mendapatkan total dan completed tasks dengan status 'revision' untuk user tertentu
$queryRevisionTasks = "
    SELECT COUNT(*) as total_tasks, 
           SUM(task_record = 'revision') as completed_tasks 
    FROM tb_task
    WHERE task_user_id = :user_id
";
$stmtRevisionTasks = $conn->prepare($queryRevisionTasks);
$stmtRevisionTasks->bindParam(':user_id', $_SESSION["user_id"]);
$stmtRevisionTasks->execute();
$revisionTasks = $stmtRevisionTasks->fetch(PDO::FETCH_ASSOC);

// Ambil data task dengan status 'set' untuk user tertentu
$querySetTasks = "
    SELECT COUNT(*) as total_tasks, 
           SUM(task_record = 'set') as completed_tasks 
    FROM tb_task
    WHERE task_user_id = :user_id AND task_record = 'set'
";
$stmtSetTasks = $conn->prepare($querySetTasks);
$stmtSetTasks->bindParam(':user_id', $_SESSION["user_id"]); // Ganti $userId dengan user ID yang sesuai
$stmtSetTasks->execute();
$setTasks = $stmtSetTasks->fetch(PDO::FETCH_ASSOC);
?>