<?php
	$dbname=!empty($dbname)?$dbname:"";
	//////////// TABLE LIST
		/// DATABASES
	$ListMode="";$i=1;	
	$TextTemp="tmp";
	///// PARAMETER AND QUERY GRID
	$Qry="select id_dbname, dbname from reg_db_mart";
	$Qry=_mysql_query($Qry);

	///// LIST GRID
	while($Isi=_mysql_fetch_array($Qry)){
		$wr = $i % 2 == 0 ? "style='background:$Main->BgRow'" : "style='background:$Main->BgRow2'";
		$wh = $i % 2 == 0 ? "$Main->BgRow" : "$Main->BgRow2";
		
		$ListMode.="
			<tr $wr  onmouseover=\"TG(this,'#FFCC33')\" onmouseout=\"TG(this,'$wh')\">
				<td align=center>$i</td>
				<td onclick=\"Fm.dbname.value='{$Isi['dbname']}';Fm.submit();\">{$Isi['dbname']}</td>
			
				

				<!-- <td width=10 onclick=\"javascript:showPopUp('400','200');ambilData('#faceboxisi', 'index.php?Pg=$Pg&Pr=$Pr&Mode=detail&Aksi=Lihat&id={$Isi['id_dbname']}')\">
					<img src='{$Dir->Images}/icon/edit.gif'>
				</td> -->
				<td width=10 onclick=\"Cek=confirm('Yakin {$Isi['dbname']} akan dihapus?');if(!Cek){return false;}else{javascript:showPopUp('400','200');ambilData('#faceboxisi', 'index.php?Pg=$Pg&Pr=$Pr&Mode=detail_cdatabase&Aksi=Hapus&id={$Isi['id_dbname']}')}\">

					<img src='{$Dir->Images}/icon/hapus.gif'>
				</td>
			</tr>
		";$i++;
	}
	
	$List="
		".$Func->tabSplit("List Databases Data Mart")."
		<p align=right>
		<input type='button' align=right value='Tambah' class='button' onclick=\"javascript:showPopUp('400','200');ambilData('#faceboxisi', 'index.php?Pg=$Pg&Pr=$Pr&Mode=detail_cdatabase')\"/>
		</p>
		<table class='tablesorter' id='tablesorter' width=100% cellpadding=1 cellspacing=0 align=center>
		<thead>
		<tr>
			<th width=10>".$Func->SortHeader("No.")."</th>
			<th>".$Func->SortHeader("Nama Database Data Mart")."</th>
		
			
			<th>&nbsp;</th>	
		</tr>
			<tbody>$ListMode</tbody>
		</table>
		$link
	";
	if(!empty($dbname)){
			/// TABLES
		///// PARAMETER AND QUERY GRID
		$Qry="select id_table,table_name from reg_db_mart_table where dbname='{$dbname}'";
		$Param="index.php?Pg=$Pg&Pr=$Pr&ckata=$ckata&Action=$Action&dbname=$dbname";	
		///// PAGE HALAMAN GRID
		$PageNavi = new pageNavi;
		$posisi = $PageNavi->cariPosisi($batas);$i=$posisi+1; 
		$jmldata = _mysql_num_rows(_mysql_query($Qry));
		$jmlhalaman = $PageNavi->jumlahHalaman($jmldata, $batas);
		$linkHalaman = $PageNavi->navHalaman($halaman, $jmlhalaman, $Param);
		$link="<div class='light'><div class='pageNavi'>$linkHalaman</div></div>";
		$Qry=_mysql_query($Qry." limit $posisi,$batas");
		$ListMode="";
		///// LIST GRID
		while($Isi=_mysql_fetch_array($Qry)){
			$wr = $i % 2 == 0 ? "style='background:$Main->BgRow'" : "style='background:$Main->BgRow2'";
			$wh = $i % 2 == 0 ? "$Main->BgRow" : "$Main->BgRow2";
			$ListMode.="
				<tr $wr  onmouseover=\"TG(this,'#FFCC33')\" onmouseout=\"TG(this,'$wh')\">
					<td align=center>$i</td>
					<td>{$Isi['table_name']}</td>
				
					<td width=10 onclick=\"javascript:showPopUp('700','200');ambilData('#faceboxisi', 'index.php?Pg=$Pg&Pr=$Pr&Mode=detail_ctables&Aksi=Lihat&dbnameid=$dbname&id={$Isi['id_table']}')\">
						<img src='{$Dir->Images}/icon/edit.gif'>
					</td>
					<td width=10 onclick=\"Cek=confirm('Yakin {$Isi['table_name']} akan dihapus?');if(!Cek){return false;}else{javascript:showPopUp('700','200');ambilData('#faceboxisi', 'index.php?Pg=$Pg&Pr=$Pr&Mode=detail_ctables&Aksi=Hapus&dbnameid=$dbname&id={$Isi['id_table']}')}\">

						<img src='{$Dir->Images}/icon/hapus.gif'>
					</td>
				</tr>
			";$i++;
		}
		
		$List.="
			".$Func->tabSplit("List Tables Database : ".strtoupper($dbname))."
			<p align=right>
			<input type='button' align=right value='Tambah' class='button' onclick=\"javascript:showPopUp('700','200');ambilData('#faceboxisi', 'index.php?Pg=$Pg&Pr=$Pr&Mode=detail_ctables&dbnameid=$dbname')\"/>
			</p>
			$link
			<table class='tablesorter' id='tablesorter' width=100% cellpadding=1 cellspacing=0 align=center>
			<thead>
			<tr>
				<th width=10>".$Func->SortHeader("No.")."</th>
				<th>".$Func->SortHeader("Nama Tables")."</th>
				<th colspan=2>&nbsp;</th>	
			</tr>
				<tbody>$ListMode</tbody>
			</table>
			$link
		";
	}
		/// LIST TABLES

	/////////// FORM
	$Form="";

	$Main->Isi="
	<form name=Fm id=Fm method=post action='$PHP_SELF?Pg=$Pg&Pr=$Pr#transaksi' enctype='multipart/form-data'>
	{$Form}{$List}
	".$Func->txtField('dbname',$dbname,'','','hidden')."
	</form>
	
	";
	
?>