-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 07, 2022 at 03:37 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smm_ci`
--

-- --------------------------------------------------------

--
-- Table structure for table `aktifitas`
--

DROP TABLE IF EXISTS `aktifitas`;
CREATE TABLE IF NOT EXISTS `aktifitas` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `aksi` enum('Masuk','Keluar') NOT NULL,
  `ip` varchar(100) DEFAULT NULL,
  `browser` varchar(100) NOT NULL,
  `os` varchar(100) NOT NULL,
  `date` varchar(100) DEFAULT NULL,
  `time` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `balas_tiket`
--

DROP TABLE IF EXISTS `balas_tiket`;
CREATE TABLE IF NOT EXISTS `balas_tiket` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_tiket` int(10) NOT NULL,
  `pengirim` enum('Admin','Member') NOT NULL,
  `user` varchar(50) NOT NULL,
  `pesan` text NOT NULL,
  `date` varchar(100) NOT NULL,
  `time` time NOT NULL,
  `this_user` int(1) NOT NULL,
  `this_admin` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

DROP TABLE IF EXISTS `berita`;
CREATE TABLE IF NOT EXISTS `berita` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `date` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `time` time NOT NULL,
  `icon` enum('PESANAN','LAYANAN','DEPOSIT','PENGGUNA','PROMO') COLLATE utf8_swedish_ci NOT NULL,
  `title` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `tipe` enum('INFO','PERINGATAN','PENTING') COLLATE utf8_swedish_ci NOT NULL,
  `konten` text COLLATE utf8_swedish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cek_pusat`
--

DROP TABLE IF EXISTS `cek_pusat`;
CREATE TABLE IF NOT EXISTS `cek_pusat` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `saldo` double NOT NULL,
  `date` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `time` time NOT NULL,
  `tipe` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `provider` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumping data for table `cek_pusat`
--

INSERT INTO `cek_pusat` (`id`, `saldo`, `date`, `time`, `tipe`, `provider`) VALUES
(1, 0, '07 Des 2022', '10:14:22', 'SMM', 'BEARPEDIA');

-- --------------------------------------------------------

--
-- Table structure for table `deposit`
--

DROP TABLE IF EXISTS `deposit`;
CREATE TABLE IF NOT EXISTS `deposit` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `kode_deposit` varchar(250) NOT NULL,
  `username` varchar(250) NOT NULL,
  `tipe` varchar(255) NOT NULL,
  `provider` varchar(255) NOT NULL,
  `pengirim` varchar(250) NOT NULL,
  `penerima` varchar(100) NOT NULL,
  `no_penerima` varchar(50) NOT NULL,
  `catatan` text NOT NULL,
  `jumlah_transfer` varchar(255) NOT NULL,
  `get_saldo` varchar(250) NOT NULL,
  `metode` varchar(100) NOT NULL,
  `status` enum('Success','Pending','Error','Expired') NOT NULL,
  `date` varchar(100) NOT NULL,
  `time` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `email_sender`
--

DROP TABLE IF EXISTS `email_sender`;
CREATE TABLE IF NOT EXISTS `email_sender` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `protocol` varchar(250) NOT NULL,
  `host` varchar(250) NOT NULL,
  `port` int(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(250) NOT NULL,
  `charset` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `email_sender`
--

INSERT INTO `email_sender` (`id`, `protocol`, `host`, `port`, `email`, `password`, `charset`) VALUES
(1, 'smtp', 'ssl://smtp.googlemail.com', 465, 'testdansdigital@gmail.com', '123456789', 'iso-8859-1');

-- --------------------------------------------------------

--
-- Table structure for table `grafik_admin`
--

DROP TABLE IF EXISTS `grafik_admin`;
CREATE TABLE IF NOT EXISTS `grafik_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `min` int(11) NOT NULL,
  `max` int(11) NOT NULL,
  `min_bar` int(11) NOT NULL,
  `max_bar` int(11) NOT NULL,
  `tahun_bar` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grafik_admin`
--

INSERT INTO `grafik_admin` (`id`, `min`, `max`, `min_bar`, `max_bar`, `tahun_bar`) VALUES
(1, 0, 10000, 0, 10000, 2022);

-- --------------------------------------------------------

--
-- Table structure for table `grafik_user`
--

DROP TABLE IF EXISTS `grafik_user`;
CREATE TABLE IF NOT EXISTS `grafik_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `min` int(11) NOT NULL,
  `max` int(11) NOT NULL,
  `min_ref` int(11) NOT NULL,
  `max_ref` int(11) NOT NULL,
  `tahun_ref` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grafik_user`
--

INSERT INTO `grafik_user` (`id`, `min`, `max`, `min_ref`, `max_ref`, `tahun_ref`) VALUES
(1, 0, 10000, 0, 0, 2022);

-- --------------------------------------------------------

--
-- Table structure for table `kategori_layanan`
--

DROP TABLE IF EXISTS `kategori_layanan`;
CREATE TABLE IF NOT EXISTS `kategori_layanan` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `kode` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `provider` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1546 DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumping data for table `kategori_layanan`
--

INSERT INTO `kategori_layanan` (`id`, `nama`, `kode`, `provider`) VALUES
(911, '- Netflix -', '- Netflix -', 'MANUAL'),
(1332, 'Instagram Views', 'Instagram Views', 'MEDANPEDIA'),
(1333, 'SoundCloud', 'SoundCloud', 'MEDANPEDIA'),
(1334, 'Telegram', 'Telegram', 'MEDANPEDIA'),
(1335, 'Google', 'Google', 'MEDANPEDIA'),
(1336, 'Instagram Story Views', 'Instagram Story Views', 'MEDANPEDIA'),
(1337, 'Instagram Live Video', 'Instagram Live Video', 'MEDANPEDIA'),
(1338, 'Instagram Story / Impressions / Saves / Profile Visit', 'Instagram Story / Impressions / Saves / Profile Vi', 'MEDANPEDIA'),
(1339, 'Twitter Views & Impressions', 'Twitter Views & Impressions', 'MEDANPEDIA'),
(1340, 'Linkedin', 'Linkedin', 'MEDANPEDIA'),
(1341, 'Website Traffic', 'Website Traffic', 'MEDANPEDIA'),
(1342, 'Instagram TV', 'Instagram TV', 'MEDANPEDIA'),
(1343, 'Youtube Likes / Dislikes / Shares / Comment', 'Youtube Likes / Dislikes / Shares / Comment', 'MEDANPEDIA'),
(1344, 'Youtube Views', 'Youtube Views', 'MEDANPEDIA'),
(1345, 'Facebook Video Views / Live Stream', 'Facebook Video Views / Live Stream', 'MEDANPEDIA'),
(1346, 'Spotify', 'Spotify', 'MEDANPEDIA'),
(1347, 'Facebook Page / Website - Likes / Stars', 'Facebook Page / Website - Likes / Stars', 'MEDANPEDIA'),
(1348, 'Followers Shopee/Tokopedia/Bukalapak', 'Followers Shopee/Tokopedia/Bukalapak', 'MEDANPEDIA'),
(1349, 'Facebook Post Likes / Comments / Shares', 'Facebook Post Likes / Comments / Shares', 'MEDANPEDIA'),
(1350, 'Pinterest', 'Pinterest', 'MEDANPEDIA'),
(1351, 'Instagram Like Komentar [ top koment ]', 'Instagram Like Komentar [ top koment ]', 'MEDANPEDIA'),
(1352, 'Instagram Like Indonesia', 'Instagram Like Indonesia', 'MEDANPEDIA'),
(1353, 'Instagram Likes', 'Instagram Likes', 'MEDANPEDIA'),
(1354, 'TIK TOK Followers', 'TIK TOK Followers', 'MEDANPEDIA'),
(1355, 'TIK TOK Likes', 'TIK TOK Likes', 'MEDANPEDIA'),
(1356, 'Instagram Followers [ No Refill ]', 'Instagram Followers [ No Refill ]', 'MEDANPEDIA'),
(1357, 'Instagram Followers Indonesia', 'Instagram Followers Indonesia', 'MEDANPEDIA'),
(1358, 'TIK TOK View/share/comment', 'TIK TOK View/share/comment', 'MEDANPEDIA'),
(1359, '- PROMO - ON OFF', '- PROMO - ON OFF', 'MEDANPEDIA'),
(1360, 'Facebook Followers / Friends', 'Facebook Followers / Friends', 'MEDANPEDIA'),
(1361, 'Instagram Followers [guaranteed]', 'Instagram Followers [guaranteed]', 'MEDANPEDIA'),
(1362, 'Twitter Followers', 'Twitter Followers', 'MEDANPEDIA'),
(1363, 'Twitter Retweets', 'Twitter Retweets', 'MEDANPEDIA'),
(1364, 'Twitch', 'Twitch', 'MEDANPEDIA'),
(1365, 'Twitter Favorites', 'Twitter Favorites', 'MEDANPEDIA'),
(1366, 'Likee app', 'Likee app', 'MEDANPEDIA'),
(1367, 'Youtube View Jam Tayang', 'Youtube View Jam Tayang', 'MEDANPEDIA'),
(1368, 'Twitter Indonesia', 'Twitter Indonesia', 'MEDANPEDIA'),
(1369, 'Youtube Subscribers', 'Youtube Subscribers', 'MEDANPEDIA'),
(1370, 'TIK TOK INDONESIA', 'TIK TOK INDONESIA', 'MEDANPEDIA'),
(1371, 'Instagram Followers Indonesia Guaranted/Refill', 'Instagram Followers Indonesia Guaranted/Refill', 'MEDANPEDIA'),
(1372, 'Youtube View Target Negara', 'Youtube View Target Negara', 'MEDANPEDIA'),
(1373, 'Instagram Comments', 'Instagram Comments', 'MEDANPEDIA'),
(1460, 'Facebook - Post Likes', 'Facebook - Post Likes', 'BEARPEDIA'),
(1461, 'Instagram - Reels', 'Instagram - Reels', 'BEARPEDIA'),
(1462, 'Instagram - Story Views', 'Instagram - Story Views', 'BEARPEDIA'),
(1463, 'Instagram - Views', 'Instagram - Views', 'BEARPEDIA'),
(1464, 'Facebook - Video Views [ Monetization ]', 'Facebook - Video Views [ Monetization ]', 'BEARPEDIA'),
(1465, 'Facebook - Group Members', 'Facebook - Group Members', 'BEARPEDIA'),
(1466, 'Instagram - Likes [ No Refill ]', 'Instagram - Likes [ No Refill ]', 'BEARPEDIA'),
(1467, 'Instagram - Followers [ No Guaranteed / No Refill ]', 'Instagram - Followers [ No Guaranteed / No Refill ', 'BEARPEDIA'),
(1468, 'Z[+Private]', 'Z[+Private]', 'BEARPEDIA'),
(1469, 'TikTok - Likes Indonesia', 'TikTok - Likes Indonesia', 'BEARPEDIA'),
(1470, 'Instagram - Followers [ Guaranteed 90-365 Days ]', 'Instagram - Followers [ Guaranteed 90-365 Days ]', 'BEARPEDIA'),
(1471, 'Instagram - Followers [ Guaranteed 45-60 Days ]', 'Instagram - Followers [ Guaranteed 45-60 Days ]', 'BEARPEDIA'),
(1472, 'Instagram - Followers [ Guaranteed Lifetime ]', 'Instagram - Followers [ Guaranteed Lifetime ]', 'BEARPEDIA'),
(1473, 'Instagram - Followers [ Guaranteed 15-30 Days ]', 'Instagram - Followers [ Guaranteed 15-30 Days ]', 'BEARPEDIA'),
(1474, 'YouTube - ADS Views [ Via Google Adwords ]', 'YouTube - ADS Views [ Via Google Adwords ]', 'BEARPEDIA'),
(1475, 'Youtube - Subscribers', 'Youtube - Subscribers', 'BEARPEDIA'),
(1476, 'YouTube - Views [ No Refill ]', 'YouTube - Views [ No Refill ]', 'BEARPEDIA'),
(1477, 'TikTok - Likes', 'TikTok - Likes', 'BEARPEDIA'),
(1478, 'Facebook - Post Reaction', 'Facebook - Post Reaction', 'BEARPEDIA'),
(1479, 'TikTok - Story', 'TikTok - Story', 'BEARPEDIA'),
(1480, 'Twitter - Followers', 'Twitter - Followers', 'BEARPEDIA'),
(1481, 'TikTok - Followers', 'TikTok - Followers', 'BEARPEDIA'),
(1482, 'TikTok - Saves', 'TikTok - Saves', 'BEARPEDIA'),
(1483, 'TikTok - Shares', 'TikTok - Shares', 'BEARPEDIA'),
(1484, 'Instagram - IGTV', 'Instagram - IGTV', 'BEARPEDIA'),
(1485, 'TikTok - Explore', 'TikTok - Explore', 'BEARPEDIA'),
(1486, 'Facebook - Verified / Centang Biru', 'Facebook - Verified / Centang Biru', 'BEARPEDIA'),
(1487, 'Facebook - Profile Followers', 'Facebook - Profile Followers', 'BEARPEDIA'),
(1488, 'Twitter - Statistics / Poll / Impressions', 'Twitter - Statistics / Poll / Impressions', 'BEARPEDIA'),
(1489, 'Twitter - Likes', 'Twitter - Likes', 'BEARPEDIA'),
(1490, 'Twitter - Retweets', 'Twitter - Retweets', 'BEARPEDIA'),
(1491, 'Twitter - Views', 'Twitter - Views', 'BEARPEDIA'),
(1492, 'Twitter - NFT Services', 'Twitter - NFT Services', 'BEARPEDIA'),
(1493, 'TikTok - Comments Likes', 'TikTok - Comments Likes', 'BEARPEDIA'),
(1494, 'Instagram - Report Spam Account', 'Instagram - Report Spam Account', 'BEARPEDIA'),
(1495, 'TikTok - Report Spam Account', 'TikTok - Report Spam Account', 'BEARPEDIA'),
(1496, 'Facebook - Report Spam Account', 'Facebook - Report Spam Account', 'BEARPEDIA'),
(1497, 'Youtube - Shorts', 'Youtube - Shorts', 'BEARPEDIA'),
(1498, 'Discord - Members', 'Discord - Members', 'BEARPEDIA'),
(1499, 'Discord - Friend Request', 'Discord - Friend Request', 'BEARPEDIA'),
(1500, 'Facebook - Comments Likes', 'Facebook - Comments Likes', 'BEARPEDIA'),
(1501, 'Instagram - Post Shares', 'Instagram - Post Shares', 'BEARPEDIA'),
(1502, 'Instagram - Saves', 'Instagram - Saves', 'BEARPEDIA'),
(1503, 'Instagram - Story Poll Votes', 'Instagram - Story Poll Votes', 'BEARPEDIA'),
(1504, 'YouTube - Live Stream Views Server 1', 'YouTube - Live Stream Views Server 1', 'BEARPEDIA'),
(1505, 'Facebook - Reels Short Videos', 'Facebook - Reels Short Videos', 'BEARPEDIA'),
(1506, 'TikTok - Views', 'TikTok - Views', 'BEARPEDIA'),
(1507, 'TikTok - Live Stream Views Server 1', 'TikTok - Live Stream Views Server 1', 'BEARPEDIA'),
(1508, 'TikTok - Live Stream', 'TikTok - Live Stream', 'BEARPEDIA'),
(1509, 'TikTok - Live Stream Views Server 2', 'TikTok - Live Stream Views Server 2', 'BEARPEDIA'),
(1510, 'Facebook - Fanspage Rating', 'Facebook - Fanspage Rating', 'BEARPEDIA'),
(1511, 'Facebook - Post Shares', 'Facebook - Post Shares', 'BEARPEDIA'),
(1512, 'Facebook - Video Views', 'Facebook - Video Views', 'BEARPEDIA'),
(1513, 'TikTok - Verified / Centang Biru', 'TikTok - Verified / Centang Biru', 'BEARPEDIA'),
(1514, 'Telegram - Post Shares', 'Telegram - Post Shares', 'BEARPEDIA'),
(1515, 'Telegram - Views', 'Telegram - Views', 'BEARPEDIA'),
(1516, 'Telegram - Reaction Premium', 'Telegram - Reaction Premium', 'BEARPEDIA'),
(1517, 'Telegram - Reaction', 'Telegram - Reaction', 'BEARPEDIA'),
(1518, 'Telegram - Members [Public Channel/Group]', 'Telegram - Members [Public Channel/Group]', 'BEARPEDIA'),
(1519, 'Telegram - Comments', 'Telegram - Comments', 'BEARPEDIA'),
(1520, 'Instagram - Verified / Centang Biru', 'Instagram - Verified / Centang Biru', 'BEARPEDIA'),
(1521, 'Instagram - Comments Custom', 'Instagram - Comments Custom', 'BEARPEDIA'),
(1522, 'Instagram - Comments Likes', 'Instagram - Comments Likes', 'BEARPEDIA'),
(1523, 'Instagram - Likes [ Refill ]', 'Instagram - Likes [ Refill ]', 'BEARPEDIA'),
(1524, 'Instagram - Impressions', 'Instagram - Impressions', 'BEARPEDIA'),
(1525, 'Facebook - Live Stream Likes', 'Facebook - Live Stream Likes', 'BEARPEDIA'),
(1526, 'TikTok - Download', 'TikTok - Download', 'BEARPEDIA'),
(1527, 'Youtube - Likes', 'Youtube - Likes', 'BEARPEDIA'),
(1528, 'Instagram - Profile Visits', 'Instagram - Profile Visits', 'BEARPEDIA'),
(1529, 'YouTube - Views [ Refill ]', 'YouTube - Views [ Refill ]', 'BEARPEDIA'),
(1530, 'TikTok - Comments', 'TikTok - Comments', 'BEARPEDIA'),
(1531, 'TikTok - Comments Custom', 'TikTok - Comments Custom', 'BEARPEDIA'),
(1532, 'Youtube - Community', 'Youtube - Community', 'BEARPEDIA'),
(1533, 'Facebook - Fanspage / Halaman', 'Facebook - Fanspage / Halaman', 'BEARPEDIA'),
(1534, 'Youtube - Comments', 'Youtube - Comments', 'BEARPEDIA'),
(1535, 'Twitch - Channel Views', 'Twitch - Channel Views', 'BEARPEDIA'),
(1536, 'Twitch - Followers', 'Twitch - Followers', 'BEARPEDIA'),
(1537, 'Instagram - Comments', 'Instagram - Comments', 'BEARPEDIA'),
(1538, 'Youtube - Views [ Untuk Monetisasi - Penghasil duit ]', 'Youtube - Views [ Untuk Monetisasi - Penghasil dui', 'BEARPEDIA'),
(1539, 'YouTube - Shares Indonesia', 'YouTube - Shares Indonesia', 'BEARPEDIA'),
(1540, 'Facebook - Story Views', 'Facebook - Story Views', 'BEARPEDIA'),
(1541, 'TikTok - Views Indonesia', 'TikTok - Views Indonesia', 'BEARPEDIA'),
(1542, 'Facebook - Live Stream Views Server 1', 'Facebook - Live Stream Views Server 1', 'BEARPEDIA'),
(1543, 'YouTube - Shares [ Social Media ]', 'YouTube - Shares [ Social Media ]', 'BEARPEDIA'),
(1544, 'Facebook - Indonesia ????????', 'Facebook - Indonesia ????????', 'BEARPEDIA'),
(1545, 'Facebook - Indonesia ????????', 'Facebook - Indonesia ????????', 'BEARPEDIA');

-- --------------------------------------------------------

--
-- Table structure for table `keuntungan`
--

DROP TABLE IF EXISTS `keuntungan`;
CREATE TABLE IF NOT EXISTS `keuntungan` (
  `id` int(4) NOT NULL,
  `jenis` enum('WEB','API','Referral') NOT NULL,
  `jumlah` int(25) NOT NULL,
  `status` enum('Aktif','Tidak Aktif') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `keuntungan`
--

INSERT INTO `keuntungan` (`id`, `jenis`, `jumlah`, `status`) VALUES
(3, 'Referral', 10, 'Aktif'),
(1, 'WEB', 40, 'Aktif'),
(2, 'API', 35, 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `kontak_web`
--

DROP TABLE IF EXISTS `kontak_web`;
CREATE TABLE IF NOT EXISTS `kontak_web` (
  `id` int(11) NOT NULL,
  `link_fb` varchar(100) NOT NULL,
  `link_ig` varchar(100) NOT NULL,
  `no_wa` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `kode_pos` int(11) NOT NULL,
  `jam_kerja` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kontak_web`
--

INSERT INTO `kontak_web` (`id`, `link_fb`, `link_ig`, `no_wa`, `email`, `alamat`, `kode_pos`, `jam_kerja`) VALUES
(1, 'https://m.facebook.com/Jetpediaid-109645517421319/', 'https://www.instagram.com/jetpediaid', '6285600899245', 'jetpediaid@gmail.com', 'Siwalan, Pekalongan, Jawa tengah, Indonesia', 51137, '08:00 - 22:00 WIB');

-- --------------------------------------------------------

--
-- Table structure for table `konversi`
--

DROP TABLE IF EXISTS `konversi`;
CREATE TABLE IF NOT EXISTS `konversi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `a1` varchar(20) NOT NULL,
  `a2` varchar(20) NOT NULL,
  `a3` varchar(20) NOT NULL,
  `a4` varchar(20) NOT NULL,
  `a5` varchar(20) NOT NULL,
  `a6` varchar(20) NOT NULL,
  `a7` varchar(20) NOT NULL,
  `a8` varchar(20) NOT NULL,
  `b1` varchar(20) NOT NULL,
  `b2` varchar(20) NOT NULL,
  `b3` varchar(20) NOT NULL,
  `b4` varchar(20) NOT NULL,
  `b5` varchar(20) NOT NULL,
  `b6` varchar(20) NOT NULL,
  `b7` varchar(20) NOT NULL,
  `b8` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `konversi`
--

INSERT INTO `konversi` (`id`, `a1`, `a2`, `a3`, `a4`, `a5`, `a6`, `a7`, `a8`, `b1`, `b2`, `b3`, `b4`, `b5`, `b6`, `b7`, `b8`) VALUES
(1, 'MEDANPEDIA', 'MEDAN PEDIA', 'Medanpedia', 'medanpedia', 'MedanPedia', 'MDP', 'MP', 'mp', 'JETPEDIA', 'JET PEDIA', 'Jetpedia', 'jetpedia', 'JetPedia', 'JET', 'JT', 'jt');

-- --------------------------------------------------------

--
-- Table structure for table `layanan`
--

DROP TABLE IF EXISTS `layanan`;
CREATE TABLE IF NOT EXISTS `layanan` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `service_id` int(10) NOT NULL,
  `kategori` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `layanan` text COLLATE utf8_swedish_ci NOT NULL,
  `catatan` text COLLATE utf8_swedish_ci NOT NULL,
  `min` int(10) NOT NULL,
  `max` int(10) NOT NULL,
  `harga` double NOT NULL,
  `harga_api` double NOT NULL,
  `status` enum('Aktif','Tidak Aktif') COLLATE utf8_swedish_ci NOT NULL,
  `provider_id` int(10) NOT NULL,
  `provider` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5454 DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumping data for table `layanan`
--

INSERT INTO `layanan` (`id`, `service_id`, `kategori`, `layanan`, `catatan`, `min`, `max`, `harga`, `harga_api`, `status`, `provider_id`, `provider`) VALUES
(1447, 9999, '- Netflix -', 'Netflix 30 Hari', 'Netflix dengan masa aktif 30 Hari ', 1000, 1000, 1475, 1455, 'Aktif', 0, 'MANUAL'),
(4338, 29, 'Instagram Views', 'instagram view Auto 1 [INSTANT]', 'INSTANT', 500, 3000000, 700, 675, 'Aktif', 29, 'MEDANPEDIA'),
(4339, 32, 'Instagram Views', 'instagram view Versi 1 [ Unlimited ] [ Superfast ]', '[ Unlimited ] [ Superfast ]', 200, 10000000, 2100, 2025, 'Aktif', 32, 'MEDANPEDIA'),
(4340, 101, 'SoundCloud', 'SoundCloud Plays [1.5M]', '  Real\r\n0-1 Hour Start!\r\n50K - 100K/Day\r\nMultiple of 100\r\nMinimum 100', 100, 1500000, 1400, 1350, 'Aktif', 101, 'MEDANPEDIA'),
(4341, 102, 'SoundCloud', 'SoundCloud Plays [10M]', 'Real\r\n0-1 Hour Start!\r\n10K - 100K/Day\r\nMinimum 20', 20, 10000000, 2100, 2025, 'Aktif', 102, 'MEDANPEDIA'),
(4342, 105, 'SoundCloud', 'Soundcloud - Likes ( S1 ) [ HQ ] ( INSTANT )', ' HQ Users, Non Drop. Order Will Be Start Instant.', 20, 40000, 28000, 27000, 'Aktif', 105, 'MEDANPEDIA'),
(4343, 108, 'Telegram', 'Telegram Post Views [10K] [Last 5]', 'Views Will Be Added To Your Last 5 Posts\r\nReal\r\n0-1 Hour Start!\r\n24 Hours Delivery\r\nMinimum 100', 100, 10000, 21000, 20250, 'Aktif', 108, 'MEDANPEDIA'),
(4344, 113, 'Google', 'Google Plus - Followers | Circles ( Max 5000)', 'Real\r\n0-1 Hour Start!\r\n6-24 Hours Finish!\r\nMinimum 100', 100, 5000, 168000, 162000, 'Aktif', 113, 'MEDANPEDIA'),
(4345, 114, 'Google', 'Google Post +1 [ 2K ]', 'Real\r\n0-1 Hour Start!\r\n1-24 Hours Finish!\r\nMinimum 20', 20, 2000, 168000, 162000, 'Aktif', 114, 'MEDANPEDIA'),
(4346, 115, 'Instagram Story Views', 'Instagram Story Views [20K] [LAST STORY ONLY]', 'Views On The Last Story Posted ONLY !\r\nUsername Only\r\n0-1 Hour Start!\r\nUltra Fast!\r\nMinimum 20', 20, 20000, 3920, 3780, 'Aktif', 115, 'MEDANPEDIA'),
(4347, 116, 'Instagram Story Views', 'Instagram - Story Views S1', '[ Username Only ] INSTANT', 100, 1000000, 8400, 8100, 'Aktif', 116, 'MEDANPEDIA'),
(4348, 117, 'Instagram Live Video', 'Instagram Live Video Likes ', 'Username Only\r\nNo Refill / No Refund\r\nLikes On Live Video\r\nFast Delivery\r\nMinimum 200', 200, 10000, 8400, 8100, 'Aktif', 117, 'MEDANPEDIA'),
(4349, 118, 'Instagram Live Video', 'Instagram - Live Video Views', ' [ Username Only ] INSTANT', 25, 100000, 105000, 101250, 'Aktif', 118, 'MEDANPEDIA'),
(4350, 120, 'Instagram Story / Impressions / Saves / Profile Vi', 'Instagram Ijtressions [10M] [EXPLORE - HOME - LOCATION - PROFILE]', 'Ijtressions showing from ALL in the statistics (Explore, Home, Location ,Etc..)!\r\nInstant Start!\r\nFast Delivery!\r\nMinimum 100\r\nMaximum 10M', 100, 20000000, 2660, 2565, 'Aktif', 120, 'MEDANPEDIA'),
(4351, 121, 'Instagram Story / Impressions / Saves / Profile Vi', 'Instagram Ijtressions [1M]', 'Real\r\nInstant Delivery!\r\nMinimum 100', 100, 1000000, 2100, 2025, 'Aktif', 121, 'MEDANPEDIA'),
(4352, 123, 'Instagram Story / Impressions / Saves / Profile Vi', 'Instagram Saves ', 'No Refill / No Refund\r\n0-1 Hour Start!\r\n15K/Day\r\nMinimum 10', 10, 15000, 5600, 5400, 'Aktif', 123, 'MEDANPEDIA'),
(4353, 138, 'Twitter Views & Impressions', 'Twitter Views Server 1 [1M]', 'Refill (30 Days Maximum) \r\n0-1 Hour Start! \r\n10K - 100K/Day \r\nMinimum 100', 100, 1000000, 14000, 13500, 'Aktif', 138, 'MEDANPEDIA'),
(4354, 139, 'Twitter Views & Impressions', 'Twitter Ijtressions Server 1 [1M]', 'Refill (30 Days Maximum) \r\n0-1 Hour Start! \r\n10K - 100K/Day \r\nMinimum 100', 100, 1000000, 35000, 33750, 'Aktif', 139, 'MEDANPEDIA'),
(4355, 141, 'Linkedin', 'Linkedin - Followers AUTO 1', 'instan', 100, 1000000, 198800, 191700, 'Aktif', 141, 'MEDANPEDIA'),
(4356, 143, 'Website Traffic', 'Website Traffic Server 2 [10M]', 'Super Cepat', 100, 10000000, 5600, 5400, 'Aktif', 143, 'MEDANPEDIA'),
(4357, 158, 'Instagram TV', 'Instagram TV Views Server 1', 'Instagram TV Views ! \r\nFull TV Video Link Needed ! \r\nINSTANT Start ! ', 50, 100000000, 1260, 1215, 'Aktif', 158, 'MEDANPEDIA'),
(4358, 248, 'Youtube Likes / Dislikes / Shares / Comment', 'Youtube Like Versi 1', 'Likes can be over-delivered!\r\nReal\r\nNo Refill Guarantee\r\n25,000-100,000 Per day\r\nkami tidak ada garansi jika like langsung turun, no kojtline\r\norder = berani tanggung resiko', 10, 400000, 105000, 101250, 'Aktif', 248, 'MEDANPEDIA'),
(4359, 469, 'Telegram', 'Telegram - Channnel Members [ Max 100K]', 'Channel Only\r\n5k/day\r\nNo Refill\r\n1-12hrs start\r\nMin 100, Max 100k', 100, 100000, 49000, 47250, 'Aktif', 469, 'MEDANPEDIA'),
(4360, 572, 'Youtube Views', 'Youtube Views server 1 [ No Garansi ][ Fast ] ', 'Instan\r\nkecepatan 5k -20k/hari\r\nGK ADA GARANSI APAPUN! JIKA VIEW TURUN\r\nBELI? berani ambil resiko', 100, 100000, 16800, 16200, 'Aktif', 572, 'MEDANPEDIA'),
(4361, 583, 'Facebook Video Views / Live Stream', 'Facebook  Video Views S1 [INSTANT]', 'Best Service! \r\nStart 1-6hrs \r\n1MILLION TO 5MILLION PER DAY \r\nLIFE TIME GUARANTEED ', 500, 10000000, 3080, 2970, 'Aktif', 583, 'MEDANPEDIA'),
(4362, 725, 'Spotify', 'Spotify Followers S1 [1M] min 1000', 'Start Time: Instant - 6 hours\r\nSpeed: 20K/ day \r\nRefill: no', 1000, 1000000, 38500, 37125, 'Aktif', 725, 'MEDANPEDIA'),
(4363, 726, 'Spotify', 'Spotify Followers S2 [1M] min 20', 'Start Time: Instant - 6 hours\r\nSpeed: 20K/ day \r\nRefill: no', 20, 1000000, 61600, 59400, 'Aktif', 726, 'MEDANPEDIA'),
(4364, 727, 'Spotify', 'Spotify Followers S3 [Super Fast] min 20', '100% High-Quality Account\r\nNo Drop - Life Time Guarantee\r\nInstant ( Avg 0-3 hrs ) \r\n500 to 5000 per 24 hour', 20, 1000000, 37800, 36450, 'Aktif', 727, 'MEDANPEDIA'),
(4365, 728, 'Spotify', 'Spotify Plays S1', 'Spotify Plays S1', 1000, 1000000, 25900, 24975, 'Aktif', 728, 'MEDANPEDIA'),
(4366, 729, 'Spotify', 'Spotify Playlists S1', 'Correct format: \r\nhttps://open.spotify.com/album/2beOdusX0eDgXQ7KdX8IVf\r\nhttps://open.spotify.com/playlist/4jHJBBSbRZp2SNFeHoJMfA', 50, 100000, 126000, 121500, 'Aktif', 729, 'MEDANPEDIA'),
(4367, 730, 'Spotify', 'Spotify Playlists S2', 'Correct format: \r\nhttps://open.spotify.com/album/2beOdusX0eDgXQ7KdX8IVf\r\nhttps://open.spotify.com/playlist/4jHJBBSbRZp2SNFeHoJMfA', 5000, 1000000, 30800, 29700, 'Aktif', 730, 'MEDANPEDIA'),
(4368, 768, 'Youtube Views', 'Youtube Views server 2 [ 50k-100k/day ] [ Lifetime Guarantee ] cheap', 'Start time: 0-3 hours\r\nJika status selesai tetapi view tidak ter update\r\nsilahkan klik like', 100, 10000000, 36400, 35100, 'Aktif', 768, 'MEDANPEDIA'),
(4369, 771, 'Facebook Page / Website - Likes / Stars', 'Facebook Page Likes [ S 8 ] [20K] [R30]', 'Start Time: Instant - 1 hour\r\nSpeed: 5K/ day \r\nRefill: 30 days\r\nSpecs: Fast', 50, 20000, 224000, 216000, 'Aktif', 771, 'MEDANPEDIA'),
(4370, 894, 'Followers Shopee/Tokopedia/Bukalapak', 'Shopee Likes Indonesia [15K] {produk}', 'Fast Process\r\nBot Female Indonesia\r\nuntuk profuk\r\n\r\nBisa sajtai 15K', 100, 10000, 9800, 9450, 'Aktif', 894, 'MEDANPEDIA'),
(4371, 910, 'Facebook Post Likes / Comments / Shares', 'Facebook Photo / Post Likes S1 Fast ', '15 days refill jika drop lebih dari 10', 100, 3000, 25200, 24300, 'Aktif', 910, 'MEDANPEDIA'),
(4372, 912, 'SoundCloud', 'SoundCloud Plays [10M] [S2]', 'Start Time: Instant - 12 hours\r\nSpeed: 3 to 5mil/ day \r\nSpecs: Full Link !', 50000, 10000000, 420, 405, 'Aktif', 912, 'MEDANPEDIA'),
(4373, 914, 'Pinterest', 'Pinterest Followers', 'Pinterest Account Followers', 25, 100000, 53200, 51300, 'Aktif', 914, 'MEDANPEDIA'),
(4374, 915, 'Pinterest', 'Pinterest Board Followers ', 'Pinterest Board Followers', 10, 250000, 53200, 51300, 'Aktif', 915, 'MEDANPEDIA'),
(4375, 916, 'Pinterest', 'Pinterest Likes ', 'Pinterest Likes ', 22, 250000, 53200, 51300, 'Aktif', 916, 'MEDANPEDIA'),
(4376, 917, 'Instagram Story Views', 'Instagram Story Views [9K] [1H - Ultra Fast! ]', 'All Stories\r\nUsername Only\r\n0-1 Hour Start! \r\nUltra Fast! \r\nMinimum 100', 250, 3000, 2800, 2700, 'Aktif', 917, 'MEDANPEDIA'),
(4377, 922, 'Instagram Live Video', 'Instagram Live Video Comments Random', 'Username Only \r\nNo Refill / No Refund \r\nRandom Comments On Live Video \r\nFast Delivery \r\nMinimum 50', 100, 2000, 140000, 135000, 'Aktif', 922, 'MEDANPEDIA'),
(4378, 923, 'Facebook Video Views / Live Stream', 'Facebook Video Views S2 [10M] ', '500K/ day ', 499, 100000000, 2100, 2025, 'Aktif', 923, 'MEDANPEDIA'),
(4379, 925, 'Website Traffic', 'Indonesia Traffic from Google', 'Start Time: Instant - 12 hours\r\nSpeed: Up to 10K/ day \r\nSpecs:\r\n100% Real & Unique Traffic\r\nDesktop Traffic\r\nGoogle Analytics Supported\r\nLow bounce rates 15-20%\r\nYou can use bit.ly to track results\r\nNo Adult, Drugs or other harmful websites allowed\r\nLink Format: Full Website URL\r\n', 500, 50000, 11200, 10800, 'Aktif', 925, 'MEDANPEDIA'),
(4380, 999, 'Facebook Video Views / Live Stream', 'Facebook Video Views S4 [ Exclusive ] [ Cheapest In Market ]', 'Speed 500 - 2k / Day\r\n\r\n30 days refill\r\n\r\nInstant - 24 hours start', 300, 2000000000, 1820, 1755, 'Aktif', 999, 'MEDANPEDIA'),
(4381, 1036, 'Followers Shopee/Tokopedia/Bukalapak', 'Tokopedia Followers INDO FAST  [ 3k ]', 'High Quality\r\nIndonesia\r\nGunakan Link https://www.tokopedia.com/username\r\nJangan https://m.tokopedia.com/username Atau pun Yang Lain Bakal Kaga bisa\r\nFORMAT WAJIB https://www.tokopedia.com/username   (username ganti dengan usernam mu)', 100, 1000, 32200, 31050, 'Aktif', 1036, 'MEDANPEDIA'),
(4382, 1043, 'Instagram Story / Impressions / Saves / Profile Vi', 'Instagram kunjungan profil / Profile Visit', 'Profile Visit', 100, 100000, 10500, 10125, 'Aktif', 1043, 'MEDANPEDIA'),
(4383, 1059, 'Instagram TV', 'Instagram TV Views Server 2  [ SUPER FAST ]', 'no partial\r\nsuperfast\r\n1M/day', 50, 100000000, 840, 810, 'Aktif', 1059, 'MEDANPEDIA'),
(4384, 1060, 'Instagram TV', 'Instagram TV Views Server 3 [ INSTANT ] ', 'IG TV Views \r\nReal Views \r\nSuper Fast\r\nInstant', 200, 5000000, 980, 945, 'Aktif', 1060, 'MEDANPEDIA'),
(4385, 1087, 'Instagram Like Komentar [ top koment ]', 'Instagram Like Komentar FAST Server 2', 'Fast', 20, 10000, 30800, 29700, 'Aktif', 1087, 'MEDANPEDIA'),
(4386, 1124, 'Youtube Views', 'Youtube Ranking Views V10 [ Recommended ][ 0 - 1 Mint Retention]', ' [ Lifetime Guarantee Views ]\r\n- Cheapest In Market\r\n- Start times : 0 - 1h ( Instant )\r\n- Non drop - Lifetime Guarantee Views\r\n- Speed 20k - 30k+ ( Some times will be Faster )\r\n- Retention : 0-1 Minutes +', 500, 10000000, 36400, 35100, 'Aktif', 1124, 'MEDANPEDIA'),
(4387, 1161, 'Instagram Like Indonesia', 'Instagram Likes Indonesia Server 1 max 1000 [ on off ] ⚡️⚡️⚡️', 'Proses sesuai antian\r\ngud service\r\n', 100, 1000, 39200, 37800, 'Aktif', 1161, 'MEDANPEDIA'),
(4388, 1169, 'Instagram Likes', 'Instagram Likes Server 3 [ Kualitas bagus ] [ Superfast ] ', 'fast', 10, 25000, 22400, 21600, 'Aktif', 1169, 'MEDANPEDIA'),
(4389, 1179, 'Instagram TV', 'Instagram TV Views Server 5 [1M/day] [ Cheapest in market]', '[1M/day] [ Cheapest in market]', 500, 10000000, 1120, 1080, 'Aktif', 1179, 'MEDANPEDIA'),
(4390, 1198, 'Instagram Story Views', 'Instagram - Story Views S2 [30K] [INSTANT - 30K/Day]', 'ALL STORIES !\r\nUSERNAME ONLY !\r\nINSTANT START !\r\nFAST DELIVERY !', 20, 30000, 1680, 1620, 'Aktif', 1198, 'MEDANPEDIA'),
(4391, 1225, 'Spotify', 'Spotify Plays [ 1M ] Speed : 500 - 3500/D', '- Start Time: 1 - 12 Hours\r\n- Speed : 500 - 3500/D\r\n- Refill : Non Drop - LifeTime Guarantee\r\n- Best Service in the Market\r\n- Followers from TIER 1 countries only! USA/CA/EU/AU/NZ/UK.\r\n- Quality: HQ\r\n- Min/Max: 1000/1M', 1000, 1000000, 12600, 12150, 'Aktif', 1225, 'MEDANPEDIA'),
(4392, 1240, 'TIK TOK Followers', 'TIK TOK FOLLOWERS S4 [ 30 days refill - Full URL ]', 'Cojtlete URL \r\n30 days refill\r\nSpeed 2-5k/Day', 10, 15000, 161000, 155250, 'Aktif', 1240, 'MEDANPEDIA'),
(4393, 1241, 'TIK TOK Likes', 'TIK TOK Likes S5 [ 30 days refill - Full URL ] ', 'Cojtlete URL \r\n30 days refill\r\nSpeed 2-5k/Day', 10, 15000, 161000, 155250, 'Aktif', 1241, 'MEDANPEDIA'),
(4394, 1256, 'Instagram Like Indonesia', 'Instagram Likes Indonesia Server 6 max 400 server new', 'INSTANT START \r\nFAST \r\nProses Max 1 x 24 Hours', 50, 400, 22400, 21600, 'Aktif', 1256, 'MEDANPEDIA'),
(4395, 1271, 'Instagram Story Views', 'Instagram - Story Views S3 All Story Views Fast ', 'instan', 100, 40000, 7000, 6750, 'Aktif', 1271, 'MEDANPEDIA'),
(4396, 1282, 'Facebook Video Views / Live Stream', 'Facebook Video Views S5 Retention 20 seconds', '10K/day \r\nNo Refill', 100, 100000, 1400, 1350, 'Aktif', 1282, 'MEDANPEDIA'),
(4397, 1283, 'Facebook Video Views / Live Stream', 'Facebook Video Views S6 Retention 40 seconds', '10K/day \r\nNo Refill', 100, 100000, 2800, 2700, 'Aktif', 1283, 'MEDANPEDIA'),
(4398, 1284, 'Facebook Video Views / Live Stream', 'Facebook Video Views S7 Retention 60 seconds', '10K/day \r\nNo Refill', 100, 1000000, 3780, 3645, 'Aktif', 1284, 'MEDANPEDIA'),
(4399, 1285, 'Facebook Video Views / Live Stream', 'Facebook Video Views S8  [ 100% retention ]', '10K/day \r\nNo Refill', 100, 1000000, 7000, 6750, 'Aktif', 1285, 'MEDANPEDIA'),
(4400, 1297, 'Instagram Like Indonesia', 'Instagram Likes Indonesia Server 10 max 500[ MURAH ] ⚡️', 'Proses 2x24 jam\r\nMax hanya 500 jangn order lagi\r\ntetapi paling lama jika pesanan banyak 1- 3 hari\r\nLimit pesanan perhari 300 jadi jika tidak bisa order berarti udah limit harian\r\nsilahkan di pesan esok hari\r\nReal indo\r\ntidak bisa untuk igtv!\r\nJangan di private saat proses pesanan berlangsung!', 100, 500, 7280, 7020, 'Aktif', 1297, 'MEDANPEDIA'),
(4401, 1316, 'Facebook Page / Website - Likes / Stars', 'Facebook Page Likes [ S 11 ] [Refill 30] [Instant Start] Real', ' Refill 30 Days\r\nInstant Start\r\nSpeed : 5K / Day\r\nNon Drop Likes', 100, 10000, 238000, 229500, 'Aktif', 1316, 'MEDANPEDIA'),
(4402, 1320, 'Instagram Followers [ No Refill ]', 'Instagram Followers JT 17 [Real Users- BOT - MIX ]', 'fast\r\nno refill\r\nhigh drop', 100, 500, 16800, 16200, 'Aktif', 1320, 'MEDANPEDIA'),
(4403, 1325, 'Instagram Followers Indonesia', 'Instagram Followers Indonesia Server 5 [max 2000] REAL AKTIF⚡ ', 'Proses normal 1x 24 jam\r\nproses bisa lebih lama jika delay\r\nmax 3 hari bisa kojtline untuk canceled\r\ntergantung pada antrian juga\r\nReal indo, fresh db\r\nkemungkinan besar real pasif hanya 10%', 20, 2000, 71400, 68850, 'Aktif', 1325, 'MEDANPEDIA'),
(4404, 1333, 'Facebook Page / Website - Likes / Stars', 'Facebook Page Likes [ S12 ] [30 Days Auto Refill]', ' Facebook Fan Page Likes\r\n( Min 500 And Max 50k )\r\nAuto-Refill if Likes Drop\r\n( Drop Ratio: 10% but we added Auto-Refill in Backend System )\r\n( Speed 5-10k Per Day )\r\nHigh Quality and Real Likes\r\nRefill : 30 Days Auto Refill', 500, 50000, 126000, 121500, 'Aktif', 1333, 'MEDANPEDIA'),
(4405, 1342, 'TIK TOK Followers', 'TIK TOK FOLLOWERS S5 [ 30 days refill - Full URL ] ', '- Speed 5000 per day\r\n- Avatars Followers and Likes\r\n- 30 days warranty\r\n- instant start to 5 minute start Time\r\n( Contoh Target yang kamu masukin https://www.tiktok.com/@username )', 10, 30000, 119000, 114750, 'Aktif', 1342, 'MEDANPEDIA'),
(4406, 1343, 'TIK TOK Likes', 'TIK TOK Likes S6 [ 30 days refill - Full URL ] ', '- Speed 5000 per day\r\n- Avatars Followers and Likes\r\n- 30 days warranty\r\n- instant start to 5 minute start Time', 9, 30000, 119000, 114750, 'Aktif', 1343, 'MEDANPEDIA'),
(4407, 1347, 'Instagram Like Indonesia', 'Instagram Likes Indonesia Server 11 max 2000 REKOMENDED ⚡️⚡️⚡️⭐', 'Dapat Bonus like jika beruntung\r\nProses instan\r\nreal indo', 20, 2000, 18200, 17550, 'Aktif', 1347, 'MEDANPEDIA'),
(4408, 1355, 'Facebook Page / Website - Likes / Stars', 'Facebook Page Likes Server 1  [ NO Refill ] 1-3k/day', '0-24 hours time to finish\r\nReal account', 100, 5000, 63000, 60750, 'Aktif', 1355, 'MEDANPEDIA'),
(4409, 1356, 'Facebook Page / Website - Likes / Stars', 'Facebook Page Likes Server 2 [ 10 days refill] 5k/day ', 'Start time : 0 - 1h', 100, 1000, 98000, 94500, 'Aktif', 1356, 'MEDANPEDIA'),
(4410, 1371, 'TIK TOK View/share/comment', 'TIK TOK View S6 [500K/day] ', '500K/day\r\nno refill', 1000, 1000000000, 350, 337.5, 'Aktif', 1371, 'MEDANPEDIA'),
(4411, 1384, '- PROMO - ON OFF', 'Instagram Likes PROMO 1 [ SUPER MURAH ]', 'instant', 100, 10000, 4060, 3915, 'Aktif', 1384, 'MEDANPEDIA'),
(4412, 1385, '- PROMO - ON OFF', 'Instagram Followers PROMO 1 [ No Refill ] [ TERMURAH, High Drop] ', 'drop 90 - 100%\r\nno kojtline', 10, 10000, 1680, 1620, 'Aktif', 1385, 'MEDANPEDIA'),
(4413, 1411, 'Instagram Views', 'instagram view Server 14 [ 1 Million / Hour ]', 'Kemungkinan  kecepatan 1 juta / jam\r\nKemungkinan mulai 0-10 menir', 100, 1000000, 840, 810, 'Aktif', 1411, 'MEDANPEDIA'),
(4414, 1421, 'Instagram Likes', ' Instagram Likes JT 2 [Instant] Real [Max 5K]', 'Speed : 200 Likes / Hour\r\nNo Partial Issues\r\nOrders will be canceled if server overload.', 100, 5000, 25900, 24975, 'Aktif', 1421, 'MEDANPEDIA'),
(4415, 1422, 'Instagram Likes', 'Instagram Likes JT 3 [ 10k ] [ Instant - Start ]', ' Start time:\r\nFor orders under 1000 likes usually instant. If more than 1000 - may take some time, usually few hours\r\nSpeed is up to 100-200 per hour (can lower a bit when many orders)\r\nNo cancellation before 24 hours', 20, 5000, 33600, 32400, 'Aktif', 1422, 'MEDANPEDIA'),
(4416, 1425, 'Instagram Views', 'instagram view JT 1 [ 5 Million / Hour ] ( Recommended )', '5 Million / Hour', 100, 2500000, 1960, 1890, 'Aktif', 1425, 'MEDANPEDIA'),
(4417, 1430, 'Youtube Views', 'Youtube Ranking Desktop Views JT 2 [ Lifetime Guaranteed ]', ' 0-24 hour start time\r\n100k to 300k /day speed\r\nLifetime refill guarantee\r\n30-40 second watch time\r\nSafe to run with monetised videos\r\nWindows desktop watch page\r\nWorldwide viewers added in a non-stop natural pattern\r\nMust be unrestricted & open for all countries\r\nOK for VEVO\r\nIncremental Speed Based on Order Size\r\n500 Minimum order\r\n1 Million Maximum order', 500, 1000000, 33600, 32400, 'Aktif', 1430, 'MEDANPEDIA'),
(4418, 1443, 'Facebook Followers / Friends', 'Facebook Profile Follower JT 1 [ No Refill ] beta test ', ' - Speed 1k/D\r\n- Start : 0 - 24h\r\n- hanya untuk followers profil ya bukan fanspage/halaman !\r\n- No Refill .', 100, 10000, 119000, 114750, 'Aktif', 1443, 'MEDANPEDIA'),
(4419, 1444, 'Facebook Followers / Friends', 'Facebook Profile Follower JT 2 [ R30Day ] ', '- Speed 1k/D\r\n- Start : 0 - 24h\r\n- Please place Profile followers ONLY , not Fan page likes.\r\n- 30 days refill', 100, 10000, 133000, 128250, 'Aktif', 1444, 'MEDANPEDIA'),
(4420, 1445, 'Facebook Post Likes / Comments / Shares', 'Facebook Photo / Post Likes JT1[ Start Instant ][Recommended]', 'Speed 5k per day\r\nNo refill', 25, 10000, 77000, 74250, 'Aktif', 1445, 'MEDANPEDIA'),
(4421, 1446, 'Facebook Post Likes / Comments / Shares', 'Facebook Photo / Post Likes JT2  [Instant - 3 hour start] [NR]', 'speed = instant finish | quality = LQ | No Refill/Refund in any case', 20, 500, 33600, 32400, 'Aktif', 1446, 'MEDANPEDIA'),
(4422, 1447, 'Facebook Post Likes / Comments / Shares', 'Facebook Custom Comments JT 1 [ REAL - Max 2K ] ', '- Start time : 0 - 12h\r\n- Speed : 1k/D\r\n- Non drop so far - No refill\r\n- Min 5 - Max 2k', 5, 2000, 1498000, 1444500, 'Aktif', 1447, 'MEDANPEDIA'),
(4423, 1448, 'Facebook Post Likes / Comments / Shares', 'Facebook Photo / Post Likes JT3 [CHEAPEST] [10K]', 'No refill / refund\r\n0 - 48 Hours start\r\nARAB REAL', 100, 10000, 30800, 29700, 'Aktif', 1448, 'MEDANPEDIA'),
(4424, 1449, 'Youtube Likes / Dislikes / Shares / Comment', 'Youtube Dislikes JT 1  ', 'Dislikes can be over-delivered!\r\nReal\r\nNo Refill Guarantee\r\n25,000-100,000 Per day\r\nkami tidak ada garansi jika like langsung turun, no kojtline\r\norder = berani tanggung resiko', 10, 400000, 203000, 195750, 'Aktif', 1449, 'MEDANPEDIA'),
(4425, 1450, 'Youtube Likes / Dislikes / Shares / Comment', 'Youtube Like JT 1 [5K] [R10]', 'Start Time: Up to 12 hours\r\nSpeed: 50/ day\r\nRefill: 10 days + Refill Button\r\nSpecs: Youtube video with at least 1 like', 5, 5000, 123200, 118800, 'Aktif', 1450, 'MEDANPEDIA'),
(4426, 1453, 'Youtube Likes / Dislikes / Shares / Comment', 'Youtube Like JT 3 [ 30 Days Refill - Max 5K ] [ Speed 100+/D ]', '- Start : 0 - 24 hours\r\n- Min: 50 - Max: 5K\r\n- Daily speed 50 - 200 ( Speed can slower if server overload, in this care must wait )\r\n- NON DROP so far - 30 days Refill Guarantee\r\n\r\nNOTE :\r\n- No Refund after order placed\r\n- No Refill if Old Likes Drop Below Start Count .', 50, 10000, 40600, 39150, 'Aktif', 1453, 'MEDANPEDIA'),
(4427, 1454, 'Youtube Likes / Dislikes / Shares / Comment', 'Youtube Like JT 4 [ TERMURAH ][ R30 - 10K ][ 200+/D ] ', '- Instant\r\n- Non drop -\r\n- Guarantee: 30 days refill if any drop\r\n- Speed 200+/D', 20, 10000, 93800, 90450, 'Aktif', 1454, 'MEDANPEDIA'),
(4428, 1455, 'Youtube Likes / Dislikes / Shares / Comment', 'Youtube Like JT 5 [ TERMURAH ][ NO REFILL- 10K ][ 10K+/D ]', '- Instant Start\r\n- Speed for now about 10K/D\r\n- No refill / No refund with any reason .', 20, 10000, 74200, 71550, 'Aktif', 1455, 'MEDANPEDIA'),
(4429, 1456, 'SoundCloud', 'Soundcloud  Followers JT 1 [ High Quality ] ~ Instant ', '[ High Quality ] ~ Instant\r\n', 20, 25000, 30800, 29700, 'Aktif', 1456, 'MEDANPEDIA'),
(4430, 1457, 'SoundCloud', 'Soundcloud Followers JT 2 [ USA ] ~ Instant ', 'Start Time: Instant - 12 hours\r\nSpeed: 1K-2K/ day\r\nRefill: 30 days\r\nSpecs: Mix Quality !', 100, 50000, 26600, 25650, 'Aktif', 1457, 'MEDANPEDIA'),
(4431, 1459, 'Telegram', 'Telegram Post Views [10K] [Last 1] ', 'Start Time: Instant - 1 hour\r\nSpeed: 10K to 20K/ day\r\nRefill: no\r\nSpecs: Latest Post\r\nSend Post Link Or channel id\r\nExajtle Link: https://t.me/link_exajtle/994', 100, 200000, 2100, 2025, 'Aktif', 1459, 'MEDANPEDIA'),
(4432, 1461, 'Facebook Page / Website - Likes / Stars', 'Facebook Page Likes Server 4 [ NO REFILL ] ', 'Max 5k\r\nINSTANT', 100, 1000, 60200, 58050, 'Aktif', 1461, 'MEDANPEDIA'),
(4433, 1463, 'Instagram Followers [guaranteed]', 'Instagram Followers Refill JT 2 (6K) (30 days Refill ) ', ' 0-3 Hours Start\r\n2-3k/Day\r\n30 Days refill', 20, 6000, 119000, 114750, 'Aktif', 1463, 'MEDANPEDIA'),
(4434, 1465, 'Instagram Followers [guaranteed]', 'Instagram Followers Refill JT 3 [REFILL 30] Real dan aktif', 'Start times : 0 - 2H\r\nSpeed/day : 1k+/D\r\nRefill Guarantee : 30 Days ( Refill Button )\r\nQuality : REAL', 20, 20000, 102200, 98550, 'Aktif', 1465, 'MEDANPEDIA'),
(4435, 1475, 'Instagram Like Indonesia', 'Instagram Likes Indonesia JT 1 [ max 3k ] ', 'KEMUNGKINAN selesai pada 3 - 6 jam\r\nmax 24 jam\r\nbisa order 1k 3x untuk 1 foto\r\njadi max 3000', 50, 2000, 21000, 20250, 'Aktif', 1475, 'MEDANPEDIA'),
(4436, 1476, 'Instagram Like Indonesia', 'Instagram Likes Indonesia JT 2 [ MAX 10K ] ⚡️⚡️⚡️', 'KEMUNGKINAN selesai pada 3 - 6 jam\r\nmax 24 jam\r\nbisa order 1k 10x untuk 1 foto\r\njadi max 10.000 untuk 1 foto', 100, 1000, 36400, 35100, 'Aktif', 1476, 'MEDANPEDIA'),
(4437, 1478, '- PROMO - ON OFF', 'Instagram Followers PROMO 5 [ DB JETPEDIA ] [ TERMURAH ] fast', 'HIGH DROP\r\nINSTANT', 10, 5000, 4900, 4725, 'Aktif', 1478, 'MEDANPEDIA'),
(4438, 1484, 'Instagram Views', 'instagram view JT 2 + Ijtressions [RANDOM]', '+ Ijtressions ', 100, 2500000, 980, 945, 'Aktif', 1484, 'MEDANPEDIA'),
(4439, 1490, 'Instagram Followers [guaranteed]', 'Instagram Followers Refill JT 12 [ REAL ] [ STABIL ] BONUS+++', 'Speed : 500-1000 / day, Small Order Deliver Faster\r\nGuaranteed: 30 days Guaranteed\r\nwaktu mulai 0 -5 jam\r\nExtra: 20 -30% Extra Delivers', 20, 20000, 96600, 93150, 'Aktif', 1490, 'MEDANPEDIA'),
(4440, 1493, 'Instagram Followers Indonesia', 'Instagram Followers Indonesia Server 12  [ 3K ] - REAL ', 'Proses sekitar 1-4 hari\r\nreal indo', 100, 1000, 54600, 52650, 'Aktif', 1493, 'MEDANPEDIA'),
(4441, 1497, 'Instagram Followers [guaranteed]', 'Instagram Followers Refill JT 13 [ Real Mixed] [ 30 days refill ] ', 'kecepatan 3k/day\r\n30 days refill\r\nReal Mixed account', 50, 15000, 70000, 67500, 'Aktif', 1497, 'MEDANPEDIA'),
(4442, 1500, 'Instagram Followers [ No Refill ]', 'Instagram Followers JT 31 [ LESS DROP | DROP 10-20% ] ', '1k in 1 minutes\r\n80% real\r\nKemungkinan drop 10-20% jika anda memesan 1000+\r\n', 100, 5000, 42000, 40500, 'Aktif', 1500, 'MEDANPEDIA'),
(4443, 1501, 'Instagram Likes', 'Instagram Likes JT 9 [ Pakistan+asia+indo ] [ 40K ] ', '1k-2k/hour\r\n', 50, 40000, 14000, 13500, 'Aktif', 1501, 'MEDANPEDIA'),
(4444, 1507, 'TIK TOK View/share/comment', 'TIK TOK View S7 [100K/day] ', 'cheap', 500, 1000000, 252, 243, 'Aktif', 1507, 'MEDANPEDIA'),
(4445, 1516, 'TIK TOK Likes', 'TIK TOK Likes S7 [ Real Looking ] 1k-5k/day', 'No Refill', 100, 10000, 33180, 31995, 'Aktif', 1516, 'MEDANPEDIA'),
(4446, 1517, 'Instagram Followers [guaranteed]', 'Instagram Followers Refill Server 4 [ Real Mixed ] [ Refill 30 days ] ', 'Start 0 - 1H\r\n3K/days\r\n30 Days Refill ', 50, 15000, 72800, 70200, 'Aktif', 1517, 'MEDANPEDIA'),
(4447, 1518, 'Youtube Likes / Dislikes / Shares / Comment', 'Youtube Like JT 6 [ Best Seller ][ AUTO Refill ] ', 'Instant\r\n30 days refill\r\nSpeed 200+/hari', 20, 10000, 56000, 54000, 'Aktif', 1518, 'MEDANPEDIA'),
(4448, 1531, 'Instagram Followers [ No Refill ]', 'Instagram Followers JT 33 [ NON DROP | BONUS 0-5% ] [ 2k/Day ]⚡️', 'waktu proses 0-1jam\r\nkecepatan 1k-3k/hari\r\nno drop\r\nkalo drop kemungkinan besar itu followers yang lain, bukan dari kami\r\nkalo drop kemungkinan sangat dikit dan no refill', 50, 100000, 168000, 162000, 'Aktif', 1531, 'MEDANPEDIA'),
(4449, 1533, 'Twitter Followers', 'Twitter Followers Server 2 [ refill 30Days ] [ Real  ] ', 'Instant Start ( 0 - 2h )\r\nReal Users\r\nSpeed 100K - 1k/D', 10, 5000, 154000, 148500, 'Aktif', 1533, 'MEDANPEDIA'),
(4450, 1534, 'Instagram Live Video', 'Instagram Live Video Views [ untuk durasi 10 menit ]', 'Mulai Instan \r\nGunakan username tanpa @ \r\nTejtatkan pesanan setelah ditayangkan langsung dari Perangkat berbeda\r\nJangan jeda sesi langsung \r\nAmbil bukti screenshot jika tayangan langsung gagal \r\nkarena masalah terkait reffund.', 20, 2000, 56000, 54000, 'Aktif', 1534, 'MEDANPEDIA'),
(4451, 1535, 'Instagram Live Video', 'Instagram Live Video Views [ untuk durasi 20 menit ]', 'Mulai Instan \r\nGunakan username tanpa @ \r\nTejtatkan pesanan setelah ditayangkan langsung dari Perangkat berbeda\r\nJangan jeda sesi langsung \r\nAmbil bukti screenshot jika tayangan langsung gagal \r\nkarena masalah terkait reffund.', 20, 2000, 88200, 85050, 'Aktif', 1535, 'MEDANPEDIA'),
(4452, 1536, 'Instagram Live Video', 'Instagram Live Video Views [ untuk durasi 30 menit ]', 'Mulai Instan \r\nGunakan username tanpa @ \r\nTejtatkan pesanan setelah ditayangkan langsung dari Perangkat berbeda\r\nJangan jeda sesi langsung \r\nAmbil bukti screenshot jika tayangan langsung gagal \r\nkarena masalah terkait reffund.', 20, 2000, 119000, 114750, 'Aktif', 1536, 'MEDANPEDIA'),
(4453, 1537, 'Facebook Video Views / Live Stream', 'Facebook Live Video Stream  Views [ untuk durasi 30 menit ]', '- Instant Start\r\n- Exajtle : https://www.facebook.com/user/videos/ID\r\n- Live must be PUBLIC\r\n\r\nCATATAN!!! : - https://www.facebook.com/user/videos/ID\r\n                        - Bukan https://www.facebook.com/user/videos/ID/', 50, 5000, 259000, 249750, 'Aktif', 1537, 'MEDANPEDIA'),
(4454, 1538, 'Facebook Video Views / Live Stream', 'Facebook Live Video Stream Views [ untuk durasi 60 menit ] ', '- Instant Start\r\n- Exajtle : https://www.facebook.com/user/videos/ID\r\n- Live must be PUBLIC\r\n\r\nCATATAN!!! : - https://www.facebook.com/user/videos/ID\r\n                        - Bukan https://www.facebook.com/user/videos/ID/', 50, 5000, 518000, 499500, 'Aktif', 1538, 'MEDANPEDIA'),
(4455, 1539, 'Facebook Video Views / Live Stream', 'Facebook Live Video Stream Views [ untuk durasi 90 menit ] ', '- Instant Start\r\n- Exajtle : https://www.facebook.com/user/videos/ID\r\n- Live must be PUBLIC\r\n\r\nCATATAN!!! : - https://www.facebook.com/user/videos/ID\r\n                        - Bukan https://www.facebook.com/user/videos/ID/', 50, 5000, 770000, 742500, 'Aktif', 1539, 'MEDANPEDIA'),
(4456, 1540, 'Facebook Video Views / Live Stream', 'Facebook Live Video Stream Views [ untuk durasi 120 menit ] ', '- Instant Start\r\n- Exajtle : https://www.facebook.com/user/videos/ID\r\n- Live must be PUBLIC\r\n\r\nCATATAN!!! : - https://www.facebook.com/user/videos/ID\r\n                        - Bukan https://www.facebook.com/user/videos/ID/', 50, 5000, 1015000, 978750, 'Aktif', 1540, 'MEDANPEDIA'),
(4457, 1546, 'TIK TOK View/share/comment', 'TIK TOK View S9 [ superfast ] [ Trending + Viral Views]', 'Layanan ini berbeda dengan view lain\r\nkarena layanan ini bisa membuat trending dan viral video', 500, 1000000, 2800, 2700, 'Aktif', 1546, 'MEDANPEDIA'),
(4458, 1553, 'Twitter Views & Impressions', 'Twitter Views Server 2 [ REAL - Max 15K ]⚡️⚡️', '- Instant start and order will cojtleted in some min\r\n- No refill\r\n- All real data , No Bo , kemungkinan drop 10%', 20, 15000, 4900, 4725, 'Aktif', 1553, 'MEDANPEDIA'),
(4459, 1555, 'Instagram Followers Indonesia', 'Instagram Followers Indonesia Server 16 max 5000 ⚡️', 'per order 2000\r\nmax bisa 5000 untuk 1 akun\r\nInstal\r\njika overload kemungkinan 1-3 hari\r\njarang terjadi\r\nReal', 100, 1000, 63000, 60750, 'Aktif', 1555, 'MEDANPEDIA'),
(4460, 1560, 'Youtube Views', 'Youtube Live Stream Views [ REAL ][ BETA ]', '• Tajtilan Aktif Nyata **\r\n• MULAI INSTAN\r\n• 100% Pemirsa Pengguna YouTube Manusia Nyata!\r\n• Tajtilan Halaman Desktop Windows & Mobile Watch\r\n• 100% Lalu Lintas Unik dapat dimonetisasi!\r\n• Pemirsa Seluruh Dunia\r\n• Harus Tidak Terbatas & Terbuka untuk SEMUA negara\r\n• Retensi Acak\r\n• Rata-rata Bersamaan dan waktu tonton berdasarkan konten streaming langsung\r\n• Pengiriman Lebih Dijamin\r\n• penayangan dapat dikirim ke embed video streaming langsung yang dinonaktifkan\r\n• Sumber Lalu Lintas: Iklan Langsung\r\n\r\nCATATAN :\r\n- Layanan Beta - itu berarti layanan yang ditawarkan apa adanya tanpa jaminan isi ulang!\r\n- Tajtilan dapat mencakup keterlibatan pengguna nyata - video Anda mungkin mendapatkan suka / tidak suka setiap hari, komentar, bagikan, pelanggan ,,, semua dibuat oleh pengguna YouTube nyata yang tidak kami kontrol!', 1000, 100000, 91000, 87750, 'Aktif', 1560, 'MEDANPEDIA'),
(4461, 1562, 'Twitter Retweets', 'Twitter Retweets Server 1 [ Max 3K ]⚡️⚡️', 'Top Quality UK Active Profiles\r\n7 day Auto Refill\r\n200 Per day\r\npesanan yang kami terima\r\ncontoh 100,200,300\r\njangan random seperti 201,732,390 tidak kami terima', 10, 3000, 39200, 37800, 'Aktif', 1562, 'MEDANPEDIA'),
(4462, 1563, 'TIK TOK Followers', 'TIK TOK FOLLOWERS Server 1  [ 30 days refill - Full URL ] ', '30 days refill guarantee\r\n100% bot with no profile pciture', 50, 50000, 77000, 74250, 'Aktif', 1563, 'MEDANPEDIA'),
(4463, 1564, 'Instagram Followers [guaranteed]', 'Instagram Followers Refill Server 8 [ Real,Mixed ] [ Refill 10D ][ Best Market ]⚡️⭐⭐ ', '- Mulai kali 1 - 6 jam\r\n- Kecepatan 20k / days\r\n- Non drop atau sedikit drop sejauh ini\r\n- Garansi: isi ulang 10 hari jika drop', 100, 50000, 64400, 62100, 'Aktif', 1564, 'MEDANPEDIA'),
(4464, 1565, 'Instagram Likes', 'Instagram Likes JT 15 [ NO DROP ] Max terbanyak', 'No Drop Likes\r\n1-3K / Hour', 100, 50000, 15400, 14850, 'Aktif', 1565, 'MEDANPEDIA'),
(4465, 1570, 'Twitch', 'Twitch Followers 100K/days', 'No Drop & 30 Day Refill Guarantee!\r\nStarts in 5 minute\r\nStarting very fast!', 100, 500000, 12880, 12420, 'Aktif', 1570, 'MEDANPEDIA'),
(4466, 1572, 'Instagram Like Komentar [ top koment ]', 'Instagram Like Komentar Indonesia Real [ BACA Deskripsi ]', 'Diusahakan post baru\r\nkadang gk dapat id komen\r\nProses max 5 jam an\r\nformat = link post + username\r\ncontoh https://www.instagram.com/p/BiWlAgnlE5e/ + filmy_gyan33 ( ingat dipisah  link post spasi + spasi username)\r\nseperti https://gyazo.com/9ab9235b653312259e325eb1a80ce1df\r\n\r\nTOLONG DIPERHATIKAN!!!', 20, 5000, 65800, 63450, 'Aktif', 1572, 'MEDANPEDIA'),
(4467, 1574, 'Instagram Followers Indonesia', 'Instagram Followers Indonesia Server 17 max 2K⚡️  Real Aktif', 'Proses fast\r\nmax proses 3 hari baru kojtline\r\nReal indo\r\nper akun max 2k', 50, 1000, 48300, 46575, 'Aktif', 1574, 'MEDANPEDIA'),
(4468, 1576, 'Instagram Followers Indonesia', 'Instagram Followers Indonesia Server 18 [ max 500 ] ', 'bisa order 2x di 1 akun\r\nreal proses max 3 hari\r\n', 100, 500, 37800, 36450, 'Aktif', 1576, 'MEDANPEDIA'),
(4469, 1580, 'Instagram Followers Indonesia', 'Instagram Followers Indonesia Server 19 [ mix bule + indo ] DB FRESH', 'bule + indo real\r\nproses cepat', 200, 4500, 30800, 29700, 'Aktif', 1580, 'MEDANPEDIA'),
(4470, 1581, 'Instagram Followers Indonesia', 'Instagram Followers Indonesia Server 20 [ mix bule + indo ] DB FRESH MAX2.5k', 'mix indo bule\r\n', 200, 2500, 35000, 33750, 'Aktif', 1581, 'MEDANPEDIA'),
(4471, 1584, 'Youtube Views', 'Youtube Views server 10 [ LIFETIME ][ FASTEST IN THE MARKET ]', 'Speed 1 Million Per Day\r\nInstant Start\r\nNON-Drop\r\nLife Time Guarantee', 1000, 100000000, 36400, 35100, 'Aktif', 1584, 'MEDANPEDIA'),
(4472, 1592, 'TIK TOK Likes', 'TIK TOK Likes Server 1 [ 30 days refill  ] [ Cheap ] ', ' Speed:1k-5k/day\r\nGuarantee : 30 Days', 100, 10000, 19600, 18900, 'Aktif', 1592, 'MEDANPEDIA'),
(4473, 1593, 'TIK TOK Followers', 'TIK TOK FOLLOWERS Server 2 [ no refill ] [baca deskripsi]', '1k-5k/day\r\nGunakan link video untuk followers jangan link profil\r\nNo Guarantee', 100, 10000, 63000, 60750, 'Aktif', 1593, 'MEDANPEDIA'),
(4474, 1594, 'Twitter Favorites', 'Twitter Favourites/Likes Server 1', '1k/1hour\r\n', 100, 1000, 24500, 23625, 'Aktif', 1594, 'MEDANPEDIA'),
(4475, 1598, 'Instagram Like Indonesia', 'Instagram Likes JT 16 [ Indian, asia, Indonesia]', 'akun dari Indonesia, India, China , Thailand like [ semual like mix tidak tertarget]', 50, 1500, 12740, 12285, 'Aktif', 1598, 'MEDANPEDIA'),
(4476, 1606, 'Likee app', 'Likee App Post Likes [Speed : 1k-2k/day]', 'contoh target :https://likee.com/@********/video/*********\r\nNo refill', 20, 10000, 74200, 71550, 'Aktif', 1606, 'MEDANPEDIA'),
(4477, 1607, 'Likee app', 'Likee App Followers  [ 500-1k/day ]', 'contoh target https://likee.com/@********\r\nno refill', 20, 10000, 161000, 155250, 'Aktif', 1607, 'MEDANPEDIA'),
(4478, 1614, '- PROMO - ON OFF', 'Tik tok View GRATIS khusus Jetpedia ', 'No kojtline\r\nNo spam', 100, 10000, 0, 0, 'Aktif', 1614, 'MEDANPEDIA'),
(4479, 1619, 'TIK TOK View/share/comment', 'TIK TOK Custom Comments Server 1 [ 1K/ Day ]', '[Speed 1K/ Day]', 5, 1000, 322000, 310500, 'Aktif', 1619, 'MEDANPEDIA'),
(4480, 1621, 'Youtube Likes / Dislikes / Shares / Comment', 'Youtube Like JT 7 [ No Refill and Cheapest ] ', 'Real Youtube Likes\r\nInstant Start', 30, 50000, 25200, 24300, 'Aktif', 1621, 'MEDANPEDIA'),
(4481, 1623, 'TIK TOK Followers', 'TIK TOK FOLLOWERS Server 3 [ 30 days refill ] [ Recommended  ] ', '30 days guarantee\r\nspeed - 10k/day', 100, 10000, 63000, 60750, 'Aktif', 1623, 'MEDANPEDIA'),
(4482, 1627, 'Instagram Followers [guaranteed]', 'Instagram Followers Refill Server 12 [ Refill 99Day ][ mix ]', 'refill 99 days\r\nkecepatan 5-10k/days', 100, 999000, 42000, 40500, 'Aktif', 1627, 'MEDANPEDIA'),
(4483, 1629, 'Instagram Followers Indonesia', 'Instagram Followers Indonesia Server 22 [ TERMURAH ] DB Max 350', 'max 3 hari \r\nlewat bisa req canceled\r\n\r\nReal Aktif bosq', 100, 350, 32200, 31050, 'Aktif', 1629, 'MEDANPEDIA'),
(4484, 1634, 'Youtube Likes / Dislikes / Shares / Comment', 'Youtube Like JT 8 [ Lifetime Guaranted and Cheapest ] ', 'Speed 200 -1k/D\r\ninstan', 10, 20000, 28700, 27675, 'Aktif', 1634, 'MEDANPEDIA'),
(4485, 1636, 'Instagram Followers [ No Refill ]', 'Instagram Followers Server 5 [ Max 50K - BOT ] ', 'highdrop', 10, 50000, 15400, 14850, 'Aktif', 1636, 'MEDANPEDIA'),
(4486, 1645, 'Instagram Followers [ No Refill ]', 'Instagram Followers Server 7 [ fastest - BOT ] ', 'Bot Quality', 10, 30000, 11200, 10800, 'Aktif', 1645, 'MEDANPEDIA'),
(4487, 1646, 'Telegram', 'Telegram Channnel Members [ Max 50k ]', 'proses 1-48 jam\r\n', 100, 25000, 22400, 21600, 'Aktif', 1646, 'MEDANPEDIA'),
(4488, 1647, 'Telegram', 'Telegram Channnel Members [ Max 5k ] INSTANT-3HRS ', 'Speed:5k/day', 1000, 5000, 36400, 35100, 'Aktif', 1647, 'MEDANPEDIA'),
(4489, 1649, 'Instagram Followers [guaranteed]', 'Instagram Followers Refill Server 14 [ auto Refill 30Day ]', 'auto refill dalam 2 minggu\r\nlebih dari itu req refill ke tiket\r\n', 100, 20000, 77000, 74250, 'Aktif', 1649, 'MEDANPEDIA'),
(4490, 1650, 'Instagram Followers [ No Refill ]', 'Instagram Followers Server 8 [ cheapest - BOT ] ', '- BOT Followers\r\nstart 0-24 jam\r\nmurah!', 50, 10000, 9240, 8910, 'Aktif', 1650, 'MEDANPEDIA'),
(4491, 1651, 'Instagram Likes', 'Instagram Likes JT 19 [ NON DROP ] [5k-10k Per Day] ', 'instan', 100, 300000, 14980, 14445, 'Aktif', 1651, 'MEDANPEDIA'),
(4492, 1665, 'Instagram Followers [guaranteed]', 'Instagram Followers Refill S1 [ Refill 60Day ] INSTANT ', 'High Quality\r\n1k - 2k Per Day Speed\r\n', 20, 100000, 42000, 40500, 'Aktif', 1665, 'MEDANPEDIA'),
(4493, 1666, 'Instagram Followers [guaranteed]', 'Instagram Followers Refill S2 [ Refill 30Day ] LessDrop', 'kemungkinan drop 5-15% ( tapi gk jami 100% )\r\nHigh-Quality\r\n', 50, 100000, 44800, 43200, 'Aktif', 1666, 'MEDANPEDIA'),
(4494, 1667, 'Instagram Followers [guaranteed]', 'Instagram Followers Refill S3 [ Refill 30Day ] [ Real Recommended  ]', 'sekitar 70%-80% real user\r\nSpeed 1k Per Day\r\n', 100, 85000, 53200, 51300, 'Aktif', 1667, 'MEDANPEDIA'),
(4495, 1668, 'Instagram Followers [guaranteed]', 'Instagram Followers Refill S4 [ Real,active ] [ Refill 30D ][ Best Market ]⚡️⭐⭐', '- waktu mulai : 0 - 20 mins \r\n- Kecepatan 2 -3k/hari \r\n- 100% Real Bule \r\n- Less DROP', 20, 100000, 60200, 58050, 'Aktif', 1668, 'MEDANPEDIA'),
(4496, 1672, 'Facebook Followers / Friends', 'Facebook Profile Follower JT 4 [ R30Day ] [Non Drop]', 'Refill 30Day\r\nkami sudah uji selama 2 bulan dan tidak ada penurunan\r\njadi kami tidak bisa mastikan ini nondrop 100% jika ada update dll', 50, 20000, 86800, 83700, 'Aktif', 1672, 'MEDANPEDIA'),
(4497, 1673, 'Instagram Followers [guaranteed]', 'Instagram Followers Refill S5 [ Refill 1 TAHUN ][ NODROP ][ BETA ]⚡️⭐⭐ ', 'speed berubah ubah karna masih tahap BETA\r\nBisa request refill selama setahun jika ada drop\r\n5K/Day', 100, 300000, 119000, 114750, 'Aktif', 1673, 'MEDANPEDIA'),
(4498, 1674, 'Instagram Like Indonesia', 'Instagram Likes Indonesia JT 3 [ Langsung Input MAX 4K ] INSTAN⚡️⚡️⚡️ ', 'FAST', 100, 4000, 37100, 35775, 'Aktif', 1674, 'MEDANPEDIA'),
(4499, 1676, 'Youtube Views', 'Youtube Views server 22 [ 5K - 20k/day ] [ Lifetime Guarantee ] ', '- Instant\r\n- Retention: 30 Second +\r\n- Speed 5K - 20k/day For NOW', 500, 10000, 40600, 39150, 'Aktif', 1676, 'MEDANPEDIA'),
(4500, 1681, 'Instagram Followers [guaranteed]', 'Instagram Followers Refill S6 [ AUTO  Refill 30 days ]⚡️⭐⭐ ', '1K/day', 50, 10000, 60200, 58050, 'Aktif', 1681, 'MEDANPEDIA'),
(4501, 1684, 'Youtube View Jam Tayang', 'Youtube Views [ Jam Tayang 4000 jam ] [ Durasi Video 1 -2  jam+ ] [ cek Deskripsi ]', 'jumlah pesan = jam tayang yang kamu dapat\r\n\r\n- Eksklusif di JETPEDIA\r\n- Silakan memesan 4000 tajtilan untuk mendapatkan waktu menonton 4kh\r\n- Mulai 0 - 12 Jam - Real Views\r\n- Jika Anda menggunakan video 1jam + maka 7 - 10 hari selesai (Video 2 jam+ maka 3 - 7 hari selesai).\r\n- Garansi: refill 30 Hari\r\n\r\n\r\nCATATAN :\r\n- Harap cantumkan video yang memiliki panjang hanya 1 jam + (Jika tidak sajtai 1 jam , pesanan masih berjalan tetapi waktu menonton tidak akan cukup, kami tidak dapat melakukan refill / reffund Dana / canceled / Partial dalam kasus ini)\r\n- Jika view lama Anda turun di bawah jumlah mulai, maka kami tidak dapat Refill / Refund / Cancel / Membatalkan sebagian. ( lebih baik menggunakan video dengan view yg sedikit/baru )\r\n- Silakan gunakan video tanpa tajtilan interleaving alami (Jika Anda secara bersamaan mendapatkan view alami (ditonton orang lain selain sistem kami ) saat menjalankan waktu jam tayang, Anda tidak akan mendapatkan cukup waktu jam tayang.)\r\n- Jika video Dihapus, Ditolak, Privat sementara kami menambahkan waktu tontonan atau setelah selesai, maka kami tidak dapat refill / reffund Dana / canceled / Partial.\r\n- Lebih baik pls video yang tidak publik saat menjalankan waktu jam tayang.\r\ntidak dipublic bukan berarti di private maksudnya itu video tidak ada muncul di channel mu tapi masih bisa diakses melalui url atau link', 100, 4000, 159600, 153900, 'Aktif', 1684, 'MEDANPEDIA'),
(4502, 1687, 'Youtube Views', 'Youtube Views server 27 [ 5 - 20 Min Retention ] [ Lifetime Guarantee ] ', '- Instant Start ( 0 - 30 mins )\r\n- Youtube Views High Retention\r\n- Retention : 5 - 20 Minutes watch time\r\n- Guarantee: 30 days refill\r\n- Speed about 1k - 5k/day for now\r\n\r\nNOTE :\r\n- Embed : disabled will not work\r\n- Premiere videos will not work\r\n- Live streamed videos will not work\r\n- Copy right content will not work', 100, 1000000, 49000, 47250, 'Aktif', 1687, 'MEDANPEDIA'),
(4503, 1688, 'Facebook Followers / Friends', 'Facebook Follower  Profile indonesia JT 5 ', 'No refill', 50, 15000, 79800, 76950, 'Aktif', 1688, 'MEDANPEDIA'),
(4504, 1705, 'Youtube Views', 'Youtube Views JT 1 [ 50k-100k/day ] [ 20 Days Refill ] INSTANT', 'Instant Start\r\n1-3mins Retention\r\n50k-100k/day\r\n20 Days Refill', 100, 100000000, 43400, 41850, 'Aktif', 1705, 'MEDANPEDIA'),
(4505, 1707, 'Youtube Views', 'Youtube Views JT 2 [ 20k/day ] [ Lifetime Refill ] ', 'Instant ', 100, 1000000, 39900, 38475, 'Aktif', 1707, 'MEDANPEDIA'),
(4506, 1709, 'Instagram Followers Indonesia', 'Instagram Followers Indonesia Server 25 DB 20K', 'Sekali order 10k', 100, 10000, 44800, 43200, 'Aktif', 1709, 'MEDANPEDIA'),
(4507, 1710, 'Youtube Views', 'Youtube Views JT 4 [ 10k/day ] [ Lifetime Refill ] ', '- Instant', 100, 1000000, 35000, 33750, 'Aktif', 1710, 'MEDANPEDIA'),
(4508, 1711, 'Youtube Views', 'Youtube Views JT 5 [ 3 - 10 Min Retention ] [ Lifetime Guarantee ] ', 'waktu mulai  0-6 HRS (Biasanya INSTANT)\r\n1K-2K+/days\r\nTajtilan Retensi Sangat Tinggi\r\n✔ 3-7 Menit Waktu Menonton (Biasanya 5+ Menit)\r\n✔ 100% Pemirsa YouTube Manusia Nyata!\r\n✔Jaminan Isi Ulang Seumur Hidup (Dijamin Over Delivery)\r\n✔ Mengaktifkan Tombol Isi Ulang\r\n✔ Sangat Bagus untuk 4000 Jam Waktu Menonton!\r\nCatatan: Hanya Kirim Tautan Video\r\nCatatan penting:\r\nTambahkan Video dengan durasi lebih dari 60 Menit untuk retensi yang lebih baik. Anda tidak akan mendapatkan retensi yang baik dalam video selama kurang dari 60 Menit', 1000, 1000000, 65800, 63450, 'Aktif', 1711, 'MEDANPEDIA'),
(4509, 1716, 'Youtube Views', 'Youtube Views JT 6 [ 20-50k/days ] [ 30 Days Refil ] ', 'fast', 100, 100000000, 43400, 41850, 'Aktif', 1716, 'MEDANPEDIA'),
(4510, 1717, 'Youtube Views', 'Youtube Views JT 7 [ Best Service ] [ Life Time Guaranteed ] ', 'INSTANT START\r\nGood For Ranking\r\nLife Time Guaranteed\r\nFast', 1000, 100000000, 30800, 29700, 'Aktif', 1717, 'MEDANPEDIA'),
(4511, 1719, 'Instagram Likes', 'Instagram Likes JT 20 [ Real Account ] [ Best Seller ] ', 'No garansi apaun yg terjadi\r\nKualitas bagus\r\ntidak drop paling kalo drop sekitar 10% ( kami tidak menjamin ini selamanya karna ig kadang update gk jelas )', 10, 20000, 9380, 9045, 'Aktif', 1719, 'MEDANPEDIA'),
(4512, 1721, 'Twitter Indonesia', 'Twitter Followers REAL INDONESIA Fast', 'No garansi\r\nno kojtline\r\nReal indo', 1, 200, 176400, 170100, 'Aktif', 1721, 'MEDANPEDIA'),
(4513, 1722, 'Twitter Indonesia', 'Twitter Followers REAL INDONESIA Fast S2', 'No garansi\r\nno kojtline\r\nReal indo', 1, 100, 176400, 170100, 'Aktif', 1722, 'MEDANPEDIA'),
(4514, 1723, 'Twitter Indonesia', 'Twitter Retweet REAL INDONESIA Fast', 'No garansi\r\nno kojtline\r\nReal indo', 1, 150, 490000, 472500, 'Aktif', 1723, 'MEDANPEDIA'),
(4515, 1724, 'Twitter Indonesia', 'Twitter Favorite/Likes REAL INDONESIA Fast', 'No garansi\r\nno kojtline\r\nReal indo', 1, 150, 259000, 249750, 'Aktif', 1724, 'MEDANPEDIA'),
(4516, 1725, 'Followers Shopee/Tokopedia/Bukalapak', 'Shopee Followers Server 3 [15K] DB NEW ', 'fast\r\nNO DROP\r\n\r\nBisa sajtai 15K', 100, 10000, 35000, 33750, 'Aktif', 1725, 'MEDANPEDIA'),
(4517, 1726, 'Instagram Like Indonesia', 'Instagram Likes Indonesia JT 4 [ Langsung Input MAX 100K ] ', 'Fast\r\nReal\r\nper order 10k bisa 10 kali', 50, 10000, 35000, 33750, 'Aktif', 1726, 'MEDANPEDIA'),
(4518, 1727, 'Instagram Followers Indonesia', 'Instagram Followers Indonesia Server 26 DB 5k INSTAN REAL', 'Fast\r\nbiasanya 1x24 jam\r\nTidak sajtai berhari hari\r\nWajib username\r\nDB max 50k', 100, 5000, 50400, 48600, 'Aktif', 1727, 'MEDANPEDIA'),
(4519, 1729, 'Instagram Followers [guaranteed]', 'Instagram Followers Refill S7 [ Refill 30 days ] [ baca Deskripsi ] Real Accounts Active', 'Hanya menerima followers di bawah 100\r\ndi atas 100 tidak kami terima\r\nmohon di pahami\r\nInstan', 10, 50000, 71400, 68850, 'Aktif', 1729, 'MEDANPEDIA'),
(4520, 1733, 'Youtube Subscribers', 'Youtube Subscribe BETA 3 [ Refill 30Days ] [ Cheap ] ', 'Real active users\r\nslow', 10, 500000, 252000, 243000, 'Aktif', 1733, 'MEDANPEDIA'),
(4521, 1738, 'TIK TOK Likes', 'TIK TOK Likes Server 4 [ Real ] [ NON DROP ] ', 'Instant\r\nsuper fast\r\nNon Drop', 10, 50000, 15400, 14850, 'Aktif', 1738, 'MEDANPEDIA'),
(4522, 1741, 'Facebook Post Likes / Comments / Shares', 'Facebook Photo / Post Likes JT4 [ 30 days Refill ]', 'Start Instant', 50, 5000, 27300, 26325, 'Aktif', 1741, 'MEDANPEDIA'),
(4523, 1744, 'Instagram Followers Indonesia', 'Instagram Followers Indonesia Server 28  BONUS+++ ', 'Instan\r\nADA BONUS sekitar 5-10%', 100, 3000, 64400, 62100, 'Aktif', 1744, 'MEDANPEDIA'),
(4524, 1745, 'Instagram Like Indonesia', 'Instagram Likes Indonesia JT 5 [ MAX 10K ] ', 'proses 2x24 jam\r\nReal', 50, 10000, 25200, 24300, 'Aktif', 1745, 'MEDANPEDIA'),
(4525, 1746, 'Instagram Like Indonesia', 'Instagram Likes Indonesia JT 6 [ MAX 5K ] FAST BONUS+++ ⚡️⚡️⚡️', 'Real\r\nfast\r\ndapat bonus jika hoki', 100, 5000, 32200, 31050, 'Aktif', 1746, 'MEDANPEDIA'),
(4526, 1747, 'Instagram Followers Indonesia', 'Instagram Followers Indonesia Server 29  [ max 3k ]', 'proses fast\r\nmax 2 hari', 100, 3000, 58800, 56700, 'Aktif', 1747, 'MEDANPEDIA'),
(4527, 1749, 'Youtube Views', 'Youtube Views JT 8 [ 5 - 20 Min Retention ] [ Lifetime Guarantee ] ', 'HR', 100, 100000, 47600, 45900, 'Aktif', 1749, 'MEDANPEDIA'),
(4528, 1750, 'TIK TOK View/share/comment', 'TIK TOK View S10 [ super cheap ]', 'proses 0-10menit\r\n', 1000, 1000000000, 28, 27, 'Aktif', 1750, 'MEDANPEDIA'),
(4529, 1751, 'Instagram Likes', 'Instagram Likes JT 23 [ no Drop ]', 'sudah di tes dalam waktu 3 bulan tidak ada penurunan\r\njika ada update tiba tiba dan like turun\r\ntidak ada garansi', 10, 5000, 14280, 13770, 'Aktif', 1751, 'MEDANPEDIA'),
(4530, 1752, 'Facebook Post Likes / Comments / Shares', 'Facebook Photo / Post Likes Indonesia', 'Instan', 50, 20000, 44800, 43200, 'Aktif', 1752, 'MEDANPEDIA'),
(4531, 1753, 'Facebook Post Likes / Comments / Shares', 'Facebook Photo / Post Likes JT5 [ 30 days Refill ] [max10k]', 'Murah', 20, 100000, 18200, 17550, 'Aktif', 1753, 'MEDANPEDIA'),
(4532, 1754, 'Instagram Likes', 'Instagram Likes JT 24 [ Less Drop ] ', 'Drop hanya 5-10%\r\nNo Garansi', 50, 10000, 10080, 9720, 'Aktif', 1754, 'MEDANPEDIA'),
(4533, 1755, 'Instagram Followers [ No Refill ]', 'Instagram Followers S1 [ bot instan ] [ max 10k ]', 'HIGH DROP\r\nbot', 20, 10000, 7560, 7290, 'Aktif', 1755, 'MEDANPEDIA'),
(4534, 1756, 'Instagram Followers [ No Refill ]', 'Instagram Followers S2 [ bot  5k per days ] [ max 10k ] ', 'Start: 0-1HRS\r\nDrop Bisa 100%\r\nbisa dibawah 50% tergantung hoki', 50, 10000, 8960, 8640, 'Aktif', 1756, 'MEDANPEDIA'),
(4535, 1757, 'Instagram Followers [ No Refill ]', 'Instagram Followers S3 [ bot Speed 500/jam ] [ max 20k ] ', 'HIGH DROP', 100, 20000, 14980, 14445, 'Aktif', 1757, 'MEDANPEDIA'),
(4536, 1758, 'Instagram Followers [ No Refill ]', 'Instagram Followers S4 [ REAL USER ] [ fast ] [ HQ ]', 'Instan\r\nreal', 100, 3000, 13160, 12690, 'Aktif', 1758, 'MEDANPEDIA'),
(4537, 1759, 'Instagram Followers Indonesia', 'Instagram Followers Indonesia S1 [ max 1k ] [ cheap ]', 'fast\r\nsebelum 12 jam udah done\r\njika pesanan tidak banyak\r\nmax2hari', 50, 1000, 47600, 45900, 'Aktif', 1759, 'MEDANPEDIA'),
(4538, 1760, 'Instagram Like Indonesia', 'Instagram Likes Indonesia JT 7 [ MAX 1K ] FAST MURAH', 'Drop kecil banget\r\nreal ', 50, 1000, 26600, 25650, 'Aktif', 1760, 'MEDANPEDIA'),
(4539, 1761, 'Instagram Followers [guaranteed]', 'Instagram Followers Refill S8 [ Refill 30D] [ max 5k ] HQ FAST', 'DROP KEMUNGKINAN Hanya 10%\r\nmulai 0-1jam', 100, 5000, 34300, 33075, 'Aktif', 1761, 'MEDANPEDIA'),
(4540, 1762, 'Instagram Followers [guaranteed]', 'Instagram Followers Refill S9 [ Refill 30D] [ max 10k ] HQ FAST ', 'DROP KEMUNGKINAN Hanya 10%\r\nmulai 0-1jam', 100, 10000, 37800, 36450, 'Aktif', 1762, 'MEDANPEDIA'),
(4541, 1763, 'Instagram Followers [guaranteed]', 'Instagram Followers Refill S10 [ Refill 30D] [ max 5k ] ', 'Instan\r\n3k-5k/days', 100, 5000, 31500, 30375, 'Aktif', 1763, 'MEDANPEDIA'),
(4542, 1764, 'TIK TOK INDONESIA', 'TikTok Views Indonesia no drop', 'Pasif indo\r\ninstan\r\nlambat jika antrian panjang', 100, 1000, 9800, 9450, 'Aktif', 1764, 'MEDANPEDIA'),
(4543, 1765, 'TIK TOK INDONESIA', 'TikTok Likes Indonesia no drop ', 'Pasif indo\r\ninstan\r\nlambat jika antrian panjang', 100, 1000, 49000, 47250, 'Aktif', 1765, 'MEDANPEDIA'),
(4544, 1766, 'TIK TOK INDONESIA', 'TikTok Share Indonesia no drop [ VIRAL ]', 'instan\r\nlambat jika antrian panjang\r\ninsyaallah fyp', 100, 1000, 67200, 64800, 'Aktif', 1766, 'MEDANPEDIA'),
(4545, 1767, 'Youtube Views', 'Youtube Views JT 9  [ 30 Days Refill] [ Recommended ] ⚡', 'instan \r\n10-30K per day', 100, 20000000, 33600, 32400, 'Aktif', 1767, 'MEDANPEDIA'),
(4546, 1768, 'Instagram Followers [guaranteed]', 'Instagram Followers Refill S11 [ AUTO REFILL ]  [ Recommended ]', 'Refill 360days\r\nGOOD', 20, 15000, 50400, 48600, 'Aktif', 1768, 'MEDANPEDIA'),
(4547, 1769, 'Instagram Followers [guaranteed]', 'Instagram Followers Refill S12 [ CHEAPEAST ] [ Refill 7D ] ', '1k/days', 20, 20000, 13440, 12960, 'Aktif', 1769, 'MEDANPEDIA');
INSERT INTO `layanan` (`id`, `service_id`, `kategori`, `layanan`, `catatan`, `min`, `max`, `harga`, `harga_api`, `status`, `provider_id`, `provider`) VALUES
(4548, 1772, 'Instagram Followers Indonesia', 'Instagram Followers Indonesia S2 [ REAL AKTIF ] [ cheapest ] [ Fast ] ', 'Proses sebelum 1 hari clear\r\nmax 2 hari jika bener bener padat', 50, 100, 21000, 20250, 'Aktif', 1772, 'MEDANPEDIA'),
(4549, 1773, 'Instagram TV', 'Instagram TV Like Server 4 [ BOT ] [ HQ ]', ' Instant\r\nno garansi ', 10, 10000, 15400, 14850, 'Aktif', 1773, 'MEDANPEDIA'),
(4550, 1774, 'Instagram TV', 'Instagram TV Like Server 5 [ Instan ]', 'instan', 100, 2000, 26600, 25650, 'Aktif', 1774, 'MEDANPEDIA'),
(4551, 1775, 'Instagram Followers Indonesia Guaranted/Refill', 'Instagram Followers Indonesia Guaranted 1 [ FEMALE ] [ Refill 7 days 1x ]', 'Dilarang private/ganti username/batas usia maka langsung sukses tanpa reffund\r\nklaim garansi jika drop 15%\r\nhanya bisa sekali refill', 100, 3000, 72800, 70200, 'Aktif', 1775, 'MEDANPEDIA'),
(4552, 1776, 'Instagram Followers Indonesia Guaranted/Refill', 'Instagram Followers Indonesia Guaranted 2 [ REAL ] [ Refill 7 days 1x ] ', 'Dilarang private/ganti username/batas usia maka langsung sukses tanpa reffund\r\nklaim garansi jika drop 15%\r\nhanya bisa sekali refill', 100, 5000, 84000, 81000, 'Aktif', 1776, 'MEDANPEDIA'),
(4553, 1777, 'Instagram Followers Indonesia Guaranted/Refill', 'Instagram Followers Indonesia Guaranted 3 [ FEMALE ] [ Refill 30 days ] ', 'bisa berkali2 refill setiap memenuhi ketentuan refill bisa terus sajte 30 hari\r\nDilarang private/ganti username/batas usia maka refill Hangus\r\n- Garansi 30 hari apabila drop lebih dari 15%\r\n- Waktu Proses Refill 1-2hari kerja', 100, 5000, 133000, 128250, 'Aktif', 1777, 'MEDANPEDIA'),
(4554, 1778, 'Instagram Followers Indonesia Guaranted/Refill', 'Instagram Followers Indonesia Guaranted 4 [ REAL ] [ Refill 30 days ] ', 'bisa berkali2 refill setiap memenuhi ketentuan refill bisa terus sajte 30 hari\r\nDilarang private/ganti username/batas usia maka refill Hangus\r\n- Garansi 30 hari apabila drop lebih dari 15%\r\n- Waktu Proses Refill 1-2hari kerja', 100, 5000, 154000, 148500, 'Aktif', 1778, 'MEDANPEDIA'),
(4555, 1779, 'Instagram Followers Indonesia Guaranted/Refill', 'KHUSUS REFILL LAYANAN Instagram Followers Indonesia Guaranted', 'bukan untuk di order\r\nmasukin username yg mau di refill jangan id order!!', 1, 1, 0, 0, 'Aktif', 1779, 'MEDANPEDIA'),
(4556, 1780, 'Followers Shopee/Tokopedia/Bukalapak', 'Shopee Followers Server 4 [2K] DB NEW ', 'gunakan username\r\n', 500, 2000, 32200, 31050, 'Aktif', 1780, 'MEDANPEDIA'),
(4557, 1783, 'Youtube Views', 'Youtube Views JT 10 [ Liftime refill ] cheap', 'mulai 0-12 jam', 500, 10000000, 28700, 27675, 'Aktif', 1783, 'MEDANPEDIA'),
(4558, 1784, 'Instagram Followers [guaranteed]', 'Instagram Followers Refill S13 [ HQ ] [ Lifetime refill ]', 'Kadang delay\r\nmulai proses 0-3 jam\r\n\r\nJika Drop:\r\n- Jika pengikut turun dari kami, kami akan mengisi ulang.\r\n- Kami tidak akan refill jika akun Anda memiliki lebih dari 100k + Pengikut (Tidak masalah jika pengikut turun dari kami atau tidak).\r\n- Jika pesanan Anda saat ini dihitung kurang dari jumlah awal - Tidak bisa refill\r\n- Jika Anda mengubah username/private akun Anda - Tidak bisa refill\r\n- Jika drop dari kami, kami akan membutuhkan waktu max 2-4 hari untuk mulai refill.', 10, 150000, 37800, 36450, 'Aktif', 1784, 'MEDANPEDIA'),
(4559, 1785, 'Instagram Views', 'instagram view JT 4 [ Recommended ]⚡', ' 1 Million/ Hour\r\nStart 0-10 minutes', 100, 10000000, 420, 405, 'Aktif', 1785, 'MEDANPEDIA'),
(4560, 1788, 'Instagram Likes', 'Instagram Likes JT 25 [ Lifetime refill ] Real', 'jika delay bisa request canceled\r\nproses mulai  0-2jam', 50, 10000, 35000, 33750, 'Aktif', 1788, 'MEDANPEDIA'),
(4561, 1789, 'Instagram Likes', 'Instagram Likes JT 26 [ No drop ] Real ', 'High Quality\r\nNo drop, jika drop mungkin hanya 10% buat sekarang', 100, 15000, 16800, 16200, 'Aktif', 1789, 'MEDANPEDIA'),
(4562, 1791, 'Youtube Views', 'Youtube Views JT 11 [ norefill ] cheapest', 'no garansi \r\nno kojtline\r\nkemungkinan waktu mulai 0-24jam', 500, 100000000, 13160, 12690, 'Aktif', 1791, 'MEDANPEDIA'),
(4563, 1792, 'Facebook Page / Website - Likes / Stars', 'Facebook Page Followers Server 1 [Low Quality] NO REFILL', ' INSTANT START\r\n1K PER DAY\r\nNO REFILL', 20, 2000, 37800, 36450, 'Aktif', 1792, 'MEDANPEDIA'),
(4564, 1793, 'Facebook Page / Website - Likes / Stars', 'Facebook Page Followers Server 2 [30 days refill] ', 'waktu mulai 0-6 jam\r\n ', 100, 25000, 96600, 93150, 'Aktif', 1793, 'MEDANPEDIA'),
(4565, 1794, 'Youtube Views', 'Youtube Views JT 12 [ Lifetime refill ] 10k/days', '✔ Monetizable views\r\n✔ Like,dislike,subs can get\r\n✔ Kualitas Terbaik\r\n✔ 100% Lalu Lintas Unik\r\n✔ Non drop atau less drop sejauh ini\r\n✔ 100% Pemirsa YouTube Real\r\n✔ Sumber: Fitur Eksternal dan Youtube\r\n✔ Retensi: Acak 0-1 Menit\r\n\r\nNote:\r\n- Kami mengirim pesanan ke sistem kami segera tetapi kami memiliki batas harian. Dianjurkan untuk memesan menurut dia.\r\n- Setelah Mengirimkan pesanan, Mohon jangan meminta Pembatalan.\r\n\r\n\r\nPesanan tidak akan dapat dicancel atau partial, jika video dihapus oleh YouTube atau dihapus oleh pemilik atau dalam kasus apa pun.\r\n Pesanan tidak dapat dicancel atau partial, jika video disetel ke pribadi..', 1000, 10000000, 44800, 43200, 'Aktif', 1794, 'MEDANPEDIA'),
(4566, 1796, 'Instagram Followers [ No Refill ]', 'Instagram Followers S7 [REAL ] INSTAN', 'real 70%\r\nDrop kemungkinan 20%\r\njika drop banyak tetap no refill\r\nbisa aja drop kapan aja tetap no kojtline', 20, 5000, 17500, 16875, 'Aktif', 1796, 'MEDANPEDIA'),
(4567, 1797, 'Instagram Followers [ No Refill ]', 'Instagram Followers S8 [ Cheapest ] ', 'mulai 0-24 jam\r\nHIGH DROP', 10, 10000, 8960, 8640, 'Aktif', 1797, 'MEDANPEDIA'),
(4568, 1799, 'Youtube Likes / Dislikes / Shares / Comment', 'Youtube Dislikes JT 3 Cheapest [ 30days refill ]', 'waktu mulai 0-6 jam\r\ninstan', 10, 20000, 126000, 121500, 'Aktif', 1799, 'MEDANPEDIA'),
(4569, 1800, '- PROMO - ON OFF', 'Instagram Likes PROMO 1 [ Fast ][ REAL Likes ]', 'KAPAN AJA BISA OFF JANGAN KOJTLINE\r\nMURAHHHHH', 50, 5000, 10500, 10125, 'Aktif', 1800, 'MEDANPEDIA'),
(4570, 1803, '- PROMO - ON OFF', 'Instagram Followers PROMO 2 [ Real ][ ada indo nya sedikit ] [ Fastest ]', 'KAPAN AJA BISA OFF JANGAN KOJTLINE \r\nMURAHHHHH\r\nBagus\r\n\r\n', 100, 4000, 19600, 18900, 'Aktif', 1803, 'MEDANPEDIA'),
(4571, 1804, '- PROMO - ON OFF', 'Tiktok  Views PROMO 1 [ MURAH WORK ]', 'KAPAN AJA BISA OFF JANGAN KOJTLINE \r\nMURAHHHHH\r\n', 1000, 1000000000, 22.4, 21.6, 'Aktif', 1804, 'MEDANPEDIA'),
(4572, 1806, 'Youtube Views', 'Youtube Views JT 13 Good for Ranking [ lifetime refill ]', 'Instant\r\n50k-100k/day\r\nRetention - 0-2 minute\r\nJika status partial reffill tidak berfungsi jika drop\r\n', 1000, 10000000, 47600, 45900, 'Aktif', 1806, 'MEDANPEDIA'),
(4573, 1807, 'Instagram Likes', 'Instagram Likes JT 27 [10K] cheap', 'no garansi\r\nspeed 300/jam\r\nmulai 0-2 jam', 10, 10000, 7280, 7020, 'Aktif', 1807, 'MEDANPEDIA'),
(4574, 1808, '- PROMO - ON OFF', 'Instagram Followers PROMO 3 [ BIG DROPS - BOT ] ', 'KAPAN AJA BISA OFF \r\nJANGAN KOJTLINE \r\nMURAHHHHH\r\nNO REFILL', 10, 10000, 3920, 3780, 'Aktif', 1808, 'MEDANPEDIA'),
(4575, 1810, 'Instagram Likes', 'Instagram Likes JT 28 [ Fast ] cheapeast', 'No refill\r\n', 20, 10000, 6020, 5805, 'Aktif', 1810, 'MEDANPEDIA'),
(4576, 1811, 'Twitter Views & Impressions', 'Twitter Views Server 3 [ FAST - Max 1M ] ', '100k-200k/hour', 100, 10000000, 2800, 2700, 'Aktif', 1811, 'MEDANPEDIA'),
(4577, 1812, 'Instagram Followers [ No Refill ]', 'Instagram Followers S12 [ SUPER FAST ] [ No Refill ] ', 'FAST\r\nINSTAN \r\nbuat sekarang', 10, 10000, 4550, 4387.5, 'Aktif', 1812, 'MEDANPEDIA'),
(4578, 1813, 'Instagram Followers [ No Refill ]', 'Instagram Followers S13 [ SUPER FAST ] [ No Refill ] ', 'waktu mulai 0-1 jam', 100, 10000, 5180, 4995, 'Aktif', 1813, 'MEDANPEDIA'),
(4579, 1814, 'Instagram Followers [guaranteed]', 'Instagram Followers Refill S14 [ Auto Refill  30 Days ]', 'Auto Refill 30 days\r\n', 20, 70000, 48300, 46575, 'Aktif', 1814, 'MEDANPEDIA'),
(4580, 1815, 'Youtube View Jam Tayang', 'Youtube Views [ Jam Tayang CLEAR 7 HARI ] [ Durasi Video 1 jam+ ] [ cek Deskripsi ] ', 'jumlah pesan = jam tayang yang kamu dapat\r\n\r\n- Eksklusif di JETPEDIA\r\n- Silakan memesan 4000 tajtilan untuk mendapatkan waktu menonton 4kh\r\n- SIAP DALAM 7 HARI 4 JAM\r\n- Garansi: refill 30 Hari\r\n\r\n\r\nCATATAN :\r\n- Harap cantumkan video yang memiliki panjang hanya 1 jam + (Jika tidak sajtai 1 jam , pesanan masih berjalan tetapi waktu menonton tidak akan cukup, kami tidak dapat melakukan refill / reffund Dana / canceled / Partial dalam kasus ini)\r\n- Jika view lama Anda turun di bawah jumlah mulai, maka kami tidak dapat Refill / Refund / Cancel / Membatalkan sebagian. ( lebih baik menggunakan video dengan view yg sedikit/baru )\r\n- Silakan gunakan video tanpa tajtilan interleaving alami (Jika Anda secara bersamaan mendapatkan view alami (ditonton orang lain selain sistem kami ) saat menjalankan waktu jam tayang, Anda tidak akan mendapatkan cukup waktu jam tayang.)\r\n- Jika video Dihapus, Ditolak, Privat sementara kami menambahkan waktu tontonan atau setelah selesai, maka kami tidak dapat refill / reffund Dana / canceled / Partial.\r\n- Lebih baik pls video yang tidak publik saat menjalankan waktu jam tayang.\r\ntidak dipublic bukan berarti di private maksudnya itu video tidak ada muncul di channel mu tapi masih bisa diakses melalui url atau link', 100, 4000, 168000, 162000, 'Aktif', 1815, 'MEDANPEDIA'),
(4581, 1816, 'Youtube Subscribers', 'Youtube Subscribe SERVER 3 Best Monetization ', '30 Days Refill\r\nSpeed:200-300/day\r\nHigh Quality subs - Helps for Monetization Approval\r\nMax 50k [ Can order 25 times - 2K ]', 5, 2000, 539000, 519750, 'Aktif', 1816, 'MEDANPEDIA'),
(4582, 1817, 'Youtube Subscribers', 'Youtube Subscribe SERVER 4 [ cek deskripsi ]', '- Waktu mulai: 0 - 1 Jam\r\n- Kecepatan 1k + / D\r\n- Garansi: refill 30 hari jika drop lebih dari 10%\r\n- Just refill , No refund .\r\n\r\n- Server ini bekerja secara otomatis, Tolong jangan mengeluh apa pun, bahkan server Tidak berfungsi. Saya tidak akan menyelesaikannya.\r\n- Server ini cepat tetapi BURUK, pesanan selesai tetapi pengiriman mungkin tidak cukup.\r\n- Server ini mengalami drop dan jika masalah drop, Pls klik tombol isi ulang.\r\n- Jika Anda sudah menggunakan server ini: Tolong jangan kojtlain kami tentang isi ulang Tidak berfungsi, server perlu 12 - 120 jam untuk isi ulang selesai dan setelah isi ulang, Subs bisa turun lagi dan Anda bisa lapor ulang lagi ... semua bekerja otomatis.', 50, 5000, 210000, 202500, 'Aktif', 1817, 'MEDANPEDIA'),
(4583, 1822, 'Youtube Subscribers', 'Youtube Subscribe SERVER 5 Real USA', '30-50days \r\nguaranted 30days\r\n', 5, 1500, 470400, 453600, 'Aktif', 1822, 'MEDANPEDIA'),
(4584, 1823, 'Instagram Views', 'instagram view JT 5 [ CHEAPEST ] FAST  ', 'INSTANT', 100, 10000000, 280, 270, 'Aktif', 1823, 'MEDANPEDIA'),
(4585, 1824, 'Followers Shopee/Tokopedia/Bukalapak', 'Shopee Likes Feed Server 1 NEW [15K] ', 'Masukkan link feed shopee\r\nGk ada kata reffund jika double order\r\ntunggu pesanan sebelumnya selesai/sukses baru order lagi\r\n\r\nBISA SAJTAI 15K', 100, 10000, 10500, 10125, 'Aktif', 1824, 'MEDANPEDIA'),
(4586, 1825, 'Instagram Likes', 'Instagram Likes JT 29 [ Real ] cheapeast ', 'No garansi\r\nfast', 100, 5000, 9520, 9180, 'Aktif', 1825, 'MEDANPEDIA'),
(4587, 1826, 'Instagram Story Views', 'Instagram - Story Views S5 [ All Story Views ] WORK', 'fast', 100, 50000, 1610, 1552.5, 'Aktif', 1826, 'MEDANPEDIA'),
(4588, 1827, 'Instagram Story / Impressions / Saves / Profile Vi', 'Instagram POST Ijtressions S1', 'Cheapest\r\nINSTANT', 100, 10000000, 420, 405, 'Aktif', 1827, 'MEDANPEDIA'),
(4589, 1828, 'Instagram Story / Impressions / Saves / Profile Vi', 'Instagram Ijtressions  + Reach Max 25k INSTAN', 'Real HQ\r\nfast', 50, 250000, 490, 472.5, 'Aktif', 1828, 'MEDANPEDIA'),
(4590, 1832, 'Youtube Likes / Dislikes / Shares / Comment', 'Youtube Video Custom Comments JT 1 Cheapest ', 'Cheapest\r\nmulai proses 0-24jam', 10, 5000, 163800, 157950, 'Aktif', 1832, 'MEDANPEDIA'),
(4591, 1833, 'Instagram Followers [guaranteed]', 'Instagram Followers Refill S15 [ Refill 99 Days ] ', '1K-2K/day', 10, 500000, 34720, 33480, 'Aktif', 1833, 'MEDANPEDIA'),
(4592, 1834, 'Youtube View Target Negara', 'Youtube  GEO  views Lifetime Refill [ Indonesia ][ Recommended ]', '- Mulai Instan atau 0-12H\r\n- Kecepatan 10K - 200k / D\r\n- Sangat Direkomendasikan - Tidak Pernah Stuck Order!\r\n- Cocok untuk Semua Panjang Video\r\n- Tajtilan Peringkat Bertarget Murni Terbaik !!! Ditambah Tajtilan REAL Aktif Sumber Stabil !!\r\n- Tajtilan dapat mencakup Keterlibatan Pengguna NYATA!\r\n\r\n⭐⭐⭐ CATATAN:\r\n- Izinkan penyematan dan pastikan video Anda benar-benar tidak dibatasi, untuk menggunakan layanan ini. Untuk mendapatkan isi ulang, harap tetap nonaktifkan monetisasi sajtai pesanan Anda benar-benar diisi ulang dan jangan gabungkan pandangan kami dengan penyedia lain (sebenarnya, jangan mendorong penayangan pihak ketiga ke video 7 hari sebelum dan setelah menerima penayangan kami ).\r\n- Tidak Dapat Membatalkan Atau Mengembalikan Dana Setelah Memulai Pesanan Dengan Alasan Apa Pun !!', 1000, 1000000000, 57400, 55350, 'Aktif', 1834, 'MEDANPEDIA'),
(4593, 1835, 'Youtube View Target Negara', 'Youtube views No Refill [ Indonesia ] ', 'mulai 0-24jam\r\n10K/Day', 1000, 1000000, 31500, 30375, 'Aktif', 1835, 'MEDANPEDIA'),
(4594, 1836, 'Instagram Comments', 'Instagram 5 Comments random [ dari Akun dengan followers 10k + ]', 'instan\r\nmendapat 5 komentar', 1000, 1000, 44800, 43200, 'Aktif', 1836, 'MEDANPEDIA'),
(4595, 1837, 'Instagram Comments', 'Instagram Comments Costum [ dari Akun dengan followers 15k + ] [ Rp2.800 ]', 'Proses slow\r\nwaktu mulai 0-48jam', 1, 30, 3920000, 3780000, 'Aktif', 1837, 'MEDANPEDIA'),
(4596, 1838, 'Instagram Comments', 'Instagram Comments Costum [ dari Akun dengan followers 10k + ] [ Rp11.000 ] ', 'lebih fast dari id layanan 1837\r\n', 1, 10, 15400000, 14850000, 'Aktif', 1838, 'MEDANPEDIA'),
(4597, 1839, 'Instagram Comments', 'Instagram  Comments Custom [Account Verif/centang biru] [ Rp25.500 ] ', 'lambat\r\nnon drop', 1, 10, 35700000, 34425000, 'Aktif', 1839, 'MEDANPEDIA'),
(4598, 1840, 'Instagram Comments', 'Instagram  Comments Random [Account Verif/centang biru] [ Rp21.000 ] ', 'lambat\r\nnon drop', 1, 10, 29400000, 28350000, 'Aktif', 1840, 'MEDANPEDIA'),
(4599, 1841, 'Instagram Comments', 'Instagram 5 Comments random [ dari Akun dengan followers 1juta+ ] ', 'waktu mulai 0-24 jam\r\ndapat 5 komentar', 1000, 1000, 74200, 71550, 'Aktif', 1841, 'MEDANPEDIA'),
(4600, 1842, 'Instagram Followers [ No Refill ]', 'Instagram Followers S14 [ LESS DROP ] [ CHEAP ]', 'no garansi followers turun\r\nreal', 100, 1000, 11620, 11205, 'Aktif', 1842, 'MEDANPEDIA'),
(4601, 1843, 'Instagram Followers [ No Refill ]', 'Instagram Followers S15 [ LESS DROP ] [ REAL ] ', '75% real\r\nno garansi', 20, 5000, 15400, 14850, 'Aktif', 1843, 'MEDANPEDIA'),
(4602, 1844, 'Instagram Followers [ No Refill ]', 'Instagram Followers S16 [ 10K ] [ REAL ] ', 'START TIME 0-1H\r\n5K/DAY\r\nno garansi', 20, 10000, 21000, 20250, 'Aktif', 1844, 'MEDANPEDIA'),
(4603, 1845, '- PROMO - ON OFF', 'Instagram Followers PROMO 4 [ Superfast - BOT ] ', 'HIGH DROP\r\nFAST', 10, 10000, 2100, 2025, 'Aktif', 1845, 'MEDANPEDIA'),
(4604, 1847, 'Instagram Followers [ No Refill ]', 'Instagram Followers Server 1 [ No Refill] [ INSTANT ] ', 'INSTANT', 10, 15000, 6720, 6480, 'Aktif', 1847, 'MEDANPEDIA'),
(4605, 1848, 'Instagram Followers [ No Refill ]', 'Instagram Followers Server 2 [ No Refill] [ BOT ] ', 'INSTANT\r\nkadang sukses pesanan tidak full masuj\r\nno kojtline', 10, 10000, 6300, 6075, 'Aktif', 1848, 'MEDANPEDIA'),
(4606, 1849, '- PROMO - ON OFF', 'Instagram Followers PROMO 5 [ Superfast - BOT ] ', 'fast', 10, 15000, 5460, 5265, 'Aktif', 1849, 'MEDANPEDIA'),
(4607, 1850, 'Youtube Subscribers', 'Youtube Subscribe SERVER 6 [ 30 days guarantee ] ', 'Speed - 10-30/day\r\n30 Days guarantee\r\nDrop 5%', 10, 100000, 392000, 378000, 'Aktif', 1850, 'MEDANPEDIA'),
(4608, 1851, 'Instagram Followers [guaranteed]', 'Instagram Followers Refill S16 [ Refill 30Days ] [ REAL HQ ]', 'instan\r\nwaktu mulai 0-6 jam\r\n', 10, 20000, 39200, 37800, 'Aktif', 1851, 'MEDANPEDIA'),
(4609, 1852, 'Instagram Followers [ No Refill ]', 'Instagram Followers Server 3 [ No Refill] [ REAL HQ ]', 'Instant \r\n High Quality\r\n3k-5k/hari', 50, 5000, 10780, 10395, 'Aktif', 1852, 'MEDANPEDIA'),
(4610, 1853, 'TIK TOK View/share/comment', 'TIK TOK View S11 [ WORK AFTER UPDATE ] FAST', 'ULTRAFAST', 100, 10000000, 490, 472.5, 'Aktif', 1853, 'MEDANPEDIA'),
(4611, 1854, '- PROMO - ON OFF', 'Tiktok Views PROMO  [ MURAH WORK AFTER UPDATE ] FAST ', 'SUPER  FAST', 100, 10000000, 378, 364.5, 'Aktif', 1854, 'MEDANPEDIA'),
(4612, 1855, '- PROMO - ON OFF', 'Tiktok Views PROMO [ TERMURAH WORK AFTER UPDATE ] Superfast ', 'NO GARANSI', 1000, 1000000, 112, 108, 'Aktif', 1855, 'MEDANPEDIA'),
(4613, 1856, 'TIK TOK View/share/comment', 'TIK TOK View S12 [ WORK AFTER UPDATE ] Superfast ', 'Superfast\r\nno garansi', 1000, 1000000, 140, 135, 'Aktif', 1856, 'MEDANPEDIA'),
(4614, 1857, 'Twitter Views & Impressions', 'Twitter Ijtressions Server 2 [5M] ', 'fast', 100, 10000000, 6020, 5805, 'Aktif', 1857, 'MEDANPEDIA'),
(4615, 1862, 'Instagram Story Views', 'Instagram - Story Views S6 [ All Story Views ] INSTANT', 'Bot HQ\r\nINSTANT', 250, 5000, 1260, 1215, 'Aktif', 1862, 'MEDANPEDIA'),
(4616, 1863, 'Twitter Followers', 'Twitter Followers Server 4 [ refill 30Days ] [ Real ] ', 'waktu mulai 0-48 jam\r\n', 10, 20000, 77000, 74250, 'Aktif', 1863, 'MEDANPEDIA'),
(4617, 1864, 'Youtube Views', 'Youtube Views JT 14 CHEAP WORLD [ No refill ] ', 'Instant Start\r\njumlah view tidak bertambah waktu status sudah sukses\r\nsilahkan anda like dan tunggu beberapa menit\r\n', 500, 100000000, 11200, 10800, 'Aktif', 1864, 'MEDANPEDIA'),
(4618, 1865, 'Youtube Views', 'Youtube Views JT 15 CHEAP WORLD [ 30 Days refill ] ', 'Instant Start\r\nCatatan : Tidak bisa untuk Premiered video, Live stream video ', 100, 10000000, 27300, 26325, 'Aktif', 1865, 'MEDANPEDIA'),
(4619, 1866, 'Youtube View Jam Tayang', 'Youtube Views [ Jam Tayang CLEAR 2 HARI ] [ Durasi Video 1 jam+ ] [ cek Deskripsi ] ', 'jumlah pesan = jam tayang yang kamu dapat\r\n\r\n- Eksklusif di JETPEDIA\r\n- Silakan memesan 4000 tajtilan untuk mendapatkan waktu menonton 4kh\r\n- SIAP DALAM 2 HARI 4 JAM\r\n- Garansi: refill 30 Hari\r\n\r\ndo not remove or make video private after\r\n\r\nCATATAN :\r\n- Harap cantumkan video yang memiliki panjang hanya 1 jam + (Jika tidak sajtai 1 jam , pesanan masih berjalan tetapi waktu menonton tidak akan cukup, kami tidak dapat melakukan refill / reffund Dana / canceled / Partial dalam kasus ini)\r\n- Jika view lama Anda turun di bawah jumlah mulai, maka kami tidak dapat Refill / Refund / Cancel / Membatalkan sebagian. ( lebih baik menggunakan video dengan view yg sedikit/baru )\r\n- Silakan gunakan video tanpa tajtilan interleaving alami (Jika Anda secara bersamaan mendapatkan view alami (ditonton orang lain selain sistem kami ) saat menjalankan waktu jam tayang, Anda tidak akan mendapatkan cukup waktu jam tayang.)\r\n- Jika video Dihapus, Ditolak, Privat sementara kami menambahkan waktu tontonan atau setelah selesai, maka kami tidak dapat refill / reffund Dana / canceled / Partial.\r\n- Lebih baik pls video yang tidak publik saat menjalankan waktu jam tayang.\r\ntidak dipublic bukan berarti di private maksudnya itu video tidak ada muncul di channel mu tapi masih bisa diakses melalui url atau link', 1000, 4000, 280000, 270000, 'Aktif', 1866, 'MEDANPEDIA'),
(4620, 1867, 'Youtube Views', 'Youtube Views JT 16 [  Lifetime Guarantee ] NonDrop', 'Instant Start\r\nSpeed 20k-30k\r\nInstant Start\r\nVery Fast Views\r\nLifetime Guarantee', 1000, 30000, 32480, 31320, 'Aktif', 1867, 'MEDANPEDIA'),
(4621, 1868, 'Youtube Views', 'Youtube Views JT 17 [ Retention 2-5 minutes ] Lifetime ', 'slow\r\nbiasa masuk sekitar 300-450 perhari', 300, 100000, 22540, 21735, 'Aktif', 1868, 'MEDANPEDIA'),
(4622, 1869, 'Youtube Views', 'Youtube Views JT 18 [ 20K/D ] Lifetime refill', 'waktu mulai 0-3jam\r\n', 100, 10000000, 28000, 27000, 'Aktif', 1869, 'MEDANPEDIA'),
(4623, 1870, 'Twitter Views & Impressions', 'Twitter Views Server 4 [ SUPERFAST - Max 100M ] ', '1Juta/hour', 100, 100000000, 1820, 1755, 'Aktif', 1870, 'MEDANPEDIA'),
(4624, 1871, 'Instagram Likes', 'Instagram Likes JT 30 [ 30 days refill ] NONDROP', 'Instan\r\nReal \r\nnondrop \r\njika terjadi drop akan kami refill', 100, 100000, 9100, 8775, 'Aktif', 1871, 'MEDANPEDIA'),
(4625, 1872, 'Youtube Views', 'Youtube Views JT 19 [ 30 Days refill ] INSTANT', 'Instant Start\r\nCatatan : Tidak bisa untuk Premiered video, Live stream video ', 100, 20000000, 32900, 31725, 'Aktif', 1872, 'MEDANPEDIA'),
(4626, 1873, 'TIK TOK Followers', 'TIK TOK FOLLOWERS Server 13 [ 30 Days Refil ] ', 'waktu mulai  0-12 jam\r\nbahkan bisa lebih karna tiktok blm stabil\r\n30 Days Refill ', 100, 50000, 53200, 51300, 'Aktif', 1873, 'MEDANPEDIA'),
(4627, 1874, 'TIK TOK Followers', 'TIK TOK FOLLOWERS Server 14 [ 30 Days Refil ] HQ', 'HQ\r\nNon Drop\r\nwaktu mulai 0-40 jam\r\n', 20, 5000, 53200, 51300, 'Aktif', 1874, 'MEDANPEDIA'),
(5041, 1191, 'Facebook - Post Likes', 'Facebook Photo / Post Likes | Lifetime Refill - Max 1M - 10K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 10K/Day\r\nQuality: Real\r\nRefill: Lifetime\r\nLink: Facebook Post/Photo Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 1000000, 8400, 8100, 'Aktif', 1191, 'BEARPEDIA'),
(5042, 1190, 'Instagram - Reels', 'Instagram Reels Likes | No Refill - Max 100K - 50K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 50K/Day\r\nRefill: No\r\nLink: Instagram Reels Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 10, 100000, 2800, 2700, 'Aktif', 1190, 'BEARPEDIA'),
(5043, 1189, 'Instagram - Story Views', 'Instagram Story Views | No Refill - Last Story - Max 30K - 30K/Day', 'Views On The Last Story Posted ONLY !\r\nUsername Only', 20, 30000, 2800, 2700, 'Aktif', 1189, 'BEARPEDIA'),
(5044, 1188, 'Instagram - Story Views', 'Instagram Story Views | No Refill - Max 30K - 30K/Day', '0 - 1 hours\r\nUsername Only', 250, 30000, 2380, 2295, 'Aktif', 1188, 'BEARPEDIA'),
(5045, 1187, 'Instagram - Views', 'Instagram Views [ Video + IGTV + Reel ] - Max 10M - 100K/Day', '[ Layanan Beta ]\r\nStart time: 0 - 24 hours\r\nSpeed: 100K/Day\r\nRefill: No\r\nLink: Instagram Video, IGTV, Reels Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 1000, 10000000, 23.8, 22.95, 'Aktif', 1187, 'BEARPEDIA'),
(5046, 1186, 'Facebook - Video Views [ Monetization ]', 'Facebook Video Views [600K Minutes Package] - Monetization - Cojtlete Time 48 Hours', 'Durasi video harus 3jam 1 menit+', 1000, 1000, 210000, 202500, 'Aktif', 1186, 'BEARPEDIA'),
(5047, 1185, 'Facebook - Group Members', 'Facebook Group Members | Refill 30Day - Max 1M - 1K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 1K/Day\r\nRefill: 30 hari\r\nLink: Facebook Group Link\r\n \r\nNote\r\n- Pada bagian admin support, biarkan default seperti aslinya.\r\n- Di bagian pengaturan grup, minta nonaktifkan persetujuan peserta untuk bergabung dengan grup.', 1000, 1000000, 25900, 24975, 'Aktif', 1185, 'BEARPEDIA'),
(5048, 1184, 'Instagram - Likes [ No Refill ]', 'Instagram Likes + Reach + Ijtreasions | No Refill - Max 130K - 70K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 70K/Day\r\nQuality: Real + HQ\r\nRefill: No\r\nLink: Instagram Post Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 130000, 1187.2, 1144.8, 'Aktif', 1184, 'BEARPEDIA'),
(5049, 1183, 'Instagram - Likes [ No Refill ]', 'Instagram Likes + Reach + Ijtreasions | No Refill - Max 50K - 10K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 10K/Day\r\nQuality: Real\r\nRefill: No\r\nLink: Instagram Post Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 10, 50000, 2380, 2295, 'Aktif', 1183, 'BEARPEDIA'),
(5050, 1182, 'Instagram - Likes [ No Refill ]', 'Instagram Likes | No Refill - Max 300K - 50K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 50K/Day\r\nRefill: No\r\nLink: Instagram Post, Video Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 15, 300000, 921.2, 888.3, 'Aktif', 1182, 'BEARPEDIA'),
(5051, 1181, 'Instagram - Likes [ No Refill ]', 'Instagram Likes | No Refill - Cheapest - HQ - Max 250K - 100K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 100K/Day\r\nQuality: HQ\r\nRefill: No\r\nLink: Instagram Post Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 50, 250000, 932.4, 899.1, 'Aktif', 1181, 'BEARPEDIA'),
(5052, 1180, 'Instagram - Likes [ No Refill ]', 'Instagram Likes | No Refill - Non Drop - Max 100K - 40K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 40K/Day\r\nDrop rate: Non Drop ( No Garansi )\r\nRefill: No\r\nLink: Instagram Post Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 10, 100000, 1540, 1485, 'Aktif', 1180, 'BEARPEDIA'),
(5053, 1179, 'Instagram - Likes [ No Refill ]', 'Instagram Likes | No Refill - Real - Max 45K - 20K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 20K/Day\r\nQuality: Real\r\nRefill: No\r\nLink: Instagram Post Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 45000, 441, 425.25, 'Aktif', 1179, 'BEARPEDIA'),
(5054, 1178, 'Instagram - Likes [ No Refill ]', 'Instagram Likes | No Refill - Max 80K - 10K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 10K/Day\r\nRefill: No\r\nLink: Instagram Post Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 30, 80000, 392, 378, 'Aktif', 1178, 'BEARPEDIA'),
(5055, 1177, 'Instagram - Followers [ No Guaranteed / No Refill ', 'Instagram Followers | No Refill - Max 5K - 1K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 1K/Day\r\nRefill: No refill / no refund\r\nLink: Instagram username tanpa \" @ \"\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan kojtlain setelah memesan layanan ini', 20, 5000, 1372, 1323, 'Aktif', 1177, 'BEARPEDIA'),
(5056, 1176, 'Instagram - Followers [ No Guaranteed / No Refill ', 'Instagram Followers | No Refill - Real - HQ - Max 250K - 10K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 10K/Day\r\nQuality: Real + HQ\r\nRefill: No refill / no refund\r\nLink: Instagram username tanpa \" @ \"\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 250000, 5180, 4995, 'Aktif', 1176, 'BEARPEDIA'),
(5057, 1175, 'Instagram - Followers [ No Guaranteed / No Refill ', 'Instagram Followers | No Refill - Max 100K - 10K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 10K/Day\r\nRefill: No refill / no refund\r\nLink: Instagram username tanpa \" @ \"\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 10, 100000, 4200, 4050, 'Aktif', 1175, 'BEARPEDIA'),
(5058, 1174, 'Instagram - Followers [ No Guaranteed / No Refill ', 'Instagram Followers | No Refill - Bots - LQ - Max 10K - 10K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 10K/Day\r\nQuality: Bots + LQ\r\nRefill: No refill / no refund\r\nLink: Instagram username tanpa \" @ \"\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 10000, 1960, 1890, 'Aktif', 1174, 'BEARPEDIA'),
(5059, 1173, 'Z[+Private]', 'Facebook Fanspage Likes | Refill 30Day - Max 1M - 3K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 3K/Day\r\nRefill: 30 hari\r\nLink: Facebook Fanspage Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 1000000, 11200, 10800, 'Aktif', 1173, 'BEARPEDIA'),
(5060, 1172, 'Z[+Private]', 'Facebook Fanspage Likes + Followers | Lifetime Refill - Max 50K - 3K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 3K/Day\r\nRefill: Lifetime\r\nLink: Facebook Fanspage Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 50000, 15722, 15160.5, 'Aktif', 1172, 'BEARPEDIA'),
(5061, 1171, 'Z[+Private]', 'TikTok Views | No Refill - Max 1M - 1M/Day', 'Start time: 0 - 24 hours\r\nSpeed: 1M/Day\r\nRefill: No\r\nLink: TikTok Video Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 500, 1100000, 51.8, 49.95, 'Aktif', 1171, 'BEARPEDIA'),
(5062, 1170, 'TikTok - Likes Indonesia', 'TikTok Likes Indonesia | Refill 30Day - Max 60K - 20K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 20K/Day\r\nRefill: 30 hari\r\nLink: TikTok Video Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 60000, 15990.8, 15419.7, 'Aktif', 1170, 'BEARPEDIA'),
(5063, 1169, 'Instagram - Followers [ Guaranteed 90-365 Days ]', 'Instagram Followers | Refill 120Day - Real Looking - Max 500K - 5K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 5K/Day\r\nQuality: Real Looking\r\nRefill: 120 hari\r\nLink: Instagram username tanpa \" @ \"\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 15, 500000, 11200, 10800, 'Aktif', 1169, 'BEARPEDIA'),
(5064, 1168, 'Instagram - Followers [ Guaranteed 90-365 Days ]', 'Instagram Followers | Refill 1 Year - Stable - Max 5M - 100K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 100K/Day\r\nQuality: High Quality / Stable\r\nRefill: 1 Tahun\r\nLink: Instagram username tanpa \" @ \"\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 50, 50000000, 10500, 10125, 'Aktif', 1168, 'BEARPEDIA'),
(5065, 1167, 'Instagram - Followers [ Guaranteed 90-365 Days ]', 'Instagram Followers | Refill 99Day - Real - Low Drop - Max 1M - 50K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 50K/Day\r\nQuality: Real\r\nDrop rate: Low Drop\r\nRefill: 99 hari\r\nLink: Instagram username tanpa \" @ \"\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 10, 1000000, 5600, 5400, 'Aktif', 1167, 'BEARPEDIA'),
(5066, 1166, 'Instagram - Followers [ Guaranteed 90-365 Days ]', 'Instagram Followers | Refill 365Day - Real - Low Drop - Max 10M - 300K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 100K - 300K/Day\r\nQuality: Real\r\nDrop rate: Low Drop\r\nRefill: 365 hari\r\nLink: Instagram username tanpa \" @ \"\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 10000000, 4900, 4725, 'Aktif', 1166, 'BEARPEDIA'),
(5067, 1165, 'Instagram - Followers [ Guaranteed 45-60 Days ]', 'Instagram Followers | Refill 45Day - Max 1M - 20K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 20K/Day\r\nRefill: 45 hari\r\nLink: Instagram username tanpa \" @ \"\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 1000000, 5023.2, 4843.8, 'Aktif', 1165, 'BEARPEDIA'),
(5068, 1164, 'Instagram - Followers [ Guaranteed 45-60 Days ]', 'Instagram Followers | Refill 60Day - Mix - Max 500K - 1-5K/Hours', 'Start time: 0 - 24 hours\r\nSpeed: 1K - 5K/Hours\r\nQuality: Mix\r\nRefill: 60 hari\r\nLink: Instagram username tanpa \" @ \"\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 25, 500000, 6797, 6554.25, 'Aktif', 1164, 'BEARPEDIA'),
(5069, 1163, 'Instagram - Followers [ Guaranteed 45-60 Days ]', 'Instagram Followers | Refill 60Day - Max 300K - 10K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 10K/Day\r\nRefill: 60 hari\r\nLink: Instagram username tanpa \" @ \"\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 50, 100000, 5180, 4995, 'Aktif', 1163, 'BEARPEDIA'),
(5070, 1162, 'Instagram - Followers [ Guaranteed Lifetime ]', 'Instagram Followers | Lifetime Refill - Real - Max 2M - 50K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 20K - 50K/Day\r\nQuality: Real\r\nRefill: Lifetime\r\nLink: Instagram username tanpa \" @ \"\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 50, 2000000, 20720, 19980, 'Aktif', 1162, 'BEARPEDIA'),
(5071, 1161, 'Instagram - Followers [ Guaranteed 45-60 Days ]', 'Instagram Followers | Refill 45Day - Low Drop - Max 10K - 2K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 2K/Day\r\nDrop rate: Low Drop\r\nRefill: 45 hari\r\nLink: Instagram username tanpa \" @ \"\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 50, 10000, 23034.2, 22211.55, 'Aktif', 1161, 'BEARPEDIA'),
(5072, 1160, 'Instagram - Followers [ Guaranteed 45-60 Days ]', 'Instagram Followers | Refill 60Day - Real - Max 1M - 50K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 50K/Day\r\nQuality: Real\r\nRefill: 60 hari\r\nLink: Instagram username tanpa \" @ \"\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 10, 1000000, 8537.2, 8232.3, 'Aktif', 1160, 'BEARPEDIA'),
(5073, 1159, 'Instagram - Followers [ Guaranteed 45-60 Days ]', 'Instagram Followers | Refill 60Day - HQ - Less Drop - Max 200K - 5-10K/Day ', 'Start time: 0 - 24 hours\r\nSpeed: 5K - 10K/Day\r\nQuality: HQ\r\nDrop rate: Less Drop\r\nRefill: 60 hari\r\nLink: Instagram username tanpa \" @ \"\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 200000, 15400, 14850, 'Aktif', 1159, 'BEARPEDIA'),
(5074, 1158, 'Instagram - Followers [ Guaranteed 45-60 Days ]', 'Instagram Followers | Refill 60Day - Best Quality - Max 20K - 5K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 5K/Day\r\nQuality: Best Quality (Account with at least 15 posts)\r\nRefill: 60 hari\r\nLink: Instagram username tanpa \" @ \"\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 10, 20000, 23800, 22950, 'Aktif', 1158, 'BEARPEDIA'),
(5075, 1157, 'Instagram - Followers [ Guaranteed 15-30 Days ]', 'Instagram Followers | Refill 15Day - Max 5K - 5K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 5K/Day\r\nRefill: 15 hari ( hanya 1× isi ulang )\r\nLink: Instagram username tanpa \" @ \"\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 20, 10000, 2380, 2295, 'Aktif', 1157, 'BEARPEDIA'),
(5076, 1156, 'Instagram - Followers [ Guaranteed 15-30 Days ]', 'Instagram Followers | Refill 30Day - Less Drop - Max 1M - 30K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 30K/Day\r\nDrop rate: Less Drop\r\nRefill: 30 hari\r\nLink: Instagram username tanpa \" @ \"\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 1000000, 18200, 17550, 'Aktif', 1156, 'BEARPEDIA'),
(5077, 1155, 'Instagram - Followers [ Guaranteed 15-30 Days ]', 'Instagram Followers | Refill 30Day - Real - HQ - Max 300K - 25K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 5K - 25K/Day\r\nQuality: Real + HQ\r\nRefill: 30 hari\r\nLink: Instagram username tanpa \" @ \"\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 300000, 6020, 5805, 'Aktif', 1155, 'BEARPEDIA'),
(5078, 1154, 'Instagram - Followers [ Guaranteed 15-30 Days ]', 'Instagram Followers | Refill 30Day - Real+Bots - Max 200K - 10K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 10K/Day\r\nQuality: Real + Bots\r\nRefill: 30 hari\r\nLink: Instagram username tanpa \" @ \"\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 50, 200000, 14000, 13500, 'Aktif', 1154, 'BEARPEDIA'),
(5079, 1153, 'Instagram - Followers [ Guaranteed 15-30 Days ]', 'Instagram Followers | AutoRefill 30Day - Mixed - Max 200K - 6K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 6k+/Day\r\nQuality: Mix\r\nRefill: AutoRefill 30 hari\r\nLink: Instagram username tanpa \" @ \"\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 200, 200000, 21000, 20250, 'Aktif', 1153, 'BEARPEDIA'),
(5080, 1152, 'Instagram - Followers [ Guaranteed 15-30 Days ]', 'Instagram Followers | Refill 30Day - Real - Live People - Max 50K - 20K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 20K/Day\r\nQuality: Real users with avatars, posts, and stories \r\nRefill: 30 hari\r\nLink: Instagram username tanpa \" @ \"\r\n\r\n✔️ Bisa aktif (berikan suka, tonton cerita, tulis komentar)\r\n✔️ Semua profil dengan avatar, kebanyakan dengan publikasi\r\n✔️ Karena ini adalah orang sungguhan, mungkin ada balasan alami.', 100, 50000, 7000, 6750, 'Aktif', 1152, 'BEARPEDIA'),
(5081, 1151, 'Instagram - Followers [ Guaranteed 15-30 Days ]', 'Instagram Followers | Refill 30Day - New HQ - Max 500K - 80K/Day', 'Start time: 0 - 24 hours\r\nSpeed: Up To 80K/Day\r\nQuality: HQ\r\nRefill: 30 hari\r\nLink: Instagram username tanpa \" @ \"\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 10, 500000, 5180, 4995, 'Aktif', 1151, 'BEARPEDIA'),
(5082, 1150, 'YouTube - ADS Views [ Via Google Adwords ]', 'YouTube Ads Views | Lifetime Refill - Never Drop - Max 10M - 20K/Day', 'Start time: 24 - 48 hours\r\nSpeed: 10K - 20K/Day\r\nQuality: Real Ads Views\r\nRefill: Lifetime\r\nLink: YouTube Video Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada channel publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 1000, 10000000, 67200, 64800, 'Aktif', 1150, 'BEARPEDIA'),
(5083, 1149, 'Youtube - Subscribers', 'Youtube Subscribers | Refill 30Day - Non Drop - Max 50K - 75+/Day', 'Channel harus memiliki setidaknya 1-2 video, Don\'t use link channel have : /c/\r\n\r\nStart time: 0 - 72 hours\r\nSpeed: 20 - 75/Day\r\nRefill: 30hari\r\nLink: Youtube Channel Link\r\n\r\n✔️ Layanan ini hanya berfungsi pada channel publik\r\n✔️ Garansi akan dicabut jika jumlah subscriber di-private \r\n️✔️ Garansi akan dicabut jika jumlah awal pesanan turun terus-menerus', 50, 50000, 182000, 175500, 'Aktif', 1149, 'BEARPEDIA'),
(5084, 1148, 'Youtube - Subscribers', 'Youtube Subscribers | No Refill - Max 200K - 15K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 15K/Day\r\nDrop rate: 50 - 100%\r\nRefill: No refill / no refund\r\nLink: YouTube Channel Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada channel publik\r\n- Tidak ada pengembalian dana / tidak ada garansi apapun\r\n- Jangan kojtlain setelah memesan layanan ini', 100, 200000, 8120, 7830, 'Aktif', 1148, 'BEARPEDIA'),
(5085, 1146, 'YouTube - Views [ No Refill ]', 'YouTube Views | No Refill - Max 5K - 1K/Day [Bots]', '[ Very Cheap Services may face delays or full drop ]\r\nStart time: 0 - 24 hours\r\nSpeed: 1K/Day\r\nRefill: No refill / no refund\r\nLink: YouTube Video Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada channel publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan kojtlain setelah memesan layanan ini', 50, 5000, 4743.2, 4573.8, 'Aktif', 1146, 'BEARPEDIA'),
(5086, 1145, 'YouTube - Views [ No Refill ]', 'YouTube Views | No Refill - Max 50K - 10K/Day [Bots]', '[ Very Cheap Services may face delays or full drop ]\r\nStart time: 0 - 24 hours\r\nSpeed: 10K/Day\r\nRefill: No refill / no refund\r\nLink: YouTube Video Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada channel publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan kojtlain setelah memesan layanan ini', 100, 50000, 5458.6, 5263.65, 'Aktif', 1145, 'BEARPEDIA'),
(5087, 1144, 'YouTube - Views [ No Refill ]', 'YouTube Views | No Refill - Max 10K - 5K/Day [Bots]', '[ Very Cheap Services may face delays or full drop ]\r\nStart time: 1 - 24 hours\r\nSpeed: 5K/Day\r\nRefill: No refill / no refund\r\nLink: YouTube Video Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada channel publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan kojtlain setelah memesan layanan ini', 100, 10000, 5180, 4995, 'Aktif', 1144, 'BEARPEDIA'),
(5088, 1143, 'TikTok - Likes', 'TikTok Likes | No Refill - Max 1M - 50K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 50K/Day\r\nRefill: No\r\nLink: TikTok Video Link\r\n \r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 1000000, 2800, 2700, 'Aktif', 1143, 'BEARPEDIA'),
(5089, 1142, 'TikTok - Likes', 'TikTok Likes | No Refill - Max 100K - 20K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 20K/Day\r\nRefill: No\r\nLink: TikTok Video Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 100000, 2597, 2504.25, 'Aktif', 1142, 'BEARPEDIA'),
(5090, 1141, 'Facebook - Group Members', 'Facebook Group Members | No Refill - Max 1M - 3-5K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 3K - 5K/Day\r\nRefill: No\r\nLink: Facebook Group Link\r\n  \r\nNote\r\n- Pada bagian admin support, biarkan default seperti aslinya.\r\n- Di bagian pengaturan grup, minta nonaktifkan persetujuan peserta untuk bergabung dengan grup.', 1000, 1000000, 14000, 13500, 'Aktif', 1141, 'BEARPEDIA'),
(5091, 1140, 'Facebook - Post Reaction', 'Facebook Post Reaction [Love❤️] - Lifetime Refill - Max 1M - 10K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 10K/Day\r\nQuality: Real\r\nRefill: Lifetime\r\nLink: Facebook Post Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 1000000, 21000, 20250, 'Aktif', 1140, 'BEARPEDIA'),
(5092, 1139, 'Facebook - Post Reaction', 'Facebook Post Reaction [Care????] - Lifetime Refill - Max 1M - 10K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 10K/Day\r\nQuality: Real\r\nRefill: Lifetime\r\nLink: Facebook Post Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 1000000, 21000, 20250, 'Aktif', 1139, 'BEARPEDIA'),
(5093, 1138, 'Facebook - Post Reaction', 'Facebook Post Reaction [Angry????] - Lifetime Refill - Max 1M - 10K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 10K/Day\r\nQuality: Real\r\nRefill: Lifetime\r\nLink: Facebook Post Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 1000000, 21000, 20250, 'Aktif', 1138, 'BEARPEDIA'),
(5094, 1137, 'Facebook - Post Reaction', 'Facebook Post Reaction [Wow????] - Lifetime Refill - Max 1M - 10K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 10K/Day\r\nQuality: Real\r\nRefill: Lifetime\r\nLink: Facebook Post Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 1000000, 21000, 20250, 'Aktif', 1137, 'BEARPEDIA'),
(5095, 1136, 'Facebook - Post Reaction', 'Facebook Post Reaction [Sad????] - Lifetime Refill - Max 1M - 10K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 10K/Day\r\nQuality: Real\r\nRefill: Lifetime\r\nLink: Facebook Post Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 1000000, 21000, 20250, 'Aktif', 1136, 'BEARPEDIA'),
(5096, 1135, 'Facebook - Post Reaction', 'Facebook Post Reaction [Haha????] - Lifetime Refill - Max 1M - 10K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 10K/Day\r\nQuality: Real\r\nRefill: Lifetime\r\nLink: Facebook Post Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 1000000, 21000, 20250, 'Aktif', 1135, 'BEARPEDIA'),
(5097, 1134, 'TikTok - Story', 'TikTok Story Views | No Refill - Max 50K - 10K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 10K/Day\r\nRefill: No\r\nLink: TikTok Story Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 50000, 5600, 5400, 'Aktif', 1134, 'BEARPEDIA'),
(5098, 1133, 'TikTok - Story', 'TikTok Story Likes | No Refill - Max 30K - 10K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 10K/Day\r\nRefill: No\r\nLink: TikTok Story Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 50, 30000, 5600, 5400, 'Aktif', 1133, 'BEARPEDIA'),
(5099, 1132, 'TikTok - Story', 'TikTok Story Shares | No Refill - Max 50K - 10K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 10K/Day\r\nRefill: No\r\nLink: TikTok Story Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 10, 50000, 5600, 5400, 'Aktif', 1132, 'BEARPEDIA'),
(5100, 1131, 'Instagram - Reels', 'Instagram Reels Comments Random + Emoji | No Refill - Max 200K - 1K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 1K/Day\r\nQuality: Real\r\nRefill: No\r\nLink: Instagram Reels Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 50, 200000, 56000, 54000, 'Aktif', 1131, 'BEARPEDIA'),
(5101, 1130, 'TikTok - Likes', 'TikTok Likes | Refill 30Day - Max 1M - 10K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 10K/Day\r\nRefill: 30 hari\r\nLink: TikTok Video Link\r\n \r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 1000000, 3920, 3780, 'Aktif', 1130, 'BEARPEDIA');
INSERT INTO `layanan` (`id`, `service_id`, `kategori`, `layanan`, `catatan`, `min`, `max`, `harga`, `harga_api`, `status`, `provider_id`, `provider`) VALUES
(5102, 1129, 'Twitter - Followers', 'Twitter Followers | No Refill - Real Mix - Max 10K - 10K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 10K/Day\r\nQuality: Real Mix\r\nRefill: No\r\nLink: https://twitter.com/username\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 20, 10000, 7000, 6750, 'Aktif', 1129, 'BEARPEDIA'),
(5103, 1128, 'TikTok - Followers', 'TikTok Followers [ Recommended ] | Lifetime Refill - Max 100K - 10k/Day', 'Start time: 0 - 24 hours\r\nSpeed: 10K/Day\r\nQuality: Real and Active Followers and Likes\r\nRefill: Lifetime\r\nLink: tiktok.com/@username\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 5, 100000, 56000, 54000, 'Aktif', 1128, 'BEARPEDIA'),
(5104, 1127, 'TikTok - Likes', 'TikTok Likes | Refill 60Day - Max 200K - 50K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 50K/Day\r\nQuality: HQ\r\nRefill: 60 hari\r\nLink: TikTok Video Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 10, 200000, 10500, 10125, 'Aktif', 1127, 'BEARPEDIA'),
(5105, 1126, 'TikTok - Saves', 'TikTok Saves | Refill 365Day - Real - Max 1M - 10K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 10K/Day\r\nQuality: Real\r\nRefill: 365 hari\r\nLink: TikTok Video Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 1000000, 7000, 6750, 'Aktif', 1126, 'BEARPEDIA'),
(5106, 1125, 'TikTok - Shares', 'TikTok Share | Refill 30Day - Max 100M - 10M/Day', 'Start time: 0 - 24 hours\r\nSpeed: 10M/Day\r\nRefill: 30 hari\r\nLink: TikTok Video Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 20, 1000000000, 231, 222.75, 'Aktif', 1125, 'BEARPEDIA'),
(5107, 1124, 'Z[+Private]', 'Facebook Profile Followers | No Refill - Real - Max 100K - 200-5K/Day', 'Start time: 0 - 24 / 48 hours\r\nSpeed: 200 - 5K/Day\r\nQuality: Real\r\nRefill: No\r\nLink: Facebook Akun Link ( Only Profile )\r\n\r\nNote\r\n- Harap matikan mode profesional untuk profil sebelum memesan.\r\n- Jika Anda memasang link Halaman, kami tidak refill/refund.\r\n- Jika pesanan telah drop di bawah jumlah awal pesanan asli, kami tidak akan menerima refill/refund', 500, 100000, 10220, 9855, 'Aktif', 1124, 'BEARPEDIA'),
(5108, 1122, 'Instagram - IGTV', 'Instagram IGTV Views | No Refill - Max 10M - 1M/Day', 'Start time: 0 - 24 hours\r\nSpeed: 1M/Day\r\nRefill: No\r\nLink: Instagram IGTV Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 100000000, 25.2, 24.3, 'Aktif', 1122, 'BEARPEDIA'),
(5109, 1121, 'Instagram - IGTV', 'Instagram IGTV Likes | Refill 30Day - Non Drop - Max 50K - 20K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 20K/Day\r\nRefill: 30 hari\r\nLink: Instagram IGTV Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 20, 50000, 4200, 4050, 'Aktif', 1121, 'BEARPEDIA'),
(5110, 1120, 'TikTok - Shares', 'TikTok Share | Lifetime Refill - Max 100M - 10M/Day', 'Start time: 0 - 24 hours\r\nSpeed: 10M/Day\r\nRefill: Lifetime\r\nLink: TikTok Video Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 100000000, 280, 270, 'Aktif', 1120, 'BEARPEDIA'),
(5111, 1119, 'Z[+Private]', 'Facebook Fanspage Followers | Refill 30Day - Max 120K - 5K/Day ', 'Start time: 0 - 24/48 hours\r\nSpeed: 5K/Day\r\nRefill: 30 hari\r\nLink: Facebook Fanspage Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 120000, 39200, 37800, 'Aktif', 1119, 'BEARPEDIA'),
(5112, 1118, 'TikTok - Explore', 'TikTok Explore | No Refill - Max 500K - 50K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 50K/Day\r\nRefill: No\r\nLink: TikTok Video Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 500000, 560, 540, 'Aktif', 1118, 'BEARPEDIA'),
(5113, 1117, 'TikTok - Explore', 'TikTok Explore | No Refill - No Drop - Real - Max 1M - 500K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 500K/Day\r\nQuality: Real\r\nRefill: No\r\nLink: TikTok Video Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 1000000, 980, 945, 'Aktif', 1117, 'BEARPEDIA'),
(5114, 1116, 'Facebook - Verified / Centang Biru', 'Facebook Comments Custom [ Dari akun Verified / Centang Biru ] [ Rp9.900 1 Komen ]', 'Start time: 0 - 24 hours\r\nSpeed: Up To 100/Day\r\nQuality: Real Accounts\r\nDrop rate: Non Drop\r\nRefill: No Refill / No Refund\r\nLink: Facebook Post Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 2, 100, 13860000, 13365000, 'Aktif', 1116, 'BEARPEDIA'),
(5115, 1115, 'Instagram - Followers [ Guaranteed Lifetime ]', 'Instagram Followers | Lifetime Refill - Real Mixed - Max 500K - 20K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 20K/Day\r\nRefill: Lifetime\r\nLink: Instagram username tanpa \" @ \"\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 10, 500000, 22400, 21600, 'Aktif', 1115, 'BEARPEDIA'),
(5116, 1114, 'Instagram - Followers [ Guaranteed 90-365 Days ]', 'Instagram Followers | Refill 99Day - Low Drop - Max 1M - 10K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 10K/Day\r\nDrop rate: Low Drop\r\nRefill: 99 hari\r\nLink: Instagram username tanpa \" @ \"\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 50, 1000000, 5880, 5670, 'Aktif', 1114, 'BEARPEDIA'),
(5117, 1113, 'TikTok - Shares', 'TikTok Share | Refill 30Day - Real - Max 1M - 1M/Day', 'Start time: 0 - 24 hours\r\nSpeed: 1M/Day\r\nQuality: Real\r\nRefill: 30 hari\r\nLink: TikTok Video Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 10000000, 352.8, 340.2, 'Aktif', 1113, 'BEARPEDIA'),
(5118, 1112, 'TikTok - Saves', 'TikTok Saves | Refill 15Day - Max 20K - 10K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 10K/Day\r\nRefill: 15 hari\r\nLink: TikTok Video Link\r\n \r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 20000, 2100, 2025, 'Aktif', 1112, 'BEARPEDIA'),
(5119, 1111, 'Facebook - Profile Followers', 'Facebook Profile Followers | No Refill - Max 10K - 200-1K/Day', 'Start time: 0 - 24 / 48 hours\r\nSpeed: 200 - 1K/Day\r\nQuality: Real\r\nRefill: No\r\nLink: Facebook Akun Link ( Only Profile )\r\n\r\nNote\r\n- Harap matikan mode profesional untuk profil sebelum memesan.\r\n- Jika anda memasang link Halaman, kami tidak refill/refund.\r\n- Jika pesanan telah drop di bawah jumlah awal pesanan asli, kami tidak akan menerima refill/refund', 1000, 10000, 13160, 12690, 'Aktif', 1111, 'BEARPEDIA'),
(5120, 1109, 'Twitter - Statistics / Poll / Impressions', 'Twitter Details Click | No Refill - Max 50M - 1M/Day', '', 100, 100000000, 175, 168.75, 'Aktif', 1109, 'BEARPEDIA'),
(5121, 1108, 'Twitter - Statistics / Poll / Impressions', 'Twitter Hasthag Click | No Refill - Max 50M - 1M/Day', '', 100, 100000000, 175, 168.75, 'Aktif', 1108, 'BEARPEDIA'),
(5122, 1107, 'Twitter - Statistics / Poll / Impressions', 'Twitter Link Click | No Refill - Max 50M - 1M/Day', '', 100, 50000000, 175, 168.75, 'Aktif', 1107, 'BEARPEDIA'),
(5123, 1104, 'Twitter - Likes', 'Twitter Likes | No Refill - Max 5K - 500-1K/Day', 'Start time: 0 - 24 hours ( Bisa lebih lambat )\r\nSpeed: 500 - 1K/Day\r\nDrop rate: High\r\nRefill: No\r\nLink: Twitter Post Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 50, 5000, 8400, 8100, 'Aktif', 1104, 'BEARPEDIA'),
(5124, 1103, 'Twitter - Retweets', 'Twitter Retweets | No Refill - Max 50K - 1K/Day', 'Start time: 1 - 24 hours ( Bisa lebih lambat )\r\nSpeed: 1K/Day\r\nDrop rate: High\r\nRefill: No\r\nLink: Twitter Post Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 50, 200000, 8400, 8100, 'Aktif', 1103, 'BEARPEDIA'),
(5125, 1102, 'Twitter - Views', 'Twitter Views | No Refill - Real - Max 10M - 5M/Day', '', 100, 100000000, 61.6, 59.4, 'Aktif', 1102, 'BEARPEDIA'),
(5126, 1101, 'Twitter - NFT Services', 'Twitter Followers [ NFT + CRYPTO Accounts] - No Refill - Real - Max 50K - Slow', 'Start time: 0 - 24 hours\r\nSpeed: Slow\r\nQuality: Real\r\nRefill: No\r\nLink: https://twitter.com/username\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 50000, 42000, 40500, 'Aktif', 1101, 'BEARPEDIA'),
(5127, 1100, 'Twitter - NFT Services', 'Twitter Retweet [ NFT + CRYPTO Accounts] - No Refill - Real - Max 5K - 500/Day', 'Start time: 1 - 24 hours\r\nSpeed: 100 - 500/Day\r\nQuality: Real\r\nRefill: No\r\nLink: Twitter Post Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 10, 5000, 63000, 60750, 'Aktif', 1100, 'BEARPEDIA'),
(5128, 1099, 'Twitter - NFT Services', 'Twitter Likes [ NFT Accounts ] - No Refill - Real - Max 50K - 10K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 10K/Day\r\nQuality: Real\r\nRefill: No\r\nLink: Twitter Post Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 50000, 39200, 37800, 'Aktif', 1099, 'BEARPEDIA'),
(5129, 1098, 'TikTok - Comments Likes', 'TikTok Comments Dislike ???? | No Refill - Max 5K - 1K/Day', 'Cara Pesan\r\nUsername/Link = Username akun tanpa \" @ \"\r\nLink Postingan = Link Post yang anda komentari', 50, 5000, 11900, 11475, 'Aktif', 1098, 'BEARPEDIA'),
(5130, 1097, 'TikTok - Saves', 'TikTok Saves | Lifetime Refill - Real - Max 1M - 10K/Day', 'Start time: 0 - 24 hours \r\nSpeed: 10K/Day\r\nRefill: Lifetime\r\nLink: TikTok Video Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 1000000, 11200, 10800, 'Aktif', 1097, 'BEARPEDIA'),
(5131, 1096, 'TikTok - Shares', 'TikTok Share | No Refill - Max 50M - 1M/Day', 'Start time: 0 - 12 hours\r\nSpeed: 1M/Day\r\nRefill: No \r\nLink: TikTok Video Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 50000000, 238, 229.5, 'Aktif', 1096, 'BEARPEDIA'),
(5132, 1095, 'Instagram - Report Spam Account', 'Instagram Report Spam [ For Post ]', '???????????????????????????? :\r\n You Must Put The Post Link\r\n Make Sure The Account Is Public\r\n The Effect Decreases On Account Over 50K\r\n\r\n???????????????? :\r\n We Don\'t Guarantee The Account Will Ban, Just We Will Do Our Best\r\n You Is Responsible For Incorrect And Incorrectly Entered Orders\r\n We Doesn\'t Accept Any Responsibility\r\n\r\n???????????????????? :\r\n Don\'t Order From Third Party, While Working On Your Order\r\n Don\'t Order More Than One Order At Same time\r\n Otherwise, Your Order Will Be Considered Cojtlete', 1000, 1000000, 28000, 27000, 'Aktif', 1095, 'BEARPEDIA'),
(5133, 1094, 'Instagram - Report Spam Account', 'Instagram Report Spam [ For Account ]', '???????????????????????????? :\r\n You Must Put The Account Link\r\n It Doesn\'t Matter If The Account Is Public/Private\r\n The Effect Decreases On Account Over 50K\r\n\r\n???????????????? :\r\n We Don\'t Guarantee The Account Will Ban, Just We Will Do Our Best\r\n You Is Responsible For Incorrect And Incorrectly Entered Orders\r\n We Doesn\'t Accept Any Responsibility\r\n\r\n???????????????????? :\r\n Don\'t Order From Third Party, While Working On Your Order\r\n Don\'t Order More Than One Order At Same time\r\n Otherwise, Your Order Will Be Considered Cojtlete', 1000, 1000000, 28000, 27000, 'Aktif', 1094, 'BEARPEDIA'),
(5134, 1093, 'TikTok - Report Spam Account', 'TikTok Report Spam [ For Video ]', '???????????????????????????? :\r\n You Must Put The Video Link\r\n Make Sure The Account Is Public\r\n The Effect Decreases On Account Over 50K\r\n\r\n???????????????? :\r\n We Don\'t Guarantee The Account Will Ban, Just We Will Do Our Best\r\n You Is Responsible For Incorrect And Incorrectly Entered Orders\r\n We Doesn\'t Accept Any Responsibility\r\n\r\n???????????????????? :\r\n Don\'t Order From Third Party, While Working On Your Order\r\n Don\'t Order More Than One Order At Same time\r\n Otherwise, Your Order Will Be Considered Cojtlete', 1000, 1000000, 28000, 27000, 'Aktif', 1093, 'BEARPEDIA'),
(5135, 1092, 'TikTok - Report Spam Account', 'TikTok Report Spam [ For Account ]', '???????????????????????????? :\r\n You Must Put The Account Link\r\n It Doesn\'t Matter If The Account Is Public/Private\r\n The Effect Decreases On Account Over 50K\r\n\r\n???????????????? :\r\n We Don\'t Guarantee The Account Will Ban, Just We Will Do Our Best\r\n You Is Responsible For Incorrect And Incorrectly Entered Orders\r\n We Doesn\'t Accept Any Responsibility\r\n\r\n???????????????????? :\r\n Don\'t Order From Third Party, While Working On Your Order\r\n Don\'t Order More Than One Order At Same time\r\n Otherwise, Your Order Will Be Considered Cojtlete', 1000, 1000000, 28000, 27000, 'Aktif', 1092, 'BEARPEDIA'),
(5136, 1091, 'Facebook - Report Spam Account', 'Facebook Report Spam [ For Post ]', '???????????????????????????? :\r\n You Must Put The Post Link\r\n Make Sure The Account Is Public\r\n The Effect Decreases On Account Over 50K\r\n\r\n???????????????? :\r\n We Don\'t Guarantee The Post Will Ban, Just We Will Do Our Best\r\n You Is Responsible For Incorrect And Incorrectly Entered Orders\r\n We Doesn\'t Accept Any Responsibility\r\n\r\n???????????????????? :\r\n Don\'t Order From Third Party, While Working On Your Order\r\n Don\'t Order More Than One Order At Same time\r\n Otherwise, Your Order Will Be Considered Cojtlete', 1000, 1000000, 28000, 27000, 'Aktif', 1091, 'BEARPEDIA'),
(5137, 1090, 'Facebook - Report Spam Account', 'Facebook Report Spam [ For Account / Page ]', '???????????????????????????? :\r\n You Must Put The Account Link\r\n It Doesn\'t Matter If The Account Is Public/Private\r\n The Effect Decreases On Account Over 50K\r\n\r\n???????????????? :\r\n We Don\'t Guarantee The Account Will Ban, Just We Will Do Our Best\r\n You Is Responsible For Incorrect And Incorrectly Entered Orders\r\n We Doesn\'t Accept Any Responsibility\r\n\r\n???????????????????? :\r\n Don\'t Order From Third Party, While Working On Your Order\r\n Don\'t Order More Than One Order At Same time\r\n Otherwise, Your Order Will Be Considered Cojtlete', 1000, 1000000, 28000, 27000, 'Aktif', 1090, 'BEARPEDIA'),
(5138, 1089, 'TikTok - Likes', 'TikTok Likes | No Refill - Max 500K - 20K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 20K/Day\r\nRefill: No\r\nLink: TikTok Video Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 500000, 3592.4, 3464.1, 'Aktif', 1089, 'BEARPEDIA'),
(5139, 1087, 'Youtube - Shorts', 'Youtube Shorts Likes | Refill 30Day - Max 200K - 10K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 10K/Day\r\nRefill: 30 hari\r\nLink: YouTube Shorts Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada channel publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 10, 200000, 10500, 10125, 'Aktif', 1087, 'BEARPEDIA'),
(5140, 1086, 'Z[+Private]', 'Youtube Shorts Views | No Refill - Source Suggested - Max 1M', 'Start time: 0 - 24 hours\r\nSpeed: 20K/Day\r\nSource: Suggested\r\nRefill: No\r\nLink: YouTube Shorts Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada channel publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 200, 10000000, 15400, 14850, 'Aktif', 1086, 'BEARPEDIA'),
(5141, 1085, 'Youtube - Shorts', 'Youtube Shorts Views + 5-10% Likes | Lifetime Refill - Source External + Direct - Max 100K', 'Start time: 0 - 72 hours\r\nSpeed: 5K/Day\r\nSource: External + Direct\r\nRefill: No\r\nLink: YouTube Shorts Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada channel publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 120000, 13300, 12825, 'Aktif', 1085, 'BEARPEDIA'),
(5142, 1084, 'Z[+Private]', 'Youtube Shorts Views | Lifetime Refill - Source External + Direct - Max 100K ', 'Start time: 0 - 24 hours\r\nSpeed: 5K/Day\r\nSource: External + Direct\r\nRefill: Lifetime\r\nLink: YouTube Shorts Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada channel publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 100000, 9800, 9450, 'Aktif', 1084, 'BEARPEDIA'),
(5143, 1083, 'Youtube - Shorts', 'Youtube Short Comment Likes | No Refill - Max 100K - 1K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 1K/Day\r\nRefill: No\r\nLink: YouTube Shorts Comments Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada channel publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 50, 100000, 32200, 31050, 'Aktif', 1083, 'BEARPEDIA'),
(5144, 1082, 'Youtube - Shorts', 'Youtube Short Views | No Refill - Max 3M - 30K/Day ', 'Start time: 0 - 24 hours\r\nSpeed: 30K/Day\r\nRefill: No\r\nLink: YouTube Shorts Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada channel publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 500, 3000000, 16800, 16200, 'Aktif', 1082, 'BEARPEDIA'),
(5145, 1081, 'Youtube - Shorts', 'Youtube Short Views | No Refill - Max 1M - 50K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 50K/Day\r\nRefill: No\r\nLink: YouTube Shorts Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada channel publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 1000, 1000000, 12460, 12015, 'Aktif', 1081, 'BEARPEDIA'),
(5146, 1080, 'Youtube - Shorts', 'YouTube Shorts Comments Custom | Refill 30Day - Max 5K - 5K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 5K/Day\r\nRefill: 30 hari\r\nLink: YouTube Shorts Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada channel publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 10, 5000, 196000, 189000, 'Aktif', 1080, 'BEARPEDIA'),
(5147, 1079, 'Z[+Private]', 'Youtube Jam Tayang [ +15 Menit ] - Refill 30Day - Max 8K', '- Gunakan video lebih dari 15 menit (Jika Video Kurang Dari 15 Menit Maka Anda Tidak Bisa Mendapatkan Jam Yang Cukup.)\r\n- Pesan 1000 Views = 1000 jam tayang\r\n- Drop rate : Non Drop\r\n- Guarantee : 30 days Refill\r\n- Speed : 1000 Hours / Day', 100, 8000, 119000, 114750, 'Aktif', 1079, 'BEARPEDIA'),
(5148, 1078, 'Z[+Private]', 'Youtube Jam Tayang [ +30 Menit ] - Refill 30Day - Max 8K', '- Gunakan video lebih dari 30 menit (Jika Video Kurang Dari 30 Menit Maka Anda Tidak Bisa Mendapatkan Jam Yang Cukup.)\r\n- Pesan 1000 Views = 1000 jam tayang\r\n- Drop rate : Non Drop\r\n- Guarantee : 30 days Refill\r\n- Speed : 1000 Hours / Day', 100, 8000, 119000, 114750, 'Aktif', 1078, 'BEARPEDIA'),
(5149, 1077, 'Z[+Private]', 'Youtube Jam Tayang [ +45 Menit ] - Refill 30Day - Max 8K', '- Gunakan video lebih dari 45 menit (Jika Video Kurang Dari 45 Menit Maka Anda Tidak Bisa Mendapatkan Jam Yang Cukup.)\r\n- Pesan 1000 Views = 1000 jam tayang\r\n- Drop rate : Non Drop\r\n- Guarantee : 30 days Refill\r\n- Speed : 1000 Hours / Day', 100, 8000, 119000, 114750, 'Aktif', 1077, 'BEARPEDIA'),
(5150, 1075, 'Z[+Private]', 'Youtube Jam Tayang [ +60 Menit ] - Refill 30Day - Max 8K', '- Gunakan video lebih dari 60 menit (Jika Video Kurang Dari 60 Menit Maka Anda Tidak Bisa Mendapatkan Jam Yang Cukup.)\r\n- Pesan 1000 Views = 1000 jam tayang\r\n- Drop rate : Non Drop\r\n- Guarantee : 30 days Refill\r\n- Speed : 1000 Hours / Day\r\nNote: Tersemat harus diaktifkan!', 100, 8000, 119000, 114750, 'Aktif', 1075, 'BEARPEDIA'),
(5151, 1074, 'Z[+Private]', '######$3282#', '\r\n', 100, 100000, 2380, 2295, 'Aktif', 1074, 'BEARPEDIA'),
(5152, 1073, 'TikTok - Likes', 'TikTok Likes | Lifetime Refill - Non Drop - Max 1M - 500K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 500K/Day\r\nQuality: Real\r\nRefill: Lifetime\r\nLink: TikTok Video Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 1000000, 5600, 5400, 'Aktif', 1073, 'BEARPEDIA'),
(5153, 1072, 'Youtube - Subscribers', 'Youtube Subscribers + Engagements | Refill 30Day - Best For Monetization Approval', 'Channel harus memiliki setidaknya 1-2 video, Don\'t use link channel have : /c/\r\n\r\nStart time: 0 - 72 hours\r\nSpeed: 50 - 80/Day\r\nRefill: 30hari\r\nLink: Youtube Channel Link\r\n\r\n✔️ Layanan ini hanya berfungsi pada channel publik\r\n✔️ Garansi akan dicabut jika jumlah subscriber di-private \r\n️✔️ Garansi akan dicabut jika jumlah awal pesanan turun terus-menerus', 50, 15000, 308000, 297000, 'Aktif', 1072, 'BEARPEDIA'),
(5154, 1071, 'Youtube - Subscribers', 'Youtube Subscribers + Views + Likes | Refill 30Day - Best For Monetization Approval', 'Channel harus memiliki setidaknya 1-2 video, Don\'t use link channel have : /c/\r\n\r\nStart time: 0 - 72 hours\r\nSpeed: 20 - 50/Day\r\nRefill: 30hari\r\nLink: Youtube Channel Link\r\n\r\n✔️ Layanan ini hanya berfungsi pada channel publik\r\n✔️ Garansi akan dicabut jika jumlah subscriber di-private \r\n️✔️ Garansi akan dicabut jika jumlah awal pesanan turun terus-menerus', 20, 6000, 308000, 297000, 'Aktif', 1071, 'BEARPEDIA'),
(5155, 1070, 'TikTok - Likes', 'TikTok Likes | No Refill - Non Drop - Real - Max 10M - 1M/Day', 'Start time: 0 - 24 hours\r\nSpeed: 1M/Day\r\nQuality: Real\r\nDrop rate: Non Drop ( No Garansi )\r\nRefill: No\r\nLink: TikTok Video Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 100000000, 5880, 5670, 'Aktif', 1070, 'BEARPEDIA'),
(5156, 1069, 'Discord - Members', 'Discord Members [ OFFLINE Server ] - No Refill - 20K - 1-2K/Day', 'Start time: 0 - 12 hours ( No Speed up )\r\nSpeed: 1K - 2K/Day\r\nQuality: High Quality Members With Photo\r\nExajtle Link: https://discord.gg/xxxxx\r\n\r\nNote\r\n- If you have anti-raid protect bot such as beemo or wick on your server, please do not place an order because these bots will kick the members from the server.\r\n- If the server asks for a captcha at joining, the order will be cancelled because this means the server is flagged.', 50, 21000, 81200, 78300, 'Aktif', 1069, 'BEARPEDIA'),
(5157, 1068, 'Discord - Friend Request', 'Discord Friend Request | No Refill - Non Drop - Max 2K - 2K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 2K/Day\r\nRefill: No\r\nExajtle link: username#1203', 25, 2000, 30800, 29700, 'Aktif', 1068, 'BEARPEDIA'),
(5158, 1067, 'Facebook - Comments Likes', 'Facebook Comment Likes [ React ???? ] - No Refill - Max 1K', '✔️ Klik kanan pada tanggal komentar lalu salin tautan dan lakukan pemesanan.\r\n\r\nStart: 0 - 24 Hours\r\nSpeed: 1K / Day\r\nRefill: No\r\nLink: Facebook comment link\r\nExajtle link: https://www.facebook.com/xyz/posts/123?comment_id=456', 50, 1000, 21000, 20250, 'Aktif', 1067, 'BEARPEDIA'),
(5159, 1065, 'Instagram - Post Shares', 'Instagram Post Shares | No Refill - Max 5M - 30K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 30K/Day\r\nRefill: No\r\nLink: Instagram Post Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 5000000, 3500, 3375, 'Aktif', 1065, 'BEARPEDIA'),
(5160, 1064, 'Instagram - Saves', 'Instagram Saves | Refill 30Day - Real Mix - Max 100k - 50K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 50K/Day\r\nQuality: Real Mix\r\nRefill: 30 hari\r\nLink: Instagram Post Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 100000, 420, 405, 'Aktif', 1064, 'BEARPEDIA'),
(5161, 1063, 'Twitter - Followers', 'Twitter Followers | No Refill - Max 200K - 10K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 10K/Day\r\nRefill: No\r\nLink: Twitter username tanpa \" @ \"\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 10, 200000, 15400, 14850, 'Aktif', 1063, 'BEARPEDIA'),
(5162, 1062, 'Instagram - Story Poll Votes', 'Instagram Story Poll Votes + Views [ VOTE = 1 ] - No Refill - Max 1M', 'Link: Instagram Story Link', 100, 1000000, 9800, 9450, 'Aktif', 1062, 'BEARPEDIA'),
(5163, 1061, 'Instagram - Story Poll Votes', 'Instagram Story Poll Votes + Views [ VOTE = 2 ] - No Refill - Max 1M', 'Link: Instagram Story Link', 100, 1000000, 9800, 9450, 'Aktif', 1061, 'BEARPEDIA'),
(5164, 1060, 'Instagram - Story Poll Votes', 'Instagram Story Poll Votes [ 1/YES Votes on Answer ] - No Refill - Max 100K', 'Link: Instagram Story Link', 100, 100000, 5600, 5400, 'Aktif', 1060, 'BEARPEDIA'),
(5165, 1059, 'Instagram - Story Poll Votes', 'Instagram Story Poll Votes [ 2/NO Votes on Answer ] - No Refill - Max 100K', 'Link: Instagram Story Link', 100, 100000, 5600, 5400, 'Aktif', 1059, 'BEARPEDIA'),
(5166, 1057, 'Instagram - Story Views', 'Instagram Story Views | No Refill - Max 5K - 5K/Day', 'USERNAME ONLY', 11, 5000, 92.4, 89.1, 'Aktif', 1057, 'BEARPEDIA'),
(5167, 1054, 'YouTube - Live Stream Views Server 1', 'Youtube Live Stream Views [ 720 Minutes ]', 'Order 1000 Views - Get 100 Concurrent Stable Viewers\r\nOrder 2000 Views - Get 200 Concurrent Stable Viewers\r\nOrder 3000 Views - Get 300 Concurrent Stable Viewers', 1000, 4000, 22120, 21330, 'Aktif', 1054, 'BEARPEDIA'),
(5168, 1049, 'Z[+Private]', 'Facebook Photo / Post Likes | No Refill - Max 10K - 500/Day', 'Start time: 0 - 24 hours\r\nSpeed: 200 - 500/Day\r\nRefill: No\r\nLink: Facebook Post/Photo Link\r\n \r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 10000, 2520, 2430, 'Aktif', 1049, 'BEARPEDIA'),
(5169, 1047, 'YouTube - Views [ No Refill ]', 'Youtube Views | No Refill - Source Google Search - Max 500K - 5K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 5K/Day\r\nSource: Google Search\r\nGuarantee: No refill no refund\r\nLink: Youtube Video Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada channel publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 200, 500000, 16520, 15930, 'Aktif', 1047, 'BEARPEDIA'),
(5170, 1046, 'Z[+Private]', 'YouTube Views + 0-5% Likes | Refill 60Day - Max 100K - 2-3K/Day', 'Start time: 0 - 24/72 hours ( membeli = setuju )\r\nSpeed: 2K - 3K/Day\r\nRefill: 60 hari\r\nLink: Youtube Video Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada channel publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 100000, 9800, 9450, 'Aktif', 1046, 'BEARPEDIA'),
(5171, 1045, 'Instagram - Likes [ No Refill ]', 'Instagram Likes | No Refill - Low Drop - Max 300K - 100K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 100K/Day\r\nRefill: No\r\nLink: Instagram Post Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 300000, 819, 789.75, 'Aktif', 1045, 'BEARPEDIA'),
(5172, 1044, 'Instagram - Likes [ No Refill ]', 'Instagram Likes | No Refill - Max 300K - 100K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 100K/Day\r\nRefill: No\r\nLink: Instagram Post Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 10, 300000, 644, 621, 'Aktif', 1044, 'BEARPEDIA'),
(5173, 1043, 'Facebook - Reels Short Videos', 'Facebook Reels Short Video [ Custom Comments ] | Refill 30Day - Max 100K - 1K/Day', 'Start Time: 0 - 24hours\r\nSpeed: 1K/Day\r\nRefill: 30 hari\r\nLink: Facebook Reels Link\r\n\r\nNote\r\n- Layanan ini tidak berfungsi di \"Facebook Watch Videos\" itu hanya untuk \"Facebook Reels Videos\".', 10, 100000, 217000, 209250, 'Aktif', 1043, 'BEARPEDIA'),
(5174, 1042, 'Facebook - Reels Short Videos', 'Facebook Reels Short Video [ Shares ] | Refill 30Day - Max 1M - 50k/Day ', 'Start Time: 0 - 24hours\r\nSpeed: 50K/Day\r\nRefill: 30 hari \r\nLink: Facebook Reels Link\r\n\r\nNote\r\n- Layanan ini tidak berfungsi di \"Facebook Watch Videos\" itu hanya untuk \"Facebook Reels Videos\".', 100, 1000000, 21000, 20250, 'Aktif', 1042, 'BEARPEDIA'),
(5175, 1041, 'TikTok - Followers', 'TikTok Followers | No Refill - Real - Max 750K - 10k/Day', 'Start time: 0 - 24 hours\r\nSpeed: 10K - 20K/Day\r\nQuality: Real\r\nRefill: No\r\nLink: tiktok.com/@username\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 10, 750000, 18200, 17550, 'Aktif', 1041, 'BEARPEDIA'),
(5176, 1040, 'TikTok - Followers', 'TikTok Followers | No Refill - Real - Max 1M - 25K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 25K/Day\r\nQuality: Real\r\nRefill: No\r\nLink: tiktok.com/@username\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 1000000, 20307, 19581.75, 'Aktif', 1040, 'BEARPEDIA'),
(5177, 1039, 'TikTok - Followers', 'TikTok Followers | No Refill - Max 50K - 5K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 5K/Day\r\nRefill: No\r\nLink: tiktok.com/@username\r\n  \r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 10, 100000, 13580, 13095, 'Aktif', 1039, 'BEARPEDIA'),
(5178, 1037, 'TikTok - Views', 'TikTok Views | No Refill - Max 100M - 10M/Day', 'Start time: 0 - 24 hours\r\nSpeed: 10M/Day\r\nRefill: No\r\nLink: TikTok Video Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 10000000, 182, 175.5, 'Aktif', 1037, 'BEARPEDIA'),
(5179, 1036, 'TikTok - Views', 'TikTok Views | No Refill - Max 100M - 1M/Day', 'Start time: 0 - 24 hours\r\nSpeed: 1M/Day\r\nRefill: No\r\nLink: TikTok Video Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 10000000, 168, 162, 'Aktif', 1036, 'BEARPEDIA'),
(5180, 1035, 'TikTok - Views', 'TikTok Views | Lifetime Refill - Max 50M - 5M/Day', 'Start time: 0 - 24 hours\r\nSpeed: 5M/Day\r\nRefill: Lifetime\r\nLink: TikTok Video Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 500000000, 119, 114.75, 'Aktif', 1035, 'BEARPEDIA'),
(5181, 1032, 'TikTok - Live Stream Views Server 1', 'Tiktok Live Stream Views [ 180 Minutes ] - Max 10K', 'Server Termurah\r\nLink : https://www.tiktok.com/@username/live', 100, 30000, 315000, 303750, 'Aktif', 1032, 'BEARPEDIA'),
(5182, 1031, 'TikTok - Live Stream Views Server 1', 'Tiktok Live Stream Views [ 120 Minutes ] - Max 10K', 'Server Termurah\r\nLink : https://www.tiktok.com/@username/live', 100, 30000, 217000, 209250, 'Aktif', 1031, 'BEARPEDIA'),
(5183, 1030, 'TikTok - Live Stream Views Server 1', 'Tiktok Live Stream Views [ 60 Minutes ] - Max 10K', 'Server Termurah\r\nLink : https://www.tiktok.com/@username/live', 100, 30000, 117600, 113400, 'Aktif', 1030, 'BEARPEDIA'),
(5184, 1029, 'TikTok - Live Stream Views Server 1', 'Tiktok Live Stream Views [ 30 Minutes ] - Max 10K', 'Server Termurah\r\nLink : https://www.tiktok.com/@username/live', 100, 30000, 77000, 74250, 'Aktif', 1029, 'BEARPEDIA'),
(5185, 1028, 'TikTok - Live Stream Views Server 1', 'Tiktok Live Stream Views [ 15 Minutes ] - Max 10K', 'Server Termurah\r\nLink : https://www.tiktok.com/@username/live', 100, 30000, 49000, 47250, 'Aktif', 1028, 'BEARPEDIA'),
(5186, 1027, 'TikTok - Live Stream', 'Tiktok Live Stream Comments Custom | No Refill - Max 100K - Instant', 'Link : TikTok Livestream Link', 10, 100000, 210000, 202500, 'Aktif', 1027, 'BEARPEDIA'),
(5187, 1026, 'TikTok - Live Stream', 'Tiktok Live Stream Emoji Comments | No Refill - Max 1M - Instant', 'Link : TikTok Livestream Link', 10, 1000000, 140000, 135000, 'Aktif', 1026, 'BEARPEDIA'),
(5188, 1025, 'TikTok - Live Stream', 'TikTok Live Stream Likes | No Refill - Bots - Max 1M - 10K/Day', 'Link : TikTok Livestream Link', 10, 1000000, 2240, 2160, 'Aktif', 1025, 'BEARPEDIA'),
(5189, 1024, 'TikTok - Live Stream Views Server 2', 'Tiktok Live Stream Views [ 120 Minutes ] - Max 100K - Instant', 'Link : https://www.tiktok.com/@username/live', 100, 100000, 770000, 742500, 'Aktif', 1024, 'BEARPEDIA'),
(5190, 1023, 'TikTok - Live Stream Views Server 2', 'Tiktok Live Stream Views [ 90 Minutes ] - Max 100K - Instant', 'Link : https://www.tiktok.com/@username/live', 100, 100000, 630000, 607500, 'Aktif', 1023, 'BEARPEDIA'),
(5191, 1022, 'TikTok - Live Stream Views Server 2', 'Tiktok Live Stream Views [ 60 Minutes ] - Max 100K - Instant', 'Link : https://www.tiktok.com/@username/live', 100, 100000, 448000, 432000, 'Aktif', 1022, 'BEARPEDIA'),
(5192, 1021, 'TikTok - Live Stream Views Server 2', 'Tiktok Live Stream Views [ 30 Minutes ] - Max 100K - Instant', 'Link : https://www.tiktok.com/@username/live', 100, 100000, 263200, 253800, 'Aktif', 1021, 'BEARPEDIA'),
(5193, 1020, 'TikTok - Live Stream Views Server 2', 'Tiktok Live Stream Views [ 15 Minutes ] - Max 100K - Instant', 'Link : https://www.tiktok.com/@username/live\r\n', 100, 100000, 175000, 168750, 'Aktif', 1020, 'BEARPEDIA'),
(5194, 1019, 'Facebook - Fanspage Rating', 'Facebook Fanspage Rating | 5 Stars Reviews - Custom Reviews ★', 'Custom Reviews\r\nLink: Facebook Fanspage Link', 10, 100000, 448000, 432000, 'Aktif', 1019, 'BEARPEDIA'),
(5195, 1017, 'Facebook - Post Shares', 'Facebook Post Shares | No Refill - Max 100K - 20K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 20K/Day\r\nRefill: No\r\nLink: Facebook Post Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 100000, 19600, 18900, 'Aktif', 1017, 'BEARPEDIA'),
(5196, 1015, 'Facebook - Video Views [ Monetization ]', 'Facebook Video Views [600K Minutes Package] - Monetization - 48 Hours Delivery', '- Video needs to be at least 181 minutes long.\r\n- Views/minutes the system has run = views/minutes the system has run + views/minutes of real users generated during order execution.\r\n- If the order is being ordered on our system but you still buy more orders on another system or run ads, if there is a shortage of quantity between the two parties, it will not be processed!', 1000, 1000, 1103200, 1063800, 'Aktif', 1015, 'BEARPEDIA'),
(5197, 1014, 'Facebook - Video Views', 'Facebook Video Views | No Refill - Max 1M - 20K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 20K/Day\r\nRefill: No\r\nLink: Facebook Video Link\r\nExajtle Link: https://www.facebook.com/username/videos/123456/\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 500, 10000000, 42000, 40500, 'Aktif', 1014, 'BEARPEDIA'),
(5198, 1013, 'Facebook - Video Views', 'Facebook Video Views | No Refill - Max 1M - 100K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 100K/Day\r\nRefill: No\r\nLink: Facebook Video Link\r\nExajtle Link: https://www.facebook.com/username/videos/123456/\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 500, 1000000, 56000, 54000, 'Aktif', 1013, 'BEARPEDIA'),
(5199, 1012, 'Facebook - Video Views', 'Facebook Video Views | No Refill - Max 10M - 100K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 100K/Day\r\nRefill: No\r\nLink: Facebook Video Link\r\nExajtle Link: https://www.facebook.com/username/videos/123456/\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 500, 100000000, 37800, 36450, 'Aktif', 1012, 'BEARPEDIA'),
(5200, 1011, 'Facebook - Video Views', 'Facebook Video Views | No Refill - Max 10M - 10K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 10K/Day\r\nRefill: No\r\nLink: Facebook Video Link\r\nExajtle Link: https://www.facebook.com/username/videos/123456/\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 500, 100000000, 21000, 20250, 'Aktif', 1011, 'BEARPEDIA'),
(5201, 1006, 'TikTok - Likes', 'TikTok Likes | Refill 30Day - Max 200K - 30k/Day', 'Start time: 0 - 24 hours\r\nSpeed: 30K/Day\r\nRefill: 30 hari\r\nLink: TikTok Video Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 200000, 4900, 4725, 'Aktif', 1006, 'BEARPEDIA'),
(5202, 1005, 'TikTok - Verified / Centang Biru', 'TikTok Comments Random [ Dari Akun Artist Verified Creator ]', 'Proses 2 - 7 hari\r\n* Pesan 1000 mendapatkan 1 komentar', 1000, 1000, 19600, 18900, 'Aktif', 1005, 'BEARPEDIA'),
(5203, 1003, 'TikTok - Saves', 'TikTok Saves | No Refill - Max 100K - 10K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 10K/Day\r\nRefill: No\r\nLink: TikTok Video Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 50, 100000, 980, 945, 'Aktif', 1003, 'BEARPEDIA'),
(5204, 1001, 'Telegram - Post Shares', 'Telegram Post Shares | No Refill - Max 1M - 5-10K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 5K - 10K/Day\r\nRefill: No\r\nLink: Telegram Post Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada channel publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 1000000, 700, 675, 'Aktif', 1001, 'BEARPEDIA'),
(5205, 1000, 'Telegram - Views', 'Telegram Post Views [ 1 Post ] - No Refill - Max 1M - 500K/Day', 'Start time: 0 - 3 hours ( No Speed Up )\r\nSpeed: 500K/Day\r\nRefill: No\r\nLink: Telegram Post Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada channel publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 1000000, 63, 60.75, 'Aktif', 1000, 'BEARPEDIA'),
(5206, 999, 'Telegram - Reaction Premium', 'Telegram Premium Reactions ???????????????????? + Views - Non Drop - Max 1M', '', 50, 1000000, 7420, 7155, 'Aktif', 999, 'BEARPEDIA'),
(5207, 998, 'Telegram - Reaction Premium', 'Telegram Premium Reaction [Bird ????] + Views - Non Drop - Max 1M', '', 20, 1000000, 4200, 4050, 'Aktif', 998, 'BEARPEDIA'),
(5208, 997, 'Telegram - Reaction Premium', 'Telegram Premium Reaction [Clown ????] + Views - Non Drop - Max 1M', '', 20, 1000000, 4200, 4050, 'Aktif', 997, 'BEARPEDIA'),
(5209, 996, 'Telegram - Reaction Premium', 'Telegram Premium Reaction [Heart-Eyes ????] + Views - Non Drop - Max 1M', '', 20, 1000000, 4200, 4050, 'Aktif', 996, 'BEARPEDIA'),
(5210, 995, 'Telegram - Reaction Premium', 'Telegram Premium Reaction [100% ????] + Views - Non Drop - Max 1M', '', 20, 1000000, 4200, 4050, 'Aktif', 995, 'BEARPEDIA'),
(5211, 994, 'Telegram - Reaction Premium', 'Telegram Premium Reaction [Smiling ????] + Views - Non Drop - Max 1M', '', 20, 1000000, 4200, 4050, 'Aktif', 994, 'BEARPEDIA'),
(5212, 993, 'Telegram - Reaction', 'Telegram Positive Reactions ????????????????❤️ + Views - Non Drop - Max 1M', '', 20, 1000000, 3360, 3240, 'Aktif', 993, 'BEARPEDIA'),
(5213, 992, 'Telegram - Reaction', 'Telegram Negative Reactions ???????????????????? + Views - Non Drop - Max 1M', '', 20, 1000000, 3360, 3240, 'Aktif', 992, 'BEARPEDIA'),
(5214, 991, 'Telegram - Members [Public Channel/Group]', 'Telegram Members | No Refill - Max 100K - Slow', 'Tidak ada kojtlain untuk layanan ini', 15, 1000000, 5320, 5130, 'Aktif', 991, 'BEARPEDIA'),
(5215, 990, 'Telegram - Members [Public Channel/Group]', 'Telegram Members | AutoRefill 14Day - Max 100K - 5K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 5K/Day\r\nRefill: Auto Refill 14 hari\r\nType: Channel + Group\r\nLink: Telegram Channel Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada channel publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 100000, 14000, 13500, 'Aktif', 990, 'BEARPEDIA'),
(5216, 989, 'Telegram - Members [Public Channel/Group]', 'Telegram Members | AutoRefill 7Day - Max 100K - 5K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 5K/Day\r\nRefill: Auto Refill 7 hari\r\nType: Channel + Group\r\nLink: Telegram Channel Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada channel publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 100000, 11200, 10800, 'Aktif', 989, 'BEARPEDIA'),
(5217, 988, 'Telegram - Comments', 'Telegram Comments Custom | No Refill - Real - Max 10K - 1K/Day', 'Start time: 1 - 24 hours\r\nSpeed: 1K/Day\r\nQuality: Real\r\nLink: Telegram Post Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada channel publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 10, 10000, 350000, 337500, 'Aktif', 988, 'BEARPEDIA'),
(5218, 986, 'Instagram - Verified / Centang Biru', 'Instagram Comment Random [ Dari Akun Verified/Centang Biru] [ Rp17.000 1 Komen ]', 'Proses 1 - 6hari, bila 1 minggu tidak masuk lapor ke admin', 1, 13, 23800000, 22950000, 'Aktif', 986, 'BEARPEDIA'),
(5219, 985, 'Instagram - Comments Custom', 'Instagram Comments Custom | No Refill - Max 50K - 500-1K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 500 - 1K/Day\r\nRefill: No\r\nLink: Instagram Post Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 10, 10000, 18900, 18225, 'Aktif', 985, 'BEARPEDIA'),
(5220, 982, 'Instagram - Comments Likes', 'Instagram Comments Likes | No Refill - Max 50K - 5K/Day', 'Cara Pesan\r\n- Username/Link : Username akun tanpa \" @ \"\r\n- Link Postingan : Link post yang anda komentari', 50, 50000, 21000, 20250, 'Aktif', 982, 'BEARPEDIA'),
(5221, 981, 'Instagram - Post Shares', 'Instagram Post Shares | No Refill - Max 1M - 5K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 5K/Day\r\nRefill: No\r\nLink: Instagram Post Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 10, 1000000, 350, 337.5, 'Aktif', 981, 'BEARPEDIA'),
(5222, 980, 'Instagram - Post Shares', 'Instagram Post Shares | No Refill - Max 1M - 15K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 5K - 15K/Day\r\nRefill: No\r\nLink: Instagram Post Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 1000000, 490, 472.5, 'Aktif', 980, 'BEARPEDIA'),
(5223, 979, 'Instagram - IGTV', 'Instagram IGTV Saves | No Refill - Non Drop - Max 100K - 25K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 25K/Day\r\nDrop rate: Non Drop\r\nRefill: No\r\nLink: Instagram IGTV Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 5, 100000, 140, 135, 'Aktif', 979, 'BEARPEDIA'),
(5224, 976, 'Instagram - IGTV', 'Instagram IGTV Likes | No Refill - Max 100K - 5K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 5K/Day\r\nRefill: No\r\nLink: Instagram IGTV Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 50, 100000, 700, 675, 'Aktif', 976, 'BEARPEDIA'),
(5225, 975, 'Instagram - Views', 'Instagram Views + Ijtressions | No Refill - Max 5M - 500K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 500K/Day\r\nRefill: No\r\nLink: Instagram Video Link\r\n \r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 50000000, 39.2, 37.8, 'Aktif', 975, 'BEARPEDIA'),
(5226, 973, 'Instagram - Reels', 'Instagram Reels Saves | No Refill - Max 15K - 5K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 5K/Day\r\nRefill: No\r\nLink: Instagram Reels Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 50, 15000, 280, 270, 'Aktif', 973, 'BEARPEDIA'),
(5227, 972, 'Instagram - Reels', 'Instagram Reels Saves | No Refill - Max 10K - 10K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 10K/Day\r\nRefill: No\r\nLink: Instagram Reels Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 50, 10000, 168, 162, 'Aktif', 972, 'BEARPEDIA'),
(5228, 971, 'Instagram - Reels', 'Instagram Reels Likes | No Refill - Max 20K - 20K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 20K/Day\r\nQuality: Real\r\nRefill: No\r\nLink: Instagram Reels Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 10, 20000, 1400, 1350, 'Aktif', 971, 'BEARPEDIA');
INSERT INTO `layanan` (`id`, `service_id`, `kategori`, `layanan`, `catatan`, `min`, `max`, `harga`, `harga_api`, `status`, `provider_id`, `provider`) VALUES
(5229, 970, 'Instagram - Reels', 'Instagram Reels Likes | No Refill - Max 40K - 20K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 20K/Day\r\nRefill: No\r\nLink: Instagram Reels Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 40000, 1092, 1053, 'Aktif', 970, 'BEARPEDIA'),
(5230, 969, 'Instagram - Reels', 'Instagram Reels Likes | No Refill - Real - Low Drop - Max 25K - 25K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 25K/Day\r\nQuality: Real\r\nDrop rate: Low Drop\r\nRefill: No\r\nLink: Instagram Reels Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 25000, 2233, 2153.25, 'Aktif', 969, 'BEARPEDIA'),
(5231, 965, 'Instagram - Likes [ Refill ]', 'Instagram Likes | Refill 45Day - Less Drop - Max 30K - 500/hour', 'Start time: 0 - 24 hours\r\nSpeed: 100 - 500/Hour\r\nDrop rate: Less Drop\r\nRefill: 45 hari\r\nLink: Instagram Post Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 10, 30000, 1225, 1181.25, 'Aktif', 965, 'BEARPEDIA'),
(5232, 964, 'Instagram - Impressions', 'Instagram Ijtressions | No Refill - Real - Max 5M - 100K/Day', '', 100, 5000000, 490, 472.5, 'Aktif', 964, 'BEARPEDIA'),
(5233, 963, 'Instagram - Impressions', 'Instagram Ijtressions | No Refill - Max 2M - 500K/Day', '', 100, 2000000, 140, 135, 'Aktif', 963, 'BEARPEDIA'),
(5234, 962, 'Z[+Private]', 'Instagram Profile Visits | No Refill - Max 500K - 50K/Day', 'Harap order dengan kelipatan 100', 100, 500000, 910, 877.5, 'Aktif', 962, 'BEARPEDIA'),
(5235, 961, 'Instagram - Saves', 'Instagram Saves | No Refill - Max 100K - 100K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 100K/Day\r\nRefill: No\r\nLink: Instagram Post Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 10, 100000, 67.2, 64.8, 'Aktif', 961, 'BEARPEDIA'),
(5236, 959, 'Instagram - Views', 'Instagram Views [ Video + IGTV + Reel ] - Max 500M - 10M/Day', 'Start time: 0 - 24 hours\r\nSpeed: 10M/Day\r\nRefill: No\r\nLink: Instagram Video, IGTV, Reels Link\r\n \r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 500000000, 70, 67.5, 'Aktif', 959, 'BEARPEDIA'),
(5237, 958, 'TikTok - Views', 'TikTok Views | Trending + Viral + Explore Page - Max 2M - 2M/Day', 'Start time: 0 - 30 Menit, bisa lambat kapan saja\r\nSpeed: 2M/Day\r\nQuality: Real\r\nRefill: No\r\nLink: TikTok Video Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 10000000, 1120, 1080, 'Aktif', 958, 'BEARPEDIA'),
(5238, 957, 'Facebook - Live Stream Likes', 'Facebook Live Stream Likes ???? | No Refill - Max 200K - 10K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 10K/Day\r\nRefill: No\r\nLink: Facebook Live Stream Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 200000, 18200, 17550, 'Aktif', 957, 'BEARPEDIA'),
(5239, 956, 'Facebook - Live Stream Likes', 'Facebook Live Stream Reaction [Care ????] - Refill 30Day - Max 1M - Instant', 'Start time: 0 - 24 hours\r\nSpeed: 100K/Day\r\nRefill: No\r\nLink: Facebook Live Stream Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 1000000, 23800, 22950, 'Aktif', 956, 'BEARPEDIA'),
(5240, 955, 'Facebook - Live Stream Likes', 'Facebook Live Stream Reaction [Love ❤️] - Refill 30Day - Max 1M - Instant', 'Start time: 0 - 24 hours\r\nSpeed: 100K/Day\r\nRefill: No\r\nLink: Facebook Live Stream Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 1000000, 23800, 22950, 'Aktif', 955, 'BEARPEDIA'),
(5241, 954, 'Facebook - Live Stream Likes', 'Facebook Live Stream Reaction [Haha ????] - Refill 30Day - Max 1M - Instant', 'Start time: 0 - 24 hours\r\nSpeed: 100K/Day\r\nRefill: No\r\nLink: Facebook Live Stream Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 1000000, 23800, 22950, 'Aktif', 954, 'BEARPEDIA'),
(5242, 953, 'Facebook - Live Stream Likes', 'Facebook Live Stream Reaction [Wow ????] - Refill 30Day - Max 1M - Instant', 'Start time: 0 - 24 hours\r\nSpeed: 100K/Day\r\nRefill: No\r\nLink: Facebook Live Stream Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 1000000, 23800, 22950, 'Aktif', 953, 'BEARPEDIA'),
(5243, 952, 'Facebook - Live Stream Likes', 'Facebook Live Stream Reaction [Angry ????] - Refill 30Day - Max 1M - Instant', 'Start time: 0 - 24 hours\r\nSpeed: 100K/Day\r\nRefill: No\r\nLink: Facebook Live Stream Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 1000000, 23800, 22950, 'Aktif', 952, 'BEARPEDIA'),
(5244, 951, 'Facebook - Live Stream Likes', 'Facebook Live Stream Reaction [Sad ????] - Refill 30Day - Max 1M - Instant', 'Start time: 0 - 24 hours\r\nSpeed: 100K/Day\r\nRefill: No\r\nLink: Facebook Live Stream Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 1000000, 23800, 22950, 'Aktif', 951, 'BEARPEDIA'),
(5245, 947, 'Instagram - Followers [ Guaranteed 45-60 Days ]', 'Instagram Followers | Refill 60Day - Real - Less Drop - Max 100K - 5K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 5K/Day\r\nQuality: Real\r\nDrop rate: Less Drop\r\nRefill: 60 hari\r\nLink: Instagram username tanpa \" @ \"\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 10, 250000, 5913.6, 5702.4, 'Aktif', 947, 'BEARPEDIA'),
(5246, 946, 'Instagram - Followers [ Guaranteed 15-30 Days ]', 'Instagram Followers | Refill 30Day - Real - Max 10M - 20K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 10K - 20K/Day\r\nQuality: Real\r\nRefill: 30 hari\r\nLink: Instagram username tanpa \" @ \"\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 50, 10000000, 5023.2, 4843.8, 'Aktif', 946, 'BEARPEDIA'),
(5247, 944, 'Instagram - Followers [ Guaranteed 45-60 Days ]', 'Instagram Followers | Refill 60Day - Less Drop - Max 500K - 10K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 10K/Day\r\nQuality: Real Mix\r\nDrop rate: Less Drop\r\nRefill: 60 hari\r\nLink: Instagram username tanpa \" @ \"\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 10, 500000, 5320, 5130, 'Aktif', 944, 'BEARPEDIA'),
(5248, 936, 'Instagram - Comments Likes', 'Instagram Comments Likes | Refill 30Day - Max 30K - 1K/Day', 'Cara Pesan\r\n- Username/Link : Username akun tanpa \" @ \"\r\n- Link Postingan : Link post yang anda komentari', 20, 30000, 14000, 13500, 'Aktif', 936, 'BEARPEDIA'),
(5249, 935, 'Instagram - Comments Likes', 'Instagram Comments Likes | No Refill - Max 10K - 1K/Day', 'Cara Pesan\r\n- Username/Link : Username akun tanpa \" @ \"\r\n- Link Postingan : Link post yang anda komentari', 20, 10000, 9800, 9450, 'Aktif', 935, 'BEARPEDIA'),
(5250, 933, 'TikTok - Comments Likes', 'TikTok Comments Likes ❤️ | Refill 30Day - Max 10K - 1K/Day', 'Cara Pesan\r\nUsername/Link = Username akun tanpa \" @ \"\r\nLink Postingan = Link Post yang anda komentari', 50, 5000, 10500, 10125, 'Aktif', 933, 'BEARPEDIA'),
(5251, 930, 'Telegram - Members [Public Channel/Group]', 'Telegram Members | AutoRefill 3Day - Max 100K - 5K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 5K/Day\r\nRefill: Auto Refill 3 hari\r\nType: Channel + Group\r\nLink: Telegram Channel Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada channel publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 100000, 9450, 9112.5, 'Aktif', 930, 'BEARPEDIA'),
(5252, 928, 'TikTok - Followers', 'TikTok Followers | Refill 30Day - Max 100K - 20K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 20K/Day\r\nRefill: 30 hari\r\nLink: tiktok.com/@username\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 10, 100000, 16800, 16200, 'Aktif', 928, 'BEARPEDIA'),
(5253, 927, 'TikTok - Download', 'TikTok Video Download | Refill 30Day - Max 20K - 2K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 2K/Day\r\nRefill: 30hari\r\nLink: TikTok Video Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat seiring dengan beban pesanan\r\n- Periksa tautan sebelum melakukan pemesanan', 100, 20000, 1400, 1350, 'Aktif', 927, 'BEARPEDIA'),
(5254, 925, 'Facebook - Reels Short Videos', 'Facebook Reels Short Video [ Shares ] | No Refill - Max 100K - 20K/Day', 'Start Time: 0 - 24hours\r\nSpeed: 20K/Day\r\nRefill: No \r\nLink: Facebook Reels Link\r\n\r\nNote\r\n- Layanan ini tidak berfungsi di \"Facebook Watch Videos\" itu hanya untuk \"Facebook Reels Videos\".', 100, 100000, 11200, 10800, 'Aktif', 925, 'BEARPEDIA'),
(5255, 922, 'Youtube - Likes', 'YouTube Video Likes | No Refill - Max 10K - 1K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 1K/Day\r\nRefill: No\r\nLink: Youtube Video Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada video publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat seiring dengan beban pesanan\r\n- Periksa tautan sebelum melakukan pemesanan\r\n- Pesanan akan dianggap selesai jika jumlah awal turun setelah pesanan dibuat', 10, 10000, 5180, 4995, 'Aktif', 922, 'BEARPEDIA'),
(5256, 921, 'Youtube - Subscribers', 'Youtube Subscribers | Refill 30Day - 0-5% Drop - Max 10K - 200+/Day', 'Channel harus memiliki setidaknya 1-2 video, Don\'t use link channel have : /c/\r\n\r\nStart time: 0 - 72 hours\r\nSpeed: 50 - 200/Day\r\nRefill: 30hari\r\nLink: Youtube Channel Link\r\n\r\n✔️ Layanan ini hanya berfungsi pada channel publik\r\n✔️ Garansi akan dicabut jika jumlah subscriber di-private \r\n️✔️ Garansi akan dicabut jika jumlah awal pesanan turun terus-menerus', 50, 10000, 210000, 202500, 'Aktif', 921, 'BEARPEDIA'),
(5257, 920, 'Twitter - Followers', 'Twitter Followers | No Refill - Max 50K - 10K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 10K/Day\r\nDrop rate: Med / High\r\nRefill: No\r\nLink: Twitter username tanpa \" @ \"\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 100000, 16800, 16200, 'Aktif', 920, 'BEARPEDIA'),
(5258, 917, 'Instagram - Views', 'Instagram Views [ Video + IGTV + Reel ] - Max 10M - 5M/Day', 'Start time: 0 - 24 hours\r\nSpeed: 5M/Day\r\nRefill: No\r\nLink: Instagram Video, IGTV, Reels Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 2147483647, 28, 27, 'Aktif', 917, 'BEARPEDIA'),
(5259, 916, 'TikTok - Views', 'TikTok Views | No Refill - Max 10M - 5M/Day', 'Start time: 0 - 24 hours\r\nSpeed: 5M/Day\r\nRefill: No\r\nLink: TikTok Video Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 3000000, 61.6, 59.4, 'Aktif', 916, 'BEARPEDIA'),
(5260, 903, 'Telegram - Reaction', 'Telegram Mix Positive Reaction [????????????????❤️????????????] + Views - Max 1M - 100K/Day', '', 15, 1000000, 3500, 3375, 'Aktif', 903, 'BEARPEDIA'),
(5261, 902, 'Telegram - Reaction', 'Telegram Mix Negative Reaction [????????????????????????????????] + Views - Max 1M - 100K/Day', '', 15, 1000000, 3500, 3375, 'Aktif', 902, 'BEARPEDIA'),
(5262, 901, 'Telegram - Reaction', 'Telegram Reaction | Start Struck ???? + Views - Non Drop - Max 10K', '', 10, 100000, 952, 918, 'Aktif', 901, 'BEARPEDIA'),
(5263, 900, 'Telegram - Reaction', 'Telegram Reaction | Like ???? + Views - Non Drop - Max 10K', '', 15, 150000, 952, 918, 'Aktif', 900, 'BEARPEDIA'),
(5264, 899, 'Telegram - Reaction', 'Telegram Reaction | Dislike ???? + Views - Non Drop - Max 10K', '', 15, 150000, 952, 918, 'Aktif', 899, 'BEARPEDIA'),
(5265, 898, 'Telegram - Reaction', 'Telegram Reaction | Heart ❤️ + Views - Non Drop - Max 10K', '', 15, 150000, 952, 918, 'Aktif', 898, 'BEARPEDIA'),
(5266, 890, 'Instagram - Profile Visits', 'Instagram Profile Visits + Reach + Ijtressions | No Refill - Max 1M - 50K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 50K/Day\r\nRefill: No\r\nLink: Instagram Profile Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 1000000, 2206.4, 2127.6, 'Aktif', 890, 'BEARPEDIA'),
(5267, 876, 'Twitter - Views', 'Twitter Video Views | No Refill - Max 1M - 100K/Day', '', 100, 10000000, 63, 60.75, 'Aktif', 876, 'BEARPEDIA'),
(5268, 875, 'Twitter - Statistics / Poll / Impressions', 'Twitter Profile Click | No Refill - Max 50M - 1M/Day', '', 100, 50000000, 175, 168.75, 'Aktif', 875, 'BEARPEDIA'),
(5269, 874, 'Twitter - Statistics / Poll / Impressions', 'Twitter Ijtression | No Refill - Max 10M - 100K/Day', '', 100, 10000000, 420, 405, 'Aktif', 874, 'BEARPEDIA'),
(5270, 868, 'TikTok - Followers', 'TikTok Followers | No Refill - Max 200K - 20K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 20K/Day\r\nRefill: No\r\nLink: tiktok.com/@username\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 10, 200000, 17080, 16470, 'Aktif', 868, 'BEARPEDIA'),
(5271, 864, 'Facebook - Comments Likes', 'Facebook Comment Likes [ React ???? ] - Refill 30Day - Max 20K', '✔️ Klik kanan pada tanggal komentar lalu salin tautan dan lakukan pemesanan.\r\n\r\nStart: 0 - 24 Hours\r\nSpeed: 1K / Day\r\nRefill: 30 Days\r\nDrop: Non-Drop, May deviate up to 10%\r\nLink: Facebook comment link\r\nExajtle link: https://www.facebook.com/xyz/posts/123?comment_id=456', 50, 20000, 25200, 24300, 'Aktif', 864, 'BEARPEDIA'),
(5272, 863, 'Facebook - Comments Likes', 'Facebook Comment Likes [ React ❤️ ] - Refill 30Day - Max 20K', '✔️ Klik kanan pada tanggal komentar lalu salin tautan dan lakukan pemesanan.\r\n\r\nStart: 0 - 24 Hours\r\nSpeed: 1K / Day\r\nRefill: 30 Days\r\nDrop: Non-Drop, May deviate up to 10%\r\nLink: Facebook comment link\r\nExajtle link: https://www.facebook.com/xyz/posts/123?comment_id=456', 50, 20000, 25200, 24300, 'Aktif', 863, 'BEARPEDIA'),
(5273, 862, 'Facebook - Comments Likes', 'Facebook Comment Likes [ React ???? ] - Refill 30Day - Max 20K', '✔️ Klik kanan pada tanggal komentar lalu salin tautan dan lakukan pemesanan.\r\n\r\nStart: 0 - 24 Hours\r\nSpeed: 1K / Day\r\nRefill: 30 Days\r\nDrop: Non-Drop, May deviate up to 10%\r\nLink: Facebook comment link\r\nExajtle link: https://www.facebook.com/xyz/posts/123?comment_id=456', 50, 20000, 25200, 24300, 'Aktif', 862, 'BEARPEDIA'),
(5274, 861, 'Facebook - Comments Likes', 'Facebook Comment Likes [ React ???? ] - Refill 30Day - Max 20K', '✔️ Klik kanan pada tanggal komentar lalu salin tautan dan lakukan pemesanan.\r\n\r\nStart: 0 - 24 Hours\r\nSpeed: 1K / Day\r\nRefill: 30 Days\r\nDrop: Non-Drop, May deviate up to 10%\r\nLink: Facebook comment link\r\nExajtle link: https://www.facebook.com/xyz/posts/123?comment_id=456', 50, 20000, 25200, 24300, 'Aktif', 861, 'BEARPEDIA'),
(5275, 860, 'Facebook - Comments Likes', 'Facebook Comment Likes [ React ???? ] - Refill 30Day - Max 20K', '✔️ Klik kanan pada tanggal komentar lalu salin tautan dan lakukan pemesanan.\r\n\r\nStart: 0 - 24 Hours\r\nSpeed: 1K / Day\r\nRefill: 30 Days\r\nDrop: Non-Drop, May deviate up to 10%\r\nLink: Facebook comment link\r\nExajtle link: https://www.facebook.com/xyz/posts/123?comment_id=456', 50, 20000, 25200, 24300, 'Aktif', 860, 'BEARPEDIA'),
(5276, 859, 'Facebook - Comments Likes', 'Facebook Comment Likes [ React ???? ] - Refill 30Day - Max 20K', '✔️ Klik kanan pada tanggal komentar lalu salin tautan dan lakukan pemesanan.\r\n\r\nStart: 0 - 24 Hours\r\nSpeed: 1K / Day\r\nRefill: 30 Days\r\nDrop: Non-Drop, May deviate up to 10%\r\nLink: Facebook comment link\r\nExajtle link: https://www.facebook.com/xyz/posts/123?comment_id=456', 50, 20000, 25200, 24300, 'Aktif', 859, 'BEARPEDIA'),
(5277, 858, 'Facebook - Comments Likes', 'Facebook Comment Likes [ React ???? ] - Refill 30Day - Max 20K', '✔️ Klik kanan pada tanggal komentar lalu salin tautan dan lakukan pemesanan.\r\n\r\nStart: 0 - 24 Hours\r\nSpeed: 1K / Day\r\nRefill: 30 Days\r\nDrop: Non-Drop, May deviate up to 10%\r\nLink: Facebook comment link\r\nExajtle link: https://www.facebook.com/xyz/posts/123?comment_id=456', 50, 20000, 25200, 24300, 'Aktif', 858, 'BEARPEDIA'),
(5278, 856, 'Twitter - Followers', 'Twitter Followers | Refill 30Day - Max 500K - 10K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 10K/Day\r\nRefill: 30 hari\r\nLink: Twitter username tanpa \" @ \"\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 10, 2000000, 19600, 18900, 'Aktif', 856, 'BEARPEDIA'),
(5279, 848, 'Youtube - Likes', 'Youtube Video Likes | Refill 30Day - Non Drop - Max 50K - 10K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 10K/Day\r\nDrop rate: Non Drop\r\nRefill: 30hari\r\nLink: Youtube Video Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada video publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat seiring dengan beban pesanan\r\n- Periksa tautan sebelum melakukan pemesanan\r\n- Pesanan akan dianggap selesai jika jumlah awal turun setelah pesanan dibuat', 100, 50000, 14000, 13500, 'Aktif', 848, 'BEARPEDIA'),
(5280, 847, 'Youtube - Likes', 'Youtube Video Likes | Refill 30Day - Max 100K - 3K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 3K/Day\r\nRefill: 30hari\r\nLink: Youtube Video Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada video publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat seiring dengan beban pesanan\r\n- Periksa tautan sebelum melakukan pemesanan\r\n- Pesanan akan dianggap selesai jika jumlah awal turun setelah pesanan dibuat', 100, 1000000, 13020, 12555, 'Aktif', 847, 'BEARPEDIA'),
(5281, 846, 'YouTube - Views [ Refill ]', 'Youtube Views | Lifetime Refill - Source External - Max 1M - 20K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 20K/Day\r\nSource: External\r\nRefill: Lifetime\r\nLink: Youtube Video Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada channel publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 1000000, 14952, 14418, 'Aktif', 846, 'BEARPEDIA'),
(5282, 845, 'Z[+Private]', 'Youtube Views + 5-10% Likes | Lifetime Refill - Source External + Direct - Max 150K - 5K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 5K/Day\r\nSource: External + Direct\r\nRefill: Lifetime\r\nLink: Youtube Video Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada channel publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 150000, 11200, 10800, 'Aktif', 845, 'BEARPEDIA'),
(5283, 844, 'Z[+Private]', 'Youtube Views | Lifetime Refill - Source Suggested - Max 100K - 2K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 2K/Day\r\nSource: Suggested\r\nRefill: Lifetime\r\nLink: Youtube Video Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada channel publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 1000000, 14546, 14026.5, 'Aktif', 844, 'BEARPEDIA'),
(5284, 843, 'YouTube - Views [ Refill ]', 'Youtube Views | Refill 90Day - Max 20M - 6-8K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 6K - 8K/Day\r\nRefill: 90 hari\r\nLink: Youtube Video Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada channel publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 2147483647, 15400, 14850, 'Aktif', 843, 'BEARPEDIA'),
(5285, 839, 'YouTube - Views [ Refill ]', 'Youtube Views | Refill 60Day - Max 30M - 15K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 15K/Day\r\nRetention: 0 - 60 detik\r\nSource: Suggested\r\nLink: Youtube Video Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada channel publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 200, 2147483647, 16100, 15525, 'Aktif', 839, 'BEARPEDIA'),
(5286, 837, 'Instagram - Story Views', 'Instagram Story Views | No Refill - All Story - Max 100K - 80K/Day', 'All Stories View', 11, 1000000, 84, 81, 'Aktif', 837, 'BEARPEDIA'),
(5287, 827, 'Facebook - Reels Short Videos', 'Facebook Reels Short Video [ Likes ] | Refill 30Day - Max 1M - 10K/Day', 'Start Time: 0 - 24hours\r\nSpeed: 10K/Day\r\nRefill: 30 hari \r\nLink: Facebook Reels Link\r\n\r\nNote\r\n- Layanan ini tidak berfungsi di \"Facebook Watch Videos\" itu hanya untuk \"Facebook Reels Videos\".', 100, 1000000, 10080, 9720, 'Aktif', 827, 'BEARPEDIA'),
(5288, 822, 'Instagram - Likes [ Refill ]', 'Instagram Likes | Refill 30Day - Non Drop - Max 40K - 20K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 20K/Day\r\nDrop rate: Non Drop\r\nRefill: 30 hari\r\nLink: Instagram Post Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 10, 40000, 2100, 2025, 'Aktif', 822, 'BEARPEDIA'),
(5289, 820, 'Instagram - IGTV', 'Instagram IGTV Likes | No Refill - Max 10K - 10K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 10K/Day\r\nRefill: No\r\nLink: Instagram IGTV Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 10000, 1960, 1890, 'Aktif', 820, 'BEARPEDIA'),
(5290, 814, 'Facebook - Post Shares', 'Facebook Post Shares | Refill 30Day - Max 1M - 10K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 10K/Day\r\nRefill: 30 hari\r\nLink: Facebook Post Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 2000, 1000000, 14000, 13500, 'Aktif', 814, 'BEARPEDIA'),
(5291, 813, 'Z[+Private]', 'Facebook Friend Request | AutoRefill 25Day - Max 5K - 500-1K/Day', 'Start time: Slow\r\nSpeed: 500 - 1K/Day\r\nRefill: Auto Refill 25 hari\r\nLink: Facebook Akun Link\r\nExajtle Link: https://www.facebook.com/xx\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 5000, 21000, 20250, 'Aktif', 813, 'BEARPEDIA'),
(5292, 812, 'Instagram - Verified / Centang Biru', 'Instagram Likes [ Dari Akun Verified/Centang Biru ] [ Rp13.000 1 Likes ]', 'Proses 1 - 3 hari. Bila 1 minggu tidak masuk lapor ke admin', 1, 13, 18200000, 17550000, 'Aktif', 812, 'BEARPEDIA'),
(5293, 810, 'TikTok - Comments', 'TikTok Comments | No Refill - Non Drop - 15 Random Comments', 'Pesan 1000 mendapatkan 15 komentar\r\nAnda akan mendapatkan 15 Komentar acak yang Relevan dengan konten video', 1000, 1000, 41300, 39825, 'Aktif', 810, 'BEARPEDIA'),
(5294, 808, 'TikTok - Live Stream', 'Tiktok Live Stream Likes BATTLE ❤️ | No Refill - Max 1M - 100K/Day', 'Link : TikTok Livestream Link', 10, 1000000, 3080, 2970, 'Aktif', 808, 'BEARPEDIA'),
(5295, 805, 'Z[+Private]', 'Facebook Comments Custom | No Refill - Termurah - Max 1M - 50-500/Day', 'Start time: Slow\r\nSpeed: 50 - 500/Day ( bisa lebih cepat/lambat )\r\nQuality: Real\r\nRefill: No refill / no refund\r\nLink: Facebook Post Link\r\nExajtle Link: https://www.facebook.com/xyz/posts/123\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada post publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama', 15, 1000000, 65800, 63450, 'Aktif', 805, 'BEARPEDIA'),
(5296, 797, 'Z[+Private]', 'Facebook Post Shares | No Refill - Max 50K - 10K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 10K/Day\r\nRefill: No\r\nLink: Facebook Post Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 20000, 11200, 10800, 'Aktif', 797, 'BEARPEDIA'),
(5297, 796, 'Facebook - Post Likes', 'Facebook Photo / Post Likes | No Refill - Max 2K - 1K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 1K/Day\r\nRefill: No\r\nLink: Facebook Post/Photo Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 50, 2000, 3220, 3105, 'Aktif', 796, 'BEARPEDIA'),
(5298, 795, 'Facebook - Post Likes', 'Facebook Photo / Post Likes | No Refill - Max 10K - 5K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 5K/Day\r\nRefill: No\r\nLink: Facebook Post/Photo Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 20000, 3920, 3780, 'Aktif', 795, 'BEARPEDIA'),
(5299, 792, 'Instagram - Followers [ No Guaranteed / No Refill ', 'Instagram Followers | No Refill - Max 4K - 2K/Day', 'Start time: 0 - 72 hours\r\nSpeed: 2K/Day\r\nRefill: No refill / no refund\r\nLink: Instagram username tanpa \" @ \"\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan kojtlain setelah memesan layanan ini', 100, 4000, 1680, 1620, 'Aktif', 792, 'BEARPEDIA'),
(5300, 791, 'Instagram - Followers [ No Guaranteed / No Refill ', 'Instagram Followers | No Refill - Max 1K - 1K/Day', 'Start time: 0 - 72 hours\r\nSpeed: 1K/Day\r\nRefill: No refill / no refund\r\nLink: Instagram username tanpa \" @ \"\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan kojtlain setelah memesan layanan ini', 10, 1000, 1232, 1188, 'Aktif', 791, 'BEARPEDIA'),
(5301, 787, 'Instagram - Profile Visits', 'Instagram Profile Visits | No Refill - Max 5M - 1M/Day', 'Start time: 0 - 24 hours\r\nSpeed: 1M/Day\r\nRefill: No\r\nLink: Instagram Profile Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 5000000, 2380, 2295, 'Aktif', 787, 'BEARPEDIA'),
(5302, 782, 'Youtube - Likes', 'YouTube Video Likes | Refill 30Day - Max 50K - 20K/Day', 'Start time: 0 - 24/48 hours\r\nSpeed: 20K/Day\r\nRefill: 30hari\r\nLink: Youtube Video Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada video publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat seiring dengan beban pesanan\r\n- Periksa tautan sebelum melakukan pemesanan\r\n- Pesanan akan dianggap selesai jika jumlah awal turun setelah pesanan dibuat', 10, 50000, 6720, 6480, 'Aktif', 782, 'BEARPEDIA'),
(5303, 781, 'TikTok - Followers', 'TikTok Followers | No Refill - Mix - Max 300K - 10K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 10K/Day\r\nQuality: Mix\r\nRefill: No\r\nLink: tiktok.com/@username\r\n \r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 10, 300000, 15400, 14850, 'Aktif', 781, 'BEARPEDIA'),
(5304, 779, 'Twitter - Retweets', 'Twitter Retweets | No Refill - Max 5K - 1K/Day', 'Start time: 1 - 24 hours\r\nSpeed: 1K/Day\r\nDrop rate: High\r\nRefill: No\r\nLink: Twitter Post Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 20, 10000, 9520, 9180, 'Aktif', 779, 'BEARPEDIA'),
(5305, 778, 'Twitter - Likes', 'Twitter Likes | No Refill - Max 5K - 1K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 1K/Day\r\nDrop rate: High\r\nRefill: No\r\nLink: Twitter Post Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 20, 10000, 9520, 9180, 'Aktif', 778, 'BEARPEDIA'),
(5306, 774, 'Instagram - Likes [ No Refill ]', 'Instagram Likes | No Refill - Non Drop - Max 30K - 30K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 30K/Day\r\nDrop rate: Non Drop ( No Garansi )\r\nRefill: No\r\nLink: Instagram Post Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 20, 30000, 5320, 5130, 'Aktif', 774, 'BEARPEDIA'),
(5307, 768, 'Telegram - Post Shares', 'Telegram Post Shares | No Refill - Max 100K - 10K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 10K/Day\r\nRefill: No\r\nLink: Telegram Post Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada channel publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 10, 100000, 3500, 3375, 'Aktif', 768, 'BEARPEDIA'),
(5308, 767, 'Telegram - Members [Public Channel/Group]', 'Telegram Members | Refill 7Day - Max 100K - 5K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 1K - 5K/Day\r\nRefill: 7 hari\r\nType: Channel + Group\r\nLink: Telegram Channel Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada channel publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 100000, 10780, 10395, 'Aktif', 767, 'BEARPEDIA'),
(5309, 766, 'Telegram - Members [Public Channel/Group]', 'Telegram Members | Refill 3Day - Max 100K - 25K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 25K/Day\r\nRefill: 3 hari\r\nType: Channel + Group\r\nLink: Telegram Channel Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada channel publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 100000, 9520, 9180, 'Aktif', 766, 'BEARPEDIA'),
(5310, 765, 'Telegram - Members [Public Channel/Group]', 'Telegram Members | No Refill - Max 10K - 10K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 1K - 10K/Day\r\nRefill: No\r\nType: Channel + Group\r\nLink: Telegram Channel Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada channel publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 10000, 10500, 10125, 'Aktif', 765, 'BEARPEDIA'),
(5311, 764, 'Telegram - Members [Public Channel/Group]', 'Telegram Members | No Refill - Max 40K - 2K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 4K/Day\r\nRefill: No\r\nType: Channel + Group\r\nLink: Telegram Channel Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada channel publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 40000, 8400, 8100, 'Aktif', 764, 'BEARPEDIA'),
(5312, 763, 'Telegram - Members [Public Channel/Group]', 'Telegram Members | No Refill - Max 100K - 1K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 1K/Day\r\nRefill: No\r\nType: Channel + Group\r\nLink: Telegram Channel Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada channel publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 100000, 9100, 8775, 'Aktif', 763, 'BEARPEDIA'),
(5313, 762, 'Telegram - Members [Public Channel/Group]', 'Telegram Members | No Refill - Max 40K - 5K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 500 - 5K/Day\r\nRefill: No\r\nType: Channel + Group\r\nLink: Telegram Channel Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada channel publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 40000, 18620, 17955, 'Aktif', 762, 'BEARPEDIA'),
(5314, 760, 'TikTok - Comments Custom', 'TikTok Comments Custom | Refill 30Day - Non Drop - Max 10K', 'No Drop & 30 Day Refill Guarantee!\r\nExajtle Link: Tiktok Video Link (All Video Link Acceeptable)', 10, 100000, 123200, 118800, 'Aktif', 760, 'BEARPEDIA'),
(5315, 758, 'Facebook - Reels Short Videos', 'Facebook Reels Short Video [ Likes ] | Refill 30Day - Max 20K - 5K/Day', 'Start Time: 0 - 24hours\r\nSpeed: 5K/Day\r\nRefill: 30 hari\r\nLink: Facebook Reels Link\r\n\r\nNote\r\n- Layanan ini tidak berfungsi di \"Facebook Watch Videos\" itu hanya untuk \"Facebook Reels Videos\".', 100, 20000, 7000, 6750, 'Aktif', 758, 'BEARPEDIA'),
(5316, 754, 'Twitter - Views', 'Twitter Video Views + Ijtression + Profile Click | No Refill - No Drop - Max 10M - 1M/Day', '', 100, 2147483647, 210, 202.5, 'Aktif', 754, 'BEARPEDIA'),
(5317, 753, 'Twitter - Views', 'Twitter Video Views | No Refill - No Drop - Max 5M - 1M/Day', '', 100, 2147483647, 67.2, 64.8, 'Aktif', 753, 'BEARPEDIA'),
(5318, 734, 'Youtube - Community', 'Youtube Community Post Likes | Refill 30Day - Non Drop - Max 100K - 5K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 5K/Day\r\nRefill: 30 hari\r\nLink: YouTube Post Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada channel publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 10, 100000, 37800, 36450, 'Aktif', 734, 'BEARPEDIA'),
(5319, 733, 'Twitter - Statistics / Poll / Impressions', 'Twitter Ijtression | Refill 30Day - Max 5M - 1M/Day', '', 1000, 50000000, 875, 843.75, 'Aktif', 733, 'BEARPEDIA'),
(5320, 732, 'Twitter - Statistics / Poll / Impressions', 'Twitter Ijtression | Refill 45Day - Max 100M - 10M/Day', '', 100, 100000000, 1120, 1080, 'Aktif', 732, 'BEARPEDIA'),
(5321, 728, 'Instagram - Followers [ Guaranteed 15-30 Days ]', 'Instagram Followers | Refill 30Day - Mix - Max 100K - 5K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 5K/Day\r\nQuality: Mix\r\nRefill: 30 hari\r\nLink: Instagram username tanpa \" @ \"\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 20, 100000, 3920, 3780, 'Aktif', 728, 'BEARPEDIA'),
(5322, 723, 'Facebook - Fanspage / Halaman', 'Facebook Fanspage Likes + Followers | Lifetime Refill - Max 1M - 20K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 20K/Day\r\nRefill: Lifetime\r\nLink: Facebook Fanspage Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 1000000, 63000, 60750, 'Aktif', 723, 'BEARPEDIA'),
(5323, 721, 'Facebook - Fanspage / Halaman', 'Facebook Fanspage Likes + Followers | Lifetime Refill - Max 1M - 5K/Day ', 'Start time: 0 - 24 hours\r\nSpeed: 5K/Day\r\nRefill: Lifetime\r\nLink: Facebook Fanspage Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 1000000, 42000, 40500, 'Aktif', 721, 'BEARPEDIA'),
(5324, 718, 'Youtube - Comments', 'Youtube Comments Likes [ UPVOTES ]  - No Refill - Max 100K - 10K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 10K/Day\r\nRefill: No\r\nLink: YouTube Comments Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada channel publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 50, 100000, 25200, 24300, 'Aktif', 718, 'BEARPEDIA'),
(5325, 717, 'Youtube - Comments', 'Youtube Comments Custom - No Refill - Real - Max 2K - 2K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 2K/Day\r\nRefill: No\r\nLink: YouTube Video Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada channel publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 10, 2000, 42000, 40500, 'Aktif', 717, 'BEARPEDIA'),
(5326, 716, 'Instagram - Verified / Centang Biru', 'Instagram Comment Custom [ Dari Akun Verified/Centang Biru ] [ Rp21.000 1 Komen ]', 'Proses 2 - 6 hari, Bila 1 minggu tidak masuk lapor ke admin', 1, 13, 29400000, 28350000, 'Aktif', 716, 'BEARPEDIA'),
(5327, 710, 'Instagram - Comments Custom', 'Instagram Comments Custom | No Refill - Max 1K - 1K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 1K/Day\r\nRefill: No\r\nLink: Instagram Post Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 10, 500, 16800, 16200, 'Aktif', 710, 'BEARPEDIA'),
(5328, 709, 'TikTok - Download', 'TikTok Video Downloads | No Refill - Max 500K - 10K/Day', 'Start time: 0 - 24/72 hours\r\nSpeed: 10K/Day\r\nRefill: No\r\nLink: TikTok Video Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 100000, 490, 472.5, 'Aktif', 709, 'BEARPEDIA'),
(5329, 706, 'YouTube - Views [ Refill ]', 'YouTube Views + Few Likes | Refill 180Day - Max 50M - 60K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 60K/Day\r\nRefill: 180 hari\r\nLink: Youtube Video Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada channel publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 50000000, 22400, 21600, 'Aktif', 706, 'BEARPEDIA'),
(5330, 705, 'YouTube - Views [ Refill ]', 'Youtube Suggested Views + 2% Likes | Refill 30Day - Max 1M - 5K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 5K/Day\r\nRefill: 30 hari\r\nLink: Youtube Video Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada channel publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 200, 1000000, 18480, 17820, 'Aktif', 705, 'BEARPEDIA'),
(5331, 703, 'YouTube - Views [ Refill ]', 'Youtube Views | Refill 30Day - Max 500K - 5K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 5K/Day\r\nSource: Suggested + Direct + 33% Each Browse Features\r\nRefill: 30 hari\r\nLink: Youtube Video Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada channel publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 500000, 18200, 17550, 'Aktif', 703, 'BEARPEDIA'),
(5332, 697, 'Z[+Private]', 'TikTok Followers | No Refill - Max 100K - 5-10K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 5K - 10K/Day\r\nRefill: No\r\nLink: tiktok.com/@username\r\n \r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 100000, 14420, 13905, 'Aktif', 697, 'BEARPEDIA'),
(5333, 689, 'Facebook - Post Reaction', 'Facebook Post Reaction [Love❤️] - Refill 30Day - Max 5K - 2K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 2K/Day\r\nRefill: 30 hari\r\nLink: Facebook Post Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 5000, 11900, 11475, 'Aktif', 689, 'BEARPEDIA'),
(5334, 688, 'Facebook - Post Reaction', 'Facebook Post Reaction [Care????] - Refill 30Day - Max 5K - 2K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 2K/Day\r\nRefill: 30 hari\r\nLink: Facebook Post Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 5000, 11900, 11475, 'Aktif', 688, 'BEARPEDIA'),
(5335, 687, 'Facebook - Post Reaction', 'Facebook Post Reaction [Angry????] - Refill 30Day  - Max 5K - 2K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 2K/Day\r\nRefill: 30 hari\r\nLink: Facebook Post Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 5000, 11900, 11475, 'Aktif', 687, 'BEARPEDIA'),
(5336, 686, 'Facebook - Post Reaction', 'Facebook Post Reaction [Wow????] - Refill 30Day - Max 5K - 2K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 2K/Day\r\nRefill: 30 hari\r\nLink: Facebook Post Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 5000, 11900, 11475, 'Aktif', 686, 'BEARPEDIA'),
(5337, 685, 'Facebook - Post Reaction', 'Facebook Post Reaction [Sad????] - Refill 30Day - Max 5K - 2K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 2K/Day\r\nRefill: 30 hari\r\nLink: Facebook Post Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 5000, 11900, 11475, 'Aktif', 685, 'BEARPEDIA'),
(5338, 684, 'Facebook - Post Reaction', 'Facebook Post Reaction [Haha????] - Refill 30Day - Max 5K - 2K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 2K/Day\r\nRefill: 30 hari\r\nLink: Facebook Post Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 5000, 11900, 11475, 'Aktif', 684, 'BEARPEDIA'),
(5339, 680, 'Telegram - Members [Public Channel/Group]', 'Telegram Members | No Refill - Max 25K - 3K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 3K/Day\r\nRefill: No\r\nType: Channel + Group\r\nLink: Telegram Channel Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada channel publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 25000, 18200, 17550, 'Aktif', 680, 'BEARPEDIA'),
(5340, 678, 'Telegram - Members [Public Channel/Group]', 'Telegram Members | No Refill - Max 10K - 5K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 1K - 5K/Day\r\nRefill: No\r\nType: Channel + Group\r\nLink: Telegram Channel Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada channel publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 10000, 9800, 9450, 'Aktif', 678, 'BEARPEDIA'),
(5341, 676, 'Youtube - Shorts', 'YouTube Shorts Views | Lifetime Refill - Max 5M - 60K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 60K/Day\r\nRefill: Lifetime\r\nLink: YouTube Shorts Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada channel publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 50000000, 18200, 17550, 'Aktif', 676, 'BEARPEDIA'),
(5342, 674, 'Twitter - Likes', 'Twitter Likes | Refill 30Day - Max 10K - 5K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 5K/Day\r\nRefill: 30 hari\r\nLink: Twitter Post Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 10, 10000, 35000, 33750, 'Aktif', 674, 'BEARPEDIA'),
(5343, 672, 'Youtube - Subscribers', 'Youtube Subscribers | Refill 30Day - Non Drop - Best For Monetization Approval', 'Channel harus memiliki setidaknya 1-2 video, Don\'t use link channel have : /c/\r\n\r\nStart time: 0 - 72 hours\r\nSpeed: 100 - 300/Day\r\nRefill: 30hari\r\nLink: Youtube Channel Link\r\n\r\n✔️ Layanan ini hanya berfungsi pada channel publik\r\n✔️ Garansi akan dicabut jika jumlah subscriber di-private \r\n️✔️ Garansi akan dicabut jika jumlah awal pesanan turun terus-menerus', 50, 15000, 252000, 243000, 'Aktif', 672, 'BEARPEDIA'),
(5344, 669, 'Telegram - Reaction', 'Telegram Reaction | Screaming Face ???? + Views - Non Drop - Max 10K', '', 10, 1000000, 952, 918, 'Aktif', 669, 'BEARPEDIA'),
(5345, 668, 'Telegram - Reaction', 'Telegram Reaction | Beaming Face ???? + Views - Non Drop - Max 10K', '', 10, 100000, 952, 918, 'Aktif', 668, 'BEARPEDIA'),
(5346, 667, 'Instagram - Followers [ Guaranteed 90-365 Days ]', 'Instagram Followers | Refill 365Day - Max 1M - 20K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 20K/Day\r\nDrop rate: Tidak stabil\r\nRefill: 365 hari\r\nLink: Instagram username tanpa \" @ \"\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 50, 1000000, 4200, 4050, 'Aktif', 667, 'BEARPEDIA'),
(5347, 665, 'Telegram - Reaction', 'Telegram Reaction | Crying Face ???? + Views - Non Drop - Max 10K', 'Start Time:  0 - 24 hours\r\nSpeed: 5K/Day\r\nRefill: No\r\nLink: Telegram Post Link\r\n\r\nCATATAN: Jika tidak ada reaksi yang ditambahkan, berarti channel tersebut telah menonaktifkan emoji ????. Pengembalian dana tidak dilakukan dalam kasus ini. Cek ketersediaan sebelum memesan', 10, 1000000, 952, 918, 'Aktif', 665, 'BEARPEDIA'),
(5348, 664, 'Telegram - Reaction', 'Telegram Reaction | Pile of Poo ???? + Views - Non Drop - Max 10K', 'Start Time:  0 - 24 hours\r\nSpeed: 5K/Day\r\nRefill: No\r\nLink: Telegram Post Link\r\n\r\nCATATAN: Jika tidak ada reaksi yang ditambahkan, berarti channel tersebut telah menonaktifkan emoji ????. Pengembalian dana tidak dilakukan dalam kasus ini. Cek ketersediaan sebelum memesan', 10, 1000000, 952, 918, 'Aktif', 664, 'BEARPEDIA'),
(5349, 663, 'Telegram - Reaction', 'Telegram Reaction | Face Vomiting ???? + Views - Non Drop - Max 10K', 'Start Time:  0 - 24 hours \r\nSpeed: 5K/Day\r\nRefill: No\r\nLink: Telegram Post Link\r\n\r\nCATATAN: Jika tidak ada reaksi yang ditambahkan, berarti channel tersebut telah menonaktifkan emoji ????. Pengembalian dana tidak dilakukan dalam kasus ini. Cek ketersediaan sebelum memesan', 10, 1000000, 952, 918, 'Aktif', 663, 'BEARPEDIA'),
(5350, 662, 'Telegram - Reaction', 'Telegram Reaction | Fire ???? + Views - Non Drop - Max 10K', 'Start Time:  0 - 24 hours\r\nSpeed: 5K/Day\r\nRefill: No\r\nLink: Telegram Post Link\r\n\r\nCATATAN: Jika tidak ada reaksi yang ditambahkan, berarti channel tersebut telah menonaktifkan emoji ????. Pengembalian dana tidak dilakukan dalam kasus ini. Cek ketersediaan sebelum memesan', 15, 150000, 952, 918, 'Aktif', 662, 'BEARPEDIA'),
(5351, 661, 'Telegram - Reaction', 'Telegram Reaction | Party Popper ???? + Views - Non Drop - Max 10K', 'Start Time: 0 - 24 hours\r\nSpeed: 5K/Day\r\nRefill: No\r\nLink: Telegram Post Link\r\n\r\nCATATAN: Jika tidak ada reaksi yang ditambahkan, berarti channel tersebut telah menonaktifkan emoji ????. Pengembalian dana tidak dilakukan dalam kasus ini. Cek ketersediaan sebelum memesan', 10, 100000, 952, 918, 'Aktif', 661, 'BEARPEDIA'),
(5352, 648, 'Youtube - Subscribers', 'Youtube Subscribers | No Refill - Max 50K - 5K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 5K/Day\r\nDrop rate: 50 - 100%\r\nRefill: No refill / no refund\r\nLink: YouTube Channel Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada channel publik\r\n- Tidak ada pengembalian dana / tidak ada garansi apapun\r\n- Jangan kojtlain setelah memesan layanan ini', 10, 50000, 7000, 6750, 'Aktif', 648, 'BEARPEDIA');
INSERT INTO `layanan` (`id`, `service_id`, `kategori`, `layanan`, `catatan`, `min`, `max`, `harga`, `harga_api`, `status`, `provider_id`, `provider`) VALUES
(5353, 647, 'TikTok - Live Stream', 'TikTok Live Stream Likes BATTLE ❤️ | No Refill - Max 1M - 100K/Day', 'Link : TikTok Livestream Link', 5, 1000000, 2520, 2430, 'Aktif', 647, 'BEARPEDIA'),
(5354, 646, 'TikTok - Live Stream', 'TikTok Live Stream Shares | No Refill - Bots - Max 1M - 10K/Day', 'Link : TikTok Livestream Link\r\n', 10, 1000000, 11900, 11475, 'Aktif', 646, 'BEARPEDIA'),
(5355, 643, 'Instagram - Followers [ Guaranteed 90-365 Days ]', 'Instagram Followers | Refill 180Day - Max 500K - 50K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 10K - 50K/Day\r\nRefill: 180 hari\r\nLink: Instagram username tanpa \" @ \"\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 20, 500000, 5600, 5400, 'Aktif', 643, 'BEARPEDIA'),
(5356, 642, 'Instagram - Story Views', 'Instagram Story Views | No Refill - All Story - Max 1M - 100K/Day', 'Link: Username\r\nAll Story', 20, 1000000, 77, 74.25, 'Aktif', 642, 'BEARPEDIA'),
(5357, 641, 'Instagram - Story Views', 'Instagram Story Views | No Refill - All Story - Max 50K - 5K/Day', 'Link: username \r\nijtortant: All Stories\r\nuser photo: http://prntscr.com/11o0luq\r\n* Tidak ada garansi apapun / no refund', 20, 50000, 63, 60.75, 'Aktif', 641, 'BEARPEDIA'),
(5358, 630, 'TikTok - Saves', 'TikTok Saves | Refill 30Day - Max 20K - 20K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 20K/Day\r\nRefill: 30 hari\r\nLink: TikTok Video Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 20000, 3700.2, 3568.05, 'Aktif', 630, 'BEARPEDIA'),
(5359, 629, 'Twitch - Channel Views', 'Twitch Channel Views', '-', 100, 100000000, 14000, 13500, 'Aktif', 629, 'BEARPEDIA'),
(5360, 628, 'Twitch - Followers', 'Twitch Followers [Non Drop] No Refill', 'Start: 0 - 2 Hours\r\nSpeed: 500 - 2K / Day\r\nQuality: Mixed\r\nRefill: No\r\nLink: Insert full twitch profile link\r\nExajtle link: https://www.twitch.tv/xyz\r\n\r\n✔️ This service works only on public profile', 100, 100000, 4900, 4725, 'Aktif', 628, 'BEARPEDIA'),
(5361, 627, 'Twitch - Followers', 'Twitch Followers [HQ] [Non Drop] R30', 'Start: 0 - 1 Hours\r\nSpeed: 5K - 10K / Day\r\nQuality: Real\r\nRefill: 30 Days\r\nLink: Insert full twitch profile link\r\nExajtle link: https://www.twitch.tv/xyz\r\n\r\n✔️ This service works only on public profile', 100, 75000, 3500, 3375, 'Aktif', 627, 'BEARPEDIA'),
(5362, 625, 'Z[+Private]', 'Facebook Fanspage Likes + Followers | No Refill - Max 100K - 200-500/Day', 'Start time: 0 - 24/72 hours ( Slow )\r\nSpeed: 200 - 500/Day\r\nRefill: No\r\nLink: Facebook Fanspage Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Tidak ada pengembalian dana bila mengganti username/tautan/menonaktifkan akun', 200, 100000, 9800, 9450, 'Aktif', 625, 'BEARPEDIA'),
(5363, 623, 'TikTok - Comments', 'TikTok Comments | No Refill - Non Drop - 12 Random Comments', 'Pesan 1000 mendapatkan 12 komentar\r\nAnda akan mendapatkan 12 Komentar acak yang Relevan dengan konten video', 1000, 1000, 25620, 24705, 'Aktif', 623, 'BEARPEDIA'),
(5364, 622, 'TikTok - Comments', 'TikTok Comments | No Refill - Non Drop - 9 Random Comments', 'Pesan 1000 mendapatkan 9 komentar\r\nAnda akan mendapatkan 9 Komentar acak yang Relevan dengan konten video', 1000, 1000, 18760, 18090, 'Aktif', 622, 'BEARPEDIA'),
(5365, 621, 'TikTok - Comments', 'TikTok Comments | No Refill - Non Drop - 6 Random Comments', 'Pesan 1000 mendapatkan 6 komentar\r\nAnda akan mendapatkan 6 Komentar acak yang Relevan dengan konten video', 1000, 1000, 7420, 7155, 'Aktif', 621, 'BEARPEDIA'),
(5366, 620, 'TikTok - Comments', 'TikTok Comments | No Refill - Non Drop - 3 Random Comments', 'Pesan 1000 mendapatkan 3 komentar\r\nAnda akan mendapatkan 3 Komentar acak yang Relevan dengan konten video', 1000, 1000, 4480, 4320, 'Aktif', 620, 'BEARPEDIA'),
(5367, 619, 'Instagram - Comments', 'Instagram Comments | 5 Random Comments from 1M+ Followers Accounts', 'Pesan 1000 mendapatkan 5 komentar', 1000, 1000, 16800, 16200, 'Aktif', 619, 'BEARPEDIA'),
(5368, 618, 'Instagram - Comments', 'Instagram Comments | 5 Random Comments from 500K+ Followers Accounts', 'Pesan 1000 mendapatkan 5 komentar', 1000, 1000, 14000, 13500, 'Aktif', 618, 'BEARPEDIA'),
(5369, 617, 'Instagram - Comments', 'Instagram Comments | 5 Random Comments from 200K+ Followers Accounts', 'Pesan 1000 mendapatkan 5 komentar', 1000, 1000, 10920, 10530, 'Aktif', 617, 'BEARPEDIA'),
(5370, 616, 'Instagram - Comments', 'Instagram Comments | 5 Random Comments from 30K+ Followers Accounts', 'Pesan 1000 mendapatkan 5 komentar', 1000, 1000, 7700, 7425, 'Aktif', 616, 'BEARPEDIA'),
(5371, 615, 'Instagram - Comments', 'Instagram Comments | 5 Random Comments from 10K+ Followers Accounts', 'Pesan 1000 mendapatkan 5 komentar', 1000, 3000, 5600, 5400, 'Aktif', 615, 'BEARPEDIA'),
(5372, 609, 'Facebook - Post Likes', 'Facebook Photo / Post Likes | No Refill - Max 40K - 10K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 10K/Day\r\nRefill: No\r\nLink: Facebook Post/Photo Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 40000, 4480, 4320, 'Aktif', 609, 'BEARPEDIA'),
(5373, 607, 'Instagram - Views', 'Instagram Views [ Video + IGTV + Reel ] - Max 100M - 1M/Day', 'Start time: 0 - 24 hours\r\nSpeed: 1M/Day\r\nRefill: No\r\nLink: Instagram Video, IGTV, Reels Link\r\n \r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 100000000, 25.2, 24.3, 'Aktif', 607, 'BEARPEDIA'),
(5374, 604, 'Youtube - Views [ Untuk Monetisasi - Penghasil dui', 'Youtube Views Untuk Penambah Adsense [ 2$ - 4$ ]', '- Durasi Video : 6 - 10 menit+\r\n- Pendapatan bergantung pada berbagai faktor seperti kata kunci, panjang, topik, dan lokasi, dll.\r\n- Kami Tidak Menjamin Berapa Banyak Pendapatan yang Akan Anda Dapatkan? (tetapi $2 - 4 diperkirakan untuk 1000 view)\r\n- Garansi: Tidak ada garansi\r\n\r\nNOTE: kami tidak menjamin untuk pendapatan akan dapat terus, lebih baik untuk mencoba pesan 200 saja dulu untuk mencobanya', 200, 1000000, 50400, 48600, 'Aktif', 604, 'BEARPEDIA'),
(5375, 602, 'YouTube - Shares Indonesia', 'YouTube Share Indonesia [ from Blogger ] | Refill 365Day - Max 10K - 300/Day', 'Start time: -\r\nSpeed: 300/Day\r\nRefill: 365 hari\r\nLink: YouTube Video Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada channel publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 10000, 30800, 29700, 'Aktif', 602, 'BEARPEDIA'),
(5376, 601, 'YouTube - Shares Indonesia', 'YouTube Share Indonesia [ from Tumblr ] | Refill 365Day - Max 10K - 300/Day', 'Start time: -\r\nSpeed: 300/Day\r\nRefill: 365 hari\r\nLink: YouTube Video Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada channel publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 10000, 30800, 29700, 'Aktif', 601, 'BEARPEDIA'),
(5377, 600, 'YouTube - Shares Indonesia', 'YouTube Share Indonesia [ from Pinterest ] | Refill 365Day - Max 10K - 300/Day', 'Start time: -\r\nSpeed: 300/Day\r\nRefill: 365 hari\r\nLink: YouTube Video Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada channel publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 10000, 30800, 29700, 'Aktif', 600, 'BEARPEDIA'),
(5378, 599, 'YouTube - Shares Indonesia', 'YouTube Share Indonesia [ from Reddit ] | Refill 365Day - Max 10K - 300/Day', 'Start time: -\r\nSpeed: 300/Day\r\nRefill: 365 hari\r\nLink: YouTube Video Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada channel publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 10000, 30800, 29700, 'Aktif', 599, 'BEARPEDIA'),
(5379, 598, 'YouTube - Shares Indonesia', 'YouTube Share Indonesia [ from Twitter ] | Refill 365Day - Max 10K - 300/Day', 'Start time: -\r\nSpeed: 300/Day\r\nRefill: 365 hari\r\nLink: YouTube Video Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada channel publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 10000, 30800, 29700, 'Aktif', 598, 'BEARPEDIA'),
(5380, 597, 'YouTube - Shares Indonesia', 'YouTube Shares Indonesia [ from Facebook ] | Refill 365Day - Max 10K - 300/Day', 'Start time: -\r\nSpeed: 300/Day\r\nRefill: 365 hari\r\nLink: YouTube Video Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada channel publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 10000, 30800, 29700, 'Aktif', 597, 'BEARPEDIA'),
(5381, 585, 'Facebook - Story Views', 'Facebook Story Views | Lifetime Refill - Non Drop - Max 2K - 2K/Day', 'Start time: 0 - 3 hours\r\nSpeed: 2K/Day\r\nRefill: Lifetime\r\nLink: Facebook Story Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 50, 2000, 8400, 8100, 'Aktif', 585, 'BEARPEDIA'),
(5382, 584, 'Facebook - Reels Short Videos', 'Facebook Reels Short Video [ Likes ] | No Refill - Max 2K - 2K/Day', 'Start Time: 0 - 24hours\r\nSpeed: 2K/Day\r\nRefill: No \r\nLink: Facebook Reels Link\r\n\r\nNote\r\n- Layanan ini tidak berfungsi di \"Facebook Watch Videos\" itu hanya untuk \"Facebook Reels Videos\".', 100, 2000, 3780, 3645, 'Aktif', 584, 'BEARPEDIA'),
(5383, 578, 'YouTube - Live Stream Views Server 1', 'Youtube Live Stream Views [ 180 Minutes ]', 'Order 1000 Views - Get 100 Concurrent Stable Viewers\r\nOrder 2000 Views - Get 200 Concurrent Stable Viewers\r\nOrder 3000 Views - Get 300 Concurrent Stable Viewers', 1000, 4000, 15400, 14850, 'Aktif', 578, 'BEARPEDIA'),
(5384, 577, 'YouTube - Live Stream Views Server 1', 'Youtube Live Stream Views [ 150 Minutes ]', 'Order 1000 Views - Get 100 Concurrent Stable Viewers\r\nOrder 2000 Views - Get 200 Concurrent Stable Viewers\r\nOrder 3000 Views - Get 300 Concurrent Stable Viewers', 1000, 4000, 12320, 11880, 'Aktif', 577, 'BEARPEDIA'),
(5385, 576, 'YouTube - Live Stream Views Server 1', 'Youtube Live Stream Views [ 120 Minutes ]', 'Order 1000 Views - Get 100 Concurrent Stable Viewers\r\nOrder 2000 Views - Get 200 Concurrent Stable Viewers\r\nOrder 3000 Views - Get 300 Concurrent Stable Viewers', 1000, 4000, 9380, 9045, 'Aktif', 576, 'BEARPEDIA'),
(5386, 575, 'YouTube - Live Stream Views Server 1', 'Youtube Live Stream Views [ 90 Minutes ]', 'Order 1000 Views - Get 100 Concurrent Stable Viewers\r\nOrder 2000 Views - Get 200 Concurrent Stable Viewers\r\nOrder 3000 Views - Get 300 Concurrent Stable Viewers', 1000, 4000, 6300, 6075, 'Aktif', 575, 'BEARPEDIA'),
(5387, 574, 'YouTube - Live Stream Views Server 1', 'Youtube Live Stream Views [ 60 Minutes ]', 'Order 1000 Views - Get 100 Concurrent Stable Viewers\r\nOrder 2000 Views - Get 200 Concurrent Stable Viewers\r\nOrder 3000 Views - Get 300 Concurrent Stable Viewers', 1000, 4000, 4900, 4725, 'Aktif', 574, 'BEARPEDIA'),
(5388, 573, 'YouTube - Live Stream Views Server 1', 'Youtube Live Stream Views [ 30 Minutes ]', 'Order 1000 Views - Get 100 Concurrent Stable Viewers\r\nOrder 2000 Views - Get 200 Concurrent Stable Viewers\r\nOrder 3000 Views - Get 300 Concurrent Stable Viewers', 1000, 4000, 3220, 3105, 'Aktif', 573, 'BEARPEDIA'),
(5389, 567, 'TikTok - Followers', 'TikTok Followers | No Refill - Max 500K - 15K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 15K/Day\r\nRefill: No\r\nLink: tiktok.com/@username\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 10, 500000, 14700, 14175, 'Aktif', 567, 'BEARPEDIA'),
(5390, 566, 'TikTok - Verified / Centang Biru', 'TikTok Comments Random [ Dari Akun Verified/Centang Biru ]', 'Proses 2 - 7 hari\r\nJumlah isi 1000 maka anda akan mendapatkan 1 komentar random\r\n* Layanan ini artinya video anda akan di komentari oleh akun yang sudah terverifikasi atau centang biru', 1000, 1000, 21000, 20250, 'Aktif', 566, 'BEARPEDIA'),
(5391, 549, 'Z[+Private]', 'Facebook Friend Request | Refill 45Day - Max 1M - 3K/day [ Slow ]', 'Start time: Slow\r\nSpeed: 1K - 3K/Day\r\nRefill: 45 hari\r\nLink: Facebook Akun Link\r\nExajtle Link: https://www.facebook.com/xx\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 1000, 1000000, 14000, 13500, 'Aktif', 549, 'BEARPEDIA'),
(5392, 548, 'Z[+Private]', 'Facebook Friend Request | Refill 30Day - Max 1M - 1K/day [ Slow ]', 'Start time: Slow\r\nSpeed: 1K/Day\r\nRefill: 30 hari\r\nLink: Facebook Akun Link\r\nExajtle Link: https://www.facebook.com/xx\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 1000, 1000000, 10360, 9990, 'Aktif', 548, 'BEARPEDIA'),
(5393, 542, 'TikTok - Views Indonesia', 'TikTok Views Indonesia | No Refill - Max 50M - 100K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 100K/Day\r\nRefill: No\r\nLink: TikTok Video Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 50000000, 238, 229.5, 'Aktif', 542, 'BEARPEDIA'),
(5394, 541, 'Z[+Private]', 'YouTube Video Likes | Refill 30Day - Non Drop - Max 100K - 10K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 10K/Day\r\nDrop rate: Non Drop\r\nRefill: 30hari\r\nLink: Youtube Video Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada video publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat seiring dengan beban pesanan\r\n- Periksa tautan sebelum melakukan pemesanan\r\n- Pesanan akan dianggap selesai jika jumlah awal turun setelah pesanan dibuat', 10, 100000, 11200, 10800, 'Aktif', 541, 'BEARPEDIA'),
(5395, 539, 'Youtube - Views [ Untuk Monetisasi - Penghasil dui', 'Youtube Views Untuk Penambah Adsense [ 3$ - 6$ ]', '- Durasi Video : 10 - 15 menit+\r\n- Pendapatan bergantung pada berbagai faktor seperti kata kunci, panjang, topik, dan lokasi, dll.\r\n- Kami Tidak Menjamin Berapa Banyak Pendapatan yang Akan Anda Dapatkan? (tetapi $3 - 6 diperkirakan untuk 1000 view)\r\n- Garansi: Tidak ada garansi\r\n\r\nNOTE: kami tidak menjamin untuk pendapatan akan dapat terus, lebih baik untuk mencoba pesan 100 saja dlu untuk mencobanya', 1000, 1000, 46200, 44550, 'Aktif', 539, 'BEARPEDIA'),
(5396, 538, 'Facebook - Post Shares', 'Facebook Post Shares | No Refill - Max 1M - 5-10K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 5K - 10K/Day\r\nRefill: No\r\nLink: Facebook Post Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 2000, 1000000, 11620, 11205, 'Aktif', 538, 'BEARPEDIA'),
(5397, 533, 'Z[+Private]', 'Youtube Jam Tayang [ +60 Menit ] | Refill 30Day - Max 50K - 1000Hours/Day', '- Gunakan video lebih dari 60 menit untuk mendapatkan efek terbaik.\r\n- Waktu tonton: 60+ menit\r\n- Jika Anda menggunakan Durasi Video 60+ Menit\r\n- 1000 Views = 1000+ jam tayang\r\n- Guarantee: 30 days Refill\r\n- Speed : 1000 Hours / Day\r\n- Source: Suggested', 100, 50000, 88200, 85050, 'Aktif', 533, 'BEARPEDIA'),
(5398, 532, 'Z[+Private]', 'Youtube Jam Tayang [ +45 Menit ] | Refill 30Day - Max 50K - 1000Hours/Day', '- Gunakan video lebih dari 45 menit untuk mendapatkan efek terbaik.\r\n- Waktu tonton: 45+ menit\r\n- Jika Anda menggunakan Durasi Video 45+ Menit\r\n- 1000 Views = 750+ jam tayang\r\n- Guarantee: 30 days Refill\r\n- Speed : 1000 Hours / Day\r\n- Source: Suggested', 100, 50000, 77000, 74250, 'Aktif', 532, 'BEARPEDIA'),
(5399, 531, 'Z[+Private]', 'Youtube Jam Tayang [ +30 Menit ] | Refill 30Day - Max 50K - 1000Hours/Day', '- Gunakan video lebih dari 30 menit untuk mendapatkan efek terbaik.\r\n- Waktu tonton: 30+ menit\r\n- Jika Anda menggunakan Durasi Video 30+ Menit\r\n- 1000 Views = 500+ jam tayang\r\n- Guarantee: 30 days Refill\r\n- Speed : 1000 Hours / Day\r\n- Source: Suggested', 100, 50000, 61600, 59400, 'Aktif', 531, 'BEARPEDIA'),
(5400, 530, 'Z[+Private]', 'Youtube Jam Tayang [ +15 Menit ] | Refill 30Day - Max 50K - 1000Hours/Day', '- Gunakan video lebih dari 15 menit untuk mendapatkan efek terbaik.\r\n- Waktu tonton: 15+ menit\r\n- Jika Anda menggunakan Durasi Video 15+ Menit\r\n- 1000 Views = 250+ jam tayang\r\n- Guarantee: 30 days Refill\r\n- Speed : 1000 Hours / Day\r\n- Source: Suggested', 100, 50000, 30800, 29700, 'Aktif', 530, 'BEARPEDIA'),
(5401, 528, 'Instagram - Followers [ Guaranteed 90-365 Days ]', 'Instagram Followers | Refill 90Day - Max 1M - 30-50K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 30K - 50K/Day\r\nDrop rate: Bisa tinggi\r\nRefill: 90 hari\r\nLink: Instagram username tanpa \" @ \"\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 20, 1000000, 6223, 6000.75, 'Aktif', 528, 'BEARPEDIA'),
(5402, 527, 'Instagram - Followers [ Guaranteed 90-365 Days ]', 'Instagram Followers | Refill 365Day - Real - Max 3M - 40K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 40K/Day\r\nQuality: Real\r\nRefill: 366 hari\r\nLink: Instagram username tanpa \" @ \"\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 20, 3000000, 5180, 4995, 'Aktif', 527, 'BEARPEDIA'),
(5403, 526, 'Facebook - Group Members', 'Facebook Group Members | No Refill - Max 40K - 1-3K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 1K - 3K/Day\r\nRefill: No\r\nLink: Facebook Group Link\r\n \r\nNote\r\n- Pada bagian admin support, biarkan default seperti aslinya.\r\n- Di bagian pengaturan grup, minta nonaktifkan persetujuan peserta untuk bergabung dengan grup.', 1000, 40000, 9660, 9315, 'Aktif', 526, 'BEARPEDIA'),
(5404, 522, 'Instagram - Impressions', 'Instagram Ijtressions | No Refill - Max 1M - 100K/Day', '', 100, 1000000, 1050, 1012.5, 'Aktif', 522, 'BEARPEDIA'),
(5405, 520, 'Instagram - Saves', 'Instagram Saves | No Refill - Max 10M - 100K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 100K/Day\r\nRefill: Nl\r\nLink: Instagram Post Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 10000000, 42, 40.5, 'Aktif', 520, 'BEARPEDIA'),
(5406, 518, 'Facebook - Live Stream Views Server 1', 'Facebook Live Stream Views [ Watchtime 180 Minutes ] - Cheapest - No Refill', '- Server Termurah. Sering sesak saat jam sibuk.\r\n- Kuantitas akan mejtertahankan 60% -120%\r\n- Jika pesanan Anda tidak terkirim, harap melakukan pemesanan di server lain. Pesanan yang tidak terkirim akan di refund', 50, 2000, 189792.4, 183014.1, 'Aktif', 518, 'BEARPEDIA'),
(5407, 517, 'Facebook - Live Stream Views Server 1', 'Facebook Live Stream Views [ Watchtime 150 Minutes ] - Cheapest - No Refill', ' - Server Termurah. Sering sesak saat jam sibuk.\r\n- Kuantitas akan mejtertahankan 60% -120%\r\n- Jika pesanan Anda tidak terkirim, harap melakukan pemesanan di server lain. Pesanan yang tidak terkirim akan di refund', 50, 2000, 158200, 152550, 'Aktif', 517, 'BEARPEDIA'),
(5408, 516, 'Facebook - Live Stream Views Server 1', 'Facebook Live Stream Views [ Watchtime 120 Minutes ] - Cheapest - No Refill', '- Server Termurah. Sering sesak saat jam sibuk.\r\n- Kuantitas akan mejtertahankan 60% -120%\r\n- Jika pesanan Anda tidak terkirim, harap melakukan pemesanan di server lain. Pesanan yang tidak terkirim akan di refund', 50, 2000, 121800, 117450, 'Aktif', 516, 'BEARPEDIA'),
(5409, 515, 'Facebook - Live Stream Views Server 1', 'Facebook Live Stream Views [ Watchtime 90 Minutes ] - Cheapest - No Refill', '- Server Termurah. Sering sesak saat jam sibuk.\r\n- Kuantitas akan mejtertahankan 60% -120%\r\n- Jika pesanan Anda tidak terkirim, harap melakukan pemesanan di server lain. Pesanan yang tidak terkirim akan di refund', 50, 2000, 89600, 86400, 'Aktif', 515, 'BEARPEDIA'),
(5410, 514, 'Facebook - Live Stream Views Server 1', 'Facebook Live Stream Views [ Watchtime 60 Minutes ] - Cheapest - No Refill', '- Server Termurah. Sering sesak saat jam sibuk.\r\n- Kuantitas akan mejtertahankan 60% -120%\r\n- Jika pesanan Anda tidak terkirim, harap melakukan pemesanan di server lain. Pesanan yang tidak terkirim akan di refund', 50, 2000, 54600, 52650, 'Aktif', 514, 'BEARPEDIA'),
(5411, 513, 'Facebook - Live Stream Views Server 1', 'Facebook Live Stream Views [ Watchtime 30 Minutes ] - Cheapest - No Refill', '- Server Termurah. Sering sesak saat jam sibuk.\r\n- Kuantitas akan mejtertahankan 60% -120%\r\n- Jika pesanan Anda tidak terkirim, harap melakukan pemesanan di server lain. Pesanan yang tidak terkirim akan di refund', 50, 2000, 22400, 21600, 'Aktif', 513, 'BEARPEDIA'),
(5412, 512, 'Youtube - Shorts', 'YouTube Shorts Likes | Refill 30Day - Max 300K - 50K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 50K/Day\r\nRefill: 30 hari\r\nLink: YouTube Shorts Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada channel publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 10, 300000, 11620, 11205, 'Aktif', 512, 'BEARPEDIA'),
(5413, 511, 'Youtube - Shorts', 'YouTube Shorts Likes | No Refill - Max 300K - 50K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 50K/Day\r\nRefill: No\r\nLink: YouTube Shorts Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada channel publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 10, 300000, 6790, 6547.5, 'Aktif', 511, 'BEARPEDIA'),
(5414, 510, 'YouTube - Shares [ Social Media ]', 'YouTube Social Shares [ from Facebook ] | Lifetime Refill - Max 10K - 300+/Day', 'WorldWide Social Shares from Facebook \r\n\r\nUnique & Natural SEO for your Video\r\nHelp with Ranking\r\nSafe for use! NO SPAM / BOTS methods\r\n\r\nYouTube Analytics Reports will be updated in 48-72h with your Shares Results', 100, 10000, 25200, 24300, 'Aktif', 510, 'BEARPEDIA'),
(5415, 509, 'YouTube - Shares [ Social Media ]', 'YouTube Social Shares [ from Twitter ] | Lifetime Refill - Max 10K - 300+/Day', 'WorldWide Social Shares from Twitter \r\n\r\nUnique & Natural SEO for your Video\r\nHelp with Ranking\r\nSafe for use! NO SPAM / BOTS methods\r\n\r\nYouTube Analytics Reports will be updated in 48-72h with your Shares Results', 100, 10000, 25200, 24300, 'Aktif', 509, 'BEARPEDIA'),
(5416, 508, 'YouTube - Shares [ Social Media ]', 'YouTube Social Shares [ from Reddit ] | Lifetime Refill - Max 10K - 300+/Day', 'WorldWide Social Shares from Reddit\r\n\r\nUnique & Natural SEO for your Video\r\nHelp with Ranking\r\nSafe for use! NO SPAM / BOTS methods\r\n\r\nYouTube Analytics Reports will be updated in 48-72h with your Shares Results', 100, 10000, 25200, 24300, 'Aktif', 508, 'BEARPEDIA'),
(5417, 507, 'YouTube - Shares [ Social Media ]', 'YouTube Social Shares [ from Pinterest ] | Lifetime Refill - Max 10K - 300+/Day', 'WorldWide Social Shares from Pinterest \r\n\r\nUnique & Natural SEO for your Video\r\nHelp with Ranking\r\nSafe for use! NO SPAM / BOTS methods\r\n\r\nYouTube Analytics Reports will be updated in 48-72h with your Shares Results', 100, 10000, 25200, 24300, 'Aktif', 507, 'BEARPEDIA'),
(5418, 506, 'YouTube - Shares [ Social Media ]', 'YouTube Social Shares [ from Linkedin ] | Lifetime Refill - Max 10K - 300+/Day', 'WorldWide Social Shares from Linkedin\r\n\r\nUnique & Natural SEO for your Video\r\nHelp with Ranking\r\nSafe for use! NO SPAM / BOTS methods\r\n\r\nYouTube Analytics Reports will be updated in 48-72h with your Shares Results', 100, 10000, 25200, 24300, 'Aktif', 506, 'BEARPEDIA'),
(5419, 505, 'YouTube - Shares [ Social Media ]', 'YouTube Social Shares [ from Odnoklassniki ] | Lifetime Refill - Max 10K - 300+/Day', 'WorldWide Social Shares from Odnoklassniki\r\n\r\nUnique & Natural SEO for your Video\r\nHelp with Ranking\r\nSafe for use! NO SPAM / BOTS methods\r\n\r\nYouTube Analytics Reports will be updated in 48-72h with your Shares Results', 100, 10000, 25200, 24300, 'Aktif', 505, 'BEARPEDIA'),
(5420, 504, 'YouTube - Shares [ Social Media ]', 'YouTube Social Shares [ from Tumblr ] | Lifetime Refill - Max 10K - 300+/Day', 'WorldWide Social Shares from Tumblr\r\n\r\nUnique & Natural SEO for your Video\r\nHelp with Ranking\r\nSafe for use! NO SPAM / BOTS methods\r\n\r\nYouTube Analytics Reports will be updated in 48-72h with your Shares Results', 100, 10000, 25200, 24300, 'Aktif', 504, 'BEARPEDIA'),
(5421, 503, 'YouTube - Shares [ Social Media ]', 'YouTube Social Shares [ from Blogger ] | Lifetime Refill - Max 10K - 300+/Day', 'WorldWide Social Shares from Blogger\r\n\r\nUnique & Natural SEO for your Video\r\nHelp with Ranking\r\nSafe for use! NO SPAM / BOTS methods\r\n\r\nYouTube Analytics Reports will be updated in 48-72h with your Shares Results', 100, 10000, 25200, 24300, 'Aktif', 503, 'BEARPEDIA'),
(5422, 502, 'YouTube - Shares [ Social Media ]', 'YouTube Social Shares [ from Vkontakte ] | Lifetime Refill - Max 10K - 300+/Day', 'WorldWide Social Shares from Vkontakte\r\n\r\nUnique & Natural SEO for your Video\r\nHelp with Ranking\r\nSafe for use! NO SPAM / BOTS methods\r\n\r\nYouTube Analytics Reports will be updated in 48-72h with your Shares Results', 100, 10000, 25200, 24300, 'Aktif', 502, 'BEARPEDIA'),
(5423, 501, 'YouTube - Shares [ Social Media ]', 'YouTube Social Shares [ from Stumbleupon ] | Lifetime Refill - Max 10K - 300+/Day', 'WorldWide Social Shares from Stumbleupon\r\n\r\nUnique & Natural SEO for your Video\r\nHelp with Ranking\r\nSafe for use! NO SPAM / BOTS methods\r\n\r\nYouTube Analytics Reports will be updated in 48-72h with your Shares Results', 100, 10000, 25200, 24300, 'Aktif', 501, 'BEARPEDIA'),
(5424, 500, 'Youtube - Likes', 'YouTube Video Likes | No Refill - Low Drop - Max 150K - 10K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 10K/Day\r\nQuality: Real\r\nDrop rate: Low Drop\r\nRefill: No\r\nLink: Youtube Video Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada video publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat seiring dengan beban pesanan\r\n- Periksa tautan sebelum melakukan pemesanan\r\n- Drop rate is low as of now. This is a no refill service so we are unable to refill a single like even if it drop 100% due to server issue or YouTube update', 10, 150000, 9100, 8775, 'Aktif', 500, 'BEARPEDIA'),
(5425, 498, 'Youtube - Likes', 'YouTube Video Likes | No Refill - Max 50K - 10K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 10K/Day\r\nRefill: No refill / no refund\r\nLink: YouTube Video Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada channel publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 10, 50000, 5320, 5130, 'Aktif', 498, 'BEARPEDIA'),
(5426, 484, 'Instagram - Reels', 'Instagram Reels Views | No Refill - Max 20M - 1M/Day', 'Start time: 0 - 24 hours\r\nSpeed: 1M/Day\r\nRefill: No\r\nLink: Instagram Reels Link\r\n \r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 2147483647, 35, 33.75, 'Aktif', 484, 'BEARPEDIA'),
(5427, 482, 'Instagram - Reels', 'Instagram Reels Views | No Refill - Max 10M - 500K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 500K/Day\r\nRefill: No\r\nLink: Instagram Reels Link\r\n \r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 100000000, 28, 27, 'Aktif', 482, 'BEARPEDIA'),
(5428, 467, 'Telegram - Views', 'Telegram Post Views [ 1 Post ] - No Refill - Max 100M -  10M/Day', 'Start time: 0 - 1 hours ( No Speed Up )\r\nSpeed: 10M/Day\r\nRefill: No\r\nLink: Telegram Post Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada channel publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 100000000, 84, 81, 'Aktif', 467, 'BEARPEDIA'),
(5429, 466, 'TikTok - Download', 'TikTok Video Download | Refill 30Day - Max 30K - 5K/Hours', 'Start time: 0 - 24 hours\r\nSpeed: 5K/Hours\r\nRefill: 30 hari\r\nLink: TikTok Video Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 50, 30000, 4900, 4725, 'Aktif', 466, 'BEARPEDIA'),
(5430, 465, 'TikTok - Saves', 'TikTok Saves | Refill 30Day - Max 100K - 5K/Hours', 'Start time: 0 - 24 hours\r\nSpeed: 5K/Hours\r\nRefill: 30 hari\r\nLink: TikTok Video Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 50, 10000, 5180, 4995, 'Aktif', 465, 'BEARPEDIA'),
(5431, 463, 'TikTok - Shares', 'TikTok Share | No Refill - Max 5M - 100K/Day', 'Start time: 0 - 12 hours\r\nSpeed: 100K/Day\r\nRefill: No \r\nLink: TikTok Video Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 50, 10000000, 266, 256.5, 'Aktif', 463, 'BEARPEDIA'),
(5432, 462, 'TikTok - Shares', 'TikTok Share | No Refill - Max 10M - 10K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 10K/Day\r\nRefill: No\r\nLink: TikTok Video Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 50, 10000000, 217, 209.25, 'Aktif', 462, 'BEARPEDIA'),
(5433, 452, 'Z[+Private]', 'Instagram Likes Indonesia [ Bonus 20% ] | Refill 2Day - Non Drop - Max 30K', 'Start time: Instant - 12jam\r\nSpeed: 100 - 1000/Jam\r\nQuality: Real + Non Drop\r\nRefill: 2 hari\r\nLink: Instagram Post link\r\n\r\nNOTE\r\n- Layanan ini hanya berfungsi pada post/akun publik\r\n- Kecepatan pengiriman bisa naik/turun seiring dengan beban pesanan\r\n- Pesanan akan dianggap selesai jika memesan dengan tautan yang salah\r\n- Kesalahan pengguna bukan tanggung jawab kami.', 25, 1000, 10080, 9720, 'Aktif', 452, 'BEARPEDIA'),
(5434, 451, 'Z[+Private]', 'Instagram Likes Indonesia | No Refill - Bots HQ - Max 2K - 2K/Day', 'Start time: Instant or up to 24hour\r\nSpeed: 100 - 2K\r\nQuality: Bots HQ\r\nRefill: No\r\nLink: Instagram Post Link\r\n\r\nNOTE\r\n- Layanan ini hanya berfungsi pada post/akun publik\r\n- Kecepatan pengiriman bisa naik/turun seiring dengan beban pesanan\r\n- Pesanan akan dianggap selesai jika memesan dengan tautan yang salah\r\n- Kesalahan pengguna bukan tanggung jawab kami.', 100, 1000, 4200, 4050, 'Aktif', 451, 'BEARPEDIA'),
(5435, 450, 'Instagram - Likes [ Refill ]', 'Instagram Likes | Refill 30Day - Max 70K - 5K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 5K/Day\r\nRefill: 30 hari\r\nLink: Instagram Post Link\r\n \r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 50, 70000, 1026.2, 989.55, 'Aktif', 450, 'BEARPEDIA'),
(5436, 449, 'Instagram - Likes [ Refill ]', 'Instagram Likes | Refill 30Day - Max 50K - 5-20K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 5K - 20K/Day\r\nRefill: 30 hari\r\nLink: Instagram Post Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 10, 50000, 896, 864, 'Aktif', 449, 'BEARPEDIA'),
(5437, 448, 'Instagram - Likes [ No Refill ]', 'Instagram Likes | No Refill - Real - Low Drop - Max 100K - 5K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 5K/Day\r\nQuality: Real\r\nDrop rate: Low Drop\r\nRefill: No\r\nLink: Instagram Post Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 100000, 560, 540, 'Aktif', 448, 'BEARPEDIA'),
(5438, 447, 'Instagram - Likes [ No Refill ]', 'Instagram Likes | No Refill - Max 40K - 40K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 40K/Day\r\nRefill: No\r\nLink: Instagram Post Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 40000, 420, 405, 'Aktif', 447, 'BEARPEDIA'),
(5439, 444, 'Instagram - Followers [ Guaranteed 15-30 Days ]', 'Instagram Followers | Refill 30Day - Max 20K - 20K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 20K/Day\r\nRefill: 30 hari ( lumayan sulit untuk direfill )\r\nLink: Instagram username tanpa \" @ \"\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 10, 20000, 2786, 2686.5, 'Aktif', 444, 'BEARPEDIA'),
(5440, 438, 'Z[+Private]', 'Instagram Followers Indonesia | No Refill - Mixed - [Sangat Slow]', '\" BACA DESKRIPSI \"\r\n\r\nStart time: Sangat Slow\r\nSpeed: 100/Day\r\nQuality: Mix (ada akun bule)\r\nGuarantee: No\r\nLink: username tanpa tanda @ (jangan di private)\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Pesanan bisa Partial / Error kapan saja karna layanan ini tidak stabil\r\n- Kecepatan pengiriman sangat slow', 10, 10000, 12950, 12487.5, 'Aktif', 438, 'BEARPEDIA'),
(5441, 436, 'Z[+Private]', 'Instagram Followers Indonesia [ Real Aktif ] Bonus 20%', '\" BACA DESKRIPSI \"\r\n\r\nStart time: 0 - 24jam (bisa lebih lambat)\r\nSpeed: -\r\nQuality: Real Aktif\r\nGuarantee: No\r\nLink: Instagram username tanpa \" @ \"\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Layanan bisa ON/OFF ( Error/Partial ) kapan saja\r\n- Periksa tautan sebelum melakukan pemesanan\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai ', 100, 500, 11900, 11475, 'Aktif', 436, 'BEARPEDIA'),
(5442, 434, 'Facebook - Indonesia ????????', 'Facebook Profile Followers Indonesian - No Refill - Instant', 'Start time: 0 - 24 hours\r\nSpeed: -\r\nRefill: No refill/no refund\r\nLink: Facebook Akun Link ( Only Profile )\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 50, 50, 74200, 71550, 'Aktif', 434, 'BEARPEDIA'),
(5443, 433, 'Facebook - Indonesia ????????', 'Facebook Post Likes Indonesia - No Refill - Instant', 'Start time: 0 - 24 hours\r\nSpeed: -\r\nRefill: No refill/no refund\r\nLink: Facebook Post Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 50, 50, 42000, 40500, 'Aktif', 433, 'BEARPEDIA'),
(5444, 431, 'Facebook - Reels Short Videos', 'Facebook Reels Short Video [ Views ] | No Refill - Max 10M - 10K/Day', 'Start Time: 0 - 24hours\r\nSpeed: 10K/Day\r\nRefill: No \r\nLink: Facebook Reels Link\r\n \r\nNote\r\n- Layanan ini tidak berfungsi di \"Facebook Watch Videos\" itu hanya untuk \"Facebook Reels Videos\".', 500, 100000000, 28000, 27000, 'Aktif', 431, 'BEARPEDIA'),
(5445, 428, 'Facebook - Reels Short Videos', 'Facebook Reels Short Video [ Views ] | No Refill - Max 10M - 30K/Day', 'Start Time: Instant - 24hours\r\nSpeed: 30K/Day\r\nRefill: No \r\nLink: Facebook Reels Link\r\n\r\nNote\r\n- Layanan ini tidak berfungsi di \"Facebook Watch Videos\" itu hanya untuk \"Facebook Reels Videos\".', 500, 10000000, 9800, 9450, 'Aktif', 428, 'BEARPEDIA'),
(5446, 423, 'Facebook - Story Views', 'Facebook Story Views | No Refill - Max 4K - 4K/Day - Instant', 'Start time: 0 - 3 hours\r\nSpeed: 4K/Day\r\nRefill: No\r\nLink: Facebook Story Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 50, 1800, 14000, 13500, 'Aktif', 423, 'BEARPEDIA'),
(5447, 417, 'Facebook - Post Reaction', 'Facebook Post Reaction [Love❤️] - No Refill - Max 5K - 1K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 1K/Day\r\nRefill: No\r\nLink: Facebook Post Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 10000, 8827, 8511.75, 'Aktif', 417, 'BEARPEDIA'),
(5448, 416, 'Facebook - Post Reaction', 'Facebook Post Reaction [Care????] - No Refill - Max 5K - 1K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 1K/Day\r\nRefill: No\r\nLink: Facebook Post Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 10000, 8827, 8511.75, 'Aktif', 416, 'BEARPEDIA'),
(5449, 415, 'Facebook - Post Reaction', 'Facebook Post Reaction [Angry????] - No Refill - Max 5K - 1K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 1K/Day\r\nRefill: No\r\nLink: Facebook Post Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 10000, 8827, 8511.75, 'Aktif', 415, 'BEARPEDIA'),
(5450, 414, 'Facebook - Post Reaction', 'Facebook Post Reaction [Wow????] - No Refill - Max 5K - 1K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 1K/Day\r\nRefill: No\r\nLink: Facebook Post Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 10000, 8827, 8511.75, 'Aktif', 414, 'BEARPEDIA'),
(5451, 413, 'Facebook - Post Reaction', 'Facebook Post Reaction [Sad????] - No Refill - Max 5K - 1K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 1K/Day\r\nRefill: No\r\nLink: Facebook Post Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 10000, 8827, 8511.75, 'Aktif', 413, 'BEARPEDIA'),
(5452, 412, 'Facebook - Post Reaction', 'Facebook Post Reaction [Haha????] - No Refill - Max 5K - 1K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 1K/Day\r\nRefill: No\r\nLink: Facebook Post Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 10000, 8827, 8511.75, 'Aktif', 412, 'BEARPEDIA'),
(5453, 405, 'Facebook - Post Likes', 'Facebook Photo / Post Likes | No Refill - Max 500K - 10K/Day', 'Start time: 0 - 24 hours\r\nSpeed: 10K/Day\r\nRefill: No\r\nLink: Facebook Post/Photo Link\r\n\r\nNote\r\n- Layanan ini hanya berfungsi pada akun publik\r\n- Kecepatan pengiriman bisa berubah lebih lama/cepat\r\n- Jangan menejtatkan beberapa pesanan untuk link yang sama sebelum selesai', 100, 500000, 7000, 6750, 'Aktif', 405, 'BEARPEDIA');

-- --------------------------------------------------------

--
-- Table structure for table `metode_depo`
--

DROP TABLE IF EXISTS `metode_depo`;
CREATE TABLE IF NOT EXISTS `metode_depo` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `provider` varchar(255) NOT NULL,
  `catatan` text NOT NULL,
  `rate` varchar(255) NOT NULL,
  `nama_penerima` varchar(100) NOT NULL,
  `tujuan` varchar(250) NOT NULL,
  `tipe` enum('Transfer Bank','Transfer Ewallet') NOT NULL,
  `minimal` int(10) NOT NULL,
  `status` enum('Aktif','Tidak Aktif') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `metode_depo`
--

INSERT INTO `metode_depo` (`id`, `provider`, `catatan`, `rate`, `nama_penerima`, `tujuan`, `tipe`, `minimal`, `status`) VALUES
(1, 'BRI', 'Metode transfer manual BRI, silahkan isi saldo sesuai nominal dan penerima yang tertera di bawah ini, hubungi admin WA 085600899245 untuk melakukan konfirmasi pembayaran.', '1', 'DAHRI ANSHOR', '596601008210531', 'Transfer Bank', 20000, 'Aktif'),
(2, 'DANA', 'Metode transfer manual DANA, silahkan isi saldo sesuai nominal dan penerima yang tertera di bawah ini, hubungi admin WA 085600899245 untuk melakukan konfirmasi pembayaran.', '1', 'DAHRI ANSHOR', '089652684800', 'Transfer Ewallet', 10000, 'Aktif'),
(4, 'LINKAJA', 'Metode transfer manual LinkAja, silahkan isi saldo sesuai nominal dan penerima yang tertera di bawah ini, hubungi admin WA 085600899245 untuk melakukan konfirmasi pembayaran.', '1', 'DAHRI ANSHOR', '085600899245', 'Transfer Ewallet', 30000, 'Tidak Aktif'),
(5, 'OVO', 'dfdsafds', '', 'DAHRI ANSHOR', '085600899245', 'Transfer Ewallet', 10000, 'Tidak Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
CREATE TABLE IF NOT EXISTS `payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_merchant` varchar(50) NOT NULL,
  `api_key` varchar(255) NOT NULL,
  `private_key` varchar(255) NOT NULL,
  `min` int(25) NOT NULL,
  `mode` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `kode_merchant`, `api_key`, `private_key`, `min`, `mode`) VALUES
(1, 'T10741', 'DEV-BBbRje1PGoo3tMOE9pAhajNXETI6T1rVg6hxa1Ih', 'KnV8i-tqzfI-gJwOm-Qn933-IzgRy', 10000, 'Sandbox');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

DROP TABLE IF EXISTS `pembelian`;
CREATE TABLE IF NOT EXISTS `pembelian` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `oid` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `provider_oid` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `user` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `layanan` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `target` text COLLATE utf8_swedish_ci NOT NULL,
  `jumlah` int(10) NOT NULL,
  `remains` varchar(10) COLLATE utf8_swedish_ci NOT NULL,
  `start_count` varchar(10) COLLATE utf8_swedish_ci NOT NULL,
  `harga` double NOT NULL,
  `profit` double NOT NULL,
  `status` enum('Pending','Processing','Error','Partial','Success') COLLATE utf8_swedish_ci NOT NULL,
  `date` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `time` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `provider` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `place_from` enum('Website','API') COLLATE utf8_swedish_ci NOT NULL,
  `refund` int(2) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `provider`
--

DROP TABLE IF EXISTS `provider`;
CREATE TABLE IF NOT EXISTS `provider` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `tipe` enum('SMM','MANUAL') COLLATE utf8_swedish_ci NOT NULL,
  `code` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `link` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `link_akun` varchar(250) COLLATE utf8_swedish_ci NOT NULL,
  `link_layanan` varchar(250) COLLATE utf8_swedish_ci NOT NULL,
  `link_order` varchar(250) COLLATE utf8_swedish_ci NOT NULL,
  `link_status` varchar(250) COLLATE utf8_swedish_ci NOT NULL,
  `api_id` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `api_key` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumping data for table `provider`
--

INSERT INTO `provider` (`id`, `tipe`, `code`, `link`, `link_akun`, `link_layanan`, `link_order`, `link_status`, `api_id`, `api_key`) VALUES
(1, 'SMM', 'BEARPEDIA', 'https://bearzzpedia-smm.com/api/', 'https://bearzzpedia-smm.com/api/profile', 'https://bearzzpedia-smm.com/api/services', 'https://bearzzpedia-smm.com/api/order', 'https://bearzzpedia-smm.com/api/status', '', '33dfSMf2EbRinDyKYdWtjhZHuVCG4glC3UKcBH6Mbg1JRVrBL1K1hW5Kqz8QMiMv'),
(2, 'MANUAL', 'MANUAL', 'MANUAL', '', '', '', '', '123', '123');

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_referral`
--

DROP TABLE IF EXISTS `riwayat_referral`;
CREATE TABLE IF NOT EXISTS `riwayat_referral` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `uplink` varchar(200) COLLATE utf8_swedish_ci NOT NULL,
  `kode` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `jumlah` varchar(25) COLLATE utf8_swedish_ci NOT NULL,
  `date` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `time` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_saldo`
--

DROP TABLE IF EXISTS `riwayat_saldo`;
CREATE TABLE IF NOT EXISTS `riwayat_saldo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `tipe` enum('Layanan','Deposit','Referral') NOT NULL,
  `aksi` enum('Penambahan Saldo','Pengurangan Saldo') NOT NULL,
  `nominal` double NOT NULL,
  `pesan` varchar(255) NOT NULL,
  `date` varchar(100) NOT NULL,
  `time` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `setting_web`
--

DROP TABLE IF EXISTS `setting_web`;
CREATE TABLE IF NOT EXISTS `setting_web` (
  `id` int(11) NOT NULL,
  `nama_web` varchar(200) NOT NULL,
  `short_title` varchar(200) NOT NULL,
  `title` varchar(200) NOT NULL,
  `deskripsi_web` text NOT NULL,
  `og` varchar(250) NOT NULL,
  `site_key` varchar(250) NOT NULL,
  `secret_key` varchar(250) NOT NULL,
  `tawkto` varchar(8000) NOT NULL,
  `logo` text NOT NULL,
  `fav` text NOT NULL,
  `date` varchar(100) NOT NULL,
  `time` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setting_web`
--

INSERT INTO `setting_web` (`id`, `nama_web`, `short_title`, `title`, `deskripsi_web`, `og`, `site_key`, `secret_key`, `tawkto`, `logo`, `fav`, `date`, `time`) VALUES
(1, 'Jetpedia', 'PANEL SMM DAN PPOB', 'Boost Follower  Terlengkap dan Termurah', 'Jetpedia Adalah Website penyedia Layanan PPOB Pulsa All Operator seperti Kebutuhan Paket data, Token PLN, Voucher Game, Saldo Grab/Gojek, Selain itu Jetpedia juga menyediakan Layanan Panel SMM Sosial media marketing seperti Jasa penambah Followers, Likes, Subscriber, dll. \r\nLayanan untuk social media terpopuler seperti Instagram, Facebook, Twitter, Youtube, dll.', '1-50_Fb_Ads.png', '6Le5l_cUAAAAAPQwDkKGYBJX5Nmvb--TwjmwraFm', '6Le5l_cUAAAAAENaQC6ZrSsGuN2doQY36h-vNue5', '<!--Start of Tawk.to Script-->\r\n<script type=\"text/javascript\">\r\nvar Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();\r\n(function(){\r\nvar s1=document.createElement(\"script\"),s0=document.getElementsByTagName(\"script\")[0];\r\ns1.async=true;\r\ns1.src=\'https://embed.tawk.to/5eccbf1769eec926/1ep37heni\';\r\ns1.charset=\'UTF-8\';\r\ns1.setAttribute(\'crossorigin\',\'*\');\r\ns0.parentNode.insertBefore(s1,s0);\r\n})();\r\n</script>\r\n<!--End of Tawk.to Script-->', 'logo-4.png', 'your-logo.png', '2019-01-03', '16:06:10');

-- --------------------------------------------------------

--
-- Table structure for table `tiket`
--

DROP TABLE IF EXISTS `tiket`;
CREATE TABLE IF NOT EXISTS `tiket` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_tiket` int(10) NOT NULL,
  `pengirim` enum('Member','Admin') COLLATE utf8_swedish_ci NOT NULL,
  `user` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `subjek` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `pesan` text COLLATE utf8_swedish_ci NOT NULL,
  `date` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `time` time NOT NULL,
  `update_terakhir` varchar(250) COLLATE utf8_swedish_ci NOT NULL,
  `status` enum('Pending','Responded','Waiting','Closed') COLLATE utf8_swedish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `top_depo`
--

DROP TABLE IF EXISTS `top_depo`;
CREATE TABLE IF NOT EXISTS `top_depo` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `method` varchar(200) COLLATE utf8_swedish_ci NOT NULL,
  `username` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `jumlah` int(250) NOT NULL,
  `total` int(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `top_layanan`
--

DROP TABLE IF EXISTS `top_layanan`;
CREATE TABLE IF NOT EXISTS `top_layanan` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `method` varchar(200) COLLATE utf8_swedish_ci NOT NULL,
  `layanan` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `jumlah` int(100) NOT NULL,
  `total` int(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `top_users`
--

DROP TABLE IF EXISTS `top_users`;
CREATE TABLE IF NOT EXISTS `top_users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `method` varchar(200) COLLATE utf8_swedish_ci NOT NULL,
  `username` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `jumlah` int(250) NOT NULL,
  `total` int(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nama` text COLLATE utf8_swedish_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `username` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `saldo` int(10) NOT NULL,
  `saldo_referral` int(10) NOT NULL,
  `pemakaian_saldo` double NOT NULL,
  `level` enum('Member','Developers') COLLATE utf8_swedish_ci NOT NULL,
  `status` enum('Aktif','Tidak Aktif') COLLATE utf8_swedish_ci NOT NULL,
  `status_akun` enum('Sudah Verifikasi','Belum Verifikasi') COLLATE utf8_swedish_ci NOT NULL,
  `api_id` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `api_key` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `uplink` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `no_hp` varchar(25) COLLATE utf8_swedish_ci NOT NULL,
  `kode_referral` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `jumlah_reff` int(10) NOT NULL,
  `read_news` int(1) NOT NULL,
  `date` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `time` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `username`, `password`, `saldo`, `saldo_referral`, `pemakaian_saldo`, `level`, `status`, `status_akun`, `api_id`, `api_key`, `uplink`, `no_hp`, `kode_referral`, `jumlah_reff`, `read_news`, `date`, `time`) VALUES
(1, 'Admin', 'admin@gmail.com', 'admin', '$2y$10$zf8MF1OOkX2jB9q52BWu9uP/.L5Lva6GcslFO/NW0yQ.lWpX27fWS', 0, 0, 0, 'Developers', 'Aktif', 'Sudah Verifikasi', '', 'qFd8KGGmF6q7YmRN1f4p', 'demo', '6285600899245', '123456', 0, 1, '2020-05-15', '16:41:28');

-- --------------------------------------------------------

--
-- Table structure for table `user_token`
--

DROP TABLE IF EXISTS `user_token`;
CREATE TABLE IF NOT EXISTS `user_token` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(128) NOT NULL,
  `token` varchar(128) NOT NULL,
  `date_created` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `withdraw`
--

DROP TABLE IF EXISTS `withdraw`;
CREATE TABLE IF NOT EXISTS `withdraw` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` int(10) NOT NULL,
  `username` varchar(15) NOT NULL,
  `via` varchar(20) NOT NULL,
  `penerima` varchar(250) NOT NULL,
  `nomor` int(20) NOT NULL,
  `jumlah` int(10) NOT NULL,
  `status` enum('Success','Pending','Error') NOT NULL,
  `date` varchar(100) NOT NULL,
  `time` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
