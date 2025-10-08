<?php

//error_reporting(1);
//session_save_path("./session");
error_reporting  (E_ALL);
ini_set('max_input_vars', 3000);

set_time_limit(0);
session_start();
if ($_GET){foreach($_GET as $key => $value){$$key = $value;}}
if ($_POST){foreach($_POST as $key => $value){$$key = $value;}}
if ($_SESSION){foreach($_SESSION as $key => $value){$$key = $value;}}
if ($_COOKIE){foreach($_COOKIE as $key => $value){$$key = $value;}}

include ("config.inc.php");

include($Dir->Library."/library.inc.php");
include($Dir->Pages."/tampilan/menu.inc.php");
$Show = $Func->gFile("{$Main->Tema}/base.inc.php");


$Tema=$Main->Tema;
/// templates Administrator


$Pg=isset($Pg)?$Pg:"";
$Pr=isset($Pr)?$Pr:"";

if ($Pg=="Login")
{	
	$Func->Login();
}
global $sUserId,$sUserHak,$sUserNm;
$sUserHak=!empty($sUserHak)?$sUserHak:"";
$sUserId=!empty($sUserId)?$sUserId:"";
$sUserNm=!empty($sUserNm)?$sUserNm:"";
$sUserHak = isset($_SESSION['sUserHak'])?$_SESSION['sUserHak']:$sUserHak;
$sUserId = isset($_SESSION['sUserId'])?$_SESSION['sUserId']:$sUserId;
$sUserNm = isset($_SESSION['sUserNm'])?$_SESSION['sUserNm']:$sUserNm;

if ($Pg=="LogOut")
{
	_mysql_query("UPDATE `__t_users` SET `id_session`='' WHERE `username`='$sUserId' LIMIT 1;");
	$sUserId="";$sUserNm="";$sUserHak="";$uLogin="";$pLogin="";
	session_destroy();
	$Pg="";$Pr="";$Main->Page="";$Main->Part="";
	header("Location:index.php");
}

if (!$Func->CekLogin())
{$HomeAdmin="";}
else
{
	if (empty($Pg))
	{$Pg = "Login";}
	$Main->Page=$Pg;
	$Main->Part=$Pr;
}

switch ($Main->Page)
{
		case "Login":						
			include($Dir->Pages."/loginexcel.inc.php");		
		break;
		case "":default:
			if(empty($Main->Part))
			{
				include"{$Dir->Pages}/public/depan.inc.php";
			}
		break;
}



$Show = str_replace("<!--desaintema-->","$Tema",$Show);
$Show = str_replace("<!--Judul-->","$Main->Judul",$Show);
$Show = str_replace("<!--JavaScript-->","$Main->Script",$Show);
$Show = str_replace("<!--JavaScript2-->","$Main->Script2",$Show);
$Show = str_replace("<!--Css-->","$Main->Css",$Show);
$Show = str_replace("<!--Atas-->","$Main->Atas",$Show);
$Show = str_replace("<!--Menu-->","$Main->Menu",$Show);
$Show = str_replace("<!--MenuAtas-->","$Main->MenuAtas",$Show);
$Show = str_replace("<!--MenuAdmin-->","$Main->MenuAdmin",$Show);
$Show = str_replace("<!--Isi-->","$Main->Isi",$Show);
$Show = str_replace("<!--Cetak-->","$Main->Excel",$Show);
$Show = str_replace("<!--Bawah-->","$Main->Bawah",$Show);
$Show = str_replace("<a","<span",$Show);
$Show = str_replace("<A","<span",$Show);
$Show = str_replace("</A> ","</span>",$Show);
$Show = str_replace("</a> ","</span>",$Show);
$Show = str_replace("class='tablesorter' id='tablesorter'","border='1'",$Show);
$Show = str_replace("	", "", $Show);

$Show = str_replace("	", "", $Show);
echo $Show;

?>