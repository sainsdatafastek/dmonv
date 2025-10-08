<?php
		/// TABLES
		///// PARAMETER AND QUERY GRID
		$Qry="select id_query,query_name, query_script from reg_db_sumber_query where dbname='{$dbname}'";
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
					<td>{$Isi['query_name']}</td>
					<td>{$Isi['query_script']}</td>	
					<td width=10 onclick=\"javascript:showPopUp('750','200');ambilData('#faceboxisi', 'index.php?Pg=$Pg&Pr=$Pr&Mode=console_query&dbname=$dbname&id={$Isi['id_query']}')\"/>
						Lihat&nbsp;Data
					</td>
					<td width=10 onclick=\"javascript:showPopUp('700','200');ambilData('#faceboxisi', 'index.php?Pg=$Pg&Pr=$Pr&Mode=detail_cquery&Aksi=Lihat&dbnameid=$dbname&id={$Isi['id_query']}')\">
						<img src='{$Dir->Images}/icon/edit.gif'>
					</td>
					<td width=10 onclick=\"Cek=confirm('Yakin {$Isi['query_name']} akan dihapus?');if(!Cek){return false;}else{javascript:showPopUp('700','200');ambilData('#faceboxisi', 'index.php?Pg=$Pg&Pr=$Pr&Mode=detail_cquery&Aksi=Hapus&dbnameid=$dbname&id={$Isi['id_query']}')}\">

						<img src='{$Dir->Images}/icon/hapus.gif'>
					</td>
				</tr>
			";$i++;
		}

		$IsiList="
			<p align=right>
			<input type='button' align=right value='Query Console' class='button' onclick=\"javascript:showPopUp('750','200');ambilData('#faceboxisi', 'index.php?Pg=$Pg&Pr=$Pr&Mode=console_query&dbname=$dbname')\"/>
			<input type='button' align=right value='Tambah Query' class='button' onclick=\"javascript:showPopUp('750','200');ambilData('#faceboxisi', 'index.php?Pg=$Pg&Pr=$Pr&Mode=detail_cquery&dbnameid=$dbname')\"/>
			</p>

			$link
			<table class='tablesorter' id='tablesorter' width=100% cellpadding=1 cellspacing=0 align=center>
			<thead>
			<tr>
				<th width=10>".$Func->SortHeader("No.")."</th>
				<th>".$Func->SortHeader("Nama Tables")."</th>
				<th>".$Func->SortHeader("Script Query")."</th>
				<th colspan=3>&nbsp;</th>	
			</tr>
				<tbody>$ListMode</tbody>
			</table>
			$link
		";
?>