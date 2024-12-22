-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 29, 2024 lúc 08:50 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `smart_event`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`, `thumbnail`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Multimedia', 'zAPfwMurdVaaNp1QjRC8fXNnw6FrWDmfVhVFCzbR.png', NULL, '2024-12-26 17:27:05', '2024-12-26 17:27:05'),
(2, 'Logistic', 'KYS4h1GQU5Fp4kI3SJNgJOu44rIKEZ93ePbn132g.png', NULL, '2024-12-26 17:30:30', '2024-12-26 17:30:30'),
(3, 'Finance', 'REkZHuo52uhA2BW4zBzdpEA6qU9pkdhOGankXifh.png', NULL, '2024-12-28 18:57:48', '2024-12-28 18:57:48'),
(4, 'Music', 'Va2vv1ZvdRYkIbM0IqcS9QdKJSKUvrqh39KxXhSh.png', NULL, '2024-12-28 18:58:13', '2024-12-28 18:58:13'),
(5, 'Design', 'GipqPK9T7hyb6KPVYmIacnSQ4uidy8mcTc4B0Rrl.png', NULL, '2024-12-28 18:58:30', '2024-12-28 18:58:30'),
(6, 'Comunity', '2G4p8bIWYWN7Mnwq1mUdNsippMIR6gSlDLMXN5dt.png', NULL, '2024-12-28 18:58:50', '2024-12-28 18:58:50'),
(7, 'Entertainment', 'MoXwq6PAXpbMfczYI56xaYiUcsDi9oQ7vJ1iTpSo.png', NULL, '2024-12-28 18:59:34', '2024-12-28 18:59:34'),
(8, 'Academic', 'CO1ixI8eVqLqSLHSziGR7rWdXEvqJy0BFgdTfvZN.png', NULL, '2024-12-28 18:59:51', '2024-12-28 18:59:51');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `classes`
--

CREATE TABLE `classes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `class_name` varchar(255) NOT NULL,
  `faculty_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `classes`
--

INSERT INTO `classes` (`id`, `class_name`, `faculty_id`, `created_at`, `updated_at`) VALUES
(1, '21ITT', 1, '2024-12-21 08:30:37', '2024-12-21 08:30:37'),
(2, '21SE1', 1, '2024-12-21 08:30:37', '2024-12-21 08:30:37'),
(3, '21SE2', 1, '2024-12-21 08:30:37', '2024-12-21 08:30:37'),
(4, '21SE3', 1, '2024-12-21 08:30:37', '2024-12-21 08:30:37'),
(5, '21DA1', 1, '2024-12-21 08:30:37', '2024-12-21 08:30:37'),
(6, '21DA2', 1, '2024-12-21 08:30:37', '2024-12-21 08:30:37'),
(7, '21DA3', 1, '2024-12-21 08:30:37', '2024-12-21 08:30:37'),
(8, '21ET1', 2, '2024-12-21 08:30:37', '2024-12-21 08:30:37'),
(9, '21ET2', 2, '2024-12-21 08:30:37', '2024-12-21 08:30:37'),
(10, '21ET3', 2, '2024-12-21 08:30:37', '2024-12-21 08:30:37'),
(11, '21EL1', 2, '2024-12-21 08:30:37', '2024-12-21 08:30:37'),
(12, '21EL2', 2, '2024-12-21 08:30:37', '2024-12-21 08:30:37'),
(13, '21EL3', 2, '2024-12-21 08:30:37', '2024-12-21 08:30:37'),
(14, '21CE1', 3, '2024-12-21 08:30:37', '2024-12-21 08:30:37'),
(15, '21CE2', 3, '2024-12-21 08:30:37', '2024-12-21 08:30:37'),
(16, '21CE3', 3, '2024-12-21 08:30:37', '2024-12-21 08:30:37'),
(17, '21ES1', 3, '2024-12-21 08:30:37', '2024-12-21 08:30:37'),
(18, '21ES2', 3, '2024-12-21 08:30:37', '2024-12-21 08:30:37'),
(19, '21ES3', 3, '2024-12-21 08:30:37', '2024-12-21 08:30:37');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `events`
--

CREATE TABLE `events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `location` varchar(255) NOT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `faculty_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `events`
--

INSERT INTO `events` (`id`, `title`, `date`, `location`, `thumbnail`, `description`, `category_id`, `faculty_id`, `created_at`, `updated_at`) VALUES
(1, 'Multimedia', '2024-12-28 14:30:00', 'VKU', 'thumbnails/oPrwWZ5r1jQ7NU3utEa63RY3RDvBknAXtX2ml4l6.png', 'Workshop', 1, 1, '2024-12-28 19:22:46', '2024-12-28 19:22:46'),
(2, 'Logistic', '2024-12-28 14:30:00', 'VKU', 'thumbnails/Oh4HRnLumTgv2YRKISoFsn9NJPg3iKDY7ckzcEXE.png', 'Workshop', 2, 2, '2024-12-28 19:24:19', '2024-12-28 19:24:19'),
(3, 'Fnance', '2024-12-28 14:30:00', 'VKU', 'thumbnails/hkq9TqLiXLuXzNRXev3Yx5unNCNrb59cIl9hXR5L.png', 'Workshop', 3, 2, '2024-12-28 19:24:38', '2024-12-28 19:24:38'),
(4, 'Music', '2024-12-28 14:30:00', 'VKU', 'thumbnails/G3Ti8k7QPW9brHe6X1BKP3g0rKK0U9X7bQvtkn2q.jpg', 'Workshop', 4, 4, '2024-12-28 19:26:16', '2024-12-28 19:26:16'),
(5, 'Design', '2024-12-28 14:30:00', 'VKU', 'thumbnails/tS0oE9oSvq1itxxtGRcCY3TmGBedJVIEcrGYdycW.jpg', 'Cuộc thi Design poster trung thu', 5, 4, '2024-12-28 19:28:26', '2024-12-28 19:28:26'),
(6, 'MHX 2024', '2024-12-28 14:30:00', 'VKU', 'thumbnails/eJBLNuItaF18oLShaeFjGjKjPQ6hhcEA8S6Apon7.jpg', 'Chiến dịch tình nguyện hè', 6, 4, '2024-12-28 19:30:01', '2024-12-28 19:30:01'),
(7, 'VKU CUP 2023', '2024-12-28 14:30:00', 'VKU', 'thumbnails/oVyZHU5AbKlguQvjrkjiBU6elOJDOCw3oSAhqS0r.jpg', 'GIẢI BÓNG ĐÁ SINH VIÊN “VKU CUP 2023', 6, 4, '2024-12-28 19:30:57', '2024-12-28 19:30:57'),
(8, 'VKU CUP 2023', '2024-12-28 14:30:00', 'VKU', 'thumbnails/obm9ImitdPEneeJRdZMk0V0bi3tfC2enulLnM6bh.jpg', 'GIẢI BÓNG ĐÁ SINH VIÊN “VKU CUP 2023', 7, 4, '2024-12-28 19:31:07', '2024-12-28 19:31:07'),
(9, 'BWD 2024', '2024-12-28 14:30:00', 'VKU', 'thumbnails/usP3tzhpPLMIxYFyXJmP0X94DGWUWvbGcKODSO5Z.jpg', 'CUỘC THI THIẾT KẾ WEB DÀNH CHO SINH VIÊN', 8, 1, '2024-12-28 19:31:56', '2024-12-28 19:31:56'),
(10, 'Robocar 2024', '2024-12-28 14:30:00', 'VKU', 'thumbnails/wt99nR7rsZZbx3PieAAo5rr8Uqw2v6ahCpyZduod.jpg', 'Vòng chung kết Cuộc thi Sáng tạo RoboCar 2024 – Lần thứ 5', 8, 3, '2024-12-28 19:33:34', '2024-12-28 19:33:34');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `event_registrations`
--

CREATE TABLE `event_registrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `event_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('registered','checked_in','absent') NOT NULL DEFAULT 'registered',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `event_registrations`
--

INSERT INTO `event_registrations` (`id`, `user_id`, `event_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 'registered', '2024-12-28 19:35:36', '2024-12-28 19:35:36');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `faculties`
--

CREATE TABLE `faculties` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `faculty` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `unit_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `faculties`
--

INSERT INTO `faculties` (`id`, `faculty`, `description`, `created_at`, `updated_at`, `unit_id`) VALUES
(1, 'Khoa học Máy tính', NULL, NULL, NULL, 1),
(2, 'Kinh tế số và Thương mại điện tử', NULL, NULL, NULL, 1),
(3, 'Kỹ thuật máy tính và Điện tử', NULL, NULL, NULL, 1),
(4, 'Đoàn trường', NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2024_12_18_095230_create_roles_table', 1),
(3, '2024_12_18_095557_create_users_table', 2),
(4, '2024_12_18_095703_create_user_details_table', 3),
(5, '2024_12_20_004009_add_student_and_identity_fields_to_user_details_table', 4),
(7, '2024_12_20_223435_create_faculties_table', 5),
(9, '2024_12_21_151416_create_classes_table', 6),
(11, '2024_12_21_154324_create_user_details_table', 7),
(12, '2024_12_23_084325_create_categories_table', 7),
(13, '2024_12_23_084352_create_events_table', 7),
(14, '2024_12_23_084406_create_event_registrations_table', 7),
(15, '2024_12_23_084423_create_user_preferences_table', 7),
(24, '2024_12_27_011902_create_units_table', 8),
(25, '2024_12_27_011921_add_unit_id_to_faculties_table', 8),
(26, '2024_12_27_013119_add_unit_id_to_user_details_table', 9);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(43, 'App\\Models\\User', 2, 'auth_token', '226be458daed66b103c8bda0e24022b4d48e40ff6074e2e1ec28975c48a4e8dc', '[\"*\"]', NULL, NULL, '2024-12-25 10:03:07', '2024-12-25 10:03:07'),
(45, 'App\\Models\\User', 2, 'auth_token', '0719e2ba4390332c8f004f12d06c53202e1af670a5177d31dc3fc3f3e242b394', '[\"*\"]', '2024-12-28 19:18:48', NULL, '2024-12-26 17:19:51', '2024-12-28 19:18:48'),
(48, 'App\\Models\\User', 2, 'auth_token', '87611a09421dd78774adcb5fdf8a7e1b510a74910541b9c53ede85e329e5332c', '[\"*\"]', '2024-12-28 19:33:34', NULL, '2024-12-28 19:19:18', '2024-12-28 19:33:34'),
(50, 'App\\Models\\User', 4, 'auth_token', 'e80796071c927087af209792feca73b2fc63230ef6f3ab2f48a283dc4e6b97cd', '[\"*\"]', NULL, NULL, '2024-12-28 19:38:57', '2024-12-28 19:38:57'),
(51, 'App\\Models\\User', 5, 'auth_token', 'd528b2834b646b2bb690773921b0806047c56f90d590165e1718c226cb72f86c', '[\"*\"]', NULL, NULL, '2024-12-28 19:39:06', '2024-12-28 19:39:06'),
(52, 'App\\Models\\User', 6, 'auth_token', '08ce9b57bf4138cbef54b25a04f6c2cf1d3643b5172c83cdf1519707aca1a0a4', '[\"*\"]', NULL, NULL, '2024-12-28 19:39:14', '2024-12-28 19:39:14'),
(55, 'App\\Models\\User', 4, 'auth_token', '86ca9deaa77802a5760b838e485df4c362c3e51784c4f405d48c840868036b0f', '[\"*\"]', '2024-12-28 19:49:03', NULL, '2024-12-28 19:49:03', '2024-12-28 19:49:03'),
(56, 'App\\Models\\User', 4, 'auth_token', '2fc0bfa2ee11ee26a6f6e3634ef3123f865c7b7bfb8ddb2132837c01776bb1d2', '[\"*\"]', '2024-12-28 19:57:00', NULL, '2024-12-28 19:57:00', '2024-12-28 19:57:00'),
(57, 'App\\Models\\User', 4, 'auth_token', '0641961f233be6a9b70a5d4c3a6bcfad8e72fa190ff18534ce5625fd75eb9d81', '[\"*\"]', '2024-12-28 19:58:29', NULL, '2024-12-28 19:58:29', '2024-12-28 19:58:29'),
(58, 'App\\Models\\User', 4, 'auth_token', '6f95ebc47d506a0ab0dab6f446eced73fdf916f3427d38285a79d6bed902ba62', '[\"*\"]', '2024-12-28 20:02:53', NULL, '2024-12-28 20:02:53', '2024-12-28 20:02:53'),
(59, 'App\\Models\\User', 3, 'auth_token', 'b3ac77699ba5b5c41e05674a6399cbe1e5ec6542db61db7c0309f0530593e1a9', '[\"*\"]', '2024-12-28 20:04:09', NULL, '2024-12-28 20:04:08', '2024-12-28 20:04:09'),
(60, 'App\\Models\\User', 4, 'auth_token', 'a7f263839eeb26daaeac45b97d98f7f4d58b28927cb2980639a02fd34653393c', '[\"*\"]', '2024-12-28 20:13:45', NULL, '2024-12-28 20:06:02', '2024-12-28 20:13:45');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `permissions` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`permissions`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`, `permissions`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'Quản trị viên toàn hệ thống, có toàn quyền.', '{\"create_event\":true,\"delete_event\":true,\"manage_users\":true,\"access_reports\":true}', NULL, NULL),
(2, 'EventOrganizer', 'Người tổ chức sự kiện, quản lý các sự kiện.', '{\"create_event\":true,\"delete_event\":false,\"manage_users\":false,\"access_reports\":true}', NULL, NULL),
(3, 'Student', 'Sinh viên tham gia sự kiện, nhận gợi ý sự kiện.', '{\"view_recommendations\":true,\"check_in_event\":true}', NULL, NULL),
(4, 'Guest', 'Khách mời tham gia sự kiện, có quyền check-in.', '{\"check_in_event\":true}', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `units`
--

CREATE TABLE `units` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `abbreviation` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `units`
--

INSERT INTO `units` (`id`, `full_name`, `abbreviation`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Vietnam – Korea University of Information and Communications Technology', 'VKU', NULL, NULL, NULL),
(2, 'Trường Y Dược', 'DDY', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL DEFAULT 3,
  `status` enum('active','inactive','banned') NOT NULL DEFAULT 'active',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role_id`, `status`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'wednesday', 'wed@gmail.com', '$2y$10$BAelLRH/rZdhr/QJdCjn.eHbGHyNDGCP1YA59XenLiKJ.RDt07zlq', 3, 'active', NULL, NULL, '2024-12-18 06:20:04', '2024-12-18 06:20:04'),
(2, 'admin', 'admin@gmail.com', '$2y$10$1byrMFxhYCNlRIFjdP8OPeVrUMrUXIczTPYE5ngYJciS.fHi1LZCy', 1, 'active', NULL, NULL, '2024-12-25 10:03:07', '2024-12-25 10:03:07'),
(3, 'use1', 'use1@gmail.com', '$2y$10$HWTa7GK03AN/3vx03oDkv.oH/5ltduJBQrO7sVvbn/u7u70FHt5LS', 3, 'active', NULL, NULL, '2024-12-28 19:38:49', '2024-12-28 19:38:49'),
(4, 'use2', 'use2@gmail.com', '$2y$10$hZ3JvplV25ugeZ2psGobQ.m.ANIJhYnuwA1zjTnLd0wsXERIMUr0C', 3, 'active', NULL, NULL, '2024-12-28 19:38:57', '2024-12-28 19:38:57'),
(5, 'use3', 'use3@gmail.com', '$2y$10$AZQeeUHT3rIA1y9Bk8iEdueFsYIWetXlTDwBojnf42N2FqIj8DUc.', 3, 'active', NULL, NULL, '2024-12-28 19:39:06', '2024-12-28 19:39:06'),
(6, 'use4', 'use4@gmail.com', '$2y$10$UZ5XQ8.lPsH9WytD8LkuheTsGHXguouHL.MOWhK7J5hMAGqZRmSCK', 3, 'active', NULL, NULL, '2024-12-28 19:39:14', '2024-12-28 19:39:14'),
(7, 'user5', 'user5@example.com', '$2y$10$gqOE4WBVbTRWu7ZdxhJtRuNcFhdj1eXd5cECTQtF1u37vSwp0Tlc2', 3, 'active', NULL, NULL, '2024-12-28 19:43:05', '2024-12-28 19:43:05'),
(8, 'user6', 'user6@example.com', '$2y$10$gqOE4WBVbTRWu7ZdxhJtRuNcFhdj1eXd5cECTQtF1u37vSwp0Tlc2', 3, 'active', NULL, NULL, '2024-12-28 19:43:05', '2024-12-28 19:43:05'),
(9, 'user7', 'user7@example.com', '$2y$10$gqOE4WBVbTRWu7ZdxhJtRuNcFhdj1eXd5cECTQtF1u37vSwp0Tlc2', 3, 'active', NULL, NULL, '2024-12-28 19:43:05', '2024-12-28 19:43:05'),
(10, 'user8', 'user8@example.com', '$2y$10$gqOE4WBVbTRWu7ZdxhJtRuNcFhdj1eXd5cECTQtF1u37vSwp0Tlc2', 3, 'active', NULL, NULL, '2024-12-28 19:43:05', '2024-12-28 19:43:05'),
(11, 'user9', 'user9@example.com', '$2y$10$gqOE4WBVbTRWu7ZdxhJtRuNcFhdj1eXd5cECTQtF1u37vSwp0Tlc2', 3, 'active', NULL, NULL, '2024-12-28 19:43:05', '2024-12-28 19:43:05'),
(12, 'user10', 'user10@example.com', '$2y$10$gqOE4WBVbTRWu7ZdxhJtRuNcFhdj1eXd5cECTQtF1u37vSwp0Tlc2', 3, 'active', NULL, NULL, '2024-12-28 19:43:05', '2024-12-28 19:43:05'),
(13, 'user11', 'user11@example.com', '$2y$10$gqOE4WBVbTRWu7ZdxhJtRuNcFhdj1eXd5cECTQtF1u37vSwp0Tlc2', 3, 'active', NULL, NULL, '2024-12-28 19:43:05', '2024-12-28 19:43:05'),
(14, 'user12', 'user12@example.com', '$2y$10$gqOE4WBVbTRWu7ZdxhJtRuNcFhdj1eXd5cECTQtF1u37vSwp0Tlc2', 3, 'active', NULL, NULL, '2024-12-28 19:43:05', '2024-12-28 19:43:05'),
(15, 'user13', 'user13@example.com', '$2y$10$gqOE4WBVbTRWu7ZdxhJtRuNcFhdj1eXd5cECTQtF1u37vSwp0Tlc2', 3, 'active', NULL, NULL, '2024-12-28 19:43:05', '2024-12-28 19:43:05'),
(16, 'user14', 'user14@example.com', '$2y$10$gqOE4WBVbTRWu7ZdxhJtRuNcFhdj1eXd5cECTQtF1u37vSwp0Tlc2', 3, 'active', NULL, NULL, '2024-12-28 19:43:05', '2024-12-28 19:43:05'),
(17, 'user15', 'user15@example.com', '$2y$10$gqOE4WBVbTRWu7ZdxhJtRuNcFhdj1eXd5cECTQtF1u37vSwp0Tlc2', 3, 'active', NULL, NULL, '2024-12-28 19:43:05', '2024-12-28 19:43:05'),
(18, 'user16', 'user16@example.com', '$2y$10$gqOE4WBVbTRWu7ZdxhJtRuNcFhdj1eXd5cECTQtF1u37vSwp0Tlc2', 3, 'active', NULL, NULL, '2024-12-28 19:43:05', '2024-12-28 19:43:05'),
(19, 'user17', 'user17@example.com', '$2y$10$gqOE4WBVbTRWu7ZdxhJtRuNcFhdj1eXd5cECTQtF1u37vSwp0Tlc2', 3, 'active', NULL, NULL, '2024-12-28 19:43:05', '2024-12-28 19:43:05'),
(20, 'user18', 'user18@example.com', '$2y$10$gqOE4WBVbTRWu7ZdxhJtRuNcFhdj1eXd5cECTQtF1u37vSwp0Tlc2', 3, 'active', NULL, NULL, '2024-12-28 19:43:05', '2024-12-28 19:43:05'),
(21, 'user19', 'user19@example.com', '$2y$10$gqOE4WBVbTRWu7ZdxhJtRuNcFhdj1eXd5cECTQtF1u37vSwp0Tlc2', 3, 'active', NULL, NULL, '2024-12-28 19:43:05', '2024-12-28 19:43:05'),
(22, 'user20', 'user20@example.com', '$2y$10$gqOE4WBVbTRWu7ZdxhJtRuNcFhdj1eXd5cECTQtF1u37vSwp0Tlc2', 3, 'active', NULL, NULL, '2024-12-28 19:43:05', '2024-12-28 19:43:05');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_details`
--

CREATE TABLE `user_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `sex` enum('Nam','Nữ','LGBT') DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `permanent_address` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `face_data` varchar(255) DEFAULT NULL,
  `identity_card` varchar(255) DEFAULT NULL,
  `student_id` varchar(255) DEFAULT NULL,
  `unit_id` bigint(20) UNSIGNED DEFAULT NULL,
  `faculty_id` bigint(20) UNSIGNED DEFAULT NULL,
  `class_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `user_details`
--

INSERT INTO `user_details` (`id`, `user_id`, `full_name`, `sex`, `phone`, `date_of_birth`, `address`, `permanent_address`, `avatar`, `face_data`, `identity_card`, `student_id`, `unit_id`, `faculty_id`, `class_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'Mai Xuân Lộc', 'Nam', '0967544253', '2000-01-01', 'Tổ Dân Phố 6, Thị trấn Đắk Hà, Đắk Hà, Kon Tum', 'Đà Nẵng', 'avatars/d8l0AbddQyXn29nHoejZhcrSfmJNH39UcPK7puqf.jpg', NULL, '034200014047', '21IT.T005', NULL, NULL, NULL, '2024-12-26 17:10:14', '2024-12-28 18:55:47'),
(2, 4, 'lộc', NULL, NULL, NULL, NULL, NULL, 'avatars/lDnLaKVopHGEPvahh5COWucENL9juxOMoLtFwWgc.jpg', NULL, NULL, NULL, 1, 1, 2, '2024-12-28 20:06:11', '2024-12-28 20:08:24');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_preferences`
--

CREATE TABLE `user_preferences` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `classes_class_name_unique` (`class_name`),
  ADD KEY `classes_faculty_id_foreign` (`faculty_id`);

--
-- Chỉ mục cho bảng `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `events_category_id_foreign` (`category_id`),
  ADD KEY `events_faculty_id_foreign` (`faculty_id`);

--
-- Chỉ mục cho bảng `event_registrations`
--
ALTER TABLE `event_registrations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_registrations_user_id_foreign` (`user_id`),
  ADD KEY `event_registrations_event_id_foreign` (`event_id`);

--
-- Chỉ mục cho bảng `faculties`
--
ALTER TABLE `faculties`
  ADD PRIMARY KEY (`id`),
  ADD KEY `faculties_unit_id_foreign` (`unit_id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Chỉ mục cho bảng `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Chỉ mục cho bảng `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- Chỉ mục cho bảng `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_details_user_id_foreign` (`user_id`),
  ADD KEY `user_details_faculty_id_foreign` (`faculty_id`),
  ADD KEY `user_details_class_id_foreign` (`class_id`),
  ADD KEY `user_details_unit_id_foreign` (`unit_id`);

--
-- Chỉ mục cho bảng `user_preferences`
--
ALTER TABLE `user_preferences`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_preferences_user_id_foreign` (`user_id`),
  ADD KEY `user_preferences_category_id_foreign` (`category_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `classes`
--
ALTER TABLE `classes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `event_registrations`
--
ALTER TABLE `event_registrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `faculties`
--
ALTER TABLE `faculties`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT cho bảng `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `units`
--
ALTER TABLE `units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT cho bảng `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `user_preferences`
--
ALTER TABLE `user_preferences`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `classes`
--
ALTER TABLE `classes`
  ADD CONSTRAINT `classes_faculty_id_foreign` FOREIGN KEY (`faculty_id`) REFERENCES `faculties` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `events_faculty_id_foreign` FOREIGN KEY (`faculty_id`) REFERENCES `faculties` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `event_registrations`
--
ALTER TABLE `event_registrations`
  ADD CONSTRAINT `event_registrations_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `event_registrations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `faculties`
--
ALTER TABLE `faculties`
  ADD CONSTRAINT `faculties_unit_id_foreign` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`) ON DELETE SET NULL;

--
-- Các ràng buộc cho bảng `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `user_details`
--
ALTER TABLE `user_details`
  ADD CONSTRAINT `user_details_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_details_faculty_id_foreign` FOREIGN KEY (`faculty_id`) REFERENCES `faculties` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_details_unit_id_foreign` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `user_details_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `user_preferences`
--
ALTER TABLE `user_preferences`
  ADD CONSTRAINT `user_preferences_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_preferences_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
