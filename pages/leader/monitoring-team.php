<?php
$title = 'Monitoring Team';
$userRole = 'Leader';
require '../session-check.php';
require '../crud/read_working_plans.php';
?>

<?php require '../template-header.php'; ?>

<?php require '../template-sidebar.php'; ?>

    <div class="container py-6">

        <!-- Page Title Start -->
        <div class="flex items-center md:justify-between flex-wrap gap-2 mb-6">
            <h4 class="text-default-900 text-lg font-medium mb-2">Monitoring Team</h4>
        </div>
        <!-- Page Title End -->

        <div class="grid lg:grid-cols-1 grid-cols-1 gap-6">
            <div class="card overflow-hidden">
                <div class="card-header">
                    <h4 class="card-title">List Task</h4>
                </div>
                <div>
                    <div class="overflow-x-auto">
                        <div class="min-w-full inline-block align-middle">
                            <div class="overflow-hidden">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-start text-sm text-default-500">
                                                Name</th>
                                            <th scope="col" class="px-6 py-3 text-start text-sm text-default-500">
                                                Role
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-start text-sm text-default-500">
                                                Task
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-start text-sm text-default-500">
                                                Status
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-start text-sm text-default-500">
                                                Deadline End
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-end text-sm text-default-500">
                                                Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                    <?php
                                        renderTableRows($HTaskProcess, function($htr) {
                                    ?>
                                        <tr class="hover:bg-gray-100">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-default-800">
                                                <?= htmlspecialchars($htr['user_name']); ?></td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-default-800">
                                                <?= htmlspecialchars($htr['job_name']); ?></td>
                                            <td class="px-6 py-4 whitespace-wrap text-sm text-default-800">
                                                <?= htmlspecialchars($htr['task_name']); ?></td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-default-800">
                                                On Progress</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-default-800">
                                                <?= htmlspecialchars($htr['task_deadline_end']); ?></td>
                                            <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                                <button class="text-primary hover:text-sky-700"
                                                      type="button"
                                                      data-toggle="modal"
                                                      data-hs-overlay="#modal-lg"
                                                      data-task-id="<?= $htr['task_id']; ?>"
                                                      data-user-name="<?= htmlspecialchars($htr['user_name']); ?>"
                                                      data-task-name="<?= htmlspecialchars($htr['task_name']); ?>"
                                                      data-description="<?= htmlspecialchars($htr['task_description']); ?>"
                                                      data-file="<?= htmlspecialchars($htr['task_attachment']); ?>"
                                                      data-deadline-start="<?= date('d F Y H:i', strtotime($htr['task_deadline_start'])); ?>"
                                                      data-deadline-end="<?= date('d F Y H:i', strtotime($htr['task_deadline_end'])); ?>"
                                                      data-task-record="On Progress"
                                                      data-report-video="<?= htmlspecialchars($htr['report_video']); ?>">
                                                Detail</button>
                                            </td>
                                        </tr>
                                    <?php
                                        }, 6);
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
        <div id="modal-lg"
            class="hs-overlay w-full h-full fixed top-0 left-0 z-70 transition-all duration-500 overflow-y-auto hidden pointer-events-none">
            <div class="-translate-y-5 hs-overlay-open:translate-y-0 hs-overlay-open:opacity-100 opacity-0 ease-in-out transition-all duration-500 sm:max-w-6xl sm:w-full my-8 sm:mx-auto flex flex-col bg-white shadow-sm rounded"> 
                <form action="../crud/update_job.php" method="POST">
                    <div
                        class="flex flex-col border border-default-200 shadow-sm rounded-lg  pointer-events-auto">
                        <div
                            class="flex justify-between items-center py-3 px-4 border-b border-default-200">
                            <h3 class="text-lg font-medium text-default-900">
                                Monitoring
                            </h3>
                            <button type="button" class="text-default-600 cursor-pointer"
                                data-hs-overlay="#modal-lg">
                                <i class="i-tabler-x text-lg"></i>
                            </button>
                        </div>
                        <div class="p-4 overflow-y-auto">    
                            <table class="w-full text-sm text-center border border-gray-200 rounded-lg overflow-hidden shadow-md">
                              <thead class="bg-gray-100">
                                <tr>
                                  <th class="py-3 px-4 font-semibold text-gray-700">Team: -</th>
                                  <th class="py-3 px-4 font-semibold text-gray-700">Task: -</th>
                                  <th class="py-3 px-4 font-semibold text-gray-700">Status: -</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr class="bg-gray-200">
                                  <td class="py-2 px-4 font-bold text-gray-800 text-center" colspan="3">View Screen User</td>
                                </tr>
                                <tr>
                                  <td colspan="3" class="p-4 bg-white">
                                    <video id="videoPlayer" controls autoplay loop class="w-full h-auto rounded-md border border-gray-300">
                                      <source id="videoSource" src="" type="video/mp4">
                                      Your browser does not support the video tag.
                                    </video>
                                    <div id ="videoRaw"></div>
                                  </td>
                                </tr>
                                <tr class="bg-gray-200">
                                  <td class="py-2 px-4 font-bold text-gray-800 text-center" colspan="3">Report</td>
                                </tr>
                                <tr>
                                  <td class="py-4 px-4 text-gray-500" colspan="3">-</td>
                                </tr>
                              </tbody>
                            </table>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
    // Event listener untuk tombol dengan data-task-id
    document.addEventListener('click', function (e) {
        if (e.target.closest('button[data-task-id]')) {
            const button = e.target.closest('button');

            // Ambil data dari atribut tombol
            const taskId = button.getAttribute('data-task-id');
            const userName = button.getAttribute('data-user-name');
            const taskName = button.getAttribute('data-task-name');
            const description = button.getAttribute('data-description');
            const deadlineStart = button.getAttribute('data-deadline-start');
            const deadlineEnd = button.getAttribute('data-deadline-end');
            const taskRecord = button.getAttribute('data-task-record');
            const videoFileName = button.getAttribute('data-report-video');

            // Path file .mp4
            const mp4Path = `../../assets/report/video/${videoFileName}`;
            // Path file _raw.avi
            const rawPath = `../../assets/report/video/${videoFileName.replace('.mp4', '_raw.avi')}`;

            // Bersihkan konten div#videoRaw
            const videoRawDiv = document.querySelector('#videoRaw');
            videoRawDiv.innerHTML = "";

            // Cek apakah file .mp4 ada
            fetch(mp4Path, { method: 'HEAD' })
                .then((response) => {
                    const videoElement = document.querySelector('#videoPlayer');
                    const videoSource = document.querySelector('#videoSource');

                    if (response.ok) {
                        // ✅ File .mp4 ditemukan, tampilkan video
                        videoSource.setAttribute('src', mp4Path);
                        videoElement.style.display = "block";
                        videoRawDiv.style.display = "none"; // hide fallback
                    } else {
                        // ❌ File .mp4 tidak ditemukan
                        console.warn(`.mp4 not found, fallback to RAW file: ${rawPath}`);

                        // Sembunyikan video player
                        videoElement.style.display = "none";

                        // Tambahkan teks & tombol download di div#videoRaw
                        videoRawDiv.innerHTML = `
                            <p class="text-red-600 font-semibold">
                                Video playback failed!<br>
                            </p>
                        `;
                        videoRawDiv.style.display = "block";
                    }

                    // Isi data ke modal
                    document.querySelector('#modal-lg th:nth-child(1)').textContent = `Name: ${userName}`;
                    document.querySelector('#modal-lg th:nth-child(2)').textContent = `Task: ${taskName}`;
                    document.querySelector('#modal-lg th:nth-child(3)').textContent = `Status: ${taskRecord}`;
                    document.querySelector('#modal-lg tbody tr:nth-child(4) td').textContent = `Deadline End: ${deadlineEnd}`;

                    // Muat ulang video
                    videoElement.load();
                    videoElement.play().catch((error) => {
                        console.error('Video playback failed:', error);
                    });
                })
                .catch((err) => {
                    console.error('Error checking video file:', err);
                });
        }
    });
    </script>

<?php require '../template-footer.php'; ?>