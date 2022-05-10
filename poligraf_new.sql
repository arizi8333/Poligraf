-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 11 Bulan Mei 2022 pada 00.01
-- Versi server: 10.4.18-MariaDB
-- Versi PHP: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `poligraf_new`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `detaillayanans`
--

CREATE TABLE `detaillayanans` (
  `pemesanan_id` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `layanan_id` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah_terperiksa` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `detaillayanans`
--

INSERT INTO `detaillayanans` (`pemesanan_id`, `layanan_id`, `jumlah_terperiksa`, `created_at`, `updated_at`) VALUES
('001/PI-QT/05/2022', 'L0002', 2, NULL, NULL),
('001/PI-QT/05/2022', 'L0003', 3, NULL, NULL),
('002/PI-QT/V/2022', 'L0002', 1, NULL, NULL),
('003/PI-QT/V/2022', 'L0001', 3, NULL, NULL),
('003/PI-QT/V/2022', 'L0002', 3, NULL, NULL),
('004/PI-QT/V/2022', 'L0001', 1, NULL, NULL),
('004/PI-QT/V/2022', 'L0003', 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `diskons`
--

CREATE TABLE `diskons` (
  `id` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` double NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `diskons`
--

INSERT INTO `diskons` (`id`, `jumlah`, `keterangan`, `status`, `created_at`, `updated_at`) VALUES
('D0000', 0, '-', 0, NULL, NULL),
('D0002', 10, 'Diskon PNS', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `layanans`
--

CREATE TABLE `layanans` (
  `id` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` int(11) NOT NULL,
  `nama_layanan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `layanans`
--

INSERT INTO `layanans` (`id`, `harga`, `nama_layanan`, `created_at`, `updated_at`) VALUES
('L0001', 500000, 'Screening / Risk Assessment Karyawan dan Calon Karyawan', NULL, NULL),
('L0002', 750000, 'Investigasi / Pengungkapan Terhadap Suatu Kasus', NULL, NULL),
('L0003', 300000, 'Training Poligraf', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2012_04_26_135401_create_roles_table', 1),
(2, '2014_10_12_000000_create_users_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2022_04_26_135417_create_diskons_table', 1),
(7, '2022_04_26_135430_create_layanans_table', 1),
(8, '2022_04_26_135447_create_pemesanans_table', 1),
(9, '2022_04_26_135533_create_detaillayanans_table', 1),
(10, '2022_04_26_135550_create_pemeriksaans_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemeriksaans`
--

CREATE TABLE `pemeriksaans` (
  `id` varchar(22) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pemesanan_id` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `layanan_id` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `case` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_terperiksa` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hasil` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pemeriksaans`
--

INSERT INTO `pemeriksaans` (`id`, `pemesanan_id`, `layanan_id`, `user_id`, `case`, `nama_terperiksa`, `hasil`, `rating`, `created_at`, `updated_at`) VALUES
('05052022-8112024-1', '001/PI-QT/05/2022', 'L0002', 'U000000004', 'Kasus Korupsi', 'Arif Rey Sinaga', 'public/hasil/MB2GSX6ZCKbsvbzuQHjRgmpTbFfAF9yWeu7EoP0h.pdf', 4, NULL, NULL),
('05052022-8112024-2', '001/PI-QT/05/2022', 'L0002', 'U000000004', 'Kasus Korupsi', 'Salsa Karina', 'public/hasil/g7Xjy2RjhZP6e2RUUNGrOPEci8hQskDj1AVZu9HW.pdf', 4, NULL, NULL),
('05052022-8112024-3', '001/PI-QT/05/2022', 'L0003', 'U000000004', 'Pelatihan Komputer', 'Siska Kohl', 'public/hasil/JDJJiPr6sVCT4sm8K7JIbzeXVEAf1w7qNwiSeLzu.pdf', 4, NULL, NULL),
('05052022-8112024-4', '001/PI-QT/05/2022', 'L0003', 'U000000004', 'Pelatihan Komputer', 'Linda Saputri', 'public/hasil/wCjE89JqUYqoZdXTznL7F97qO7Jo0yIoTjjgeGG4.pdf', 4, NULL, NULL),
('05052022-8112024-5', '001/PI-QT/05/2022', 'L0003', 'U000000004', 'Pelatihan Komputer', 'aji Santoso', 'public/hasil/y69WK17bgquimYJrB1GCTFJ52yoo7kOD5z9aIzro.pdf', 4, NULL, NULL),
('08052022-11112024-06', '002/PI-QT/V/2022', 'L0002', 'U000000004', 'Pencurian', 'Anto', 'public/hasil/Xpe9OxLzIIWQNtBkSjWTmFxhFLHZdYjqoCXk7O9n.jpg', 5, NULL, NULL),
('10052022-13112024-010', '003/PI-QT/V/2022', 'L0001', 'U000000003', ' ', ' ', '-', 0, NULL, NULL),
('10052022-13112024-011', '003/PI-QT/V/2022', 'L0001', 'U000000003', ' ', ' ', '-', 0, NULL, NULL),
('10052022-13112024-012', '003/PI-QT/V/2022', 'L0001', 'U000000003', ' ', ' ', '-', 0, NULL, NULL),
('10052022-13112024-013', '003/PI-QT/V/2022', 'L0002', 'U000000003', ' ', ' ', '-', 0, NULL, NULL),
('10052022-13112024-014', '003/PI-QT/V/2022', 'L0002', 'U000000003', ' ', ' ', '-', 0, NULL, NULL),
('10052022-13112024-015', '003/PI-QT/V/2022', 'L0002', 'U000000003', ' ', ' ', '-', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemesanans`
--

CREATE TABLE `pemesanans` (
  `id` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `diskon_id` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bukti_pembayaran` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `jam_kadaluarsa` time NOT NULL,
  `jam_pembayaran` time DEFAULT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_selesai` date NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pemesanans`
--

INSERT INTO `pemesanans` (`id`, `user_id`, `diskon_id`, `bukti_pembayaran`, `status`, `total_harga`, `jam_kadaluarsa`, `jam_pembayaran`, `tgl_mulai`, `tgl_selesai`, `keterangan`, `created_at`, `updated_at`) VALUES
('001/PI-QT/05/2022', 'U000000001', 'D0000', 'public/bukti/2fwyVCl4e8lIHhdKbwoJgDCjXdCiBLOBEu6nEHTw.png', 2, 2400000, '09:59:06', '20:24:00', '2022-05-19', '2022-05-20', NULL, NULL, NULL),
('002/PI-QT/V/2022', 'U000000001', 'D0000', 'public/bukti/Iqjxd8MHIwgaU4bYwf47E3Ot7JFaoqtjnJfc78wD.jpg', 2, 750000, '05:59:31', '03:59:40', '2022-05-09', '2022-05-10', NULL, NULL, NULL),
('003/PI-QT/V/2022', 'U000000001', 'D0000', NULL, 2, 3750000, '06:33:22', '00:00:00', '2022-05-18', '2022-05-22', NULL, NULL, NULL),
('004/PI-QT/V/2022', 'U000000001', 'D0000', NULL, 2, 1100000, '08:47:27', '00:00:00', '2022-05-21', '2022-05-25', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `id` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_role` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id`, `nama_role`, `created_at`, `updated_at`) VALUES
('R01', 'Admin', NULL, NULL),
('R02', 'Instruktur', NULL, NULL),
('R03', 'Client', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `companies` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telp_perusahaan` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `role_id`, `nama`, `companies`, `no_hp`, `telp_perusahaan`, `address`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
('U000000001', 'R03', 'Alfarizi', 'PT. Cinta Abadi', '081270789843', '0217544', 'Jln Setia Budi Yang Paling Setia', 'arizi@gmail.com', '2022-04-26 11:41:14', '$2y$10$fpPdxW8nTivc1TuAa2nHX.LbNWCn6x90PhvgTgumBgjAKoCCKxUHq', NULL, NULL, NULL),
('U000000002', 'R01', 'Agung Prasetya', 'PT Poligraf Indonesia', '0852897654', '021435786', 'Jln Setia Budi No 56 Jakarta Utara', 'admin@gmail.com', '2022-04-29 13:58:33', '$2y$10$Y1zh4eEdAGc.mgsWJGtJDuYkcpIi3bGw2AYfv.PakAXUOt1rDgCny', NULL, NULL, NULL),
('U000000003', 'R02', 'Harry Silakban', 'PT Poligraf Indonesia', '0889324276', '0217544', 'Perumahan Jayapura', 'harry@gmail.com', '2022-04-29 14:01:01', '$2y$10$Y1zh4eEdAGc.mgsWJGtJDuYkcpIi3bGw2AYfv.PakAXUOt1rDgCny', NULL, NULL, NULL),
('U000000004', 'R02', 'Ridho Febri Silalahi', 'PT Poligraf Indonesia', '-', '0217544', 'Simpang Tinju', 'ridho@gmail.com', '2022-04-29 15:53:40', '$2y$10$jQBPio6FuF.vg/oLbWUpr.quztSCYw5qrZwl1bJQmsw8rD/PJ2ll2', NULL, NULL, NULL),
('U000000005', 'R02', 'Haris Ikhsan', 'PT Poligraf Indonesia', '08123123123', '0212449', 'Perumahan Jayapura', 'haris@gmail.com', '2022-05-09 23:56:37', '$2y$10$mpp9j63Qrr8257Xab22y9u4OnJUmZchtCwcS7xewAHrIluNto9/6u', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `detaillayanans`
--
ALTER TABLE `detaillayanans`
  ADD KEY `detaillayanans_pemesanan_id_foreign` (`pemesanan_id`),
  ADD KEY `detaillayanans_layanan_id_foreign` (`layanan_id`);

--
-- Indeks untuk tabel `diskons`
--
ALTER TABLE `diskons`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `layanans`
--
ALTER TABLE `layanans`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `pemeriksaans`
--
ALTER TABLE `pemeriksaans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pemeriksaans_pemesanan_id_foreign` (`pemesanan_id`),
  ADD KEY `pemeriksaans_layanan_id_foreign` (`layanan_id`),
  ADD KEY `pemeriksaans_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `pemesanans`
--
ALTER TABLE `pemesanans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pemesanans_user_id_foreign` (`user_id`),
  ADD KEY `pemesanans_diskon_id_foreign` (`diskon_id`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `detaillayanans`
--
ALTER TABLE `detaillayanans`
  ADD CONSTRAINT `detaillayanans_layanan_id_foreign` FOREIGN KEY (`layanan_id`) REFERENCES `layanans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detaillayanans_pemesanan_id_foreign` FOREIGN KEY (`pemesanan_id`) REFERENCES `pemesanans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pemeriksaans`
--
ALTER TABLE `pemeriksaans`
  ADD CONSTRAINT `pemeriksaans_layanan_id_foreign` FOREIGN KEY (`layanan_id`) REFERENCES `layanans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pemeriksaans_pemesanan_id_foreign` FOREIGN KEY (`pemesanan_id`) REFERENCES `pemesanans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pemeriksaans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pemesanans`
--
ALTER TABLE `pemesanans`
  ADD CONSTRAINT `pemesanans_diskon_id_foreign` FOREIGN KEY (`diskon_id`) REFERENCES `diskons` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pemesanans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
