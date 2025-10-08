<?php
	$Show = $Func->gFile("{$Main->Tema}/kosong.html");	
	$dbnameid=!empty($dbnameid)?$dbnameid:"";$List="";
	switch($Aksi)
	{
		case "Simpan";
			if(!empty($query_name)&&!empty($query_script))
			{	
				$Qry=_mysql_query("select * from `reg_db_sumber_query` where `id_query`='$id'");
				if(_mysql_num_rows($Qry)>0)					
				{
					$QSimpan="UPDATE `reg_db_sumber_query` SET `query_name`='{$query_name}', `dbname`='{$dbnameid}', `query_script`='".  _mysql_real_escape_string($query_script)."', `tanggal_update`='{$TANGGAL_AKSES}', `user_update`='{$sUserId}' WHERE  `id_query`='{$id}';";

					


				}	
				else
				{$QSimpan="INSERT INTO `reg_db_sumber_query` (`query_name`, `dbname`, `query_script`, `tanggal_insert`, `user_create`) VALUES ('{$query_name}', '{$dbnameid}', '".  _mysql_real_escape_string($query_script)."', '{$TANGGAL_AKSES}', '{$sUserId}');";}

				
				$Simpan=_mysql_query( $QSimpan );
				$Pesan = $Simpan?$Func->ViewPesan("Sudah di simpan"):$Func->ViewPesan("Gagal di simpan");		
				echo "<script>parent.location='index.php?Pg=$Pg&Pr=$Pr&Sb=$Sb&dbname=$dbnameid';</script>";	
			}
			else
			{$Pesan = $Func->ViewPesan("Maaf, form warna merah wajib diisi");}
		break;
		case "Lihat":
			$Func->ambilData("select * from `reg_db_sumber_query` where `id_query`='".$id."';");
		break;
		case "Hapus":
			_mysql_query("DELETE FROM `reg_db_sumber_query` where `id_query`='{$id}';");
			$Func->kosongkanData('reg_db_sumber_query');
			echo "<script>parent.location='index.php?Pg=$Pg&Pr=$Pr&Sb=$Sb&dbname=$dbnameid';</script>";	
		break;
	}
	
	if(empty($id))
	{$Func->kosongkanData('reg_db_sumber_query');}
	
	$Main->Isi="
		
		<form name=Fm2 id=Fm2 method=post action='$PHP_SELF?Pg=$Pg&Pr=$Pr' enctype='multipart/form-data'>	
			
			<table border=0>
			<tr>
				<td>Nama Query</td>
				<td> ".$Func->txtField("query_name",$query_name,'25','25','text')."</td>
			</tr>
			<tr>
				<td>Script Query</td>
				<td></td>
			</tr>
			<tr>
				
				<td colspan=2> <textarea name='query_script' rows='query_script' style='width:665px;height:100px;font-family:consolas;font-size:10pt;'>$query_script</textarea>
			</tr>
			<tr>
				<td style='border:0px'></td>
				<td style='border:0px' align=right colspan='3'>
					<input type='button' class='button' value='Simpan' onclick=\"Fm2.Aksi.value='Simpan';submitForm('#Fm2', '#faceboxisi', Fm2.action);\">
				</td>
			</tr>
			</table>
			
			".$Func->txtField('dbnameid',$dbnameid,'','','hidden')."
			".$Func->txtField('Mode',$Mode,'','','hidden')."
			".$Func->txtField('Aksi',$Aksi,'','','hidden')."
			".$Func->txtField('id',$id,'','','hidden')."
			".$Func->txtField('Pg',$Pg,'','','hidden')."
			".$Func->txtField('Pr',$Pr,'','','hidden')."
			".$Func->txtField('Sb',$Sb,'','','hidden')."
		</form>
	";

	$Main->Isi = $Func->Kotak($Main->MenuHeader." [Query]",$Main->Isi,'100%');
?>