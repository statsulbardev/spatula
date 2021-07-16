-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 16, 2021 at 09:22 AM
-- Server version: 5.6.51
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spatuladb`
--

-- --------------------------------------------------------

--
-- Table structure for table `d_penilaian`
--

CREATE TABLE `d_penilaian` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_konsumen` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_konsumen` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_wa_telepon` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kode_petugas` bigint(20) DEFAULT NULL,
  `rating_petugas` char(1) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kode_layanan` bigint(20) DEFAULT NULL,
  `rating_layanan` char(1) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kode_saran` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `is_pengaduan` tinyint(4) DEFAULT NULL,
  `saran_pengaduan` text COLLATE utf8mb4_unicode_ci,
  `tanggal_notifikasi` datetime DEFAULT NULL,
  `tanggal_kategorisasi` datetime DEFAULT NULL,
  `tanggal_tl_pj_layanan` datetime DEFAULT NULL,
  `text_pj_layanan` text COLLATE utf8mb4_unicode_ci,
  `tanggal_tl_pj_pengaduan` datetime DEFAULT NULL,
  `text_pj_pengaduan` text COLLATE utf8mb4_unicode_ci,
  `kode_satker_id` char(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `selesai` tinyint(4) NOT NULL,
  `tanggal_selesai` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `d_penilaian`
--

INSERT INTO `d_penilaian` (`id`, `nama_konsumen`, `email_konsumen`, `no_wa_telepon`, `kode_petugas`, `rating_petugas`, `kode_layanan`, `rating_layanan`, `kode_saran`, `is_pengaduan`, `saran_pengaduan`, `tanggal_notifikasi`, `tanggal_kategorisasi`, `tanggal_tl_pj_layanan`, `text_pj_layanan`, `tanggal_tl_pj_pengaduan`, `text_pj_pengaduan`, `kode_satker_id`, `selesai`, `tanggal_selesai`, `created_at`, `updated_at`) VALUES
(6, 'Anna', 'Annabaharuddin@gmail.com', NULL, NULL, NULL, 10, '5', '[4]', 0, 'layanan OK', '2020-06-24 11:57:46', '2020-07-06 12:01:37', NULL, NULL, NULL, NULL, '7600', 1, '2020-06-24 12:28:00', '2020-06-24 04:57:46', '2020-06-24 05:28:00'),
(7, 'ramlah', 'ramlahvirgo24896@gmail.com', '081353703093', 8, '5', 4, '5', '[4]', 0, 'Terima kasih kepada BPS Provinsi Sulawesi Barat, pelayanan yang diberikan sangat memuaskan.', NULL, '2020-07-03 12:34:04', NULL, NULL, NULL, NULL, '7600', 1, '2020-07-03 12:34:56', '2020-07-03 03:56:45', '2020-07-03 05:34:56'),
(8, 'Sri Aryani', 'sikungtam@gmail.com', '085299427765', NULL, NULL, 7, '5', '[4]', 0, 'Mantap', '2020-07-01 11:18:46', '2020-07-01 11:18:46', NULL, NULL, NULL, NULL, '7600', 1, '2020-07-01 12:18:41', '2020-07-01 03:46:17', '2020-07-01 05:18:41'),
(9, 'hasta pratama', 'hasta@bps.go.id', '085277397687', NULL, NULL, 7, '5', '[4]', 0, 'mantap', NULL, '2020-07-01 11:19:06', NULL, NULL, NULL, NULL, '7600', 1, '2020-07-01 12:18:42', '2020-07-01 03:46:56', '2020-07-01 05:18:42'),
(10, 'Hairuddin', 'hai.23.09.85@gmail.com', '082352030084', NULL, NULL, 7, '5', '[4]', 0, 'Website sangat membantu kita dalam mencari data yang diperlukan.', NULL, '2020-06-26 11:48:59', NULL, NULL, NULL, NULL, '7600', 1, '2020-06-26 12:18:51', '2020-06-26 03:48:39', '2020-06-26 05:18:51'),
(11, 'Dolly', 'kecoak.kampret@gmail.com', '089653205248', 8, '5', 1, '5', '[4]', 0, 'Mantab', NULL, '2020-07-02 11:18:15', NULL, NULL, NULL, NULL, '7600', 1, '2020-07-02 12:18:53', '2020-07-02 03:49:25', '2020-07-02 05:18:53'),
(12, 'Fitri Pratiwi', 'pratiwifitri92@gmail.com', NULL, NULL, NULL, 7, '5', '[1,4]', 0, 'Pelayanan yang diberikan oleh BPS, khususnya BPS Sulawesi Barat sangat amat memuaskan. Cepat, ramah dan informasi yang dibutuhkan diberikan jawaban yang detail didukung dengan data yang ada. Sedikit saran, penggunaan tanda koma atau titik pada angka yang disajikan dalam tabel excel kiranya dapat ditambahkan, untuk memudahkan proses filter data pada aplikasi excel. Penggunaan titik tidak memungkinkan untuk melakukan filter data di aplikasi Ms Office excel. Overall pelayanan yang diberikan BPS sangat memuaskan. Kami dari Badan Keuangan Provinsi merasa sangat terbantu dalam penyajian data ekonomi makro dan mikro pada Laporan Keuangan Pemerintah Daerah yang kami susun. Sekali lagi terimakasih.', '2020-06-29 10:37:10', '2020-06-29 11:20:49', NULL, NULL, NULL, NULL, '7600', 1, '2020-06-29 11:55:28', '2020-06-29 03:37:05', '2020-06-29 04:55:28'),
(13, 'Miswar', 'lenimiswar@gmail.com', '082188173388', NULL, NULL, 10, '5', '[4]', 0, 'Respon cepat,, penjelasan yg mudah dipahami.', NULL, '2020-06-30 11:49:06', NULL, NULL, NULL, NULL, '7600', 1, '2020-06-30 12:18:54', '2020-06-30 04:09:25', '2020-06-30 05:18:54'),
(14, 'Istiqomah', 'esty.bhull@gmail.com', '085299921862', NULL, NULL, 7, '5', '[4]', 0, 'Mantap', NULL, '2020-07-06 11:22:38', NULL, NULL, NULL, NULL, '7600', 1, '2020-07-06 12:21:18', '2020-07-06 04:09:34', '2020-07-06 05:21:18'),
(15, 'Sigit Susanto', 'sigit.menroe@gmail.com', '081361066000', NULL, NULL, 7, '5', '[1]', 0, 'semoga bentuk pengadun dapat depat terlayani', NULL, '2020-07-03 11:48:50', NULL, NULL, NULL, NULL, '7600', 1, '2020-07-03 12:21:21', '2020-07-03 04:10:18', '2020-07-03 05:21:21'),
(16, 'Kadarsah', 'muh.kadarsah@gmail.com', '085241620696', NULL, NULL, 7, '5', '[4]', 0, 'Semakin hari semakin baik.. tampilan semakin menarik... isan semakin lengkap..', NULL, '2020-07-04 11:49:12', NULL, NULL, NULL, NULL, '7600', 1, '2020-07-06 12:21:22', '2020-07-04 04:10:35', '2020-07-04 05:21:22'),
(17, 'Dhori Pridana Kusuma', 'dhorikusuma@gmail.com', NULL, NULL, NULL, 7, '5', '[4]', 0, 'Website OK', '2020-06-25 11:15:05', '2020-06-25 11:49:19', NULL, NULL, NULL, NULL, '7600', 1, '2020-06-25 11:55:58', '2020-06-25 04:15:05', '2020-06-25 04:55:58'),
(18, 'Riri', 'ersetiawati@gmail.com', '081341232574', NULL, NULL, 7, '5', '[4]', 0, 'Good job', NULL, '2020-07-06 11:49:26', NULL, NULL, NULL, NULL, '7600', 1, '2020-07-06 12:27:53', '2020-07-06 04:23:48', '2020-07-06 05:27:53'),
(19, 'hella', 'hellacitra@gmail.com', '085260266558', NULL, NULL, 7, '5', '[1]', 0, 'semoga dapat terimplementasi dengan baik', NULL, '2020-07-06 11:49:36', NULL, NULL, NULL, NULL, '7600', 1, '2020-07-06 12:27:55', '2020-07-06 04:25:18', '2020-07-06 05:27:55'),
(21, 'Novri Satria', 'satria9rayhan@gmail.com', '081364175183', NULL, NULL, 7, '5', '[4]', 0, 'Pelayanan sangat memuaskan, semoga bisa selalu dipertahankan...', NULL, '2020-07-03 11:50:31', NULL, NULL, NULL, NULL, '7600', 1, '2020-07-03 12:27:56', '2020-07-03 04:27:11', '2020-07-03 05:27:56'),
(22, 'Luhur Partomo Hudoyo', 'luhurph110710@gmail.com', '085240692300', NULL, NULL, 10, '5', '[4]', 0, 'mantap...', NULL, '2020-07-06 11:52:02', NULL, NULL, NULL, NULL, '7600', 1, '2020-07-06 12:27:57', '2020-07-06 04:30:58', '2020-07-06 05:27:57'),
(23, 'Ajulawati. B, SH', 'ajulawati77@gmail.com', NULL, NULL, NULL, 7, '5', '[1]', 0, 'Agar pelayanan publikasi BPS lebih ditingkatkan dalam penyajian data', '2020-06-24 11:33:55', '2020-07-06 11:51:50', NULL, NULL, NULL, NULL, '7600', 1, '2020-06-24 11:53:45', '2020-06-24 04:33:55', '2020-07-06 04:51:50'),
(24, 'Arbi', NULL, '085228869594', NULL, NULL, 7, '5', '[4]', 0, 'bagus', NULL, '2020-07-06 12:03:55', NULL, NULL, NULL, NULL, '7600', 1, '2020-07-06 12:27:59', '2020-07-06 04:54:26', '2020-07-06 05:27:59'),
(26, 'Abdul Majid', 'majidsag346@gmail.com', NULL, 8, '5', 2, '5', '[4]', 0, 'Pelayanan sudah bagus, dipertahankan', '2020-07-06 12:04:40', '2020-07-06 12:17:50', NULL, NULL, NULL, NULL, '7600', 1, '2020-07-06 12:28:07', '2020-07-06 05:04:40', '2020-07-06 05:28:07'),
(27, 'Intan S', 'intan8123@yahoo.com', NULL, 8, '5', 4, '5', '[4]', 0, 'Pelayanan untuk memperoleh data sangatlah mudah dan data yang diperoleh sangat lengkap sehingga mudah saya dalam menyelesaikan tugas dari kampus.\r\n\r\nsangat puas dengan semua pelayanannya', '2020-07-06 12:06:27', '2020-07-06 13:48:58', NULL, NULL, NULL, NULL, '7600', 1, '2020-07-06 20:02:09', '2020-07-06 05:06:27', '2020-07-06 13:02:09'),
(28, 'Fahmi Maulaba', 'fahmimaulana@bps.go.id', '08112409273', NULL, NULL, 7, '5', '[4]', 0, 'Mantap', NULL, '2020-07-06 13:49:02', NULL, NULL, NULL, NULL, '7600', 1, '2020-07-06 20:02:12', '2020-07-06 05:20:51', '2020-07-06 13:02:12'),
(34, 'Hermawan Prasetyo', 'hprasetyo33@gmail.com', '081225242518', NULL, NULL, 7, '5', '[4]', 0, 'Sangat bermanfaat', NULL, '2020-07-06 13:49:07', NULL, NULL, NULL, NULL, '7600', 1, '2020-07-06 20:02:18', '2020-07-06 05:35:13', '2020-07-06 13:02:18'),
(35, 'Mirda', 'mirda.project@gmail.com', '081290244890', NULL, NULL, 7, '5', '[1,4]', 0, 'data banyak tersedia, semoga data dapat segera diupdate untuk data terbaru. Terima kasih BPS.', NULL, '2020-07-06 15:17:54', NULL, NULL, NULL, NULL, '7600', 1, '2020-07-06 20:02:24', '2020-07-06 07:35:10', '2020-07-06 13:02:24'),
(36, 'Mardiyana', 'diyanamahdin@gmail.com', '081399394121', NULL, NULL, 7, '5', '[4]', 0, 'Website BPS Sulbar okeee beud 👍👍\r\nKami secara rutin menggunakan data2 yg telah dirilis pd menu BRS. Penyediaan data tersebut sangat bermanfaat dalam pelaksanaan pekerjaan kami di Kanwil DJPb Provinsi Sulbar, data yg dirilis pun up to date. Sangat membantu, terutama di tengah banyaknya pembatasan gerak seperti sekarang ini.\r\n\r\nTerima kasih, tim website BPS Sulbar..\r\nSemoga sukses terus, berinovasi dalam menyediakan data yg akurat bagi kemajuan Sulbar!', NULL, '2020-07-06 15:18:10', NULL, NULL, NULL, NULL, '7600', 1, '2020-07-06 20:02:25', '2020-07-06 07:57:25', '2020-07-06 13:02:25'),
(37, 'Lusi', 'lusi.3yani@gmail.com', '082310378059', NULL, NULL, 7, '4', '[1]', 0, 'Agar data yang tersedia lebih lengkap lagi dan tersedia dalam bentuk Excel.', NULL, '2020-07-06 20:02:47', NULL, NULL, NULL, NULL, '7600', 1, '2020-07-06 20:17:26', '2020-07-06 08:04:08', '2020-07-06 13:17:26'),
(40, 'Sri Ayu Astuti', NULL, '082248431977', 8, '5', 4, '5', '[4]', 0, 'Petugas sangat membantu dalam pencarian data', NULL, '2020-07-07 16:04:05', NULL, NULL, NULL, NULL, '7600', 1, '2020-07-07 16:04:08', '2020-07-06 12:57:19', '2020-07-07 09:04:08'),
(45, 'M Alimuddin', 'helmiunsyiah@gmail.com', '081324351366', NULL, NULL, 7, '5', '[4]', 0, 'mantul', NULL, '2020-07-10 13:44:10', NULL, NULL, NULL, NULL, '7600', 1, '2020-07-10 13:44:24', '2020-07-08 00:25:24', '2020-07-10 06:44:24'),
(46, 'Kartika Hajati', NULL, '082311422215', 8, '5', 2, '5', '[4]', 0, 'terima kasih atas layanannya', NULL, '2020-08-13 09:26:15', NULL, NULL, NULL, NULL, '7600', 1, '2020-08-13 09:26:47', '2020-08-13 02:21:41', '2020-08-13 02:26:47'),
(47, 'Fadiah Azis', NULL, '081242881497', 13, '5', 2, '5', '[4]', 0, 'mantap, ditunggu kiriman datanya melalui email', NULL, '2020-09-02 09:26:22', NULL, NULL, NULL, NULL, '7600', 1, '2020-09-02 09:26:51', '2020-09-02 02:22:27', '2020-09-02 02:26:51'),
(48, 'Syarifuddin', NULL, '085299210003', 8, '5', 2, '5', '[4]', 0, 'terima kasih atas bantuannya memberikan data IPM', NULL, '2020-09-03 09:26:29', NULL, NULL, NULL, NULL, '7600', 1, '2020-09-03 09:26:52', '2020-09-03 02:23:34', '2020-09-03 02:26:52'),
(49, 'Abdul Rajab', NULL, '085399677009', 13, '5', 2, '5', '[4]', 0, 'oke', NULL, '2020-09-02 09:26:33', NULL, NULL, NULL, NULL, '7600', 1, '2020-09-02 09:26:54', '2020-09-02 02:24:02', '2020-09-02 02:26:54'),
(50, 'samsuddin saleh', NULL, '085293992755', 8, '5', 2, '5', '[4]', 0, 'terima kasih BPS', NULL, '2020-08-18 09:26:37', NULL, NULL, NULL, NULL, '7600', 1, '2020-08-18 09:26:55', '2020-08-18 02:24:34', '2020-08-18 02:26:55'),
(51, 'FIRMAN AR', NULL, '085399951255', 8, '5', 2, '5', '[4]', 0, 'terima kasih sudah membantu untuk penyelesaian tugas sekolah', NULL, '2020-08-05 09:26:43', NULL, NULL, NULL, NULL, '7600', 1, '2020-08-05 09:26:57', '2020-08-05 02:25:25', '2020-08-05 02:26:57'),
(52, 'Supriadi', NULL, '085320200560', NULL, NULL, 10, '5', '[4]', 0, 'terima kasih untuk info datanya', NULL, '2020-08-04 09:42:49', NULL, NULL, NULL, NULL, '7600', 1, '2020-10-08 09:48:59', '2020-08-04 02:41:02', '2020-10-08 02:48:59'),
(53, 'Imran', NULL, '082346579218', NULL, NULL, 10, '5', '[4]', 0, 'mantapp', NULL, '2020-08-04 09:43:06', NULL, NULL, NULL, NULL, '7600', 1, '2020-10-08 09:49:01', '2020-08-04 02:41:49', '2020-10-08 02:49:01'),
(54, 'Ranti Suryani', NULL, '087776931054', NULL, NULL, 10, '5', '[4]', 0, 'terima kasih untuk data penduduk yang bekerjanya', NULL, '2020-10-01 09:49:07', NULL, NULL, NULL, NULL, '7600', 1, '2020-10-01 09:49:11', '2020-10-01 02:47:32', '2020-10-01 02:49:11'),
(55, 'Diah Daniaty', NULL, '081297848613', NULL, NULL, 10, '5', '[4]', 0, 'layanan mantap', NULL, '2020-09-02 09:49:10', NULL, NULL, NULL, NULL, '7600', 1, '2020-09-02 09:49:13', '2020-09-02 02:48:32', '2020-09-02 02:49:13'),
(56, 'Indah Rahayu', NULL, '082393294595', NULL, NULL, 10, '5', '[4]', 0, 'respon WA-nya cepat, terima kasih BPS', NULL, '2020-09-21 10:05:59', NULL, NULL, NULL, NULL, '7600', 1, '2020-09-21 10:06:01', '2020-09-21 03:05:44', '2020-09-21 03:06:01'),
(57, 'Nur Hanafiah', NULL, '082340795419', NULL, NULL, 10, '5', '[4]', 0, 'layanan WA memudahkan untuk mencari data', NULL, '2020-09-21 10:13:47', NULL, NULL, NULL, NULL, '7600', 1, '2020-09-21 10:13:49', '2020-09-21 03:13:21', '2020-09-21 03:13:49'),
(59, 'daud eko cahyo rukmono', 'ekodaud@gmail.com', '082187229002', 8, '5', 2, '5', '[4]', 0, 'terima kasih atas pelayanannya', NULL, '2020-10-23 12:01:36', NULL, NULL, NULL, NULL, '7600', 1, '2020-10-23 12:11:49', '2020-10-23 04:58:27', '2020-10-23 05:11:49'),
(62, 'rijal abdul malik', 'rijal.a.em.09@gmail.com', '081221866558', NULL, NULL, 7, '5', '[4]', 0, 'sudah sangat bagus', NULL, '2020-11-05 12:52:49', NULL, NULL, NULL, NULL, '7600', 1, '2020-11-05 12:52:53', '2020-11-03 08:37:58', '2020-11-05 05:52:53'),
(63, 'Misna Test', 'misnawm@gmail.com', '085255178499', NULL, NULL, 7, '5', NULL, 0, 'Layanan mantap', NULL, NULL, NULL, NULL, NULL, NULL, '7601', 0, NULL, '2020-11-09 04:25:59', '2020-11-09 04:25:59'),
(64, 'Suwandy intan', 'wandyintan1991@gmail.com', '085366070605', NULL, NULL, 8, '5', '[4]', 0, 'Bagus', NULL, '2020-12-29 09:31:54', NULL, NULL, NULL, NULL, '7600', 1, '2020-12-29 09:31:59', '2020-11-17 08:20:07', '2020-12-29 02:31:59'),
(65, 'Suwandy intan', 'wandyintan1991@gmail.com', '085366070605', NULL, NULL, 7, '5', '[4]', 0, 'Bagus', NULL, '2020-12-29 09:31:21', NULL, NULL, NULL, NULL, '7600', 1, '2020-12-29 09:31:57', '2020-11-17 08:20:31', '2020-12-29 02:31:57'),
(66, 'Nur Rezky Safitriani', 'rezky.toaba@gmail.com', '081354279486', NULL, NULL, 7, '2', '[1,3]', 0, 'Data mengenai jumlah tindak kriminalitas (crime total) menurut kab./kota sejak tahun 2018 tidak tersedia di website BPS Provinsi maupun masing-masing kabupaten yang ada di Sulawesi Barat. Mohon kepada petugas BPS bisa segera mengupload data kriminalitas dalam publikasi Statistik Politik dan Keamanan Provinsi Sulawesi Barat.', NULL, '2021-02-04 13:49:19', NULL, NULL, NULL, NULL, '7600', 1, '2021-02-04 13:49:31', '2021-01-14 06:59:25', '2021-02-04 06:49:31'),
(67, 'Nur Rezky Safitriani', 'rezky.toaba@gmail.com', '081354279486', NULL, NULL, 7, '2', '[1,3]', 0, 'Data mengenai jumlah tindak kriminalitas (crime total) menurut kab./kota sejak tahun 2018 tidak tersedia di website BPS Provinsi maupun masing-masing kabupaten yang ada di Sulawesi Barat. Mohon kepada petugas BPS bisa segera mengupload data kriminalitas dalam publikasi Statistik Politik dan Keamanan Provinsi Sulawesi Barat.', NULL, '2021-02-04 13:49:25', NULL, NULL, NULL, NULL, '7600', 1, '2021-02-04 13:49:32', '2021-01-14 06:59:44', '2021-02-04 06:49:32'),
(68, 'Endang Suyanti', NULL, '085242946204', 8, '5', 1, '5', '[4]', 0, 'Memuaskan', NULL, '2021-04-14 10:47:56', NULL, NULL, NULL, NULL, '7600', 1, '2021-04-14 10:48:03', '2021-03-30 04:51:06', '2021-04-14 03:48:03'),
(69, 'faried', 'fariedbainta@gmail.com', '085255910409', 8, '5', 1, '4', '[4]', 0, 'pelayanan baik dan ramah,', NULL, '2021-04-14 10:48:12', NULL, NULL, NULL, NULL, '7600', 1, '2021-04-14 10:48:44', '2021-04-05 04:40:02', '2021-04-14 03:48:44'),
(70, 'Supriadi R', 'rian.saputra1176@gmail.com', '085320200560', NULL, NULL, 10, '5', '[4]', 0, 'Sangat bermanfaat infonya', NULL, '2021-04-14 10:48:28', NULL, NULL, NULL, NULL, '7600', 1, '2021-04-14 10:48:50', '2021-04-05 07:21:18', '2021-04-14 03:48:50'),
(71, 'Fadiah Azis', 'fadiahazis07@gmail.com', '081242881497', NULL, NULL, 10, '5', '[1]', 0, 'Mungkin bisa pelayanan siaga  24 jam untuk informasi.', NULL, '2021-04-14 10:48:35', NULL, NULL, NULL, NULL, '7600', 1, '2021-04-14 10:48:52', '2021-04-05 12:43:12', '2021-04-14 03:48:52'),
(72, 'ABDUL RAJAB', 'rajab.daeng@gmail.com', '085399677008', NULL, NULL, 7, '5', '[4]', 0, 'Layanannya sangat baik sekali', NULL, '2021-04-14 10:48:42', NULL, NULL, NULL, NULL, '7600', 1, '2021-04-14 10:48:54', '2021-04-06 02:45:01', '2021-04-14 03:48:54'),
(73, 'Hasanuddin Nur', 'polewiratama@gmail.com', '085259704791', NULL, NULL, 8, '1', NULL, 0, 'Versi PDF dan Word', NULL, NULL, NULL, NULL, NULL, NULL, '7601', 0, NULL, '2021-04-10 10:27:44', '2021-04-10 10:27:44'),
(74, 'Fina Afriza', 'finaaprizajmb@gmail.com', '082269683315', NULL, NULL, 7, '5', '[9]', 0, 'Ingin mengetahui data BPS provinsi Sulawesi barat', NULL, '2021-06-22 11:28:41', NULL, NULL, NULL, NULL, '7600', 1, '2021-06-22 11:28:44', '2021-04-29 01:15:51', '2021-06-22 04:28:44'),
(75, 'Jeffriansyah', 'jeffriamori77@gmail.com', '082290746277', NULL, NULL, 7, '5', NULL, 0, 'Mohon informasinya, dimana saya bisa mendapatkan metadata Ternak Hewan Kabupaten Majene yang terbaru, dikarenakan di bps majene, link yang di share tidak dapat di akses. terima kasih', NULL, NULL, NULL, NULL, NULL, NULL, '7600', 0, NULL, '2021-06-09 00:37:28', '2021-06-09 00:37:28'),
(76, 'Ahmad', 'ahmadmamuju55@gmail.com', '082208220028', NULL, NULL, 10, '5', '[4]', 0, 'Pertahankan pelayanan yang telah berjalan saat ini dan berusaha terus menjadi yang terbaik', NULL, '2021-06-22 11:28:59', NULL, NULL, NULL, NULL, '7600', 1, '2021-06-22 11:29:08', '2021-06-09 12:00:14', '2021-06-22 04:29:08'),
(77, 'Ahmad', 'ahmadmamuju55@gmail.com', '082208220028', NULL, NULL, 10, '5', '[4]', 0, 'Pertahankan pelayanan yang telah berjalan saat ini dan berusaha terus menjadi yang terbaik', NULL, '2021-06-22 11:29:04', NULL, NULL, NULL, NULL, '7600', 1, '2021-06-22 11:29:09', '2021-06-09 12:00:18', '2021-06-22 04:29:09'),
(78, 'Andi Walinono', 'walinono8889@gmail.com', '085394112567', NULL, NULL, 8, '1', NULL, 0, 'Alhamdulillah sdh baik pelayanan', NULL, NULL, NULL, NULL, NULL, NULL, '7600', 0, NULL, '2021-07-08 08:20:07', '2021-07-08 08:20:07'),
(79, 'Andi Walinono', 'walinono8889@gmail.com', '085394112567', NULL, NULL, 8, '1', NULL, 0, 'Alhamdulillah sdh baik pelayanan', NULL, NULL, NULL, NULL, NULL, NULL, '7600', 0, NULL, '2021-07-08 08:20:10', '2021-07-08 08:20:10'),
(80, 'Andi Walinono', 'walinono8889@gmail.com', '085394112567', NULL, NULL, 8, '1', NULL, 0, 'Alhamdulillah sdh baik pelayanan', NULL, NULL, NULL, NULL, NULL, NULL, '7600', 0, NULL, '2021-07-08 08:20:15', '2021-07-08 08:20:15'),
(81, 'Andi Walinono', 'walinono8889@gmail.com', '085394112567', NULL, NULL, 8, '1', NULL, 0, 'Alhamdulillah sdh baik pelayanan', NULL, NULL, NULL, NULL, NULL, NULL, '7600', 0, NULL, '2021-07-08 08:20:19', '2021-07-08 08:20:19'),
(82, 'Andi Walinono', 'walinono8889@gmail.com', '085394112567', NULL, NULL, 8, '1', NULL, 0, 'Alhamdulillah sdh baik pelayanan', NULL, NULL, NULL, NULL, NULL, NULL, '7600', 0, NULL, '2021-07-08 08:20:26', '2021-07-08 08:20:26'),
(83, 'Andi Walinono', 'walinono8889@gmail.com', '085394112567', NULL, NULL, 8, '1', NULL, 0, 'Alhamdulillah sdh baik pelayanan', NULL, NULL, NULL, NULL, NULL, NULL, '7600', 0, NULL, '2021-07-08 08:20:31', '2021-07-08 08:20:31'),
(84, 'Andi Walinono', 'walinono8889@gmail.com', '085394112567', NULL, NULL, 8, '1', NULL, 0, 'Alhamdulillah sdh baik pelayanan', NULL, NULL, NULL, NULL, NULL, NULL, '7600', 0, NULL, '2021-07-08 08:20:39', '2021-07-08 08:20:39'),
(85, 'Andi Walinono', 'walinono8889@gmail.com', '085394112567', NULL, NULL, 8, '1', NULL, 0, 'Alhamdulillah sdh baik pelayanan', NULL, NULL, NULL, NULL, NULL, NULL, '7600', 0, NULL, '2021-07-08 08:20:46', '2021-07-08 08:20:46'),
(86, 'Andi Walinono', 'walinono8889@gmail.com', '085394112567', NULL, NULL, 8, '1', NULL, 0, 'Alhamdulillah sdh baik pelayanan', NULL, NULL, NULL, NULL, NULL, NULL, '7600', 0, NULL, '2021-07-08 08:20:48', '2021-07-08 08:20:48');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
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
(8, '2020_05_11_035431_create_d_penilaian_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `m_akses`
--

CREATE TABLE `m_akses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_akses` int(11) NOT NULL,
  `nama_akses` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `m_akses`
--

INSERT INTO `m_akses` (`id`, `kode_akses`, `nama_akses`, `created_at`, `updated_at`) VALUES
(1, 1, 'Superadmin', '2020-06-11 21:36:16', '2020-06-11 21:36:16'),
(2, 2, 'Admin', '2020-06-11 21:36:16', '2020-06-11 21:36:16'),
(3, 3, 'Pimpinan', '2020-06-11 21:36:16', '2020-06-11 21:36:16'),
(4, 4, 'PJ Layanan', '2020-06-11 21:36:16', '2020-06-11 21:36:16'),
(5, 5, 'PJ Pengaduan', '2020-06-11 21:36:16', '2020-06-11 21:36:16'),
(6, 6, 'Tim ZI Area Pengawasan', '2020-06-11 21:36:16', '2020-06-11 21:36:16'),
(7, 7, 'Petugas/Operator', '2020-06-11 21:36:16', '2020-06-11 21:36:16');

-- --------------------------------------------------------

--
-- Table structure for table `m_layanan`
--

CREATE TABLE `m_layanan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_layanan` char(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_layanan` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_form` char(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `m_layanan`
--

INSERT INTO `m_layanan` (`id`, `kode_layanan`, `nama_layanan`, `kode_form`, `created_at`, `updated_at`) VALUES
(1, '1', 'Konsultasi dan Rekomendasi Kegiatan Statistik', '1', '2020-06-11 21:36:16', '2020-06-11 21:36:16'),
(2, '2', 'Konsultasi Pengguna Data', '1', '2020-06-11 21:36:16', '2020-06-11 21:36:16'),
(3, '3', 'Perpustakaan Tercetak', '1', '2020-06-11 21:36:16', '2020-06-11 21:36:16'),
(4, '4', 'Perpustakaan Digital', '1', '2020-06-11 21:36:16', '2020-06-11 21:36:16'),
(5, '5', 'Penjualan Buku', '1', '2020-06-11 21:36:16', '2020-06-11 21:36:16'),
(6, '6', 'Mikro/Peta Digital/Softcopy Publikasi', '1', '2020-06-11 21:36:16', '2020-06-11 21:36:16'),
(7, '7', 'Website', '2', '2020-06-11 21:36:16', '2020-06-11 21:36:16'),
(8, '8', 'Email', '2', '2020-06-11 21:36:16', '2020-06-11 21:36:16'),
(9, '9', 'Chat Us', '2', '2020-06-11 21:36:16', '2020-06-11 21:36:16'),
(10, '10', 'Whatsapp', '2', '2020-06-11 21:36:16', '2020-06-11 21:36:16');

-- --------------------------------------------------------

--
-- Table structure for table `m_pengguna`
--

CREATE TABLE `m_pengguna` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bpsid` varchar(9) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kode_satker_id` bigint(20) NOT NULL,
  `role_id` bigint(20) NOT NULL,
  `aktif` tinyint(4) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `m_pengguna`
--

INSERT INTO `m_pengguna` (`id`, `nama`, `username`, `email`, `password`, `bpsid`, `foto`, `kode_satker_id`, `role_id`, `aktif`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Superadmin', 'superadmin', 'superadmin@mail.id', '$2y$10$/HRy43WJ0yNAWkBUaZMEjuI.0.Dtbs15tuLzELmED9YIDZVmTFH4e', NULL, NULL, 1, 1, 1, NULL, '2020-06-11 21:36:16', '2020-06-24 08:37:24'),
(2, 'Admin 7600', 'admin7600', 'admin7600@mail.id', '$2y$10$y3cQRcZdO4kR6J.CI4lcVulvgbqgdGKa8tiPU5F6EXVBzpk.6Qm7m', NULL, NULL, 1, 2, 1, NULL, '2020-06-11 21:36:16', '2020-06-11 21:36:16'),
(3, 'Admin 7601', 'admin7601', 'admin7601@mail.id', '$2y$10$5ypSYAxqWVZicgYIEIqK7uzlcakpv3pXKVIWg7sRk4BrFuFkA8Q.6', NULL, NULL, 2, 2, 1, NULL, '2020-06-11 21:36:16', '2020-06-24 07:17:24'),
(4, 'Admin 7602', 'admin7602', 'admin7602@mail.id', '$2y$10$0J5mDzjc3wQQZWYbI9/1T.b8nLuvRxXz9XAmiiBzFFU3tIXxJMOMe', NULL, NULL, 3, 2, 1, NULL, '2020-06-11 21:36:16', '2020-06-11 21:36:16'),
(5, 'Admin 7603', 'admin7603', 'admin7603@mail.id', '$2y$10$SrT9CPP2vs0W1MM3D4zlme3p3eep62rpWayUzNj.ZaNgOp3FJfkue', NULL, NULL, 4, 2, 1, NULL, '2020-06-11 21:36:16', '2020-06-11 21:36:16'),
(6, 'Admin 7604', 'admin7604', 'admin7604@mail.id', '$2y$10$Kn6DlJTVGWudXqfFdL28qe7fq5Nuu8b/BIArICuWf8jnxUcQ.wK7.', NULL, NULL, 5, 2, 1, NULL, '2020-06-11 21:36:16', '2020-06-11 21:36:16'),
(7, 'Admin 7605', 'admin7605', 'admin7605@mail.id', '$2y$10$YzTgkyUO5spr9T9WXWQs/.D6/794AD1SmY21HZIZhi0wxvq2D4R1u', NULL, NULL, 6, 2, 1, NULL, '2020-06-11 21:36:16', '2020-06-11 21:36:16'),
(8, 'Irnanda Mas Putri', 'irnanda.mas', 'irnanda.mas@bps.go.id', '$2y$10$fOK..6SxkVkPXIsRVeOCOeR629O6TNzpnXbJ0uXjurv/VjLapBqKG', '340058302', NULL, 1, 7, 0, NULL, '2020-06-11 21:36:16', '2021-06-25 08:34:56'),
(9, 'Misnawati Mansur SST MM', 'misna', 'misna@bps.go.id', '$2y$10$pT5debeiHp6kPD8EIeUss.jsiUa42UE3Oe2wW6QZji0NZSBfjVm8G', '340054318', NULL, 1, 4, 1, NULL, '2020-06-17 09:25:07', '2020-07-06 07:13:05'),
(10, 'Syaifur Rijal Syamsul', 'ipulmisaja', 'syaifur.rijal@bps.go.id', '$2y$10$odQSqfVacB/bLf.DvyevO.JbNN0H46RNFnsXMUOZtc6nFRI.Dmicu', '340056465', NULL, 1, 5, 1, NULL, '2020-06-19 13:17:11', '2020-06-19 13:39:46'),
(12, 'Andra Citta P', 'andra', 'andra.citta@bps.go.id', '$2y$10$5bmVzFkjTIi/sPrSKXbzHOxoUqDi.GvuclTbd1WrXMo6zoTgZL3ca', '340012435', NULL, 1, 4, 1, NULL, '2020-06-19 13:40:17', '2020-06-19 13:40:17'),
(13, 'Sri Andriyani Baso', 'sribaso', 'sri.baso@bps.go.id', '$2y$10$A8bcy43r6H8G0tc9.AFWteC3iwqJFK1sSFVl4OP1VeI8NlZ7FXwG.', NULL, NULL, 1, 7, 0, NULL, '2020-07-01 06:36:33', '2021-06-25 08:34:54'),
(16, 'Prayitno', 'prayitno', 'prayitno@bps.go.id', '$2y$10$MF2pYo8GlwzGrasWdoZYFOa1K0R8uLIaC/Dj/oV40nyJ2ZWRdrvOu', '340013008', NULL, 1, 3, 1, NULL, '2020-07-06 06:59:23', '2020-10-08 02:08:57'),
(17, 'Abdul Syukur', 'Syukur', 'syukur@bps.go.id', '$2y$10$sjpwVHCi9UM7/bOZ/kPUl.sXlzKT1RRfMHQYZw3OODSzc9QBqrAmy', '340014270', NULL, 1, 5, 1, NULL, '2020-07-06 08:56:03', '2020-07-06 08:56:03'),
(18, 'Sundari Budiani', 'sundari.budiani', 'sundari.budiani@bps.go.id', '$2y$10$pg.WhgAoEXk96vKm5I2E/uHPp/fn7n4d1eww8FQeA.zRcjU7xojMe', '340017872', NULL, 1, 6, 1, NULL, '2020-07-06 13:45:58', '2020-10-08 02:08:45'),
(19, 'Nurwahida', 'nurwahida', 'nurwahida@bps.go.id', '$2y$10$KFAal5WLkRK84p/yI7hK3eUoG4GEA3.6U2h6anHLkN.Y1kd9vFPaC', '340057533', NULL, 1, 6, 1, NULL, '2020-07-06 13:47:00', '2020-10-08 02:08:34'),
(20, 'Heni Djumadi', 'hdjumadi', 'hdjumadi@bps.go.id', '$2y$10$yQt4vRiXfaqxju7kveM2iOkj9Sa8afSb7CmWNaOoY8fvM9/INKypu', '340013780', NULL, 1, 5, 1, NULL, '2020-07-06 13:48:12', '2020-07-06 13:48:12'),
(22, 'Sri Mulyani', 'muyani', 'muyani@bps.go.id', '$2y$10$gRqQizVvDIX8c0cAtafNaeSMeqPC4yf3uxFa28oNpDIIp85rahJcu', '340017366', NULL, 1, 6, 1, NULL, '2020-07-06 13:50:11', '2020-10-08 02:08:14'),
(23, 'Saiyed Andi Bangsawan', 'bangsawan', 'bangsawan@bps.go.id', '$2y$10$EErPouadXcWfzOwyI8PbUeIoHAdYF40J5ob972dc1UzaDGPSkWTPW', '340018954', NULL, 1, 6, 1, NULL, '2020-07-06 13:51:36', '2020-10-08 02:07:50'),
(24, 'Sri Prasetyaningsih', 'sripras', 'sripras@bps.go.id', '$2y$10$N/KGM0Gb0cxdgOTt3elvyevxokd7Sq/Yz6IwjBfxCuCbUl3h9z1IC', '340054128', NULL, 1, 6, 1, NULL, '2020-07-06 13:52:31', '2020-10-08 02:08:01'),
(25, 'Agus Gede Hendrayana Hermawan', 'hendrayana', 'hendrayana@bps.go.id', '$2y$10$usRMNOe8BWCPyJ2CoYFBV.slTe/yj1wy0CziAkc6WWDYOYa3XWpVe', '340016011', NULL, 1, 3, 1, NULL, '2020-10-08 02:07:26', '2020-10-08 02:07:26'),
(26, 'Mohammad Jufri', 'jufri', 'jufri@bps.go.id', '$2y$10$PTPZL9hUBsyX5e/6e0uUXObiQO7TYk6D4xcWbf/JvvYFIK.GlKZE.', '340000000', NULL, 2, 7, 1, NULL, '2020-11-09 04:19:10', '2020-11-09 04:31:32'),
(27, 'Yenni Kurnia', 'yenni.kurnia', 'yenni.kurnia@bps.go.id', '$2y$10$fKdlyPs2O8ulImWBfOfebOH4d4qAYeZi3WxYFirK.3zqRvp2GO8mS', '199999999', NULL, 1, 7, 1, NULL, '2021-06-25 08:34:40', '2021-06-25 08:34:40');

-- --------------------------------------------------------

--
-- Table structure for table `m_saran`
--

CREATE TABLE `m_saran` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_saran` char(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_saran` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_satker` char(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` char(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `m_satker`
--

INSERT INTO `m_satker` (`id`, `kode_satker`, `nama`, `level`, `created_at`, `updated_at`) VALUES
(1, '7600', 'Provinsi Sulawesi Barat', '1', '2020-06-11 21:36:16', '2020-06-11 21:36:16'),
(2, '7601', 'Kabupaten Majene', '2', '2020-06-11 21:36:16', '2020-06-11 21:36:16'),
(3, '7602', 'Kabupaten Polewali Mandar', '2', '2020-06-11 21:36:16', '2020-06-11 21:36:16'),
(4, '7603', 'Kabupaten Mamasa', '2', '2020-06-11 21:36:16', '2020-06-11 21:36:16'),
(5, '7604', 'Kabupaten Mamuju', '2', '2020-06-11 21:36:16', '2020-06-11 21:36:16'),
(6, '7605', 'Kabupaten Pasangkayu', '2', '2020-06-11 21:36:16', '2020-06-11 21:36:16');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
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
-- Indexes for table `m_akses`
--
ALTER TABLE `m_akses`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `d_penilaian`
--
ALTER TABLE `d_penilaian`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `m_akses`
--
ALTER TABLE `m_akses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `m_layanan`
--
ALTER TABLE `m_layanan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `m_pengguna`
--
ALTER TABLE `m_pengguna`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `m_saran`
--
ALTER TABLE `m_saran`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `m_satker`
--
ALTER TABLE `m_satker`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
