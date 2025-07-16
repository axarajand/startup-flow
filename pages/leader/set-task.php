<?php
$title = 'Set Task';
$userRole = 'Leader';
require '../session-check.php';
require '../crud/read_user.php';
require '../crud/read_project.php';
?>

<?php require '../template-header.php'; ?>

<?php require '../template-sidebar.php'; ?>

    <div class="container py-6">

        <!-- Page Title Start -->
        <div class="flex items-center md:justify-between flex-wrap gap-2 mb-6">
            <h4 class="text-default-900 text-lg font-medium mb-2">Set Task</h4>
        </div>
        <!-- Page Title End -->

        <div class="grid lg:grid-cols-2 grid-cols-1 gap-6">
            <div class="col-span-2">
                <div class="card">
                    <div class="p-6">
                        <h4 class="card-title mb-4">New Project</h4>

                        <form action="../crud/insert_working_plans.php" method="POST" enctype="multipart/form-data">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                                <div class="lg:col-span-2">
                                    <label for="inputproject" class="text-default-800 text-sm font-medium inline-block mb-2">Project To</label>
                                    <select id="inputproject" class="form-select" name="project_to">
                                        <option selected disabled>Select one</option>
                                        <?php foreach ($projects as $project): ?>
                                            <option value="<?= htmlspecialchars($project['project_id']); ?>">
                                                <?= htmlspecialchars($project['project_name']); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="lg:col-span-2">
                                    <label for="inputName" class="text-default-800 text-sm font-medium inline-block mb-2">Task Name</label>
                                    <input type="text" class="form-input" id="inputName" name="task_name" placeholder="Enter Task Name" required>
                                </div>

                                <div class="lg:col-span-2">
                                    <label for="inputDescription" class="text-default-800 text-sm font-medium inline-block mb-2">Description</label>
                                    <textarea id="inputDescription" class="form-input" name="description" class="form-control" rows="4" placeholder="Enter Project Description" required></textarea>
                                </div>

                                <div class="lg:col-span-2">
                                    <label for="inputStatus" class="text-default-800 text-sm font-medium inline-block mb-2">Send To</label>
                                    <select id="inputStatus" class="form-select" name="send_to">
                                        <option selected disabled>Select one</option>
                                        <!-- Opsi akan diisi dengan JavaScript -->
                                    </select>
                                </div>

                                <div class="lg:col-span-2">
                                    <label for="inputAttachement" class="text-default-800 text-sm font-medium inline-block mb-2">Attachment</label>
                                    <input type="file" class="form-input" id="inputAttachement" name="attachment" required>
                                </div>

                                <div class="lg:col-span-2">
                                    <label for="deadlineStart" class="text-default-800 text-sm font-medium inline-block mb-2">Deadline Start</label>
                                    <input type="datetime-local" class="form-input" id="deadlineStart" name="deadline_start" required>
                                </div>

                                <div class="lg:col-span-2">
                                    <label for="deadlineEnd" class="text-default-800 text-sm font-medium inline-block mb-2">Deadline End</label>
                                    <input type="datetime-local" class="form-input" id="deadlineEnd" name="deadline_end" required>
                                </div>

                                <!-- Display Duration -->
                                <label class="text-default-800 text-sm font-medium inline-block mb-2">Deadline: <b id="DeadlineDurationDay">0</b> Days <b id="DeadlineDurationHours">0</b> Hours</label>

                            <button type="submit" class="lg:col-span-2 btn bg-primary text-white">Set Task</button>
                        </form>

                    </div>
                </div> 
            </div> <!-- end col -->
        </div>
       
    </div>

<script>
  document.getElementById('inputproject').addEventListener('change', function () {
    const projectId = this.value;
    const userSelect = document.getElementById('inputStatus');

    // Kosongkan dropdown Send To saat menunggu data baru
    userSelect.innerHTML = '<option selected disabled>Loading...</option>';

    // Kirim AJAX request untuk mendapatkan pengguna terkait
    fetch(`../crud/read_project.php?project_id=${projectId}`)
        .then(response => {
            // Pastikan responnya OK (status 200)
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();  // Mengubah respon menjadi JSON
        })
        .then(users => {
            // Kosongkan dropdown sebelum menambahkan opsi baru
            userSelect.innerHTML = '<option selected disabled>Select one</option>';

            if (Array.isArray(users) && users.length > 0) {
                // Tambahkan opsi berdasarkan hasil AJAX
                users.forEach(user => {
                    const option = document.createElement('option');
                    option.value = user.user_id;
                    option.textContent = user.user_name;
                    userSelect.appendChild(option);
                });
            } else {
                userSelect.innerHTML = '<option selected disabled>No users found</option>';
            }
        })
        .catch(error => {
            console.error('Error fetching users:', error);
            userSelect.innerHTML = '<option selected disabled>Error loading users</option>';
        });
});

document.addEventListener('DOMContentLoaded', function () {
    // Ambil elemen-elemen input dan label durasi
    const deadlineStart = document.getElementById('deadlineStart');
    const deadlineEnd = document.getElementById('deadlineEnd');
    const durationDayLabel = document.getElementById('DeadlineDurationDay');
    const durationHoursLabel = document.getElementById('DeadlineDurationHours');

    // Fungsi untuk menghitung durasi dalam hari dan jam
    function calculateDuration() {
        const start = new Date(deadlineStart.value);
        const end = new Date(deadlineEnd.value);

        // Pastikan kedua tanggal valid
        if (!isNaN(start) && !isNaN(end)) {
            // Hitung selisih waktu dalam milidetik
            const diffTime = end - start;

            // Ubah milidetik menjadi hari dan jam
            const diffDays = Math.floor(diffTime / (1000 * 3600 * 24));  // Menghitung hari
            const diffHours = Math.floor((diffTime % (1000 * 3600 * 24)) / (1000 * 3600)); // Menghitung jam dari sisa waktu

            // Tampilkan durasi dalam hari dan jam
            durationDayLabel.textContent = diffDays;
            durationHoursLabel.textContent = diffHours;
        }
    }

    // Event listener untuk menghitung durasi ketika salah satu field berubah
    deadlineStart.addEventListener('input', calculateDuration);
    deadlineEnd.addEventListener('input', calculateDuration);
});
</script>

<?php require '../template-footer.php'; ?>