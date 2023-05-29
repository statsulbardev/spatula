-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 29, 2023 at 07:43 AM
-- Server version: 8.0.30
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spatulaprod`
--

-- --------------------------------------------------------

--
-- Table structure for table `d_penilaian`
--

CREATE TABLE `d_penilaian` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_konsumen` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_konsumen` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_wa_telepon` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kode_petugas` bigint DEFAULT NULL,
  `rating_petugas` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kode_layanan` bigint DEFAULT NULL,
  `rating_layanan` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kode_saran` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `is_pengaduan` tinyint DEFAULT NULL,
  `saran_pengaduan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `tanggal_notifikasi` datetime DEFAULT NULL,
  `tanggal_kategorisasi` datetime DEFAULT NULL,
  `tanggal_tl_pj_layanan` datetime DEFAULT NULL,
  `text_pj_layanan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `tanggal_tl_pj_pengaduan` datetime DEFAULT NULL,
  `text_pj_pengaduan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `kode_satker_id` char(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `selesai` tinyint NOT NULL,
  `tanggal_selesai` datetime DEFAULT NULL,
  `catatan` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `d_penilaian`
--

INSERT INTO `d_penilaian` (`id`, `nama_konsumen`, `email_konsumen`, `no_wa_telepon`, `kode_petugas`, `rating_petugas`, `kode_layanan`, `rating_layanan`, `kode_saran`, `is_pengaduan`, `saran_pengaduan`, `tanggal_notifikasi`, `tanggal_kategorisasi`, `tanggal_tl_pj_layanan`, `text_pj_layanan`, `tanggal_tl_pj_pengaduan`, `text_pj_pengaduan`, `kode_satker_id`, `selesai`, `tanggal_selesai`, `catatan`, `created_at`, `updated_at`) VALUES
(1, 'Anna', 'Annabaharuddin@gmail.com', NULL, 3, '5', 10, '5', '[4]', 0, 'layanan OK', '2020-06-24 11:57:46', '2020-07-06 12:01:37', NULL, NULL, NULL, NULL, '7600', 1, '2020-06-24 12:28:00', NULL, '2020-06-24 04:57:46', '2020-06-24 05:28:00'),
(2, 'ramlah', 'ramlahvirgo24896@gmail.com', '081353703093', 3, '5', 4, '5', '[4]', 0, 'Terima kasih kepada BPS Provinsi Sulawesi Barat, pelayanan yang diberikan sangat memuaskan.', NULL, '2020-07-03 12:34:04', NULL, NULL, NULL, NULL, '7600', 1, '2020-07-03 12:34:56', NULL, '2020-07-03 03:56:45', '2020-07-03 05:34:56'),
(3, 'Sri Aryani', 'sikungtam@gmail.com', '085299427765', NULL, NULL, 7, '5', '[4]', 0, 'Mantap', '2020-07-01 11:18:46', '2020-07-01 11:18:46', NULL, NULL, NULL, NULL, '7600', 1, '2020-07-01 12:18:41', NULL, '2020-07-01 03:46:17', '2020-07-01 05:18:41'),
(4, 'hasta pratama', 'hasta@bps.go.id', '085277397687', NULL, NULL, 7, '5', '[4]', 0, 'mantap', NULL, '2020-07-01 11:19:06', NULL, NULL, NULL, NULL, '7600', 1, '2020-07-01 12:18:42', NULL, '2020-07-01 03:46:56', '2020-07-01 05:18:42'),
(5, 'Hairuddin', 'hai.23.09.85@gmail.com', '082352030084', NULL, NULL, 7, '5', '[4]', 0, 'Website sangat membantu kita dalam mencari data yang diperlukan.', NULL, '2020-06-26 11:48:59', NULL, NULL, NULL, NULL, '7600', 1, '2020-06-26 12:18:51', NULL, '2020-06-26 03:48:39', '2020-06-26 05:18:51'),
(6, 'Dolly', 'kecoak.kampret@gmail.com', '089653205248', 6, '5', 1, '5', '[4]', 0, 'Mantab', NULL, '2020-07-02 11:18:15', NULL, NULL, NULL, NULL, '7600', 1, '2020-07-02 12:18:53', NULL, '2020-07-02 03:49:25', '2020-07-02 05:18:53'),
(7, 'Fitri Pratiwi', 'pratiwifitri92@gmail.com', NULL, NULL, NULL, 7, '5', '[1,4]', 0, 'Pelayanan yang diberikan oleh BPS, khususnya BPS Sulawesi Barat sangat amat memuaskan. Cepat, ramah dan informasi yang dibutuhkan diberikan jawaban yang detail didukung dengan data yang ada. Sedikit saran, penggunaan tanda koma atau titik pada angka yang disajikan dalam tabel excel kiranya dapat ditambahkan, untuk memudahkan proses filter data pada aplikasi excel. Penggunaan titik tidak memungkinkan untuk melakukan filter data di aplikasi Ms Office excel. Overall pelayanan yang diberikan BPS sangat memuaskan. Kami dari Badan Keuangan Provinsi merasa sangat terbantu dalam penyajian data ekonomi makro dan mikro pada Laporan Keuangan Pemerintah Daerah yang kami susun. Sekali lagi terimakasih.', '2020-06-29 10:37:10', '2020-06-29 11:20:49', NULL, NULL, NULL, NULL, '7600', 1, '2020-06-29 11:55:28', NULL, '2020-06-29 03:37:05', '2020-06-29 04:55:28'),
(8, 'Miswar', 'lenimiswar@gmail.com', '082188173388', 6, '5', 10, '5', '[4]', 0, 'Respon cepat,, penjelasan yg mudah dipahami.', NULL, '2020-06-30 11:49:06', NULL, NULL, NULL, NULL, '7600', 1, '2020-06-30 12:18:54', NULL, '2020-06-30 04:09:25', '2020-06-30 05:18:54'),
(9, 'Istiqomah', 'esty.bhull@gmail.com', '085299921862', NULL, NULL, 7, '5', '[4]', 0, 'Mantap', NULL, '2020-07-06 11:22:38', NULL, NULL, NULL, NULL, '7600', 1, '2020-07-06 12:21:18', NULL, '2020-07-06 04:09:34', '2020-07-06 05:21:18'),
(10, 'Sigit Susanto', 'sigit.menroe@gmail.com', '081361066000', NULL, NULL, 7, '5', '[1]', 0, 'semoga bentuk pengadun dapat depat terlayani', NULL, '2020-07-03 11:48:50', NULL, NULL, NULL, NULL, '7600', 1, '2020-07-03 12:21:21', NULL, '2020-07-03 04:10:18', '2020-07-03 05:21:21'),
(11, 'Kadarsah', 'muh.kadarsah@gmail.com', '085241620696', NULL, NULL, 7, '5', '[4]', 0, 'Semakin hari semakin baik.. tampilan semakin menarik... isan semakin lengkap..', NULL, '2020-07-04 11:49:12', NULL, NULL, NULL, NULL, '7600', 1, '2020-07-06 12:21:22', NULL, '2020-07-04 04:10:35', '2020-07-04 05:21:22'),
(12, 'Dhori Pridana Kusuma', 'dhorikusuma@gmail.com', NULL, NULL, NULL, 7, '5', '[4]', 0, 'Website OK', '2020-06-25 11:15:05', '2020-06-25 11:49:19', NULL, NULL, NULL, NULL, '7600', 1, '2020-06-25 11:55:58', NULL, '2020-06-25 04:15:05', '2020-06-25 04:55:58'),
(13, 'Riri', 'ersetiawati@gmail.com', '081341232574', NULL, NULL, 7, '5', '[4]', 0, 'Good job', NULL, '2020-07-06 11:49:26', NULL, NULL, NULL, NULL, '7600', 1, '2020-07-06 12:27:53', NULL, '2020-07-06 04:23:48', '2020-07-06 05:27:53'),
(14, 'hella', 'hellacitra@gmail.com', '085260266558', NULL, NULL, 7, '5', '[1]', 0, 'semoga dapat terimplementasi dengan baik', NULL, '2020-07-06 11:49:36', NULL, NULL, NULL, NULL, '7600', 1, '2020-07-06 12:27:55', NULL, '2020-07-06 04:25:18', '2020-07-06 05:27:55'),
(15, 'Novri Satria', 'satria9rayhan@gmail.com', '081364175183', NULL, NULL, 7, '5', '[4]', 0, 'Pelayanan sangat memuaskan, semoga bisa selalu dipertahankan...', NULL, '2020-07-03 11:50:31', NULL, NULL, NULL, NULL, '7600', 1, '2020-07-03 12:27:56', NULL, '2020-07-03 04:27:11', '2020-07-03 05:27:56'),
(16, 'Luhur Partomo Hudoyo', 'luhurph110710@gmail.com', '085240692300', NULL, NULL, 10, '5', '[4]', 0, 'mantap...', NULL, '2020-07-06 11:52:02', NULL, NULL, NULL, NULL, '7600', 1, '2020-07-06 12:27:57', NULL, '2020-07-06 04:30:58', '2020-07-06 05:27:57'),
(17, 'Ajulawati. B, SH', 'ajulawati77@gmail.com', NULL, NULL, NULL, 7, '5', '[1]', 0, 'Agar pelayanan publikasi BPS lebih ditingkatkan dalam penyajian data', '2020-06-24 11:33:55', '2020-07-06 11:51:50', NULL, NULL, NULL, NULL, '7600', 1, '2020-06-24 11:53:45', NULL, '2020-06-24 04:33:55', '2020-07-06 04:51:50'),
(18, 'Arbi', NULL, '085228869594', NULL, NULL, 7, '5', '[4]', 0, 'bagus', NULL, '2020-07-06 12:03:55', NULL, NULL, NULL, NULL, '7600', 1, '2020-07-06 12:27:59', NULL, '2020-07-06 04:54:26', '2020-07-06 05:27:59'),
(19, 'Abdul Majid', 'majidsag346@gmail.com', NULL, 6, '5', 2, '5', '[4]', 0, 'Pelayanan sudah bagus, dipertahankan', '2020-07-06 12:04:40', '2020-07-06 12:17:50', NULL, NULL, NULL, NULL, '7600', 1, '2020-07-06 12:28:07', NULL, '2020-07-06 05:04:40', '2020-07-06 05:28:07'),
(20, 'Intan S', 'intan8123@yahoo.com', NULL, 6, '5', 4, '5', '[4]', 0, 'Pelayanan untuk memperoleh data sangatlah mudah dan data yang diperoleh sangat lengkap sehingga mudah saya dalam menyelesaikan tugas dari kampus.\r\n\r\nsangat puas dengan semua pelayanannya', '2020-07-06 12:06:27', '2020-07-06 13:48:58', NULL, NULL, NULL, NULL, '7600', 1, '2020-07-06 20:02:09', NULL, '2020-07-06 05:06:27', '2020-07-06 13:02:09'),
(21, 'Fahmi Maulaba', 'fahmimaulana@bps.go.id', '08112409273', NULL, NULL, 7, '5', '[4]', 0, 'Mantap', NULL, '2020-07-06 13:49:02', NULL, NULL, NULL, NULL, '7600', 1, '2020-07-06 20:02:12', NULL, '2020-07-06 05:20:51', '2020-07-06 13:02:12'),
(22, 'Hermawan Prasetyo', 'hprasetyo33@gmail.com', '081225242518', NULL, NULL, 7, '5', '[4]', 0, 'Sangat bermanfaat', NULL, '2020-07-06 13:49:07', NULL, NULL, NULL, NULL, '7600', 1, '2020-07-06 20:02:18', NULL, '2020-07-06 05:35:13', '2020-07-06 13:02:18'),
(23, 'Mirda', 'mirda.project@gmail.com', '081290244890', NULL, NULL, 7, '5', '[1,4]', 0, 'data banyak tersedia, semoga data dapat segera diupdate untuk data terbaru. Terima kasih BPS.', NULL, '2020-07-06 15:17:54', NULL, NULL, NULL, NULL, '7600', 1, '2020-07-06 20:02:24', NULL, '2020-07-06 07:35:10', '2020-07-06 13:02:24'),
(24, 'Mardiyana', 'diyanamahdin@gmail.com', '081399394121', NULL, NULL, 7, '5', '[4]', 0, 'Website BPS Sulbar okeee beud 👍👍\r\nKami secara rutin menggunakan data2 yg telah dirilis pd menu BRS. Penyediaan data tersebut sangat bermanfaat dalam pelaksanaan pekerjaan kami di Kanwil DJPb Provinsi Sulbar, data yg dirilis pun up to date. Sangat membantu, terutama di tengah banyaknya pembatasan gerak seperti sekarang ini.\r\n\r\nTerima kasih, tim website BPS Sulbar..\r\nSemoga sukses terus, berinovasi dalam menyediakan data yg akurat bagi kemajuan Sulbar!', NULL, '2020-07-06 15:18:10', NULL, NULL, NULL, NULL, '7600', 1, '2020-07-06 20:02:25', NULL, '2020-07-06 07:57:25', '2020-07-06 13:02:25'),
(25, 'Lusi', 'lusi.3yani@gmail.com', '082310378059', NULL, NULL, 7, '4', '[1]', 0, 'Agar data yang tersedia lebih lengkap lagi dan tersedia dalam bentuk Excel.', NULL, '2020-07-06 20:02:47', NULL, NULL, NULL, NULL, '7600', 1, '2020-07-06 20:17:26', NULL, '2020-07-06 08:04:08', '2020-07-06 13:17:26'),
(26, 'Sri Ayu Astuti', NULL, '082248431977', 6, '5', 4, '5', '[4]', 0, 'Petugas sangat membantu dalam pencarian data', NULL, '2020-07-07 16:04:05', NULL, NULL, NULL, NULL, '7600', 1, '2020-07-07 16:04:08', NULL, '2020-07-06 12:57:19', '2020-07-07 09:04:08'),
(27, 'M Alimuddin', 'helmiunsyiah@gmail.com', '081324351366', NULL, NULL, 7, '5', '[4]', 0, 'mantul', NULL, '2020-07-10 13:44:10', NULL, NULL, NULL, NULL, '7600', 1, '2020-07-10 13:44:24', NULL, '2020-07-08 00:25:24', '2020-07-10 06:44:24'),
(28, 'Kartika Hajati', NULL, '082311422215', 6, '5', 2, '5', '[4]', 0, 'terima kasih atas layanannya', NULL, '2020-08-13 09:26:15', NULL, NULL, NULL, NULL, '7600', 1, '2020-08-13 09:26:47', NULL, '2020-08-13 02:21:41', '2020-08-13 02:26:47'),
(29, 'Fadiah Azis', NULL, '081242881497', 3, '5', 2, '5', '[4]', 0, 'mantap, ditunggu kiriman datanya melalui email', NULL, '2020-09-02 09:26:22', NULL, NULL, NULL, NULL, '7600', 1, '2020-09-02 09:26:51', NULL, '2020-09-02 02:22:27', '2020-09-02 02:26:51'),
(30, 'Syarifuddin', NULL, '085299210003', 6, '5', 2, '5', '[4]', 0, 'terima kasih atas bantuannya memberikan data IPM', NULL, '2020-09-03 09:26:29', NULL, NULL, NULL, NULL, '7600', 1, '2020-09-03 09:26:52', NULL, '2020-09-03 02:23:34', '2020-09-03 02:26:52'),
(31, 'Abdul Rajab', NULL, '085399677009', 3, '5', 2, '5', '[4]', 0, 'oke', NULL, '2020-09-02 09:26:33', NULL, NULL, NULL, NULL, '7600', 1, '2020-09-02 09:26:54', NULL, '2020-09-02 02:24:02', '2020-09-02 02:26:54'),
(32, 'samsuddin saleh', NULL, '085293992755', 6, '5', 2, '5', '[4]', 0, 'terima kasih BPS', NULL, '2020-08-18 09:26:37', NULL, NULL, NULL, NULL, '7600', 1, '2020-08-18 09:26:55', NULL, '2020-08-18 02:24:34', '2020-08-18 02:26:55'),
(33, 'FIRMAN AR', NULL, '085399951255', 6, '5', 2, '5', '[4]', 0, 'terima kasih sudah membantu untuk penyelesaian tugas sekolah', NULL, '2020-08-05 09:26:43', NULL, NULL, NULL, NULL, '7600', 1, '2020-08-05 09:26:57', NULL, '2020-08-05 02:25:25', '2020-08-05 02:26:57'),
(34, 'Supriadi', NULL, '085320200560', NULL, NULL, 10, '5', '[4]', 0, 'terima kasih untuk info datanya', NULL, '2020-08-04 09:42:49', NULL, NULL, NULL, NULL, '7600', 1, '2020-10-08 09:48:59', NULL, '2020-08-04 02:41:02', '2020-10-08 02:48:59'),
(35, 'Imran', NULL, '082346579218', NULL, NULL, 10, '5', '[4]', 0, 'mantapp', NULL, '2020-08-04 09:43:06', NULL, NULL, NULL, NULL, '7600', 1, '2020-10-08 09:49:01', NULL, '2020-08-04 02:41:49', '2020-10-08 02:49:01'),
(36, 'Ranti Suryani', NULL, '087776931054', NULL, NULL, 10, '5', '[4]', 0, 'terima kasih untuk data penduduk yang bekerjanya', NULL, '2020-10-01 09:49:07', NULL, NULL, NULL, NULL, '7600', 1, '2020-10-01 09:49:11', NULL, '2020-10-01 02:47:32', '2020-10-01 02:49:11'),
(37, 'Diah Daniaty', NULL, '081297848613', NULL, NULL, 10, '5', '[4]', 0, 'layanan mantap', NULL, '2020-09-02 09:49:10', NULL, NULL, NULL, NULL, '7600', 1, '2020-09-02 09:49:13', NULL, '2020-09-02 02:48:32', '2020-09-02 02:49:13'),
(38, 'Indah Rahayu', NULL, '082393294595', NULL, NULL, 10, '5', '[4]', 0, 'respon WA-nya cepat, terima kasih BPS', NULL, '2020-09-21 10:05:59', NULL, NULL, NULL, NULL, '7600', 1, '2020-09-21 10:06:01', NULL, '2020-09-21 03:05:44', '2020-09-21 03:06:01'),
(39, 'Nur Hanafiah', NULL, '082340795419', NULL, NULL, 10, '5', '[4]', 0, 'layanan WA memudahkan untuk mencari data', NULL, '2020-09-21 10:13:47', NULL, NULL, NULL, NULL, '7600', 1, '2020-09-21 10:13:49', NULL, '2020-09-21 03:13:21', '2020-09-21 03:13:49'),
(40, 'daud eko cahyo rukmono', 'ekodaud@gmail.com', '082187229002', 6, '5', 2, '5', '[4]', 0, 'terima kasih atas pelayanannya', NULL, '2020-10-23 12:01:36', NULL, NULL, NULL, NULL, '7600', 1, '2020-10-23 12:11:49', NULL, '2020-10-23 04:58:27', '2020-10-23 05:11:49'),
(41, 'rijal abdul malik', 'rijal.a.em.09@gmail.com', '081221866558', NULL, NULL, 7, '5', '[4]', 0, 'sudah sangat bagus', NULL, '2020-11-05 12:52:49', NULL, NULL, NULL, NULL, '7600', 1, '2020-11-05 12:52:53', NULL, '2020-11-03 08:37:58', '2020-11-05 05:52:53'),
(42, 'Suwandy intan', 'wandyintan1991@gmail.com', '085366070605', NULL, NULL, 8, '5', '[4]', 0, 'Bagus', NULL, '2020-12-29 09:31:54', NULL, NULL, NULL, NULL, '7600', 1, '2020-12-29 09:31:59', NULL, '2020-11-17 08:20:07', '2020-12-29 02:31:59'),
(43, 'Suwandy intan', 'wandyintan1991@gmail.com', '085366070605', NULL, NULL, 7, '5', '[4]', 0, 'Bagus', NULL, '2020-12-29 09:31:21', NULL, NULL, NULL, NULL, '7600', 1, '2020-12-29 09:31:57', NULL, '2020-11-17 08:20:31', '2020-12-29 02:31:57'),
(44, 'Nur Rezky Safitriani', 'rezky.toaba@gmail.com', '081354279486', NULL, NULL, 7, '2', '[1,3]', 0, 'Data mengenai jumlah tindak kriminalitas (crime total) menurut kab./kota sejak tahun 2018 tidak tersedia di website BPS Provinsi maupun masing-masing kabupaten yang ada di Sulawesi Barat. Mohon kepada petugas BPS bisa segera mengupload data kriminalitas dalam publikasi Statistik Politik dan Keamanan Provinsi Sulawesi Barat.', NULL, '2021-02-04 13:49:19', NULL, NULL, NULL, NULL, '7600', 1, '2021-02-04 13:49:31', NULL, '2021-01-14 06:59:25', '2021-02-04 06:49:31'),
(45, 'Endang Suyanti', NULL, '085242946204', 6, '5', 1, '5', '[4]', 0, 'Memuaskan', NULL, '2021-03-30 10:47:56', NULL, NULL, NULL, NULL, '7600', 1, '2021-03-30 10:48:03', NULL, '2021-03-30 02:51:06', '2021-03-30 03:48:03'),
(46, 'faried', 'fariedbainta@gmail.com', '085255910409', 6, '5', 1, '4', '[4]', 0, 'pelayanan baik dan ramah,', NULL, '2021-04-14 10:48:12', NULL, NULL, NULL, NULL, '7600', 1, '2021-04-14 10:48:44', NULL, '2021-04-05 04:40:02', '2021-04-14 03:48:44'),
(47, 'Supriadi R', 'rian.saputra1176@gmail.com', '085320200560', 6, '5', 10, '5', '[4]', 0, 'Sangat bermanfaat infonya', NULL, '2021-04-06 10:48:28', NULL, NULL, NULL, NULL, '7600', 1, '2021-04-06 10:48:50', NULL, '2021-04-05 07:21:18', '2021-04-06 03:48:50'),
(48, 'Fadiah Azis', 'fadiahazis07@gmail.com', '081242881497', 3, '5', 10, '5', '[1]', 0, 'Mungkin bisa pelayanan siaga  24 jam untuk informasi.', NULL, '2021-04-14 10:48:35', NULL, NULL, NULL, NULL, '7600', 1, '2021-04-14 10:48:52', NULL, '2021-04-13 12:43:12', '2021-04-14 03:48:52'),
(49, 'ABDUL RAJAB', 'rajab.daeng@gmail.com', '085399677008', NULL, NULL, 7, '5', '[4]', 0, 'Layanannya sangat baik sekali', NULL, '2021-04-14 10:48:42', NULL, NULL, NULL, NULL, '7600', 1, '2021-04-14 10:48:54', NULL, '2021-04-06 02:45:01', '2021-04-14 03:48:54'),
(50, 'Hasanuddin Nur', 'polewiratama@gmail.com', '085259704791', NULL, NULL, 8, '1', '[1]', 0, 'Versi PDF dan Word', NULL, '2022-07-19 09:18:46', NULL, NULL, NULL, NULL, '7601', 1, '2022-07-19 09:18:49', NULL, '2021-04-10 10:27:44', '2022-07-19 02:18:49'),
(51, 'Fina Afriza', 'finaaprizajmb@gmail.com', '082269683315', NULL, NULL, 7, '5', '[9]', 0, 'Ingin mengetahui data BPS provinsi Sulawesi barat', NULL, '2021-04-29 11:28:41', NULL, NULL, NULL, NULL, '7600', 1, '2021-04-29 11:28:44', NULL, '2021-04-29 01:15:51', '2021-04-29 04:28:44'),
(52, 'Jeffriansyah', 'jeffriamori77@gmail.com', '082290746277', NULL, NULL, 7, '5', '[9]', 0, 'Mohon informasinya, dimana saya bisa mendapatkan metadata Ternak Hewan Kabupaten Majene yang terbaru, dikarenakan di bps majene, link yang di share tidak dapat di akses. terima kasih', NULL, '2021-06-09 14:44:05', NULL, NULL, NULL, NULL, '7600', 1, '2021-06-09 14:44:08', NULL, '2021-06-09 00:37:28', '2021-06-09 07:44:08'),
(53, 'Ahmad', 'ahmadmamuju55@gmail.com', '082208220028', 3, '5', 10, '5', '[4]', 0, 'Pertahankan pelayanan yang telah berjalan saat ini dan berusaha terus menjadi yang terbaik', NULL, '2021-06-10 11:28:59', NULL, NULL, NULL, NULL, '7600', 1, '2021-06-10 11:29:08', NULL, '2021-06-09 12:00:14', '2021-06-10 04:29:08'),
(54, 'Ahmad', 'ahmadmamuju55@gmail.com', '082208220028', 3, '5', 10, '5', '[4]', 0, 'Pertahankan pelayanan yang telah berjalan saat ini dan berusaha terus menjadi yang terbaik', NULL, '2022-06-22 11:29:04', NULL, NULL, NULL, NULL, '7600', 1, '2022-06-22 11:29:09', NULL, '2022-06-21 12:00:18', '2022-06-22 04:29:09'),
(55, 'Andi Walinono', 'walinono8889@gmail.com', '085394112567', NULL, NULL, 8, '5', '[4]', 0, 'Alhamdulillah sdh baik pelayanan', NULL, '2021-07-08 14:53:53', NULL, NULL, NULL, NULL, '7600', 1, '2021-07-08 14:54:25', NULL, '2021-07-08 05:20:07', '2021-07-08 07:54:25'),
(56, 'Ahmad', 'ahmadabdurrahman99@gmail.com', '085242045499', NULL, NULL, 7, '5', '[4]', 0, 'semakin ditingkatkan excellent', NULL, '2021-10-11 14:39:40', NULL, NULL, NULL, NULL, '7600', 1, '2021-10-11 14:39:47', NULL, '2021-10-11 03:52:54', '2021-10-11 07:39:47'),
(57, 'dahlia', 'dahlia036energy@gmail.com', '085298767211', NULL, NULL, 7, '5', '[4]', 0, 'Pelayanan nya sangat baik walau harus menunggu antrian terlebih dahulu.', NULL, '2021-10-11 14:39:57', NULL, NULL, NULL, NULL, '7600', 1, '2021-10-11 14:40:03', NULL, '2021-10-11 06:43:06', '2021-10-11 07:40:03'),
(58, 'Ruti Tryana Telaumbanua', '211810590@stis.ac.id', '082277063040', 3, '5', 10, '5', '[4]', 0, 'Admin WA sudah sangat responsif dan membantu. Terimakasih BPS Provinsi Sulawesi Barat.', NULL, '2021-11-04 14:38:44', NULL, NULL, NULL, NULL, '7600', 1, '2021-11-04 14:39:03', NULL, '2021-11-03 10:42:40', '2021-11-04 07:39:03'),
(59, 'Faried Bainta', 'fariedbainta@gmail.com', '085255910409', 12, '5', 10, '4', '[4]', 0, 'pelayanannya baik, responnya cepat', NULL, '2021-12-29 14:44:20', NULL, NULL, NULL, NULL, '7600', 1, '2021-12-29 14:45:44', NULL, '2021-12-29 03:17:43', '2021-12-29 07:45:44'),
(60, 'sapriani kambawa', 'sapriani_kambawa@yahoo.co.id', '082290893524', 3, '5', 10, '5', '[4]', 0, 'pelayanan prima ramah dan cepat', NULL, '2021-07-01 14:55:40', NULL, NULL, NULL, NULL, '7600', 1, '2021-07-01 14:55:43', NULL, '2021-07-01 05:02:58', '2021-07-01 07:55:43'),
(61, 'sapriani kambawa', 'sapriani_kambawa@yahoo.co.id', '082290893524', 12, '5', 10, '5', '[4]', 0, 'mantap BPS Sulbar, terima kasih untuk pelayanan prima yang cepat dan responsif', NULL, '2022-02-09 14:55:48', NULL, NULL, NULL, NULL, '7600', 1, '2022-02-09 14:55:51', NULL, '2022-02-09 04:02:59', '2022-02-09 07:55:51'),
(62, 'sapriani kambawa', 'sapriani_kambawa@yahoo.co.id', '082290893524', 12, '5', 10, '5', '[4]', 0, 'pelayanan prima ramah dan cepat', NULL, '2021-12-29 14:55:57', NULL, NULL, NULL, NULL, '7600', 1, '2021-12-29 14:55:59', NULL, '2021-12-29 03:03:00', '2021-12-29 07:55:59'),
(63, 'Wawan sulviantono', 'sulviantonowawan@gmail.com', '085242461906', 12, '5', 10, '5', '[1,4]', 0, 'Pelayanan yg sdh baik agar bisa dipertahankan dan yg kurang baik diperbaiki dan ditingkatkan', NULL, '2022-01-12 14:41:33', NULL, NULL, NULL, NULL, '7600', 1, '2022-01-12 14:41:40', NULL, '2022-01-12 06:54:56', '2022-01-12 07:41:40'),
(64, 'Wawan sulviantono', 'sulviantonowawan@gmail.com', '085242461906', 12, '5', 10, '5', '[4]', 0, 'Dipertahankan pelayanannya dan terus ditingkatkan', NULL, '2022-05-20 14:56:05', NULL, NULL, NULL, NULL, '7600', 1, '2022-05-20 14:56:07', NULL, '2022-05-20 05:10:31', '2022-05-20 07:56:07'),
(65, 'Wawan jurwanto', 'wawanjurwanto86@gmail.com', '085242231200', 12, '5', 10, '5', '[4]', 0, 'Puas dalam pelayanan nya', NULL, '2022-01-25 14:42:39', NULL, NULL, NULL, NULL, '7600', 1, '2022-01-25 14:42:47', NULL, '2022-01-25 04:33:59', '2022-01-25 07:42:47'),
(66, 'Inas R', 'inasrafidah0@gmail.com', '089653233406', 12, '5', 10, '5', '[4]', 0, 'Pelayanan yang ramah dan cepat tanggap', NULL, '2022-01-25 14:39:28', NULL, NULL, NULL, NULL, '7600', 1, '2022-01-25 14:42:20', NULL, '2022-01-25 16:48:59', '2022-01-25 07:42:20'),
(67, 'ronny hidayat', 'ronnyacer@gmail.com', '081218086369', NULL, NULL, 7, '5', '[1]', 0, 'terus di jaga dan ditingkatkan kualitas pelayanannya', NULL, '2022-02-23 14:43:19', NULL, NULL, NULL, NULL, '7600', 1, '2022-02-23 14:43:23', NULL, '2022-02-22 13:49:50', '2022-02-23 07:43:23'),
(68, 'Imelda', 'mellaabbas02@gmail.com', '08521707532', 12, '5', 10, '5', '[4]', 0, 'Sangat Puas dengan layanan yang diberikan', NULL, '2022-02-09 14:43:33', NULL, NULL, NULL, NULL, '7600', 1, '2022-02-09 14:43:38', NULL, '2022-02-09 03:49:51', '2022-02-09 07:43:38'),
(69, 'Imelda', 'mellaabbas02@gmail.com', '08521707532', NULL, NULL, 7, '5', '[4]', 0, 'Sangat Puas dengan layanan yang diberikan', NULL, '2022-03-04 15:05:37', NULL, NULL, NULL, NULL, '7600', 1, '2022-03-04 15:05:40', NULL, '2022-03-04 03:49:53', '2022-03-04 08:05:40'),
(70, 'Muhammad Saleh', 'alefaisal@gmail.com', '0811467473', 12, '5', 10, '5', '[4]', 0, 'Apresiasi terhadap respon dan pelayanan yang cepat', NULL, '2022-03-04 14:43:55', NULL, NULL, NULL, NULL, '7600', 1, '2022-03-04 14:44:28', NULL, '2022-03-04 04:29:52', '2022-03-04 07:44:28'),
(71, 'Fitri Pratiwi', 'twkasim@gmail.com', '085242293046', 12, '5', 10, '5', '[4]', 0, 'Baik dan ramah', NULL, '2022-03-10 14:44:46', NULL, NULL, NULL, NULL, '7600', 1, '2022-03-10 14:44:51', NULL, '2022-03-10 04:22:20', '2022-03-10 07:44:51'),
(72, 'Ni Nyoman Nopiyanti', 'ninyomannopiyanti69@gmail.com', '082217568210', 12, '4', 10, '4', '[1,4]', 0, 'Bagi saya pelayanan untuk data sudah baik, tapi harus lebih cepat respon🙏 karena data yang dibutuhkan konsumen sangat di perlukan.\r\nTerima kasih', NULL, '2022-03-22 14:45:03', NULL, NULL, NULL, NULL, '7600', 1, '2022-03-22 14:45:07', NULL, '2022-03-22 04:01:50', '2022-03-22 07:45:07'),
(73, 'M Faisal Hanapi', 'imamrevifaisalmamuju@gmail.com', '081355877081', NULL, NULL, 7, '4', '[9]', 0, 'Minta tolong dikirim releasenya saya wartawan kantor berita ANTARA', NULL, '2022-04-02 14:45:19', NULL, NULL, NULL, NULL, '7600', 1, '2022-04-02 14:45:23', NULL, '2022-04-02 06:42:33', '2022-04-02 07:45:23'),
(74, 'Imran', 'imranalim2011@gmail.com', '085230673516', 12, '4', 10, '4', '[1]', 0, 'Permintaan data sebaiknya mendapatkan respon sesegera mungkin', NULL, '2022-04-26 14:43:07', NULL, NULL, NULL, NULL, '7600', 1, '2022-04-26 14:45:29', NULL, '2022-04-26 07:31:14', '2022-04-26 07:45:29'),
(75, 'Rezki Amaliah', 'rezkiamaliah05@gmail.com', '082292339983', NULL, NULL, 7, '5', '[4]', 0, 'Update informasi semakin baik, data yang disajikan juga lengkap, memudahkan kami dalam mencari informasi data. Selain website, pelayanan whatsapp juga sangat membantu. Semoga kedepannya bisa lebih baik lagi, memberi inovasi untuk melayani masyarakat.', NULL, '2022-06-07 14:34:26', NULL, NULL, NULL, NULL, '7600', 1, '2022-06-07 14:45:38', NULL, '2022-06-07 07:23:19', '2022-06-07 07:45:38'),
(76, 'Jamaluddin', NULL, '08114228121', 12, '5', 10, '5', '[1]', 0, 'Agar BPS menyediakan data jumlah penduduk per desa yang terbaru di awal tahun', NULL, '2022-04-07 16:07:05', NULL, NULL, NULL, NULL, '7600', 1, '2022-04-07 16:07:09', NULL, '2022-04-07 09:05:50', '2022-04-07 09:07:09'),
(77, 'elvy suhartaty amir', NULL, '082291036393', 12, '5', 10, '5', '[4]', 0, 'terima kasih untuk layanannya', NULL, '2022-05-25 16:10:44', NULL, NULL, NULL, NULL, '7600', 1, '2022-05-25 16:10:47', NULL, '2022-05-25 09:10:30', '2022-05-25 09:10:47'),
(78, 'Imran', NULL, '085230673516', 12, '5', 10, '5', '[4]', 0, 'terima kasih', NULL, '2022-05-20 16:13:29', NULL, NULL, NULL, NULL, '7600', 1, '2022-05-20 16:13:33', NULL, '2022-05-20 09:13:15', '2022-05-20 09:13:33'),
(79, 'Nurhikma', NULL, '082343473267', 12, '5', 10, '5', '[4]', 0, 'mantap BPS', NULL, '2022-03-22 16:16:49', NULL, NULL, NULL, NULL, '7600', 1, '2022-03-22 16:16:51', NULL, '2022-03-22 09:16:13', '2022-03-22 09:16:51'),
(80, 'Mastura', NULL, '082337064303', 12, '5', 10, '5', '[4]', 0, 'terima kasih', NULL, '2022-06-02 16:21:45', NULL, NULL, NULL, NULL, '7600', 1, '2022-06-02 16:21:47', NULL, '2022-06-02 09:20:48', '2022-06-02 09:21:47'),
(81, 'NURHALIA', 'lhyaashar@gmail.com', '085252194078', NULL, NULL, 7, '5', '[1]', 0, 'mohon juga untuk mengadakan Survey pendataan Anak Tidak Sekolah dan data Warisan Budaya Sulawesi Barat', NULL, '2022-07-30 14:58:11', NULL, NULL, NULL, NULL, '7600', 1, '2022-07-30 14:58:14', NULL, '2022-07-19 06:40:36', '2022-07-30 07:58:14'),
(82, 'hirlan khaeri', 'jakabadung1924@gmail.com', '+6285262320063', NULL, NULL, 7, '5', '[4]', 0, 'okeh lanjutkan', NULL, '2022-07-20 07:56:36', '2022-07-20 17:20:53', 'asas', NULL, NULL, '7604', 0, NULL, NULL, '2022-07-20 00:55:47', '2022-07-20 10:20:53'),
(83, 'Sutrisno', 'sutrisno8@pajak.go.id', '081258384817', NULL, NULL, 8, '5', '[4]', 0, 'Sangat membantu pekerjaan saya. Terimakasih BPS Kabupaten Pasangkayu.', NULL, '2022-07-26 17:27:12', NULL, NULL, NULL, NULL, '7605', 1, '2022-07-26 17:27:19', NULL, '2022-07-25 09:09:38', '2022-07-26 10:27:19'),
(84, 'Muh Khaerun', 'mhairun174@gmail.com', '085396721685', NULL, NULL, 7, '5', '[1]', 0, 'Lebih di sosialisasikan lagi alamat webnya. Agar lebuh memudahkan stakeholder dalam permintaan data tnpa harus ke kantor', NULL, '2022-08-17 13:16:20', NULL, NULL, NULL, NULL, '7600', 1, '2022-08-17 13:16:24', NULL, '2022-08-01 03:43:23', '2022-08-17 06:16:24'),
(85, 'Wina Nurfaidah', 'winanurfaidah102000@gmail.com', '082377408076', 3, '5', 10, '5', '[4]', 0, 'Terimakasih banyak atas respon dan bantuannya, sangat cepat, ramah dan membantu sekali', NULL, '2022-08-17 13:16:30', NULL, NULL, NULL, NULL, '7600', 1, '2022-08-17 13:16:32', NULL, '2022-08-03 04:18:09', '2022-08-17 06:16:32'),
(86, 'Intan', 'intanbasri76@gmail.com', '081340666314', 3, '5', 10, '5', '[4]', 0, 'Layanan ini sangat membantu saya dalam mendapatkan informasi dan juga layanan ini sangat cepat memberi respon\r\nTerimakasih', NULL, '2022-08-17 13:16:40', NULL, NULL, NULL, NULL, '7600', 1, '2022-08-17 13:16:43', NULL, '2022-08-15 01:42:32', '2022-08-17 06:16:43'),
(87, 'Fikri', 'fikrihasan2512@gmail.com', '085696011067', NULL, NULL, 7, '2', NULL, 0, 'Data iklim kec binuang tahunan', NULL, NULL, NULL, NULL, NULL, NULL, '7602', 0, NULL, NULL, '2022-08-20 15:02:01', '2022-08-20 15:02:01'),
(88, 'Faried Bainta ST MSi', 'fariedbainta@gmail.com', '0845255910409', NULL, NULL, 7, '4', '[1]', 0, 'Pelayanannya baik, walapun responnya agak lambat, semoga kedepan respon adminnya lebih cepat.. secara umum sudah mantap', NULL, '2022-08-22 15:25:03', NULL, NULL, NULL, NULL, '7600', 1, '2022-08-22 15:25:07', NULL, '2022-08-22 07:52:55', '2022-08-22 08:25:07'),
(89, 'Muhsin Husain', 'muhsinhusain@gmail.com', '0811822424', 3, '5', 10, '5', '[4]', 0, 'Terima kasih pelanannya. Cepat & sesuai dg data yg kami inginkan', NULL, '2022-08-30 12:25:35', NULL, NULL, NULL, NULL, '7600', 1, '2022-08-30 12:25:36', NULL, '2022-08-22 09:22:56', '2022-08-30 05:25:36'),
(90, 'Ni Nyoman Nopiyanti', 'ninyomannopiyanti69@gmail.com', '082217568210', 3, '4', 10, '3', '[4]', 0, 'Respon baik', NULL, '2022-08-30 12:25:25', NULL, NULL, NULL, NULL, '7600', 1, '2022-08-30 12:25:29', NULL, '2022-08-24 13:53:43', '2022-08-30 05:25:29'),
(91, 'Andy Ariskha Masdar', 'ariskhamasdar98rail@gmail.com', '082198310096', NULL, NULL, 11, '5', '[1]', 0, 'Updating data BPS sebaiknya di lakukan sampai di level kabupaten', NULL, '2022-08-30 12:23:49', NULL, NULL, NULL, NULL, '7600', 1, '2022-08-30 12:24:05', NULL, '2022-08-30 05:17:59', '2022-08-30 05:24:05'),
(92, 'Dwi Ardian', 'dwi.ardian@bps.go.id', '085255136252', NULL, NULL, 11, '5', '[1]', 0, 'Sebaiknya pastikan yang diundang adalah kepala dinas terkait, biar bisa melihat kebijakan dengan baik.', NULL, '2022-08-30 12:24:13', NULL, NULL, NULL, NULL, '7600', 1, '2022-08-30 12:24:15', NULL, '2022-08-30 05:18:28', '2022-08-30 05:24:15'),
(93, 'Martin', 'mrtnluter31@gmail.com', '085238809301', NULL, NULL, 11, '5', '[9]', 0, '---', NULL, '2022-08-30 12:23:58', NULL, NULL, NULL, NULL, '7600', 1, '2022-08-30 12:24:03', NULL, '2022-08-30 05:18:55', '2022-08-30 05:24:03'),
(94, 'Muh Rusdin', 'rusdinsulbar@gmail.com', '081342974268', NULL, NULL, 11, '4', '[1]', 0, 'waktu diskusi lebih lama', NULL, '2022-08-30 12:24:19', NULL, NULL, NULL, NULL, '7600', 1, '2022-08-30 12:24:21', NULL, '2022-08-30 05:19:21', '2022-08-30 05:24:21'),
(95, 'Muh Firdaus', 'firdaus12107@gmail.com', '081242423936', NULL, NULL, 11, '4', '[1]', 0, 'Bisa lebih di optimalkan dalam penyajian data dan sinkronisasi data', NULL, '2022-08-30 12:24:28', NULL, NULL, NULL, NULL, '7600', 1, '2022-08-30 12:24:29', NULL, '2022-08-30 05:20:11', '2022-08-30 05:24:29'),
(96, 'M Aco Suaib', 'macosamrin@gmail.com', '081241813555', NULL, NULL, 11, '4', '[1]', 0, 'Dilanjutkan', NULL, '2022-08-30 12:24:46', NULL, NULL, NULL, NULL, '7600', 1, '2022-08-30 12:24:48', NULL, '2022-08-30 05:20:35', '2022-08-30 05:24:48'),
(97, 'Arman', 'armanfromwest@gmail.com', '081355482579', NULL, NULL, 11, '4', '[1]', 0, 'Perlu tindaklanjut dlm bentuk rencana aksi', NULL, '2022-08-30 12:24:38', NULL, NULL, NULL, NULL, '7600', 1, '2022-08-30 12:24:40', NULL, '2022-08-30 05:21:23', '2022-08-30 05:24:40'),
(98, 'Drs H Farid Wajdi M', 'faridmandar@gmail.com', '081341934366', NULL, NULL, 11, '4', '[1]', 0, 'Durasi singkat', NULL, '2022-08-30 12:24:53', NULL, NULL, NULL, NULL, '7600', 1, '2022-08-30 12:24:55', NULL, '2022-08-30 05:21:58', '2022-08-30 05:24:55'),
(99, 'Nurdawati Jusman', 'nurdawatirahman@gmail.com', '081355217677', NULL, NULL, 11, '4', '[9]', 0, '----', NULL, '2022-08-30 12:25:00', NULL, NULL, NULL, NULL, '7600', 1, '2022-08-30 12:25:02', NULL, '2022-08-30 05:22:23', '2022-08-30 05:25:02'),
(100, 'Awaluddin', 'awalabdullah85@gmail.com', '081342336466', NULL, NULL, 11, '5', '[1]', 0, 'Kegiatan ini agar dapat berkelanjutan', NULL, '2022-08-30 12:25:07', NULL, NULL, NULL, NULL, '7600', 1, '2022-08-30 12:25:08', NULL, '2022-08-30 05:22:45', '2022-08-30 05:25:08'),
(101, 'Muhammad Saleh', 'alefaisal@gmail.com', '0811467473', NULL, NULL, 11, '5', '[1]', 0, 'Agar Koordinasi BPS dengan Seluruh OPD lebih ditingkatkan, pembuatan Pojok Data di Bappeda', NULL, '2022-08-30 12:25:15', NULL, NULL, NULL, NULL, '7600', 1, '2022-08-30 12:25:17', NULL, '2022-08-30 05:23:07', '2022-08-30 05:25:17'),
(102, 'Septika', NULL, '081319277255', NULL, NULL, 11, '5', '[9]', 0, '---', NULL, '2022-08-30 12:39:05', NULL, NULL, NULL, NULL, '7600', 1, '2022-08-30 12:39:08', NULL, '2022-08-30 05:38:38', '2022-08-30 05:39:08'),
(103, 'Junaedi', 'junbarends@gmail.com', '085964199850', NULL, NULL, 7, '5', NULL, 0, 'Sudah sangat bagus, harapan kami semoga dimasa depan, ada info loker yg bsa di pantau', NULL, NULL, NULL, NULL, NULL, NULL, '7605', 0, NULL, NULL, '2022-09-01 13:22:37', '2022-09-01 13:22:37'),
(104, 'syarif kurniawan', 'syarifkurniawan001@gmail.com', '085655875535', 12, '5', 10, '5', '[4]', 0, 'pelayanan baik', NULL, '2022-09-14 08:52:05', NULL, NULL, NULL, NULL, '7600', 1, '2022-09-14 08:52:06', NULL, '2022-09-05 03:56:05', '2022-09-14 01:52:06'),
(105, 'Andi Hertasnin', 'habibihertasmin@gmail.com', '085292589003', NULL, NULL, 8, '5', '[4]', 0, 'Memuaskan pelayanannya', NULL, '2022-09-14 08:52:12', NULL, NULL, NULL, NULL, '7600', 1, '2022-09-14 08:52:14', NULL, '2022-09-06 06:58:20', '2022-09-14 01:52:14'),
(106, 'Syahrian s', 'syahriansyahrir06@gmail.com', '082291596294', NULL, NULL, 8, '3', '[9]', 0, 'Respon', NULL, '2022-09-14 08:54:08', NULL, NULL, NULL, NULL, '7600', 1, '2022-09-14 08:54:10', NULL, '2022-09-07 09:50:14', '2022-09-14 01:54:10'),
(107, 'Kasmat', 'kasmatsojc123@gmail.com', '081245121993', NULL, NULL, 7, '5', '[1]', 0, 'Agar kedepan lebih ditingkatkan lagi', NULL, '2022-09-14 08:52:25', NULL, NULL, NULL, NULL, '7600', 1, '2022-09-14 08:52:28', NULL, '2022-09-08 08:58:46', '2022-09-14 01:52:28'),
(108, 'Irwan Waris', 'irwanwaris@yahoo.co.id', '081340357186', NULL, NULL, 7, '5', '[4]', 0, 'Pelayanan sangat baik memenuhi kebutuhan data masyarakat', NULL, '2022-09-14 08:52:50', NULL, NULL, NULL, NULL, '7600', 1, '2022-09-14 08:52:52', NULL, '2022-09-08 11:54:42', '2022-09-14 01:52:52'),
(109, 'agus okalaksana sadikin', 'laksanaoka@gmail.com', '081310865495', 12, '4', 10, '4', '[1]', 0, 'datanya lebih banyak lagi yang bisa dishare', NULL, '2022-09-14 08:52:59', NULL, NULL, NULL, NULL, '7600', 1, '2022-09-14 08:53:01', NULL, '2022-09-09 03:22:40', '2022-09-14 01:53:01'),
(110, 'Muh Ikhwanul Muin ST', 'ikhwan.uzumaki09@gmail.com', '083138133000', NULL, NULL, 11, '5', '[1]', 0, 'untuk penyajian datanya bagi saya sangat memberikan pengetahuan baru dalam menyajikan data. cuman kayaknya perlu pembelajaran lanjutan terkait cara mengolah data mentah dari OPD sehingga menghasilkan data yg baik. contohnya IPM pada indikator makro yang memiliki beberapa variabel. Soalnya banyak dari kami yang tidak memiliki basic pengolahan data', NULL, '2022-09-14 08:53:16', NULL, NULL, NULL, NULL, '7600', 1, '2022-09-14 08:53:18', NULL, '2022-09-12 03:37:43', '2022-09-14 01:53:18'),
(111, 'Nurul Ilmi Amaliyah', 'ilmiamaliyahnurul@gmail.com', '085776326204', NULL, NULL, 11, '5', '[4]', 0, 'Materi yang disampaikan sangat jelas dan mudah dimengerti.', NULL, '2022-09-14 08:53:27', NULL, NULL, NULL, NULL, '7600', 1, '2022-09-14 08:53:30', NULL, '2022-09-12 03:40:21', '2022-09-14 01:53:30'),
(112, 'Nurul Ilmi Amaliyah', 'ilmiamaliyahnurul@gmail.com', '085776326204', NULL, NULL, 11, '5', '[4]', 0, 'Materi yang disampaikan sangat jelas dan mudah dimengerti.', NULL, '2022-10-21 07:50:58', NULL, NULL, NULL, NULL, '7600', 1, '2022-10-21 07:51:15', NULL, '2022-09-12 03:40:24', '2022-10-21 00:51:15'),
(113, 'Muh Firdaus', 'firdaus12107@gmail.com', '081242423936', NULL, NULL, 11, '5', '[4]', 0, 'materi sangat jelas, dan penyampaian materi juga jelas.', NULL, '2022-09-14 08:53:38', NULL, NULL, NULL, NULL, '7600', 1, '2022-09-14 08:53:39', NULL, '2022-09-12 03:42:38', '2022-09-14 01:53:39'),
(114, 'Saeful Bahri', 'saefulbahri.1990@gmail.com', '08118162109', NULL, NULL, 11, '5', '[4]', 0, 'sangat bagus, semoga kegiatan serupa bisa dilakukan lagi', NULL, '2022-09-14 08:53:46', NULL, NULL, NULL, NULL, '7600', 1, '2022-09-14 08:53:48', NULL, '2022-09-12 04:45:52', '2022-09-14 01:53:48'),
(115, 'musrifa', 'musrifa.hamka@gmail.com', '082235017045', NULL, NULL, 11, '5', '[4]', 0, 'dengan sharing session dengan tim data bappeda sangat membantu dalam pengelolaan data pembangun sulbar', NULL, '2022-09-14 08:53:56', NULL, NULL, NULL, NULL, '7600', 1, '2022-09-14 08:53:59', NULL, '2022-09-12 04:49:49', '2022-09-14 01:53:59'),
(116, 'Rijal Abdul Malik', 'rijal.a.em@gmail.com', '081221866558', NULL, NULL, 11, '5', '[4]', 0, 'Sudah bagus', NULL, '2022-09-19 10:29:29', NULL, NULL, NULL, NULL, '7600', 1, '2022-09-19 10:30:03', NULL, '2022-09-19 03:13:29', '2022-09-19 03:30:03'),
(117, 'Dita Ariningrum', NULL, '085222955588', NULL, NULL, 11, '5', '[4]', 0, 'sudah bagus', NULL, '2022-09-19 10:29:48', NULL, NULL, NULL, NULL, '7600', 1, '2022-09-19 10:29:57', NULL, '2022-09-19 03:14:29', '2022-09-19 03:29:57'),
(118, 'Ahmad Zahidin', NULL, '08125479370', NULL, NULL, 11, '5', '[4]', 0, 'sudah bagus', NULL, '2022-09-19 10:32:07', NULL, NULL, NULL, NULL, '7600', 1, '2022-09-19 10:37:08', NULL, '2022-09-19 03:15:49', '2022-09-19 03:37:08'),
(119, 'Harry Bowo', NULL, '08159918047', NULL, NULL, 11, '5', '[4]', 0, 'Materi sangat mudah di pahami', NULL, '2022-09-19 10:30:13', NULL, NULL, NULL, NULL, '7600', 1, '2022-09-19 10:30:26', NULL, '2022-09-19 03:17:09', '2022-09-19 03:30:26'),
(120, 'Subakdo', 'div.pas_kanwilsulbar@yahoo.com', '082230669071', NULL, NULL, 13, '5', '[1]', 0, 'Agar pelayanan dipertahankan', NULL, '2022-10-21 07:50:39', NULL, NULL, NULL, NULL, '7600', 1, '2022-10-21 07:51:19', NULL, '2022-10-04 03:10:11', '2022-10-21 00:51:19'),
(121, 'Joko Ariwibowo', 'aryewb@gmail.com', '085242005145', NULL, NULL, 13, '5', '[4]', 0, 'Terus dipertahankan dan terus berkembang lebih baik demi melayani masyarakat... Sukses BPS Mamuju', NULL, '2022-10-21 07:50:27', NULL, NULL, NULL, NULL, '7600', 1, '2022-10-21 07:50:29', NULL, '2022-10-04 03:11:19', '2022-10-21 00:50:29'),
(122, 'NOVIAN ENDUS SANTOSO', 'Dilsolmupon@gmail.com', '087810633192', NULL, NULL, 13, '5', '[4]', 0, 'Pelayanan sudah prima.. \r\nMantap..', NULL, '2022-10-21 07:47:21', NULL, NULL, NULL, NULL, '7600', 1, '2022-10-21 07:47:25', NULL, '2022-10-04 03:15:49', '2022-10-21 00:47:25'),
(123, 'Robianto', 'robianto@kemenkumham.go.id', '082110908785', NULL, NULL, 13, '5', '[4]', 0, 'Pelayanan yang kami terima sangat baik dan memuaskan', NULL, '2022-10-21 07:46:52', NULL, NULL, NULL, NULL, '7600', 1, '2022-10-21 07:47:00', NULL, '2022-10-04 03:19:24', '2022-10-21 00:47:00'),
(124, 'Kopi', 'kopibatte7@gmail.com', '0821114561356', NULL, NULL, 7, '1', '[2,3]', 1, 'Selamat Malam BPS Mamasa. Terima kasih sudah menyajikan data statistik sebagai sumber informasi data valid dan terpercaya di Kabupaten Mamasa. Semoga kedepannya tetap mempertahankan kinerja luar biasa itu. \r\n\r\nDari sekian banyak program BPS Statistik Kab. Mamasa, saya sangat kecewa dengan kegiatan perekrutan Mitra BPS Kabupaten Mamasa bulan Februari lalu. Perekrutan ini  terkoneksi dan terintegrasi dengan BPS pusat, dimana peserta yang dinyatakan lolos akan menjadi mitra statistik Sampai pada kegiatan ST2023. Ini dikuatkan dengan informasi grafik pendaftaran di akun media Sosial BPS Kabupaten Mamasa (25 Februari 2021) yang lalu. Dan juga beberapa argumen yang mendukung dari pihak BPS Kab. Mamasa saat kegiatan pelatihan SP2021 lanjutan. \r\n\r\nPeserta yang dinyatakan lolos juga dipasilitasi dengan data digital dari BPS pusat dan terintegrasi dengan Aplikasi SOBAT BPS. \r\n\r\nSaya sebagai salah satu bagian dari Mitra BPS Kabupaten Mamasa yang dinyatakan lolos dan mendapat SK dalam melakukan tugas pendataan lanjutan sensus penduduk SP2021; Sekali lagi, sangat kecewa dengan kegiatan perekrutan Mitra BPS Kab.Mamasa yang tidak memperhatikan prosedur perekrutan yang sebenarnya. \r\n\r\nBPS Mamasa lalai dalam menjaga manajemen organisasi dan kinerja lembaga dimana Mitra Mereka yang baru seakan tidak memiliki kemampuan sehingga menggantikannya dengan yang baru pula tanpa memperhatikan pedoman perekrutan yang sebenarnya.\r\n\r\nMohon maaf, saya menilai \"ini adalah kinerja paling buruk menurut saya untuk BPS Kab Mamasa\". Alangkah lebih baiknya jika perekrutan tidak dipublikasikan jika jiwa nasionalis dan demokratis tidak dikedepankan. Ini hanya akan mengecewakan dan merugikan bagi kami yang ingin bekerja dan berbakti bagi Kab. Mamasa, tapi dihalangi oleh prinsip pekerjaan seperti itu...\r\n\r\n\r\nMohon maaf, saya menyamarkan Identitas Saya, Namun Pastinya BPS Kabupaten Mamasa tahu betul bahwa pernah merektrut mitra tapi dikaramkan ditengah jalan....', NULL, '2023-04-06 09:16:40', NULL, NULL, NULL, NULL, '7603', 0, NULL, NULL, '2022-10-05 13:53:48', '2023-04-06 02:16:40'),
(125, 'Warli', 'dewimedialestari.sales@gmail.com', '081327166616', 12, '5', 10, '5', '[4]', 0, 'Pelayanan yang ramah, fast respon dan informatif , terimakasih BPS Provinsi Sulawesi Barat', NULL, '2022-10-21 07:46:43', NULL, NULL, NULL, NULL, '7600', 1, '2022-10-21 07:46:58', NULL, '2022-10-06 04:14:40', '2022-10-21 00:46:58'),
(126, 'Dede Sukaputra', 'dede.suka96@gmail.com', '0811101342', 12, '5', 10, '5', '[4]', 0, 'Responsif', NULL, '2022-10-21 07:46:29', NULL, NULL, NULL, NULL, '7600', 1, '2022-10-21 07:47:06', NULL, '2022-10-06 04:58:29', '2022-10-21 00:47:06'),
(127, 'Kopi', 'kopibatte7@gmail.com', '0821114561356', NULL, NULL, 9, '1', NULL, 0, 'Sekali lagi...\r\n\r\nTolong Bapak/Ibu  sampaikan ke BPS Kabupaten Mamasa, kalau membuat program harus direliasasikan dengan baik apalagi jika programnya menyangkut orang lain. Terlebih merombak kegiatan dan keputusan ditengah jalan. Saya mitranya yang lolos seleksi pada bulan Februari lalu mendapat SK tugas pada pendataan lanjutan sensus SP2021 namun tidak dilanjutkan pada kegiatan surfei lainnya tanpa pemberitahuan dan tembusan apapun.  Padahal informasi grafik pendataan yang dirilis oleh BPS Kabupaten Mamasa tertaut informasi bahwa mitra statistik yang lolos akan diikutkan survei Pertanian Terintegrasi/SITASI dan survei lainnya di tahun 2022   https://www.facebook.com/100069259747518/posts/pfbid02USywe5BfKBHM6wy35nJBC7LWWFZCUDn1Yf8JC8M5guTGf9xEnrk71bKhB4gT1AKPl/?app=fbl .\r\n\r\n Ini hanya akan berdampak penilaian buruk pada BPS Kabupaten Mamasa yang tidak konsisten dengan apa yang mereka programkan. Mohon untuk disampaikan, supaya dilain waktu dalam mengemban tugas dan amanat sebagai Lembaga Pemerintah dapat memberikan rasa kenyamanan kepada masyarakat terlebih mengedepankan Pancasila sebagai dasar dan pedoman hidup bersama dalam pengabdian kepada Negeri Kita Tercinta..', NULL, NULL, NULL, NULL, NULL, NULL, '7603', 0, NULL, NULL, '2022-10-07 04:47:47', '2022-10-07 04:47:47'),
(128, 'Kopi', 'kopibatte7@gmail.com', '0821114561356', NULL, NULL, 12, '5', '[1,4]', 0, 'Sangat puas dengan kinerja terlebih dalam menyajikan data mayarakat yang valid.\r\n\r\n\r\nTolong Bapak/Ibu  sampaikan ke BPS Kabupaten Mamasa, kalau membuat program harus direliasasikan dengan baik apalagi jika programnya menyangkut orang lain. Terlebih merombak kegiatan dan keputusan ditengah jalan. Saya mitranya yang lolos seleksi pada bulan Februari lalu mendapat SK tugas pada pendataan lanjutan sensus SP2021 namun tidak dilanjutkan pada kegiatan survei lainnya tanpa pemberitahuan dan tembusan apapun.  Padahal informasi grafik pendataan yang dirilis oleh BPS Kabupaten Mamasa tertaut informasi bahwa mitra statistik yang lolos akan diikutkan survei Pertanian Terintegrasi/SITASI dan survei lainnya di tahun 2022   https://www.facebook.com/100069259747518/posts/pfbid02USywe5BfKBHM6wy35nJBC7LWWFZCUDn1Yf8JC8M5guTGf9xEnrk71bKhB4gT1AKPl/?app=fbl .\r\n\r\n Ini hanya akan berdampak penilaian buruk pada BPS Kabupaten Mamasa yang tidak konsisten dengan apa yang mereka programkan. Mohon untuk disampaikan, supaya dilain waktu dalam mengemban tugas dan amanat sebagai Lembaga Pemerintah dapat memberikan rasa kenyamanan kepada masyarakat terlebih mengedepankan Pancasila sebagai dasar dan pedoman hidup bersama dalam pengabdian kepada Negeri Kita Tercinta..', NULL, '2022-10-21 07:55:02', NULL, NULL, NULL, NULL, '7600', 1, '2022-10-21 07:55:04', NULL, '2022-10-07 04:54:52', '2022-10-21 00:55:04'),
(129, 'Aslindah', 'aslindahaslindah831@gmail.com', '085240321641', 12, '5', 10, '5', '[4]', 0, 'Semoga BPS kedepannya dapat tetap memberikan pelayanan maksimal', NULL, '2022-10-21 07:45:44', NULL, NULL, NULL, NULL, '7600', 1, '2022-10-21 07:45:50', NULL, '2022-10-07 06:33:25', '2022-10-21 00:45:50'),
(130, 'Masriani', 'masrianibaya48@gmail.com', '085281886466', NULL, NULL, 10, '1', NULL, 0, 'Saya termotivasi dengan teman saya yang kerja di bps', NULL, NULL, NULL, NULL, NULL, NULL, '7604', 0, NULL, NULL, '2022-10-07 09:39:00', '2022-10-07 09:39:00'),
(131, 'Badrayanti Wulandhari', 'bookishpetals@gmail.com', '085240796361', NULL, NULL, 11, '5', '[4]', 0, 'Pelayanan yang keren dan informatif', NULL, '2023-01-24 12:51:44', NULL, NULL, NULL, NULL, '7600', 1, '2023-01-24 12:51:46', NULL, '2022-10-28 04:01:19', '2023-01-24 05:51:46'),
(132, 'Mahesa rizky pratama', 'mahesarizky477@gmail.com', '082292169195', NULL, NULL, 11, '5', '[4]', 0, 'Untuk pelayanan di kantor BPS Provinsi Sulawasi Barat saya menilai sangat baik dan para pegawai disana sangat ramah dalam menyambut kedatangan  kami para tamu undangan.', NULL, '2023-01-24 12:52:02', NULL, NULL, NULL, NULL, '7600', 1, '2023-01-24 12:52:24', NULL, '2022-10-28 04:07:59', '2023-01-24 05:52:24'),
(133, 'Sukardi', 'sukardisaleh@gmail.com', '081355762916', 12, '5', 1, '5', '[1]', 0, 'Dipertahankan pelayanannya', NULL, '2023-02-03 16:08:14', NULL, NULL, NULL, NULL, '7600', 1, '2023-02-03 16:08:16', NULL, '2022-10-31 03:10:50', '2023-02-03 09:08:16'),
(134, 'Sarman', 'sarmanyahya5@gmail.com', '085394511599', NULL, NULL, 7, '5', '[4]', 0, 'Terima kasih banyak atas pelayanan yang diberikan dan respon cepat terhadap pertanyaan dan aduan yang kami sampaikan', NULL, '2023-02-03 16:08:22', NULL, NULL, NULL, NULL, '7600', 1, '2023-02-03 16:08:24', NULL, '2022-10-31 09:09:24', '2023-02-03 09:08:24'),
(135, 'Faried Bainta', 'fariedbainta@gmail.com', '0845255910409', 12, '5', 10, '5', '[4]', 0, 'Sukses terus admin whatsApp  BPS, Pelayanan Mantab', NULL, '2023-02-03 16:08:30', NULL, NULL, NULL, NULL, '7600', 1, '2023-02-03 16:08:32', NULL, '2022-11-03 04:11:48', '2023-02-03 09:08:32'),
(136, 'Wahyu Sabtika', 'wahyusabtika.ws@gmail.com', '085659468597', NULL, NULL, 7, '5', '[4]', 0, 'Data yang diminta snagat sesuai, responnya cukup cepat', NULL, '2023-02-03 16:08:40', NULL, NULL, NULL, NULL, '7600', 1, '2023-02-03 16:08:41', NULL, '2022-11-22 09:01:44', '2023-02-03 09:08:41'),
(137, 'nurifad ridwan', 'nurifadridwan99@gmail.com', '085242960250', NULL, NULL, 7, '1', '[1]', 0, 'kenapa tidak bisa didapat luas lahan pertanian tahun 2021 ?', NULL, '2023-01-26 16:32:43', '2023-01-26 16:33:31', 'https://sulbar.bps.go.id/pressrelease/2022/11/01/1090/pada-2022--luas-panen-padi-diperkirakan-sebesar-71-47-ribu-hektare-dengan-produksi-sekitar-364-68-ribu-ton-gkg--jika-dikonversikan-menjadi-beras--maka-produksi-beras-pada-2022-diperkirakan-sebesar-209-45-ribu-ton.html', NULL, NULL, '7604', 0, NULL, NULL, '2023-01-23 13:35:08', '2023-01-26 09:33:31'),
(138, 'Irma yunita', 'halimayunitaahmad@gmail.com', '082191234135', 12, '5', 10, '5', '[4]', 0, 'Is the best,', NULL, '2023-01-24 12:52:59', NULL, NULL, NULL, NULL, '7600', 1, '2023-01-24 13:04:49', NULL, '2023-01-24 03:02:17', '2023-01-24 06:04:49'),
(139, 'Muh Fachri', 'muhfachri517@gmail.com', '082187289442', NULL, NULL, 7, '5', '[4]', 0, 'Datanya sangat bisa di andalkan sebagai bahan anev kami kepimpinan terkhusus buat kami dari pihak kepolisian Terima kasih 🙏', NULL, '2023-01-24 12:53:28', NULL, NULL, NULL, NULL, '7600', 1, '2023-01-24 12:53:43', NULL, '2023-01-24 03:16:51', '2023-01-24 05:53:43'),
(140, 'Nuraeni Amir', 'renisiswanto@gmail.com', '082220424328', NULL, NULL, 13, '5', '[4]', 0, 'Terima kasih atas layanan data yang diberikan kepada OPD', NULL, '2023-01-24 12:53:59', NULL, NULL, NULL, NULL, '7600', 1, '2023-01-24 12:54:07', NULL, '2023-01-24 04:42:31', '2023-01-24 05:54:07'),
(141, 'Muchlis', 'muchlismuhlis422@gmail.com', '082393893821', 12, '5', 10, '5', '[4]', 0, 'terima kasih .', NULL, '2023-01-24 12:56:16', NULL, NULL, NULL, NULL, '7600', 1, '2023-01-24 13:04:45', NULL, '2023-01-24 04:45:07', '2023-01-24 06:04:45'),
(142, 'Misbahuddin', 'misbahuddin19711030@gmail.com', '085236656301', NULL, NULL, 13, '5', '[4]', 0, 'Data merupakan hal yang sangat urgen dalam berbagai hal. oleh karenanya dengan upaya yang dilakukan oleh Statistik dalam rangka kolaborasi dalam memperoleh data yang akurat ini adalah sebuah apresiasi yang luar biasa. Tanpa data maka dalam hal perencanaan itu adalah kesalahan terbesar oleh seorang perencana.', NULL, '2023-01-24 12:54:37', NULL, NULL, NULL, NULL, '7600', 1, '2023-01-24 12:54:47', NULL, '2023-01-24 04:46:24', '2023-01-24 05:54:47'),
(143, 'DIAN PANCAWATY', 'dian.pancawaty@gmail.com', '08114305005', NULL, NULL, 13, '4', '[4]', 0, 'sangat membantu dalam pendampingan untuk mendapatkan data-data sesuai kebutuhan indikator sehingga data yang akan di gunakan dapat diyakini sudah sesuai dan akurat, semoga akses konsultasi dan pendampingan ini dapat terus konsisten berjalan. sukses terus BPS Sulbar, semoga Sulbar dapat mewujidkan satu data yang akurat untuk intervensi seluruh program pembangunan di Sulbar.', NULL, '2023-01-24 12:55:13', NULL, NULL, NULL, NULL, '7600', 1, '2023-01-24 12:55:18', NULL, '2023-01-24 05:03:03', '2023-01-24 05:55:18'),
(144, 'Erik Kalalembang', NULL, '085399134442', NULL, NULL, 13, '5', '[1]', 0, 'Semoga BPS terus melakukan pembinaan kepada Pemda, khususnya walidata.', NULL, '2023-01-24 12:55:32', NULL, NULL, NULL, NULL, '7600', 1, '2023-01-24 12:55:37', NULL, '2023-01-24 05:47:20', '2023-01-24 05:55:37'),
(145, 'Purnama SP MKes', 'purpurnama077@gmail', '085299157376', NULL, NULL, 13, '4', '[1]', 0, 'Semoga kegiatan kolaborasi data tetap terjalin, dan ada tindak lanjutnya', NULL, '2023-01-24 12:55:47', NULL, NULL, NULL, NULL, '7600', 1, '2023-01-24 12:55:53', NULL, '2023-01-24 05:50:39', '2023-01-24 05:55:53'),
(146, 'Halimah', 'debynasruddin@gmail.com', '085242757105', NULL, NULL, 13, '3', '[1]', 0, 'Saran Sy smoga kaloborasi ini berlanjut sehingga Kami diDinas dpt memperoleh Data yg mudah, cpt & akurat..', NULL, '2023-02-03 14:01:44', NULL, NULL, NULL, NULL, '7600', 1, '2023-02-03 14:01:54', NULL, '2023-01-24 07:57:21', '2023-02-03 07:01:54'),
(147, 'Muhammad Athar', 'rauf_athar@yahoo.com', '082152787005', NULL, NULL, 13, '5', '[1,4]', 0, 'Sangat membantu dan solutif, kami berharap hal baik ini terus berlanjut. Pendekatannya lebih persuasif sehingga dpt meminimalisir rasa canggung.\r\nTerimakasih untuk hal-hal yang baik ini dan sukses selalu.', NULL, '2023-02-03 14:02:09', NULL, NULL, NULL, NULL, '7600', 1, '2023-02-03 14:02:17', NULL, '2023-01-24 11:31:34', '2023-02-03 07:02:17'),
(148, 'Nuraidi', 'Nuraidi.aminullah@gmail.com', '0811444067', NULL, NULL, 13, '3', '[1]', 0, 'Disegerakan satu data untuk Sulawesi Barat', NULL, '2023-02-03 14:02:26', NULL, NULL, NULL, NULL, '7600', 1, '2023-02-03 14:02:31', NULL, '2023-01-25 00:19:21', '2023-02-03 07:02:31'),
(149, 'achmad harjadinata', 'achmadharjadinata1988@gmail.com', '085652052052', NULL, NULL, 13, '5', '[4]', 0, 'cukup baik', NULL, '2023-02-03 14:02:43', NULL, NULL, NULL, NULL, '7600', 1, '2023-02-03 14:02:49', NULL, '2023-01-25 01:04:50', '2023-02-03 07:02:49'),
(150, 'Hj Nur Asiah', 'nurasiahkemenag70@gmail.com', '081343519617', NULL, NULL, 13, '5', '[1]', 0, 'Agar Statistisi yg ada Kanwil Kemenag Sulbar selalu diundang jk ada kegiatan di BPS', NULL, '2023-02-03 14:02:57', NULL, NULL, NULL, NULL, '7600', 1, '2023-02-03 14:03:02', NULL, '2023-01-25 01:08:37', '2023-02-03 07:03:02'),
(151, 'Muhammad Irwan', 'muhammadirwan536@gmail.com', '081244553553', NULL, NULL, 13, '5', '[4]', 0, 'Ibu Kepala BPS dan seluruh jajarannya Ramah dan lugas memberikan infirmasi', NULL, '2023-02-03 14:03:17', NULL, NULL, NULL, NULL, '7600', 1, '2023-02-03 14:03:22', NULL, '2023-01-25 05:36:52', '2023-02-03 07:03:22'),
(152, 'Murniati', NULL, '082393668869', NULL, NULL, 7, '5', '[4]', 0, 'Pelayanan sudah bagus', NULL, '2023-02-03 16:08:46', NULL, NULL, NULL, NULL, '7600', 1, '2023-02-03 16:08:48', NULL, '2023-02-01 03:30:54', '2023-02-03 09:08:48');
INSERT INTO `d_penilaian` (`id`, `nama_konsumen`, `email_konsumen`, `no_wa_telepon`, `kode_petugas`, `rating_petugas`, `kode_layanan`, `rating_layanan`, `kode_saran`, `is_pengaduan`, `saran_pengaduan`, `tanggal_notifikasi`, `tanggal_kategorisasi`, `tanggal_tl_pj_layanan`, `text_pj_layanan`, `tanggal_tl_pj_pengaduan`, `text_pj_pengaduan`, `kode_satker_id`, `selesai`, `tanggal_selesai`, `catatan`, `created_at`, `updated_at`) VALUES
(153, 'Andi ahmad irfa', 'andi.irfa@gmail.com', '085322223070', NULL, NULL, 13, '5', '[4]', 0, 'Pelayanan sangat memuaskan', NULL, '2023-02-03 16:08:52', NULL, NULL, NULL, NULL, '7600', 1, '2023-02-03 16:08:53', NULL, '2023-02-02 08:17:59', '2023-02-03 09:08:53'),
(154, 'Marwawati', 'marwaw@gmail.com', '082260912877', NULL, NULL, 13, '5', '[4]', 0, 'Dengan adanya zoom tersebut bisa membantu wawasan sedikit mengenai olahan data.', NULL, '2023-02-07 16:54:57', NULL, NULL, NULL, NULL, '7600', 1, '2023-02-07 16:54:58', NULL, '2023-02-07 03:12:24', '2023-02-07 09:54:58'),
(155, 'Yati Saputri', 'yatichaqueena@gmail.com', '081243914448', NULL, NULL, 13, '5', '[4]', 0, 'Terima kasih atas informasi terkait data kemiskinan dan pengangguran meskipun tidak bisa sampai level kecamatan', NULL, '2023-02-07 16:54:49', NULL, NULL, NULL, NULL, '7600', 1, '2023-02-07 16:54:51', NULL, '2023-02-07 03:16:19', '2023-02-07 09:54:51'),
(156, 'Nur Jannah Basiran', 'ennung3@gmail.com', '082349419001', NULL, NULL, 13, '4', '[9]', 0, 'Nanti akan berkunjung untuk mencari data sawit Mateng', NULL, '2023-02-07 16:54:38', NULL, NULL, NULL, NULL, '7600', 1, '2023-02-07 16:54:40', NULL, '2023-02-07 03:20:14', '2023-02-07 09:54:40'),
(157, 'Nurul Uswatun Nisa', 'nuruluswanisa@gmail.com', '081355550305', NULL, NULL, 13, '4', '[4]', 0, 'Terima kasih info layanan websitenya', NULL, '2023-02-07 16:54:17', NULL, NULL, NULL, NULL, '7600', 1, '2023-02-07 16:54:20', NULL, '2023-02-07 03:22:15', '2023-02-07 09:54:20'),
(158, 'Nur Dewi Yanti Djauharis', 'nurdewiyantidj@yahoo.com', '082338323512', NULL, NULL, 13, '5', '[4]', 0, 'saya mengucapkan banyak terima kasih karena telah mengadakan kegiatan konsultasi ini,sebagai mhasiswa semester akhir ini sangat membantu saya menyusun skripsi,semoga bps selalu mengadakan kegiatan seperti ini.', NULL, '2023-02-07 16:53:57', NULL, NULL, NULL, NULL, '7600', 1, '2023-02-07 16:54:00', NULL, '2023-02-07 03:39:12', '2023-02-07 09:54:00'),
(159, 'Mien Olivia', 'mienoliviamosialu@gmail.com', '081355928294', NULL, NULL, 13, '5', '[4]', 0, 'Terimakasih untuk BPS Sulbar yg sudah membantu kami Mahasiswa dalam bagaimana cara mengambil data yang benar guna penyelesaian tugas akhir perkuliahan kami. Semoga class online dari BPS dapat sering diadakan.', NULL, '2023-02-07 16:53:39', NULL, NULL, NULL, NULL, '7600', 1, '2023-02-07 16:53:42', NULL, '2023-02-07 04:18:10', '2023-02-07 09:53:42'),
(160, 'Bonewati', 'bonewati.abdullah@gmail.com', '082192755090', NULL, NULL, 13, '5', '[4]', 0, 'Selama ini Bps selaku pembina data statistik sektoral sangat intens melakukan pembinaan terhadap kegiatan statistik lingkup pemprov sulbar.', NULL, '2023-02-15 13:31:09', NULL, NULL, NULL, NULL, '7600', 1, '2023-02-15 13:46:05', NULL, '2023-02-14 04:36:12', '2023-02-15 06:46:05'),
(161, 'MUH IKHWANUL MUIN', 'ikhwan.uzumaki09@gmail.com', '083138133000', NULL, NULL, 13, '5', '[9]', 0, 'Cukup memuaskan', NULL, '2023-02-15 13:46:21', NULL, NULL, NULL, NULL, '7600', 1, '2023-02-15 13:47:23', NULL, '2023-02-14 04:39:04', '2023-02-15 06:47:23'),
(162, 'Erik Kalalembang', 'erik_kalalembang@yahoo.com', '085399134442', NULL, NULL, 13, '5', '[4]', 0, 'Kerwn..lanjutkan', NULL, '2023-02-15 13:46:33', NULL, NULL, NULL, NULL, '7600', 1, '2023-02-15 13:47:28', NULL, '2023-02-14 04:39:40', '2023-02-15 06:47:28'),
(163, 'Muhammad Athar', 'rauf_athar@yahoo.com', '082152787005', NULL, NULL, 13, '5', '[4]', 0, 'Sangat baik, interaktif sehingga dpt membangun kesepahaman dg baik pula.', NULL, '2023-02-15 13:46:48', NULL, NULL, NULL, NULL, '7600', 1, '2023-02-15 13:47:31', NULL, '2023-02-14 05:02:51', '2023-02-15 06:47:31'),
(164, 'Nuraidi', 'Nuraidi.aminullah@gmail.com', '0811444067', NULL, NULL, 13, '3', '[1]', 0, 'Percepatan satu data untuk sulbar', NULL, '2023-02-15 13:47:19', NULL, NULL, NULL, NULL, '7600', 1, '2023-02-15 13:47:33', NULL, '2023-02-15 03:46:32', '2023-02-15 06:47:33'),
(165, 'Eva Muliana', 'evamuliana@gmail.com', '081342607888', NULL, NULL, 13, '5', '[4]', 0, 'Coach sangat membantu dlm pelaksanaan kegiatan', NULL, '2023-02-15 13:48:06', NULL, NULL, NULL, NULL, '7600', 1, '2023-02-15 13:48:40', NULL, '2023-02-15 03:52:23', '2023-02-15 06:48:40'),
(166, 'NURI YULANDARI OKTAVIANI', 'nuriyulandari88@gmail.com', '087787169721', NULL, NULL, 13, '5', '[4]', 0, 'Sangat apresiasi dalam setiap menjawab pertanyaan kami, sangat lugas dalam menyampaikan penjelasan dengan bahasa yang sangat mudah dimengerti.', NULL, '2023-02-15 13:48:13', NULL, NULL, NULL, NULL, '7600', 1, '2023-02-15 13:48:41', NULL, '2023-02-15 03:53:08', '2023-02-15 06:48:41'),
(167, 'Sukmawati', 'sukmawati.naja@gmail.com', '082346157360', NULL, NULL, 13, '5', '[4]', 0, 'sangat baik pelayanannya dan ramah coachnya', NULL, '2023-02-15 13:48:20', NULL, NULL, NULL, NULL, '7600', 1, '2023-02-15 13:48:42', NULL, '2023-02-15 03:56:53', '2023-02-15 06:48:42'),
(168, 'Sutarni', 'suthe1187@gmail.com', '081343773377', NULL, NULL, 13, '5', '[4]', 0, 'Sangat apresiasi untuk memperlancar data', NULL, '2023-02-15 13:48:25', NULL, NULL, NULL, NULL, '7600', 1, '2023-02-15 13:48:43', NULL, '2023-02-15 04:26:37', '2023-02-15 06:48:43'),
(169, 'Muh Yusran', 'arifyusran@gmail.com', '083134066240', NULL, NULL, 13, '5', '[1]', 0, 'Tetap di pertahankan Pelayananya', NULL, '2023-02-15 13:48:31', NULL, NULL, NULL, NULL, '7600', 1, '2023-02-15 13:48:45', NULL, '2023-02-15 04:37:56', '2023-02-15 06:48:45'),
(170, 'MTaufikTH', 'muh.upiek@gmail.com', '085399289707', NULL, NULL, 13, '3', '[4]', 0, 'Sangat membantu dalam mengisi form data sektoral', NULL, '2023-02-15 13:48:38', NULL, NULL, NULL, NULL, '7600', 1, '2023-02-15 13:48:46', NULL, '2023-02-15 06:11:23', '2023-02-15 06:48:46'),
(171, 'Nurliah Nurdin', 'lia.nurdin77@gmail.com', '085241604894', NULL, NULL, 13, '5', '[4]', 0, 'Sangat mengapresiasi kegiatan COSMIC ini di mana kami dapat lebih memahami pentingnya data sektoral di setiap OPD.', NULL, '2023-02-16 11:06:10', NULL, NULL, NULL, NULL, '7600', 1, '2023-02-16 11:06:14', NULL, '2023-02-16 03:49:07', '2023-02-16 04:06:14'),
(172, 'Arman', 'armanfromwest@gmail.com', '081355482579', NULL, NULL, 13, '3', '[4]', 0, 'Pelayanannya sangat baik dan ramah', NULL, '2023-02-16 11:06:02', NULL, NULL, NULL, NULL, '7600', 1, '2023-02-16 11:06:04', NULL, '2023-02-16 03:50:38', '2023-02-16 04:06:04'),
(173, 'NURDAWATI JUSMAN', 'nurdawatirahman@gmai.com', '081355217677', NULL, NULL, 13, '5', '[4]', 0, 'terima kasih', NULL, '2023-02-16 11:05:53', NULL, NULL, NULL, NULL, '7600', 1, '2023-02-16 11:05:55', NULL, '2023-02-16 03:59:18', '2023-02-16 04:05:55'),
(174, 'Anugrah Arpul', 'nughe.anugrah@gmail.com', '082322436888', NULL, NULL, 13, '5', '[4]', 0, 'apresiasi atas Peningkatan layanan informasi data sektoral', NULL, '2023-02-16 11:05:44', NULL, NULL, NULL, NULL, '7600', 1, '2023-02-16 11:05:46', NULL, '2023-02-16 04:02:48', '2023-02-16 04:05:46'),
(175, 'Ashmad Patiju', 'ashmadpatuju@gmail.com', '085222207858', NULL, NULL, 13, '5', '[4]', 0, 'Sangat Memuaskan., Dan Tingkatkan.', NULL, '2023-02-16 11:05:35', NULL, NULL, NULL, NULL, '7600', 1, '2023-02-16 11:05:37', NULL, '2023-02-16 04:02:54', '2023-02-16 04:05:37'),
(176, 'Muh Aswad M', 'aswad28@gmail.com', '085333263154', NULL, NULL, 13, '5', '[4]', 0, 'Sangat membantu.', NULL, '2023-02-20 09:01:37', NULL, NULL, NULL, NULL, '7600', 1, '2023-02-20 09:01:39', NULL, '2023-02-16 04:13:09', '2023-02-20 02:01:39'),
(177, 'NURHALIA', 'lhyaashar@gmail.com', '085252194078', NULL, NULL, 13, '5', '[1,4]', 0, 'Lebih di tingkatkan lagi Pelayanannya Kereeennnn', NULL, '2023-02-20 09:01:47', NULL, NULL, NULL, NULL, '7600', 1, '2023-02-20 09:01:48', NULL, '2023-02-16 04:26:45', '2023-02-20 02:01:48'),
(178, 'Agung Setyo Pratomo', 'agungsp1606@gmail.com', '085216513097', NULL, NULL, 12, '5', '[4]', 0, 'Sangat bermanfaat dan menginspirasi', NULL, '2023-02-20 09:01:21', NULL, NULL, NULL, NULL, '7600', 1, '2023-02-20 09:01:22', NULL, '2023-02-17 08:21:29', '2023-02-20 02:01:22'),
(179, 'Muh Ali imran', 'imran894012@gmail.com', '081279627839', NULL, NULL, 10, '1', NULL, 0, 'Data luas lahan, produksi kopra menurut kecamatan di kabupaten Pasangkayu', NULL, NULL, NULL, NULL, NULL, NULL, '7605', 0, NULL, NULL, '2023-02-20 16:38:00', '2023-02-20 16:38:00'),
(180, 'Al khaliq', 'haliq635@gmail.com', '085757889300', NULL, NULL, 12, '5', '[4]', 0, 'Baik sekali', NULL, '2023-03-28 14:41:47', NULL, NULL, NULL, NULL, '7600', 1, '2023-03-28 14:41:50', NULL, '2023-02-24 08:13:10', '2023-03-28 07:41:50'),
(181, 'Marthen Luther', 'marthen.luther@bps.go.id', '081234503243', NULL, NULL, 12, '5', '[4]', 0, 'Semoga kedepan lebih baik lagi', NULL, '2023-03-28 14:42:17', NULL, NULL, NULL, NULL, '7600', 1, '2023-03-28 14:42:19', NULL, '2023-02-24 08:13:48', '2023-03-28 07:42:19'),
(182, 'KARMILA SEKAR SARI', 'krmla0290@gmail.com', '082345893446', NULL, NULL, 12, '5', '[4]', 0, 'Sangat sangat sangat baik', NULL, '2023-03-28 14:42:30', NULL, NULL, NULL, NULL, '7600', 1, '2023-03-28 14:42:32', NULL, '2023-02-24 08:14:16', '2023-03-28 07:42:32'),
(183, 'Masita Sulo', 'masita.sulo@bps.go.id', '085255419215', NULL, NULL, 12, '5', '[4]', 0, 'Jaya Terus BPS', NULL, '2023-03-28 14:42:46', NULL, NULL, NULL, NULL, '7600', 1, '2023-03-28 14:42:47', NULL, '2023-02-24 08:14:16', '2023-03-28 07:42:47'),
(184, 'Iksan suyono', 'iksansuyono@yahoo.com', '085331255430', NULL, NULL, 12, '5', '[4]', 0, 'Mantap😁👍', NULL, '2023-03-28 14:42:57', NULL, NULL, NULL, NULL, '7600', 1, '2023-03-28 14:43:26', NULL, '2023-02-24 08:14:33', '2023-03-28 07:43:26'),
(185, 'M Niswar', 'mniswar1115@gmail.com', '089649997645', NULL, NULL, 12, '5', '[4]', 0, 'BPS Luar Biasa bisa membantu dan menambah pengalaman dan ilmu bagi kita', NULL, '2023-03-28 14:43:35', NULL, NULL, NULL, NULL, '7600', 1, '2023-03-28 14:43:36', NULL, '2023-02-24 08:14:34', '2023-03-28 07:43:36'),
(186, 'ASPIDAH RUHUL', 'aspidah661@gmail.com', '085298524782', NULL, NULL, 12, '5', '[4]', 0, 'BPS LUAR BIASA', NULL, '2023-03-28 14:43:47', NULL, NULL, NULL, NULL, '7600', 1, '2023-03-28 14:43:49', NULL, '2023-02-24 08:14:48', '2023-03-28 07:43:49'),
(187, 'ALIZAH PUTRI', 'alizahputri16@gmail.com', '082293209508', NULL, NULL, 12, '5', '[9]', 0, 'Sukses selalu BPS', NULL, '2023-03-28 14:44:06', NULL, NULL, NULL, NULL, '7600', 1, '2023-03-28 14:44:08', NULL, '2023-02-24 08:14:57', '2023-03-28 07:44:08'),
(188, 'Qonita Raihananda', 'qraihananda@gmail.com', '081241902168', NULL, NULL, 7, '5', '[4]', 0, 'webnya cukup update dan UInya mudah digunakan.', NULL, '2023-03-28 14:44:21', NULL, NULL, NULL, NULL, '7600', 1, '2023-03-28 14:44:22', NULL, '2023-02-24 08:15:01', '2023-03-28 07:44:22'),
(189, 'Nurwapika', 'nurwapika22@guru.smp.belajar.id', '087800162351', NULL, NULL, 7, '4', '[4]', 0, 'Baik dalam memberikan pelayanan, semoga kedepannya lebih  baik lagi.', NULL, '2023-03-28 14:44:37', NULL, NULL, NULL, NULL, '7600', 1, '2023-03-28 14:44:39', NULL, '2023-02-24 08:15:04', '2023-03-28 07:44:39'),
(190, 'Kamaluddin', 'kamaluddin@bps.go.id', '082191432654', NULL, NULL, 7, '5', '[4]', 0, 'Bps mantap', NULL, '2023-03-28 14:44:50', NULL, NULL, NULL, NULL, '7600', 1, '2023-03-28 14:44:52', NULL, '2023-02-24 08:15:25', '2023-03-28 07:44:52'),
(191, 'Ardiansyah', 'wawan88ardianyasah@gmail.com', '082197175355', NULL, NULL, 7, '5', '[4]', 0, 'BPS mantap dalam pengumpulan data', NULL, '2023-03-28 14:45:05', NULL, NULL, NULL, NULL, '7600', 1, '2023-03-28 14:45:06', NULL, '2023-02-24 08:15:42', '2023-03-28 07:45:06'),
(192, 'Fitriani s', 'budimanfitriani687@gmail.com', '085256906185', 12, '5', 2, '5', '[4]', 0, 'Pelayanan sudah sangat bagus', NULL, '2023-03-28 14:53:13', NULL, NULL, NULL, NULL, '7600', 1, '2023-03-28 14:53:38', NULL, '2023-02-24 08:16:13', '2023-03-28 07:53:38'),
(193, 'Sitti khadijah m', 'nurwapika98@gmail.com', '081356187807', NULL, NULL, 7, '5', '[4]', 0, 'Terimakasih telah berusaha memberikan yg terbaik🤗', NULL, '2023-03-28 14:45:25', NULL, NULL, NULL, NULL, '7600', 1, '2023-03-28 14:45:27', NULL, '2023-02-24 08:16:26', '2023-03-28 07:45:27'),
(194, 'Haruna', 'haruna5689@gmail.com', '081240272340', NULL, NULL, 12, '5', '[4]', 0, 'Alhamdulillah pematerinya luar biasa...smogah kedepannya lebih baik lagi', NULL, '2023-03-28 14:45:46', NULL, NULL, NULL, NULL, '7600', 1, '2023-03-28 14:45:48', NULL, '2023-02-24 08:16:33', '2023-03-28 07:45:48'),
(195, 'RIDWAN MADADI', 'ridwanmadadi98@gmail.com', '082291892380', NULL, NULL, 7, '5', '[9]', 0, 'JEKPOT', NULL, '2023-03-28 14:46:06', NULL, NULL, NULL, NULL, '7600', 1, '2023-03-28 14:46:08', NULL, '2023-02-24 08:16:48', '2023-03-28 07:46:08'),
(196, 'Risma', 'rhisma0202@gmail.com', '081295617019', NULL, NULL, 12, '5', '[4]', 0, 'Pelayanan BPS provinsi sangat baik dan orangnya sangat2 Rama', NULL, '2023-03-28 14:46:21', NULL, NULL, NULL, NULL, '7600', 1, '2023-03-28 14:46:23', NULL, '2023-02-24 08:16:54', '2023-03-28 07:46:23'),
(197, 'Fitriani s', 'budimanfitriani687@gmail.com', '085256906185', NULL, NULL, 12, '4', '[1]', 0, 'Agar lebih meningkatkan kualitas pojok statistik', NULL, '2023-03-28 14:53:21', NULL, NULL, NULL, NULL, '7600', 1, '2023-03-28 14:53:36', NULL, '2023-02-24 08:17:38', '2023-03-28 07:53:36'),
(198, 'Asrun', 'asrunrahman10@gmail.com', '085342037053', NULL, NULL, 12, '5', '[4]', 0, 'Materi Sangat baik dan jelas ..', NULL, '2023-03-28 14:46:36', NULL, NULL, NULL, NULL, '7600', 1, '2023-03-28 14:46:41', NULL, '2023-02-24 08:19:11', '2023-03-28 07:46:41'),
(199, 'RIDWAN MADADI', NULL, '082291892380', NULL, NULL, 12, '5', '[4]', 0, 'SANGAT BAIK', NULL, '2023-03-28 14:46:50', NULL, NULL, NULL, NULL, '7600', 1, '2023-03-28 14:46:54', NULL, '2023-02-24 08:19:26', '2023-03-28 07:46:54'),
(200, 'Renoldy saiful qiram', 'reynoldisq72@gmail.com', '085340888997', NULL, NULL, 12, '5', '[4]', 0, 'BPS  luar biasa', NULL, '2023-03-28 14:47:04', NULL, NULL, NULL, NULL, '7600', 1, '2023-03-28 14:47:07', NULL, '2023-02-24 08:20:53', '2023-03-28 07:47:07'),
(201, 'Abdul rahman', 'rahmankamalabdul@gmail.com', '085341300300', NULL, NULL, 12, '5', '[4]', 0, 'Terima kasih atas ilmu yang di berikan, semoga apa kita lakukan hari ini bernilai ibadah', NULL, '2023-03-28 14:47:21', NULL, NULL, NULL, NULL, '7600', 1, '2023-03-28 14:50:11', NULL, '2023-02-24 08:21:47', '2023-03-28 07:50:11'),
(202, 'Pramanda Abruri Fahmi', 'pabrurifahmi@gmail.com', '085230532445', NULL, NULL, 12, '4', '[4]', 0, 'Harapannya semakin konsisten dan rajin utk berkarya dengan data', NULL, '2023-03-28 14:47:34', NULL, NULL, NULL, NULL, '7600', 1, '2023-03-28 14:50:14', NULL, '2023-02-24 08:24:09', '2023-03-28 07:50:14'),
(203, 'MUHAMMAD ARHAM SIUDIN', 'wildairasyafirah@gmail.com', '085342042132', NULL, NULL, 12, '5', '[9]', 0, 'Salam satu data', NULL, '2023-03-28 14:47:45', NULL, NULL, NULL, NULL, '7600', 1, '2023-03-28 14:50:16', NULL, '2023-02-24 08:31:33', '2023-03-28 07:50:16'),
(204, 'Jupriadi', 'jupriadiaco7@gmail.com', '081342531100', NULL, NULL, 12, '5', '[4]', 0, 'Bps mantap', NULL, '2023-03-28 14:47:57', NULL, NULL, NULL, NULL, '7600', 1, '2023-03-28 14:50:20', NULL, '2023-02-24 08:32:58', '2023-03-28 07:50:20'),
(205, 'Eka Putra Bakhtiar A Bong', 'red.abong@gmail.com', '01355471157', 12, '5', 2, '5', '[4]', 0, 'Pelayanan sangat memuaskan, terbuka, ramah dan solutif. semoga BPS dapat mempertahankan pelayanannya dan semakin sukses lagi', NULL, '2023-03-28 14:48:20', NULL, NULL, NULL, NULL, '7600', 1, '2023-03-28 14:50:22', NULL, '2023-02-28 07:43:41', '2023-03-28 07:50:22'),
(206, 'Anggi Prastyono', 'anggiprastyono1999@gmail.com', '082242634433', NULL, NULL, 10, '5', '[4]', 0, 'Petugas sangat responsive dan tanggap dalam memberikan pelayanan 👍👍👍', NULL, '2023-03-28 14:48:30', NULL, NULL, NULL, NULL, '7600', 1, '2023-03-28 14:50:24', NULL, '2023-03-02 03:29:25', '2023-03-28 07:50:24'),
(207, 'Mutiara Panggabean', 'mutiara_p@mhs.unsyiah.ac.id', '085361208407', 12, '4', 10, '2', '[1,3]', 0, 'Terimakasih sebelumnya telah menyediakan pelayanan dari BPS Sulbar. Saya ingin menyampaikan bahwa sejak dua hari lalu saya sudah menghubungi melalui WhatsApp dan sejak kemarin sudah menghubungi melalui chat us di web, namun sampai hari ini tidak ada balasan atau tanggapan untuk permintaan saya. Saya meminta kelengkapan data laju pertumbuhan PDRB pengeluaran q-to-q untuk 2010. karena data yang tersedia di web kurang lengkap karena data Q 1 nya tidak ada. Mohon layanannya, terimakasih', NULL, '2023-03-28 14:53:33', NULL, NULL, NULL, NULL, '7600', 1, '2023-03-28 14:53:35', NULL, '2023-03-09 05:47:30', '2023-03-28 07:53:35'),
(208, 'lisna', 'lisnamatra@gmail.com', '081288796606', NULL, NULL, 7, '4', '[1]', 0, 'Pelayanannya tinggal dipertahankan.tetapi yg perlu ditingkatkan yaitu kelengkapan data x.krna masih ada beberapa data yg kami butuhkan tdk tersedia', NULL, '2023-03-28 14:49:24', NULL, NULL, NULL, NULL, '7600', 1, '2023-03-28 14:50:27', NULL, '2023-03-12 17:14:42', '2023-03-28 07:50:27'),
(209, 'Muhammad Idham', 'idhaam287@gmail.com', '087700910436', 12, '5', 10, '5', '[4]', 0, 'Sangat responsif', NULL, '2023-03-28 14:49:43', NULL, NULL, NULL, NULL, '7600', 1, '2023-03-28 14:50:29', NULL, '2023-03-14 07:21:38', '2023-03-28 07:50:29'),
(210, 'Fadlurrahman', 'fadlurrahman080@gmail.com', '082188927750', NULL, NULL, 7, '5', '[4]', 0, 'Pelayanan baik', NULL, '2023-03-28 14:49:55', NULL, NULL, NULL, NULL, '7600', 1, '2023-03-28 14:50:32', NULL, '2023-03-20 09:51:49', '2023-03-28 07:50:32'),
(211, 'MULIYADI', 'muliyadikurniati@gmail.com', '082195413811', NULL, NULL, 7, '1', NULL, 0, 'Assalamualaikum wr wb, ijin pak bisa minta data statistik kelurahan matanga, untuk lengkapi laporan pak', NULL, NULL, '2023-04-08 12:29:06', 'Selamat siang Pak', NULL, NULL, '7602', 0, NULL, NULL, '2023-04-03 07:27:02', '2023-04-08 05:29:06'),
(212, 'Bagas Raditya Nanggala', 'bagasraditya36@gmail.com', '08982945566', NULL, NULL, 10, '4', NULL, 0, 'Respon pelayanan cukup baik', NULL, NULL, NULL, NULL, NULL, NULL, '7600', 0, NULL, NULL, '2023-04-05 05:53:55', '2023-04-05 05:53:55'),
(213, 'Bagas Raditya Nanggala', 'bagasraditya36@gmail.com', '08982945566', NULL, NULL, 10, '4', '[9]', 0, 'Respon pelayanan cukup baik', NULL, '2023-04-19 05:12:59', NULL, NULL, NULL, NULL, '7600', 1, '2023-04-19 05:16:17', NULL, '2023-04-05 05:53:57', '2023-04-18 21:16:17'),
(214, 'Amalia Tangdilambi', 'twentytwo20th@gmail.com', '085299850350', NULL, NULL, 10, '5', NULL, 0, 'terimakasih BPS Polman', NULL, NULL, NULL, NULL, NULL, NULL, '7602', 0, NULL, NULL, '2023-04-08 05:26:27', '2023-04-08 05:26:27'),
(215, 'Sulastri Yasim', 'lastriyasim@gmail.com', '085299366967', NULL, NULL, 10, '5', '[1,2]', 1, 'Pelayanannya cepat dan santun. 👍', NULL, '2023-04-19 04:58:52', NULL, NULL, NULL, NULL, '7600', 1, '2023-04-19 05:16:51', NULL, '2023-04-10 05:49:22', '2023-04-18 21:16:51'),
(216, 'Sulastri Yasim', 'lastriyasim@gmail.com', '085299366967', NULL, NULL, 10, '5', '[1]', 0, 'Pelayanannya cepat dan santun. 👍', NULL, '2023-04-19 05:02:22', NULL, NULL, NULL, NULL, '7600', 0, NULL, NULL, '2023-04-10 05:49:25', '2023-04-18 21:02:22'),
(298, 'Sapto dwi nurdyanto', 'sapto.mamuju@gmail.com', '+62811422667', 12, '5', 4, '5', NULL, NULL, '<div>Sangat baik</div>', NULL, NULL, NULL, NULL, NULL, NULL, '7600', 0, NULL, NULL, '2023-05-22 23:19:36', '2023-05-22 23:19:36'),
(299, 'Bague', 'rajakbague396@gmail.com', '081342825093', NULL, NULL, 2, '5', NULL, NULL, '<div>Sangat Bai</div>', NULL, NULL, NULL, NULL, NULL, NULL, '7600', 0, NULL, NULL, '2023-05-23 19:59:47', '2023-05-23 19:59:47'),
(300, 'Rajak Azie Bague', 'rajakbague396@gmail.com', '081342825093', NULL, NULL, 2, '5', NULL, NULL, '<div>Sangat Bai</div>', NULL, NULL, NULL, NULL, NULL, NULL, '7600', 0, NULL, NULL, '2023-05-23 20:00:23', '2023-05-23 20:00:23'),
(301, 'Rina G', 'rinagunawan595@gmail.com', '085342678249', NULL, NULL, 10, '4', NULL, NULL, '<div>Semoga kedepannya dapat memberikan BPS terbaru mengenai Sulawesi Barat termasuk data terbaru desa😊</div>', NULL, NULL, NULL, NULL, NULL, NULL, '7600', 0, NULL, NULL, '2023-05-23 20:33:02', '2023-05-23 20:33:02'),
(302, 'Febriyanto Latif', 'febriyantolatif14@gmail.com', '085396559683', NULL, NULL, 2, '5', NULL, NULL, 'Mantap', NULL, NULL, NULL, NULL, NULL, NULL, '7600', 0, NULL, NULL, '2023-05-23 20:39:59', '2023-05-23 20:39:59'),
(303, 'KP2KP Mamasa', 'mamasapajak@gmail.com', '082349364264', NULL, NULL, 7, '5', NULL, NULL, '<div>Website https://mamasakab.bps.go.id sangat membantu instansi kami (KP2KP Mamasa) dalam memberikan data yg dibutuhkan dalam mengambil kebijakan. Data disajikan dengan detail dengan tampilan userface dan menarik.<br>Good luck buat BPS Kab Mamasa&nbsp;</div>', NULL, NULL, NULL, NULL, NULL, NULL, '7600', 0, NULL, NULL, '2023-05-25 17:49:06', '2023-05-25 17:49:06'),
(304, 'andinurfhadi', 'andinurfhadia@gmail.com', '085171641390', NULL, NULL, 10, '5', NULL, NULL, '<div>Respon yang sangat baik&nbsp;</div>', NULL, NULL, NULL, NULL, NULL, NULL, '7600', 0, NULL, NULL, '2023-05-26 01:44:59', '2023-05-26 01:44:59');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2020_05_10_234711_create_m_pengguna_table', 1),
(4, '2020_05_11_000623_create_m_satker_table', 1),
(5, '2020_05_11_002400_create_m_layanan_table', 1),
(6, '2020_05_11_003202_create_m_saran_table', 1),
(7, '2020_05_11_003620_create_m_akses_table', 1),
(8, '2020_05_11_035431_create_d_penilaian_table', 1),
(9, '2022_08_24_084202_create_permission_tables', 2);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\m_pengguna', 1),
(5, 'App\\Models\\m_pengguna', 2),
(6, 'App\\Models\\m_pengguna', 2),
(7, 'App\\Models\\m_pengguna', 2),
(2, 'App\\Models\\m_pengguna', 3),
(4, 'App\\Models\\m_pengguna', 3),
(4, 'App\\Models\\m_pengguna', 4),
(4, 'App\\Models\\m_pengguna', 5),
(3, 'App\\Models\\m_pengguna', 6),
(3, 'App\\Models\\m_pengguna', 7),
(5, 'App\\Models\\m_pengguna', 8),
(3, 'App\\Models\\m_pengguna', 9),
(5, 'App\\Models\\m_pengguna', 10),
(6, 'App\\Models\\m_pengguna', 11),
(6, 'App\\Models\\m_pengguna', 12),
(6, 'App\\Models\\m_pengguna', 13),
(3, 'App\\Models\\m_pengguna', 14),
(2, 'App\\Models\\m_pengguna', 15),
(7, 'App\\Models\\m_pengguna', 16),
(7, 'App\\Models\\m_pengguna', 17),
(2, 'App\\Models\\m_pengguna', 18),
(7, 'App\\Models\\m_pengguna', 36);

-- --------------------------------------------------------

--
-- Table structure for table `m_layanan`
--

CREATE TABLE `m_layanan` (
  `id` bigint UNSIGNED NOT NULL,
  `kode_layanan` char(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_layanan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `metode` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `m_layanan`
--

INSERT INTO `m_layanan` (`id`, `kode_layanan`, `nama_layanan`, `deskripsi`, `metode`, `created_at`, `updated_at`) VALUES
(1, '1', 'Rekomendasi Kegiatan Statistik', NULL, '1', '2020-06-11 21:36:16', '2020-06-11 21:36:16'),
(2, '2', 'Konsultasi Statistik', NULL, '1', '2020-06-11 21:36:16', '2020-06-11 21:36:16'),
(3, '3', 'Perpustakaan Tercetak', NULL, '1', '2020-06-11 21:36:16', '2020-06-11 21:36:16'),
(4, '4', 'Perpustakaan Digital', NULL, '1', '2020-06-11 21:36:16', '2020-06-11 21:36:16'),
(5, '5', 'Penjualan Publikasi', NULL, '1', '2020-06-11 21:36:16', '2020-06-11 21:36:16'),
(6, '6', 'Penjualan Data Mikro dan Peta Wilayah Kerja Statistik', NULL, '1', '2020-06-11 21:36:16', '2020-06-11 21:36:16'),
(7, '7', 'Website', NULL, '2', '2020-06-11 21:36:16', '2020-06-11 21:36:16'),
(8, '8', 'Email', NULL, '2', '2020-06-11 21:36:16', '2020-06-11 21:36:16'),
(9, '9', 'Chat Us', NULL, '2', '2020-06-11 21:36:16', '2020-06-11 21:36:16'),
(10, '10', 'WhatsApp', NULL, '2', '2020-06-11 21:36:16', '2020-06-11 21:36:16'),
(11, '11', 'Sharing Session Coaching Statistics Melalui Intensive Class (COSMIC)', NULL, '2', '2022-08-22 01:18:35', '2022-08-22 01:19:18'),
(12, '12', 'Pojok Statistik', NULL, '2', '2023-05-29 07:03:20', '2023-05-29 07:03:20'),
(13, '13', 'Konsultasi Statistik Melalui Coaching Statistics Melalui Intensive Class (COSMIC)', NULL, '2', '2022-10-21 01:09:38', '2022-10-21 01:09:38');

-- --------------------------------------------------------

--
-- Table structure for table `m_pengguna`
--

CREATE TABLE `m_pengguna` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `bpsid` varchar(9) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kode_satker_id` char(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_petugas` tinyint NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `m_pengguna`
--

INSERT INTO `m_pengguna` (`id`, `nama`, `username`, `email`, `password`, `bpsid`, `foto`, `kode_satker_id`, `is_petugas`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin Spatula', 'spatula.admin', 'spatula.admin@mail.com', '$2y$10$RyHhppWr.Vb3UQ5l3L5RrO.nZqtBtU6ldGAHuJyNJY5hojI1u.1e.', NULL, NULL, '7600', 0, NULL, '2020-06-11 21:36:16', '2020-06-24 08:37:24'),
(2, 'Irnanda Mas Putri', 'irnanda.mas', 'irnanda.mas@bps.go.id', '$2y$10$uFwqQHLDlGChg82GM4IuCekclA3AJqinGgF2vOeor0M3gdDvXMf/.', '340058302', NULL, '7600', 0, NULL, '2020-06-11 21:36:16', '2023-04-18 17:22:35'),
(3, 'Misnawati Mansur', 'misna', 'misna@bps.go.id', '$2y$10$pT5debeiHp6kPD8EIeUss.jsiUa42UE3Oe2wW6QZji0NZSBfjVm8G', '340054318', NULL, '7600', 1, NULL, '2020-06-17 09:25:07', '2020-07-06 07:13:05'),
(4, 'Syaifur Rijal', 'syaifur.rijal', 'syaifur.rijal@bps.go.id', '$2y$10$r4FYcGJNfDyhJdUMtIpg1eceqy9BWMwXqjc6Q8ZZOOwlTWI/jB5Da', '340056465', NULL, '7600', 0, NULL, '2020-06-19 13:17:11', '2023-04-18 17:32:33'),
(5, 'Andra Citta P', 'andra', 'andra.citta@bps.go.id', '$2y$10$5bmVzFkjTIi/sPrSKXbzHOxoUqDi.GvuclTbd1WrXMo6zoTgZL3ca', '340012435', NULL, '7600', 0, NULL, '2020-06-19 13:40:17', '2020-06-19 13:40:17'),
(6, 'Sri Andriyani', 'sri.baso', 'sri.baso@bps.go.id', '$2y$10$rGT7neLL83WLbYu1PBlP6.kg.rjt/ZOvspvaGVVcNarezTWSG7PFe', NULL, NULL, '7600', 0, NULL, '2020-07-01 06:36:33', '2023-04-18 17:32:42'),
(7, 'Abdul Syukur', 'Syukur', 'syukur@bps.go.id', '$2y$10$sjpwVHCi9UM7/bOZ/kPUl.sXlzKT1RRfMHQYZw3OODSzc9QBqrAmy', '340014270', NULL, '7600', 0, NULL, '2020-07-06 08:56:03', '2020-07-06 08:56:03'),
(8, 'Nurwahida', 'nurwahida', 'nurwahida@bps.go.id', '$2y$10$KFAal5WLkRK84p/yI7hK3eUoG4GEA3.6U2h6anHLkN.Y1kd9vFPaC', '340057533', NULL, '7600', 0, NULL, '2020-07-06 13:47:00', '2020-10-08 02:08:34'),
(9, 'Sri Mulyani', 'muyani', 'muyani@bps.go.id', '$2y$10$gRqQizVvDIX8c0cAtafNaeSMeqPC4yf3uxFa28oNpDIIp85rahJcu', '340017366', NULL, '7600', 0, NULL, '2020-07-06 13:50:11', '2020-10-08 02:08:14'),
(10, 'Saiyed Andi Bangsawan', 'bangsawan', 'bangsawan@bps.go.id', '$2y$10$EErPouadXcWfzOwyI8PbUeIoHAdYF40J5ob972dc1UzaDGPSkWTPW', '340018954', NULL, '7600', 0, NULL, '2020-07-06 13:51:36', '2020-10-08 02:07:50'),
(11, 'Mohammad Jufri', 'jufri', 'jufri@bps.go.id', '$2y$10$PTPZL9hUBsyX5e/6e0uUXObiQO7TYk6D4xcWbf/JvvYFIK.GlKZE.', '340000000', NULL, '7601', 1, NULL, '2020-11-09 04:19:10', '2020-11-09 04:31:32'),
(12, 'Yenni Kurnia', 'yenni.kurnia', 'yenni.kurnia@bps.go.id', '$2y$10$fKdlyPs2O8ulImWBfOfebOH4d4qAYeZi3WxYFirK.3zqRvp2GO8mS', '199999999', NULL, '7600', 1, NULL, '2021-06-25 08:34:40', '2023-04-30 17:50:31'),
(13, 'Dea Aditya', 'Dea Aditya', 'dea.aditya@bps.go.id', '$2y$10$jST/wOO2qkDJNkUi5pWrXeeMqRWRyh/po6N1TPcf6EwqXOFUVu5Fe', '199706022', NULL, '7605', 1, NULL, '2022-07-19 03:17:18', '2023-04-30 17:50:19'),
(14, 'Anggoro Rahmadi', 'anggoro.rahmadi', 'anggoro.rahmadi@bps.go.id', '$2y$10$N4jX9lSymuqNTbFy2OB7eO7z.yk4zMOL4U3jQJK0QFv6N0v2VdJXS', '199403222', NULL, '7603', 1, NULL, '2023-04-06 02:07:36', '2023-04-06 02:07:36');

-- --------------------------------------------------------

--
-- Table structure for table `m_saran`
--

CREATE TABLE `m_saran` (
  `id` bigint UNSIGNED NOT NULL,
  `kode_saran` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_saran` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `m_saran`
--

INSERT INTO `m_saran` (`id`, `kode_saran`, `nama_saran`, `created_at`, `updated_at`) VALUES
(1, '1', 'Saran', '2020-06-11 21:36:16', '2020-06-11 21:36:16'),
(2, '2', 'Pengaduan', '2020-06-11 21:36:16', '2020-06-11 21:36:16'),
(3, '3', 'Kritik', '2020-06-11 21:36:16', '2020-06-11 21:36:16'),
(4, '4', 'Apresiasi', '2020-06-11 21:36:16', '2020-06-11 21:36:16'),
(5, '9', 'Lainnya', '2020-06-11 21:36:16', '2020-06-11 21:36:16');

-- --------------------------------------------------------

--
-- Table structure for table `m_satker`
--

CREATE TABLE `m_satker` (
  `id` bigint UNSIGNED NOT NULL,
  `kode_satker` char(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `web` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `telepon` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `m_satker`
--

INSERT INTO `m_satker` (`id`, `kode_satker`, `nama`, `level`, `alamat`, `web`, `telepon`, `created_at`, `updated_at`) VALUES
(1, '7600', 'BPS Provinsi Sulawesi Barat', '1', '', '', '', '2020-06-11 21:36:16', '2020-06-11 21:36:16'),
(2, '7601', 'BPS Kabupaten Majene', '2', '', '', '', '2020-06-11 21:36:16', '2020-06-11 21:36:16'),
(3, '7602', 'BPS Kabupaten Polewali Mandar', '2', '', '', '', '2020-06-11 21:36:16', '2020-06-11 21:36:16'),
(4, '7603', 'BPS Kabupaten Mamasa', '2', '', '', '', '2020-06-11 21:36:16', '2020-06-11 21:36:16'),
(5, '7604', 'BPS Kabupaten Mamuju', '2', '', '', '', '2020-06-11 21:36:16', '2020-06-11 21:36:16'),
(6, '7605', 'BPS Kabupaten Pasangkayu', '2', '', '', '', '2020-06-11 21:36:16', '2020-06-11 21:36:16'),
(7, '7606', 'BPS Kabupaten Mamuju Tengah', '2', '', '', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'superadmin', 'web', '2023-04-12 06:26:50', '2023-04-12 06:26:50'),
(2, 'admin', 'web', '2023-04-12 06:26:50', '2023-04-12 06:26:50'),
(3, 'pimpinan', 'web', '2023-04-12 06:26:50', '2023-04-12 06:26:50'),
(4, 'pj-layanan', 'web', '2023-04-12 06:26:50', '2023-04-12 06:26:50'),
(5, 'pj-pengaduan', 'web', '2023-04-12 06:26:50', '2023-04-12 06:26:50'),
(6, 'tim-zi', 'web', '2023-04-12 06:26:50', '2023-04-12 06:26:50'),
(7, 'operator', 'web', '2023-04-12 06:26:50', '2023-04-12 06:26:50');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `d_penilaian`
--
ALTER TABLE `d_penilaian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `m_layanan`
--
ALTER TABLE `m_layanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_pengguna`
--
ALTER TABLE `m_pengguna`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `m_pengguna_email_unique` (`email`),
  ADD UNIQUE KEY `m_pengguna_bpsid_unique` (`bpsid`);

--
-- Indexes for table `m_saran`
--
ALTER TABLE `m_saran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_satker`
--
ALTER TABLE `m_satker`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `d_penilaian`
--
ALTER TABLE `d_penilaian`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=305;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `m_layanan`
--
ALTER TABLE `m_layanan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `m_pengguna`
--
ALTER TABLE `m_pengguna`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `m_saran`
--
ALTER TABLE `m_saran`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `m_satker`
--
ALTER TABLE `m_satker`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
