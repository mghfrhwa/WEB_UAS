-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 21 Des 2025 pada 05.24
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web_uas`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bahan`
--

CREATE TABLE `bahan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `satuan` varchar(255) NOT NULL,
  `stok` int(11) NOT NULL DEFAULT 0,
  `harga` int(11) NOT NULL DEFAULT 0,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `bahan`
--

INSERT INTO `bahan` (`id`, `nama`, `satuan`, `stok`, `harga`, `keterangan`, `created_at`, `updated_at`) VALUES
(3, 'Bearing', 'pcs', 1, 9998, NULL, '2025-12-02 09:27:23', '2025-12-16 21:33:11'),
(4, 'Snap Ring', 'pcs', 0, 500, NULL, '2025-12-03 21:26:27', '2025-12-13 02:17:06'),
(5, 'UCP 204-12', 'pcs', 9, 46900, NULL, '2025-12-16 05:51:12', '2025-12-16 06:13:13'),
(7, 'Bearing 6208', 'pcs', 14, 20000, NULL, '2025-12-16 05:52:26', '2025-12-16 06:13:13'),
(8, 'Bearing 6204', 'pcs', 40, 8000, NULL, '2025-12-16 05:53:01', '2025-12-16 21:33:11'),
(9, 'Pulley Cor 2,5AS 30', 'pcs', 2, 44999, NULL, '2025-12-16 05:53:53', '2025-12-16 06:13:13'),
(10, 'Pulley Cor 2 AS 14', 'pcs', 6, 14000, NULL, '2025-12-16 05:54:55', '2025-12-16 21:33:11'),
(11, 'Pulley Cor 2,5 AS 19', 'pcs', 6, 16000, NULL, '2025-12-16 05:55:37', '2025-12-16 21:33:11'),
(12, 'Pulley Cor 3 AS 19', 'pcs', 5, 17000, NULL, '2025-12-16 05:56:13', '2025-12-16 21:33:11'),
(13, 'Pulley Cor 6 AS 19', 'pcs', 5, 39000, NULL, '2025-12-16 05:56:53', '2025-12-16 21:33:11'),
(14, 'Seal 50x80x1', 'pcs', 6, 25000, NULL, '2025-12-16 05:57:28', '2025-12-16 06:13:13'),
(15, 'ucf 204', 'pcs', 30, 300000, 'mesin', '2025-12-16 21:30:58', '2025-12-16 21:30:58');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `katalog`
--

CREATE TABLE `katalog` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `harga` int(11) NOT NULL DEFAULT 0,
  `foto` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `katalog`
--

INSERT INTO `katalog` (`id`, `judul`, `deskripsi`, `harga`, `foto`, `created_at`, `updated_at`) VALUES
(4, 'Mesin Cetak Opak Gambir', 'Ini adalah mesin rotary (meja putar) untuk mencetak kue semprong, gapit, atau waffle tipis. Mesin ini menggunakan bahan bakar gas (LPG) dengan kompor di bagian bawah setiap cetakan. Operator tinggal memutar meja, menuang adonan, dan membolak-balik cetakan hitam tersebut secara manual namun dalam alur kerja yang kontinu.', 11000000, 'katalog-img/xtpzIWjDeC7Mt84IQ7p17ChpCTIe6x97zbreH5pS.jpg', '2025-12-16 18:35:54', '2025-12-16 18:40:52'),
(5, 'Mesin Cetak Pelet Pakan Ternak', 'Tipe Screw Horizontal Mesin ini digunakan untuk memadatkan campuran bahan pakan menjadi bentuk butiran (pelet) silinder. Biasa digunakan untuk pakan ikan, ayam, atau kelinci. Menggunakan sistem screw (ulir) untuk menekan bahan keluar melalui saringan (die). Pada ujungnya terdapat pisau pemotong untuk mengatur panjang pelet.', 5000000, 'katalog-img/ssv7nVvMctDmk9lSNUrS0IpaizT6aUiRgkmJzWkG.jpg', '2025-12-16 18:36:31', '2025-12-16 18:50:05'),
(6, 'Mesin Cetak Opak Gambir', 'Model Rak / Press Manual mesin berbentuk rak statis (tidak berputar). Operator bekerja dengan berjalan menggeser posisi atau berdiri di depan mesin. Menggunakan sistem jepit manual dengan pegangan merah.', 4500000, 'katalog-img/iUFNjHmzUCfQmxTCHMo1MVw0i3gyNOnNB1FLDxuK.jpg', '2025-12-16 18:37:48', '2025-12-16 18:50:51'),
(7, 'Mesin Ekstruder Pelet Pakan', 'Tipe Diesel/Heavy Duty Ini adalah versi yang lebih bertenaga dari mesin menggunakan mesin diesel (bahan bakar solar) sebagai penggerak, yang menandakan kapasitas produksi lebih besar. Mesin ini seringkali bisa dimodifikasi untuk membuat pelet apung atau tenggelam tergantung jenis screw di dalamnya.', 9000000, 'katalog-img/H7mXI6lKHhQaycb9OBsOWUrEdNlS1lzn2v63exrJ.jpg', '2025-12-16 18:38:25', '2025-12-16 18:51:35'),
(8, 'Mesin Giling Daging (Meat Grinder) Tipe Pulley', 'Mesin giling daging rakitan dengan kepala gilingan (head grinder) besi cor atau stainless. Menggunakan rangka besi siku model A. Biasa digunakan oleh tukang bakso di pasar atau usaha catering untuk menggiling daging sapi, ayam, atau kacang bumbu pecel.', 3000000, 'katalog-img/SQiEyMfL7sLD623XvB72nl4YRcoegKGOhzzYCAQq.jpg', '2025-12-16 18:39:19', '2025-12-16 18:39:19');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_12_01_152408_create_pengguna_table', 1),
(5, '2025_12_01_152441_create_pesanan_table', 1),
(6, '2025_12_01_152452_create_pesanan_pengguna_table', 1),
(7, '2025_12_01_152502_create_progres_table', 1),
(8, '2025_12_01_152512_create_bahan_table', 1),
(9, '2025_12_01_152524_create_pemakaian_bahan_table', 1),
(10, '2025_12_01_152538_create_katalog_table', 1),
(11, '2025_12_02_164714_add_harga_to_katalog_table', 2),
(12, '2025_12_16_060831_add_remember_token_to_pengguna_table', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemakaian_bahan`
--

CREATE TABLE `pemakaian_bahan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pesanan_id` bigint(20) UNSIGNED NOT NULL,
  `bahan_id` bigint(20) UNSIGNED NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tanggal_pakai` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pemakaian_bahan`
--

INSERT INTO `pemakaian_bahan` (`id`, `pesanan_id`, `bahan_id`, `jumlah`, `tanggal_pakai`, `created_at`, `updated_at`) VALUES
(5, 8, 3, 10, '2025-12-13 08:50:31', '2025-12-13 01:50:31', '2025-12-13 01:50:31'),
(6, 8, 4, 2, '2025-12-13 08:50:31', '2025-12-13 01:50:31', '2025-12-13 01:50:31'),
(7, 8, 3, 1, '2025-12-13 09:10:42', '2025-12-13 02:10:42', '2025-12-13 02:10:42'),
(8, 8, 4, 1, '2025-12-13 09:10:42', '2025-12-13 02:10:42', '2025-12-13 02:10:42'),
(9, 8, 3, 1, '2025-12-13 09:17:06', '2025-12-13 02:17:06', '2025-12-13 02:17:06'),
(10, 8, 4, 1, '2025-12-13 09:17:06', '2025-12-13 02:17:06', '2025-12-13 02:17:06'),
(11, 9, 5, 1, '2025-12-16 13:13:13', '2025-12-16 06:13:13', '2025-12-16 06:13:13'),
(13, 9, 7, 4, '2025-12-16 13:13:13', '2025-12-16 06:13:13', '2025-12-16 06:13:13'),
(14, 9, 8, 4, '2025-12-16 13:13:13', '2025-12-16 06:13:13', '2025-12-16 06:13:13'),
(15, 9, 9, 2, '2025-12-16 13:13:13', '2025-12-16 06:13:13', '2025-12-16 06:13:13'),
(16, 9, 10, 2, '2025-12-16 13:13:13', '2025-12-16 06:13:13', '2025-12-16 06:13:13'),
(17, 9, 11, 2, '2025-12-16 13:13:13', '2025-12-16 06:13:13', '2025-12-16 06:13:13'),
(18, 9, 12, 2, '2025-12-16 13:13:13', '2025-12-16 06:13:13', '2025-12-16 06:13:13'),
(19, 9, 13, 2, '2025-12-16 13:13:13', '2025-12-16 06:13:13', '2025-12-16 06:13:13'),
(20, 9, 14, 2, '2025-12-16 13:13:13', '2025-12-16 06:13:13', '2025-12-16 06:13:13'),
(21, 10, 3, 1, '2025-12-17 04:33:11', '2025-12-16 21:33:11', '2025-12-16 21:33:11'),
(22, 10, 8, 5, '2025-12-17 04:33:11', '2025-12-16 21:33:11', '2025-12-16 21:33:11'),
(23, 10, 10, 5, '2025-12-17 04:33:11', '2025-12-16 21:33:11', '2025-12-16 21:33:11'),
(24, 10, 11, 5, '2025-12-17 04:33:11', '2025-12-16 21:33:11', '2025-12-16 21:33:11'),
(25, 10, 12, 2, '2025-12-17 04:33:11', '2025-12-16 21:33:11', '2025-12-16 21:33:11'),
(26, 10, 13, 3, '2025-12-17 04:33:11', '2025-12-16 21:33:11', '2025-12-16 21:33:11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE `pengguna` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `kata_sandi` varchar(255) NOT NULL,
  `telepon` varchar(255) DEFAULT NULL,
  `peran` enum('admin','customer') NOT NULL DEFAULT 'customer',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`id`, `nama`, `email`, `kata_sandi`, `telepon`, `peran`, `created_at`, `updated_at`, `remember_token`) VALUES
(1, 'Maghfirotus Zahwa', 'wawa@gmail.com', '$2y$12$TrFIMHdfiU/swcUfvRX6cOVfBTUv7JcQw1/uv5PMQvdx/pwCkurwS', '085646712902', 'admin', '2025-12-15 23:04:59', '2025-12-15 23:04:59', NULL),
(2, 'wawa', 'w@gmail.com', '$2y$12$1oyIhd4.M7GzP.fWBs9mS..pkoMSPv5FXcabQBy7dHbGuaAfFdfJG', '0755537', 'customer', '2025-12-15 23:45:08', '2025-12-15 23:45:08', 'qvVeADxXrHW5p4NKxzGJOv0SOe8o3JMfkIdWA6hWWVd2cFONcMLU1m6JMP8O'),
(3, 'Firman Ramadhani', 'fir@gmail.com', '$2y$12$LFdyTn3WQU2lSD9nkrAiNeV2qx25NkYrTsB51WtqvTHaaghY9JF1a', '08563748263', 'customer', '2025-12-16 06:44:52', '2025-12-16 06:44:52', NULL),
(4, 'jillyanap', 'jill@gmail.com', '$2y$12$W5LYWUeb6dPGHtFXR0jsEukKYDjoTXkTYrOdRY790xnxKaoc/ZO4i', '081217898776', 'customer', '2025-12-16 18:29:52', '2025-12-16 18:29:52', NULL),
(5, 'Pinkan Mambo', 'pink@gmail.com', '$2y$12$r47M2GjXelDchW/kGboA6OXdujCqQUyIDjKbhlheykJHLyIFY18r6', '085636728364', 'customer', '2025-12-20 21:19:55', '2025-12-20 21:19:55', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesanan`
--

CREATE TABLE `pesanan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_pesanan` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `status` enum('Menunggu','Proses','Selesai') NOT NULL DEFAULT 'Menunggu',
  `tanggal_mulai` date DEFAULT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `kode_pesanan` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `biaya_jasa` int(11) DEFAULT 0,
  `total_biaya` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pesanan`
--

INSERT INTO `pesanan` (`id`, `nama_pesanan`, `deskripsi`, `status`, `tanggal_mulai`, `tanggal_selesai`, `kode_pesanan`, `created_at`, `updated_at`, `biaya_jasa`, `total_biaya`) VALUES
(8, 'upil', 'pp', 'Selesai', '2025-12-16', '2025-12-16', 'PSN-ARXQ7M', '2025-12-13 01:50:31', '2025-12-16 09:20:10', 9000000, 9121976),
(9, 'Pelet Extrunder', 'mesin', 'Proses', NULL, NULL, 'PSN-MII2TZ', '2025-12-16 06:13:13', '2025-12-16 06:25:08', 4000000, 5667898),
(10, 'Mesin giling', 'Mesin giling daging', 'Proses', '2025-12-17', '2025-12-20', 'PSN-3FQWZV', '2025-12-16 21:33:11', '2025-12-16 21:35:21', 1500000, 1850998);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesanan_pengguna`
--

CREATE TABLE `pesanan_pengguna` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pengguna_id` bigint(20) UNSIGNED NOT NULL,
  `pesanan_id` bigint(20) UNSIGNED NOT NULL,
  `tanggal_gabung` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pesanan_pengguna`
--

INSERT INTO `pesanan_pengguna` (`id`, `pengguna_id`, `pesanan_id`, `tanggal_gabung`, `created_at`, `updated_at`) VALUES
(1, 2, 8, '2025-12-16 08:50:59', '2025-12-16 01:50:59', '2025-12-16 01:50:59'),
(2, 3, 9, '2025-12-16 13:45:29', '2025-12-16 06:45:29', '2025-12-16 06:45:29'),
(3, 3, 8, '2025-12-16 14:56:27', '2025-12-16 07:56:27', '2025-12-16 07:56:27'),
(4, 2, 9, '2025-12-16 17:13:27', '2025-12-16 10:13:27', '2025-12-16 10:13:27'),
(5, 2, 10, '2025-12-17 04:34:35', '2025-12-16 21:34:35', '2025-12-16 21:34:35');

-- --------------------------------------------------------

--
-- Struktur dari tabel `progres`
--

CREATE TABLE `progres` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pesanan_id` bigint(20) UNSIGNED NOT NULL,
  `catatan` text DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `tahap_status` varchar(255) DEFAULT NULL,
  `tanggal_progres` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `progres`
--

INSERT INTO `progres` (`id`, `pesanan_id`, `catatan`, `foto`, `tahap_status`, `tanggal_progres`, `created_at`, `updated_at`) VALUES
(9, 8, 'ehe', NULL, 'Perancangan', '2025-12-13 09:17:44', '2025-12-13 02:17:44', '2025-12-13 02:17:44'),
(10, 9, 'ini masih merancang', 'NkWgSGjOXrSzp5qskX4JkiTf8J4HyEj44C6wLrHk.jpg', 'Perancangan', '2025-12-16 13:13:00', '2025-12-16 06:13:54', '2025-12-16 07:03:18'),
(11, 9, 'dalam perakitan', NULL, 'Perakitan', '2025-12-16 13:56:27', '2025-12-16 06:56:27', '2025-12-16 06:56:27'),
(12, 8, 'sudah', NULL, 'Finishing', '2025-12-16 15:37:00', '2025-12-16 08:37:22', '2025-12-16 08:37:22'),
(13, 10, 'Dalam pembuatan', 'D3dNfTtvZsAzoXrB8lOhbQqTMev3m4jKTgoHu6W3.jpg', 'Pengerjaan Komponen', '2025-12-17 04:35:00', '2025-12-16 21:36:23', '2025-12-16 21:36:23'),
(14, 10, 'Dalam perakitan', 'gvWb0qyigMyUdjb3Yt5lIe3STTYe14nmAni069JB.jpg', 'Perakitan', '2025-12-17 04:36:00', '2025-12-16 21:36:45', '2025-12-16 21:36:45');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('h0s2ndabgPqfZQrZWUmDvs7eSlhLrAoHvRR8xuv2', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiM1gwMGpxdHFXR014elF3ckM4TjZqS21nclRNOUk1VFFpNElJdUZnMCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MzoidXJsIjthOjE6e3M6ODoiaW50ZW5kZWQiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbiI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1765865458);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `bahan`
--
ALTER TABLE `bahan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `katalog`
--
ALTER TABLE `katalog`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `pemakaian_bahan`
--
ALTER TABLE `pemakaian_bahan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pemakaian_bahan_pesanan_id_foreign` (`pesanan_id`),
  ADD KEY `pemakaian_bahan_bahan_id_foreign` (`bahan_id`);

--
-- Indeks untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pengguna_email_unique` (`email`);

--
-- Indeks untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pesanan_kode_pesanan_unique` (`kode_pesanan`);

--
-- Indeks untuk tabel `pesanan_pengguna`
--
ALTER TABLE `pesanan_pengguna`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pesanan_pengguna_pengguna_id_foreign` (`pengguna_id`),
  ADD KEY `pesanan_pengguna_pesanan_id_foreign` (`pesanan_id`);

--
-- Indeks untuk tabel `progres`
--
ALTER TABLE `progres`
  ADD PRIMARY KEY (`id`),
  ADD KEY `progres_pesanan_id_foreign` (`pesanan_id`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `bahan`
--
ALTER TABLE `bahan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `katalog`
--
ALTER TABLE `katalog`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `pemakaian_bahan`
--
ALTER TABLE `pemakaian_bahan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `pesanan_pengguna`
--
ALTER TABLE `pesanan_pengguna`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `progres`
--
ALTER TABLE `progres`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `pemakaian_bahan`
--
ALTER TABLE `pemakaian_bahan`
  ADD CONSTRAINT `pemakaian_bahan_bahan_id_foreign` FOREIGN KEY (`bahan_id`) REFERENCES `bahan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pemakaian_bahan_pesanan_id_foreign` FOREIGN KEY (`pesanan_id`) REFERENCES `pesanan` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pesanan_pengguna`
--
ALTER TABLE `pesanan_pengguna`
  ADD CONSTRAINT `pesanan_pengguna_pengguna_id_foreign` FOREIGN KEY (`pengguna_id`) REFERENCES `pengguna` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pesanan_pengguna_pesanan_id_foreign` FOREIGN KEY (`pesanan_id`) REFERENCES `pesanan` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `progres`
--
ALTER TABLE `progres`
  ADD CONSTRAINT `progres_pesanan_id_foreign` FOREIGN KEY (`pesanan_id`) REFERENCES `pesanan` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
