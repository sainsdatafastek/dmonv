<?php
	class MyVariable{
		/////// variabel content
			var $Base;var $Isi;var $Atas;var $Bawah;var $Page; var $Part;var $URL;var $Judul;var $Script; var $Tema;
			var $Tema2;var $Tema3; var $Cetak; var $BgRow; var $BgRow2;var $BgPilih;var $MenuHeader;
		/////// variabel content Menu
			var $Menu;var $MenuAdmin;var $MenuAtas;
		/////// variabel directory
			var $Common;var $Css;var $Images;var $Library;var $Templates;var $ModAdmin;var $ModPas;var $ModUser;
		/////// variabel basis data
			var $Host;var $Pwd;var $Dbs;
		////// variabel waktu
			var $NamaHari;var $NamaBulan;var $AngkaBulan;var $JmlHari;

			var $Script2;

			var $Root; var $Pages; var $Template; var $Files; var $Session; var $Admin; var $Kop; var $NamaBulan2D; var $Abjad; var $TotHari;
	}
	$Main= new MyVariable;$Dir= new MyVariable;$SQL= new MyVariable;$Ref= new MyVariable;
	$Dir->Root		= "./";
	$Dir->Pages		= $Dir->Root."pages";
	$Dir->Template  = $Dir->Root."templates";
	$Dir->Common	= $Dir->Root."common";
	$Dir->Css		= $Dir->Root."css";
	$Dir->Library	= $Dir->Root."library";
	$Dir->Images	= $Dir->Root."images";
	$Dir->Files		= $Dir->Root."files";
	$Dir->Session	= $Dir->Root."session";
	$Dir->Admin		= $Dir->Root.$Dir->Pages."admin";
	$Dir->ModAdmin	= $Dir->Pages."/admin/mod_admin/mod_";
	
	
	$Main->BgRow	 ="#ECEDFF";
	$Main->BgRow2	 ="#FFF4DF";
	$Main->BgPilih	 = "#BFC6FF";

	$Main->Menu		  = "Menu";
	$Main->MenuAdmin  = "";
	$Main->MenuAtas   = "";
	$Main->Atas       = "Atas";
	$Main->Kop       = "Atas";
	$Main->Isi	     = "Isi";
	$Main->Bawah     = "Copy Right @ 20013";
	$Main->Cetak	 ="";
	$Pg="";
	$Pr="";
	$Main->Page      = isset($_GET['Pg'])?$_GET['Pg']:"";
	$Main->Part      = isset($_GET['Pr'])?$_GET['Pr']:"";

	$Waktu = date("Y-m-d");
	$WaktuJam = date("h:i:s");
	$TANGGAL_AKSES = date("Y-m-d h:i:s");

	$Show = "";
	$SLASHDOMAIN           = "";
	
	$Ref->NamaHari   = array("Minggu","Senin","Selasa","Rabu","Kamis","Jum'at","Sabtu");
	$Ref->NamaBulan  = array("Januari","Pebruari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","Nopember","Desember");
	$Ref->NamaBulan2D  = array(array("01","Januari"),array("02","Pebruari"),array("03","Maret"),array("04","April"),array("05","Mei"),array("06","Juni"),array("07","Juli"),array("08","Agustus"),array("09","September"),array("10","Oktober"),array("11","Nopember"),array("12","Desember"));
	$Ref->AngkaBulan  = array("01","02","03","04","05","06","07","08","09","10","11","12");
	$Ref->Abjad=array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","AA","AB","AC","AD","AE","AF","AG","AH","AI","AJ","AK","AL","AM","AN","AO","AP","AQ","AR","AS","AT","AU","AV","AW","AX","AY","AZ","BA","BB","BC","BD","BE","BF","BG","BH","BI","BJ","BK","BL","BM","BN","BO","BP","BQ","BR","BS","BT","BU","BV","BW","BX","BY","BZ","CA","CB","CC","CD","CE","CF","CG","CH","CI","CJ","CK","CL","CM","CN","CO","CP","CQ","CR","CS","CT","CU","CV","CW","CX","CY","CZ","DA","DB","DC","DD","DE","DF","DG","DH","DI","DJ","DK","DL","DM","DN","DO","DP","DQ","DR","DS","DT","DU","DV","DW","DX","DY","DZ","EA","EB","EC","ED","EE","EF","EG","EH","EI","EJ","EK","EL","EM","EN","EO","EP","EQ","ER","ES","ET","EU","EV","EW","EX","EY","EZ","FA","FB","FC","FD","FE","FF","FG","FH","FI","FJ","FK","FL","FM","FN","FO","FP","FQ","FR","FS","FT","FU","FV","FW","FX","FY","FZ","GA","GB","GC","GD","GE","GF","GG","GH","GI","GJ","GK","GL","GM","GN","GO","GP","GQ","GR","GS","GT","GU","GV","GW","GX","GY","GZ","HA","HB","HC","HD","HE","HF","HG","HH","HI","HJ","HK","HL","HM","HN","HO","HP","HQ","HR","HS","HT","HU","HV","HW","HX","HY","HZ","IA","IB","IC","ID","IE","IF","IG","IH","II","IJ","IK","IL","IM","IN","IO","IP","IQ","IR","IS","IT","IU","IV","IW","IX","IY","IZ","JA","JB","JC","JD","JE","JF","JG","JH","JI","JJ","JK","JL","JM","JN","JO","JP","JQ","JR","JS","JT","JU","JV","JW","JX","JY","JZ","KA","KB","KC","KD","KE","KF","KG","KH","KI","KJ","KK","KL","KM","KN","KO","KP","KQ","KR","KS","KT","KU","KV","KW","KX","KY","KZ","LA","LB","LC","LD","LE","LF","LG","LH","LI","LJ","LK","LL","LM","LN","LO","LP","LQ","LR","LS","LT","LU","LV","LW","LX","LY","LZ","MA","MB","MC","MD","ME","MF","MG","MH","MI","MJ","MK","ML","MM","MN","MO","MP","MQ","MR","MS","MT","MU","MV","MW","MX","MY","MZ","NA","NB","NC","ND","NE","NF","NG","NH","NI","NJ","NK","NL","NM","NN","NO","NP","NQ","NR","NS","NT","NU","NV","NW","NX","NY","NZ","OA","OB","OC","OD","OE","OF","OG","OH","OI","OJ","OK","OL","OM","ON","OO","OP","OQ","OR","OS","OT","OU","OV","OW","OX","OY","OZ","PA","PB","PC","PD","PE","PF","PG","PH","PI","PJ","PK","PL","PM","PN","PO","PP","PQ","PR","PS","PT","PU","PV","PW","PX","PY","PZ","QA","QB","QC","QD","QE","QF","QG","QH","QI","QJ","QK","QL","QM","QN","QO","QP","QQ","QR","QS","QT","QU","QV","QW","QX","QY","QZ","RA","RB","RC","RD","RE","RF","RG","RH","RI","RJ","RK","RL","RM","RN","RO","RP","RQ","RR","RS","RT","RU","RV","RW","RX","RY","RZ","SA","SB","SC","SD","SE","SF","SG","SH","SI","SJ","SK","SL","SM","SN","SO","SP","SQ","SR","SS","ST","SU","SV","SW","SX","SY","SZ","TA","TB","TC","TD","TE","TF","TG","TH","TI","TJ","TK","TL","TM","TN","TO","TP","TQ","TR","TS","TT","TU","TV","TW","TX","TY","TZ","UA","UB","UC","UD","UE","UF","UG","UH","UI","UJ","UK","UL","UM","UN","UO","UP","UQ","UR","US","UT","UU","UV","UW","UX","UY","UZ","VA","VB","VC","VD","VE","VF","VG","VH","VI","VJ","VK","VL","VM","VN","VO","VP","VQ","VR","VS","VT","VU","VV","VW","VX","VY","VZ","WA","WB","WC","WD","WE","WF","WG","WH","WI","WJ","WK","WL","WM","WN","WO","WP","WQ","WR","WS","WT","WU","WV","WW","WX","WY","WZ","XA","XB","XC","XD","XE","XF","XG","XH","XI","XJ","XK","XL","XM","XN","XO","XP","XQ","XR","XS","XT","XU","XV","XW","XX","XY","XZ","YA","YB","YC","YD","YE","YF","YG","YH","YI","YJ","YK","YL","YM","YN","YO","YP","YQ","YR","YS","YT","YU","YV","YW","YX","YY","YZ","ZA","ZB","ZC","ZD","ZE","ZF","ZG","ZH","ZI","ZJ","ZK","ZL","ZM","ZN","ZO","ZP","ZQ","ZR","ZS","ZT","ZU","ZV","ZW","ZX","ZY","ZZ");
	$Ref->JmlHari = array(31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
	$Ref->TotHari = array(31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
	$AYesNo=array("Y","N");

	if ($_GET){foreach($_GET as $key => $value){$$key = $value;}}
	if ($_POST){foreach($_POST as $key => $value){$$key = $value;}}
	if ($_COOKIE){foreach($_COOKIE as $key => $value){$$key = $value;}}

	$Action=!empty($Action)?$Action:"";
	$Mode=!empty($Mode)?$Mode:"";
	$ListMode=!empty($ListMode)?$ListMode:"";
	$wr=!empty($wr)?$wr:"";
	$wh=!empty($wh)?$wh:"";
	$ckata=!empty($ckata)?$ckata:"";
	$aksi=!empty($aksi)?$aksi:"";	
	$view=!empty($view)?$view:"";	
	$id=!empty($id)?$id:"";	
	$VPesan=!empty($VPesan)?$VPesan:"";	
	$Pesan=!empty($Pesan)?$Pesan:"";
	$Mode=!empty($Mode)?$Mode:"";
	$lpopup =!empty($lpopup )?$lpopup :"";
	$AddForm =!empty($AddForm)?$AddForm:"";
	$Jml=!empty($Jml)?$Jml:"";
	$Sb=!empty($Sb)?$Sb:"";
	$Content=!empty($Content)?$Content:"";
	$Aksi=!empty($Aksi)?$Aksi:"";
	$TambahId=!empty($TambahId)?$TambahId:"";
	
	$popup=!empty($popup)?$popup:"";
	$ckata=!empty($ckata)?$ckata:"";
	$pagehal=!empty($pagehal)?$pagehal:"";
	$batas = 50;
	$halaman=!empty($_GET['pagehal'])?$_GET['pagehal']:1;
	
	$BgPilih = "#BFC6FF";
	$BgRow = "#ECEDFF";
	$BgRow2 = "#FFF4DF";
?>