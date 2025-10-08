<?php
	$nmquery=!empty($nmquery)?$nmquery:"";
	$pwd=!empty($pwd)?$pwd:"";
	$isiquery=!empty($isiquery)?$isiquery:"";
	$aktif=!empty($aktif)?$aktif:"";
	switch($Action)
	{
		case"Simpan":
			if(!empty($nmquery)&&!empty($pwd)&&!empty($isiquery)&&!empty($aktif))
			{					
				$Qry=_mysql_query("select * from webservices_json where id='".@$id."'");
				if(_mysql_num_rows($Qry)>0)					
				{$QSimpan="UPDATE webservices_json SET `nmquery`='{$nmquery}', `pwd`='{$pwd}', `isiquery`='".addslashes($isiquery)."', aktif='$aktif' WHERE  id='$id' LIMIT 1;";}	
				else
				{$QSimpan="INSERT INTO webservices_json (`nmquery`, `pwd`, `isiquery`, aktif) VALUES ('{$nmquery}', '{$pwd}', '".addslashes($isiquery)."', '$aktif');";}
				$Simpan = _mysql_query($QSimpan) or  $Func->ViewPesan("Gagal di simpan, ".mysql_error(),0);
				$Pesan = $Simpan?$Func->ViewPesan("Sudah di simpan"):$Func->ViewPesan("Gagal di simpan, ".mysql_error(),0);	
			}
		break;
		case"hapus":
			_mysql_query("delete from webservices_json where id='$id' LIMIT 1;");
		break;
		case"edit":
			$Func->ambilData("select * from webservices_json where id='$id'");
		break;
		case "baru":
			header("location:index.php?Pg=$Pg&Pr=$Pr");
		break;
	}
	
	$Main->Isi = "
	$Pesan

	

	<div id='list'>
	<form name=Fm id=Fm method=post action='$PHP_SELF?Pg=$Pg&Pr=$Pr#transaksi' enctype='multipart/form-data'>
	<TABLE width=100%>
		<td align=right width=100%>
			<input type='button' value='Baru' class='button' onclick=\"Fm.Action.value='baru';Fm.Mode.value='';Fm.submit();\"/>	
			<input type='button' value='Simpan' class='button' onclick=\"Fm.Action.value='Simpan';Fm.Mode.value='';Fm.submit();\"/>		
			<a href='http://".$_SERVER['SERVER_NAME'] ."/parsing/' target='_blank'><input type='button' value='Run' class='button'/></a>			
		</td>
	</TR>
	</TABLE>
	
	<table width=100%>
	<tr >
		<td>Nama Query</td>
		<td> ".$Func->txtField("nmquery",$nmquery,'','40','text')."</td>
	</tr>
	<tr>
		<td>Passsword</td>
		<td> ".$Func->txtField("pwd",$pwd,'','30','text')."</td>
	</tr>	
	<tr>
		<td>Query</td>
		<td> ".$Func->txtField("isiquery",$isiquery,'','180','text')."</td>
	</tr>	
	<tr >
		<td>Aktif</td>
		<td> ".$Func->cmb2D("aktif",$aktif,array(array('1','Aktif'),array('2','Tidak Aktif')))."</td>
	</tr>
	</table>
	    ".$Func->txtField('id',@$id,'','','hidden')."
	    ".$Func->txtField('Pr',$Pr,'','','hidden')."
		".$Func->txtField('Sb',$Sb,'','','hidden')."
		".$Func->txtField('Mode',$Mode,'','','hidden')."
		".$Func->txtField('Action',$Action,'','','hidden')."
</div>
	";
	$ArrAktif=array('Aktif','Tidak Aktif');
	$PageNavi = new pageNavi;
	$pagehal=!empty($pagehal)?$pagehal:"";
	$batas = 100;
	$halaman=!empty($_GET['pagehal'])?$_GET['pagehal']:1;
	$posisi = $PageNavi->cariPosisi($batas);
	$i=$posisi+1; //a.KREDIT
	$jmldata = _mysql_num_rows(_mysql_query("select * from webservices_json "));
	$jmlhalaman = $PageNavi->jumlahHalaman($jmldata, $batas);
	$linkHalaman = $PageNavi->navHalaman($halaman, $jmlhalaman, "index.php?Pg=$Pg&Pr=$Pr&ckata=$ckata&Action=$Action");
	$link="<div class='light'><div class='pageNavi'>$linkHalaman</div></div>";

	/// LIST DATA
	$ListMode="";
	//a.KREDIT, 
	$Qry=_mysql_query("select * from webservices_json  limit $posisi,$batas");

	if(_mysql_num_rows($Qry)>0)
	{		
		while($Isi=_mysql_fetch_array($Qry))
		{		$popup="";
			
			$ListMode.="
				<tr $wr  onmouseover=\"TG(this,'#FFCC33')\" onmouseout=\"TG(this,'')\" >
					<td align=center $popup>$i</td>
					<td $popup>{$Isi['nmquery']}</td>
					<td $popup>{$Isi['pwd']}</td>					
					<td $popup>{$Isi['isiquery']}</td>	
					<td $popup>".$ArrAktif[$Isi['aktif']-1]."</td>
					<td width='10'>
						<a href=\"index.php?Pg=$Pg&Pr=$Pr&Action=edit&id={$Isi['id']}\">
							<img src='{$Dir->Images}/icon/edit.gif'>
						</a>
					</td>
					<td width='10'>
						<a href=\"index.php?Pg=$Pg&Pr=$Pr&Action=hapus&id={$Isi['id']}\" onclick=\"Cek=confirm('Yakin akan di hapus ?');if(!Cek){return false;}\">
							<img src='{$Dir->Images}/icon/hapus.gif'>
						</a>
					</td>
				</tr>
				<tr>
					<td colspan=7 bgcolor='green' style='color:white;'>
						<b>[Tipe Get] : http://".$_SERVER['SERVER_NAME']."/webapi/index.php?nmquery={$Isi['nmquery']}&pwd={$Isi['pwd']}
						<hr>
						[Tipe POST] : http://".$_SERVER['SERVER_NAME']."/webapi/index.php <br>
						[nmquery={$Isi['nmquery']}]<BR>[pwd={$Isi['pwd']}]</b>
					</td>
				</tr>
			";$i++;
			
		}
		$nohal=$i-1;
	}

	
	$Main->Isi .="

	<table class='tablesorter' id='tablesorter' width=100% cellpadding=1 cellspacing=0 align=center>
	<thead>
		<tr>
			<th width=10>".$Func->SortHeader("No.")."</th>
			<th>".$Func->SortHeader("Nama Query")."</th>
			<th>".$Func->SortHeader("Password")."</th>
			<th>".$Func->SortHeader("Isi Query")."</th>
			<th>".$Func->SortHeader("Aktif")."</th>
			<th colspan=2>&nbsp;</th>									
		</tr>
		</thead>
		<tbody>$ListMode</tbody>
	</table>	
	".$Func->txtField('halaman',$halaman,'','','hidden')."
	".$Func->txtField('pagehal',$pagehal,'','','hidden')."
	".$Func->txtField('posisi',$posisi,'','','hidden')."
	".$Func->txtField('id',$id,'','','hidden')."
		
		
	</FORM>
	$link
	";
	
?>