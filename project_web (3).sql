-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 15, 2026 at 08:04 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_web`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `guide_id` bigint UNSIGNED DEFAULT NULL,
  `equipment_id` bigint UNSIGNED DEFAULT NULL,
  `destination_id` bigint UNSIGNED DEFAULT NULL,
  `booking_date` date NOT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `duration_hours` int DEFAULT NULL,
  `equipment_quantity` int NOT NULL DEFAULT '1',
  `guide_cost` decimal(10,2) NOT NULL DEFAULT '0.00',
  `equipment_cost` decimal(10,2) NOT NULL DEFAULT '0.00',
  `total_cost` decimal(10,2) NOT NULL,
  `notes` text,
  `status` enum('pending','approved','rejected','completed','cancelled') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `guide_id`, `equipment_id`, `destination_id`, `booking_date`, `start_time`, `end_time`, `duration_hours`, `equipment_quantity`, `guide_cost`, `equipment_cost`, `total_cost`, `notes`, `status`, `created_at`, `updated_at`) VALUES
(3, 1, NULL, NULL, NULL, '2026-04-29', NULL, NULL, 4, 1, 300000.00, 0.00, 300000.00, NULL, 'approved', '2026-04-26 08:17:34', '2026-04-26 08:50:35'),
(4, 1, NULL, NULL, NULL, '2026-04-27', NULL, NULL, 6, 1, 450000.00, 0.00, 450000.00, NULL, 'pending', '2026-04-27 05:35:01', '2026-04-27 05:35:01'),
(5, 1, NULL, NULL, NULL, '2026-04-27', NULL, NULL, 6, 1, 450000.00, 0.00, 450000.00, NULL, 'pending', '2026-04-27 05:35:15', '2026-04-27 05:35:15'),
(7, 16, NULL, NULL, NULL, '2026-05-06', NULL, NULL, 8, 1, 400000.00, 0.00, 400000.00, NULL, 'approved', '2026-05-04 07:22:30', '2026-05-04 07:23:26'),
(8, 16, NULL, NULL, NULL, '2026-05-21', NULL, NULL, 10, 1, 500000.00, 0.00, 500000.00, NULL, 'approved', '2026-05-04 09:52:26', '2026-05-04 09:52:56'),
(9, 16, NULL, NULL, NULL, '2026-05-21', NULL, NULL, 10, 1, 500000.00, 0.00, 500000.00, NULL, 'approved', '2026-05-04 09:52:28', '2026-05-04 09:53:32'),
(10, 16, NULL, NULL, NULL, '2026-05-07', NULL, NULL, 4, 1, 200000.00, 0.00, 200000.00, NULL, 'approved', '2026-05-04 19:06:13', '2026-05-04 19:06:57'),
(11, 16, NULL, NULL, NULL, '2026-05-13', NULL, NULL, 5, 1, 250000.00, 0.00, 250000.00, NULL, 'approved', '2026-05-04 19:30:41', '2026-05-04 19:31:05'),
(12, 16, 10, NULL, NULL, '2026-05-21', NULL, NULL, 4, 1, 348000.00, 0.00, 348000.00, NULL, 'approved', '2026-05-13 21:15:05', '2026-05-13 21:19:53'),
(13, 16, 10, NULL, NULL, '2026-05-22', NULL, NULL, 4, 1, 0.00, 0.00, 348000.00, NULL, 'approved', '2026-05-14 09:12:08', '2026-05-14 09:12:50'),
(14, 16, 10, NULL, NULL, '2026-05-29', NULL, NULL, 4, 1, 348000.00, 0.00, 348000.00, NULL, 'approved', '2026-05-14 09:53:55', '2026-05-14 09:54:42'),
(15, 16, 10, NULL, NULL, '2026-05-29', NULL, NULL, 4, 1, 348000.00, 0.00, 348000.00, NULL, 'approved', '2026-05-14 09:58:15', '2026-05-14 09:58:53'),
(16, 16, 12, NULL, NULL, '2026-05-28', NULL, NULL, 7, 1, 595000.00, 0.00, 595000.00, NULL, 'approved', '2026-05-14 10:00:41', '2026-05-15 08:12:24'),
(17, 16, 10, NULL, NULL, '2026-05-23', NULL, NULL, 3, 1, 261000.00, 0.00, 261000.00, NULL, 'approved', '2026-05-14 10:21:44', '2026-05-14 10:22:37'),
(19, 16, 10, NULL, NULL, '2026-05-28', NULL, NULL, 5, 1, 435000.00, 0.00, 435000.00, NULL, 'approved', '2026-05-14 10:33:45', '2026-05-14 10:34:32'),
(20, 16, 12, NULL, NULL, '2026-05-22', NULL, NULL, 4, 1, 340000.00, 0.00, 340000.00, NULL, 'approved', '2026-05-15 00:23:39', '2026-05-15 00:25:32'),
(21, 16, 10, NULL, NULL, '2026-05-20', NULL, NULL, 5, 1, 585000.00, 0.00, 585000.00, NULL, 'approved', '2026-05-18 04:12:40', '2026-05-18 04:13:17'),
(22, 27, 11, NULL, NULL, '2026-05-20', NULL, NULL, 6, 1, 570000.00, 0.00, 570000.00, NULL, 'approved', '2026-05-18 05:58:33', '2026-05-18 05:59:56'),
(23, 16, 10, NULL, NULL, '2026-06-09', NULL, NULL, 4, 1, 423000.00, 0.00, 423000.00, NULL, 'approved', '2026-06-14 00:26:23', '2026-06-14 00:27:13');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `destinations`
--

CREATE TABLE `destinations` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `photo` varchar(255) NOT NULL,
  `distance_from_purwokerto` decimal(8,2) DEFAULT NULL,
  `difficulty_level` decimal(3,1) NOT NULL DEFAULT '3.0',
  `category` enum('gunung','air terjun','danau','pantai','hutan') NOT NULL,
  `guide_recommended` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `destinations`
--

INSERT INTO `destinations` (`id`, `name`, `slug`, `description`, `photo`, `distance_from_purwokerto`, `difficulty_level`, `category`, `guide_recommended`, `created_at`, `updated_at`) VALUES
(12, 'Curug Cipendok', 'curug-cipendok', 'Curug Cipendok adalah air terjun dengan ketinggian 92 meter yang terletak di lereng Gunung Slamet. Curug Cipendok mempunyai daya tarik tersendiri, karena lingkungan masih betul-betul alami. Kesunyian juga masih sangat terasa, sebab belum banyak pelancong yang datang menikmati keindahan alamnya. Hawa di sekitarnya sejuk dan sepanjang jalan menuju ke sana terdapat area perkebunan. Di sekitar wilayahnya terdapat bumi perkemahan, Rearing Unit Manggala BBPTU Sapi Perah Baturraden dan sebuah telaga yang bernama Telaga Pucung.', 'destinations/shPNvHtiXpOYgjne6QCXGtWmXoqGvBTiXDw1xAII.jpg', 21.50, 4.0, 'air terjun', 1, '2026-05-12 07:51:00', '2026-05-12 07:51:00'),
(13, 'Curug pengantin', 'curug-pengantin', 'curug pengantin', 'destinations/gaD9aEd5mQQYQ6hxiVjrGaZ2gvzx8gzpzgheMwfz.jpg', 13.20, 4.0, 'air terjun', 1, '2026-05-15 07:22:57', '2026-05-15 07:22:57'),
(14, 'Telaga Sunyi', 'telaga-sunyi', 'Sebuah wisata di Baturraden Banyumas', 'destinations/hfLYChoYwioBBevlq0YqD7FlfUBZpZZSPiC6u2jz.jpg', 13.70, 4.0, 'air terjun', 1, '2026-05-18 04:05:56', '2026-05-18 04:05:56');

-- --------------------------------------------------------

--
-- Table structure for table `equipments`
--

CREATE TABLE `equipments` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `daily_rate` decimal(10,2) NOT NULL,
  `stock` int NOT NULL,
  `available_stock` int NOT NULL,
  `category` enum('sepeda','camping','trekking','lainnya') NOT NULL,
  `status` enum('available','maintenance') NOT NULL DEFAULT 'available',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `equipments`
--

INSERT INTO `equipments` (`id`, `user_id`, `name`, `description`, `photo`, `daily_rate`, `stock`, `available_stock`, `category`, `status`, `created_at`, `updated_at`) VALUES
(2, 4, 'Tenda Camping 4 Orang', 'Tenda waterproof berkualitas tinggi kapasitas 4 orang', 'tenda.jpg', 75000.00, 15, 12, 'camping', 'available', '2026-04-26 02:43:51', '2026-04-29 10:10:34'),
(3, 1, 'Carrier 60  Liter', 'ga', 'equipments/fYRyUAOl6ZCcAPwsgPGWADtepxSRg7CBrHl8K6eS.jpg', 30000.00, 10, 10, 'camping', 'available', '2026-05-13 12:47:38', '2026-05-13 12:47:38');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `guides`
--

CREATE TABLE `guides` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `bio` text NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `hourly_rate` decimal(10,2) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `is_certified` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `guides`
--

INSERT INTO `guides` (`id`, `user_id`, `name`, `phone`, `bio`, `photo`, `hourly_rate`, `status`, `is_certified`, `created_at`, `updated_at`) VALUES
(10, 18, 'Bayu Caesario Nor Saputra', '0895384354863', 'ahli di bidang curug', 'guides/l9298ci55wottwcAtZZYG5O6aY4nkDedoMlPpZbm.jpg', 87000.00, 'active', 0, '2026-05-12 06:36:23', '2026-05-19 07:46:49'),
(11, 19, 'Erlan Anggi Setiawan', '081567456467', 'Pemandu wisata lokal Banyumas yang berpengalaman menjelajahi curug, jalur tracking, dan wisata alam Baturraden. Ramah, komunikatif, dan siap membantu perjalanan wisata menjadi lebih aman dan menyenangkan.', 'guides/xA6IPSzRDU2Wzkdz0JDEIV7BvmgBW7sPJuwk4L3W.jpg', 90000.00, 'active', 0, '2026-05-12 08:02:56', '2026-05-19 07:45:08'),
(12, 20, 'Raditya Ramadani', '08765723446', 'Guide outdoor muda dengan semangat petualangan tinggi dan pengetahuan destinasi lokal yang luas. Cocok untuk wisata keluarga maupun rombongan.', 'guides/J1NRAtkVdp3GK3uzVPCtvM0T3DhgYTXIuwCYSXu5.jpg', 85000.00, 'active', 0, '2026-05-12 08:08:12', '2026-05-19 07:44:37'),
(13, 21, 'Elsy Maya Rose tanti', '987786567484', 'Pemandu wisata profesional yang fokus pada kenyamanan dan keamanan wisatawan selama perjalanan. Siap memberikan rekomendasi spot terbaik di Banyumas.', 'guides/MvFFkyvAT2JE0TCMerU6ycVTroVlHsAkqZjmSs5M.jpg', 85000.00, 'active', 0, '2026-05-12 08:09:25', '2026-05-19 07:44:14');

-- --------------------------------------------------------

--
-- Table structure for table `guide_reviews`
--

CREATE TABLE `guide_reviews` (
  `id` bigint UNSIGNED NOT NULL,
  `booking_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `guide_id` bigint UNSIGNED NOT NULL,
  `rating` int NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `incomes`
--

CREATE TABLE `incomes` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `nama_pelanggan` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `durasi` int NOT NULL,
  `biaya` decimal(15,2) NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'disetujui',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `incomes`
--

INSERT INTO `incomes` (`id`, `user_id`, `nama_pelanggan`, `tanggal`, `durasi`, `biaya`, `status`, `created_at`, `updated_at`) VALUES
(8, 16, 'Yuniatul Inayah', '2026-05-22', 6, 522000.00, 'disetujui', '2026-05-13 22:04:44', '2026-05-13 22:04:44'),
(9, 16, 'Yuniatul Inayah', '2026-05-22', 6, 522000.00, 'disetujui', '2026-05-13 22:06:03', '2026-05-13 22:06:03'),
(10, 16, 'Yuniatul Inayah', '2026-05-22', 6, 522000.00, 'disetujui', '2026-05-13 22:06:05', '2026-05-13 22:06:05'),
(11, 16, 'Yuniatul Inayah', '2026-05-22', 6, 522000.00, 'disetujui', '2026-05-13 22:06:13', '2026-05-13 22:06:13'),
(12, 16, 'Yuniatul Inayah', '2026-05-22', 6, 522000.00, 'disetujui', '2026-05-13 22:09:02', '2026-05-13 22:09:02'),
(13, 16, 'Yuniatul Inayah', '2026-05-22', 6, 597000.00, 'disetujui', '2026-05-13 22:20:58', '2026-05-13 22:20:58'),
(15, 16, 'Yuniatul Inayah', '2026-05-23', 4, 348000.00, 'pending', '2026-05-14 09:22:55', '2026-05-14 09:22:55'),
(17, 18, 'Yuniatul Inayah', '2026-05-28', 5, 435000.00, 'pending', '2026-05-14 10:33:45', '2026-05-14 10:33:45'),
(18, 20, 'Yuniatul Inayah', '2026-05-22', 4, 340000.00, 'pending', '2026-05-15 00:23:39', '2026-05-15 00:23:39'),
(19, 18, 'Yuniatul Inayah', '2026-05-20', 5, 585000.00, 'pending', '2026-05-18 04:12:40', '2026-05-18 04:12:40'),
(20, 19, 'Fandi Irawann', '2026-05-20', 6, 570000.00, 'pending', '2026-05-18 05:58:33', '2026-05-18 05:58:33'),
(21, 18, 'Yuniatul Inayah, A.md., S.Pd.', '2026-06-09', 4, 423000.00, 'pending', '2026-06-14 00:26:23', '2026-06-14 00:26:23');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint UNSIGNED NOT NULL,
  `booking_id` bigint UNSIGNED NOT NULL,
  `sender_id` bigint UNSIGNED NOT NULL,
  `receiver_id` bigint UNSIGNED NOT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `booking_id`, `sender_id`, `receiver_id`, `message`, `is_read`, `created_at`, `updated_at`) VALUES
(2, 21, 16, 18, 'haiii', 1, '2026-06-13 23:24:44', '2026-06-14 08:21:37'),
(3, 23, 18, 16, 'haiii yuniatul, mau cod dimana', 1, '2026-06-14 08:00:16', '2026-06-14 09:32:58'),
(4, 23, 16, 18, 'cod dihatimu saja hahaha', 1, '2026-06-14 08:10:42', '2026-06-14 08:11:09');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_04_26_082123_create_guides_table', 1),
(5, '2026_04_26_082124_create_equipments_table', 1),
(6, '2026_04_26_082125_create_bookings_table', 1),
(7, '2026_04_26_082126_create_user_profiles_table', 1),
(8, '2026_04_26_082127_create_packages_table', 1),
(9, '2026_04_26_083242_create_personal_access_tokens_table', 1),
(10, '2026_04_26_083544_add_phone_to_users_table', 1),
(11, '2026_04_26_090344_add_phone_to_users_table', 1),
(12, '2026_04_26_092146_create_destinations_table', 1),
(13, '2026_04_26_092521_add_destination_to_bookings_table', 1),
(14, '2026_04_28_155037_add_role_to_users_table', 2),
(15, '2026_04_29_155110_create_incomes_table', 3),
(16, '2026_04_29_162027_add_status_to_incomes_table', 4),
(17, '2026_06_14_060534_create_messages_table', 5),
(18, '2026_06_14_065003_add_avatar_to_users_table', 6),
(19, '2026_06_14_160637_create_reviews_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint UNSIGNED NOT NULL,
  `booking_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `guide_id` bigint UNSIGNED NOT NULL,
  `rating` int NOT NULL,
  `comment` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `booking_id`, `user_id`, `guide_id`, `rating`, `comment`, `created_at`, `updated_at`) VALUES
(1, 21, 16, 10, 4, 'mantappp lumayan si ya', '2026-06-15 00:12:37', '2026-06-15 00:12:37');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text,
  `payload` longtext NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('mzVlkoDdLyxfPKNtYHpTIMQkoGoCRIOoKEuPR8aF', 16, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiWDhEbXh2a2JNbVhpaDEwYktydHgzTktqd2twZnEzaU5XaFBBN2RHWCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQvcmV2aWV3cz9ib29raW5nX2lkPTIzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTY7fQ==', 1781508748),
('NWaOhoV75iciJfQBy1Yfhq9Bs0EjaAzHy5nV6hUD', 16, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiNGxGMkhnRDJ5MHgzckptU1J0a1NOelRkTUtJTVdUQkltVVlyTmJhSiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9pbmNvbWVzL3ByaW50LzIzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTY7fQ==', 1781510350);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `avatar`, `phone`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(1, 'Admin PurwoGuide', 'admin@purwoguide.com', NULL, '085712345678', NULL, '$2y$12$R6.BFA45yLRR.SpxyfLSROEGNlsxD0HmmKcQ7X0NR7iAte/yQXXui', NULL, '2026-04-26 02:43:50', '2026-06-13 22:48:54', 'user'),
(4, 'Rental Alat Purwokerto', 'rental@purwoguide.com', NULL, '085712345681', NULL, '$2y$12$AYhaiJ0FNzjQMooTgU3SAuBC2htemAjN2RneUOROKRSZ4pyo.dzsG', NULL, '2026-04-26 02:43:51', '2026-04-29 10:10:34', 'user'),
(5, 'Raditya Ramadhani', 'raditya@guide.com', NULL, '085712345680', NULL, '$2y$12$duIPHLEXTU8D17I02mU.deloRme1vK5dkFPvwHyGnoT9TYuffhnWS', NULL, '2026-04-28 04:30:02', '2026-04-28 04:30:02', 'user'),
(7, 'BAYU CAESARIO NOR SAPUTRA', 'bayucns@guide.com', NULL, '0895384354863', NULL, '$2y$12$Y5XDa1F51PEqy6FSPkWNFux/E0OV.DZgigRkSY3mdfr6WYzI2r1bW', NULL, '2026-04-28 09:40:22', '2026-04-28 09:40:22', 'user'),
(13, 'Slamet Riyadi', 'Sllamet@guide.com', NULL, '087257326736', NULL, '$2y$12$KGp6oMCow1RFnqVvmi90a.X8JONP9tnFfsb4cIX5td9YHSrWHjQUC', NULL, '2026-05-01 06:14:48', '2026-05-01 06:14:48', 'user'),
(14, 'prabowo', 'prabowo@gmail.com', NULL, '85442249', NULL, '$2y$12$tBiAHe9T0CKTqY7rInAMfetsCrgFq1OxdE0Xo68RDXDKzA80LQ4Nu', NULL, '2026-05-04 06:34:59', '2026-05-04 06:34:59', 'user'),
(16, 'Yuniatul Inayah, A.md., S.Pd.', 'bundaiin@gmail.com', 'avatars/BTQTn97ZvMovT4raBW8BiBkFJ5G1OO2cxCIrsXHi.jpg', '85442249', NULL, '$2y$12$gC1/G4Gz7PW9uQ4Nk8lcRed999TzKy7xpGz9zgQ8r2tGsA.xN9WBC', NULL, '2026-05-04 07:18:47', '2026-06-13 23:52:51', 'user'),
(17, 'Selamet Riyadi', 'selametriyadi@gmail.com', NULL, '0817653453453', NULL, '$2y$12$qQEPC2.z2CSmc/h8RnmLpOORP0KzbXSqdcMt8aFL9TDyhRL7mJV3u', NULL, '2026-05-11 06:07:02', '2026-05-11 06:07:02', 'user'),
(18, 'Bayu Caesario Nor Saputra', 'bayucaesarionorsaputra@gmail.com', 'avatars/GmUL9di4vKRklZpxF2IdqhpWtxJHVGWnBbjvW4K0.jpg', '0895384354863', NULL, '$2y$12$wufDG0Zbq/ilqKOAnRd9uumNAYfiKHFmloVUdVocnniIbCF6ICWSK', NULL, '2026-05-12 06:36:23', '2026-06-14 00:23:31', 'guide'),
(19, 'Erlan Anggi Setiawan', 'erlananggi@gmail.com', NULL, '081567456467', NULL, '$2y$12$IERMMRuIL8hUwflMNv9eBuHTdTFxDrm2VpecnQQhbnpcllgRHWrL2', NULL, '2026-05-12 08:02:56', '2026-05-12 08:02:56', 'guide'),
(20, 'Raditya Ramadani', 'radityaramadhani@gmail.com', NULL, '08765723446', NULL, '$2y$12$B1.UlqQRVn8iYZb97xJlSeLmJODjMkjeBdU2WIbyB2Jej07uLoNca', NULL, '2026-05-12 08:08:12', '2026-05-13 12:37:28', 'guide'),
(21, 'Elsy Maya Rose tanti', 'elsymaya@gmail.com', NULL, '987786567484', NULL, '$2y$12$SO5eehTeBVSENWLt3pG/ie7Tt21a0Tmw1Lu/5bLJ43Qnge/pIxcVe', NULL, '2026-05-12 08:09:25', '2026-05-12 08:09:25', 'guide'),
(22, 'Bayu CNS', 'masbayucns@gmail.com', NULL, '0895384354863', NULL, '$2y$12$OP1IGnL9FjeSFxNWEJy8IeQze3SdedTe1Og5vx6W3kNT6Wi/P.zVu', NULL, '2026-05-18 04:21:45', '2026-05-18 04:21:45', 'user'),
(23, 'Fatahul Qorib', 'fatahulqorib@gmail.com', NULL, '895384354863', NULL, '$2y$12$jjbbVCCRrsbRdVw4sCumNeK.eHvSXG.UJVrm1HFWTAhZMFi4HL0zy', NULL, '2026-05-18 05:07:26', '2026-05-18 05:07:26', 'user'),
(24, 'Radit Ganteng', 'radit65@gmail.com', NULL, '895384354863', NULL, '$2y$12$Ir1G3xOjzipQ8.Akuk7G3uEkq7jRpkPj/hQNanED7tjiXOGNOj/Oi', NULL, '2026-05-18 05:14:00', '2026-05-18 05:14:00', 'user'),
(25, 'Dede Ragil', 'dederagil@gmail.com', NULL, '895384354863', NULL, '$2y$12$1bQFe06PQpMvrrcUJRtz9uCgzo3YxVJOosI0RKYabtsM2QOPCRvVq', NULL, '2026-05-18 05:15:57', '2026-05-18 05:15:57', 'user'),
(26, 'Qurotul Aeni', 'qurotulaeni@gmail.com', NULL, '89667083413', NULL, '$2y$12$bju1.tPuxFctuYV9JIvx1uQpMx/1U/Cr4T8nKe6zaNb05Ofg7R.W6', NULL, '2026-05-18 05:18:59', '2026-05-18 05:18:59', 'user'),
(27, 'Fandi Irawann', 'fandiirawan31@gmail.com', NULL, '896754564562', NULL, '$2y$12$fAva8zEk5buUukoW2d1euuiILo2AiwVqSmDksful13qxntbSTMyJ.', NULL, '2026-05-18 05:57:44', '2026-05-18 05:57:44', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `user_profiles`
--

CREATE TABLE `user_profiles` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `location` varchar(255) NOT NULL,
  `role` enum('tourist','guide','renter','admin') NOT NULL DEFAULT 'tourist',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_profiles`
--

INSERT INTO `user_profiles` (`id`, `user_id`, `avatar`, `location`, `role`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'Purwokerto', 'admin', '2026-04-26 02:43:50', '2026-04-26 02:43:50'),
(3, 4, NULL, 'Purwokerto', 'renter', '2026-04-26 02:43:51', '2026-04-29 10:10:34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bookings_user_id_foreign` (`user_id`),
  ADD KEY `bookings_booking_date_status_index` (`booking_date`,`status`),
  ADD KEY `bookings_guide_id_index` (`guide_id`),
  ADD KEY `bookings_equipment_id_index` (`equipment_id`),
  ADD KEY `bookings_destination_id_index` (`destination_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `destinations`
--
ALTER TABLE `destinations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `destinations_slug_unique` (`slug`);

--
-- Indexes for table `equipments`
--
ALTER TABLE `equipments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `equipments_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `guides`
--
ALTER TABLE `guides`
  ADD PRIMARY KEY (`id`),
  ADD KEY `guides_user_id_foreign` (`user_id`);

--
-- Indexes for table `guide_reviews`
--
ALTER TABLE `guide_reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `incomes`
--
ALTER TABLE `incomes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `incomes_user_id_foreign` (`user_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_booking_id_foreign` (`booking_id`),
  ADD KEY `messages_sender_id_foreign` (`sender_id`),
  ADD KEY `messages_receiver_id_foreign` (`receiver_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_booking_id_foreign` (`booking_id`),
  ADD KEY `reviews_user_id_foreign` (`user_id`),
  ADD KEY `reviews_guide_id_foreign` (`guide_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_profiles`
--
ALTER TABLE `user_profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_profiles_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `destinations`
--
ALTER TABLE `destinations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `equipments`
--
ALTER TABLE `equipments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `guides`
--
ALTER TABLE `guides`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `guide_reviews`
--
ALTER TABLE `guide_reviews`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `incomes`
--
ALTER TABLE `incomes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `user_profiles`
--
ALTER TABLE `user_profiles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_destination_id_foreign` FOREIGN KEY (`destination_id`) REFERENCES `destinations` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `bookings_equipment_id_foreign` FOREIGN KEY (`equipment_id`) REFERENCES `equipments` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `bookings_guide_id_foreign` FOREIGN KEY (`guide_id`) REFERENCES `guides` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `bookings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `equipments`
--
ALTER TABLE `equipments`
  ADD CONSTRAINT `equipments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `guides`
--
ALTER TABLE `guides`
  ADD CONSTRAINT `guides_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `incomes`
--
ALTER TABLE `incomes`
  ADD CONSTRAINT `incomes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `messages_receiver_id_foreign` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `messages_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_guide_id_foreign` FOREIGN KEY (`guide_id`) REFERENCES `guides` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_profiles`
--
ALTER TABLE `user_profiles`
  ADD CONSTRAINT `user_profiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
