-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.4.3 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for sistem-pbl-mahasiswa


-- Dumping structure for table sistem-pbl-mahasiswa.bobot
CREATE TABLE IF NOT EXISTS `bobot` (
  `id_bobot` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kriteria` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bobot` decimal(10,2) DEFAULT NULL,
  `tipe` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_bobot`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sistem-pbl-mahasiswa.bobot: ~6 rows (approximately)
INSERT INTO `bobot` (`id_bobot`, `kriteria`, `bobot`, `tipe`, `created_at`, `updated_at`) VALUES
	(1, 'IOT', 0.14, 'B', NULL, NULL),
	(2, 'Keamanan Data', 0.14, 'B', NULL, NULL),
	(3, 'Web Lanjut', 0.14, 'B', NULL, NULL),
	(4, 'IT Project', 0.14, 'B', NULL, NULL),
	(5, 'Partisipasi', 0.14, 'B', NULL, NULL),
	(6, 'Hasil Proyek', 0.14, 'B', NULL, NULL);

-- Dumping structure for table sistem-pbl-mahasiswa.detail_matkul_dosen
CREATE TABLE IF NOT EXISTS `detail_matkul_dosen` (
  `id_detail_matkul_dosen` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_user` bigint unsigned NOT NULL,
  `id_matkul` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_detail_matkul_dosen`),
  KEY `detail_matkul_dosen_id_user_foreign` (`id_user`),
  KEY `detail_matkul_dosen_id_matkul_foreign` (`id_matkul`),
  CONSTRAINT `detail_matkul_dosen_id_matkul_foreign` FOREIGN KEY (`id_matkul`) REFERENCES `matkul` (`id_matkul`) ON DELETE CASCADE,
  CONSTRAINT `detail_matkul_dosen_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sistem-pbl-mahasiswa.detail_matkul_dosen: ~0 rows (approximately)

-- Dumping structure for table sistem-pbl-mahasiswa.kelompok
CREATE TABLE IF NOT EXISTS `kelompok` (
  `id_kelompok` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama_kelompok` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_kelompok`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sistem-pbl-mahasiswa.kelompok: ~1 rows (approximately)
INSERT INTO `kelompok` (`id_kelompok`, `nama_kelompok`, `created_at`, `updated_at`) VALUES
	(1, 'TI 3C - 5', NULL, NULL);

-- Dumping structure for table sistem-pbl-mahasiswa.mahasiswa
CREATE TABLE IF NOT EXISTS `mahasiswa` (
  `id_mahasiswa` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nim` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_kelompok` bigint unsigned NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_mahasiswa`),
  KEY `mahasiswa_id_kelompok_foreign` (`id_kelompok`),
  CONSTRAINT `mahasiswa_id_kelompok_foreign` FOREIGN KEY (`id_kelompok`) REFERENCES `kelompok` (`id_kelompok`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sistem-pbl-mahasiswa.mahasiswa: ~3 rows (approximately)
INSERT INTO `mahasiswa` (`id_mahasiswa`, `nim`, `nama`, `kelas`, `id_kelompok`, `email`, `password`, `created_at`, `updated_at`) VALUES
	(1, '2401301111', 'hadir', 'TI-3C', 1, 'hadir@gmail.com', '$2y$12$cYaV1jExJST4z4GcD5OcTOm3QGFNPM17Qc2VGIwo0ksPMk2SQb8ma', NULL, NULL),
	(2, '2401301234', 'zidan', 'TI-3C', 1, 'zidan@gmail.com', '$2y$12$AOLx/QyMQLMgQSD3QKsSBu.AN6CMj0Dsqd13b4xdXjl8P2lnEWfpi', NULL, NULL),
	(3, '2401301235', 'rehan', 'TI-3C', 1, 'rehan@gmail.com', '$2y$12$a1CW8mPHNt0MfZi9nVNKCuP81GY6FS2dAjoCNzBLepbQhEuvw6Xpa', NULL, NULL),
	(4, '2401301236', 'adit', 'TI-3C', 1, 'adit@gmail.com', '$2y$12$a1CW8mPHNt0MfZi9nVNKCuP81GY6FS2dAjoCNzBLepbQhEuvw6Xpa', NULL, NULL),
	(5, '2401301237', 'supri', 'TI-3A', 1, 'supri@gmail.com', '$2y$12$a1CW8mPHNt0MfZi9nVNKCuP81GY6FS2dAjoCNzBLepbQhEuvw6Xpa', NULL, NULL),
	(6, '2401301238', 'rifki', 'TI-3A', 1, 'rifki@gmail.com', '$2y$12$a1CW8mPHNt0MfZi9nVNKCuP81GY6FS2dAjoCNzBLepbQhEuvw6Xpa', NULL, NULL),
	(7, '2401301239', 'riki', 'TI-3A', 1, 'riki@gmail.com', '$2y$12$a1CW8mPHNt0MfZi9nVNKCuP81GY6FS2dAjoCNzBLepbQhEuvw6Xpa', NULL, NULL),
	(8, '2401301231', 'andi', 'TI-3B', 1, 'andi@gmail.com', '$2y$12$a1CW8mPHNt0MfZi9nVNKCuP81GY6FS2dAjoCNzBLepbQhEuvw6Xpa', NULL, NULL),
	(9, '2401301232', 'citra', 'TI-3B', 1, 'citra@gmail.com', '$2y$12$a1CW8mPHNt0MfZi9nVNKCuP81GY6FS2dAjoCNzBLepbQhEuvw6Xpa', NULL, NULL),
	(10, '2401301233', 'nada', 'TI-3B', 1, 'nada@gmail.com', '$2y$12$a1CW8mPHNt0MfZi9nVNKCuP81GY6FS2dAjoCNzBLepbQhEuvw6Xpa', NULL, NULL),

-- Dumping structure for table sistem-pbl-mahasiswa.mahasiswa-terbaik
CREATE TABLE IF NOT EXISTS `mahasiswa-terbaik` (
  `id_mahasiswa_terbaik` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_mahasiswa` bigint unsigned NOT NULL,
  `iot` decimal(10,2) NOT NULL,
  `keamanan_data` decimal(10,2) NOT NULL,
  `web_lanjut` decimal(10,2) NOT NULL,
  `it_project` decimal(10,2) NOT NULL,
  `total_nilai` decimal(10,2) NOT NULL,
  `partisipasi` decimal(10,2) NOT NULL,
  `hasil_proyek` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_mahasiswa_terbaik`),
  KEY `mahasiswa_terbaik_id_mahasiswa_foreign` (`id_mahasiswa`),
  CONSTRAINT `mahasiswa_terbaik_id_mahasiswa_foreign` FOREIGN KEY (`id_mahasiswa`) REFERENCES `mahasiswa` (`id_mahasiswa`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sistem-pbl-mahasiswa.mahasiswa-terbaik: ~0 rows (approximately)

-- Dumping structure for table sistem-pbl-mahasiswa.matkul
CREATE TABLE IF NOT EXISTS `matkul` (
  `id_matkul` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama_matkul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_matkul`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sistem-pbl-mahasiswa.matkul: ~4 rows (approximately)
INSERT INTO `matkul` (`id_matkul`, `nama_matkul`) VALUES
	(1, 'iot'),
	(2, 'keamanan_data'),
	(3, 'web_lanjut'),
	(4, 'it_project');

-- Dumping structure for table sistem-pbl-mahasiswa.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sistem-pbl-mahasiswa.migrations: ~14 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2025_10_04_150013_create_sessions_table', 1),
	(2, '2025_10_05_13410_kelompok', 1),
	(3, '2025_10_05_141044_matkul', 1),
	(4, '2025_10_06_134110_create_mahasiswa_table', 1),
	(5, '2025_10_06_134112_create_nilai_mahasiswa_table', 1),
	(6, '2025_10_31_140327_user', 1),
	(7, '2025_10_31_140719_nilai_kelompok', 1),
	(8, '2025_10_31_141229_peringkat_mahasiswa', 1),
	(9, '2025_10_31_141621_peringkat_kelompok', 1),
	(10, '2025_10_31_141844_profil', 1),
	(11, '2025_10_31_142240_id_detail_matkul_dosen', 1),
	(12, '2025_11_02_073020_craete_table_bobot', 1),
	(13, '2025_11_02_075009_mahasiswa_terbaik', 1),
	(14, '2025_11_12_134536_tenggat_penilaian', 1);

-- Dumping structure for table sistem-pbl-mahasiswa.nilai_kelompok
CREATE TABLE IF NOT EXISTS `nilai_kelompok` (
  `id_nilai_kelompok` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_kelompok` bigint unsigned NOT NULL,
  `id_matkul` bigint unsigned NOT NULL,
  `id_user` bigint unsigned DEFAULT NULL,
  `nilai_tugas` decimal(10,2) NOT NULL,
  `nilai_project` decimal(10,2) NOT NULL,
  `nilai_presentasi` decimal(10,2) NOT NULL,
  `nilai_kehadiran` decimal(10,2) NOT NULL,
  `total_nilai` decimal(10,2) NOT NULL,
  `Pertemuan` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_nilai_kelompok`),
  KEY `nilai_kelompok_id_kelompok_foreign` (`id_kelompok`),
  KEY `nilai_kelompok_id_matkul_foreign` (`id_matkul`),
  CONSTRAINT `nilai_kelompok_id_kelompok_foreign` FOREIGN KEY (`id_kelompok`) REFERENCES `kelompok` (`id_kelompok`) ON DELETE CASCADE,
  CONSTRAINT `nilai_kelompok_id_matkul_foreign` FOREIGN KEY (`id_matkul`) REFERENCES `matkul` (`id_matkul`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sistem-pbl-mahasiswa.nilai_kelompok: ~3 rows (approximately)
INSERT INTO `nilai_kelompok` (`id_nilai_kelompok`, `id_kelompok`, `id_matkul`, `id_user`, `nilai_tugas`, `nilai_project`, `nilai_presentasi`, `nilai_kehadiran`, `total_nilai`, `Pertemuan`, `created_at`, `updated_at`) VALUES
	(5, 1, 1, NULL, 19.00, 25.00, 30.00, 15.00, 22.00, NULL, NULL, NULL),
	(6, 1, 2, NULL, 20.00, 24.00, 30.00, 15.00, 22.00, NULL, NULL, NULL),
	(7, 1, 3, NULL, 20.00, 25.00, 29.00, 15.00, 22.00, NULL, NULL, NULL);

-- Dumping structure for table sistem-pbl-mahasiswa.nilai_mahasiswa
CREATE TABLE IF NOT EXISTS `nilai_mahasiswa` (
  `id_nilai_mahasiswa` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_mahasiswa` bigint unsigned NOT NULL,
  `id_matkul` bigint unsigned NOT NULL,
  `id_user` bigint unsigned DEFAULT NULL,
  `nilai_tugas` decimal(10,2) NOT NULL,
  `nilai_project` decimal(10,2) NOT NULL,
  `nilai_presentasi` decimal(10,2) NOT NULL,
  `nilai_kehadiran` decimal(10,2) NOT NULL,
  `total_nilai` decimal(10,2) NOT NULL,
  `Pertemuan` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_nilai_mahasiswa`),
  KEY `nilai_mahasiswa_id_mahasiswa_foreign` (`id_mahasiswa`),
  KEY `nilai_mahasiswa_id_matkul_foreign` (`id_matkul`),
  CONSTRAINT `nilai_mahasiswa_id_mahasiswa_foreign` FOREIGN KEY (`id_mahasiswa`) REFERENCES `mahasiswa` (`id_mahasiswa`) ON DELETE CASCADE,
  CONSTRAINT `nilai_mahasiswa_id_matkul_foreign` FOREIGN KEY (`id_matkul`) REFERENCES `matkul` (`id_matkul`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=193 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sistem-pbl-mahasiswa.nilai_mahasiswa: ~191 rows (approximately)
INSERT INTO `nilai_mahasiswa` (`id_nilai_mahasiswa`, `id_mahasiswa`, `id_matkul`, `id_user`, `nilai_tugas`, `nilai_project`, `nilai_presentasi`, `nilai_kehadiran`, `total_nilai`, `Pertemuan`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, 77.17, 74.33, 80.55, 80.55, 78.15, 1, NULL, NULL),
(2, 1, 1, NULL, 77.17, 74.33, 80.55, 80.55, 78.15, 2, NULL, NULL),
(3, 1, 1, NULL, 77.17, 74.33, 80.55, 80.55, 78.15, 3, NULL, NULL),
(4, 1, 1, NULL, 77.17, 74.33, 80.55, 80.55, 78.15, 4, NULL, NULL),

(5, 1, 2, NULL, 51.81, 74.33, 80.55, 80.55, 56.81, 1, NULL, NULL),
(6, 1, 2, NULL, 51.81, 74.33, 80.55, 80.55, 56.81, 2, NULL, NULL),
(7, 1, 2, NULL, 51.81, 74.33, 80.55, 80.55, 56.81, 3, NULL, NULL),
(8, 1, 2, NULL, 51.81, 74.33, 80.55, 80.55, 56.81, 4, NULL, NULL),

(9, 1, 3, NULL, 63.37, 74.33, 80.55, 80.55, 74.70, 1, NULL, NULL),
(10, 1, 3, NULL, 63.37, 74.33, 80.55, 80.55, 74.70, 2, NULL, NULL),
(11, 1, 3, NULL, 63.37, 74.33, 80.55, 80.55, 74.70, 3, NULL, NULL),
(12, 1, 3, NULL, 63.37, 74.33, 80.55, 80.55, 74.70, 4, NULL, NULL),

(13, 1, 4, NULL, 81.81, 74.33, 80.55, 80.55, 79.31, 1, NULL, NULL),
(14, 1, 4, NULL, 81.81, 74.33, 80.55, 80.55, 79.31, 2, NULL, NULL),
(15, 1, 4, NULL, 81.81, 74.33, 80.55, 80.55, 79.31, 3, NULL, NULL),
(16, 1, 4, NULL, 81.81, 74.33, 80.55, 80.55, 79.31, 4, NULL, NULL),

(17, 2, 1, NULL, 82.10, 78.90, 84.20, 84.20, 81.55, 1, NULL, NULL),
(18, 2, 1, NULL, 82.10, 78.90, 84.20, 84.20, 81.55, 2, NULL, NULL),
(19, 2, 1, NULL, 82.10, 78.90, 84.20, 84.20, 81.55, 3, NULL, NULL),
(20, 2, 1, NULL, 82.10, 78.90, 84.20, 84.20, 81.55, 4, NULL, NULL),

(21, 2, 2, NULL, 74.40, 75.10, 78.20, 78.20, 76.22, 1, NULL, NULL),
(22, 2, 2, NULL, 74.40, 75.10, 78.20, 78.20, 76.22, 2, NULL, NULL),
(23, 2, 2, NULL, 74.40, 75.10, 78.20, 78.20, 76.22, 3, NULL, NULL),
(24, 2, 2, NULL, 74.40, 75.10, 78.20, 78.20, 76.22, 4, NULL, NULL),

(25, 2, 3, NULL, 79.80, 78.60, 82.20, 82.20, 80.40, 1, NULL, NULL),
(26, 2, 3, NULL, 79.80, 78.60, 82.20, 82.20, 80.40, 2, NULL, NULL),
(27, 2, 3, NULL, 79.80, 78.60, 82.20, 82.20, 80.40, 3, NULL, NULL),
(28, 2, 3, NULL, 79.80, 78.60, 82.20, 82.20, 80.40, 4, NULL, NULL),

(29, 2, 4, NULL, 80.10, 77.80, 80.70, 80.70, 79.27, 1, NULL, NULL),
(30, 2, 4, NULL, 80.10, 77.80, 80.70, 80.70, 79.27, 2, NULL, NULL),
(31, 2, 4, NULL, 80.10, 77.80, 80.70, 80.70, 79.27, 3, NULL, NULL),
(32, 2, 4, NULL, 80.10, 77.80, 80.70, 80.70, 79.27, 4, NULL, NULL),

(33,3,1,NULL,85.20,83.10,86.80,86.80,84.65,1,NULL,NULL),
(34,3,1,NULL,85.20,83.10,86.80,86.80,84.65,2,NULL,NULL),
(35,3,1,NULL,85.20,83.10,86.80,86.80,84.65,3,NULL,NULL),
(36,3,1,NULL,85.20,83.10,86.80,86.80,84.65,4,NULL,NULL),

(37,3,2,NULL,83.90,84.00,84.90,84.90,84.40,1,NULL,NULL),
(38,3,2,NULL,83.90,84.00,84.90,84.90,84.40,2,NULL,NULL),
(39,3,2,NULL,83.90,84.00,84.90,84.90,84.40,3,NULL,NULL),
(40,3,2,NULL,83.90,84.00,84.90,84.90,84.40,4,NULL,NULL),

(41,3,3,NULL,70.10,72.80,72.90,72.90,71.48,1,NULL,NULL),
(42,3,3,NULL,70.10,72.80,72.90,72.90,71.48,2,NULL,NULL),
(43,3,3,NULL,70.10,72.80,72.90,72.90,71.48,3,NULL,NULL),
(44,3,3,NULL,70.10,72.80,72.90,72.90,71.48,4,NULL,NULL),

(45,3,4,NULL,82.40,80.60,81.80,81.80,81.00,1,NULL,NULL),
(46,3,4,NULL,82.40,80.60,81.80,81.80,81.00,2,NULL,NULL),
(47,3,4,NULL,82.40,80.60,81.80,81.80,81.00,3,NULL,NULL),
(48,3,4,NULL,82.40,80.60,81.80,81.80,81.00,4,NULL,NULL),

(49,4,1,NULL,78.60,77.20,79.40,79.40,78.40,1,NULL,NULL),
(50,4,1,NULL,78.60,77.20,79.40,79.40,78.40,2,NULL,NULL),
(51,4,1,NULL,78.60,77.20,79.40,79.40,78.40,3,NULL,NULL),
(52,4,1,NULL,78.60,77.20,79.40,79.40,78.40,4,NULL,NULL),

(53,4,2,NULL,75.40,76.10,76.40,76.40,75.99,1,NULL,NULL),
(54,4,2,NULL,75.40,76.10,76.40,76.40,75.99,2,NULL,NULL),
(55,4,2,NULL,75.40,76.10,76.40,76.40,75.99,3,NULL,NULL),
(56,4,2,NULL,75.40,76.10,76.40,76.40,75.99,4,NULL,NULL),

(57,4,3,NULL,80.40,80.80,80.80,80.80,80.66,1,NULL,NULL),
(58,4,3,NULL,80.40,80.80,80.80,80.80,80.66,2,NULL,NULL),
(59,4,3,NULL,80.40,80.80,80.80,80.80,80.66,3,NULL,NULL),
(60,4,3,NULL,80.40,80.80,80.80,80.80,80.66,4,NULL,NULL),

(61,4,4,NULL,78.60,78.40,78.80,78.80,78.58,1,NULL,NULL),
(62,4,4,NULL,78.60,78.40,78.80,78.80,78.58,2,NULL,NULL),
(63,4,4,NULL,78.60,78.40,78.80,78.80,78.58,3,NULL,NULL),
(64,4,4,NULL,78.60,78.40,78.80,78.80,78.58,4,NULL,NULL),

(65,5,1,NULL,80.10,78.60,80.30,80.30,79.65,1,NULL,NULL),
(66,5,1,NULL,80.10,78.60,80.30,80.30,79.65,2,NULL,NULL),
(67,5,1,NULL,80.10,78.60,80.30,80.30,79.65,3,NULL,NULL),
(68,5,1,NULL,80.10,78.60,80.30,80.30,79.65,4,NULL,NULL),

(69,5,2,NULL,80.40,80.80,80.90,80.90,80.71,1,NULL,NULL),
(70,5,2,NULL,80.40,80.80,80.90,80.90,80.71,2,NULL,NULL),
(71,5,2,NULL,80.40,80.80,80.90,80.90,80.71,3,NULL,NULL),
(72,5,2,NULL,80.40,80.80,80.90,80.90,80.71,4,NULL,NULL),

(73,5,3,NULL,79.10,79.60,79.90,79.90,79.53,1,NULL,NULL),
(74,5,3,NULL,79.10,79.60,79.90,79.90,79.53,2,NULL,NULL),
(75,5,3,NULL,79.10,79.60,79.90,79.90,79.53,3,NULL,NULL),
(76,5,3,NULL,79.10,79.60,79.90,79.90,79.53,4,NULL,NULL),

(77,5,4,NULL,79.20,78.70,79.00,79.00,78.95,1,NULL,NULL),
(78,5,4,NULL,79.20,78.70,79.00,79.00,78.95,2,NULL,NULL),
(79,5,4,NULL,79.20,78.70,79.00,79.00,78.95,3,NULL,NULL),
(80,5,4,NULL,79.20,78.70,79.00,79.00,78.95,4,NULL,NULL),

(81,6,1,NULL,77.00,76.40,76.90,76.90,76.65,1,NULL,NULL),
(82,6,1,NULL,77.00,76.40,76.90,76.90,76.65,2,NULL,NULL),
(83,6,1,NULL,77.00,76.40,76.90,76.90,76.65,3,NULL,NULL),
(84,6,1,NULL,77.00,76.40,76.90,76.90,76.65,4,NULL,NULL),

(85,6,2,NULL,69.40,69.90,70.10,70.10,69.80,1,NULL,NULL),
(86,6,2,NULL,69.40,69.90,70.10,70.10,69.80,2,NULL,NULL),
(87,6,2,NULL,69.40,69.90,70.10,70.10,69.80,3,NULL,NULL),
(88,6,2,NULL,69.40,69.90,70.10,70.10,69.80,4,NULL,NULL),

(89,6,3,NULL,75.60,75.90,75.90,75.90,75.82,1,NULL,NULL),
(90,6,3,NULL,75.60,75.90,75.90,75.90,75.82,2,NULL,NULL),
(91,6,3,NULL,75.60,75.90,75.90,75.90,75.82,3,NULL,NULL),
(92,6,3,NULL,75.60,75.90,75.90,75.90,75.82,4,NULL,NULL),

(93,6,4,NULL,78.60,78.40,78.80,78.80,78.58,1,NULL,NULL),
(94,6,4,NULL,78.60,78.40,78.80,78.80,78.58,2,NULL,NULL),
(95,6,4,NULL,78.60,78.40,78.80,78.80,78.58,3,NULL,NULL),
(96,6,4,NULL,78.60,78.40,78.80,78.80,78.58,4,NULL,NULL),

(97,7,1,NULL,81.20,80.90,81.20,81.20,81.15,1,NULL,NULL),
(98,7,1,NULL,81.20,80.90,81.20,81.20,81.15,2,NULL,NULL),
(99,7,1,NULL,81.20,80.90,81.20,81.20,81.15,3,NULL,NULL),
(100,7,1,NULL,81.20,80.90,81.20,81.20,81.15,4,NULL,NULL),

(101,7,2,NULL,81.40,81.60,81.60,81.60,81.51,1,NULL,NULL),
(102,7,2,NULL,81.40,81.60,81.60,81.60,81.51,2,NULL,NULL),
(103,7,2,NULL,81.40,81.60,81.60,81.60,81.51,3,NULL,NULL),
(104,7,2,NULL,81.40,81.60,81.60,81.60,81.51,4,NULL,NULL),

(105,7,3,NULL,77.10,77.40,77.20,77.20,77.21,1,NULL,NULL),
(106,7,3,NULL,77.10,77.40,77.20,77.20,77.21,2,NULL,NULL),
(107,7,3,NULL,77.10,77.40,77.20,77.20,77.21,3,NULL,NULL),
(108,7,3,NULL,77.10,77.40,77.20,77.20,77.21,4,NULL,NULL),

(109,7,4,NULL,31.00,30.80,30.90,30.90,30.98,1,NULL,NULL),
(110,7,4,NULL,31.00,30.80,30.90,30.90,30.98,2,NULL,NULL),
(111,7,4,NULL,31.00,30.80,30.90,30.90,30.98,3,NULL,NULL),
(112,7,4,NULL,31.00,30.80,30.90,30.90,30.98,4,NULL,NULL),

(113,8,1,NULL,76.70,76.50,76.80,76.80,76.65,1,NULL,NULL),
(114,8,1,NULL,76.70,76.50,76.80,76.80,76.65,2,NULL,NULL),
(115,8,1,NULL,76.70,76.50,76.80,76.80,76.65,3,NULL,NULL),
(116,8,1,NULL,76.70,76.50,76.80,76.80,76.65,4,NULL,NULL),

(117,8,2,NULL,76.50,76.70,76.70,76.70,76.62,1,NULL,NULL),
(118,8,2,NULL,76.50,76.70,76.70,76.70,76.62,2,NULL,NULL),
(119,8,2,NULL,76.50,76.70,76.70,76.70,76.62,3,NULL,NULL),
(120,8,2,NULL,76.50,76.70,76.70,76.70,76.62,4,NULL,NULL),

(121,8,3,NULL,74.20,74.50,74.30,74.30,74.33,1,NULL,NULL),
(122,8,3,NULL,74.20,74.50,74.30,74.30,74.33,2,NULL,NULL),
(123,8,3,NULL,74.20,74.50,74.30,74.30,74.33,3,NULL,NULL),
(124,8,3,NULL,74.20,74.50,74.30,74.30,74.33,4,NULL,NULL),

(125,8,4,NULL,75.70,75.40,75.60,75.60,75.52,1,NULL,NULL),
(126,8,4,NULL,75.70,75.40,75.60,75.60,75.52,2,NULL,NULL),
(127,8,4,NULL,75.70,75.40,75.60,75.60,75.52,3,NULL,NULL),
(128,8,4,NULL,75.70,75.40,75.60,75.60,75.52,4,NULL,NULL),

(129,9,1,NULL,78.50,78.30,78.40,78.40,78.40,1,NULL,NULL),
(130,9,1,NULL,78.50,78.30,78.40,78.40,78.40,2,NULL,NULL),
(131,9,1,NULL,78.50,78.30,78.40,78.40,78.40,3,NULL,NULL),
(132,9,1,NULL,78.50,78.30,78.40,78.40,78.40,4,NULL,NULL),

(133,9,2,NULL,78.60,78.80,78.60,78.60,78.66,1,NULL,NULL),
(134,9,2,NULL,78.60,78.80,78.60,78.60,78.66,2,NULL,NULL),
(135,9,2,NULL,78.60,78.80,78.60,78.60,78.66,3,NULL,NULL),
(136,9,2,NULL,78.60,78.80,78.60,78.60,78.66,4,NULL,NULL),

(137,9,3,NULL,73.50,73.80,73.60,73.60,73.59,1,NULL,NULL),
(138,9,3,NULL,73.50,73.80,73.60,73.60,73.59,2,NULL,NULL),
(139,9,3,NULL,73.50,73.80,73.60,73.60,73.59,3,NULL,NULL),
(140,9,3,NULL,73.50,73.80,73.60,73.60,73.59,4,NULL,NULL),

(141,9,4,NULL,79.50,79.30,79.40,79.40,79.42,1,NULL,NULL),
(142,9,4,NULL,79.50,79.30,79.40,79.40,79.42,2,NULL,NULL),
(143,9,4,NULL,79.50,79.30,79.40,79.40,79.42,3,NULL,NULL),
(144,9,4,NULL,79.50,79.30,79.40,79.40,79.42,4,NULL,NULL),

(145,10,1,NULL,80.50,80.30,80.40,80.40,80.40,1,NULL,NULL),
(146,10,1,NULL,80.50,80.30,80.40,80.40,80.40,2,NULL,NULL),
(147,10,1,NULL,80.50,80.30,80.40,80.40,80.40,3,NULL,NULL),
(148,10,1,NULL,80.50,80.30,80.40,80.40,80.40,4,NULL,NULL),

(149,10,2,NULL,82.00,82.10,82.00,82.00,82.02,1,NULL,NULL),
(150,10,2,NULL,82.00,82.10,82.00,82.00,82.02,2,NULL,NULL),
(151,10,2,NULL,82.00,82.10,82.00,82.00,82.02,3,NULL,NULL),
(152,10,2,NULL,82.00,82.10,82.00,82.00,82.02,4,NULL,NULL),

(153,10,3,NULL,80.20,80.40,80.30,80.30,80.30,1,NULL,NULL),
(154,10,3,NULL,80.20,80.40,80.30,80.30,80.30,2,NULL,NULL),
(155,10,3,NULL,80.20,80.40,80.30,80.30,80.30,3,NULL,NULL),
(156,10,3,NULL,80.20,80.40,80.30,80.30,80.30,4,NULL,NULL),

(157,10,4,NULL,81.90,81.80,81.90,81.90,81.85,1,NULL,NULL),
(158,10,4,NULL,81.90,81.80,81.90,81.90,81.85,2,NULL,NULL),
(159,10,4,NULL,81.90,81.80,81.90,81.90,81.85,3,NULL,NULL),
(160,10,4,NULL,81.90,81.80,81.90,81.90,81.85,4,NULL,NULL);


(161, 1, 1, NULL, 77.17, 74.33, 80.55, 80.55, 78.15, 5, NULL, NULL),
(2, 1, 1, NULL, 77.17, 74.33, 80.55, 80.55, 78.15, 6, NULL, NULL),
(3, 1, 1, NULL, 77.17, 74.33, 80.55, 80.55, 78.15, 7, NULL, NULL),
(4, 1, 1, NULL, 77.17, 74.33, 80.55, 80.55, 78.15, 8, NULL, NULL),

(5, 1, 2, NULL, 51.81, 74.33, 80.55, 80.55, 56.81, 1, NULL, NULL),
(6, 1, 2, NULL, 51.81, 74.33, 80.55, 80.55, 56.81, 2, NULL, NULL),
(7, 1, 2, NULL, 51.81, 74.33, 80.55, 80.55, 56.81, 3, NULL, NULL),
(8, 1, 2, NULL, 51.81, 74.33, 80.55, 80.55, 56.81, 4, NULL, NULL),

(9, 1, 3, NULL, 63.37, 74.33, 80.55, 80.55, 74.70, 1, NULL, NULL),
(10, 1, 3, NULL, 63.37, 74.33, 80.55, 80.55, 74.70, 2, NULL, NULL),
(11, 1, 3, NULL, 63.37, 74.33, 80.55, 80.55, 74.70, 3, NULL, NULL),
(12, 1, 3, NULL, 63.37, 74.33, 80.55, 80.55, 74.70, 4, NULL, NULL),

(13, 1, 4, NULL, 81.81, 74.33, 80.55, 80.55, 79.31, 1, NULL, NULL),
(14, 1, 4, NULL, 81.81, 74.33, 80.55, 80.55, 79.31, 2, NULL, NULL),
(15, 1, 4, NULL, 81.81, 74.33, 80.55, 80.55, 79.31, 3, NULL, NULL),
(16, 1, 4, NULL, 81.81, 74.33, 80.55, 80.55, 79.31, 4, NULL, NULL),

(17, 2, 1, NULL, 82.10, 78.90, 84.20, 84.20, 81.55, 1, NULL, NULL),
(18, 2, 1, NULL, 82.10, 78.90, 84.20, 84.20, 81.55, 2, NULL, NULL),
(19, 2, 1, NULL, 82.10, 78.90, 84.20, 84.20, 81.55, 3, NULL, NULL),
(20, 2, 1, NULL, 82.10, 78.90, 84.20, 84.20, 81.55, 4, NULL, NULL),

(21, 2, 2, NULL, 74.40, 75.10, 78.20, 78.20, 76.22, 1, NULL, NULL),
(22, 2, 2, NULL, 74.40, 75.10, 78.20, 78.20, 76.22, 2, NULL, NULL),
(23, 2, 2, NULL, 74.40, 75.10, 78.20, 78.20, 76.22, 3, NULL, NULL),
(24, 2, 2, NULL, 74.40, 75.10, 78.20, 78.20, 76.22, 4, NULL, NULL),

(25, 2, 3, NULL, 79.80, 78.60, 82.20, 82.20, 80.40, 1, NULL, NULL),
(26, 2, 3, NULL, 79.80, 78.60, 82.20, 82.20, 80.40, 2, NULL, NULL),
(27, 2, 3, NULL, 79.80, 78.60, 82.20, 82.20, 80.40, 3, NULL, NULL),
(28, 2, 3, NULL, 79.80, 78.60, 82.20, 82.20, 80.40, 4, NULL, NULL),

(29, 2, 4, NULL, 80.10, 77.80, 80.70, 80.70, 79.27, 1, NULL, NULL),
(30, 2, 4, NULL, 80.10, 77.80, 80.70, 80.70, 79.27, 2, NULL, NULL),
(31, 2, 4, NULL, 80.10, 77.80, 80.70, 80.70, 79.27, 3, NULL, NULL),
(32, 2, 4, NULL, 80.10, 77.80, 80.70, 80.70, 79.27, 4, NULL, NULL),

(33,3,1,NULL,85.20,83.10,86.80,86.80,84.65,1,NULL,NULL),
(34,3,1,NULL,85.20,83.10,86.80,86.80,84.65,2,NULL,NULL),
(35,3,1,NULL,85.20,83.10,86.80,86.80,84.65,3,NULL,NULL),
(36,3,1,NULL,85.20,83.10,86.80,86.80,84.65,4,NULL,NULL),

(37,3,2,NULL,83.90,84.00,84.90,84.90,84.40,1,NULL,NULL),
(38,3,2,NULL,83.90,84.00,84.90,84.90,84.40,2,NULL,NULL),
(39,3,2,NULL,83.90,84.00,84.90,84.90,84.40,3,NULL,NULL),
(40,3,2,NULL,83.90,84.00,84.90,84.90,84.40,4,NULL,NULL),

(41,3,3,NULL,70.10,72.80,72.90,72.90,71.48,1,NULL,NULL),
(42,3,3,NULL,70.10,72.80,72.90,72.90,71.48,2,NULL,NULL),
(43,3,3,NULL,70.10,72.80,72.90,72.90,71.48,3,NULL,NULL),
(44,3,3,NULL,70.10,72.80,72.90,72.90,71.48,4,NULL,NULL),

(45,3,4,NULL,82.40,80.60,81.80,81.80,81.00,1,NULL,NULL),
(46,3,4,NULL,82.40,80.60,81.80,81.80,81.00,2,NULL,NULL),
(47,3,4,NULL,82.40,80.60,81.80,81.80,81.00,3,NULL,NULL),
(48,3,4,NULL,82.40,80.60,81.80,81.80,81.00,4,NULL,NULL),

(49,4,1,NULL,78.60,77.20,79.40,79.40,78.40,1,NULL,NULL),
(50,4,1,NULL,78.60,77.20,79.40,79.40,78.40,2,NULL,NULL),
(51,4,1,NULL,78.60,77.20,79.40,79.40,78.40,3,NULL,NULL),
(52,4,1,NULL,78.60,77.20,79.40,79.40,78.40,4,NULL,NULL),

(53,4,2,NULL,75.40,76.10,76.40,76.40,75.99,1,NULL,NULL),
(54,4,2,NULL,75.40,76.10,76.40,76.40,75.99,2,NULL,NULL),
(55,4,2,NULL,75.40,76.10,76.40,76.40,75.99,3,NULL,NULL),
(56,4,2,NULL,75.40,76.10,76.40,76.40,75.99,4,NULL,NULL),

(57,4,3,NULL,80.40,80.80,80.80,80.80,80.66,1,NULL,NULL),
(58,4,3,NULL,80.40,80.80,80.80,80.80,80.66,2,NULL,NULL),
(59,4,3,NULL,80.40,80.80,80.80,80.80,80.66,3,NULL,NULL),
(60,4,3,NULL,80.40,80.80,80.80,80.80,80.66,4,NULL,NULL),

(61,4,4,NULL,78.60,78.40,78.80,78.80,78.58,1,NULL,NULL),
(62,4,4,NULL,78.60,78.40,78.80,78.80,78.58,2,NULL,NULL),
(63,4,4,NULL,78.60,78.40,78.80,78.80,78.58,3,NULL,NULL),
(64,4,4,NULL,78.60,78.40,78.80,78.80,78.58,4,NULL,NULL),

(65,5,1,NULL,80.10,78.60,80.30,80.30,79.65,1,NULL,NULL),
(66,5,1,NULL,80.10,78.60,80.30,80.30,79.65,2,NULL,NULL),
(67,5,1,NULL,80.10,78.60,80.30,80.30,79.65,3,NULL,NULL),
(68,5,1,NULL,80.10,78.60,80.30,80.30,79.65,4,NULL,NULL),

(69,5,2,NULL,80.40,80.80,80.90,80.90,80.71,1,NULL,NULL),
(70,5,2,NULL,80.40,80.80,80.90,80.90,80.71,2,NULL,NULL),
(71,5,2,NULL,80.40,80.80,80.90,80.90,80.71,3,NULL,NULL),
(72,5,2,NULL,80.40,80.80,80.90,80.90,80.71,4,NULL,NULL),

(73,5,3,NULL,79.10,79.60,79.90,79.90,79.53,1,NULL,NULL),
(74,5,3,NULL,79.10,79.60,79.90,79.90,79.53,2,NULL,NULL),
(75,5,3,NULL,79.10,79.60,79.90,79.90,79.53,3,NULL,NULL),
(76,5,3,NULL,79.10,79.60,79.90,79.90,79.53,4,NULL,NULL),

(77,5,4,NULL,79.20,78.70,79.00,79.00,78.95,1,NULL,NULL),
(78,5,4,NULL,79.20,78.70,79.00,79.00,78.95,2,NULL,NULL),
(79,5,4,NULL,79.20,78.70,79.00,79.00,78.95,3,NULL,NULL),
(80,5,4,NULL,79.20,78.70,79.00,79.00,78.95,4,NULL,NULL),

(81,6,1,NULL,77.00,76.40,76.90,76.90,76.65,1,NULL,NULL),
(82,6,1,NULL,77.00,76.40,76.90,76.90,76.65,2,NULL,NULL),
(83,6,1,NULL,77.00,76.40,76.90,76.90,76.65,3,NULL,NULL),
(84,6,1,NULL,77.00,76.40,76.90,76.90,76.65,4,NULL,NULL),

(85,6,2,NULL,69.40,69.90,70.10,70.10,69.80,1,NULL,NULL),
(86,6,2,NULL,69.40,69.90,70.10,70.10,69.80,2,NULL,NULL),
(87,6,2,NULL,69.40,69.90,70.10,70.10,69.80,3,NULL,NULL),
(88,6,2,NULL,69.40,69.90,70.10,70.10,69.80,4,NULL,NULL),

(89,6,3,NULL,75.60,75.90,75.90,75.90,75.82,1,NULL,NULL),
(90,6,3,NULL,75.60,75.90,75.90,75.90,75.82,2,NULL,NULL),
(91,6,3,NULL,75.60,75.90,75.90,75.90,75.82,3,NULL,NULL),
(92,6,3,NULL,75.60,75.90,75.90,75.90,75.82,4,NULL,NULL),

(93,6,4,NULL,78.60,78.40,78.80,78.80,78.58,1,NULL,NULL),
(94,6,4,NULL,78.60,78.40,78.80,78.80,78.58,2,NULL,NULL),
(95,6,4,NULL,78.60,78.40,78.80,78.80,78.58,3,NULL,NULL),
(96,6,4,NULL,78.60,78.40,78.80,78.80,78.58,4,NULL,NULL),

(97,7,1,NULL,81.20,80.90,81.20,81.20,81.15,1,NULL,NULL),
(98,7,1,NULL,81.20,80.90,81.20,81.20,81.15,2,NULL,NULL),
(99,7,1,NULL,81.20,80.90,81.20,81.20,81.15,3,NULL,NULL),
(100,7,1,NULL,81.20,80.90,81.20,81.20,81.15,4,NULL,NULL),

(101,7,2,NULL,81.40,81.60,81.60,81.60,81.51,1,NULL,NULL),
(102,7,2,NULL,81.40,81.60,81.60,81.60,81.51,2,NULL,NULL),
(103,7,2,NULL,81.40,81.60,81.60,81.60,81.51,3,NULL,NULL),
(104,7,2,NULL,81.40,81.60,81.60,81.60,81.51,4,NULL,NULL),

(105,7,3,NULL,77.10,77.40,77.20,77.20,77.21,1,NULL,NULL),
(106,7,3,NULL,77.10,77.40,77.20,77.20,77.21,2,NULL,NULL),
(107,7,3,NULL,77.10,77.40,77.20,77.20,77.21,3,NULL,NULL),
(108,7,3,NULL,77.10,77.40,77.20,77.20,77.21,4,NULL,NULL),

(109,7,4,NULL,31.00,30.80,30.90,30.90,30.98,1,NULL,NULL),
(110,7,4,NULL,31.00,30.80,30.90,30.90,30.98,2,NULL,NULL),
(111,7,4,NULL,31.00,30.80,30.90,30.90,30.98,3,NULL,NULL),
(112,7,4,NULL,31.00,30.80,30.90,30.90,30.98,4,NULL,NULL),

(113,8,1,NULL,76.70,76.50,76.80,76.80,76.65,1,NULL,NULL),
(114,8,1,NULL,76.70,76.50,76.80,76.80,76.65,2,NULL,NULL),
(115,8,1,NULL,76.70,76.50,76.80,76.80,76.65,3,NULL,NULL),
(116,8,1,NULL,76.70,76.50,76.80,76.80,76.65,4,NULL,NULL),

(117,8,2,NULL,76.50,76.70,76.70,76.70,76.62,1,NULL,NULL),
(118,8,2,NULL,76.50,76.70,76.70,76.70,76.62,2,NULL,NULL),
(119,8,2,NULL,76.50,76.70,76.70,76.70,76.62,3,NULL,NULL),
(120,8,2,NULL,76.50,76.70,76.70,76.70,76.62,4,NULL,NULL),

(121,8,3,NULL,74.20,74.50,74.30,74.30,74.33,1,NULL,NULL),
(122,8,3,NULL,74.20,74.50,74.30,74.30,74.33,2,NULL,NULL),
(123,8,3,NULL,74.20,74.50,74.30,74.30,74.33,3,NULL,NULL),
(124,8,3,NULL,74.20,74.50,74.30,74.30,74.33,4,NULL,NULL),

(125,8,4,NULL,75.70,75.40,75.60,75.60,75.52,1,NULL,NULL),
(126,8,4,NULL,75.70,75.40,75.60,75.60,75.52,2,NULL,NULL),
(127,8,4,NULL,75.70,75.40,75.60,75.60,75.52,3,NULL,NULL),
(128,8,4,NULL,75.70,75.40,75.60,75.60,75.52,4,NULL,NULL),

(129,9,1,NULL,78.50,78.30,78.40,78.40,78.40,1,NULL,NULL),
(130,9,1,NULL,78.50,78.30,78.40,78.40,78.40,2,NULL,NULL),
(131,9,1,NULL,78.50,78.30,78.40,78.40,78.40,3,NULL,NULL),
(132,9,1,NULL,78.50,78.30,78.40,78.40,78.40,4,NULL,NULL),

(133,9,2,NULL,78.60,78.80,78.60,78.60,78.66,1,NULL,NULL),
(134,9,2,NULL,78.60,78.80,78.60,78.60,78.66,2,NULL,NULL),
(135,9,2,NULL,78.60,78.80,78.60,78.60,78.66,3,NULL,NULL),
(136,9,2,NULL,78.60,78.80,78.60,78.60,78.66,4,NULL,NULL),

(137,9,3,NULL,73.50,73.80,73.60,73.60,73.59,1,NULL,NULL),
(138,9,3,NULL,73.50,73.80,73.60,73.60,73.59,2,NULL,NULL),
(139,9,3,NULL,73.50,73.80,73.60,73.60,73.59,3,NULL,NULL),
(140,9,3,NULL,73.50,73.80,73.60,73.60,73.59,4,NULL,NULL),

(141,9,4,NULL,79.50,79.30,79.40,79.40,79.42,1,NULL,NULL),
(142,9,4,NULL,79.50,79.30,79.40,79.40,79.42,2,NULL,NULL),
(143,9,4,NULL,79.50,79.30,79.40,79.40,79.42,3,NULL,NULL),
(144,9,4,NULL,79.50,79.30,79.40,79.40,79.42,4,NULL,NULL),

(145,10,1,NULL,80.50,80.30,80.40,80.40,80.40,1,NULL,NULL),
(146,10,1,NULL,80.50,80.30,80.40,80.40,80.40,2,NULL,NULL),
(147,10,1,NULL,80.50,80.30,80.40,80.40,80.40,3,NULL,NULL),
(148,10,1,NULL,80.50,80.30,80.40,80.40,80.40,4,NULL,NULL),

(149,10,2,NULL,82.00,82.10,82.00,82.00,82.02,1,NULL,NULL),
(150,10,2,NULL,82.00,82.10,82.00,82.00,82.02,2,NULL,NULL),
(151,10,2,NULL,82.00,82.10,82.00,82.00,82.02,3,NULL,NULL),
(152,10,2,NULL,82.00,82.10,82.00,82.00,82.02,4,NULL,NULL),

(153,10,3,NULL,80.20,80.40,80.30,80.30,80.30,1,NULL,NULL),
(154,10,3,NULL,80.20,80.40,80.30,80.30,80.30,2,NULL,NULL),
(155,10,3,NULL,80.20,80.40,80.30,80.30,80.30,3,NULL,NULL),
(156,10,3,NULL,80.20,80.40,80.30,80.30,80.30,4,NULL,NULL),

(157,10,4,NULL,81.90,81.80,81.90,81.90,81.85,1,NULL,NULL),
(158,10,4,NULL,81.90,81.80,81.90,81.90,81.85,2,NULL,NULL),
(159,10,4,NULL,81.90,81.80,81.90,81.90,81.85,3,NULL,NULL),
(160,10,4,NULL,81.90,81.80,81.90,81.90,81.85,4,NULL,NULL);


-- Dumping structure for table sistem-pbl-mahasiswa.peringkat_kelompok
CREATE TABLE IF NOT EXISTS `peringkat_kelompok` (
  `id_peringkat_kelompok` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_kelompok` bigint unsigned NOT NULL,
  `nilai` decimal(8,2) NOT NULL,
  `peringkat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_peringkat_kelompok`),
  KEY `peringkat_kelompok_id_kelompok_foreign` (`id_kelompok`),
  CONSTRAINT `peringkat_kelompok_id_kelompok_foreign` FOREIGN KEY (`id_kelompok`) REFERENCES `kelompok` (`id_kelompok`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sistem-pbl-mahasiswa.peringkat_kelompok: ~0 rows (approximately)

-- Dumping structure for table sistem-pbl-mahasiswa.peringkat_mahasiswa
CREATE TABLE IF NOT EXISTS `peringkat_mahasiswa` (
  `id_peringkat_mahasiswa` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_mahasiswa` bigint unsigned NOT NULL,
  `nilai` decimal(8,2) NOT NULL,
  `peringkat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_peringkat_mahasiswa`),
  KEY `peringkat_mahasiswa_id_mahasiswa_foreign` (`id_mahasiswa`),
  CONSTRAINT `peringkat_mahasiswa_id_mahasiswa_foreign` FOREIGN KEY (`id_mahasiswa`) REFERENCES `mahasiswa` (`id_mahasiswa`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sistem-pbl-mahasiswa.peringkat_mahasiswa: ~0 rows (approximately)

-- Dumping structure for table sistem-pbl-mahasiswa.profil
CREATE TABLE IF NOT EXISTS `profil` (
  `id_profil` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_user` bigint unsigned NOT NULL,
  `matakuliah` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `potoprofil` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `NIP` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_profil`),
  KEY `profil_id_user_foreign` (`id_user`),
  CONSTRAINT `profil_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sistem-pbl-mahasiswa.profil: ~4 rows (approximately)
INSERT INTO `profil` (`id_profil`, `id_user`, `matakuliah`, `potoprofil`, `NIP`) VALUES
	(1, 1, 'Integrasi Sistem', 'jsfgshgf', '123456789'),
	(2, 2, 'Integrasi Sistem', 'shshd', '123456788'),
	(3, 3, 'Integrasi Sistem', 'sfshi', '123456787'),
	(4, 4, 'Integrasi Sistem', 'shgsd', '123456798');

-- Dumping structure for table sistem-pbl-mahasiswa.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sistem-pbl-mahasiswa.sessions: ~2 rows (approximately)
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('1fAqe1UPifPFtUGqNZCIMf4LC0qQCfjImJS80jTq', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiMzZyTDJ5WVRQdVNrMlRORTczclViekp3VEtNRWF3WndEU25xZ2V1cCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0NToiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2FkbWluL3RlbmdnYXQtcGVuaWxhaWFuIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kb3Nlbi9uaWxhaS1tYWhhc2lzd2EiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1765899438),
	('xmwWXULE4JJW6GXiRDNJqSEf16p7Uo5bYSMu3APE', 4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiQnJmQjNRaGhlbzlSREdNaEVmUURwU01HbW9RV2tSbFBJNThVRzlkViI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi90cGsiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo0O30=', 1765899434);

-- Dumping structure for table sistem-pbl-mahasiswa.tenggat_penilaian
CREATE TABLE IF NOT EXISTS `tenggat_penilaian` (
  `id_tenggat` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tahun_ajaran` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_tenggat` datetime NOT NULL,
  `waktu_kirim_notif` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_tenggat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sistem-pbl-mahasiswa.tenggat_penilaian: ~0 rows (approximately)

-- Dumping structure for table sistem-pbl-mahasiswa.user
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_wa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` enum('admin','dosen','kaprodi','pembimbing') COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sistem-pbl-mahasiswa.user: ~4 rows (approximately)
INSERT INTO `user` (`id_user`, `nama`, `email`, `no_wa`, `password`, `level`) VALUES
	(1, 'Dr. Ahmad Khaidir', 'ahmad.khaidir@politala.ac.id', '6285787064089', '$2y$12$U6mWuw5gpWx0VIgT4Q.UzuvRQu4bjYaC/3ps599m/iemHOho5LGja', 'dosen'),
	(2, 'Budi Santoso', 'budi.santoso@politala.ac.id', '6285787064089', '$2y$12$3ZJNxIpk/oGqSBCjS/.WTeqb624/nJQJIY4lDxkjneSvWwMWbTs52', 'pembimbing'),
	(3, 'Dewi Kartika', 'dewi.kartika@politala.ac.id', '6285787064089', '$2y$12$OAibDqA1sdOIiAJjOnOdTu.DHQ8JzL/H2Wax/TkQte/CYhd/XVKgm', 'kaprodi'),
	(4, 'andhika', 'andhika@politala.ac.id', '6285787064089', '$2y$12$dDexHmsf2MUkaGB6YvtJKeM.NM86jZ/OotUqoVp0qlpMRQYh6rRti', 'admin');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
