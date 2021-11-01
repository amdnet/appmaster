-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Nov 2021 pada 20.15
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
(1, 'Admin', 'Web Administrator'),
(2, 'Advisor', 'Staff konsumen'),
(3, 'PIC', 'Staff bengkel'),
(4, 'Asuransi', 'Asuransi perusahaan'),
(5, 'Surveyor', 'Asuransi perwakilan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_groups_permissions`
--

CREATE TABLE `auth_groups_permissions` (
  `group_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `permission_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `auth_groups_permissions`
--

INSERT INTO `auth_groups_permissions` (`group_id`, `permission_id`) VALUES
(1, 1),
(1, 1),
(2, 2),
(2, 2),
(3, 3),
(3, 3),
(4, 4),
(4, 4);

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
(1, 25),
(1, 26),
(2, 23),
(3, 2),
(3, 21),
(3, 22),
(4, 20),
(4, 24);

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
(34, '127.0.0.1', 'admin1@gmail.com', 1, '2021-11-01 15:39:11', 1);

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
  `pgs_id` int(11) UNSIGNED NOT NULL,
  `pgs_kode` varchar(25) NOT NULL,
  `pgs_client` varchar(30) NOT NULL,
  `pgs_mobil` varchar(30) NOT NULL,
  `pgs_polisi` varchar(30) NOT NULL,
  `pgs_tgl` date NOT NULL,
  `pgs_location` varchar(30) NOT NULL,
  `pgs_progress` varchar(5) NOT NULL,
  `pgs_note` varchar(255) NOT NULL,
  `pgs_photo` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kat_mobil`
--

CREATE TABLE `kat_mobil` (
  `id_mobil` int(11) NOT NULL,
  `mobil` varchar(35) NOT NULL,
  `username` varchar(35) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `kat_mobil`
--

INSERT INTO `kat_mobil` (`id_mobil`, `mobil`, `username`, `created_at`, `updated_at`) VALUES
(1, 'mobil ok', 'admin satu', '2021-10-22 23:06:50', '2021-10-23 21:46:38'),
(2, 'mobil dua', 'admin satu', '2021-10-23 20:43:44', '2021-10-23 20:43:44'),
(4, 'dwst dwda', 'admin satu', '2021-10-26 21:38:45', '2021-10-31 09:41:09');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kat_stall`
--

CREATE TABLE `kat_stall` (
  `id_stall` int(11) NOT NULL,
  `stall` varchar(35) NOT NULL,
  `username` varchar(35) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `kat_stall`
--

INSERT INTO `kat_stall` (`id_stall`, `stall`, `username`, `created_at`, `updated_at`) VALUES
(8, '1234a', 'admin satu', '2021-10-22 03:56:50', '2021-11-01 19:12:19'),
(10, 'satu dua 2222', 'admin satu', '2021-10-23 20:23:44', '2021-10-26 23:06:47'),
(12, 'stall yang keberapa', '', '2021-10-23 20:36:25', '2021-10-23 20:36:25'),
(13, 'stall sepuluh', '', '2021-10-23 20:38:59', '2021-10-23 20:38:59'),
(14, 'satu satu', '', '2021-10-23 20:42:39', '2021-10-23 20:42:39'),
(15, 'dwad wadwa', 'admin satu', '2021-10-23 21:11:53', '2021-10-23 21:11:53'),
(16, 'satall ', 'admin satu', '2021-10-26 21:33:08', '2021-10-26 21:33:40');

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
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(30) NOT NULL,
  `fullname` varchar(30) NOT NULL,
  `photo` varchar(255) NOT NULL DEFAULT 'default.svg',
  `telp` varchar(30) DEFAULT NULL,
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
(1, 'admin1@gmail.com', 'admin satu', '', 'default.svg', '', '', '$2y$10$0S1DSGWUTUAf53go7ccHQOy5MuJ9TSicPlsbzr0cn9fZBwXljfQfa', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2021-10-18 10:49:12', '2021-10-18 10:49:53', NULL),
(2, 'admin2@gmail.com', 'admin dua', '', 'default.svg', '9097865645', 'jalan kanggraksan no 950 cirebon', '$2y$10$0S1DSGWUTUAf53go7ccHQOy5MuJ9TSicPlsbzr0cn9fZBwXljfQfa', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2021-10-20 17:47:13', '2021-11-01 03:23:56', NULL),
(11, 'client1@gmai.com', 'admin satu1', '', 'default.svg', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-28 00:46:17', '2021-10-28 00:46:17', NULL),
(12, 'dwa@dwad.com', 'admin sat', '', 'default.svg', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-28 00:47:02', '2021-10-28 00:47:02', NULL),
(13, 'client54@gmai.com', 'admin', '', 'default.svg', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-28 00:51:33', '2021-10-28 00:51:33', NULL),
(14, 'dwadwa@fewafd.co', 'dwawdad', '', 'default.svg', '', '', '$2y$10$tR5JUbR8w3VB1Az41McYd.Ei59d4Fblb6HE4mE/f0nDGmHhIeJ1lO', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-28 01:05:36', '2021-10-28 01:05:36', NULL),
(15, 'fehtre@hgfd.uy', 'asytesre', '', 'default.svg', '', '', '$2y$10$7SPg7/Emsv8iwJFtH6qjAe3RfHmLzXRRMICiQV0p.ouuL2NU3tfnq', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-28 01:10:17', '2021-10-28 01:10:17', NULL),
(16, 'addwamin10@gmail.com', 'admin satdwau', '', 'default.svg', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-28 02:04:10', '2021-10-28 02:04:10', NULL),
(17, 'adwadmin10@gmail.com', 'clwaiuent1', '', 'default.svg', '', '', '$2y$10$sAwx0n1mnvAaIG8RF1ItHO5v2WHY.3Ry6teudO5vakJhZ5CzytKou', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-10-28 02:05:31', '2021-10-28 02:05:31', NULL),
(19, '', '', '', 'default.svg', NULL, 'jalan kanggraksan no 950 cirebon', '', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-11-01 01:59:55', '2021-11-01 01:59:55', NULL),
(20, 'client00@gmai.com', 'cliunt1', '', 'default.svg', '', '', '$2y$10$Rq3CZNRgCG6vseYblrwMJeu0hDTbTEcA6OafQkX4.v5/3Anlhymqq', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-11-01 04:46:15', '2021-11-01 05:06:43', NULL),
(21, 'mailasi@yaho.com', 'asuransi pertama', '', 'bfb5cc0872b444917fc7dc4e252d25ff.jpg', '0096554', 'tuparev barat', '$2y$10$mIhH22ReIQoc5P7xAY486.LSV6/vqs1GPjZod4EV9zLJPlHU06Vn.', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-11-01 06:07:42', '2021-11-01 21:06:25', NULL),
(22, 'ransi@gmail.com', 'asuransi abc', 'nama surveyor', 'rujak-kangkung-sambel-asem-foto-resep-utama.jpg', '089784496', 'fatahillah jabar', '$2y$10$G6778OcNxfA9/ra3VZu/ceoK7iWmuU3TOkRMFeOZHrfmmlefXYQve', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-11-01 21:21:26', '2021-11-01 21:21:42', NULL),
(23, 'picbengkel@gm.com', 'pic nama user', 'nama advisor', '1635778558_f8ef36f1946cb12ced3c.jpg', '785785685', 'nama alamanar', '$2y$10$ZGfk5ocrQoUso9eV6/ZmqOBLMPF9EUFkzmORyfW218binPWGQVIty', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-11-01 21:53:47', '2021-11-01 21:55:58', NULL),
(24, 'clien5t@gmai.com', 'fuytrr gtree', 'nar iku', '1635779286_f95959f7b36293e52ce2.jpg', '258569866', 'yfyuiui mkuhny', '$2y$10$i.8i.aXruwZ5bBnYsAr1iOWZux48hVd69eIEBuVSQ2zKyBZJ1Mf9a', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-11-01 22:06:33', '2021-11-01 22:08:06', NULL),
(25, 'adm954@yahu.com', 'adm 954', 'admin 954', '1635782416_c143efbeba38667fabd9.png', '987498565', 'jalan kalibata', '$2y$10$N9seziHylqWS8bMwRAtn/uWZtjWJ57WMCEaQm2B9uqSrpF/kjIRG.', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-11-01 22:31:28', '2021-11-01 23:00:16', NULL),
(26, 'aaddrfd@fttg.byfd', 'useruser', 'adsawu', '1635789446_013c8b442b57be5e6051.jpg', '123456789', 'gyjiuhygygt', '$2y$10$7nYPjl9NhDEaHND49PhboOO/rE4og.gu82SqipI6f0EiolhTLgTeO', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2021-11-01 23:00:50', '2021-11-02 01:41:20', NULL);

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
  ADD PRIMARY KEY (`pgs_id`),
  ADD KEY `pgs_kode` (`pgs_kode`);

--
-- Indeks untuk tabel `kat_mobil`
--
ALTER TABLE `kat_mobil`
  ADD PRIMARY KEY (`id_mobil`);

--
-- Indeks untuk tabel `kat_stall`
--
ALTER TABLE `kat_stall`
  ADD PRIMARY KEY (`id_stall`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `auth_logins`
--
ALTER TABLE `auth_logins`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT untuk tabel `auth_permissions`
--
ALTER TABLE `auth_permissions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `auth_tokens`
--
ALTER TABLE `auth_tokens`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `data_progress`
--
ALTER TABLE `data_progress`
  MODIFY `pgs_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kat_mobil`
--
ALTER TABLE `kat_mobil`
  MODIFY `id_mobil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `kat_stall`
--
ALTER TABLE `kat_stall`
  MODIFY `id_stall` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

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
