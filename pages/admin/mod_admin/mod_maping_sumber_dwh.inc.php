<?php
	$id_maping=!empty($id_maping)?$id_maping:"";
	//////////// TABLE LIST
		/// DATABASES
	$ListMode="";$i=1;	
	$TextTemp="tmp";
	///// PARAMETER AND QUERY GRID
	$Qry="select a.id_maping, b.dbname as dbsumber, e.query_name as query_sumber , c.dbname as dbdwh, f.table_name as table_dwh from reg_maping_sumber_to_dwh as a inner join reg_db_sumber as b on a.id_dbname_sumber=b.id_dbname inner join reg_db_dwh as c on a.id_dbname_dwh =c.id_dbname inner join reg_db_sumber_query as e on a.id_query =e.id_query inner join reg_db_dwh_table as f on a.id_table  = f.id_table";
	$Qry=_mysql_query($Qry);

	///// LIST GRID
	while($Isi=_mysql_fetch_array($Qry)){
		$wr = $i % 2 == 0 ? "style='background:$Main->BgRow'" : "style='background:$Main->BgRow2'";
		$wh = $i % 2 == 0 ? "$Main->BgRow" : "$Main->BgRow2";
		
		$ListMode.="
			<tr $wr  onmouseover=\"TG(this,'#FFCC33')\" onmouseout=\"TG(this,'$wh')\">
				<td align=center>$i</td>
				<td onclick=\"Fm.id_maping.value='{$Isi['id_maping']}';Fm.Action.value='BknSimpan';Fm.submit();\">{$Isi['dbsumber']}</td>
				
				<td>{$Isi['query_sumber']}</td>					
				<td>{$Isi['dbdwh']}</td>
				<td>{$Isi['table_dwh']}</td>

				<td width=10 onclick=\"javascript:showPopUp('500','200');ambilData('#faceboxisi', 'index.php?Pg=$Pg&Pr=$Pr&Mode=detail&Aksi=Lihat&id={$Isi['id_maping']}')\">
					<img src='{$Dir->Images}/icon/edit.gif'>
				</td>
				<td width=10 onclick=\"Cek=confirm('Yakin akan dihapus?');if(!Cek){return false;}else{javascript:showPopUp('500','200');ambilData('#faceboxisi', 'index.php?Pg=$Pg&Pr=$Pr&Mode=detail&Aksi=Hapus&id={$Isi['id_maping']}')}\">

					<img src='{$Dir->Images}/icon/hapus.gif'>
				</td>
			</tr>
		";$i++;
	}
	
	$List="
		".$Func->tabSplit("Maping Database")."
		<p align=right>
		<input type='button' align=right value='Tambah' class='button' onclick=\"javascript:showPopUp('500','200');ambilData('#faceboxisi', 'index.php?Pg=$Pg&Pr=$Pr&Mode=detail')\"/>
		</p>
		<table class='tablesorter' id='tablesorter' width=100% cellpadding=1 cellspacing=0 align=center>
		<thead>
		<tr>
			<th width=10 rowspan=2>".$Func->SortHeader("No.")."</th>
			<th colspan=2>".$Func->SortHeader("Data Sumber")."</th>
			<th colspan=2>".$Func->SortHeader("Tujuan Data DWH")."</th>
			<th colspan=2 rowspan=2>&nbsp;</th>	
		</tr>
		<tr>
			<th>".$Func->SortHeader("Database")."</th>
			<th>".$Func->SortHeader("Query")."</th>
			<th>".$Func->SortHeader("Database")."</th>
			<th>".$Func->SortHeader("Table")."</th>
		</tr>
			<tbody>$ListMode</tbody>
		</table>
		$link
	";
	if(!empty($id_maping)){
		$ChangeField="";$Primary="";
		switch($Action){

			case "Simpan":

				$field_sumber=!empty($field_sumber)?$field_sumber:array();
				foreach ($field_sumber as $k=>$v) {
					$QCek=_mysql_query("select * from reg_maping_sumber_to_dwh_field where id_maping_fields='{$id_maping_fields[$k]}' and id_maping='$id_maping'");
					
					if(_mysql_num_rows($QCek)>0){
						_mysql_query("UPDATE `reg_maping_sumber_to_dwh_field` SET `field_sumber`='".trim($field_sumber[$k])."', `field_dwh`='".trim($field_dwh[$k])."', param='".$param[$k]."' WHERE  `id_maping_fields`='{$id_maping_fields[$k]}'and id_maping='$id_maping';");
					}else{
						_mysql_query("INSERT INTO `reg_maping_sumber_to_dwh_field` (`id_maping`, `field_sumber`, `field_dwh`,`param`) VALUES ('{$id_maping}', '".trim($field_sumber[$k])."', '".trim($field_dwh[$k])."', '".$param[$k]."');");					
					}

					if($param[$k]=='Y'){
						$ChangeField.="CHANGE COLUMN `".trim($field_dwh[$k])."` `".trim($field_dwh[$k])."` ".$COLUMN_TYPE[$k]." NOT NULL ,";
						$Primary.="`".trim($field_dwh[$k])."`,";			
					}
				}

				//// ADD PRIMARY TABLE
				if(!empty($Primary)){
					$QSaveTable=_mysql_query("ALTER TABLE ".$tbldwh." ".$ChangeField." DROP PRIMARY KEY,	ADD PRIMARY KEY (".substr($Primary,0,-1).");");
					if($QSaveTable){}else{
						_mysql_query("ALTER TABLE ".$tbldwh." ".$ChangeField." ADD PRIMARY KEY (".substr($Primary,0,-1).");");
					}					
				}
			break;
		}

		/**/
			/// TABLES
		///// PARAMETER AND QUERY GRID
		$Func->ambilData("select concat('`',b.dbname,'`.`',c.table_name,'`') as tbldwh ,b.dbname as dbdwh, c.table_name as table_dwh, e.dbname as dbsumber, f.query_name as query_sumber, f.query_script, e.hostname, e.username, e.`password` from reg_maping_sumber_to_dwh as a inner join reg_db_dwh as b on a.id_dbname_dwh=b.id_dbname inner join reg_db_dwh_table as c on a.id_table = c.id_table inner join reg_db_sumber as e on a.id_dbname_sumber= e.id_dbname inner join reg_db_sumber_query as f on a.id_query  = f.id_query where a.id_maping ='{$id_maping}'");

		
		

		///////////////////// ARR FIELD
		$con00 = mysqli_connect($hostname, $username, $password, $dbsumber);

		$Qry = mysqli_query($con00,"$query_script");
		while ($Field=mysqli_fetch_field($Qry)){
			$ArrField[]= $Field->name;
			}


/*
		$txtRplc=str_replace(" from "," FROM ",$query_script);
		$txtRplc=str_replace("`","",$txtRplc);
		$txtRplc=str_replace("select ","",$txtRplc);
		$txtRplc=str_replace("a.","",$txtRplc);
		$txtRplc=str_replace("b.","",$txtRplc);
		$txtRplc=str_replace("c.","",$txtRplc);
		$txtRplc=str_replace("d.","",$txtRplc);
		$txtRplc=str_replace("e.","",$txtRplc);
		$txtRplc=str_replace("f.","",$txtRplc);
		$txtRplc=str_replace("g.","",$txtRplc);
		$txtRplc=str_replace("h.","",$txtRplc);
		$txtRplc=str_replace("i.","",$txtRplc);
		$txtRplc=str_replace("j.","",$txtRplc);

		
		$Utext=strpos($txtRplc," FROM ");	
		$IsiText=substr($txtRplc,0,$Utext);
		$IsiText=str_replace(" ","",$IsiText);

	
		$ArrField=explode(",",$IsiText);
*/
		///////////////////// ARR FIELD
		$link="";$i=1;
		$Qry=_mysql_query("SELECT b.field_sumber ,a.COLUMN_NAME as field_dwh, id_maping_fields, if(a.COLUMN_KEY='PRI','Y', b.param) AS param, a.COLUMN_TYPE FROM information_schema.columns as a left join (select field_dwh, field_sumber, id_maping_fields, param from reg_maping_sumber_to_dwh_field where id_maping='{$id_maping}') as b on a.COLUMN_NAME=b.field_dwh WHERE a.table_name = '{$table_dwh}' and a.TABLE_SCHEMA='{$dbdwh}'");


		$ListMode="";
		///// LIST GRID
		$ArrField=!empty($ArrField)?$ArrField:array();
		while($Isi=_mysql_fetch_array($Qry)){
			$wr = $i % 2 == 0 ? "style='background:$Main->BgRow'" : "style='background:$Main->BgRow2'";
			$wh = $i % 2 == 0 ? "$Main->BgRow" : "$Main->BgRow2";
			$ListMode.="
				".$Func->txtField("id_maping_fields[$i-1]",$Isi['id_maping_fields'],'','','hidden')."
				".$Func->txtField("field_dwh[$i-1]",$Isi['field_dwh'],'','','hidden')."
				".$Func->txtField("COLUMN_TYPE[$i-1]",$Isi['COLUMN_TYPE'],'','','hidden')."
				<tr $wr  onmouseover=\"TG(this,'#FFCC33')\" onmouseout=\"TG(this,'$wh')\">
					<td align=center>$i</td>
					<td>".$Func->cmbUmum("field_sumber[$i-1]",$Isi['field_sumber'],$ArrField,"style='background:$wh;'")."</td>
					<td>{$Isi['field_dwh']}</td>	
					<td>".$Func->cmbUmum("param[$i-1]",$Isi['param'],array("Y","N"),"style='background:$wh;'")."</td>
				</tr>
			";$i++;
		}
		
		$List.="
		
			".$Func->tabSplit("Maping [{$dbsumber}.{$query_sumber}] to [{$dbdwh}.{$table_dwh}]")."
			<p align=right>
			<input type='button' align=right value='Simpan' class='button' onclick=\"Fm.Action.value='Simpan';Fm.submit();\"/>
			</p>
			<table class='tablesorter' id='tablesorter' width=100% cellpadding=1 cellspacing=0 align=center>
			<thead>
			<tr>
				<th width=10>".$Func->SortHeader("No.")."</th>
				<th>".$Func->SortHeader("Field Sumber <br>[{$dbsumber}.{$query_sumber}]")."</th>
				<th>".$Func->SortHeader("Field DWH <br>[{$dbdwh}.{$table_dwh}]")."</th>			
				<th width=15>".$Func->SortHeader("Set. Param")."</th>			
			</tr>
				<tbody>$ListMode</tbody>
			</table>

		";
	}
		/// LIST TABLES

	/////////// FORM
	$Form="";

	$Main->Isi="
	<form name=Fm id=Fm method=post action='$PHP_SELF?Pg=$Pg&Pr=$Pr#transaksi' enctype='multipart/form-data'>
	{$Form}{$List}
	".$Func->txtField('id_maping',$id_maping,'','','hidden')."
	".$Func->txtField('Action',$Action,'','','hidden')."
	".$Func->txtField('tbldwh',@$tbldwh,'','','hidden')."
	</form>
	
	";
	
?>