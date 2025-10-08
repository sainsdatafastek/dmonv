<?php
	switch($Action)
	{
		case "Simpan":
			$username=!empty($username)?$username:array();
			
			$scrt="*&^~53r37";
			$password= $Func->antiinjection(sha1($scrt."rahasia".$scrt));
			$password=substr($Func->hex(addslashes($password),82), 0, 31);			

			foreach ($username as $k=>$v) {			
				if(!empty($v))
				{				
					$Qry=_mysql_query("select * from __t_users where username='$id_username[$k]'");
					if(_mysql_num_rows($Qry)>0)
					{_mysql_query("UPDATE `__t_users` SET `username`='$v', `nama_lengkap`='$nama_lengkap[$k]', email='$email[$k]', `level`='$level[$k]', `blokir`='$blokir[$k]'  WHERE `username`='$id_username[$k]' LIMIT 1;");}	
					else
					{_mysql_query("INSERT INTO `__t_users` (`username`, `password`, `nama_lengkap`, `email`, `level`, `blokir`) VALUES ('$v', '$password', '$nama_lengkap[$k]', '$email[$k]', '$level[$k]', '$blokir[$k]');");}
				}
			}
		break;
		case "reset":
			$scrt="*&^~53r37";
			$password= $Func->antiinjection(sha1($scrt."rahasia".$scrt));
			$password=substr($Func->hex(addslashes($password),82), 0, 31);	
			_mysql_query("UPDATE `__t_users` SET `password`='$password' WHERE `username`='$id' LIMIT 1;");			
		break;
		case "hapus":
			_mysql_query("DELETE FROM `__t_users` WHERE `username`='{$_GET['id']}' LIMIT 1;");
			header("location:index.php?Pg=$Pg&Pr=$Pr");
		break;
		
	}
	$ListMode="";$wh="";
	$clevel=!empty($clevel)?$clevel:"";$cNama=!empty($cNama)?$cNama:"";	
	if(!empty($clevel)){$wh.="and level='$clevel'";}
	if(!empty($cNama)){$wh.="and nama_lengkap like '%$cNama%' or username like '%$cNama%'";}
	$PageNavi = new pageNavi;
	$batas = 40;
	$halaman=!empty($halaman)?$halaman:1;
	$halaman=!empty($_GET['pagehal'])?$_GET['pagehal']:$halaman;
	$posisi = $PageNavi->cariPosisi($batas);
	$i=$posisi+1;
	$jmldata = _mysql_num_rows(_mysql_query("select * from __t_users where level!=1 $wh"));
	$jmlhalaman = $PageNavi->jumlahHalaman($jmldata, $batas);
	$linkHalaman = $PageNavi->navHalaman($halaman, $jmlhalaman, "index.php?Pg=$Pg&Pr=$Pr&clevel=$clevel&cNama=$cNama");
	$link="<div class='light'><div class='pageNavi'>$linkHalaman</div></div>";

	$i=$posisi+1;
	$z=1;
	$Qry=_mysql_query("select `username`, `nama_lengkap`, `email`, `level`, `blokir` from __t_users where level!='' $wh ORDER BY level,nama_lengkap ASC limit $posisi,$batas");
	while($isi=_mysql_fetch_array($Qry))
	{
		if($z==1)
		{
			$Func->kosongkanData("__t_users");$check1="";$check2="";
			$ListMode="
				<tr $wr  onmouseover=\"TG(this,'#FFCC33')\" onmouseout=\"TG(this,'$wh')\">
					<td align=center>x</td>
					<td>
						".$Func->txtField("id_username[$i-1]",$username,'','','hidden')."
						".$Func->txtField("username[$i-1]",$username,'50','50','text'," style='border:0px solid white;background:white;width:100%;height:25;border:0px solid black;'")."
					</td>
					<td>
						".$Func->txtField("nama_lengkap[$i-1]",$nama_lengkap,'100','100','text'," style='border:0px solid white;background:white;width:100%;height:25;border:0px solid black;'")."
					</td>
					<td>
						".$Func->txtField("email[$i-1]",$email,'100','100','text'," style='border:0px solid white;background:white;width:100%;height:25;border:0px solid black;'")."
					</td>
					<td></td>
					<td>
						".$Func->cmb2D("level[$i-1]",$level,array(array(1,"admin"),array(2,"member")),"style='border:0px;width:100%;'")."
					</td>
					<td align=center width='100'>						
						<table>
						<tr>
							<td style='border:0px;'>".$Func->txtField("blokir[$i-1]",'Y','','','radio',$check1)."</td>
							<td style='border:0px;'>Y</td>
							<td style='border:0px;'>".$Func->txtField("blokir[$i-1]",'N','','','radio',$check2)."</td>
							<td style='border:0px;'>N</td>
						</tr>
						</table>
						
						
					</td>
					<td align=center>&nbsp;</td>
				</tr>
			";
		}
		$z++;
		$i++;
		$Func->ambilData("select `username`, `nama_lengkap`, `email`, `level`, `blokir` from __t_users where username='{$isi['username']}' limit 1");
		if(!empty($username))
		{
			$check1="";$check2="";
			if(trim($blokir)=="Y"){$check1="checked";}else{$check2="checked";}
			$ListMode.="
				<tr $wr  onmouseover=\"TG(this,'#FFCC33')\" onmouseout=\"TG(this,'$wh')\" >
					<td align=center>".($z-1)."</td>
					<td>
						".$Func->txtField("id_username[$i-1]",$username,'','','hidden')."
						".$Func->txtField("username[$i-1]",$username,'50','50','text'," style='border:0px solid white;background:white;width:100%;height:25;border:0px solid black;'")."
					</td>
					<td>
						".$Func->txtField("nama_lengkap[$i-1]",$nama_lengkap,'100','100','text'," style='border:0px solid white;background:white;width:100%;height:25;border:0px solid black;'")."
					</td>
					<td>
						".$Func->txtField("email[$i-1]",$email,'100','100','text'," style='border:0px solid white;background:white;width:100%;height:25;border:0px solid black;'")."
					</td>
					<td>
						[<a href=\"index.php?Pg=$Pg&Pr=$Pr&id=$username&Action=reset\">Reset</a>]&nbsp;[<a href=\"javascript:showPopUp('500','200');ambilData('#faceboxisi', 'index.php?Pg=$Pg&Pr=$Pr&id=$username&Mode=Detail')\">Hak&nbsp;Akses</a>]
					</td>
					<td>
						".$Func->cmb2D("level[$i-1]",$level,array(array(1,"admin"),array(2,"Member")),"style='border:0px;width:100%;'")."
					</td>
					<td align=center>						
						<table>
						<tr>
							<td style='border:0px;'>".$Func->txtField("blokir[$i-1]",'Y','','','radio',$check1)."</td>
							<td style='border:0px;'>Y</td>
							<td style='border:0px;'>".$Func->txtField("blokir[$i-1]",'N','','','radio',$check2)."</td>
							<td style='border:0px;'>N</td>
						</tr>
						</table>
					</td>
					<td align=center>
						<a href=\"index.php?Pg=$Pg&Pr=$Pr&Action=hapus&id=$username\"><img src='{$Dir->Images}/icon/hapus.gif' border=0></a>
					</td>
				</tr>
			";			
		}$username="";
		
	}
	if($jmldata==0)
	{$i=1;
		$Func->kosongkanData("__t_users");$check1="";$check2="";
		$ListMode="
			<tr $wr  onmouseover=\"TG(this,'#FFCC33')\" onmouseout=\"TG(this,'$wh')\">
				<td align=center>x</td>
				<td>
					".$Func->txtField("id_username[$i-1]",$username,'','','hidden')."
					".$Func->txtField("username[$i-1]",$username,'50','50','text'," style='border:0px solid white;background:white;width:100%;height:25;border:0px solid black;'")."
				</td>
				<td>
					".$Func->txtField("nama_lengkap[$i-1]",$nama_lengkap,'100','100','text'," style='border:0px solid white;background:white;width:100%;height:25;border:0px solid black;'")."
				</td>
				<td>
					".$Func->txtField("email[$i-1]",$email,'100','100','text'," style='border:0px solid white;background:white;width:100%;height:25;border:0px solid black;'")."
				</td>
				<td></td>
				<td>
					".$Func->cmb2D("level[$i-1]",$level,array(array(1,"admin"),array(2,"member")),"style='border:0px;width:100%;'")."
				</td>
				<td align=center width='100'>						
					".$Func->txtField("blokir[$i-1]",'Y','','','radio',$check1)."Y
					".$Func->txtField("blokir[$i-1]",'N','','','radio',$check2)."N
				</td>
				<td align=center>&nbsp;</td>
			</tr>
		";
	}
	$List ="
	<form name=Fm id=Fm method=post action='$PHP_SELF?Pg=$Pg' enctype='multipart/form-data'>
	<TABLE width=100%>
	<TR>
		<TD>Cari</TD>
		<TD>".$Func->txtField('cNama',$cNama,'50','20','text',"placeholder='Username' style='color:#808080;'")."</TD>
		<TD>
		<input type='button' value='go' class='button' onclick=\"Fm.Action.value='BknSimpan';Fm.Mode.value='';Fm.submit();\"/>
		</TD>
		<td align=right width=100%>
			<input type='button' value='Simpan' class='button' onclick=\"Fm.Action.value='Simpan';Fm.Mode.value='';Fm.submit();\"/>		
		</td>
	</TR>
	</TABLE>		
	<b>Password Default : <span style='color:red;'>rahasia</span></b>
	<table class='tablesorter' id='tablesorter' width=100% cellpadding=1 cellspacing=0 align=center>
	<thead>
		<tr>
			<th width=10>".$Func->SortHeader("No.")."</th>
			<th>".$Func->SortHeader("Id Pengguna")."</th>
			<th>".$Func->SortHeader("Nama Lengkap")."</th>
			<th>".$Func->SortHeader("E-mail")."</th>
			<th>".$Func->SortHeader("Action")."</th>
			<th>".$Func->SortHeader("Level")."</th>
			<th>".$Func->SortHeader("Blokir")."</th>
			<th></th>									
		</tr>
		</thead>
		<tbody>$ListMode</tbody>
	</table>
	$link
	".$Func->txtField('Pr',$Pr,'','','hidden')."
		".$Func->txtField('Mode',$Mode,'','','hidden')."
		".$Func->txtField('halaman',$halaman,'','','hidden')."
		".$Func->txtField('Action',$Action,'','','hidden')."
	</FORM>
	";	
	
	$Main->Isi =$List;
	
	
?>