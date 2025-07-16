<?php
$title = 'Team';
$userRole = 'Leader';
require '../session-check.php';
require '../crud/read_user.php';
require '../crud/read_job.php';
?>

<?php require '../template-header.php'; ?>

<?php require '../template-sidebar.php'; ?>

    <div class="container py-6">

        <!-- Page Title Start -->
        <div class="flex items-center md:justify-between flex-wrap gap-2 mb-6">
            <h4 class="text-default-900 text-lg font-medium mb-2">Team</h4>
        </div>
        <!-- Page Title End -->

        <div class="grid lg:grid-cols-1 grid-cols-1 gap-6">
            <div class="card overflow-hidden">
                <div class="card-header flex justify-between items-center">
                    <h4 class="card-title">List Team</h4>
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
                                                Avatar</th>
                                            <th scope="col" class="px-6 py-3 text-start text-sm text-default-500">
                                                Name</th>
                                            <th scope="col" class="px-6 py-3 text-start text-sm text-default-500">
                                                Email</th>
                                            <th scope="col" class="px-6 py-3 text-start text-sm text-default-500">
                                                Job</th>
                                            <th scope="col" class="px-6 py-3 text-start text-sm text-default-500">
                                                Salary/Hours</th>
                                            <th scope="col" class="px-6 py-3 text-start text-sm text-default-500">
                                                Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                    <?php
                                        renderTableRows($users, function($user) {
                                    ?>
                                        <tr class="hover:bg-gray-100">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-default-800">
                                            <img class="inline-block size-[62px] rounded-full clickable-image"
                                            src="../../assets/images/avatar/<?= $user['user_avatar']; ?>"
                                            alt="Image Avatar"
                                            style="width: 50px; height: 50px; cursor: pointer;"
                                            data-toggle="modal" 
                                            data-hs-overlay="#imageModal"></td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-default-800">
                                            <?= htmlspecialchars($user['user_name']); ?></td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-default-800">
                                            <?= htmlspecialchars($user['user_email']); ?></td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-default-800">
                                            <?= htmlspecialchars($user['job_name']); ?></td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-default-800">
                                            <?= htmlspecialchars(number_format($user['user_sph'], 2, ',', '.')); ?></td>
                                            <td class="px-6 py-4 flex whitespace-nowrap justify-start font-medium mt-3">
                                                <a class="text-primary hover:text-sky-700 btn-edit"
                                                    data-id="<?= htmlspecialchars($user['user_id']); ?>" 
                                                    data-name="<?= htmlspecialchars($user['user_name']); ?>" 
                                                    data-email="<?= htmlspecialchars($user['user_email']); ?>" 
                                                    data-job="<?= htmlspecialchars($user['job_id']); ?>" 
                                                    data-sph="<?= htmlspecialchars($user['user_sph']); ?>"  
                                                    data-toggle="modal" 
                                                    data-hs-overlay="#modal-edit-md"
                                                    style="margin-right: 7px"
                                                    href="#">
                                                    <i data-lucide="pencil-line" class="size-5"></i>
                                                </a>
                                                <a class="text-primary hover:text-sky-700"
                                                    href="../crud/delete_team.php?id=<?= htmlspecialchars($user['user_id']); ?>"
                                                    onclick="return confirm('Are you sure you want to delete this team member?');">
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

    <div class="">
        <div id="modal-add-md"
            class="hs-overlay w-full h-full fixed top-0 left-0 z-70 transition-all duration-500 overflow-y-auto hidden pointer-events-none">
            <div class="-translate-y-5 hs-overlay-open:translate-y-0 hs-overlay-open:opacity-100 opacity-0 ease-in-out transition-all duration-500 sm:max-w-2xl sm:w-full my-8 sm:mx-auto flex flex-col bg-white shadow-sm rounded"> 
                <form action="../crud/insert_team.php" method="POST" enctype="multipart/form-data">
                    <div class="flex flex-col border border-default-200 shadow-sm rounded-lg  pointer-events-auto">
                        <div
                            class="flex justify-between items-center py-3 px-4 border-b border-default-200">
                            <h3 class="text-lg font-medium text-default-900">
                                Add Team
                            </h3>
                            <button type="button" class="text-default-600 cursor-pointer"
                                data-hs-overlay="#modal-add-md">
                                <i class="i-tabler-x text-lg"></i>
                            </button>
                        </div>
                        <div class="p-4 overflow-y-auto">
                            <div class="lg:col-span-2">
                                <label for="userName" class="text-default-800 text-sm font-medium inline-block mb-2">User Name</label>
                                <input type="text" class="form-input" id="userName" name="user_name" placeholder="Enter User Name" required>
                            </div>
                            <div class="lg:col-span-2" style="margin-top: 7px;">
                                <label for="userSPH" class="text-default-800 text-sm font-medium inline-block mb-2">Salary/Hours</label>
                                <div class="flex">
                                    <div class="flex items-center justify-center border border-default-200 bg-default-100 px-3 font-semibold rounded-s-md border-e-0">
                                        Rp
                                    </div>
                                    <input type="number" placeholder="Enter User SPH" id="userSPH" name="user_sph" class="form-input rounded-s-none" required>
                                </div>
                            </div>
                            <div class="lg:col-span-2" style="margin-top: 7px;">
                                <label for="userEmail" class="text-default-800 text-sm font-medium inline-block mb-2">Email</label>
                                <input type="email" class="form-input" id="userEmail" name="user_email" placeholder="Enter User Email" required>
                            </div>
                            <div class="lg:col-span-2" style="margin-top: 7px;">
                                <label for="userPassword" class="text-default-800 text-sm font-medium inline-block mb-2">Password</label>
                                <input type="password" class="form-input" id="userPassword" name="user_password" placeholder="Enter User Password" required>
                            </div>
                            <div class="lg:col-span-2" style="margin-top: 7px;">
                                <input type="text" id="userRole" name="user_role" value="Employee" required hidden>     
                                <input type="number" id="inputLeader" name="user_leader_id" value="<?= $_SESSION["user_id"] ?>" required hidden>
                            </div>
                            <div class="lg:col-span-2" style="margin-top: 7px;">
                                <label for="userJob" class="text-default-800 text-sm font-medium inline-block mb-2">Job</label>
                                <select id="userJob" class="form-select" name="user_job">
                                <option selected disabled>Select one</option>
                                <?php foreach ($jobs as $job): ?>
                                    <option value="<?= htmlspecialchars($job['job_id']); ?>">
                                      <?= htmlspecialchars($job['job_name']); ?>
                                    </option>
                                <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="lg:col-span-2" style="margin-top: 7px;">
                                <label for="userAvatar" class="text-default-800 text-sm font-medium inline-block mb-2">Avatar</label>
                                <input type="file" class="form-input" id="userAvatar" name="user_avatar" required>
                            </div>
                        </div>
                        <div class="flex justify-end items-center gap-x-2 py-3 px-4 border-t border-default-200">
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
                <form action="../crud/update_team.php" method="POST" enctype="multipart/form-data">
                    <div class="flex flex-col border border-default-200 shadow-sm rounded-lg pointer-events-auto">
                        <div
                            class="flex justify-between items-center py-3 px-4 border-b border-default-200">
                            <h3 class="text-lg font-medium text-default-900">
                                Edit Team
                            </h3>
                            <button type="button" class="text-default-600 cursor-pointer"
                                data-hs-overlay="#modal-edit-md">
                                <i class="i-tabler-x text-lg"></i>
                            </button>
                        </div>
                        <div class="p-4 overflow-y-auto">
                            <!-- Hidden Input untuk ID -->
                            <input type="hidden" id="editUserId" name="user_id">
                            <div class="lg:col-span-2">
                                <label for="editUserName" class="text-default-800 text-sm font-medium inline-block mb-2">User Name</label>
                                <input type="text" class="form-input" id="editUserName" placeholder="Enter User Name" name="user_name" required>
                            </div>
                            <div class="lg:col-span-2" style="margin-top: 7px;">
                                <label for="editUserSPH" class="text-default-800 text-sm font-medium inline-block mb-2">Salary/Hours</label>
                                <div class="flex">
                                    <div class="flex items-center justify-center border border-default-200 bg-default-100 px-3 font-semibold rounded-s-md border-e-0">
                                        Rp
                                    </div>
                                    <input type="number" placeholder="Enter User SPH" id="editUserSPH" name="user_sph" class="form-input rounded-s-none">
                                </div>
                            </div>
                            <div class="lg:col-span-2" style="margin-top: 7px;">
                                <label for="editUserEmail" class="text-default-800 text-sm font-medium inline-block mb-2">Email</label>
                                <input type="email" class="form-input" id="editUserEmail" name="user_email" placeholder="Enter User Email" required>
                            </div>
                            <div class="lg:col-span-2" style="margin-top: 7px;">
                                <label for="editUserJob" class="text-default-800 text-sm font-medium inline-block mb-2">Job</label>
                                <select id="editUserJob" class="form-select" name="user_job">
                                <option selected disabled>Select one</option>
                                <?php foreach ($jobs as $job): ?>
                                    <option value="<?= htmlspecialchars($job['job_id']); ?>">
                                      <?= htmlspecialchars($job['job_name']); ?>
                                    </option>
                                <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="lg:col-span-2" style="margin-top: 7px;">
                                <label for="editUserAvatar" class="text-default-800 text-sm font-medium inline-block mb-2">Avatar</label>
                                <input type="file" class="form-input" id="editUserAvatar" name="user_avatar">
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


    <div class="">
        <div id="imageModal"
            class="hs-overlay w-full h-full fixed top-0 left-0 z-70 transition-all duration-500 overflow-y-auto hidden pointer-events-none">
            <div class="-translate-y-5 hs-overlay-open:translate-y-0 hs-overlay-open:opacity-100 opacity-0 ease-in-out transition-all duration-500 sm:max-w-2xl sm:w-full my-8 sm:mx-auto flex flex-col bg-white shadow-sm rounded"> 
                <img id="modalImage" src="" alt="Enlarged Image" class="img-fluid">
            </div>
        </div>
    </div>
        
    <script>
      document.addEventListener('DOMContentLoaded', function () {
        // Pilih semua gambar dengan class "clickable-image"
        const images = document.querySelectorAll('.clickable-image');

        // Tambahkan event click pada setiap gambar
        images.forEach(image => {
          image.addEventListener('click', function () {
            const modalImage = document.getElementById('modalImage');
            modalImage.src = this.src; // Ambil src gambar yang diklik
            modalImage.alt = this.alt; // Ambil alt untuk keterangan gambar
          });
        });
      });

       // Pilih semua tombol edit
       const editButtons = document.querySelectorAll('.btn-edit');

      // Tambahkan event click pada setiap tombol edit
      editButtons.forEach(button => {
        button.addEventListener('click', function () {
          // Ambil data dari atribut tombol
          const userId = this.getAttribute('data-id');
          const userName = this.getAttribute('data-name');
          const userEmail = this.getAttribute('data-email');
          const userJob = this.getAttribute('data-job');
          const userSPH = this.getAttribute('data-sph');

          // Isi form dengan data yang diambil
          document.getElementById('editUserId').value = userId;
          document.getElementById('editUserName').value = userName;
          document.getElementById('editUserEmail').value = userEmail;
          document.getElementById('editUserJob').value = userJob;
          document.getElementById('editUserSPH').value = userSPH;
        });
      });
    </script>

<?php require '../template-footer.php'; ?>