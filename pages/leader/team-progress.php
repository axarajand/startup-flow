<?php
$title = 'Team Progress';
$userRole = 'Leader';
require '../session-check.php';
require '../crud/read_task.php';
?>

<?php require '../template-header.php'; ?>

<?php require '../template-sidebar.php'; ?>

    <div class="container py-6">

        <!-- Page Title Start -->
        <div class="flex items-center md:justify-between flex-wrap gap-2 mb-6">
            <h4 class="text-default-900 text-lg font-medium mb-2">Team Progress</h4>
        </div>
        <!-- Page Title End -->

        <div class="grid lg:grid-cols-1 grid-cols-1 gap-6">
            <div class="card">
                <div class="card-header">
                    <div class="flex justify-between items-center">
                        <h4 class="card-title mb-4">Task Progress</h4>

                    </div>
                </div>
                <div class="p-3">
                    <div class="py-2 whitespace-nowrap text-sm font-medium text-default-800">
                        All Teams - <?= $allTeams['completed_tasks'] . '/' . $allTeams['total_tasks'] ?> Task
                    </div>
                    <div class="flex w-full h-4 bg-gray-200 rounded-full overflow-hidden">
                        <div class="flex flex-col justify-center overflow-hidden text-xs text-white text-center 
                            <?= $allTeams['completed_tasks'] == $allTeams['total_tasks'] ? 'bg-green-600' : ($allTeams['completed_tasks'] > $allTeams['total_tasks'] / 2 ? 'bg-yellow-600' : 'bg-red-600') ?>"
                            role="progressbar"
                            style="width: <?= calculateProgress($allTeams['completed_tasks'], $allTeams['total_tasks']) ?>%"
                            aria-valuenow="<?= calculateProgress($allTeams['completed_tasks'], $allTeams['total_tasks']) ?>"
                            aria-valuemin="0"
                            aria-valuemax="100">
                            <?= round(calculateProgress($allTeams['completed_tasks'], $allTeams['total_tasks'])) ?>%
                        </div>
                    </div>
                </div>
                <?php foreach ($taskData as $user): ?>
                <?php
                  // Ambil nama user berdasarkan user_id
                  $userQuery = "SELECT user_name, job_name FROM tb_user LEFT JOIN tb_job ON user_job_id = job_id WHERE user_id = :user_id";
                  $stmtUser = $conn->prepare($userQuery);
                  $stmtUser->bindParam(':user_id', $user['task_user_id']);
                  $stmtUser->execute();
                  $userData = $stmtUser->fetch(PDO::FETCH_ASSOC);
                ?>
                <div class="p-3">
                    <div class="py-2 whitespace-nowrap text-sm font-medium text-default-800 flex">
                        <?= $userData['user_name'] ?> (<?= $userData['job_name'] ?>) - <?= $user['completed_tasks'] . '/' . $user['total_tasks'] ?> Task
                        <i data-lucide="eye" class="size-5" style="margin-left: 7px; cursor: pointer;"
                            id="detail" data-toggle="modal" data-hs-overlay="#taskDetailModal" data-user-id="<?= $user['task_user_id'] ?>"></i>
                    </div>
                    <div class="flex w-full h-4 bg-gray-200 rounded-full overflow-hidden">
                        <div class="flex flex-col justify-center overflow-hidden text-xs text-white text-center
                        <?= $user['completed_tasks'] == $user['total_tasks'] ? 'bg-green-600' : ($user['completed_tasks'] > $user['total_tasks'] / 2 ? 'bg-yellow-600' : 'bg-red-600') ?>"
                            role="progressbar"
                            style="width: <?= calculateProgress($user['completed_tasks'], $user['total_tasks']) ?>%"
                            aria-valuenow="<?= calculateProgress($user['completed_tasks'], $user['total_tasks']) ?>"
                            aria-valuemin="0"
                            aria-valuemax="100">
                            <?= round(calculateProgress($user['completed_tasks'], $user['total_tasks'])) ?>%
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
       
    </div>

    <div class="">
        <div id="taskDetailModal"
            class="hs-overlay w-full h-full fixed top-0 left-0 z-70 transition-all duration-500 overflow-y-auto hidden pointer-events-none">
            <div
                class="-translate-y-5 hs-overlay-open:translate-y-0 hs-overlay-open:opacity-100 opacity-0 ease-in-out transition-all duration-500 sm:max-w-6xl sm:w-full my-8 sm:mx-auto flex flex-col bg-white shadow-sm rounded">
                <div
                    class="flex flex-col border border-default-200 shadow-sm rounded-lg  pointer-events-auto">
                    <div
                        class="flex justify-between items-center py-3 px-4 border-b border-default-200">
                        <h3 class="text-lg font-medium text-default-900">
                            Task Detail - <span id="modalUserName"></span>
                        </h3>
                        <button type="button" class="text-default-600 cursor-pointer"
                            data-hs-overlay="#taskDetailModal">
                            <i class="i-tabler-x text-lg"></i>
                        </button>
                    </div>
                    <div class="p-4 overflow-y-auto">
                        <div class="card overflow-hidden">
                        <div>
                            <div class="overflow-x-auto">
                                <div class="min-w-full inline-block align-middle">
                                    <div class="overflow-hidden">
                                        <table class="min-w-full divide-y divide-gray-200">
                                            <thead>
                                                <tr>
                                                    <th scope="col" class="px-6 py-3 text-start text-sm text-default-500">
                                                        Task Name</th>
                                                    <th scope="col" class="px-6 py-3 text-start text-sm text-default-500">
                                                        Description
                                                    </th>
                                                    <th scope="col" class="px-6 py-3 text-start text-sm text-default-500">
                                                        Attachment
                                                    </th>
                                                    <th scope="col" class="px-6 py-3 text-start text-sm text-default-500">
                                                        Status</th>
                                                </tr>
                                            </thead>
                                            <tbody class="divide-y divide-gray-200" id="modalTaskDetails">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
      $(document).on('click', '#detail', function () {
      var userId = $(this).data('user-id'); // Ambil user_id yang sesuai

      $.ajax({
        url: '../crud/read_task.php',
        method: 'GET',
        data: { user_id: userId },
        dataType: 'json',
        success: function (data) {
          if (data.error) {
            alert('Error: ' + data.error);
          } else {
            // Tampilkan nama user di modal
            $('#modalUserName').text(data.user_name);
            
            // Siapkan HTML untuk menampilkan tugas
            var taskHtml = '';
            $.each(data.tasks, function(index, task) {
              var taskStatus = '';
              var statusColor = '';

              // Tentukan status dan warnanya
              if (task.task_record === 'set') {
                taskStatus = 'Unfinished';
                statusColor = 'red';
              } else if (task.task_record === 'process' || task.task_record === 'paused') {
                taskStatus = 'On Progress';
                statusColor = 'orange';
              } else if (task.task_record === 'done') {
                taskStatus = 'Done';
                statusColor = 'green';
              } else if (task.task_record === 'request') {
                taskStatus = 'Request Approval';
                statusColor = 'blue';
              } else if (task.task_record === 'revision') {
                taskStatus = 'Revision';
                statusColor = 'maroon';
              }

              taskHtml += '<tr class="hover:bg-gray-100">';
              taskHtml += '<td class="px-6 py-4 whitespace-nowrap text-sm text-default-800">' + task.task_name + '</td>';
              taskHtml += '<td class="px-6 py-4 whitespace-wrap text-sm text-default-800">' + task.task_description + '</td>';
              taskHtml += `
                <td class="px-6 py-4 whitespace-nowrap text-sm text-default-800 text-primary hover:text-sky-700">
                  ${task.task_attachment ? 
                    `<a href="../../assets/attachment/${task.task_attachment}" target="_blank">
                      ${task.task_attachment} <i class="fas fa-eye ml-2"></i>
                    </a>` : 
                    'No Attachment'}
                </td>
              `;
              taskHtml += '<td class="px-6 py-4 whitespace-nowrap text-sm text-default-800" style="color: ' + statusColor + ';">' + taskStatus + '</td>';
              taskHtml += '</tr>';
            });

            // Masukkan taskHtml ke dalam modal
            $('#modalTaskDetails').html(taskHtml);
          }
        }
      });
    });
    </script>

<?php require '../template-footer.php'; ?>