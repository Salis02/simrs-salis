-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 30, 2025 at 05:06 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simrs`
--

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `specialization` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `name`, `specialization`, `phone`, `email`, `is_active`, `created_at`, `updated_at`) VALUES
(2, 'Dr. Siti Nurhaliza, Sp.A', 'Anak', '081234567891', 'siti.nurhaliza@example.com', 1, '2025-09-28 06:43:48', '2025-09-28 06:43:48'),
(3, 'Dr. Budi Santoso, Sp.OG', 'Kandungan', '081234567892', 'budi.santoso@example.com', 1, '2025-09-28 06:43:48', '2025-09-29 09:05:47'),
(4, 'Dr. Maya Dewi, Sp.M', 'Mata', '081234567893', 'maya.dewi@example.com', 1, '2025-09-28 06:43:48', '2025-09-28 06:43:48'),
(5, 'Dr. Rizki Pratama, Sp.JP', 'Jantung', '081234567894', 'rizki.pratama@example.com', 1, '2025-09-28 06:43:48', '2025-09-28 06:43:48'),
(6, 'Salis Nizar Qomaruzaman, S.Kom.', 'Penyakit Dalam', '081234567890', 'ahmad.hidayat@example.com', 1, '2025-09-29 13:53:16', '2025-09-29 13:53:16');

-- --------------------------------------------------------

--
-- Table structure for table `drugs`
--

CREATE TABLE `drugs` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `generic_name` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `unit` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `stock` int NOT NULL DEFAULT '0',
  `price` decimal(10,2) NOT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `drugs`
--

INSERT INTO `drugs` (`id`, `name`, `generic_name`, `unit`, `stock`, `price`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Kontreksin', 'cahdaj', 'Kapsul', 88, '300000.00', 'obat puyeng\r\n', '2025-09-30 03:16:58', '2025-09-30 04:03:13'),
(2, 'ngising', 'skaajd', 'Unit', 23019, '100000.00', 'anajsss', '2025-09-30 03:17:27', '2025-09-30 04:45:57');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint UNSIGNED NOT NULL,
  `version` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `class` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `group` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `namespace` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `time` int NOT NULL,
  `batch` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(10, '2025-09-28-053209', 'App\\Database\\Migrations\\CreateUsersTable', 'default', 'App', 1759041792, 1),
(11, '2025-09-28-053215', 'App\\Database\\Migrations\\CreateDoctorsTable', 'default', 'App', 1759041792, 1),
(12, '2025-09-28-053220', 'App\\Database\\Migrations\\CreatePatientsTable', 'default', 'App', 1759041792, 1),
(13, '2025-09-28-053224', 'App\\Database\\Migrations\\CreateWorkingHoursTable', 'default', 'App', 1759041792, 1),
(14, '2025-09-28-053227', 'App\\Database\\Migrations\\CreateReservationsTable', 'default', 'App', 1759041792, 1),
(15, '2025-09-28-053233', 'App\\Database\\Migrations\\CreateQueuesTable', 'default', 'App', 1759041792, 1),
(16, '2025-09-30-030032', 'App\\Database\\Migrations\\CreateDrugsTable', 'default', 'App', 1759202153, 2),
(17, '2025-09-30-033341', 'App\\Database\\Migrations\\CreatePrescriptionsTables', 'default', 'App', 1759203317, 3);

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `address` text COLLATE utf8mb4_general_ci,
  `birth_date` date DEFAULT NULL,
  `gender` enum('male','female') COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`id`, `name`, `phone`, `address`, `birth_date`, `gender`, `created_at`, `updated_at`) VALUES
(51, 'Lamaran Pramuniaga – Salis Nizar Qomaruzaman', '081227209872', 'KRAKAL ALIAN KEBUMEN\nPERUMAHAN PENDOWOHARJO INDAH, SEWON, BANTUL', '2025-09-02', 'female', '2025-09-29 13:47:54', '2025-09-29 13:47:54'),
(52, 'Salis Nizar', '081227209872', 'PERUMAHAN PENDOWOHARJO INDAH, SEWON, BANTUL', '2025-09-02', 'male', '2025-09-29 15:01:50', '2025-09-29 15:01:50'),
(53, 'Sugiono', '3133433414141341', 'BANTUL YOGYAKARTA\nPERUMAHAN PENDOWOHARJO INDAH, SEWON, BANTUL', '2025-09-05', 'female', '2025-09-29 23:17:24', '2025-09-29 23:17:24'),
(54, 'salis1', '12321312321312', 'jalndkdh', '2025-09-11', 'female', '2025-09-29 23:24:22', '2025-09-29 23:24:22'),
(55, 'Sumanto', '111111111111', 'jalna maanag', '2025-09-30', 'female', '2025-09-29 23:57:47', '2025-09-30 02:53:40'),
(56, 'Slamet riyadi', '00000000000000', 'KRAKAL ALIAN KEBUMEN\r\nPERUMAHAN PENDOWOHARJO INDAH, SEWON, BANTUL', '2025-09-02', 'male', '2025-09-30 02:54:09', '2025-09-30 02:54:09');

-- --------------------------------------------------------

--
-- Table structure for table `prescriptions`
--

CREATE TABLE `prescriptions` (
  `id` int UNSIGNED NOT NULL,
  `patient_id` int UNSIGNED NOT NULL,
  `doctor_id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL COMMENT 'Admin/User yang mencatat resep',
  `prescription_date` datetime NOT NULL,
  `notes` text COLLATE utf8mb4_general_ci,
  `total_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `status` enum('DRAFT','COMPLETED','CANCELLED') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'DRAFT',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prescriptions`
--

INSERT INTO `prescriptions` (`id`, `patient_id`, `doctor_id`, `user_id`, `prescription_date`, `notes`, `total_amount`, `status`, `created_at`, `updated_at`) VALUES
(7, 53, 6, 5, '2025-09-30 04:45:57', 'dsdsfsff', '9100000.00', 'COMPLETED', '2025-09-30 04:45:57', '2025-09-30 04:45:57');

-- --------------------------------------------------------

--
-- Table structure for table `prescription_items`
--

CREATE TABLE `prescription_items` (
  `id` int UNSIGNED NOT NULL,
  `prescription_id` int UNSIGNED NOT NULL,
  `drug_id` int UNSIGNED NOT NULL,
  `quantity` int NOT NULL,
  `dosage_instruction` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `price_per_unit` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prescription_items`
--

INSERT INTO `prescription_items` (`id`, `prescription_id`, `drug_id`, `quantity`, `dosage_instruction`, `price_per_unit`, `subtotal`) VALUES
(5, 7, 2, 90, 'makan sepuasanya', '100000.00', '9000000.00'),
(6, 7, 2, 1, 'dddd', '100000.00', '100000.00');

-- --------------------------------------------------------

--
-- Table structure for table `queues`
--

CREATE TABLE `queues` (
  `id` int UNSIGNED NOT NULL,
  `patient_id` int UNSIGNED NOT NULL,
  `queue_number` int NOT NULL,
  `queue_date` date NOT NULL,
  `status` enum('waiting','serving','completed','cancelled') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'waiting',
  `served_at` datetime DEFAULT NULL,
  `completed_at` datetime DEFAULT NULL,
  `notes` text COLLATE utf8mb4_general_ci,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` int UNSIGNED NOT NULL,
  `patient_id` int UNSIGNED NOT NULL,
  `doctor_id` int UNSIGNED NOT NULL,
  `working_hour_id` int UNSIGNED NOT NULL,
  `reservation_date` date NOT NULL,
  `reservation_time` time NOT NULL,
  `status` enum('pending','approved','rejected','completed','cancelled') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'pending',
  `notes` text COLLATE utf8mb4_general_ci,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `patient_id`, `doctor_id`, `working_hour_id`, `reservation_date`, `reservation_time`, `status`, `notes`, `created_at`, `updated_at`) VALUES
(1, 51, 4, 2, '2025-09-29', '08:36:00', 'pending', 'sdasada', '2025-09-29 13:47:54', '2025-09-29 13:47:54'),
(2, 51, 4, 2, '2025-09-29', '11:36:00', 'pending', 'dasdas', '2025-09-29 13:50:38', '2025-09-29 13:50:38'),
(3, 51, 2, 16, '2025-10-03', '09:54:00', 'cancelled', 'ffsfsf', '2025-09-29 14:51:36', '2025-09-29 23:15:34'),
(4, 51, 3, 29, '2025-10-08', '15:33:00', 'rejected', 'ffaff', '2025-09-29 14:52:13', '2025-09-29 23:15:10'),
(5, 52, 2, 16, '2025-10-03', '08:38:00', 'approved', 'ffaf', '2025-09-29 15:01:50', '2025-09-29 23:15:25'),
(6, 53, 2, 64, '2025-10-18', '09:08:00', 'pending', 'dsdda', '2025-09-29 23:17:24', '2025-09-29 23:17:24'),
(7, 55, 6, 85, '2025-09-29', '11:30:00', 'pending', 'dadasda', '2025-09-29 23:57:47', '2025-09-29 23:57:47');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int UNSIGNED NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `full_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `role` enum('admin') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'admin',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `full_name`, `role`, `created_at`, `updated_at`) VALUES
(4, 'admin', '$2y$10$Y.6W7QkGkqgAuDpFUu6luudliiufxOlTjQbNPU4u9BP7lWbvA4qnm', 'admin', 'admin', '2025-09-30 04:35:46', '2025-09-30 04:35:46'),
(5, 'Salis', '$2y$10$REGhQyNWzqs0agKmc1fOWeqMR.ng6GsbxQtut.piIMcr8NRz5WLRi', 'Salis Nizar', 'admin', '2025-09-30 04:36:53', '2025-09-30 04:36:53');

-- --------------------------------------------------------

--
-- Table structure for table `working_hours`
--

CREATE TABLE `working_hours` (
  `id` int UNSIGNED NOT NULL,
  `doctor_id` int UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `duration_per_patient` int NOT NULL DEFAULT '60',
  `max_patients` int NOT NULL DEFAULT '10',
  `is_available_for_reservation` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `working_hours`
--

INSERT INTO `working_hours` (`id`, `doctor_id`, `date`, `start_time`, `end_time`, `duration_per_patient`, `max_patients`, `is_available_for_reservation`, `created_at`, `updated_at`) VALUES
(1, 2, '2025-09-29', '14:00:00', '18:00:00', 34, 8, 0, '2025-09-28 06:43:48', '2025-09-28 06:43:48'),
(2, 4, '2025-09-29', '08:00:00', '12:00:00', 36, 14, 1, '2025-09-28 06:43:48', '2025-09-28 06:43:48'),
(3, 5, '2025-09-29', '08:00:00', '11:00:00', 32, 14, 1, '2025-09-28 06:43:48', '2025-09-28 06:43:48'),
(5, 2, '2025-09-30', '08:00:00', '11:00:00', 34, 11, 0, '2025-09-28 06:43:48', '2025-09-28 06:43:48'),
(7, 4, '2025-09-30', '14:00:00', '18:00:00', 55, 14, 0, '2025-09-28 06:43:48', '2025-09-28 06:43:48'),
(9, 2, '2025-10-01', '13:00:00', '17:00:00', 39, 15, 0, '2025-09-28 06:43:48', '2025-09-28 06:43:48'),
(10, 4, '2025-10-01', '08:00:00', '12:00:00', 54, 10, 1, '2025-09-28 06:43:48', '2025-09-28 06:43:48'),
(12, 2, '2025-10-02', '08:00:00', '12:00:00', 44, 13, 0, '2025-09-28 06:43:48', '2025-09-28 06:43:48'),
(13, 4, '2025-10-02', '14:00:00', '18:00:00', 42, 8, 1, '2025-09-28 06:43:48', '2025-09-28 06:43:48'),
(14, 5, '2025-10-02', '08:00:00', '12:00:00', 46, 12, 0, '2025-09-28 06:43:48', '2025-09-28 06:43:48'),
(16, 2, '2025-10-03', '08:00:00', '11:00:00', 38, 8, 1, '2025-09-28 06:43:48', '2025-09-28 06:43:48'),
(17, 3, '2025-10-03', '08:00:00', '12:00:00', 51, 11, 0, '2025-09-28 06:43:48', '2025-09-28 06:43:48'),
(18, 5, '2025-10-03', '08:00:00', '12:00:00', 36, 11, 0, '2025-09-28 06:43:48', '2025-09-28 06:43:48'),
(19, 2, '2025-10-04', '13:00:00', '17:00:00', 45, 9, 0, '2025-09-28 06:43:48', '2025-09-28 06:43:48'),
(20, 3, '2025-10-04', '08:00:00', '11:00:00', 46, 13, 0, '2025-09-28 06:43:48', '2025-09-28 06:43:48'),
(21, 5, '2025-10-04', '08:00:00', '11:00:00', 47, 9, 0, '2025-09-28 06:43:48', '2025-09-28 06:43:48'),
(23, 4, '2025-10-06', '08:00:00', '12:00:00', 58, 12, 1, '2025-09-28 06:43:48', '2025-09-28 06:43:48'),
(25, 4, '2025-10-07', '08:00:00', '12:00:00', 54, 8, 0, '2025-09-28 06:43:48', '2025-09-28 06:43:48'),
(26, 5, '2025-10-07', '08:00:00', '11:00:00', 30, 9, 0, '2025-09-28 06:43:48', '2025-09-28 06:43:48'),
(28, 2, '2025-10-08', '08:00:00', '11:00:00', 51, 13, 0, '2025-09-28 06:43:48', '2025-09-28 06:43:48'),
(29, 3, '2025-10-08', '13:00:00', '17:00:00', 51, 11, 1, '2025-09-28 06:43:48', '2025-09-28 06:43:48'),
(30, 4, '2025-10-08', '08:00:00', '11:00:00', 33, 8, 0, '2025-09-28 06:43:48', '2025-09-28 06:43:48'),
(31, 5, '2025-10-08', '14:00:00', '18:00:00', 42, 8, 0, '2025-09-28 06:43:48', '2025-09-28 06:43:48'),
(33, 2, '2025-10-09', '08:00:00', '11:00:00', 59, 10, 1, '2025-09-28 06:43:48', '2025-09-28 06:43:48'),
(34, 3, '2025-10-09', '13:00:00', '17:00:00', 31, 11, 1, '2025-09-28 06:43:48', '2025-09-28 06:43:48'),
(35, 4, '2025-10-09', '08:00:00', '11:00:00', 30, 8, 0, '2025-09-28 06:43:48', '2025-09-28 06:43:48'),
(36, 5, '2025-10-09', '08:00:00', '12:00:00', 45, 13, 0, '2025-09-28 06:43:48', '2025-09-28 06:43:48'),
(37, 2, '2025-10-10', '08:00:00', '12:00:00', 37, 10, 1, '2025-09-28 06:43:48', '2025-09-28 06:43:48'),
(38, 3, '2025-10-10', '08:00:00', '11:00:00', 33, 12, 1, '2025-09-28 06:43:48', '2025-09-28 06:43:48'),
(39, 4, '2025-10-10', '14:00:00', '18:00:00', 51, 14, 0, '2025-09-28 06:43:48', '2025-09-28 06:43:48'),
(40, 5, '2025-10-10', '08:00:00', '11:00:00', 33, 12, 1, '2025-09-28 06:43:48', '2025-09-28 06:43:48'),
(42, 2, '2025-10-11', '14:00:00', '18:00:00', 39, 12, 0, '2025-09-28 06:43:48', '2025-09-28 06:43:48'),
(43, 3, '2025-10-11', '14:00:00', '18:00:00', 38, 15, 1, '2025-09-28 06:43:48', '2025-09-28 06:43:48'),
(44, 4, '2025-10-11', '08:00:00', '11:00:00', 45, 10, 0, '2025-09-28 06:43:48', '2025-09-28 06:43:48'),
(45, 5, '2025-10-11', '08:00:00', '12:00:00', 33, 12, 0, '2025-09-28 06:43:48', '2025-09-28 06:43:48'),
(47, 2, '2025-10-13', '08:00:00', '12:00:00', 56, 14, 1, '2025-09-28 06:43:48', '2025-09-28 06:43:48'),
(48, 3, '2025-10-13', '08:00:00', '12:00:00', 38, 9, 0, '2025-09-28 06:43:48', '2025-09-28 06:43:48'),
(49, 4, '2025-10-13', '13:00:00', '17:00:00', 47, 8, 0, '2025-09-28 06:43:48', '2025-09-28 06:43:48'),
(50, 5, '2025-10-13', '08:00:00', '11:00:00', 34, 10, 1, '2025-09-28 06:43:48', '2025-09-28 06:43:48'),
(51, 2, '2025-10-14', '08:00:00', '11:00:00', 37, 12, 0, '2025-09-28 06:43:48', '2025-09-28 06:43:48'),
(52, 3, '2025-10-14', '14:00:00', '18:00:00', 47, 10, 0, '2025-09-28 06:43:48', '2025-09-28 06:43:48'),
(53, 5, '2025-10-14', '08:00:00', '11:00:00', 51, 14, 1, '2025-09-28 06:43:48', '2025-09-28 06:43:48'),
(54, 4, '2025-10-15', '08:00:00', '11:00:00', 35, 12, 0, '2025-09-28 06:43:48', '2025-09-28 06:43:48'),
(57, 3, '2025-10-16', '08:00:00', '11:00:00', 60, 12, 0, '2025-09-28 06:43:48', '2025-09-28 06:43:48'),
(58, 5, '2025-10-16', '08:00:00', '12:00:00', 46, 11, 0, '2025-09-28 06:43:48', '2025-09-28 06:43:48'),
(60, 3, '2025-10-17', '13:00:00', '17:00:00', 34, 14, 1, '2025-09-28 06:43:48', '2025-09-28 06:43:48'),
(61, 4, '2025-10-17', '08:00:00', '11:00:00', 30, 14, 0, '2025-09-28 06:43:48', '2025-09-28 06:43:48'),
(62, 5, '2025-10-17', '13:00:00', '17:00:00', 44, 15, 1, '2025-09-28 06:43:48', '2025-09-28 06:43:48'),
(64, 2, '2025-10-18', '08:00:00', '11:00:00', 34, 13, 1, '2025-09-28 06:43:48', '2025-09-28 06:43:48'),
(65, 3, '2025-10-18', '08:00:00', '12:00:00', 58, 9, 1, '2025-09-28 06:43:48', '2025-09-28 06:43:48'),
(66, 4, '2025-10-18', '13:00:00', '17:00:00', 35, 15, 1, '2025-09-28 06:43:48', '2025-09-28 06:43:48'),
(67, 5, '2025-10-18', '08:00:00', '12:00:00', 40, 12, 1, '2025-09-28 06:43:48', '2025-09-28 06:43:48'),
(69, 2, '2025-10-20', '08:00:00', '12:00:00', 36, 15, 0, '2025-09-28 06:43:48', '2025-09-28 06:43:48'),
(70, 3, '2025-10-20', '13:00:00', '17:00:00', 48, 15, 1, '2025-09-28 06:43:48', '2025-09-28 06:43:48'),
(71, 4, '2025-10-20', '08:00:00', '11:00:00', 55, 15, 0, '2025-09-28 06:43:48', '2025-09-28 06:43:48'),
(72, 3, '2025-10-21', '13:00:00', '17:00:00', 35, 14, 0, '2025-09-28 06:43:48', '2025-09-28 06:43:48'),
(73, 4, '2025-10-22', '08:00:00', '12:00:00', 58, 13, 1, '2025-09-28 06:43:48', '2025-09-28 06:43:48'),
(74, 5, '2025-10-22', '14:00:00', '18:00:00', 43, 14, 0, '2025-09-28 06:43:48', '2025-09-28 06:43:48'),
(76, 3, '2025-10-23', '08:00:00', '11:00:00', 52, 11, 1, '2025-09-28 06:43:48', '2025-09-28 06:43:48'),
(78, 3, '2025-10-24', '13:00:00', '17:00:00', 57, 11, 1, '2025-09-28 06:43:48', '2025-09-28 06:43:48'),
(79, 5, '2025-10-24', '08:00:00', '12:00:00', 37, 14, 0, '2025-09-28 06:43:48', '2025-09-28 06:43:48'),
(80, 2, '2025-10-25', '14:00:00', '18:00:00', 39, 14, 1, '2025-09-28 06:43:48', '2025-09-28 06:43:48'),
(81, 3, '2025-10-25', '14:00:00', '18:00:00', 36, 9, 0, '2025-09-28 06:43:48', '2025-09-28 06:43:48'),
(82, 4, '2025-10-25', '08:00:00', '11:00:00', 43, 11, 0, '2025-09-28 06:43:48', '2025-09-28 06:43:48'),
(83, 2, '2025-10-27', '08:00:00', '12:00:00', 59, 13, 0, '2025-09-28 06:43:48', '2025-09-28 06:43:48'),
(84, 5, '2025-10-27', '14:00:00', '18:00:00', 30, 15, 0, '2025-09-28 06:43:48', '2025-09-28 06:43:48'),
(85, 6, '2025-09-29', '08:00:00', '12:00:00', 30, 10, 1, '2025-09-29 23:57:19', '2025-09-29 23:57:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `drugs`
--
ALTER TABLE `drugs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prescriptions_patient_id_foreign` (`patient_id`),
  ADD KEY `prescriptions_doctor_id_foreign` (`doctor_id`),
  ADD KEY `prescriptions_user_id_foreign` (`user_id`);

--
-- Indexes for table `prescription_items`
--
ALTER TABLE `prescription_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prescription_items_prescription_id_foreign` (`prescription_id`),
  ADD KEY `prescription_items_drug_id_foreign` (`drug_id`);

--
-- Indexes for table `queues`
--
ALTER TABLE `queues`
  ADD PRIMARY KEY (`id`),
  ADD KEY `queues_patient_id_foreign` (`patient_id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reservations_patient_id_foreign` (`patient_id`),
  ADD KEY `reservations_doctor_id_foreign` (`doctor_id`),
  ADD KEY `reservations_working_hour_id_foreign` (`working_hour_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `working_hours`
--
ALTER TABLE `working_hours`
  ADD PRIMARY KEY (`id`),
  ADD KEY `working_hours_doctor_id_foreign` (`doctor_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `drugs`
--
ALTER TABLE `drugs`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `prescriptions`
--
ALTER TABLE `prescriptions`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `prescription_items`
--
ALTER TABLE `prescription_items`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `queues`
--
ALTER TABLE `queues`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `working_hours`
--
ALTER TABLE `working_hours`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD CONSTRAINT `prescriptions_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `prescriptions_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `prescriptions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `prescription_items`
--
ALTER TABLE `prescription_items`
  ADD CONSTRAINT `prescription_items_drug_id_foreign` FOREIGN KEY (`drug_id`) REFERENCES `drugs` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `prescription_items_prescription_id_foreign` FOREIGN KEY (`prescription_id`) REFERENCES `prescriptions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `queues`
--
ALTER TABLE `queues`
  ADD CONSTRAINT `queues_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservations_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservations_working_hour_id_foreign` FOREIGN KEY (`working_hour_id`) REFERENCES `working_hours` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `working_hours`
--
ALTER TABLE `working_hours`
  ADD CONSTRAINT `working_hours_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
