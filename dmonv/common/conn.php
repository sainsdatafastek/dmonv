<?php
	//// Koneksi Jab
	$HostJab             = "localhost";
	$UserJab             = "root";
	$PwdJab              = "";
	$DbsJab              = "dbmonitoring";
	$JConn = @mysql_connect($HostJab,$UserJab,$PwdJab);if ($JConn){$dbJab=mysql_select_db($DbsJab,$JConn);}
?>