<?php
$title = 'List Task';
$userRole = 'Employee';
require '../session-check.php';
require '../crud/read_working_plans.php';
?>

<?php require '../template-header.php'; ?>

<?php require '../template-sidebar.php'; ?>

    <div class="container py-6">

        <!-- Page Title Start -->
        <div class="flex items-center md:justify-between flex-wrap gap-2 mb-6">
            <h4 class="text-default-900 text-lg font-medium mb-2">List Task</h4>
        </div>
        <!-- Page Title End -->

        <div class="grid lg:grid-cols-1 grid-cols-1 gap-6">
            <div class="card overflow-hidden">
                <div>
                    <div class="overflow-x-auto">
                        <div class="min-w-full inline-block align-middle">
                            <div class="overflow-hidden">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-start text-sm text-default-500">
                                                Headline Task</th>
                                            <th scope="col" class="px-6 py-3 text-start text-sm text-default-500">
                                                Deadline Start
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-start text-sm text-default-500">
                                                Deadline End
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-start text-sm text-default-500">
                                                Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                    <?php
                                        renderTableRows($HWorkingPlans, function($hwp) {
                                    ?>
                                        <tr class="hover:bg-gray-100">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-default-800">
                                                <?= htmlspecialchars($hwp['task_name']); ?></td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-default-800">
                                                <?= date('d F Y H:i', strtotime($hwp['task_deadline_start'])); ?></td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-default-800">
                                                <?= date('d F Y H:i', strtotime($hwp['task_deadline_end'])); ?></td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <button class="text-primary hover:text-sky-700"
                                                    type="button"
                                                    data-hs-overlay="#modal-lg"
                                                    <?php if($hwp['task_record'] == 'process') : ?>
                                                        data-toggle-first="modal-first"
                                                    <?php endif; ?>
                                                    data-task-id="<?= $hwp['task_id']; ?>"
                                                    data-task-project-id="<?= $hwp['task_project_id']; ?>"
                                                    data-task-leader-id="<?= $_SESSION['user_leader_id']; ?>"
                                                    data-task-name="<?= htmlspecialchars($hwp['task_name']); ?>"
                                                    data-description="<?= htmlspecialchars($hwp['task_description']); ?>"
                                                    data-file="<?= htmlspecialchars($hwp['task_attachment']); ?>"
                                                    data-deadline-start="<?= date('d F Y H:i', strtotime($hwp['task_deadline_start'])); ?>"
                                                    data-deadline-end="<?= date('d F Y H:i', strtotime($hwp['task_deadline_end'])); ?>"
                                                    data-task-record="<?= $hwp['task_record']; ?>"

                                                    onclick="fillModalData(this)">
                                                    Detail
                                                </button>
                                            </td>
                                        </tr>
                                    <?php
                                        }, 4);
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

    <style>
        /* Matikan klik backdrop */
        #modal-lg[data-locked="true"] {
            pointer-events: auto;
        }
        #modal-lg[data-locked="true"] .hs-overlay-backdrop {
            pointer-events: none !important;
        }
    </style>

    
    <div class="" id="modal-lg-overlay">
        <div id="modal-lg"
            class="hs-overlay w-full h-full fixed top-0 left-0 z-70 transition-all duration-500 overflow-y-auto hidden pointer-events-none">
            <div class="-translate-y-5 hs-overlay-open:translate-y-0 hs-overlay-open:opacity-100 opacity-0 ease-in-out transition-all duration-500 sm:max-w-2xl sm:w-full my-8 sm:mx-auto flex flex-col bg-white shadow-sm rounded"> 
                <form action="../crud/update_job.php" method="POST">
                    <div
                        class="flex flex-col border border-default-200 shadow-sm rounded-lg  pointer-events-auto">
                        <div
                            class="flex justify-between items-center py-3 px-4 border-b border-default-200">
                            <h3 class="text-lg font-medium text-default-900" id="modalTitle">
                                Detail Task
                            </h3>
                            <button type="button" id="modalCloseBtn" class="text-default-600 cursor-pointer"
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
                        </div>
                        <div
                            class="flex justify-end items-center gap-x-2 py-3 px-4 border-t border-default-200">
                            <a
                                class="py-2 px-5 inline-flex items-center justify-center font-medium tracking-wide border align-middle duration-500 text-sm text-center bg-danger hover:bg-primary border-primary/10 hover:border-primary text-white hover:text-white rounded-md"
                                data-hs-overlay="#modal-edit-md" href="#" id="sendTaskLink" style="display: none;">
                                End Task
                            </a>
                            <a class="py-2 px-5 inline-flex items-center justify-center font-medium tracking-wide border align-middle duration-500 text-sm text-center bg-primary hover:bg-primary-700 border-primary hover:border-primary-700 text-white rounded-md"
                                href="#" id="startTaskLink">
                                Start Task
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    // Cari button yang punya data-toggle-first="modal-first"
    const firstButton = document.querySelector('button[data-toggle-first="modal-first"]');

    if (firstButton) {
        // Kasih delay 2 detik sebelum klik otomatis
        setTimeout(function () {
            firstButton.click();
        }, 50); // 2000 ms = 2 detik
    }
    const modal = document.getElementById('modal-lg');
    const closeBtn = document.getElementById('modalCloseBtn');
    const startTaskLink = document.getElementById('startTaskLink');
    const sendTaskLink = document.getElementById('sendTaskLink');

    const modalTitle = document.getElementById('modalTitle');

    // Make fillModalData globally accessible
    window.fillModalData = function (button) {
        const taskId = button.getAttribute('data-task-id');
        const projectId = button.getAttribute('data-task-project-id');
        const leaderId = button.getAttribute('data-task-leader-id');
        const taskName = button.getAttribute('data-task-name');
        const description = button.getAttribute('data-description');
        const file = button.getAttribute('data-file');
        const deadlineStart = button.getAttribute('data-deadline-start');
        const deadlineEnd = button.getAttribute('data-deadline-end');
        const taskRecord = button.getAttribute('data-task-record');
        const userId = <?= $_SESSION["user_id"] ?>;

        const modalTitle = document.getElementById('modalTitle');
        if (taskRecord === 'process') {
            modalTitle.textContent = 'You must complete this task first';
            modalTitle.classList.remove('text-default-900');
            modalTitle.classList.add('text-red-600');
        } else {
            modalTitle.textContent = 'Detail Task';
            modalTitle.classList.remove('text-red-600');
            modalTitle.classList.add('text-default-900');
        }
    
        // Isi data ke form modal
        document.getElementById('inputName').value = taskName;
        document.getElementById('inputDescription').value = description;
        document.getElementById('inputDeadlineStart').value = deadlineStart;
        document.getElementById('inputDeadlineEnd').value = deadlineEnd;

        const attachmentTable = document.getElementById('attachmentTable');
        if (file) {
            attachmentTable.innerHTML = `
                <tr>
                    <td class="text-primary hover:text-sky-700">
                        <a href="../../assets/attachment/${file}" target="_blank">
                            See Attach (${file})
                        </a>
                    </td>
                </tr>`;
        } else {
            attachmentTable.innerHTML = `<tr><td class="text-gray-500">No attachment available</td></tr>`;
        }

        // Lock/unlock modal
        if (taskRecord === 'process') {
            lockModal();
            startTaskLink.textContent = 'Pause Task';
            startTaskLink.className = 'py-2 px-5 bg-red-600 text-white rounded-md';
            startTaskLink.href = `../crud/update_task.php?task_id=${taskId}&task_record=paused&user_id=${userId}&leader_id=${leaderId}&project_id=${projectId}`;
            sendTaskLink.style.display = '';
            sendTaskLink.href = `../crud/update_task.php?task_id=${taskId}&task_record=done&user_id=${userId}&leader_id=${leaderId}&project_id=${projectId}`;
        } else {
            unlockModal();
            if (taskRecord === 'paused') {
                startTaskLink.textContent = 'Continue Task';
                startTaskLink.className = 'py-2 px-5 bg-yellow-500 text-white rounded-md';
                startTaskLink.href = `../crud/update_task.php?task_id=${taskId}&task_record=process&user_id=${userId}&leader_id=${leaderId}&project_id=${projectId}`;
                sendTaskLink.style.display = '';
                sendTaskLink.href = `../crud/update_task.php?task_id=${taskId}&task_record=done&user_id=${userId}&leader_id=${leaderId}&project_id=${projectId}`;
            } else {
                startTaskLink.textContent = 'Start Task';
                startTaskLink.className = 'py-2 px-5 bg-blue-600 text-white rounded-md';
                startTaskLink.href = `../crud/update_task.php?task_id=${taskId}&task_record=process&user_id=${userId}&leader_id=${leaderId}&project_id=${projectId}`;
                sendTaskLink.style.display = 'none';
            }
        }
    };

    function lockModal() {
        modal.dataset.locked = "true";
        closeBtn.classList.add('hidden');

        // Disable ESC key
        document.addEventListener('keydown', blockEsc, true);

        // Disable backdrop click
        modal.addEventListener('click', blockBackdrop, true);
    }

    function unlockModal() {
        modal.dataset.locked = "false";
        closeBtn.classList.remove('hidden');

        // Enable ESC key
        document.removeEventListener('keydown', blockEsc, true);

        // Enable backdrop click
        modal.removeEventListener('click', blockBackdrop, true);
    }

    function blockEsc(e) {
        if (e.key === "Escape") {
            e.preventDefault();
            e.stopPropagation();
        }
    }

    function blockBackdrop(e) {
        if (e.target === modal && modal.dataset.locked === "true") {
            e.preventDefault();
            e.stopPropagation();
        }
    }
});

function lockModal() {
    modal.dataset.locked = "true";

    // Sembunyikan tombol close
    closeBtn.classList.add('hidden');

    // Disable ESC key
    document.addEventListener('keydown', blockEsc, true);

    // Cegah klik backdrop (force hijack Preline)
    const backdrop = modal.querySelector('.hs-overlay-backdrop');
    if (backdrop) {
        backdrop.onclick = function(e) {
            e.stopPropagation();
            e.preventDefault();
            return false;
        };
    }
}

function unlockModal() {
    modal.dataset.locked = "false";

    // Tampilkan tombol close
    closeBtn.classList.remove('hidden');

    // Enable ESC key
    document.removeEventListener('keydown', blockEsc, true);

    // Aktifkan lagi klik backdrop
    const backdrop = modal.querySelector('.hs-overlay-backdrop');
    if (backdrop) backdrop.onclick = null;
}
</script>



<?php require '../template-footer.php'; ?>