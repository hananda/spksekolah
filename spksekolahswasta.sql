/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : spksekolah

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2015-12-26 22:54:37
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for detail_kriteria
-- ----------------------------
DROP TABLE IF EXISTS `detail_kriteria`;
CREATE TABLE `detail_kriteria` (
  `detail_kriteria_id` int(11) NOT NULL AUTO_INCREMENT,
  `detail_kriteria_nama` varchar(200) DEFAULT NULL,
  `detail_kriteria_id_kriteria` int(11) DEFAULT NULL COMMENT 'ini untuk relasi ke tabel kriteria',
  `detail_kriteria_aktif` enum('N','Y') DEFAULT 'Y',
  `detail_created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `detail_user` int(11) DEFAULT NULL,
  `detail_kriteria_bobot` int(11) DEFAULT NULL,
  `detail_kriteria_parent` int(11) DEFAULT '-1' COMMENT 'jika -1 brarti detail kriteria tanpa sub, jika 0 brarti sub kriteria, jika tidak keduanya brarti detail dari sub',
  PRIMARY KEY (`detail_kriteria_id`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of detail_kriteria
-- ----------------------------
INSERT INTO `detail_kriteria` VALUES ('1', 'Akreditasi A', '1', 'Y', '2015-04-04 00:00:00', '1', '100', '-1');
INSERT INTO `detail_kriteria` VALUES ('2', 'Akreditasi B', '1', 'Y', '2015-04-04 11:44:05', '1', '60', '-1');
INSERT INTO `detail_kriteria` VALUES ('3', 'Akreditasi C', '1', 'Y', '2015-04-04 11:44:15', '1', '20', '-1');
INSERT INTO `detail_kriteria` VALUES ('8', 'Perlengkapan Sekolah', '2', 'Y', '2015-04-04 11:52:06', '1', '20', '53');
INSERT INTO `detail_kriteria` VALUES ('9', 'SPP Bulanan', '2', 'Y', '2015-04-04 11:52:28', '1', '30', '52');
INSERT INTO `detail_kriteria` VALUES ('10', 'Uang gedung sekolah', '2', 'Y', '2015-04-04 11:52:39', '1', '30', '53');
INSERT INTO `detail_kriteria` VALUES ('11', 'Paduan Suara', '3', 'Y', '2015-04-04 12:39:31', '1', '10', '58');
INSERT INTO `detail_kriteria` VALUES ('12', 'Musik Band', '3', 'Y', '2015-04-04 12:42:06', '1', '10', '58');
INSERT INTO `detail_kriteria` VALUES ('13', 'Futsal', '3', 'Y', '2015-04-04 12:42:14', '1', '20', '57');
INSERT INTO `detail_kriteria` VALUES ('14', 'Basket', '3', 'Y', '2015-04-04 12:43:05', '1', '20', '57');
INSERT INTO `detail_kriteria` VALUES ('36', 'Pecinta Alam', '3', 'Y', '2015-10-27 19:42:05', null, '10', '57');
INSERT INTO `detail_kriteria` VALUES ('37', 'Kelas Ber AC', '15', 'Y', '2015-10-27 19:42:42', null, '25', '66');
INSERT INTO `detail_kriteria` VALUES ('38', 'LCD Tiap Kelas', '15', 'Y', '2015-10-27 19:43:00', null, '25', '66');
INSERT INTO `detail_kriteria` VALUES ('39', 'Mendapatkan Makan Siang', '15', 'Y', '2015-10-27 19:43:24', null, '10', '67');
INSERT INTO `detail_kriteria` VALUES ('40', 'Laboratorium sekolah', '15', 'Y', '2015-10-27 19:43:44', null, '20', '65');
INSERT INTO `detail_kriteria` VALUES ('41', 'Lift sekolah', '15', 'Y', '2015-10-27 19:43:57', null, '20', '65');
INSERT INTO `detail_kriteria` VALUES ('42', 'Kemudahan akses', '16', 'Y', '2015-10-27 19:44:27', null, '50', '-1');
INSERT INTO `detail_kriteria` VALUES ('43', 'Pinggir jalan', '16', 'Y', '2015-10-27 19:44:42', null, '20', '-1');
INSERT INTO `detail_kriteria` VALUES ('44', 'Terletak dipusat kota', '16', 'Y', '2015-10-27 19:44:59', null, '30', '-1');
INSERT INTO `detail_kriteria` VALUES ('45', 'coba 1', '17', 'Y', '2015-11-12 21:59:54', null, '20', '-1');
INSERT INTO `detail_kriteria` VALUES ('46', 'coba 2', '17', 'Y', '2015-11-12 22:00:07', null, '30', '-1');
INSERT INTO `detail_kriteria` VALUES ('47', 'coba 3', '17', 'Y', '2015-11-12 22:00:16', null, '50', '-1');
INSERT INTO `detail_kriteria` VALUES ('48', 'Juara 1 Matematika', '18', 'Y', '2015-11-19 19:06:49', null, '50', '-1');
INSERT INTO `detail_kriteria` VALUES ('49', 'Juara 1 Fisika', '18', 'Y', '2015-11-19 19:07:01', null, '30', '-1');
INSERT INTO `detail_kriteria` VALUES ('50', 'Tidak Punya', '3', 'Y', '2015-12-13 21:33:40', null, '5', '-1');
INSERT INTO `detail_kriteria` VALUES ('52', 'Rutin Bulanan', '2', 'Y', '2015-12-26 21:35:48', null, '0', '0');
INSERT INTO `detail_kriteria` VALUES ('53', 'Awal Sekolah', '2', 'Y', '2015-12-26 21:36:01', null, '0', '0');
INSERT INTO `detail_kriteria` VALUES ('54', 'Uang Kegiatan', '2', 'Y', '2015-12-26 21:38:33', null, '10', '52');
INSERT INTO `detail_kriteria` VALUES ('55', 'Uang Makan', '2', 'Y', '2015-12-26 21:38:40', null, '10', '52');
INSERT INTO `detail_kriteria` VALUES ('56', 'Ekskul Ilmiah', '3', 'Y', '2015-12-26 21:41:58', null, '0', '0');
INSERT INTO `detail_kriteria` VALUES ('57', 'Ekskul Olahraga', '3', 'Y', '2015-12-26 21:42:16', null, '0', '0');
INSERT INTO `detail_kriteria` VALUES ('58', 'Ekskul Entertaint', '3', 'Y', '2015-12-26 21:42:42', null, '0', '0');
INSERT INTO `detail_kriteria` VALUES ('59', 'Karya Ilmiah', '3', 'Y', '2015-12-26 21:44:35', null, '10', '56');
INSERT INTO `detail_kriteria` VALUES ('60', 'English Club', '3', 'Y', '2015-12-26 21:44:48', null, '10', '56');
INSERT INTO `detail_kriteria` VALUES ('61', 'TPQ', '3', 'Y', '2015-12-26 21:44:56', null, '5', '56');
INSERT INTO `detail_kriteria` VALUES ('62', 'Voli', '3', 'Y', '2015-12-26 21:45:30', null, '5', '57');
INSERT INTO `detail_kriteria` VALUES ('63', 'Cheers', '3', 'Y', '2015-12-26 21:45:43', null, '20', '57');
INSERT INTO `detail_kriteria` VALUES ('64', 'Teater', '3', 'Y', '2015-12-26 21:46:14', null, '10', '58');
INSERT INTO `detail_kriteria` VALUES ('65', 'Fasilitas Gedung', '15', 'Y', '2015-12-26 21:48:26', null, '0', '0');
INSERT INTO `detail_kriteria` VALUES ('66', 'Fasilitas Kelas', '15', 'Y', '2015-12-26 21:48:40', null, '0', '0');
INSERT INTO `detail_kriteria` VALUES ('67', 'Fasilitas Konsumsi', '15', 'Y', '2015-12-26 21:49:00', null, '0', '0');

-- ----------------------------
-- Table structure for kriteria
-- ----------------------------
DROP TABLE IF EXISTS `kriteria`;
CREATE TABLE `kriteria` (
  `kriteria_id` int(11) NOT NULL AUTO_INCREMENT,
  `kriteria_nama` varchar(255) DEFAULT NULL,
  `kriteria_user` int(5) DEFAULT NULL,
  `kriteria_aktif` enum('N','Y') DEFAULT 'Y',
  PRIMARY KEY (`kriteria_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of kriteria
-- ----------------------------
INSERT INTO `kriteria` VALUES ('1', 'Akreditasi Sekolah', '1', 'Y');
INSERT INTO `kriteria` VALUES ('2', 'Biaya Sekolah', '1', 'Y');
INSERT INTO `kriteria` VALUES ('3', 'Ekstra Kulikuler', '1', 'Y');
INSERT INTO `kriteria` VALUES ('15', 'Fasilitas Sekolah', null, 'Y');
INSERT INTO `kriteria` VALUES ('16', 'Lokasi', null, 'Y');
INSERT INTO `kriteria` VALUES ('17', 'tests', null, '');
INSERT INTO `kriteria` VALUES ('18', 'Prestasi sekolah', null, '');

-- ----------------------------
-- Table structure for sekolah
-- ----------------------------
DROP TABLE IF EXISTS `sekolah`;
CREATE TABLE `sekolah` (
  `sekolah_id` int(11) NOT NULL AUTO_INCREMENT,
  `sekolah_nama` varchar(255) DEFAULT NULL,
  `sekolah_desc` text,
  `sekolah_created_date` timestamp NULL DEFAULT NULL,
  `sekolah_user` int(11) DEFAULT NULL,
  `sekolah_aktif` enum('N','Y') DEFAULT 'Y',
  `sekolah_foto` varchar(100) DEFAULT NULL,
  `sekolah_alamat` varchar(255) DEFAULT NULL,
  `sekolah_updated_date` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`sekolah_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sekolah
-- ----------------------------
INSERT INTO `sekolah` VALUES ('1', 'SMA 17 AGUSTUS SURABAYA', '<p style=\"text-align:center\"><img alt=\"\" src=\"/spksekolah/Pictures/PASKIBRA_copy.jpg\" style=\"height:451px; width:616px\" /></p>\r\n\r\n<p style=\"text-align:center\"><span style=\"font-size:20px\"><u><strong><span style=\"font-family:times new roman,times,serif\">VISI</span></strong></u></span></p>\r\n\r\n<p style=\"text-align:center\"><span style=\"font-family:comic sans ms,cursive\"><em><span style=\"font-size:18px\">Menjadi Sekolah&nbsp;<strong>FAVORIT</strong></span></em></span></p>\r\n\r\n<p style=\"text-align:center\">&nbsp;</p>\r\n\r\n<p style=\"text-align:center\"><span style=\"font-size:20px\"><u><strong><span style=\"font-family:times new roman,times,serif\">MISI</span></strong></u></span></p>\r\n\r\n<p><span style=\"font-family:comic sans ms,cursive\"><em><span style=\"font-size:18px\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 1. Menghasilkan lulusan yang berbudi pekerti luhur.</span></em></span></p>\r\n\r\n<p><span style=\"font-family:comic sans ms,cursive\"><em><span style=\"font-size:18px\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 2. Menghasilkan lulusan yang berprestasi.</span></em></span></p>\r\n\r\n<p><span style=\"font-family:comic sans ms,cursive\"><em><span style=\"font-size:18px\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 3. Menghasilkan lulusan yang berdaya saing tinggi.</span></em></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p style=\"text-align:center\">SMA 17 Agustus 1945 Surabaya merupakan salah satu dari unit di lingkungan Yayasan Perguruan 17 Agustus 1945 Surabaya. Padahal awal berdirinya tahun 1984, SMA 17 Agustus 1945 Surabayamemiliki prodi Ilmu Alam (IPA) dan Ilmu Sosial (IPS). Sejak berdirinya sekolah sampai sekarang memperoleh hasil akreditasi dengan nilai &quot;A&quot; yang dikeluarkan oleh BAN-SM.</p>\r\n\r\n<p style=\"text-align:center\">Dalam mengelolah sekolah di SMA 17 Agustus 1945 Surabaya telah dilakukan bebagai upaya untuk meningkatkan kualitas lulusan, sepeti peningkatan kualitas dan kuantitas sarana prasarana, peningkatan kualitas sumber daya manusia ( guru dan tenaga kependidikan ), perbaikan kurikulum, memperbanyak dan memanfaatkan kerjasama dengan permintaan maupun swasta.</p>\r\n', '2015-10-27 20:55:09', null, 'Y', 'copy-of-untag-logo-2.jpg', null, '2015-12-13 20:49:40');
INSERT INTO `sekolah` VALUES ('2', 'SMA AL FALAH KETINTANG', '<p style=\"text-align: justify;\"><img alt=\"\" src=\"/spksekolah/Pictures/Slide7.jpg\" style=\"height:480px; width:640px\" /></p>\r\n\r\n<p style=\"text-align: justify;\"><span style=\"color:rgb(0, 0, 0); font-family:verdana,geneva; font-size:12pt\">Yayasan Kepharmasian Surabaya (YKS) berdiri sejak tahun 1972 berdasarkan Akta&nbsp;</span><span style=\"color:rgb(0, 0, 0); font-family:verdana,geneva; font-size:12pt\">Notaris, Soedjono, S.H. dan Diah Anggraini, S.H., M.Hum. Yayasan ini bergerak di bidang pendidikan dasar sampai pendidikan tinggi serta semua hal yang berhubungan dengan pendidikan (seminar, pelatihan, buku, dan majalah) khususnya di bidang farmasi dan pendidikan yang bernuansakan Akhlaqul Karimah (Islam).</span></p>\r\n\r\n<p style=\"text-align: justify;\">&nbsp;</p>\r\n\r\n<h2><span style=\"font-size:18pt\"><span style=\"font-size:14pt\"><span style=\"font-family:impact,chicago\">VISI &amp; MISI</span></span></span></h2>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-family:verdana,geneva\"><span style=\"font-size:12pt\">Turut secara aktif meningkatkan kualitas Sumber Daya Manusia Indonesia melalui pendidikan dasar, menengah, dan kejuruan.</span></span></p>\r\n\r\n<p><span style=\"font-size:18px\">untuk informasi lebih lengkap&nbsp;silahkan kunjungi situs SMA Al Falah <a href=\"http://www.alfalahketintang.com\" target=\"_blank\">http://www.alfalahketintang.com</a></span></p>\r\n', '2015-10-22 21:23:42', '1', 'Y', '2U-f4YV2_400x400.jpeg', null, '2015-12-13 21:09:24');
INSERT INTO `sekolah` VALUES ('3', 'SMA GIKI 1 SURABAYA', '<p style=\"padding: 0px; margin: 0px; color: rgb(136, 136, 136); font-family: Verdana, Tahoma, Arial, sans-serif; font-size: 12px; line-height: normal; text-align: justify;\"><img alt=\"\" src=\"/spksekolah/Pictures/DSC00984.jpg\" style=\"height:480px; width:640px\" /></p>\r\n\r\n<p style=\"padding: 0px; margin: 0px; color: rgb(136, 136, 136); font-family: Verdana, Tahoma, Arial, sans-serif; font-size: 12px; line-height: normal; text-align: justify;\">&nbsp;</p>\r\n\r\n<p style=\"padding: 0px; margin: 0px; color: rgb(136, 136, 136); font-family: Verdana, Tahoma, Arial, sans-serif; font-size: 12px; line-height: normal; text-align: justify;\"><span style=\"color:#000000\"><span style=\"font-size:14px\">GIKI diselenggarakannya sejak tanggal 28 Desember 1958 sampai dengan saat ini dan pada tanggal 28 Desember 2008 genap berusia 50 tahun.</span></span></p>\r\n\r\n<p style=\"padding: 0px; margin: 0px; color: rgb(136, 136, 136); font-family: Verdana, Tahoma, Arial, sans-serif; font-size: 12px; line-height: normal; text-align: justify;\">&nbsp;</p>\r\n\r\n<p style=\"padding: 0px; margin: 0px; color: rgb(136, 136, 136); font-family: Verdana, Tahoma, Arial, sans-serif; font-size: 12px; line-height: normal; text-align: justify;\"><span style=\"color:#000000\"><span style=\"font-size:14px\">Keberadaan Yayasan Pendidikan GITA KIRTTI (GIKI)/Yayasan GITA KIRTTI Surabaya saat ini tidak dapat dipisahkan dengan latar belakang historis yang diawali pada zaman Pemerintahan Hindia Belanda dengan didirikannya perkumpulan yang bernama I E V ( Indo Europeezch Verbond ) pada tanggal 1 Juli 1919 di Batavia (Jakarta) kemudian bernama &rdquo;Indo-Eenheids Verbond- Gabungan Indo untuk Kesatuan Indonesia ( G.I.K.I ) tanggal 28 Desember 1951, dan pada tanggal 28 Desember 1958 di Surabaya dibentuk &rdquo;G I K I Foundation&rdquo;.</span></span></p>\r\n\r\n<p style=\"padding: 0px; margin: 0px; color: rgb(136, 136, 136); font-family: Verdana, Tahoma, Arial, sans-serif; font-size: 12px; line-height: normal; text-align: justify;\">&nbsp;</p>\r\n\r\n<p style=\"padding: 0px; margin: 0px; color: rgb(136, 136, 136); font-family: Verdana, Tahoma, Arial, sans-serif; font-size: 12px; line-height: normal; text-align: justify;\"><span style=\"color:#000000\"><span style=\"font-size:14px\">Dengan dibubarkannya Gabungan Indo untuk Kesatuan Indonesia ( G.I.K.I ) pada tanggal 14 Mei 1961, maka segala hak milik, tanggung jawab serta usaha-usaha sosial dan pendidikan G.I.K.I dialihkan kepada Yayasan G.I.K.I Foudation, dan pada tanggal 22 Agustus 1968 nama &rdquo; GIKI Foundation&rdquo; diubah menjadi &rdquo;Yayasan Pendidikan GITA KIRTTI &rdquo; disingkat GIKI yang maknanya ajaran perbuatan baik ,berkedudukan di Surabaya. Usaha-usaha dan sekolah-sekolah yang diselenggarakan Yayasan Pendidikan GITA KIRTTI meliputi Perpustakaan &rdquo;Elk Wat Wils&rdquo; dan Kursus Bahasa Belanda, kemudian ditutup tahun 1984, Yayasan Dana Pensiun GIKI dan sekolah-sekolah yang berada di wilayah Surabaya, DKI Jakarta, Bogor dan Bandung mulai dari TK, SD, SMP, SMA dan bahkan SMK.</span></span></p>\r\n\r\n<p style=\"padding: 0px; margin: 0px; color: rgb(136, 136, 136); font-family: Verdana, Tahoma, Arial, sans-serif; font-size: 12px; line-height: normal; text-align: justify;\">&nbsp;</p>\r\n\r\n<p style=\"padding: 0px; margin: 0px; color: rgb(136, 136, 136); font-family: Verdana, Tahoma, Arial, sans-serif; font-size: 12px; line-height: normal; text-align: justify;\"><span style=\"color:#000000\"><span style=\"font-size:14px\">Pada tanggal 29 Desember 1989 Yayasan Pendidikan GITA KIRTTI (GIKI) dinyatakan non aktif dan &rdquo;in likwidatie&rdquo; / dibubarkan, dan aset-aset yang dimiliki Yayasan Pendidikan GITA KIRTTI dikelola secara otonom Yayasan baru yang berlokasi di wilayah Surabaya dan Yayasan baru yang berlokasi di wilayah DKI Jakarta dan Jawa Barat.</span></span></p>\r\n\r\n<p style=\"padding: 0px; margin: 0px; color: rgb(136, 136, 136); font-family: Verdana, Tahoma, Arial, sans-serif; font-size: 12px; line-height: normal; text-align: justify;\"><span style=\"color:#000000\"><span style=\"font-size:14px\">Pada tanggal 10 Januari 1990 di Surabaya didirikan Yayasan baru bernama &rdquo; Yayasan GITA KIRTTI Surabaya (GIKI) dan terpisah dengan Yayasan GITA KIRTTI DKI Jaya/Jabar.</span></span></p>\r\n\r\n<p style=\"padding: 0px; margin: 0px; color: rgb(136, 136, 136); font-family: Verdana, Tahoma, Arial, sans-serif; font-size: 12px; line-height: normal; text-align: justify;\">&nbsp;</p>\r\n\r\n<p style=\"padding: 0px; margin: 0px; color: rgb(136, 136, 136); font-family: Verdana, Tahoma, Arial, sans-serif; font-size: 12px; line-height: normal; text-align: justify;\">&nbsp;</p>\r\n\r\n<p style=\"color: rgb(136, 136, 136); font-style: italic; text-align: justify;\"><span style=\"font-size:14px\">Visi, Misi dan Tujuan</span></p>\r\n\r\n<p style=\"text-align: justify;\">&nbsp;</p>\r\n\r\n<p style=\"text-align: justify;\"><span style=\"font-size:14px\"><u><strong>V I S I &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : &nbsp;&nbsp;</strong></u></span></p>\r\n\r\n<p style=\"text-align: justify;\"><span style=\"font-size:14px\">Beriman dan taqwa, berilmu pengetahuan teknologi, berprestasi unggul, berkepribadian, berbudaya dan berwawasan kebangsaan demi terwujudnya kedamaian dan kesejahteraan.</span></p>\r\n\r\n<p style=\"text-align: justify;\">&nbsp;</p>\r\n\r\n<p style=\"text-align: justify;\">&nbsp;</p>\r\n\r\n<p style=\"text-align: justify;\"><span style=\"font-size:14px\"><u><strong>M I S I &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :&nbsp;&nbsp;</strong></u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></p>\r\n\r\n<p style=\"text-align: justify;\"><span style=\"font-size:14px\">a.&nbsp; Meningkatkan Keimanan dan ketaqwaan Kepada Tuhan Yang Maha Esa.</span></p>\r\n\r\n<p style=\"text-align: justify;\"><span style=\"font-size:14px\">b.&nbsp; Tanggap dan terampil terhadap perkembangan ilmu pengetahuan dan teknologi.</span></p>\r\n\r\n<p style=\"text-align: justify;\"><span style=\"font-size:14px\">c.&nbsp; Meningkatkan kwalitas sumber daya manusia dan berprestasi unggul.</span></p>\r\n\r\n<p style=\"text-align: justify;\"><span style=\"font-size:14px\">d.&nbsp; Menanamkan disiplin, loyalitas, kebanggan kepada almamater dan profesionalisme.</span></p>\r\n\r\n<p style=\"text-align: justify;\"><span style=\"font-size:14px\">e.&nbsp; Berkepribadian, berbudaya dan berwawasan kebangsaan</span></p>\r\n\r\n<p style=\"text-align: justify;\"><span style=\"font-size:14px\">f.&nbsp; Membangun kekeluargaan dan kebersamaan</span></p>\r\n\r\n<p style=\"text-align: justify;\"><span style=\"font-size:14px\">g.&nbsp; Mewujudkan kedamaian dan kesejahteraan.</span></p>\r\n\r\n<p style=\"text-align: justify;\"><span style=\"font-size:14px\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></p>\r\n\r\n<p style=\"text-align: justify;\">&nbsp;</p>\r\n\r\n<p style=\"text-align: justify;\"><span style=\"font-size:14px\"><u><strong>Tujuan &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</strong></u></span></p>\r\n\r\n<p style=\"text-align: justify;\"><span style=\"font-size:14px\">1.Membentuk peserta didik yang memiliki ketakwaan terhadap Tuhan Yang Maha Esa, dan mampu mengamalkan setiap keyakinannya dalam kehidupan sehari-hari.</span></p>\r\n\r\n<p style=\"text-align: justify;\"><span style=\"font-size:14px\">2.Membentuk peserta didik yang memiliki pengetahuan yang memadai untuk dapat melanjutkan ke pendidikan yang lebih tinggi, serta mampu meraih prestasi akademik optimal sesuai kemampuan, minat, dan bakatnya.</span></p>\r\n\r\n<p style=\"text-align: justify;\"><span style=\"font-size:14px\">3.Membentuk peserta didik yang berbudi luhur, mampu menghormati orang tua, guru, dan sesama peserta didik serta lingkungannya.</span></p>\r\n\r\n<p style=\"text-align: justify;\"><span style=\"font-size:14px\">4.Membentuk peserta didik yang memiliki wawasan luas dalam segala bidang melalui Komputer dan Bahasa Inggris serta bahasa asing yang dikuasainya.</span></p>\r\n\r\n<p style=\"text-align: justify;\">&nbsp;</p>\r\n\r\n<p style=\"text-align: justify;\"><span style=\"font-size:14px\">untuk informasi lebih lengkap, silahkan kunjungi&nbsp;<a href=\"http://www.smagiki1-sby.sch.id/\" target=\"_blank\">http://www.smagiki1-sby.sch.id/</a></span></p>\r\n', '2015-10-22 21:23:45', '1', 'Y', 'images.jpg', null, '2015-12-13 21:27:17');
INSERT INTO `sekolah` VALUES ('4', 'SMKN1 SURABAYAs 3', '<p>stestset</p>\n\n<p>asdfasdfddddddd</p>\n\n<p><img alt=\"\" src=\"/spksekolah/Pictures/test/Selection_044.jpg\" style=\"height:487px; width:724px\" /></p>\n', '2015-10-22 21:23:48', '1', '', 'Selection_002.jpg', null, '2015-12-13 21:27:21');

-- ----------------------------
-- Table structure for t_kriteria
-- ----------------------------
DROP TABLE IF EXISTS `t_kriteria`;
CREATE TABLE `t_kriteria` (
  `t_kriteria_id` int(11) NOT NULL AUTO_INCREMENT,
  `t_kriteria_sekolah_id` int(11) DEFAULT NULL,
  `t_kriteria_kriteria_id` int(11) DEFAULT NULL,
  `t_kriteria_detail_kriteria_id` int(11) DEFAULT NULL,
  `t_kriteria_created_date` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `t_kriteria_user` int(11) DEFAULT NULL,
  PRIMARY KEY (`t_kriteria_id`)
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of t_kriteria
-- ----------------------------
INSERT INTO `t_kriteria` VALUES ('30', '4', '1', '1', '2015-11-01 21:24:07', '1');
INSERT INTO `t_kriteria` VALUES ('31', '4', '2', '8', '2015-11-01 21:24:07', '1');
INSERT INTO `t_kriteria` VALUES ('32', '4', '3', '11', '2015-11-01 21:24:08', '1');
INSERT INTO `t_kriteria` VALUES ('33', '4', '3', '12', '2015-11-01 21:24:08', '1');
INSERT INTO `t_kriteria` VALUES ('34', '4', '3', '13', '2015-11-01 21:24:08', '1');
INSERT INTO `t_kriteria` VALUES ('35', '4', '3', '14', '2015-11-01 21:24:08', '1');
INSERT INTO `t_kriteria` VALUES ('36', '4', '3', '36', '2015-11-01 21:24:08', '1');
INSERT INTO `t_kriteria` VALUES ('37', '4', '15', '39', '2015-11-01 21:24:08', '1');
INSERT INTO `t_kriteria` VALUES ('38', '4', '15', '40', '2015-11-01 21:24:08', '1');
INSERT INTO `t_kriteria` VALUES ('39', '4', '15', '41', '2015-11-01 21:24:08', '1');
INSERT INTO `t_kriteria` VALUES ('40', '4', '16', '43', '2015-11-01 21:24:08', '1');
INSERT INTO `t_kriteria` VALUES ('41', '4', '16', '44', '2015-11-01 21:24:08', '1');
INSERT INTO `t_kriteria` VALUES ('60', '2', '1', '1', '2015-12-13 15:10:52', '0');
INSERT INTO `t_kriteria` VALUES ('61', '2', '2', '9', '2015-12-13 15:10:52', '0');
INSERT INTO `t_kriteria` VALUES ('62', '2', '2', '10', '2015-12-13 15:10:52', '0');
INSERT INTO `t_kriteria` VALUES ('63', '2', '3', '36', '2015-12-13 15:10:52', '0');
INSERT INTO `t_kriteria` VALUES ('64', '2', '15', '40', '2015-12-13 15:10:52', '0');
INSERT INTO `t_kriteria` VALUES ('65', '2', '16', '42', '2015-12-13 15:10:52', '0');
INSERT INTO `t_kriteria` VALUES ('66', '2', '16', '43', '2015-12-13 15:10:52', '0');
INSERT INTO `t_kriteria` VALUES ('74', '3', '1', '1', '2015-12-13 15:34:16', '1');
INSERT INTO `t_kriteria` VALUES ('75', '3', '2', '9', '2015-12-13 15:34:16', '1');
INSERT INTO `t_kriteria` VALUES ('76', '3', '2', '8', '2015-12-13 15:34:16', '1');
INSERT INTO `t_kriteria` VALUES ('77', '3', '3', '50', '2015-12-13 15:34:16', '1');
INSERT INTO `t_kriteria` VALUES ('78', '3', '15', '40', '2015-12-13 15:34:16', '1');
INSERT INTO `t_kriteria` VALUES ('79', '3', '16', '42', '2015-12-13 15:34:16', '1');
INSERT INTO `t_kriteria` VALUES ('80', '3', '16', '43', '2015-12-13 15:34:16', '1');
INSERT INTO `t_kriteria` VALUES ('91', '1', '1', '1', '2015-12-26 16:07:28', '1');
INSERT INTO `t_kriteria` VALUES ('92', '1', '2', '9', '2015-12-26 16:07:28', '1');
INSERT INTO `t_kriteria` VALUES ('93', '1', '2', '8', '2015-12-26 16:07:28', '1');
INSERT INTO `t_kriteria` VALUES ('94', '1', '3', '13', '2015-12-26 16:07:28', '1');
INSERT INTO `t_kriteria` VALUES ('95', '1', '3', '14', '2015-12-26 16:07:28', '1');
INSERT INTO `t_kriteria` VALUES ('96', '1', '3', '12', '2015-12-26 16:07:28', '1');
INSERT INTO `t_kriteria` VALUES ('97', '1', '15', '40', '2015-12-26 16:07:28', '1');
INSERT INTO `t_kriteria` VALUES ('98', '1', '16', '42', '2015-12-26 16:07:28', '1');
INSERT INTO `t_kriteria` VALUES ('99', '1', '16', '43', '2015-12-26 16:07:28', '1');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_nama` varchar(100) DEFAULT NULL,
  `user_pass` varchar(100) DEFAULT NULL,
  `user_aktif` enum('N','Y') DEFAULT 'Y',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'iqbal', 'e10adc3949ba59abbe56e057f20f883e', 'Y');
INSERT INTO `user` VALUES ('2', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Y');

-- ----------------------------
-- Table structure for variabel
-- ----------------------------
DROP TABLE IF EXISTS `variabel`;
CREATE TABLE `variabel` (
  `variabel_id` int(11) NOT NULL AUTO_INCREMENT,
  `variabel_nama` varchar(255) DEFAULT NULL,
  `variabel_nilai` double DEFAULT NULL,
  `variabel_aktif` enum('N','Y') DEFAULT 'Y',
  `variabel_created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `variabel_user` int(11) DEFAULT NULL,
  `variabel_range_awal` int(11) DEFAULT NULL,
  `variabel_range_akhir` int(11) DEFAULT NULL,
  PRIMARY KEY (`variabel_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of variabel
-- ----------------------------
INSERT INTO `variabel` VALUES ('1', 'Kurang Baik', '1', 'Y', '2015-04-04 11:39:35', '1', '0', '29');
INSERT INTO `variabel` VALUES ('2', 'Kurang', '2', 'Y', '2015-04-04 11:39:55', '1', '30', '59');
INSERT INTO `variabel` VALUES ('3', 'Cukup', '3', 'Y', '2015-04-04 11:40:05', '1', '60', '74');
INSERT INTO `variabel` VALUES ('4', 'Baik', '4', 'Y', '2015-04-04 11:40:13', '1', '75', '84');
INSERT INTO `variabel` VALUES ('5', 'Sangat Baik', '5', 'Y', '2015-04-04 11:40:23', '1', '85', '100');
INSERT INTO `variabel` VALUES ('6', 'Sanggat Tinggi', '1', '', '2015-04-04 11:40:33', '1', null, null);
INSERT INTO `variabel` VALUES ('7', 'test', '123', 'N', '2015-05-17 11:20:31', '0', null, null);
INSERT INTO `variabel` VALUES ('8', 'tet', '1', 'N', '2015-05-24 01:33:41', '1', null, null);

-- ----------------------------
-- View structure for v_detail_kriteria
-- ----------------------------
DROP VIEW IF EXISTS `v_detail_kriteria`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost`  VIEW `v_detail_kriteria` AS select `t_kriteria`.`t_kriteria_id` AS `t_kriteria_id`,`t_kriteria`.`t_kriteria_sekolah_id` AS `t_kriteria_sekolah_id`,`t_kriteria`.`t_kriteria_kriteria_id` AS `t_kriteria_kriteria_id`,`t_kriteria`.`t_kriteria_detail_kriteria_id` AS `t_kriteria_detail_kriteria_id`,`t_kriteria`.`t_kriteria_created_date` AS `t_kriteria_created_date`,`t_kriteria`.`t_kriteria_user` AS `t_kriteria_user`,`detail_kriteria`.`detail_kriteria_id` AS `detail_kriteria_id`,`detail_kriteria`.`detail_kriteria_nama` AS `detail_kriteria_nama`,`detail_kriteria`.`detail_kriteria_id_kriteria` AS `detail_kriteria_id_kriteria`,`detail_kriteria`.`detail_kriteria_aktif` AS `detail_kriteria_aktif`,`detail_kriteria`.`detail_created_date` AS `detail_created_date`,`detail_kriteria`.`detail_user` AS `detail_user`,`detail_kriteria`.`detail_kriteria_bobot` AS `detail_kriteria_bobot` from (`t_kriteria` left join `detail_kriteria` on((`t_kriteria`.`t_kriteria_detail_kriteria_id` = `detail_kriteria`.`detail_kriteria_id`))) ;
