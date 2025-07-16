<?php
$title = 'Personal Progress';
$userRole = 'Employee';
require '../session-check.php';
require '../crud/read_task.php';
?>

<?php require '../template-header.php'; ?>

<?php require '../template-sidebar.php'; ?>

    <div class="container py-6">

        <!-- Page Title Start -->
        <div class="flex items-center md:justify-between flex-wrap gap-2 mb-6">
            <h4 class="text-default-900 text-lg font-medium mb-2">Personal Progress</h4>
        </div>
        <!-- Page Title End -->

        <div class="grid lg:grid-cols-1 grid-cols-1 gap-6">
            <div class="card">
                <div class="card-header">
                    <div class="flex justify-between items-center">
                        <h4 class="card-title mb-4">Your List Task</h4>
                    </div>
                </div>
                <div class="p-3">
                    <div class="py-2 whitespace-nowrap text-sm font-medium text-default-800">
                        All Tasks Approved - <?= $approveTasks['completed_tasks'] . '/' . $allTasks['total_tasks'] ?> Tasks
                    </div>
                    <div class="flex w-full h-4 bg-gray-200 rounded-full overflow-hidden">
                        <div class="flex flex-col justify-center overflow-hidden text-xs text-white text-center
                        <?= $approveTasks['completed_tasks'] == $allTasks['total_tasks'] ? 'bg-green-600' : ($approveTasks['completed_tasks'] > $allTasks['total_tasks'] / 2 ? 'bg-yellow-600' : 'bg-red-600') ?>"
                            role="progressbar"
                            style="width: <?= calculateProgress($allTasks['completed_tasks'], $allTasks['total_tasks']) ?>%"
                            aria-valuenow="<?= calculateProgress($allTasks['completed_tasks'], $allTasks['total_tasks']) ?>"
                            aria-valuemin="0" aria-valuemax="100">
                            <?= round(calculateProgress($allTasks['completed_tasks'], $allTasks['total_tasks'])) ?>%
                        </div>
                    </div>
                </div>
                <div class="p-3 space-y-3">
                    <div>
                        <label class="block text-sm font-medium text-success mb-1">Approved</label>
                        <input type="text" class="w-full border border-gray-300 rounded px-3 py-2 bg-gray-100 text-success"
                            value="<?= (int)($approveTasks['completed_tasks'] ?? 0) ?> Tasks" disabled>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-info mb-1">On Progress</label>
                        <input type="text" class="w-full border border-gray-300 rounded px-3 py-2 bg-gray-100 text-info"
                            value="<?= (int)($onProgressTasks['completed_tasks'] ?? 0) ?> Tasks" disabled>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-800 mb-1">Request</label>
                        <input type="text" class="w-full border border-gray-300 rounded px-3 py-2 bg-gray-100 text-gray-800"
                            value="<?= (int)($requestTasks['completed_tasks'] ?? 0) ?> Tasks" disabled>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-warning mb-1">Revision</label>
                        <input type="text" class="w-full border border-gray-300 rounded px-3 py-2 bg-gray-100 text-warning"
                            value="<?= (int)($revisionTasks['completed_tasks'] ?? 0) ?> Tasks" disabled>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-danger mb-1">Unfinished</label>
                        <input type="text" class="w-full border border-gray-300 rounded px-3 py-2 bg-gray-100 text-danger"
                            value="<?= (int)($setTasks['completed_tasks'] ?? 0) ?> Tasks" disabled>
                    </div>
                </div>
            </div>
        </div>
       
    </div>

<?php require '../template-footer.php'; ?>