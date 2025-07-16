-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Jul 2025 pada 11.59
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `startup-flow`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_category`
--

CREATE TABLE `tb_category` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(255) NOT NULL,
  `cat_created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_category`
--

INSERT INTO `tb_category` (`cat_id`, `cat_name`, `cat_created_at`) VALUES
(25, 'Productivity', '2025-07-08 12:29:37'),
(26, 'Business', '2025-07-08 12:29:43'),
(27, 'Finance', '2025-07-08 12:29:47'),
(28, 'Health & Fitness', '2025-07-08 12:29:53'),
(29, 'Education', '2025-07-08 12:29:58'),
(30, 'Travel', '2025-07-08 12:30:03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_job`
--

CREATE TABLE `tb_job` (
  `job_id` int(11) NOT NULL,
  `job_name` varchar(255) NOT NULL,
  `job_created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_job`
--

INSERT INTO `tb_job` (`job_id`, `job_name`, `job_created_at`) VALUES
(31, 'Frontend Developer', '2025-07-08 12:28:11'),
(32, 'Backend Developer', '2025-07-08 12:28:17'),
(33, 'UI/UX Developer', '2025-07-08 12:28:22'),
(34, 'DevOps Developer', '2025-07-08 12:28:31'),
(35, 'Q/A Engineer', '2025-07-08 12:28:36');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_project`
--

CREATE TABLE `tb_project` (
  `project_id` int(11) NOT NULL,
  `project_name` varchar(255) NOT NULL,
  `project_description` text NOT NULL,
  `project_budget` bigint(20) NOT NULL,
  `project_category_id` int(11) NOT NULL,
  `project_leader_id` int(11) NOT NULL,
  `project_users_id` text NOT NULL,
  `project_created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_project`
--

INSERT INTO `tb_project` (`project_id`, `project_name`, `project_description`, `project_budget`, `project_category_id`, `project_leader_id`, `project_users_id`, `project_created_at`) VALUES
(13, 'Mentory', 'Mentory is a web and mobile-based mentor-mentee application that facilitates connections between mentees and professional mentors in various fields. This application provides search filter features, booking systems, chat, and video calls to facilitate interaction.', 50000000, 29, 1, '[31,32,33,34,35,36,37]', '2025-07-08 12:43:36');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_report`
--

CREATE TABLE `tb_report` (
  `report_id` int(11) NOT NULL,
  `report_task_id` int(11) NOT NULL,
  `report_user_id` int(11) NOT NULL,
  `report_csv` varchar(255) NOT NULL,
  `report_video` varchar(255) NOT NULL,
  `report_start_time` datetime NOT NULL,
  `report_end_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_report`
--

INSERT INTO `tb_report` (`report_id`, `report_task_id`, `report_user_id`, `report_csv`, `report_video`, `report_start_time`, `report_end_time`) VALUES
(62, 108, 31, '1_13/activity_108_31.csv', '1_13/screen_108_31.mp4', '2025-07-10 10:54:36', '2025-07-10 10:54:39'),
(63, 109, 31, '1_13/activity_109_31.csv', '1_13/screen_109_31.mp4', '2025-07-10 10:55:00', '2025-07-10 10:55:01'),
(64, 110, 31, '1_13/activity_110_31.csv', '1_13/screen_110_31.mp4', '2025-07-10 10:55:05', '2025-07-10 10:55:07'),
(65, 113, 32, '1_13/activity_113_32.csv', '1_13/screen_113_32.mp4', '2025-07-10 10:55:45', '2025-07-10 10:55:46'),
(66, 114, 32, '1_13/activity_114_32.csv', '1_13/screen_114_32.mp4', '2025-07-10 10:55:48', '2025-07-10 10:55:49'),
(67, 115, 32, '1_13/activity_115_32.csv', '1_13/screen_115_32.mp4', '2025-07-10 10:55:52', '2025-07-10 10:55:52'),
(68, 116, 32, '1_13/activity_116_32.csv', '1_13/screen_116_32.mp4', '2025-07-10 10:55:54', '2025-07-10 10:55:55'),
(69, 117, 32, '1_13/activity_117_32.csv', '1_13/screen_117_32.mp4', '2025-07-10 10:55:57', '2025-07-10 10:55:58'),
(70, 119, 33, '1_13/activity_119_33.csv', '1_13/screen_119_33.mp4', '2025-07-10 10:56:10', '2025-07-10 10:56:11'),
(71, 124, 34, '1_13/activity_124_34.csv', '1_13/screen_124_34.mp4', '2025-07-10 10:56:23', '2025-07-10 10:56:24'),
(72, 125, 34, '1_13/activity_125_34.csv', '1_13/screen_125_34.mp4', '2025-07-10 10:56:26', '2025-07-10 10:56:27'),
(73, 126, 34, '1_13/activity_126_34.csv', '1_13/screen_126_34.mp4', '2025-07-10 10:56:28', '2025-07-10 10:56:29'),
(74, 127, 34, '1_13/activity_127_34.csv', '1_13/screen_127_34.mp4', '2025-07-10 10:56:31', '2025-07-10 10:56:32'),
(75, 128, 34, '1_13/activity_128_34.csv', '1_13/screen_128_34.mp4', '2025-07-10 10:56:33', '2025-07-10 10:56:34'),
(76, 129, 34, '1_13/activity_129_34.csv', '1_13/screen_129_34.mp4', '2025-07-10 10:56:36', '2025-07-10 10:56:37'),
(77, 130, 34, '1_13/activity_130_34.csv', '1_13/screen_130_34.mp4', '2025-07-10 10:56:38', '2025-07-10 10:56:39'),
(78, 131, 35, '1_13/activity_131_35.csv', '1_13/screen_131_35.mp4', '2025-07-10 10:56:49', '2025-07-10 10:56:51'),
(79, 132, 35, '1_13/activity_132_35.csv', '1_13/screen_132_35.mp4', '2025-07-10 10:56:52', '2025-07-10 10:56:53'),
(80, 136, 36, '1_13/activity_136_36.csv', '1_13/screen_136_36.mp4', '2025-07-10 10:57:05', '2025-07-10 10:57:06'),
(81, 137, 36, '1_13/activity_137_36.csv', '1_13/screen_137_36.mp4', '2025-07-10 10:57:08', '2025-07-10 10:57:09'),
(82, 138, 36, '1_13/activity_138_36.csv', '1_13/screen_138_36.mp4', '2025-07-10 10:57:11', '2025-07-10 10:57:12'),
(83, 139, 36, '1_13/activity_139_36.csv', '1_13/screen_139_36.mp4', '2025-07-10 10:57:13', '2025-07-10 10:57:14'),
(84, 140, 36, '1_13/activity_140_36.csv', '1_13/screen_140_36.mp4', '2025-07-10 10:57:16', '2025-07-10 10:57:17'),
(85, 141, 37, '1_13/activity_141_37.csv', '1_13/screen_141_37.mp4', '2025-07-10 10:57:35', '2025-07-10 10:57:36'),
(86, 142, 37, '1_13/activity_142_37.csv', '1_13/screen_142_37.mp4', '2025-07-10 10:57:37', '2025-07-10 10:57:38'),
(87, 143, 37, '1_13/activity_143_37.csv', '1_13/screen_143_37.mp4', '2025-07-10 10:57:40', '2025-07-10 10:57:41'),
(88, 144, 37, '1_13/activity_144_37.csv', '1_13/screen_144_37.mp4', '2025-07-10 10:57:42', '2025-07-10 10:57:43');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_task`
--

CREATE TABLE `tb_task` (
  `task_id` int(11) NOT NULL,
  `task_record` enum('set','process','request','done','revision','paused') NOT NULL,
  `task_name` varchar(255) NOT NULL,
  `task_description` text NOT NULL,
  `task_project_id` int(11) NOT NULL,
  `task_user_id` int(100) NOT NULL,
  `task_attachment` varchar(255) DEFAULT NULL,
  `task_deadline_start` datetime NOT NULL,
  `task_deadline_end` datetime NOT NULL,
  `task_created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `task_modified_dt` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_task`
--

INSERT INTO `tb_task` (`task_id`, `task_record`, `task_name`, `task_description`, `task_project_id`, `task_user_id`, `task_attachment`, `task_deadline_start`, `task_deadline_end`, `task_created_at`, `task_modified_dt`) VALUES
(108, 'done', 'Build Login Page', 'Develop a responsive login page for the application.', 13, 31, '1751979027.pdf', '2025-07-09 08:00:00', '2025-07-10 17:00:00', '2025-07-08 12:56:58', '2025-07-10 10:57:57'),
(109, 'done', 'Create Dashboard UI', 'Design and implement the mentee dashboard interface.', 13, 31, '1751979027.pdf', '2025-07-11 08:00:00', '2025-07-13 17:00:00', '2025-07-08 12:56:58', '2025-07-10 10:58:17'),
(110, 'done', 'Implement Navigation Bar', 'Develop the main navigation bar for the app.', 13, 31, '1751979027.pdf', '2025-07-14 08:00:00', '2025-07-15 17:00:00', '2025-07-08 12:56:58', '2025-07-10 10:58:25'),
(111, 'set', 'Optimize Frontend Performance', 'Improve the frontend performance and loading speed.', 13, 31, '1751979027.pdf', '2025-07-16 08:00:00', '2025-07-17 17:00:00', '2025-07-08 12:56:58', '2025-07-08 22:33:35'),
(112, 'set', 'Integrate API with Frontend', 'Connect backend APIs with frontend components.', 13, 31, '1751979027.pdf', '2025-07-18 08:00:00', '2025-07-20 17:00:00', '2025-07-08 12:56:58', '2025-07-08 22:33:39'),
(113, 'done', 'Setup Authentication API', 'Create login and registration APIs with token-based authentication.', 13, 32, '1751979027.pdf', '2025-07-09 08:00:00', '2025-07-11 17:00:00', '2025-07-08 12:56:58', '2025-07-10 10:58:08'),
(114, 'done', 'Develop User CRUD API', 'Implement APIs for creating, reading, updating, and deleting users.', 13, 32, '1751979027.pdf', '2025-07-12 08:00:00', '2025-07-13 17:00:00', '2025-07-08 12:56:58', '2025-07-10 10:58:18'),
(115, 'done', 'Design Database Schema', 'Design the database schema for Mentory.', 13, 32, '1751979027.pdf', '2025-07-14 08:00:00', '2025-07-15 17:00:00', '2025-07-08 12:56:58', '2025-07-10 10:58:27'),
(116, 'done', 'Create Notification API', 'Develop APIs for sending user notifications.', 13, 32, '1751979027.pdf', '2025-07-16 08:00:00', '2025-07-18 17:00:00', '2025-07-08 12:56:58', '2025-07-10 10:58:32'),
(117, 'done', 'Optimize Query Performance', 'Optimize database queries for better performance.', 13, 32, '1751979027.pdf', '2025-07-19 08:00:00', '2025-07-21 17:00:00', '2025-07-08 12:56:58', '2025-07-10 10:58:39'),
(118, 'set', 'Develop Payment Gateway API', 'Implement APIs for mentor payment processing.', 13, 32, '1751979027.pdf', '2025-07-22 08:00:00', '2025-07-24 17:00:00', '2025-07-08 12:56:58', '2025-07-08 20:04:53'),
(119, 'done', 'Design Landing Page', 'Create a modern and engaging landing page for Mentory.', 13, 33, '1751979027.pdf', '2025-07-09 08:00:00', '2025-07-10 17:00:00', '2025-07-08 12:56:58', '2025-07-10 10:57:59'),
(120, 'set', 'Create User Flow Diagram', 'Design user flow diagrams for smooth navigation.', 13, 33, '1751979027.pdf', '2025-07-11 08:00:00', '2025-07-12 17:00:00', '2025-07-08 12:56:58', '2025-07-08 20:04:53'),
(121, 'set', 'Design Dashboard UI', 'Design the mentee dashboard with focus on UX.', 13, 33, '1751979027.pdf', '2025-07-13 08:00:00', '2025-07-14 17:00:00', '2025-07-08 12:56:58', '2025-07-08 20:04:53'),
(122, 'set', 'Prepare Icon Assets', 'Design and prepare icon assets for the application.', 13, 33, '1751979027.pdf', '2025-07-15 08:00:00', '2025-07-16 17:00:00', '2025-07-08 12:56:58', '2025-07-08 20:04:53'),
(123, 'set', 'Create Interactive Prototype', 'Build an interactive prototype in Figma.', 13, 33, '1751979027.pdf', '2025-07-17 08:00:00', '2025-07-18 17:00:00', '2025-07-08 12:56:58', '2025-07-08 20:04:53'),
(124, 'done', 'Setup Staging Server', 'Setup a staging server for testing and deployment.', 13, 34, '1751979027.pdf', '2025-07-09 08:00:00', '2025-07-10 17:00:00', '2025-07-08 12:56:58', '2025-07-10 10:58:01'),
(125, 'done', 'Configure CI/CD Pipeline', 'Implement CI/CD for automated deployments.', 13, 34, '1751979027.pdf', '2025-07-11 08:00:00', '2025-07-12 17:00:00', '2025-07-08 12:56:58', '2025-07-10 10:58:10'),
(126, 'done', 'Setup Database Backup', 'Setup database backup and recovery systems.', 13, 34, '1751979027.pdf', '2025-07-13 08:00:00', '2025-07-14 17:00:00', '2025-07-08 12:56:58', '2025-07-10 10:58:20'),
(127, 'done', 'Implement Server Monitoring', 'Implement monitoring tools for server performance.', 13, 34, '1751979027.pdf', '2025-07-15 08:00:00', '2025-07-16 17:00:00', '2025-07-08 12:56:58', '2025-07-10 10:58:28'),
(128, 'done', 'Enhance Server Security', 'Configure server security settings.', 13, 34, '1751979027.pdf', '2025-07-17 08:00:00', '2025-07-18 17:00:00', '2025-07-08 12:56:58', '2025-07-10 10:58:34'),
(129, 'done', 'Deploy to Production', 'Deploy the application to the production server.', 13, 34, '1751979027.pdf', '2025-07-19 08:00:00', '2025-07-20 17:00:00', '2025-07-08 12:56:58', '2025-07-10 10:58:38'),
(130, 'done', 'Test Load Balancer Setup', 'Test load balancing configurations.', 13, 34, '1751979027.pdf', '2025-07-21 08:00:00', '2025-07-22 17:00:00', '2025-07-08 12:56:58', '2025-07-10 10:58:41'),
(131, 'done', 'Write Unit Tests for API', 'Develop unit tests for backend APIs.', 13, 35, '1751979027.pdf', '2025-07-09 08:00:00', '2025-07-10 17:00:00', '2025-07-08 12:56:58', '2025-07-10 10:58:03'),
(132, 'done', 'Perform Frontend Testing', 'Test frontend UI on multiple devices.', 13, 35, '1751979027.pdf', '2025-07-11 08:00:00', '2025-07-12 17:00:00', '2025-07-08 12:56:58', '2025-07-10 10:58:11'),
(133, 'set', 'Write Integration Tests', 'Develop integration tests for API and frontend.', 13, 35, '1751979027.pdf', '2025-07-13 08:00:00', '2025-07-14 17:00:00', '2025-07-08 12:56:58', '2025-07-08 20:04:53'),
(134, 'set', 'Document Bugs and Issues', 'Document all bugs found during testing.', 13, 35, '1751979027.pdf', '2025-07-15 08:00:00', '2025-07-16 17:00:00', '2025-07-08 12:56:58', '2025-07-08 20:04:53'),
(135, 'set', 'Conduct Regression Testing', 'Perform regression testing for each release.', 13, 35, '1751979027.pdf', '2025-07-17 08:00:00', '2025-07-18 17:00:00', '2025-07-08 12:56:58', '2025-07-08 20:04:53'),
(136, 'done', 'Build Profile Page', 'Develop the user profile page with responsive design.', 13, 36, '1751979027.pdf', '2025-07-09 08:00:00', '2025-07-10 17:00:00', '2025-07-08 12:56:58', '2025-07-10 10:58:05'),
(137, 'done', 'Develop Notification System', 'Implement notification system in the frontend.', 13, 36, '1751979027.pdf', '2025-07-11 08:00:00', '2025-07-12 17:00:00', '2025-07-08 12:56:58', '2025-07-10 10:58:13'),
(138, 'done', 'Implement Responsive Design', 'Optimize the UI for all screen sizes.', 13, 36, '1751979027.pdf', '2025-07-13 08:00:00', '2025-07-14 17:00:00', '2025-07-08 12:56:58', '2025-07-10 10:58:22'),
(139, 'done', 'Integrate Chat Feature', 'Add realtime chat feature to the frontend.', 13, 36, '1751979027.pdf', '2025-07-15 08:00:00', '2025-07-16 17:00:00', '2025-07-08 12:56:58', '2025-07-10 10:58:29'),
(140, 'done', 'Create Notification Dropdown', 'Develop a dropdown menu for notifications.', 13, 36, '1751979027.pdf', '2025-07-17 08:00:00', '2025-07-18 17:00:00', '2025-07-08 12:56:58', '2025-07-10 10:58:36'),
(141, 'done', 'Develop Chat API', 'Build backend APIs for realtime chat.', 13, 37, '1751979027.pdf', '2025-07-09 08:00:00', '2025-07-10 17:00:00', '2025-07-08 12:56:58', '2025-07-10 10:58:06'),
(142, 'done', 'Implement Role-Based Access Control', 'Set up user roles and access permissions.', 13, 37, '1751979027.pdf', '2025-07-11 08:00:00', '2025-07-12 17:00:00', '2025-07-08 12:56:58', '2025-07-10 10:58:15'),
(143, 'done', 'Create Analytics API', 'Develop APIs for analytics and reports.', 13, 37, '1751979027.pdf', '2025-07-13 08:00:00', '2025-07-14 17:00:00', '2025-07-08 12:56:58', '2025-07-10 10:58:24'),
(144, 'done', 'Optimize API Response Time', 'Improve backend API response time.', 13, 37, '1751979027.pdf', '2025-07-15 08:00:00', '2025-07-16 17:00:00', '2025-07-08 12:56:58', '2025-07-10 10:58:31'),
(145, 'set', 'Setup WebSocket Server', 'Implement WebSocket server for realtime communication.', 13, 37, '1751979027.pdf', '2025-07-17 08:00:00', '2025-07-18 17:00:00', '2025-07-08 12:56:58', '2025-07-08 20:04:53');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_sph` bigint(20) NOT NULL,
  `user_avatar` varchar(255) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  `user_job_id` int(11) NOT NULL,
  `user_role` enum('Leader','Employee') NOT NULL,
  `user_leader_id` int(11) DEFAULT NULL,
  `user_created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_modified_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`user_id`, `user_name`, `user_sph`, `user_avatar`, `user_email`, `user_password`, `user_job_id`, `user_role`, `user_leader_id`, `user_created_at`, `user_modified_at`) VALUES
(1, 'Project Manager', 19000, 'rika_avatar.png', 'project_manager@gmail.com', '202cb962ac59075b964b07152d234b70', 1, 'Leader', NULL, '2025-01-04 10:43:39', '2025-03-13 08:53:27'),
(31, 'Employee A', 50000, '5.jpg', 'employee_a@gmail.com', '202cb962ac59075b964b07152d234b70', 31, 'Employee', 1, '2025-07-08 12:33:42', '2025-07-08 12:58:33'),
(32, 'Employee B', 60000, '38.jpg', 'employee_b@gmail.com', '202cb962ac59075b964b07152d234b70', 32, 'Employee', 1, '2025-07-08 12:35:32', '2025-07-08 12:58:33'),
(33, 'Employee C', 45000, '44.jpg', 'employee_c@gmail.com', '202cb962ac59075b964b07152d234b70', 33, 'Employee', 1, '2025-07-08 12:35:56', '2025-07-08 12:58:33'),
(34, 'Employee D', 70000, '60.jpg', 'employee_d@gmail.com', '202cb962ac59075b964b07152d234b70', 34, 'Employee', 1, '2025-07-08 12:36:21', '2025-07-08 12:58:33'),
(35, 'Employee E', 40000, 'student_1.png', 'employee_e@gmail.com', '202cb962ac59075b964b07152d234b70', 35, 'Employee', 1, '2025-07-08 12:36:47', '2025-07-08 12:58:33'),
(36, 'Employee F', 52000, 'student_2.png', 'employee_f@gmail.com', '202cb962ac59075b964b07152d234b70', 31, 'Employee', 1, '2025-07-08 12:37:14', '2025-07-08 12:58:33'),
(37, 'Employee G', 62000, 'student_3.png', 'employee_g@gmail.com', '202cb962ac59075b964b07152d234b70', 32, 'Employee', 1, '2025-07-08 12:37:38', '2025-07-08 12:58:33'),
(38, 'Employee H', 48000, 'student_4.png', 'employee_h@gmail.com', '202cb962ac59075b964b07152d234b70', 33, 'Employee', 1, '2025-07-08 12:37:59', '2025-07-08 12:58:33'),
(39, 'Employee I', 72000, 'student_6.png', 'employee_i@gmail.com', '202cb962ac59075b964b07152d234b70', 34, 'Employee', 1, '2025-07-08 12:38:22', '2025-07-08 12:58:33'),
(40, 'Employee J', 42000, 'student_7.png', 'employee_j@gmail.com', '202cb962ac59075b964b07152d234b70', 35, 'Employee', 1, '2025-07-08 12:39:03', '2025-07-08 12:58:33');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_category`
--
ALTER TABLE `tb_category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indeks untuk tabel `tb_job`
--
ALTER TABLE `tb_job`
  ADD PRIMARY KEY (`job_id`);

--
-- Indeks untuk tabel `tb_project`
--
ALTER TABLE `tb_project`
  ADD PRIMARY KEY (`project_id`),
  ADD KEY `project_category_id` (`project_category_id`),
  ADD KEY `project_leader_id` (`project_leader_id`);

--
-- Indeks untuk tabel `tb_report`
--
ALTER TABLE `tb_report`
  ADD PRIMARY KEY (`report_id`),
  ADD KEY `report_task_id` (`report_task_id`),
  ADD KEY `report_user_id` (`report_user_id`);

--
-- Indeks untuk tabel `tb_task`
--
ALTER TABLE `tb_task`
  ADD PRIMARY KEY (`task_id`),
  ADD KEY `task_project_id` (`task_project_id`),
  ADD KEY `task_user_id` (`task_user_id`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `user_job_id` (`user_job_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_category`
--
ALTER TABLE `tb_category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `tb_job`
--
ALTER TABLE `tb_job`
  MODIFY `job_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT untuk tabel `tb_project`
--
ALTER TABLE `tb_project`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `tb_report`
--
ALTER TABLE `tb_report`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT untuk tabel `tb_task`
--
ALTER TABLE `tb_task`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_project`
--
ALTER TABLE `tb_project`
  ADD CONSTRAINT `tb_project_ibfk_1` FOREIGN KEY (`project_category_id`) REFERENCES `tb_category` (`cat_id`),
  ADD CONSTRAINT `tb_project_ibfk_2` FOREIGN KEY (`project_leader_id`) REFERENCES `tb_user` (`user_id`);

--
-- Ketidakleluasaan untuk tabel `tb_report`
--
ALTER TABLE `tb_report`
  ADD CONSTRAINT `tb_report_ibfk_1` FOREIGN KEY (`report_task_id`) REFERENCES `tb_task` (`task_id`),
  ADD CONSTRAINT `tb_report_ibfk_2` FOREIGN KEY (`report_user_id`) REFERENCES `tb_user` (`user_id`);

--
-- Ketidakleluasaan untuk tabel `tb_task`
--
ALTER TABLE `tb_task`
  ADD CONSTRAINT `tb_task_ibfk_1` FOREIGN KEY (`task_user_id`) REFERENCES `tb_user` (`user_id`),
  ADD CONSTRAINT `tb_task_ibfk_2` FOREIGN KEY (`task_project_id`) REFERENCES `tb_project` (`project_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
