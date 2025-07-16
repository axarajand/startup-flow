<?php
$title = 'Set Project';
$userRole = 'Leader';
require '../session-check.php';
require '../crud/read_user.php';
require '../crud/read_category.php';
?>

<?php require '../template-header.php'; ?>

<?php require '../template-sidebar.php'; ?>
        
    <div class="container py-6">

        <!-- Page Title Start -->
        <div class="flex items-center md:justify-between flex-wrap gap-2 mb-6">
            <h4 class="text-default-900 text-lg font-medium mb-2">Set Project</h4>
        </div>
        <!-- Page Title End -->

        <div class="grid lg:grid-cols-2 grid-cols-1 gap-6">
            <div class="col-span-2">
                <div class="card">
                    <div class="p-6">
                        <h4 class="card-title mb-4">New Project</h4>

                        <form action="../crud/insert_project.php" method="POST" enctype="multipart/form-data">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="lg:col-span-2">
                                    <label for="inputName" class="text-default-800 text-sm font-medium inline-block mb-2">Project Name</label>
                                    <input type="text" class="form-input" id="inputName" name="project_name" placeholder="Enter your Project Name" required>
                                </div>

                                <div class="lg:col-span-2">
                                    <label for="inputDescription" class="text-default-800 text-sm font-medium inline-block mb-2">Description</label>
                                    <textarea id="inputDescription" class="form-input" name="description" class="form-control" rows="4" placeholder="Enter Project Description" required></textarea>
                                </div>

                                <div class="lg:col-span-2">
                                    <label for="inputCategory" class="text-default-800 text-sm font-medium inline-block mb-2">Category</label>
                                    <select id="inputCategory" class="form-select" name="project_category">
                                    <option selected disabled>Select one</option>
                                    <?php foreach ($cats as $cat): ?>
                                        <option value="<?= htmlspecialchars($cat['cat_id']); ?>">
                                            <?= htmlspecialchars($cat['cat_name']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="lg:col-span-2">
                                    <label for="inputBudget" class="text-default-800 text-sm font-medium inline-block mb-2">Budget</label>
                                    <div class="flex">
                                        <div class="flex items-center justify-center border border-default-200 bg-default-100 px-3 font-semibold rounded-s-md border-e-0">
                                            Rp
                                        </div>
                                        <input type="number" placeholder="Enter your Budget" id="inputBudget" name="project_anggaran" class="form-input rounded-s-none">
                                    </div>
                                </div>

                                <div class="lg:col-span-2">
                                    <label class="text-default-800 text-sm font-medium inline-block mb-2">Create Teams</label>
                                    <?php 
                                        if (count($users) > 0) {
                                    ?>
                                    <?php foreach ($users as $user): ?>
                                        <div class="form-check mt-2">
                                            <input type="checkbox" name="inputUsers[]" class="form-checkbox rounded text-primary" id="<?= htmlspecialchars($user['user_id']).htmlspecialchars($user['user_name']); ?>" value="<?= htmlspecialchars($user['user_id']); ?>">
                                            <label class="ms-1.5" for="<?= htmlspecialchars($user['user_id']).htmlspecialchars($user['user_name']); ?>"><?= htmlspecialchars($user['user_name']); ?> - <?= htmlspecialchars($user['job_name']); ?></label>
                                        </div>
                                    <?php endforeach; ?>
                                    <?php } else { ?>
                                        <div class="form-check mt-2">
                                            <label style="color: red;">No employees created yet! Add an employee first to assign them to your project later.</label>
                                        </div>
                                    <?php } ?>
                                </div>

                            <button type="submit" class="lg:col-span-2 btn bg-primary text-white">Set Project</button>
                        </form>

                    </div>
                </div> 
            </div> <!-- end col -->
        </div>
       
    </div>

<?php require '../template-footer.php'; ?>