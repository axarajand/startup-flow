                <?php if (isset($_SESSION['message'])): ?>
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            const status = "<?= htmlspecialchars($_SESSION['message']) ?>";
                            const titleSuccess = "<?= isset($_SESSION['text_success']) ? htmlspecialchars($_SESSION['text_success']) : 'Successfully!' ?>"; // Default text Success
                            const titleFail = "<?= isset($_SESSION['text_fail']) ? htmlspecialchars($_SESSION['text_fail']) : 'Failed! Try again.' ?>"; // Default text Fail
                            if (status === 'success') {
                                Swal.fire({
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000,
                                    icon: 'success',
                                    title: titleSuccess
                                });
                            } else if (status === 'error') {
                                Swal.fire({
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000,
                                    icon: 'error',
                                    title: titleFail
                                });
                            }
                        });
                    </script>
                    <?php unset($_SESSION['message']); ?>
                <?php endif; ?>

            </main>

        </div>
        <!-- End Page content -->

    </div>
    
    <!-- Plugin Js (Mandatory in All Pages) -->
    <script src="../../assets/libs/simplebar/simplebar.min.js"></script>
    <script src="../../assets/libs/lucide/umd/lucide.min.js"></script>
    <script src="../../assets/libs/iconify-icon/iconify-icon.min.js"></script>
    <script src="../../assets/libs/node-waves/waves.min.js"></script>

    <!-- App Js (Mandatory in All Pages) -->
    <script src="../../assets/js/app.js"></script>
    
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>