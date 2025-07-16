<!-- Start Sidebar -->
<aside id="app-menu"
    class="hs-overlay fixed inset-y-0 start-0 z-60 hidden w-sidenav min-w-sidenav -translate-x-full transform overflow-y-auto bg-body transition-all duration-300 hs-overlay-open:translate-x-0 lg:bottom-0 lg:end-auto lg:z-30 lg:block lg:translate-x-0 rtl:translate-x-full rtl:hs-overlay-open:translate-x-0 rtl:lg:translate-x-0 print:hidden [--body-scroll:true] [--overlay-backdrop:true] lg:[--overlay-backdrop:false]">
    <div class="lg:sticky lg:top-0 h-32 flex flex-col items-center justify-center">
        <img class="inline-block size-[62px] rounded-full" src="../../assets/images/avatar/<?= $_SESSION['user_avatar']; ?>" alt="Image Avatar">
        <p class="mt-2"><?= $_SESSION["user_name"]; ?></p>
        <small><?= $_SESSION["user_email"]; ?></small>
    </div>
    
    <hr>

    <div class="h-[calc(100%-64px)] p-4 lg:ps-8" data-simplebar>
        <ul class="admin-menu hs-accordion-group flex w-full flex-col gap-1.5">

        <?php if ($_SESSION['user_role'] == "Leader") : ?>
            

            <li class="px-5 py-2 text-sm font-medium text-default-600">Inisialitation Team</li>

            <li class="menu-item">
                <a href="../../pages/leader/job.php"
                    class="group flex items-center gap-x-4 rounded-md px-3 py-2 text-sm font-medium text-default-700 transition-all hover:bg-default-900/5 hs-accordion-active:bg-default-900/5 hs-accordion-active:text-default-700 <?= (basename($_SERVER['REQUEST_URI']) == 'job.php') ? 'active' : ''; ?>">
                    <i data-lucide="plus" class="size-5"></i>
                    <span class="menu-text"> Job </span>
                </a>
            </li>

            <li class="menu-item">
                <a href="../../pages/leader/category.php"
                    class="group flex items-center gap-x-4 rounded-md px-3 py-2 text-sm font-medium text-default-700 transition-all hover:bg-default-900/5 hs-accordion-active:bg-default-900/5 hs-accordion-active:text-default-700 <?= (basename($_SERVER['REQUEST_URI']) == 'category.php') ? 'active' : ''; ?>">
                    <i data-lucide="plus" class="size-5"></i>
                    <span class="menu-text"> Category </span>
                </a>
            </li>

            <li class="menu-item">
                <a href="../../pages/leader/team.php"
                    class="group flex items-center gap-x-4 rounded-md px-3 py-2 text-sm font-medium text-default-700 transition-all hover:bg-default-900/5 hs-accordion-active:bg-default-900/5 hs-accordion-active:text-default-700 <?= (basename($_SERVER['REQUEST_URI']) == 'team.php') ? 'active' : ''; ?>">
                    <i data-lucide="plus" class="size-5"></i>
                    <span class="menu-text"> Team </span>
                </a>
            </li>

            <li class="px-5 py-2 text-sm font-medium text-default-600">Inisialitation Project</li>

            <li class="menu-item">
                <a href="../../pages/leader/set-project.php"
                    class="group flex items-center gap-x-4 rounded-md px-3 py-2 text-sm font-medium text-default-700 transition-all hover:bg-default-900/5 hs-accordion-active:bg-default-900/5 hs-accordion-active:text-default-700 <?= (basename($_SERVER['REQUEST_URI']) == 'set-project.php') ? 'active' : ''; ?>">
                    <i data-lucide="airplay" class="size-5"></i>
                    <span class="menu-text"> Add Project </span>
                </a>
            </li>

            <li class="menu-item">
                <a href="../../pages/leader/set-task.php"
                    class="group flex items-center gap-x-4 rounded-md px-3 py-2 text-sm font-medium text-default-700 transition-all hover:bg-default-900/5 hs-accordion-active:bg-default-900/5 hs-accordion-active:text-default-700 <?= (basename($_SERVER['REQUEST_URI']) == 'set-task.php') ? 'active' : ''; ?>">
                    <i data-lucide="file-text" class="size-5"></i>
                    <span class="menu-text"> Add Task </span>
                </a>
            </li>

            <li class="px-5 py-2 text-sm font-medium text-default-600">Monitoring</li>

            <li class="menu-item">
                <a href="../../pages/leader/team-progress.php"
                    class="group flex items-center gap-x-4 rounded-md px-3 py-2 text-sm font-medium text-default-700 transition-all hover:bg-default-900/5 hs-accordion-active:bg-default-900/5 hs-accordion-active:text-default-700 <?= (basename($_SERVER['REQUEST_URI']) == 'team-progress.php') ? 'active' : ''; ?>">
                    <i data-lucide="circle-dot-dashed" class="size-5"></i>
                    <span class="menu-text"> Team Progress </span>
                </a>
            </li>

            <li class="menu-item">
                <a href="../../pages/leader/daily-report.php"
                    class="group flex items-center gap-x-4 rounded-md px-3 py-2 text-sm font-medium text-default-700 transition-all hover:bg-default-900/5 hs-accordion-active:bg-default-900/5 hs-accordion-active:text-default-700 <?= (basename($_SERVER['REQUEST_URI']) == 'daily-report.php') ? 'active' : ''; ?>">
                    <i data-lucide="notebook-text" class="size-5"></i>
                    <span class="menu-text"> Daily Report </span>
                </a>
            </li>

            <li class="menu-item">
                <a href="../../pages/leader/request-approval.php"
                    class="group flex items-center gap-x-4 rounded-md px-3 py-2 text-sm font-medium text-default-700 transition-all hover:bg-default-900/5 hs-accordion-active:bg-default-900/5 hs-accordion-active:text-default-700 <?= (basename($_SERVER['REQUEST_URI']) == 'request-approval.php') ? 'active' : ''; ?>">
                    <i data-lucide="git-pull-request" class="size-5"></i>
                    <span class="menu-text"> Request Approval </span>
                </a>
            </li>

            <li class="menu-item">
                <a href="../../pages/leader/monitoring-team.php"
                    class="group flex items-center gap-x-4 rounded-md px-3 py-2 text-sm font-medium text-default-700 transition-all hover:bg-default-900/5 hs-accordion-active:bg-default-900/5 hs-accordion-active:text-default-700 <?= (basename($_SERVER['REQUEST_URI']) == 'monitoring-team.php') ? 'active' : ''; ?>">
                    <i data-lucide="monitor-check" class="size-5"></i>
                    <span class="menu-text"> Monitoring Team </span>
                </a>
            </li>

            <li class="menu-item">
                <a href="../../pages/leader/project-report.php"
                    class="group flex items-center gap-x-4 rounded-md px-3 py-2 text-sm font-medium text-default-700 transition-all hover:bg-default-900/5 hs-accordion-active:bg-default-900/5 hs-accordion-active:text-default-700 <?= (basename($_SERVER['REQUEST_URI']) == 'report-project.php') ? 'active' : ''; ?>">
                    <i data-lucide="archive" class="size-5"></i>
                    <span class="menu-text"> Project Report </span>
                </a>
            </li>

        <?php elseif ($_SESSION['user_role'] == "Employee")  : ?>

            <li class="px-5 py-2 text-sm font-medium text-default-600">Task</li>

            <li class="menu-item">
                <a href="../../pages/employee/list-task.php"
                    class="group flex items-center gap-x-4 rounded-md px-3 py-2 text-sm font-medium text-default-700 transition-all hover:bg-default-900/5 hs-accordion-active:bg-default-900/5 hs-accordion-active:text-default-700 <?= (basename($_SERVER['REQUEST_URI']) == 'list-task.php') ? 'active' : ''; ?>">
                    <i data-lucide="layout-list" class="size-5"></i>
                    <span class="menu-text"> List Task </span>
                </a>
            </li>

            <li class="px-5 py-2 text-sm font-medium text-default-600">Monitoring</li>

            <li class="menu-item">
                <a href="../../pages/employee/personal-progress.php"
                    class="group flex items-center gap-x-4 rounded-md px-3 py-2 text-sm font-medium text-default-700 transition-all hover:bg-default-900/5 hs-accordion-active:bg-default-900/5 hs-accordion-active:text-default-700 <?= (basename($_SERVER['REQUEST_URI']) == 'personal-progress.php') ? 'active' : ''; ?>">
                    <i data-lucide="circle-dashed" class="size-5"></i>
                    <span class="menu-text"> Personal Progress </span>
                </a>
            </li>

            <li class="menu-item">
                <a href="../../pages/employee/revision.php"
                    class="group flex items-center gap-x-4 rounded-md px-3 py-2 text-sm font-medium text-default-700 transition-all hover:bg-default-900/5 hs-accordion-active:bg-default-900/5 hs-accordion-active:text-default-700 <?= (basename($_SERVER['REQUEST_URI']) == 'revision.php') ? 'active' : ''; ?>">
                    <i data-lucide="badge-x" class="size-5"></i>
                    <span class="menu-text"> Revision </span>
                </a>
            </li>

            <li class="menu-item">
                <a href="../../pages/employee/approval.php"
                    class="group flex items-center gap-x-4 rounded-md px-3 py-2 text-sm font-medium text-default-700 transition-all hover:bg-default-900/5 hs-accordion-active:bg-default-900/5 hs-accordion-active:text-default-700 <?= (basename($_SERVER['REQUEST_URI']) == 'approval.php') ? 'active' : ''; ?>">
                    <i data-lucide="badge-check" class="size-5"></i>
                    <span class="menu-text"> Approval </span>
                </a>
            </li>

        <?php endif; ?>

            <li class="px-5 py-2 text-sm font-medium text-default-600"><hr></li>

            <li class="menu-item">
                <a href="../../pages/logout.php"
                    class="group flex items-center gap-x-4 rounded-md px-3 py-2 text-sm font-medium text-default-700 transition-all hover:bg-default-900/5 hs-accordion-active:bg-default-900/5 hs-accordion-active:text-default-700 <?= (basename($_SERVER['REQUEST_URI']) == 'logout.php') ? 'active' : ''; ?>">
                    <i data-lucide="log-out" class="size-5"></i>
                    <span class="menu-text"> Logout </span>
                </a>
            </li>

        </ul>
    </div>
</aside>
<!-- End Sidebar -->

<!-- Mobile Nav Start -->
<div class="md:hidden flex">
    <div class="fixed bottom-0 z-50 shadow-md w-full h-16 flex items-center justify-between px-5 gap-4 bg-white border-b border-default-100">

        <?php if ($_SESSION['user_role'] == "Leader") : ?>

            <a href="../../pages/leader/team-progress.php" class="flex flex-col items-center justify-center gap-1 text-default-600">
                <i data-lucide="circle-dot-dashed" class="size-5"></i>
                <span class="text-xs font-semibold">Progress</span>
            </a>
            <a href="../../pages/leader/daily-report.php" class="flex flex-col items-center justify-center gap-1 text-default-600">
                <i data-lucide="notebook-text" class="size-5"></i>
                <span class="text-xs font-semibold">Daily</span>
            </a>
            <a href="../../pages/leader/request-approval.php" class="flex flex-col items-center justify-center gap-1 text-default-600">
                <i data-lucide="git-pull-request" class="size-5"></i>
                <span class="text-xs font-semibold">Request</span>
            </a>
            <a href="../../pages/leader/monitoring-team.php" class="flex flex-col items-center justify-center gap-1 text-default-600">
                <i data-lucide="monitor-check" class="size-5"></i>
                <span class="text-xs font-semibold">Monitoring</span>
            </a>
            <a href="../../pages/leader/project-report.php" class="flex flex-col items-center justify-center gap-1 text-default-600">
                <i data-lucide="archive" class="size-5"></i>
                <span class="text-xs font-semibold">Report</span>
            </a>

        <?php elseif ($_SESSION['user_role'] == "Employee")  : ?>

            <a href="../../pages/employee/list-task.php" class="flex flex-col items-center justify-center gap-1 text-default-600">
                <i data-lucide="layout-list" class="size-5"></i>
                <span class="text-xs font-semibold">List Task</span>
            </a>
            <a href="../../pages/employee/personal-progress.php" class="flex flex-col items-center justify-center gap-1 text-default-600">
                <i data-lucide="circle-dashed" class="size-5"></i>
                <span class="text-xs font-semibold">Personal Progress</span>
            </a>
            <a href="../../pages/employee/revision.php" class="flex flex-col items-center justify-center gap-1 text-default-600">
                <i data-lucide="badge-x" class="size-5"></i>
                <span class="text-xs font-semibold">Revision</span>
            </a>
            <a href="../../pages/employee/approval.php" class="flex flex-col items-center justify-center gap-1 text-default-600">
                <i data-lucide="badge-check" class="size-5"></i>
                <span class="text-xs font-semibold">Approval</span>
            </a>

        <?php endif; ?>
    </div>
</div>
<!-- Mobile Nav End -->

<!-- Start Page Content here -->
<div class="page-content">

    <!-- Topbar Start -->
    <header class="app-header md:hidden h-16 flex items-center lg:bg-opacity-10 bg-white  backdrop-blur-sm">
        <div class="container flex items-center gap-4">
            <!-- Topbar Brand Logo -->
            <a href="index.html" class="md:hidden flex">
                <img src="../../assets/images/favicon.png" class="h-6" alt="Small logo">
            </a>

            <!-- Sidenav Menu Toggle Button -->
            <button id="button-toggle-menu" class="text-default-500 hover:text-default-600 p-2 rounded-full cursor-pointer"
                data-hs-overlay="#app-menu" aria-label="Toggle navigation">
                <i class="i-tabler-menu-2 text-2xl"></i>
            </button>

            <!-- Language Dropdown Button -->
            <div class="ms-auto hs-dropdown relative inline-flex [--placement:bottom-right]">
            </div>

            <!-- Fullscreen Toggle Button -->
            <div class="md:flex hidden">
                <button data-toggle="fullscreen" type="button" class="nav-link p-2">
                    <span class="sr-only">Fullscreen Mode</span>
                    <span class="flex items-center justify-center size-6">
                        <i class="i-tabler-maximize text-2xl flex group-[-fullscreen]:hidden"></i>
                        <i class="i-tabler-minimize text-2xl hidden group-[-fullscreen]:flex"></i>
                    </span>
                </button>
            </div>

            <!-- Profile Dropdown Button -->
            <div class="relative">
                <div class="hs-dropdown relative inline-flex [--placement:bottom-right]">
                    <button type="button" class="hs-dropdown-toggle nav-link flex items-center gap-2">
                        <p><?= $_SESSION["user_name"]; ?></p>
                        <img src="../../assets/images/avatar/<?= $_SESSION["user_avatar"]; ?>" alt="user-image" class="rounded-full h-10">
                    </button>
                </div>
            </div>
        </div>
    </header>
    <!-- Topbar End -->

    <main>