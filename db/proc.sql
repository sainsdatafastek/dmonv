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

-- Dumping structure for procedure dbmonitoring.proc
DROP PROCEDURE IF EXISTS `proc`;
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc`()
BEGIN
truncate database_update;
insert into database_update select a.TABLE_SCHEMA, count(*) as jmltable , max(a.UPDATE_TIME) as update_data, max(a.CREATE_TIME) as pembaharuan  from information_schema.`TABLES` as a where a.TABLE_SCHEMA not in ('webauth','phpmyadmin','performance_schema','cdcol','mysql') group by a.TABLE_SCHEMA;
END//
DELIMITER ;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
