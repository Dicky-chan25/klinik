-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Jan 2024 pada 10.57
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `klinik`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokters`
--

CREATE TABLE `dokters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `id_poli` int(11) NOT NULL,
  `telepon` varchar(255) NOT NULL,
  `jadwalpraktek` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `dokters`
--

INSERT INTO `dokters` (`id`, `nama`, `alamat`, `id_poli`, `telepon`, `jadwalpraktek`, `created_at`, `updated_at`) VALUES
(1, 'Dicky Sulaeman', 'Kp. Bonisari', 1, '634654364', '3', '2023-12-19 02:11:06', '2023-12-19 02:32:28'),
(2, 'Chan', 'Kp. Bonisari', 3, '86754754', '2', '2023-12-19 02:11:25', '2023-12-22 09:14:46'),
(4, 'Sulaeman', 'rththth', 4, '8657567567', '5', '2023-12-22 01:30:53', '2023-12-22 01:30:53'),
(5, 'Danu', 'vncfnfn', 5, '567457', '4', '2023-12-22 09:15:11', '2023-12-22 09:15:11'),
(6, 'Gilang', 'fgf gn', 7, '865756868678', '6', '2023-12-22 09:15:47', '2023-12-22 09:15:47');

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
-- Struktur dari tabel `jadwals`
--

CREATE TABLE `jadwals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jadwalpraktek` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `jadwals`
--

INSERT INTO `jadwals` (`id`, `jadwalpraktek`, `created_at`, `updated_at`) VALUES
(2, 'SENIN', '2023-12-18 20:06:45', '2023-12-18 20:06:45'),
(3, 'SELASA', '2023-12-18 21:16:57', '2023-12-18 21:16:57'),
(4, 'RABU', '2023-12-18 21:17:03', '2023-12-18 21:17:03'),
(5, 'JUM\'AT', '2023-12-22 01:30:18', '2023-12-22 01:30:18'),
(6, 'KAMIS', '2023-12-22 09:13:05', '2023-12-22 09:13:05'),
(7, 'SABTU', '2023-12-22 09:13:13', '2023-12-22 09:13:13'),
(8, 'MINGGU', '2023-12-22 09:13:20', '2023-12-22 09:13:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis`
--

CREATE TABLE `jenis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jenisobat` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `jenis`
--

INSERT INTO `jenis` (`id`, `jenisobat`, `created_at`, `updated_at`) VALUES
(1, 'Analgesik', '2023-12-14 23:45:17', '2023-12-14 23:45:17'),
(2, 'Antasida', '2023-12-14 23:45:36', '2023-12-14 23:45:36'),
(3, 'Anticemas', '2023-12-14 23:46:00', '2023-12-14 23:46:00'),
(4, 'Anti-aritmia', '2023-12-14 23:46:15', '2023-12-14 23:46:15'),
(5, 'Antibiotik', '2023-12-14 23:46:30', '2023-12-14 23:46:30'),
(6, 'Antikoagulan', '2023-12-14 23:46:45', '2023-12-14 23:46:45'),
(7, 'trombolitik', '2023-12-14 23:46:56', '2023-12-14 23:46:56'),
(8, 'Antikonvulsan', '2023-12-14 23:47:07', '2023-12-14 23:47:07'),
(9, 'Antidepresan', '2023-12-14 23:47:24', '2023-12-14 23:47:24'),
(10, 'Antidiare', '2023-12-14 23:47:39', '2023-12-14 23:47:39'),
(11, 'Anti-emetik', '2023-12-14 23:47:50', '2023-12-14 23:47:50'),
(12, 'Antijamur', '2023-12-14 23:48:02', '2023-12-14 23:48:02'),
(13, 'Antihistamin', '2023-12-14 23:48:16', '2023-12-14 23:48:16'),
(14, 'Antihipertensi', '2023-12-14 23:48:25', '2023-12-14 23:48:25'),
(15, 'Anti-inflamasi', '2023-12-14 23:48:36', '2023-12-14 23:48:36'),
(16, 'Antineoplastik', '2023-12-14 23:48:50', '2023-12-14 23:48:50'),
(17, 'Antipsikotik', '2023-12-14 23:49:03', '2023-12-14 23:49:03');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_12_06_043254_create_roles_table', 1),
(6, '2023_12_07_103955_create_pasiens_table', 1),
(7, '2023_12_08_013905_create_dokters_table', 1),
(8, '2023_12_08_014402_create_rekams_table', 1),
(9, '2023_12_08_014430_create_obats_table', 1),
(10, '2023_12_08_014451_create_jadwals_table', 1),
(11, '2023_12_08_014859_create_polis_table', 1),
(12, '2023_12_08_015007_create_jenis_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `obats`
--

CREATE TABLE `obats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `kodeobat` varchar(255) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  `id_jenis` int(11) DEFAULT NULL,
  `namaobat` varchar(255) NOT NULL,
  `dosis` varchar(255) DEFAULT NULL,
  `harga` varchar(255) DEFAULT NULL,
  `expired` date DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `obats`
--

INSERT INTO `obats` (`id`, `created_at`, `updated_at`, `kodeobat`, `stok`, `id_jenis`, `namaobat`, `dosis`, `harga`, `expired`, `image`) VALUES
(1, '2023-12-24 09:18:50', '2024-01-05 08:57:41', '001', 11, NULL, 'Panadol', '3', '20.000', '2023-12-29', NULL),
(2, '2023-12-24 09:18:42', '2024-01-05 09:40:56', '002', 22, NULL, 'oskadon', '2', '20.000', '2023-12-21', 'ktp new.jpg'),
(9, '2023-12-24 09:17:43', '2023-12-24 09:45:48', '003', 28, NULL, 'Abacavir', '0.5', '15000', '2024-04-25', 'C:\\xampp\\tmp\\php34AE.tmp'),
(10, '2023-12-24 09:18:30', '2023-12-24 09:18:30', '004', 14, 5, 'Abrocitinib', '1', '5000', '2024-04-25', 'C:\\xampp\\tmp\\phpF9BA.tmp');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pasiens`
--

CREATE TABLE `pasiens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kodepasien` varchar(255) DEFAULT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `lahir` date NOT NULL,
  `nik` varchar(255) DEFAULT NULL,
  `kelamin` varchar(255) NOT NULL,
  `telepon` varchar(255) NOT NULL,
  `agama` varchar(255) NOT NULL,
  `pendidikan` varchar(255) DEFAULT NULL,
  `pekerjaan` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pasiens`
--

INSERT INTO `pasiens` (`id`, `kodepasien`, `nama`, `alamat`, `lahir`, `nik`, `kelamin`, `telepon`, `agama`, `pendidikan`, `pekerjaan`, `created_at`, `updated_at`) VALUES
(1, '061223061223', 'Dicky Sulaeman', 'Kp. Bonisari', '2023-12-06', '46465465465656', 'perempuan', '8657567567', 'islam', 'slta/sma', 'hfghfghgh', '2023-12-21 19:37:04', '2024-01-05 09:40:56'),
(2, '100608', 'Chan', 'rththth', '2008-06-10', '686586586767', 'laki-laki', '865756868678', 'islam', 'sarjana', 'gfgjf', '2023-12-21 19:46:03', '2023-12-21 19:46:03'),
(3, '101223', 'Danu', 'Kp. Bonisari', '2023-12-10', '686586586767', 'laki-laki', '545y5y', 'hindu', 'slta/sma', 'hfghfghgh', '2023-12-22 21:35:26', '2023-12-22 21:35:26'),
(4, '121223', 'Inka', 'Kp. Bonisari', '2023-12-12', '45654656', 'perempuan', '67575676', 'hindu', 'sarjana', 'TRTYTY', '2023-12-23 07:36:24', '2023-12-23 07:36:24'),
(5, '201223', 'Angga', 'Kp. Nagrak', '2023-12-20', '35345454', 'laki-laki', '67575676', 'katolik', 'sltp/sd-smp', 'guru', '2023-12-24 09:10:19', '2023-12-24 09:10:19'),
(6, '030124030124', 'Badrudin', 'Kp. Tegal Kunir', '2024-01-03', '2334353546868547', 'perempuan', '0837758588543', 'islam', 'sarjana', 'PNS', '2024-01-03 10:03:48', '2024-01-05 08:57:09'),
(7, '050124', 'Ikbal', 'Kp. Dadap', '2024-01-05', '546546', 'laki-laki', '0837758588543', 'islam', 'sltp/sd-smp', 'gfgjf', '2024-01-05 09:16:14', '2024-01-05 09:16:14'),
(8, '050124', 'Budi', 'Cituis', '2024-01-05', '46465465465656', 'perempuan', '67575676', 'islam', 'sarjana', 'hfghfghgh', '2024-01-05 09:22:56', '2024-01-05 09:22:56'),
(9, '050603', 'Bunga', 'cadas', '2003-06-05', '68658658', 'perempuan', '0837758588543', 'hindu', 'sarjana', 'gfngngfn', '2024-01-05 09:24:41', '2024-01-05 09:24:41'),
(10, '060788', 'Siti', 'kota bumi', '1988-07-06', '45654656', 'perempuan', '0837758588543', 'islam', 'sarjana', 'hfghfghgh', '2024-01-05 09:27:33', '2024-01-05 09:27:33');

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
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

-- --------------------------------------------------------

--
-- Struktur dari tabel `polis`
--

CREATE TABLE `polis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `polis`
--

INSERT INTO `polis` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'ANAK', '2023-12-18 20:52:12', '2023-12-18 21:09:44'),
(3, 'KANDUNGAN', '2023-12-18 21:16:36', '2023-12-18 21:16:36'),
(4, 'MATA', '2023-12-18 21:16:46', '2023-12-18 21:16:46'),
(5, 'SARAF', '2023-12-22 09:13:35', '2023-12-22 09:13:35'),
(6, 'PENYAKIT DALAM', '2023-12-22 09:13:50', '2023-12-22 09:13:50'),
(7, 'GIGI', '2023-12-22 09:14:03', '2023-12-22 09:14:03'),
(8, 'THT', '2023-12-22 09:14:08', '2023-12-22 09:14:08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekams`
--

CREATE TABLE `rekams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_pasien` int(11) NOT NULL,
  `nomorantrian` varchar(255) NOT NULL,
  `tanggalperiksa` date DEFAULT NULL,
  `layanan` varchar(255) NOT NULL,
  `keluhan` varchar(255) NOT NULL,
  `id_dokter` int(11) NOT NULL,
  `diagnosa` varchar(255) DEFAULT NULL,
  `id_obat` int(11) DEFAULT NULL,
  `jumlahobat` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `rawat` varchar(255) DEFAULT NULL,
  `lamabaru` varchar(255) DEFAULT NULL,
  `darah` varchar(255) DEFAULT NULL,
  `tinggi` varchar(255) DEFAULT NULL,
  `berat` varchar(255) DEFAULT NULL,
  `pinggang` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `rekams`
--

INSERT INTO `rekams` (`id`, `created_at`, `updated_at`, `id_pasien`, `nomorantrian`, `tanggalperiksa`, `layanan`, `keluhan`, `id_dokter`, `diagnosa`, `id_obat`, `jumlahobat`, `keterangan`, `rawat`, `lamabaru`, `darah`, `tinggi`, `berat`, `pinggang`) VALUES
(3, '2023-12-22 03:08:23', '2024-01-03 09:34:43', 1, '0', NULL, 'Umum', 'dfbfbfdsbfdb', 6, 'fbddfb', 10, '2', 'fbdfbfdb', 'R.Jalan', NULL, 'A+', '166', '65', '80'),
(8, '2023-12-23 09:48:01', '2023-12-23 09:48:01', 2, '0', NULL, 'Umum', 'egsg', 2, 'egege', 1, '5', 'hdfgdfg', NULL, NULL, NULL, NULL, NULL, NULL),
(10, '2023-12-24 09:45:48', '2023-12-24 09:46:14', 5, '0', NULL, 'Umum', 'diare', 6, 'Diare', 10, '2', 'biasa', 'R.Jalan', NULL, 'A+', '155', '55', '80'),
(11, '2024-01-03 10:03:48', '2024-01-05 08:53:23', 6, '0', NULL, 'Asuransi', 'Demam', 5, 'Demam', 2, '4', 'normal', 'R.Jalan', 'Baru', 'AB+', NULL, '65', '100'),
(12, '2024-01-05 08:57:41', '2024-01-05 08:57:41', 6, '0', NULL, 'Asuransi', 'sakit gigi', 4, 'sakit gigi', 1, '2', 'fefe', NULL, NULL, NULL, NULL, NULL, NULL),
(15, '2024-01-05 09:13:31', '2024-01-05 09:40:56', 1, '0', NULL, 'Umum', 'demam', 4, 'Demam', 2, '3', 'fbdfbfdb', 'R.Jalan', 'Lama', 'A+', NULL, '70', '100'),
(16, '2024-01-05 09:16:15', '2024-01-05 09:16:15', 7, '004', NULL, 'Umum', 'fhfdhfh', 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, '2024-01-05 09:22:56', '2024-01-05 09:22:56', 8, '005', NULL, 'Umum', 'egrg', 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(18, '2024-01-05 09:24:41', '2024-01-05 09:24:41', 9, '006', NULL, 'Asuransi', 'wdwd', 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, '2024-01-05 09:27:33', '2024-01-05 09:27:33', 10, '007', NULL, 'Umum', 'shh', 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(20, '2024-01-05 09:28:32', '2024-01-05 09:28:32', 5, '008', NULL, 'Umum', 'rgre', 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id`, `role_name`, `created_at`, `updated_at`) VALUES
(1, 'superadmin', '2023-12-14 23:42:49', '2023-12-14 23:42:49'),
(2, 'admin', '2023-12-14 23:42:49', '2023-12-14 23:42:49'),
(3, 'apotek', '2023-12-14 23:42:49', '2023-12-14 23:42:49');

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
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Prof. Destiny Abbott', 'wendell08@example.com', '2023-12-14 23:42:49', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 2, '7efyQNJ0IyKrC0F9B8RgEBkn8XDdZVIYdkeYtr6ExtbNcMVxYhC4Sua1Irjl', '2023-12-14 23:42:49', '2023-12-14 23:42:49'),
(2, 'Monte Connelly III', 'fritsch.rosina@example.org', '2023-12-14 23:42:49', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 3, '0QPVXksbeKoQZwNnsYPNJqRItJe8UnoWHQDxrsaBRASaMjBvm3Y6bdAmuLDJ', '2023-12-14 23:42:49', '2023-12-14 23:42:49'),
(3, 'Delores Runte', 'altenwerth.liliana@example.org', '2023-12-14 23:42:49', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 3, 'QloyFq8gjN', '2023-12-14 23:42:49', '2023-12-14 23:42:49'),
(4, 'Larry Jacobson', 'gmurazik@example.org', '2023-12-14 23:42:49', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 3, 'PXIgrkv2L9', '2023-12-14 23:42:49', '2023-12-14 23:42:49'),
(5, 'Stuart McDermott', 'harley09@example.com', '2023-12-14 23:42:49', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 'JN9E6JiTn5qHrOhpiJdJawnFhkexCR0NUqhUZtCHq99eIB5OqAwMQQY3wnf9', '2023-12-14 23:42:49', '2023-12-14 23:42:49'),
(6, 'Vance Schinner', 'nfeest@example.net', '2023-12-14 23:42:49', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 2, '25cvLCjRZ4', '2023-12-14 23:42:49', '2023-12-14 23:42:49'),
(7, 'Montana Marquardt', 'nestor69@example.com', '2023-12-14 23:42:49', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 'BCzd7NJ7hX5VbxjxGEfzPLoWAMOuGM59UJkQ2R3iTD3MISEqe38DdoQ3PItu', '2023-12-14 23:42:50', '2023-12-14 23:42:50'),
(8, 'Prof. Maximillia Balistreri', 'elmore03@example.com', '2023-12-14 23:42:49', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 2, 'o4E4uOR51k7Qggr4WEoJpe9de70dVSEqjpH2X64jqXwNIsN0gwpQF0EUxXDL', '2023-12-14 23:42:50', '2023-12-14 23:42:50'),
(9, 'Fabian Wuckert', 'ofelia.herman@example.org', '2023-12-14 23:42:49', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 'cmKwjaJI45PzcKKuDU42AhDzVxrlT0PX67012FVGHEPltyGZ9d5jz4BI31gV', '2023-12-14 23:42:50', '2023-12-14 23:42:50'),
(10, 'Miss Kattie McCullough IV', 'terry.haag@example.org', '2023-12-14 23:42:49', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 3, '21mhLIk5OF', '2023-12-14 23:42:50', '2023-12-14 23:42:50');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `dokters`
--
ALTER TABLE `dokters`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jadwals`
--
ALTER TABLE `jadwals`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jenis`
--
ALTER TABLE `jenis`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `obats`
--
ALTER TABLE `obats`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pasiens`
--
ALTER TABLE `pasiens`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `polis`
--
ALTER TABLE `polis`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `rekams`
--
ALTER TABLE `rekams`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_role_name_unique` (`role_name`);

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
-- AUTO_INCREMENT untuk tabel `dokters`
--
ALTER TABLE `dokters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jadwals`
--
ALTER TABLE `jadwals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `jenis`
--
ALTER TABLE `jenis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `obats`
--
ALTER TABLE `obats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `pasiens`
--
ALTER TABLE `pasiens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `polis`
--
ALTER TABLE `polis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `rekams`
--
ALTER TABLE `rekams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
