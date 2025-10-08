<?php
	$Show = $Func->gFile("{$Main->Tema}/kosong.html");	
	$dbnameid=!empty($dbnameid)?$dbnameid:"";
	$List="";
	$ListMode="";
	$ChangeField=!empty($ChangeField)?$ChangeField:"";
	$vPrimary=!empty($vPrimary)?$vPrimary:"";
	$ChangeField=!empty($ChangeField)?$ChangeField:"";
	$jcol=!empty($jcol)?$jcol:0;
	switch($Aksi)
	{
		case "Simpan";
			if(!empty($table_name)&&!empty($dbnameid))
			{	
				$Qry=_mysql_query("select * from `reg_db_dwh_table` where `id_table`='$id'");
				if(_mysql_num_rows($Qry)>0)					
				{
					_mysql_query("delete from `reg_db_dwh_field` where `dbname`='{$dbnameid}' and `table_name`='{$table_name}'");
					$QSimpan="UPDATE `reg_db_dwh_table` SET `table_name`='{$table_name}', `dbname`='{$dbnameid}', `tanggal_update`='{$TANGGAL_AKSES}', `user_update`='{$sUserId}' WHERE  `id_table`='{$id}';";
					$Simpan=_mysql_query( $QSimpan );
					$Urutan=1000;
					foreach ($COLUMN_NAME as $k=>$v) {		
						$LengthQ=!empty($LengthSet[$k])?"({$LengthSet[$k]})":"";
						
						$QryCek=_mysql_query("SELECT COLUMN_NAME, DATA_TYPE, replace(replace(replace(COLUMN_TYPE,DATA_TYPE,''),'(',''),')','') as LengthSet FROM information_schema.columns WHERE table_name = '{$table_name}' and TABLE_SCHEMA='{$dbnameid}' and COLUMN_NAME='".$COLUMN_NAME[$k]."'");
						if(_mysql_num_rows($QryCek)>0){
							$QTSimpan=_mysql_query("ALTER TABLE `".$dbnameid."`.`".$table_name."` CHANGE COLUMN `{$COLUMN_NAME_OLD[$k]}` `{$COLUMN_NAME[$k]}` {$DATA_TYPE[$k]}{$LengthQ} NULL DEFAULT NULL ;");
						}else{
							$QTSimpan=_mysql_query("ALTER TABLE `".$dbnameid."`.`".$table_name."` ADD COLUMN `{$COLUMN_NAME[$k]}` {$DATA_TYPE[$k]}{$LengthQ} NULL DEFAULT NULL ;");
						}
						
						if($PRIMARY[$k]=='1'){
							$ChangeField.="CHANGE COLUMN `".trim($COLUMN_NAME[$k])."` `".trim($COLUMN_NAME[$k])."` ".$DATA_TYPE[$k]."({$LengthSet[$k]})  NOT NULL ,";
							$vPrimary.="`".trim($COLUMN_NAME[$k])."`,";			
						}
						
						_mysql_query("INSERT INTO `reg_db_dwh_field` (`dbname`, `table_name`, `field`, `type`, `length`, `primary`, `urutan`) VALUES ('{$dbnameid}', '{$table_name}', '{$COLUMN_NAME[$k]}', '{$DATA_TYPE[$k]}', '{$LengthSet[$k]}', '{$PRIMARY[$k]}', '".$Urutan."');");
						$Urutan++;
					}
					
					if(!empty($vPrimary)){
						//echo "ALTER TABLE `".$dbnameid."`.`".$table_name."` ".$ChangeField." DROP PRIMARY KEY,	ADD PRIMARY KEY (".substr($vPrimary,0,-1).");";
						$QSaveTable=_mysql_query("ALTER TABLE `".$dbnameid."`.`".$table_name."` ".$ChangeField." DROP PRIMARY KEY,	ADD PRIMARY KEY (".substr($vPrimary,0,-1).");");
						if($QSaveTable){}else{
							_mysql_query("ALTER TABLE `".$dbnameid."`.`".$table_name."` ".$ChangeField." ADD PRIMARY KEY (".substr($vPrimary,0,-1).");");
						}					
					}

				}else{
					$COLUMN_NAME=!empty($COLUMN_NAME)?$COLUMN_NAME:array();			
					$CTableTmp="";$Urutan=1000;
					foreach ($COLUMN_NAME as $k=>$v) {		
						$LengthQ=!empty($LengthSet[$k])?"({$LengthSet[$k]})":"";
						$CTableTmp.="`{$COLUMN_NAME[$k]}` {$DATA_TYPE[$k]}{$LengthQ} NULL DEFAULT NULL,";	

						_mysql_query("INSERT INTO `reg_db_dwh_field` (`dbname`, `table_name`, `field`, `type`, `length`, `primary`, `urutan`) VALUES ('{$dbnameid}', '{$table_name}', '{$COLUMN_NAME[$k]}', '{$DATA_TYPE[$k]}', '{$LengthSet[$k]}', '{$PRIMARY[$k]}', '".$Urutan."');");


						$Urutan++;
					}
					$QTSimpan=_mysql_query("CREATE TABLE IF NOT EXISTS `".$dbnameid."`.`".$table_name."` ( ".substr($CTableTmp,0,-1)."	)COLLATE='latin1_swedish_ci' ENGINE=MyISAM;");

					
				}


				$Pesan = $QTSimpan?$Func->ViewPesan("Sudah di simpan"):$Func->ViewPesan("Gagal di simpan");	
				if( $QTSimpan){
					$QSimpan="INSERT INTO `reg_db_dwh_table` (`table_name`, `dbname`, `tanggal_insert`, `user_create`) VALUES ('{$table_name}', '{$dbnameid}', '{$TANGGAL_AKSES}', '{$sUserId}');";
					$Simpan=_mysql_query( $QSimpan );
					$Pesan = $Func->ViewPesan("Sudah di simpan");	
					//echo "<script>parent.location='index.php?Pg=$Pg&Pr=$Pr&Sb=$Sb&dbname=$dbnameid';</script>";
				}else{
					$Pesan =$Func->ViewPesan("Gagal di simpan");
				}
				
				
			}
			else
			{$Pesan = $Func->ViewPesan("Maaf, form warna merah wajib diisi");}
		break;
		case "Lihat":
			$Func->ambilData("select * from `reg_db_dwh_table` where `id_table`='".$id."';");
			$Func->ambilData("SELECT count(*) as jcol FROM information_schema.columns WHERE table_name = '{$table_name}' and TABLE_SCHEMA='{$dbname}'");
			$dbnameid=$dbname;
		break;
		case "Hapus":
			$Func->ambilData("select dbname, table_name from `reg_db_dwh_table` where `id_table`='".$id."';");
			_mysql_query("DROP TABLE IF EXISTS `".$dbname."`.`".$table_name."`;");
			_mysql_query("DELETE FROM `reg_db_dwh_table` where `id_table`='{$id}';");
			echo "<script>parent.location='index.php?Pg=$Pg&Pr=$Pr&Sb=$Sb&dbname=$dbnameid';</script>";	
		break;
	}
	
	if(empty($id)&&empty($table_name))
	{$Func->kosongkanData('reg_db_dwh_table');}
	
	if($jcol>0){
		$i=1;

		$Qry=_mysql_query("SELECT COLUMN_NAME, DATA_TYPE, replace(replace(replace(COLUMN_TYPE,DATA_TYPE,''),'(',''),')','') as LengthSet, IF(COLUMN_KEY='PRI',1,0) AS 'PRIMARY' FROM information_schema.columns WHERE table_name = '{$table_name}' and TABLE_SCHEMA='{$dbnameid}'");
		
		while($Isi=_mysql_fetch_array($Qry)){
				$wr = $i % 2 == 0 ? "style='background:$Main->BgRow'" : "style='background:$Main->BgRow2'";
				$wh = $i % 2 == 0 ? "$Main->BgRow" : "$Main->BgRow2";
				$StyleTd="style='border:0px;background:$wh;width:100%'";
				$ListMode.="
					".$Func->txtField("COLUMN_NAME_OLD[$i-1]",$Isi['COLUMN_NAME'],'','','hidden')."
					<tr $wr  onmouseover=\"TG(this,'#FFCC33')\" onmouseout=\"TG(this,'$wh')\">
						<td align=center>$i</td>
						<td>".$Func->txtField("COLUMN_NAME[$i-1]",$Isi['COLUMN_NAME'],'','','text',$StyleTd)."</td>
						<td>".$Func->cmbQuery("DATA_TYPE[$i-1]",strtoupper(trim($Isi['DATA_TYPE'])),"select name_tipe, concat('[',kategori,'] ',name_tipe) from _tipe_data",$StyleTd)."</td>
						<td>".$Func->txtField("LengthSet[$i-1]",$Isi['LengthSet'],'','','text',$StyleTd)."</td>
						<td>".$Func->cmb2D("PRIMARY[$i-1]",$Isi['PRIMARY'],array(array(1,"Primary"),array(0,"No Primary")),$StyleTd)."</td>
					</tr>			
				";
				$i++;
		}

		///// Add list
		if($Aksi=='go'){
			while($jcol>=$i){
				$wr = $i % 2 == 0 ? "style='background:$Main->BgRow'" : "style='background:$Main->BgRow2'";
				$wh = $i % 2 == 0 ? "$Main->BgRow" : "$Main->BgRow2";
				$StyleTd="style='border:0px;background:$wh;width:100%'";
				$ListMode.="
					".$Func->txtField("COLUMN_NAME_OLD[$i-1]",'','','','hidden')."
					<tr $wr  onmouseover=\"TG(this,'#FFCC33')\" onmouseout=\"TG(this,'$wh')\">
						<td align=center>$i</td>
						<td>".$Func->txtField("COLUMN_NAME[$i-1]",'','','','text',$StyleTd)."</td>
						<td>".$Func->cmbQuery("DATA_TYPE[$i-1]",'',"select name_tipe, concat('[',kategori,'] ',name_tipe) from _tipe_data",$StyleTd)."</td>
						<td>".$Func->txtField("LengthSet[$i-1]",'','','','text',$StyleTd)."</td>
						<td>".$Func->cmb2D("PRIMARY[$i-1]",$Isi['PRIMARY'],array(array(1,"Primary"),array(0,"No Primary")),$StyleTd)."</td>
					</tr>			
				";
				$i++;
			}
		}

		$List="
			<table class='tablesorter' id='tablesorter' width=100% cellpadding=1 cellspacing=0 align=center>
			<thead>
			<tr>
				<th width=10>".$Func->SortHeader("#")."</th>
				<th>".$Func->SortHeader("Name Field")."</th>
				<th>".$Func->SortHeader("Data Type")."</th>
				<th>".$Func->SortHeader("Length/Set")."</th>
				<th>".$Func->SortHeader("Primary")."</th>
			</tr>
				<tbody>$ListMode</tbody>
			</table>
		";
	}
	$Main->Isi="
		$Pesan
		<form name=Fm2 id=Fm2 method=post action='$PHP_SELF?Pg=$Pg&Pr=$Pr' enctype='multipart/form-data'>	
			
			<table border=0>
			<tr>
				<td>Nama Tabel</td>
				<td> ".$Func->txtField("table_name",$table_name,'25','25','text')."</td>
			</tr>
			<tr>
				<td>Jumlah Column</td>
				<td> ".$Func->txtField("jcol",$jcol,'3','3','text')." <input type='button' class='button' value='Go' onclick=\"Fm2.Aksi.value='go';submitForm('#Fm2', '#faceboxisi', Fm2.action);\"></td>
		
			</table>
			<p align=right>
			<input type='button' class='button' value='Simpan' onclick=\"Fm2.Aksi.value='Simpan';submitForm('#Fm2', '#faceboxisi', Fm2.action);\">
			</p>
			$List
			".$Func->txtField('dbnameid',$dbnameid,'','','hidden')."
			".$Func->txtField('Mode',$Mode,'','','hidden')."
			".$Func->txtField('Aksi',$Aksi,'','','hidden')."
			".$Func->txtField('id',$id,'','','hidden')."
			".$Func->txtField('Pg',$Pg,'','','hidden')."
			".$Func->txtField('Pr',$Pr,'','','hidden')."
			".$Func->txtField('Sb',$Sb,'','','hidden')."
		</form>
	";

	$Main->Isi = $Func->Kotak($Main->MenuHeader." [Table]",$Main->Isi,'100%');
?>