<?php
	if($Action == 'Simpan')
	{
		$iduser= $Func->antiinjection(@$_POST['iduser']);

		$scrt="*&^~53r37";
		$cekSandi= $Func->antiinjection(sha1($scrt.@$_POST['Sandi'].$scrt));
		$cekSandi=substr($Func->hex(addslashes($cekSandi),82), 0, 31);
		
		$cekSandi1= $Func->antiinjection(sha1($scrt.@$_POST['Sandi1'].$scrt));
		$cekSandi1=substr($Func->hex(addslashes($cekSandi1),82), 0, 31);		
		$Qry = _mysql_query("select * from __t_users where username='{$_SESSION['sUserId']}' and password='$cekSandi' limit 1");
		if(_mysql_num_rows($Qry)>0)
		{

			if (!empty($Sandi1))
			{
				$QSimpan=_mysql_query("update __t_users set password = '$cekSandi1', username='$iduser' where username='{$_SESSION['sUserId']}'");
				if($QSimpan)
				{$Pesan = $Func->ViewPesan("Password dan Username Baru Telah di Set");}
				else
				{$Pesan = $Func->ViewPesan("Password dan Username Baru Gagal di Set");}
			}
			else
			{
				$Pesan = $Func->ViewPesan("Password Baru Masih Kosong...", 0);
			}
		}
		else
		{
			$Pesan = $Func->ViewPesan("Maaf, password lama tidak sama...!",0);		
		}
	}

	$Func->ambilData("select `iduser`, `nama_lengkap` from __t_users where username='{$_SESSION['sUserId']}' limit 1;");
	$iduser=!empty($iduser)?$iduser:$sUserId;
	$Main->Isi ="
		<center>$Pesan<br>
  		<form name=Fm id=Fm method=post action='$PHP_SELF?Pg=$Pg&Pr=$Pr'>
		<table width=100% border=0 cellpadding=2 cellspacing=0 align=center>
			<tr><td width=200>Password Lama</td><td width=1%>:</td><td>".$Func->txtField('Sandi',"",'30','30','password')."</td></tr>
			<tr><td>Password Baru</td><td width=1%>:</td><td>".$Func->txtField('Sandi1','','30','30','password')."</td></tr>
			<tr><td>Password Lagi</td><td width=1%>:</td><td>".$Func->txtField('Sandi2','','30','30','password')."</td></tr>
			<tr><td>Username Baru</td><td width=1%>:</td><td>".$Func->txtField('iduser',$iduser,'30','30','text')."</td></tr>

			<tr><td colspan=3 align=right>
				<input type='button' value='Simpan' onclick=\"javascript:CekPassword();\" alt='Simpan' class=button>
			</td></tr>
			".$Func->txtField('Pg',$Pg,'50','50','hidden')."
			".$Func->txtField('Pr',$Pr,'50','50','hidden')."
			".$Func->txtField('Action',$Action,'50','50','hidden')."
		</table>
		<script>
			function CekPassword()
			{
				if (Fm.Sandi1.value != Fm.Sandi2.value){
					alert('Password Baru Tidak Sama...');
					return false;
				}
				else{
					Fm.Action.value='Simpan';
					Fm.submit();
					return true;
				}
			}
		</script>
	";
	$Main->Isi=$Func->Kotak("Ganti Password",$Main->Isi,'100%');
?>