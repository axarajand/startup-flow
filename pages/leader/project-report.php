<?php
$title = 'Project Report';
$userRole = 'Leader';
require '../session-check.php';
require '../crud/read_report.php';
require '../../config.php';
?>

<?php require '../template-header.php'; ?>

<?php require '../template-sidebar.php'; ?>

    <div id="overlay-loader" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="text-white text-lg font-semibold animate-pulse">
            ⏳ Processing... Please wait
        </div>
    </div>

    <div class="container py-6">

        <!-- Page Title Start -->
        <div class="flex items-center md:justify-between flex-wrap gap-2 mb-6">
            <h4 class="text-default-900 text-lg font-medium mb-2">Project Report</h4>
        </div>
        <!-- Page Title End -->

        <div class="grid lg:grid-cols-1 grid-cols-1 gap-6">
            <div class="card overflow-hidden">
                <div class="card-header flex justify-between items-center">
                    <h4 class="card-title">List Project Report</h4>
                </div>
                <div>
                    <div class="overflow-x-auto">
                        <div class="min-w-full inline-block align-middle">
                            <div class="overflow-hidden">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-start text-sm text-default-500">
                                                Project Name</th>
                                            <th scope="col" class="px-6 py-3 text-start text-sm text-default-500">
                                                Project Budget
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-start text-sm text-default-500">
                                                Total Member of Teams
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-start text-sm text-default-500">
                                                Budget Estimated
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-start text-sm text-default-500">
                                                Completed Estimated
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-start text-sm text-default-500">
                                                Report</th>
                                            <th scope="col" class="px-6 py-3 text-start text-sm text-default-500">
                                                Calculate
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                    <?php
                                        // Menampilkan data laporan
                                        renderTableRows($reportsEnd, function($rp) {

                                        // Path ke file JSON
                                        $leader_id = $rp['project_leader_id'];
                                        $project_id = $rp['project_id'];
                                        $jsonFilePath = "C:/xampp/htdocs/startup-flow/assets/report/csv/report_users/{$leader_id}_{$project_id}/estimated_project_{$leader_id}_{$project_id}.json";

                                        // Cek apakah file JSON ada
                                        if (file_exists($jsonFilePath)) {
                                            // Membaca file JSON
                                            $jsonData = file_get_contents($jsonFilePath);

                                            // Mengonversi JSON ke array PHP
                                            $estimatedData = json_decode($jsonData, true);
                                        } else {
                                            // Jika file JSON tidak ada, set data estimasi ke null
                                            $estimatedData = null;
                                        }
                                    ?>
                                        <tr class="hover:bg-gray-100">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-default-800">
                                                <?= htmlspecialchars($rp['project_name']); ?></td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-default-800">
                                                Rp. <?= number_format(htmlspecialchars($rp['project_budget']), 2); ?></td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-default-800">
                                                <?= count(explode(',', htmlspecialchars($rp['project_users_id']))); ?></td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-default-800">
                                                <?php if ($estimatedData): ?>
                                                    <!-- Menampilkan estimasi biaya dari JSON jika file ada -->
                                                    Rp. <?= number_format($estimatedData['estimated_total_cost_idr'], 2); ?>
                                                <?php else: ?>
                                                    <!-- Kolom kosong jika file JSON tidak ada -->
                                                    -
                                                <?php endif; ?>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-default-800">
                                                <?php if ($estimatedData): ?>
                                                    <!-- Menampilkan estimasi waktu dari JSON jika file ada -->
                                                    <?= $estimatedData['estimated_completion_time_days']; ?> days
                                                <?php else: ?>
                                                    <!-- Kolom kosong jika file JSON tidak ada -->
                                                    -
                                                <?php endif; ?>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <button type="button" class="text-primary hover:text-sky-700"
                                                    data-toggle="modal" data-hs-overlay="#modal-lg"
                                                    onclick="loadReport(<?= $rp['project_leader_id']; ?>, <?= $rp['project_id']; ?>)">
                                                    Detail
                                                </button>
                                            </td>
                                            <td class="px-6 py-4 whitespace-wrap text-sm font-medium">
                                                <div class="flex flex-col gap-2">
                                                    <a href="javascript:void(0)"
                                                    onclick="runScript('mergecsv', <?= $rp['project_leader_id']; ?>, <?= $rp['project_id']; ?>)"
                                                    class="w-full py-2 px-4 inline-flex items-center justify-center font-medium tracking-wide border align-middle duration-500 text-sm text-center bg-primary hover:bg-primary-700 border-primary hover:border-primary-700 text-white rounded-md">
                                                        Load CSV
                                                    </a>

                                                    <a href="javascript:void(0)"
                                                    onclick="runScript('refreshestimated', <?= $rp['project_leader_id']; ?>, <?= $rp['project_id']; ?>)"
                                                    class="w-full py-2 px-4 inline-flex items-center justify-center font-medium tracking-wide border align-middle duration-500 text-sm text-center bg-primary hover:bg-primary-700 border-primary hover:border-primary-700 text-white rounded-md">
                                                        Refresh Estimated
                                                    </a>

                                                    <a href="javascript:void(0)"
                                                    onclick="runScript('timecostestimated', <?= $rp['project_leader_id']; ?>, <?= $rp['project_id']; ?>)"
                                                    class="w-full py-2 px-4 inline-flex items-center justify-center font-medium tracking-wide border align-middle duration-500 text-sm text-center bg-primary hover:bg-primary-700 border-primary hover:border-primary-700 text-white rounded-md">
                                                        Project Estimated
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php
                                        }, 5);
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
                                <div class="min-w-full inline-block align-middle modal-body">
                                    
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
        function runScript(type, leaderId, projectId) {
            Swal.fire({
                title: 'Processing...',
                html: 'Please wait while the script runs.',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading()
                }
            });

            fetch(`../crud/${type}.php?leader_id=${leaderId}&project_id=${projectId}`)
                .then(res => res.text())
                .then(result => {
                    if (result.trim() === "success") {
                        Swal.fire({
                            icon: 'success',
                            title: 'Completed!',
                            text: `${type} executed successfully.`,
                        }).then(() => window.location.reload());
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Failed',
                            text: result
                        });
                    }
                })
                .catch(err => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: err
                    });
                });
        }

        
    function loadReport(leaderId, projectId) {
        // Mengambil data detail report via fetch dan masukkan ke dalam modal
        fetch(`../crud/load_report.php?leader_id=${leaderId}&project_id=${projectId}`)
            .then(response => response.text())
            .then(data => {
                document.querySelector('#modal-lg .modal-body').innerHTML = data;
                // Buka modal
                const modal = document.querySelector('#modal-lg');
                modal.classList.remove('hidden');
                modal.classList.add('block');
            })
            .catch(error => {
                console.error('Error fetching report:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Failed to load report detail',
                    text: error
                });
            });
    }
    </script>

<?php require '../template-footer.php'; ?>