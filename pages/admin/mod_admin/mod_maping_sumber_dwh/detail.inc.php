<?php
	$Show = $Func->gFile("{$Main->Tema}/kosong.html");	
	$sortir=!empty($sortir)?$sortir:1;
	$TambahId=!empty($TambahId)?$TambahId:"";
	$koderek=!empty($koderek)?$koderek:"";
	$uraian=!empty($uraian)?$uraian:"";
	$TextTemp="tmp";
	switch($Aksi)
	{
		case "Simpan";
			if(!empty($id_dbname_sumber)&&!empty($id_dbname_dwh)&&!empty($id_query)&&!empty($id_table))
			{	
				$Qry=_mysql_query("select * from reg_maping_sumber_to_dwh where id_maping='$id'");
				if(_mysql_num_rows($Qry)>0)					
				{$QSimpan="UPDATE `reg_maping_sumber_to_dwh` SET `id_dbname_sumber`='{$id_dbname_sumber}', `id_dbname_dwh`='{$id_dbname_dwh}', `id_query`='{$id_query}', `id_table`='{$id_table}',  `tanggal_update`='{$TANGGAL_AKSES}', `user_update`='{$sUserId}' WHERE  `id_maping`='{$id}';";}	
				else
				{$QSimpan="INSERT INTO `reg_maping_sumber_to_dwh` (`id_dbname_sumber`, `id_dbname_dwh`, `id_query`, `id_table`, `tanggal_insert`, `user_create`) VALUES ('{$id_dbname_sumber}', '{$id_dbname_dwh}', '{$id_query}', '{$id_table}', '{$TANGGAL_AKSES}', '{$sUserId}');";}
				
				 
				$Simpan=_mysql_query( $QSimpan );
				$Pesan = $Simpan?$Func->ViewPesan("Sudah di simpan"):$Func->ViewPesan("Gagal di simpan");		
				echo "<script>parent.location='index.php?Pg=$Pg&Pr=$Pr&Sb=$Sb';</script>";	
			}
			else
			{$Pesan = $Func->ViewPesan("Maaf, form warna merah wajib diisi");}
		break;
		case "Lihat":
			$Func->ambilData("select * from `reg_maping_sumber_to_dwh` where `id_maping`='".$id."';");
		break;
		case "Hapus":
			_mysql_query("DELETE FROM `reg_maping_sumber_to_dwh` where `id_maping`='{$id}';");
			$Func->kosongkanData('reg_maping_sumber_to_dwh');
			echo "<script>parent.location='index.php?Pg=$Pg&Pr=$Pr&Sb=$Sb';</script>";	
		break;
	}
	
	$id_dbname_sumber=!empty($id_dbname_sumber)?$id_dbname_sumber:"";
	$id_query=!empty($id_query)?$id_query:"";
	$id_dbname_dwh=!empty($id_dbname_dwh)?$id_dbname_dwh:"";
	$id_table=!empty($id_table)?$id_table:"";

	$Main->Isi="
			<form name=Fm2 id=Fm2 method=post action='$PHP_SELF?Pg=$Pg&Pr=$Pr' enctype='multipart/form-data'>		
			<table border=0>
			<tr>
				<td>Database Sumber</td>
				<td> ".$Func->cmbQuery("id_dbname_sumber",$id_dbname_sumber,"select id_dbname, dbname from reg_db_sumber","onchange=\"Fm2.Aksi.value='BknSimpan';submitForm('#Fm2', '#faceboxisi', Fm2.action);\"")."</td>
				<td>Query Sumber</td>
				<td> ".$Func->cmbQuery("id_query",$id_query,"select id_query, query_name from reg_db_sumber_query as a inner join reg_db_sumber as b on a.dbname=b.dbname where b.id_dbname='{$id_dbname_sumber}'")."</td>
			</tr>
		
			<tr>
				<td>Database DWH</td>
				<td> ".$Func->cmbQuery("id_dbname_dwh",$id_dbname_dwh,"select a.id_dbname, a.dbname from reg_db_dwh as a ","onchange=\"Fm2.Aksi.value='BknSimpan';submitForm('#Fm2', '#faceboxisi', Fm2.action);\"")."</td>
				<td>Table DWH</td>
				<td> ".$Func->cmbQuery("id_table",$id_table,"select a.id_table, a.table_name from reg_db_dwh_table as a inner join reg_db_dwh as b on a.dbname=b.dbname where b.id_dbname='{$id_dbname_dwh}'")."</td>
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
	$Main->Isi = $Func->Kotak($Main->MenuHeader,$Main->Isi,'100%');
?>