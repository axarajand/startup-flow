<?php
$title = 'Job';
$userRole = 'Leader';
require '../session-check.php';
require '../crud/read_job.php';
?>

<?php require '../template-header.php'; ?>

<?php require '../template-sidebar.php'; ?>

    <div class="container py-6">

        <!-- Page Title Start -->
        <div class="flex items-center md:justify-between flex-wrap gap-2 mb-6">
            <h4 class="text-default-900 text-lg font-medium mb-2">Job</h4>
        </div>
        <!-- Page Title End -->

        <div class="grid lg:grid-cols-2 grid-cols-1 gap-6">
            <div class="col-span-2">
                <div class="card overflow-hidden">
                    <div class="card-header flex justify-between items-center">
                        <h4 class="card-title">List Job</h4>
                        <button type="submit" class="py-2 px-5 inline-flex items-center justify-center font-medium tracking-wide border align-middle duration-500 text-sm text-center bg-primary hover:bg-primary-700 border-primary hover:border-primary-700 text-white rounded-md"
                            data-toggle="modal" data-hs-overlay="#modal-add-md">
                            <i class="i-tabler-plus text-base me-4"></i> Add
                        </button>
                    </div>
                    <div>
                        <div class="overflow-x-auto">
                            <div class="min-w-full inline-block align-middle">
                                <div class="overflow-hidden">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="px-6 py-3 text-start text-sm text-default-500">
                                                    Job Name</th>
                                                <th scope="col" class="px-6 py-3 text-end text-sm text-default-500">
                                                    Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200">
                                        <?php
                                            renderTableRows($jobs, function($job) {
                                        ?>
                                            <tr class="hover:bg-gray-100">
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-default-800">
                                                <?= htmlspecialchars($job['job_name']); ?></td>
                                                <td class="px-6 py-4 flex whitespace-nowrap text-end justify-end text-sm font-medium">
                                                    <a class="text-primary hover:text-sky-700 btn-edit-job"
                                                        data-job-id="<?= $job['job_id']; ?>" 
                                                        data-job-name="<?= htmlspecialchars($job['job_name']); ?>" 
                                                        data-toggle="modal" 
                                                        data-hs-overlay="#modal-edit-md"
                                                        style="margin-right: 7px"
                                                        href="#">
                                                        <i data-lucide="pencil-line" class="size-5"></i>
                                                    </a>
                                                    <a class="text-primary hover:text-sky-700"
                                                        href="../crud/delete_job.php?job_id=<?= htmlspecialchars($job['job_id']); ?>"
                                                        onclick="return confirm('Are you sure you want to delete this job?');">
                                                        <i data-lucide="trash-2" class="size-5"></i>
                                                    </a>
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
    </div>

    <div class="">
        <div id="modal-add-md"
            class="hs-overlay w-full h-full fixed top-0 left-0 z-70 transition-all duration-500 overflow-y-auto hidden pointer-events-none">
            <div class="-translate-y-5 hs-overlay-open:translate-y-0 hs-overlay-open:opacity-100 opacity-0 ease-in-out transition-all duration-500 sm:max-w-2xl sm:w-full my-8 sm:mx-auto flex flex-col bg-white shadow-sm rounded"> 
                <form action="../crud/insert_job.php" method="POST">
                    <div
                        class="flex flex-col border border-default-200 shadow-sm rounded-lg  pointer-events-auto">
                        <div
                            class="flex justify-between items-center py-3 px-4 border-b border-default-200">
                            <h3 class="text-lg font-medium text-default-900">
                                Add Job
                            </h3>
                            <button type="button" class="text-default-600 cursor-pointer"
                                data-hs-overlay="#modal-add-md">
                                <i class="i-tabler-x text-lg"></i>
                            </button>
                        </div>
                        <div class="p-4 overflow-y-auto">
                            <div class="lg:col-span-2">
                                <label for="jobName" class="text-default-800 text-sm font-medium inline-block mb-2">Job Name</label>
                                <input type="text" class="form-input" id="jobName" name="job_name" placeholder="Enter Job Name" required>
                            </div>
                        </div>
                        <div
                            class="flex justify-end items-center gap-x-2 py-3 px-4 border-t border-default-200">
                            <button type="button"
                                class="py-2 px-5 inline-flex items-center justify-center font-medium tracking-wide border align-middle duration-500 text-sm text-center bg-primary/5 hover:bg-primary border-primary/10 hover:border-primary text-primary hover:text-white rounded-md"
                                data-hs-overlay="#modal-add-md">
                                <i class="i-tabler-x me-1"></i>
                                Close
                            </button>
                            <button type="submit" class="py-2 px-5 inline-flex items-center justify-center font-medium tracking-wide border align-middle duration-500 text-sm text-center bg-primary hover:bg-primary-700 border-primary hover:border-primary-700 text-white rounded-md"
                                href="#">
                                Add
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="">
        <div id="modal-edit-md"
            class="hs-overlay w-full h-full fixed top-0 left-0 z-70 transition-all duration-500 overflow-y-auto hidden pointer-events-none">
            <div class="-translate-y-5 hs-overlay-open:translate-y-0 hs-overlay-open:opacity-100 opacity-0 ease-in-out transition-all duration-500 sm:max-w-2xl sm:w-full my-8 sm:mx-auto flex flex-col bg-white shadow-sm rounded"> 
                <form action="../crud/update_job.php" method="POST">
                    <div
                        class="flex flex-col border border-default-200 shadow-sm rounded-lg  pointer-events-auto">
                        <div
                            class="flex justify-between items-center py-3 px-4 border-b border-default-200">
                            <h3 class="text-lg font-medium text-default-900">
                                Edit Job
                            </h3>
                            <button type="button" class="text-default-600 cursor-pointer"
                                data-hs-overlay="#modal-edit-md">
                                <i class="i-tabler-x text-lg"></i>
                            </button>
                        </div>
                        <div class="p-4 overflow-y-auto">
                            <!-- Hidden Input untuk ID -->
                            <input type="hidden" id="jobId" name="job_id">
                            <div class="lg:col-span-2">
                                <label for="jobNameEdit" class="text-default-800 text-sm font-medium inline-block mb-2">Job Name</label>
                                <input type="text" class="form-input" id="jobNameEdit" name="job_name" required>
                            </div>
                        </div>
                        <div
                            class="flex justify-end items-center gap-x-2 py-3 px-4 border-t border-default-200">
                            <button type="button"
                                class="py-2 px-5 inline-flex items-center justify-center font-medium tracking-wide border align-middle duration-500 text-sm text-center bg-primary/5 hover:bg-primary border-primary/10 hover:border-primary text-primary hover:text-white rounded-md"
                                data-hs-overlay="#modal-edit-md">
                                <i class="i-tabler-x me-1"></i>
                                Close
                            </button>
                            <button type="submit" class="py-2 px-5 inline-flex items-center justify-center font-medium tracking-wide border align-middle duration-500 text-sm text-center bg-primary hover:bg-primary-700 border-primary hover:border-primary-700 text-white rounded-md"
                                href="#">
                                Save Changes
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
        
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Pilih semua tombol edit job
            const editButtons = document.querySelectorAll('.btn-edit-job');

            // Tambahkan event listener pada setiap tombol
            editButtons.forEach(button => {
                button.addEventListener('click', function () {
                    // Ambil data dari atribut tombol
                    const jobId = this.getAttribute('data-job-id');
                    const jobName = this.getAttribute('data-job-name');

                    // Masukkan data ke dalam modal
                    document.getElementById('jobId').value = jobId; // Untuk hidden input job_id
                    document.getElementById('jobNameEdit').value = jobName; // Untuk input job_name
                });
            });
        });
    </script>

<?php require '../template-footer.php'; ?>