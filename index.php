<?php
session_start();
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query untuk mengecek data login
    $stmt = $conn->prepare("SELECT * FROM tb_user WHERE user_email = :email AND user_password = MD5(:password)");
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->execute();

    // Jika pengguna ditemukan
    if ($stmt->rowCount() > 0) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Set session
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['user_name'] = $user['user_name'];
        $_SESSION['user_email'] = $user['user_email'];
        $_SESSION['user_role'] = $user['user_role'];
        $_SESSION['user_avatar'] = $user['user_avatar'];
        $_SESSION['user_sph'] = $user['user_sph'];
        $_SESSION['user_leader_id'] = $user['user_leader_id'];
        $_SESSION['message'] = "success";

        // Redirect berdasarkan role
        if ($user['user_role'] == 'Leader') {
            header('Location: pages/leader/team-progress.php');
        } elseif ($user['user_role'] == 'Employee') {
            header('Location: pages/employee/personal-progress.php');
        } else {
            $error = "Role tidak dikenal!";
        }
        exit;
    } else {
        $_SESSION['message'] = "error";
        $error = "Email atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Startup Flow - Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/images/favicon.png">
    <link href="assets/auth/css/tailwind.css" rel="stylesheet" type="text/css" />

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-bootstrap-4/bootstrap-4.min.css">
</head>

<body class="h-screen w-screen flex justify-center items-center relative bg-cover bg-top after:absolute after:inset-0 after:bg-black/50 after:-z-10" style="background-image: url('assets/auth/images/bg-auth-3.png');">
    <div class="xl:w-1/2 md:w-3/4 w-full m-8 whitespace-nowrap">
        <div class="flex bg-white overflow-hidden rounded-xl">
            <div class="w-1/2 lg:block hidden p-2">
                <img src="assets/auth/images/bg-auth-2.png" alt="" class="h-full w-full rounded-xl">
            </div>
            <form class="lg:w-1/2 w-full" method="POST">
                <div class="px-6 py-8">
                    <div class="flex justify-between items-start">
                        <h5 class="text-xl font-bold text-gray-700 mb-6">Startup Flow</h5>
                    </div>

                    <div class="mb-4">
                        <label class="flex font-semibold text-base mb-2" for="email">Email Address</label>
                        <input id="email" class="form-input font-normal rounded block w-full border-gray-200 text-sm focus:border-gray-300 focus:ring-0 bg-white" type="email" placeholder="Enter your email" name="email">
                    </div>

                    <div class="mb-4">
                        <label class="flex font-semibold text-base mb-2" for="Password">Password</label>
                        <input id="Password" class="form-input font-normal rounded block w-full border-gray-200 text-sm focus:border-gray-300 focus:ring-0 bg-white" type="password" placeholder="Enter your password" name="password">
                    </div>

                    <div class="flex justify-center mb-6">
                        <button type="submit" class="inline-flex items-center justify-center rounded py-1.5 px-3 text-sm font-semibold transition-all w-full text-white" style="background-color: #00524D;"> Log In </button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <?php if (isset($_SESSION['message'])): ?>
      <script>
          document.addEventListener('DOMContentLoaded', function () {
            const status = "<?= htmlspecialchars($_SESSION['message']) ?>";
              if (status === 'success') {
                  Swal.fire({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    icon: 'success',
                    title: 'Successfully!'
                  });
              } else if (status === 'error') {
                  Swal.fire({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    icon: 'error',
                    title: 'Failed. Please try again.'
                  });
              }
          });
      </script>
    <?php unset($_SESSION['message']); ?>
    <?php endif; ?>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>