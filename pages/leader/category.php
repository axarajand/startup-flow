<?php
$title = 'Category';
$userRole = 'Leader';
require '../session-check.php';
require '../crud/read_category.php';
?>

<?php require '../template-header.php'; ?>

<?php require '../template-sidebar.php'; ?>

    <div class="container py-6">

        <!-- Page Title Start -->
        <div class="flex items-center md:justify-between flex-wrap gap-2 mb-6">
            <h4 class="text-default-900 text-lg font-medium mb-2">Category</h4>
        </div>
        <!-- Page Title End -->

        <div class="grid lg:grid-cols-2 grid-cols-1 gap-6">
            <div class="col-span-2">
                <div class="card overflow-hidden">
                    <div class="card-header flex justify-between items-center">
                        <h4 class="card-title">List Category</h4>
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
                                                    Category Name</th>
                                                <th scope="col" class="px-6 py-3 text-end text-sm text-default-500">
                                                    Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200">
                                        <?php
                                            renderTableRows($cats, function($cat) {
                                        ?>
                                            <tr class="hover:bg-gray-100">
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-default-800">
                                                <?= htmlspecialchars($cat['cat_name']); ?></td>
                                                <td class="px-6 py-4 flex whitespace-nowrap text-end justify-end text-sm font-medium">
                                                    <a class="text-primary hover:text-sky-700 btn-edit-cat"
                                                        data-cat-id="<?= $cat['cat_id']; ?>" 
                                                        data-cat-name="<?= htmlspecialchars($cat['cat_name']); ?>" 
                                                        data-toggle="modal" 
                                                        data-hs-overlay="#modal-edit-md"
                                                        style="margin-right: 7px"
                                                        href="#">
                                                        <i data-lucide="pencil-line" class="size-5"></i>
                                                    </a>
                                                    <a class="text-primary hover:text-sky-700"
                                                        href="../crud/delete_category.php?cat_id=<?= htmlspecialchars($cat['cat_id']); ?>"
                                                        onclick="return confirm('Are you sure you want to delete this category?');">
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
                <form action="../crud/insert_category.php" method="POST">
                    <div
                        class="flex flex-col border border-default-200 shadow-sm rounded-lg  pointer-events-auto">
                        <div
                            class="flex justify-between items-center py-3 px-4 border-b border-default-200">
                            <h3 class="text-lg font-medium text-default-900">
                                Add Category
                            </h3>
                            <button type="button" class="text-default-600 cursor-pointer"
                                data-hs-overlay="#modal-add-md">
                                <i class="i-tabler-x text-lg"></i>
                            </button>
                        </div>
                        <div class="p-4 overflow-y-auto">
                            <div class="lg:col-span-2">
                                <label for="catName" class="text-default-800 text-sm font-medium inline-block mb-2">Category Name</label>
                                <input type="text" class="form-input" id="catName" name="cat_name" placeholder="Enter Category Name" required>
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
                <form action="../crud/update_category.php" method="POST">
                    <div
                        class="flex flex-col border border-default-200 shadow-sm rounded-lg  pointer-events-auto">
                        <div
                            class="flex justify-between items-center py-3 px-4 border-b border-default-200">
                            <h3 class="text-lg font-medium text-default-900">
                                Edit Category
                            </h3>
                            <button type="button" class="text-default-600 cursor-pointer"
                                data-hs-overlay="#modal-edit-md">
                                <i class="i-tabler-x text-lg"></i>
                            </button>
                        </div>
                        <div class="p-4 overflow-y-auto">
                            <!-- Hidden Input untuk ID -->
                            <input type="hidden" id="catId" name="cat_id">
                            <div class="lg:col-span-2">
                                <label for="catNameEdit" class="text-default-800 text-sm font-medium inline-block mb-2">Category Name</label>
                                <input type="text" class="form-input" id="catNameEdit" name="cat_name" required>
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
            // Pilih semua tombol edit category
            const editButtons = document.querySelectorAll('.btn-edit-cat');

            // Tambahkan event listener pada setiap tombol
            editButtons.forEach(button => {
                button.addEventListener('click', function () {
                    // Ambil data dari atribut tombol
                    const catId = this.getAttribute('data-cat-id');
                    const catName = this.getAttribute('data-cat-name');

                    // Masukkan data ke dalam modal
                    document.getElementById('catId').value = catId; // Untuk hidden input cat_id
                    document.getElementById('catNameEdit').value = catName; // Untuk input cat_name
                });
            });
        });
    </script>

<?php require '../template-footer.php'; ?>