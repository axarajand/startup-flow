<?php
session_start();
if (!isset($_SESSION['user_id']) && !isset($_SESSION['user_role'])) {
    if($_SESSION['user_role'] == $userRole) {
        header('Location: ../../index.php');
        exit;
    }
    header('Location: ../../index.php');
    exit;
}

function renderTableRows($data, $callback, $colspan = 4) {
    if (count($data) > 0) {
        foreach ($data as $item) {
            $callback($item);
        }
    } else {
        echo '<tr>
            <td colspan="'.$colspan.'" class="px-6 py-4 text-center text-gray-500">
                Tidak Ada Data/Tugas untuk saat ini
            </td>
        </tr>';
    }
}
?>
