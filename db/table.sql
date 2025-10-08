-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.16 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Version:             9.1.0.4867
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;



-- Dumping structure for table dbmonitoring.aaaa
DROP TABLE IF EXISTS `aaaa`;
CREATE TABLE IF NOT EXISTS `aaaa` (
  `AAS` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table dbmonitoring.database_update
DROP TABLE IF EXISTS `database_update`;
CREATE TABLE IF NOT EXISTS `database_update` (
  `TABLE_SCHEMA` varchar(64) CHARACTER SET utf8 NOT NULL,
  `jmltable` bigint(21) NOT NULL,
  `update_data` datetime DEFAULT NULL,
  `update_table` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table dbmonitoring.parsing_date
DROP TABLE IF EXISTS `parsing_date`;
CREATE TABLE IF NOT EXISTS `parsing_date` (
  `waktu` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table dbmonitoring.parsing_json
DROP TABLE IF EXISTS `parsing_json`;
CREATE TABLE IF NOT EXISTS `parsing_json` (
  `idparsing` int(11) NOT NULL AUTO_INCREMENT,
  `nmurl` varchar(6535) DEFAULT NULL,
  `nmtable` varchar(50) DEFAULT NULL,
  `aktif` char(1) DEFAULT '1',
  PRIMARY KEY (`idparsing`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table dbmonitoring.parsing_json_data
DROP TABLE IF EXISTS `parsing_json_data`;
CREATE TABLE IF NOT EXISTS `parsing_json_data` (
  `nmurl` varchar(6535) DEFAULT NULL,
  `nmtable` varchar(50) DEFAULT NULL,
  `datajson` longtext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table dbmonitoring.reg_db_dwh
DROP TABLE IF EXISTS `reg_db_dwh`;
CREATE TABLE IF NOT EXISTS `reg_db_dwh` (
  `id_dbname` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `dbname` varchar(25) NOT NULL,
  `tanggal_akses` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `tanggal_insert` timestamp NULL DEFAULT NULL,
  `tanggal_update` timestamp NULL DEFAULT NULL,
  `user_create` varchar(50) DEFAULT NULL,
  `user_update` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_dbname`),
  UNIQUE KEY `dbname` (`dbname`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table dbmonitoring.reg_db_dwh_field
DROP TABLE IF EXISTS `reg_db_dwh_field`;
CREATE TABLE IF NOT EXISTS `reg_db_dwh_field` (
  `dbname` varchar(50) NOT NULL,
  `table_name` varchar(50) NOT NULL,
  `field` varchar(150) NOT NULL,
  `type` varchar(150) DEFAULT NULL,
  `length` decimal(10,2) DEFAULT NULL,
  `primary` char(1) NOT NULL DEFAULT '0',
  `urutan` int(18) NOT NULL DEFAULT '0',
  PRIMARY KEY (`dbname`,`table_name`,`field`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table dbmonitoring.reg_db_dwh_table
DROP TABLE IF EXISTS `reg_db_dwh_table`;
CREATE TABLE IF NOT EXISTS `reg_db_dwh_table` (
  `id_table` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `table_name` varchar(25) NOT NULL,
  `dbname` varchar(25) NOT NULL,
  `tanggal_akses` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `tanggal_insert` timestamp NULL DEFAULT NULL,
  `tanggal_update` timestamp NULL DEFAULT NULL,
  `user_create` varchar(50) DEFAULT NULL,
  `user_update` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_table`),
  UNIQUE KEY `table_name_dbname` (`table_name`,`dbname`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table dbmonitoring.reg_db_mart
DROP TABLE IF EXISTS `reg_db_mart`;
CREATE TABLE IF NOT EXISTS `reg_db_mart` (
  `id_dbname` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `dbname` varchar(25) NOT NULL,
  `hostname` varchar(25) DEFAULT NULL,
  `username` varchar(25) DEFAULT NULL,
  `password` varchar(25) DEFAULT NULL,
  `tanggal_akses` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `tanggal_insert` timestamp NULL DEFAULT NULL,
  `tanggal_update` timestamp NULL DEFAULT NULL,
  `user_create` varchar(50) DEFAULT NULL,
  `user_update` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_dbname`),
  UNIQUE KEY `dbname` (`dbname`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table dbmonitoring.reg_db_mart_table
DROP TABLE IF EXISTS `reg_db_mart_table`;
CREATE TABLE IF NOT EXISTS `reg_db_mart_table` (
  `id_table` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `table_name` varchar(25) NOT NULL,
  `dbname` varchar(25) NOT NULL,
  `tanggal_akses` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `tanggal_insert` timestamp NULL DEFAULT NULL,
  `tanggal_update` timestamp NULL DEFAULT NULL,
  `user_create` varchar(50) DEFAULT NULL,
  `user_update` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_table`),
  UNIQUE KEY `table_name_dbname` (`table_name`,`dbname`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table dbmonitoring.reg_db_sumber
DROP TABLE IF EXISTS `reg_db_sumber`;
CREATE TABLE IF NOT EXISTS `reg_db_sumber` (
  `id_dbname` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `dbname` varchar(25) NOT NULL,
  `hostname` varchar(25) DEFAULT NULL,
  `username` varchar(25) DEFAULT NULL,
  `password` varchar(25) DEFAULT NULL,
  `tanggal_akses` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `tanggal_insert` timestamp NULL DEFAULT NULL,
  `tanggal_update` timestamp NULL DEFAULT NULL,
  `user_create` varchar(50) DEFAULT NULL,
  `user_update` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_dbname`),
  UNIQUE KEY `dbname` (`dbname`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table dbmonitoring.reg_db_sumber_query
DROP TABLE IF EXISTS `reg_db_sumber_query`;
CREATE TABLE IF NOT EXISTS `reg_db_sumber_query` (
  `id_query` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `query_name` varchar(50) NOT NULL,
  `query_script` text NOT NULL,
  `dbname` varchar(25) NOT NULL,
  `tanggal_akses` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `tanggal_insert` timestamp NULL DEFAULT NULL,
  `tanggal_update` timestamp NULL DEFAULT NULL,
  `user_create` varchar(50) DEFAULT NULL,
  `user_update` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_query`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table dbmonitoring.reg_maping_dwh_to_mart
DROP TABLE IF EXISTS `reg_maping_dwh_to_mart`;
CREATE TABLE IF NOT EXISTS `reg_maping_dwh_to_mart` (
  `id_maping` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_dbname_sumber` int(10) unsigned NOT NULL,
  `id_dbname_dwh` int(10) unsigned NOT NULL,
  `id_query` int(10) unsigned NOT NULL,
  `id_table` int(10) unsigned NOT NULL,
  `tanggal_akses` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `tanggal_insert` timestamp NULL DEFAULT NULL,
  `tanggal_update` timestamp NULL DEFAULT NULL,
  `user_create` varchar(50) DEFAULT NULL,
  `user_update` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_maping`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table dbmonitoring.reg_maping_dwh_to_mart_field
DROP TABLE IF EXISTS `reg_maping_dwh_to_mart_field`;
CREATE TABLE IF NOT EXISTS `reg_maping_dwh_to_mart_field` (
  `id_maping_fields` int(11) NOT NULL AUTO_INCREMENT,
  `id_maping` int(10) unsigned NOT NULL,
  `field_sumber` varchar(50) NOT NULL,
  `field_dwh` varchar(50) NOT NULL,
  `param` enum('Y','N') NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id_maping_fields`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table dbmonitoring.reg_maping_sumber_to_dwh
DROP TABLE IF EXISTS `reg_maping_sumber_to_dwh`;
CREATE TABLE IF NOT EXISTS `reg_maping_sumber_to_dwh` (
  `id_maping` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_dbname_sumber` int(10) unsigned NOT NULL,
  `id_dbname_dwh` int(10) unsigned NOT NULL,
  `id_query` int(10) unsigned NOT NULL,
  `id_table` int(10) unsigned NOT NULL,
  `tanggal_akses` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `tanggal_insert` timestamp NULL DEFAULT NULL,
  `tanggal_update` timestamp NULL DEFAULT NULL,
  `user_create` varchar(50) DEFAULT NULL,
  `user_update` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_maping`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table dbmonitoring.reg_maping_sumber_to_dwh_field
DROP TABLE IF EXISTS `reg_maping_sumber_to_dwh_field`;
CREATE TABLE IF NOT EXISTS `reg_maping_sumber_to_dwh_field` (
  `id_maping_fields` int(11) NOT NULL AUTO_INCREMENT,
  `id_maping` int(10) unsigned NOT NULL,
  `field_sumber` varchar(50) NOT NULL,
  `field_dwh` varchar(50) NOT NULL,
  `param` enum('Y','N') NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id_maping_fields`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table dbmonitoring._tipe_data
DROP TABLE IF EXISTS `_tipe_data`;
CREATE TABLE IF NOT EXISTS `_tipe_data` (
  `kategori` varchar(50) DEFAULT NULL,
  `name_tipe` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table dbmonitoring.__t_hak_akses
DROP TABLE IF EXISTS `__t_hak_akses`;
CREATE TABLE IF NOT EXISTS `__t_hak_akses` (
  `username` varchar(50) NOT NULL,
  `id_sub` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table dbmonitoring.__t_mainmenu
DROP TABLE IF EXISTS `__t_mainmenu`;
CREATE TABLE IF NOT EXISTS `__t_mainmenu` (
  `id_main` int(5) NOT NULL AUTO_INCREMENT,
  `nama_menu` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `link` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `aktif` enum('Y','N') NOT NULL DEFAULT 'Y',
  `membermenu` enum('Y','N') NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id_main`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table dbmonitoring.__t_pengguna
DROP TABLE IF EXISTS `__t_pengguna`;
CREATE TABLE IF NOT EXISTS `__t_pengguna` (
  `ID_PENGGUNA` varchar(25) NOT NULL,
  `PASSWD` varchar(254) NOT NULL,
  `NAMA` varchar(25) NOT NULL,
  `BAGIAN` varchar(25) NOT NULL,
  PRIMARY KEY (`ID_PENGGUNA`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table dbmonitoring.__t_submenu
DROP TABLE IF EXISTS `__t_submenu`;
CREATE TABLE IF NOT EXISTS `__t_submenu` (
  `id_sub` int(5) NOT NULL AUTO_INCREMENT,
  `nama_sub` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `link_sub` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT '#',
  `id_main` int(5) NOT NULL,
  `aktif` enum('Y','N') NOT NULL DEFAULT 'Y',
  `icon` varchar(15) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  PRIMARY KEY (`id_sub`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table dbmonitoring.__t_templates
DROP TABLE IF EXISTS `__t_templates`;
CREATE TABLE IF NOT EXISTS `__t_templates` (
  `id_templates` int(5) NOT NULL AUTO_INCREMENT,
  `judul` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `pembuat` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `folder` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `aktif` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id_templates`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- Data exporting was unselected.


-- Dumping structure for table dbmonitoring.__t_users
DROP TABLE IF EXISTS `__t_users`;
CREATE TABLE IF NOT EXISTS `__t_users` (
  `username` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `iduser` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `password` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `nama_lengkap` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `no_telp` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `level` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `blokir` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'N',
  `id_session` varchar(100) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- Data exporting was unselected.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
