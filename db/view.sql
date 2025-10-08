
-- Dumping structure for view dbmonitoring.aaa
DROP VIEW IF EXISTS `aaa`;
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `aaa`;


-- Dumping structure for view dbmonitoring.__v_menu
DROP VIEW IF EXISTS `__v_menu`;
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `__v_menu`;


-- Dumping structure for view dbmonitoring.__v_menu_aktif
DROP VIEW IF EXISTS `__v_menu_aktif`;
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `__v_menu_aktif`;


CREATE VIEW `aaa` AS select `a`.`TABLE_SCHEMA` AS `TABLE_SCHEMA`,count(0) AS `jmltable`,max(`a`.`UPDATE_TIME`) AS `update_data`,max(`a`.`CREATE_TIME`) AS `pembaharuan` from `information_schema`.`TABLES` `a` where (`a`.`TABLE_SCHEMA` not in ('webauth','phpmyadmin','performance_schema','cdcol','mysql')) group by `a`.`TABLE_SCHEMA` ;
CREATE VIEW `__v_menu` AS select `a`.`username` AS `username`,`b`.`id_sub` AS `id_sub`,`b`.`nama_sub` AS `nama_sub`,`b`.`link_sub` AS `link_sub`,`b`.`id_main` AS `id_main`,`b`.`aktif` AS `aktif`,`b`.`icon` AS `icon`,`b`.`keterangan` AS `keterangan`,`c`.`nama_menu` AS `nama_menu`,`c`.`link` AS `link`,`c`.`membermenu` AS `membermenu` from ((`__t_hak_akses` `a` join `__t_submenu` `b` on((`a`.`id_sub` = `b`.`id_sub`))) join `__t_mainmenu` `c` on((`b`.`id_main` = `c`.`id_main`))) ;
CREATE VIEW `__v_menu_aktif` AS select `a`.`id_main` AS `id_main`,`a`.`nama_menu` AS `nama_menu`,`a`.`link` AS `link`,`a`.`membermenu` AS `membermenu`,`b`.`id_sub` AS `id_sub`,`b`.`nama_sub` AS `nama_sub`,`b`.`link_sub` AS `link_sub`,`b`.`aktif` AS `aktifsub`,`b`.`icon` AS `icon`,`b`.`keterangan` AS `keterangan` from (`__t_mainmenu` `a` join `__t_submenu` `b` on((`a`.`id_main` = `b`.`id_main`))) where ((`a`.`membermenu` = 'Y') and (`b`.`aktif` = 'Y')) ;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
