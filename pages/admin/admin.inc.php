<?PHP
@session_start();
$Func->ambilData("select folder from __t_templates where judul='baru'");
$Main->Tema= $folder;
$Show = $Func->gFile("{$Main->Tema}/base.html");
/*
include "timeout.php";

function cek_login(){
	$timeout=$_SESSION['timeout'];
	
	if(time()<$timeout){
		timer();		
		return true;
	}else{
		unset($_SESSION['timeout']);
		return false;
	}
}

if($_SESSION['login']==1){	
	if(!$Func->CekLogin()){
		$_SESSION['login'] = 0;
	}
}
*/
if($_SESSION['login']==0){
  header('location:logout.php');
}
else
{
	$Main->Isi = "";
	$Main->Atas="<br>";	
	if (empty($_SESSION['sUserHak'])){header("Location:index.php");}
	include($Dir->Pages."/tampilan/menuadmin.inc.php");	
	switch ($Main->Part)
	{				
		case "gpwd":
			include("{$Dir->ModAdmin}gpwd.inc.php");
		break;
		case "":default:
			$url="index.php?Pg=$Pg&Pr=".trim($Main->Part);
			$QLinkAdm=_mysql_query("select link_sub, nama_sub from __v_menu where username='$sUserId' and link_sub='$url'");
			$Isi=_mysql_fetch_array($QLinkAdm);
			$Main->MenuHeader=@$Isi['nama_sub'];
			if(_mysql_num_rows($QLinkAdm)>0)
			{				
				if (file_exists("{$Dir->ModAdmin}{$Main->Part}.inc.php")) {
				   include("{$Dir->ModAdmin}{$Main->Part}.inc.php");
				   if(empty($Mode)){$Main->Isi = $Func->Kotak($Main->MenuHeader,$Main->Isi,'100%');}
					else
					{$ListMode="";$i=1;include "{$Dir->ModAdmin}{$Pr}/{$Mode}.inc.php";}

				} else {
					$Main->Isi = $Func->Kotak("Perhatian","<font size=5 color=red><br>Maaf, Halaman ini belum tersedia.<br>Silahkan hubungi administrator anda</font>",'100%');
				}
			}
			else
			{

				$Main->Isi="
					
				Selamat datang di halaman member . Silahkan klik menu pilihan yang berada di bagian atas untuk mengelola data. <br>
				".$Func->TglAll(date('Y-m-d')).", ".date('h:i:s')." Wib";
				$Main->Isi = $Func->Kotak("Halaman Utama",$Main->Isi,'85%');	
			}
				
		break;
	}	
}
?>