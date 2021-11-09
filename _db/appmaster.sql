-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 08 Nov 2021 pada 21.12
-- Versi server: 10.4.21-MariaDB
-- Versi PHP: 7.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `appmaster`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_activation_attempts`
--

CREATE TABLE `auth_activation_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_groups`
--

CREATE TABLE `auth_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `auth_groups`
--

INSERT INTO `auth_groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'web administrator'),
(2, 'advisor', 'staff konsumen'),
(3, 'asuransi', 'asuransi perusahaan'),
(4, 'surveyor', 'asuransi perwakilan'),
(5, 'client', 'customer');

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_groups_permissions`
--

CREATE TABLE `auth_groups_permissions` (
  `group_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `permission_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_groups_users`
--

CREATE TABLE `auth_groups_users` (
  `group_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `auth_groups_users`
--

INSERT INTO `auth_groups_users` (`group_id`, `user_id`) VALUES
(1, 1),
(1, 2),
(1, 25),
(1, 26),
(2, 12),
(2, 37),
(3, 20),
(3, 22),
(4, 21),
(4, 23),
(5, 24),
(5, 27),
(5, 28),
(5, 34),
(5, 35);

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_logins`
--

CREATE TABLE `auth_logins` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `auth_logins`
--

INSERT INTO `auth_logins` (`id`, `ip_address`, `email`, `user_id`, `date`, `success`) VALUES
(1, '127.0.0.1', 'admin1@gmail.com', 1, '2021-10-18 10:50:32', 1),
(2, '127.0.0.1', 'admin1@gmail.com', 1, '2021-10-18 10:52:01', 1),
(3, '127.0.0.1', 'admin2@gmail.com', 2, '2021-10-20 17:47:25', 1),
(4, '127.0.0.1', 'admin1@gmail.com', 1, '2021-10-21 03:31:39', 1),
(5, '127.0.0.1', 'admin1@gmail.com', 1, '2021-10-22 20:11:42', 1),
(6, '127.0.0.1', 'admin1@gmail.com', 1, '2021-10-23 00:31:57', 1),
(7, '127.0.0.1', 'admin1@gmail.com', 1, '2021-10-23 00:48:55', 1),
(8, '127.0.0.1', 'admin1@gmail.com', 1, '2021-10-23 01:03:08', 1),
(9, '127.0.0.1', 'admin1@gmail.com', 1, '2021-10-23 01:04:33', 1),
(10, '127.0.0.1', 'admin1@gmail.com', 1, '2021-10-23 01:05:06', 1),
(11, '127.0.0.1', 'admin1@gmail.com', 1, '2021-10-23 01:11:57', 1),
(12, '127.0.0.1', 'admin1@gmail.com', 1, '2021-10-23 01:12:08', 1),
(13, '127.0.0.1', 'admin1@gmail.com', 1, '2021-10-23 01:29:59', 1),
(14, '127.0.0.1', 'admin2@gmail.com', 2, '2021-10-23 02:08:25', 1),
(15, '127.0.0.1', 'admin1@gmail.com', 1, '2021-10-23 02:08:58', 1),
(16, '127.0.0.1', 'admin1@gmail.com', NULL, '2021-10-23 02:13:25', 0),
(17, '127.0.0.1', 'admin1@gmail.com', 1, '2021-10-23 02:13:35', 1),
(18, '127.0.0.1', 'admin satu', NULL, '2021-10-23 02:14:55', 0),
(19, '127.0.0.1', 'admin1@gmail.com', 1, '2021-10-23 02:15:31', 1),
(20, '127.0.0.1', 'admin1@gmail.com', 1, '2021-10-23 19:24:22', 1),
(21, '127.0.0.1', 'admin1@gmail.com', 1, '2021-10-24 01:15:16', 1),
(22, '127.0.0.1', 'admin1@gmail.com', 1, '2021-10-24 02:29:51', 1),
(23, '127.0.0.1', 'admin1@gmail.com', 1, '2021-10-24 02:48:34', 1),
(24, '127.0.0.1', 'admin1@gmail.com', 1, '2021-10-26 21:08:22', 1),
(25, '127.0.0.1', 'admin1@gmail.com', NULL, '2021-10-27 16:39:11', 0),
(26, '127.0.0.1', 'admin1@gmail.com', 1, '2021-10-27 16:39:22', 1),
(27, '127.0.0.1', 'admin1@gmail.com', 1, '2021-10-27 18:53:28', 1),
(28, '127.0.0.1', 'admin1@gmail.com', 1, '2021-10-27 19:02:12', 1),
(29, '127.0.0.1', 'admin1@gmail.com', NULL, '2021-10-31 08:39:15', 0),
(30, '127.0.0.1', 'admin1@gmail.com', 1, '2021-10-31 08:39:23', 1),
(31, '127.0.0.1', 'admin1@gmail.com', 1, '2021-10-31 19:21:30', 1),
(32, '127.0.0.1', 'admin1@gmail.com', 1, '2021-11-01 03:27:08', 1),
(33, '127.0.0.1', 'admin1@gmail.com', 1, '2021-11-01 03:46:34', 1),
(34, '127.0.0.1', 'admin1@gmail.com', 1, '2021-11-01 15:39:11', 1),
(35, '127.0.0.1', 'admin1@gmail.com', 1, '2021-11-02 16:44:11', 1),
(36, '127.0.0.1', 'admin1@gmail.com', NULL, '2021-11-03 01:52:25', 0),
(37, '127.0.0.1', 'admin1@gmail.com', NULL, '2021-11-03 01:52:33', 0),
(38, '127.0.0.1', 'admin1@gmail.com', NULL, '2021-11-03 01:52:41', 0),
(39, '127.0.0.1', 'admin1@gmail.com', NULL, '2021-11-03 01:54:03', 0),
(40, '127.0.0.1', 'admin1@gmail.com', NULL, '2021-11-03 01:54:10', 0),
(41, '127.0.0.1', 'admin1@gmail.com', NULL, '2021-11-03 01:54:18', 0),
(42, '127.0.0.1', 'admin1@gmail.com', NULL, '2021-11-03 01:54:26', 0),
(43, '127.0.0.1', 'admin1@gmail.com', NULL, '2021-11-03 03:04:26', 0),
(44, '127.0.0.1', 'admin1@gmail.com', NULL, '2021-11-03 03:04:35', 0),
(45, '127.0.0.1', 'admin1@gmail.com', NULL, '2021-11-03 03:05:05', 0),
(46, '127.0.0.1', 'admin2@gmail.com', 2, '2021-11-03 03:05:32', 1),
(47, '127.0.0.1', 'admin2@gmail.com', NULL, '2021-11-03 03:07:36', 0),
(48, '127.0.0.1', 'admin2@gmail.com', 2, '2021-11-03 03:07:49', 1),
(49, '127.0.0.1', 'admin2@gmail.com', 2, '2021-11-03 03:09:24', 1),
(50, '127.0.0.1', 'asuransi', NULL, '2021-11-03 04:47:15', 0),
(51, '127.0.0.1', 'asuransi', NULL, '2021-11-03 04:47:38', 0),
(52, '127.0.0.1', 'asuransi@gmai.com', NULL, '2021-11-03 04:48:05', 0),
(53, '127.0.0.1', 'admin2@gmail.com', 2, '2021-11-03 04:49:51', 1),
(54, '127.0.0.1', 'admin2@gmail.com', NULL, '2021-11-03 04:50:25', 0),
(55, '127.0.0.1', 'admin2@gmail.com', NULL, '2021-11-03 04:55:26', 0),
(56, '127.0.0.1', 'admin2@gmail.com', NULL, '2021-11-03 04:55:33', 0),
(57, '127.0.0.1', 'admin2@gmail.com', NULL, '2021-11-03 04:57:52', 0),
(58, '127.0.0.1', 'admin2@gmail.com', NULL, '2021-11-03 05:00:27', 0),
(59, '127.0.0.1', 'admin2@gmail.com', NULL, '2021-11-03 05:00:37', 0),
(60, '127.0.0.1', 'admin2@gmail.com', NULL, '2021-11-03 05:08:12', 0),
(61, '127.0.0.1', 'admin2@gmail.com', NULL, '2021-11-03 05:08:22', 0),
(62, '127.0.0.1', 'admin1@gmail.com', NULL, '2021-11-03 05:08:33', 0),
(63, '127.0.0.1', 'admin1@gmail.com', NULL, '2021-11-03 05:08:54', 0),
(64, '127.0.0.1', 'admin1@gmail.com', NULL, '2021-11-03 05:09:00', 0),
(65, '127.0.0.1', 'admin1@gmail.com', NULL, '2021-11-03 05:09:07', 0),
(66, '127.0.0.1', 'admin1@gmail.com', NULL, '2021-11-03 05:13:01', 0),
(67, '127.0.0.1', 'admin1@gmail.com', NULL, '2021-11-03 05:13:50', 0),
(68, '127.0.0.1', 'admin1@gmail.com', NULL, '2021-11-03 05:23:38', 0),
(69, '127.0.0.1', 'admin1@gmail.com', NULL, '2021-11-03 05:23:48', 0),
(70, '127.0.0.1', 'admin1@gmail.com', NULL, '2021-11-03 05:23:55', 0),
(71, '127.0.0.1', 'admin1@gmail.com', NULL, '2021-11-03 05:24:01', 0),
(72, '127.0.0.1', 'admin1@gmail.com', NULL, '2021-11-03 05:41:57', 0),
(73, '127.0.0.1', 'admin1@gmail.com', NULL, '2021-11-03 05:54:49', 0),
(74, '127.0.0.1', 'admin1@gmail.com', 1, '2021-11-03 06:20:13', 1),
(75, '127.0.0.1', 'admin2@gmail.com', 2, '2021-11-03 06:26:07', 1),
(76, '127.0.0.1', 'asuransi@gmail.com', 20, '2021-11-03 08:12:10', 0),
(77, '127.0.0.1', 'asuransi@gmail.com', NULL, '2021-11-03 08:14:50', 0),
(78, '127.0.0.1', 'asuransi@gmail.com', 20, '2021-11-03 08:14:58', 0),
(79, '127.0.0.1', 'admin2@gmail.com', 2, '2021-11-03 08:17:52', 1),
(80, '127.0.0.1', 'client 002', 27, '2021-11-03 08:22:03', 0),
(81, '127.0.0.1', 'client001@yahu.com', 28, '2021-11-03 08:56:31', 1),
(82, '127.0.0.1', 'admin1@gmail.com', 1, '2021-11-04 00:08:00', 1),
(83, '127.0.0.1', 'klient@gmail.com', NULL, '2021-11-04 03:30:19', 0),
(84, '127.0.0.1', 'klien@gmail.com', 30, '2021-11-04 03:30:55', 1),
(85, '127.0.0.1', 'klient01@gmail.com', 31, '2021-11-04 03:31:55', 1),
(86, '127.0.0.1', 'klient02@gmail.com', 32, '2021-11-04 03:35:05', 1),
(87, '127.0.0.1', 'client05@gmail.com', 35, '2021-11-04 04:17:30', 1),
(88, '127.0.0.1', 'admin1@gmail.com', 1, '2021-11-04 16:36:48', 1),
(89, '127.0.0.1', 'admin3@gmail.com', 12, '2021-11-04 19:12:33', 0),
(90, '127.0.0.1', 'admin3@gmail.com', NULL, '2021-11-04 19:13:43', 0),
(91, '127.0.0.1', 'admin3@gmail.com', 12, '2021-11-04 19:13:52', 0),
(92, '127.0.0.1', 'advisor1@gmail.com', 36, '2021-11-04 19:42:32', 1),
(93, '127.0.0.1', 'advisor1@gmail.com', 36, '2021-11-04 19:43:14', 1),
(94, '127.0.0.1', 'advisor1@gmail.com', 36, '2021-11-04 20:36:19', 1),
(95, '127.0.0.1', 'advisor1@gmail.com', 36, '2021-11-04 21:06:49', 1),
(96, '127.0.0.1', 'admin2@gmail.com', 2, '2021-11-04 23:25:11', 0),
(97, '127.0.0.1', 'admin2@gmail.com', 2, '2021-11-04 23:26:32', 0),
(98, '127.0.0.1', 'admin2@gmail.com', 2, '2021-11-04 23:30:51', 0),
(99, '127.0.0.1', 'admin2@gmail.com', 2, '2021-11-05 00:21:55', 1),
(100, '127.0.0.1', 'admin1@gmail.com', 1, '2021-11-05 17:08:22', 1),
(101, '127.0.0.1', 'admin2@gmail.com', 2, '2021-11-05 20:23:22', 1),
(102, '127.0.0.1', 'admin2@gmail.com', 2, '2021-11-05 20:23:47', 1),
(103, '127.0.0.1', 'admin2@gmail.com', 2, '2021-11-06 00:30:23', 1),
(104, '127.0.0.1', 'admin2@gmail.com', 2, '2021-11-06 00:31:45', 1),
(105, '127.0.0.1', 'admin2@gmail.com', 2, '2021-11-06 00:32:20', 1),
(106, '127.0.0.1', 'admin2@gmail.com', 2, '2021-11-06 00:33:15', 1),
(107, '127.0.0.1', 'admin2@gmail.com', 2, '2021-11-06 00:40:24', 1),
(108, '127.0.0.1', 'admin2@gmail.com', 2, '2021-11-06 00:46:18', 1),
(109, '127.0.0.1', 'admin2@gmail.com', 2, '2021-11-06 00:52:32', 1),
(110, '127.0.0.1', 'admin2@gmail.com', 2, '2021-11-06 01:00:31', 1),
(111, '127.0.0.1', 'admin1@gmail.com', 1, '2021-11-06 01:08:38', 1),
(112, '127.0.0.1', 'admin1@gmail.com', 1, '2021-11-06 01:09:12', 1),
(113, '127.0.0.1', 'admin1@gmail.com', 1, '2021-11-06 01:10:15', 1),
(114, '127.0.0.1', 'admin1@gmail.com', 1, '2021-11-06 01:14:53', 1),
(115, '127.0.0.1', 'admin1@gmail.com', 1, '2021-11-06 01:16:38', 1),
(116, '127.0.0.1', 'admin1@gmail.com', 1, '2021-11-06 01:17:23', 1),
(117, '127.0.0.1', 'admin2@gmail.com', 2, '2021-11-06 01:18:12', 1),
(118, '127.0.0.1', 'admin1@gmail.com', 1, '2021-11-06 01:21:13', 1),
(119, '127.0.0.1', 'admin2@gmail.com', 2, '2021-11-06 01:21:42', 1),
(120, '127.0.0.1', 'admin2@gmail.com', 2, '2021-11-06 01:22:16', 1),
(121, '127.0.0.1', 'admin2@gmail.com', 2, '2021-11-06 01:22:49', 1),
(122, '::1', 'admin2@gmail.com', 2, '2021-11-06 01:23:33', 1),
(123, '127.0.0.1', 'admin2@gmail.com', 2, '2021-11-06 01:24:57', 1),
(124, '127.0.0.1', 'admin1@gmail.com', 1, '2021-11-06 01:29:46', 1),
(125, '127.0.0.1', 'admin2@gmail.com', 2, '2021-11-06 01:44:19', 1),
(126, '127.0.0.1', 'admin2@gmail.com', 2, '2021-11-06 01:53:22', 1),
(127, '127.0.0.1', 'admin2@gmail.com', 2, '2021-11-06 15:02:53', 1),
(128, '127.0.0.1', 'admin1@gmail.com', 1, '2021-11-06 15:56:12', 1),
(129, '127.0.0.1', 'admin2@gmail.com', 2, '2021-11-06 21:50:37', 1),
(130, '127.0.0.1', 'admin1@gmail.com', 1, '2021-11-07 02:16:49', 1),
(131, '127.0.0.1', 'admin1@gmail.com', 1, '2021-11-07 21:34:32', 1),
(132, '127.0.0.1', 'admin1@gmail.com', 1, '2021-11-08 15:26:12', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_permissions`
--

CREATE TABLE `auth_permissions` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `auth_permissions`
--

INSERT INTO `auth_permissions` (`id`, `name`, `description`) VALUES
(1, 'panel-superadmin', 'panel grup super admin'),
(2, 'panel-admin', 'panel grup admin'),
(3, 'panel-asuransi', 'panel user asuransi'),
(4, 'panel-client', 'panel user client');

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_reset_attempts`
--

CREATE TABLE `auth_reset_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `auth_reset_attempts`
--

INSERT INTO `auth_reset_attempts` (`id`, `email`, `ip_address`, `user_agent`, `token`, `created_at`) VALUES
(1, '', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:93.0) Gecko/20100101 Firefox/93.0', '', '2021-11-03 02:05:57'),
(2, '', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:93.0) Gecko/20100101 Firefox/93.0', '', '2021-11-03 02:06:15'),
(3, '', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:93.0) Gecko/20100101 Firefox/93.0', '', '2021-11-03 02:32:04'),
(4, '', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:93.0) Gecko/20100101 Firefox/93.0', '', '2021-11-03 02:32:55'),
(5, '', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:93.0) Gecko/20100101 Firefox/93.0', '', '2021-11-03 02:33:46'),
(6, '', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:93.0) Gecko/20100101 Firefox/93.0', '', '2021-11-03 02:34:12'),
(7, 'admin1@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:93.0) Gecko/20100101 Firefox/93.0', '$2y$10$G5o2kOk9hKUNo1pr1CwMe.CwItfaNsqxrdihAZJ45IMIV545oZBkC', '2021-11-03 03:02:08'),
(8, 'admin1@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:93.0) Gecko/20100101 Firefox/93.0', '$2y$10$G5o2kOk9hKUNo1pr1CwMe.CwItfaNsqxrdihAZJ45IMIV545oZBkC', '2021-11-03 03:02:21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_tokens`
--

CREATE TABLE `auth_tokens` (
  `id` int(11) UNSIGNED NOT NULL,
  `selector` varchar(255) NOT NULL,
  `hashedValidator` varchar(255) NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `expires` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_users_permissions`
--

CREATE TABLE `auth_users_permissions` (
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `permission_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_progress`
--

CREATE TABLE `data_progress` (
  `id_progress` int(11) UNSIGNED NOT NULL,
  `id_service` int(11) NOT NULL,
  `tgl_progress` date NOT NULL,
  `id_stall` int(11) NOT NULL,
  `pgs_persen` tinyint(4) NOT NULL,
  `pgs_note` varchar(255) NOT NULL,
  `pgs_photo` varchar(255) NOT NULL,
  `id_users` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `data_progress`
--

INSERT INTO `data_progress` (`id_progress`, `id_service`, `tgl_progress`, `id_stall`, `pgs_persen`, `pgs_note`, `pgs_photo`, `id_users`, `created_at`, `updated_at`) VALUES
(1, 13, '2021-11-04', 10, 30, 'Sedang pengerjaan bongkar pasang', '1635959531_5e325c5e8cb63f6c1258.jpg', 1, '2021-11-04 23:54:47', '2021-11-04 23:54:47'),
(2, 14, '2021-11-18', 17, 30, 'keterangan saja', '1635802846_39e6530c5025422f3935.jpg', 2, '2021-11-08 00:45:39', '2021-11-08 00:45:39'),
(3, 13, '2021-11-18', 17, 30, 'keterangan saja', '1635960927_670345da9d640188f22c.jpg', 2, '2021-11-08 00:45:39', '2021-11-08 00:45:39');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_service`
--

CREATE TABLE `data_service` (
  `id_service` int(10) UNSIGNED NOT NULL,
  `kode_service` varchar(10) NOT NULL,
  `id_advisor` smallint(6) NOT NULL,
  `id_client` smallint(6) NOT NULL,
  `id_asuransi` smallint(6) NOT NULL,
  `tipe_client` varchar(10) NOT NULL,
  `pic_nama` varchar(30) DEFAULT NULL,
  `pic_telp` varchar(15) DEFAULT NULL,
  `id_mbl_jenis` smallint(6) NOT NULL,
  `id_mbl_merk` smallint(6) NOT NULL,
  `id_mbl_tipe` smallint(6) NOT NULL,
  `thn_rakit` varchar(5) NOT NULL,
  `no_pol` varchar(10) NOT NULL,
  `no_rangka` varchar(30) NOT NULL,
  `no_mesin` varchar(30) NOT NULL,
  `id_users` smallint(6) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `data_service`
--

INSERT INTO `data_service` (`id_service`, `kode_service`, `id_advisor`, `id_client`, `id_asuransi`, `tipe_client`, `pic_nama`, `pic_telp`, `id_mbl_jenis`, `id_mbl_merk`, `id_mbl_tipe`, `thn_rakit`, `no_pol`, `no_rangka`, `no_mesin`, `id_users`, `created_at`, `updated_at`) VALUES
(13, 'AK-01', 12, 34, 22, '1', 'nama si pic', '098 765 567', 1, 2, 5, '2012', 'B 7603 WJF', '15045', 'MHYKZE81SCJ115045', 1, '2021-11-08 03:49:39', '2021-11-08 11:49:30'),
(14, 'AK-02', 37, 28, 22, '2', NULL, NULL, 5, 2, 7, '2012', 'B 7603 WJF', '15045', 'MHYKZE81SCJ115045', 1, '2021-11-08 03:49:55', '2021-11-08 03:49:55');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_stall`
--

CREATE TABLE `data_stall` (
  `id_stall` int(11) NOT NULL,
  `stall` varchar(35) NOT NULL,
  `id_users` smallint(6) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `data_stall`
--

INSERT INTO `data_stall` (`id_stall`, `stall`, `id_users`, `created_at`, `updated_at`) VALUES
(10, 'satall 10', 1, '2021-10-23 20:23:44', '2021-11-04 21:43:30'),
(12, 'stall yang keberap', 1, '2021-10-23 20:36:25', '2021-11-04 18:42:49'),
(13, 'stall sepuluh', 2, '2021-10-23 20:38:59', '2021-10-23 20:38:59'),
(14, 'satu satu', 26, '2021-10-23 20:42:39', '2021-10-23 20:42:39'),
(16, 'satall ', 25, '2021-10-26 21:33:08', '2021-10-26 21:33:40'),
(17, 'pitu las', 1, '2021-11-03 12:38:01', '2021-11-03 12:38:01'),
(18, 'stal 18', 1, '2021-11-04 18:43:02', '2021-11-04 18:43:02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2017-11-20-223112', 'Myth\\Auth\\Database\\Migrations\\CreateAuthTables', 'default', 'Myth\\Auth', 1634122826, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `mobil_jenis`
--

CREATE TABLE `mobil_jenis` (
  `id_mobil_jenis` int(11) UNSIGNED NOT NULL,
  `nama_mobil_jenis` varchar(30) NOT NULL,
  `id_users` smallint(6) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `mobil_jenis`
--

INSERT INTO `mobil_jenis` (`id_mobil_jenis`, `nama_mobil_jenis`, `id_users`, `created_at`, `updated_at`) VALUES
(1, 'jenis pertama 1', 1, '2021-11-02 22:21:30', '2021-11-04 21:43:42'),
(4, 'jenis empt', 1, '2021-11-03 07:43:37', '2021-11-03 07:43:48'),
(5, 'jenis lima', 1, '2021-11-04 21:43:49', '2021-11-04 21:43:49');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mobil_merk`
--

CREATE TABLE `mobil_merk` (
  `id_mobil_merk` int(11) UNSIGNED NOT NULL,
  `nama_mobil_merk` varchar(30) NOT NULL,
  `id_users` smallint(6) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `mobil_merk`
--

INSERT INTO `mobil_merk` (`id_mobil_merk`, `nama_mobil_merk`, `id_users`, `created_at`, `updated_at`) VALUES
(1, 'merk mobil satu', 1, '2021-11-03 09:33:13', '2021-11-03 09:33:13'),
(2, 'dua merk edit', 1, '2021-11-03 09:47:55', '2021-11-03 09:48:01'),
(4, 'empat', 1, '2021-11-03 09:48:14', '2021-11-03 09:48:14');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mobil_tipe`
--

CREATE TABLE `mobil_tipe` (
  `id_mobil_tipe` int(10) UNSIGNED NOT NULL,
  `nama_mobil_tipe` varchar(30) NOT NULL,
  `id_users` smallint(6) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `mobil_tipe`
--

INSERT INTO `mobil_tipe` (`id_mobil_tipe`, `nama_mobil_tipe`, `id_users`, `created_at`, `updated_at`) VALUES
(1, 'tipe satu edit', 1, '2021-11-03 09:49:47', '2021-11-03 09:50:23'),
(2, 'dua tipe', 1, '2021-11-03 09:49:55', '2021-11-04 04:31:52'),
(5, 'kelima client', 1, '2021-11-03 10:28:52', '2021-11-03 11:49:18'),
(7, 'berapa tujuh', 28, '2021-11-03 11:58:04', '2021-11-03 12:06:00'),
(8, 'lage', 11, '2021-11-03 11:59:34', '2021-11-03 11:59:34');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(30) NOT NULL,
  `fullname` varchar(30) NOT NULL,
  `photo` varchar(255) NOT NULL DEFAULT 'default.svg',
  `telp` varchar(15) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `password_hash` varchar(255) NOT NULL,
  `reset_hash` varchar(255) DEFAULT NULL,
  `reset_at` datetime DEFAULT NULL,
  `reset_expires` datetime DEFAULT NULL,
  `activate_hash` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `status_message` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `force_pass_reset` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `fullname`, `photo`, `telp`, `alamat`, `password_hash`, `reset_hash`, `reset_at`, `reset_expires`, `activate_hash`, `status`, `status_message`, `active`, `force_pass_reset`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'admin1@gmail.com', 'admin pertama', 'admin no satu', '1636022278_d6261077eeb524223168.jpg', '984557455', 'jalan hujan alamat', '$2y$10$mCss0GIwqL4lLeuRijvnnuOR6YSnGCzwiouLr.qf8qzDufUV7QQ..', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2021-10-18 10:49:12', '2021-11-04 21:55:38', NULL),
(2, 'admin2@gmail.com', 'admin dua', 'nama admin 2', '1635963584_16469f1e59760630f265.jpg', '9097865645', 'jalan kanggraksan no 950 cirebon', '$2y$10$4OnrTlw/WJju2q24H5MN7uvmqx27j09XiCDW.YBXga8Avsg4xg9ce', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2021-10-20 17:47:13', '2021-11-06 22:45:32', NULL),
(12, 'admin3@gmail.com', 'advisor 12', 'advisor dua belas', 'avatar.png', '516484963', 'jalan ketiiga', '$2y$10$kCX03irmFKHyAM1HxnDVDO.hW18vbVyg4TS.vnTP3.PLyuWjUSEqO', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-28 00:47:02', '2021-11-08 17:07:08', NULL),
(20, 'asuransi@gmail.com', 'asuransi', 'nama surveyor', '1635851362_d9cebaaecdafd85bf837.jpg', '57448785487', 'alamat survwyor', '$2y$10$T8.h9iZV.volp8UzT/szUe0wr9LTXyty6qTqEDyJTvH2sm64Q5jE2', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-11-01 04:46:15', '2021-11-03 08:11:46', NULL),
(21, 'pic01@yaho.com', 'pic01', 'nama pic 01', 'bfb5cc0872b444917fc7dc4e252d25ff.jpg', '0096554', 'alamat pic 01', '$2y$10$mIhH22ReIQoc5P7xAY486.LSV6/vqs1GPjZod4EV9zLJPlHU06Vn.', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-11-01 06:07:42', '2021-11-06 17:12:26', NULL),
(22, 'asuransi.abc@gmail.com', 'asuransi abc', 'nama suryevor abc', 'rujak-kangkung-sambel-asem-foto-resep-utama.jpg', '089784496', 'fatahillah jabar', '$2y$10$G6778OcNxfA9/ra3VZu/ceoK7iWmuU3TOkRMFeOZHrfmmlefXYQve', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-11-01 21:21:26', '2021-11-06 17:05:06', NULL),
(23, 'picbengkel@gm.com', 'pic nama user', 'nama advisor', '1635778558_f8ef36f1946cb12ced3c.jpg', '785785685', 'nama alamanar', '$2y$10$ZGfk5ocrQoUso9eV6/ZmqOBLMPF9EUFkzmORyfW218binPWGQVIty', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-11-01 21:53:47', '2021-11-01 21:55:58', NULL),
(24, 'clien5t@gmai.com', 'fuytrr gtree', 'nar iku', '1635779286_f95959f7b36293e52ce2.jpg', '258569866', 'yfyuiui mkuhny', '$2y$10$i.8i.aXruwZ5bBnYsAr1iOWZux48hVd69eIEBuVSQ2zKyBZJ1Mf9a', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-11-01 22:06:33', '2021-11-01 22:08:06', NULL),
(25, 'adm954@yahu.com', 'adm 954', 'admin 954', '1635782416_c143efbeba38667fabd9.png', '987498565', 'jalan kalibata', '$2y$10$N9seziHylqWS8bMwRAtn/uWZtjWJ57WMCEaQm2B9uqSrpF/kjIRG.', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-11-01 22:31:28', '2021-11-01 23:00:16', NULL),
(26, 'aaddrfd@fttg.byfd', 'useruser', 'adsawu', '1635789446_013c8b442b57be5e6051.jpg', '123456789', 'gyjiuhygygt', '$2y$10$7nYPjl9NhDEaHND49PhboOO/rE4og.gu82SqipI6f0EiolhTLgTeO', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-11-01 23:00:50', '2021-11-02 01:41:20', NULL),
(27, 'client002@yahu.com', 'client 002', 'nama clientt 002', 'avatar.png', '09735352432', 'alamat client', '$2y$10$N/Fc6mY2jVmyrMi8TMCYnOXzQJvQTf9vjbWHYWI8HIjjxp96r2VDq', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-11-03 08:21:03', '2021-11-03 08:21:03', NULL),
(28, 'client001@yahu.com', 'client001', 'client nama', 'avatar.png', '09764433561', 'alamat client001', '$2y$10$6FapNAs6nzGZ4JSQhibYpe1R/pLIiUyHtP7kMVJnjEj0uIqaGNyqW', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2021-11-03 08:55:41', '2021-11-03 08:55:41', NULL),
(30, 'klien@gmail.com', 'klien klien', 'nama klien', '1635971202_ef40c64a5e75bb94070f.png', '094354325', 'lamaat klien', '$2y$10$wlwDbVt71Q9gQbudUF9cDu4OPJNKRLz3jhhr4qcI9T6ffyDMnvEcS', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2021-11-04 03:26:42', '2021-11-04 03:26:42', NULL),
(31, 'klient01@gmail.com', 'klient01', 'asgus spuranma', '1635971377_895ac1a14efc3f20b815', '09862233', 'alamat purnama', '$2y$10$KVfRe3OQqZmzKLLpZGhwHu9IUP/pV3L48C2/vXtkbW9dMB2om1yHS', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2021-11-04 03:29:37', '2021-11-04 03:29:37', NULL),
(32, 'klient02@gmail.com', 'klient02', 'ythythyth rfws', '1635971620_95fb49b7be7692586371.jpg', '876543457', 'rbtyn hytdhytt', '$2y$10$o1q2NU88Qad7LhWpQdwVa.bmoBKJWGiXjq9mtZXGPKw3RvPhEccWu', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2021-11-04 03:33:40', '2021-11-04 03:33:40', NULL),
(33, 'klient03@gmail.com', 'fr g rg gr ', 'r rrefr', 'directory', '545445434', 'r erbgt gthtrg', '$2y$10$aqDynScclyS.BKqNv2C9ruMc2of/O2lZADg6ptd1/JGQCGS40SXc2', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2021-11-04 03:57:01', '2021-11-04 03:57:01', NULL),
(34, 'client04@gmail.com', ' hythyt', 'regth', '1635974159_77261ffc1171781160c8png', '8765567565', ' htyju jty', '$2y$10$ymcS9KmKIOgj4tqF1zypp.fUVGH1y6J/10QqD.ZDgD62j8ZVEYmW.', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2021-11-04 04:15:59', '2021-11-04 04:15:59', NULL),
(35, 'client05@gmail.com', 'username kelima', 'klient kelima', '1635974207_f7de71d9401138daa6a4.png', '5665544', 'alamat kelima', '$2y$10$NUy3lQnSl3IbWoiGQ9Ccx.OqYf7DaNccDwPoP25BbS/NKfe5ipSW2', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2021-11-04 04:16:47', '2021-11-04 04:42:18', NULL),
(36, 'advisor1@gmail.com', 'advisor satu', 'nama si advisor', '1636029357_b9bf6447d320939eacd2.png', '564598479', 'alamat advisor', '$2y$10$1wn75cm8c.IYEGF7zE2.K.03X7GL8iSq0vIoyM.jxZWMK5ry1JHIe', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2021-11-04 19:35:57', '2021-11-04 21:27:34', NULL),
(37, 'advisor2@gmail.com', 'advisor2', 'nama advisor 2', '1636029586_331fa0a0752865fc2925.png', '5648549', 'alamat advisor ', '$2y$10$IPoX8qtK4nTrL34lV/FkeOqLPJVlyrpGb0TDgYNe6MaSmFy94gOCS', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2021-11-04 19:39:46', '2021-11-04 19:39:46', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `auth_activation_attempts`
--
ALTER TABLE `auth_activation_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `auth_groups`
--
ALTER TABLE `auth_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  ADD KEY `auth_groups_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `group_id_permission_id` (`group_id`,`permission_id`);

--
-- Indeks untuk tabel `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD KEY `auth_groups_users_user_id_foreign` (`user_id`),
  ADD KEY `group_id_user_id` (`group_id`,`user_id`);

--
-- Indeks untuk tabel `auth_logins`
--
ALTER TABLE `auth_logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `auth_permissions`
--
ALTER TABLE `auth_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auth_tokens_user_id_foreign` (`user_id`),
  ADD KEY `selector` (`selector`);

--
-- Indeks untuk tabel `auth_users_permissions`
--
ALTER TABLE `auth_users_permissions`
  ADD KEY `auth_users_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `user_id_permission_id` (`user_id`,`permission_id`);

--
-- Indeks untuk tabel `data_progress`
--
ALTER TABLE `data_progress`
  ADD PRIMARY KEY (`id_progress`);

--
-- Indeks untuk tabel `data_service`
--
ALTER TABLE `data_service`
  ADD PRIMARY KEY (`id_service`);

--
-- Indeks untuk tabel `data_stall`
--
ALTER TABLE `data_stall`
  ADD PRIMARY KEY (`id_stall`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `mobil_jenis`
--
ALTER TABLE `mobil_jenis`
  ADD PRIMARY KEY (`id_mobil_jenis`);

--
-- Indeks untuk tabel `mobil_merk`
--
ALTER TABLE `mobil_merk`
  ADD PRIMARY KEY (`id_mobil_merk`);

--
-- Indeks untuk tabel `mobil_tipe`
--
ALTER TABLE `mobil_tipe`
  ADD PRIMARY KEY (`id_mobil_tipe`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `auth_activation_attempts`
--
ALTER TABLE `auth_activation_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `auth_groups`
--
ALTER TABLE `auth_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `auth_logins`
--
ALTER TABLE `auth_logins`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT untuk tabel `auth_permissions`
--
ALTER TABLE `auth_permissions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `auth_tokens`
--
ALTER TABLE `auth_tokens`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `data_progress`
--
ALTER TABLE `data_progress`
  MODIFY `id_progress` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `data_service`
--
ALTER TABLE `data_service`
  MODIFY `id_service` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `data_stall`
--
ALTER TABLE `data_stall`
  MODIFY `id_stall` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `mobil_jenis`
--
ALTER TABLE `mobil_jenis`
  MODIFY `id_mobil_jenis` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `mobil_merk`
--
ALTER TABLE `mobil_merk`
  MODIFY `id_mobil_merk` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `mobil_tipe`
--
ALTER TABLE `mobil_tipe`
  MODIFY `id_mobil_tipe` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  ADD CONSTRAINT `auth_groups_permissions_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_groups_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD CONSTRAINT `auth_groups_users_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_groups_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD CONSTRAINT `auth_tokens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `auth_users_permissions`
--
ALTER TABLE `auth_users_permissions`
  ADD CONSTRAINT `auth_users_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_users_permissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
