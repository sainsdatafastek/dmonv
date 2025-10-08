<?php
	$Show = $Func->gFile("{$Main->Tema}/kosong.html");	
	$sortir=!empty($sortir)?$sortir:1;
	$TambahId=!empty($TambahId)?$TambahId:"";
	$koderek=!empty($koderek)?$koderek:"";
	$uraian=!empty($uraian)?$uraian:"";
	$TextTemp="dwh_";
	switch($Aksi)
	{
		case "Simpan";
			if(!empty($dbname))
			{	
				$Qry=_mysql_query("select * from reg_db_dwh where id_dbname='$id'");
				if(_mysql_num_rows($Qry)>0)					
				{$QSimpan="UPDATE `reg_db_dwh` SET `dbname`='".$TextTemp."{$dbname}', `tanggal_update`='{$TANGGAL_AKSES}', `user_update`='{$sUserId}' WHERE  `id_dbname`='{$id}';";}	
				else
				{$QSimpan="INSERT INTO `reg_db_dwh` (`dbname`, `tanggal_insert`, `user_create`) VALUES ('".$TextTemp."{$dbname}', '{$TANGGAL_AKSES}', '{$sUserId}');";}
				
				
				$Simpan=_mysql_query( $QSimpan );
				_mysql_query("CREATE DATABASE IF NOT EXISTS `".$TextTemp."{$dbname}`");
				$Pesan = $Simpan?$Func->ViewPesan("Sudah di simpan"):$Func->ViewPesan("Gagal di simpan");		
				echo "<script>parent.location='index.php?Pg=$Pg&Pr=$Pr&Sb=$Sb';</script>";	
			}
			else
			{$Pesan = $Func->ViewPesan("Maaf, form warna merah wajib diisi");}
		break;
		case "Lihat":
			$Func->ambilData("select * from `reg_db_dwh` where `id_dbname`='".$id."';");
		break;
		case "Hapus":
			$Func->ambilData("select dbname from `reg_db_dwh` where `id_dbname`='".$id."';");
			_mysql_query("DROP DATABASE IF EXISTS `".$TextTemp."{$dbname}`;");
			_mysql_query("DELETE FROM `reg_db_dwh` where `id_dbname`='{$id}';");
			$Func->kosongkanData('reg_db_dwh');
			echo "<script>parent.location='index.php?Pg=$Pg&Pr=$Pr&Sb=$Sb';</script>";	
		break;
	}
	
	if(empty($id)){$Func->kosongkanData('reg_db_dwh');}

	$Main->Isi="
		<i>*) Pastikan Nama Database Sudah Benar</i>
		<form name=Fm2 id=Fm2 method=post action='$PHP_SELF?Pg=$Pg&Pr=$Pr' enctype='multipart/form-data'>	
			
			<table border=0>
		
			<tr>
				<td style='color:red;'>Nama Database </td>
				<td> ".$Func->txtField("dbname",$dbname,'25','25','text')."</td>
			</tr>
			<tr>
				<td style='border:0px'></td>
				<td style='border:0px' align=right colspan='3'>
					<input type='button' class='button' value='Simpan' onclick=\"Fm2.Aksi.value='Simpan';submitForm('#Fm2', '#faceboxisi', Fm2.action);\">
				</td>
			</tr>
			</table>
			
			".$Func->txtField('Mode',$Mode,'','','hidden')."
			".$Func->txtField('Aksi',$Aksi,'','','hidden')."
			".$Func->txtField('id',$id,'','','hidden')."
			".$Func->txtField('Pg',$Pg,'','','hidden')."
			".$Func->txtField('Pr',$Pr,'','','hidden')."
			".$Func->txtField('Sb',$Sb,'','','hidden')."
		</form>
	";
	$Main->Isi = $Func->Kotak($Main->MenuHeader." [Database]",$Main->Isi,'100%');
?>