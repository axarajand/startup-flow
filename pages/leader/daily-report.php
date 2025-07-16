<?php
$title = 'Daily Report';
$userRole = 'Leader';
require '../session-check.php';
require '../crud/read_report.php';
?>

<?php require '../template-header.php'; ?>

<?php require '../template-sidebar.php'; ?>

    <div class="container py-6">

        <!-- Page Title Start -->
        <div class="flex items-center md:justify-between flex-wrap gap-2 mb-6">
            <h4 class="text-default-900 text-lg font-medium mb-2">Daily Report</h4>
        </div>
        <!-- Page Title End -->

        <div class="grid lg:grid-cols-1 grid-cols-1 gap-6">
            <div class="card overflow-hidden">
                <div class="card-header">
                    <h4 class="card-title">List Report</h4>
                </div>
                <div>
                    <div class="overflow-x-auto">
                        <div class="min-w-full inline-block align-middle">
                            <div class="overflow-hidden">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-start text-sm text-default-500">
                                                User</th>
                                            <th scope="col" class="px-6 py-3 text-start text-sm text-default-500">
                                                Job
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-start text-sm text-default-500">
                                                Project
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-start text-sm text-default-500">
                                                Task
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-start text-sm text-default-500">
                                                Date
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-start text-sm text-default-500">
                                                Duration
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-start text-sm text-default-500">
                                                Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                    <?php
                                        renderTableRows($reports, function($report) {
                                    ?>
                                        <tr class="hover:bg-gray-100">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-default-800">
                                                <?= htmlspecialchars($report['user_name']); ?></td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-default-800">
                                                <?= htmlspecialchars($report['job_name']); ?></td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-default-800">
                                                <?= htmlspecialchars($report['project_name']); ?></td>
                                            <td class="px-6 py-4 whitespace-wrap text-sm text-default-800">
                                                <?= htmlspecialchars($report['task_name']); ?></td>
                                            <td class="px-6 py-4 whitespace-wrap text-sm text-default-800">
                                                <?= date('d F Y H:i', strtotime($report['report_start_time'])); ?>
                                                -
                                                <?= date('d F Y H:i', strtotime($report['report_end_time'])); ?>
                                            </td>
                                            <td class="px-6 py-4 whitespace-wrap text-sm text-default-800">
                                            <?php
                                                $startTime = strtotime($report['report_start_time']);
                                                $endTime = strtotime($report['report_end_time']);
                                                $durationInSeconds = $endTime - $startTime;

                                                // Menghitung jam dan menit dari durasi
                                                $hours = floor($durationInSeconds / 3600); // 1 jam = 3600 detik
                                                $minutes = floor(($durationInSeconds % 3600) / 60); // Sisa dibagi 60 untuk menit

                                                echo sprintf('%02d Hours %02d Minutes', $hours, $minutes);
                                            ?>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                                <button class="text-primary hover:text-sky-700"
                                                    type="button"
                                                    data-toggle="modal"
                                                    data-hs-overlay="#modal-lg"
                                                    data-csv="<?= htmlspecialchars($report['report_csv']); ?>">
                                                    Detail
                                                </button>
                                            </td>
                                        </tr>
                                    <?php
                                        }, 7);
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
            <div
                class="-translate-y-5 hs-overlay-open:translate-y-0 hs-overlay-open:opacity-100 opacity-0 ease-in-out transition-all duration-500 sm:max-w-6xl sm:w-full my-8 sm:mx-auto flex flex-col bg-white shadow-sm rounded">
                <div
                    class="flex flex-col border border-default-200 shadow-sm rounded-lg  pointer-events-auto">
                    <div
                        class="flex justify-between items-center py-3 px-4 border-b border-default-200">
                        <h3 class="text-lg font-medium text-default-900">
                            Report Detail
                        </h3>
                        <button type="button" class="text-default-600 cursor-pointer"
                            data-hs-overlay="#modal-lg">
                            <i class="i-tabler-x text-lg"></i>
                        </button>
                    </div>
                    <div class="p-4 overflow-y-auto">
                        <div class="card overflow-hidden">
                        <div>
                            <div class="overflow-x-auto">
                                <div class="min-w-full inline-block align-middle">
                                    <div class="card overflow-hidden">
                                        <div>
                                            <div class="overflow-x-auto">
                                                <div class="min-w-full inline-block align-middle">
                                                    <div class="overflow-hidden">
                                                        <table class="min-w-full divide-y divide-gray-200">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col" class="px-6 py-3 text-start text-sm text-default-500">
                                                                        Time</th>
                                                                    <th scope="col" class="px-6 py-3 text-start text-sm text-default-500">
                                                                        Activity
                                                                    </th>
                                                                    <th scope="col" class="px-6 py-3 text-start text-sm text-default-500">
                                                                        Status
                                                                    </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody class="divide-y divide-gray-200" id="modal-content">

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
                </div>
            </div>
        </div>
    </div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Event delegation untuk tombol "Detail"
    document.querySelectorAll('[data-hs-overlay="#modal-lg"]').forEach(button => {
        button.addEventListener('click', function () {
            const csvFile = this.getAttribute('data-csv');
            const modalBody = document.getElementById('modal-content');
            modalBody.innerHTML = ''; // Reset isi modal

            fetch(`../../assets/report/csv/${csvFile}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('CSV file could not be loaded.');
                    }
                    return response.text();
                })
                .then(csvData => {
                    const rows = csvData.split('\n');
                    rows.slice(1).forEach(row => {
                        if (row.trim() !== '') {
                            const cols = row.split('|');
                            const rowHtml = `
                                <tr class="hover:bg-gray-100">
                                    <td class="px-6 py-4 whitespace-wrap text-sm text-default-800">${cols[2]}</td>
                                    <td class="px-6 py-4 whitespace-wrap text-sm text-default-800">${cols[3]}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-default-800">${cols[4]}</td>
                                </tr>
                            `;
                            modalBody.insertAdjacentHTML('beforeend', rowHtml);
                        }
                    });
                })
                .catch(error => {
                    modalBody.innerHTML = `<tr><td colspan="3" class="text-red-500 px-6 py-4">${error.message}</td></tr>`;
                });
        });
    });
});
</script>

<?php require '../template-footer.php'; ?>