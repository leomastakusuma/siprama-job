-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 24, 2017 at 12:22 AM
-- Server version: 5.7.15-0ubuntu0.16.04.1
-- PHP Version: 7.0.13-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myr_recruitment`
--

DELIMITER $$
--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `nextseq` (`seq_name` VARCHAR(100), `additional_param` VARCHAR(20)) RETURNS VARCHAR(60) CHARSET utf8 MODIFIES SQL DATA
BEGIN
    DECLARE cur_val varchar(60);
      
      SELECT CONCAT(nextval(seq_name), additional_param) INTO cur_val FROM DUAL;
      SELECT CONCAT(sequence_prefix, cur_val, DATE_FORMAT(now(), sequence_suffix )) INTO cur_val FROM sequence_data WHERE sequence_name = seq_name;
      
    RETURN cur_val;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `nextseq_daily` (`seq_name` VARCHAR(100)) RETURNS VARCHAR(60) CHARSET utf8 BEGIN
  
  DECLARE vperiod INTEGER(1);
  DECLARE cur_val varchar(60);
  
  SELECT COUNT(1) into vperiod FROM sequence_data 
  WHERE sequence_name = seq_name 
    AND period = DATE_FORMAT(now(), '%Y-%m-%d');
  
  IF vperiod < 1 THEN
    UPDATE sequence_data
    SET period = now(), sequence_cur_value = '0'
    WHERE sequence_name = seq_name;
  END IF;
  
  SELECT nextseq(seq_name, '') INTO cur_val FROM DUAL;
  
  RETURN cur_val;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `nextval` (`seq_name` VARCHAR(60)) RETURNS VARCHAR(21) CHARSET utf8 MODIFIES SQL DATA
BEGIN
    DECLARE cur_val varchar(21);
    DECLARE lmax bigint(21);
    
        UPDATE
            sequence_data
        SET
            sequence_cur_value = IF (
                sequence_cur_value = sequence_max_value,
                IF (
                    sequence_cycle = TRUE,
                    sequence_min_value,
                    NULL
                ),
                sequence_cur_value + sequence_increment
            )
        WHERE
            sequence_name = seq_name
        ;
        
        SELECT LENGTH(sequence_max_value) INTO lmax
        FROM sequence_data 
        WHERE sequence_name = seq_name;
        
        SELECT
            LPAD(sequence_cur_value, lmax, '0') INTO cur_val
        FROM
            sequence_data
        WHERE
            sequence_name = seq_name
        ;
    
 
    RETURN cur_val;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_tm_client`
--

CREATE TABLE `cms_tm_client` (
  `client_id` varchar(30) NOT NULL COMMENT 'CLIENT+ 00001 + yy',
  `branch_id` varchar(20) NOT NULL COMMENT 'fk sys_tm_branch',
  `_name` varchar(45) NOT NULL,
  `_desc` text,
  `_address` varchar(250) DEFAULT NULL,
  `_phone` varchar(25) DEFAULT NULL,
  `_logo_real_name` varchar(250) DEFAULT NULL,
  `_logo_enc_name` varchar(150) DEFAULT NULL,
  `_logo_url` varchar(250) DEFAULT NULL,
  `_pic_name` varchar(45) DEFAULT NULL,
  `_pic_phone` varchar(25) DEFAULT NULL,
  `_pic_email` varchar(45) DEFAULT NULL,
  `_active` enum('0','1') NOT NULL DEFAULT '1',
  `_delete` enum('0','1') NOT NULL DEFAULT '0',
  `create_date` datetime NOT NULL,
  `create_by` varchar(25) NOT NULL COMMENT 'fk cms_tm_user',
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_update_by` varchar(25) DEFAULT NULL COMMENT 'cms_tm_user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cms_tm_client`
--

INSERT INTO `cms_tm_client` (`client_id`, `branch_id`, `_name`, `_desc`, `_address`, `_phone`, `_logo_real_name`, `_logo_enc_name`, `_logo_url`, `_pic_name`, `_pic_phone`, `_pic_email`, `_active`, `_delete`, `create_date`, `create_by`, `last_update`, `last_update_by`) VALUES
('CLIENT00000616', 'BRANCH00116', 'PT. MULTI SARANA PAKANINDO', 'Rumah potong unggas', 'Sawangan Depok', '021768876892', 'logo_msp.jpg', 'be87fd06156271e09351260eb198c83b.jpg', 'http://yansen.dev.codigo.id/myr/siprama-recruitment-cms/public_assets/uploads/be87fd06156271e09351260eb198c83b.jpg', 'SHITA', '081278678299', 'Nishita.alitya@gmail.com', '1', '0', '2016-10-14 10:11:44', 'USR0000001516', '2016-10-14 04:37:34', 'USR0000001516'),
('CLIENT00000716', 'BRANCH00116', 'UNIQLO', 'PT. Fast Retailing Indonesia . Brand Fashion Uniqlo', 'jakarta', '021783893892', 'UniqloStorefront.jpg', '8c9949225f18a3ed2e6756d59b3d20e0.jpg', 'http://yansen.dev.codigo.id/myr/siprama-recruitment-cms/public_assets/uploads/8c9949225f18a3ed2e6756d59b3d20e0.jpg', 'Karulia', '081253637891', 'karulia@gmail.com', '1', '0', '2016-10-14 10:17:47', 'USR0000001516', '2016-10-14 03:17:47', NULL),
('CLIENT00001116', 'BRANCH00116', 'A', 's', 's', 'a', 'cecep_opt_opt.jpg', '4c0e5368b0171f1e4300cbbcebc18ca8.jpg', 'http://yansen.dev.codigo.id/myr/siprama-recruitment-cms/public_assets/uploads/4c0e5368b0171f1e4300cbbcebc18ca8.jpg', 'A', 'a', 'a', '1', '0', '2016-10-23 22:17:53', 'USR0000001516', '2016-10-23 15:20:56', 'USR0000001516'),
('CLIENT00001216', 'BRANCH00116', 'COR TESTING ', ' is repulsive questions contented him few extensive supported. Of remarkably thoroughly he appearance in. Supposing tolerably applauded or of be. Suffering unfeeling so objection agreeable allowance me of. Ask within entire season sex common far who family. As be valley warmth assure on. Park girl they rich hour new well way you. Face ye be me been room we sons fond. Justice joy manners boy met resolve produce. Bed head loud next plan rent had easy add him', 'address', 'phone', 'ini.jpg', '8510ce6ff2b42827cb43d6b355397cbb.jpg', 'http://localhost/siprama-recruitment-cms/public_assets/uploads/8510ce6ff2b42827cb43d6b355397cbb.jpg', 'TE', '+6285768079129', 'leomastakusuma@gmail.com', '1', '0', '2016-09-20 17:35:43', 'USR0000001716', '2016-10-25 10:45:18', 'USR0000001516'),
('CLIENT00001316', 'BRANCH00116', 'a', 'a', 'a', 'a', 'cecep_opt_opt.jpg', '26661481a808db98331f64bf75688980.jpg', 'http://yansen.dev.codigo.id/myr/siprama-recruitment-cms/public_assets/uploads/26661481a808db98331f64bf75688980.jpg', 'a', 'a', 'a', '1', '0', '2016-10-23 22:26:05', 'USR0000001516', '2016-10-23 15:26:05', NULL),
('CLIENT00001416', 'BRANCH00116', 'A', 'a', 'a', 'a', 'cecep_opt_opt.jpg', '0777e9bb20667b0536f14f2687a7256d.jpg', 'http://yansen.dev.codigo.id/myr/siprama-recruitment-cms/public_assets/uploads/0777e9bb20667b0536f14f2687a7256d.jpg', 'a', 'a', 'a', '1', '0', '2016-10-23 22:26:40', 'USR0000001516', '2016-10-23 15:26:40', NULL),
('CLIENT00001516', 'BRANCH00116', 'PT. KARABINAR DJAYA', 'Masih bisa menginputkan data yang sama persis seperti yang sudah ada (Double)', 'Jl. Jalan', '081234567890', 'cecep_opt_opt.jpg', '1151467f9d4eca7c286c59d1122a2c5d.jpg', 'http://yansen.dev.codigo.id/myr/siprama-recruitment-cms/public_assets/uploads/1151467f9d4eca7c286c59d1122a2c5d.jpg', 'KARABINAR', '1', 'asdsadsad', '1', '0', '2016-10-23 22:33:41', 'USR0000001516', '2016-10-23 17:53:27', 'USR0000001516'),
('CLIENT00001616', 'BRANCH00116', 'DS/Direct Sales', 'Masih bisa menginputkan data yang sama persis seperti yang sudah ada (Double)', 'Jl. Jalan', '081234567890', '', '', '', 'a', 'a', 'asdsadsad', '1', '0', '2016-10-23 22:34:08', 'USR0000001516', '2016-10-23 15:34:08', NULL),
('CLIENT00001716', 'BRANCH00116', 'www.mysite.com', 'www.mysite.com', 'www.mysite.com', 'www.mysite.com', '', '', '', 'www.mysite.com', 'www.mysite.com', 'www.mysite.com', '1', '0', '2016-10-23 22:34:45', 'USR0000001516', '2016-10-23 15:34:45', NULL),
('CLIENT00001816', 'BRANCH00116', 'COR TESTING', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsu', 'وضع ابن الهيثم تصور واضح للعلاقة بين النموذج الرياضي المثالي ومنظومة الظواهر الملحوظة.', 'Римский император Констан', '', '', '', 'LOREM IPSUM DOLOR SIT AMET, Римский император', '123', 'gmail@a.com', '1', '0', '2016-10-23 22:36:54', 'USR0000001516', '2016-10-25 10:46:24', 'USR0000001516'),
('CLIENT00001916', 'BRANCH00116', 'Nice site,  I think I\'ll take it. [removed]al', '&lt;blink&gt;Hello there&lt;/blink&gt;', '\'-prompt&#40;&#41;-\'"-prompt&#40;&#41;-"', '"-prompt&#40;&#41;-"', '', '', '', '<i><b>Bold</i></b>', ' Space on both sides ', '  leading tabs and spaces', '1', '0', '2016-10-23 22:44:12', 'USR0000001516', '2016-10-23 15:44:12', NULL),
('CLIENT00002416', 'BRANCH00116', 'COR TESTING', 'Cor Testing', 'Cor Testing', '121', '', '', '', 'TESTING', '123123', 'testing@gmai.com', '1', '0', '2016-10-25 17:18:28', 'USR0000001516', '2016-10-25 10:45:28', 'USR0000001516');

-- --------------------------------------------------------

--
-- Table structure for table `cms_tm_client_attachment`
--

CREATE TABLE `cms_tm_client_attachment` (
  `client_attachment_id` varchar(30) NOT NULL COMMENT 'CREATORATT + 000001 + ddmmyy',
  `client_id` varchar(30) NOT NULL COMMENT 'fk cms_tm_creator',
  `type_id` varchar(25) NOT NULL COMMENT 'fk sys_type',
  `_url` varchar(300) DEFAULT NULL,
  `_real_name` varchar(300) DEFAULT NULL,
  `_enc_name` varchar(150) DEFAULT NULL,
  `_caption` text,
  `_position` smallint(6) DEFAULT NULL COMMENT 'untuk lampiran yang sifatnya urutan',
  `_delete` enum('0','1') NOT NULL DEFAULT '0',
  `create_date` datetime NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cms_tm_fe_homeslider`
--

CREATE TABLE `cms_tm_fe_homeslider` (
  `homeslider_no` bigint(20) NOT NULL,
  `multimediabank_no` varchar(30) DEFAULT NULL COMMENT 'fk cms_tm_multimediabank_',
  `_title` varchar(100) DEFAULT NULL,
  `_desc` text CHARACTER SET utf8mb4,
  `_position` smallint(6) NOT NULL COMMENT 'urutan',
  `_active` enum('0','1') NOT NULL DEFAULT '0',
  `_delete` enum('0','1') NOT NULL DEFAULT '0',
  `create_date` datetime NOT NULL,
  `create_by` varchar(25) NOT NULL COMMENT 'fk cms_tm_user_',
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_update_by` varchar(25) DEFAULT NULL COMMENT 'fk cms_tm_user_'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cms_tm_fe_homeslider`
--

INSERT INTO `cms_tm_fe_homeslider` (`homeslider_no`, `multimediabank_no`, `_title`, `_desc`, `_position`, `_active`, `_delete`, `create_date`, `create_by`, `last_update`, `last_update_by`) VALUES
(1, NULL, '', '', 3, '0', '0', '0000-00-00 00:00:00', 'USR0000001516', '2016-10-28 16:31:00', 'USR0000001516'),
(2, 'MMDBANK00000005102016', 'QWEQWEQWE', '<p>eqeqqweqwe</p>\r\n', 2, '1', '0', '2016-10-28 23:30:48', 'USR0000001516', '2016-10-28 16:31:04', 'USR0000001516'),
(3, 'MMDBANK00000005102016', 'QWEQWEQWE', '<p>eqeqqweqwe</p>\r\n', 1, '1', '0', '2016-10-28 23:30:55', 'USR0000001516', '2016-10-28 16:31:04', 'USR0000001516'),
(4, NULL, '', '', 4, '0', '0', '0000-00-00 00:00:00', 'USR0000001516', '2016-10-28 16:30:18', NULL),
(5, NULL, '', '', 5, '0', '0', '0000-00-00 00:00:00', 'USR0000001516', '2016-10-28 16:30:18', NULL),
(6, NULL, '', '', 6, '0', '0', '0000-00-00 00:00:00', 'USR0000001516', '2016-10-28 16:30:18', NULL),
(7, NULL, '', '', 7, '0', '0', '0000-00-00 00:00:00', 'USR0000001516', '2016-10-28 16:30:18', NULL),
(8, NULL, '', '', 8, '0', '0', '0000-00-00 00:00:00', 'USR0000001516', '2016-10-28 16:28:59', NULL),
(9, NULL, '', '', 9, '0', '0', '0000-00-00 00:00:00', 'USR0000001516', '2016-10-28 16:28:40', NULL),
(10, NULL, '', '', 10, '0', '0', '0000-00-00 00:00:00', 'USR0000001516', '2016-10-28 16:27:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cms_tm_location`
--

CREATE TABLE `cms_tm_location` (
  `location_no` varchar(30) NOT NULL,
  `type_location_id` varchar(25) NOT NULL COMMENT 'fk sys_type (TYPELOC01)',
  `_location_country_no` varchar(30) NOT NULL COMMENT 'FK Self',
  `_parent_location_no` varchar(30) DEFAULT NULL COMMENT 'FK Self',
  `_name` varchar(60) NOT NULL,
  `name_on_gmaps` varchar(60) DEFAULT NULL,
  `_desc` varchar(200) DEFAULT NULL,
  `_latitude` varchar(20) DEFAULT NULL,
  `_longitude` varchar(20) DEFAULT NULL,
  `_active` enum('0','1') NOT NULL DEFAULT '1',
  `_delete` enum('0','1') NOT NULL DEFAULT '0',
  `create_date` datetime NOT NULL,
  `create_by` varchar(25) DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_update_by` varchar(25) DEFAULT NULL COMMENT 'fk cms_tm_user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cms_tm_location`
--

INSERT INTO `cms_tm_location` (`location_no`, `type_location_id`, `_location_country_no`, `_parent_location_no`, `_name`, `name_on_gmaps`, `_desc`, `_latitude`, `_longitude`, `_active`, `_delete`, `create_date`, `create_by`, `last_update`, `last_update_by`) VALUES
('LOC000000042016', 'TYPELOC01', 'LOC000000042016', NULL, 'Indonesia ', 'Indonesia', 'Indonesia', NULL, NULL, '0', '0', '2016-09-27 21:33:14', 'USR0000001716', '2016-09-27 16:16:56', 'USR0000001716'),
('LOC000000102016', 'TYPELOC02', 'LOC000000042016', 'LOC000000042016', 'Lampung', 'Lampung', 'Lampung', NULL, NULL, '1', '0', '2016-09-27 21:37:09', 'USR0000001716', '2016-09-27 16:17:09', 'USR0000001716'),
('LOC000000452016', 'TYPELOC03', 'LOC000000042016', 'LOC000000102016', 'Bandar Lampung ', 'Bandar Lampung ', 'Bandar Lampung ', NULL, NULL, '1', '0', '2016-09-27 22:02:14', 'USR0000001716', '2016-09-27 16:17:16', 'USR0000001716'),
('LOC000000492016', 'TYPELOC02', 'LOC000000042016', 'LOC000000042016', 'D.K.I JAKARTA', 'Jakarta', 'Daeah Kota Istimewa Jakarta', NULL, NULL, '1', '0', '2016-10-14 11:14:10', 'USR0000001516', '0000-00-00 00:00:00', NULL),
('LOC000000502016', 'TYPELOC02', 'LOC000000042016', 'LOC000000042016', 'JAWA BARAT', 'Bandung', 'Bandung', NULL, NULL, '1', '0', '2016-10-14 11:20:20', 'USR0000001516', '0000-00-00 00:00:00', NULL),
('LOC000000512016', 'TYPELOC03', 'LOC000000042016', 'LOC000000502016', 'BOGOR', 'BOGOR', 'BOGOR', NULL, NULL, '1', '0', '2016-10-14 11:27:47', 'USR0000001516', '0000-00-00 00:00:00', NULL),
('LOC000000522016', 'TYPELOC03', 'LOC000000042016', 'LOC000000492016', 'JAKARTA', 'Jakarta', 'JAKARTA', NULL, NULL, '1', '0', '2016-10-14 11:34:09', 'USR0000001516', '0000-00-00 00:00:00', NULL),
('LOC000000532016', 'TYPELOC03', 'LOC000000042016', 'LOC000000502016', 'DEPOK', 'Sawangan', 'Depok', NULL, NULL, '1', '0', '2016-10-14 11:36:14', 'USR0000001516', '0000-00-00 00:00:00', NULL),
('LOC000000542016', 'TYPELOC02', 'LOC000000042016', 'LOC000000042016', 'BANTEN', 'BANTEN', 'Tangsel', NULL, NULL, '1', '0', '2016-10-17 15:29:04', 'USR0000001516', '0000-00-00 00:00:00', NULL),
('LOC000000552016', 'TYPELOC01', 'LOC000000552016', NULL, 'Amerika', 'USA', 'Get Rekt', NULL, NULL, '0', '1', '2016-10-23 10:44:22', 'USR0000001516', '0000-00-00 00:00:00', NULL),
('LOC000000582016', 'TYPELOC02', 'LOC000000622016', 'LOC000000552016', 'New Jersey', 'New Jersey', 'New Jersey', NULL, NULL, '0', '1', '2016-10-23 10:46:35', 'USR0000001516', '2016-10-23 04:09:03', 'USR0000001516'),
('LOC000000602016', 'TYPELOC03', 'LOC000000552016', 'LOC000000582016', 'Jersey City', 'Jersey City', 'City Of Jersey', NULL, NULL, '1', '0', '2016-10-23 10:51:03', 'USR0000001516', '0000-00-00 00:00:00', NULL),
('LOC000000612016', 'TYPELOC03', 'LOC000000622016', 'LOC000000642016', 'YorkShire City', 'YorkShire City', 'YorkShire City', NULL, NULL, '1', '0', '2016-10-23 11:00:24', 'USR0000001516', '2016-10-23 04:10:23', 'USR0000001516'),
('LOC000000622016', 'TYPELOC01', 'LOC000000622016', NULL, 'America', 'USA', 'Fat', NULL, NULL, '0', '1', '2016-10-23 11:02:48', 'USR0000001516', '0000-00-00 00:00:00', NULL),
('LOC000000632016', 'TYPELOC02', 'LOC000000622016', 'LOC000000622016', 'Texas', 'Kentucky', 'Kentucky', NULL, NULL, '0', '1', '2016-10-23 11:07:50', 'USR0000001516', '0000-00-00 00:00:00', NULL),
('LOC000000642016', 'TYPELOC02', 'LOC000000622016', 'LOC000000622016', 'Texas', 'Kentucky', 'Kentucky', NULL, NULL, '1', '0', '2016-10-23 11:10:00', 'USR0000001516', '0000-00-00 00:00:00', NULL),
('LOC000000652016', 'TYPELOC03', 'LOC000000622016', 'LOC000000642016', 'Galvaston', 'New MexicoGalvaston', 'Galvaston', NULL, NULL, '1', '0', '2016-10-23 11:13:00', 'USR0000001516', '2016-10-23 04:15:39', 'USR0000001516'),
('LOC000000662016', 'TYPELOC03', 'LOC000000622016', 'LOC000000642016', 'Dallas', 'Dallas', 'Dallas', NULL, NULL, '1', '0', '2016-10-23 11:13:57', 'USR0000001516', '0000-00-00 00:00:00', NULL),
('LOC000000672016', 'TYPELOC03', 'LOC000000622016', 'LOC000000642016', 'Houston', 'Houston', 'Houston', NULL, NULL, '1', '0', '2016-10-23 11:14:25', 'USR0000001516', '0000-00-00 00:00:00', NULL),
('LOC000000682016', 'TYPELOC03', 'LOC000000622016', 'LOC000000642016', 'Austin', 'Austin', 'Austin', NULL, NULL, '1', '0', '2016-10-23 11:14:50', 'USR0000001516', '0000-00-00 00:00:00', NULL),
('LOC000000692016', 'TYPELOC02', 'LOC000000622016', 'LOC000000622016', 'California', 'California', 'California', NULL, NULL, '1', '0', '2016-10-23 11:17:05', 'USR0000001516', '0000-00-00 00:00:00', NULL),
('LOC000000702016', 'TYPELOC03', 'LOC000000622016', 'LOC000000692016', 'Los Angeles', 'Los Angeles', 'Los Angeles', NULL, NULL, '1', '0', '2016-10-23 11:17:28', 'USR0000001516', '0000-00-00 00:00:00', NULL),
('LOC000000712016', 'TYPELOC03', 'LOC000000622016', 'LOC000000692016', 'San Fransisco', 'San Fransisco', 'San Fransisco', NULL, NULL, '1', '0', '2016-10-23 11:17:56', 'USR0000001516', '0000-00-00 00:00:00', NULL),
('LOC000000722016', 'TYPELOC01', 'LOC000000722016', NULL, ',\';', ',"\');', ',"\');', NULL, NULL, '0', '1', '2016-10-23 11:25:41', 'USR0000001516', '0000-00-00 00:00:00', NULL),
('LOC000000732016', 'TYPELOC01', 'LOC000000732016', NULL, '-', '-', '-', NULL, NULL, '0', '1', '2016-10-23 11:26:02', 'USR0000001516', '0000-00-00 00:00:00', NULL),
('LOC000000742016', 'TYPELOC01', 'LOC000000622016', 'LOC000000692016', 'YorkShire City', 'YorkShire City', 'YorkShire City', NULL, NULL, '0', '1', '2016-10-23 11:47:33', 'USR0000001516', '0000-00-00 00:00:00', NULL),
('LOC000000792016', 'TYPELOC01', 'LOC000000792016', NULL, 'Indonesia', 'wrqwr', 'qwr', NULL, NULL, '0', '1', '2016-10-26 17:19:33', 'USR0000001516', '0000-00-00 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cms_tm_lowongan`
--

CREATE TABLE `cms_tm_lowongan` (
  `lowongan_no` varchar(30) NOT NULL,
  `branch_id` varchar(20) NOT NULL COMMENT 'fk sys_tm_branch',
  `client_id` varchar(30) NOT NULL COMMENT 'fk cms_tm_client',
  `type_lowongan_id` varchar(25) NOT NULL COMMENT 'FK sys_type_ (CTGLWGN)',
  `pekerjaan_branch_no` varchar(30) NOT NULL COMMENT 'fk cms_tm_pekerjaan_branch_',
  `location_no` varchar(30) NOT NULL COMMENT 'fk cms_tm_location',
  `_name` varchar(45) NOT NULL,
  `_desc` text NOT NULL,
  `_persyaratan` text,
  `_date_from` date NOT NULL,
  `_date_thru` date NOT NULL,
  `_active` enum('0','1') NOT NULL DEFAULT '1',
  `_delete` enum('0','1') NOT NULL DEFAULT '0',
  `create_date` datetime NOT NULL,
  `create_by` varchar(25) DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_update_by` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cms_tm_lowongan`
--

INSERT INTO `cms_tm_lowongan` (`lowongan_no`, `branch_id`, `client_id`, `type_lowongan_id`, `pekerjaan_branch_no`, `location_no`, `_name`, `_desc`, `_persyaratan`, `_date_from`, `_date_thru`, `_active`, `_delete`, `create_date`, `create_by`, `last_update`, `last_update_by`) VALUES
('LWGN00000012016', 'BRANCH00116', 'CLIENT00000616', 'CTGLWGN01', 'PKJBRANCH00001716', 'LOC000000532016', 'Adobe', '<h3>Persyaratan :</h3>\r\n\r\n<p>- Umur max 28thn</p>\r\n', '<h3>Jobdesk :</h3>\r\n\r\n<p>- Membuat Penggajian</p>\r\n', '2016-10-25', '2016-11-06', '0', '1', '2016-09-29 09:58:48', 'USR0000001516', '2016-11-05 15:55:42', 'USR0000001516'),
('LWGN00000302016', 'BRANCH00116', 'CLIENT00000716', 'CTGLWGN01', 'PKJBRANCH00001116', 'LOC000000522016', 'Open Hiring Uniqlo PIK', '<div class="col-lg-12 col-md-12 col-sm-12">\r\n<h2 class="job-ads-h2">DESKRIPSI PEKERJAAN</h2>\r\n\r\n<div class="unselectable wrap-text" id="job_description" itemprop="description">\r\n<div>\r\n<div xss="removed"><strong>Responsibilities:</strong></div>\r\n\r\n<div xss="removed"> </div>\r\n\r\n<ul>\r\n <li xss="removed">Collaborate with Product and cross functional teams to design new mobile apps/Web  and optimize existing mobile apps/web.</li>\r\n <li xss="removed">Design visually pleasing Web/mobile products with an emphasis on conversion and meeting company goals</li>\r\n <li xss="removed">Graphic production and resizing of graphics (Adobe Creative Suite - Photoshop, Sketch, Illustrator, InDesign)</li>\r\n <li xss="removed">Develop conceptual diagrams, wire-frames, detailed visual mockups and high fidelity functioning prototypes to communicate high-level design strategies and detailed interaction behaviors</li>\r\n <li xss="removed">Develop and maintain effective specifications and design patterns</li>\r\n <li xss="removed">Apply basic user interface and experience design</li>\r\n <li xss="removed">Should be detailed with practical understanding of best practices in user experience design</li>\r\n</ul>\r\n\r\n<div xss="removed"> </div>\r\n</div>\r\n</div>\r\n</div>\r\n', '<div class="col-lg-12 col-md-12 col-sm-12">\r\n<h2 class="job-ads-h2"> </h2>\r\n\r\n<div xss="removed"><strong>Skills Set Required:</strong></div>\r\n\r\n<div> </div>\r\n\r\n<div class="unselectable wrap-text" id="job_description" itemprop="description">\r\n<div>\r\n<ul>\r\n <li xss="removed">3-5 years Web/ mobile design experience for E-Commerce  company, Technology, Internet company or web design consulting firm/agency</li>\r\n <li xss="removed">Experience with native mobile app/Web development.</li>\r\n <li xss="removed">Need to have a creative and product design mindset.</li>\r\n <li xss="removed">Familiar with Mobile/Web Guidelines.</li>\r\n <li xss="removed">Data-driven analytics based design approach.</li>\r\n <li xss="removed">Detail focused, highly organized and able to multi-task and effectively manage the timely delivery of work against very short deadlines.</li>\r\n <li xss="removed">Excellent interpersonal and presentation skills.</li>\r\n</ul>\r\n</div>\r\n\r\n<div> </div>\r\n</div>\r\n</div>\r\n', '2016-10-12', '2016-10-28', '0', '1', '2016-10-12 14:22:24', 'USR0000001516', '2016-11-05 15:56:22', 'USR0000001516'),
('LWGN00000312016', 'BRANCH00116', 'CLIENT00000716', 'CTGLWGN01', 'PKJBRANCH00001216', 'LOC000000522016', 'Open Hiring Uniqlo', '<h2 class="job-ads-h2"> </h2>\r\n\r\n<div class="unselectable wrap-text" id="job_description" itemprop="description">\r\n<div><strong>Job Description</strong></div>\r\n\r\n<div>- Pendidikan Min SMU</div>\r\n\r\n<div>- Max umur 20thn</div>\r\n\r\n<div>- Tingi min 150 cm</div>\r\n</div>\r\n', '<p>jobdesk:</p>\r\n\r\n<p>- Melayani pembeli</p>\r\n\r\n<p>- Merapihkan Baj</p>\r\n', '2016-10-17', '2016-10-20', '0', '1', '2016-10-12 15:12:01', 'USR0000001516', '2016-10-23 19:03:09', 'USR0000001516'),
('LWGN00000352016', 'BRANCH00116', 'CLIENT00001516', 'CTGLWGN01', 'PKJBRANCH00002916', 'LOC000000702016', 'Karabinar Dwika', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>\r\n', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>\r\n', '2016-10-25', '2016-10-31', '1', '0', '2016-10-24 01:49:38', 'USR0000001516', '2016-10-26 10:32:04', 'USR0000001516'),
('LWGN00000362016', 'BRANCH00116', 'CLIENT00001516', 'CTGLWGN02', 'PKJBRANCH00001716', 'LOC000000682016', 'Lorem ipsum dolor sit amet', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>\r\n', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>\r\n', '2016-10-12', '2016-10-17', '1', '0', '2016-10-24 01:59:09', 'USR0000001516', '2016-11-05 15:56:35', 'USR0000001516'),
('LWGN00000382016', 'BRANCH00116', 'CLIENT00000716', 'CTGLWGN01', 'PKJBRANCH00001116', 'LOC000000712016', 'Open Hiring Uniqlo', '<p>SFBZDFBEB </p>\r\n', '<p>EWNAENETNE</p>\r\n', '2016-11-05', '2016-11-08', '1', '0', '2016-10-25 13:40:12', 'USR0000001516', '2016-11-05 15:57:40', 'USR0000001516'),
('LWGN00000392016', 'BRANCH00116', 'CLIENT00002416', 'CTGLWGN01', 'PKJBRANCH00002316', 'LOC000000452016', 'teets', '', '', '2016-10-25', '2016-10-27', '0', '1', '2016-10-26 10:38:40', 'USR0000001516', '2016-11-05 15:56:30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cms_tm_lowongan_promoted`
--

CREATE TABLE `cms_tm_lowongan_promoted` (
  `lowongan_promoted_no` varchar(30) NOT NULL,
  `branch_id` varchar(20) NOT NULL COMMENT 'fk sys_tm_branch_',
  `lowongan_no` varchar(30) DEFAULT NULL COMMENT 'fk cms_tm_lowongan_',
  `_cover_real_name` varchar(300) DEFAULT NULL,
  `_cover_enc_name` varchar(100) DEFAULT NULL,
  `_cover_url` varchar(200) DEFAULT NULL,
  `_date_from` datetime DEFAULT NULL,
  `_date_thru` datetime DEFAULT NULL,
  `_position` smallint(6) NOT NULL COMMENT 'urutan',
  `_active` enum('0','1') NOT NULL DEFAULT '0',
  `_delete` enum('0','1') NOT NULL DEFAULT '0',
  `create_date` datetime NOT NULL,
  `create_by` varchar(25) NOT NULL COMMENT 'fk cms_tm_user_',
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_update_by` varchar(25) DEFAULT NULL COMMENT 'fk cms_tm_user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cms_tm_lowongan_promoted`
--

INSERT INTO `cms_tm_lowongan_promoted` (`lowongan_promoted_no`, `branch_id`, `lowongan_no`, `_cover_real_name`, `_cover_enc_name`, `_cover_url`, `_date_from`, `_date_thru`, `_position`, `_active`, `_delete`, `create_date`, `create_by`, `last_update`, `last_update_by`) VALUES
('LWGNPROMOTE00000123102016', 'BRANCH00116', NULL, '', '', '', NULL, NULL, 1, '0', '0', '2016-10-28 23:55:04', 'USR0000001516', '2016-10-28 16:57:00', NULL),
('LWGNPROMOTE00000124102016', 'BRANCH00116', NULL, '', '', '', NULL, NULL, 2, '0', '0', '2016-10-28 23:55:04', 'USR0000001516', '2016-10-28 16:55:04', NULL),
('LWGNPROMOTE00000125102016', 'BRANCH00116', NULL, '', '', '', NULL, NULL, 3, '0', '0', '2016-10-28 23:55:04', 'USR0000001516', '2016-10-28 16:55:04', NULL),
('LWGNPROMOTE00000126102016', 'BRANCH00116', NULL, '', '', '', NULL, NULL, 4, '0', '0', '2016-10-28 23:55:04', 'USR0000001516', '2016-10-28 16:55:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cms_tm_multimediabank`
--

CREATE TABLE `cms_tm_multimediabank` (
  `multimediabank_no` varchar(30) NOT NULL,
  `multimedia_type_id` varchar(25) NOT NULL COMMENT 'fk sys_type_ cat 29',
  `_title` varchar(100) DEFAULT NULL,
  `_desc` text CHARACTER SET utf8mb4,
  `_url` varchar(300) DEFAULT NULL,
  `_real_name` varchar(300) DEFAULT NULL,
  `_enc_name` varchar(150) DEFAULT NULL,
  `_delete` enum('0','1') NOT NULL DEFAULT '0',
  `create_date` datetime NOT NULL,
  `create_by` varchar(25) NOT NULL COMMENT 'fk cms_tm_user_',
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_update_by` varchar(25) DEFAULT NULL COMMENT 'fk cms_tm_user_'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cms_tm_multimediabank`
--

INSERT INTO `cms_tm_multimediabank` (`multimediabank_no`, `multimedia_type_id`, `_title`, `_desc`, `_url`, `_real_name`, `_enc_name`, `_delete`, `create_date`, `create_by`, `last_update`, `last_update_by`) VALUES
('MMDBANK00000005102016', 'MULTIMEDIA01', 'QWEQWEQWE', 'eqeqqweqwe', 'http://localhost/siprama-recruitment-cms/public_assets/uploads/c18513bbfb108b166c0e92f426f592f8.jpg', '5.jpg', 'c18513bbfb108b166c0e92f426f592f8.jpg', '0', '2016-10-27 21:44:26', 'USR0000001516', '2016-10-27 15:07:17', 'USR0000001516'),
('MMDBANK00000007102016', 'MULTIMEDIA01', 'Gambar Ayam', 'Ayam Adalah', 'http://localhost/siprama-recruitment-cms/public_assets/uploads/a11cc5e778cfb2c194922d563a5f9e86.jpg', '2.jpg', 'a11cc5e778cfb2c194922d563a5f9e86.jpg', '0', '2016-10-27 22:07:43', 'USR0000001516', '2016-10-27 15:07:43', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cms_tm_pekerjaan`
--

CREATE TABLE `cms_tm_pekerjaan` (
  `pekerjaan_id` varchar(30) NOT NULL,
  `_name` varchar(45) NOT NULL,
  `_parent_pekerjaan_id` varchar(30) DEFAULT 'fk self',
  `_active` enum('0','1') NOT NULL DEFAULT '0',
  `_delete` enum('0','1') NOT NULL DEFAULT '0',
  `create_date` datetime NOT NULL,
  `create_by` varchar(25) DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_update_by` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cms_tm_pekerjaan`
--

INSERT INTO `cms_tm_pekerjaan` (`pekerjaan_id`, `_name`, `_parent_pekerjaan_id`, `_active`, `_delete`, `create_date`, `create_by`, `last_update`, `last_update_by`) VALUES
('PKJ000000012016', 'System Analyst', 'NULL', '1', '1', '2016-09-27 10:28:20', 'USR0000001716', '2016-10-22 19:21:55', NULL),
('PKJ000000022016', 'SPG', 'NULL', '1', '0', '2016-09-29 10:00:17', 'USR0000001716', '2016-09-29 03:00:17', NULL),
('PKJ000000032016', 'Leader', 'NULL', '1', '0', '2016-09-29 10:00:29', 'USR0000001716', '2016-09-29 03:00:29', NULL),
('PKJ000000042016', 'UI/UX', 'NULL', '1', '0', '2016-10-12 14:10:30', 'USR0000001716', '2016-10-12 07:11:48', NULL),
('PKJ000000052016', 'WEB Developer', 'NULL', '1', '0', '2016-10-12 14:10:57', 'USR0000001716', '2016-10-12 07:12:15', NULL),
('PKJ000000062016', 'SPB & SPG', 'NULL', '1', '0', '2016-10-14 10:38:05', 'USR0000001716', '2016-10-14 03:40:48', NULL),
('PKJ000000072016', 'SPB', 'NULL', '1', '0', '2016-10-14 10:38:14', 'USR0000001716', '2016-10-14 03:40:58', NULL),
('PKJ000000082016', 'MD/Merchandiser', 'NULL', '1', '0', '2016-10-14 10:38:36', 'USR0000001716', '2016-10-14 03:41:19', NULL),
('PKJ000000092016', 'TL', 'NULL', '1', '0', '2016-10-14 10:38:46', 'USR0000001716', '2016-10-14 03:41:29', NULL),
('PKJ000000102016', 'PIC', 'NULL', '1', '0', '2016-10-14 10:38:54', 'USR0000001716', '2016-10-14 03:41:37', NULL),
('PKJ000000112016', 'DS/Direct Sales ', 'NULL', '1', '1', '2016-10-14 10:39:08', 'USR0000001716', '2016-10-24 07:44:09', 'USR0000001516'),
('PKJ000000122016', 'Testing', 'NULL', '1', '1', '2016-10-18 22:16:33', 'USR0000001716', '2016-10-18 15:24:09', NULL),
('PKJ000000132016', 'testing 2', 'NULL', '1', '1', '2016-10-18 22:21:02', 'USR0000001716', '2016-10-18 15:27:29', NULL),
('PKJ000000142016', 'Korlap', 'NULL', '1', '1', '2016-10-20 08:49:52', 'USR0000001716', '2016-10-24 07:45:59', NULL),
('PKJ000000162016', 'System Analyst (Junior)', 'PKJ000000012016', '1', '0', '2016-10-23 02:20:03', 'USR0000001516', '2016-10-22 19:20:03', NULL),
('PKJ000000172016', 'SPG Supervisior', 'PKJ000000172016', '1', '1', '2016-10-23 02:20:48', 'USR0000001516', '2016-10-22 19:22:00', 'USR0000001516'),
('PKJ000000182016', 'Korlap', 'NULL', '1', '0', '2016-10-23 22:30:19', 'USR0000001516', '2016-10-23 15:30:19', NULL),
('PKJ000000202016', 'DS/Direct Sales ', 'NULL', '1', '0', '2016-10-24 14:36:28', 'USR0000001516', '2016-10-24 07:43:46', NULL),
('PKJ000000242016', 'testing222', 'PKJ000000242016', '1', '0', '2016-11-08 12:03:31', 'USR0000001516', '2016-11-08 05:06:35', 'USR0000001516'),
('PKJ000000252016', 'testing', 'NULL', '1', '0', '2016-11-08 12:04:07', 'USR0000001516', '2016-11-08 05:11:51', 'USR0000001516'),
('PKJ000000262016', 'testaja', 'NULL', '1', '0', '2016-11-08 12:04:25', 'USR0000001516', '2016-11-08 05:12:00', 'USR0000001516'),
('PKJ000000272016', 'abcs', 'NULL', '1', '0', '2016-11-08 12:12:18', 'USR0000001516', '2016-11-08 05:12:18', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cms_tm_pekerjaan_branch`
--

CREATE TABLE `cms_tm_pekerjaan_branch` (
  `pekerjaan_branch_no` varchar(30) NOT NULL,
  `branch_id` varchar(20) NOT NULL COMMENT 'fk sys_tm_branch',
  `pekerjaan_id` varchar(30) NOT NULL COMMENT 'fk cms_tm_pekerjaan',
  `_active` enum('0','1') NOT NULL DEFAULT '0',
  `_delete` enum('0','1') NOT NULL DEFAULT '0',
  `create_date` datetime NOT NULL,
  `create_by` varchar(25) DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_update_by` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cms_tm_pekerjaan_branch`
--

INSERT INTO `cms_tm_pekerjaan_branch` (`pekerjaan_branch_no`, `branch_id`, `pekerjaan_id`, `_active`, `_delete`, `create_date`, `create_by`, `last_update`, `last_update_by`) VALUES
('PKJBRANCH00000116', 'BRANCH00116', 'PKJ000000012016', '1', '1', '2016-09-28 13:05:38', 'USR0000001716', '2016-10-14 03:18:30', 'USR0000001716'),
('PKJBRANCH00000516', 'BRANCH00116', 'PKJ000000022016', '1', '0', '2016-10-05 22:19:25', 'USR0000001516', '2016-10-14 03:24:54', 'USR0000001516'),
('PKJBRANCH00000616', 'BRANCH00116', 'PKJ000000042016', '1', '0', '2016-10-12 14:11:22', 'USR0000001516', '2016-10-12 07:12:40', NULL),
('PKJBRANCH00000716', 'BRANCH00116', 'PKJ000000052016', '1', '1', '2016-10-12 14:11:27', 'USR0000001516', '2016-10-14 03:19:08', NULL),
('PKJBRANCH00000816', 'BRANCH00116', 'PKJ000000022016', '1', '1', '2016-10-14 10:24:41', 'USR0000001516', '2016-10-14 03:43:44', NULL),
('PKJBRANCH00001116', 'BRANCH00116', 'PKJ000000062016', '1', '0', '2016-10-14 10:40:02', 'USR0000001516', '2016-10-14 03:42:45', NULL),
('PKJBRANCH00001216', 'BRANCH00116', 'PKJ000000072016', '1', '0', '2016-10-14 10:40:09', 'USR0000001516', '2016-10-14 03:42:52', NULL),
('PKJBRANCH00001416', 'BRANCH00116', 'PKJ000000082016', '1', '0', '2016-10-14 10:40:23', 'USR0000001516', '2016-10-14 03:43:06', NULL),
('PKJBRANCH00001516', 'BRANCH00116', 'PKJ000000082016', '1', '1', '2016-10-14 10:41:11', 'USR0000001516', '2016-10-14 03:43:57', NULL),
('PKJBRANCH00001616', 'BRANCH00116', 'PKJ000000092016', '1', '0', '2016-10-14 10:41:23', 'USR0000001516', '2016-10-14 03:44:06', NULL),
('PKJBRANCH00001716', 'BRANCH00116', 'PKJ000000102016', '1', '0', '2016-10-14 10:41:29', 'USR0000001516', '2016-10-14 03:44:12', NULL),
('PKJBRANCH00001816', 'BRANCH00116', 'PKJ000000112016', '1', '1', '2016-10-14 10:41:34', 'USR0000001516', '2016-10-24 07:44:10', NULL),
('PKJBRANCH00001916', 'BRANCH00116', 'PKJ000000012016', '1', '1', '2016-10-14 10:42:18', 'USR0000001516', '2016-10-22 19:21:55', NULL),
('PKJBRANCH00002016', 'BRANCH00116', 'PKJ000000052016', '1', '0', '2016-10-14 10:42:38', 'USR0000001516', '2016-10-14 03:45:21', NULL),
('PKJBRANCH00002216', 'BRANCH00116', 'PKJ000000062016', '1', '0', '2016-10-14 10:55:46', 'USR0000001516', '2016-10-14 03:55:46', NULL),
('PKJBRANCH00002316', 'BRANCH00116', 'PKJ000000022016', '1', '0', '2016-10-17 15:27:12', 'USR0000001516', '2016-10-17 08:27:12', NULL),
('PKJBRANCH00002416', 'BRANCH00116', 'PKJ000000122016', '1', '1', '2016-10-18 22:16:33', 'USR0000001716', '2016-10-18 15:28:46', NULL),
('PKJBRANCH00002516', 'BRANCH00116', 'PKJ000000132016', '1', '1', '2016-10-18 22:21:02', 'USR0000001716', '2016-10-18 15:27:29', NULL),
('PKJBRANCH00002616', 'BRANCH00116', 'PKJ000000142016', '1', '1', '2016-10-20 08:49:52', 'USR0000001716', '2016-10-24 07:45:59', NULL),
('PKJBRANCH00002816', 'BRANCH00116', 'PKJ000000162016', '1', '0', '2016-10-23 02:20:03', 'USR0000001516', '2016-10-22 19:20:03', NULL),
('PKJBRANCH00002916', 'BRANCH00116', 'PKJ000000172016', '1', '1', '2016-10-23 02:20:48', 'USR0000001516', '2016-10-22 19:22:00', NULL),
('PKJBRANCH00003016', 'BRANCH00116', 'PKJ000000182016', '1', '0', '2016-10-23 22:30:19', 'USR0000001516', '2016-10-23 15:30:19', NULL),
('PKJBRANCH00003216', 'BRANCH00116', 'PKJ000000202016', '1', '0', '2016-10-24 14:36:28', 'USR0000001516', '2016-10-24 07:43:46', NULL),
('PKJBRANCH00003616', 'BRANCH00116', 'PKJ000000242016', '1', '0', '2016-11-08 12:03:31', 'USR0000001516', '2016-11-08 05:03:31', NULL),
('PKJBRANCH00003716', 'BRANCH00116', 'PKJ000000252016', '1', '0', '2016-11-08 12:04:07', 'USR0000001516', '2016-11-08 05:04:07', NULL),
('PKJBRANCH00003816', 'BRANCH00116', 'PKJ000000262016', '1', '0', '2016-11-08 12:04:25', 'USR0000001516', '2016-11-08 05:04:25', NULL),
('PKJBRANCH00003916', 'BRANCH00116', 'PKJ000000272016', '1', '0', '2016-11-08 12:12:18', 'USR0000001516', '2016-11-08 05:12:18', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cms_tm_soal`
--

CREATE TABLE `cms_tm_soal` (
  `soal_id` varchar(30) NOT NULL,
  `branch_id` varchar(20) NOT NULL COMMENT 'FK sys_tm_branch',
  `category_soal_id` varchar(25) NOT NULL COMMENT 'fk sys_type',
  `_position` smallint(6) DEFAULT NULL COMMENT 'urutan soal',
  `_pertanyaan` varchar(300) NOT NULL,
  `_opsi_a` varchar(200) NOT NULL,
  `_score_a` decimal(3,2) NOT NULL,
  `_opsi_b` varchar(200) NOT NULL,
  `_score_b` decimal(3,2) NOT NULL,
  `_opsi_c` varchar(200) NOT NULL,
  `_score_c` decimal(3,2) NOT NULL,
  `_opsi_d` varchar(200) NOT NULL,
  `_score_d` decimal(3,2) NOT NULL,
  `_opsi_e` varchar(200) DEFAULT NULL,
  `_score_e` decimal(3,2) DEFAULT NULL,
  `_active` enum('0','1') NOT NULL DEFAULT '1',
  `_delete` enum('0','1') NOT NULL DEFAULT '0',
  `create_date` datetime NOT NULL,
  `create_by` varchar(25) NOT NULL COMMENT 'fk cms_tm_user',
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_update_by` varchar(25) DEFAULT NULL COMMENT 'fk cms_tm_user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cms_tm_soal`
--

INSERT INTO `cms_tm_soal` (`soal_id`, `branch_id`, `category_soal_id`, `_position`, `_pertanyaan`, `_opsi_a`, `_score_a`, `_opsi_b`, `_score_b`, `_opsi_c`, `_score_c`, `_opsi_d`, `_score_d`, `_opsi_e`, `_score_e`, `_active`, `_delete`, `create_date`, `create_by`, `last_update`, `last_update_by`) VALUES
('SOAL0000000022016', 'BRANCH00116', 'CTGSOAL01', 1, 'Apakah itu tanggjung jawab', 'adalah', '2.00', 'adalah', '4.00', 'adalah', '5.00', 'adalah', '6.00', NULL, NULL, '1', '0', '2016-09-26 17:21:40', 'USR0000001716', '2016-09-26 11:53:00', NULL),
('SOAL0000000032016', 'BRANCH00116', 'CTGSOAL01', 2, 'Apakah itu Kejujuran a', 'adalaha aaa', '9.10', 'adalahqaa', '2.00', 'adalah2', '3.00', 'adalah4', '4.00', NULL, NULL, '1', '0', '2016-09-26 17:46:00', 'USR0000001716', '2016-10-06 12:23:58', 'USR0000001716'),
('SOAL0000000262016', 'BRANCH00116', 'CTGSOAL01', 3, '<p><span xss=removed>Hampir semua pegawai di kantor instansi saya meminta uang tanda terimakasih atas pengurusan surat ijin tertentu. Namun menurut peraturan kantor, hal itu tidaklah diperbolehkan, maka saya</span></p>\r\n', 'Ikut melakukannya karena bagaimanapun juga kawan-kawan kantor juga melakukannya', '5.00', 'Melakukannya hanya jika terpaksa membutuhkan uang tambahan untuk keperluan keluarga, sebab gaji kantor memang kecil', '6.00', 'Terkadang saja melakukan hal tersebut', '5.00', 'Berusaha semampunya untuk tidak melakukannya', '9.99', NULL, NULL, '1', '0', '2016-10-13 13:43:24', 'USR0000001516', '2016-10-13 06:45:27', NULL),
('SOAL0000000272016', 'BRANCH00116', 'CTGSOAL01', 4, '<p><span xss=removed>Atasan anda melakukan rekayasa laporan keuangan kantor, maka anda</span><br xss=removed>\r\n </p>\r\n', 'Dalam hati tidak menyetujui hal tersebut', '4.00', 'Hal tersebut sering terjadi di kantor manapun', '5.00', 'Mengingatkan dan melaporkan kepada yang berwenang', '9.99', 'Tidak ingin terlibat dalam proses rekayasa tersebut', '9.99', NULL, NULL, '1', '0', '2016-10-13 13:46:12', 'USR0000001516', '2016-10-13 06:48:15', NULL),
('SOAL0000000282016', 'BRANCH00116', 'CTGSOAL01', 5, '<p><span xss=removed>Bagi saya, bekerja adalah…</span></p>\r\n', 'Beribadah', '7.00', 'Tugas', '8.00', 'Kewajiban', '9.00', 'Kebutuhan', '9.99', NULL, NULL, '1', '0', '2016-10-13 13:58:02', 'USR0000001516', '2016-10-13 07:00:05', NULL),
('SOAL0000000292016', 'BRANCH00116', 'CTGSOAL02', 6, '<p><span xss=removed>Hampir semua pegawai di kantor instansi saya meminta uang tanda terimakasih atas pengurusan surat ijin tertentu. Namun menurut peraturan kantor, hal itu tidaklah </span><span xss=removed>diperbolehkan, maka saya</span></p>\r\n', 'Ikut melakukannya karena bagaimanapun juga kawan-kawan kantor juga melakukannya', '2.00', 'Melakukannya hanya jika terpaksa membutuhkan uang tambahan untuk   keperluan keluarga, sebab gaji kantor memang kecil', '3.00', 'Terkadang saja melakukan hal tersebut', '4.00', 'Berusaha semampunya untuk tidak melakukannya', '5.00', NULL, NULL, '1', '0', '2016-10-13 14:01:53', 'USR0000001516', '2016-10-13 07:03:57', NULL),
('SOAL0000000302016', 'BRANCH00116', 'CTGSOAL02', 7, '<p><span xss=removed>Anda adalah seorang karyawan apotek. Seorang pembeli ingin membeli obat-obatan tertentu yang harus menggunakan resep dokter karena bisa membahayakan </span><span xss=removed>kesehatan. Dia tidak mempunyai resep itu. Namun pembeli tersebut memaksa ingin </span><span xss=removed>m', 'Saya memberikan obat tersebut kepadanya, toh tak ada yang tahu', '3.00', 'Saya ragu-ragu keputusan apa yang saya ambil', '4.00', 'Saya berkonsultasi kepada rekan sejawat dulu', '5.00', 'Saya menolaknya dengan mantap', '3.00', NULL, NULL, '0', '1', '2016-10-13 14:03:07', 'USR0000001516', '2016-10-23 03:35:54', NULL),
('SOAL0000000312016', 'BRANCH00116', 'CTGSOAL02', 8, '<p><span xss=removed>Atasan anda melakukan rekayasa laporan keuangan kantor, maka anda</span><br xss=removed>\r\n </p>\r\n', ' Dalam hati tidak menyetujui hal tersebut', '2.00', 'Hal tersebut sering terjadi di kantor manapun', '3.00', 'Mengingatkan dan melaporkan kepada yang berwenang', '4.00', 'Tidak ingin terlibat dalam proses rekayasa tersebut', '5.00', NULL, NULL, '1', '0', '2016-10-13 14:03:57', 'USR0000001516', '2016-10-13 07:06:00', NULL),
('SOAL0000000322016', 'BRANCH00116', 'CTGSOAL02', 9, '<p><span xss=removed>Andi, teman karib anda, melakukan kecurangan absensi. Maka anda</span></p>\r\n', 'Mentoleransi sebab baru kali ini Andi melakukannya', '2.00', 'Rekan kerja yang lain juga melakukannya, jadi tidaklah mengapa', '3.00', 'Mengingatkan dan menegur', '4.00', 'Menegur dan melaporkan apa adanya kepada atasan', '5.00', NULL, NULL, '1', '0', '2016-10-13 14:05:22', 'USR0000001516', '2016-10-13 07:07:26', NULL),
('SOAL0000000332016', 'BRANCH00116', 'CTGSOAL03', 10, '<p><span xss=removed>Kinerja</span><span xss=removed> organisasi berjalan cukup efisien, </span><span xss=removed>namun</span><span xss=removed> </span><span xss=removed>pimpinan</span><span xss=removed> terkesan </span><span xss=removed>mengontrol </span>situasi dengan sangat ketat. Sikap saya adal', 'Tidak bertindak apapun, cukup dengan mengikuti jalannya arus', '3.00', 'Mengusahakan keterlibatan pegawai dalam pengambilan keputusan', '4.00', 'Mengabaikan saja', '6.00', 'Melakukan apa saja yang dapat dikerjakan utuk membuat pegawai merasa peting', '7.00', NULL, NULL, '1', '0', '2016-10-13 14:07:32', 'USR0000001516', '2016-10-13 07:09:36', NULL),
('SOAL0000000342016', 'BRANCH00116', 'CTGSOAL03', 11, '<p><span xss=removed>Saya </span><span xss=removed>mengajukan</span><span xss=removed> suatu usulan </span><span xss=removed>untuk</span><span xss=removed> atasan </span><span xss=removed>saya</span><span xss=removed> </span><span xss=removed>namun</span><span xss=removed> usulan tersebut </span><sp', 'Merasa sangat kecewa', '3.00', 'Mencoba mencari alternatif usulan lain yang lebih tepat untuk diajukan lagi', '4.00', 'Merasa kecewa tetapi berusaha melupakan penolakan tersebut', '5.00', 'Bersikeras memberikan alasan dan pembenaran atas usulan tersebut sampai', '6.00', NULL, NULL, '1', '0', '2016-10-13 14:08:51', 'USR0000001516', '2016-10-13 07:10:55', NULL),
('SOAL0000000352016', 'BRANCH00116', 'CTGSOAL03', 12, '<p><span xss=removed>Saya ditugaskan </span><span xss=removed>di</span><i xss=removed> <span xss=removed>front</span> <span xss=removed>office</span></i><span xss=removed> </span><span xss=removed>untuk</span><span xss=removed> </span><span xss=removed>melayani</span><span xss=removed> </span><span ', 'Mengambil keputusan meskipun tanpa petunjuk atasan selama tidak bertentangan dengan kebijakan umum pimpinan', '3.00', 'Tidak berani mengambil keputusan tanpa petunjuk atasan saya', '4.00', ' Ragu  ragu dalam mengambil keputusan tanpa petunjuk atasan saya', '5.00', 'Menunda', '6.00', NULL, NULL, '1', '0', '2016-10-13 14:10:01', 'USR0000001516', '2016-10-13 07:12:05', NULL),
('SOAL0000000362016', 'BRANCH00116', 'CTGSOAL04', 13, '<p><span xss=removed>Bila ada rekan kerja yang salah memanggil nama saya, </span></p>\r\n', 'Saya sedikit tersinggung, karena nama adalah kehormatan seseorang', '3.00', 'Saya tak boleh tersinggung', '4.00', 'Saya mengingatkannya', '5.00', 'Saya mengingatkannya dengan keras agar tidak diulang', '6.00', NULL, NULL, '1', '0', '2016-10-13 14:12:35', 'USR0000001516', '2016-10-13 07:14:39', NULL),
('SOAL0000000372016', 'BRANCH00116', 'CTGSOAL04', 14, '<p><span xss=removed>Reko kali ini lupa belum mengembalikan bolpoin yang dipinjamnya</span></p>\r\n', 'Saya akan menegurnya dengan keras agar tidak terulang lagi', '3.00', 'Saya membiarkannya terlebih dulu sebab ini yang pertama kalinya dia lupa ', '4.00', 'Saya mengihlaskan bolpoin tersebut, toh harganya murah', '5.00', 'Saya mengingatkannya ', '6.00', NULL, NULL, '1', '0', '2016-10-13 14:13:20', 'USR0000001516', '2016-10-13 07:15:24', NULL),
('SOAL0000000382016', 'BRANCH00116', 'CTGSOAL04', 15, '<p><span xss=removed>Saya sudah berusaha untuk memperbaiki kelemahan diri,tetapi belum juga menampakkan hasilnya. Sehingga saya,</span></p>\r\n', 'menerimanya dengan terpaksa', '4.00', 'menerimanya, meski tentu saja dengan sedikit kekecewaan ', '5.00', 'menerimanya dengan lapang dada ', '6.00', 'membenci diri saya sendiri.', '7.00', NULL, NULL, '1', '0', '2016-10-13 14:14:08', 'USR0000001516', '2016-10-13 07:16:12', NULL),
('SOAL0000000422016', 'BRANCH00116', 'CTGSOAL03', NULL, '<p>Apa Itu Inisiatif?</p>\r\n', 'Itu', '-9.99', 'Hmm', '0.00', 'Pass', '0.00', 'Kata', '9.99', NULL, NULL, '0', '0', '2016-10-23 10:16:18', 'USR0000001516', '2016-10-23 03:19:56', 'USR0000001516'),
('SOAL0000000432016', 'BRANCH00116', 'CTGSOAL04', 16, '<p>a</p>\r\n', 'a', '1.00', 'a', '1.00', 'a', '1.00', 'a', '1.00', NULL, NULL, '0', '1', '2016-10-23 10:34:51', 'USR0000001516', '2016-10-23 03:35:01', NULL),
('SOAL0000000442016', 'BRANCH00116', 'CTGSOAL03', NULL, '<p>Anda laper dan teman anda punya banyak makanan, anda akan?</p>\r\n', 'Minta', '9.99', 'Beli', '9.09', 'Ambil Paksa', '9.00', 'Ambil diam diam', '0.00', NULL, NULL, '0', '0', '2016-10-23 10:37:06', 'USR0000001516', '2016-10-23 03:39:03', 'USR0000001516'),
('SOAL0000000592016', 'BRANCH00116', 'CTGSOAL02', 16, '<p>Apakah itu tanggjung jawab;</p>\r\n', 'asdasd', '2.00', 'tete', '9.99', 'tete', '4.00', 'tete', '4.00', NULL, NULL, '1', '0', '2016-10-24 15:10:25', 'USR0000001516', '2016-10-24 08:17:42', NULL),
('SOAL0000000602016', 'BRANCH00116', 'CTGSOAL01', 17, '<p>Apakah itu tanggjung jawab</p>\r\n', 'wrqw', '1.00', 'rqwr', '2.00', 'qwr', '3.00', 'qwr', '4.00', NULL, NULL, '1', '0', '2016-10-24 15:11:20', 'USR0000001516', '2016-10-24 08:18:38', NULL),
('SOAL0000000612016', 'BRANCH00116', 'CTGSOAL01', 18, '<p>Apakah itu tanggjung jawab</p>\r\n', 'qwe', '2.00', 'qweq', '3.00', 'qwe', '4.00', 'qwe', '5.00', NULL, NULL, '1', '0', '2016-10-24 15:12:08', 'USR0000001516', '2016-10-24 08:19:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cms_tm_user`
--

CREATE TABLE `cms_tm_user` (
  `user_no` varchar(25) NOT NULL COMMENT 'USRCMS + 0000001 + yy',
  `branch_id` varchar(20) NOT NULL COMMENT 'fk sys_tm_branch',
  `user_level_id` varchar(25) NOT NULL COMMENT 'FK sys_type (USRLVL)',
  `_id` varchar(45) NOT NULL,
  `_password` varchar(80) NOT NULL,
  `_full_name` varchar(45) NOT NULL,
  `_initial_name` varchar(5) DEFAULT NULL,
  `_email` varchar(45) NOT NULL,
  `_phone` varchar(25) DEFAULT NULL,
  `_address` varchar(250) DEFAULT NULL,
  `_avatar_real_name` varchar(250) DEFAULT NULL,
  `_avatar_enc_name` varchar(150) DEFAULT NULL,
  `_avatar_url` varchar(250) DEFAULT NULL,
  `_active` enum('0','1') NOT NULL DEFAULT '0',
  `_delete` enum('0','1') NOT NULL DEFAULT '0',
  `create_date` datetime NOT NULL,
  `create_by` varchar(25) NOT NULL COMMENT 'fk cms_tm_user (low cardinality)',
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_update_by` varchar(25) DEFAULT NULL COMMENT 'fk cms_tm_user  (low cardinality)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cms_tm_user`
--

INSERT INTO `cms_tm_user` (`user_no`, `branch_id`, `user_level_id`, `_id`, `_password`, `_full_name`, `_initial_name`, `_email`, `_phone`, `_address`, `_avatar_real_name`, `_avatar_enc_name`, `_avatar_url`, `_active`, `_delete`, `create_date`, `create_by`, `last_update`, `last_update_by`) VALUES
('USR0000001516', 'BRANCH00116', 'USRLVL06', 'admin', 'f13c49e0693be9f397e9321dd31a2b0470f7fb7239be078c4a68777a43d63aaa', 'admin', 'admin', 'root@g.id', 'asdasdasdasd', 'asdasd', NULL, NULL, NULL, '1', '0', '2016-09-17 22:59:47', '', '2016-09-28 11:08:13', NULL),
('USR0000001716', 'BRANCH00116', 'USRLVL01', 'SYSADMIN', 'f13c49e0693be9f397e9321dd31a2b0470f7fb7239be078c4a68777a43d63aaa', 'IS SYSADMIN', 'SQWEQ', 'qwe@g', 'qwe', 'Admin', NULL, NULL, NULL, '1', '0', '2016-09-18 11:52:10', 'USR0000001516', '2016-09-28 06:29:01', 'USR0000001716'),
('USR0000001816', 'BRANCH00116', 'USRLVL02', 'THE A A', '8e69e270ad956081240e6c92d5e77189f5f3e21c5ed8ee05454ebb239ac8bf4e', 'THE A', 'THE A', 'leomastakusuma@gmail.com', 'a', 'aa', 'app.png', 'fb7e5bf3159dd2630f70f68cbf723c23.png', 'http://localhost/MyrRecuitmen/public_assets/uploads/fb7e5bf3159dd2630f70f68cbf723c23.png', '1', '0', '2016-09-19 16:18:28', 'USR0000001716', '2016-09-19 02:41:05', 'USR0000001716');

-- --------------------------------------------------------

--
-- Table structure for table `cms_tm_user_access`
--

CREATE TABLE `cms_tm_user_access` (
  `user_access_no` varchar(30) NOT NULL,
  `branch_role_id` varchar(30) NOT NULL COMMENT 'fk sys_tm_branch_role_',
  `user_level_id` varchar(25) NOT NULL COMMENT 'FK sys_type (USRLVL)',
  `_active` enum('0','1') NOT NULL DEFAULT '0',
  `_delete` enum('0','1') NOT NULL DEFAULT '0',
  `create_date` datetime NOT NULL,
  `create_by` varchar(25) DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_update_by` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cms_tm_user_access`
--

INSERT INTO `cms_tm_user_access` (`user_access_no`, `branch_role_id`, `user_level_id`, `_active`, `_delete`, `create_date`, `create_by`, `last_update`, `last_update_by`) VALUES
('USRACC00000000616', 'BRANCHROLE00002616', 'USRLVL01', '1', '0', '2016-09-19 12:06:00', 'USR0000001716', '2016-09-19 01:58:01', NULL),
('USRACC00000000716', 'BRANCHROLE00002716', 'USRLVL01', '1', '0', '2016-09-19 13:15:55', 'USR0000001716', '2016-09-18 23:15:55', NULL),
('USRACC00000000816', 'BRANCHROLE00002916', 'USRLVL01', '1', '0', '2016-09-19 13:16:05', 'USR0000001716', '2016-09-18 23:16:05', NULL),
('USRACC00000000916', 'BRANCHROLE00003016', 'USRLVL01', '1', '0', '2016-09-19 13:21:18', 'USR0000001716', '2016-09-18 23:21:18', NULL),
('USRACC00000001016', 'BRANCHROLE00003116', 'USRLVL01', '1', '0', '2016-09-19 13:21:26', 'USR0000001716', '2016-09-18 23:21:26', NULL),
('USRACC00000001116', 'BRANCHROLE00003216', 'USRLVL01', '1', '0', '2016-09-19 13:26:01', 'USR0000001716', '2016-09-18 23:26:01', NULL),
('USRACC00000001216', 'BRANCHROLE00003316', 'USRLVL01', '0', '1', '2016-09-19 13:42:58', 'USR0000001716', '2016-09-19 01:18:23', NULL),
('USRACC00000001316', 'BRANCHROLE00003516', 'USRLVL01', '1', '0', '2016-09-19 15:17:04', 'USR0000001716', '2016-09-19 01:17:04', NULL),
('USRACC00000001416', 'BRANCHROLE00003416', 'USRLVL02', '0', '1', '2016-09-19 15:17:15', 'USR0000001716', '2016-09-19 01:25:33', NULL),
('USRACC00000001516', 'BRANCHROLE00003116', 'USRLVL01', '0', '1', '2016-09-19 15:17:41', 'USR0000001716', '2016-09-19 01:49:09', NULL),
('USRACC00000001616', 'BRANCHROLE00003316', 'USRLVL01', '1', '0', '2016-09-19 15:18:00', 'USR0000001716', '2016-09-19 01:18:00', NULL),
('USRACC00000001716', 'BRANCHROLE00003716', 'USRLVL01', '1', '0', '2016-09-19 15:22:31', 'USR0000001716', '2016-09-19 01:22:31', NULL),
('USRACC00000001816', 'BRANCHROLE00002916', 'USRLVL01', '1', '0', '2016-09-19 15:22:41', 'USR0000001716', '2016-09-19 01:22:41', NULL),
('USRACC00000001916', 'BRANCHROLE00003416', 'USRLVL01', '1', '0', '2016-09-19 15:25:41', 'USR0000001716', '2016-09-19 01:25:41', NULL),
('USRACC00000002016', 'BRANCHROLE00003916', 'USRLVL01', '1', '0', '2016-09-19 15:34:04', 'USR0000001716', '2016-09-19 01:34:04', NULL),
('USRACC00000002116', 'BRANCHROLE00003916', 'USRLVL01', '0', '1', '2016-09-19 15:34:13', 'USR0000001716', '2016-09-19 01:34:25', NULL),
('USRACC00000002216', 'BRANCHROLE00004016', 'USRLVL01', '1', '0', '2016-09-19 15:34:35', 'USR0000001716', '2016-09-19 01:34:35', NULL),
('USRACC00000003516', 'BRANCHROLE00004216', 'USRLVL01', '1', '0', '2016-09-19 15:54:36', 'USR0000001716', '2016-09-19 01:54:36', NULL),
('USRACC00000003616', 'BRANCHROLE00004316', 'USRLVL01', '1', '0', '2016-09-19 15:54:45', 'USR0000001716', '2016-09-19 01:54:45', NULL),
('USRACC00000003816', 'BRANCHROLE00004416', 'USRLVL01', '1', '0', '2016-09-19 16:02:10', 'USR0000001716', '2016-09-19 02:02:10', NULL),
('USRACC00000003916', 'BRANCHROLE00004616', 'USRLVL02', '0', '1', '2016-09-19 16:02:25', 'USR0000001716', '2016-09-19 02:05:27', NULL),
('USRACC00000004016', 'BRANCHROLE00004616', 'USRLVL01', '1', '0', '2016-09-19 16:05:38', 'USR0000001716', '2016-09-19 02:05:38', NULL),
('USRACC00000004116', 'BRANCHROLE00005016', 'USRLVL01', '1', '0', '2016-09-19 16:43:45', 'USR0000001716', '2016-09-19 02:43:45', NULL),
('USRACC00000004216', 'BRANCHROLE00004916', 'USRLVL01', '1', '0', '2016-09-19 16:43:55', 'USR0000001716', '2016-09-19 02:43:55', NULL),
('USRACC00000004316', 'BRANCHROLE00004816', 'USRLVL01', '1', '0', '2016-09-19 16:44:03', 'USR0000001716', '2016-09-19 02:44:03', NULL),
('USRACC00000004416', 'BRANCHROLE00004716', 'USRLVL01', '1', '0', '2016-09-19 16:44:13', 'USR0000001716', '2016-09-19 02:44:13', NULL),
('USRACC00000004516', 'BRANCHROLE00005716', 'USRLVL01', '0', '1', '2016-09-26 18:52:04', 'USR0000001716', '2016-09-28 10:36:59', NULL),
('USRACC00000004616', 'BRANCHROLE00005316', 'USRLVL01', '0', '1', '2016-09-26 18:52:25', 'USR0000001716', '2016-09-28 10:38:11', NULL),
('USRACC00000004716', 'BRANCHROLE00005116', 'USRLVL01', '0', '1', '2016-09-26 18:52:39', 'USR0000001716', '2016-09-28 10:38:23', NULL),
('USRACC00000004816', 'BRANCHROLE00005216', 'USRLVL01', '0', '1', '2016-09-26 18:52:55', 'USR0000001716', '2016-09-28 10:38:29', NULL),
('USRACC00000004916', 'BRANCHROLE00005416', 'USRLVL01', '0', '1', '2016-09-26 18:58:35', 'USR0000001716', '2016-09-28 10:38:36', NULL),
('USRACC00000005016', 'BRANCHROLE00005616', 'USRLVL01', '0', '1', '2016-09-27 10:36:53', 'USR0000001716', '2016-09-28 10:37:25', NULL),
('USRACC00000005116', 'BRANCHROLE00005816', 'USRLVL01', '0', '1', '2016-09-27 10:37:27', 'USR0000001716', '2016-09-28 10:37:17', NULL),
('USRACC00000005216', 'BRANCHROLE00005916', 'USRLVL01', '0', '1', '2016-09-27 10:37:37', 'USR0000001716', '2016-09-28 10:37:10', NULL),
('USRACC00000005316', 'BRANCHROLE00005616', 'USRLVL06', '1', '0', '2016-09-28 08:06:20', 'USR0000001716', '2016-09-28 01:06:20', NULL),
('USRACC00000005416', 'BRANCHROLE00005716', 'USRLVL06', '1', '0', '2016-09-28 08:06:31', 'USR0000001716', '2016-09-28 01:06:31', NULL),
('USRACC00000005516', 'BRANCHROLE00005816', 'USRLVL06', '1', '0', '2016-09-28 08:06:44', 'USR0000001716', '2016-09-28 01:06:44', NULL),
('USRACC00000005616', 'BRANCHROLE00005916', 'USRLVL06', '1', '0', '2016-09-28 08:06:54', 'USR0000001716', '2016-09-28 01:06:54', NULL),
('USRACC00000005716', 'BRANCHROLE00005516', 'USRLVL06', '1', '0', '2016-09-28 08:07:22', 'USR0000001716', '2016-09-28 01:07:22', NULL),
('USRACC00000005816', 'BRANCHROLE00133116', 'USRLVL01', '0', '1', '2016-09-28 10:18:15', 'USR0000001716', '2016-09-28 10:55:27', NULL),
('USRACC00000005916', 'BRANCHROLE00133316', 'USRLVL01', '0', '1', '2016-09-28 10:18:24', 'USR0000001716', '2016-09-28 10:55:33', NULL),
('USRACC00000006016', 'BRANCHROLE00133216', 'USRLVL01', '0', '1', '2016-09-28 10:18:31', 'USR0000001716', '2016-09-28 10:55:42', NULL),
('USRACC00000006116', 'BRANCHROLE00005516', 'USRLVL01', '0', '1', '2016-09-28 10:18:40', 'USR0000001716', '2016-09-28 10:55:47', NULL),
('USRACC00000006216', 'BRANCHROLE00133416', 'USRLVL01', '0', '1', '2016-09-28 10:26:40', 'USR0000001716', '2016-09-28 10:50:50', NULL),
('USRACC00000006316', 'BRANCHROLE00133516', 'USRLVL01', '0', '1', '2016-09-28 10:26:52', 'USR0000001716', '2016-09-28 10:50:56', NULL),
('USRACC00000006416', 'BRANCHROLE00133616', 'USRLVL01', '0', '1', '2016-09-28 10:27:01', 'USR0000001716', '2016-09-28 10:51:02', NULL),
('USRACC00000006516', 'BRANCHROLE00133716', 'USRLVL01', '0', '1', '2016-09-28 10:27:08', 'USR0000001716', '2016-09-28 10:51:07', NULL),
('USRACC00000006616', 'BRANCHROLE00133816', 'USRLVL01', '1', '0', '2016-09-28 10:34:11', 'USR0000001716', '2016-09-28 03:37:25', NULL),
('USRACC00000006716', 'BRANCHROLE00133916', 'USRLVL01', '1', '0', '2016-09-28 10:34:28', 'USR0000001716', '2016-09-28 03:37:42', NULL),
('USRACC00000006816', 'BRANCHROLE00134016', 'USRLVL01', '1', '0', '2016-09-28 10:34:42', 'USR0000001716', '2016-09-28 03:37:56', NULL),
('USRACC00000006916', 'BRANCHROLE00134216', 'USRLVL01', '1', '0', '2016-09-28 10:34:50', 'USR0000001716', '2016-09-28 03:38:04', NULL),
('USRACC00000007016', 'BRANCHROLE00134316', 'USRLVL01', '0', '1', '2016-09-28 10:35:00', 'USR0000001716', '2016-09-28 10:52:12', NULL),
('USRACC00000007116', 'BRANCHROLE00134416', 'USRLVL01', '0', '1', '2016-09-28 10:35:14', 'USR0000001716', '2016-09-28 10:51:48', NULL),
('USRACC00000007216', 'BRANCHROLE00134516', 'USRLVL01', '0', '1', '2016-09-28 10:35:21', 'USR0000001716', '2016-09-28 10:51:39', NULL),
('USRACC00000007316', 'BRANCHROLE00134916', 'USRLVL01', '1', '0', '2016-09-28 17:45:33', 'USR0000001716', '2016-09-28 10:48:48', NULL),
('USRACC00000007416', 'BRANCHROLE00135116', 'USRLVL01', '1', '0', '2016-09-28 17:45:54', 'USR0000001716', '2016-09-28 10:49:09', NULL),
('USRACC00000007516', 'BRANCHROLE00135116', 'USRLVL06', '0', '0', '2016-09-28 17:46:04', 'USR0000001716', '2016-10-20 01:48:40', NULL),
('USRACC00000007616', 'BRANCHROLE00134716', 'USRLVL01', '1', '0', '2016-09-28 17:46:18', 'USR0000001716', '2016-09-28 10:49:32', NULL),
('USRACC00000007716', 'BRANCHROLE00134716', 'USRLVL06', '1', '0', '2016-09-28 17:46:29', 'USR0000001716', '2016-10-20 01:49:07', NULL),
('USRACC00000007816', 'BRANCHROLE00134616', 'USRLVL06', '1', '0', '2016-09-28 17:46:45', 'USR0000001716', '2016-09-28 10:50:00', NULL),
('USRACC00000007916', 'BRANCHROLE00005116', 'USRLVL06', '1', '0', '2016-09-28 17:50:27', 'USR0000001716', '2016-09-28 10:53:42', NULL),
('USRACC00000008016', 'BRANCHROLE00005216', 'USRLVL06', '1', '0', '2016-09-28 17:50:42', 'USR0000001716', '2016-09-28 10:53:56', NULL),
('USRACC00000008116', 'BRANCHROLE00005316', 'USRLVL06', '1', '0', '2016-09-28 17:50:55', 'USR0000001716', '2016-09-28 10:54:09', NULL),
('USRACC00000008216', 'BRANCHROLE00005416', 'USRLVL06', '1', '0', '2016-09-28 17:51:05', 'USR0000001716', '2016-09-28 10:54:20', NULL),
('USRACC00000008416', 'BRANCHROLE00133116', 'USRLVL06', '1', '0', '2016-09-28 17:52:50', 'USR0000001716', '2016-09-28 10:56:05', NULL),
('USRACC00000008516', 'BRANCHROLE00133216', 'USRLVL06', '1', '0', '2016-09-28 17:53:06', 'USR0000001716', '2016-09-28 10:56:20', NULL),
('USRACC00000008616', 'BRANCHROLE00133316', 'USRLVL06', '1', '0', '2016-09-28 17:53:16', 'USR0000001716', '2016-09-28 10:56:30', NULL),
('USRACC00000008716', 'BRANCHROLE00133416', 'USRLVL06', '1', '0', '2016-09-28 17:53:43', 'USR0000001716', '2016-09-28 10:56:57', NULL),
('USRACC00000008816', 'BRANCHROLE00133516', 'USRLVL06', '1', '0', '2016-09-28 17:53:54', 'USR0000001716', '2016-09-28 10:57:08', NULL),
('USRACC00000008916', 'BRANCHROLE00133616', 'USRLVL06', '1', '0', '2016-09-28 17:54:07', 'USR0000001716', '2016-09-28 10:57:22', NULL),
('USRACC00000009016', 'BRANCHROLE00133716', 'USRLVL06', '1', '0', '2016-09-28 17:54:18', 'USR0000001716', '2016-09-28 10:57:32', NULL),
('USRACC00000009116', 'BRANCHROLE00134316', 'USRLVL06', '0', '1', '2016-09-28 17:56:07', 'USR0000001716', '2016-10-20 01:50:56', NULL),
('USRACC00000009216', 'BRANCHROLE00134416', 'USRLVL06', '0', '1', '2016-09-28 17:56:27', 'USR0000001716', '2016-10-20 01:50:47', NULL),
('USRACC00000009316', 'BRANCHROLE00134516', 'USRLVL06', '0', '1', '2016-09-28 17:56:39', 'USR0000001716', '2016-10-20 01:50:38', NULL),
('USRACC00000009416', 'BRANCHROLE00004216', 'USRLVL06', '0', '0', '2016-09-28 18:13:11', 'USR0000001716', '2016-10-20 01:48:08', NULL),
('USRACC00000009516', 'BRANCHROLE00004316', 'USRLVL06', '0', '0', '2016-09-28 18:13:23', 'USR0000001716', '2016-10-20 01:48:05', NULL),
('USRACC00000009616', 'BRANCHROLE00003116', 'USRLVL06', '0', '0', '2016-09-28 18:13:38', 'USR0000001716', '2016-10-20 01:47:58', NULL),
('USRACC00000009716', 'BRANCHROLE00003016', 'USRLVL06', '1', '0', '2016-09-28 18:13:52', 'USR0000001716', '2016-09-28 11:17:07', NULL),
('USRACC00000009816', 'BRANCHROLE00004416', 'USRLVL06', '1', '0', '2016-09-28 18:14:09', 'USR0000001716', '2016-09-28 11:17:24', NULL),
('USRACC00000009916', 'BRANCHROLE00004616', 'USRLVL06', '1', '0', '2016-09-28 18:14:16', 'USR0000001716', '2016-09-28 11:17:30', NULL),
('USRACC00000010016', 'BRANCHROLE00135516', 'USRLVL06', '1', '0', '2016-10-14 02:43:13', 'USR0000001716', '2016-10-13 19:45:41', NULL),
('USRACC00000010116', 'BRANCHROLE00135416', 'USRLVL06', '1', '0', '2016-10-14 02:43:22', 'USR0000001716', '2016-10-13 19:45:51', NULL),
('USRACC00000010216', 'BRANCHROLE00135316', 'USRLVL06', '1', '0', '2016-10-14 02:43:37', 'USR0000001716', '2016-10-13 19:46:05', NULL),
('USRACC00000010316', 'BRANCHROLE00135216', 'USRLVL06', '1', '0', '2016-10-14 02:43:47', 'USR0000001716', '2016-10-13 19:46:15', NULL),
('USRACC00000010416', 'BRANCHROLE00135616', 'USRLVL06', '1', '0', '2016-10-15 23:12:48', 'USR0000001716', '2016-10-15 16:16:41', NULL),
('USRACC00000010516', 'BRANCHROLE00135716', 'USRLVL06', '1', '0', '2016-10-15 23:13:05', 'USR0000001716', '2016-10-15 16:16:58', NULL),
('USRACC00000010616', 'BRANCHROLE00135816', 'USRLVL06', '1', '0', '2016-10-15 23:13:21', 'USR0000001716', '2016-10-15 16:17:15', NULL),
('USRACC00000010716', 'BRANCHROLE00136116', 'USRLVL06', '1', '0', '2016-10-15 23:13:38', 'USR0000001716', '2016-10-15 16:17:31', NULL),
('USRACC00000010816', 'BRANCHROLE00136516', 'USRLVL06', '1', '0', '2016-10-16 18:45:30', 'USR0000001716', '2016-10-16 11:50:01', NULL),
('USRACC00000010916', 'BRANCHROLE00136416', 'USRLVL06', '1', '0', '2016-10-16 18:45:41', 'USR0000001716', '2016-10-16 11:50:11', NULL),
('USRACC00000011016', 'BRANCHROLE00136316', 'USRLVL06', '1', '0', '2016-10-16 18:45:50', 'USR0000001716', '2016-10-16 11:50:20', NULL),
('USRACC00000011116', 'BRANCHROLE00136216', 'USRLVL06', '1', '0', '2016-10-16 18:46:00', 'USR0000001716', '2016-10-16 11:50:31', NULL),
('USRACC00000011216', 'BRANCHROLE00136616', 'USRLVL06', '1', '0', '2016-10-18 22:05:39', 'USR0000001716', '2016-10-18 15:11:47', NULL),
('USRACC00000011316', 'BRANCHROLE00136716', 'USRLVL06', '1', '0', '2016-10-18 22:05:53', 'USR0000001716', '2016-10-18 15:12:02', NULL),
('USRACC00000011416', 'BRANCHROLE00136816', 'USRLVL06', '1', '0', '2016-10-18 22:06:07', 'USR0000001716', '2016-10-18 15:12:15', NULL),
('USRACC00000011516', 'BRANCHROLE00136916', 'USRLVL06', '1', '0', '2016-10-19 23:11:38', 'USR0000001716', '2016-10-19 16:18:34', NULL),
('USRACC00000011616', 'BRANCHROLE00137016', 'USRLVL06', '1', '0', '2016-10-19 23:11:48', 'USR0000001716', '2016-10-19 16:18:44', NULL),
('USRACC00000011716', 'BRANCHROLE00137116', 'USRLVL06', '1', '0', '2016-10-19 23:11:59', 'USR0000001716', '2016-10-19 16:18:55', NULL),
('USRACC00000011816', 'BRANCHROLE00133816', 'USRLVL06', '1', '0', '2016-10-20 08:51:26', 'USR0000001716', '2016-10-20 01:51:26', NULL),
('USRACC00000011916', 'BRANCHROLE00133916', 'USRLVL06', '1', '0', '2016-10-20 08:51:38', 'USR0000001716', '2016-10-20 01:51:38', NULL),
('USRACC00000012016', 'BRANCHROLE00134016', 'USRLVL06', '1', '0', '2016-10-20 08:51:53', 'USR0000001716', '2016-10-20 01:51:53', NULL),
('USRACC00000012116', 'BRANCHROLE00134216', 'USRLVL06', '1', '0', '2016-10-20 08:52:05', 'USR0000001716', '2016-10-20 01:52:05', NULL),
('USRACC00000012216', 'BRANCHROLE00137616', 'USRLVL06', '1', '0', '2016-10-27 22:16:36', 'USR0000001716', '2016-10-27 15:16:36', NULL),
('USRACC00000012316', 'BRANCHROLE00137516', 'USRLVL06', '1', '0', '2016-10-27 22:16:47', 'USR0000001716', '2016-10-27 15:16:47', NULL),
('USRACC00000012416', 'BRANCHROLE00137316', 'USRLVL06', '1', '0', '2016-10-27 22:16:56', 'USR0000001716', '2016-10-27 15:16:56', NULL),
('USRACC00000012616', 'BRANCHROLE00137416', 'USRLVL06', '1', '0', '2016-10-27 22:17:27', 'USR0000001716', '2016-10-27 15:17:27', NULL),
('USRACC00000012716', 'BRANCHROLE00137216', 'USRLVL06', '1', '0', '2016-10-27 22:18:04', 'USR0000001716', '2016-10-27 15:18:04', NULL),
('USRACC00000012816', 'BRANCHROLE00138116', 'USRLVL06', '1', '0', '2016-10-29 00:04:03', 'USR0000001716', '2016-10-28 17:04:03', NULL),
('USRACC00000012916', 'BRANCHROLE00137916', 'USRLVL06', '1', '0', '2016-10-29 00:04:15', 'USR0000001716', '2016-10-28 17:04:16', NULL),
('USRACC00000013016', 'BRANCHROLE00137816', 'USRLVL06', '1', '0', '2016-10-29 00:04:25', 'USR0000001716', '2016-10-28 17:04:25', NULL),
('USRACC00000013116', 'BRANCHROLE00137716', 'USRLVL06', '1', '0', '2016-10-29 00:04:35', 'USR0000001716', '2016-10-28 17:04:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cms_tx_interview`
--

CREATE TABLE `cms_tx_interview` (
  `interview_no` varchar(30) NOT NULL,
  `branch_id` varchar(20) NOT NULL COMMENT 'fk sys_tm_branch',
  `psikotes_no` varchar(30) NOT NULL COMMENT 'fk fe_tx_psikotes',
  `pelamar_no` varchar(30) NOT NULL COMMENT 'fk fe_tm_pelamar - support speed query fe_tx_apply_lowongan.pelamar_no',
  `_analisa_interview` text NOT NULL,
  `status_interview_id` varchar(25) NOT NULL COMMENT 'fk sys_type (category 25)',
  `_active` enum('0','1') NOT NULL DEFAULT '1',
  `_delete` enum('0','1') NOT NULL DEFAULT '0',
  `create_date` datetime NOT NULL,
  `create_by` varchar(25) NOT NULL COMMENT 'fk cms_tm_user_',
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_update_by` varchar(25) DEFAULT NULL COMMENT 'fk cms_tm_user_'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cms_tx_interview`
--

INSERT INTO `cms_tx_interview` (`interview_no`, `branch_id`, `psikotes_no`, `pelamar_no`, `_analisa_interview`, `status_interview_id`, `_active`, `_delete`, `create_date`, `create_by`, `last_update`, `last_update_by`) VALUES
('INTERVIEW00000009112016', 'BRANCH00116', 'PSI00000004105112016', 'PELAMAR0000000462016', '<p>LOLOS INTERVIEW CLIENT</p>\r\n', 'STATUSINT01', '1', '0', '2016-11-05 23:01:32', 'USR0000001516', '2016-11-05 16:01:51', 'USR0000001516');

-- --------------------------------------------------------

--
-- Table structure for table `cms_tx_interview_client`
--

CREATE TABLE `cms_tx_interview_client` (
  `interview_client_no` varchar(30) NOT NULL,
  `branch_id` varchar(20) NOT NULL COMMENT 'fk sys_tm_branch',
  `interview_no` varchar(30) NOT NULL COMMENT 'fk cms_tx_interview',
  `_analisa_interview` text NOT NULL,
  `status_interview_client_id` varchar(25) NOT NULL COMMENT 'fk sys_type (category 26)',
  `_active` enum('0','1') NOT NULL DEFAULT '1',
  `_delete` enum('0','1') NOT NULL DEFAULT '0',
  `create_date` datetime NOT NULL,
  `create_by` varchar(25) NOT NULL COMMENT 'fk cms_tm_user',
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_update_by` varchar(25) DEFAULT NULL COMMENT 'fk cms_tm_user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cms_tx_interview_client`
--

INSERT INTO `cms_tx_interview_client` (`interview_client_no`, `branch_id`, `interview_no`, `_analisa_interview`, `status_interview_client_id`, `_active`, `_delete`, `create_date`, `create_by`, `last_update`, `last_update_by`) VALUES
('INTERVIEWCL00000010112016', 'BRANCH00116', 'INTERVIEW00000009112016', '<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; $data[&#39;homeslider&#39;] = $this-&gt;Lowongancms_model-&gt;homeslider();</p>\r\n\r\n<p>&nbsp;</p>\r\n', 'STATUSINTCL01', '1', '0', '2016-11-05 23:01:51', 'USR0000001516', '2016-11-05 16:07:42', 'USR0000001516');

-- --------------------------------------------------------

--
-- Table structure for table `fe_tm_pelamar`
--

CREATE TABLE `fe_tm_pelamar` (
  `pelamar_no` varchar(30) NOT NULL,
  `branch_id` varchar(20) NOT NULL COMMENT 'fk sys_tm_branch',
  `_email` varchar(70) NOT NULL,
  `_password` varchar(200) NOT NULL,
  `_resume_url` varchar(300) DEFAULT NULL,
  `_resume_real_name` varchar(200) DEFAULT NULL,
  `_resume_enc_name` varchar(100) DEFAULT NULL,
  `_resume_date` datetime DEFAULT NULL COMMENT 'ketika pelamar upload cv saat daftar ataupun update',
  `_active` enum('0','1') NOT NULL DEFAULT '0',
  `_delete` enum('0','1') NOT NULL DEFAULT '0',
  `_last_login` datetime DEFAULT NULL,
  `create_date` datetime NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fe_tm_pelamar`
--

INSERT INTO `fe_tm_pelamar` (`pelamar_no`, `branch_id`, `_email`, `_password`, `_resume_url`, `_resume_real_name`, `_resume_enc_name`, `_resume_date`, `_active`, `_delete`, `_last_login`, `create_date`, `last_update`) VALUES
('PELAMAR0000000242016', 'BRANCH00116', 'admin@google.com', 'f13c49e0693be9f397e9321dd31a2b0470f7fb7239be078c4a68777a43d63aaa', 'http://localhost/cakrawala/public_assets/uploads/8c05dbb83212acfc71a17d6504844c03.pdf', 'testing.pdf', 'testing.pdf', '2016-10-01 22:23:37', '1', '0', '2016-10-13 13:11:36', '2016-10-01 22:23:37', '0000-00-00 00:00:00'),
('PELAMAR0000000252016', 'BRANCH00116', 'admin@google.com', 'admin', 'http://localhost/cakrawala/public_assets/uploads/2abee8db38473c4fd97d3a62a2aa7554.pdf', 'testing.pdf', 'testing.pdf', '2016-10-01 22:27:34', '1', '0', NULL, '2016-10-01 22:27:34', '0000-00-00 00:00:00'),
('PELAMAR0000000262016', 'BRANCH00116', 'admin@google.com', 'admin', 'http://localhost/cakrawala/public_assets/uploads/ff087fc0465bd185badb5491df6ab993.pdf', 'testing.pdf', 'testing.pdf', '2016-10-01 22:27:44', '1', '0', NULL, '2016-10-01 22:27:44', '0000-00-00 00:00:00'),
('PELAMAR0000000272016', 'BRANCH00116', 'admin@google.com', 'admin', 'http://localhost/cakrawala/public_assets/uploads/b64b17bae3c044868e451b97ebd62313.pdf', 'testing.pdf', 'testing.pdf', '2016-10-01 22:28:03', '1', '0', NULL, '2016-10-01 22:28:03', '0000-00-00 00:00:00'),
('PELAMAR0000000282016', 'BRANCH00116', 'admin@gmail.com', 'admin', 'http://localhost/cakrawala/public_assets/uploads/05e65e226998dfcf13e2e85d23a90626.pdf', 'testing.pdf', 'testing.pdf', '2016-10-01 22:41:48', '1', '0', NULL, '2016-10-01 22:41:48', '0000-00-00 00:00:00'),
('PELAMAR0000000292016', 'BRANCH00116', 'admin@gogle.com', 'admin', 'http://localhost/cakrawala/public_assets/uploads/bcf002a8e3beb4c08da742e6d578da35.pdf', 'testing.pdf', 'testing.pdf', '2016-10-01 22:56:53', '1', '0', NULL, '2016-10-01 22:56:53', '0000-00-00 00:00:00'),
('PELAMAR0000000302016', 'BRANCH00116', 'leomastakusuma@gmail.com', '0ce9d602addf3f0269cf3b69b17676e2f8a025af138aafb07f6a30027a70992c', 'http://localhost/cakrawala/public_assets/uploads/baf10cf1acec5d82231de321708347e0.pdf', 'testing.pdf', 'testing.pdf', '2016-10-01 23:01:26', '1', '0', '2016-10-14 02:54:47', '2016-10-01 23:01:26', '2016-10-13 19:57:10'),
('PELAMAR0000000452016', 'BRANCH00116', 'leomastakuma@gmail.com', 'f13c49e0693be9f397e9321dd31a2b0470f7fb7239be078c4a68777a43d63aaa', 'http://localhost/siprama-recruitment-web/public_assets/uploads/0d7f3f9b1b5f1c34804ec3f209fa1785.pdf', 'lesson2.pdf', 'lesson2.pdf', '2016-10-03 20:32:38', '1', '0', '2016-10-06 18:29:31', '2016-10-03 20:32:38', '0000-00-00 00:00:00'),
('PELAMAR0000000462016', 'BRANCH00116', 'takarya@hotmail.com', 'f13c49e0693be9f397e9321dd31a2b0470f7fb7239be078c4a68777a43d63aaa', 'http://localhost/siprama-recruitment-web/public_assets/uploads/e1421e68a60c9d9a62a570b5e406366d.pdf', 'CV-Template_DPM (1).pdf', 'e1421e68a60c9d9a62a570b5e406366d.pdf', '2016-10-04 12:34:11', '1', '0', '2016-11-08 12:47:20', '2016-10-04 12:34:11', '2016-11-08 05:47:20'),
('PELAMAR0000000482016', 'BRANCH00116', 'testing@gmail.com', 'f13c49e0693be9f397e9321dd31a2b0470f7fb7239be078c4a68777a43d63aaa', 'http://localhost/siprama-recruitment-web/public_assets/uploads/bd70cb1b5a6d8b929f823223fd33de96.pdf', 'lesson2.pdf', 'lesson2.pdf', '2016-10-04 20:30:54', '1', '0', NULL, '2016-10-04 20:30:54', '0000-00-00 00:00:00'),
('PELAMAR0000000492016', 'BRANCH00116', 'Doni@gmail.com', 'f13c49e0693be9f397e9321dd31a2b0470f7fb7239be078c4a68777a43d63aaa', 'http://localhost/siprama-recruitment-web/public_assets/uploads/9d05024bb46e9a586e6cda6229a8e3aa.pdf', 'lesson2.pdf', 'lesson2.pdf', '2016-10-04 23:07:21', '1', '0', NULL, '2016-10-04 23:07:21', '0000-00-00 00:00:00'),
('PELAMAR0000000512016', 'BRANCH00116', 'testing@yahoo.com', 'b3fe7302579d8fc3d0a42fa31e441274932b3d507dd2115c0708bdd2146cceca', 'http://localhost/siprama-recruitment-web/public_assets/uploads/38552c766acd0fcbfe72639f1511229d.pdf', 'lesson2.pdf', 'lesson2.pdf', '2016-10-05 19:59:00', '1', '0', NULL, '2016-10-05 19:59:00', '0000-00-00 00:00:00'),
('PELAMAR0000000522016', 'BRANCH00116', 'te@gmail.com', 'd6fe7eebfd7d73a6b49ad35bc5953351cb825f34b0d52e5c4fa53bbaa4739fff', 'http://localhost/siprama-recruitment-web/public_assets/uploads/c8a064d466d91de5041f09391995e659.pdf', 'lesson2.pdf', 'lesson2.pdf', '2016-10-05 20:37:28', '1', '0', NULL, '2016-10-05 20:37:28', '0000-00-00 00:00:00'),
('PELAMAR0000000632016', 'BRANCH00116', 'youcandoit95@gmail.com', '09ddb6986fe8e6ac1726aca63f36a028e7a2bb65029b2c736d3b4fc0cdc8534a', 'http://yansen.dev.codigo.id/myr/siprama-recruitment-web/public_assets/uploads/919cacdecf786ce83106988f0cd2c3bc.pdf', 'CV - Siti Soraya Annisa.pdf', 'CV - Siti Soraya Annisa.pdf', '2016-10-12 15:24:08', '1', '0', '2016-10-25 18:44:11', '2016-10-12 15:24:08', '2016-10-13 19:57:17'),
('PELAMAR0000000642016', 'BRANCH00116', 'yanto@gmail.com', 'f13c49e0693be9f397e9321dd31a2b0470f7fb7239be078c4a68777a43d63aaa', 'http://localhost/siprama-recruitment-web/public_assets/uploads/56f97afa9280a147df0b6068e7828468.pdf', 'CV-Template_DPM.pdf', 'CV-Template_DPM.pdf', '2016-10-13 13:13:30', '1', '0', '2016-10-13 13:22:21', '2016-10-13 13:13:30', '0000-00-00 00:00:00'),
('PELAMAR0000000652016', 'BRANCH00116', 'yansen@codigo.id', '09ddb6986fe8e6ac1726aca63f36a028e7a2bb65029b2c736d3b4fc0cdc8534a', '', '', '', '2016-10-14 03:10:58', '1', '0', '2016-10-17 06:25:36', '2016-10-14 03:10:58', '2016-10-16 23:46:22'),
('PELAMAR0000000662016', 'BRANCH00116', 'testint@mailhog.codigo.id', 'f45326d7d202e50290e66c80ce3500b8960ee035e7ce67e2ef0a88ae01e1d562', 'http://yansen.dev.codigo.id/myr/siprama-recruitment-web/public_assets/uploads/a7bcb6ca458e140a028eda6d07b8b99e.docx', 'CV - Artika 2.docx', 'CV - Artika 2.docx', '2016-10-17 06:08:32', '1', '0', NULL, '2016-10-17 06:08:32', '0000-00-00 00:00:00'),
('PELAMAR0000000672016', 'BRANCH00116', 'admin@tk.id', 'f13c49e0693be9f397e9321dd31a2b0470f7fb7239be078c4a68777a43d63aaa', 'http://localhost/siprama-recruitment-web/public_assets/uploads/7cc905b8c6103100a668210de9595c38.docx', 'Dear Yansen.docx', 'Dear Yansen.docx', '2016-10-19 20:59:15', '1', '0', NULL, '2016-10-19 20:59:15', '0000-00-00 00:00:00'),
('PELAMAR0000000692016', 'BRANCH00116', 'siprama@mailinator.com', 'd209b132e66b0293c49a30c409c7bf5c5261a4fe73ae8508c9c88eb98f587ec8', 'http://yansen.dev.codigo.id/myr/siprama-recruitment-web/public_assets/uploads/b0edd632cab9f748f1aec9f5eaf960aa.docx', 'Sejarah Kemerdekaan RI.docx', 'Sejarah Kemerdekaan RI.docx', '2016-10-24 12:30:20', '1', '0', '2016-10-24 12:33:35', '2016-10-24 12:30:20', '0000-00-00 00:00:00'),
('PELAMAR0000000702016', 'BRANCH00116', 'yansen95@gmail.com', 'f45326d7d202e50290e66c80ce3500b8960ee035e7ce67e2ef0a88ae01e1d562', 'http://yansen.dev.codigo.id/myr/siprama-recruitment-web/public_assets/uploads/05dae7c751a81e31f2df6432063c54fc.pdf', 'CV - Mohamad Yansen Riadi.pdf', 'CV - Mohamad Yansen Riadi.pdf', '2016-10-25 18:43:18', '1', '0', NULL, '2016-10-25 18:43:18', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `fe_tm_pelamar_family_info`
--

CREATE TABLE `fe_tm_pelamar_family_info` (
  `pelamar_family_info_no` varchar(30) NOT NULL,
  `pelamar_no` varchar(30) NOT NULL COMMENT 'fk fe_pelamar',
  `family_type_id` varchar(25) NOT NULL COMMENT 'fk sys_type (FAMILY01)',
  `_name` varchar(60) NOT NULL,
  `_phone` varchar(25) DEFAULT NULL,
  `_delete` enum('0','1') NOT NULL DEFAULT '0',
  `create_date` datetime NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `admin_last_update` datetime DEFAULT NULL,
  `admin_last_update_by` varchar(25) DEFAULT NULL COMMENT 'fk cms_tm_user',
  `admin_last_update_reason` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT=' ';

--
-- Dumping data for table `fe_tm_pelamar_family_info`
--

INSERT INTO `fe_tm_pelamar_family_info` (`pelamar_family_info_no`, `pelamar_no`, `family_type_id`, `_name`, `_phone`, `_delete`, `create_date`, `last_update`, `admin_last_update`, `admin_last_update_by`, `admin_last_update_reason`) VALUES
('PELAMARFI0000000072016', 'PELAMAR0000000462016', 'FAMILY02', 'Siti Badriyah', '08123123123', '0', '2016-10-04 13:37:12', '2016-10-13 06:00:20', NULL, NULL, NULL),
('PELAMARFI0000000082016', 'PELAMAR0000000462016', 'FAMILY03', 'Andika Sugiarto', '08123123', '1', '2016-10-04 13:37:12', '2016-11-08 05:49:12', NULL, NULL, NULL),
('PELAMARFI0000000092016', 'PELAMAR0000000462016', 'FAMILY03', 'Dema Wiguna', '081234', '1', '2016-10-04 13:37:12', '2016-11-08 05:49:15', NULL, NULL, NULL),
('PELAMARFI0000000102016', 'PELAMAR0000000462016', 'FAMILY03', 'Jamal1212', '08123123123', '1', '2016-10-04 13:37:12', '2016-11-08 05:49:14', NULL, NULL, NULL),
('PELAMARFI0000000112016', 'PELAMAR0000000462016', 'FAMILY03', 'Kanda', '0812312', '1', '2016-10-13 11:39:56', '2016-10-13 05:28:56', NULL, NULL, NULL),
('PELAMARFI0000000122016', 'PELAMAR0000000462016', 'FAMILY03', 'Test', '123123', '1', '2016-10-13 12:28:14', '2016-10-13 05:28:20', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `fe_tm_pelamar_family_info_history`
--

CREATE TABLE `fe_tm_pelamar_family_info_history` (
  `pelamar_family_info_history_no` varchar(30) NOT NULL,
  `type_history_id` varchar(25) NOT NULL COMMENT 'fk sys_type (category 27)',
  `pelamar_family_info_no` varchar(30) NOT NULL COMMENT 'fk fe_tm_pelamar_family_info',
  `pelamar_no` varchar(30) NOT NULL COMMENT 'fk fe_pelamar',
  `family_type_id` varchar(25) NOT NULL COMMENT 'fk sys_type (FAMILY01)',
  `_name` varchar(60) NOT NULL,
  `_delete` enum('0','1') NOT NULL DEFAULT '0',
  `create_date` datetime NOT NULL,
  `create_by_source` varchar(25) NOT NULL COMMENT 'fk sys type category 28',
  `create_by_pelamar_no` varchar(30) DEFAULT NULL COMMENT 'fk fe_tm_pelamar (history dicreate oleh pelamar)',
  `create_by_user_no` varchar(25) DEFAULT NULL COMMENT 'fk cms_tm_user (history di create oleh user cms)',
  `create_by_user_no_reason` varchar(300) DEFAULT NULL COMMENT 'alasan user cms dml data'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `fe_tm_pelamar_personal_info`
--

CREATE TABLE `fe_tm_pelamar_personal_info` (
  `pelamar_personal_info_no` varchar(30) NOT NULL,
  `pelamar_no` varchar(30) NOT NULL COMMENT 'fk fe_pelamar',
  `_no_ktp` varchar(30) NOT NULL,
  `_fullname` varchar(60) NOT NULL,
  `place_birth` varchar(30) NOT NULL COMMENT 'fk sys_tm_location',
  `_birthdate` date NOT NULL,
  `_gender` enum('0','1') NOT NULL COMMENT '0=female 1=male',
  `_closer_person_fullname` varchar(60) NOT NULL COMMENT 'orang terdekat',
  `_closer_person_phone` varchar(25) NOT NULL COMMENT 'telepon orang terdekat',
  `religion_id` varchar(25) NOT NULL COMMENT 'fk sys_type (RELIGION01)',
  `_address_ktp` varchar(300) NOT NULL,
  `_address_ktp_kelurahan` varchar(45) DEFAULT NULL,
  `_address_ktp_kecamatan` varchar(45) DEFAULT NULL,
  `address_ktp_kota` varchar(30) NOT NULL COMMENT 'fk cms_tm_location_ type city',
  `_address_sekarang` varchar(300) NOT NULL,
  `address_sekarang_kota` varchar(30) NOT NULL COMMENT 'fk cms_tm_location type city',
  `_height` smallint(3) NOT NULL COMMENT 'tinggi_badan cm',
  `_weight` smallint(3) NOT NULL COMMENT 'berat_badan kg',
  `skin_color_id` varchar(25) NOT NULL COMMENT 'FK SYS_TYPE (SKINCOLOR)',
  `_phone_home` varchar(25) DEFAULT NULL,
  `_phone_primary` varchar(25) NOT NULL,
  `_phone_secondary` varchar(25) DEFAULT NULL,
  `relationship_id` varchar(25) NOT NULL COMMENT 'fk sys_type (RELATIONSHIP01)',
  `_total_children` smallint(6) DEFAULT NULL COMMENT 'jika menikah atau bercerai harus diisi (boleh 0)',
  `_no_sim_a` varchar(45) DEFAULT NULL,
  `_no_sim_b1` varchar(45) DEFAULT NULL,
  `_no_sim_b2` varchar(45) DEFAULT NULL,
  `_no_sim_c` varchar(45) DEFAULT NULL,
  `owned_kendaraan_id` varchar(25) NOT NULL COMMENT 'kendaraan yang dimiliki FK sys_type (KENDARAAN01)',
  `_no_npwp` varchar(45) DEFAULT NULL,
  `_no_bpjs_tk` varchar(45) DEFAULT NULL,
  `_no_bpjs_kesehatan` varchar(45) DEFAULT NULL,
  `insurance_id` varchar(25) DEFAULT NULL COMMENT 'provider asuransi fk sys_type - insprovider01',
  `_no_insurance` varchar(45) DEFAULT NULL,
  `pendidikan_id` varchar(25) NOT NULL COMMENT 'pendidikan terakhir - fk sys_type pendidikan01',
  `_pendidikan_place` varchar(45) NOT NULL,
  `_pendidikan_year` smallint(6) NOT NULL COMMENT 'tahun lulus',
  `bank_id` varchar(25) DEFAULT NULL COMMENT 'fk sys_type (BANK01)',
  `_bank_account_no` varchar(45) DEFAULT NULL,
  `_experience` text NOT NULL,
  `_photo_url` varchar(300) DEFAULT NULL,
  `_photo_real_name` varchar(200) DEFAULT NULL,
  `_photo_enc_name` varchar(100) DEFAULT NULL,
  `create_date` datetime NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `admin_last_update` datetime DEFAULT NULL,
  `admin_last_update_by` varchar(25) DEFAULT NULL COMMENT 'fk cms_tm_user',
  `admin_last_update_reason` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fe_tm_pelamar_personal_info`
--

INSERT INTO `fe_tm_pelamar_personal_info` (`pelamar_personal_info_no`, `pelamar_no`, `_no_ktp`, `_fullname`, `place_birth`, `_birthdate`, `_gender`, `_closer_person_fullname`, `_closer_person_phone`, `religion_id`, `_address_ktp`, `_address_ktp_kelurahan`, `_address_ktp_kecamatan`, `address_ktp_kota`, `_address_sekarang`, `address_sekarang_kota`, `_height`, `_weight`, `skin_color_id`, `_phone_home`, `_phone_primary`, `_phone_secondary`, `relationship_id`, `_total_children`, `_no_sim_a`, `_no_sim_b1`, `_no_sim_b2`, `_no_sim_c`, `owned_kendaraan_id`, `_no_npwp`, `_no_bpjs_tk`, `_no_bpjs_kesehatan`, `insurance_id`, `_no_insurance`, `pendidikan_id`, `_pendidikan_place`, `_pendidikan_year`, `bank_id`, `_bank_account_no`, `_experience`, `_photo_url`, `_photo_real_name`, `_photo_enc_name`, `create_date`, `last_update`, `admin_last_update`, `admin_last_update_by`, `admin_last_update_reason`) VALUES
('PELAMARPI0000000032016', 'PELAMAR0000000242016', 'No KTP', 'Nama Lengkap', 'LOC000000452016', '1990-01-01', '0', 'nama orang terdekat', 'Telepon Orang Terdekat', 'RELIGION01', 'alamat ktp', 'Keluharan (KTP)', 'Kecamatan (KTP)', 'LOC000000452016', 'Alamat Sekarang\r\n', 'LOC000000452016', 13, 12, 'SKINCOLOR01', '', '', '', 'RELATIONSHIP01', 2, 'No SIM A', 'No SIM B1', 'No SIM B2', 'No SIM C', 'KENDARAAN01', 'npwp', 'No BPJS Ketenagakerjaan', 'No BPJS Kesehatan', 'INSPROVIDER02', 'no rek asu', 'PENDIDIKAN01', 'tempat pendidikan', 2004, 'BANK01', 'no rek bank', 'asdasdasd', 'http://localhost/siprama-recruitment-web/public_assets/uploads/4edb0e4b25f6c0b22768aaa3faba7c8a.jpg', '04.jpg', '4edb0e4b25f6c0b22768aaa3faba7c8a.jpg', '2016-10-03 20:12:04', '2016-10-13 06:12:42', NULL, NULL, NULL),
('PELAMARPI0000000092016', 'PELAMAR0000000452016', '1808011111', 'Leo Masta Kusuma', 'LOC000000452016', '2016-03-12', '1', 'Riza Masta', '', 'RELIGION01', 'Jl Jendrel', 'Kelurahan ', 'Kecamatan', 'LOC000000452016', 'Alamat Sekarang', 'LOC000000452016', 50, 170, 'SKINCOLOR01', '08123123', '', '', 'RELATIONSHIP01', NULL, '', '', '', '', 'KENDARAAN01', '', '', '', 'INSPROVIDER01', NULL, 'PENDIDIKAN03', 'jakarata', 2015, 'BANK03', '123123', '', 'http://localhost/siprama-recruitment-web/public_assets/uploads/3aaff8c48a7621c0aa4a9b2fc9f0b34a.png', 'Screenshot from 2016-10-03 19-51-12.png', '3aaff8c48a7621c0aa4a9b2fc9f0b34a.png', '2016-10-03 20:37:24', '0000-00-00 00:00:00', NULL, NULL, NULL),
('PELAMARPI0000000282016', 'PELAMAR0000000462016', 'Kara Binar', 'Yansen ', 'LOC000000452016', '2015-02-01', '0', 'Nama Orang Terdekat', 'Telepon Orang Terdekat', 'RELIGION01', 'jln', 'Keluharan (KTP)', 'Kecamatan (KTP)', 'LOC000000452016', 'Alamat Sekarang\r\n', 'LOC000000452016', 12, 23, 'SKINCOLOR01', '', '', '', 'RELATIONSHIP01', 0, 'No SIM A', 'No SIM A', 'No SIM A', 'No SIM A', 'KENDARAAN01', '', '', '', 'INSPROVIDER01', 'qweqwe', 'PENDIDIKAN01', 'Jakarta', 2013, 'BANK01', '8000111', 'Seorang yang sangat ulet', 'http://localhost/siprama-recruitment-web/public_assets/uploads/60f1912d9f03f356fcf8a61dbae6c803.jpg', '05.jpg', '60f1912d9f03f356fcf8a61dbae6c803.jpg', '2016-10-04 13:37:12', '2016-11-08 05:49:15', NULL, NULL, NULL),
('PELAMARPI0000000662016', 'PELAMAR0000000302016', '88123123', 'Leo Masta Kusuma', 'LOC000000452016', '2016-09-20', '0', '', '', 'RELIGION02', '123123', '123123', '123123', 'LOC000000452016', '123123', 'LOC000000452016', 4, 12, 'SKINCOLOR01', '123123', '123123', '12312', 'RELATIONSHIP01', 2, '12', '12', '123', '123', 'KENDARAAN01', '', '', '', 'INSPROVIDER00', '123', 'PENDIDIKAN01', '23', 2323, 'BANK00', '23', '23', NULL, NULL, NULL, '2016-10-04 20:21:45', '2016-10-12 11:32:01', NULL, NULL, NULL),
('PELAMARPI0000000682016', 'PELAMAR0000000492016', '111', 'Aldhonie', 'LOC000000452016', '2016-01-01', '0', 'YA', 'YA', 'RELIGION01', '', '', '', 'LOC000000452016', 'Jl Sekarang', 'LOC000000452016', 0, 0, 'SKINCOLOR01', '', '', '', 'RELATIONSHIP02', NULL, 'YA', 'YA', 'YA', 'YA', 'KENDARAAN01', '', '', '', 'INSPROVIDER00', '', 'PENDIDIKAN01', 'Jakarta', 2016, 'BANK00', '', '1231231231', 'http://localhost/siprama-recruitment-web/public_assets/uploads/53c39318e13b5086a3311c6158dfad77.png', 'Screenshot from 2016-10-03 19-51-12.png', '53c39318e13b5086a3311c6158dfad77.png', '2016-10-04 23:10:33', '0000-00-00 00:00:00', NULL, NULL, NULL),
('PELAMARPI0000000692016', 'PELAMAR0000000492016', '111', 'Aldhonie', 'LOC000000452016', '2016-01-01', '0', 'YA', 'YA', 'RELIGION01', '', '', '', 'LOC000000452016', 'Jl Sekarang', 'LOC000000452016', 0, 0, 'SKINCOLOR01', '', '', '', 'RELATIONSHIP02', NULL, 'YA', 'YA', 'YA', 'YA', 'KENDARAAN01', '', '', '', 'INSPROVIDER00', '', 'PENDIDIKAN01', 'Jakarta', 2016, 'BANK00', '', '1231231231', 'http://localhost/siprama-recruitment-web/public_assets/uploads/c9adab4b1c0869f53ca55ce83d1cbd8e.png', 'Screenshot from 2016-10-03 19-51-12.png', 'c9adab4b1c0869f53ca55ce83d1cbd8e.png', '2016-10-04 23:13:01', '0000-00-00 00:00:00', NULL, NULL, NULL),
('PELAMARPI0000000702016', 'PELAMAR0000000512016', 'Testing', 'Testing', 'LOC000000452016', '2014-01-01', '0', '', '', 'RELIGION01', 'ALamat', '', '', 'LOC000000452016', '', 'LOC000000452016', 0, 0, 'SKINCOLOR02', '', '', '', 'RELATIONSHIP02', NULL, 'qweqwe', 'qweqwe', 'qweqwe', 'qweqwe', 'KENDARAAN02', '', '', '', 'INSPROVIDER00', '', 'PENDIDIKAN02', '', 0, 'BANK00', '', '', 'http://localhost/siprama-recruitment-web/public_assets/uploads/e271bc5c8be58eb79e1b88aec5f8615a.png', 'Screenshot from 2016-10-03 19-51-12.png', 'e271bc5c8be58eb79e1b88aec5f8615a.png', '2016-10-05 20:01:30', '0000-00-00 00:00:00', NULL, NULL, NULL),
('PELAMARPI0000000712016', 'PELAMAR0000000512016', 'Testing', 'Testing', 'LOC000000452016', '2014-01-01', '0', '', '', 'RELIGION01', 'ALamat', '', '', 'LOC000000452016', '', 'LOC000000452016', 0, 0, 'SKINCOLOR02', '', '', '', 'RELATIONSHIP02', NULL, 'qweqwe', 'qweqwe', 'qweqwe', 'qweqwe', 'KENDARAAN02', '', '', '', 'INSPROVIDER00', '', 'PENDIDIKAN02', '', 0, 'BANK00', '', '', 'http://localhost/siprama-recruitment-web/public_assets/uploads/a5c7032d97f9a7ae89f675910c9b6ce5.png', 'Screenshot from 2016-10-03 19-51-12.png', 'a5c7032d97f9a7ae89f675910c9b6ce5.png', '2016-10-05 20:04:45', '0000-00-00 00:00:00', NULL, NULL, NULL),
('PELAMARPI0000000722016', 'PELAMAR0000000632016', '4234324324', 'sdfdsfds', 'LOC000000452016', '2016-10-14', '0', 'fdsfdsfds', '23432432', 'RELIGION01', 'fdsfdsfds', 'dsfdsfds', 'fdsfdsfds', 'LOC000000452016', 'fdsfdsfds', 'LOC000000452016', 32767, 34, 'SKINCOLOR01', '34324324', '23432432423', '4234234', 'RELATIONSHIP02', NULL, '432432432', '4324324', '4242342', '423432432', 'KENDARAAN01', '4234324', '24323432', '4234324', 'INSPROVIDER00', '423432432432', 'PENDIDIKAN01', 'jakrta', 2012, 'BANK01', '4324324324', 'fdfgdgfdg', 'http://yansen.dev.codigo.id/myr/siprama-recruitment-web/public_assets/uploads/6555c598d9355971e075a5537225a83c.png', 'natsu_dragneel_render_by_stella1994x-d83504u.png', '6555c598d9355971e075a5537225a83c.png', '2016-10-14 02:18:41', '0000-00-00 00:00:00', NULL, NULL, NULL),
('PELAMARPI0000000742016', 'PELAMAR0000000662016', '12332343243', 'tes yansen', 'LOC000000522016', '2016-10-17', '0', 'kirik', '88888888888', 'RELIGION01', 'alamat ktp', 'kelurahan ktp', 'kec ktp', 'LOC000000522016', 'alamat skrng', 'LOC000000522016', 178, 44, 'SKINCOLOR01', '33333333333', '333333333333', '33333333333', 'RELATIONSHIP02', NULL, '1111111111111', '111111111111', '1111111111111', '1111111111111', 'KENDARAAN01', '111111111111111111', '1111111111111111111', '11111111111111111', 'INSPROVIDER00', NULL, 'PENDIDIKAN01', 'jakarta', 2012, 'BANK01', '2222222222222222', 'kdjdklsjkdjdfkldsjflkds', 'http://yansen.dev.codigo.id/myr/siprama-recruitment-web/public_assets/uploads/63fadf008a15221e2357703a9bfb2ece.png', 'natsu_dragneel_render_by_stella1994x-d83504u.png', '63fadf008a15221e2357703a9bfb2ece.png', '2016-10-17 06:17:14', '0000-00-00 00:00:00', NULL, NULL, NULL),
('PELAMARPI0000000752016', 'PELAMAR0000000652016', '5555555555555', 'yansen', 'LOC000000522016', '2016-10-17', '0', 'kirik', '6666666666666', 'RELIGION01', 'alamat ktp', 'kel ktp', 'kec ktp', 'LOC000000522016', 'alamat skerng', 'LOC000000522016', 45, 144, 'SKINCOLOR01', '666666666666', '666666666666', '666666666666', 'RELATIONSHIP02', NULL, '666666666666', '666666666666', '555555555555', '666666666666', 'KENDARAAN01', '1111111111111', '111111111111', '11111111111111', 'INSPROVIDER00', NULL, 'PENDIDIKAN01', 'jakarta', 2012, 'BANK01', '5555555555555', 'dhasgdhfjdsfds', 'http://yansen.dev.codigo.id/myr/siprama-recruitment-web/public_assets/uploads/28fd7242501cc5f2da9244132b9ce92a.png', 'natsu_dragneel_render_by_stella1994x-d83504u.png', '28fd7242501cc5f2da9244132b9ce92a.png', '2016-10-17 06:23:53', '0000-00-00 00:00:00', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `fe_tm_pelamar_personal_info_history`
--

CREATE TABLE `fe_tm_pelamar_personal_info_history` (
  `pelamar_personal_info_history_no` varchar(30) NOT NULL,
  `type_history_id` varchar(25) NOT NULL COMMENT 'fk sys_type (category 27)',
  `pelamar_personal_info_no` varchar(30) NOT NULL COMMENT 'fk fe_tm_pelamar_personal_info',
  `pelamar_no` varchar(30) NOT NULL COMMENT 'fk fe_pelamar',
  `_no_ktp` varchar(30) NOT NULL,
  `_fullname` varchar(60) NOT NULL,
  `place_birth` varchar(30) NOT NULL COMMENT 'fk sys_tm_location',
  `_birthdate` date NOT NULL,
  `_gender` enum('0','1') NOT NULL COMMENT '0=female 1=male',
  `_closer_person_fullname` varchar(60) NOT NULL COMMENT 'orang terdekat',
  `_closer_person_phone` varchar(25) NOT NULL COMMENT 'telepon orang terdekat',
  `religion_id` varchar(25) NOT NULL COMMENT 'fk sys_type (RELIGION01)',
  `_address_ktp` varchar(300) NOT NULL,
  `_address_ktp_kelurahan` varchar(45) DEFAULT NULL,
  `_address_ktp_kecamatan` varchar(45) DEFAULT NULL,
  `address_ktp_kota` varchar(30) NOT NULL COMMENT 'fk cms_tm_location_ type city',
  `_address_sekarang` varchar(300) NOT NULL,
  `address_sekarang_kota` varchar(30) NOT NULL COMMENT 'fk cms_tm_location type city',
  `_height` smallint(3) NOT NULL COMMENT 'tinggi_badan cm',
  `_weight` smallint(3) NOT NULL COMMENT 'berat_badan kg',
  `skin_color_id` varchar(25) NOT NULL COMMENT 'FK SYS_TYPE (SKINCOLOR)',
  `_phone_home` varchar(25) DEFAULT NULL,
  `_phone_primary` varchar(25) NOT NULL,
  `_phone_secondary` varchar(25) DEFAULT NULL,
  `relationship_id` varchar(25) NOT NULL COMMENT 'fk sys_type (RELATIONSHIP01)',
  `_total_children` smallint(6) DEFAULT NULL COMMENT 'jika menikah atau bercerai harus diisi (boleh 0)',
  `_no_sim_a` varchar(45) DEFAULT NULL,
  `_no_sim_b1` varchar(45) DEFAULT NULL,
  `_no_sim_b2` varchar(45) DEFAULT NULL,
  `_no_sim_c` varchar(45) DEFAULT NULL,
  `owned_kendaraan_id` varchar(25) NOT NULL COMMENT 'kendaraan yang dimiliki FK sys_type (KENDARAAN01)',
  `_no_npwp` varchar(45) DEFAULT NULL,
  `_no_bpjs_tk` varchar(45) DEFAULT NULL,
  `_no_bpjs_kesehatan` varchar(45) DEFAULT NULL,
  `insurance_id` varchar(25) DEFAULT NULL COMMENT 'provider asuransi fk sys_type - insprovider01',
  `_no_insurance` varchar(45) DEFAULT NULL,
  `pendidikan_id` varchar(25) NOT NULL COMMENT 'pendidikan terakhir - fk sys_type pendidikan01',
  `_pendidikan_place` varchar(45) NOT NULL,
  `_pendidikan_year` smallint(6) NOT NULL COMMENT 'tahun lulus',
  `bank_id` varchar(25) DEFAULT NULL COMMENT 'fk sys_type (BANK01)',
  `_bank_account_no` varchar(45) DEFAULT NULL,
  `_experience` text NOT NULL,
  `_photo_url` varchar(300) DEFAULT NULL,
  `_photo_real_name` varchar(200) DEFAULT NULL,
  `_photo_enc_name` varchar(100) DEFAULT NULL,
  `create_date` datetime NOT NULL,
  `create_by_source` varchar(25) NOT NULL COMMENT 'fk sys type category 28',
  `create_by_pelamar_no` varchar(30) DEFAULT NULL COMMENT 'fk fe_tm_pelamar (history dicreate oleh pelamar)',
  `create_by_user_no` varchar(25) DEFAULT NULL COMMENT 'fk cms_tm_user (history di create oleh user cms)',
  `create_by_user_no_reason` varchar(300) DEFAULT NULL COMMENT 'alasan user cms dml data'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fe_tm_pelamar_personal_info_history`
--

INSERT INTO `fe_tm_pelamar_personal_info_history` (`pelamar_personal_info_history_no`, `type_history_id`, `pelamar_personal_info_no`, `pelamar_no`, `_no_ktp`, `_fullname`, `place_birth`, `_birthdate`, `_gender`, `_closer_person_fullname`, `_closer_person_phone`, `religion_id`, `_address_ktp`, `_address_ktp_kelurahan`, `_address_ktp_kecamatan`, `address_ktp_kota`, `_address_sekarang`, `address_sekarang_kota`, `_height`, `_weight`, `skin_color_id`, `_phone_home`, `_phone_primary`, `_phone_secondary`, `relationship_id`, `_total_children`, `_no_sim_a`, `_no_sim_b1`, `_no_sim_b2`, `_no_sim_c`, `owned_kendaraan_id`, `_no_npwp`, `_no_bpjs_tk`, `_no_bpjs_kesehatan`, `insurance_id`, `_no_insurance`, `pendidikan_id`, `_pendidikan_place`, `_pendidikan_year`, `bank_id`, `_bank_account_no`, `_experience`, `_photo_url`, `_photo_real_name`, `_photo_enc_name`, `create_date`, `create_by_source`, `create_by_pelamar_no`, `create_by_user_no`, `create_by_user_no_reason`) VALUES
('PELAMARPIHST0000000505102016', 'TYPEHST01', 'PELAMARPI0000000712016', 'PELAMAR0000000512016', 'Testing', 'Testing', 'LOC000000452016', '2014-01-01', '0', '', '', 'RELIGION01', 'ALamat', '', '', 'LOC000000452016', '', 'LOC000000452016', 0, 0, 'SKINCOLOR02', '', '', '', 'RELATIONSHIP02', NULL, 'qweqwe', 'qweqwe', 'qweqwe', 'qweqwe', 'KENDARAAN02', '', '', '', 'INSPROVIDER00', '', 'PENDIDIKAN02', '', 0, 'BANK00', '', '', 'http://localhost/siprama-recruitment-web/public_assets/uploads/a5c7032d97f9a7ae89f675910c9b6ce5.png', 'Screenshot from 2016-10-03 19-51-12.png', 'a5c7032d97f9a7ae89f675910c9b6ce5.png', '2016-10-05 20:04:45', 'TYPEHSTCRTBY02', 'PELAMAR0000000512016', NULL, NULL),
('PELAMARPIHST0000000614102016', 'TYPEHST01', 'PELAMARPI0000000722016', 'PELAMAR0000000632016', '4234324324', 'sdfdsfds', 'LOC000000452016', '2016-10-14', '0', 'fdsfdsfds', '23432432', 'RELIGION01', 'fdsfdsfds', 'dsfdsfds', 'fdsfdsfds', 'LOC000000452016', 'fdsfdsfds', 'LOC000000452016', 32767, 34, 'SKINCOLOR01', '34324324', '23432432423', '4234234', 'RELATIONSHIP02', NULL, '432432432', '4324324', '4242342', '423432432', 'KENDARAAN01', '4234324', '24323432', '4234324', 'INSPROVIDER00', '423432432432', 'PENDIDIKAN01', 'jakrta', 2012, 'BANK01', '4324324324', 'fdfgdgfdg', 'http://yansen.dev.codigo.id/myr/siprama-recruitment-web/public_assets/uploads/6555c598d9355971e075a5537225a83c.png', 'natsu_dragneel_render_by_stella1994x-d83504u.png', '6555c598d9355971e075a5537225a83c.png', '2016-10-14 02:18:41', 'TYPEHSTCRTBY02', 'PELAMAR0000000632016', NULL, NULL),
('PELAMARPIHST0000000717102016', 'TYPEHST01', 'PELAMARPI0000000742016', 'PELAMAR0000000662016', '12332343243', 'tes yansen', 'LOC000000522016', '2016-10-17', '0', 'kirik', '88888888888', 'RELIGION01', 'alamat ktp', 'kelurahan ktp', 'kec ktp', 'LOC000000522016', 'alamat skrng', 'LOC000000522016', 178, 44, 'SKINCOLOR01', '33333333333', '333333333333', '33333333333', 'RELATIONSHIP02', NULL, '1111111111111', '111111111111', '1111111111111', '1111111111111', 'KENDARAAN01', '111111111111111111', '1111111111111111111', '11111111111111111', 'INSPROVIDER00', NULL, 'PENDIDIKAN01', 'jakarta', 2012, 'BANK01', '2222222222222222', 'kdjdklsjkdjdfkldsjflkds', 'http://yansen.dev.codigo.id/myr/siprama-recruitment-web/public_assets/uploads/63fadf008a15221e2357703a9bfb2ece.png', 'natsu_dragneel_render_by_stella1994x-d83504u.png', '63fadf008a15221e2357703a9bfb2ece.png', '2016-10-17 06:17:14', 'TYPEHSTCRTBY02', 'PELAMAR0000000662016', NULL, NULL),
('PELAMARPIHST0000000817102016', 'TYPEHST01', 'PELAMARPI0000000752016', 'PELAMAR0000000652016', '5555555555555', 'yansen', 'LOC000000522016', '2016-10-17', '0', 'kirik', '6666666666666', 'RELIGION01', 'alamat ktp', 'kel ktp', 'kec ktp', 'LOC000000522016', 'alamat skerng', 'LOC000000522016', 45, 144, 'SKINCOLOR01', '666666666666', '666666666666', '666666666666', 'RELATIONSHIP02', NULL, '666666666666', '666666666666', '555555555555', '666666666666', 'KENDARAAN01', '1111111111111', '111111111111', '11111111111111', 'INSPROVIDER00', NULL, 'PENDIDIKAN01', 'jakarta', 2012, 'BANK01', '5555555555555', 'dhasgdhfjdsfds', 'http://yansen.dev.codigo.id/myr/siprama-recruitment-web/public_assets/uploads/28fd7242501cc5f2da9244132b9ce92a.png', 'natsu_dragneel_render_by_stella1994x-d83504u.png', '28fd7242501cc5f2da9244132b9ce92a.png', '2016-10-17 06:23:53', 'TYPEHSTCRTBY02', 'PELAMAR0000000652016', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `fe_tx_apply_lowongan`
--

CREATE TABLE `fe_tx_apply_lowongan` (
  `apply_lowongan_no` varchar(30) NOT NULL COMMENT 'nextseq_daily',
  `branch_id` varchar(20) NOT NULL COMMENT 'fk sys_tm_branch',
  `lowongan_no` varchar(30) NOT NULL COMMENT 'fk cms_tm_lowongan',
  `pelamar_no` varchar(30) NOT NULL COMMENT 'fk fe_tm_pelamar',
  `status_apply_lowongan_id` varchar(25) NOT NULL COMMENT 'fk sys_type - default awal STATUS01 (created) lalu STATUSPSIxx | STATUSINTxx |STATUSINTCLxx (dari status psikotes - interview - interview klien)',
  `_cancel` enum('0','1') NOT NULL DEFAULT '0',
  `_cancel_reason` varchar(300) DEFAULT NULL,
  `_active` enum('0','1') NOT NULL DEFAULT '1',
  `_delete` enum('0','1') NOT NULL DEFAULT '0',
  `create_date` datetime NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `admin_last_update` datetime DEFAULT NULL,
  `admin_last_update_by` varchar(25) DEFAULT NULL COMMENT 'fk cms_tm_user',
  `admin_last_update_reason` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fe_tx_apply_lowongan`
--

INSERT INTO `fe_tx_apply_lowongan` (`apply_lowongan_no`, `branch_id`, `lowongan_no`, `pelamar_no`, `status_apply_lowongan_id`, `_cancel`, `_cancel_reason`, `_active`, `_delete`, `create_date`, `last_update`, `admin_last_update`, `admin_last_update_by`, `admin_last_update_reason`) VALUES
('APLYLWGN00000001505112016', 'BRANCH00116', 'LWGN00000382016', 'PELAMAR0000000462016', 'STATUSINTCL02', '0', NULL, '1', '0', '2016-11-05 22:58:29', '2016-11-05 16:02:05', '0000-00-00 00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `fe_tx_apply_lowongan_history`
--

CREATE TABLE `fe_tx_apply_lowongan_history` (
  `apply_lowongan_history_no` varchar(30) NOT NULL COMMENT 'nextseq_daily',
  `apply_lowongan_no` varchar(30) NOT NULL COMMENT 'fk fe_tx_apply_lowongan',
  `status_apply_lowongan_id` varchar(25) NOT NULL COMMENT 'fk sys_type',
  `_cancel` enum('0','1') NOT NULL DEFAULT '0',
  `_cancel_reason` varchar(300) DEFAULT NULL,
  `_active` enum('0','1') NOT NULL DEFAULT '1',
  `_delete` enum('0','1') NOT NULL DEFAULT '0',
  `create_date` datetime NOT NULL,
  `create_by_source` varchar(25) NOT NULL COMMENT 'fk sys type category 28',
  `create_by_pelamar_no` varchar(30) DEFAULT NULL COMMENT 'fk fe_tm_pelamar (history dicreate oleh pelamar)',
  `create_by_user_no` varchar(25) DEFAULT NULL COMMENT 'fk cms_tm_user (history di create oleh user cms)',
  `create_by_user_no_reason` varchar(300) DEFAULT NULL COMMENT 'alasan user cms dml data'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `fe_tx_psikotes`
--

CREATE TABLE `fe_tx_psikotes` (
  `psikotes_no` varchar(30) NOT NULL COMMENT 'nextseq_daily',
  `branch_id` varchar(20) NOT NULL COMMENT 'fk sys_tm_branch',
  `apply_lowongan_no` varchar(30) NOT NULL COMMENT 'fk fe_tx_apply_lowongan',
  `_score` smallint(6) DEFAULT NULL COMMENT 'hasil dari sum psikotes_detail._current_score ',
  `_jumlah_soal` smallint(6) DEFAULT NULL COMMENT 'hasil dari count psikotes_detail.psikotes_detail_no',
  `status_psikotes_id` varchar(25) NOT NULL COMMENT 'fk sys_type (category 22)',
  `_analisa` text,
  `follow_up_by` varchar(25) DEFAULT NULL COMMENT 'fk cms_tm_user',
  `_active` enum('0','1') NOT NULL DEFAULT '1',
  `_delete` enum('0','1') NOT NULL DEFAULT '0',
  `create_date` datetime NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_update_by` varchar(25) DEFAULT NULL COMMENT 'fk cms_tm_user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fe_tx_psikotes`
--

INSERT INTO `fe_tx_psikotes` (`psikotes_no`, `branch_id`, `apply_lowongan_no`, `_score`, `_jumlah_soal`, `status_psikotes_id`, `_analisa`, `follow_up_by`, `_active`, `_delete`, `create_date`, `last_update`, `last_update_by`) VALUES
('PSI00000004105112016', 'BRANCH00116', 'APLYLWGN00000001505112016', 50, 10, 'STATUSPSI02', '<p>CUKUP</p>\r\n', 'USR0000001516', '1', '0', '2016-11-05 22:58:57', '2016-11-05 16:01:32', 'USR0000001516');

-- --------------------------------------------------------

--
-- Table structure for table `fe_tx_psikotes_detail`
--

CREATE TABLE `fe_tx_psikotes_detail` (
  `psikotes_detail_no` varchar(30) NOT NULL COMMENT 'nextseq_daily',
  `psikotes_no` varchar(30) NOT NULL COMMENT 'fk fe_tx_psikotes',
  `soal_id` varchar(30) NOT NULL COMMENT 'fk cms_tm_soal',
  `_opsi` varchar(1) NOT NULL,
  `_current_opsi` varchar(200) NOT NULL,
  `_current_score` decimal(3,2) NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fe_tx_psikotes_detail`
--

INSERT INTO `fe_tx_psikotes_detail` (`psikotes_detail_no`, `psikotes_no`, `soal_id`, `_opsi`, `_current_opsi`, `_current_score`, `create_date`) VALUES
('PSIDTL00000046805112016', 'PSI00000004105112016', 'SOAL0000000022016', 'b', 'adalah', '4.00', '2016-11-05 22:58:57'),
('PSIDTL00000046905112016', 'PSI00000004105112016', 'SOAL0000000282016', 'c', 'Kewajiban', '9.00', '2016-11-05 22:58:57'),
('PSIDTL00000047005112016', 'PSI00000004105112016', 'SOAL0000000602016', 'c', 'qwr', '3.00', '2016-11-05 22:58:57'),
('PSIDTL00000047105112016', 'PSI00000004105112016', 'SOAL0000000612016', 'a', 'qwe', '2.00', '2016-11-05 22:58:57'),
('PSIDTL00000047205112016', 'PSI00000004105112016', 'SOAL0000000292016', 'd', 'Berusaha semampunya untuk tidak melakukannya', '5.00', '2016-11-05 22:58:57'),
('PSIDTL00000047305112016', 'PSI00000004105112016', 'SOAL0000000312016', 'b', 'Hal tersebut sering terjadi di kantor manapun', '3.00', '2016-11-05 22:58:57'),
('PSIDTL00000047405112016', 'PSI00000004105112016', 'SOAL0000000592016', 'b', 'tete', '9.99', '2016-11-05 22:58:57'),
('PSIDTL00000047505112016', 'PSI00000004105112016', 'SOAL0000000332016', 'b', 'Mengusahakan keterlibatan pegawai dalam pengambilan keputusan', '4.00', '2016-11-05 22:58:57'),
('PSIDTL00000047605112016', 'PSI00000004105112016', 'SOAL0000000352016', 'c', ' Ragu  ragu dalam mengambil keputusan tanpa petunjuk atasan saya', '5.00', '2016-11-05 22:58:57'),
('PSIDTL00000047705112016', 'PSI00000004105112016', 'SOAL0000000382016', 'b', 'menerimanya, meski tentu saja dengan sedikit kekecewaan ', '5.00', '2016-11-05 22:58:57');

-- --------------------------------------------------------

--
-- Table structure for table `sequence_data`
--

CREATE TABLE `sequence_data` (
  `sequence_name` varchar(60) NOT NULL,
  `sequence_prefix` varchar(20) DEFAULT NULL,
  `sequence_suffix` varchar(10) DEFAULT NULL,
  `sequence_increment` int(11) NOT NULL DEFAULT '1',
  `sequence_min_value` int(11) NOT NULL DEFAULT '1',
  `sequence_max_value` bigint(20) NOT NULL DEFAULT '999999999999999999',
  `sequence_cur_value` bigint(20) NOT NULL DEFAULT '0',
  `sequence_cycle` tinyint(1) NOT NULL DEFAULT '1',
  `period` date DEFAULT NULL,
  `create_date` datetime NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sequence_data`
--

INSERT INTO `sequence_data` (`sequence_name`, `sequence_prefix`, `sequence_suffix`, `sequence_increment`, `sequence_min_value`, `sequence_max_value`, `sequence_cur_value`, `sequence_cycle`, `period`, `create_date`, `last_update`) VALUES
('cms_tm_client', 'CLIENT', '%y', 1, 1, 999999, 24, 1, NULL, '2016-10-16 00:00:00', '2016-10-25 10:25:48'),
('cms_tm_client_attachment', 'CLIENTATT', '%y', 1, 1, 9999999, 1, 1, NULL, '2016-10-16 00:00:00', '2016-09-15 20:15:03'),
('cms_tm_location', 'LOC', '%Y', 1, 1, 99999999, 82, 1, NULL, '2016-10-16 00:00:00', '2016-10-26 10:28:26'),
('cms_tm_lowongan', 'LWGN', '%Y', 1, 1, 9999999, 70, 1, NULL, '2016-10-16 00:00:00', '2016-10-26 04:16:18'),
('cms_tm_lowongan_promoted', 'LWGNPROMOTE', '%m%Y', 1, 1, 99999999, 126, 1, NULL, '2016-10-16 00:00:00', '2016-10-28 16:55:04'),
('cms_tm_multimediabank', 'MMDBANK', '%m%Y', 1, 1, 99999999, 7, 1, NULL, '2016-10-16 00:00:00', '2016-10-27 15:07:43'),
('cms_tm_pekerjaan', 'PKJ', '%Y', 1, 1, 99999999, 27, 1, NULL, '2016-10-16 00:00:00', '2016-11-08 05:12:18'),
('cms_tm_pekerjaan_branch', 'PKJBRANCH', '%y', 1, 1, 999999, 39, 1, NULL, '2016-10-16 00:00:00', '2016-11-08 05:12:18'),
('cms_tm_soal', 'SOAL', '%Y', 1, 1, 999999999, 69, 1, NULL, '2016-10-16 00:00:00', '2016-10-24 08:22:57'),
('cms_tm_user', 'USR', '%y', 1, 1, 99999999, 18, 1, NULL, '2016-10-16 00:00:00', '2016-09-19 02:18:28'),
('cms_tm_user_access', 'USRACC', '%y', 1, 1, 999999999, 131, 1, NULL, '2016-10-16 00:00:00', '2016-10-28 17:04:35'),
('cms_tx_interview', 'INTERVIEW', '%m%Y', 1, 1, 99999999, 9, 1, NULL, '2016-10-16 00:00:00', '2016-11-05 16:01:32'),
('cms_tx_interview_client', 'INTERVIEWCL', '%m%Y', 1, 1, 99999999, 10, 1, NULL, '2016-10-16 00:00:00', '2016-11-05 16:01:51'),
('fe_tm_pelamar', 'PELAMAR', '%Y', 1, 1, 999999999, 70, 1, NULL, '2016-10-16 00:00:00', '2016-10-25 11:43:18'),
('fe_tm_pelamar_family_info', 'PELAMARFI', '%Y', 1, 1, 999999999, 12, 1, NULL, '2016-10-16 00:00:00', '2016-10-13 05:30:15'),
('fe_tm_pelamar_family_info_history', 'PELAMARFIHST', '%d%m%Y', 1, 1, 99999999, 10, 1, NULL, '2016-10-16 00:00:00', '2016-10-04 06:40:41'),
('fe_tm_pelamar_personal_info', 'PELAMARPI', '%Y', 1, 1, 999999999, 75, 1, NULL, '2016-10-16 00:00:00', '2016-10-16 23:23:53'),
('fe_tm_pelamar_personal_info_history', 'PELAMARPIHST', '%d%m%Y', 1, 1, 99999999, 8, 1, NULL, '2016-10-16 00:00:00', '2016-10-16 23:23:53'),
('fe_tx_apply_lowongan', 'APLYLWGN', '%d%m%Y', 1, 1, 999999999, 15, 1, NULL, '2016-10-16 00:00:00', '2016-11-05 15:58:29'),
('fe_tx_apply_lowongan_history', 'APLYLWGNHST', '%d%m%Y', 1, 1, 99999999999, 0, 1, NULL, '2016-10-16 00:00:00', '2016-10-15 17:00:00'),
('fe_tx_psikotes', 'PSI', '%d%m%Y', 1, 1, 999999999, 42, 1, NULL, '2016-10-16 00:00:00', '2016-11-05 16:00:37'),
('fe_tx_psikotes_detail', 'PSIDTL', '%d%m%Y', 1, 1, 999999999, 487, 1, NULL, '2016-10-16 00:00:00', '2016-11-05 16:00:37'),
('sys_tm_branch', 'BRANCH', '%y', 1, 1, 999999, 7, 1, NULL, '2016-10-16 00:00:00', '2016-09-17 22:47:09'),
('sys_tm_branch_role', 'BRANCHROLE', '%y', 1, 1, 999999, 1381, 1, NULL, '2016-10-16 00:00:00', '2016-10-28 17:02:11'),
('sys_tm_corporate', 'CORP', '%y', 1, 1, 9999, 21, 1, NULL, '2016-10-16 00:00:00', '2016-09-19 02:49:01'),
('sys_tm_role', 'ROLE', '%y', 1, 1, 999999, 91, 1, NULL, '2016-10-16 00:00:00', '2016-10-28 17:00:34'),
('sys_type.pekerjaan', 'PEKERJAAN', '%y', 1, 1, 99999, 0, 1, NULL, '2016-10-16 00:00:00', '2016-10-15 10:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `sys_category`
--

CREATE TABLE `sys_category` (
  `category_no` int(11) NOT NULL,
  `_name` varchar(25) NOT NULL,
  `_desc` varchar(80) DEFAULT NULL,
  `create_date` datetime NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sys_category`
--

INSERT INTO `sys_category` (`category_no`, `_name`, `_desc`, `create_date`, `last_update`) VALUES
(1, 'object', 'category object', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
(2, 'content', 'category content', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
(3, 'third party provider', 'category provider', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
(4, 'status', 'category status', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
(5, 'attachment', 'category attachment', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
(6, 'img_ratio', 'category image ratio', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
(7, 'user fe', 'category user front end', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
(8, 'user level cms', 'category user cms', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
(9, 'social media provider', 'category social media provider', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
(10, 'location', 'category location', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
(11, 'gender', 'category gender', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
(12, 'religion', 'category agama', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
(13, 'skin color', 'category warna kulit', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
(14, 'relationship', 'catefory status pernikahan', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
(15, 'family', 'category family', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
(16, 'kendaraan', 'category kendaraan', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
(17, 'asuransi provider', 'category asuransi provider', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
(18, 'pendidikan', 'category pendidikan', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
(19, 'bank', 'category bank', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
(20, 'soal', 'category soal', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
(21, 'lowongan', 'category lowongan', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
(22, 'status psikotes', 'category status psikotes', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
(23, 'kontrak', 'category kontrak', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
(24, 'jenis gaji', 'category gaji', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
(25, 'status interview', 'category status interview', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
(26, 'status interview client', 'category status interview client', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
(27, 'type history', 'category type history', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
(28, 'type history create by', 'category history create by', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
(29, 'multimedia', 'category multimedia', '2016-06-10 00:00:00', '2016-06-09 17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `sys_tm_branch`
--

CREATE TABLE `sys_tm_branch` (
  `branch_id` varchar(20) NOT NULL COMMENT 'BRANCH + SEQ (001) + yy',
  `corporate_id` varchar(10) NOT NULL COMMENT 'fk sys_tm_corporate',
  `_name` varchar(45) NOT NULL,
  `_desc` varchar(200) DEFAULT NULL,
  `_address` varchar(250) DEFAULT NULL,
  `_phone` varchar(25) DEFAULT NULL,
  `_logo_real_name` varchar(250) DEFAULT NULL,
  `_logo_enc_name` varchar(150) DEFAULT NULL,
  `_logo_url` varchar(250) DEFAULT NULL,
  `_pic_name` varchar(45) DEFAULT NULL,
  `_pic_phone` varchar(25) DEFAULT NULL,
  `_pic_email` varchar(45) DEFAULT NULL,
  `_active` enum('0','1') NOT NULL DEFAULT '0',
  `_delete` enum('0','1') NOT NULL DEFAULT '0',
  `create_date` datetime NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sys_tm_branch`
--

INSERT INTO `sys_tm_branch` (`branch_id`, `corporate_id`, `_name`, `_desc`, `_address`, `_phone`, `_logo_real_name`, `_logo_enc_name`, `_logo_url`, `_pic_name`, `_pic_phone`, `_pic_email`, `_active`, `_delete`, `create_date`, `last_update`) VALUES
('BRANCH00116', 'CORP00116', 'BRANCH ADMIN', NULL, 'address', 'phone', NULL, NULL, NULL, 'FUFU', NULL, NULL, '1', '0', '2016-06-10 00:00:00', '2016-09-26 09:18:33');

-- --------------------------------------------------------

--
-- Table structure for table `sys_tm_branch_role`
--

CREATE TABLE `sys_tm_branch_role` (
  `branch_role_id` varchar(30) NOT NULL,
  `branch_id` varchar(20) NOT NULL COMMENT 'fk sys_tm_branch',
  `role_id` varchar(30) NOT NULL COMMENT 'fk sys_tm_role_',
  `_active` enum('0','1') NOT NULL DEFAULT '0',
  `_delete` enum('0','1') NOT NULL DEFAULT '0',
  `create_date` datetime NOT NULL,
  `create_by` varchar(25) DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_update_by` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sys_tm_branch_role`
--

INSERT INTO `sys_tm_branch_role` (`branch_role_id`, `branch_id`, `role_id`, `_active`, `_delete`, `create_date`, `create_by`, `last_update`, `last_update_by`) VALUES
('BRANCHROLE00002616', 'BRANCH00116', 'ROLE00001616', '1', '0', '2016-09-19 12:01:35', 'USR0000001716', '2016-09-18 22:01:35', NULL),
('BRANCHROLE00002716', 'BRANCH00116', 'ROLE00002616', '1', '0', '2016-09-19 12:12:48', 'USR0000001716', '2016-09-18 22:12:48', NULL),
('BRANCHROLE00002916', 'BRANCH00116', 'ROLE00002716', '1', '0', '2016-09-19 12:14:04', 'USR0000001716', '2016-09-18 22:14:04', NULL),
('BRANCHROLE00003016', 'BRANCH00116', 'ROLE00002816', '1', '0', '2016-09-19 13:20:51', 'USR0000001716', '2016-09-18 23:20:51', NULL),
('BRANCHROLE00003116', 'BRANCH00116', 'ROLE00002916', '1', '0', '2016-09-19 13:20:59', 'USR0000001716', '2016-09-18 23:20:59', NULL),
('BRANCHROLE00003216', 'BRANCH00116', 'ROLE00002316', '1', '0', '2016-09-19 13:25:20', 'USR0000001716', '2016-09-18 23:25:20', NULL),
('BRANCHROLE00003316', 'BRANCH00116', 'ROLE00001516', '1', '0', '2016-09-19 13:42:45', 'USR0000001716', '2016-09-18 23:42:45', NULL),
('BRANCHROLE00003416', 'BRANCH00116', 'ROLE00001916', '1', '0', '2016-09-19 15:16:24', 'USR0000001716', '2016-09-19 01:16:24', NULL),
('BRANCHROLE00003516', 'BRANCH00116', 'ROLE00001816', '1', '0', '2016-09-19 15:16:36', 'USR0000001716', '2016-09-19 01:16:36', NULL),
('BRANCHROLE00003616', 'BRANCH00116', 'ROLE00003016', '1', '0', '2016-09-19 15:22:03', 'USR0000001716', '2016-09-19 01:22:03', NULL),
('BRANCHROLE00003716', 'BRANCH00116', 'ROLE00002016', '1', '0', '2016-09-19 15:22:12', 'USR0000001716', '2016-09-19 01:22:12', NULL),
('BRANCHROLE00003916', 'BRANCH00116', 'ROLE00002116', '1', '0', '2016-09-19 15:33:16', 'USR0000001716', '2016-09-19 01:33:16', NULL),
('BRANCHROLE00004016', 'BRANCH00116', 'ROLE00002216', '1', '0', '2016-09-19 15:33:24', 'USR0000001716', '2016-09-19 01:33:24', NULL),
('BRANCHROLE00004216', 'BRANCH00116', 'ROLE00002416', '1', '0', '2016-09-19 15:47:08', 'USR0000001716', '2016-09-19 01:47:08', NULL),
('BRANCHROLE00004316', 'BRANCH00116', 'ROLE00002516', '1', '0', '2016-09-19 15:47:16', 'USR0000001716', '2016-09-19 01:47:16', NULL),
('BRANCHROLE00004416', 'BRANCH00116', 'ROLE00003116', '1', '0', '2016-09-19 16:01:42', 'USR0000001716', '2016-09-19 02:01:42', NULL),
('BRANCHROLE00004616', 'BRANCH00116', 'ROLE00003216', '1', '0', '2016-09-19 16:01:58', 'USR0000001716', '2016-09-19 02:01:58', NULL),
('BRANCHROLE00004716', 'BRANCH00116', 'ROLE00003616', '1', '0', '2016-09-19 16:43:11', 'USR0000001716', '2016-09-19 02:43:11', NULL),
('BRANCHROLE00004816', 'BRANCH00116', 'ROLE00003516', '1', '0', '2016-09-19 16:43:18', 'USR0000001716', '2016-09-19 02:43:18', NULL),
('BRANCHROLE00004916', 'BRANCH00116', 'ROLE00003416', '1', '0', '2016-09-19 16:43:24', 'USR0000001716', '2016-09-19 02:43:24', NULL),
('BRANCHROLE00005016', 'BRANCH00116', 'ROLE00003316', '1', '0', '2016-09-19 16:43:31', 'USR0000001716', '2016-09-19 02:43:31', NULL),
('BRANCHROLE00005116', 'BRANCH00116', 'ROLE00003716', '1', '0', '2016-09-26 18:51:33', 'USR0000001716', '2016-09-26 11:54:42', NULL),
('BRANCHROLE00005216', 'BRANCH00116', 'ROLE00003816', '1', '0', '2016-09-26 18:51:38', 'USR0000001716', '2016-09-26 11:54:47', NULL),
('BRANCHROLE00005316', 'BRANCH00116', 'ROLE00003916', '1', '0', '2016-09-26 18:51:45', 'USR0000001716', '2016-09-26 11:54:54', NULL),
('BRANCHROLE00005416', 'BRANCH00116', 'ROLE00004516', '1', '0', '2016-09-26 18:58:00', 'USR0000001716', '2016-09-26 12:01:10', NULL),
('BRANCHROLE00005516', 'BRANCH00116', 'ROLE00004016', '1', '0', '2016-09-20 18:17:50', 'USR0000001716', '2016-09-19 21:17:50', NULL),
('BRANCHROLE00005616', 'BRANCH00116', 'ROLE00004116', '1', '0', '2016-09-21 19:43:56', 'USR0000001716', '2016-09-20 22:43:56', NULL),
('BRANCHROLE00005716', 'BRANCH00116', 'ROLE00004216', '1', '0', '2016-09-21 19:44:02', 'USR0000001716', '2016-09-20 22:44:02', NULL),
('BRANCHROLE00005816', 'BRANCH00116', 'ROLE00004316', '1', '0', '2016-09-21 19:44:08', 'USR0000001716', '2016-09-20 22:44:08', NULL),
('BRANCHROLE00005916', 'BRANCH00116', 'ROLE00004416', '1', '0', '2016-09-21 19:44:13', 'USR0000001716', '2016-09-20 22:44:13', NULL),
('BRANCHROLE00133116', 'BRANCH00116', 'ROLE00005516', '1', '0', '2016-09-28 10:16:22', 'USR0000001716', '2016-09-28 03:19:36', NULL),
('BRANCHROLE00133216', 'BRANCH00116', 'ROLE00005616', '1', '0', '2016-09-28 10:16:27', 'USR0000001716', '2016-09-28 03:19:41', NULL),
('BRANCHROLE00133316', 'BRANCH00116', 'ROLE00005416', '1', '0', '2016-09-28 10:16:33', 'USR0000001716', '2016-09-28 03:19:46', NULL),
('BRANCHROLE00133416', 'BRANCH00116', 'ROLE00005716', '1', '0', '2016-09-28 10:25:58', 'USR0000001716', '2016-09-28 03:29:11', NULL),
('BRANCHROLE00133516', 'BRANCH00116', 'ROLE00005816', '1', '0', '2016-09-28 10:26:03', 'USR0000001716', '2016-09-28 03:29:17', NULL),
('BRANCHROLE00133616', 'BRANCH00116', 'ROLE00005916', '1', '0', '2016-09-28 10:26:09', 'USR0000001716', '2016-09-28 03:29:23', NULL),
('BRANCHROLE00133716', 'BRANCH00116', 'ROLE00006016', '1', '0', '2016-09-28 10:26:14', 'USR0000001716', '2016-09-28 03:29:28', NULL),
('BRANCHROLE00133816', 'BRANCH00116', 'ROLE00004716', '1', '0', '2016-09-28 10:30:05', 'USR0000001716', '2016-09-28 03:33:19', NULL),
('BRANCHROLE00133916', 'BRANCH00116', 'ROLE00004816', '1', '0', '2016-09-28 10:30:17', 'USR0000001716', '2016-09-28 03:33:31', NULL),
('BRANCHROLE00134016', 'BRANCH00116', 'ROLE00004916', '1', '0', '2016-09-28 10:30:25', 'USR0000001716', '2016-09-28 03:33:39', NULL),
('BRANCHROLE00134216', 'BRANCH00116', 'ROLE00005016', '1', '0', '2016-09-28 10:30:45', 'USR0000001716', '2016-09-28 03:33:59', NULL),
('BRANCHROLE00134316', 'BRANCH00116', 'ROLE00005116', '1', '0', '2016-09-28 10:30:55', 'USR0000001716', '2016-09-28 03:34:09', NULL),
('BRANCHROLE00134416', 'BRANCH00116', 'ROLE00005216', '1', '0', '2016-09-28 10:31:02', 'USR0000001716', '2016-09-28 03:34:16', NULL),
('BRANCHROLE00134516', 'BRANCH00116', 'ROLE00005316', '1', '0', '2016-09-28 10:31:09', 'USR0000001716', '2016-09-28 03:34:23', NULL),
('BRANCHROLE00134616', 'BRANCH00116', 'ROLE00006416', '1', '0', '2016-09-28 17:44:15', 'USR0000001716', '2016-09-28 10:47:29', NULL),
('BRANCHROLE00134716', 'BRANCH00116', 'ROLE00006316', '1', '0', '2016-09-28 17:44:20', 'USR0000001716', '2016-09-28 10:47:34', NULL),
('BRANCHROLE00134916', 'BRANCH00116', 'ROLE00006116', '1', '0', '2016-09-28 17:44:34', 'USR0000001716', '2016-09-28 10:47:49', NULL),
('BRANCHROLE00135116', 'BRANCH00116', 'ROLE00006216', '1', '0', '2016-09-28 17:44:48', 'USR0000001716', '2016-09-28 10:48:03', NULL),
('BRANCHROLE00135216', 'BRANCH00116', 'ROLE00006816', '1', '0', '2016-10-14 02:42:30', 'USR0000001716', '2016-10-13 19:44:58', NULL),
('BRANCHROLE00135316', 'BRANCH00116', 'ROLE00006716', '1', '0', '2016-10-14 02:42:35', 'USR0000001716', '2016-10-13 19:45:03', NULL),
('BRANCHROLE00135416', 'BRANCH00116', 'ROLE00006616', '1', '0', '2016-10-14 02:42:42', 'USR0000001716', '2016-10-13 19:45:10', NULL),
('BRANCHROLE00135516', 'BRANCH00116', 'ROLE00006516', '1', '0', '2016-10-14 02:42:48', 'USR0000001716', '2016-10-13 19:45:16', NULL),
('BRANCHROLE00135616', 'BRANCH00116', 'ROLE00006916', '1', '0', '2016-10-15 23:03:02', 'USR0000001716', '2016-10-15 16:06:55', NULL),
('BRANCHROLE00135716', 'BRANCH00116', 'ROLE00007116', '1', '0', '2016-10-15 23:03:11', 'USR0000001716', '2016-10-15 16:07:04', NULL),
('BRANCHROLE00135816', 'BRANCH00116', 'ROLE00007016', '1', '0', '2016-10-15 23:03:27', 'USR0000001716', '2016-10-15 16:07:20', NULL),
('BRANCHROLE00136116', 'BRANCH00116', 'ROLE00007216', '1', '0', '2016-10-15 23:04:15', 'USR0000001716', '2016-10-15 16:08:07', NULL),
('BRANCHROLE00136216', 'BRANCH00116', 'ROLE00007616', '1', '0', '2016-10-16 18:44:58', 'USR0000001716', '2016-10-16 11:49:28', NULL),
('BRANCHROLE00136316', 'BRANCH00116', 'ROLE00007516', '1', '0', '2016-10-16 18:45:04', 'USR0000001716', '2016-10-16 11:49:34', NULL),
('BRANCHROLE00136416', 'BRANCH00116', 'ROLE00007416', '1', '0', '2016-10-16 18:45:10', 'USR0000001716', '2016-10-16 11:49:40', NULL),
('BRANCHROLE00136516', 'BRANCH00116', 'ROLE00007316', '1', '0', '2016-10-16 18:45:15', 'USR0000001716', '2016-10-16 11:49:45', NULL),
('BRANCHROLE00136616', 'BRANCH00116', 'ROLE00007916', '1', '0', '2016-10-18 22:05:13', 'USR0000001716', '2016-10-18 15:11:21', NULL),
('BRANCHROLE00136716', 'BRANCH00116', 'ROLE00007816', '1', '0', '2016-10-18 22:05:18', 'USR0000001716', '2016-10-18 15:11:26', NULL),
('BRANCHROLE00136816', 'BRANCH00116', 'ROLE00007716', '1', '0', '2016-10-18 22:05:23', 'USR0000001716', '2016-10-18 15:11:32', NULL),
('BRANCHROLE00136916', 'BRANCH00116', 'ROLE00008016', '1', '0', '2016-10-19 23:11:06', 'USR0000001716', '2016-10-19 16:18:02', NULL),
('BRANCHROLE00137016', 'BRANCH00116', 'ROLE00008116', '1', '0', '2016-10-19 23:11:14', 'USR0000001716', '2016-10-19 16:18:10', NULL),
('BRANCHROLE00137116', 'BRANCH00116', 'ROLE00008216', '1', '0', '2016-10-19 23:11:19', 'USR0000001716', '2016-10-19 16:18:16', NULL),
('BRANCHROLE00137216', 'BRANCH00116', 'ROLE00008716', '1', '0', '2016-10-27 22:15:51', 'USR0000001716', '2016-10-27 15:15:51', NULL),
('BRANCHROLE00137316', 'BRANCH00116', 'ROLE00008616', '1', '0', '2016-10-27 22:15:57', 'USR0000001716', '2016-10-27 15:15:57', NULL),
('BRANCHROLE00137416', 'BRANCH00116', 'ROLE00008516', '1', '0', '2016-10-27 22:16:02', 'USR0000001716', '2016-10-27 15:16:02', NULL),
('BRANCHROLE00137516', 'BRANCH00116', 'ROLE00008416', '1', '0', '2016-10-27 22:16:09', 'USR0000001716', '2016-10-27 15:16:09', NULL),
('BRANCHROLE00137616', 'BRANCH00116', 'ROLE00008316', '1', '0', '2016-10-27 22:16:15', 'USR0000001716', '2016-10-27 15:16:15', NULL),
('BRANCHROLE00137716', 'BRANCH00116', 'ROLE00009116', '1', '0', '2016-10-29 00:01:51', 'USR0000001716', '2016-10-28 17:01:51', NULL),
('BRANCHROLE00137816', 'BRANCH00116', 'ROLE00009016', '1', '0', '2016-10-29 00:01:56', 'USR0000001716', '2016-10-28 17:01:56', NULL),
('BRANCHROLE00137916', 'BRANCH00116', 'ROLE00008916', '1', '0', '2016-10-29 00:02:02', 'USR0000001716', '2016-10-28 17:02:02', NULL),
('BRANCHROLE00138116', 'BRANCH00116', 'ROLE00008816', '1', '0', '2016-10-29 00:02:11', 'USR0000001716', '2016-10-28 17:02:11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sys_tm_corporate`
--

CREATE TABLE `sys_tm_corporate` (
  `corporate_id` varchar(10) NOT NULL COMMENT 'CORP + SEQ (001) + yy',
  `_name` varchar(45) NOT NULL,
  `_address` varchar(250) DEFAULT NULL,
  `_phone` varchar(45) DEFAULT NULL,
  `_logo_file_name` varchar(200) DEFAULT NULL,
  `_logo_enc_name` varchar(150) DEFAULT NULL,
  `_logo_url` varchar(200) DEFAULT NULL,
  `_active` enum('0','1') NOT NULL DEFAULT '0',
  `_delete` enum('0','1') NOT NULL DEFAULT '0',
  `create_date` datetime NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sys_tm_corporate`
--

INSERT INTO `sys_tm_corporate` (`corporate_id`, `_name`, `_address`, `_phone`, `_logo_file_name`, `_logo_enc_name`, `_logo_url`, `_active`, `_delete`, `create_date`, `last_update`) VALUES
('CORP00116', 'CORPORATE ADMIN', 'MENARA ANUGRAH', '02187888', 'user.png', 'bb4eae5f0dd10fbcb877b3cda38a0035.png', 'http://localhost/MyrRecuitmen/public_assets/uploads/bb4eae5f0dd10fbcb877b3cda38a0035.png', '1', '0', '2016-09-19 16:50:34', '2016-09-26 09:19:08'),
('CORP002016', 'CORPORATE', 'Corporate', '08123123123', 'user.png', 'ce5a8c41a58ad841306c7c915d491fd2.png', 'http://localhost/MyrRecuitmen/public_assets/uploads/ce5a8c41a58ad841306c7c915d491fd2.png', '0', '1', '2016-09-18 16:42:47', '2016-09-18 02:55:33');

-- --------------------------------------------------------

--
-- Table structure for table `sys_tm_role`
--

CREATE TABLE `sys_tm_role` (
  `role_id` varchar(30) NOT NULL,
  `_name` varchar(45) NOT NULL,
  `_desc` varchar(200) DEFAULT NULL,
  `_icon_real_name` varchar(250) DEFAULT NULL,
  `_icon_enc_name` varchar(80) DEFAULT NULL,
  `_icon_url` varchar(250) DEFAULT NULL,
  `_active` enum('0','1') NOT NULL DEFAULT '0',
  `_delete` enum('0','1') NOT NULL DEFAULT '0',
  `create_date` datetime NOT NULL,
  `create_by` varchar(25) DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_update_by` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sys_tm_role`
--

INSERT INTO `sys_tm_role` (`role_id`, `_name`, `_desc`, `_icon_real_name`, `_icon_enc_name`, `_icon_url`, `_active`, `_delete`, `create_date`, `create_by`, `last_update`, `last_update_by`) VALUES
('ROLE00001516', 'Menu Role ', 'Menu Role', '', '', '', '1', '0', '2016-09-19 11:53:37', 'USR0000001716', '2016-09-19 01:09:44', 'USR0000001716'),
('ROLE00001616', 'Menu Branch', 'Branch Management', '', '', '', '1', '0', '2016-09-19 11:54:43', 'USR0000001716', '2016-09-19 01:09:41', NULL),
('ROLE00001716', 'Menu User', 'Management User', '', '', '', '1', '0', '2016-09-19 11:55:11', 'USR0000001716', '2016-09-18 21:55:11', NULL),
('ROLE00001816', 'Add Branch Role ', 'Add Branch Role ', '', '', '', '1', '0', '2016-09-19 11:55:58', 'USR0000001716', '2016-09-18 21:55:58', NULL),
('ROLE00001916', 'Add Branch', 'Add Branch', '', '', '', '1', '0', '2016-09-19 11:56:25', 'USR0000001716', '2016-09-18 21:56:25', NULL),
('ROLE00002016', 'Edit Branch', 'Edit Branch', '', '', '', '1', '0', '2016-09-19 11:56:36', 'USR0000001716', '2016-09-18 21:56:36', NULL),
('ROLE00002116', 'Add Role', 'Add Role', '', '', '', '1', '0', '2016-09-19 11:57:47', 'USR0000001716', '2016-09-18 21:57:47', NULL),
('ROLE00002216', 'Edit Role', 'Edit Role', '', '', '', '1', '0', '2016-09-19 11:57:57', 'USR0000001716', '2016-09-18 21:57:57', NULL),
('ROLE00002316', 'Menu User', 'Management User', '', '', '', '1', '0', '2016-09-19 11:58:16', 'USR0000001716', '2016-09-18 21:58:16', NULL),
('ROLE00002416', 'Add User Access', 'Add User Access', '', '', '', '1', '0', '2016-09-19 11:58:48', 'USR0000001716', '2016-09-18 21:58:48', NULL),
('ROLE00002516', 'Edit User Access', 'Edit User Access', '', '', '', '1', '0', '2016-09-19 11:58:58', 'USR0000001716', '2016-09-18 21:58:58', NULL),
('ROLE00002616', 'List Branch', 'List Branch', '', '', '', '1', '0', '2016-09-19 12:09:45', 'USR0000001716', '2016-09-18 22:09:45', NULL),
('ROLE00002716', 'List Branch Role ', 'List Branch Role ', '', '', '', '1', '0', '2016-09-19 12:13:16', 'USR0000001716', '2016-09-18 22:13:16', NULL),
('ROLE00002816', 'List User', 'List User', '', '', '', '1', '0', '2016-09-19 13:19:27', 'USR0000001716', '2016-09-18 23:19:27', NULL),
('ROLE00002916', 'List Access', 'List Access', '', '', '', '1', '0', '2016-09-19 13:19:36', 'USR0000001716', '2016-09-18 23:19:36', NULL),
('ROLE00003016', 'Edit Branch Role', 'Edit Branch Role', '', '', '', '1', '0', '2016-09-19 15:20:24', 'USR0000001716', '2016-09-19 01:20:24', NULL),
('ROLE00003116', 'Add User', 'Add User', '', '', '', '1', '0', '2016-09-19 16:01:12', 'USR0000001716', '2016-09-19 02:01:12', NULL),
('ROLE00003216', 'Edit User', 'Edit User', '', '', '', '1', '0', '2016-09-19 16:01:24', 'USR0000001716', '2016-09-19 02:01:24', NULL),
('ROLE00003316', 'Menu Corporate', 'Menu Corporate', '', '', '', '1', '0', '2016-09-19 16:42:25', 'USR0000001716', '2016-09-19 02:42:25', NULL),
('ROLE00003416', 'List Corporate', 'List Corporate', '', '', '', '1', '0', '2016-09-19 16:42:38', 'USR0000001716', '2016-09-19 02:42:38', NULL),
('ROLE00003516', 'Add Corporate', 'Add Corporate', '', '', '', '1', '0', '2016-09-19 16:42:48', 'USR0000001716', '2016-09-19 02:42:48', NULL),
('ROLE00003616', 'Edit Corporate', 'Edit Corporate', '', '', '', '1', '0', '2016-09-19 16:42:58', 'USR0000001716', '2016-09-19 02:42:58', NULL),
('ROLE00003716', 'Menu Soal', 'Menu Soal', '', '', '', '1', '0', '2016-09-26 18:50:41', 'USR0000001716', '2016-09-26 11:53:50', NULL),
('ROLE00003816', 'List Soal', 'List Soal', '', '', '', '1', '0', '2016-09-26 18:50:52', 'USR0000001716', '2016-09-26 11:54:01', NULL),
('ROLE00003916', 'Edit Soal', 'Edit Soal', '', '', '', '1', '0', '2016-09-26 18:51:04', 'USR0000001716', '2016-09-26 11:54:13', NULL),
('ROLE00004016', 'Edit Client', 'Edit Client', '', '', '', '1', '0', '2016-09-20 18:17:29', 'USR0000001716', '2016-09-19 21:17:29', NULL),
('ROLE00004116', 'Menu Lowongan', 'Menu Lowongan', '', '', '', '1', '0', '2016-09-21 19:38:39', 'USR0000001716', '2016-09-20 22:38:39', NULL),
('ROLE00004216', 'List Lowongan', 'List Lowongan', '', '', '', '1', '0', '2016-09-21 19:38:56', 'USR0000001716', '2016-09-20 22:38:56', NULL),
('ROLE00004316', 'Add Lowongan', 'Add Lowongan', '', '', '', '1', '0', '2016-09-21 19:39:04', 'USR0000001716', '2016-09-20 22:39:04', NULL),
('ROLE00004416', 'Edit Lowongan', 'Edit Lowongan', '', '', '', '1', '0', '2016-09-21 19:39:16', 'USR0000001716', '2016-09-20 22:39:16', NULL),
('ROLE00004516', 'Add Soal', 'Add Soal', '', '', '', '1', '0', '2016-09-26 18:56:33', 'USR0000001716', '2016-09-26 11:59:42', NULL),
('ROLE00004716', 'Menu Pekerjaan', 'Menu Pekerjaan', '', '', '', '1', '0', '2016-09-27 10:34:32', 'USR0000001716', '2016-09-27 03:37:43', NULL),
('ROLE00004816', 'List Pekerjaan', 'List Pekerjaan', '', '', '', '1', '0', '2016-09-27 10:34:42', 'USR0000001716', '2016-09-27 03:37:53', NULL),
('ROLE00004916', 'Add Pekerjaan', 'Add Pekerjaan', '', '', '', '1', '0', '2016-09-27 10:34:56', 'USR0000001716', '2016-09-27 03:38:07', NULL),
('ROLE00005016', 'Edit Pekerjaan', 'Edit Pekerjaan', '', '', '', '1', '0', '2016-09-27 10:35:18', 'USR0000001716', '2016-09-27 03:38:29', NULL),
('ROLE00005116', 'List Pekerjaan Branch', 'List Pekerjaan Branch', '', '', '', '1', '0', '2016-09-27 10:35:33', 'USR0000001716', '2016-09-27 03:38:44', NULL),
('ROLE00005216', 'Add Pekerjaan Branch', 'Add Pekerjaan Branch', '', '', '', '1', '0', '2016-09-27 10:35:41', 'USR0000001716', '2016-09-27 03:38:52', NULL),
('ROLE00005316', 'Edit Pekerjaan Branch', 'Edit Pekerjaan Branch', '', '', '', '1', '0', '2016-09-27 10:35:50', 'USR0000001716', '2016-09-27 03:39:01', NULL),
('ROLE00005416', 'List Client', 'List Client', '', '', '', '1', '0', '2016-09-28 10:15:35', 'USR0000001716', '2016-09-28 03:18:49', NULL),
('ROLE00005516', 'Menu Client', 'Menu Client', '', '', '', '1', '0', '2016-09-28 10:15:49', 'USR0000001716', '2016-09-28 03:19:03', NULL),
('ROLE00005616', 'Add Client', 'Add Client', '', '', '', '1', '0', '2016-09-28 10:15:57', 'USR0000001716', '2016-09-28 03:19:11', NULL),
('ROLE00005716', 'Menu Location', 'Menu Location', '', '', '', '1', '0', '2016-09-28 10:21:26', 'USR0000001716', '2016-09-28 03:24:40', NULL),
('ROLE00005816', 'List Location', 'List Location', '', '', '', '1', '0', '2016-09-28 10:21:38', 'USR0000001716', '2016-09-28 03:24:51', NULL),
('ROLE00005916', 'Add Location', 'Add Location', '', '', '', '1', '0', '2016-09-28 10:21:51', 'USR0000001716', '2016-09-28 03:25:04', NULL),
('ROLE00006016', 'Edit Location', 'Edit Location', '', '', '', '1', '0', '2016-09-28 10:22:01', 'USR0000001716', '2016-09-28 03:25:14', NULL),
('ROLE00006116', 'Menu System Management', 'Menu System Management', '', '', '', '1', '0', '2016-09-28 17:24:53', 'USR0000001716', '2016-09-28 10:28:08', NULL),
('ROLE00006216', 'Menu  User Management ', 'Menu  User Management ', '', '', '', '1', '0', '2016-09-28 17:25:14', 'USR0000001716', '2016-09-28 10:28:29', NULL),
('ROLE00006316', ' Menu Master Data Management ', ' Menu Master Data Management ', '', '', '', '1', '0', '2016-09-28 17:25:38', 'USR0000001716', '2016-09-28 10:28:52', NULL),
('ROLE00006416', 'Menu Transaction', 'Menu Transaction', '', '', '', '1', '0', '2016-09-28 17:25:58', 'USR0000001716', '2016-09-28 10:29:13', NULL),
('ROLE00006516', 'Seleksi Psikotes', 'Seleksi Psikotes', '', '', '', '1', '0', '2016-10-14 02:40:29', 'USR0000001716', '2016-10-13 19:42:57', NULL),
('ROLE00006616', 'List Seleksi Psikotes', 'List Seleksi Psikotes', '', '', '', '1', '0', '2016-10-14 02:40:53', 'USR0000001716', '2016-10-13 19:43:21', NULL),
('ROLE00006716', 'Detail Seleksi Psikotes', 'Detail Seleksi Psikotes', '', '', '', '1', '0', '2016-10-14 02:41:30', 'USR0000001716', '2016-10-13 19:43:58', NULL),
('ROLE00006816', 'TIndak Lanjut Seleksi Psikotes', 'TIndak Lanjut Seleksi Psikotes', '', '', '', '1', '0', '2016-10-14 02:41:50', 'USR0000001716', '2016-10-13 19:44:18', NULL),
('ROLE00006916', 'Menu Interview', 'Menu Interview', '', '', '', '1', '0', '2016-10-15 22:56:49', 'USR0000001716', '2016-10-15 16:00:41', NULL),
('ROLE00007016', 'List Interview', 'List Interview', '', '', '', '1', '0', '2016-10-15 22:57:02', 'USR0000001716', '2016-10-15 16:00:54', NULL),
('ROLE00007116', 'Tindak Lanjut Interview', 'Tindak Lanjut Interview', '', '', '', '1', '0', '2016-10-15 22:57:28', 'USR0000001716', '2016-10-15 16:01:21', NULL),
('ROLE00007216', 'Detail Interview', 'Detail Interview', '', '', '', '1', '0', '2016-10-15 22:58:07', 'USR0000001716', '2016-10-15 16:01:59', NULL),
('ROLE00007316', 'Menu Interview Client', 'Menu Interview Client', '', '', '', '1', '0', '2016-10-16 18:41:30', 'USR0000001716', '2016-10-16 11:46:00', NULL),
('ROLE00007416', 'List  Interview Client', 'List  Interview Client', '', '', '', '1', '0', '2016-10-16 18:41:43', 'USR0000001716', '2016-10-16 11:46:13', NULL),
('ROLE00007516', 'Detail  Interview Client', 'Detail  Interview Client', '', '', '', '1', '0', '2016-10-16 18:41:53', 'USR0000001716', '2016-10-16 11:46:24', NULL),
('ROLE00007616', 'Tindak Lanjut  Interview Client', 'Tindak Lanjut  Interview Client', '', '', '', '1', '0', '2016-10-16 18:42:12', 'USR0000001716', '2016-10-16 11:46:42', NULL),
('ROLE00007716', 'List Lowongan Promoted', 'List Lowongan Promoted', '', '', '', '1', '0', '2016-10-18 21:43:41', 'USR0000001716', '2016-10-18 14:49:49', NULL),
('ROLE00007816', 'Edit Lowongan Promoted', 'Edit Lowongan Promoted', '', '', '', '1', '0', '2016-10-18 21:43:51', 'USR0000001716', '2016-10-18 14:49:59', NULL),
('ROLE00007916', 'Menu Lowongan Promoted', 'Menu Lowongan Promoted', '', '', '', '1', '0', '2016-10-18 21:44:19', 'USR0000001716', '2016-10-18 14:50:27', NULL),
('ROLE00008016', 'Menu Laporan', 'Menu Laporan', '', '', '', '1', '0', '2016-10-19 23:09:03', 'USR0000001716', '2016-10-19 16:16:00', NULL),
('ROLE00008116', 'Laporan Pelamar Masuk', 'Laporan Pelamar Masuk', '', '', '', '1', '0', '2016-10-19 23:09:17', 'USR0000001716', '2016-10-19 16:16:13', NULL),
('ROLE00008216', 'Laporan Lowongan', 'Laporan Lowongan', '', '', '', '1', '0', '2016-10-19 23:09:26', 'USR0000001716', '2016-10-19 16:16:22', NULL),
('ROLE00008316', 'Menu Multimedia Bank', 'Menu Multimedia Bank', '', '', '', '1', '0', '2016-10-27 22:09:16', 'USR0000001716', '2016-10-27 15:09:16', NULL),
('ROLE00008416', 'List Multimedia Bank', 'List Multimedia Bank', '', '', '', '1', '0', '2016-10-27 22:09:24', 'USR0000001716', '2016-10-27 15:09:24', NULL),
('ROLE00008516', 'Edit Multimedia Bank', 'Edit Multimedia Bank', '', '', '', '1', '0', '2016-10-27 22:09:31', 'USR0000001716', '2016-10-27 15:09:31', NULL),
('ROLE00008616', 'Delete Multimedia Bank', 'Delete Multimedia Bank', '', '', '', '1', '0', '2016-10-27 22:09:39', 'USR0000001716', '2016-10-27 15:10:00', 'USR0000001716'),
('ROLE00008716', 'Add Multimedia Bank', 'Add Multimedia Bank', '', '', '', '1', '0', '2016-10-27 22:10:48', 'USR0000001716', '2016-10-27 15:10:48', NULL),
('ROLE00008816', 'Menu Home Slider', 'Menu Home Slider', '', '', '', '1', '0', '2016-10-28 23:59:56', 'USR0000001716', '2016-10-28 16:59:56', NULL),
('ROLE00008916', 'List Home Slider', 'List Home Slider', '', '', '', '1', '0', '2016-10-29 00:00:12', 'USR0000001716', '2016-10-28 17:00:12', NULL),
('ROLE00009016', 'Edit Home Slider', 'Edit Home Slider', '', '', '', '1', '0', '2016-10-29 00:00:20', 'USR0000001716', '2016-10-28 17:00:20', NULL),
('ROLE00009116', 'Kosongkan  Home Slider', 'Kosongkan  Home Slider', '', '', '', '1', '0', '2016-10-29 00:00:34', 'USR0000001716', '2016-10-28 17:00:34', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sys_type`
--

CREATE TABLE `sys_type` (
  `type_id` varchar(25) NOT NULL,
  `category_id` int(11) NOT NULL COMMENT 'fk sys_category',
  `_name` varchar(25) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `_desc` varchar(80) DEFAULT NULL,
  `_active` enum('0','1') NOT NULL DEFAULT '0',
  `_delete` enum('0','1') NOT NULL DEFAULT '0',
  `create_date` datetime NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sys_type`
--

INSERT INTO `sys_type` (`type_id`, `category_id`, `_name`, `_desc`, `_active`, `_delete`, `create_date`, `last_update`) VALUES
('ATTACHMENT01', 5, 'PORTFOLIO URL', 'TYPE ATTACHMENT - PORTFOLIO URL', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('ATTACHMENT02', 5, 'COMPANY PROFILE URL', 'TYPE ATTACHMENT - COMPANY PROFILE URL', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('ATTACHMENT03', 5, 'IMAGE', 'TYPE ATTACHMENT - IMAGE', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('ATTACHMENT04', 5, 'VIDEO', 'TYPE ATTACHMENT - VIDEO', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('ATTACHMENT05', 5, 'AUDIO', 'TYPE ATTACHMENT - AUDIO', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('ATTACHMENT06', 5, 'IMAGECOVER', 'TYPE ATTACHMENT - IMAGECOVER', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('ATTACHMENT07', 5, 'VIDEOCOVER', 'TYPE ATTACHMENT - VIDEOCOVER', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('ATTACHMENT08', 5, 'EMBED LINK', 'TYPE ATTACHMENT - EMBED LINK', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('BANK00', 19, 'TIDAK MEMILIKI REKENING', 'TYPE BANK - TIDAK MEMILIKI REKENING', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('BANK01', 19, 'BCA', 'TYPE BANK - BCA', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('BANK02', 19, 'BNI', 'TYPE BANK - BNI', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('BANK03', 19, 'BRI', 'TYPE BANK - BRI', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('BANK04', 19, 'BII', 'TYPE BANK - BII', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('BANK05', 19, 'MANDIRI', 'TYPE BANK - MANDIRI', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('BANK06', 19, 'PERMATA', 'TYPE BANK - PERMATA', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('BANK07', 19, 'CIMB', 'TYPE BANK - CIMB', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('CTGKONTRAK01', 23, 'PKWT', 'TYPE CATEGORY KONTRAK - PKWT', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('CTGKONTRAK02', 23, 'KEMITRAAN', 'TYPE CATEGORY KONTRAK - KEMITRAAN', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('CTGKONTRAK03', 23, 'EVENT', 'TYPE CATEGORY KONTRAK - EVENT', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('CTGLWGN01', 21, 'REGULER', 'TYPE CATEGORY LOWONGAN - REGULER', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('CTGLWGN02', 21, 'EVENT', 'TYPE CATEGORY LOWONGAN - EVENT', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('CTGSOAL01', 20, 'TANGGUNG JAWAB', 'TYPE CATEGORY SOAL - TANGGUNG JAWAB', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('CTGSOAL02', 20, 'INTEGRITAS & KEJUJURAN', 'TYPE CATEGORY SOAL - INTEGRITAS', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('CTGSOAL03', 20, 'INISIATIF & KREATIFITAS', 'TYPE CATEGORY SOAL - INISIATIF', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('CTGSOAL04', 20, 'TEAMWORK', 'TYPE CATEGORY SOAL - TEAMWORK', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('FAMILY01', 15, 'SUAMI', 'TYPE FAMILY - SUAMI', '1', '0', '2016-06-10 00:00:00', '2016-10-04 06:23:55'),
('FAMILY02', 15, 'ISTRI', 'TYPE FAMILY - ISTRI', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('FAMILY03', 15, 'ANAK', 'TYPE FAMILY - ANAK', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('FAMILY04', 15, 'IBU', 'TYPE FAMILY - IBU', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('FAMILY05', 15, 'AYAH', 'TYPE FAMILY - AYAH', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('GENDER01', 11, 'LAKI - LAKI', 'TYPE GENDER - LAKI', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('GENDER02', 11, 'PEREMPUAN', 'TYPE GENDER - PEREMPUAN', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('IMGRATIO01', 6, '16:9', 'TYPE IMGRATIO - 16 : 9', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('IMGRATIO02', 6, '4:3', 'TYPE IMGRATIO - 4 : 3', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('IMGRATIO03', 6, '1:1', 'TYPE IMGRATIO - 1 :1', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('INSPROVIDER00', 17, 'TIDAK MEMILIKI ASURANSI', 'TYPE INSURANCE - TIDAK MEMILIKI ASURANSI', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('INSPROVIDER01', 17, 'ALLIANZ', 'TYPE INSURANCE - ALLIANZ', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('INSPROVIDER02', 17, 'PRUDENTIAL', 'TYPE INSURANCE - PRUDENTIAL', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('KENDARAAN01', 16, 'MOBIL', 'TYPE KENDARAAN - MOBIL', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('KENDARAAN02', 16, 'MOTOR', 'TYPE KENDARAAN - MOTOR', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('KENDARAAN03', 16, 'MOBIL & MOTOR', 'TYPE KENDARAAN - MOBIL DAN MOTOR', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('KENDARAAN04', 16, 'TIDAK MEMILIKI', 'TYPE KENDARAAN - TIDAK MEMILIKI KENDARAAN', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('MULTIMEDIA01', 29, 'IMAGE', 'TYPE MULTIMEDIA - IMAGE', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('MULTIMEDIA02', 29, 'VIDEO', 'TYPE MULTIMEDIA - VIDEO', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('PENDIDIKAN01', 18, 'SMK', 'TYPE PENDIDIKAN - SMK', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('PENDIDIKAN02', 18, 'SMA', 'TYPE PENDIDIKAN - SMA', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('PENDIDIKAN03', 18, 'D1', 'TYPE PENDIDIKAN - D1', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('PENDIDIKAN04', 18, 'D2', 'TYPE PENDIDIKAN - D2', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('PENDIDIKAN05', 18, 'D3', 'TYPE PENDIDIKAN - D3', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('PENDIDIKAN06', 18, 'D4', 'TYPE PENDIDIKAN - D4', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('PENDIDIKAN07', 18, 'S1', 'TYPE PENDIDIKAN - S1', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('PENDIDIKAN08', 18, 'S2', 'TYPE PENDIDIKAN - S2', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('PROVIDER01', 9, 'FACEBOOK', 'TYPE PROVIDER - FACEBOOK', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('PROVIDER02', 9, 'TWITTER', 'TYPE PROVIDER - TWITTER', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('PROVIDER03', 9, 'G+', 'TYPE PROVIDER - GOOGLE +', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('PROVIDER04', 9, 'INSTAGRAM', 'TYPE PROVIDER - INSTAGRAM', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('PROVIDER05', 3, 'YOUTUBE', 'TYPE PROVIDER - YOUTUBE', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('PROVIDER06', 3, 'SOUNDCLOUD', 'TYPE PROVIDER - SOUNDCLOUD', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('PROVIDER07', 3, 'PINTEREST', 'TYPE PROVIDER - PINTEREST', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('RELATIONSHIP01', 14, 'MENIKAH', 'TYPE RELATIONSHIP - MENIKAH', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('RELATIONSHIP02', 14, 'BELUM MENIKAH', 'TYPE RELATIONSHIP - BELUM MENIKAH', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('RELATIONSHIP03', 14, 'BERCERAI', 'TYPE RELATIONSHIP - JANDA', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('RELIGION01', 12, 'ISLAM', 'TYPE AGAMA - ISLAM', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('RELIGION02', 12, 'KRISTEN PROTESTAN', 'TYPE AGAMA - PROTESTAN', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('RELIGION03', 12, 'KRISTEN KATOLIK', 'TYPE AGAMA - KATOLIK', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('RELIGION04', 12, 'HINDU', 'TYPE AGAMA - HINDU', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('RELIGION05', 12, 'BUDHA', 'TYPE AGAMA - BUDHA', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('RELIGION06', 12, 'KONGUCU', 'TYPE AGAMA - KONGUCU', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('SKINCOLOR01', 13, 'PUTIH', 'TYPE SKIN - PUTIH', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('SKINCOLOR02', 13, 'COKLAT', 'TYPE SKIN - COKLAT', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('STATUS01', 4, 'CREATED', 'TYPE STATUS - CREATED', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('STATUS02', 4, 'APPROVED', 'TYPE STATUS - APPROVED', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('STATUS03', 4, 'REJECTED', 'TYPE STATUS - REJECTED', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('STATUS04', 4, 'ON PROGRESS', 'TYPE STATUS - ON PROGRESS', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('STATUS05', 4, 'DONE', 'TYPE STATUS - DONE', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('STATUS06', 4, 'PASSED', 'TYPE STATUS - PASSED', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('STATUSINT00', 25, 'BELUM DI TINDAK LANJUT', 'TYPE STATUS INTERVIEW - BELUM DI TINDAK LANJUT', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('STATUSINT01', 25, 'LOLOS', 'TYPE STATUS INTERVIEW - LOLOS', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('STATUSINT02', 25, 'TIDAK LOLOS', 'TYPE STATUS INTERVIEW - TIDAK LOLOS', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('STATUSINTCL00', 26, 'BELUM DI TINDAK LANJUT', 'TYPE STATUS INTERVIEW KLIEN -  BELUM DI TINDAK LANJUT', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('STATUSINTCL01', 26, 'LOLOS', 'TYPE STATUS INTERVIEW KLIEN -  LOLOS', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('STATUSINTCL02', 26, 'TIDAK LOLOS', 'TYPE STATUS INTERVIEW KLIEN - TIDAK LOLOS', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('STATUSPSI00', 22, 'BELUM DITINDAK LANJUT', 'TYPE STATUS PSIKOTES - BELUM DITINDAK LANJUT', '1', '0', '2016-06-10 00:00:00', '2016-10-13 19:41:22'),
('STATUSPSI01', 22, 'KURANG', 'TYPE STATUS PSIKOTES - KURANG', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('STATUSPSI02', 22, 'CUKUP', 'TYPE STATUS PSIKOTES - CUKUP', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('STATUSPSI03', 22, 'BAIK', 'TYPE STATUS PSIKOTES - BAIK', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('TYPEHST01', 27, 'INSERT', 'TYPE HISTORY - INSERT DATA', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('TYPEHST02', 27, 'UPDATE', 'TYPE HISTORY - UPDATE DATA', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('TYPEHST03', 27, 'DELETE', 'TYPE HISTORY - DELETE DATA', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('TYPEHSTCRTBY01', 28, 'SYSTEM', 'TYPE HISTORY CREATE BY - SYSTEM', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('TYPEHSTCRTBY02', 28, 'PELAMAR', 'TYPE HISTORY CREATE BY - PELAMAR', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('TYPEHSTCRTBY03', 28, 'ADMIN', 'TYPE HISTORY CREATE BY - ADMIN (USER CMS)', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('TYPELOC01', 10, 'NEGARA', 'TYPE LOCATION - NEGARA', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('TYPELOC02', 10, 'PROVINSI', 'TYPE LOCATION - PROVINSI', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('TYPELOC03', 10, 'KOTA', 'TYPE LOCATION - KOTA', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('TYPESAL01', 24, 'GAJI BULANAN', 'TYPE GAJI - GAJI BULANAN', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('TYPESAL02', 24, 'GAJI HARIAN', 'TYPE GAJI - GAJI HARIAN', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('TYPESAL03', 24, 'LEMBUR HARI', 'TYPE GAJI - LEMBUR HARI', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('TYPESAL04', 24, 'LEMBUR JAM', 'TYPE GAJI - LEMBUR JAM', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('TYPESAL05', 24, 'LEMBUR KHUSUS', 'TYPE GAJI - LEMBUR KHUSUS', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('TYPESAL06', 24, 'INSENTIF', 'TYPE GAJI - INSENTIF', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('TYPESAL07', 24, 'BPJS', 'TYPE GAJI - BPJS', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('USERFE01', 7, 'CONTENT CREATOR', 'TYPE USER FRONT END - CONTENT CREATOR', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('USERFE02', 7, 'BRAND', 'TYPE USER FRONT END - BRAND', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('USRLVL01', 8, 'SYSADMIN', 'TYPE USER CMS - SYSADMIN', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('USRLVL02', 8, 'SUPERADMIN', 'TYPE USER CMS - SUPER ADMIN', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('USRLVL03', 8, 'BOD', 'TYPE USER CMS - BOD (DIREKSI)', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('USRLVL04', 8, 'GM', 'TYPE USER CMS - GM', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('USRLVL05', 8, 'MANAGER', 'TYPE USER CMS - MANAGER', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('USRLVL06', 8, 'ADMIN', 'TYPE USER CMS - ADMIN', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00'),
('USRLVL07', 8, 'PIC', 'TYPE USER CMS - PIC', '1', '0', '2016-06-10 00:00:00', '2016-06-09 17:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cms_tm_client`
--
ALTER TABLE `cms_tm_client`
  ADD PRIMARY KEY (`client_id`),
  ADD KEY `fk_cms_tm_creator_cms_tm_user1_idx` (`create_by`),
  ADD KEY `fk_cms_tm_creator_cms_tm_user2_idx` (`last_update_by`),
  ADD KEY `fk_cms_tm_client_sys_tm_branch1_idx` (`branch_id`),
  ADD KEY `cms_tm_client_active_idx` (`_active`),
  ADD KEY `cms_tm_client_delete_idx` (`_delete`);

--
-- Indexes for table `cms_tm_client_attachment`
--
ALTER TABLE `cms_tm_client_attachment`
  ADD PRIMARY KEY (`client_attachment_id`),
  ADD KEY `fk_cms_tm_creator_detail_cms_tm_creator1_idx` (`client_id`),
  ADD KEY `fk_cms_tm_creator_attachment_sys_type1_idx` (`type_id`),
  ADD KEY `cms_tm_client_attachment_delete_idx` (`_delete`);

--
-- Indexes for table `cms_tm_fe_homeslider`
--
ALTER TABLE `cms_tm_fe_homeslider`
  ADD PRIMARY KEY (`homeslider_no`),
  ADD KEY `fk_cms_tm_fe_homeslider_cms_tm_multimediabank1_idx` (`multimediabank_no`),
  ADD KEY `fk_cms_tm_fe_homeslider_cms_tm_user1_idx` (`create_by`),
  ADD KEY `fk_cms_tm_fe_homeslider_cms_tm_user2_idx` (`last_update_by`),
  ADD KEY `cms_tm_fe_homeslider_active_idx` (`_active`),
  ADD KEY `cms_tm_fe_homeslider_delete_idx` (`_delete`);

--
-- Indexes for table `cms_tm_location`
--
ALTER TABLE `cms_tm_location`
  ADD PRIMARY KEY (`location_no`),
  ADD KEY `fk_sys_tm_location_sys_type1_idx` (`type_location_id`),
  ADD KEY `fk_cms_tm_location_cms_tm_user1_idx` (`last_update_by`);

--
-- Indexes for table `cms_tm_lowongan`
--
ALTER TABLE `cms_tm_lowongan`
  ADD PRIMARY KEY (`lowongan_no`),
  ADD KEY `fk_cms_tm_lowongan_sys_tm_branch1_idx` (`branch_id`),
  ADD KEY `fk_cms_tm_lowongan_cms_tm_client1_idx` (`client_id`),
  ADD KEY `fk_cms_tm_lowongan_cms_tm_user1_idx` (`create_by`),
  ADD KEY `fk_cms_tm_lowongan_cms_tm_user2_idx` (`last_update_by`),
  ADD KEY `fk_cms_tm_lowongan_sys_type2_idx` (`type_lowongan_id`),
  ADD KEY `fk_cms_tm_lowongan_cms_tm_pekerjaan_branch1_idx` (`pekerjaan_branch_no`),
  ADD KEY `cms_tm_lowongan_active_idx` (`_active`),
  ADD KEY `cms_tm_lowongan_delete_idx` (`_delete`),
  ADD KEY `fk_cms_tm_lowongan_cms_tm_location1_idx` (`location_no`);

--
-- Indexes for table `cms_tm_lowongan_promoted`
--
ALTER TABLE `cms_tm_lowongan_promoted`
  ADD PRIMARY KEY (`lowongan_promoted_no`),
  ADD KEY `fk_cms_tm_lowongan_promoted_cms_tm_lowongan1_idx` (`lowongan_no`),
  ADD KEY `fk_cms_tm_lowongan_promoted_cms_tm_user1_idx` (`create_by`),
  ADD KEY `fk_cms_tm_lowongan_promoted_cms_tm_user2_idx` (`last_update_by`),
  ADD KEY `fk_cms_tm_lowongan_promoted_sys_tm_branch1_idx` (`branch_id`),
  ADD KEY `cms_tm_lowongan_promoted_active_idx` (`_active`),
  ADD KEY `cms_tm_lowongan_promoted_delete_idx` (`_delete`),
  ADD KEY `cms_tm_lowongan_promoted_date_from_idx` (`_date_from`) USING BTREE,
  ADD KEY `cms_tm_lowongan_promoted_date_thru_idx` (`_date_thru`) USING BTREE;

--
-- Indexes for table `cms_tm_multimediabank`
--
ALTER TABLE `cms_tm_multimediabank`
  ADD PRIMARY KEY (`multimediabank_no`),
  ADD KEY `fk_cms_tm_multimediabank_sys_type1_idx` (`multimedia_type_id`),
  ADD KEY `fk_cms_tm_multimediabank_cms_tm_user1_idx` (`create_by`),
  ADD KEY `fk_cms_tm_multimediabank_cms_tm_user2_idx` (`last_update_by`),
  ADD KEY `cms_tm_multimediabank_delete_idx` (`_delete`);

--
-- Indexes for table `cms_tm_pekerjaan`
--
ALTER TABLE `cms_tm_pekerjaan`
  ADD PRIMARY KEY (`pekerjaan_id`),
  ADD KEY `cms_tm_pekerjaan_parent_pekerjaan_id_idx` (`_parent_pekerjaan_id`) USING BTREE,
  ADD KEY `cms_tm_pekerjaan_active_idx` (`_active`),
  ADD KEY `cms_tm_pekerjaan_delete_idx` (`_delete`);

--
-- Indexes for table `cms_tm_pekerjaan_branch`
--
ALTER TABLE `cms_tm_pekerjaan_branch`
  ADD PRIMARY KEY (`pekerjaan_branch_no`),
  ADD KEY `fk_cms_tm_pekerjaan_cms_tm_user2_idx` (`last_update_by`),
  ADD KEY `fk_cms_tm_pekerjaan_cms_tm_user1_idx` (`create_by`),
  ADD KEY `fk_cms_tm_pekerjaan_sys_tm_branch1_idx` (`branch_id`),
  ADD KEY `fk_cms_tm_pekerjaan_branch_cms_tm_pekerjaan1_idx` (`pekerjaan_id`),
  ADD KEY `cms_tm_pekerjaan_branch_active_idx` (`_active`),
  ADD KEY `cms_tm_pekerjaan_branch_delete_idx` (`_delete`);

--
-- Indexes for table `cms_tm_soal`
--
ALTER TABLE `cms_tm_soal`
  ADD PRIMARY KEY (`soal_id`),
  ADD KEY `fk_cms_tm_soal_sys_type1_idx` (`category_soal_id`),
  ADD KEY `fk_cms_tm_soal_cms_tm_user1_idx` (`create_by`),
  ADD KEY `fk_cms_tm_soal_cms_tm_user2_idx` (`last_update_by`),
  ADD KEY `fk_cms_tm_soal_sys_tm_branch1_idx` (`branch_id`),
  ADD KEY `cms_tm_soal_active_idx` (`_active`),
  ADD KEY `cms_tm_soal_delete_idx` (`_delete`);

--
-- Indexes for table `cms_tm_user`
--
ALTER TABLE `cms_tm_user`
  ADD PRIMARY KEY (`user_no`),
  ADD KEY `fk_cms_tm_user_sys_tm_branch1_idx` (`branch_id`),
  ADD KEY `fk_cms_tm_user_sys_type1_idx` (`user_level_id`),
  ADD KEY `cms_tm_user_active_idx` (`_active`),
  ADD KEY `cms_tm_user_delete_idx` (`_delete`);

--
-- Indexes for table `cms_tm_user_access`
--
ALTER TABLE `cms_tm_user_access`
  ADD PRIMARY KEY (`user_access_no`),
  ADD KEY `fk_cms_tm_user_access_sys_tm_branch_role1_idx` (`branch_role_id`),
  ADD KEY `fk_cms_tm_user_access_sys_type1_idx` (`user_level_id`),
  ADD KEY `cms_tm_user_access_active_idx` (`_active`),
  ADD KEY `cms_tm_user_access_delete_idx` (`_delete`);

--
-- Indexes for table `cms_tx_interview`
--
ALTER TABLE `cms_tx_interview`
  ADD PRIMARY KEY (`interview_no`),
  ADD KEY `fk_cms_tx_interview_fe_tx_psikotes1_idx` (`psikotes_no`),
  ADD KEY `fk_cms_tx_interview_fe_tm_pelamar1_idx` (`pelamar_no`),
  ADD KEY `fk_cms_tx_interview_cms_tm_user1_idx` (`create_by`),
  ADD KEY `fk_cms_tx_interview_cms_tm_user2_idx` (`last_update_by`),
  ADD KEY `fk_cms_tx_interview_sys_type1_idx` (`status_interview_id`),
  ADD KEY `fk_cms_tx_interview_sys_tm_branch1_idx` (`branch_id`),
  ADD KEY `cms_tx_interview_active_idx` (`_active`),
  ADD KEY `cms_tx_interview_delete_idx` (`_delete`);

--
-- Indexes for table `cms_tx_interview_client`
--
ALTER TABLE `cms_tx_interview_client`
  ADD PRIMARY KEY (`interview_client_no`),
  ADD KEY `fk_cms_tx_interview_client_cms_tx_interview1_idx` (`interview_no`),
  ADD KEY `fk_cms_tm_interview_client_no_sys_tm_branch1_idx` (`branch_id`),
  ADD KEY `fk_cms_tx_interview_client_no_sys_type1_idx` (`status_interview_client_id`),
  ADD KEY `fk_cms_tx_interview_client_no_cms_tm_user1_idx` (`create_by`),
  ADD KEY `fk_cms_tx_interview_client_no_cms_tm_user2_idx` (`last_update_by`),
  ADD KEY `cms_tx_interview_client_active_idx` (`_active`),
  ADD KEY `cms_tx_interview_client_delete_idx` (`_delete`);

--
-- Indexes for table `fe_tm_pelamar`
--
ALTER TABLE `fe_tm_pelamar`
  ADD PRIMARY KEY (`pelamar_no`),
  ADD KEY `fk_fe_tm_pelamar_sys_tm_branch1_idx` (`branch_id`),
  ADD KEY `fe_tm_pelamar_active_idx` (`_active`),
  ADD KEY `fe_tm_pelamar_delete_idx` (`_delete`),
  ADD KEY `fe_tm_pelamar_email_idx` (`_email`) USING BTREE;

--
-- Indexes for table `fe_tm_pelamar_family_info`
--
ALTER TABLE `fe_tm_pelamar_family_info`
  ADD PRIMARY KEY (`pelamar_family_info_no`),
  ADD KEY `fk_fe_pelamar_family_fe_pelamar1_idx` (`pelamar_no`),
  ADD KEY `fk_fe_pelamar_family_sys_type1_idx` (`family_type_id`),
  ADD KEY `fe_tm_pelamar_family_info_delete_idx` (`_delete`),
  ADD KEY `fk_fe_tm_pelamar_family_info_cms_tm_user1_idx` (`admin_last_update_by`),
  ADD KEY `fe_tm_pelamar_family_info_idx` (`_delete`);

--
-- Indexes for table `fe_tm_pelamar_family_info_history`
--
ALTER TABLE `fe_tm_pelamar_family_info_history`
  ADD PRIMARY KEY (`pelamar_family_info_history_no`),
  ADD KEY `fk_fe_tm_pelamar_family_info_history_fe_tm_pelamar_family_i_idx` (`pelamar_family_info_no`),
  ADD KEY `fk_fe_tm_pelamar_family_info_history_sys_type1_idx` (`type_history_id`),
  ADD KEY `fk_fe_tm_pelamar_family_info_history_sys_type2_idx` (`create_by_source`),
  ADD KEY `fk_fe_tm_pelamar_family_info_history_fe_tm_pelamar1_idx` (`create_by_pelamar_no`),
  ADD KEY `fk_fe_tm_pelamar_family_info_history_cms_tm_user1_idx` (`create_by_user_no`);

--
-- Indexes for table `fe_tm_pelamar_personal_info`
--
ALTER TABLE `fe_tm_pelamar_personal_info`
  ADD PRIMARY KEY (`pelamar_personal_info_no`),
  ADD KEY `fk_fe_pelamar_sys_tm_location1_idx` (`place_birth`),
  ADD KEY `fk_fe_pelamar_sys_type1_idx` (`religion_id`),
  ADD KEY `fk_fe_pelamar_sys_type2_idx` (`skin_color_id`),
  ADD KEY `fk_fe_pelamar_basic_info_fe_pelamar1_idx` (`pelamar_no`),
  ADD KEY `fk_fe_pelamar_basic_info_sys_type1_idx` (`relationship_id`),
  ADD KEY `fk_fe_pelamar_personal_info_sys_type1_idx` (`owned_kendaraan_id`),
  ADD KEY `fk_fe_pelamar_personal_info_sys_type2_idx` (`insurance_id`),
  ADD KEY `fk_fe_pelamar_personal_info_sys_type3_idx` (`pendidikan_id`),
  ADD KEY `fk_fe_pelamar_personal_info_sys_type4_idx` (`bank_id`),
  ADD KEY `fe_tm_pelamar_personal_info_gender_idx` (`_gender`),
  ADD KEY `fk_fe_tm_pelamar_personal_info_cms_tm_user1_idx` (`admin_last_update_by`),
  ADD KEY `fe_tm_pelamar_personal_info_fullname_idx` (`_fullname`),
  ADD KEY `fe_tm_pelamar_personal_info_height_idx` (`_height`),
  ADD KEY `fe_tm_pelamar_personal_info_weight_idx` (`_weight`),
  ADD KEY `fe_tm_pelamar_personal_info_total_children_idx` (`_total_children`),
  ADD KEY `fk_fe_tm_pelamar_personal_info_cms_tm_location1_idx` (`address_ktp_kota`),
  ADD KEY `fk_fe_tm_pelamar_personal_info_cms_tm_location2_idx` (`address_sekarang_kota`);

--
-- Indexes for table `fe_tm_pelamar_personal_info_history`
--
ALTER TABLE `fe_tm_pelamar_personal_info_history`
  ADD PRIMARY KEY (`pelamar_personal_info_history_no`),
  ADD KEY `fk_fe_tm_pelamar_personal_info_history_fe_tm_pelamar_person_idx` (`pelamar_personal_info_no`),
  ADD KEY `fk_fe_tm_pelamar_personal_info_history_sys_type1_idx` (`type_history_id`),
  ADD KEY `fk_fe_tm_pelamar_personal_info_history_sys_type2_idx` (`create_by_source`),
  ADD KEY `fk_fe_tm_pelamar_personal_info_history_fe_tm_pelamar1_idx` (`create_by_pelamar_no`),
  ADD KEY `fk_fe_tm_pelamar_personal_info_history_cms_tm_user1_idx` (`create_by_user_no`);

--
-- Indexes for table `fe_tx_apply_lowongan`
--
ALTER TABLE `fe_tx_apply_lowongan`
  ADD PRIMARY KEY (`apply_lowongan_no`),
  ADD KEY `fk_fe_tx_apply_lowongan_cms_tm_lowongan1_idx` (`lowongan_no`),
  ADD KEY `fk_fe_tx_apply_lowongan_fe_tm_pelamar1_idx` (`pelamar_no`),
  ADD KEY `fk_fe_tx_apply_lowongan_sys_tm_branch1_idx` (`branch_id`),
  ADD KEY `fk_fe_tx_apply_lowongan_sys_type1_idx` (`status_apply_lowongan_id`),
  ADD KEY `fk_fe_tx_apply_lowongan_cms_tm_user1_idx` (`admin_last_update_by`),
  ADD KEY `fe_tx_apply_lowongan_active_idx` (`_active`),
  ADD KEY `fe_tx_apply_lowongan_delete_idx` (`_delete`),
  ADD KEY `fe_tx_apply_lowongan_cancel_idx` (`_cancel`);

--
-- Indexes for table `fe_tx_apply_lowongan_history`
--
ALTER TABLE `fe_tx_apply_lowongan_history`
  ADD PRIMARY KEY (`apply_lowongan_history_no`),
  ADD KEY `fk_fe_tx_apply_lowongan_history_fe_tx_apply_lowongan1_idx` (`apply_lowongan_no`),
  ADD KEY `fk_fe_tx_apply_lowongan_history_sys_type1_idx` (`status_apply_lowongan_id`),
  ADD KEY `fk_fe_tx_apply_lowongan_history_sys_type2_idx` (`create_by_source`),
  ADD KEY `fe_tx_apply_lowongan_history_active_idx` (`_active`),
  ADD KEY `fe_tx_apply_lowongan_history_delete_idx` (`_delete`),
  ADD KEY `fk_fe_tx_apply_lowongan_history_fe_tm_pelamar1_idx` (`create_by_pelamar_no`);

--
-- Indexes for table `fe_tx_psikotes`
--
ALTER TABLE `fe_tx_psikotes`
  ADD PRIMARY KEY (`psikotes_no`),
  ADD KEY `fk_fe_tx_psikotes_fe_tx_apply_lowongan1_idx` (`apply_lowongan_no`),
  ADD KEY `fk_fe_tx_psikotes_sys_type1_idx` (`status_psikotes_id`),
  ADD KEY `fk_fe_tx_psikotes_cms_tm_user1_idx` (`follow_up_by`),
  ADD KEY `fk_fe_tx_psikotes_cms_tm_user2_idx` (`last_update_by`),
  ADD KEY `fk_fe_tx_psikotes_sys_tm_branch1_idx` (`branch_id`),
  ADD KEY `fe_tx_psikotes_score_idx` (`_score`) USING BTREE,
  ADD KEY `fe_tx_psikotes_active_idx` (`_active`),
  ADD KEY `fe_tx_psikotes_delete_idx` (`_delete`),
  ADD KEY `fe_tx_psikotes_jumlah_soal_idx` (`_jumlah_soal`) USING BTREE;

--
-- Indexes for table `fe_tx_psikotes_detail`
--
ALTER TABLE `fe_tx_psikotes_detail`
  ADD PRIMARY KEY (`psikotes_detail_no`),
  ADD KEY `fk_fe_tx_piskotes_detail_fe_tx_psikotes1_idx` (`psikotes_no`),
  ADD KEY `fk_fe_tx_piskotes_detail_cms_tm_soal1_idx` (`soal_id`);

--
-- Indexes for table `sequence_data`
--
ALTER TABLE `sequence_data`
  ADD PRIMARY KEY (`sequence_name`);

--
-- Indexes for table `sys_category`
--
ALTER TABLE `sys_category`
  ADD PRIMARY KEY (`category_no`);

--
-- Indexes for table `sys_tm_branch`
--
ALTER TABLE `sys_tm_branch`
  ADD PRIMARY KEY (`branch_id`),
  ADD KEY `fk_sys_tm_branch_sys_tm_corporate1_idx` (`corporate_id`),
  ADD KEY `sys_tm_branch_active_idx` (`_active`),
  ADD KEY `sys_tm_branch_delete_idx` (`_delete`);

--
-- Indexes for table `sys_tm_branch_role`
--
ALTER TABLE `sys_tm_branch_role`
  ADD PRIMARY KEY (`branch_role_id`),
  ADD KEY `fk_sys_tm_branch_role_sys_tm_branch1_idx` (`branch_id`),
  ADD KEY `fk_sys_tm_branch_role_sys_tm_role1_idx` (`role_id`),
  ADD KEY `sys_tm_branch_role_active_idx` (`_active`),
  ADD KEY `sys_tm_branch_role_delete_idx` (`_delete`);

--
-- Indexes for table `sys_tm_corporate`
--
ALTER TABLE `sys_tm_corporate`
  ADD PRIMARY KEY (`corporate_id`),
  ADD KEY `sys_tm_corporate_active_idx` (`_active`),
  ADD KEY `sys_tm_corporate_delete_idx` (`_delete`);

--
-- Indexes for table `sys_tm_role`
--
ALTER TABLE `sys_tm_role`
  ADD PRIMARY KEY (`role_id`),
  ADD KEY `fk_sys_tm_role_cms_tm_user1_idx` (`create_by`),
  ADD KEY `fk_sys_tm_role_cms_tm_user2_idx` (`last_update_by`),
  ADD KEY `sys_tm_role_active_idx` (`_active`),
  ADD KEY `sys_tm_role_delete_idx` (`_delete`);

--
-- Indexes for table `sys_type`
--
ALTER TABLE `sys_type`
  ADD PRIMARY KEY (`type_id`),
  ADD KEY `fk_sys_type_sys_category_idx` (`category_id`),
  ADD KEY `sys_type_active_idx` (`_active`),
  ADD KEY `sys_type_delete_idx` (`_delete`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cms_tm_fe_homeslider`
--
ALTER TABLE `cms_tm_fe_homeslider`
  MODIFY `homeslider_no` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `cms_tm_client`
--
ALTER TABLE `cms_tm_client`
  ADD CONSTRAINT `fk_cms_tm_client_sys_tm_branch1` FOREIGN KEY (`branch_id`) REFERENCES `sys_tm_branch` (`branch_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cms_tm_creator_cms_tm_user1` FOREIGN KEY (`create_by`) REFERENCES `cms_tm_user` (`user_no`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cms_tm_creator_cms_tm_user2` FOREIGN KEY (`last_update_by`) REFERENCES `cms_tm_user` (`user_no`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `cms_tm_client_attachment`
--
ALTER TABLE `cms_tm_client_attachment`
  ADD CONSTRAINT `fk_cms_tm_creator_attachment_sys_type1` FOREIGN KEY (`type_id`) REFERENCES `sys_type` (`type_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cms_tm_creator_detail_cms_tm_creator1` FOREIGN KEY (`client_id`) REFERENCES `cms_tm_client` (`client_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `cms_tm_fe_homeslider`
--
ALTER TABLE `cms_tm_fe_homeslider`
  ADD CONSTRAINT `fk_cms_tm_fe_homeslider_cms_tm_multimediabank1` FOREIGN KEY (`multimediabank_no`) REFERENCES `cms_tm_multimediabank` (`multimediabank_no`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cms_tm_fe_homeslider_cms_tm_user1` FOREIGN KEY (`create_by`) REFERENCES `cms_tm_user` (`user_no`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cms_tm_fe_homeslider_cms_tm_user2` FOREIGN KEY (`last_update_by`) REFERENCES `cms_tm_user` (`user_no`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `cms_tm_location`
--
ALTER TABLE `cms_tm_location`
  ADD CONSTRAINT `fk_cms_tm_location_cms_tm_user1` FOREIGN KEY (`last_update_by`) REFERENCES `cms_tm_user` (`user_no`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_sys_tm_location_sys_type1` FOREIGN KEY (`type_location_id`) REFERENCES `sys_type` (`type_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `cms_tm_lowongan`
--
ALTER TABLE `cms_tm_lowongan`
  ADD CONSTRAINT `fk_cms_tm_lowongan_cms_tm_client1` FOREIGN KEY (`client_id`) REFERENCES `cms_tm_client` (`client_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cms_tm_lowongan_cms_tm_location1` FOREIGN KEY (`location_no`) REFERENCES `cms_tm_location` (`location_no`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cms_tm_lowongan_cms_tm_pekerjaan_branch1` FOREIGN KEY (`pekerjaan_branch_no`) REFERENCES `cms_tm_pekerjaan_branch` (`pekerjaan_branch_no`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cms_tm_lowongan_cms_tm_user1` FOREIGN KEY (`create_by`) REFERENCES `cms_tm_user` (`user_no`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cms_tm_lowongan_cms_tm_user2` FOREIGN KEY (`last_update_by`) REFERENCES `cms_tm_user` (`user_no`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cms_tm_lowongan_sys_tm_branch1` FOREIGN KEY (`branch_id`) REFERENCES `sys_tm_branch` (`branch_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cms_tm_lowongan_sys_type2` FOREIGN KEY (`type_lowongan_id`) REFERENCES `sys_type` (`type_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `cms_tm_lowongan_promoted`
--
ALTER TABLE `cms_tm_lowongan_promoted`
  ADD CONSTRAINT `fk_cms_tm_lowongan_promoted_cms_tm_lowongan1` FOREIGN KEY (`lowongan_no`) REFERENCES `cms_tm_lowongan` (`lowongan_no`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cms_tm_lowongan_promoted_cms_tm_user1` FOREIGN KEY (`create_by`) REFERENCES `cms_tm_user` (`user_no`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cms_tm_lowongan_promoted_cms_tm_user2` FOREIGN KEY (`last_update_by`) REFERENCES `cms_tm_user` (`user_no`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cms_tm_lowongan_promoted_sys_tm_branch1` FOREIGN KEY (`branch_id`) REFERENCES `sys_tm_branch` (`branch_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `cms_tm_multimediabank`
--
ALTER TABLE `cms_tm_multimediabank`
  ADD CONSTRAINT `fk_cms_tm_multimediabank_cms_tm_user1` FOREIGN KEY (`create_by`) REFERENCES `cms_tm_user` (`user_no`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cms_tm_multimediabank_cms_tm_user2` FOREIGN KEY (`last_update_by`) REFERENCES `cms_tm_user` (`user_no`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cms_tm_multimediabank_sys_type1` FOREIGN KEY (`multimedia_type_id`) REFERENCES `sys_type` (`type_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `cms_tm_pekerjaan_branch`
--
ALTER TABLE `cms_tm_pekerjaan_branch`
  ADD CONSTRAINT `fk_cms_tm_pekerjaan_branch_cms_tm_pekerjaan1` FOREIGN KEY (`pekerjaan_id`) REFERENCES `cms_tm_pekerjaan` (`pekerjaan_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cms_tm_pekerjaan_cms_tm_user1` FOREIGN KEY (`create_by`) REFERENCES `cms_tm_user` (`user_no`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cms_tm_pekerjaan_cms_tm_user2` FOREIGN KEY (`last_update_by`) REFERENCES `cms_tm_user` (`user_no`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cms_tm_pekerjaan_sys_tm_branch1` FOREIGN KEY (`branch_id`) REFERENCES `sys_tm_branch` (`branch_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `cms_tm_soal`
--
ALTER TABLE `cms_tm_soal`
  ADD CONSTRAINT `fk_cms_tm_soal_cms_tm_user1` FOREIGN KEY (`create_by`) REFERENCES `cms_tm_user` (`user_no`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cms_tm_soal_cms_tm_user2` FOREIGN KEY (`last_update_by`) REFERENCES `cms_tm_user` (`user_no`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cms_tm_soal_sys_tm_branch1` FOREIGN KEY (`branch_id`) REFERENCES `sys_tm_branch` (`branch_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cms_tm_soal_sys_type1` FOREIGN KEY (`category_soal_id`) REFERENCES `sys_type` (`type_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `cms_tm_user`
--
ALTER TABLE `cms_tm_user`
  ADD CONSTRAINT `fk_cms_tm_user_sys_tm_branch1` FOREIGN KEY (`branch_id`) REFERENCES `sys_tm_branch` (`branch_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cms_tm_user_sys_type1` FOREIGN KEY (`user_level_id`) REFERENCES `sys_type` (`type_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `cms_tm_user_access`
--
ALTER TABLE `cms_tm_user_access`
  ADD CONSTRAINT `fk_cms_tm_user_access_sys_tm_branch_role1` FOREIGN KEY (`branch_role_id`) REFERENCES `sys_tm_branch_role` (`branch_role_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cms_tm_user_access_sys_type1` FOREIGN KEY (`user_level_id`) REFERENCES `sys_type` (`type_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `cms_tx_interview`
--
ALTER TABLE `cms_tx_interview`
  ADD CONSTRAINT `fk_cms_tx_interview_cms_tm_user1` FOREIGN KEY (`create_by`) REFERENCES `cms_tm_user` (`user_no`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cms_tx_interview_cms_tm_user2` FOREIGN KEY (`last_update_by`) REFERENCES `cms_tm_user` (`user_no`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cms_tx_interview_fe_tm_pelamar1` FOREIGN KEY (`pelamar_no`) REFERENCES `fe_tm_pelamar` (`pelamar_no`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cms_tx_interview_fe_tx_psikotes1` FOREIGN KEY (`psikotes_no`) REFERENCES `fe_tx_psikotes` (`psikotes_no`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cms_tx_interview_sys_tm_branch1` FOREIGN KEY (`branch_id`) REFERENCES `sys_tm_branch` (`branch_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cms_tx_interview_sys_type1` FOREIGN KEY (`status_interview_id`) REFERENCES `sys_type` (`type_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `cms_tx_interview_client`
--
ALTER TABLE `cms_tx_interview_client`
  ADD CONSTRAINT `fk_cms_tm_interview_client_no_sys_tm_branch1` FOREIGN KEY (`branch_id`) REFERENCES `sys_tm_branch` (`branch_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cms_tx_interview_client_cms_tx_interview1` FOREIGN KEY (`interview_no`) REFERENCES `cms_tx_interview` (`interview_no`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cms_tx_interview_client_no_cms_tm_user1` FOREIGN KEY (`create_by`) REFERENCES `cms_tm_user` (`user_no`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cms_tx_interview_client_no_cms_tm_user2` FOREIGN KEY (`last_update_by`) REFERENCES `cms_tm_user` (`user_no`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cms_tx_interview_client_no_sys_type1` FOREIGN KEY (`status_interview_client_id`) REFERENCES `sys_type` (`type_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `fe_tm_pelamar`
--
ALTER TABLE `fe_tm_pelamar`
  ADD CONSTRAINT `fk_fe_tm_pelamar_sys_tm_branch1` FOREIGN KEY (`branch_id`) REFERENCES `sys_tm_branch` (`branch_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `fe_tm_pelamar_family_info`
--
ALTER TABLE `fe_tm_pelamar_family_info`
  ADD CONSTRAINT `fk_fe_pelamar_family_fe_pelamar1` FOREIGN KEY (`pelamar_no`) REFERENCES `fe_tm_pelamar` (`pelamar_no`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_fe_pelamar_family_sys_type1` FOREIGN KEY (`family_type_id`) REFERENCES `sys_type` (`type_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_fe_tm_pelamar_family_info_cms_tm_user1` FOREIGN KEY (`admin_last_update_by`) REFERENCES `cms_tm_user` (`user_no`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `fe_tm_pelamar_family_info_history`
--
ALTER TABLE `fe_tm_pelamar_family_info_history`
  ADD CONSTRAINT `fk_fe_tm_pelamar_family_info_history_cms_tm_user1` FOREIGN KEY (`create_by_user_no`) REFERENCES `cms_tm_user` (`user_no`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_fe_tm_pelamar_family_info_history_fe_tm_pelamar1` FOREIGN KEY (`create_by_pelamar_no`) REFERENCES `fe_tm_pelamar` (`pelamar_no`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_fe_tm_pelamar_family_info_history_fe_tm_pelamar_family_info1` FOREIGN KEY (`pelamar_family_info_no`) REFERENCES `fe_tm_pelamar_family_info` (`pelamar_family_info_no`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_fe_tm_pelamar_family_info_history_sys_type1` FOREIGN KEY (`type_history_id`) REFERENCES `sys_type` (`type_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_fe_tm_pelamar_family_info_history_sys_type2` FOREIGN KEY (`create_by_source`) REFERENCES `sys_type` (`type_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `fe_tm_pelamar_personal_info`
--
ALTER TABLE `fe_tm_pelamar_personal_info`
  ADD CONSTRAINT `fk_fe_pelamar_basic_info_fe_pelamar1` FOREIGN KEY (`pelamar_no`) REFERENCES `fe_tm_pelamar` (`pelamar_no`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_fe_pelamar_basic_info_sys_type1` FOREIGN KEY (`relationship_id`) REFERENCES `sys_type` (`type_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_fe_pelamar_personal_info_sys_type1` FOREIGN KEY (`owned_kendaraan_id`) REFERENCES `sys_type` (`type_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_fe_pelamar_personal_info_sys_type2` FOREIGN KEY (`insurance_id`) REFERENCES `sys_type` (`type_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_fe_pelamar_personal_info_sys_type3` FOREIGN KEY (`pendidikan_id`) REFERENCES `sys_type` (`type_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_fe_pelamar_personal_info_sys_type4` FOREIGN KEY (`bank_id`) REFERENCES `sys_type` (`type_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_fe_pelamar_sys_tm_location1` FOREIGN KEY (`place_birth`) REFERENCES `cms_tm_location` (`location_no`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_fe_pelamar_sys_type1` FOREIGN KEY (`religion_id`) REFERENCES `sys_type` (`type_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_fe_pelamar_sys_type2` FOREIGN KEY (`skin_color_id`) REFERENCES `sys_type` (`type_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_fe_tm_pelamar_personal_info_cms_tm_location1` FOREIGN KEY (`address_ktp_kota`) REFERENCES `cms_tm_location` (`location_no`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_fe_tm_pelamar_personal_info_cms_tm_location2` FOREIGN KEY (`address_sekarang_kota`) REFERENCES `cms_tm_location` (`location_no`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_fe_tm_pelamar_personal_info_cms_tm_user1` FOREIGN KEY (`admin_last_update_by`) REFERENCES `cms_tm_user` (`user_no`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `fe_tm_pelamar_personal_info_history`
--
ALTER TABLE `fe_tm_pelamar_personal_info_history`
  ADD CONSTRAINT `fk_fe_tm_pelamar_personal_info_history_cms_tm_user1` FOREIGN KEY (`create_by_user_no`) REFERENCES `cms_tm_user` (`user_no`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_fe_tm_pelamar_personal_info_history_fe_tm_pelamar1` FOREIGN KEY (`create_by_pelamar_no`) REFERENCES `fe_tm_pelamar` (`pelamar_no`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_fe_tm_pelamar_personal_info_history_fe_tm_pelamar_personal1` FOREIGN KEY (`pelamar_personal_info_no`) REFERENCES `fe_tm_pelamar_personal_info` (`pelamar_personal_info_no`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_fe_tm_pelamar_personal_info_history_sys_type1` FOREIGN KEY (`type_history_id`) REFERENCES `sys_type` (`type_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_fe_tm_pelamar_personal_info_history_sys_type2` FOREIGN KEY (`create_by_source`) REFERENCES `sys_type` (`type_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `fe_tx_apply_lowongan`
--
ALTER TABLE `fe_tx_apply_lowongan`
  ADD CONSTRAINT `fk_fe_tx_apply_lowongan_cms_tm_lowongan1` FOREIGN KEY (`lowongan_no`) REFERENCES `cms_tm_lowongan` (`lowongan_no`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_fe_tx_apply_lowongan_cms_tm_user1` FOREIGN KEY (`admin_last_update_by`) REFERENCES `cms_tm_user` (`user_no`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_fe_tx_apply_lowongan_fe_tm_pelamar1` FOREIGN KEY (`pelamar_no`) REFERENCES `fe_tm_pelamar` (`pelamar_no`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_fe_tx_apply_lowongan_sys_tm_branch1` FOREIGN KEY (`branch_id`) REFERENCES `sys_tm_branch` (`branch_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_fe_tx_apply_lowongan_sys_type1` FOREIGN KEY (`status_apply_lowongan_id`) REFERENCES `sys_type` (`type_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `fe_tx_apply_lowongan_history`
--
ALTER TABLE `fe_tx_apply_lowongan_history`
  ADD CONSTRAINT `fk_fe_tx_apply_lowongan_history_fe_tm_pelamar1` FOREIGN KEY (`create_by_pelamar_no`) REFERENCES `fe_tm_pelamar` (`pelamar_no`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_fe_tx_apply_lowongan_history_fe_tx_apply_lowongan1` FOREIGN KEY (`apply_lowongan_no`) REFERENCES `fe_tx_apply_lowongan` (`apply_lowongan_no`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_fe_tx_apply_lowongan_history_sys_type1` FOREIGN KEY (`status_apply_lowongan_id`) REFERENCES `sys_type` (`type_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_fe_tx_apply_lowongan_history_sys_type2` FOREIGN KEY (`create_by_source`) REFERENCES `sys_type` (`type_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `fe_tx_psikotes`
--
ALTER TABLE `fe_tx_psikotes`
  ADD CONSTRAINT `fk_fe_tx_psikotes_cms_tm_user1` FOREIGN KEY (`follow_up_by`) REFERENCES `cms_tm_user` (`user_no`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_fe_tx_psikotes_cms_tm_user2` FOREIGN KEY (`last_update_by`) REFERENCES `cms_tm_user` (`user_no`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_fe_tx_psikotes_fe_tx_apply_lowongan1` FOREIGN KEY (`apply_lowongan_no`) REFERENCES `fe_tx_apply_lowongan` (`apply_lowongan_no`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_fe_tx_psikotes_sys_tm_branch1` FOREIGN KEY (`branch_id`) REFERENCES `sys_tm_branch` (`branch_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_fe_tx_psikotes_sys_type1` FOREIGN KEY (`status_psikotes_id`) REFERENCES `sys_type` (`type_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `fe_tx_psikotes_detail`
--
ALTER TABLE `fe_tx_psikotes_detail`
  ADD CONSTRAINT `fk_fe_tx_piskotes_detail_cms_tm_soal1` FOREIGN KEY (`soal_id`) REFERENCES `cms_tm_soal` (`soal_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_fe_tx_piskotes_detail_fe_tx_psikotes1` FOREIGN KEY (`psikotes_no`) REFERENCES `fe_tx_psikotes` (`psikotes_no`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `sys_tm_branch`
--
ALTER TABLE `sys_tm_branch`
  ADD CONSTRAINT `fk_sys_tm_branch_sys_tm_corporate1` FOREIGN KEY (`corporate_id`) REFERENCES `sys_tm_corporate` (`corporate_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `sys_tm_branch_role`
--
ALTER TABLE `sys_tm_branch_role`
  ADD CONSTRAINT `fk_sys_tm_branch_role_sys_tm_branch1` FOREIGN KEY (`branch_id`) REFERENCES `sys_tm_branch` (`branch_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_sys_tm_branch_role_sys_tm_role1` FOREIGN KEY (`role_id`) REFERENCES `sys_tm_role` (`role_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `sys_tm_role`
--
ALTER TABLE `sys_tm_role`
  ADD CONSTRAINT `fk_sys_tm_role_cms_tm_user1` FOREIGN KEY (`create_by`) REFERENCES `cms_tm_user` (`user_no`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_sys_tm_role_cms_tm_user2` FOREIGN KEY (`last_update_by`) REFERENCES `cms_tm_user` (`user_no`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `sys_type`
--
ALTER TABLE `sys_type`
  ADD CONSTRAINT `fk_sys_type_sys_category` FOREIGN KEY (`category_id`) REFERENCES `sys_category` (`category_no`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
