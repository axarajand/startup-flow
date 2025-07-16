<?php
$title = 'Revision';
$userRole = 'Employee';
require '../session-check.php';
require '../crud/read_working_plans.php';
?>

<?php require '../template-header.php'; ?>

<?php require '../template-sidebar.php'; ?>

    <div class="container py-6">

        <!-- Page Title Start -->
        <div class="flex items-center md:justify-between flex-wrap gap-2 mb-6">
            <h4 class="text-default-900 text-lg font-medium mb-2">Revision</h4>
        </div>
        <!-- Page Title End -->

        <div class="grid lg:grid-cols-1 grid-cols-1 gap-6">
            <div class="card overflow-hidden">
                <div class="card-header">
                    <h4 class="card-title">List Revision</h4>
                </div>
                <div>
                    <div class="overflow-x-auto">
                        <div class="min-w-full inline-block align-middle">
                            <div class="overflow-hidden">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-start text-sm text-default-500">
                                                Task</th>
                                            <th scope="col" class="px-6 py-3 text-start text-sm text-default-500">
                                                Deadline End
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-start text-sm text-default-500">
                                                Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                    <?php
                                        renderTableRows($HTaskUserRevision, function($htr) {
                                    ?>
                                        <tr class="hover:bg-gray-100">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-default-800">
                                                <?= htmlspecialchars($htr['task_name']); ?></td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-default-800">
                                                <?= htmlspecialchars($htr['task_deadline_end']); ?> </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <button class="text-primary hover:text-sky-700"
                                                  type="button"
                                                  data-toggle="modal"
                                                  data-hs-overlay="#modal-lg"
                                                  data-task-id="<?= $htr['task_id']; ?>"
                                                  data-task-name="<?= htmlspecialchars($htr['task_name']); ?>"
                                                  data-description="<?= htmlspecialchars($htr['task_description']); ?>"
                                                  data-file="<?= htmlspecialchars($htr['task_attachment']); ?>"
                                                  data-deadline-start="<?= date('d F Y H:i', strtotime($htr['task_deadline_start'])); ?>"
                                                  data-deadline-end="<?= date('d F Y H:i', strtotime($htr['task_deadline_end'])); ?>"
                                                  >
                                                  Detail
                                                </button>
                                            </td>
                                        </tr>         
                                    <?php
                                        }, 3);
                                    ?>                         
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       
    </div>

    <div class="">
        <div id="modal-lg" class="hs-overlay w-full h-full fixed top-0 left-0 z-70 transition-all duration-500 overflow-y-auto hidden pointer-events-none">
            <div class="-translate-y-5 hs-overlay-open:translate-y-0 hs-overlay-open:opacity-100 opacity-0 ease-in-out transition-all duration-500 sm:max-w-2xl sm:w-full my-8 sm:mx-auto flex flex-col bg-white shadow-sm rounded"> 
                    <div
                        class="flex flex-col border border-default-200 shadow-sm rounded-lg  pointer-events-auto">
                        <div
                            class="flex justify-between items-center py-3 px-4 border-b border-default-200">
                            <h3 class="text-lg font-medium text-default-900">
                                Detail Task
                            </h3>
                            <button type="button" class="text-default-600 cursor-pointer"
                                data-hs-overlay="#modal-lg">
                                <i class="i-tabler-x text-lg"></i>
                            </button>
                        </div>
                        <div class="p-4 overflow-y-auto">
                            <div class="grid grid-cols-1 md:grid-cols-1 gap-6">

                                <div class="lg:col-span-2">
                                    <label for="inputName" class="text-default-800 text-sm font-medium inline-block mb-2">Task Name</label>
                                    <input type="text" class="form-input" id="inputName" disabled>
                                </div>

                                <div class="lg:col-span-2">
                                    <label for="inputDescription" class="text-default-800 text-sm font-medium inline-block mb-2">Description</label>
                                    <textarea id="inputDescription" class="form-input" class="form-control" rows="4" disabled></textarea>
                                </div>

                                <div class="lg:col-span-2">
                                    <label class="text-default-800 text-sm font-medium inline-block mb-2">Attachment</label>
                                    <table class="form-input" style="background-color: #E9ECEF; border-radius: 5px;">
                                        <tbody id="attachmentTable" class="min-w-full divide-y divide-gray-200"></tbody>
                                    </table>
                                </div>

                                <div class="lg:col-span-2">
                                    <label for="inputDeadlineStart" class="text-default-800 text-sm font-medium inline-block mb-2">Deadline Start</label>
                                    <input type="text" class="form-input" id="inputDeadlineStart" disabled>
                                </div>

                                <div class="lg:col-span-2">
                                    <label for="inputDeadlineEnd" class="text-default-800 text-sm font-medium inline-block mb-2">Deadline End</label>
                                    <input type="text" class="form-input" id="inputDeadlineEnd" disabled>
                                </div>
                        </div>
                        <div
                            class="flex justify-end items-center gap-x-2 py-3 px-4 border-t border-default-200">
                            <a class="py-2 px-5 inline-flex items-center justify-center font-medium tracking-wide align-middle duration-500 text-sm text-center btn bg-success hover:bg-primary-700 hover:border-primary-700 text-white rounded-md"
                                href="#" id="revisionTaskLink">
                                Request Again
                            </a>
                        </div>
                    </div>
            </div>
        </div>
    </div>

    <script>
      $(document).ready(function() {
        // Ketika tombol Detail diklik
        $('button[data-toggle="modal"]').on('click', function() {
          var taskId = $(this).data('task-id');
          var taskName = $(this).data('task-name');
          var description = $(this).data('description');
          var file = $(this).data('file');
          var deadlineStart = $(this).data('deadline-start');
          var deadlineEnd = $(this).data('deadline-end');

          // Isi nilai di modal
          $('#inputName').val(taskName);
          $('#inputDescription').val(description);
          $('#inputDeadlineStart').val(deadlineStart);
          $('#inputDeadlineEnd').val(deadlineEnd);

          // Menangani lampiran (jika ada)
          var attachmentHtml = '';
          if (file) {
            // Mengambil nama file dan ukuran file
            var fileName = file.split('/').pop(); // Ambil nama file saja
            var fileSize = (new Blob([file]).size / 1024).toFixed(2); // Ukuran file dalam KB
            attachmentHtml = `
                <tr>
                    <td>
                        <a href="../../assets/attachment/${file}" target="_blank" data-lucide="eye">
                            See Attach (${file} - ${(new Blob([file]).size / 1024).toFixed(2)} kb)
                        </a>
                    </td>
                </tr>
            `;
          } else {
            attachmentHtml = `
              <tr>
                <td colspan="3">No attachment available</td>
              </tr>
            `;
          }

          // Masukkan HTML lampiran ke dalam tabel
          $('#attachmentTable').html(attachmentHtml);

          document.getElementById("revisionTaskLink").setAttribute('href', '../crud/update_task_req.php?task_id=' + taskId + '&task_record=request');

        });
      });
    </script>

<?php require '../template-footer.php'; ?>